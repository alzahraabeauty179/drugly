<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Dashboard\BackEndController;
use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DataTables;

// use Yajra\Datatables\Datatables;

class CategoryController extends BackEndController
{
    public function __construct(Category $model, CategoryDataTable $catDataTable)
    {
        parent::__construct($model, $catDataTable);
    }

    // public function index()
    // {
    //     // return $this->dataTable->get();
    //     $module_name_plural = $this->getClassNameFromModel();
    //     $module_name_singular = $this->getSingularModelName();

    //     return VIEW('dashboard.' . $module_name_plural . '.index', compact('module_name_singular', 'module_name_plural'));
    // }

    public function isExists(Request $request, $id)
    {
        $ownerData = Category::where('owner_id', auth()->user()->id)->whereNull('parent_id')->pluck('id')->toArray();
        $result = 0;

        foreach (config('translatable.locales') as $locale)
            if (is_null($id))
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
        if ($this->isExists($request, null) != 0) {
            session()->flash('error', __('site.repeated_data'));
            return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.create');
        } else {
            $rules = [
                'image'     => 'nullable|image|max:2048',
                'parent_id' => ['required', Rule::exists('categories', 'id')->where(function ($query) {
                    $query->whereNull('parent_id');
                }),],

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
        if ($this->isExists($request, $id) != 0) {
            session()->flash('error', __('site.repeated_data'));
            return redirect()->back();
        } else {

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


    public function dataAjax()
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
