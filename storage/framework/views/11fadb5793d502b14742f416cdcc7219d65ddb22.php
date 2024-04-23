
<?php $__env->startSection('breadcrumb'); ?>
    <span class="breadcrumb-item active"><?php echo e(__('Send Query')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Send Query')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php echo Form::open(['route' => 'guest.store.query', 'method' => 'POST']); ?>

    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header"><?php echo e(__('Send Query')); ?> </div>
            <div class="card-body">
                <div class="form-group">
                    <?php echo e(__('Subject:')); ?>

                    <?php echo Form::text('subject', null, ['placeholder' => __('Subject'), 'class' => 'form-control']); ?>

                </div>
                <div class="form-group">
                    <?php echo e(__('Message:')); ?>

                    <?php echo Form::textarea('message', null, ['placeholder' => __('Message'), 'class' => 'form-control']); ?>

                </div>

                <div>
                    <?php echo e(Form::submit(__('Send'), ['class' => 'btn btn-primary '])); ?>

                </div>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/guest/report/create_query.blade.php ENDPATH**/ ?>