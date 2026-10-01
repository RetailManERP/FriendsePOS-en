
<?php $__env->startSection('title', __('crm::lang.proposal_template')); ?>
<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('crm::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<!-- Content Header (Page header) -->
	<section class="content-header no-print">
	   <h1>
	   		<?php echo app('translator')->get('crm::lang.proposal_template'); ?>
	   		<small><?php echo app('translator')->get('lang_v1.create'); ?></small>
	   </h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
			<?php echo Form::open(['url' => action([\Modules\Crm\Http\Controllers\ProposalTemplateController::class, 'store']), 'method' => 'post', 'id' => 'proposal_template_form', 'files' => true]); ?>

				<?php if ($__env->exists('crm::proposal_template.partials.template_form', ['attachments' => true])) echo $__env->make('crm::proposal_template.partials.template_form', ['attachments' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<button type="submit" class="btn btn-primary ladda-button float-end m-5" data-style="expand-right">
                    <span class="ladda-label"><?php echo app('translator')->get('messages.save'); ?></span>
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

     	//initialize file input
        $('#attachments').fileinput({
            showUpload: false,
            showPreview: false,
            browseLabel: '',
            removeLabel: '',
            cancelLabel: ''
        });

        $('form#proposal_template_form').validate({
	        submitHandler: function(form) {
	            form.submit();
	            let ladda = Ladda.create(document.querySelector('.ladda-button'));
    			ladda.start();
	        }
	    });
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>