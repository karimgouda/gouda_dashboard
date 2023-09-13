<?php

namespace App\DataTables;

use App\Models\Slider;
use App\Models\Translation;
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

class TranslationDataTable extends DataTable
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
            ->addColumn('lang_value', function ($query) {
                return view('backend.translations._action', compact('query'));
            });


        return $table->rawColumns(['lang_value'])->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Slider $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Translation $model): QueryBuilder
    {
        return $model->newQuery()->where('lang',$this->lang);
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
            ['name' => 'lang_key',              'data' => 'lang_key',  'title'=> translate('lang_key')],
            ['name' => 'lang_value',            'data' => 'lang_value',  'title'=> translate('lang_value')],

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
