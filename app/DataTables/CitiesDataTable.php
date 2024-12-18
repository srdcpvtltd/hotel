<?php

namespace App\DataTables;

use App\Models\City;
use App\Models\Country;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CitiesDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('district_id', function (City $city) {
                return ($city->district != null) ? $city->district->name : '-';
            })
            ->addColumn('action', function (City $city) {
                return view('cities.action', compact('city'));
            });
    }


    public function query(City $model)
    {
        //$query=$model->with('country');
        return $model->newQuery()->orderBy('id', 'ASC');
    }


    public function html()
    {
        return $this->builder()
            ->setTableId('districts-table')
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


    protected function getColumns()
    {
        return [
            Column::make('id')
                ->title('Sl No.')
                ->render('meta.row + meta.settings._iDisplayStart + 1;')
                ->orderable(false),
            Column::make('district_id')->title('District'),
            Column::make('name')->title('City'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }



    protected function filename()
    {
        return 'Cities_' . date('YmdHis');
    }
}
