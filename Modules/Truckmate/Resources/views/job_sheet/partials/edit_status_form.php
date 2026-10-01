<div class="row mt-15">
	<div class="col-md-12">
		<div class="form-group">
			<?php echo Form::label('status_id_modal',  __('sale.status') . ':*'); ?>

    		<?php echo Form::select('status_id', $status_dropdown['statuses'], $status_update_data['status_id'] ?? $job_sheet->status_id, ['class' => 'form-control select2', 'required', 'style' => 'width:100%', 'placeholder' => __('messages.please_select'), 'required', 'id' => 'status_id_modal'], $status_dropdown['template']); ?>

		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<?php echo Form::label('update_note', __( 'truckmate::lang.update_note' ) . ':'); ?>

				<?php echo Form::textarea('update_note', $status_update_data['update_note'] ?? null, ['class' => 'form-control', 'placeholder' => __( 'truckmate::lang.update_note' ), 'rows' => 3, 'id' => 'update_note' ]); ?>

			</div>
		</div>
	</div>
	<div class="row">
    <div class="col-md-8 hide">
        <div class="form-group">
            <div class="checkbox-inline">
                <label>
                    <input type="checkbox" name="send_sms" value="1" id="send_sms" <?php if(!empty($status_update_data['send_sms'])): ?> checked <?php endif; ?>> <?php echo app('translator')->get('truckmate::lang.send_sms'); ?>
                </label>
            </div>
            <div class="checkbox-inline">
                <label>
                    <input type="checkbox" name="send_email" value="1" id="send_email" <?php if(!empty($status_update_data['send_email'])): ?> checked <?php endif; ?>> <?php echo app('translator')->get('truckmate::lang.send_email'); ?>
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-12 sms_body" <?php if(empty($status_update_data['send_sms'])): ?> style="display: none !important;" <?php endif; ?>>
    	<div class="form-group">
			<?php echo Form::label('sms_body', __( 'lang_v1.sms_body' ) . ':'); ?>

				<?php echo Form::textarea('sms_body', $status_update_data['sms_body'] ?? null, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.sms_body' ), 'rows' => 4, 'id' => 'sms_body']); ?>

				<p class="help-block">
                <label><?php echo e($status_template_tags['help_text'], false); ?>:</label><br>
                <?php echo e(implode(', ', $status_template_tags['tags']), false); ?>

            </p>
			</div>
    </div>
</div>
<div class="row email_template" <?php if(empty($status_update_data['send_email'])): ?> style="display: none !important;" <?php endif; ?>>
	<div class="col-md-12">
		<div class="form-group">
    		<?php echo Form::label('email_subject', __( 'lang_v1.email_subject' ) . ':'); ?>

    		<?php echo Form::text('email_subject', $status_update_data['email_subject'] ?? null, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.email_subject' ), 'id' => 'email_subject']); ?>

		</div>
	</div>
		<div class="col-md-12">
		<div class="form-group">
    		<?php echo Form::label('email_body', __( 'lang_v1.email_body' ) . ':'); ?>

    		<?php echo Form::textarea('email_body', $status_update_data['email_body'] ?? null, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.email_body' ), 'rows' => 5, 'id' => 'email_body']); ?>

    		<p class="help-block">
        		<label><?php echo e($status_template_tags['help_text'], false); ?>:</label><br>
        		<?php echo e(implode(', ', $status_template_tags['tags']), false); ?>

    		</p>
		</div>
	</div>
</div>