<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\BackEndController;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends BackEndController
{
    public function __construct(Category $model)
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
        $request->validate([
            'ar.name'          => 'required|min:5|unique:category_translations,name',
            'en.name'          => 'required|min:5|unique:category_translations,name',
            'ar.description'   => 'required|min:5|unique:category_translations,description',
            'en.description'   => 'required|min:5|unique:category_translations,description',
            'image'            => 'required|image',
        ]);
        //    return $request;
        request()->request->add(['author' => auth()->user()->id,]);
        $request_data = $request->except(['image', '_token']);
        if ($request->image) {
            $request_data['image'] = $this->uploadImage($request->image, 'category_images');
        }

        Category::create($request_data);
        session()->flash('success', __('site.add_successfuly'));
        return redirect()->route('dashboard.'.$this->getClassNameFromModel().'.index');
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
        $category = $this->model->findOrFail($id);
        $request->validate([
            'ar.name'          => ['required', 'min:5', Rule::unique('category_translations','name')->ignore($category->id, 'category_id') ],
            'en.name'          => ['required', 'min:5', Rule::unique('category_translations','name')->ignore($category->id, 'category_id') ],
            'ar.description'   => ['required', 'min:5', Rule::unique('category_translations','description')->ignore($category->id, 'category_id') ],
            'en.description'   => ['required', 'min:5', Rule::unique('category_translations','description')->ignore($category->id, 'category_id') ],
            'image'            => 'nullable|image',
        ]);
        $request_data = $request->except(['_token', 'image']);
        if ($request->image) {
            if ($category->image != null) {
                Storage::disk('public_uploads')->delete('/category_images/' . $category->image); 
            }
           $request_data['image'] = $this->uploadImage($request->image, 'category_images');
        } //end of if

        $category->update($request_data);
        session()->flash('success', __('site.updated_successfuly'));
        return redirect()->route('dashboard.'.$this->getClassNameFromModel().'.index');
    }

    public function destroy($id, Request $request)
    {
        $category = $this->model->findOrFail($id);
        if($category->image != null){
            Storage::disk('public_uploads')->delete('/category_images/' . $category->image); 
        }
        $category->delete();
        session()->flash('success', __('site.deleted_successfuly'));
        return redirect()->route('dashboard.'.$this->getClassNameFromModel().'.index');
    }
}
