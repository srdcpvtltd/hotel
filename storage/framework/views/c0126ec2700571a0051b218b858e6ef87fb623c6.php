
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Vendor Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item"
        href="<?php echo e(route('vendors.index')); ?>"><?php echo e(__('Vendor')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Show')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-md-12 m-auto">
        <div class="card">
            <div class="card-header"><?php echo e(__('Vendor Details')); ?> </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Category</th>
                            <td><?php echo e($Vendor->category->name); ?></td>
                            <th>Name</th>
                            <td><?php echo e($Vendor->name); ?></td>
                        </tr>
                        <tr>
                            <th>E-mail</th>
                            <td><?php echo e($Vendor->email); ?></td>
                            <th>Mobile No.</th>
                            <td><?php echo e($Vendor->mobile_no); ?></td>
                        </tr>
                        <tr>
                            <th>GST No.</th>
                            <td><?php echo e($Vendor->gst_no); ?></td>
                            <th>Contact Person Name</th>
                            <td><?php echo e($Vendor->contact_person_name); ?></td>
                        </tr>
                        <tr>
                            <th>Contact Person Email</th>
                            <td><?php echo e($Vendor->contact_person_email); ?></td>
                            <th>Contact Person Mobile</th>
                            <td><?php echo e($Vendor->contact_person_mobile); ?></td>
                        </tr>
                        <tr>
                            <th>Country</th>
                            <td><?php echo e($Vendor->country->name); ?></td>
                            <th>State</th>
                            <td><?php echo e($Vendor->state->name); ?></td>
                        </tr>
                        <tr>
                            <th>District</th>
                            <td><?php echo e($Vendor->district->name); ?></td>
                            <th>City</th>
                            <td><?php echo e($Vendor->city); ?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td colspan="3"><?php echo e($Vendor->address); ?></td>
                        </tr>

                    </tbody>
                </table>
                <a class="btn btn-secondary" href="<?php echo e(route('vendors.index')); ?>"> <?php echo e(__('Back')); ?></a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/vendors/vendor/show.blade.php ENDPATH**/ ?>