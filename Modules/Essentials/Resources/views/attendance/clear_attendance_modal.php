<div class="modal-dialog" role="document" style="padding-top:5%">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center">Are you Sure? (This Action is Irreversable)</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="clear-attendance-form" action="<?php echo e(action([\Modules\Essentials\Http\Controllers\AttendanceController::class, 'authClearAttendance']), false); ?>" method="post" autocomplete="off">
				<?php echo csrf_field(); ?>
				<div class="row">
					<div class="col-md-12">
				        <div class="form-group">
							<label for="permission_username">Admin Username:</label>
							<input type="text" name="permission_username" class="form-control" id='permission_username'>
						</div>
				    </div>
					<div class="col-md-12">
				        <div class="form-group">
							<label for="permission_password">Admin Password</label>
							<input type="password" name="permission_password" class="form-control" id='permission_password'>
						</div>
				    </div>
					<div class="col-md-12">
						<button class="btn btn-primary" id="submit-clear-attendance" type="submit">Perform Action</button>
						<button class="btn" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
