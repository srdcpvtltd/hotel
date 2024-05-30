<div class="btn-group">
    <button class="btn btn-secondary" type="button"><?php echo e(__('Action')); ?></button>
    <button class="btn btn-secondary dropdown-toggle dropdown-toggle-split" type="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false"><span class="sr-only">Toggle Dropdown</span></button>
    <div class="dropdown-menu" x-placement="bottom-start">
        <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-expanded="false"><i
                class="fas fa-ellipsis-h"></i></a>
        <a href="<?php echo e(route('product_category.edit', $product_category->id)); ?>" class=" dropdown-item"><i
                class="cil-pencil action-btn"></i>
            <?php echo e(__('Edit')); ?></a>
        <div class="dropdown-divider"></div>
        <a href="<?php echo e(route('product_category.index')); ?>" class="dropdown-item  text-danger" data-toggle="tooltip"
            data-original-title="<?php echo e(__('Delete')); ?>" onclick="delete_record('delete-form-<?php echo e($product_category->id); ?>')"><i
                class="cil-trash action-btn"></i><?php echo e(__('Delete')); ?></a>
        <?php echo Form::open([
            'method' => 'DELETE',
            'route' => ['product_category.destroy', $product_category->id],
            'id' => 'delete-form-' . $product_category->id,
        ]); ?>

        <?php echo Form::close(); ?>

    </div>
</div>
<?php /**PATH C:\xampp\htdocs\hotel\resources\views/inventory/product_category/action.blade.php ENDPATH**/ ?>