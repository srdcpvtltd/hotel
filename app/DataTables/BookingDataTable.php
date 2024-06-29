<?php

namespace App\DataTables;

use App\Models\AdvanceBooking;
use App\Models\HotelProfile;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BookingDataTable extends DataTable
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
            ->editColumn('room_type_id', function (AdvanceBooking $booking) {
                return ($booking->room_type != null) ? $booking->room_type->room_type : '-';
            })
            ->addColumn('action', function (AdvanceBooking $booking) {
                return view('booking.action', compact('booking'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Advancebooking $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AdvanceBooking $model)
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        return $model->newQuery()->where('hotel_id', $hotel->id)->where('status', 0)->orderBy('id', 'ASC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('advance_bookings-table')
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
            Column::make('id')
                ->title('Sl No.')
                ->render('meta.row + meta.settings._iDisplayStart + 1;')
                ->orderable(false),
                Column::make('name')->title('Name'),
                Column::make('phone_number')->title('Phone Number'),
                Column::make('room_type_id')->title('Room Type'),
                Column::make('from_date')->title('From Date'),
                Column::make('to_date')->title('To Date'),
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
        return 'Booking_' . date('YmdHis');
    }
}
