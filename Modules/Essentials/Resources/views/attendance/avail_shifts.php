<?php if(count($available_shifts) > 0): ?>
	<h4><?php echo app('translator')->get('essentials::lang.your_shifts'); ?>:</h4>
	<?php $__currentLoopData = $available_shifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $available_shift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<table class="table table-striped text-center table-th-skin">
			<caption>
				<?php echo e(ucFirst($available_shift->name), false); ?> (<code><?php echo app('translator')->get('essentials::lang.'.$available_shift->type); ?></code>)
			</caption>
			<thead>
				<tr>
					<th>
						<?php echo app('translator')->get('essentials::lang.start_date'); ?>
					</th>
					<th>
						<?php echo app('translator')->get('essentials::lang.end_date'); ?>
					</th>
					<?php if($available_shift->type == 'fixed_shift'): ?>
						<th>
							<?php echo app('translator')->get('essentials::lang.timing'); ?>
						</th>
					<?php endif; ?>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<?php echo e(\Carbon::createFromTimestamp(strtotime($available_shift->start_date))->format(session('business.date_format')), false); ?>

					</td>
					<td>
						<?php echo e(\Carbon::createFromTimestamp(strtotime($available_shift->end_date))->format(session('business.date_format')), false); ?>

					</td>
					<?php if($available_shift->type == 'fixed_shift'): ?>
						<td>
							<?php echo e(\Carbon::createFromTimestamp(strtotime($available_shift->start_time))->format('h:i A'), false); ?> - <?php echo e(\Carbon::createFromTimestamp(strtotime($available_shift->end_time))->format('h:i A'), false); ?>

						</td>
					<?php endif; ?>
				</tr>
			</tbody>
		</table>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
