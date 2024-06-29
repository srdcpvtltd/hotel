
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Create Food Item')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a>
    <a class="breadcrumb-item" href="<?php echo e(route('food.management')); ?>"><?php echo e(__('Food Management')); ?></a>
    <a class="breadcrumb-item" href="<?php echo e(route('food.index')); ?>"><?php echo e(__('Food Item')); ?></a>
    <span class="breadcrumb-item active"><?php echo e(__('Create')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo Form::open(['route' => 'food.store', 'method' => 'POST']); ?>

    <div class="col-md-12 m-auto">
        <div class="card">
            <div class="card-header"><?php echo e(__('Create New Food Item')); ?> </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Category'))); ?>

                            <select name="category_id" id="category" class="form-control">
                                <option value="">Select</option>
                                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoryy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($categoryy->id); ?>"><?php echo e($categoryy->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Name'))); ?>

                            <?php echo Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Price'))); ?>

                            <?php echo Form::text('price', null, ['placeholder' => __('Price'), 'class' => 'form-control']); ?>

                        </div>
                    </div>
                </div>
                <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-primary', 'id' => 'submit'])); ?>

                <a class="btn btn-secondary" href="<?php echo e(route('food.index')); ?>"> <?php echo e(__('Back')); ?></a>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/food/food/create.blade.php ENDPATH**/ ?>