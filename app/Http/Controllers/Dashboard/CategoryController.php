<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\BackEndController;
use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends BackEndController
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function isExists(Request $request, $id)
    {
        $ownerData = Category::where('owner_id', auth()->user()->id)->whereNull('parent_id')->pluck('id')->toArray();
        $result = 0;

        foreach (config('translatable.locales') as $locale)
            if( is_null($id) )
                $result += CategoryTranslation::where('name', $request[$locale . '.name'])->whereIn('category_id', $ownerData)->count();
            else
                $result += CategoryTranslation::where('name', $request[$locale . '.name'])->whereIn('category_id', $ownerData)
                                              ->where('category_id', '!=', $id)->count();

        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( $this->isExists($request, null) != 0 )
        {
            session()->flash('error', __('site.repeated_data'));
            return redirect()->route('dashboard.'.$this->getClassNameFromModel().'.create');

        }else{
            $rules = [
                'image' => 'required|image|max:2048',
            ];
            foreach (config('translatable.locales') as $locale) {
                $rules += [
                    $locale . '.name'        => 'required|string|min:3|max:200',
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
        if( $this->isExists($request, $id) != 0 )
        {
            session()->flash('error', __('site.repeated_data'));
            return redirect()->back();

        }else{

            $category = $this->model->findOrFail($id);
            $rules = [
                'image' => 'nullable|image|max:2000',
            ];
            foreach (config('translatable.locales') as $locale) {
                $rules += [
                    $locale . '.name'        => 'required|string|min:3|max:200',
                    $locale . '.description' => 'nullable|string|min:3|max:500',
                ];
            }
            $request->validate($rules);

            $request_data = $request->except(['_token', 'image']);
            if ($request->image) {
                if ($category->image != null) {
                    Storage::disk('public_uploads')->delete($this->getClassNameFromModel() . '_images/' . $category->image);
                }
                $request_data['image'] = $this->uploadImage($request->image, $this->getClassNameFromModel() . '_images');
            } //end of if

            $category->update($request_data);
            session()->flash('success', __('site.updated_successfuly'));
            return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
        }
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
        $category = $this->model->findOrFail($id);
        if ($category->image != null) {
            Storage::disk('public_uploads')->delete($this->getClassNameFromModel() . '_images/' . $category->image);
        }
        $category->delete();
        session()->flash('success', __('site.deleted_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }
}
