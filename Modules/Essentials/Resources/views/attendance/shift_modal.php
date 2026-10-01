<div class="modal-dialog" role="document">
  	<div class="modal-content">
  		<?php echo Form::open(['url' => empty($shift) ? action([\Modules\Essentials\Http\Controllers\ShiftController::class, 'store']) : action([\Modules\Essentials\Http\Controllers\ShiftController::class, 'update'], [$shift->id]), 'method' => empty($shift) ? 'post' : 'put', 'id' => 'add_shift_form' ]); ?>

  		<div class="modal-header">
	      	<h4 class="modal-title"><?php echo app('translator')->get( 'essentials::lang.add_shift' ); ?></h4>
	      	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	    </div>
	    <div class="modal-body">
	    	<div class="form-group">
	        	<?php echo Form::label('name', __( 'user.name' ) . ':*'); ?>

	        	<?php echo Form::text('name', !empty($shift->name) ? $shift->name : null, ['class' => 'form-control', 'placeholder' => __( 'user.name'), 'required']); ?>

	      	</div>
	      	<div class="form-group">
	        	<?php echo Form::label('type', __('essentials::lang.shift_type') . ':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('essentials::lang.shift_type_tooltip') . '"></i>';
                }
            ?>
	        	<?php echo Form::select('type', ['fixed_shift' => __('essentials::lang.fixed_shift'), 'flexible_shift' => __('essentials::lang.flexible_shift')],  !empty($shift->type) ? $shift->type : null, ['class' => 'form-control select2', 'required', 'id' => 'shift_type']); ?>

	      	</div>
	      	<div class="form-group time_div">
	        	<?php echo Form::label('start_time', __( 'restaurant.start_time' ) . ':*'); ?>

	        	<div class="input-group date">
	        		<?php echo Form::text('start_time', !empty($shift->start_time) ? \Carbon::createFromTimestamp(strtotime($shift->start_time))->format('h:i A') : null, ['class' => 'form-control', 'placeholder' => __( 'restaurant.start_time' ), 'readonly', 'required' ]); ?>

	        		<span class="input-group-text"><i class="fas fa-clock"></i></span>
	        	</div>
	      	</div>
	      	<div class="form-group time_div">
	        	<?php echo Form::label('end_time', __( 'restaurant.end_time' ) . ':*'); ?>

	        	<div class="input-group date">
	        		<?php echo Form::text('end_time', !empty($shift->end_time) ? \Carbon::createFromTimestamp(strtotime($shift->end_time))->format('h:i A') : null, ['class' => 'form-control', 'placeholder' => __( 'restaurant.end_time' ), 'readonly', 'required']); ?>

	        		<span class="input-group-text"><i class="fas fa-clock"></i></span>
	        	</div>
	      	</div>
	      	<div class="form-group">
	        	<?php echo Form::label('holidays', __( 'essentials::lang.holiday' ) . ':'); ?>

	        	<?php echo Form::select('holidays[]', $days,  !empty($shift->holidays) ? $shift->holidays : null, ['class' => 'form-control select2', 'multiple' ]); ?>

	      	</div>
			<div class="form-group">
	        	<?php echo Form::label('weeks', __( 'essentials::lang.weeks' ) . ':'); ?>

	        	<?php echo Form::select('weeks[]', $weeks,  !empty($shift->weeks) ? $shift->weeks : null, ['class' => 'form-control select2', 'multiple' ]); ?>

	      	</div>
			<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label class="form-check-label">
<?php echo Form::checkbox('is_allowed_auto_clockout', 1, !empty($shift->is_allowed_auto_clockout) ? 1 : 0, ['id' => 'is_allowed_auto_clockout']); ?>

						<?php echo app('translator')->get('essentials::lang.allow_auto_clockout'); ?>
					</label>
					<?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('essentials::lang.allow_auto_clockout_tooltip') . '"></i>';
                }
            ?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="form-check-label">
<?php echo Form::checkbox('count_overtime', 1, !empty($shift->count_overtime) ? 1 : 0, ['id' => 'count_overtime']); ?>

						<?php echo app('translator')->get('essentials::lang.count_overtime'); ?>
					</label>
					<?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('essentials::lang.count_overtime_tooltip') . '"></i>';
                }
            ?>
				</div>
			</div>
			</div><!-- /.row -->
			<div class="clearfix"></div>
    		<div class="form-group enable_auto_clock_out_time" style="display: none;">
    			<?php echo Form::label('auto_clockout_time', __( 'essentials::lang.auto_clockout_time' ) . ':*'); ?>

	        	<div class="input-group date">
	        		<?php echo Form::text('auto_clockout_time', !empty($shift->auto_clockout_time) ? \Carbon::createFromTimestamp(strtotime($shift->auto_clockout_time))->format('h:i A') : null, ['class' => 'form-control', 'placeholder' => __( 'essentials::lang.auto_clockout_time' ), 'readonly', 'required']); ?>

	        		<span class="input-group-text"><i class="fas fa-clock"></i></span>
	        	</div>
    		</div>
	    </div>
	    <div class="modal-footer">
	      	<button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.submit' ); ?></button>
	      	<button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
	    </div>
	    <?php echo Form::close(); ?>

  	</div>
</div>
