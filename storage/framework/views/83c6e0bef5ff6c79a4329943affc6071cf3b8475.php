<?php
use App\Facades\UtilityFacades;
$logo = asset(Storage::url('uploads/logo/'));
$company_favicon = UtilityFacades::getValByName('company_favicon');
?>
<!DOCTYPE html>
<html lang="en" lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>"
    dir="<?php echo e(env('SITE_RTL') == 'on' ? 'rtl' : ''); ?>">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo $__env->yieldContent('title'); ?> | <?php echo e(config('app.name')); ?></title>
    <link href="<?php echo e(asset('css/free.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
    <link rel="icon" href="<?php echo e($logo . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png')); ?>" type="image" sizes="16x16">
    <?php if(env('SITE_RTL') == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-rtl.css')); ?>">
        <link rel="manifest" href="<?php echo e(asset('assets/favicon/manifest.json')); ?>">
    <?php endif; ?>
    <link href="<?php echo e(asset('css/toastr.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/coreui-chartjs.css')); ?>" rel="stylesheet">
</head>

<body class="c-app flex-row align-items-center">

    <?php echo $__env->yieldContent('content'); ?>

    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/toastr.min.js')); ?>"></script>
    <?php if(Session::has('message')): ?>
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("<?php echo e(session('message')); ?>");
        </script>
    <?php endif; ?>
    <?php if(Session::has('errors')): ?>
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("<?php echo e(session('errors')->first()); ?>");
        </script>
    <?php endif; ?>
    <?php if(Session::has('error')): ?>
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("<?php echo e(session('error')); ?>");
        </script>
    <?php endif; ?>
    <?php if(Session::has('info')): ?>
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("<?php echo e(session('info')); ?>");
        </script>
    <?php endif; ?>
    <?php if(Session::has('warning')): ?>
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("<?php echo e(session('warning')); ?>");
        </script>
    <?php endif; ?>
    <?php echo $__env->yieldContent('javascript'); ?>

</body>

</html>
<?php /**PATH /home/u475147066/domains/saraiodisha.in/public_html/resources/views/layouts/auth.blade.php ENDPATH**/ ?>