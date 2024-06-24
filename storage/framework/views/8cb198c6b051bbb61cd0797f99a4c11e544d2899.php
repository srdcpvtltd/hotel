
<?php $__env->startSection('title'); ?>
<?php echo e(__('Create Vendor Category')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a>
<a class="breadcrumb-item" href="<?php echo e(route('vendor_category.index')); ?>"><?php echo e(__('Vendor Category')); ?></a>
<span class="breadcrumb-item active"><?php echo e(__('Create')); ?></span>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<?php echo Form::open(['route' => 'vendor_category.store', 'method' => 'POST']); ?>

<div class="col-md-4 m-auto">
    <div class="card">
        <div class="card-header"><?php echo e(__('Create New Vendor Category')); ?> </div>
        <div class="card-body">
            <div class="form-group">
                <?php echo e(Form::label('name', __('Name'))); ?>

                <?php echo Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control']); ?>

            </div>
            <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-primary','id' => 'submit'])); ?>

            <a class="btn btn-secondary" href="<?php echo e(route('vendor_category.index')); ?>"> <?php echo e(__('Back')); ?></a>
        </div>
    </div>
</div>
<?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/vendors/category/create.blade.php ENDPATH**/ ?>