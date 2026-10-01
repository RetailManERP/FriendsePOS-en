<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="advance_followup_modal">

	<div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	        <div class="modal-header">
	            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	            </button>
	            <h4 class="modal-title" id="myModalLabel">
	                <?php echo app('translator')->get('crm::lang.add_advance_follow_up'); ?>
	            </h4>
	        </div>
	        <div class="modal-body">
	            <div class="row">
	            	<div class="col-md-12 text-center">
	            		<a href="<?php echo e(action([\Modules\Crm\Http\Controllers\ScheduleController::class, 'create']), false); ?>" class="btn btn-success">
			                <i class="fa fa-plus"></i> <?php echo app('translator')->get('crm::lang.add_onetime_follow_up'); ?>
			            </a>
			            <a href="<?php echo e(action([\Modules\Crm\Http\Controllers\ScheduleController::class, 'create']), false); ?>?is_recursive=true" class="btn btn-primary">
			                <i class="fa fa-plus"></i> <?php echo app('translator')->get('crm::lang.add_recursive_follow_up'); ?>
			            </a>
	            	</div>
	            </div>
	        </div>
	        <div class="modal-footer">
	            <button type="button" class="btn btn-default" data-bs-dismiss="modal">
	            <?php echo app('translator')->get('messages.close'); ?>
	            </button>
	        </div>
	    </div>
	</div>

</div>
