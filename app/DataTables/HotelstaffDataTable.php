<?php

namespace App\DataTables;

use App\Models\Hotel_staff;
use App\Models\HotelProfile;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class HotelstaffDataTable extends DataTable
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
            ->editColumn('designation_id', function (Hotel_staff $hotel_staff) {
                return ($hotel_staff->designation!=null)?$hotel_staff->designation->designation:'-';
            })
            ->addColumn('action', function (Hotel_staff $hotel_staff) {
                return view('hotel_staff.action', compact('hotel_staff'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\HotelstaffDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Hotel_staff $model)
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
            ->setTableId('hotel_staffs-table')
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
            Column::make('hotel_id')->title('Hotel'),
            Column::make('name')->title('Name'),
            Column::make('contact_no')->title('Contact No'),
            Column::make('designation_id')->title('Designation'),
            Column::make('shift')->title('Shift'),
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
        return 'Hotelstaff_' . date('YmdHis');
    }
}
