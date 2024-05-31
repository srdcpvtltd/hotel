
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Create Stocks')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a>
    <a class="breadcrumb-item" href="<?php echo e(route('stock_inventory')); ?>"><?php echo e(__('Stocks')); ?></a>
    <span class="breadcrumb-item active"><?php echo e(__('Create')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php echo Form::open(['route' => 'stock.store', 'method' => 'POST']); ?>

    <div class="col-md-12 m-auto">
        <div class="card">
            <div class="card-header">
                <?php echo e(__('Create New Stock')); ?>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Product Category'))); ?>

                            <select name="product_category_id" id="product_category_id" class="form-control">
                                <option value="">Select</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Product'))); ?>

                            <select name="product_id" id="product_id" class="form-control">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Stock'))); ?>

                            <select name="stock" id="stock" class="form-control">
                                <option value="">Select</option>
                                <option value="In">In</option>
                                <option value="Out">Out</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Quantity'))); ?>

                            <?php echo Form::text('quantity', null, ['placeholder' => __('Quantity'), 'class' => 'form-control']); ?>

                        </div>
                    </div>
                </div>
                <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-primary'])); ?>

                <a class="btn btn-secondary" href="<?php echo e(route('stock_inventory')); ?>"> <?php echo e(__('Back')); ?></a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Category</th>
                            <th>Product</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $stockIn = App\Models\Stock::where('hotel_id', $hotel->id)
                                    ->where('product_id', $product->id)
                                    ->where('stock', 'In')
                                    ->sum('quantity');

                                $stockOut = App\Models\Stock::where('hotel_id', $hotel->id)
                                    ->where('product_id', $product->id)
                                    ->where('stock', 'Out')
                                    ->sum('quantity');

                                $total = $stockIn - $stockOut;
                            ?>
                            <tr>
                                <td><?php echo e($key + 1); ?></td>
                                <td><?php echo e($product->category->name); ?></td>
                                <td><?php echo e($product->name); ?></td>
                                <td><?php echo e($total); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#product_category_id').on('change', function() {
                var ProductCategoryId = this.value;
                $.ajax({
                    url: "<?php echo e(route('getProduct')); ?>?ProductCategory_id=" + ProductCategoryId,
                    type: 'get',
                    success: function(res) {
                        $('#product_id').html('<option value="">Select</option>');
                        $.each(res, function(key, value) {
                            $('#product_id').append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/inventory/stock/create.blade.php ENDPATH**/ ?>