<?php
	// Phase 62: prefer controller-supplied per-branch overlay; session is the fallback.
	$common_settings = isset($common_settings) && ! empty($common_settings)
		? $common_settings
		: session()->get('business.common_settings');

	$product_name = $product->product_name . '<br/>' . $product->sub_sku ;
	if(!empty($product->brand)){ $product_name .= ' ' . $product->brand ;}
?>
<tr class="product_row" data-row_index="<?php echo e($row_count, false); ?>">
	<td>
		<?php echo $product_name; ?>

		<input type="hidden" class="enable_sr_no" value="<?php echo e($product->enable_sr_no, false); ?>">
		<input type="hidden" 
			class="product_type" 
			name="products[<?php echo e($row_count, false); ?>][product_type]" 
			value="<?php echo e($product->product_type, false); ?>">

		<?php
			$hide_tax = 'hide';
	        
			$tax_id = $product->tax_id;
			$item_tax = !empty($product->item_tax) ? $product->item_tax : 0;
			$unit_price_inc_tax = $product->sell_price_inc_tax;


			$discount_type = !empty($product->line_discount_type) ? $product->line_discount_type : 'fixed';
			$discount_amount = !empty($product->line_discount_amount) ? $product->line_discount_amount : 0;

  			$sell_line_note = '';
  			if(!empty($product->sell_line_note)){
  				$sell_line_note = $product->sell_line_note;
  			}
  		?>

		<?php
			$max_quantity = $product->qty_available;
			$formatted_max_quantity = $product->formatted_qty_available;
			$max_qty_rule = $max_quantity;
			$max_qty_msg = __('validation.custom-messages.quantity_not_available', ['qty'=> $formatted_max_quantity, 'unit' => $product->unit  ]);
		?>
		<?php if(!empty($sell_line_note)): ?>
			<br><small class="text-muted"><?php echo nl2br($sell_line_note); ?></small>
		<?php endif; ?>
  		<textarea class="form-control hide" name="products[<?php echo e($row_count, false); ?>][sell_line_note]" rows="2"><?php echo e($sell_line_note, false); ?></textarea>
  		<p class="help-block hide"><small><?php echo app('translator')->get('lang_v1.sell_line_description_help'); ?></small></p>
	</td>

	<td>

		<input type="hidden" name="products[<?php echo e($row_count, false); ?>][product_id]" class="form-control product_id" value="<?php echo e($product->product_id, false); ?>">

		<input type="hidden" value="<?php echo e($product->variation_id, false); ?>" 
			name="products[<?php echo e($row_count, false); ?>][variation_id]" class="row_variation_id">

		<input type="hidden" value="<?php echo e($product->enable_stock, false); ?>" 
			name="products[<?php echo e($row_count, false); ?>][enable_stock]">

        <?php if(!empty($product->custom_blind_data)): ?>
            <input type="hidden" name="products[<?php echo e($row_count, false); ?>][custom_blind_data]" value="<?php echo e($product->custom_blind_data, false); ?>">
        <?php endif; ?>

		<?php
			$multiplier = 1;
			$allow_decimal = true;
			if($product->unit_allow_decimal != 1) {
				$allow_decimal = false;
			}
		?>
		<?php $__currentLoopData = $sub_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        	<?php if(!empty($product->sub_unit_id) && $product->sub_unit_id == $key): ?>
        		<?php
        			$multiplier = $value['multiplier'];

        			if($value['allow_decimal']) {
        				$allow_decimal = true;
        			}
        		?>
        	<?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<div class="input-group input-number">
			<span class="input-group-btn d-none d-md-inline"><button type="button" class="btn btn-default btn-flat quantity-down"><i class="fa fa-minus text-danger"></i></button></span>
		<input type="text" data-min="1" 
			class="form-control pos_quantity input_number mousetrap input_quantity" 
			value="<?php echo e(number_format($product->quantity_ordered, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" name="products[<?php echo e($row_count, false); ?>][quantity]" data-allow-overselling="<?php if(empty($pos_settings['allow_overselling'])): ?><?php echo e('false', false); ?><?php else: ?><?php echo e('true', false); ?><?php endif; ?>" 
			<?php if($allow_decimal): ?> 
				data-decimal=1 
			<?php else: ?> 
				data-decimal=0 
				data-rule-abs_digit="true" 
				data-msg-abs_digit="<?php echo app('translator')->get('lang_v1.decimal_value_not_allowed'); ?>" 
			<?php endif; ?>
			data-rule-required="true" 
			data-msg-required="<?php echo app('translator')->get('validation.custom-messages.this_field_is_required'); ?>" 
		>
		<span class="input-group-btn d-none d-md-inline"><button type="button" class="btn btn-default btn-flat quantity-up"><i class="fa fa-plus text-success"></i></button></span>
		</div>
		
		<input type="hidden" name="products[<?php echo e($row_count, false); ?>][product_unit_id]" value="<?php echo e($product->unit_id, false); ?>">
		<?php if(count($sub_units) > 0): ?>
			<br>
			<select name="products[<?php echo e($row_count, false); ?>][sub_unit_id]" class="form-control input-sm sub_unit">
                <?php $__currentLoopData = $sub_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key, false); ?>" data-multiplier="<?php echo e($value['multiplier'], false); ?>" data-unit_name="<?php echo e($value['name'], false); ?>" data-allow_decimal="<?php echo e($value['allow_decimal'], false); ?>" <?php if(!empty($product->sub_unit_id) && $product->sub_unit_id == $key): ?> selected <?php endif; ?>>
                        <?php echo e($value['name'], false); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           </select>
		<?php else: ?>
			<?php echo e($product->unit, false); ?>

		<?php endif; ?>

		<?php if(isset($product->secondary_unit_quantity)): ?>
            <br>
            <span style="white-space: nowrap;">
            Quantity:</span><br>
            <input type="text" 
            name="products[<?php echo e($row_count, false); ?>][secondary_unit_quantity]" 
            value="<?php echo e(number_format($product->secondary_unit_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>"
            class="form-control input-sm input_number"
            readonly>
        <?php endif; ?>

		<input type="hidden" class="base_unit_multiplier" name="products[<?php echo e($row_count, false); ?>][base_unit_multiplier]" value="<?php echo e($multiplier, false); ?>">

		<input type="hidden" class="hidden_base_unit_sell_price" value="<?php echo e($product->default_sell_price / $multiplier, false); ?>">
		
		
		<?php if($product->product_type == 'combo'&& !empty($product->combo_products)): ?>

			<?php $__currentLoopData = $product->combo_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $combo_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

				<?php
					$qty_total = $combo_product['qty_required'];
				?>

				<input type="hidden" 
					name="products[<?php echo e($row_count, false); ?>][combo][<?php echo e($k, false); ?>][product_id]"
					value="<?php echo e($combo_product['product_id'], false); ?>">

					<input type="hidden" 
					name="products[<?php echo e($row_count, false); ?>][combo][<?php echo e($k, false); ?>][variation_id]"
					value="<?php echo e($combo_product['variation_id'], false); ?>">

					<input type="hidden"
					class="combo_product_qty" 
					name="products[<?php echo e($row_count, false); ?>][combo][<?php echo e($k, false); ?>][quantity]"
					data-unit_quantity="<?php echo e($combo_product['qty_required'], false); ?>"
					value="<?php echo e($qty_total, false); ?>">

			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>
	</td>
		<?php
			$pos_unit_price = !empty($product->unit_price_before_discount) ? $product->unit_price_before_discount : $product->default_sell_price;
		?>
		<td class="hide">
			<input type="text" name="products[<?php echo e($row_count, false); ?>][unit_price]" class="form-control pos_unit_price input_number mousetrap" value="<?php echo e(number_format($pos_unit_price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" <?php if(!empty($pos_settings['enable_msp'])): ?> data-rule-min-value="<?php echo e($pos_unit_price, false); ?>" data-msg-min-value="<?php echo e(__('lang_v1.minimum_selling_price_error_msg', ['price' => number_format($pos_unit_price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator'])]), false); ?>" <?php endif; ?>>
		</td>
		<td class="hide">
			<?php echo Form::text("products[$row_count][line_discount_amount]", number_format($discount_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number row_discount_amount']); ?><br>
			<?php echo Form::select("products[$row_count][line_discount_type]", ['fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage')], $discount_type , ['class' => 'form-control row_discount_type']); ?>

			<?php if(!empty($discount)): ?>
				<p class="help-block"><?php echo __('lang_v1.applied_discount_text', ['discount_name' => $discount->name, 'starts_at' => $discount->formated_starts_at, 'ends_at' => $discount->formated_ends_at]); ?></p>
			<?php endif; ?>
		</td>
		<td class="text-center hide">
			<?php echo Form::hidden("products[$row_count][item_tax]", number_format($item_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'item_tax']); ?>

		
			<?php echo Form::select("products[$row_count][tax_id]", $tax_dropdown['tax_rates'], $tax_id, ['placeholder' => 'Select', 'class' => 'form-control tax_id sell_line_tax_id'], $tax_dropdown['attributes']); ?>

		</td>
	<td class="text-center">
		<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $unit_price_inc_tax, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
		<input type="hidden" name="products[<?php echo e($row_count, false); ?>][unit_price_inc_tax]" class="form-control pos_unit_price_inc_tax input_number" value="<?php echo e(number_format($unit_price_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" <?php if(!empty($pos_settings['enable_msp'])): ?> data-rule-min-value="<?php echo e($unit_price_inc_tax, false); ?>" data-msg-min-value="<?php echo e(__('lang_v1.minimum_selling_price_error_msg', ['price' => number_format($unit_price_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator'])]), false); ?>" <?php endif; ?>>
	</td>
	<td class="text-center">
		<input type="hidden" class="form-control pos_line_total <?php if(!empty($pos_settings['is_pos_subtotal_editable'])): ?> input_number <?php endif; ?>" value="<?php echo e(number_format($product->quantity_ordered*$unit_price_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>">
		<span class="display_currency pos_line_total_text" data-currency_symbol="true"><?php echo e($product->quantity_ordered*$unit_price_inc_tax, false); ?></span>
	</td>
	<td class="text-center v-center">
		<i class="fa fa-times text-danger pos_remove_row cursor-pointer" aria-hidden="true"></i>
	</td>
</tr>
