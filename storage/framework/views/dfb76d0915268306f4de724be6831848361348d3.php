
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Staff Attendance')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Staff Attendance')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <?php echo $__env->make('layouts.datatables_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        .pt_10 {
            padding-top: 10px;
        }

        .pb_10 {
            padding-bottom: 10px;
        }

        .dgn {
            color: #a42121;
            font-size: 35px;
        }

        .bos_shadow {
            border: 0;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, .14), 0 3px 1px -2px rgba(0, 0, 0, .2), 0 1px 5px 0 rgba(0, 0, 0, .12);
        }

        .cntnr_height {
            height: 400px;
        }

        p {
            color: #000;
        }

        a {
            text-decoration: none !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><?php echo e(__('Staff Attendance')); ?></h4>
                        </div>
                        <div class="container cntnr_height">
                            <table id="table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Staff Name</th>
                                        <th>Designation</th>
                                        <th>Shift</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($key + 1); ?></td>
                                            <td><?php echo e($staff->name); ?></td>
                                            <td><?php echo e($staff->designation->designation); ?></td>
                                            <td><?php echo e($staff->shift); ?></td>
                                            <td colspan="2">
                                                <?php
                                                    $attendance = App\Models\StaffAttendance::where('hotel_staff_id',$staff->id,)
                                                        ->orderBy('id', 'DESC')
                                                        ->first();
                                                ?>
                                                <?php if(!empty($attendance)): ?>
                                                    <?php if($attendance->checkin && $attendance->checkout == ''): ?>
                                                        <h2 id="count_up_timer">00:00:00</h2>
                                                        <a href="<?php echo e(url('staff_checkout', $attendance->id)); ?>" id="STOP">
                                                            <span class="badge badge-danger" style="font-size: 100%;">Check
                                                                Out</span>
                                                        </a>
                                                    <?php elseif($attendance->checkout): ?>
                                                        <a href="<?php echo e(url('staff_checkin', $staff->id)); ?>" id="START">
                                                            <span class="badge badge-success" style="font-size: 100%;">Check
                                                                In</span>
                                                        </a>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                <a href="<?php echo e(url('staff_checkin', $staff->id)); ?>" id="START">
                                                    <span class="badge badge-success" style="font-size: 100%;">Check
                                                        In</span>
                                                </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script>
        // const startTimerElem = document.querySelector("#START");
        // const stopTimerElem = document.querySelector("#STOP");


        // const btnActive = () => {
        //     if (startTimerElem.disabled) {
        //         startTimerElem.disabled = false;
        //         stopTimerElem.disabled = true;
        //     } else {
        //         startTimerElem.disabled = true;
        //         stopTimerElem.disabled = false;
        //     }
        // };
        $('#START').on('click', function() {
            console.log('start');
            const countUpTimerResult = document.querySelector("#count_up_timer");
            let MyTimer;
            let totalSeconds = 0;
            MyTimer = setInterval(countUpTimer, 1000);
            // btnActive();
        });
        $('#STOP').on('click', function() {
            console.log('stop');
            clearInterval(MyTimer);
            // btnActive();
        });

        const countUpTimer = () => {
            totalSeconds++;
            var hour = Math.floor(totalSeconds / 3600);
            var minute = Math.floor((totalSeconds - hour * 3600) / 60);
            var seconds = totalSeconds - (hour * 3600 + minute * 60);

            if (hour < 10) hour = "0" + hour;
            if (minute < 10) minute = "0" + minute;
            if (seconds < 10) seconds = "0" + seconds; //
            countUpTimerResult.innerHTML = hour + ":" + minute + ":" + seconds;
        };
        // startTimerElem.addEventListener("click",
        //     startTimerHandler);
        // stopTimerElem.addEventListener("click", stopTimerHandler);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hotel\resources\views/system_management/attendance.blade.php ENDPATH**/ ?>