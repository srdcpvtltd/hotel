
<?php $__env->startSection('breadcrumb'); ?>
    <span class="breadcrumb-item active"><?php echo e(__('Guest Detail')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Guest Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <style>
        .pd_0 {
            padding: 0;
        }
    </style>
    <div class="">
        <?php if(session()->has('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session()->get('success')); ?>

            </div>
        <?php endif; ?>

        <div class="fade-in guest-register">
            <div class="col-sm">
                <div class="card">
                    <div class="card-header">Guest Detail</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-center" style="margin-bottom: 15px;">
                                <img src="<?php echo e(asset(url('storage/bookings/' . $booking->guest_image))); ?>" />
                            </div>
                            <div class="col-md-4 detil-item">
                                <b>Guest Name:</b> <?php echo e($booking->gues_name); ?>

                            </div>
                            <div class="col-md-4 detil-item">
                                <b>Mobile Number:</b> <?php echo e($booking->mobile_number); ?>

                            </div>

                            <div class="col-md-4 detil-item">
                                <b>Guest Email:</b> <?php echo e($booking->email_id); ?>

                            </div>
                            <div class="col-md-4 detil-item">
                                <b>Arrived From:</b> <?php echo e($booking->arrived_from); ?>

                            </div>
                            <div class="col-md-4 detil-item">
                                <b>Arrival Date:</b> <?php echo e($booking->arrival_date); ?>

                            </div>
                            <div class="col-md-4 detil-item">
                                <b>Arrival Time:</b> <?php echo e($booking->arrival_time); ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <?php if(!empty($criminal)): ?>
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">Criminal Detail</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-center" style="margin-bottom: 15px;">
                                    <img src="<?php echo e(asset(url('storage/criminals/' . $criminal->photo))); ?>" />
                                </div>
                                <div class="col-md-4 detil-item">
                                    <b>Name:</b> <?php echo e($criminal->name); ?>

                                </div>
                                <div class="col-md-4 detil-item">
                                    <b>Mobile Number:</b> <?php echo e($criminal->mobile); ?>

                                </div>
                                <div class="col-md-4 detil-item">
                                    <b>Age:</b> <?php echo e($criminal->age); ?>

                                </div>
                                <div class="col-md-4 detil-item">
                                    <b>Gender:</b> <?php echo e($criminal->gender); ?>

                                </div>
                                <div class="col-md-4 detil-item">
                                    <b>Remarks:</b> <?php echo e($criminal->remarks); ?>

                                </div>
                                <div class="col-md-4 detil-item">
                                    <a class="btn btn-danger btn-xs"
                                        href="<?php echo e(asset(url('/mark/unsuspicious/' . $booking->id))); ?>">Mark as Not
                                        Suspicious</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
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
                                    <?php $__currentLoopData = $booking->rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="per_room_tr">
                                            <td class="text-center"><?php echo e($key + 1); ?></td>
                                            <td>
                                                <?php echo e($room->room_type->room_type); ?><br>
                                                (Room No. : <?php echo e($room->room_number); ?>)
                                            </td>
                                            <th class="text-center">
                                                <?php
                                                    if ($advance_booking != null) {
                                                        $checkout_date = $advance_booking->to_date;
                                                    } else {
                                                        $checkout_date = date('Y-m-d');
                                                    }
                                                    $datetime1 = strtotime($booking->arrival_date);
                                                    $datetime2 = strtotime($checkout_date);
                                                    $days = (int) (($datetime2 - $datetime1) / 86400);
                                                    $subtotal = 0;
                                                ?>
                                                <span class=""><?php echo e($days); ?></span>
                                            </th>
                                            <td class="text-center">
                                                <span class="error base_price_err_msg"></span>
                                                <button type="button" class="btn btn-xs btn-info" data-toggle="modal"
                                                    data-target="#room_price_model_<?php echo e($room->id); ?>">Price
                                                    Break</button>
                                                <div id="room_price_model_<?php echo e($room->id); ?>" class="modal fade"
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
                                                                                <?php
                                                                                    $room_price = App\Models\Room::where(
                                                                                        'hotel_id',
                                                                                        $hotel->id,
                                                                                    )
                                                                                        ->where(
                                                                                            'name',
                                                                                            $room->room_number,
                                                                                        )
                                                                                        ->first('price');
                                                                                    $p = $room_price->price;
                                                                                    $price = $p * $days;
                                                                                    $tot = [];
                                                                                ?>
                                                                                <?php for($i = 0; $i < $days; $i++): ?>
                                                                                    <?php
                                                                                    if ($advance_booking == null) {
                                                                                        $anchor = Carbon\Carbon::yesterday()->subDay($i);
                                                                                    }else{
                                                                                        $anchor = Carbon\Carbon::yesterday()->addDay($i);
                                                                                    }
                                                                                        $date[] = date('Y-m-d',strtotime($anchor));
                                                                                        $tot[] = $p;
                                                                                    ?>
                                                                                    <tr>
                                                                                        <td class="text-center">
                                                                                            <?php echo e($date[$i]); ?>

                                                                                        </td>
                                                                                        <?php if($date[$i] != date('Y-m-d')): ?>
                                                                                            <td class="text-right">₹
                                                                                                <?php echo e($room_price->price); ?>.00
                                                                                            </td>
                                                                                        <?php else: ?>
                                                                                            <td class="text-right">₹ 0.00
                                                                                            </td>
                                                                                        <?php endif; ?>
                                                                                    </tr>
                                                                                <?php endfor; ?>
                                                                                <tr>
                                                                                    <td></td>
                                                                                    <td class="text-right"><b>₹
                                                                                            <?php echo e($price); ?>.00</b>
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
                                            <td class="text-right td_total_per_room_amount">₹ <?php echo e($price); ?>.00</td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        if ($tot != null) {
                                            $count = count($tot);
                                            for ($i = 0; $i < $count; $i++) {
                                                $subtotal += $tot[$i];
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th class="text-right">Subtotal <input id="total_room_amount"
                                                name="amount[total_room_amount]" type="hidden"
                                                value="<?php echo e($subtotal); ?>.00"></th>
                                        <td width="20%" class="text-right td_total_room_amount">₹ <?php echo e($subtotal); ?>.00
                                        </td>
                                    </tr>
                                    <?php
                                        $sgst = ($subtotal * 9) / 100;
                                        $cgst = ($subtotal * 9) / 100;
                                        $total_amount = $subtotal + ($cgst + $sgst);
                                    ?>
                                    <tr>
                                        <th class="text-right">SGST (9%) <input id="total_room_amount_gst"
                                                name="amount[total_room_amount_gst]" type="hidden"
                                                value="<?php echo e($sgst); ?>"></th>
                                        <td width="20%" id="td_total_room_amount_gst" class="text-right">₹
                                            <?php echo e($sgst); ?>.00
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <th class="text-right">CGST (9%) <input id="total_room_amount_cgst"
                                                name="amount[total_room_amount_cgst]" type="hidden"
                                                value="<?php echo e($cgst); ?>"></th>
                                        <td width="20%" id="td_total_room_amount_cgst" class="text-right">₹
                                            <?php echo e($cgst); ?>.00
                                        </td>
                                    </tr>
                                    
                                    
                                    <tr class="bg-warning">
                                        <th class="text-right">Total Amount <input id="total_room_final_amount"
                                                name="amount[total_room_final_amount]" type="hidden" value="51000.00">
                                        </th>
                                        <td width="20%" id="td_room_final_amount" class="text-right">₹
                                            <?php echo e($total_amount); ?>.00</td>
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
                                    <?php
                                        $tot_price = 0;
                                        $i = 0;
                                    ?>
                                    <?php if(count($booking->rooms) > 0): ?>
                                        <?php $__currentLoopData = $booking->rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bookin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $rooms = App\Models\Room::where('hotel_id', $hotel->id)
                                                    ->where('name', $bookin->room_number)
                                                    ->first();

                                                $orders = App\Models\Order::where('room_id', $rooms->id)
                                                    ->where('status', 1)
                                                    ->get();
                                            ?>
                                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $tot_price += $order->total_price;
                                                ?>
                                                <tr>
                                                    <td><?php echo e($i + 1); ?></td>
                                                    <td>
                                                        <?php echo e($order->food->name); ?> <br>
                                                        (Room No.: <?php echo e($order->room->name); ?>)
                                                    </td>
                                                    <td><?php echo e(date('d-m-Y', strtotime($order->created_at))); ?></td>
                                                    <td class="text-center"><?php echo e($order->quantity); ?></td>
                                                    <td class="text-right">₹ <?php echo e($order->price); ?>.00</td>
                                                    <td class="text-right">₹ <?php echo e($order->total_price); ?>.00</td>
                                                </tr>
                                                <?php
                                                    $i++;
                                                ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6">No Orders</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th class="text-right">Subtotal <input id="total_order_amount"
                                                name="amount[order_amount]" type="hidden" value="<?php echo e($tot_price); ?>">
                                        </th>
                                        <td width="15%" id="td_total_order_amount" class="text-right">₹
                                            <?php echo e($tot_price); ?></td>
                                    </tr>
                                    <?php
                                        $sgst1 = ($tot_price * 9) / 100;
                                        $cgst1 = ($tot_price * 9) / 100;
                                        $total_amount1 = $tot_price + ($cgst1 + $sgst1);
                                        $grand_total = $total_amount1 + $total_amount;
                                    ?>
                                    <tr>
                                        <th class="text-right">SGST (9%) <input id="total_order_amount_gst"
                                                name="amount[order_amount_gst]" type="hidden"
                                                value="<?php echo e($sgst1); ?>"></th>
                                        <td width="15%" id="td_order_amount_gst" class="text-right">₹
                                            <?php echo e($sgst1); ?></td>
                                    </tr>
                                    <tr class="">
                                        <th class="text-right">CGST (9%) <input id="total_order_amount_cgst"
                                                name="amount[order_amount_cgst]" type="hidden"
                                                value="<?php echo e($cgst1); ?>"></th>
                                        <td width="15%" id="td_order_amount_cgst" class="text-right">₹
                                            <?php echo e($cgst1); ?></td>
                                    </tr>
                                    
                                    <tr class="bg-warning">
                                        <th class="text-right">Total Amount <input id="total_order_final_amount"
                                                name="amount[order_final_amount]" type="hidden"
                                                value="<?php echo e($total_amount1); ?>"></th>
                                        <td width="15%" id="td_order_final_amount" class="text-right">₹
                                            <?php echo e($total_amount1); ?></td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="bg-success">
                                        <th class="text-right">Grand Total <input id="total_final_amount"
                                                name="amount[total_final_amount]" type="hidden"
                                                value="<?php echo e($grand_total); ?>.00"></th>
                                        <td width="15%" id="td_final_amount" class="text-right">₹
                                            <?php echo e(number_format($grand_total, 2)); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php if($booking->payment_status != 'Paid'): ?>
                                <form action="<?php echo e(route('payment')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <input type="hidden" name="booking_id" value="<?php echo e($booking->id); ?>">
                                        <input type="hidden" name="total_amount" value="<?php echo e($grand_total); ?>">
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
                            <?php else: ?>
                                <h5>Payment Status : <span class="badge badge-success">Completed</span></h5>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card">
                    <div class="card-header">Booking Detail</div>
                    <div class="card-body">
                        <h5><b>Room Booked :</b> <?php echo e($booking->room_booked); ?></h5>
                        <?php $__currentLoopData = $booking->rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roomm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="row">
                                <div class="col-md-3 detil-item">
                                    <b>Room Type:</b> <?php echo e($roomm->room_type->room_type); ?><br>
                                </div>
                                <div class="col-md-3 detil-item">
                                    <b>Room Number:</b> <?php echo e($roomm->room_number); ?>

                                </div>
                                <div class="col-md-3 detil-item">
                                    <?php if(auth()->check() && auth()->user()->hasRole('free')): ?>
                                        <?php if($roomm->status == '0'): ?>
                                            <a href="<?php echo e($roomm->status ? '#' : asset(url('/guest/checkout/' . $booking->id . '/room/' . $roomm->id))); ?>"
                                                style="<?php echo e($roomm->status ? 'cursor: not-allowed; pointer-events:none' : ''); ?>"
                                                class="btn btn-primary" onclick="return disableDoubleClick()">Checkout</a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/guest/detail.blade.php ENDPATH**/ ?>