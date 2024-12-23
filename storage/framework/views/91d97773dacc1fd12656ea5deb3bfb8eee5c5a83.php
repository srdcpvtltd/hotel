
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item"
        href="<?php echo e(route('settings.index')); ?>"><?php echo e(__('Settings')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Email Setting')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Email Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php echo e(Form::open(['route' => 'settings.emails', 'method' => 'post'])); ?>

    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header"><?php echo e(__('Email Setting')); ?> </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('mail_driver', __('Mail Driver'), ['class' => 'form-control-label'])); ?>

                        <?php echo e(Form::text('mail_driver', env('MAIL_DRIVER'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Driver')])); ?>

                    </div>
                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('mail_host', __('Mail Host'), ['class' => 'form-control-label'])); ?>

                        <?php echo e(Form::text('mail_host', env('MAIL_HOST'), ['class' => 'form-control ', 'placeholder' => __('Enter Mail Driver')])); ?>

                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('mail_port', __('Mail Port'), ['class' => 'form-control-label'])); ?>

                        <?php echo e(Form::text('mail_port', env('MAIL_PORT'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Port')])); ?>

                    </div>
                    <div class="form-group col-md-6">

                        <?php echo e(Form::label('mail_username', __('Mail Username'), ['class' => 'form-control-label'])); ?>

                        <?php echo e(Form::text('mail_username', env('MAIL_USERNAME'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Username')])); ?>

                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">

                        <?php echo e(Form::label('mail_password', __('Mail Password'), ['class' => 'form-control-label'])); ?>


                        <?php echo e(Form::text('mail_password', env('MAIL_PASSWORD'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Password')])); ?>

                    </div>
                    <div class="form-group col-md-6">

                        <?php echo e(Form::label('mail_encryption', __('Mail Encryption'), ['class' => 'form-control-label'])); ?>

                        <?php echo e(Form::text('mail_encryption', env('MAIL_ENCRYPTION'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Encryption')])); ?>

                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">

                        <?php echo e(Form::label('mail_from_address', __('Mail From Address'), ['class' => 'form-control-label'])); ?>

                        <?php echo e(Form::text('mail_from_address', env('MAIL_FROM_ADDRESS'), ['class' => 'form-control', 'placeholder' => __('Enter Mail From Address')])); ?>

                    </div>
                    <div class="form-group col-md-6">

                        <?php echo e(Form::label('mail_from_name', __('Mail From Name'), ['class' => 'form-control-label'])); ?>

                        <?php echo e(Form::text('mail_from_name', env('MAIL_FROM_NAME'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Encryption')])); ?>

                    </div>
                </div>
                <div>

                    <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-primary '])); ?>

                    <a class="btn  btn-info" href="<?php echo e(route('test.mail' )); ?>"> <?php echo e(__('Send Test Mail')); ?></a>

                    <a class="btn btn-secondary" href="<?php echo e(route('settings.index')); ?>"> <?php echo e(__('Back')); ?></a>
                </div>
            </div>
        </div>
    </div>
    <?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>
    
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/settings/emailset.blade.php ENDPATH**/ ?>