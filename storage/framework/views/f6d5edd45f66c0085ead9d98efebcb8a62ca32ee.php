<?php $__env->startSection('title'); ?>
<?php echo e(__('Reset Password')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"><?php echo e(__('Reset Password')); ?></div>

                    <div class="card-body">
                        <?php if(session('status')): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo e(session('status')); ?>

                            </div>
                        <?php endif; ?>

                        <?php echo e(Form::open(['route' => 'password.email', 'method' => 'post'])); ?>


                        <div class="form-group">
                            <?php echo e(Form::label('email', __('E-Mail Address'), ['class' => ' col-form-label'])); ?>

                            <?php echo e(Form::text('email', null, ['class' => 'form-control'])); ?>

                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-email text-danger" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>

                            <?php echo e(Form::submit(__('Send Password Reset Link'), ['class' => 'btn btn-primary '])); ?>


                        </div>
                        <?php echo e(Form::close()); ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u475147066/domains/saraiodisha.in/public_html/resources/views/auth/passwords/email.blade.php ENDPATH**/ ?>