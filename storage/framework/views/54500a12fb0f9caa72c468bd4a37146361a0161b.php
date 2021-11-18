<!DOCTYPE html>
<html lang="en" dir="<?php echo e(app()->getLocale() == 'ar' ? 'rtl' : 'ltr'); ?>">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo e(settings('dashboard_name_' . app()->getLocale())); ?></title>

	<?php echo $__env->make('dashboard.parts.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->yieldContent('style'); ?>
	<?php echo $__env->make('dashboard.parts.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>	
	
</head>
<body class="bg-slate-800" style="background-image: url(<?php echo e(asset('assets/global')); ?>/images/backgrounds/user_bg1.png); background-position: center; background-size: cover; background-repeat: no-repeat;">
	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">
			<!-- Content area -->
			<?php echo $__env->yieldContent('content'); ?>
			<!-- /content area -->
		</div>
		<!-- /main content -->
	</div>
	<!-- /page content -->
</body>
</html><?php /**PATH D:\Workspace\mohammed\phew-backend\resources\views/dashboard/auth_layout.blade.php ENDPATH**/ ?>