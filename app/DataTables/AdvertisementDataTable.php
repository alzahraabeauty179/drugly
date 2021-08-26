<?php

namespace App\DataTables;

use App\Models\Advertisement;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

use Illuminate\Database\Eloquent\Builder;

class AdvertisementDataTable extends DataTable
{

    protected $model;
	/**
     * Constructor.
     */
    public function __construct(Advertisement $model)
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
            ->addColumn('title', function ($query) {
                return $query->translation->title;
            })
            ->addColumn('image', function ($query) {
                return '<image src="'.$query->image_path.'" width="40" height="40" style="cursor: url(`'.$query->image_path.'`), auto;"/>';
            })
        	->addColumn('owner', function ($query) {
                return is_null($query->owner_id)? ''
                		:'<a href="'.route('dashboard.users.show', ['user' => $query->owner_id]).'" ><i class="glyphicon glyphicon-edit"></i> '. $query->owner->name .'</a>';
            })
            ->editColumn('created_at', function ($query) {
                return $query->created_at->diffForHumans();
            })
            ->addColumn('action', function (Advertisement $row) {
                $module_name_singular = 'advertisement';
                $module_name_plural   = 'advertisements';
                return view('dashboard.buttons.edit', compact('module_name_singular', 'module_name_plural', 'row')) .  view('dashboard.buttons.delete', compact('module_name_singular', 'module_name_plural', 'row'));
            })
            ->filter(function ($query) {
                return $query
                    ->where(function ($w) {
                        return $w->whereTranslationLike('title', "%" . request()->search['value'] . "%")
                            ->whereHas('owner', function (Builder $q) {
    							$q->where('name', 'like', '%'.request()->search['value'].'%');
							})
                            ->orwhere('id', 'like', "%" . request()->search['value'] . "%")
                            ->orwhere('created_at', 'like', "%" . request()->search['value'] . "%")
                            ->orwhere('updated_at', 'like', "%" . request()->search['value'] . "%");
                    });
            })
            ->rawColumns(['action', 'title', 'image', 'owner']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Advertisement $model
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
                    ->setTableId('advertisementdatatable-table')
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
            Column::computed('title'),
            Column::make('image'),
        	Column::make('owner'),
            Column::make('created_at'),
            Column::make('updated_at'),
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
        return 'Advertisement_' . date('YmdHis');
    }
}
