
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit Vendor')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item"
        href="<?php echo e(route('vendors.index')); ?>"><?php echo e(__('Vendor')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Edit')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo Form::model($Vendor, ['method' => 'PATCH', 'route' => ['vendors.update', $Vendor->id]]); ?>

    <div class="col-md-12 m-auto">
        <div class="card">
            <div class="card-header"><?php echo e(__('Edit Vendor')); ?> </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Category'))); ?>

                            <select name="category_id" id="category" class="form-control">
                                <option value="">Select</option>
                                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoryy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($categoryy->id); ?>"
                                        <?php echo e($categoryy->id == $Vendor->category_id ? 'selected' : ''); ?>>
                                        <?php echo e($categoryy->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Name'))); ?>

                            <?php echo Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Email'))); ?>

                            <?php echo Form::text('email', null, ['placeholder' => __('Email'), 'class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Mobile No.'))); ?>

                            <?php echo Form::text('mobile_no', null, ['placeholder' => __('Mobile No.'), 'class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Address'))); ?>

                            <?php echo Form::text('address', null, ['placeholder' => __('Address'), 'class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Country'))); ?>

                            <select name="country_id" id="country" class="form-control">
                                <option value="">Select</option>
                                <?php $__currentLoopData = $country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countryy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($countryy->id); ?>"
                                        <?php echo e($countryy->id == $Vendor->country_id ? 'selected' : ''); ?>>
                                        <?php echo e($countryy->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('State'))); ?>

                            <select name="state_id" id="state" class="form-control">
                                <option value="">Select</option>
                                <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($state->id); ?>" <?php echo e(($state->id == $Vendor->state_id) ? 'selected':''); ?>><?php echo e($state->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('District'))); ?>

                            <select name="district_id" id="district" class="form-control">
                                <option value="">Select</option>
                                <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($district->id); ?>" <?php echo e(($district->id == $Vendor->district_id) ? 'selected':''); ?>><?php echo e($district->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('City'))); ?>

                            <?php echo Form::text('city', null, ['placeholder' => __('City'), 'class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('GST No.'))); ?>

                            <?php echo Form::text('gst_no', null, ['placeholder' => __('GST No.'), 'class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Contact Person Name'))); ?>

                            <?php echo Form::text('contact_person_name', null, [
                                'placeholder' => __('Contact Person Name'),
                                'class' => 'form-control',
                            ]); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Contact Person Mobile'))); ?>

                            <?php echo Form::text('contact_person_mobile', null, [
                                'placeholder' => __('Contact Person Mobile No.'),
                                'class' => 'form-control',
                            ]); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Contact Person Email'))); ?>

                            <?php echo Form::text('contact_person_email', null, [
                                'placeholder' => __('Contact Person Email'),
                                'class' => 'form-control',
                            ]); ?>

                        </div>
                    </div>
                </div>
                <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-primary', 'id' => 'submit'])); ?>

                <a class="btn btn-secondary" href="<?php echo e(route('vendors.index')); ?>"> <?php echo e(__('Back')); ?></a>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script>
        $('#country').on('change', function() {
            var countryId = $(this).val();
            $.ajax({
                url: "<?php echo e(route('getStates')); ?>?country_id=" + countryId,
                type: 'get',
                success: function(res) {
                    $('#state').html('<option value="">Select State</option>');
                    $.each(res, function(key, value) {
                        $('#state').append('<option value="' + value.id + '">' +
                            value.name + '</option>');
                    });
                }
            });
        });
        $('#state').on('change', function() {
            var stateId = $(this).val();
            $.ajax({
                url: "<?php echo e(route('getDistricts')); ?>?state_id=" + stateId,
                type: 'get',
                success: function(res) {
                    $('#district').html('<option value="">Select District</option>');
                    $.each(res, function(key, value) {
                        $('#district').append('<option value="' + value.id + '">' +
                            value.name + '</option>');
                    });
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/vendors/vendor/edit.blade.php ENDPATH**/ ?>