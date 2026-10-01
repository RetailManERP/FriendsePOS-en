<div class="modal-dialog" role="document">
	<div class="modal-content">
		<?php echo Form::open(['url' => action([\Modules\Repair\Http\Controllers\JobSheetController::class, 'updateStatus'], [$job_sheet->id]), 'method' => 'put', 'id' => 'update_status_form']); ?>

			<div class="modal-header">
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?php echo app('translator')->get( 'repair::lang.edit_status' ); ?></h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<strong>
							<?php echo app('translator')->get('repair::lang.job_sheet_no'); ?>:
						</strong>
						<span id="job_sheet_no">
							<?php echo e($job_sheet->job_sheet_no, false); ?>

						</span>
					</div>
				</div>
				<?php echo $__env->make('repair::job_sheet.partials.edit_status_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
			<div class="modal-footer">
				<input type="hidden" id="status_form_redirect">
				<?php if($job_sheet->status->is_completed_status != 1): ?>
					<button type="submit" class="btn btn-danger ladda-button update_status_button hide mark-as-complete-btn" data-href="<?php echo e(action([\Modules\Repair\Http\Controllers\JobSheetController::class, 'addParts'], [$job_sheet->id]), false); ?>"><?php echo app('translator')->get( 'repair::lang.add_parts_and_mark_complete' ); ?></button>
				<?php endif; ?>
				

				<button type="submit" class="btn btn-success ladda-button update_status_button mark-as-incomplete-btn" data-href="<?php echo e(action([\Modules\Repair\Http\Controllers\JobSheetController::class, 'addParts'], [$job_sheet->id]), false); ?>"><?php echo app('translator')->get( 'repair::lang.save_and_add_parts' ); ?></button>
				<button type="submit" class="btn btn-primary ladda-button update_status_button mark-as-incomplete-btn" data-href=""><?php echo app('translator')->get( 'messages.update' ); ?></button>
				<button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
			</div>

		<?php echo Form::close(); ?>

	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
