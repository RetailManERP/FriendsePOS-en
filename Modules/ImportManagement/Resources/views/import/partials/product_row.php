<tr class="import_item_row" data-row="<?php echo e($row_index, false); ?>">
    <td>
        <input type="hidden" name="import_lines[<?php echo e($row_index, false); ?>][product_id]" value="<?php echo e($product->id, false); ?>">
        <input type="hidden" name="import_lines[<?php echo e($row_index, false); ?>][variation_id]" value="<?php echo e($variation->id, false); ?>">
        <span class="product_name_label">
            <?php echo e($product->name, false); ?>

            <?php if($variation->name != 'DUMMY'): ?>
                - <?php echo e($variation->name, false); ?>

            <?php endif; ?>
        </span>
        <br><small class="text-muted">SKU: <?php echo e($product->sku ?? ($variation->sub_sku ?? ''), false); ?></small>
    </td>
    <td>
        <input type="number" name="import_lines[<?php echo e($row_index, false); ?>][quantity]" class="form-control input-sm import_line_qty" value="1" min="0.0001" step="any" required>
    </td>
    <td>
        <input type="number" name="import_lines[<?php echo e($row_index, false); ?>][unit_price]" class="form-control input-sm import_line_price" value="<?php echo e($default_purchase_price, false); ?>" min="0" step="any" required>
    </td>
    <td>
        <span class="import_line_subtotal"><?php echo e(number_format($default_purchase_price, session('business.cost_decimal', 2)), false); ?></span>
    </td>
    <td>
        <?php echo Form::select('import_lines[' . $row_index . '][tax_id]', $taxes, $product->tax ?? null, ['class' => 'form-control input-sm import_line_tax_select', 'placeholder' => 'None']); ?>

        <input type="hidden" name="import_lines[<?php echo e($row_index, false); ?>][item_tax]" class="import_line_item_tax" value="0">
    </td>
    <td>
        <input type="number" name="import_lines[<?php echo e($row_index, false); ?>][weight_per_unit]" class="form-control input-sm" value="<?php echo e($product->weight ?? '', false); ?>" min="0" step="any">
    </td>
    <td>
        <input type="text" name="import_lines[<?php echo e($row_index, false); ?>][lot_number]" class="form-control input-sm" value="">
    </td>
    <td>
        <button type="button" class="btn btn-danger btn-xs remove_import_line"><i class="fa fa-times"></i></button>
    </td>
</tr>
