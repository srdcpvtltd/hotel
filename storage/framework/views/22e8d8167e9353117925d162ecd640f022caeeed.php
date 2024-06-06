
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Create Hotel Staff')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item"
        href="<?php echo e(route('hotel_staff.index')); ?>"><?php echo e(__('Hotel Staff')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Create')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo Form::open(['route' => 'hotel_staff.store', 'method' => 'POST']); ?>

    <div class="col-md-8 m-auto">
        <div class="card">
            <div class="card-header"><?php echo e(__('Create New Hotel Staff')); ?> </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Hotel Staff Name'))); ?>

                            <?php echo Form::text('name', null, ['placeholder' => __('Enter Name'), 'class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Contact number'))); ?>

                            <?php echo Form::text('contact_no', null, ['placeholder' => __('Enter Contact Number'), 'class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Designation'))); ?>

                            <select name="designation" id="designation" class="form-control">
                                <option value="">Select</option>
                                <?php $__currentLoopData = $designation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $desg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($desg->id); ?>"><?php echo e($desg->designation); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Salary'))); ?>

                            <?php echo Form::text('salary', null, ['placeholder' => __('Enter Salary'), 'class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Shift'))); ?>

                            <select name="shift" id="shift" class="form-control">
                                <option value="">Select</option>
                                <option value="Morning">Morning</option>
                                <option value="Night">Night</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Shift Timing Start'))); ?>

                            <input type="time" name="shift_timing_start" class="form-control">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Shift Timing End'))); ?>

                            <input type="time" name="shift_timing_end" class="form-control To">
                        </div>
                    </div>
                </div>

                <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-primary'])); ?>


                <a class="btn btn-secondary" href="<?php echo e(route('hotel_staff.index')); ?>"> <?php echo e(__('Back')); ?></a>
            </div>
            <div>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/hotel_staff/create.blade.php ENDPATH**/ ?>