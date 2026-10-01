<tr class="product_row">
    <td>
        <?php echo e($variation_name, false); ?>

    </td>
    <td>
        <input type="text" class="form-control input_number input_quantity" value="<?php echo e(number_format($quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" name="parts[<?php echo e($variation_id, false); ?>][quantity]" >
        <?php echo e($unit, false); ?>

    </td>
    <td class="text-center">
        <i class="fas fa-times remove_product_row cursor-pointer" aria-hidden="true"></i>
    </td>
</tr>