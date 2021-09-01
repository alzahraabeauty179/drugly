<?php

namespace App\DataTables;

use App\Models\Order;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

use Illuminate\Database\Eloquent\Builder;

class OrderDataTable extends DataTable
{
    protected $model;
    /**
     * Constructor.
     */
    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    /**
     * Build DataTable class. this will used by super admin
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
                return '<a href="'.route('dashboard.stores.show', [ 'store' => $query->to_id ]).'" ><i class="glyphicon glyphicon-edit"></i> '.$query->to->name.'</a>';
            })->addColumn('pharmacy', function ($query) {
                return '<a href="'.route('dashboard.stores.show', [ 'store' => $query->from_id ]).'" ><i class="glyphicon glyphicon-edit"></i> '.$query->to->name.'</a>';

            })->addColumn('status', function ($query) {
                return $query->status;
            })->editColumn('created_at', function ($query) {
                return $query->created_at->diffForHumans();
            })->addColumn('action', function ($query) {
                $module_name_singular = 'order';
                $module_name_plural   = 'orders';
                $row = $query;
                return view('dashboard.buttons.show', compact('module_name_singular', 'module_name_plural', 'row'));
            })->filter(function ($query) {
                return $query
                    ->where('status', request()->status)
                    ->where(function ($w) {
                        return $w->whereHas('to', function (Builder $q) {
                                $q->whereTranslationLike('name', "%" . request()->search['value'] . "%");
                            })->orwhereHas('from', function (Builder $q) {
                                $q->where('name', 'like', '%'.request()->search['value'].'%');
                            })
                            ->orwhere('status', 'like', "%" . request()->search['value'] . "%")
                            ->orwhere('id', 'like', "%" . request()->search['value'] . "%")
                            ->orwhere('created_at', 'like', "%" . request()->search['value'] . "%")
                            ->orwhere('updated_at', 'like', "%" . request()->search['value'] . "%");
                    });
            })
            ->rawColumns(['action', 'store', 'pharmacy']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\OrderDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->model->where('status', request()->status)->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('orderdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
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
            Column::computed('store'),
            Column::computed('pharmacy'),
            Column::make('status'),
            Column::make('created_at'),
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
        return 'Order_' . date('YmdHis');
    }
}
