<div class="modal-dialog modal-lg" role="document">
  	<div class="modal-content">
  		<div class="modal-header no-print">
	      	<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
	      		<span aria-hidden="true">&times;</span>
	      	</button>
	      	<h4 class="modal-title no-print">
	      		<?php echo app('translator')->get('crm::lang.proposal_sent_to', ['name' => $proposal->contact]); ?>
	      	</h4>
	    </div>
	    <div class="modal-body">
	    	<div class="row">
	    		<div class="col-md-6">
					<p class="float-start">
						<strong><?php echo e(__('crm::lang.sent_by'), false); ?>:</strong> <?php echo e($proposal->sent_by_full_name, false); ?>

					</p>
				</div>
        		<div class="col-md-6">
					<p class="float-end">
						<strong><?php echo e(__('receipt.date'), false); ?>:</strong> <?php echo format_datetime_br($proposal->created_at); ?>

					</p>
				</div>
			</div>
			<div class="row mt-10">
        		<div class="col-md-12">
					<p>
						<strong>CC:</strong> <?php echo e($proposal->cc, false); ?>

					</p>
				</div>
			</div>
			<div class="row mt-10">
        		<div class="col-md-12">
					<p>
						<strong>BCC:</strong> <?php echo e($proposal->bcc, false); ?>

					</p>
				</div>
			</div>
	    	<div class="row mt-10">
        		<div class="col-md-12">
					<p>
						<strong><?php echo e(__('crm::lang.subject'), false); ?>:</strong> <?php echo e($proposal->subject, false); ?>

					</p>
				</div>
			</div>
			<div class="row mt-10">
				<div class="col-md-12">
					<p>
						<strong><?php echo e(__('crm::lang.email_body'), false); ?>:</strong> <?php echo $proposal->body; ?>

					</p>
				</div>
			</div>
			<?php if($proposal->media->count() > 0): ?>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<h4>
							<?php echo e(__('crm::lang.attachments'), false); ?>

						</h4>
						<?php if ($__env->exists('crm::proposal_template.partials.attachment', ['medias' => $proposal->media])) echo $__env->make('crm::proposal_template.partials.attachment', ['medias' => $proposal->media], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</div>
				</div>
			<?php endif; ?>
	    </div>
	    <div class="modal-footer no-print">
	      	<button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
	    </div>
  	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
