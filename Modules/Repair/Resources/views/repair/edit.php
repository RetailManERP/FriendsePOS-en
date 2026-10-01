

<?php $__env->startSection('title', __('repair::lang.edit_repair')); ?>
<?php $__env->startSection('content'); ?>
<style type="text/css">
	.krajee-default.file-preview-frame .kv-file-content {
		height: 65px;
	}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('repair::lang.edit_repair'); ?> <small>(<?php echo app('translator')->get('repair::lang.repair_no'); ?>: <span class="text-success">#<?php echo e($transaction->invoice_no, false); ?>)</span></small></h1>
</section>
<!-- Main content -->
<section class="content">
<input type="hidden" id="item_addition_method" value="<?php echo e($business_details->item_addition_method, false); ?>">
<?php if(session('business.enable_rp') == 1): ?>
    <input type="hidden" id="reward_point_enabled">
<?php endif; ?>
	<?php echo Form::open(['url' => action([\App\Http\Controllers\SellPosController::class, 'update'], ['id' => $transaction->id ]), 'method' => 'put', 'id' => 'edit_sell_form', 'files' => true ]); ?>


	<?php echo Form::hidden('location_id', $transaction->location_id, ['id' => 'location_id', 'data-receipt_printer_type' => !empty($location_printer_type) ? $location_printer_type : 'browser']); ?>

	<?php echo Form::hidden('has_module_data', true); ?>

	<?php echo Form::hidden('status', 'final'); ?>

	<?php echo Form::hidden('sub_type', 'repair'); ?>

	<div class="row">
		<div class="col-md-12 col-sm-12">
			<?php $__env->startComponent('components.widget'); ?>
				<div class="<?php if(!empty($commission_agent)): ?> col-sm-3 <?php else: ?> col-sm-4 <?php endif; ?>">
					<div class="form-group">
						<?php echo Form::label('contact_id', __('contact.customer') . ':*'); ?>

						<div class="input-group">
							<span class="input-group-text">
								<i class="fa fa-user"></i>
							</span>
							<input type="hidden" id="default_customer_id" 
							value="<?php echo e($transaction->contact->id, false); ?>" >
							<input type="hidden" id="default_customer_name" 
							value="<?php echo e($transaction->contact->name, false); ?>" >
							<?php echo Form::select('contact_id', 
								[], null, ['class' => 'form-control mousetrap', 'id' => 'customer_id', 'placeholder' => 'Enter Customer name / phone', 'required']); ?>

							<span class="input-group-btn">
								<button type="button" class="btn btn-default bg-white btn-flat add_new_customer" data-name=""><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
							</span>
						</div>
					</div>
				</div>
				<div class="<?php if(!empty($commission_agent)): ?> col-sm-3 <?php else: ?> col-sm-4 <?php endif; ?>">
					<div class="form-group">
						<?php echo Form::label('transaction_date', __('repair::lang.repair_added_on') . ':*'); ?>

						<div class="input-group">
							<span class="input-group-text">
								<i class="fa fa-calendar"></i>
							</span>
							<?php echo Form::text('transaction_date', $transaction->transaction_date, ['class' => 'form-control', 'readonly', 'required']); ?>

						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<?php echo Form::label('repair_completed_on', __('repair::lang.repair_completed_on') . ':*'); ?>

						<div class="input-group">
							<span class="input-group-text">
								<i class="fa fa-calendar"></i>
							</span>
							<?php echo Form::text('repair_completed_on', $transaction->repair_completed_on, ['class' => 'form-control', 'readonly', 'required']); ?>

						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label for="repair_status_id"><?php echo e(__('repair::lang.repair_status') . ':*', false); ?></label>
						<select name="repair_status_id" class="form-control" id="repair_status_id"></select>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<?php echo Form::label('repair_brand_id', __('repair::lang.manufacturer') . ':'); ?>

						<?php echo Form::select('repair_brand_id', $brands, $transaction->repair_brand_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<?php echo Form::label('repair_model', __('repair::lang.model') . ':'); ?>

						<?php echo Form::text('repair_model', $transaction->repair_model, ['class' => 'form-control', 'placeholder' => __('repair::lang.model')]); ?>

					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<?php echo Form::label('repair_serial_no', __('repair::lang.serial_no') . ':'); ?>

						<?php echo Form::text('repair_serial_no', $transaction->repair_serial_no, ['class' => 'form-control', 'placeholder' => __('repair::lang.serial_no')]); ?>

					</div>
				</div>
				<?php if(in_array('service_staff' ,$enabled_modules)): ?>
				<div class="col-sm-4">
					<div class="form-group">
						<?php echo Form::label('res_waiter_id', __('repair::lang.assign_repair_to') . ':'); ?>

						<?php echo Form::select('res_waiter_id', $waiters, $transaction->res_waiter_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

					</div>
				</div>
				<?php endif; ?>
				<div class="col-sm-4">
					<br>
					<div class="form-check">
						<label class="form-check-label">
<?php echo Form::checkbox('repair_updates_email', 1, !empty($transaction->repair_updates_email), ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('repair::lang.auto_send_notification'); ?> (Email)
						</label> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('repair::lang.auto_send_email_tooltip') . '"></i>';
                }
            ?>
					</div>
				</div>
				<div class="col-sm-4">
					<br>
					<div class="form-check">
						<label class="form-check-label">
<?php echo Form::checkbox('repair_updates_sms', 1, !empty($transaction->repair_updates_sms), ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('repair::lang.auto_send_notification'); ?> (SMS)
						</label> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('repair::lang.auto_send_sms_tooltip') . '"></i>';
                }
            ?>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-sm-2">
					<div class="form-group">
					<br>
						<button type="button" class="btn btn-primary btn-flat" data-bs-toggle="modal" data-bs-target="#checklist_modal"><i class="fa fa-plus"></i> <?php echo app('translator')->get('repair::lang.pre_repair_checklist'); ?></button>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<br>
						<button type="button" class="btn btn-primary btn-flat" data-bs-toggle="modal" data-bs-target="#security_modal"><i class="fa fa-lock"></i> <?php echo app('translator')->get('repair::lang.security'); ?></button>
					</div>
				</div>
				<div class="clearfix"></div>
			    <div class="col-md-12">
			        <div class="form-group">
			            <?php echo Form::label('documents', __('lang_v1.upload_documents') . ':' ); ?>

			            <?php echo Form::file('documents[]', ['multiple', 'id' => 'documents']); ?>

			        </div>
			    </div>
			    <?php
			    	$selected_checklist = !empty($transaction->repair_checklist) ? json_decode($transaction->repair_checklist, true) : [];

			    ?>
				<?php echo $__env->make('repair::repair.partials.security_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php echo $__env->make('repair::repair.partials.checklist_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<?php echo $__env->renderComponent(); ?>

			<?php $__env->startComponent('components.widget'); ?>
				<div class="col-sm-6">
					<div class="form-group">
						<?php echo Form::label('repair_defects',__('repair::lang.defect') . ':'); ?>

						<?php echo Form::textarea('repair_defects', $transaction->repair_defects, ['class' => 'form-control', 'rows' => 3]); ?>

					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<?php echo Form::label('staff_note',__('repair::lang.noted_problems_n_technician_comments'). ':'); ?>

						<?php echo Form::textarea('staff_note', $transaction->staff_note, ['class' => 'form-control', 'rows' => 3]); ?>

					</div>
				</div>
			<?php echo $__env->renderComponent(); ?>
			
			<?php $__env->startComponent('components.widget'); ?>
				<div class="col-sm-10 col-sm-offset-1">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-text">
								<i class="fa fa-barcode"></i>
							</span>
							<?php echo Form::text('search_product', null, ['class' => 'form-control mousetrap', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'),
							'autofocus' => true,
							]); ?>

						</div>
					</div>
				</div>

				<div class="row col-sm-12 pos_product_div" style="min-height: 0">

					<input type="hidden" name="sell_price_tax" id="sell_price_tax" value="<?php echo e($business_details->sell_price_tax, false); ?>">

					<!-- Keeps count of product rows -->
					<input type="hidden" id="product_row_count" 
						value="<?php echo e(count($sell_details), false); ?>">
					<?php
						$hide_tax = '';
						if( session()->get('business.enable_inline_tax') == 0){
							$hide_tax = 'hide';
						}
					?>
					<div class="table-responsive">
					<table class="table table-condensed table-bordered table-striped" id="pos_table">
						<thead>
							<tr>
								<th class="text-center">	
									<?php echo app('translator')->get('sale.product'); ?>
								</th>
								<th class="text-center">
									<?php echo app('translator')->get('sale.qty'); ?>
								</th>
								<?php if(!empty($pos_settings['inline_service_staff']) && in_array('service_staff' ,$enabled_modules)): ?>
									<th class="text-center col-md-2">
										<?php echo app('translator')->get('restaurant.service_staff'); ?>
									</th>
								<?php endif; ?>
								<th class="text-center <?php echo e($hide_tax, false); ?>">
									<?php echo app('translator')->get('sale.price_inc_tax'); ?>
								</th>
								<th class="text-center">
									<?php echo app('translator')->get('sale.subtotal'); ?>
								</th>
								<th class="text-center"><i class="fa fa-close" aria-hidden="true"></i></th>
							</tr>
						</thead>
						<tbody>
							<?php $__currentLoopData = $sell_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sell_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php echo $__env->make('sale_pos.product_row', ['product' => $sell_line, 'row_count' => $loop->index, 'tax_dropdown' => $taxes, 'sub_units' => !empty($sell_line->unit_details) ? $sell_line->unit_details : [] ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
					</div>
					<div class="table-responsive">
					<table class="table table-condensed table-bordered table-striped">
						<tr>
							<td>
								<div class="float-end"><b><?php echo app('translator')->get('sale.total'); ?>: </b>
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
			                <span class="input-group-text">
			                    <i class="fa fa-info"></i>
			                </span>
			                <?php echo Form::select('discount_type', ['fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage')], $transaction->discount_type , ['class' => 'form-control','placeholder' => __('messages.please_select'), 'required', 'data-default' => 'percentage']); ?>

			            </div>
			        </div>
			    </div>
			    <div class="col-md-4">
			        <div class="form-group">
			            <?php echo Form::label('discount_amount', __('sale.discount_amount') . ':*' ); ?>

			            <div class="input-group">
			                <span class="input-group-text">
			                    <i class="fa fa-info"></i>
			                </span>
			                <?php echo Form::text('discount_amount', number_format($transaction->discount_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'data-default' => $business_details->default_sales_discount]); ?>

			            </div>
			        </div>
			    </div>
			    <div class="col-md-4"><br>
			    	<b><?php echo app('translator')->get( 'sale.discount_amount' ); ?>:</b>(-) 
					<span class="display_currency" id="total_discount">0</span>
			    </div>
			    <div class="clearfix"></div>
			    <div class="col-md-12 well well-sm bg-light-gray <?php if(session('business.enable_rp') != 1): ?> hide <?php endif; ?>">
			    	<input type="hidden" name="rp_redeemed" id="rp_redeemed" value="<?php echo e($transaction->rp_redeemed, false); ?>">
			    	<input type="hidden" name="rp_redeemed_amount" id="rp_redeemed_amount" value="<?php echo e($transaction->rp_redeemed_amount, false); ?>">
			    	<div class="col-md-12"><h4><?php echo e(session('business.rp_name'), false); ?></h4></div>
			    	<div class="col-md-4">
				        <div class="form-group">
				            <?php echo Form::label('rp_redeemed_modal', __('lang_v1.redeemed') . ':' ); ?>

				            <div class="input-group">
				                <span class="input-group-text">
				                    <i class="fa fa-gift"></i>
				                </span>
				                <?php echo Form::number('rp_redeemed_modal', $transaction->rp_redeemed, ['class' => 'form-control direct_sell_rp_input', 'data-amount_per_unit_point' => session('business.redeem_amount_per_unit_rp'), 'min' => 0, 'data-max_points' => !empty($redeem_details['points']) ? $redeem_details['points'] : 0, 'data-min_order_total' => session('business.min_order_total_for_redeem') ]); ?>

				                <input type="hidden" id="rp_name" value="<?php echo e(session('business.rp_name'), false); ?>">
				            </div>
				        </div>
				    </div>
				    <div class="col-md-4">
				    	<p><strong><?php echo app('translator')->get('lang_v1.available'); ?>:</strong> <span id="available_rp"><?php echo e($redeem_details['points'] ?? 0, false); ?></span></p>
				    </div>
				    <div class="col-md-4">
				    	<p><strong><?php echo app('translator')->get('lang_v1.redeemed_amount'); ?>:</strong> (-)<span id="rp_redeemed_amount_text"><?php echo e(number_format($transaction->rp_redeemed_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span></p>
				    </div>
			    </div>
			    <div class="col-md-4">
			    	<div class="form-group">
			            <?php echo Form::label('tax_rate_id', __('sale.order_tax') . ':*' ); ?>

			            <div class="input-group">
			                <span class="input-group-text">
			                    <i class="fa fa-info"></i>
			                </span>
			                <?php echo Form::select('tax_rate_id', $taxes['tax_rates'], $transaction->tax_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control', 'data-default'=> $business_details->default_sales_tax], $taxes['attributes']); ?>


							<input type="hidden" name="tax_calculation_amount" id="tax_calculation_amount" 
							value="<?php echo e(number_format($transaction->tax?->amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" data-default="<?php echo e($business_details->tax_calculation_amount, false); ?>">
			            </div>
			        </div>
			    </div>
			    <div class="col-md-4 col-md-offset-4">
			    	<b><?php echo app('translator')->get( 'sale.order_tax' ); ?>:</b>(+) 
					<span class="display_currency" id="order_tax"><?php echo e($transaction->tax_amount, false); ?></span>
			    </div>
			    <div class="clearfix"></div>
				<div class="col-md-4">
					<div class="form-group">
			            <?php echo Form::label('shipping_details', __('sale.shipping_details')); ?>

			            <div class="input-group">
							<span class="input-group-text">
			                    <i class="fa fa-info"></i>
			                </span>
			                <?php echo Form::textarea('shipping_details',$transaction->shipping_details, ['class' => 'form-control','placeholder' => __('sale.shipping_details') ,'rows' => '1', 'cols'=>'30']); ?>

			            </div>
			        </div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<?php echo Form::label('shipping_charges', __('sale.shipping_charges')); ?>

						<div class="input-group">
						<span class="input-group-text">
						<i class="fa fa-info"></i>
						</span>
						<?php echo Form::text('shipping_charges',number_format($transaction->shipping_charges, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']),['class'=>'form-control input_number','placeholder'=> __('sale.shipping_charges')]); ?>

						</div>
					</div>
				</div>
			    <div class="col-md-4 col-md-offset-8">
			    	<div><b><?php echo app('translator')->get('sale.total_payable'); ?>: </b>
						<input type="hidden" name="final_total" id="final_total_input">
						<span id="total_payable">0</span>
					</div>
			    </div>
			    <div class="col-md-12">
			    	<div class="form-group">
						<?php echo Form::label('update_note',__('repair::lang.update_note') . ':'); ?>

						<?php echo Form::textarea('update_note', null, ['class' => 'form-control', 'rows' => 3]); ?>

					</div>
			    </div>
			    <input type="hidden" name="is_direct_sale" value="1">
			    <div class="col-md-12">
			    	<button type="button" class="btn btn-primary float-end" id="submit-sell"><?php echo app('translator')->get('messages.update'); ?></button>
			    </div>
			<?php echo $__env->renderComponent(); ?>

		</div>
	</div>
	<?php if(in_array('subscription', $enabled_modules)): ?>
		<?php echo $__env->make('sale_pos.partials.recurring_invoice_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php endif; ?>
	<?php echo Form::close(); ?>

</section>

<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	<?php echo $__env->make('contact.create', ['quick_add' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<!-- /.content -->
<div class="modal fade register_details_modal" tabindex="-1" role="dialog" 
	aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade close_register_modal" tabindex="-1" role="dialog" 
	aria-labelledby="gridSystemModalLabel">
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('js/pos.js?v=' . $asset_v), false); ?>"></script>
	<?php echo $__env->make('repair::layouts.partials.javascripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<script type="text/javascript">
		$(document).ready( function() {
			// lock.setPattern('<?php echo e($transaction->repair_security_pattern, false); ?>');

			<?php echo $__env->make('repair::repair.partials.repair_status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			
			$("select#repair_status_id").val(<?php echo e($transaction->repair_status_id, false); ?>).change();
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>