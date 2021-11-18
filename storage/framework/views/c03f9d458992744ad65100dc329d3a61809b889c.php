<?php $__env->startSection('file_scripts'); ?>
	<script src="<?php echo e(asset('assets/global')); ?>/js/plugins/forms/styling/uniform.min.js"></script>	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_scripts'); ?>
	<script src="<?php echo e(asset('assets/global')); ?>/js/demo_pages/login.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="content d-flex justify-content-center align-items-center">
	<!-- Login card -->
	<form class="login-form" method="post" action="<?php echo e(route('dashboard.post_login')); ?>">
		<?php echo e(csrf_field()); ?>

		<div class="card mb-0">			
			<div class="card-body">
				<?php $__empty_1 = true; $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
					<div class="alert alert-danger alert-styled-left alert-arrow-left alert-dismissible">
						<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
						<?php echo e($message); ?>

					</div> 
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
				<?php endif; ?>
				<?php if(session('message') && session('class') ): ?>
					<div class="alert alert-<?php echo e(session('class')); ?> alert-styled-left alert-arrow-left alert-dismissible">
						<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
						<?php echo e(session('message')); ?>

					</div>
				<?php endif; ?>
				<div class="text-center mb-3">
					<div class="icon-object border-slate-300 text-slate-300"><img src="<?php echo e(asset('assets/global')); ?>/images/logos/logo-icon.png" style="width: 60px; height: 60px"></div>
					<h5 class="mb-0"><?php echo e(trans('dash.auth.login')); ?></h5>
					<span class="d-block text-muted"><?php echo e(settings('dashboard_name_' . app()->getLocale())); ?></span>
				</div>
				<div class="form-group form-group-feedback form-group-feedback-left">
					<input type="email" class="form-control" placeholder="<?php echo e(trans('dash.auth.email')); ?>" name="username" required="required">
					<div class="form-control-feedback">
						<i class="icon-user text-muted"></i>
					</div>
				</div>
				<div class="form-group form-group-feedback form-group-feedback-left">
					<input type="password" class="form-control" placeholder="<?php echo e(trans('dash.auth.password')); ?>" name="password" required="required">
					<div class="form-control-feedback">
						<i class="icon-lock2 text-muted"></i>
					</div>
				</div>
				<div class="form-group d-flex align-items-center">
					<div class="form-check mb-0">
						<label class="form-check-label">
							<input type="checkbox" name="remember" class="form-input-styled" checked data-fouc> <?php echo e(trans('dash.auth.remember_me')); ?>

						</label>
					</div>
					<a href="<?php echo e(route('password.reset')); ?>" class="ml-auto"><?php echo e(trans('dash.auth.forgot_password')); ?></a>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block"><?php echo e(trans('dash.auth.login')); ?>

						<i class="<?php echo e(app()->getLocale() == 'ar' ? 'icon-circle-left2' : 'icon-circle-right2'); ?> ml-2"></i>
					</button>
				</div>				
			</div>
		</div>
	</form>
	<!-- /login card -->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.auth_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Workspace\mohammed\phew-backend\resources\views/dashboard/auth/login.blade.php ENDPATH**/ ?>