<?php
	$allow_edit_on_production = !empty($recipe) && !empty($recipe->allow_editing_ingredient_qty_in_production);
	$disable_editing_ingredient_qty = !empty($manufacturing_settings['disable_editing_ingredient_qty']) && empty($allow_edit_on_production);
?>
<?php if(!$disable_editing_ingredient_qty): ?> 
<div class="col-md-10 col-md-offset-1">
	<div class="form-group text-left">
		<?php echo Form::label('search_product', __('manufacturing::lang.select_ingredient').':'); ?>

		<div class="input-group ">
			<div class="input-group-btn">
				<button type="button" class="btn btn-default bg-white btn-flat" id="open_products_search_modal" title="<?php echo e(__('lang_v1.products_search'), false); ?>"><i class="fas fa-search"></i></button>
			</div>
			<?php echo Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product', 'placeholder' => __('manufacturing::lang.select_ingredient'), 'autofocus' => true ]); ?>

		</div>
	</div>
</div>
<div class="clearfix"></div>
<?php endif; ?>
<div class="table-responsive">
<table class="table table-striped table-th-green text-center" id="ingredients_for_unit_recipe_table" data-disable-editing-ingredient-qty="<?php echo e(!empty($disable_editing_ingredient_qty) ? 1 : 0, false); ?>">
	<thead>
		<tr>
			<th><?php echo app('translator')->get('manufacturing::lang.ingredient'); ?></th>
			<th><?php echo app('translator')->get('manufacturing::lang.input_quantity'); ?></th>
			<th><?php echo app('translator')->get('manufacturing::lang.waste_percent'); ?></th>
			<th><?php echo app('translator')->get('manufacturing::lang.final_quantity'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('manufacturing::lang.final_quantity_tooltip') . '"></i>';
                }
            ?></th>
			<th><?php echo app('translator')->get('manufacturing::lang.total_price'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('manufacturing::lang.total_price_tooltip') . '"></i>';
                }
            ?></th>
			<?php if(!$disable_editing_ingredient_qty): ?> 
			<th></th>
			<?php endif; ?>
		</tr>
	</thead>
	<tbody>
		<?php
			$total_ingredient_price = 0;
			$row_index = 0;
			$ingredient_quantity = 0;
			$ingredient_groups = [];
		?>
		<?php if(!empty($ingredients)): ?>
			<?php $__currentLoopData = $ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			
				<?php if(empty($ingredient['mfg_ingredient_group_id'])): ?>
					<?php echo $__env->make('manufacturing::recipe.ingredient_row_for_production', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					<?php
						$row_index = $loop->index;
						$row_index++;
					?>
				<?php else: ?>
					<?php
						$ingredient_groups[$ingredient['mfg_ingredient_group_id']][] = $ingredient;
						$ingredient_obj = (object) $ingredient;
						$quantity = $ingredient_obj->quantity;
						$ingredient_quantity += $quantity;
					?>
				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php $__currentLoopData = $ingredient_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr class="bg-gray ingredient_group_row">
					<td colspan="5" style="text-align: left;"><strong><?php echo e($ingredient_group[0]['ingredient_group_name'] ?? '', false); ?></strong></td>
				</tr>
				<?php $__currentLoopData = $ingredient_group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php echo $__env->make('manufacturing::recipe.ingredient_row_for_production', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>
	</tbody>
	<tfoot>
		
		<tr>
			<td colspan="4" style="text-align: right;"><strong><?php echo app('translator')->get('manufacturing::lang.ingredients_quantity'); ?></strong></td>
			<td><span class="display_currency" name="ingredients_quantity" id="total_ingredient_quantity"><?php echo e($ingredient_quantity, false); ?></span>
			</td>
		</tr>
		<tr>
			<td colspan="4" style="text-align: right;"><strong><?php echo app('translator')->get('manufacturing::lang.ingredients_cost'); ?></strong></td>
			<td><span class="display_currency" data-currency_symbol="true" id="total_ingredient_price"><?php echo e($total_ingredient_price, false); ?></span>
				<input type="hidden" id="waste_percent" value="<?php echo e($recipe->waste_percent ?? 0, false); ?>">
			</td>
		</tr>
	</tfoot>
</table>
</div>

<input type="hidden" id="row_index" value="<?php echo e($row_index, false); ?>">
