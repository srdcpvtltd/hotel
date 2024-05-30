
<?php $__env->startSection('title'); ?>
<?php echo e(__('Edit Product')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a>
<a class="breadcrumb-item" href="<?php echo e(route('cities.index')); ?>"><?php echo e(__('Product')); ?></a>
<span class="breadcrumb-item active"><?php echo e(__('Edit')); ?></span>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<?php echo Form::model($product, ['method' => 'PATCH', 'route' => ['product.update', $product->id]]); ?>

<div class="col-md-4 m-auto">
    <div class="card">
        <div class="card-header"><?php echo e(__('Edit Product')); ?> </div>
        <div class="card-body">
            <div class="form-group">
                <?php echo e(Form::label('name', __('Product Category'))); ?>

                <select name="product_category_id" id="product_category_id" class="form-control">
                    <option value="">Select</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php if($category->id == $product->product_category_id): ?> Selected <?php endif; ?>><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('name', __('Name'))); ?>

                <?php echo Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control']); ?>

            </div>

            <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-primary','id' => 'submit'])); ?>

            <a class="btn btn-secondary" href="<?php echo e(route('product.index')); ?>"> <?php echo e(__('Back')); ?></a>
        </div>
    </div>
</div>
<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/inventory/product/edit.blade.php ENDPATH**/ ?>