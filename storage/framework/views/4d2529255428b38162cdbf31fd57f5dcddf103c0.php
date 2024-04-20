

<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item"
        href="<?php echo e(route('users.index')); ?>"><?php echo e(__('User')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Edit')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit User')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id]]); ?>

    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header"><strong><?php echo e(__('Edit User')); ?></strong> </div>
            <div class="card-body">
                <div class="form-group">
                    <strong><?php echo e(__('Name:')); ?></strong>
                    <?php echo Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control']); ?>

                </div>
                <div class="form-group">
                    <strong><?php echo e(__('Email:')); ?></strong>
                    <?php echo Form::text('email', null, ['placeholder' => __('Email'), 'class' => 'form-control']); ?>

                </div>
                <div class="form-group ">
                    <strong><?php echo e(__('Role:')); ?></strong>
                    <?php echo Form::select('roles', $roles, $userRole, ['class' => 'form-control']); ?>

                </div>
                <div class="form-group ">
                    <strong><?php echo e(__('Password:')); ?> <small style="color:red;">Leave it blank if you don't want to change</small></strong>
                    <?php echo Form::password('password', ['placeholder' => __('Password'), 'type' => '', 'class' => 'form-control']); ?>

                </div>
                <div>
                    <?php echo e(Form::submit(__('Update Permission'), ['class' => 'btn btn-primary '])); ?>


                    <a class="btn btn-secondary" href="<?php echo e(route('users.index')); ?>"> <?php echo e(__('Back')); ?></a>
                </div>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/users/edit.blade.php ENDPATH**/ ?>