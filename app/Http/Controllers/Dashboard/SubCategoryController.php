<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Support\Facades\Storage;

class SubCategoryController extends BackEndController
{

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    protected function append()
    {
        $categories = $this->model->whereNull('parent_id')->get();
        return ['categories'=>$categories];
    } //end of append

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $module_name_plural   = "subcategories";
        $module_name_singular = "subcategory";
        $append = $this->append();

        return view('dashboard.' . $module_name_plural . '.create', compact('module_name_singular', 'module_name_plural'))->with($append);
    } //end of create

    protected function uploadImage($image, $path)
    {
        $imageName = $image->hashName();
        Image::make($image)->resize(null, 200, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('uploads/' . $path . '/' . $imageName));
        return $imageName;
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
            'parent_id' => 'required|exists:categories,id',
            'image'       => 'required|image|max:2048',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [
                $locale . '.name'        => ['required', 'string', 'min:3', 'max:191', Rule::unique('category_translations', 'name')->where(function ($query) {
                    $query->join('categories', function($j){ return $j->where('categories.store_id', '=', auth()->user()->store_id)->where('parent_id', $request->parent_id); });
                }),],
                $locale . '.description' => 'nullable|string|min:3|max:500',
            ];
        }
        $request->validate($rules);

        $request_data = $request->except(['_token', 'image']);
        // store_id will change to setting_id cause now the suber admin is used that but the right store do
        $request_data['store_id'] = auth()->user()->app_setting_id;
        $request_data['created_by'] = auth()->user()->id;
    
        if ($request->image) {
            $request_data['image'] = $this->uploadImage($request->image, 'categories_images');
        }

        $this->model->create($request_data);
        session()->flash('success', __('site.add_successfuly'));
        return redirect()->route('dashboard.subcategories.index');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $module_name_plural   = "subcategories";
        $module_name_singular = "subcategory";
        $append = $this->append();
        $row = $this->model->findOrFail($id);
        return view('dashboard.subcategories.edit', compact('row', 'module_name_singular', 'module_name_plural'))->with($append);
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
        $subcategory = $this->model->findOrFail($id);
        $rules = [
            'image' => 'nullable|image|max:2000',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [
                $locale . '.name'        => ['required', 'string', 'min:3', 'max:191', Rule::unique('category_translations', 'name')->ignore($subcategory->id, 'category_id')->where(function ($query) {
                    $query->join('categories', function($j){ return $j->where('categories.store_id', '=', auth()->user()->store_id)->where('parent_id', $request->parent_id); });
                }),],
                $locale . '.description' => 'nullable|string|min:3|max:500',
            ];
        }
        $request->validate($rules);

        $request_data = $request->except(['_token', 'image']);
        if ($request->image) {
            if ($subcategory->image != null) {
                Storage::disk('public_uploads')->delete('categories_images/' . $subcategory->image);
            }
            $request_data['image'] = $this->uploadImage($request->image, 'categories_images');
        } //end of if

        $subcategory->update($request_data);
        session()->flash('success', __('site.updated_successfuly'));
        return redirect()->route('dashboard.subcategories.index');
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
            Storage::disk('public_uploads')->delete('categories_images/' . $category->image);
        }
        $category->delete();
        session()->flash('success', __('site.deleted_successfuly'));
        return redirect()->route('dashboard.subcategories.index');
    }
}
