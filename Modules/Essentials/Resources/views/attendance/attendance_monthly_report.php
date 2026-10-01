<style type="text/css">
.collapse-tr {
    display: none;
}

.bg-info {
	background-color: #d1ecf1 !important; /* Light blue */
	color: #0c5460 !important;
}
.bg-danger {
	background-color: #f8d7da !important; /* Light red */
	color: #721c24 !important;
}
</style>
<div class="filters hide" style="display:inline-block">
	<h2>Monthly Attendance Report</h2>
	<b>Month: </b> <?php echo e($month, false); ?> <b>Year: </b><?php echo e($year, false); ?> <?php if(!empty($employee)): ?> <b>Employee: </b> -- <?php echo e($employee['surname'].' '. $employee['first_name'] .' '. $employee['last_name'], false); ?> <?php endif; ?>
	<br>
</div>
<div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="attendance_monthly_table" style="width: 100%;">
	<thead>
		<tr>
			<th><?php echo app('translator')->get('user.user_id'); ?></th>
			<th><?php echo app('translator')->get('essentials::lang.employee'); ?></th>
			<th>#</th>
			<th><?php echo app('translator')->get( 'lang_v1.date' ); ?></th>
			<th><?php echo app('translator')->get('essentials::lang.clock_in'); ?></th>
			<th><?php echo app('translator')->get('essentials::lang.clock_out'); ?></th>
			<th><?php echo app('translator')->get('essentials::lang.work_duration'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php $__empty_18 = true; $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
			<tr class="bg-gray toggle-tr" style="cursor: pointer;" data-atten-tr-class="atten_<?php echo e($e['employee_id'], false); ?>">
				<td><?php echo e($e['employee_id'], false); ?>

					<br><span class="collapse-icon collapsed">
						<i class="fas fa-arrow-circle-right"></i>
					</span>
				</td>
				<td><b><?php echo e($e['name'], false); ?></b><br><?php echo e('	'.$e['designation'], false); ?></td>
				<td colspan="5"></td>
			</tr>
			<?php $__currentLoopData = $e['attendances']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr class="collapse-tr atten_<?php echo e($e['employee_id'], false); ?> <?php if(in_array($a['day'], $off_days)): ?> bg-info  <?php elseif(empty($a['clock_in_time'])): ?> bg-danger <?php endif; ?>">
					<?php if(in_array($a['day'], $off_days)): ?>
						<td colspan="2"></td>
						<td><b><?php echo e($loop->index+1, false); ?></b></td>
						<td><b><?php echo e($a['date'], false); ?> (<?php echo e($a['date_day'], false); ?>)</b></td>
						<td><b><?php echo e($a['clock_in_time'], false); ?></b></td>
						<td><b><?php echo e($a['clock_out_time'], false); ?></b></td>
						<td><b><?php echo e($a['work_duration'], false); ?></b></td>
					<?php else: ?>
						<td colspan="2"></td>
						<td><?php echo e($loop->index+1, false); ?></td>
						<td><?php echo e($a['date'], false); ?> (<?php echo e($a['date_day'], false); ?>)</td>
						<td><?php echo e($a['clock_in_time'], false); ?></td>
						<td><?php echo e($a['clock_out_time'], false); ?></td>
						<td><?php echo e($a['work_duration'], false); ?></td>
					<?php endif; ?>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
			<tr class="text-center">
				<td colspan="7">No Records Found</td>
			</tr>
		<?php endif; ?>
	</tbody>
</table>
</div>
<div class="row no-print">
	<div class="col-md-1 col-md-offset-11">
		<button type="button"  id="print_atten_monthly_report" class="btn btn-success pull-right"><i class="fa fa-print"></i> Print</button>
	</div>
</div>
