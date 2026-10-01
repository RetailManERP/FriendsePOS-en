<?php $__currentLoopData = $weekdays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td><?php echo e($day['day'], false); ?>, <?php echo e($day['date'], false); ?></td>
    <td><input type="text" name="weekdays[<?php echo e($row_count, false); ?>][hours]" value="<?php echo e(number_format($day['hours'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" class="form-control input-sm weekday_hours"></td>
    <td>
        <select name="weekdays[<?php echo e($row_count, false); ?>][shift]" class="form-control input-sm">
            <option value="Day" <?php if($day['shift'] == 'Day'): ?> selected <?php endif; ?> >Day</option>
            <option value="Night" <?php if($day['shift'] == 'Night'): ?> selected <?php endif; ?>>Night</option>
        </select>

        <input type="hidden" name="weekdays[<?php echo e($row_count, false); ?>][day]" value="<?php echo e($day['day'], false); ?>">
        <input type="hidden" name="weekdays[<?php echo e($row_count, false); ?>][date]" value="<?php echo e($day['date'], false); ?>">
    </td>
    <td><input type="text" name="weekdays[<?php echo e($row_count, false); ?>][hourly_rate]" value="<?php echo e(number_format($day['hourly_rate'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" class="form-control input-sm weekday_rate"></td>
    <td><input type="text" name="weekdays[<?php echo e($row_count, false); ?>][total_amount]" value="<?php echo e(number_format($day['total_amount'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" class="form-control input-sm weekday_total" readonly></td>
    <td><input type="text" name="weekdays[<?php echo e($row_count, false); ?>][remarks]" value="<?php echo e($day['remarks'], false); ?>" class="form-control input-sm"></td>
</tr>
<?php
$row_count++;
?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
