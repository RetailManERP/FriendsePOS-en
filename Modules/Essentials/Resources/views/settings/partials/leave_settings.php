<div class="pos-tab-content active">
	<div class="row">
		<div class="col-md-4">
            <div class="form-group">
            	<?php echo Form::label('leave_ref_no_prefix',  __('essentials::lang.leave_ref_no_prefix') . ':'); ?>

            	<?php echo Form::text('leave_ref_no_prefix', !empty($settings['leave_ref_no_prefix']) ? $settings['leave_ref_no_prefix'] : null, ['class' => 'form-control','placeholder' => __('essentials::lang.leave_ref_no_prefix')]); ?>

            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <?php echo Form::label('leave_instructions',  __('essentials::lang.leave_instructions') . ':'); ?>

                <?php echo Form::textarea('leave_instructions', !empty($settings['leave_instructions']) ? $settings['leave_instructions'] : null, ['class' => 'form-control','placeholder' => __('essentials::lang.leave_instructions')]); ?>

            </div>
        </div>
	</div>
</div>
