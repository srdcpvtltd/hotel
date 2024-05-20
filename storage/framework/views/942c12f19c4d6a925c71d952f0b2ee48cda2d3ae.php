
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit Hotel Staff')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item"
        href="<?php echo e(route('designation.index')); ?>"><?php echo e(__('Hotel Staff')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Edit')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo Form::model($hotel_staff, ['method' => 'PATCH', 'route' => ['hotel_staff.update', $hotel_staff->id]]); ?>

    <div class="col-md-8 m-auto">
        <div class="card">
            <div class="card-header"><?php echo e(__('Edit Hotel Staff')); ?> </div>
            <div class="card-body">
                <div class="col-12">
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

                                <select name="designation_id" id="designation" class="form-control">
                                    <option value="">Select</option>
                                    <?php $__currentLoopData = $designation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $desg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($desg->id); ?>" <?php if($desg->id == $hotel_staff->designation_id): ?> selected <?php endif; ?>><?php echo e($desg->designation); ?></option>
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
                                    <option value="Morning" <?php if($hotel_staff->shift == "Morning"): ?> selected <?php endif; ?>>Morning</option>
                                    <option value="Night" <?php if($hotel_staff->shift == "Night"): ?> selected <?php endif; ?>>Night</option>
                                </select>
                            </div>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/hotel_staff/edit.blade.php ENDPATH**/ ?>