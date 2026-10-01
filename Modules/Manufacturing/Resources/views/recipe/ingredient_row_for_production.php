<?php
	$disable_editing_ingredient_qty = $disable_editing_ingredient_qty ?? false;
?>
<tr>
	<td>
		<?php echo e($ingredient['full_name'], false); ?>

		<?php
			$current_stock = $ingredient['qty_available'] ?? 0;
			$current_stock_multiplier = !empty($ingredient['multiplier']) ? $ingredient['multiplier'] : 1;
			$current_stock_display = !empty($current_stock_multiplier) ? $current_stock / $current_stock_multiplier : $current_stock;
		?>
		<p class="help-block ingredient-current-stock mb-0 mt-1">
			<strong>Current stock Quantity:</strong>
			<span class="ingredient_current_stock_qty" data-current-stock-base="<?php echo e($current_stock, false); ?>"><?php echo e(number_format($current_stock_display, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
			<span class="ingredient_current_stock_unit"><?php echo e($ingredient['unit'], false); ?></span>
		</p>
		<input type="hidden" name="ingredients[<?php echo e($ingredient['id'], false); ?>][price]" class="ingredient_price" value="<?php echo e($ingredient['dpp_inc_tax'], false); ?>">
		<input type="hidden" name="ingredients[<?php echo e($ingredient['id'], false); ?>][variation_id]"  class="ingredient_id" value="<?php echo e($ingredient['variation_id'], false); ?>">
		<input type="hidden" class="unit_quantity" value="<?php echo e($ingredient['unit_quantity'], false); ?>">
		<input type="hidden" name="ingredients[<?php echo e($ingredient['id'], false); ?>][mfg_ingredient_group_id]" value="<?php echo e($ingredient['mfg_ingredient_group_id'], false); ?>">
		<input type="hidden" class="total_quantity" name="ingredients[<?php echo e($ingredient['id'], false); ?>][quantity]" value="<?php echo e($ingredient['quantity'], false); ?>">
		<?php $__currentLoopData = $ingredient['purchase_lines']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php
				if(!empty($pl->transaction) && $pl->transaction->status == 'received'){
					$available_qty = $pl->quantity - $pl->quantity_sold - $pl->quantity_adjusted - $pl->quantity_returned - $pl->mfg_quantity_used;
					$available_qty = round($available_qty, 4);
					if($available_qty <= 0){
						continue;
					}
				}else{
					continue;
				}
			?>
			<input type="hidden" class="ingredient_pl" data-plid="<?php echo e($pl->id, false); ?>" data-quantity="<?php echo e($available_qty, false); ?>" data-price="<?php echo e($pl->purchase_price_inc_tax, false); ?>">
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php if(!empty($ingredient['not_in_recipe'])): ?>
			<input type="hidden" name='not_in_recipe[]' value="<?php echo e($ingredient['id'], false); ?>">
		<?php endif; ?>
	</td>
	<td>
		<div class="<?php if(!empty($ingredient['sub_units'])): ?> input_inline <?php else: ?> input-group <?php endif; ?>">
			<input 
			type="text" 
			data-min="1" 
			class="form-control input-sm input_number input_quantity mousetrap total_quantities total_batches"
			value="<?php echo e(number_format($ingredient['quantity'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" 
			name="ingredients[<?php echo e($ingredient['id'], false); ?>][quantity]" 
			data-allow-overselling="<?php if(empty($pos_settings['allow_overselling'])): ?><?php echo e('false', false); ?><?php else: ?><?php echo e('true', false); ?><?php endif; ?>"
			<?php if($ingredient['allow_decimal']): ?> 
				data-allow-decimal=1 
			<?php else: ?> 
				data-decimal=0 
				data-rule-abs_digit="true" 
				data-msg-abs_digit="<?php echo app('translator')->get('lang_v1.decimal_value_not_allowed'); ?>" 
			<?php endif; ?> 
				data-rule-required="true" 
				data-msg-required="<?php echo app('translator')->get('validation.custom-messages.this_field_is_required'); ?>" 
			<?php if($ingredient['enable_stock'] == 1 && empty($pos_settings['allow_overselling']) && !empty($ingredient['qty_available']) && empty($disable_quantity_check)): ?> 	
				data-rule-max-value="<?php echo e($ingredient['qty_available'], false); ?>"  
				data-msg-max-value="<?php echo e('Maximum Available Qty is '.number_format($ingredient['qty_available']).'', false); ?>" 
				data-qty_available="<?php echo e($ingredient['qty_available'], false); ?>"
			<?php endif; ?> 

			<?php if($disable_editing_ingredient_qty): ?>
			disabled
			<?php endif; ?>
			>
			<span class="<?php if(empty($ingredient['sub_units'])): ?> input-group-text <?php endif; ?> line_unit_span">
			<?php if(empty($ingredient['sub_units'])): ?> 
				<?php echo e($ingredient['unit'], false); ?>

			<?php else: ?>
				<select name="ingredients[<?php echo e($ingredient['id'], false); ?>][sub_unit_id]" class="input-sm form-control sub_unit" 
				<?php if($disable_editing_ingredient_qty): ?>
				disabled="" 
				<?php endif; ?>
			>
					<?php $__currentLoopData = $ingredient['sub_units']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option 
							value="<?php echo e($key, false); ?>" 
							data-allow_decimal="<?php echo e($value['allow_decimal'], false); ?>"
							data-multiplier="<?php echo e($value['multiplier'], false); ?>"
							data-unit_name="<?php echo e($value['name'], false); ?>"
							<?php if($ingredient['sub_unit_id'] == $key): ?> selected <?php endif; ?>><?php echo e($value['name'], false); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>

				<?php if($disable_editing_ingredient_qty): ?>
					<input type="hidden" name="ingredients[<?php echo e($ingredient['id'], false); ?>][sub_unit_id]" value="<?php echo e($ingredient['sub_unit_id'], false); ?>">
				<?php endif; ?>
			<?php endif; ?>
			</span>
		</div>
	</td>
	<td>
		<div class="input-group">
			<input type="text" name="ingredients[<?php echo e($ingredient['id'], false); ?>][mfg_waste_percent]" value="<?php echo e(number_format($ingredient['waste_percent'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" class="form-control input-sm input_number mfg_waste_percent">
			<span class="input-group-text"><i class="fa fa-percent"></i></span>
		</div>
	</td>
	<td>
		<span class="row_final_quantity"><?php echo e(number_format($ingredient['final_quantity'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span> <span class="row_unit_text"><?php echo e($ingredient['unit'], false); ?></span>
	</td>
	<td>
		<span class="ingredient_total_price display_currency" data-currency_symbol="true"><?php echo e(number_format($ingredient['total_price'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
		<input type="hidden" class="total_price" value="<?php echo e($ingredient['total_price'], false); ?>">
	</td>
	<?php if(!$disable_editing_ingredient_qty): ?>
	<td>
		<button type="button" class="btn btn-danger btn-xs remove_ingredient"><i class="fas fa-times"></i></button>
	</td>
	<?php endif; ?>
</tr>
