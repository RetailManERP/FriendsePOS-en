<option value=""><?php echo app('translator')->get("messages.please_select"); ?></option>
<?php if(!empty($models)): ?>
	<?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<option value="<?php echo e($key, false); ?>"><?php echo e($value, false); ?></option>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
