<?php

namespace App\DataTables;

use App\Models\Category;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
    protected $model;
    public function __construct(Category $model)
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
            ->addColumn('name', function ($query) {
                return '<a href="'.route('dashboard.categories.show', ['category' => $query->id]).'" ><i class="glyphicon glyphicon-edit"></i> '. $query->translation->name .'</a>';
            })
            // ->addColumn('description', function ($query) {
            //     return $query->translation->description;
            // })
            ->addColumn('logo', function ($query) {
                return '<image src="'.$query->image_path.'" width="40" height="40" style="cursor: url(`'.$query->image_path.'`), auto;" />';
            })

            ->editColumn('created_at', function ($query) {
                return $query->created_at->diffForHumans();
            })
            ->addColumn('action', function (Category $row) {
                $module_name_singular = 'category';
                $module_name_plural   = 'categories';
                return view('dashboard.buttons.edit', compact('module_name_singular', 'module_name_plural', 'row')) .  view('dashboard.buttons.delete', compact('module_name_singular', 'module_name_plural', 'row'));
                // return '<a  href="' . route("dashboard.categories.edit", ["category" => $l]) . '" class="btn btn-info">edit</>';
            })

            // ->setRowClass('{{ $id % 2 == 0 ? "alert-success" : "alert-primary" }}')
            ->filter(function ($query) {
                return $query
                    ->whereNUll('parent_id')
                    ->where(function ($w) {
                        return $w->whereTranslationLike('name', "%" . request()->search['value'] . "%")
                            // ->orwhereTranslationLike('description', "%" . request()->search['value'] . "%")
                            ->orwhere('id', 'like', "%" . request()->search['value'] . "%")
                            ->orwhere('created_at', 'like', "%" . request()->search['value'] . "%")
                            ->orwhere('updated_at', 'like', "%" . request()->search['value'] . "%");
                    });
            })
            ->rawColumns(['action', 'name', 'logo']); // this is for show view and url 

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->model->whereNUll('parent_id')->where('created_by', auth()->user()->id)->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('category-table')
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
            Column::computed('name'),
            // Column::computed('description'),
            Column::make('logo'),
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
        return 'Category_' . date('YmdHis');
    }
}
