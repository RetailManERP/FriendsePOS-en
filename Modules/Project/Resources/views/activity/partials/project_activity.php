<table class="table table-hover">
	<caption>
		<?php echo app('translator')->get('project::lang.updated_values'); ?>
	</caption>
    <thead>
    	<tr>
    		<th class="col-md-2">
    			<?php echo app('translator')->get('project::lang.field'); ?>
    		</th>
    		<th class="col-md-5">
    			<?php echo app('translator')->get('project::lang.old_value'); ?>
    		</th>
    		<th class="col-md-5">
    			<?php echo app('translator')->get('project::lang.new_value'); ?>
    		</th>
        </tr>
    </thead>
    <tbody>
    	<?php $__currentLoopData = $activity->properties['attributes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    	<tr>
    		<?php if($key == 'name' || $key == 'start_date' || $key == 'end_date' || $key == 'status' || $key == 'description'): ?>
				<td>
					<?php echo e($label [$key], false); ?>

				</td>
				<td>
					<?php if($key == 'name' || $key == 'description'): ?>

						<?php echo $activity->properties['old'][$key]; ?>


					<?php elseif($key == 'start_date' || $key == 'end_date'): ?>

						<?php echo e(\Carbon::createFromTimestamp(strtotime($activity->properties['old'][$key]))->format(session('business.date_format')), false); ?>


					<?php elseif($key == 'status'): ?>

						<?php echo e($status_and_priority[$activity->properties['old'][$key]], false); ?>


					<?php endif; ?>
				</td>
				<td>
					<?php if($key == 'name' || $key == 'description'): ?>

						<?php echo $value; ?>


					<?php elseif($key == 'start_date' || $key == 'end_date'): ?>

						<?php echo e(\Carbon::createFromTimestamp(strtotime($value))->format(session('business.date_format')), false); ?>


					<?php elseif($key == 'status'): ?>
					
						<?php echo e($status_and_priority[$value], false); ?>


					<?php endif; ?>
				</td>
			<?php endif; ?>
		</tr>	
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>