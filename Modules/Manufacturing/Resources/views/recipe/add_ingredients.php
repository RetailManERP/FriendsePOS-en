
<?php $__env->startSection('title', __('manufacturing::lang.add_ingredients')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('manufacturing::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('manufacturing::lang.add_ingredients'); ?></h1>
</section>

<!-- Main content -->
<section class="content">
	<?php echo Form::open(['url' => action([\Modules\Manufacturing\Http\Controllers\RecipeController::class, 'store']), 'method' => 'post', 'id' => 'recipe_form' ]); ?>

	<div id="box_group">
	<div class="box box-primary">
		<div class="box-header"> 
			<h4 class="box-title"><strong><?php echo app('translator')->get('sale.product'); ?>: </strong>(<?php echo e($variation->sub_sku, false); ?>) <?php echo e($variation->product_name, false); ?> <?php if($variation->product_type == 'variable'): ?> - <?php echo e($variation->product_variation_name, false); ?> - <?php echo e($variation->name, false); ?> <?php endif; ?></h4>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<button type="button" class="btn btn-success float-end" id="add_ingredient_group"><?php echo app('translator')->get('manufacturing::lang.add_ingredient_group'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('manufacturing::lang.ingredient_group_tooltip') . '"></i>';
                }
            ?></button>
				</div>
				<div class="col-md-10 col-md-offset-1">
					<div class="form-group">
						<?php echo Form::label('search_product', __('manufacturing::lang.select_ingredient').':'); ?>


						<div class="input-group">
								<button type="button" class="btn btn-default bg-white btn-flat" id="open_products_search_modal" title="<?php echo e(__('lang_v1.products_search'), false); ?>"><i class="fas fa-search"></i></button>
							<?php echo Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product', 'placeholder' => __('manufacturing::lang.select_ingredient'), 'autofocus' => true ]); ?>


							<?php echo Form::hidden('variation_id', $variation->id); ?>

						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped table-th-green text-center ingredients_table">
						<thead>
							<tr>
								<th><?php echo app('translator')->get('manufacturing::lang.ingredient'); ?></th>
								<th><?php echo app('translator')->get('manufacturing::lang.waste_percent'); ?></th>
								<th><?php echo app('translator')->get('manufacturing::lang.final_quantity'); ?></th>
								<th><?php echo app('translator')->get('lang_v1.price'); ?></th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody class="ingredient-row-sortable">
							<?php
								$row_index = 0;
								$ingredient_groups = [];
								$ingredient_total = 0;
								$ingredient_quantity = 0;
							?>
							<?php if(!empty($ingredients)): ?>
								<?php $__currentLoopData = $ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php
										$ingredient_obj = (object) $ingredient;
										$price = !empty($ingredient_obj->quantity) ? $ingredient_obj->quantity * $ingredient_obj->dpp_inc_tax : $ingredient_obj->dpp_inc_tax;
										$price = $price * $ingredient_obj->multiplier;
										$ingredient_total += $price;
										$quantity = $ingredient_obj->quantity;
										$ingredient_quantity += $quantity;
									?>
									<?php if(empty($ingredient['mfg_ingredient_group_id'])): ?>
										<?php
											$row_index = $loop->index;
										?>

										<?php echo $__env->make('manufacturing::recipe.ingredient_row', ['ingredient' => (object) $ingredient, 'ig_index' => ''], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
										
										<?php
											$row_index++;
										?>
									<?php else: ?>
										<?php
											$ingredient_groups[$ingredient['mfg_ingredient_group_id']][] = $ingredient;
										?>
									<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
						</tbody>
					</table>
				</div>	
			</div>
			<hr>
			<div class="row">
				<div class="col-md-8 text-right">
					<strong><?php echo app('translator')->get('manufacturing::lang.ingredients_quantity'); ?>: </strong> 
					<span id="ingredients_quantity_text"><?php echo e(number_format($ingredient_quantity, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
					<input type="hidden" name="ingredients_quantity" id="ingredients_quantity" value="<?php echo e($recipe->ingredients_quantity ?? 0, false); ?>">
				</div>
			
				<div class="col-md-4 text-left">
					<strong><?php echo app('translator')->get('manufacturing::lang.ingredients_cost'); ?>: </strong> 
					<span id="ingredients_cost_text"><?php echo e(number_format($ingredient_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
					<input type="hidden" name="ingredients_cost" id="ingredients_cost" value="<?php echo e($recipe->ingredients_cost ?? 0, false); ?>">
				</div>
			</div>
		</div>
	</div> <!--box end-->
	<?php
		$ig_index = 0;
	?>
	<?php $__currentLoopData = $ingredient_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php
			$ig_name = !empty($ingredient_group[0]['ingredient_group_name']) ? $ingredient_group[0]['ingredient_group_name'] : '';
			$ig_description = !empty($ingredient_group[0]['ig_description']) ? $ingredient_group[0]['ig_description'] : '';
		?>
		<?php echo $__env->make('manufacturing::recipe.ingredient_group', ['ingredients' => $ingredient_group, 'ig_index' => $ig_index, 'ig_name' => $ig_name, 'ig_description' => $ig_description], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php
			$ig_index++;
			$row_index += count($ingredient_group);
		?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
	<div class="box box-primary">
		<div class="box-body">
			<div class="row">
				<input type="hidden" id="row_index" value="<?php echo e($row_index, false); ?>">
				<input type="hidden" id="ig_index" value="<?php echo e($ig_index, false); ?>">
				
				<div class="col-md-3">
					<div class="form-group">
						<?php echo Form::label('waste_percent', __('manufacturing::lang.wastage').':'); ?> <?php
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
							<?php echo Form::text('waste_percent',!empty($recipe->waste_percent) ? number_format($recipe->waste_percent, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : 0, ['class' => 'form-control input_number', 'placeholder' => __('manufacturing::lang.wastage') ]); ?>

							<span class="input-group-text">
								<i class="fa fa-percent"></i>
							</span>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<?php echo Form::label('total_quantity', __('manufacturing::lang.total_output_quantity').':'); ?>

						<div class="<?php if(!is_array($unit_html)): ?> input-group <?php else: ?> input_inline <?php endif; ?>">
							<?php echo Form::text('total_quantity',!empty($recipe->total_quantity) ? number_format($recipe->total_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : 1, ['class' => 'form-control input_number', 'placeholder' => __('manufacturing::lang.total_output_quantity') ]); ?>

							<span class="<?php if(!is_array($unit_html)): ?> input-group-text <?php endif; ?>">
								<?php if(is_array($unit_html)): ?>
									<select name="sub_unit_id" class="form-control" id="sub_unit_id">
										<?php $__currentLoopData = $unit_html; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option 
												value="<?php echo e($key, false); ?>" 
												data-multiplier="<?php echo e($value['multiplier'], false); ?>"
												<?php if(!empty($recipe->sub_unit_id) && $recipe->sub_unit_id == $key): ?>
													selected
												<?php endif; ?>
											><?php echo e($value['name'], false); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								<?php else: ?>
									<?php echo e($unit_html, false); ?>

								<?php endif; ?>
							</span>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<?php echo Form::label('extra_cost', __('manufacturing::lang.production_cost').':'); ?> <?php
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
							<?php echo Form::text('extra_cost',!empty($recipe->extra_cost) ? number_format($recipe->extra_cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : 0, ['class' => 'form-control input_number', 'placeholder' => __('manufacturing::lang.extra_cost') ]); ?>

							<span>
								<?php echo Form::select('production_cost_type',['fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage'), 'per_unit' => __('manufacturing::lang.per_unit')], !empty($recipe->production_cost_type) ? $recipe->production_cost_type : 'fixed', ['class' => 'form-control', 'id' => 'production_cost_type']); ?>	
							</span>
						</div>
						<p><strong>
							<?php echo e(__('manufacturing::lang.total_production_cost'), false); ?>:
						</strong>
						<span id="total_production_cost" class="display_currency" data-currency_symbol="true"><?php echo e($total_production_cost, false); ?></span></p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<?php echo Form::label('total', __('sale.total').':'); ?>

						<div class="input-group">
							<?php
								$final_price = $ingredient_total;
								if(!empty($recipe->final_price)) {
									$final_price = $recipe->final_price;
								}

							?>
							<?php echo Form::text('total', number_format($final_price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['id' => 'total', 'class' => "form-control", 'readonly']); ?>

							<span class="input-group-text">
								<?php echo e($currency_details->symbol, false); ?>

							</span>
						</div>
					</div>
				</div>
				<?php if(!empty($manufacturing_settings['disable_editing_ingredient_qty'])): ?>
					<div class="col-md-3">
						<div class="form-group">
							<br>
							<div class="form-check">
								<label class="form-check-label">
									<?php echo Form::checkbox('allow_editing_ingredient_qty_in_production', 1, !empty($allow_editing_ingredient_qty_in_production), ['class' => 'form-check-input', 'id' => 'allow_editing_ingredient_qty_in_production']); ?>

									<?php echo app('translator')->get('manufacturing::lang.allow_edit_on_production'); ?>
								</label>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>	
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?php echo Form::label('instructions', __('manufacturing::lang.recipe_instructions').':'); ?>


						<?php echo Form::textarea('instructions',!empty($recipe) ? $recipe->instructions : null, ['class' => 'form-control', 'placeholder' => __('manufacturing::lang.recipe_instructions') ]); ?>

					</div>
				</div>
			</div>
			<br>
			<div id="recipe-footer-actions-template" class="d-none">
				<button type="submit" class="btn btn-primary" form="recipe_form"><i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?></button>
			</div>
		</div>
	</div>
<?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('modals'); ?>
	<div class="modal fade" id="products_search_modal" tabindex="-1" data-bs-focus="false" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
	<div class="modal fade" id="product_qty_detail_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" style="z-index:1100;"></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
	<?php echo $__env->make('manufacturing::layouts.partials.common_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<script type="text/javascript">
		$('.ingredient-row-sortable').sortable({
			cursor: "move",
			handle: ".handle",
			update: function(event, ui) {
				$(this).children().each(function(index) {
					$(this).find('input.sort_order').val(++index)
				});
			}
		});
		if ($('#search_product').length) {
			initialize_search($('#search_product'));
		}
		$('.search_product').each(function() {
			initialize_search($(this));
		});
		//Product Search Screen Functonality
		$(document).on('click', '#ps_select_products', function(e){
			e.preventDefault();
			if($('#products_search_results .ps-row-select:checked').length){
				toastr.success('Adding Products');
				$('#products_search_results .ps-row-select:checked').each(function() {
					addIngredientRow($(this).val(), $('input#search_product'));
					$('#row_index').val(parseInt($('#row_index').val())+1);
				});
				$('#products_search_modal').modal('hide');

			}else if($('#products_search_results .ps-row-select:focus').length){
				toastr.success('Adding Product');
				addIngredientRow($(this).val(), $('input#search_product'));
				$('#products_search_modal').modal('hide');

			}else{
				toastr.error('No products selected');
			}
		});

		$(document).on('dblclick', '#products_search_results tbody tr', function () {
			toastr.success('Adding Product');
			let variation_id = $(this).find('.ps-row-select').val();
			addIngredientRow(variation_id, $('input#search_product'));
			$('#products_search_modal').modal('hide');
		});

	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>