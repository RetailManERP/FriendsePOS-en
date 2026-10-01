<div class="modal-dialog" role="document">
	<div class="modal-content">

		<?php echo Form::open(['url' => action([\Modules\Repair\Http\Controllers\RepairController::class, 'updateRepairStatus']), 'method' => 'post', 'id' => 'update_truckmate_status_form']); ?>

			<?php echo Form::hidden('truckmate_id', $transaction->id, ['id' => 'truckmate_id']); ?>

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?php echo app('translator')->get( 'truckmate::lang.edit_status' ); ?></h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<strong><?php echo app('translator')->get('sale.invoice_no'); ?>: </strong>
						<span id="truckmate_no"><?php echo e($transaction->invoice_no, false); ?></span>
					</div>
				</div>
				<div class="row mt-15">
					<div class="col-md-12">
						<div class="form-group">
							<?php echo Form::label('truckmate_status_id_modal',  __('sale.status') . ':*'); ?>

		            		<?php echo Form::select('truckmate_status_id_modal', $truckmate_status_dropdown['statuses'], $transaction->truckmate_status_id, ['class' => 'form-control select2', 'required', 'style' => 'width:100%', 'placeholder' => __('messages.please_select'), 'required'], $truckmate_status_dropdown['template']); ?>

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
		    				<?php echo Form::label('update_note', __( 'truckmate::lang.update_note' ) . ':'); ?>

		      				<?php echo Form::textarea('update_note', null, ['class' => 'form-control', 'placeholder' => __( 'truckmate::lang.update_note' ), 'rows' => 3, 'id' => 'update_note' ]); ?>

		  				</div>
		  			</div>
		  		</div>
  				<div class="row">
	                <div class="col-md-4">
	                    <div class="form-group">
	                        <div class="checkbox">
	                            <label>
	                                <input type="checkbox" name="send_sms" value="1" id="send_sms"> <?php echo app('translator')->get('truckmate::lang.send_sms'); ?>
	                            </label>
	                        </div>
	                    </div>
	                </div>
	                <div class="col-md-12 sms_body" style="display: none !important;">
	                	<div class="form-group">
	        				<?php echo Form::label('sms_body', __( 'lang_v1.sms_body' ) . ':'); ?>

	          				<?php echo Form::textarea('sms_body', null, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.sms_body' ), 'rows' => 4, 'id' => 'sms_body']); ?>

	          				<p class="help-block">
		                        <label><?php echo e($status_template_tags['help_text'], false); ?>:</label><br>
		                        <?php echo e(implode(', ', $status_template_tags['tags']), false); ?>

		                    </p>
	      				</div>
	                </div>
	            </div>
			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-primary ladda-button"><?php echo app('translator')->get( 'messages.update' ); ?></button>
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
			</div>

		<?php echo Form::close(); ?>


	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->