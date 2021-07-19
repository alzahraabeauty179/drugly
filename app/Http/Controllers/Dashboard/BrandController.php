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
        // return $request;
        $rules = [
            'image' => 'nullable|image|max:2048',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [
                $locale . '.name'        => ['required', 'string', 'min:3', 'max:191', Rule::unique('brand_translations', 'name')->where(function ($query) {
                    $query->join('brands', function($j){ return $j->where('brands.owner_id', '=', auth()->user()->id); });
                }),],               
                $locale . '.description' => 'nullable|string|min:3|max:500',
            ];
        }
        $request->validate($rules);

        $request_data = $request->except(['_token', 'image']);
        $request_data['owner_id'] = auth()->user()->id;
        if ($request->image) {
            $request_data['image'] = $this->uploadImage($request->image, $this->getClassNameFromModel() . '_images');
        }

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

        $brand = $this->model->findOrFail($id);
        $rules = [
            'image' => 'nullable|image|max:2000',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [       
                $locale . '.name'        => ['required', 'string', 'min:3', 'max:191', Rule::unique('brand_translations', 'name')->ignore($brand->id, 'brand_id')->where(function ($query) {
                    $query->join('brands', function($j){ return $j->where('brands.owner_id', '=', auth()->user()->id); });
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
        session()->flash('success', __('site.updated_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $brand = $this->model->findOrFail($id);
        if ($brand->image != null) {
            Storage::disk('public_uploads')->delete($this->getClassNameFromModel() . '_images/' . $brand->image);
        }
        $brand->delete();
        session()->flash('success', __('site.deleted_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }
}
