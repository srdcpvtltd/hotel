
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit Housekeeping')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a>
    <a class="breadcrumb-item" href="<?php echo e(route('housekeeping.index')); ?>"><?php echo e(__('Housekeeping')); ?></a>
    <span class="breadcrumb-item active"><?php echo e(__('Edit')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo Form::model($housekeeping, ['method' => 'PATCH', 'route' => ['housekeeping.update', $housekeeping->id]]); ?>

    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header"><?php echo e(__('Edit Housekeeping')); ?> </div>
            <div class="card-body">
                <div class="form-group">
                    <?php echo e(Form::label('name', __('Room'))); ?>

                    <select name="room_id" id="room_id" class="form-control">
                        <option value="">Select</option>
                        <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($room->id); ?>" <?php if($room->id == $housekeeping->room_id): ?> selected <?php endif; ?>>
                                <?php echo e($room->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('name', __('Staff'))); ?>

                    <select name="assign_staff_id" id="assign_staff_id" class="form-control">
                        <option value="">Select</option>
                        <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($staff->id); ?>" <?php if($staff->id == $housekeeping->assign_staff_id): ?> selected <?php endif; ?>>
                                <?php echo e($staff->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('name', __('Status'))); ?>

                    <select name="status" id="status" class="form-control">
                        <option value="">Select</option>
                        <option value="0" <?php if($housekeeping->status == '0'): ?> selected <?php endif; ?>>In Progress</option>
                        <option value="1" <?php if($housekeeping->status == '1'): ?> selected <?php endif; ?>>Complete</option>
                    </select>
                </div>

                <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-primary', 'id' => 'submit'])); ?>

                <a class="btn btn-secondary" href="<?php echo e(route('housekeeping.index')); ?>"> <?php echo e(__('Back')); ?></a>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/housekeeping/edit.blade.php ENDPATH**/ ?>