<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\BrandDataTable;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class BrandController extends BackEndDatatableController
{
    /**
     * Constructor.
     */
    public function __construct(Brand $model, BrandDataTable $brandDataTable)
    {
        parent::__construct($model, $brandDataTable);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( is_null(auth()->user()->store_id) )
        {
            session()->flash('error', __('site.set_store_settings'));
            return redirect()->back();
        }
  
        $rules = [
            'image' => 'nullable|image|max:2048',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [
                $locale . '.name'        => ['required', 'string', 'min:3', 'max:191', Rule::unique('brand_translations', 'name')->where(function ($query) {
                    $query->join('brands', function($j){ return $j->where('brands.store_id', '=', auth()->user()->store_id); });
                }),],               
                $locale . '.description' => 'nullable|string|min:3|max:500',
            ];
        }
        $request->validate($rules);

        $request_data = $request->except(['_token', 'image']);

        $request_data['store_id'] = auth()->user()->store_id;
        $request_data['created_by'] = auth()->user()->id;

        if ($request->image) {
            $request_data['image'] = $this->uploadImage($request->image, $this->getClassNameFromModel() . '_images');
        }

        $brand = $this->model->create($request_data);
    	
    	$data = [
        	'log_type'	=> $this->getClassNameFromModel(),
        	'log_id'  	=> $brand->id,
    		'message' 	=> $this->getSingularModelName().'_has_been_added',
        	'action_by'	=> auth()->user()->id,
    	];
    	$this->addLog($data);
    
        session()->flash('success', __('site.add_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $module_name_plural = $this->getClassNameFromModel();
        $module_name_singular = $this->getSingularModelName();
        $row = $this->model->findOrFail($id);

        return view('dashboard.' . $module_name_plural . '.show', compact('module_name_singular', 'module_name_plural', 'row'));
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
        $brand = $this->model->findOrFail($id);
        
        $rules = [
            'image' => 'nullable|image|max:2000',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [       
                $locale . '.name'        => ['required', 'string', 'min:3', 'max:191', Rule::unique('brand_translations', 'name')->ignore($brand->id, 'brand_id')->where(function ($query) {
                    $query->join('brands', function($j){ return $j->where('brands.store_id', '=', auth()->user()->store_id); });
                }),],  

                $locale . '.description' => 'nullable|string|min:3|max:500',
            ];
        }
        $request->validate($rules);

        $request_data = $request->except(['_token', 'image']);
        if ($request->image) {
            if ($brand->image != null) {
                Storage::disk('public_uploads')->delete($this->getClassNameFromModel() . '_images/' . $brand->image);
            }
            $request_data['image'] = $this->uploadImage($request->image, $this->getClassNameFromModel() . '_images');
        } //end of if

        $brand->update($request_data);
    	
    	$data = [
        	'log_type'	=> $this->getClassNameFromModel(),
        	'log_id'  	=> $brand->id,
    		'message' 	=> $this->getSingularModelName().'_has_been_updated',
        	'action_by'	=> auth()->user()->id,
    	];
    	$this->addLog($data);
    
        session()->flash('success', __('site.updated_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }

}
