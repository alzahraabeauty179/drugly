<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\BackEndController;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class BrandController extends BackEndController
{
    /**
     * Constructor.
     */
    public function __construct(Brand $model)
    {
        parent::__construct($model);
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
            'image' => 'required|image|max:2048',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [
                $locale . '.name'        => 'required|string|min:3|max:200',
                $locale . '.description' => 'required|string|min:3|max:500',
            ];
        }
        $request->validate($rules);

        $request_data = $request->except(['_token', 'image']);
        $request_data['owner_id'] = auth()->user()->id;

        if ($request->image) {
            $request_data['image'] = $this->uploadImage($request->image, $this->getClassNameFromModel() . '_images');
        }

        $request_data = $request->except(['image', '_token']);
        if ($request->image) {
            $request_data['image'] = $this->uploadImage($request->image, 'brands_images');
        }

        $this->model->create($request_data);
        session()->flash('success', __('site.add_successfuly'));
        return redirect()->route('dashboard.'.$this->getClassNameFromModel().'.index');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        //
    }
}
