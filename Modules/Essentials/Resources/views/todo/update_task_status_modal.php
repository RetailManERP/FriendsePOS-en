<div class="modal fade" id="update_task_status_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
  		<div class="modal-content">
  			<div class="modal-header">
		      	<h4 class="modal-title"><?php echo app('translator')->get( 'essentials::lang.change_status' ); ?></h4>
		      	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		    </div>
		    <div class="modal-body">
	  			<div class="form-group">
					<?php echo Form::label('updated_status', __('sale.status') . ':'); ?>

					<?php echo Form::select('status', $task_statuses, null, ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;', 'id' => 'updated_status']); ?>

					<?php echo Form::hidden('task_id', null, ['id' => 'task_id']); ?>

				</div>
  			</div>
  			<div class="modal-footer">
		      	<button type="button" class="btn btn-primary" id="update_status_btn"><?php echo app('translator')->get( 'messages.update' ); ?></button>
		      	<button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
		    </div>
  		</div>
  	</div>
</div>
