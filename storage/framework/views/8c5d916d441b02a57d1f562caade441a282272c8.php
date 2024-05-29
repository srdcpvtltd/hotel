
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Create Plan')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item"
        href="<?php echo e(route('plans.index')); ?>"><?php echo e(__('Plan')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Create')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo Form::open(['route' => 'plans.store', 'method' => 'POST']); ?>

    <div class="col-md-10 m-auto">
        <div class="card">
            <div class="card-header"><?php echo e(__('Create New Plan')); ?> </div>
            <div class="card-body">
                <div class="form-group">
                    <?php echo e(Form::label('name', __('Name'))); ?>

                    <?php echo Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control']); ?>

                </div>
                <div class="form-group">
                    <?php echo e(Form::label('name', __('Price'))); ?>

                    <?php echo Form::text('price', null, ['placeholder' => __('Price'), 'class' => 'form-control']); ?>

                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" name="role_id" id="role">
                        <option value="">Select Role</option>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($role->name != 'admin' && $role->name != 'user' && $role->name != 'viewer' && $role->name != 'free'): ?>
                                <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('name', __('Modules'))); ?>

                    <textarea name="modules" id="modules" class="form-control" cols="30" rows="10"></textarea>

                </div>
                <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-primary'])); ?>


                <a class="btn btn-secondary" href="<?php echo e(route('plans.index')); ?>"> <?php echo e(__('Back')); ?></a>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.3/tinymce.min.js"></script>

    <script>
        tinymce.init({
            selector: '#modules',

            height: 200,
            setup: function(editor) {
                editor.on('init change', function() {
                    editor.save();
                });
            },

            directionality: 'ltr',
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/plan/create.blade.php ENDPATH**/ ?>