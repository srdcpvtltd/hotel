
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Guest View Detail')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item"
        href="<?php echo e(route('admin.report')); ?>"><?php echo e(__('Report')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Guest View Detail')); ?></span>
<?php $__env->stopSection(); ?>
<style>
    .detil-item {
        margin-top: 20px;
    }
</style>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="fade-in">
            <section class="content">
                <div class="fade-in guest-register">
                    <div class="card">
                        <div class="fade-in guest-register">
                            <div class="card">
                            <div class="card-header">Guest Detail</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <b>Guest Name:</b> <?php echo e($booking->gues_name); ?>

                                        </div>
                                        <div class="col-md-4">
                                            <b>Mobile Number:</b> <?php echo e($booking->mobile_number); ?>

                                        </div>
                                        <div class="col-md-4">
                                            <b>Alternate Mobile Number:</b> <?php echo e($booking->alter_mobile_number); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Age:</b> <?php echo e($booking->age); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Gender:</b> <?php echo e($booking->gender); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Guest Email Id:</b> <?php echo e($booking->email_id); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Guest Arrived From:</b> <?php echo e($booking->arrived_from); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Nationality:</b> <?php echo e($booking->nationality); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Means of Transport:</b> <?php echo e($booking->transport); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Present House Number:</b> <?php echo e($booking->house_number); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Present House Lane:</b> <?php echo e($booking->lane); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Present House Landmark:</b> <?php echo e($booking->land_mark); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Present House Country:</b> <?php echo e($booking->country->name); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Present House State:</b> <?php echo e($booking->state->name); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Present House District:</b> <?php echo e($booking->district->name); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Present House City:</b> <?php echo e($booking->city->name); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Present House Town:</b> <?php echo e($booking->present_town); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Present House Pin:</b> <?php echo e($booking->present_pin); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Parmanent House Number:</b> <?php echo e($booking->p_house_number); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Parmanent House Lane:</b> <?php echo e($booking->p_lane); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Parmanent House Landmark:</b> <?php echo e($booking->p_land_mark); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Parmanent House Country:</b> <?php echo e($booking->p_country->name); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Parmanent House State:</b> <?php echo e($booking->p_state->name); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Parmanent House District:</b> <?php echo e($booking->p_district->name); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Parmanent House City:</b> <?php echo e($booking->p_city->name); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Parmanent House Town:</b> <?php echo e($booking->p_town); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Parmanent House Pin:</b> <?php echo e($booking->p_pin); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Local Contact Name:</b> <?php echo e($booking->local_contact_name); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Local Contact Number:</b> <?php echo e($booking->local_contact_number); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Arrival Date & Time:</b> <?php echo e($booking->arrival_date); ?> <?php echo e($booking->arrival_time); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>ID Type:</b> <?php echo e($booking->id_type); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>ID Number:</b> <?php echo e($booking->id_number); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Room Booked:</b> <?php echo e($booking->room_booked); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Room Number:</b> <?php if($booking->rooms != []): ?> <?php $__currentLoopData = $booking->rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($room->room_number); ?> <?php if($booking->room_booked >= 2): ?> , <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Purpose of Visit:</b> <?php echo e($booking->whom_to_visit); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/guest/viewdetail.blade.php ENDPATH**/ ?>