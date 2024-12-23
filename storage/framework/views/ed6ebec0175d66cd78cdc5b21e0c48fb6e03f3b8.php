
<?php $__env->startSection('breadcrumb'); ?>
    <span class="breadcrumb-item active"><?php echo e(__('Queries')); ?></span>
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
        <div class="d-flex justify-content-between mb-2">
            <a href="<?php echo e(route('guest.create.query')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Send Query</a>
        </div>
        <div class="fade-in guest-register">
            <div class="card">
                <div class="card-body">
                    <div class="table-wrapper">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Message</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $queries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $query): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td scope="col"><?php echo e($query->datetime); ?></td>
                                    <td scope="col"><?php echo e($query->subject); ?></td>
                                    <td scope="col"><?php echo e($query->message); ?></td>
                                    <td scope="col">
                                        <?php if($query->status): ?> Resolved <?php else: ?> Pending <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <?php echo e($queries->links()); ?>

            </div>

        </div>
    </div>
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script type="text/javascript">
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
    <style>
        .disabled {
            pointer-events: none;
            cursor: default;
            opacity: .6;
        }
    </style>


<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>

        $(document).on('click', '#resolve', function (e) {
            let id = $(this).attr('data-id');
            $.ajax({
                type: 'get',
                url: 'resolve/' + id,
                success: function(data) {
                    let element = $("a[data-id='" + data +"']")
                    element.css('cursor','default');
                    element.css('opacity',.6);
                    element.css('pointerEvents', 'none');
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/guest/report/sent_queries.blade.php ENDPATH**/ ?>