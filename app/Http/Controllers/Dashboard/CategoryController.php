<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\BackEndController;
use App\Http\Controllers\Dashboard\Datatables\CategoryDatatablesController;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\DataTables\UsersDataTable;
use DataTables;


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

        $rules = [
            'image' => 'nullable|image|max:2048',
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
        $rules = [
            'image' => 'nullable|image|max:2000',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [
                $locale . '.name'        => 'required|string|min:3|max:200',
                $locale . '.description' => 'required|string|min:3|max:500',
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


    public function datatableAjax(Request  $request)
    {
        $module_name_plural = $this->getClassNameFromModel();
        $module_name_singular = $this->getSingularModelName();

        // return $request
        $model = Category::query();
        // return $model;
        return DataTables::eloquent($model)
            ->addColumn('name', function (Category $n) {
                return $n->translation->name;
            })->addColumn('description', function (Category $d) {
                return $d->translation->description;
            })->editColumn('created_at', function (Category $d) {
                return $d->created_at->diffForHumans();
            })
            // ->editColumn('updated_at', 'dashboard.buttons.edit')
            ->setRowClass('{{ $id % 2 == 0 ? "alert-success" : "alert-warning" }}')
            ->filter(function ($query) use ($request) {
                return $query
                    ->whereTranslationLike('name', "%" . $request->search['value'] . "%")
                    ->orwhereTranslationLike('description', "%" . $request->search['value'] . "%")
                    ->orwhere('id', 'like', "%" . $request->search['value'] . "%")
                    ->orwhere('created_at', 'like', "%" . $request->search['value'] . "%")
                    ->orwhere('updated_at', 'like', "%" . $request->search['value'] . "%");
            })

            // ->orderColumn('name', function ($query, $order = 'DESC') {
            //      $query->join('category_translations', function($join){
            //          return $join->on('categories.id', '=', 'category_translations.category_id')->select('category_translations.id AS ali', 'category_translations.name AS name', 'category_translations.description AS description'); //->orderBy('category_translations.name', 'DESC');
            //      });
            //     //  $query->join('category_translations', 'categories.id', '=', 'category_translations.category_id')->orderBy('category_translations.name', 'DESC');
            //     // ->orderBy('status', $order);
            // })

            // ->orderColumns(['id', 'created_at'], '-:column $1')

            // ->orderColumn('name', function ($query, Category $n) {
            //     return $query->orderBy($n->translation->name, 'DESC');
            // }) 

            // ->orderColumn('name', 'category_translations.name')

            // ->order(function ($query) {
            //     if (request()->has('name')) {
            //         return $query->orderBy('category_translations.name', 'asc');
            //     };
            //     if (request()->has('description')) {
            //         return $query->orderBy('description', 'desc');
            //     } 
            //      if (request()->has('id')) {
            //         return $query->orderBy('id', 'DESC');
            //     }
            // })
            ->toJson();
    }
}
