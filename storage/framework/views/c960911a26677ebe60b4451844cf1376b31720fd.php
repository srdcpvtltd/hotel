
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Create Room Type')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item"
        href="<?php echo e(route('room_type.index')); ?>"><?php echo e(__('Room Type')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Create')); ?></span>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php echo Form::open(['route' => 'room_type.store', 'method' => 'POST']); ?>

    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header"><?php echo e(__('Create New Room Type')); ?> </div>
            <div class="card-body">
                <div class="form-group">
                    <?php echo e(Form::label('name', __('Room Type'))); ?>

                    <?php echo Form::text('room_type', null, ['placeholder' => __('Name'),  'class' => 'form-control']); ?>

                </div>
                <div class="form-group">
                    <?php echo e(Form::label('name', __('Description'))); ?>

                    <textarea name="description" id="description" cols="30" rows="3" class="form-control mb-3"></textarea>

                <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-primary'])); ?>


                <a class="btn btn-secondary" href="<?php echo e(route('cities.index')); ?>"> <?php echo e(__('Back')); ?></a>
            </div>
            <div>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/system_management/room_type/create.blade.php ENDPATH**/ ?>