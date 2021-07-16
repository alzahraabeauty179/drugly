<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Dashboard\BackEndController;
use App\Models\Brand;
use App\Models\BrandTranslation;
use Illuminate\Http\Request;
use App\User;
use App\Models\AppSetting;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class UserController extends BackEndController
{
    
    /**
     * Constructor.
     */
    public function __construct(User $model, UserDataTable $userDataTable)
    {
        parent::__construct($model, $userDataTable);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $module_name_plural   = $this->getClassNameFromModel();
        $module_name_singular = $this->getSingularModelName();

        $app_settings = AppSetting::where('owner_id', auth()->user()->id)->first();
        $append = ['app_settings' => $app_settings];
   
        $row = $this->model->findOrFail($id);

        return view('dashboard.' . $this->getClassNameFromModel() . '.edit', compact('row', 'module_name_singular', 'module_name_plural'))->with($append);
    } //end of edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $brand = $this->model->findOrFail($id);
        // $rules = [
        //     'image' => 'nullable|image|max:2000',
        // ];
        // foreach (config('translatable.locales') as $locale) {
        //     $rules += [
        //         $locale . '.name'        => 'required|string|min:3|max:200',
        //         $locale . '.description' => 'nullable|string|min:3|max:500',
        //     ];
        // }
        // $request->validate($rules);

        // $request_data = $request->except(['_token', 'image']);
        // if ($request->image) {
        //     if ($brand->image != null) {
        //         Storage::disk('public_uploads')->delete($this->getClassNameFromModel() . '_images/' . $brand->image);
        //     }
        //     $request_data['image'] = $this->uploadImage($request->image, $this->getClassNameFromModel() . '_images');
        // } //end of if

        // $brand->update($request_data);
        // session()->flash('success', __('site.updated_successfuly'));
        // return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
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
        // $brand = $this->model->findOrFail($id);
        // if ($brand->image != null) {
        //     Storage::disk('public_uploads')->delete($this->getClassNameFromModel() . '_images/' . $brand->image);
        // }
        // $brand->delete();
        // session()->flash('success', __('site.deleted_successfuly'));
        // return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }
}
