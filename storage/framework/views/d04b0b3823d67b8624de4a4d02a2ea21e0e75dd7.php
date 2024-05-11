
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Create Designation')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item"
        href="<?php echo e(route('designation.index')); ?>"><?php echo e(__('Designation')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Create')); ?></span>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php echo Form::open(['route' => 'designation.store', 'method' => 'POST']); ?>

    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header"><?php echo e(__('Create New Designation')); ?> </div>
            <div class="card-body">
                <div class="form-group">
                    <?php echo e(Form::label('name', __('Designation'))); ?>

                    <?php echo Form::text('designation', null, ['placeholder' => __('Enter Designation'),  'class' => 'form-control']); ?>

                </div>
                <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-primary'])); ?>


                <a class="btn btn-secondary" href="<?php echo e(route('districts.index')); ?>"> <?php echo e(__('Back')); ?></a>
            </div>
            <div>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#country').on('change', function() {
            var countryId = this.value;
            $('#state').html('');
            $.ajax({
                url: "<?php echo e(route('getStates')); ?>?country_id=" + countryId,
                type: 'get',
                success: function(res) {
                    $('#state').html('<option value="">Select State</option>');
                    $.each(res, function(key, value) {
                        $('#state').append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    $('#district').html('<option value="">Select District</option>');
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/designation/create.blade.php ENDPATH**/ ?>