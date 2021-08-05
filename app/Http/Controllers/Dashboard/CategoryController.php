<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\CategoryDataTable;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DataTables;

// use Yajra\Datatables\Datatables;

class CategoryController extends BackEndDatatableController
{
    public function __construct(Category $model, CategoryDataTable $catDataTable)
    {
        parent::__construct($model, $catDataTable);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( is_null(auth()->user()->store_id) )
        {
            auth()->user()->type == "super_admin"?  session()->flash('error', __('site.only_for_stores')) : session()->flash('error', __('site.set_store_settings'));

            return redirect()->back();
        }
        
        $rules = [
            'image'     => 'nullable|image|max:2048',
            'parent_id' => ['nullable', Rule::exists('categories', 'id')->where(function ($query) {
                $query->whereNull('parent_id');
            }),]
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [
                $locale . '.name'        => ['required', 'string', 'min:3', 'max:191', Rule::unique('category_translations', 'name')->where(function ($query) {
                    $query->join('categories', function($j){ return $j->where('categories.store_id', '=', auth()->user()->store_id); });
                }),],
                $locale . '.description' => 'nullable|string|min:3|max:500',
            ];
        }

        $request->validate($rules);

        $request_data = $request->except(['_token', 'image']);

        $request_data['store_id'] = auth()->user()->store_id;
        $request_data['created_by'] = auth()->user()->id;
        
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
        $module_name_plural = $this->getClassNameFromModel();
        $module_name_singular = $this->getSingularModelName();

        return VIEW('dashboard.' . $module_name_plural . '.show', compact('module_name_singular', 'module_name_plural'));
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
                $locale . '.name'        => ['required', 'string', 'min:3', 'max:191', Rule::unique('category_translations', 'name')->ignore($category->id, 'category_id')->where(function ($query) {
                    $query->join('categories', function($j){ return $j->where('categories.store_id', '=', auth()->user()->store_id); });
                }),],

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

    /**
     * Display the specified sub/areas resource.
     *
     */
    public function subCategory()
    {
        // $x = $this->model->whereNull('parent_id');
        // return Datatables::of($x->newQuery())->make(true);

        $query = $this->model->where('parent_id', request()->subCategory);
        // return response()->json( Datatables::of($x)->make(true));

        return Datatables::of($query)
            ->addColumn('name', function ($query) {
                return  $query->translation->name;
            })->addColumn('description', function ($query) {
                return $query->translation->description;
            })->editColumn('created_at', function ($query) {
                return $query->created_at->diffForHumans();
            })
            ->addColumn('action', function ($query) {
                $module_name_singular = 'category';
                $module_name_plural   = 'categories';
                $row = $query;
                return view('dashboard.buttons.edit', compact('module_name_singular', 'module_name_plural', 'row')) .  view('dashboard.buttons.delete', compact('module_name_singular', 'module_name_plural', 'row'));
                // return '<a  href="' . route("dashboard.categories.edit", ["category" => $l]) . '" class="btn btn-info">edit</>';
            })

            // ->setRowClass('{{ $id % 2 == 0 ? "alert-success" : "alert-primary" }}')
            ->filter(function ($query) {
                return $query
                    ->where('parent_id', request()->subCategory)
                    ->where(function ($w) {
                        return $w->whereTranslationLike('name', "%" . request()->search['value'] . "%")
                            ->orwhereTranslationLike('description', "%" . request()->search['value'] . "%")
                            ->orwhere('id', 'like', "%" . request()->search['value'] . "%")
                            ->orwhere('created_at', 'like', "%" . request()->search['value'] . "%")
                            ->orwhere('updated_at', 'like', "%" . request()->search['value'] . "%");
                    });
            })
            ->rawColumns(['action', 'name']) // this is for show view and url 
            // ->Button::make('excel')

            ->make(true);
    }
}
