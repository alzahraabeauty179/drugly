<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\DataTables\SubscriberDataTable;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Storage;

use DataTables;
use Carbon\Carbon;

class SubscriberController extends BackEndDatatableController
{

    public function __construct(Subscriber $model, SubscriberDataTable $subscriberDataTable)
    {
        parent::__construct($model, $subscriberDataTable);
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

        return VIEW('dashboard.' . $module_name_plural . '.show', compact('module_name_singular', 'module_name_plural', 'row'));
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
    	$rules = [
            'decision'     => 'required|in:accepting,rejecting',
        ];
    
        foreach (config('translatable.locales') as $locale) {
            $rules += [
                $locale . '.message'        => 'required|string|min:3|max:500',
            ];
        }
    	
    	$request->validate($rules);
    
    	$subscriber = $this->model->findOrFail($id);
    	
    	# Update the subscribe data
    	if($request->decision == 'rejecting')
        {
        	$user = User::findOrFail($subscriber->subscriber_id);
        	$subscriber->delete();
        	// dd("working on sending user's mail");
        	$user->delete();
        
        	session()->flash('success', __('site.subscribe_rejected_successfully'));
       	 	return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
        
        }else{
        	$subscriber->update([
            	'status'		=>$request->decision,
            	'start_date'	=>Carbon::now(),
            	'end_date'		=>Carbon::now()->addMonth($subscriber->subscription->duriation)->format('Y-m-d'),
            ]);
    		// dd("working on sending user's mail");
        
        	session()->flash('success', __('site.subscribe_accepted_successfully'));
       	 	return redirect()->route('dashboard.user.role.index');
        }

    }

}
