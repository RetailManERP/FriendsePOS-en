<?php $__empty_18 = true; $__currentLoopData = $attendance_by_date; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
<tr>
	<td><?php echo e(\Carbon::createFromTimestamp(strtotime($data['date']))->format(session('business.date_format')), false); ?></td>
	<td><?php echo e($data['present'], false); ?></td>
	<td><?php echo e($data['absent'], false); ?></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
	<tr>
		<td colspan="3" class="text-center"><?php echo app('translator')->get('essentials::lang.no_data_found'); ?></td>
	</tr>
<?php endif; ?>
