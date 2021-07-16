<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\CategoryDataTable;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class OwnerController extends BackEndController
{

    public function __construct(Owner $model, CategoryDataTable $userDataTable)
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
        // return $request;
        $request->validate([
            'ar.name'      => 'required|min:5|unique:owner_translations,name',
            'en.name'      => 'required|min:5|unique:owner_translations,name',
            'ar.address'   => 'required|min:5|unique:owner_translations,address',
            'en.address'   => 'required|min:5|unique:owner_translations,address',
            'ar.title'     => 'required|min:5|unique:owner_translations,title',
            'en.title'     => 'required|min:5|unique:owner_translations,title',
            'phone'        => 'required|string',
            'phone_whats'  => 'required|string',
            'email'        => 'required|email',
            'image'        => 'required|image',
        ]);
        request()->request->add(['author' => auth()->user()->id,]);
        $request_data = $request->except(['_token', 'image']);
        if ($request->image) {
            $request_data['image'] = $this->uploadImage($request->image, 'owner_images');
        }
        Owner::create($request_data);
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
        //
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
        $owner = $this->model->findOrFail($id);
        $request->validate([
            'ar.name'          => ['required', 'min:5', Rule::unique('owner_translations', 'name')->ignore($owner->id, 'owner_id')],
            'en.name'          => ['required', 'min:5', Rule::unique('owner_translations', 'name')->ignore($owner->id, 'owner_id')],
            'ar.address'       => ['required', 'min:5', Rule::unique('owner_translations', 'address')->ignore($owner->id, 'owner_id')],
            'en.address'       => ['required', 'min:5', Rule::unique('owner_translations', 'address')->ignore($owner->id, 'owner_id')],
            'ar.title'         => ['required', 'min:5', Rule::unique('owner_translations', 'title')->ignore($owner->id, 'owner_id')],
            'en.title'         => ['required', 'min:5', Rule::unique('owner_translations', 'title')->ignore($owner->id, 'owner_id')],
            'image'            => 'nullable|image',
        ]);
        // return $owner;
        $request_data = $request->except(['_token', 'image']);
        if ($request->image) {
            if ($owner->image != null) {
                Storage::disk('public_uploads')->delete('/owner_images/' . $owner->image);
            }
            $request_data['image'] = $this->uploadImage($request->image, 'owner_images');
        } //end of if

        $owner->update($request_data);
        // return $request_data;
        session()->flash('success', __('site.update_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }

    public function destroy($id, Request $request)
    {
        $owner = $this->model->findOrFail($id);
        if ($owner->image != null) {
            Storage::disk('public_uploads')->delete('/owner_images/' . $owner->image);
        }
        $owner->delete();
        session()->flash('success', __('site.deleted_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }
}
