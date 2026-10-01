<?php if($is_edit): ?>
    <tr>
<?php endif; ?>
        <input type="hidden" value="<?php echo e($data['total_price'], false); ?>" name="rooms[<?php echo e($currentIndex, false); ?>][total_price]">
        <input type="hidden" value="<?php echo e($data['price'], false); ?>" name="rooms[<?php echo e($currentIndex, false); ?>][price]">
        <input type="hidden" value="<?php echo e($type->id, false); ?>" name="rooms[<?php echo e($currentIndex, false); ?>][type_id]">
        <input type="hidden" class="room-id-input" value="<?php echo e($room->id, false); ?>" name="rooms[<?php echo e($currentIndex, false); ?>][room_id]">
        <input type="hidden" value="<?php echo e($data['no_of_adult'], false); ?>" name="rooms[<?php echo e($currentIndex, false); ?>][no_of_adult]">
        <input type="hidden" value="<?php echo e($data['no_of_child'], false); ?>" name="rooms[<?php echo e($currentIndex, false); ?>][no_of_child]">
    <td>
        <?php echo e($type->type, false); ?>

       
    </td>
    <td>
        <?php echo e($room->room_number, false); ?>

    </td>
    <td>
        <?php echo e($data['no_of_adult'], false); ?>

    </td>
    <td>
        <?php echo e($data['no_of_child'], false); ?>

    </td>
    <td class="price-td display_currency" data-currency_symbol="true">
        <?php echo e($data['total_price'], false); ?>

    </td>
    <td> 
        <button type="button" class="btn btn-sm btn-danger me-1 remove"><i class="fas fa-trash-alt"></i></button> 
        <button type="button" class="btn btn-sm btn-primary me-1 edit"><i class="fas fa-edit"></i></button> 
    </td> 
 <?php if($is_edit): ?>
</tr>
<?php endif; ?>
