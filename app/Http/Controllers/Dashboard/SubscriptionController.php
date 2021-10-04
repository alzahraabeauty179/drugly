<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Dashboard\BackEndDatatableController;
use App\DataTables\SubscriptionDataTable;
use App\Models\Subscription;
use DataTables;

class SubscriptionController extends BackEndDatatableController
{
    /**
     * Constructor.
     */
    public function __construct(Subscription $model, SubscriptionDataTable $subscriptionDataTable)
    {
        parent::__construct($model, $subscriptionDataTable);
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
        	'type'		=> 'required|string|in:medical_store,beauty_company,pharmacy',
        	'price'		=> 'required|numeric|min:0|max:1264',
        	'duriation'	=> 'required|integer|min:1',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [
                $locale . '.name'        => ['required', 'string', 'min:3', 'max:191', Rule::unique('subscription_translations', 'name')->where(function ($query) {
                    $query->join('subscriptions', function($j){ return $j->where('subscriptions.type', $_REQUEST['type']); });
                }),],
                $locale . '.description' => 'required|string|min:3|max:500',
            ];
        }

        $request->validate($rules);

        $request_data = $request->except(['_token']);

        $request_data['created_by'] = auth()->user()->id;

        $this->model->create($request_data);
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
        $subscription = $this->model->findOrFail($id);
        $rules = [
        	'type'		=> 'required|string|in:medical_store,beauty_company,pharmacy',
        	'price'		=> 'required|numeric|min:0|max:1264',
        	'duriation'	=> 'required|integer|min:1',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [
                $locale . '.name'        => ['required', 'string', 'min:3', 'max:191', Rule::unique('subscription_translations', 'name')
                                             											   ->ignore($subscription->id, 'subscription_id')
                                             											   ->where(function ($query) {
                    						$query->join('subscriptions', function($j){ return $j->where('subscriptions.type', $_REQUEST['type']); });
                							}),],
                $locale . '.description' => 'required|string|min:3|max:500',
            ];
        }
        $request->validate($rules);

        $request_data = $request->except(['_token']);

        $subscription->update($request_data);
        session()->flash('success', __('site.updated_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }

}
