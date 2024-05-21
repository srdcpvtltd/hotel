<?php

namespace App\DataTables;

use App\Models\HotelProfile;
use App\Models\PriceRule;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class PriceRuleDataTable extends DataTable
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
            ->editColumn('room_type_id', function (PriceRule $pricerule) {
                return ($pricerule->room_type != null) ? $pricerule->room_type->room_type : '-';
            })
            ->addColumn('action', function (PriceRule $pricerule) {
                return view('system_management.price_rule.action', compact('pricerule'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PriceRule $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PriceRule $model)
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        return $model->newQuery()->where('hotel_id', $hotel->id)->orderBy('id', 'ASC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('pricerule-table')
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
            Column::make('room_type_id')->title('Room Type'),
            Column::make('check_in')->title('Check In Time'),
            Column::make('check_out')->title('Check Out Time'),
            Column::make('price')->title('Price'),
            Column::make('overtime_charge')->title('Overtime Surcharge'),
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
        return 'PriceRule_' . date('YmdHis');
    }
}
