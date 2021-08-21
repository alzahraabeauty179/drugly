<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\LogDataTable;
use App\Models\Log;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DataTables;

class LogController extends BackEndDatatableController
{
	/**
     * Constructor.
     */
	public function __construct(Log $model, LogDataTable $logDataTable)
    {
        parent::__construct($model, $logDataTable);
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
}
