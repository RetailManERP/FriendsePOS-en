<tr class="demand-line-row" data-row-index="<?php echo e($row_index, false); ?>">
    <td>
        <?php echo e($product_name, false); ?>

        <input type="hidden" name="demand_lines[<?php echo e($row_index, false); ?>][variation_id]" value="<?php echo e($variation->id, false); ?>">
    </td>
    <td>
        <span class="display_currency demand-line-on-hand"
              data-currency_symbol="false"
              data-is_quantity="true"
              data-orig-value="<?php echo e($on_hand_qty ?? 0, false); ?>"><?php echo e($on_hand_qty ?? 0, false); ?></span>
    </td>
    <td>
        <input type="text" name="demand_lines[<?php echo e($row_index, false); ?>][quantity]" 
               class="form-control input_number demand-line-qty" 
               value="<?php echo e(number_format(1, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" required>
    </td>
    <td><?php echo e($variation->product->unit->short_name ?? '', false); ?></td>
    <td>
        <input type="text" name="demand_lines[<?php echo e($row_index, false); ?>][batch_quantity]" 
               class="form-control input_number input_quantity demand-line-batch-qty bg-gray" data-orig-value="<?php echo e($recipe->total_quantity, false); ?>"
               value="<?php echo e(number_format($recipe->total_quantity ?? 0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" required readonly>
    </td>
    <td>
        <?php if($recipe): ?>
            <span class="badge bg-success"><i class="fas fa-check"></i> <?php echo app('translator')->get('manufacturing::lang.recipe_available'); ?></span>
        <?php else: ?>
            <span class="badge bg-warning"><i class="fas fa-exclamation-triangle"></i> <?php echo app('translator')->get('manufacturing::lang.no_recipe'); ?></span>
        <?php endif; ?>
    </td>
    <?php
        $cost_decimal = session('business.cost_decimal', 2);
    ?>
    <td>
        <span class="est-unit-cost display_currency" 
              data-currency_symbol="true" 
              data-orig-value="<?php echo e($estimated_cost, false); ?>"><?php echo e(number_format($estimated_cost, $cost_decimal), false); ?></span>
    </td>
    <td>
        <span class="est-line-total display_currency" 
              data-currency_symbol="true" 
              data-orig-value="<?php echo e($estimated_cost, false); ?>"><?php echo e(number_format($estimated_cost, $cost_decimal), false); ?></span>
    </td>
    <td>
        <input type="text" name="demand_lines[<?php echo e($row_index, false); ?>][line_notes]" 
               class="form-control" placeholder="<?php echo app('translator')->get('manufacturing::lang.line_notes'); ?>">
    </td>
    <td>
        <button type="button" class="btn btn-danger btn-xs remove-demand-line">
            <i class="fa fa-times"></i>
        </button>
    </td>
</tr>
