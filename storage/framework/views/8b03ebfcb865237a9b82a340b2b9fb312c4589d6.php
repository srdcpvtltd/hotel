
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit Expense')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item"
        href="<?php echo e(route('salary.index')); ?>"><?php echo e(__('Expense')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Edit')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo Form::model($salary, ['method' => 'PATCH', 'route' => ['salary.update', $salary->id]]); ?>

    <div class="col-md-12 m-auto">
        <div class="card">
            <div class="card-header"><?php echo e(__('Edit Expense')); ?> </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Staff'))); ?>

                            <select name="staff_id" id="staff_id" class="form-control">
                                <option value="">Select</option>salary
                                <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staffs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($staffs->id); ?>" <?php echo e(($staffs->id == $salary->vendor_id) ? 'selected':''); ?>><?php echo e($staffs->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Salary'))); ?>

                            <?php echo Form::text('salary', $salary->amount, ['placeholder' => __('Salary'), 'class' => 'form-control']); ?>

                        </div>
                    </div>
                </div>
                <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-primary', 'id' => 'submit'])); ?>

                <a class="btn btn-secondary" href="<?php echo e(route('salary.index')); ?>"> <?php echo e(__('Back')); ?></a>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/expenses/salary/edit.blade.php ENDPATH**/ ?>