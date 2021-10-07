<?php

namespace App\DataTables;

use App\Role;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RoleDataTable extends DataTable
{
    protected $model;
    public function __construct(Role $model)
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
            ->editColumn(__('site.created_at'), function ($query) {
                return $query->created_at->diffForHumans();
            }) ->editColumn(__('site.updated_at'), function ($query) {
                return date('d-M-Y', strtotime($query->updated_at));
            })
            ->addColumn('action', function ($query) {
                $module_name_singular = 'role';
                $module_name_plural   = 'roles';
                $row                  = $query;
                return view('dashboard.buttons.edit', compact('module_name_singular', 'module_name_plural', 'row')) .  view('dashboard.buttons.delete', compact('module_name_singular', 'module_name_plural', 'row'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('role-table')
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
            Column::make('display_name'),
            // Column::make('description'),
            Column::make(__('site.created_at')),
            Column::make(__('site.updated_at')),
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
        return 'Role_' . date('YmdHis');
    }
}
