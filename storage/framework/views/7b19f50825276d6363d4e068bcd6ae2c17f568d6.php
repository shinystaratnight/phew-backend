<!-- Global stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="<?php echo e(asset('assets/global')); ?>/images/logos/fav.png" type="image/x-icon">
<link href="<?php echo e(asset('assets/global')); ?>/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
<link href="<?php echo e(asset('assets/global')); ?>/css/icons/icofont/icofont.min.css" rel="stylesheet" type="text/css">
<?php if(app()->getLocale() == 'ar'): ?>
    <link href="<?php echo e(asset('assets/RTL')); ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('assets/RTL')); ?>/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('assets/RTL')); ?>/css/layout.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('assets/RTL')); ?>/css/components.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('assets/RTL')); ?>/css/colors.min.css" rel="stylesheet" type="text/css">
<?php else: ?>
    <link href="<?php echo e(asset('assets/LTR')); ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('assets/LTR')); ?>/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('assets/LTR')); ?>/css/layout.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('assets/LTR')); ?>/css/components.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('assets/LTR')); ?>/css/colors.min.css" rel="stylesheet" type="text/css">
<?php endif; ?>

<link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
<style>
    body{
        font-family: 'Cairo', sans-serif;
    }
    .content{
        position: relative;
    }
    .loading-page{
        opacity: 0;
    }
    .loading{
        position: absolute;
        right: 15px;
        left: 15px;
        top: 15px;
        height: 480px;
        bottom: 15px;
        z-index: 3;
        background: #fff;
        text-align: center;
    }
</style>
<link href="<?php echo e(asset('assets/global')); ?>/css/clock.css" rel="stylesheet" type="text/css">
<!-- /global stylesheets --><?php /**PATH D:\Workspace\mohammed\phew-backend\resources\views/dashboard/parts/styles.blade.php ENDPATH**/ ?>