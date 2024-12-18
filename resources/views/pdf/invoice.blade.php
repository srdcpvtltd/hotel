<style>
    .fullTable {
        margin-left: -25px;
    }
</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable">
    <tr>
        <td>
            <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"
                bgcolor="#ffffff" style="border-radius: 10px 10px 0 0;">
                <tr>
                    <td>
                        <table width="480" border="0" cellpadding="0" cellspacing="0" align="center"
                            class="fullPadding">
                            <tbody>
                                <tr>
                                    <td>
                                        <table width="220" border="0" cellpadding="0" cellspacing="0"
                                            align="left" class="col">
                                            <tbody>
                                                <tr>
                                                    <td align="left"> <img
                                                            src="http://www.supah.it/dribbble/017/logo.png"
                                                            width="32" height="32" alt="logo"
                                                            border="0" /></td>
                                                </tr>
                                                <tr class="hiddenMobile">
                                                    <td height="20"></td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="font-size: 12px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 18px; vertical-align: top; text-align: left;">
                                                        Hello, {{ $booking->gues_name }}.
                                                    </td>
                                                </tr>
                                                <tr class="visibleMobile">
                                                    <td height="10"></td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="font-size: 11px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 1; vertical-align: top; text-decoration:underline;margin-bottom:10px">
                                                        <strong>PAYMENT METHOD</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="font-size: 12px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 18px; vertical-align: top;">
                                                        <span>Booking No :-</span> {{ $booking->id }}<br />
                                                        @if ($booking->rooms[0]->checkout_date != null)
                                                            <span>Date :-
                                                                {{ date('F jS Y', strtotime($booking->rooms[0]->checkout_date)) }}</span>
                                                        @else
                                                            <span>Date :- {{ date('F jS Y') }}</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; line-height: 20px; vertical-align: top; ">
                                                        Payment Mode : {{ $booking->payment_method }}<br>
                                                        Payment Status : {{ $booking->payment_status }}<br>
                                                    </td>
                                                </tr>
                                                <tr class="hiddenMobile">
                                                    <td height="40"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table width="220" border="0" cellpadding="0" cellspacing="0"
                                            align="right" class="col" style="margin-top: -40%;">
                                            <tbody>
                                                <tr class="visibleMobile">
                                                    <td height="20"></td>
                                                </tr>
                                                <tr>
                                                    <td height="5"></td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="font-size: 21px; color: #ff0000; letter-spacing: -1px; font-family: 'Open Sans', sans-serif; line-height: 1; vertical-align: top; text-align: right;">
                                                        Invoice
                                                    </td>
                                                </tr>
                                                <tr>
                                                <tr class="hiddenMobile">
                                                    <td height="100"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable">
    <tbody>
        <tr>
            <td>
                <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"
                    bgcolor="#ffffff">
                    <tbody>
                        <tr>
                            <td>
                                <div
                                    style="margin-left: 80px;margin-bottom: 10px;color: #686868;text-decoration: underline;">
                                    Payment Information</div>

                                <table width="480" border="0" cellpadding="0" cellspacing="0" align="center">
                                    <tbody>
                                        <tr>
                                            <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 10px 7px 0;"
                                                width="40%" align="left">Room</th>
                                            <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 10px 7px 0;"
                                                width="43%" align="center">Duration of Stay</th>
                                            <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 10px 7px 0;"
                                                width="35%" align="right">Total Amount</th>
                                        </tr>
                                        <tr>
                                            <td height="1" style="background: #bebebe;" colspan="4"></td>
                                        </tr>
                                        @foreach ($booking->rooms as $key => $room)
                                            <tr>
                                                <td
                                                    style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #ff0000;  line-height: 18px;  vertical-align: top; padding:10px 0;">
                                                    {{ $room->room_type->room_type }}<br>
                                                    (Room No. : {{ $room->room_number }})
                                                </td>
                                                <th
                                                    style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;">
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
                                                        $room_price = App\Models\Room::where('hotel_id', $hotel->id)
                                                            ->where('name', $room->room_number)
                                                            ->first('price');
                                                        $p = $room_price->price;
                                                        $price = $p * $days;
                                                        $tot[] = $price;
                                                    @endphp
                                                    <span class="">{{ $days }}</span>
                                                </th>
                                                <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;"
                                                    align="right">₹
                                                    {{ $price }}.00</td>
                                            </tr>
                                            <tr>
                                                <td height="1" style="background: #bebebe;" colspan="4"></td>
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
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable">
    <tbody>
        <tr>
            <td>
                <table width="600" border="0" cellpadding="0" cellspacing="0" align="center"
                    class="fullTable" bgcolor="#ffffff">
                    <tbody>
                        <tr>
                            <td>
                                @php
                                    $sgst = ($subtotal * 9) / 100;
                                    $cgst = ($subtotal * 9) / 100;
                                    $total_amount = $subtotal + ($cgst + $sgst);
                                @endphp
                                <table width="480" border="0" cellpadding="0" cellspacing="0" align="center"
                                    class="fullPadding">
                                    <tbody>
                                        <tr>
                                            <td
                                                style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                Subtotal
                                            </td>
                                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; white-space:nowrap;"
                                                width="80">
                                                ₹ {{ number_format($subtotal, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                SGST(9%)
                                            </td>
                                            <td
                                                style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                ₹ {{ number_format($sgst, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                CGST(9%)
                                            </td>
                                            <td
                                                style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                ₹ {{ number_format($cgst, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                                                <strong>Total (Incl.Tax)</strong>
                                            </td>
                                            <td
                                                style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                                                <strong>₹ {{ number_format($total_amount, 2) }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr class="hiddenMobile">
            <td height="30"></td>
        </tr>
    </tbody>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable">
    <tbody>
        <tr>
            <td>
                <table width="600" border="0" cellpadding="0" cellspacing="0" align="center"
                    class="fullTable" bgcolor="#ffffff">
                    <tbody>
                        <tr class="visibleMobile">
                            <td height="20"></td>
                        </tr>
                        <tr>
                            <td>
                                <div
                                    style="margin-left: 80px;margin-bottom: 10px;color: #686868;text-decoration: underline;">
                                    Food Orders</div>

                                <table width="480" border="0" cellpadding="0" cellspacing="0"
                                    align="center">
                                    <tbody>
                                        <tr>
                                            <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 10px 7px 0;"
                                                width="25%" align="left">Item Details</th>
                                            <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 10px 7px 0;"
                                                width="15%" align="center">Date</th>
                                            <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 10px 7px 0;"
                                                width="20%" align="center">Item Qty</th>
                                            <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 10px 7px 0;"
                                                width="20%" align="center">Item subtotal</th>
                                            <th style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #5b5b5b; font-weight: normal; line-height: 1; vertical-align: top; padding: 0 10px 7px 0;"
                                                width="20%" align="right">Total Amount</th>
                                        </tr>
                                        <tr>
                                            <td height="1" style="background: #bebebe;" colspan="5"></td>
                                        </tr>
                                        @php
                                            $tot_price = 0;
                                        @endphp
                                        @foreach ($orders as $key => $order)
                                            <tr>
                                                <td
                                                    style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #ff0000;  line-height: 18px;  vertical-align: top; padding:10px 0;">
                                                    {{ $order->food->name }} <br>
                                                    (Room No.: {{ $order->room->name }})
                                                </td>
                                                <td
                                                    style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;">
                                                    {{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                                                <td
                                                    style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;text-align: center;">
                                                    {{ $order->quantity }}</td>
                                                <td
                                                    style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;text-align: center;">
                                                    ₹ {{ $order->price }}.00</td>
                                                <td
                                                    style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e;  line-height: 18px;  vertical-align: top; padding:10px 0;text-align: right;">
                                                    ₹ {{ $order->total_price }}.00</td>
                                            </tr>
                                            <tr>
                                                <td height="1" style="background: #bebebe;" colspan="5"></td>
                                            </tr>
                                            @php
                                                $tot_price += $order->total_price;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable">
    <tbody>
        <tr>
            <td>
                <table width="600" border="0" cellpadding="0" cellspacing="0" align="center"
                    class="fullTable" bgcolor="#ffffff">
                    <tbody>
                        <tr>
                            <td>
                                @php
                                    $sgst1 = ($tot_price * 9) / 100;
                                    $cgst1 = ($tot_price * 9) / 100;
                                    $total_amount1 = $tot_price + ($cgst1 + $sgst1);
                                    $grand_total = $total_amount1 + $total_amount;
                                @endphp
                                <table width="480" border="0" cellpadding="0" cellspacing="0" align="center"
                                    class="fullPadding">
                                    <tbody>
                                        <tr>
                                            <td
                                                style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                Subtotal
                                            </td>
                                            <td style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; white-space:nowrap;"
                                                width="80">
                                                ₹ {{ number_format($tot_price, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                SGST(9%)
                                            </td>
                                            <td
                                                style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                ₹ {{ number_format($sgst1, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                CGST(9%)
                                            </td>
                                            <td
                                                style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 22px; vertical-align: top; text-align:right; ">
                                                ₹ {{ number_format($cgst1, 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                                                <strong>Total (Incl.Tax)</strong>
                                            </td>
                                            <td
                                                style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                                                <strong>₹ {{ number_format($total_amount1, 2) }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th
                                                style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                                                <strong>Grand Total</strong>
                                            </th>
                                            <td
                                                style="font-size: 12px; font-family: 'Open Sans', sans-serif; color: #000; line-height: 22px; vertical-align: top; text-align:right; ">
                                                ₹
                                                <strong>{{ number_format($grand_total, 2) }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr class="hiddenMobile">
            <td height="30"></td>
        </tr>
    </tbody>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable">

    <tr>
        <td>
            <table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="fullTable"
                bgcolor="#ffffff" style="border-radius: 0 0 10px 10px;">
                <tr>
                    <td>
                        <table width="480" border="0" cellpadding="0" cellspacing="0" align="center"
                            class="fullPadding">
                            <tbody>
                                <tr>
                                    <td
                                        style="font-size: 12px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 18px; vertical-align: top; text-align: left;">
                                        Have a nice day.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr class="spacer">
                    <td height="50"></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td height="30"></td>
    </tr>
</table>

