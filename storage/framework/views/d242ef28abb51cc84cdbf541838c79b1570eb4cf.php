
<?php $__env->startSection('title'); ?>
<?php echo e(__('Edit Room')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item" href="<?php echo e(route('cities.index')); ?>"><?php echo e(__('Room')); ?></a><span class="breadcrumb-item active"><?php echo e(__('Edit')); ?></span>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<?php echo Form::model($room, ['method' => 'PATCH', 'route' => ['rooms.update', $room->id]]); ?>

<div class="col-md-4 m-auto">
    <div class="card">
        <div class="card-header"><?php echo e(__('Create New Room')); ?> </div>
        <div class="card-body">
            <div class="form-group">
                <?php echo e(Form::label('name', __('Room Name'))); ?>

                <?php echo Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control']); ?>

            </div>
            <div class="form-group">
                <?php echo e(Form::label('name', __('Room Type'))); ?>

                <select name="room_type_id" id="room_type_id" class="form-control">
                    <option value="">Select</option>
                    <?php $__currentLoopData = $room_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roomtype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($roomtype->id); ?>" <?php if($room->room_type_id == $roomtype->id): ?> selected <?php endif; ?>><?php echo e($roomtype->room_type); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('name', __('Price'))); ?>

                <?php echo Form::text('price', null, ['placeholder' => __('Price'),'id' => 'price', 'class' => 'form-control', 'readonly']); ?>

            </div>
            <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-primary','id' => 'submit'])); ?>

            <a class="btn btn-secondary" href="<?php echo e(route('rooms.index')); ?>"> <?php echo e(__('Back')); ?></a>
        </div>
    </div>
</div>
<?php echo Form::close(); ?>

<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#room_type_id').on('change', function() {
            var RoomTypeId = this.value;
            $('#price').html('');
            $.ajax({
                url: "<?php echo e(route('getPrice')); ?>?Roomtype_id=" + RoomTypeId,
                type: 'get',
                success: function(res) {
                    if(res == "No Price Rules Created"){
                        $('#price').val(res);
                        $('#submit').attr("disabled", true);
                    } else {
                        $('#price').val(res);
                        $('#submit').attr("disabled", false);
                    }
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/system_management/room/edit.blade.php ENDPATH**/ ?>