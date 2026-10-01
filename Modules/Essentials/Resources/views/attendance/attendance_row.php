<tr data-user_id="<?php echo e($user->id, false); ?>">
	<td>
		<?php echo e($user->user_full_name, false); ?>

	</td>
	<td>
		<?php if(empty($attendance->clock_in_time)): ?>
			<div class="input-group date">
				<?php echo Form::text('attendance[' . $user->id . '][clock_in_time]', null, ['class' => 'form-control date_time_picker', 'placeholder' => __( 'essentials::lang.clock_in_time' ), 'readonly', 'required' ]); ?>

				<span class="input-group-text"><i class="fas fa-clock"></i></span>
			</div>
		<?php else: ?>
			<?php echo format_datetime_br($attendance->clock_in_time); ?> <br>
			<small class="text-muted">(<?php echo app('translator')->get('essentials::lang.clocked_in'); ?> - <?php echo e(\Carbon::parse($attendance->clock_in_time)->diffForHumans(\Carbon::now()), false); ?>)</small>

			<?php echo Form::hidden('attendance[' . $user->id . '][id]', $attendance->id ); ?>

		<?php endif; ?>
	</td>
	<td>
		<div class="input-group date">
			<?php echo Form::text('attendance[' . $user->id . '][clock_out_time]', null , ['class' => 'form-control date_time_picker', 'placeholder' => __( 'essentials::lang.clock_out_time' ), 'readonly' ]); ?>

			<span class="input-group-text"><i class="fas fa-clock"></i></span>
		</div>
	</td>
	<td>
		<?php echo Form::select('attendance[' . $user->id . '][essentials_shift_id]', $shifts, !empty($attendance->essentials_shift_id) ? $attendance->essentials_shift_id : null, ['class' => 'form-control', 'placeholder' => __( 'messages.please_select' ) ]); ?>

	</td>
	<td>
		<?php echo Form::text('attendance[' . $user->id . '][ip_address]', !empty($attendance->ip_address) ? $attendance->ip_address : null, ['class' => 'form-control', 'placeholder' => __( 'essentials::lang.ip_address') ]); ?>

	</td>
	<td>
		<?php echo Form::textarea('attendance[' . $user->id . '][clock_in_note]', !empty($attendance->clock_in_note) ? $attendance->clock_in_note : null, ['class' => 'form-control', 'placeholder' => __( 'essentials::lang.clock_in_note'), 'rows' => 3 ]); ?>

	</td>
	<td>
		<?php echo Form::textarea('attendance[' . $user->id . '][clock_out_note]', !empty($attendance->clock_out_note) ? $attendance->clock_out_note : null, ['class' => 'form-control', 'placeholder' => __( 'essentials::lang.clock_out_note'), 'rows' => 3 ]); ?>

	</td>
	<td><button type="button" class="btn btn-xs btn-danger remove_attendance_row"><i class="fa fa-times"></i></button></td>
</tr>
