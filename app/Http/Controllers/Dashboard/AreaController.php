<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\AreaDataTable;
use App\Models\Area;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

class AreaController extends BackEndDatatableController
{
	/**
     * Constructor.
     */
    public function __construct(Area $model, AreaDataTable $areaDataTable)
    {
        parent::__construct($model, $areaDataTable);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $module_name_plural   = "areas";
        $module_name_singular = "area";

        $append = ['areas'=>Area::whereNUll('parent_id')->where('created_by', auth()->user()->id)->get()];

        return view('dashboard.' . $module_name_plural . '.create', compact('module_name_singular', 'module_name_plural'))->with($append);
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
            'parent_id' => $_REQUEST['parent_id']  == ''?'nullable' : 'nullable|exists:areas,id',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [
                $locale . '.name'        => ['required', 'string', 'min:3', 'max:191', Rule::unique('area_translations', 'name')->where(function ($query) {
                    $query->join('areas', function($j){ 
                    	return $j->where('parent_id', '!=', $_REQUEST['parent_id']);
                        // return $_REQUEST['parent_id'] != ''? $j->where('parent_id', $_REQUEST['parent_id']) : $j;
                    });
                }),],
            ];
        }
        
        $request->validate($rules);

        $request_data = $_REQUEST['parent_id']  == ''? $request->except(['_token', 'parent_id']) : $request->except(['_token']);

        $request_data['created_by'] = auth()->user()->id;
    
        $this->model->create($request_data);
        session()->flash('success', __('site.add_successfuly'));

        return $_REQUEST['parent_id']  == ''? redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index') : redirect()->route('dashboard.areas.show', ['area' => $_REQUEST['parent_id']]);

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
        $row = $this->model->findOrFail($id);

        return VIEW('dashboard.' . $module_name_plural . '.show', compact('module_name_singular', 'module_name_plural', 'row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $module_name_plural   = "areas";
        $module_name_singular = "area";

        $append = ['areas'=>Area::whereNUll('parent_id')->where('created_by', auth()->user()->id)->get()];

        $row = $this->model->findOrFail($id);
        return view('dashboard.areas.edit', compact('row', 'module_name_singular', 'module_name_plural'))->with($append);
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
        $area = $this->model->findOrFail($id);

        foreach (config('translatable.locales') as $locale) {
            $rules = [
                $locale . '.name'        => ['required', 'string', 'min:3', 'max:191', Rule::unique('area_translations', 'name')->ignore($area->id, 'area_id')->where(function ($query) {
                    $query->join('areas', function($j){ 
                        return $_REQUEST['parent_id']  != ''? $j->where('parent_id', $_REQUEST['parent_id']) : $j;
                    });
                }),],
            ];
        }
        $request->validate($rules);

        $request_data = $_REQUEST['parent_id']  != ''? $request->except(['_token', 'parent_id']) : $request->except(['_token']);

        $area->update($request_data);
        session()->flash('success', __('site.updated_successfuly'));

        return $_REQUEST['parent_id']  == ''? redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index') : redirect()->route('dashboard.areas.show', ['area' => $_REQUEST['parent_id']]);
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
        $area = $this->model->findOrFail($id);
        $area->delete();
        
        session()->flash('success', __('site.deleted_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }

    /**
     * Display the specified sub/areas resource.
     *
     */
    public function subAreas()
    {
        $query = $this->model->where('parent_id', request()->subArea);

        return Datatables::of($query)
            ->addColumn('name', function ($query) {
                return  $query->translation->name;
            })->editColumn('created_at', function ($query) {
                return $query->created_at->diffForHumans();
            })
            ->addColumn('action', function ($query) {
                $module_name_singular = 'area';
                $module_name_plural   = 'areas';
                $row = $query;
                return view('dashboard.buttons.edit', compact('module_name_singular', 'module_name_plural', 'row')) .  view('dashboard.buttons.delete', compact('module_name_singular', 'module_name_plural', 'row'));
            })

            ->filter(function ($query) {
                return $query
                    ->where('parent_id', request()->subArea)
                    ->where(function ($w) {
                        return $w->whereTranslationLike('name', "%" . request()->search['value'] . "%")
                            ->orwhere('id', 'like', "%" . request()->search['value'] . "%")
                            ->orwhere('created_at', 'like', "%" . request()->search['value'] . "%")
                            ->orwhere('updated_at', 'like', "%" . request()->search['value'] . "%");
                    });
            })
            ->rawColumns(['action', 'name']) // this is for show view and url 
            ->make(true);
    }
}
