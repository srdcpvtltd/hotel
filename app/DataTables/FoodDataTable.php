<?php

namespace App\DataTables;

use App\Models\Food;
use App\Models\HotelProfile;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FoodDataTable extends DataTable
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
            ->editColumn('category_id', function (Food $food){
                return($food->category != null) ? $food->category->name : '-';
            })
            ->addColumn('action', function (Food $food) {
                return view('food.food.action', compact('food'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Food $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Food $model)
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
                    ->setTableId('food-table')
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
            Column::make('category_id')->title('Category'),
            Column::make('name')->title('name'),
            Column::make('price')->title('price'),
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
        return 'Food_' . date('YmdHis');
    }
}
