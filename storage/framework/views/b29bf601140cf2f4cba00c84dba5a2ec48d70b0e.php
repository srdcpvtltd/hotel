
<?php $__env->startSection('title'); ?>
<?php echo e(__('Edit Booking')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item" href="<?php echo e(route('booking.index')); ?>"><?php echo e(__('Bookings')); ?></a><span class="breadcrumb-item active"><?php echo e(__('Edit')); ?></span>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo Form::model($booking, ['method' => 'PATCH', 'route' => ['booking.update', $booking->id]]); ?>

<div class="col-md-8 m-auto">
    <div class="card">
        <div class="card-header"><?php echo e(__('Edit Booking')); ?> </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo e(Form::label('name', __('Customer Name'))); ?>

                        <?php echo Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control']); ?>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo e(Form::label('name', __('Phone Number'))); ?>

                        <?php echo Form::text('phone_number', null, ['placeholder' => __('Phone Number'), 'class' => 'form-control', 'oninput' => "validateTelInput(this)", 'maxlength' => "10"]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Room Type</label>
                        <select class="form-control" name="room_type_id" id="room_type">
                            <option value="" selected>Select Room Type</option>
                            <?php $__currentLoopData = $room_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($room_type->id); ?>" <?php if($room_type->id == $booking->room_type_id): ?> selected <?php endif; ?>><?php echo e($room_type->room_type); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo e(Form::label('name', __('From Date'))); ?>

                        <?php echo Form::date('from_date', null, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo e(Form::label('name', __('To Date'))); ?>

                        <?php echo Form::date('to_date', null, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <div class="form-group">
                        <?php echo e(Form::label('name', __('Advance Payment'))); ?>

                        <?php echo Form::text('advance_payment', null, ['placeholder' => __('0'), 'class' => 'form-control', 'oninput' => "validateTelInput(this)", 'maxlength' => "4"]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo e(Form::label('name', __('Total Price'))); ?>

                        <?php echo Form::text('total_price', null, ['placeholder' => __('0'), 'class' => 'form-control', 'oninput' => "validateTelInput(this)", 'maxlength' => "4"]); ?>

                    </div>
                </div> -->
            </div>
            <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-primary'])); ?>


            <a class="btn btn-secondary" href="<?php echo e(route('cities.index')); ?>"> <?php echo e(__('Back')); ?></a>
        </div>
        <div>
        </div>
    </div>
</div>
<?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/booking/edit.blade.php ENDPATH**/ ?>