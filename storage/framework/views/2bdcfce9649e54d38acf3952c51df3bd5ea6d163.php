
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item"
        href="<?php echo e(route('settings.index')); ?>"><?php echo e(__('Settings')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Logo Change')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Logo Change')); ?>

<?php $__env->stopSection(); ?>
<?php
$logo = asset(Storage::url('uploads/logo/'));
?>
<?php $__env->startSection('content'); ?>
    <?php echo e(Form::model($settings, ['route' => 'settings.logo', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header"><?php echo e(__('App Settings')); ?></div>
            <div class="card-body">
                <div class="form-group">
                    <?php echo e(Form::label('name', __('Application Name'))); ?>



                    <input type="text" name="app_name" class="form-control" value="<?php echo e(config('app.name')); ?>">
                </div>
                <div class="form-group">

                    <?php echo e(Form::label('name', __('Dark Logo'))); ?> <div class="bg-light text-center">

                        <?php echo form::image($logo . '/dark_logo.png', null, ['class' => 'img img-responsive my-2 text-center']); ?>


                    </div>
                    <?php echo form::file('dark_logo', ['class' => 'form-control', 'accept' => 'image/png']); ?>


                </div>
                <div class="form-group">
                    <?php echo e(Form::label('name', __('Light Logo'))); ?>

                    <div class="bg-dark text-center">


                        <?php echo form::image($logo . '/light_logo.png', null, ['class' => 'img img-responsive my-2 text-center']); ?>

                    </div>
                    <?php echo form::file('light_logo', ['class' => 'form-control', 'accept' => 'image/png']); ?>


                </div>
                <div class="form-group">
                    <?php echo e(Form::label('name', __('Small Logo'))); ?>

                    <div class="bg-dark text-center">

                        <?php echo form::image($logo . '/small_logo.png', null, ['class' => 'img img-responsive my-2 text-center']); ?>


                    </div>
                    <?php echo form::file('small_logo', ['class' => 'form-control', 'accept' => 'image/png']); ?>


                </div>
                <div class="form-group">
                    <?php echo e(Form::label('name', __('Favicon'))); ?>

                    <div class="bg-light text-center">

                        <?php echo form::image($logo . '/favicon.png', null, ['class' => 'img img-responsive my-2 text-center']); ?>


                    </div>
                    <?php echo form::file('favicon', ['class' => 'form-control', 'accept' => 'image/png']); ?>


                </div>
                <div>
                    <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-primary '])); ?>


                    <a class="btn btn-secondary" href="<?php echo e(route('settings.index')); ?>"> <?php echo e(__('Back')); ?></a>
                </div>
            </div>
        </div>
    </div>
    <?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/settings/logo.blade.php ENDPATH**/ ?>