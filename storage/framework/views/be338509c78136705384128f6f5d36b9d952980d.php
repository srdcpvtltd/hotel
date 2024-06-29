<div class="btn-group">
    <button class="btn btn-secondary" type="button"><?php echo e(__('Action')); ?></button>
    <button class="btn btn-secondary dropdown-toggle dropdown-toggle-split" type="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false"><span class="sr-only">Toggle Dropdown</span></button>
    <div class="dropdown-menu" x-placement="bottom-start">
        <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-expanded="false"><i
                class="fas fa-ellipsis-h"></i></a>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show-expense')): ?>
            <a href="<?php echo e(route('expenses.show', $expense->id)); ?>" class="dropdown-item"><i class="cil-eye action-btn"></i>
                <?php echo e(__('Show')); ?></a>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-expense')): ?>
            <a href="<?php echo e(route('expenses.edit', $expense->id)); ?>" class="dropdown-item"><i class="cil-pencil action-btn"></i>
                <?php echo e(__('Edit')); ?></a>
        <?php endif; ?>

        <div class="dropdown-divider"></div>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-expense')): ?>
            <a href="<?php echo e(route('expenses.index')); ?>" class="dropdown-item  text-danger" data-toggle="tooltip"
                data-original-title="<?php echo e(__('Delete')); ?>" onclick="delete_record('delete-form-<?php echo e($expense->id); ?>')"><i
                    class="cil-trash action-btn"></i><?php echo e(__('Delete')); ?></a>
            <?php echo Form::open([
                'method' => 'DELETE',
                'route' => ['expenses.destroy', $expense->id],
                'id' => 'delete-form-' . $expense->id,
            ]); ?>

            <?php echo Form::close(); ?>

        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\hotel\resources\views/expenses/expenses/action.blade.php ENDPATH**/ ?>