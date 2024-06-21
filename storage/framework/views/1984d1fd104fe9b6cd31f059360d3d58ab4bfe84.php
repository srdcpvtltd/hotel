
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Create Housekeeping')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a>
    <a class="breadcrumb-item" href="<?php echo e(route('housekeeping.index')); ?>"><?php echo e(__('Housekeeping')); ?></a>
    <span class="breadcrumb-item active"><?php echo e(__('Create')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo Form::open(['route' => 'housekeeping.store', 'method' => 'POST']); ?>

    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header"><?php echo e(__('Create New Housekeeping')); ?> </div>
            <div class="card-body">
                <div class="form-group">
                    <?php echo e(Form::label('name', __('Room'))); ?>

                    <select name="room_id" id="room_id" class="form-control">
                        <option value="">Select</option>
                        <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($room->id); ?>"><?php echo e($room->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('name', __('Staff'))); ?>

                    <select name="assign_staff_id" id="assign_staff_id" class="form-control">
                        <option value="">Select</option>
                        <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($staff->id); ?>"><?php echo e($staff->name); ?> (<?php echo e($staff->designation->designation); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('name', __('Status'))); ?>

                    <select name="status" id="status" class="form-control">
                        <option value="">Select</option>
                        <option value="0">In Progress</option>
                        <option value="1">Complete</option>
                    </select>
                </div>

                <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-primary', 'id' => 'submit'])); ?>

                <a class="btn btn-secondary" href="<?php echo e(route('housekeeping.index')); ?>"> <?php echo e(__('Back')); ?></a>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/housekeeping/create.blade.php ENDPATH**/ ?>