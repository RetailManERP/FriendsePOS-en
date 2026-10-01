<div class="modal-dialog" role="document">
	<div class="modal-content">

		<?php echo Form::open(['url' => action([\Modules\Repair\Http\Controllers\RepairController::class, 'updateCollectionInfo']), 'method' => 'post', 'id' => 'update_collection_info_form']); ?>

			<?php echo Form::hidden('invoice_id', $transaction->id, ['id' => 'invoice_id']); ?>

			<div class="modal-header">
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?php echo app('translator')->get( 'repair::lang.update_collection_info' ); ?></h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<strong><?php echo app('translator')->get('sale.invoice_no'); ?>: </strong>
						<span id="repair_no"><?php echo e($transaction->invoice_no, false); ?></span>
					</div>
				</div>
				<div class="row mt-15">
					<div class="col-md-12">
						<div class="form-group">
		    				<?php echo Form::label('repair_collection_note', __( 'repair::lang.repair_collection_note' ) . ':'); ?>

		      				<?php echo Form::textarea('repair_collection_note', $transaction->repair_collection_note, ['class' => 'form-control', 'placeholder' => __( 'repair::lang.repair_collection_note' ), 'rows' => 3, 'id' => 'repair_collection_note' ]); ?>

		  				</div>
		  			</div>
		  		</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<?php echo Form::label("repair_collection_date" , __('repair::lang.repair_collection_date') . ':*'); ?>

							<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</span>
							<?php echo Form::text('repair_collection_date', \Carbon::createFromTimestamp(strtotime(!empty($transaction->repair_collection_date) ? $transaction->repair_collection_date : now()))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'readonly', 'required']); ?>

							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-primary ladda-button"><?php echo app('translator')->get( 'messages.update' ); ?></button>
				<button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
			</div>

		<?php echo Form::close(); ?>


	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
