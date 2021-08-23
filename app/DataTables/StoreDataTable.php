<?php

namespace App\DataTables;

use App\Models\Store;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StoreDataTable extends DataTable
{
    protected $model;
	/**
     * Constructor.
     */
    public function __construct(Store $model)
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
            ->addColumn('store', function ($query) {
                return '<a href="'.route('dashboard.stores.show', [ 'store' => $query->id ]).'" ><i class="glyphicon glyphicon-edit"></i> '. __('site.' . $query->translation->name) .'</a>';
            })
            ->addColumn('email', function ($query) {
                return $query->email;
            })
            ->addColumn('action', function (Store $row) {
                $module_name_singular = 'store';
                $module_name_plural   = 'stores';
                return view('dashboard.buttons.show', compact('module_name_singular', 'module_name_plural', 'row'));
            })
            ->filter(function ($query) {
                return $query
                    ->where(function ($w) {
                        return $w->whereTranslationLike('name', "%" . request()->search['value'] . "%")
                            ->orwhere('email', 'like', "%" . request()->search['value'] . "%")
                            ->orwhere('id', 'like', "%" . request()->search['value'] . "%")
                            ->orwhere('created_at', 'like', "%" . request()->search['value'] . "%")
                            ->orwhere('updated_at', 'like', "%" . request()->search['value'] . "%");
                    });
            })
            ->rawColumns(['store', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\StoreDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return isset($_REQUEST['medical_store'])? $this->model->where('type', 'medical_store')->newQuery() : $this->model->where('type', 'beauty_company')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('storedatatable-table')
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
            Column::computed('name'),
            Column::computed('email'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Store_' . date('YmdHis');
    }
}