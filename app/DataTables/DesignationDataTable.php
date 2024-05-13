<?php

namespace App\DataTables;

use App\Models\Designation;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class DesignationDataTable extends DataTable
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
            ->addColumn('action', function (Designation $designation) {
                return view('designation.action', compact('designation'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\DesignationDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Designation $model)
    {
        return $model->newQuery()->orderBy('id', 'ASC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('designations-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create')->className('btn-primary '),
                Button::make('pageLength')->className('btn-light ')

            )->language([
                'buttons' => [
                    'create' => __('Create'),
                    'pageLength' => __('Show %d rows'),
                ]
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('row_number')
                ->title('Sl No.')
                ->render('meta.row + meta.settings._iDisplayStart + 1;')
                ->orderable(false),
                Column::make('hotel_id')->title('hotel'),
                Column::make('designation')->title('designation'),
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
        return 'Designation_' . date('YmdHis');
    }
}
