
<?php $__env->startSection('title'); ?>
<?php echo e(__('Create Stocks')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a>
<a class="breadcrumb-item" href="<?php echo e(route('stock_inventory')); ?>"><?php echo e(__('Stocks')); ?></a>
<span class="breadcrumb-item active"><?php echo e(__('Create')); ?></span>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<?php echo Form::open(['route' => 'stock.store', 'method' => 'POST']); ?>

<div class="col-md-4 m-auto">
    <div class="card">
        <div class="card-header">
            <?php echo e(__('Create New Stock')); ?>

        </div>
        <div class="card-body">
            <div class="form-group">
                <?php echo e(Form::label('name', __('Product Category'))); ?>

                <select name="product_category_id" id="product_category_id" class="form-control">
                    <option value="">Select</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('name', __('Product'))); ?>

                <select name="product_id" id="product_id" class="form-control">
                    <option value="">Select</option>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($product->id); ?>"><?php echo e($product->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('name', __('Stock'))); ?>

                <select name="stock" id="stock" class="form-control">
                    <option value="">Select</option>
                    <option value="In">In</option>
                    <option value="Out">Out</option>
                </select>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('name', __('Quantity'))); ?>

                <?php echo Form::text('quantity', null, ['placeholder' => __('Quantity'), 'class' => 'form-control']); ?>

            </div>
            <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-primary'])); ?>

            <a class="btn btn-secondary" href="<?php echo e(route('stock_inventory')); ?>"> <?php echo e(__('Back')); ?></a>
        </div>
    </div>
</div>
<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/inventory/stock/create.blade.php ENDPATH**/ ?>