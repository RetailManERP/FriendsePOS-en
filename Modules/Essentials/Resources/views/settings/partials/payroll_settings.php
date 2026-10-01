<div class="pos-tab-content">
	<div class="row">
		<div class="col-md-4">
            <div class="form-group">
                <?php echo Form::label('payroll_ref_no_prefix',  __('essentials::lang.payroll_ref_no_prefix') . ':'); ?>

                <?php echo Form::text('payroll_ref_no_prefix', !empty($settings['payroll_ref_no_prefix']) ? $settings['payroll_ref_no_prefix'] : null, ['class' => 'form-control','placeholder' => __('essentials::lang.payroll_ref_no_prefix')]); ?>

            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php echo Form::label('payroll_payemnt_ref_no_prefix',  __('essentials::lang.payroll_payemnt_ref_no_prefix') . ':'); ?>

                <?php echo Form::text('payroll_payemnt_ref_no_prefix', !empty($settings['payroll_payemnt_ref_no_prefix']) ? $settings['payroll_payemnt_ref_no_prefix'] : null, ['class' => 'form-control','placeholder' => __('essentials::lang.payroll_payemnt_ref_no_prefix')]); ?>

            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php echo Form::label('payroll_advance_payment_prefix',  __('essentials::lang.payroll_advance_payment_prefix') . ':'); ?>

                <?php echo Form::text('payroll_advance_payment_prefix', !empty($settings['payroll_advance_payment_prefix']) ? $settings['payroll_advance_payment_prefix'] : null, ['class' => 'form-control','placeholder' => __('essentials::lang.payroll_advance_payment_prefix')]); ?>

            </div>
        </div>
	</div>
</div>
