
<?php $__env->startSection('title'); ?>
<?php echo e(__('Edit Product Category')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a>
<a class="breadcrumb-item" href="<?php echo e(route('product_category.index')); ?>"><?php echo e(__('Product Category')); ?></a>
<span class="breadcrumb-item active"><?php echo e(__('Edit')); ?></span>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<?php echo Form::model($product_category, ['method' => 'PATCH', 'route' => ['product_category.update', $product_category->id]]); ?>

<div class="col-md-8 m-auto">
    <div class="card">
        <div class="card-header"><?php echo e(__('Edit Product Category')); ?> </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo e(Form::label('name', __('Name'))); ?>

                        <?php echo Form::text('name', $product_category->name , ['class' => 'form-control']); ?>

                    </div>
                </div>
            </div>
            <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-primary'])); ?>

            <a class="btn btn-secondary" href="<?php echo e(route('product_category.index')); ?>"> <?php echo e(__('Back')); ?></a>
        </div>
    </div>
</div>
<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/inventory/product_category/edit.blade.php ENDPATH**/ ?>