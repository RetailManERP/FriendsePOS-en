	<div class="modal-dialog" role="document">
	  <div class="modal-content">

	    <?php echo Form::open(['url' => action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'postAddAdvancePayment']), 'method' => 'get', 'id' => 'add_advance_payment_form' ]); ?>


		<div class="modal-header">
			<h4 class="modal-title"><?php echo app('translator')->get( 'essentials::lang.add_advance_payment' ); ?></h4>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>

	    <div class="modal-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<?php echo Form::label("sub_type" , 'Type:'); ?>

						<?php echo Form::select("sub_type", ['advance_payment' => 'Advance Payment', 'loan_payment' => 'Load Payment'], 'advance_payment', ['class' => 'form-control', 'id'=> 'advance_pay_type', 'style' => 'width:100%;']); ?>

					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<?php echo Form::label("paid_on" , __('lang_v1.paid_on') . ':*'); ?>

						<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</span>
						<?php echo Form::text('paid_on', $default_datetime, ['class' => 'form-control', 'readonly', 'required', $date_readonly]); ?>

						</div>
		         	</div>
				</div>
				<div class="col-md-12">
				<div class="form-group">
					<?php echo Form::label('location_id', __( 'business.location' ) . ':*'); ?>

					<?php echo Form::select('location_id', $locations, null, ['class' => 'form-control select2', 'style' => 'width: 100%;', 'id' => 'location_id']); ?>

				</div>
				</div>
				<div class="col-md-12">
				<div class="form-group">
					<?php echo Form::label('employee_id', __( 'essentials::lang.employee' ) . ':*'); ?>

					<?php echo Form::select('employee_id', $employees, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;', 'id' => 'employee_id']); ?>

				</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<?php echo Form::label("method" , __('purchase.payment_method') . ':*'); ?>

						<div class="input-group">
						<span class="input-group-addon">
							<i class="fas fa-money-bill-alt"></i>
						</span>
						<?php echo Form::select("method", $payment_types, $payment_line->method, ['class' => 'form-control select2 payment_types_dropdown', 'required', 'style' => 'width:100%;']); ?>

						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<?php echo Form::label("amount" , __('sale.amount') . ':*'); ?>

						<div class="input-group">
						<span class="input-group-addon">
							<i class="fas fa-money-bill-alt"></i>
						</span>
						<?php echo Form::text("amount", 0, ['class' => 'form-control input_number payment_amount', 'required', 'placeholder' => __('sale.amount'),
										'data-rule-required'=> true, 'data-msg-required'=> 'This field is required',
										'data-rule-min-value' => 1, 'data-msg-min-value' => 'Min Value Allowed is 1.00']); ?>

						</div>
					</div>
				</div>

				<div class="col-md-6 hide loan_fields">
					<div class="form-group">
						<?php echo Form::label("recur_repetitions" , __('essentials::lang.loan_installments') . ':*'); ?>

						<div class="input-group">
						<span class="input-group-addon">
							<i class="fas fa-sync"></i>
						</span>
						<?php echo Form::text("recur_repetitions", 0, ['class' => 'form-control input_number', 'required', 'placeholder' => __('sale.amount'), 'data-rule-min-value' => 1, 'data-msg-min-value' => 'Min Value Allowed']); ?>

						</div>
					</div>
				</div>

			</div>

	    </div>

	    <div class="modal-footer">
	      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'essentials::lang.proceed' ); ?></button>
	      <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
	    </div>

	    <?php echo Form::close(); ?>


	  </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
