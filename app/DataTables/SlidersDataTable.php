<?php

namespace App\DataTables;

use App\Models\Slider;
use App\Services\TranslatableService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SlidersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $table =   (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $id = $query->id;
                return view('backend.sliders._action', compact('id'));
            })
            ->editColumn('record_no', function ($query) {
                return '<div class="form-check form-check-primary d-block new-control">
                <input class="form-check-input child-chk" name="ids[]"value="'.$query->id.'" type="checkbox" id="form-check-default">
            </div>';
            })
            ->editColumn('link', function ($query) {
                return '<a target="_blank" href="' . $query->link . '">' . $query->link . '</a>';
            })
            ->editColumn('image', function ($query) {
                return '<a class="profile-img" href="javascript: void(0);">
                                <img src="' . asset($query->image) . '" alt="' . $query->title . '">
                        </a>';
            })
            ->editColumn('created_at', function ($query) {
                return $query->created_at->format('Y-m-d');
            });

        TranslatableService::addTranslatableColumnsToDataTable(new Slider(), $table);

        return $table->rawColumns(['action', 'image', 'link', 'record_no'])->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Slider $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Slider $model): QueryBuilder
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
            ->setTableId('sliders-table')
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
            ['name' => 'record_no',          'data' => 'record_no', 'title' => $this->chk_parent(),'width' => 20, 'class' => 'checkbox-column dt-no-sorting sorting_asc', 'orderable' => false, 'searchable' => false],
            ['name' => 'title',              'data' => 'title',  'title'=> translate('title')],
            ['name' => 'image',              'data' => 'image',  'title'=> translate('image')],
            ['name' => 'link',               'data' => 'link',  'title'=> translate('link')],
            ['name' => 'created_at',         'data' => 'created_at', 'title'=> translate('created_at')],
            ['name' => 'action',             'data' => 'action', 'title'=> translate('action') , 'width' => 150, 'exportable' => false, 'printable' => false, 'orderable' => false, 'searchable' => false],

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
        return 'Sliders_' . date('YmdHis');
    }
}
