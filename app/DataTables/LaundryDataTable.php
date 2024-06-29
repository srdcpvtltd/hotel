<?php

namespace App\DataTables;

use App\Models\HotelProfile;
use App\Models\Laundry;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LaundryDataTable extends DataTable
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
            ->editColumn('room_id', function (Laundry $laundry) {
                return ($laundry->room != null) ? $laundry->room->name : '-';
            })
            ->editColumn('assign_staff_id', function (Laundry $laundry) {
                return ($laundry->staff != null) ? $laundry->staff->name : '-';
            })
            ->editColumn('status', function (Laundry $laundry) {
                return ($laundry->status === 0) ? '<span class="badge badge-warning" style="font-size: 14px;color:#fff
                ">In Process</span>' : '<span class="badge badge-success" style="font-size: 14px;
                ">Complete</span>';
            })
            ->rawColumns(['status'])
            ->addColumn('action', function (Laundry $laundry) {
                return view('laundry.action', compact('laundry'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Laundry $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Laundry $model)
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        return $model->newQuery()->where('hotel_id', $hotel->id)->orderBy('id', 'DESC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('laundry-table')
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
            Column::make('room_id')->title('Room'),
            Column::make('assign_staff_id')->title('Assigned Staff'),
            Column::make('item')->title('Item'),
            Column::make('quantity')->title('Quantity'),
            Column::make('status')->title('Status'),
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
        return 'Laundry_' . date('YmdHis');
    }
}
