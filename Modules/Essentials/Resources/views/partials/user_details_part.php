<div class="clearfix"></div>
<hr style="margin-top: 10px;margin-bottom: 10px;">
<div class="col-md-12 col-xs-12">
	<h4><?php echo app('translator')->get('essentials::lang.hrm_details'); ?>:</h4>
</div>
<div class="col-md-6 col-xs-6">
	<p><strong><?php echo app('translator')->get('essentials::lang.appointment_date'); ?>:</strong> <?php if(!empty($user->essentials_appointment_date)): ?> <?php echo e(\Carbon::createFromTimestamp(strtotime($user->essentials_appointment_date))->format(session('business.date_format')), false); ?> <?php endif; ?></p>
	<p><strong><?php echo app('translator')->get('essentials::lang.department'); ?>:</strong> <?php echo e($user_department->name ?? '', false); ?></p>
	<p><strong><?php echo app('translator')->get('essentials::lang.sub_department'); ?>:</strong> <?php echo e($user_sub_department->name ?? '', false); ?></p>
	<p><strong><?php echo app('translator')->get('essentials::lang.designation'); ?>:</strong> <?php echo e($user_designstion->name ?? '', false); ?></p>
	<p><strong><?php echo app('translator')->get('essentials::lang.essentials_attendence_uid'); ?>:</strong> <?php echo e($user->essentials_attendence_uid ?? '', false); ?></p>
	<p><strong><?php echo app('translator')->get('essentials::lang.finger_enrolled'); ?>:</strong> <?php echo e(($user->essentials_attendence_finger) ? 'Yes' : 'No', false); ?></p>
	<p><strong><?php echo app('translator')->get('essentials::lang.face_enrolled'); ?>:</strong> <?php echo e(($user->essentials_attendence_face) ? 'Yes' : 'No', false); ?></p>
</div>
<div class="col-md-6 col-xs-6">
	<p>
		<strong><?php echo app('translator')->get('lang_v1.primary_work_location'); ?>:</strong>
		<?php if(!empty($work_location)): ?>
			<?php echo e($work_location->name, false); ?>

		<?php else: ?>
			<?php echo e(__('report.all_locations'), false); ?>

		<?php endif; ?>
	</p>

	<p>
		<strong><?php echo app('translator')->get('essentials::lang.salary'); ?>:</strong> 
		<?php if(!empty($user->essentials_salary) && !empty($user->essentials_pay_period)): ?>
			<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $user->essentials_salary, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> <?php echo app('translator')->get('essentials::lang.per'); ?>
			<?php if($user->essentials_pay_period == 'week'): ?>
				<?php echo e(__('essentials::lang.week'), false); ?>

			<?php else: ?>
				<?php echo e(__('lang_v1.'.$user->essentials_pay_period), false); ?>

			<?php endif; ?>
		<?php endif; ?>
	</p>

	<p>
		<strong><?php echo app('translator')->get('essentials::lang.pay_cycle'); ?>:</strong>
		<?php if(!empty($user->essentials_pay_period)): ?>
			<?php if($user->essentials_pay_period == 'week'): ?>
				<?php echo e(__('essentials::lang.week'), false); ?>

			<?php else: ?>
				<?php echo e(__('lang_v1.month'), false); ?>

			<?php endif; ?>
		<?php endif; ?>
	</p>

</div>
