<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Work;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkController extends BackEndController
{
    public function __construct(Work $model)
    {
        parent::__construct($model);
    }

    public function index(Request $request)
    {
        //get all data of Model
        $rows = $this->model;
        $rows = $this->filter($rows);
        // ------------------------------------------  this id old way with database elquant and scope not sign on it 
        // $rows = DB::select('select user_id, users.name AS name ,  sum(calls) AS calls, sum(whats) AS whats, sum(meeting) AS meeting, sum(care) AS care, sum(nocare) AS nocare from works JOIN users ON works.user_id = users.id GROUP BY 1, 2',);

        $rows = Work::selectRaw(' user_id, users.name AS name ,
                                          sum(calls) AS calls, sum(whats) AS whats,
                                         sum(meeting) AS meeting, sum(care) AS care, 
                                         sum(nocare) AS nocare
                                          ')
            ->join('users', 'users.id', '=', 'user_id')
            ->groupBy(['works.user_id', 'users.name'])
            ->get();

        $module_name_plural = $this->getClassNameFromModel();
        $module_name_singular = $this->getSingularModelName();
        // return $module_name_plural;
        return view('dashboard.' . $module_name_plural . '.index', compact('rows', 'module_name_singular', 'module_name_plural'));
    } //end of index

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'calls'       => 'required|numeric|min:0|max:100',
            'whats'       => 'required|numeric|min:0|max:100',
            'meeting'     => 'required|numeric|min:0|max:100',
            'care'        => 'required|numeric|min:0|max:100',
            'nocare'      => 'required|numeric|min:0|max:100',
            'description' => 'nullable|string|max:200',
            'user_id'     => 'required|numeric|exists:users,id',
        ]);

        $this->model->create($request->all());

        session()->flash('success', __('site.add_successfuly'));
        return redirect()->route('dashboard.' . $this->getClassNameFromModel() . '.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        // return $request->search;
        $rows = $this->model;
        $rows = $this->filter($rows);
        if ($request->search) {
            $from = date('Y-m-d 0:0:0', strtotime($request->search));
            $to   = date('Y-m-d 23:59:00', strtotime($request->search));
        } else {
            $from = date('Y-m-d 0:0:0', time());
            $to   = date('Y-m-d 23:59:00', time());
        }

        $rows = $rows->where('user_id', $id)->when($request->search, function ($query) use ($request, $from, $to) {
            return $query->whereBetween('created_at', [$from, $to]);
        })->orderBy('created_at', 'Desc')->paginate(10);
        // return $rows;
        $module_name_plural = $this->getClassNameFromModel();
        $module_name_singular = $this->getSingularModelName();
        // return $module_name_plural;
        return view('dashboard.' . $module_name_plural . '.show', compact('rows', 'module_name_singular', 'module_name_plural'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        //
    }

    public function charlist(Request $request)
    {
        // if ($request->search) {
        //     $from = date('Y-m-d 0:0:0', strtotime($request->search));
        //     $to   = date('Y-m-d 23:59:00', strtotime($request->search));
        // } else {
        //     $from = date('Y-m-d 0:0:0', time());
        //     $to   = date('Y-m-d 23:59:00', time());
        // }

        $userData = User::active()->with('latestWork')->get();
        return $userData->toarray();
    }
}
