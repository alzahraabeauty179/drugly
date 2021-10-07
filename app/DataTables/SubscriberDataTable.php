<?php

namespace App\DataTables;

use App\Models\Subscriber;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

use Illuminate\Database\Eloquent\Builder;

class SubscriberDataTable extends DataTable
{
    protected $model;
    /**
     * Constructor.
     */
    public function __construct(Subscriber $model)
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
            ->addColumn(__('site.subscriber'), function ($query) {
                return '<a href="'.route('dashboard.users.edit', ['user' => $query->subscriber_id]).'" ><i class="glyphicon glyphicon-edit"></i> '. $query->user->name .'</a>';
            })
        	->addColumn(__('site.subscription'), function ($query) {
                return '<a href="'.route('dashboard.subscriptions.edit', ['subscription' => $query->subscription_id]).'" ><i class="glyphicon glyphicon-edit"></i> '. $query->subscription->translation->name .'</a>';
            })
            ->addColumn(__('site.status'), function ($query) {
                return  __('site.' . $query->status);
            })
            ->editColumn(__('site.created_at'), function ($query) {
                return $query->created_at->diffForHumans();
            })
            ->addColumn(__('site.action'), function (Subscriber $row) {
                $module_name_singular = 'subscriber';
                $module_name_plural   = 'subscribers';
                return view('dashboard.buttons.show', compact('module_name_singular', 'module_name_plural', 'row'));
            })
        	->filter(function ($query) {
            	return $query
                    ->where(function ($w) {
                        return $w->whereHas('user', function (Builder $q) {
    												$q->where('name', 'like', '%'.request()->search['value'].'%');
												})
                            ->orwhereHas('subscription', function (Builder $r) {
                                                        $r->whereTranslationLike('name', '%'.request()->search['value'].'%');
                                                    })
                            ->orwhere('id', 'like', "%" . request()->search['value'] . "%")
                            ->orwhere('status', 'like', "%" . request()->search['value'] . "%")
                            ->orwhere('created_at', 'like', "%" . request()->search['value'] . "%")
                            ->orwhere('updated_at', 'like', "%" . request()->search['value'] . "%");
                    });
            })
                 
            ->rawColumns([__('site.action'), __('site.subscriber'), __('site.subscription')]);
    }

    /**
     * Get query source of dataTable.
     *
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
                    ->setTableId('subscriberdatatable-table')
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
            Column::computed(__('site.subscriber')),
        	Column::computed(__('site.subscription')),
            Column::computed(__('site.status')),
            Column::make(__('site.created_at')),
            Column::make('updated_at'),
            Column::computed(__('site.action'))
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
        return 'Subscriber_' . date('YmdHis');
    }
}
