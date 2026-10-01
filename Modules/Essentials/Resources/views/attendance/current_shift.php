<?php if(!empty($shift_info)): ?>
	<h4>
		<?php echo e(ucfirst($shift_info->name), false); ?>

		<small>
			(
				<code>
					<?php echo app('translator')->get('essentials::lang.'.$shift_info->type); ?>
				</code>
			)
		</small>
	</h4>
	<?php if($shift_info->type == 'fixed_shift'): ?>
		<b><?php echo app('translator')->get('restaurant.start_time'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($shift_info->start_time))->format('h:i A'), false); ?> 
		<br>
		<b><?php echo app('translator')->get('restaurant.end_time'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($shift_info->end_time))->format('h:i A'), false); ?>

	<?php endif; ?>
<?php endif; ?>
