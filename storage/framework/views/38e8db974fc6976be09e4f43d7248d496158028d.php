
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Create Order')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item"
        href="<?php echo e(route('order.index')); ?>"><?php echo e(__('Order')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Create')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo Form::open(['route' => 'order.store', 'method' => 'POST']); ?>

    <div class="col-md-12 m-auto">
        <div class="card">
            <div class="card-header"><?php echo e(__('Create New Order')); ?> </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Room</label>
                            <select class="form-select form-select-lg form-control select2" name="room_id" id="room_id">
                                <option value="">Select</option>
                                <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($room->id); ?>"><?php echo e($room->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Food Category</label>
                            <select class="form-select form-select-lg form-control select2" name="food_category_id"
                                id="food_category_id">
                                <option value="">Select</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Food Item</label>
                            <select class="form-select form-select-lg form-control select2" name="food_id" id="food_id">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Price'))); ?>

                            <?php echo Form::text('price', null, [
                                'placeholder' => __('Price'),
                                'class' => 'form-control',
                                'id' => 'price',
                                'readonly',
                            ]); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Quantity'))); ?>

                            <?php echo Form::text('quantity', null, [
                                'placeholder' => __('Quantity'),
                                'class' => 'form-control',
                                'id' => 'quantity',
                            ]); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Total Price'))); ?>

                            <?php echo Form::text('total_price', null, [
                                'placeholder' => __('Total Price'),
                                'class' => 'form-control',
                                'id' => 'total_price',
                                'readonly'
                            ]); ?>

                        </div>
                    </div>
                </div>

                <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-primary'])); ?>


                <a class="btn btn-secondary" href="<?php echo e(route('order.index')); ?>"> <?php echo e(__('Back')); ?></a>
            </div>
            <div>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            $('#food_category_id').on('change', function() {
                var categoryId = $(this).val();
                $('#food_id').html('');
                $.ajax({
                    url: "<?php echo e(route('getFood')); ?>?category_id=" + categoryId,
                    type: 'get',
                    success: function(res) {
                        $('#food_id').html('<option value="">Select Food</option>');
                        $.each(res, function(key, value) {
                            $('#food_id').append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
            $('#food_id').on('change', function() {
                var foodId = $(this).val();
                $.ajax({
                    url: "<?php echo e(route('getFoodPrice')); ?>?food_id=" + foodId,
                    type: 'get',
                    success: function(res) {
                        console.log(res);
                        $('#price').val(res.price);
                    }
                });
            });
            $('#quantity').on('keyup', function() {
                var qnt = $(this).val();
                var price = $('#price').val();
                var tot = price * qnt;
                console.log(tot);
                $('#total_price').val(tot);
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/order/create.blade.php ENDPATH**/ ?>