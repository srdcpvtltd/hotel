
<?php $__env->startSection('breadcrumb'); ?>
    <span class="breadcrumb-item active"><?php echo e(__('Guest Detail')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Guest Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="">
        <?php if(session()->has('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session()->get('success')); ?>

            </div>
        <?php endif; ?>

        <div class="fade-in guest-register">
            <div class="container">
                <div class="row">
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
                            <div class="card-header">Booking Detail</div>
                            <div class="card-body">
                                <h5><b>Room Booked :</b> <?php echo e($booking->room_booked); ?></h5>
                                <?php $__currentLoopData = $booking->rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row">
                                        <div class="col-md-4 detil-item">
                                            <b>Room Type:</b> <?php echo e($room->room_type->room_type); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Room Number:</b> <?php echo e($room->room_number); ?>

                                        </div>

                                        <div class="col-md-4 detil-item">
                                            <?php if(auth()->check() && auth()->user()->hasRole('user')): ?>
                                                <button
                                                    class="btn btn-info"><?php echo e($room->status ? 'Completed' : 'In Progress'); ?></button>
                                                
                                                    <?php if($room->status == '0'): ?>
                                                    <a href="<?php echo e($room->status ? '#' : asset(url('/guest/checkout/' . $booking->id . '/room/' . $room->id))); ?>"
                                                        style="<?php echo e($room->status ? 'cursor: not-allowed; pointer-events:none' : ''); ?>"
                                                        class="btn btn-primary"
                                                        onclick="return disableDoubleClick()">Checkout</a>
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