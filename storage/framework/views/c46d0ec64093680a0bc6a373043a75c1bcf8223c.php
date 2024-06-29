
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Food Management')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Food Management')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <?php echo $__env->make('layouts.datatables_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        .pt_10 {
            padding-top: 10px;
        }

        .pb_10 {
            padding-bottom: 10px;
        }

        .dgn {
            color: #a42121;
            font-size: 35px;
        }

        .bos_shadow {
            border: 0;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, .14), 0 3px 1px -2px rgba(0, 0, 0, .2), 0 1px 5px 0 rgba(0, 0, 0, .12);
        }

        .cntnr_height {
            height: 400px;
        }

        p {
            color: #000;
        }

        a {
            text-decoration: none !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><?php echo e(__('Food Management')); ?></h4>
                        </div>
                        <div class="container cntnr_height">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3 mt-3 mb-3">
                                        <a href="<?php echo e(route('food_category.index')); ?>">
                                            <div class="border pt_10 pb_10 text-center align-middle bos_shadow">
                                                <p class="mb-0"><i class="cil-applications dgn"></i></p>
                                                <p class="mb-0">Category</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-3 mt-3 mb-3">
                                        <a href="<?php echo e(route('food.index')); ?>">
                                            <div class="border pt_10 pb_10 text-center align-middle bos_shadow">
                                                <p class="mb-0"><i class="cil-people dgn"></i></p>
                                                <p class="mb-0">Food</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/food/index.blade.php ENDPATH**/ ?>