
<?php $__env->startSection('title', __('manufacturing::lang.production')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('manufacturing::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('manufacturing::lang.production'); ?> </h1>
</section>

<!-- Main content -->
<section class="content">

	<?php echo Form::open(['url' => action([\Modules\Manufacturing\Http\Controllers\ProductionController::class, 'update'], [$production_purchase->id]), 'method' => 'put', 'id' => 'production_form', 'files' => true ]); ?>

	<?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
		<div class="row">
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
					<?php echo Form::select('location_id', $business_locations, $production_purchase->location_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); ?>

				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('ref_no', __('purchase.ref_no').':'); ?>

					<?php echo Form::text('ref_no', $production_purchase->ref_no, ['class' => 'form-control']); ?>

				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('transaction_date', __('manufacturing::lang.mfg_date') . ':*'); ?>

					<div class="input-group">
						<span class="input-group-text">
							<i class="fa fa-calendar"></i>
						</span>
						<?php echo Form::text('transaction_date', \Carbon::createFromTimestamp(strtotime($production_purchase->transaction_date))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'readonly', 'required']); ?>

					</div>
				</div>
			</div>
			
			<?php
				$purchase_line = $production_purchase->purchase_lines[0];
			?>
			<div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('upload_document', __('purchase.attach_document') . ':'); ?>

                    <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
                    <?php echo Form::file('documents[]', ['id' => 'upload_document', 'multiple', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); ?>

                    <?php echo $__env->make('sell.partials.media_table', ['medias' => $production_purchase->media, 'delete' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('variation_id_shown', __('sale.product').':*'); ?>

					<?php echo Form::select('variation_id_shown', $recipe_dropdown, $purchase_line->variation_id, ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'required', 'disabled']); ?>

					<?php echo Form::hidden('variation_id', $purchase_line->variation_id, ['id' => 'variation_id']); ?>

					<p id="production_current_stock" class="help-block mt-1" data-last-production-unit-cost="<?php echo e(!is_null($last_production_unit_cost) ? $last_production_unit_cost : '', false); ?>">
						<strong>Current stock Quantity:</strong>
						<span id="production_current_stock_qty"><?php echo e($formatted_current_stock, false); ?></span>
						<span id="production_current_stock_unit"><?php echo e($unit_name, false); ?></span>
						<br>
						<strong>Last production unit cost price:</strong>
						<span id="production_last_unit_cost"><?php echo e($formatted_last_production_unit_cost ?? '--', false); ?></span>
						<span id="production_last_unit_cost_unit"><?php echo e(!is_null($last_production_unit_cost) ? '/ ' . $unit_name : '', false); ?></span>
						<br>
						<strong>Current production unit cost price:</strong>
						<span id="production_current_unit_cost">--</span>
						<span id="production_current_unit_cost_unit">/ <?php echo e($unit_name, false); ?></span>
						<br>
						<strong>Difference:</strong>
						<span id="production_unit_cost_difference" class="text-muted">--</span>
					</p>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('recipe_quantity', __('lang_v1.quantity').':*'); ?>

					<div class="<?php if(!empty($sub_units)): ?> input_inline <?php else: ?> input-group <?php endif; ?>" id="recipe_quantity_input">
						<?php echo Form::text('quantity', number_format($quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number input_quantity', 'id' => 'recipe_quantity', 'required', 'data-rule-notEmpty' => 'true', 'data-rule-notEqualToWastedQuantity' => 'true', 'data-decimal' => session('business.quantity_precision', 2) > 0 ? '1' : '0']); ?>

						<span class="<?php if(empty($sub_units)): ?> input-group-text <?php endif; ?>" id="unit_html">
							<?php if(!empty($sub_units)): ?>
								<select name="sub_unit_id" class="form-control" id="sub_unit_id">
								<?php $__currentLoopData = $sub_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option 
										value="<?php echo e($key, false); ?>" 
										data-multiplier="<?php echo e($value['multiplier'], false); ?>" 
										data-unit_name="<?php echo e($value['name'], false); ?>"
										<?php if($key == $sub_unit_id): ?>
											<?php
												$unit_name = $value['name'];
											?>
											selected
										<?php endif; ?>
										><?php echo e($value['name'], false); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							<?php else: ?>
								<?php echo e($unit_name, false); ?>

							<?php endif; ?>
						</span>
					</div>
				</div>
			</div>

			
		</div>
	<?php echo $__env->renderComponent(); ?>

	<?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('manufacturing::lang.production_planning'), 'collapsible' => true, 'collapsed' => true]); ?>
		<div class="row">
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('mfg_production_status', __('manufacturing::lang.production_status').':'); ?>

					<?php echo Form::select('mfg_production_status', [
						'planned' => __('manufacturing::lang.status_planned'),
						'in_progress' => __('manufacturing::lang.status_in_progress'),
						'quality_check' => __('manufacturing::lang.status_quality_check'),
						'completed' => __('manufacturing::lang.status_completed'),
						'on_hold' => __('manufacturing::lang.status_on_hold'),
						'cancelled' => __('manufacturing::lang.status_cancelled'),
					], $production_purchase->mfg_production_status, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('mfg_priority', __('manufacturing::lang.priority').':'); ?>

					<?php echo Form::select('mfg_priority', [
						'low' => __('manufacturing::lang.priority_low'),
						'normal' => __('manufacturing::lang.priority_normal'),
						'high' => __('manufacturing::lang.priority_high'),
						'urgent' => __('manufacturing::lang.priority_urgent'),
					], $production_purchase->mfg_priority, ['class' => 'form-control select2']); ?>

				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('mfg_due_date', __('manufacturing::lang.due_date').':'); ?>

					<div class="input-group">
						<span class="input-group-text"><i class="fa fa-calendar"></i></span>
						<?php echo Form::text('mfg_due_date', !empty($production_purchase->mfg_due_date) ? \Carbon::createFromTimestamp(strtotime($production_purchase->mfg_due_date))->format(session('business.date_format')) : null, ['class' => 'form-control', 'readonly', 'id' => 'mfg_due_date']); ?>

					</div>
				</div>
			</div>
			<?php if(!empty($manufacturing_settings['enable_batch_tracking'])): ?>
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('mfg_batch_number', __('manufacturing::lang.batch_number').':'); ?>

					<?php echo Form::text('mfg_batch_number', $production_purchase->mfg_batch_number, ['class' => 'form-control']); ?>

				</div>
			</div>
			<?php endif; ?>
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('mfg_expected_quantity', __('manufacturing::lang.expected_quantity').':'); ?>

					<?php echo Form::text('mfg_expected_quantity', !empty($production_purchase->mfg_expected_quantity) ? number_format($production_purchase->mfg_expected_quantity, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : null, ['class' => 'form-control input_number']); ?>

				</div>
			</div>
			<?php if(!empty($manufacturing_settings['enable_enhanced_costs'])): ?>
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('mfg_labor_cost', __('manufacturing::lang.labor_cost').':'); ?>

					<?php echo Form::text('mfg_labor_cost', number_format($production_purchase->mfg_labor_cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number']); ?>

				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('mfg_overhead_cost', __('manufacturing::lang.overhead_cost').':'); ?>

					<?php echo Form::text('mfg_overhead_cost', number_format($production_purchase->mfg_overhead_cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number']); ?>

				</div>
			</div>
			<?php endif; ?>
			<div class="col-sm-12">
				<div class="form-group">
					<?php echo Form::label('mfg_notes', __('manufacturing::lang.production_notes').':'); ?>

					<?php echo Form::textarea('mfg_notes', $production_purchase->mfg_notes, ['class' => 'form-control', 'rows' => 3]); ?>

				</div>
			</div>
		</div>
	<?php echo $__env->renderComponent(); ?>

	<?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('manufacturing::lang.ingredients')]); ?>
		<div class="row">
			<div class="col-md-12">
				<div id="enter_ingredients_table">
					<?php echo $__env->make('manufacturing::recipe.ingredients_for_production', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<?php if(request()->session()->get('business.enable_lot_number') == 1): ?>
				<div class="col-sm-3">
					<div class="form-group">
						<?php echo Form::label('lot_number', __('lang_v1.lot_number').':'); ?>

						<?php echo Form::text('lot_number', $purchase_line->lot_number, ['class' => 'form-control']); ?>

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
							<?php echo Form::text('exp_date', !empty($purchase_line->exp_date) ? \Carbon::createFromTimestamp(strtotime($purchase_line->exp_date))->format(session('business.date_format')) : null, ['class' => 'form-control', 'readonly']); ?>

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
						<?php echo Form::text('mfg_wasted_units', number_format($production_purchase->mfg_wasted_units, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number']); ?>

						<span class="input-group-text" id="wasted_units_text"><?php echo e($unit_name, false); ?></span>
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
						<?php echo Form::text('production_cost', number_format($production_purchase->mfg_production_cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number']); ?>

						<span>
							<?php echo Form::select('mfg_production_cost_type',['fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage'), 'per_unit' => __('manufacturing::lang.per_unit')], $production_purchase->mfg_production_cost_type, ['class' => 'form-control', 'id' => 'mfg_production_cost_type']); ?>	
						</span>
					</div>
					<p><strong>
						<?php echo e(__('manufacturing::lang.total_production_cost'), false); ?>:
					</strong>
					<span id="total_production_cost" class="display_currency" data-currency_symbol="true"><?php echo e($total_production_cost, false); ?></span></p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<?php echo Form::label('mfg_instructions', __('manufacturing::lang.recipe_instructions').':'); ?>

					<textarea id="recipe_instructions_display" name="mfg_instructions" class="form-control" rows="3"><?php echo e(!empty($production_purchase->mfg_instructions) ? $production_purchase->mfg_instructions : ((!empty($recipe) && !empty($recipe->instructions)) ? strip_tags($recipe->instructions) : ''), false); ?></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-md-offset-9">
				<?php echo Form::hidden('final_total', number_format($production_purchase->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['id' => 'final_total']); ?>

				<strong>
					<?php echo e(__('manufacturing::lang.total_cost'), false); ?>:
				</strong>
				<span id="final_total_text" class="display_currency" data-currency_symbol="true"><?php echo e($production_purchase->final_total, false); ?></span>
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

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<?php echo $__env->make('manufacturing::production.production_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<script type="text/javascript">
		$(document).ready( function () {
			calculateRecipeTotal();
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>