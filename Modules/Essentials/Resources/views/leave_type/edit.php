<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\Modules\Essentials\Http\Controllers\EssentialsLeaveTypeController::class, 'update'], [$leave_type->id]), 'method' => 'put', 'id' => 'edit_leave_type_form' ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'essentials::lang.edit_leave_type' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
      	<div class="form-group">
        	<?php echo Form::label('leave_type', __( 'essentials::lang.leave_type' ) . ':*'); ?>

          	<?php echo Form::text('leave_type', $leave_type->leave_type, ['class' => 'form-control', 'required', 'placeholder' => __( 'essentials::lang.leave_type' ) ]); ?>

      	</div>

      	<div class="form-group">
        	<?php echo Form::label('max_leave_count', __( 'essentials::lang.max_leave_count' ) . ':'); ?>

          	<?php echo Form::number('max_leave_count', $leave_type->max_leave_count, ['class' => 'form-control', 'placeholder' => __( 'essentials::lang.max_leave_count' ) ]); ?>

      	</div>

        <div class="form-group">
            <strong><?php echo app('translator')->get('essentials::lang.leave_count_interval'); ?></strong><br>
            <label class="radio-inline">
              <?php echo Form::radio('leave_count_interval', 'month', $leave_type->leave_count_interval == 'month'); ?> <?php echo app('translator')->get('essentials::lang.current_month'); ?>
            </label>
            <label class="radio-inline">
              <?php echo Form::radio('leave_count_interval', 'year', $leave_type->leave_count_interval == 'year'); ?> <?php echo app('translator')->get('essentials::lang.current_fy'); ?>
            </label>
            <label class="radio-inline">
              <?php echo Form::radio('leave_count_interval', null, empty($leave_type->leave_count_interval)); ?> <?php echo app('translator')->get('lang_v1.none'); ?>
            </label>
        </div>
    </div>

    <div class="modal-footer">
      	<button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.update' ); ?></button>
      	<button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
