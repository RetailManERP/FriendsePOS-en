<?php $__empty_18 = true; $__currentLoopData = $nozzles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nozzle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
    <tr>
        <td><input type="checkbox" class="nozzle-check" name="nozzles[<?php echo e($nozzle->id, false); ?>][selected]" value="1" checked></td>
        <td><?php echo e($nozzle->name, false); ?></td>
        <td><?php echo e(optional($nozzle->tank)->name ?? '-', false); ?></td>
        <td><?php echo e(optional($nozzle->product)->name ?? '-', false); ?></td>
        <td>
            <input type="number" step="any" class="form-control input-sm" name="nozzles[<?php echo e($nozzle->id, false); ?>][opening_reading]" value="<?php echo e($nozzle->current_reading, false); ?>">
        </td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
    <tr><td colspan="5" class="text-center text-muted"><?php echo app('translator')->get('fuelstation::lang.no_active_nozzles'); ?></td></tr>
<?php endif; ?>
