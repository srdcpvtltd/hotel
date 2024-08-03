@extends('layouts.admin')
@section('breadcrumb')
    <span class="breadcrumb-item active">{{ __('Guest Detail') }}</span>
@endsection
@section('title')
    {{ __('Guest Details') }}
@endsection
@section('content')
    <style>
        .pd_0 {
            padding: 0;
        }
    </style>
    <div class="">
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        <div class="fade-in guest-register">
            <div class="col-sm">
                <div class="card">
                    <div class="card-header">Guest Detail</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-center" style="margin-bottom: 15px;">
                                <img src="{{ asset(url('storage/bookings/' . $booking->guest_image)) }}" />
                            </div>
                            <div class="col-md-4 detil-item">
                                <b>Guest Name:</b> {{ $booking->gues_name }}
                            </div>
                            <div class="col-md-4 detil-item">
                                <b>Mobile Number:</b> {{ $booking->mobile_number }}
                            </div>

                            <div class="col-md-4 detil-item">
                                <b>Guest Email:</b> {{ $booking->email_id }}
                            </div>
                            <div class="col-md-4 detil-item">
                                <b>Arrived From:</b> {{ $booking->arrived_from }}
                            </div>
                            <div class="col-md-4 detil-item">
                                <b>Arrival Date:</b> {{ $booking->arrival_date }}
                            </div>
                            <div class="col-md-4 detil-item">
                                <b>Arrival Time:</b> {{ $booking->arrival_time }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @if (!empty($criminal))
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">Criminal Detail</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-center" style="margin-bottom: 15px;">
                                    <img src="{{ asset(url('storage/criminals/' . $criminal->photo)) }}" />
                                </div>
                                <div class="col-md-4 detil-item">
                                    <b>Name:</b> {{ $criminal->name }}
                                </div>
                                <div class="col-md-4 detil-item">
                                    <b>Mobile Number:</b> {{ $criminal->mobile }}
                                </div>
                                <div class="col-md-4 detil-item">
                                    <b>Age:</b> {{ $criminal->age }}
                                </div>
                                <div class="col-md-4 detil-item">
                                    <b>Gender:</b> {{ $criminal->gender }}
                                </div>
                                <div class="col-md-4 detil-item">
                                    <b>Remarks:</b> {{ $criminal->remarks }}
                                </div>
                                <div class="col-md-4 detil-item">
                                    <a class="btn btn-danger btn-xs"
                                        href="{{ asset(url('/mark/unsuspicious/' . $booking->id)) }}">Mark as Not
                                        Suspicious</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-sm">
                <div class="card">
                    <div class="card-header">Payment Information</div>
                    <div class="card-body">
                        <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="2%">S.No.</th>
                                        <th class="text-center" width="20%">Room</th>
                                        <th class="text-center" width="5%">Duration of Stay</th>
                                        <th class="text-center" width="5%">Base Price</th>
                                        <th class="text-center" width="10%">Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($booking->rooms as $key => $room)
                                        <tr class="per_room_tr">
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>
                                                {{ $room->room_type->room_type }}<br>
                                                (Room No. : {{ $room->room_number }})
                                            </td>
                                            <th class="text-center">
                                                @php
                                                    if ($advance_booking != null) {
                                                        $checkout_date = $advance_booking->to_date;
                                                    } elseif ($room->status == 1) {
                                                        $checkout_date = $room->checkout_date;
                                                    } else {
                                                        $checkout_date = date('Y-m-d');
                                                    }
                                                    $datetime1 = strtotime($booking->arrival_date);
                                                    $datetime2 = strtotime($checkout_date);
                                                    $days = (int) (($datetime2 - $datetime1) / 86400);
                                                    $subtotal = 0;
                                                @endphp
                                                <span class="">{{ $days }}</span>
                                            </th>
                                            <td class="text-center">
                                                <span class="error base_price_err_msg"></span>
                                                <button type="button" class="btn btn-xs btn-info" data-toggle="modal"
                                                    data-target="#room_price_model_{{ $room->id }}">Price
                                                    Break</button>
                                                <div id="room_price_model_{{ $room->id }}" class="modal fade"
                                                    role="dialog" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Date wise Price</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <table class="table table-striped table-bordered">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th width="20%" class="text-center">
                                                                                        Date
                                                                                    </th>
                                                                                    <th width="20%" class="text-center">
                                                                                        Price
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="">
                                                                                @php
                                                                                    $room_price = App\Models\Room::where(
                                                                                        'hotel_id',
                                                                                        $booking->hotel_id,
                                                                                    )
                                                                                        ->where(
                                                                                            'name',
                                                                                            $room->room_number,
                                                                                        )
                                                                                        ->first('price');
                                                                                    $p = $room_price->price;
                                                                                    $price = $p * $days;
                                                                                    $tot[] = $price;
                                                                                @endphp
                                                                                @for ($i = 0; $i < $days; $i++)
                                                                                    @php
                                                                                        $anchor = Carbon\Carbon::create(
                                                                                            $booking->arrival_date,
                                                                                        )->addDay($i);
                                                                                        $date[] = date(
                                                                                            'Y-m-d',
                                                                                            strtotime($anchor),
                                                                                        );

                                                                                    @endphp
                                                                                    <tr>
                                                                                        <td class="text-center">
                                                                                            {{ $date[$i] }}
                                                                                        </td>
                                                                                        @if ($advance_booking != null)
                                                                                            <td>₹
                                                                                                {{ $room_price->price }}.00
                                                                                            </td>
                                                                                        @else
                                                                                            @if ($date[$i] != date('Y-m-d'))
                                                                                                <td class="text-right">₹
                                                                                                    {{ $room_price->price }}.00
                                                                                                </td>
                                                                                            @else
                                                                                                <td class="text-right">₹
                                                                                                    0.00
                                                                                                </td>
                                                                                            @endif
                                                                                        @endif
                                                                                    </tr>
                                                                                @endfor
                                                                                <tr>
                                                                                    <td></td>
                                                                                    <td class="text-right"><b>₹
                                                                                            {{ $price }}.00</b>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-right td_total_per_room_amount">₹ {{ $price }}.00</td>
                                        </tr>
                                    @endforeach
                                    @php
                                        if ($tot != null) {
                                            $count = count($tot);
                                            for ($i = 0; $i < $count; $i++) {
                                                $subtotal += $tot[$i];
                                            }
                                        }
                                    @endphp
                                </tbody>
                            </table>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th class="text-right">Subtotal <input id="total_room_amount"
                                                name="amount[total_room_amount]" type="hidden"
                                                value="{{ $subtotal }}.00"></th>
                                        <td width="20%" class="text-right td_total_room_amount">₹ {{ $subtotal }}.00
                                        </td>
                                    </tr>
                                    @php
                                        $sgst = ($subtotal * 9) / 100;
                                        $cgst = ($subtotal * 9) / 100;
                                        $total_amount = $subtotal + ($cgst + $sgst);
                                    @endphp
                                    <tr>
                                        <th class="text-right">SGST (9%) <input id="total_room_amount_gst"
                                                name="amount[total_room_amount_gst]" type="hidden"
                                                value="{{ $sgst }}"></th>
                                        <td width="20%" id="td_total_room_amount_gst" class="text-right">₹
                                            {{ $sgst }}.00
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <th class="text-right">CGST (9%) <input id="total_room_amount_cgst"
                                                name="amount[total_room_amount_cgst]" type="hidden"
                                                value="{{ $cgst }}"></th>
                                        <td width="20%" id="td_total_room_amount_cgst" class="text-right">₹
                                            {{ $cgst }}.00
                                        </td>
                                    </tr>
                                    <tr class="bg-warning">
                                        <th class="text-right">Total Amount</th>
                                        <td width="20%" id="td_room_final_amount" class="text-right">₹
                                            {{ $total_amount }}.00</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="x_title">
                                <h2>Food Orders</h2>
                                <div class="clearfix"></div>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="2%">S.No.</th>
                                        <th width="20%">Item Details</th>
                                        <th width="5%">Date</th>
                                        <th width="5%">Item Qty</th>
                                        <th width="5%">Item subtotal</th>
                                        <th width="10%">Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $tot_price = 0;
                                    @endphp
                                    @if (count($orders) > 0)
                                        @foreach ($orders as $key => $order)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    {{ $order->food->name }} <br>
                                                    (Room No.: {{ $order->room->name }})
                                                </td>
                                                <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                                                <td class="text-center">{{ $order->quantity }}</td>
                                                <td class="text-right">₹ {{ $order->price }}.00</td>
                                                <td class="text-right">₹ {{ $order->total_price }}.00</td>
                                            </tr>
                                            @php
                                                $tot_price += $order->total_price;
                                            @endphp
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6">No Orders</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th class="text-right">Subtotal <input id="total_order_amount"
                                                name="amount[order_amount]" type="hidden" value="{{ $tot_price }}">
                                        </th>
                                        <td width="15%" id="td_total_order_amount" class="text-right">₹
                                            {{ $tot_price }}</td>
                                    </tr>
                                    @php
                                        $sgst1 = ($tot_price * 9) / 100;
                                        $cgst1 = ($tot_price * 9) / 100;
                                        $total_amount1 = $tot_price + ($cgst1 + $sgst1);
                                        $grand_total = $total_amount1 + $total_amount;
                                    @endphp
                                    <tr>
                                        <th class="text-right">SGST (9%) <input id="total_order_amount_gst"
                                                name="amount[order_amount_gst]" type="hidden"
                                                value="{{ $sgst1 }}"></th>
                                        <td width="15%" id="td_order_amount_gst" class="text-right">₹
                                            {{ $sgst1 }}</td>
                                    </tr>
                                    <tr class="">
                                        <th class="text-right">CGST (9%) <input id="total_order_amount_cgst"
                                                name="amount[order_amount_cgst]" type="hidden"
                                                value="{{ $cgst1 }}"></th>
                                        <td width="15%" id="td_order_amount_cgst" class="text-right">₹
                                            {{ $cgst1 }}</td>
                                    </tr>
                                    <tr class="bg-warning">
                                        <th class="text-right">Total Amount <input id="total_order_final_amount"
                                                name="amount[order_final_amount]" type="hidden"
                                                value="{{ $total_amount1 }}"></th>
                                        <td width="15%" id="td_order_final_amount" class="text-right">₹
                                            {{ $total_amount1 }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="bg-success">
                                        <th class="text-right">Grand Total <input id="total_final_amount"
                                                name="amount[total_final_amount]" type="hidden"
                                                value="{{ $grand_total }}.00"></th>
                                        <td width="15%" id="td_final_amount" class="text-right">₹
                                            {{ number_format($grand_total, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            @if ($booking->payment_status != 'Paid')
                                <form action="{{ route('payment') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                        <input type="hidden" name="total_amount" value="{{ $grand_total }}">
                                        <div class="col-md-3 detil-item">
                                            <label for="">Payment Method</label>
                                            <select class="form-control" name="payment_method">
                                                <option value="">Select</option>
                                                <option value="UPI">UPI</option>
                                                <option value="Cash">Cash</option>
                                                <option value="Card">Card</option>
                                                <option value="bank_transfer">Bank Transfer</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 detil-item">
                                            <label for="">Payment Status</label>
                                            <select class="form-control" name="payment_status">
                                                <option value="">Select</option>
                                                <option value="Paid">Paid</option>
                                                <option value="Unpaid">Unpaid</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3" style="margin-top: 32px;">
                                            <button type="submit" class="btn btn-primary">save</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <h5>Payment Status : <span class="badge badge-success">Completed</span></h5>
                                <h5>Invoice : <a href="{{ route('download_invoice', $booking->id) }}"><span
                                            class="badge badge-primary">Download</span></a></h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card">
                    <div class="card-header">Booking Detail</div>
                    <div class="card-body">
                        <h5><b>Room Booked :</b> {{ $booking->room_booked }}</h5>
                        @foreach ($booking->rooms as $roomm)
                            <div class="row">
                                <div class="col-md-3 detil-item">
                                    <b>Room Type:</b> {{ $roomm->room_type->room_type }}<br>
                                </div>
                                <div class="col-md-3 detil-item">
                                    <b>Room Number:</b> {{ $roomm->room_number }}
                                </div>
                                <div class="col-md-3 detil-item">
                                    @if ($roomm->status == '0' && $booking->payment_status == 'Paid')
                                        <a href="{{ $roomm->status ? '#' : asset(url('/guest/checkout/' . $booking->id . '/room/' . $roomm->id)) }}"
                                            style="{{ $roomm->status ? 'cursor: not-allowed; pointer-events:none' : '' }}"
                                            class="btn btn-primary" onclick="return disableDoubleClick()">Checkout</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .detil-item {
            margin-bottom: 15px;
        }

        .v-p-i img {
            width: 100%;
            height: 250px;
        }
    </style>
    <script type="text/javascript">
        disableDoubleClick = function() {
            if (typeof(_linkEnabled) == "undefined") _linkEnabled = true;
            setTimeout("blockClick()", 100);
            return _linkEnabled;
        }
        blockClick = function() {
            _linkEnabled = false;
            setTimeout("_linkEnabled=true", 1000);
        }
    </script>
@endsection
