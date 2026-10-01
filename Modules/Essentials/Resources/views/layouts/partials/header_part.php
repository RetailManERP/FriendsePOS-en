<?php if($__is_essentials_enabled && $is_employee_allowed): ?>
	<li class="nav-item">
		<button 
			type="button" 
			class="nav-icon-btn clock_in_btn
			<?php if(!empty($clock_in)): ?>
				hide
			<?php endif; ?>
			"
			data-type="clock_in"
			data-bs-toggle="tooltip"
			data-bs-placement="bottom"
			title="<?php echo app('translator')->get('essentials::lang.clock_in'); ?>" 
			>
			<i class="fas fa-arrow-circle-down"></i>
		</button>
	</li>

	<li class="nav-item">
		<button 
			type="button" 
			class="nav-icon-btn clock_out_btn
			<?php if(empty($clock_in)): ?>
				hide
			<?php endif; ?>
			" 	
			data-type="clock_out"
			data-bs-toggle="tooltip"
			data-bs-placement="bottom"
			data-html="true"
			title="<?php echo app('translator')->get('essentials::lang.clock_out'); ?> <?php if(!empty($clock_in)): ?>
						<br>
						<small>
							<b><?php echo app('translator')->get('essentials::lang.clocked_in_at'); ?>:</b> <?php echo format_datetime_br($clock_in->clock_in_time); ?>

						</small>
						<br>
						<small><b><?php echo app('translator')->get('essentials::lang.shift'); ?>:</b> <?php echo e(ucfirst($clock_in->shift_name), false); ?></small>
						<?php if(!empty($clock_in->start_time) && !empty($clock_in->end_time)): ?>
							<br>
							<small>
								<b><?php echo app('translator')->get('restaurant.start_time'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($clock_in->start_time))->format('h:i A'), false); ?><br>
								<b><?php echo app('translator')->get('restaurant.end_time'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($clock_in->end_time))->format('h:i A'), false); ?>

							</small>
						<?php endif; ?>
					<?php endif; ?>" 
			>
			<i class="fas fa-hourglass-half fa-spin"></i>
		</button>
	</li>
<?php endif; ?>
