<?php
$lang = \App\Facades\UtilityFacades::getValByName('default_language');
?>

<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item"
        href="<?php echo e(route('settings.index')); ?>"><?php echo e(__('Settings')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('General Setting')); ?></span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    <?php echo e(__('General Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php echo e(Form::open(['route' => 'settings.datetime', 'method' => 'post'])); ?>

    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header"><strong><?php echo e(__('General Setting')); ?></strong> </div>
            <div class="card-body">
                <div class="form-group ">
                    <?php echo e(Form::label('two_factor_authentication', __('Two Factor Authentication'), ['class' => 'form-control-label text-dark'])); ?>

                    <select type="text" name="authentication" class="form-control select2" id="authentication">
                        <option value="activate" <?php if(@$settings['authentication'] == 'activate'): ?> selected="selected" <?php endif; ?>><?php echo e(__('Activate')); ?></option>
                        <option value="deactivate" <?php if(@$settings['authentication'] == 'deactivate'): ?> selected="selected" <?php endif; ?>><?php echo e(__('Deactivate')); ?></option>
                    </select>
                    <?php if(!extension_loaded('imagick')): ?>
                        <small>
                            <?php echo e(__('Note: for 2FA your server must have Imagick.')); ?> <a
                                href="https://www.php.net/manual/en/book.imagick.php"
                                target="_new"><?php echo e(__('Imagick Document')); ?></a>
                        </small>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('timezone', __('Timezone'), ['class' => 'form-control-label text-dark'])); ?>

                    <select type="text" name="timezone" class="form-control select2" id="timezone">
                        <option value=""><?php echo e(__('Select Timezone')); ?></option>
                        <?php $__currentLoopData = $timezones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $timezone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($k); ?>" <?php echo e(env('TIMEZONE') == $k ? 'selected' : ''); ?>>
                                <?php echo e($timezone); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group ">
                    <?php echo e(Form::label('default_language', __('Date Format'), ['class' => 'form-control-label text-dark'])); ?>

                    <select type="text" name="site_date_format" class="form-control select2" id="site_date_format">
                        <option value="M j, Y" <?php if(@$settings['site_date_format'] == 'M j, Y'): ?> selected="selected" <?php endif; ?>>Jan 1,2015</option>
                        <option value="d-m-Y" <?php if(@$settings['site_date_format'] == 'd-m-Y'): ?> selected="selected" <?php endif; ?>>d-m-y</option>
                        <option value="m-d-Y" <?php if(@$settings['site_date_format'] == 'm-d-Y'): ?> selected="selected" <?php endif; ?>>m-d-y</option>
                        <option value="Y-m-d" <?php if(@$settings['site_date_format'] == 'Y-m-d'): ?> selected="selected" <?php endif; ?>>y-m-d</option>
                    </select>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('default_language', __('Default Language'), ['class' => 'form-control-label'])); ?>

                    <div class="changeLanguage">
                        <select name="default_language" id="default_language" class="form-control select2">
                            <?php $__currentLoopData = \App\Facades\UtilityFacades::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php if($lang == $language): ?> selected <?php endif; ?> value="<?php echo e($language); ?>"><?php echo e(Str::upper($language)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('SITE_RTL', __('RTL'), ['class' => 'form-control-label'])); ?>

                    <div class="">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="SITE_RTL" id="SITE_RTL"
                                <?php echo e(env('SITE_RTL') == 'on' ? 'checked="checked"' : ''); ?>>
                            <label class="custom-control-label form-control-label" for="SITE_RTL"></label>
                        </div>
                    </div>
                </div>
                <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-primary '])); ?>


                <a class="btn btn-secondary" href="<?php echo e(route('settings.index')); ?>"> <?php echo e(__('Back')); ?></a>
            </div>
        </div>
    </div>
    <?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/settings/datetime.blade.php ENDPATH**/ ?>