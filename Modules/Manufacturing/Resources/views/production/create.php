
<?php $__env->startSection('title', __('manufacturing::lang.production')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('manufacturing::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('manufacturing::lang.production'); ?> </h1>
</section>

<!-- Main content -->
<section class="content">

	<?php echo Form::open(['url' => action([\Modules\Manufacturing\Http\Controllers\ProductionController::class, 'store']), 'method' => 'post', 'id' => 'production_form', 'files' => true ]); ?>

	<?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
		<div class="row">
			<?php if(empty($default_location)): ?>
				<?php if(count($business_locations) == 1): ?>
					<?php 
						$default_location = current(array_keys($business_locations->toArray()));
					?>
				<?php endif; ?>
			<?php endif; ?>
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('location_id', __('purchase.business_location').':*'); ?>

					<?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.purchase_location') . '"></i>';
                }
            ?>
					<?php echo Form::select('location_id', $business_locations, $default_location, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); ?>

				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('ref_no', __('purchase.ref_no').':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('manufacturing::lang.ref_no_tooltip') . '"></i>';
                }
            ?>
					<?php echo Form::text('ref_no', null, ['class' => 'form-control']); ?>

				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('transaction_date', __('manufacturing::lang.mfg_date') . ':*'); ?>

					<div class="input-group">
						<span class="input-group-text">
							<i class="fa fa-calendar"></i>
						</span>
						<?php echo Form::text('transaction_date', \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'readonly', 'required']); ?>

					</div>
				</div>
			</div>
			
			<div class="col-sm-3">
                <div class="form-group">
                    <?php echo Form::label('upload_document', __('purchase.attach_document') . ':'); ?>

                    <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
                    <?php echo Form::file('documents[]', ['id' => 'upload_document', 'multiple', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); ?>

                </div>
            </div>

			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('variation_id', __('sale.product').':*'); ?>

					<?php echo Form::select('variation_id', $recipe_dropdown, null, array_merge(['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required'], empty($default_location) ? ['disabled' => 'disabled', 'id' => 'variation_id'] : ['id' => 'variation_id'])); ?>

					<?php echo Form::hidden('sales_order_line_id', null, ['id' => 'sales_order_line_id']); ?>

					<?php
						$pos_settings = !empty(session('business.pos_settings')) ? json_decode(session('business.pos_settings'), true) : [];
					?>
					<?php if(!empty($pos_settings['enable_order_request_custom1'])): ?>
					<br>	
					<br>
						<button type="button" class="btn btn-primary btn-sm mt-1" id="btn_select_sales_order" data-bs-toggle="modal" data-bs-target="#sales_orders_modal">
							<i class="fa fa-list"></i> Select from Sales Orders
						</button>
					<?php endif; ?>
					<p id="production_current_stock" class="help-block mt-1" style="display: none;">
						<strong>Current stock Quantity:</strong>
						<span id="production_current_stock_qty">0.00</span>
						<span id="production_current_stock_unit"></span>
						<br>
						<strong>Last production unit cost price:</strong>
						<span id="production_last_unit_cost">--</span>
						<span id="production_last_unit_cost_unit"></span>
						<br>
						<strong>Current production unit cost price:</strong>
						<span id="production_current_unit_cost">--</span>
						<span id="production_current_unit_cost_unit"></span>
						<br>
						<strong>Difference:</strong>
						<span id="production_unit_cost_difference" class="text-muted">--</span>
					</p>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('number_of_batches', __('lang_v1.number_of_batches').':*'); ?>

					<div class="input-group" id="number_of_batches_input">
						<?php echo Form::text('quantity', 1, ['class' => 'form-control input_number input_quantity', 'id' => 'number_of_batches', 'required', 'data-rule-notEmpty' => 'true', 'data-rule-notEqualToWastedQuantity' => 'true', 'data-decimal' => session('business.quantity_precision', 2) > 0 ? '1' : '0']); ?>

						<span class="input-group-text" id="unit_html_no"></span>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('recipe_quantity', __('lang_v1.quantity').':*'); ?>

					<div class="input-group" id="recipe_quantity_input">
						<?php echo Form::text('quantity', 1, ['class' => 'form-control input_number input_quantity', 'id' => 'recipe_quantity', 'required', 'data-rule-notEmpty' => 'true', 'data-rule-notEqualToWastedQuantity' => 'true', 'data-decimal' => session('business.quantity_precision', 2) > 0 ? '1' : '0']); ?>

						<span class="input-group-text" id="unit_html"></span>
					</div>
				</div>
			</div>
			
		</div>
	<?php echo $__env->renderComponent(); ?>

	
	<?php $__env->startComponent('components.widget', ['class' => 'box-info', 'title' => __('manufacturing::lang.production_planning'), 'collapsible' => true, 'collapsed' => true]); ?>
		<div class="row">
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('mfg_production_status', __('manufacturing::lang.production_status').':'); ?>

					<?php echo Form::select('mfg_production_status', \Modules\Manufacturing\Utils\ManufacturingUtil::productionStatuses(), 'planned', ['class' => 'form-control select2']); ?>

				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('mfg_priority', __('manufacturing::lang.priority').':'); ?>

					<?php echo Form::select('mfg_priority', \Modules\Manufacturing\Utils\ManufacturingUtil::priorityLevels(), 'normal', ['class' => 'form-control select2']); ?>

				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('mfg_due_date', __('manufacturing::lang.due_date').':'); ?>

					<div class="input-group">
						<span class="input-group-text"><i class="fa fa-calendar"></i></span>
						<?php echo Form::text('mfg_due_date', null, ['class' => 'form-control', 'readonly', 'id' => 'mfg_due_date']); ?>

					</div>
				</div>
			</div>
			<?php if(!empty($manufacturing_settings['enable_batch_tracking'])): ?>
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('mfg_batch_number', __('manufacturing::lang.batch_number').':'); ?>

					<?php echo Form::text('mfg_batch_number', null, ['class' => 'form-control', 'placeholder' => __('manufacturing::lang.batch_number_placeholder')]); ?>

				</div>
			</div>
			<?php endif; ?>
		</div>
		<div class="row">
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('mfg_expected_quantity', __('manufacturing::lang.expected_quantity').':'); ?>

					<?php echo Form::text('mfg_expected_quantity', null, ['class' => 'form-control input_number', 'placeholder' => __('manufacturing::lang.expected_quantity')]); ?>

				</div>
			</div>
			<?php if(!empty($manufacturing_settings['enable_enhanced_costs'])): ?>
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('mfg_labor_cost', __('manufacturing::lang.labor_cost').':'); ?>

					<?php echo Form::text('mfg_labor_cost', 0, ['class' => 'form-control input_number']); ?>

				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('mfg_overhead_cost', __('manufacturing::lang.overhead_cost').':'); ?>

					<?php echo Form::text('mfg_overhead_cost', 0, ['class' => 'form-control input_number']); ?>

				</div>
			</div>
			<?php endif; ?>
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('mfg_notes', __('manufacturing::lang.production_notes').':'); ?>

					<?php echo Form::textarea('mfg_notes', null, ['class' => 'form-control', 'rows' => 2, 'placeholder' => __('manufacturing::lang.production_notes_placeholder')]); ?>

				</div>
			</div>
		</div>
	<?php echo $__env->renderComponent(); ?>

	<?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('manufacturing::lang.ingredients')]); ?>
		<div class="row">
			<div class="col-md-12">
				<div id="enter_ingredients_table" class="text-center">
					<i><?php echo app('translator')->get('manufacturing::lang.add_ingredients_tooltip'); ?></i>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<?php if(request()->session()->get('business.enable_lot_number') == 1): ?>
				<div class="col-sm-3">
					<div class="form-group">
						<?php echo Form::label('lot_number', __('lang_v1.lot_number').':'); ?>

						<?php echo Form::text('lot_number', null, ['class' => 'form-control']); ?>

					</div>
				</div>
			<?php endif; ?>
			<?php if(session('business.enable_product_expiry')): ?>
				<div class="col-sm-3">
					<div class="form-group">
						<?php echo Form::label('exp_date', __('product.exp_date').':*'); ?>

						<div class="input-group">
							<span class="input-group-text">
								<i class="fa fa-calendar"></i>
							</span>
							<?php echo Form::text('exp_date', null, ['class' => 'form-control', 'readonly']); ?>

						</div>
					</div>
				</div>
			<?php endif; ?>
			<div class="col-md-3">
				<div class="form-group">
					<?php echo Form::label('mfg_wasted_units', __('manufacturing::lang.waste_units').':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('manufacturing::lang.wastage_tooltip') . '"></i>';
                }
            ?>
					<div class="input-group">
						<?php echo Form::text('mfg_wasted_units', 0, ['class' => 'form-control input_number']); ?>

						<span class="input-group-text" id="wasted_units_text"></span>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<?php echo Form::label('production_cost', __('manufacturing::lang.production_cost').':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('manufacturing::lang.production_cost_tooltip') . '"></i>';
                }
            ?>
					<div class="input_inline">
						<?php echo Form::text('production_cost', 0, ['class' => 'form-control input_number']); ?>

						<span>
							<?php echo Form::select('mfg_production_cost_type',['fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage'), 'per_unit' => __('manufacturing::lang.per_unit')], 'fixed', ['class' => 'form-control', 'id' => 'mfg_production_cost_type']); ?>	
						</span>
					</div>
					<p><strong>
					<?php echo e(__('manufacturing::lang.total_production_cost'), false); ?>:
				</strong>
				<span id="total_production_cost" class="display_currency" data-currency_symbol="true">0</span></p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<?php echo Form::label('mfg_instructions', __('manufacturing::lang.recipe_instructions').':'); ?>

					<textarea id="recipe_instructions_display" name="mfg_instructions" class="form-control" rows="3" placeholder="<?php echo app('translator')->get('manufacturing::lang.recipe_instructions'); ?>"></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-md-offset-9">
				<?php echo Form::hidden('final_total', 0, ['id' => 'final_total']); ?>

				<strong>
					<?php echo e(__('manufacturing::lang.total_cost'), false); ?>:
				</strong>
				<span id="final_total_text" class="display_currency" data-currency_symbol="true">0</span>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-md-offset-9">
				<div class="form-group">
					<br>
					<div class="form-check">
						<label class="form-check-label">
<?php echo Form::checkbox('finalize', 1, false, ['class' => 'form-check-input', 'id' => 'finalize']); ?> <?php echo app('translator')->get('manufacturing::lang.finalize'); ?>
						</label> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('manufacturing::lang.finalize_tooltip') . '"></i>';
                }
            ?>
					</div>
		        </div>
			</div>
		</div>
		<div id="production-footer-actions-template" class="d-none">
			<button type="submit" class="btn btn-primary" form="production_form"><i class="fas fa-check"></i> <?php echo app('translator')->get('messages.submit'); ?></button>
		</div>
	<?php echo $__env->renderComponent(); ?>
	<?php echo Form::close(); ?>

	<div class="modal fade" id="products_search_modal" tabindex="-1" data-bs-focus="false" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
	<div class="modal fade" id="product_qty_detail_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" style="z-index:1100;"></div>
	
	<div class="modal fade" id="sales_orders_modal" tabindex="-1" role="dialog" aria-labelledby="salesOrdersModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="salesOrdersModalLabel">Select Product from Sales Orders</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="table-responsive">
						<table class="table table-bordered table-striped" id="sales_orders_table" style="width: 100%;">
							<thead>
								<tr>
									<th>Date</th>
									<th>Ref No</th>
									<th>Invoice No</th>
									<th>Product</th>
									<th>SKU</th>
									<th>Quantity</th>
									<th>Action</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
				</div>
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<?php echo $__env->make('manufacturing::production.production_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>