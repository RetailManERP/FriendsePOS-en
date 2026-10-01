
<?php $__env->startSection('title', __('manufacturing::lang.reverse_production')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('manufacturing::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('manufacturing::lang.reverse_production'); ?> </h1>
</section>

<!-- Main content -->
<section class="content">

	<?php echo Form::open(['url' => action([\Modules\Manufacturing\Http\Controllers\ReverseProductionController::class, 'store']), 'method' => 'post', 'id' => 'production_form', 'files' => true ]); ?>

	<?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
		<div class="row">
			<?php if(empty($default_location)): ?>
				<?php if(count($business_locations) == 1): ?>
					<?php 
						$default_location = current(array_keys($business_locations->toArray()));
					?>
				<?php else: ?>
					<?php
						$default_location = array_key_first($business_locations->toArray());
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

					<?php echo Form::select('variation_id', $recipe_dropdown, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); ?>

				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('select_lot_number', __('lang_v1.select_lot_number').':*'); ?>

					<?php echo Form::select('select_lot_number', [], null, ['class' => 'form-control', 'required']); ?>

					<?php echo Form::hidden('lot_number', null, ['id'=> 'lot_number']); ?>						
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('recipe_quantity', __('lang_v1.quantity').':*'); ?>

					<div class="input-group" id="recipe_quantity_input">
						<?php echo Form::text('quantity', 1, ['class' => 'form-control input_number', 'id' => 'recipe_quantity', 'required', 'data-rule-notEmpty' => 'true', 'data-rule-notEqualToWastedQuantity' => 'true']); ?>

						<span class="input-group-text" id="unit_html"></span>
					</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('lot_quantity_cost', __('lang_v1.lot_quantity_cost').':'); ?>

					<?php echo Form::text('lot_quantity_cost', null, ['class' => 'form-control input_number', 'id' => 'lot_quantity_cost', 'disabled']); ?>

					<?php echo Form::hidden('lot_quantity', null, ['class' => 'form-control', 'id' => 'lot_quantity']); ?>

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
		<div id="reverse-production-footer-actions-template" class="d-none">
			<button type="submit" class="btn btn-primary" form="production_form"><i class="fas fa-check"></i> <?php echo app('translator')->get('messages.submit'); ?></button>
		</div>
	<?php echo $__env->renderComponent(); ?>
	<?php echo Form::close(); ?>

	<div class="modal fade" id="products_search_modal" tabindex="-1" data-bs-focus="false" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
	<div class="modal fade" id="product_qty_detail_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" style="z-index:1100;"></div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<?php echo $__env->make('manufacturing::reverse_production.production_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>