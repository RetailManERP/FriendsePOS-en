
<?php $__env->startSection('title', __('crm::lang.proposal')); ?>
<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('crm::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<!-- Content Header (Page header) -->
	<section class="content-header no-print">
	   <h1>
	   		<?php echo app('translator')->get('crm::lang.proposal'); ?>
	   		<small><?php echo app('translator')->get('crm::lang.send'); ?></small>
	   </h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
			<?php echo Form::open(['url' => action([\Modules\Crm\Http\Controllers\ProposalController::class, 'store']), 'method' => 'post', 'id' => 'proposal_form']); ?>

				<div class="row">
					<div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('contact_id', __('crm::lang.send_to') .':*'); ?>

                            <?php echo Form::select('contact_id', $contacts, null, ['class' => 'form-control select2', 'id' => 'proposal_contact', 'style' => 'width: 100%;', 'required', 'placeholder' => __('messages.please_select')]); ?>

                        </div>
                    </div>
				</div>
				<?php if ($__env->exists('crm::proposal_template.partials.template_form', ['proposal_template' => $proposal_template, 'attachments' => false])) echo $__env->make('crm::proposal_template.partials.template_form', ['proposal_template' => $proposal_template, 'attachments' => false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
				<button type="submit" class="btn btn-primary ladda-button float-end m-5" data-style="expand-right">
                    <span class="ladda-label"><?php echo app('translator')->get('crm::lang.send'); ?></span>
                </button>
			<?php echo Form::close(); ?>

    	<?php echo $__env->renderComponent(); ?>
	</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	$(function () {
		tinymce.init({
	        selector: 'textarea#proposal_email_body',
	        height: 350,
	    });

        $('form#proposal_form').validate({
	        submitHandler: function(form) {
	            form.submit();
	            let ladda = Ladda.create(document.querySelector('.ladda-button'));
    			ladda.start();
	        }
	    });
	    
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