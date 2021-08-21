<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\AdvertisementDataTable;
use App\Models\Advertisement;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DataTables;

class AdvertisementController extends BackEndDatatableController
{
	/**
     * Constructor.
     */
	public function __construct(Advertisement $model, AdvertisementDataTable $adDataTable)
    {
        parent::__construct($model, $adDataTable);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$rules = [
            'image'     		=> 'required|image|max:2048',
            'end_date' 			=> 'required|date',
        	'owner_id' 			=> 'nullable|exists:users,id',
        	'display_method'	=> 'required|in:horizontal,vertical,longitudinal',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [
                $locale . '.title'		=> ['required', 'string', 'min:3', 'max:191', Rule::unique('advertisement_translations', 'title')],
                $locale . '.content' 	=> 'nullable|string|min:3|max:500',
            ];
        }

        $request->validate($rules);

        $request_data = $request->except(['_token', 'image']);
            
		$request_data['created_by'] = auth()->user()->id;
        
        if ($request->image) {
            $request_data['image'] = $this->uploadImage($request->image, $this->getClassNameFromModel() . '_images');
        }
   		
        $ad = $this->model->create($request_data);

    	$data = [
        	'log_type'	=> $this->getClassNameFromModel(),
        	'log_id'  	=> $ad->id,
    		'message' 	=> $this->getSingularModelName().'_has_been_added',
        	'action_by'	=> auth()->user()->id,
    	];
	
    	$this->addLog($data);
    
        session()->flash('success', __('site.add_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $advertisement = $this->model->findOrFail($id);
        $rules = [
            'image' 			=> 'nullable|image|max:2000',
            'end_date' 			=> 'nullable|date',
        	'display_method'	=> 'required|in:horizontal,vertical,longitudinal',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [
                $locale . '.title'		=> ['required', 'string', 'min:3', 'max:191', Rule::unique('advertisement_translations', 'title')->ignore($advertisement->id, 'advertisement_id')],

                $locale . '.content' 	=> 'nullable|string|min:3|max:500',
            ];
        }
        $request->validate($rules);

        $request_data = $request->except(['_token', 'image']);
        if ($request->image) {
            if ($advertisement->image != null) {
                Storage::disk('public_uploads')->delete($this->getClassNameFromModel() . '_images/' . $advertisement->image);
            }
            $request_data['image'] = $this->uploadImage($request->image, $this->getClassNameFromModel() . '_images');
        } //end of if

        $advertisement->update($request_data);
    
        $data = [
        	'log_type'	=> $this->getClassNameFromModel(),
        	'log_id'  	=> $advertisement->id,
    		'message' 	=> $this->getSingularModelName().'_has_been_updated',
        	'action_by'	=> auth()->user()->id,
    	];
	
    	$this->addLog($data);
    
        session()->flash('success', __('site.updated_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }

}
