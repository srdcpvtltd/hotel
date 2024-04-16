<?php

namespace App\DataTables;

use App\Models\PoliceStation;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PoliceStationsDataTable extends DataTable
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
            ->editColumn('city_id', function (PoliceStation $police_station) {
                return ($police_station->city != null) ? $police_station->city->name : '-';
            })
            ->addColumn('action', function (PoliceStation $police_station) {
                return view('police_stations.action', compact('police_station'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PoliceStationsDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PoliceStation $model)
    {
        return $model->newQuery()->orderBy('id', 'ASC');;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('policestationsdatatable-table')
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
            Column::make('city_id')->title('City'),
            Column::make('code')->title('Police Station'),
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
        return 'PoliceStations_' . date('YmdHis');
    }
}
