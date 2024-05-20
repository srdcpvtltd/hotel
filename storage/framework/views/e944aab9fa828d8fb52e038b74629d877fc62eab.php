
<?php $__env->startSection('title'); ?>
<?php echo e(__('Create Price Rule')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item" href="<?php echo e(route('room_type.index')); ?>"><?php echo e(__('Price Rule')); ?></a><span class="breadcrumb-item active"><?php echo e(__('Create')); ?></span>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<?php echo Form::open(['route' => 'price_rule.store', 'method' => 'POST']); ?>

<div class="col-md-8 m-auto">
    <div class="card">
        <div class="card-header"><?php echo e(__('Create New Price Rule')); ?> </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo e(Form::label('name', __('Room Type'))); ?>

                        <select name="room_type_id" id="room_type_id" class="form-control">
                            <option value="">Select</option>
                            <?php $__currentLoopData = $room_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roomtype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($roomtype->id); ?>"><?php echo e($roomtype->room_type); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo e(Form::label('name', __('Price'))); ?>

                        <?php echo Form::text('price', '100', ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo e(Form::label('name', __('Extra Adult Price'))); ?>

                        <?php echo Form::text('extra_adult_price', '100', ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo e(Form::label('name', __('Extra Child Price'))); ?>

                        <?php echo Form::text('extra_child_price', '50', ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo e(Form::label('name', __('Checkin Time'))); ?>

                        <?php echo Form::time('check_in', '12:00', ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo e(Form::label('name', __('Checkout Time'))); ?>

                        <?php echo Form::time('check_out', '12:00', ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo e(Form::label('name', __('Overtime Surcharge'))); ?>

                        <?php echo Form::text('overtime_charge', '10', ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo e(Form::label('name', __('Rounded minutes to one hour'))); ?>

                        <?php echo Form::text('rounded_minutes', '30', ['class' => 'form-control']); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><?php echo e(__('Holiday Price')); ?> </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo e(Form::label('name', __('Friday Price'))); ?>

                        <?php echo Form::text('friday_price', null, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo e(Form::label('name', __('Saturday Price'))); ?>

                        <?php echo Form::text('saturday_price', null, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo e(Form::label('name', __('Sunday Price'))); ?>

                        <?php echo Form::text('sunday_price', null, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo e(Form::label('name', __('Holiday Price'))); ?>

                        <?php echo Form::text('holiday_price', null, ['class' => 'form-control']); ?>

                    </div>
                </div>
            </div>

            <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-primary'])); ?>

            <a class="btn btn-secondary" href="<?php echo e(route('price_rule.index')); ?>"> <?php echo e(__('Back')); ?></a>
        </div>
    </div>
</div>
<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/system_management/price_rule/create.blade.php ENDPATH**/ ?>