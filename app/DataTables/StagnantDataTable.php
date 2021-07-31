<?php

namespace App\DataTables;

use App\Models\Stagnant;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StagnantDataTable extends DataTable
{

    protected $model;
    public function __construct(Stagnant $model)
    {
        $this->model = $model;
    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable()
    {
        $query = $this->query();
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('name',  function ($query) {
                return '<a href="'.route('dashboard.stagnants.show', ['stagnant' => $query->id]).'" >'. $query->name .'</a>';
            })
            ->addColumn('description', function ($query) {
                return  $query->description;
            })
            ->addColumn('amount', function ($query) {
                return  $query->amount;
            })
            ->addColumn('price',  function ($query) {
                return  $query->price;
            })
            ->addColumn('image', function ($query) {
                return '<image src="' . $query->image_path . '" width="40" height="40" />';
            })
            ->editColumn('created_at', function ($query) {
                return $query->created_at->diffForHumans();
            })
            ->addColumn('action', function ($query) {
                $module_name_singular = 'stagnant';
                $module_name_plural   = 'stagnants';
                $row                  = $query;
                return view('dashboard.buttons.edit', compact('module_name_singular', 'module_name_plural', 'row')) .  view('dashboard.buttons.delete', compact('module_name_singular', 'module_name_plural', 'row'));
                // return '<a  href="' . route("dashboard.categories.edit", ["category" => $l]) . '" class="btn btn-info">edit</>';
            })->addColumn('exchange', function ($query) {
                return '<a  href="' . route("dashboard.stagnants.create", ["stagnant" => $query->id]) . '" class="btn btn-success btn-sm"><i class="fa fa-exchange">'. __("site.exchange").' </i> </>';
            })
            // ->setRowClass('{{ $id % 2 == 0 ? "alert-success" : "alert-primary" }}')

            ->rawColumns(['action', 'image', 'exchange', 'name']); // this is for show view and url 

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Stagnant $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->model->whereNull('stagnant_id')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('stagnant-table')
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
            Column::make('name'),
            Column::make('description'),
            Column::make('amount'),
            Column::make('price'),
            Column::computed('image'),
            Column::make('created_at'),
            Column::computed('exchange'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
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
        return 'Stagnant_' . date('YmdHis');
    }
}
