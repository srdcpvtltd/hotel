<?php

namespace App\DataTables;

use App\Models\HotelProfile;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
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
            ->editColumn('room_id', function(Order $order){
                return($order->room != null) ? $order->room->name : '-';
            })
            ->editColumn('food_category_id', function(Order $order){
                return($order->category != null) ? $order->category->name : '-';
            })
            ->editColumn('food_id', function(Order $order){
                return($order->food != null) ? $order->food->name : '-';
            })
            ->editColumn('status', function(Order $order){
                return ($order->status === 0) ? '<span class="badge badge-warning" style="font-size: 14px;
    ">Inprogress</span>' : '<span class="badge badge-success" style="font-size: 14px;
    ">Completed</span>';
            })
            ->rawColumns(['status'])
            ->addColumn('action', function (Order $order) {
                return view('Order.action', compact('order'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\OrderDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
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
                    ->setTableId('order-table')
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
            Column::make('food_category_id')->title('Category'),
            Column::make('food_id')->title('Food'),
            Column::make('price')->title('Price'),
            Column::make('quantity')->title('Quantity'),
            Column::make('total_price')->title('Total Amount'),
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
        return 'Order_' . date('YmdHis');
    }
}
