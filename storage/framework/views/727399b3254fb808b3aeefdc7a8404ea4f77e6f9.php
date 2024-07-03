
<?php $__env->startSection('breadcrumb'); ?>
<span class="breadcrumb-item active"><?php echo e(__('Guest Detail')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e(__(' Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
<?php if(session()->has('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session()->get('success')); ?>

    </div>
    <?php endif; ?>
    <div class="fade-in guest-register">
        <div class="card">
            <div class="card-body">
                <form action="<?php echo e(asset(url('guest/filter'))); ?>" method="get">
                    <div class="form-row" style="margin-bottom: 15px;">
                        <div class="col">
                            <div class="form-grup">
                                <input placeholder="Enter Guest Name" name="guest_name" type="text" class="form-control"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-grup">
                                <input placeholder="Enter Guest Mobile Number" name="mobile_number" type="text" class="form-control"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-grup">
                                <input placeholder="Enter Email" name="email" type="text" class="form-control"/>
                            </div>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Guest Name</th>
                            <th scope="col">Mobile Number</th>
                            <th scope="col">Email</th>
                            <th scope="col">No of Rooms Booked</th>
                            <th scope="col">Arrival Date</th>
                            <th scope="col">Arrival Time</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th><?php echo e($booking->gues_name); ?></th>
                            <td><?php echo e($booking->mobile_number); ?></td>
                            <td><?php echo e($booking->email_id); ?></td>
                            <td><?php echo e($booking->room_booked); ?></td>
                            <td><?php echo e($booking->arrival_date); ?></td>
                            <td><?php echo e($booking->arrival_time); ?></td>
                            <td>
                                <a class="btn btn-primary btn-xs" href="<?php echo e(asset(url('/guest/detail/'.$booking->id))); ?>">Proceed to Check-Out</a>
                                <button class="btn btn-github btn-xs" data-toggle="modal" data-target="#quickView" onclick="open_quickView(<?php echo e($booking->id); ?>)"><i class="fa fa-eye"></i></button>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">
            <?php echo e($bookings->links()); ?>

        </div>
    </div>
</div>
<div class="modal fade" id="quickView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="h4 font-weight-400 float-left modal-title" id="exampleModalLabel"> View Guest Details </h4>
                <a href="#" class="more-text widget-text float-right close-icon" data-dismiss="modal" aria-label="Close">&times;</a>
            </div>
            <div class="modal-body">
                <div class="iframe-div">
                    <iframe></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery library -->

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>

<script>
    function open_quickView(id){
        $('.iframe-div').find('iframe').attr('src',"<?php echo e(url('/guest/quickinvoice/')); ?>/"+id);
    }

</script>


<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/guest/list.blade.php ENDPATH**/ ?>