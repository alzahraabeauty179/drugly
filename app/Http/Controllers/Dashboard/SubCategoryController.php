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

    public function __construct(Category $model, CategoryDataTable $subCatDataTable)
    {
        parent::__construct($model, $subCatDataTable);
    }

    public function isExists(Request $request, $id)
    {
        $ownerData = Category::where('owner_id', auth()->user()->id)->where('parent_id', $request->parent_id)->pluck('id')->toArray();
        $result = 0;

        foreach (config('translatable.locales') as $locale)
            if( is_null($id) )
                $result += CategoryTranslation::where('name', $request[$locale . '.name'])->whereIn('category_id', $ownerData)->count();
            else
                $result += CategoryTranslation::where('name', $request[$locale . '.name'])->whereIn('category_id', $ownerData)
                                              ->where('category_id', '!=', $id)->count();

        return $result;
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
        if( $this->isExists($request, null) != 0 )
        {
            session()->flash('error', __('site.repeated_data'));
            return redirect()->route('dashboard.subcategories.create');

        }else{
            $rules = [
                'parent_id' => 'required|exists:categories,id',
                'image'       => 'required|image|max:2048',
            ];
            foreach (config('translatable.locales') as $locale) {
                $rules += [
                    $locale . '.name'        => 'required|string|min:3|max:200',
                    $locale . '.description' => 'nullable|string|min:3|max:500',
                ];
            }
            $request->validate($rules);

            $request_data = $request->except(['_token', 'image']);
            $request_data['owner_id']  = auth()->user()->id;
        
            if ($request->image) {
                $request_data['image'] = $this->uploadImage($request->image, 'categories_images');
            }

            $this->model->create($request_data);
            session()->flash('success', __('site.add_successfuly'));
            return redirect()->route('dashboard.subcategories.index');
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
        if( $this->isExists($request, $id) != 0 )
        {
            session()->flash('error', __('site.repeated_data'));
            return redirect()->back();

        }else{
                
            $subcategory = $this->model->findOrFail($id);
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
                if ($subcategory->image != null) {
                    Storage::disk('public_uploads')->delete('categories_images/' . $subcategory->image);
                }
                $request_data['image'] = $this->uploadImage($request->image, 'categories_images');
            } //end of if

            $subcategory->update($request_data);
            session()->flash('success', __('site.updated_successfuly'));
            return redirect()->route('dashboard.subcategories.index');
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
            Storage::disk('public_uploads')->delete('categories_images/' . $category->image);
        }
        $category->delete();
        session()->flash('success', __('site.deleted_successfuly'));
        return redirect()->route('dashboard.subcategories.index');
    }
}
