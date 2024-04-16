<div class="btn-group">
    <button class="btn btn-secondary" type="button"><?php echo e(__('Action')); ?></button>
    <button class="btn btn-secondary dropdown-toggle dropdown-toggle-split" type="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
            class="sr-only">Toggle Dropdown</span></button>
    <div class="dropdown-menu" x-placement="bottom-start">
        <a href="#" class="action-item" role="button" data-toggle="dropdown"
            aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-module')): ?>
            <a href="<?php echo e(route('police_stations.edit', $police_station->id)); ?>" class=" dropdown-item"><i
                    class="cil-pencil action-btn"></i>
                <?php echo e(__('Edit')); ?></a>
        <?php endif; ?>
        <div class="dropdown-divider"></div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-module')): ?>
            <a href="<?php echo e(route('police_stations.index')); ?>" class="dropdown-item  text-danger"
                data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>"
                onclick="delete_record('delete-form-<?php echo e($police_station->id); ?>')"><i
                    class="cil-trash action-btn"></i><?php echo e(__('Delete')); ?></a>
            <?php echo Form::open(['method' => 'DELETE', 'route' => ['police_stations.destroy', $police_station->id], 'id' => 'delete-form-' . $police_station->id]); ?>

            <?php echo Form::close(); ?>

        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\hotel\resources\views/police_stations/action.blade.php ENDPATH**/ ?>