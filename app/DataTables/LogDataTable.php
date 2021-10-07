<?php

namespace App\DataTables;

use App\Models\Log;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

use Illuminate\Database\Eloquent\Builder;

class LogDataTable extends DataTable
{
	protected $model;
	/**
     * Constructor.
     */
    public function __construct(Log $model)
    {
        $this->model = $model;
    }
    
	/**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
    	$query = $this->query();
    
        return datatables()
            ->eloquent($query)
            ->addColumn(__('site.module'), function ($query) {
                return is_null( $query->log_id )? __('site.' . $query->log_type)
                		: '<a href="'.route('dashboard.'. $query->log_type .'.show', [ strtok($query->message , "_") => $query->log_id ]).'" ><i class="glyphicon glyphicon-edit"></i> '. __('site.' . $query->log_type) .'</a>';
            })
            ->addColumn(__('site.hint'), function ($query) {
                return __('site.' . $query->message);
            })
            ->addColumn(__('site.action_by'), function ($query) {
                return '<a href="'.route('dashboard.users.show', ['user' => $query->action_by]).'" ><i class="glyphicon glyphicon-edit"></i> '. $query->actionBy->name .'</a>';
            })
            ->editColumn(__('site.created_at'), function ($query) {
                return $query->created_at->diffForHumans();
            })
            ->filter(function ($query) {
                return $query
                    ->where(function ($w) {
                        return $w->where('log_type', 'like', "%" . request()->search['value'] . "%")
                            ->orwhere('message', 'like', "%" . request()->search['value'] . "%")
                        	->orwherehas('actionBy', function (Builder $q) {
    												$q->where('name', 'like', '%'.request()->search['value'].'%');
                            })
                            ->orwhere('id', 'like', "%" . request()->search['value'] . "%")
                            ->orwhere('created_at', 'like', "%" . request()->search['value'] . "%")
                            ->orwhere('updated_at', 'like', "%" . request()->search['value'] . "%");
                    });
            })
            ->rawColumns([ __('site.module'), __('site.action_by') ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->model->orderBy('id', 'DESC')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('logdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::computed(__('site.module')),
            Column::computed(__('site.hint')),
            Column::make(__('site.action_by')),
            Column::make(__('site.created_at')),
            Column::make('updated_at')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Log_' . date('YmdHis');
    }
}
