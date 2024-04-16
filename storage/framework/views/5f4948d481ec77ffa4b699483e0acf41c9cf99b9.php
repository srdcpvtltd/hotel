
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit City')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item"
        href="<?php echo e(route('cities.index')); ?>"><?php echo e(__('Cities')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Edit')); ?></span>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo Form::model($city, ['method' => 'PATCH', 'route' => ['cities.update', $city->id]]); ?>

    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header"><?php echo e(__('Edit City')); ?> </div>
            <div class="card-body">
                <div class="form-group">
                    <?php echo e(Form::label('name', __('Name'))); ?>

                    <?php echo Form::text('name', null, ['placeholder' => __('Name'),  'class' => 'form-control']); ?>

                </div>
                <div class="form-group">
                    <label>Country</label>
                    <select  class="form-select form-select-lg form-control select2" name="country_id" id="country_id">
                        <option value="" selected>Select country</option>
                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($country->id); ?>" <?php if( $selected_country_id== $country->id): ?> selected <?php endif; ?>><?php echo e($country->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>State</label>
                    <select  name="state_id" class="form-select form-select-lg form-control select2" id="state">
                        <option value="">Select State</option>
                        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($state->id); ?>" <?php if($selected_state_id == $state->id): ?> selected <?php endif; ?>><?php echo e($state->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>District</label>
                    <select name="district_id" class="form-select form-select-lg form-control select2" id="district">
                        <option value="">Select District</option>
                        <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($district->id); ?>" <?php if($selected_district_id == $district->id): ?> selected <?php endif; ?>><?php echo e($district->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-primary'])); ?>


                <a class="btn btn-secondary" href="<?php echo e(route('cities.index')); ?>"> <?php echo e(__('Back')); ?></a>
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
                url: "<?php echo e(route('getCities')); ?>?country_id=" + countryId,
                type: 'get',
                success: function(res) {
                    $('#state').html('<option value="">Select State</option>');
                    $.each(res, function(key, value) {
                        $('#state').append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    $('#city').html('<option value="">Select City</option>');
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/cities/edit.blade.php ENDPATH**/ ?>