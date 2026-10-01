<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <?php echo Form::label('cc', 'CC:' ); ?>

            <?php echo Form::text('cc',!empty($proposal_template) ? $proposal_template->cc : '', ['class' => 'form-control' ]); ?>

            <p class="help-block"><?php echo app('translator')->get('crm::lang.comma_separated_email'); ?></p>
       </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <?php echo Form::label('bcc', 'BCC:' ); ?>

            <?php echo Form::text('bcc',!empty($proposal_template) ? $proposal_template->bcc : '', ['class' => 'form-control' ]); ?>

            <p class="help-block"><?php echo app('translator')->get('crm::lang.comma_separated_email'); ?></p>
       </div> 
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <?php echo Form::label('subject', __('crm::lang.subject') . ':*' ); ?>

            <?php echo Form::text('subject',!empty($proposal_template) ? $proposal_template->subject : '', ['class' => 'form-control', 'required' ]); ?>

       </div>
    </div>
</div>
<div class="row">
	<div class="col-md-12">
        <div class="form-group">
            <?php echo Form::label('body', __('crm::lang.email_body') . ':*'); ?>

            <?php echo Form::textarea('body', !empty($proposal_template) ? $proposal_template->body : '', ['class' => 'form-control', 'id' => 'proposal_email_body','required']); ?>

        </div>
        <?php $__errorArgs = ['body'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        	<label id="proposal_email_body-error" class="error" for="body">
        		<?php echo e($message, false); ?>

        	</label>
		<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>
<?php if($attachments): ?>
	<div class="row">
		<div class="col-sm-12">
	      <div class="form-group">
	        <?php echo Form::label('attachments', __('crm::lang.attachments') . ':'); ?>

	        <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
	        <?php echo Form::file('attachments[]', ['id' => 'attachments', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types'))), 'multiple']); ?>

	      </div>
	    </div>
	</div>
<?php endif; ?>
