

<?php $__env->startSection('title', __('truckmate::lang.add_invoice')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('truckmate::job_sheet.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style type="text/css">
	.krajee-default.file-preview-frame .kv-file-content {
		height: 65px;
	}
</style>
<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <div class="tm-page-header">
        <h1><i class="fas fa-plus-circle" style="color:var(--tm-primary)"></i> <?php echo app('translator')->get('truckmate::lang.add_invoice'); ?></h1>
    </div>
</section>
<!-- Main content -->
<section class="content tm-content no-print">

<div class="row">
	<div class="col-sm-3">
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon">
					<i class="fa fa-map-marker"></i>
				</span>
			<?php echo Form::select('select_location_id', $business_locations, null, ['class' => 'form-control input-sm', 
					'id' => 'select_location_id', 
					'required', 'autofocus'], $bl_attributes); ?>

			<span class="input-group-addon">
					<?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.sale_location') . '"></i>';
                }
            ?>
				</span> 
			</div>
		</div>
	</div>
</div>

<input type="hidden" id="item_addition_method" value="<?php echo e($business_details->item_addition_method, false); ?>">

<?php if(!empty($truckmate_settings['default_product'])): ?>
 	<input type="hidden" id="default_product" value="<?php echo e($truckmate_settings['default_product'], false); ?>">
<?php endif; ?>
<?php if(session('business.enable_rp') == 1): ?>
    <input type="hidden" id="reward_point_enabled">
<?php endif; ?>

	<?php echo Form::open(['url' => action([\Modules\Truckmate\Http\Controllers\TruckmateController::class, 'store']), 'method' => 'post', 'id' => 'add_truckmate_invoice_form', 'files' => true ]); ?>

	<?php echo Form::hidden('status', 'final', ['id'=> 'status']); ?>

	<?php echo Form::hidden('sub_type', 'truckmate'); ?>

	<?php echo Form::hidden('has_module_data', true); ?>

	<div class="row">
		<div class="col-md-12 col-sm-12">
			<?php $__env->startComponent('components.widget'); ?>
				<?php echo Form::hidden('location_id', $default_location->id, ['id' => 'location_id', 'data-receipt_printer_type' => isset($bl_attributes[$default_location->id]['data-receipt_printer_type']) ? $bl_attributes[$default_location->id]['data-receipt_printer_type'] : 'browser']); ?>

				
				<div class="row align-items-start">
				<div class="col-md-3 col-sm-6">
					<input type="hidden" id="job_sheet_customer_id" value="<?php echo e($job_sheet->customer->id ?? '', false); ?>" >
					<input type="hidden" id="job_sheet_customer_name" value="<?php echo e($job_sheet->customer->full_name_with_business ?? '', false); ?>">
					<input type="hidden" id="job_sheet_id" value="<?php echo e($job_sheet->id ?? '', false); ?>">
					<div class="form-group">
						<?php echo Form::label('contact_id', __('contact.customer') . ':*'); ?>

						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-user"></i>
							</span>
							
							<?php echo Form::select('contact_id', 
								[], null, ['class' => 'form-control mousetrap', 'id' => 'customer_id', 'placeholder' => 'Enter Customer name / phone', 'required']); ?>

							<span class="input-group-btn">
								<button type="button" class="btn btn-default bg-white btn-flat add_new_customer" data-name=""><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
							</span>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="form-group">
						<div class="multi-input">
							<?php
								$is_pay_term_required = !empty($pos_settings['is_pay_term_required']);
							?>
							<?php echo Form::label('pay_term_number', __('contact.pay_term') . ':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.pay_term') . '"></i>';
                }
            ?>
							<br />
							<?php echo Form::number('pay_term_number', $walk_in_customer['pay_term_number'], [
								'class' => 'form-control width-40 pull-left',
								'placeholder' => __('contact.pay_term'),
								'required' => $is_pay_term_required, 'style' => 'width: 100%;',
								!empty($common_settings['make_pay_term_readonly']) ? 'readonly' : ''
							]); ?>

							<?php echo Form::select(
								'pay_term_type',
								['months' => __('lang_v1.months'), 'days' => __('lang_v1.days')],
								$walk_in_customer['pay_term_type'],
								array_merge(
									[
									'class' => 'form-control width-60 pull-left',
									'placeholder' => __('messages.please_select'),
									'required' => $is_pay_term_required,
									],
									!empty($common_settings['make_pay_term_readonly']) 
									? ['style' => 'pointer-events: none;background-color:#F5F5F5;']
									: ['style' => 'width: 100%;']
								),
							); ?>

						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="form-group">
						<?php echo Form::label('transaction_date', __('truckmate::lang.invoice_date') . ':*'); ?>

						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</span>
							<?php echo Form::text('transaction_date', $default_datetime, ['class' => 'form-control', 'readonly', 'required']); ?>

						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="form-group">
						<?php echo Form::label('invoice_no', __('sale.invoice_no') . ':',); ?>

						<?php echo Form::text('invoice_no', null, ['class' => 'form-control', 'placeholder' => __('sale.invoice_no'),]); ?>

						<p class="help-block"><?php echo app('translator')->get('lang_v1.keep_blank_to_autogenerate'); ?></p>
					</div>
				</div>
				
				
				<?php if(in_array('upload_documents', $enabled_modules)): ?>
				<div class="col-md-3 col-sm-6">
			        <div class="form-group">
			            <?php echo Form::label('documents', __('lang_v1.upload_documents') . ':' ); ?>

			            <?php echo Form::file('documents[]', ['multiple', 'id' => 'documents']); ?>

			        </div>
			    </div>
			    <?php endif; ?>
				</div>
				<div class="clearfix"></div>
				
				
			<?php echo $__env->renderComponent(); ?>

			<?php $__env->startComponent('components.widget'); ?>
				<div class="col-sm-10 col-sm-offset-1">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-file"></i>
							</span>
							

							<?php echo Form::select('job_sheet_ids[]', [], null, [
                                    'class' => 'form-control select2',
                                    'id' => 'job_sheet_ids', 'style' => 'width: 100%;',
                                ]); ?>

						</div>
					</div>
				</div>

				<div class="row col-sm-12 sell_product_div" style="min-height: 0">

					<input type="hidden" name="sell_price_tax" id="sell_price_tax" value="<?php echo e($business_details->sell_price_tax, false); ?>">

					<!-- Keeps count of product rows -->
					<input type="hidden" id="job_row_count" value="0">
					<div class="table-responsive">
					<table class="table table-condensed table-bordered table-striped" id="job_table">
						<thead>
							<tr>
								<th class="text-center">	
									<?php echo app('translator')->get('lang_v1.date'); ?>
								</th>
								<th class="text-center">	
									<?php echo app('translator')->get('truckmate::lang.job_sheet'); ?>
								</th>
								<th class="text-center">	
									<?php echo app('translator')->get('truckmate::lang.collection'); ?>
								</th>
								<th class="text-center">	
									<?php echo app('translator')->get('truckmate::lang.drop_off'); ?>
								</th>
								<th class="text-center">	
									<?php echo app('translator')->get('truckmate::lang.price'); ?>
								</th>
								<th class="text-center">	
									<?php echo app('translator')->get('truckmate::lang.waiting_charges'); ?>
								</th>
								<th class="text-center">
									<?php echo app('translator')->get('sale.subtotal'); ?>
								</th>
								<th class="text-center"><i class="fas fa-times" aria-hidden="true"></i></th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($job_sheet)): ?>
								<?php echo $__env->make('truckmate::truckmate.partials.job_sheet_row', [
									'row_count' => 0,
									'job_sheet' => $job_sheet
								], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							<?php endif; ?>
						</tbody>
					</table>
					</div>
					<div class="table-responsive"><table class="table table-condensed table-bordered table-striped">
						<tr>
							<td>
								<div class="pull-right"><b><?php echo app('translator')->get('sale.total'); ?>: </b>
									<span class="price_total">0</span>
								</div>
							</td>
						</tr>
					</table>
					</div>
				</div>
			<?php echo $__env->renderComponent(); ?>

			<?php $__env->startComponent('components.widget'); ?>
				<div class="col-md-4">
			        <div class="form-group">
			            <?php echo Form::label('discount_type', __('sale.discount_type') . ':*' ); ?>

			            <div class="input-group">
			                <span class="input-group-addon">
			                    <i class="fa fa-info"></i>
			                </span>
			                <?php echo Form::select('discount_type', ['fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage')], 'percentage' , ['class' => 'form-control','placeholder' => __('messages.please_select'), 'required', 'data-default' => 'percentage']); ?>

			            </div>
			        </div>
			    </div>
			    <div class="col-md-4">
			        <div class="form-group">
			            <?php echo Form::label('discount_amount', __('sale.discount_amount') . ':*' ); ?>

			            <div class="input-group">
			                <span class="input-group-addon">
			                    <i class="fa fa-info"></i>
			                </span>
			                <?php echo Form::text('discount_amount', number_format($business_details->default_sales_discount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'data-default' => $business_details->default_sales_discount]); ?>

			            </div>
			        </div>
			    </div>
			    <div class="col-md-4"><br>
			    	<b><?php echo app('translator')->get( 'sale.discount_amount' ); ?>:</b>(-) 
					<span class="display_currency" id="total_discount">0</span>
			    </div>
			    <div class="clearfix"></div>
			    <div class="col-md-4">
			    	<div class="form-group">
			            <?php echo Form::label('tax_rate_id', __('sale.order_tax') . ':*' ); ?>

			            <div class="input-group">
			                <span class="input-group-addon">
			                    <i class="fa fa-info"></i>
			                </span>
			                <?php echo Form::select('tax_rate_id', $taxes['tax_rates'], $business_details->default_sales_tax, ['placeholder' => __('messages.please_select'), 'class' => 'form-control', 'data-default'=> $business_details->default_sales_tax], $taxes['attributes']); ?>


							<input type="hidden" name="tax_calculation_amount" id="tax_calculation_amount" 
							value="<?php if(empty($edit)): ?> <?php echo e(number_format($business_details->tax_calculation_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php else: ?> <?php echo e(number_format($transaction->tax?->amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php endif; ?>" data-default="<?php echo e($business_details->tax_calculation_amount, false); ?>">
			            </div>
			        </div>
			    </div>
			    <div class="col-md-4 col-md-offset-4">
			    	<b><?php echo app('translator')->get( 'sale.order_tax' ); ?>:</b>(+) 
					<span class="display_currency" id="order_tax">0</span>
			    </div>
			    <div class="clearfix"></div>
				<div class="col-sm-6">
					<div class="form-group">
						<?php echo Form::label('staff_note',__('truckmate::lang.remarks'). ':'); ?>

						<?php echo Form::textarea('staff_note', null, ['class' => 'form-control', 'rows' => 3]); ?>

					</div>
				</div>
			    <div class="col-md-4 col-md-offset-2">
			    	<div><b><?php echo app('translator')->get('sale.total_payable'); ?>: </b>
						<input type="hidden" name="final_total" id="final_total_input">
						<span id="total_payable">0</span>
					</div>
			    </div>
				<input type="hidden" name="is_direct_sale" value="1">
				<input type="hidden" id="print_label" name="print_label" value="0">
				<div class="clearfix"></div>
			<?php echo $__env->renderComponent(); ?>

			<?php
            $payment_body_id = 'payment_rows_div';
			?>
			<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('truckmate.add_payment')): ?>
				<?php $__env->startComponent('components.widget', [
					'class' => 'box-success',
					'id' => $payment_body_id,
					'title' => __('purchase.add_payment'),
				]); ?>
						<div class="payment_row" id="payment_rows_div">
							
							<?php if($common_settings['set_sale_invoice_payment_zero']): ?>
								<input type="hidden" id="set_sale_invoice_payment_zero" value="true">
							<?php endif; ?>
							<?php echo $__env->make('sale_pos.partials.payment_row_form', [
								'row_index' => 0,
								'show_date' => true,
								'show_denomination' => true,
								'default_datetime' => $default_datetime,
								'payment_line' => $payment_line
							], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</div>
						<div class="payment_row">
							<div class="row">
								<div class="col-md-12">
									<hr>
									<strong>
										<?php echo app('translator')->get('lang_v1.change_return'); ?>:
									</strong>
									<br />
									<span class="lead text-bold change_return_span">0</span>
									<?php echo Form::hidden('change_return', $change_return['amount'], [
										'class' => 'form-control change_return input_number',
										'required',
										'id' => 'change_return',
									]); ?>

									<!-- <span class="lead text-bold total_quantity">0</span> -->
									<?php if(!empty($change_return['id'])): ?>
										<input type="hidden" name="change_return_id" value="<?php echo e($change_return['id'], false); ?>">
									<?php endif; ?>
								</div>
							</div>
							<div class="row hide payment_row" id="change_return_payment_data">
								<div class="col-md-4">
									<div class="form-group">
										<?php echo Form::label('change_return_method', __('lang_v1.change_return_payment_method') . ':*'); ?>

										<div class="input-group">
											<span class="input-group-addon">
												<i class="fas fa-money-bill-alt"></i>
											</span>
											<?php
												$_payment_method = empty($change_return['method']) && array_key_exists('cash', $payment_types) ? 'cash' : $change_return['method'];
												$_payment_types = $payment_types;
												if (isset($_payment_types['advance'])) {
													unset($_payment_types['advance']);
												}
											?>
											<?php echo Form::select('payment[change_return][method]', $_payment_types, $_payment_method, [
												'class' => 'form-control col-md-12 payment_types_dropdown',
												'id' => 'change_return_method',
												'style' => 'width:100%;',
											]); ?>

										</div>
									</div>
								</div>
								<?php if(!empty($accounts)): ?>
									<div class="col-md-4">
										<div class="form-group">
											<?php echo Form::label('change_return_account', __('lang_v1.change_return_payment_account') . ':'); ?>

											<div class="input-group">
												<span class="input-group-addon">
													<i class="fas fa-money-bill-alt"></i>
												</span>
												<?php echo Form::select(
													'payment[change_return][account_id]',
													$accounts,
													!empty($change_return['account_id']) ? $change_return['account_id'] : '',
													['class' => 'form-control select2', 'id' => 'change_return_account', 'style' => 'width:100%;'],
												); ?>

											</div>
										</div>
									</div>
								<?php endif; ?>
								<?php echo $__env->make('sale_pos.partials.payment_type_details', [
									'payment_line' => $change_return,
									'row_index' => 'change_return',
								], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-12">
									<div class="pull-right"><strong><?php echo app('translator')->get('lang_v1.balance'); ?>:</strong> <span
											class="balance_due">0.00</span></div>
								</div>
							</div>
						</div>
				<?php echo $__env->renderComponent(); ?>
			<?php endif; ?>

			<div class="col-md-12">
				<?php echo Form::hidden('is_save_and_print', 0, ['id' => 'is_save_and_print']); ?>

			</div>

		</div>
	</div>
	
	<?php echo Form::close(); ?>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('modals'); ?>
<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	<?php echo $__env->make('contact.create', ['quick_add' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('js/pos.js?v=' . $asset_v), false); ?>"></script>
	<?php echo $__env->make('truckmate::layouts.partials.javascripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<script type="text/javascript">
		$(document).ready( function() {

			var default_customer_id = $('#job_sheet_customer_id').val();
			var default_customer_name = $('#job_sheet_customer_name').val();
			var exists = default_customer_id ? $('select#customer_id option[value=' + default_customer_id + ']').length : 0;
			if (exists == 0 && default_customer_id) {
				$('select#customer_id').append(
					$('<option>', { value: default_customer_id, text: default_customer_name })
				);
				job_total_row();
			}
			$('select#customer_id').val(default_customer_id).trigger('change');
			
			// setTimeout(() => {
			// 	var job_sheet_id = $('#job_sheet_id').val();
			// 	console.log(job_sheet_id);
			// 	var job_exists = job_sheet_id ? $('select#job_sheet_ids option[value="' + job_sheet_id + '"]').length : 0;
			// 	if (job_exists == 1) {
			// 		$('select#job_sheet_ids').val(job_sheet_id).trigger('change');
			// 		$('select#job_sheet_ids').trigger({
			// 		type: 'select2:select',
			// 		params: { data: { id: job_sheet_id, text: text } }
			// 	});	
			// 	}				
			// }, 2500);

			$('#submit-n-print-label').click( function() {
				$('input#print_label').val(1);
				$("#submit-sell").trigger('click');
			});
			
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>