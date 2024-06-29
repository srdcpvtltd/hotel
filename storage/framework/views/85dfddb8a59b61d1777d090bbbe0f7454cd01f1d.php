
<?php $__env->startSection('title'); ?>
    <?php echo e(__('System Management')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('System Management')); ?></span>
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
                            <h4><?php echo e(__('System Management')); ?></h4>
                        </div>
                        <div class="container cntnr_height">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3 mt-3 mb-3">
                                        <a href="<?php echo e(url('room_type')); ?>">
                                            <div class="border pt_10 pb_10 text-center align-middle bos_shadow">
                                                <p class="mb-0"><i class="cil-room dgn"></i></p>
                                                <p class="mb-0">Room Types</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-3 mt-3 mb-3">
                                        <a href="<?php echo e(url('price_rule')); ?>">
                                            <div class="border pt_10 pb_10 text-center align-middle bos_shadow">
                                                <p class="mb-0"><i class="cil-calculator dgn"></i></p>
                                                <p class="mb-0">Price Rules</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-3 mt-3 mb-3">
                                        <a href="<?php echo e(url('rooms')); ?>">
                                            <div class="border pt_10 pb_10 text-center align-middle bos_shadow">
                                                <p class="mb-0"><i class="cil-bed dgn"></i></p>
                                                <p class="mb-0">Rooms</p>
                                            </div>
                                        </a>
                                    </div>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show-Designation')): ?>
                                        <div class="col-md-3 mt-3 mb-3">
                                            <a href="<?php echo e(url('/designation')); ?>">
                                                <div class="border pt_10 pb_10 text-center align-middle bos_shadow">
                                                    <p class="mb-0"><i class="cil-cog c-sidebar-nav-icon dgn"></i></p>
                                                    <p class="mb-0"><?php echo e(__('Designation')); ?></p>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show-hotelstaff')): ?>
                                        <div class="col-md-3 mt-3 mb-3">
                                            <a href="<?php echo e(url('hotel_staff')); ?>">
                                                <div class="border pt_10 pb_10 text-center align-middle bos_shadow">
                                                    <p class="mb-0"><i class="cil-user c-sidebar-nav-icon dgn"></i></p>
                                                    <p class="mb-0"><?php echo e(__('Hotel Staff')); ?></p>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(auth()->check() && auth()->user()->hasRole('free')): ?>
                                        <?php
                                            $checkIsHotelCreated = DB::table('hotel_profiles')
                                                ->where('user_id', Auth::id())
                                                ->first();
                                        ?>
                                        <?php if($checkIsHotelCreated): ?>
                                            <div class="col-md-3 mt-3 mb-3">
                                                <a href="<?php echo e(asset(url('edit-hotel/' . $checkIsHotelCreated->id))); ?>">
                                                    <div class="border pt_10 pb_10 text-center align-middle bos_shadow">
                                                        <p class="mb-0"><i class="cil-building c-sidebar-nav-icon dgn"></i>
                                                        </p>
                                                        <p class="mb-0"><?php echo e(__('Edit Hotel')); ?></p>
                                                    </div>
                                                </a>
                                            </div>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            <div class="col-md-3 mt-3 mb-3">
                                                <a href="<?php echo e(asset(url('staff_attendance'))); ?>">
                                                    <div class="border pt_10 pb_10 text-center align-middle bos_shadow">
                                                        <p class="mb-0"><i class="cil-user c-sidebar-nav-icon dgn"></i>
                                                        </p>
                                                        <p class="mb-0"><?php echo e(__('Staff Attendance')); ?></p>
                                                    </div>
                                                </a>
                                            </div>
                                            <!-- <div class="col-md-3 mt-3 mb-3">
                                                <a href="">
                                                    <div class="border pt_10 pb_10 text-center align-middle bos_shadow">
                                                        <p class="mb-0"><i class="cil-fastfood dgn"></i></p>
                                                        <p class="mb-0">Menus / Services</p>
                                                    </div>
                                                </a>
                                            </div> -->
                                    <!-- <div class="col-md-3 mt-3 mb-3">
                                                <a href="">
                                                    <div class="border pt_10 pb_10 text-center align-middle bos_shadow">
                                                        <p class="mb-0"><i class="cil-user-follow dgn"></i></p>
                                                        <p class="mb-0">Secondary Accounts</p>
                                                    </div>
                                                </a>
                                            </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/system_management/index.blade.php ENDPATH**/ ?>