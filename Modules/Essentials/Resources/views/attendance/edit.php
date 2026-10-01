<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\Modules\Essentials\Http\Controllers\AttendanceController::class, 'update'], [$attendance->id]), 'method' => 'put', 'id' => 'attendance_form' ]); ?>


    <?php echo Form::hidden('employees', $attendance->employee->id, ['id' => 'employees']); ?>

    <?php echo Form::hidden('attendance_id', $attendance->id, ['id' => 'attendance_id']); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'essentials::lang.edit_attendance' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
    	<div class="row">
    		<div class="form-group col-md-12">
    			<strong><?php echo app('translator')->get('essentials::lang.employees'); ?>: </strong> <?php echo e($attendance->employee->user_full_name, false); ?>

    		</div>
    		<div class="form-group col-md-6">
	        	<?php echo Form::label('clock_in_time', __( 'essentials::lang.clock_in_time' ) . ':*'); ?>

	        	<div class="input-group date">
	        		<?php echo Form::text('clock_in_time', \Carbon::createFromTimestamp(strtotime($attendance->clock_in_time))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'placeholder' => __( 'essentials::lang.clock_in_time' ), 'readonly', 'required' ]); ?>

	        		<span class="input-group-text"><i class="fas fa-clock"></i></span>
	        	</div>
	      	</div>
	      	<div class="form-group col-md-6">
	        	<?php echo Form::label('clock_out_time', __( 'essentials::lang.clock_out_time' ) . ':'); ?>

	        	<div class="input-group date">
	        		<?php echo Form::text('clock_out_time', !empty($attendance->clock_out_time) ? \Carbon::createFromTimestamp(strtotime($attendance->clock_out_time))->format(session('business.date_format') . ' ' . 'h:i A') : null, ['class' => 'form-control', 'placeholder' => __( 'essentials::lang.clock_out_time' ), 'readonly' ]); ?>

	        		<span class="input-group-text"><i class="fas fa-clock"></i></span>
	        	</div>
	      	</div>
	      	<div class="form-group col-md-6">
	        	<?php echo Form::label('ip_address', __( 'essentials::lang.ip_address' ) . ':'); ?>

	        	<?php echo Form::text('ip_address', $attendance->ip_address, ['class' => 'form-control', 'placeholder' => __( 'essentials::lang.ip_address') ]); ?>

	      	</div>
			<div class="form-group col-md-6">
	        	<?php echo Form::label('essentials_shift_id', __( 'essentials::lang.shift' ) . ':'); ?>

	        	<?php echo Form::select('essentials_shift_id', $shifts, !empty($attendance->essentials_shift_id) ? $attendance->essentials_shift_id : null, ['class' => 'form-control', 'placeholder' => __( 'messages.please_select' ) ]); ?>

	      	</div>
	      	<div class="form-group col-md-12">
              <?php echo Form::label('clock_in_note', __( 'essentials::lang.clock_in_note' ) . ':'); ?>

              <?php echo Form::textarea('clock_in_note', $attendance->clock_in_note, ['class' => 'form-control', 'placeholder' => __( 'essentials::lang.clock_in_note'), 'rows' => 3 ]); ?>

            </div>
            <div class="form-group col-md-12">
              <?php echo Form::label('clock_out_note', __( 'essentials::lang.clock_out_note' ) . ':'); ?>

              <?php echo Form::textarea('clock_out_note', $attendance->clock_out_note, ['class' => 'form-control', 'placeholder' => __( 'essentials::lang.clock_out_note'), 'rows' => 3 ]); ?>

            </div>
    	</div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.update' ); ?></button>
      <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
