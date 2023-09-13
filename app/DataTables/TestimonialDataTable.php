<?php

namespace App\DataTables;

use App\Models\Blog;
use App\Models\Testimonial;
use App\Services\TranslatableService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TestimonialDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $table = (new EloquentDataTable($query))
            ->addColumn('actions', function ($query) {
                $id = $query->id;
                return view('backend.testimonial._actions', compact('id'));
            }) ->editColumn('image', function ($query) {
                return '<a class="profile-img" href="javascript: void(0);">
                                <img src="' . asset($query->image) . '" alt="' . $query->title . '">
                        </a>';
            })
            ->editColumn('created_at', function ($query) {
                return $query->created_at->format('Y-m-d');
            });
        TranslatableService::addTranslatableColumnsToDataTable(new Testimonial(), $table);

        return $table->rawColumns(['actions', 'image','rate'])->addIndexColumn();
    }


    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Testimonial $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Testimonial $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('testimonial-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            ['name' => 'name', 'data' => 'name',  'title'=> translate('Name')],
            ['name' => 'description', 'data' => 'description',  'title'=> translate('Description')],
            ['name' => 'job', 'data' => 'job',  'title'=> translate('job')],
            ['name' => 'image', 'data' => 'image',  'title'=> translate('image')],
            ['name' => 'rate', 'data' => 'rate',  'title'=> translate('Rate')],
            ['name' => 'created_at',         'data' => 'created_at', 'title'=> translate('created_at')],
            ['name' => 'actions','data' => 'actions', 'title'=> translate('actions') , 'width' => 150, 'exportable' => false, 'printable' => false, 'orderable' => false, 'searchable' => false],
        ];
    }

    protected function chk_parent()
    {
        return '<div class="form-check form-check-primary d-block new-control">
                    <input class="form-check-input chk-parent" type="checkbox" id="form-check-default">
                </div>';
    }
    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Testimonial_' . date('YmdHis');
    }
}
