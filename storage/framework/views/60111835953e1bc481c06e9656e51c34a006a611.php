<?php
    $users = \Auth::user();
    $currantLang = $users->currentLanguage();
    $logo = asset('uploads/logo/');
    $checkIsHotelCreated = DB::table('hotel_profiles')->where('user_id', Auth::id())->first();
?>
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <img class="c-sidebar-brand-full"
            src="<?php echo e($logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : '/light_logo.png')); ?>"
            height="46" class="navbar-brand-img">
        <img class="c-sidebar-brand-minimized"
            src="<?php echo e($logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : '/small_logo.png')); ?>"
            height="46" class="navbar-brand-img">
    </div>
    <ul class="c-sidebar-nav ps ps--active-y">
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?php echo e(url('/dashboard')); ?>">
                <i class="cil-speedometer c-sidebar-nav-icon"></i> <?php echo e(__('Dashboard')); ?></a>
        </li>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage-user')): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(route('users.index')); ?>">
                    <i class="cil-user c-sidebar-nav-icon"></i><?php echo e(__('Users')); ?>

                </a>
            </li>
        <?php endif; ?>

        <?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(route('criminals.index')); ?>">
                    <i class="cil-user c-sidebar-nav-icon"></i><?php echo e(__('Criminals')); ?>

                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(route('admin.report')); ?>">
                    <i class="cil-user c-sidebar-nav-icon"></i><?php echo e(__('Report')); ?>

                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(route('admin.irregular_checkin')); ?>">
                    <i class="cil-user c-sidebar-nav-icon"></i><?php echo e(__('Irregular Check Ins ')); ?>

                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(route('admin.suspicious_checkins')); ?>">
                    <i class="cil-user c-sidebar-nav-icon"></i><?php echo e(__('Suspicicous Check Ins ')); ?>

                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(route('messages')); ?>">
                    <i class="cil-chat-bubble c-sidebar-nav-icon"></i><?php echo e(__('Messages ')); ?>

                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(route('admin.queries')); ?>">
                    <i class="cil-user c-sidebar-nav-icon"></i><?php echo e(__('Queries ')); ?>

                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(route('hotel_report.report')); ?>">
                    <i class="cil-user c-sidebar-nav-icon"></i><?php echo e(__('Hotel Report')); ?>

                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a href="<?php echo e(url('/notificationsettings')); ?>" class="c-sidebar-nav-link">
                    <i class="cil-user c-sidebar-nav-icon"></i><?php echo e(__('Notification Settings')); ?>

                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a href="<?php echo e(url('/countries')); ?>" class="c-sidebar-nav-link">
                    <i class="cil-user c-sidebar-nav-icon"></i><?php echo e(__('Countries')); ?>

                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a href="<?php echo e(url('/states')); ?>" class="c-sidebar-nav-link">
                    <i class="cil-user c-sidebar-nav-icon"></i><?php echo e(__('States')); ?>

                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a href="<?php echo e(url('/districts')); ?>" class="c-sidebar-nav-link">
                    <i class="cil-user c-sidebar-nav-icon"></i><?php echo e(__('District')); ?>

                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a href="<?php echo e(url('/cities')); ?>" class="c-sidebar-nav-link">
                    <i class="cil-user c-sidebar-nav-icon"></i><?php echo e(__('Cities')); ?>

                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a href="<?php echo e(url('/police_stations')); ?>" class="c-sidebar-nav-link">
                    <i class="cil-user c-sidebar-nav-icon"></i><?php echo e(__('Police Station')); ?>

                </a>
            </li>
        <?php endif; ?>
        <?php if(auth()->check() && auth()->user()->hasRole('viewer')): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(route('admin.report')); ?>">
                    <i class="cil-user c-sidebar-nav-icon"></i><?php echo e(__('Report')); ?>

                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(route('viewer_report.report')); ?>">
                    <i class="cil-user c-sidebar-nav-icon"></i><?php echo e(__('Hotel Report')); ?>

                </a>
            </li>
        <?php endif; ?>
        <?php if(auth()->check() && auth()->user()->hasRole('user')): ?>
            <?php if($checkIsHotelCreated && ($checkIsHotelCreated->city != null || $checkIsHotelCreated->police_station != null)): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show-Booking')): ?>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="<?php echo e(route('booking.index')); ?>">
                            <i class="cil-user c-sidebar-nav-icon"></i><?php echo e(__('Bookings')); ?>

                        </a>
                    </li>
                <?php endif; ?>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="<?php echo e(route('guest.create')); ?>">
                        <i class="cil-user c-sidebar-nav-icon"></i><?php echo e(__('Guest Check In')); ?>

                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="<?php echo e(route('guest.list')); ?>">
                        <i class="cil-user c-sidebar-nav-icon"></i><?php echo e(__('Guest Check Out')); ?>

                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="<?php echo e(route('messages')); ?>">
                        <i class="cil-user c-sidebar-nav-icon"></i><?php echo e(__('Messages ')); ?>

                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="<?php echo e(route('guest.queries')); ?>">
                        <i class="cil-user c-sidebar-nav-icon"></i><?php echo e(__('Queries ')); ?>

                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="<?php echo e(route('guest.report')); ?>">
                        <i class="cil-user c-sidebar-nav-icon"></i><?php echo e(__('Report')); ?>

                    </a>
                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show-System Management')): ?>
                    <li class="c-sidebar-nav-item">
                        <a href="<?php echo e(url('/system_management')); ?>" class="c-sidebar-nav-link">
                            <i class="cil-cog c-sidebar-nav-icon"></i><?php echo e(__('System Management')); ?>

                        </a>
                    </li>
                <?php endif; ?>
                
            <?php endif; ?>
        <?php endif; ?>
        
        <?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
        data-class="c-sidebar-minimized"></button>
</div>
<?php /**PATH C:\xampp\htdocs\hotel\resources\views/partial/nav-builder.blade.php ENDPATH**/ ?>