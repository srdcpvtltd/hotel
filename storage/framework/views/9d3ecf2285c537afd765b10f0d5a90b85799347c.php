
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit Expense')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item"
        href="<?php echo e(route('expenses.index')); ?>"><?php echo e(__('Expense')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Edit')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo Form::model($Expense, ['method' => 'PATCH', 'route' => ['expenses.update', $Expense->id]]); ?>

    <div class="col-md-12 m-auto">
        <div class="card">
            <div class="card-header"><?php echo e(__('Edit Expense')); ?> </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Category'))); ?>

                            <select name="category_id" id="category" class="form-control">
                                <option value="">Select</option>
                                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoryy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($categoryy->id); ?>" <?php echo e(($categoryy->id == $Expense->category_id) ? 'selected':''); ?>><?php echo e($categoryy->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Purchase Type'))); ?>

                            <select name="purchase_type" id="purchase_type" class="form-control">
                                <option value="">Select</option>
                                <option value="Local" <?php echo e(($Expense->purchase_type == "Local") ? 'selected':''); ?>>Local</option>
                                <option value="Vendor" <?php echo e(($Expense->purchase_type == "Vendor") ? 'selected':''); ?>>Vendor</option>
                            </select>
                        </div>
                    </div>
                    <?php if($Expense->vendor_id != 0): ?>
                    <div class="col-md-3" id="vendor">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Vendor'))); ?>

                            <select name="vendor_id" id="vendor_id" class="form-control">
                                <option value="">Select</option>
                                <?php $__currentLoopData = $vendor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendors): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($vendors->id); ?>" <?php echo e(($vendors->id == $Expense->vendor_id) ? 'selected':''); ?>><?php echo e($vendors->name); ?>

                                        (<?php echo e($vendors->category->name); ?>)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Title'))); ?>

                            <?php echo Form::text('title', null, ['placeholder' => __('Title'), 'class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Amount'))); ?>

                            <?php echo Form::text('amount', null, ['placeholder' => __('Amount'), 'class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Date'))); ?>

                            <?php echo Form::date('date', null, ['class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Remark'))); ?>

                            <?php echo Form::text('remark', null, ['placeholder' => __('Remark'), 'class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Payment Mode'))); ?>

                            <select name="payment_mode" id="payment_mode" class="form-control">
                                <option value="">Select</option>
                                <option value="Online" <?php echo e(($Expense->payment_mode == "Online") ? 'selected':''); ?>>Online</option>
                                <option value="Cash" <?php echo e(($Expense->payment_mode == "Cash") ? 'selected':''); ?>>Cash</option>
                                <option value="UPI" <?php echo e(($Expense->payment_mode == "UPI") ? 'selected':''); ?>>UPI</option>
                                <option value="Unpaid" <?php echo e(($Expense->payment_mode == "Unpaid") ? 'selected':''); ?>>Unpaid</option>
                            </select>
                        </div>
                    </div>
                </div>
                <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-primary', 'id' => 'submit'])); ?>

                <a class="btn btn-secondary" href="<?php echo e(route('expenses.index')); ?>"> <?php echo e(__('Back')); ?></a>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/expenses/expenses/edit.blade.php ENDPATH**/ ?>