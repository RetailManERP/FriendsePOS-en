
<?php $__env->startSection('title', __('crm::lang.proposal_template')); ?>
<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('crm::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<!-- Content Header (Page header) -->
	<section class="content-header no-print">
	   <h1>
	   	<?php echo app('translator')->get('crm::lang.proposal_template'); ?>
	   	<small><?php echo app('translator')->get('messages.view'); ?></small>
	   </h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="box box-info">
			<div class="box-header with-border">
				<div class="box-tools float-end">
					<?php if(auth()->user()->can('crm.add_proposal_template')): ?>
    					<a href="<?php echo e(action([\Modules\Crm\Http\Controllers\ProposalTemplateController::class, 'getEdit']), false); ?>" class="btn  btn-primary">
    						<?php echo app('translator')->get('messages.edit'); ?>
    					</a>
    				<?php endif; ?>
    				<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crm.access_proposal')): ?>
    					<a href="<?php echo e(action([\Modules\Crm\Http\Controllers\ProposalTemplateController::class, 'send']), false); ?>" class="btn  btn-success">
    						<?php echo app('translator')->get('crm::lang.send'); ?>
    					</a>
    				<?php endif; ?>
				</div>
            </div>
            <div class="box-body">
            	<div class="row">
            		<div class="col-md-12">
						<p>
							<strong>CC:</strong> <?php echo e($proposal_template->cc, false); ?>

						</p>
					</div>
					<div class="col-md-12">
						<p>
							<strong>BCC:</strong> <?php echo e($proposal_template->bcc, false); ?>

						</p>
					</div>
            		<div class="col-md-12">
						<p>
							<strong><?php echo e(__('crm::lang.subject'), false); ?>:</strong> <?php echo e($proposal_template->subject, false); ?>

						</p>
					</div>
				</div>
				<div class="row mt-10">
					<div class="col-md-12">
						<p>
							<strong><?php echo e(__('crm::lang.email_body'), false); ?>:</strong> <?php echo $proposal_template->body; ?>

						</p>
					</div>
				</div>
				<?php if($proposal_template->media->count() > 0): ?>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<h4>
								<?php echo e(__('crm::lang.attachments'), false); ?>

							</h4>
							<?php if ($__env->exists('crm::proposal_template.partials.attachment', ['medias' => $proposal_template->media])) echo $__env->make('crm::proposal_template.partials.attachment', ['medias' => $proposal_template->media], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	$(function () {
	    $(document).on('click', 'a.delete_attachment', function (e) {
            e.preventDefault();
            var url = $(this).data('href');
            var this_btn = $(this);
            swal({
                title: LANG.sure,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((confirmed) => {
                if (confirmed) {
                    $.ajax({
                        method: 'DELETE',
                        url: url,
                        dataType: 'json',
                        success: function(result) {
                            if(result.success == true){
			                    this_btn.closest('tr').remove();
			                    toastr.success(result.msg);
			                } else {
			                    toastr.error(result.msg);
			                }
                        }
                    });
                }
            });
        });
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>