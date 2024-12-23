
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit Permission')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item"
        href="<?php echo e(route('permission.index')); ?>"><?php echo e(__('Permissions')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Edit')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php echo e(Form::model($permission, ['route' => ['permission.update', $permission->id], 'method' => 'PUT'])); ?>

    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header"><strong><?php echo e(__('Edit Permission')); ?>

                </strong> </div>
            <div class="card-body">
                <div class="form-group">
                    <strong> <?php echo e(Form::label('name', __('Name'))); ?> </strong>
                    <?php echo e(Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Permission Name')])); ?>

                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-name" role="alert">
                            <strong class="text-danger"><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <?php echo e(Form::submit(__('Update'), ['class' => 'btn btn-primary'])); ?>

                <a class="btn btn-secondary" href="<?php echo e(route('permission.index')); ?>"> <?php echo e(__('Back')); ?></a>
            </div>
            <div>
            </div>
        </div>
    </div>
    <?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/permission/edit.blade.php ENDPATH**/ ?>