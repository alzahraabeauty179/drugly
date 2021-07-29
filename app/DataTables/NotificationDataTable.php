<?php

namespace App\DataTables;

use App\Models\Notification;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class NotificationDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
        ->eloquent($query)
        ->addColumn('type', function (Notification $n) {
            return \Illuminate\Support\Str::snake( class_basename($n->type, ' ') );
        })
        ->editColumn('created_at', function (Notification $d) {
            return $d->created_at->diffForHumans();
        })
        ->addColumn('action', function (Notification $row) {
            $module_name_singular = 'notification';
            $module_name_plural   = 'notifications';

            return view('dashboard.buttons.edit', compact('module_name_singular', 'module_name_plural', 'row')) .  view('dashboard.buttons.delete', compact('module_name_singular', 'module_name_plural', 'row'));
        })

        // ->setRowClass('{{ $id % 2 == 0 ? "alert-success" : "alert-primary" }}')
        ->filter(function ($query) {
            return $query
                ->where('type', "%" . request()->search['value'] . "%")
                // ->orwhereTranslationLike('description', "%" . request()->search['value'] . "%")
                ->orwhere('id', 'like', "%" . request()->search['value'] . "%")
                ->orwhere('created_at', 'like', "%" . request()->search['value'] . "%")
                ->orwhere('updated_at', 'like', "%" . request()->search['value'] . "%");
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\NotificationDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Notification $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('notificationdatatable-table')
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
            Column::make('type'),
            // Column::make('description'),
            // Column::make('logo'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                // ->width(60)
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
        return 'Notification_' . date('YmdHis');
    }
}
