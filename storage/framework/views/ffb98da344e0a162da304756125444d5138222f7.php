
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Settings')); ?></span>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-6 col-lg-4">
                    <div class="card">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="bg-warning p-3 mr-3">
                                <svg class="c-icon c-icon-xl">
                                    <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
                                </svg>
                            </div>
                            <div>
                                <div class="text-value text-warning"><?php echo e(__('LOGO SETTINGS')); ?></div>
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2"><a
                                class="btn-block text-muted d-flex justify-content-between align-items-center"
                                href="<?php echo e(route('getlogo')); ?>"><span
                                    class="small font-weight-bold"><?php echo e(__('View Settings')); ?></span>
                                <svg class="c-icon">
                                    <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-chevron-right"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4">
                    <div class="card">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="bg-primary p-3 mr-3">
                                <svg class="c-icon c-icon-xl">
                                    <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-settings"></use>
                                </svg>
                            </div>
                            <div>
                                <div class="text-value text-primary"><?php echo e(__('EMAIL SETTINGS')); ?></div>
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2"><a
                                class="btn-block text-muted d-flex justify-content-between align-items-center"
                                href="<?php echo e(route('settings.getmail')); ?>"><span
                                    class="small font-weight-bold"><?php echo e(__('View Settings')); ?></span>
                                <svg class="c-icon">
                                    <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-chevron-right"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4">
                    <div class="card">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="bg-info p-3 mr-3">
                                <svg class="c-icon c-icon-xl">
                                    <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-clock"></use>
                                </svg>
                            </div>
                            <div>
                                <div class="text-value text-info"><?php echo e(__('GENERAL SETTINGS')); ?></div>
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2"><a href="<?php echo e(route('datetime')); ?>"
                                class="btn-block text-muted d-flex justify-content-between align-items-center"><span
                                    class="small font-weight-bold"><?php echo e(__('View Settings')); ?></span>
                                <svg class="c-icon">
                                    <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-chevron-right"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->yieldContent('content'); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/settings/setting.blade.php ENDPATH**/ ?>