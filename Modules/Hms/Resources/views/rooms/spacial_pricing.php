<tr>
    <td>
        <select class="form-control" required name="pricing[<?php echo e($currentIndex, false); ?>][adults]">
            <?php for($i = 1; $i <= $room_type->no_of_adult; $i++): ?>
                <option value="<?php echo e($i, false); ?>"><?php echo e($i, false); ?></option>
            <?php endfor; ?>
        </select>
    </td> 
    <td>
        <select class="form-control" required name="pricing[<?php echo e($currentIndex, false); ?>][childrens]">
            <?php for($i = 0; $i <= $room_type->no_of_child; $i++): ?>
                <option value="<?php echo e($i, false); ?>"><?php echo e($i, false); ?></option>
            <?php endfor; ?>
        </select>
    </td> 
    <td>
        <input class="form-control" required step="0.01" name="pricing[<?php echo e($currentIndex, false); ?>][monday]" type="number">
    </td> 
    <td>
        <input class="form-control" required step="0.01" name="pricing[<?php echo e($currentIndex, false); ?>][tuesday]" type="number">
    </td> 
    <td>
        <input class="form-control" required step="0.01" name="pricing[<?php echo e($currentIndex, false); ?>][wednesday]" type="number">
    </td> 
    <td>
        <input class="form-control" required step="0.01" name="pricing[<?php echo e($currentIndex, false); ?>][thursday]" type="number">
    </td> 
    <td>
        <input class="form-control" required step="0.01" name="pricing[<?php echo e($currentIndex, false); ?>][friday]" type="number"></td> 
    <td>
        <input class="form-control" required step="0.01" name="pricing[<?php echo e($currentIndex, false); ?>][saturday]" type="number">
    </td> 
    <td>
        <input class="form-control" required step="0.01" name="pricing[<?php echo e($currentIndex, false); ?>][sunday]" type="number">
    </td> 
    <td> 
        <button type="button" class="btn btn-sm btn-danger remove"><i class="fas fa-trash-alt"></i></button> 
        <button type="button" class="btn btn-sm btn-success copy"><i class="fas fa-copy"></i></button> 
    </td> 
</tr>
