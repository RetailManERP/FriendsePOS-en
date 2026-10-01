

<?php $__env->startSection('title', __('truckmate::lang.edit_invoice')); ?>

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
        <h1><i class="fas fa-edit" style="color:var(--tm-primary)"></i> <?php echo app('translator')->get('truckmate::lang.edit_invoice'); ?></h1>
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
				<?php echo Form::select('select_location_id', $business_locations, $default_location->id, ['class' => 'form-control input-sm', 
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

	<?php echo Form::open(['url' => action([\Modules\Truckmate\Http\Controllers\TruckmateController::class, 'update'], ['truckmate' => $invoice->id ]), 'method' => 'put', 'id' => 'add_truckmate_invoice_form', 'files' => true ]); ?>

	<?php echo Form::hidden('status', 'final', ['id'=> 'status']); ?>

	<?php echo Form::hidden('hidden_invoice_id', $invoice->id, ['id'=> 'hidden_invoice_id']); ?>

	<?php echo Form::hidden('sub_type', 'truckmate'); ?>

	<?php echo Form::hidden('has_module_data', true); ?>

	<div class="row">
		<div class="col-md-12 col-sm-12">
			<?php $__env->startComponent('components.widget'); ?>
				<?php echo Form::hidden('location_id', $default_location->id, ['id' => 'location_id', 'data-receipt_printer_type' => isset($bl_attributes[$default_location->id]['data-receipt_printer_type']) ? $bl_attributes[$default_location->id]['data-receipt_printer_type'] : 'browser']); ?>

				<div class="row align-items-start">
				<div class="col-md-3 col-sm-6">
					<div class="form-group">
						<?php echo Form::label('contact_id', __('contact.customer') . ':*'); ?>

						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-user"></i>
							</span>
							<input type="hidden" id="default_customer_id" value="<?php echo e($invoice->contact->id, false); ?>" >
							<input type="hidden" id="default_customer_name" value="<?php echo e(!empty($invoice->contact->name) ? $invoice->contact->name : $invoice->contact->supplier_business_name, false); ?>" >
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
							<?php echo Form::number('pay_term_number', $invoice->pay_term_number, [
								'class' => 'form-control width-40 pull-left',
								'placeholder' => __('contact.pay_term'),
								'required' => $is_pay_term_required, 'style' => 'width: 100%;',
								!empty($common_settings['make_pay_term_readonly']) ? 'readonly' : ''
							]); ?>

							<?php echo Form::select(
								'pay_term_type',
								['months' => __('lang_v1.months'), 'days' => __('lang_v1.days')],
								$invoice->pay_term_type,
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
							<?php echo Form::text('transaction_date', $invoice->transaction_date, ['class' => 'form-control', 'readonly', 'required']); ?>

						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="form-group">
						<?php echo Form::label('invoice_no', __('sale.invoice_no') . ':',); ?>

						<?php echo Form::text('invoice_no', $invoice->invoice_no, ['class' => 'form-control', 'placeholder' => __('sale.invoice_no'),]); ?>

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
							<?php
							$row_count = 0
							?>
							<?php $__currentLoopData = $job_sheets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job_sheet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php echo $__env->make('truckmate::truckmate.partials.job_sheet_row', ['job_sheet' => $job_sheet, 'row_count' => $row_count, 'edit' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
								<?php
								$row_count++;
								?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
					
					<input type="hidden" id="job_row_count" value="<?php echo e($row_count, false); ?>">
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
			                <?php echo Form::select('discount_type', ['fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage')], $invoice->discount_type , ['class' => 'form-control','placeholder' => __('messages.please_select'), 'required', 'data-default' => 'percentage']); ?>

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
			                <?php echo Form::text('discount_amount', number_format($invoice->discount_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'data-default' => $business_details->default_sales_discount]); ?>

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
			                <?php echo Form::select('tax_rate_id', $taxes['tax_rates'], $invoice->tax_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control', 'data-default'=> $business_details->default_sales_tax], $taxes['attributes']); ?>


							<input type="hidden" name="tax_calculation_amount" id="tax_calculation_amount" 
									value="<?php echo e(number_format($transaction->tax?->amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" data-default="<?php echo e($business_details->tax_calculation_amount, false); ?>">
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

						<?php echo Form::textarea('staff_note', $invoice->staff_note, ['class' => 'form-control', 'rows' => 3]); ?>

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

			job_total_row();
			$('#submit-n-print-label').click( function() {
				$('input#print_label').val(1);
				$("#submit-sell").trigger('click');
			});
			
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>