<?php

namespace App\DataTables;

use App\Models\Subscription;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SubscriptionDataTable extends DataTable
{
    protected $model;
    /**
     * Constructor.
     */
    public function __construct(Subscription $model)
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
            ->addColumn(__('site.name'), function ($query) {
                return $query->translation->name;
            })
        
        	->addColumn(__('site.type'), function ($query) {
                return __('site.' . $query->type);
            })

            ->editColumn(__('site.created_at'), function ($query) {
                return $query->created_at->diffForHumans();
            })
            ->addColumn(__('site.action'), function (Subscription $row) {
                $module_name_singular = 'subscription';
                $module_name_plural   = 'subscriptions';
                return view('dashboard.buttons.edit', compact('module_name_singular', 'module_name_plural', 'row')) .  view('dashboard.buttons.delete', compact('module_name_singular', 'module_name_plural', 'row'));
            })

            ->filter(function ($query) {
                return $query
                    ->where(function ($w) {
                        return $w->whereTranslationLike('name', "%" . request()->search['value'] . "%")
                            ->orwhere('id', 'like', "%" . request()->search['value'] . "%")
                        	->orwhere('type', 'like', "%" . request()->search['value'] . "%")
                            ->orwhere('created_at', 'like', "%" . request()->search['value'] . "%")
                            ->orwhere('updated_at', 'like', "%" . request()->search['value'] . "%");
                    });
            })
            ->rawColumns([__('site.action')]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SubscriptionDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->model->where('created_by', auth()->user()->id)->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('subscriptiondatatable-table')
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
            Column::computed(__('site.name')),
        	Column::computed(__('site.type')),
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
        return 'Subscription_' . date('YmdHis');
    }
}
