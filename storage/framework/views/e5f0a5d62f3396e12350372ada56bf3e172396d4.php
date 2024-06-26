
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Expense Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item"
        href="<?php echo e(route('expenses.index')); ?>"><?php echo e(__('Expense')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Show')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-md-12 m-auto">
        <div class="card">
            <div class="card-header"><?php echo e(__('Expense Details')); ?> </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Category</th>
                            <td><?php echo e($Expense->category->name); ?></td>
                            <th>Purchase Type</th>
                            <td><?php echo e($Expense->purchase_type); ?></td>
                        </tr>
                        <tr>
                            <?php if($Expense->vendor_id != 0): ?>
                                <th>Vendor</th>
                                <td><?php echo e($Expense->vendor->name); ?></td>
                            <?php endif; ?>
                            <th>Title</th>
                            <td><?php echo e($Expense->title); ?></td>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td><?php echo e($Expense->amount); ?>/-</td>
                            <th>Date</th>
                            <td><?php echo e($Expense->date); ?></td>
                        </tr>
                        <tr>
                            <th>Remark</th>
                            <td><?php echo e($Expense->remark); ?></td>
                            <th>Payment Mode</th>
                            <td><?php echo e($Expense->payment_mode); ?></td>
                        </tr>
                    </tbody>
                </table>
                <a class="btn btn-secondary" href="<?php echo e(route('expenses.index')); ?>"> <?php echo e(__('Back')); ?></a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/expenses/expenses/show.blade.php ENDPATH**/ ?>