<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document" style="height: 80vh;">
  <div class="modal-content" style="height: 100%;">

    <?php echo Form::open(['url' => action([\Modules\Essentials\Http\Controllers\AttendanceController::class, 'store']), 'method' => 'post', 'id' => 'attendance_form', 'style' => 'display: flex; flex-direction: column; height: 100%;' ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'essentials::lang.add_latest_attendance' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body attendance-modal-body" style="flex: 1 1 auto; overflow: visible;">
    	<div class="row">
    		<div class="form-group col-md-12">
		        <?php echo Form::label('employee', __('essentials::lang.select_employee') . ':'); ?>

		        <?php echo Form::select('employee', $employees, null, ['class' => 'form-control select2', 'style' => 'width: 100%;', 'id' => 'select_employee', 'placeholder' => __('essentials::lang.select_employee') ]); ?>

    		</div>
			<div class="table-responsive attendance-table-responsive">
    			<table class="table table-th-skin" id="employee_attendance_table">
    				<thead>
    					<th width="10%"><?php echo app('translator')->get('essentials::lang.employee'); ?></th>
    					<th width="15%"><?php echo app('translator')->get('essentials::lang.clock_in_time'); ?></th>
    					<th width="15%"><?php echo app('translator')->get('essentials::lang.clock_out_time'); ?></th>
    					<th width="15%"><?php echo app('translator')->get('essentials::lang.shift'); ?></th>
    					<th width="12%"><?php echo app('translator')->get('essentials::lang.ip_address'); ?></th>
    					<th width="15%"><?php echo app('translator')->get('essentials::lang.clock_in_note'); ?></th>
    					<th width="15%"><?php echo app('translator')->get('essentials::lang.clock_out_note'); ?></th>
    					<th width="3%">&nbsp;</th>
    				</thead>
    				<tbody>
    				</tbody>
    			</table>
    		</div>
    	</div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
