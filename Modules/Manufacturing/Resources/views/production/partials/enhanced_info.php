



<?php if(!empty($production_purchase->mfg_production_status)): ?>
<div class="row mb-3">
    <div class="col-md-12">
        <h5><i class="fas fa-tasks"></i> <?php echo app('translator')->get('manufacturing::lang.production_status'); ?></h5>
        <div class="d-flex flex-wrap gap-2 align-items-center">
            <?php
                $statuses = ['planned', 'in_progress', 'quality_check', 'completed'];
                $current_status = $production_purchase->mfg_production_status;
            ?>
            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $is_active = ($status == $current_status);
                    $is_done = (array_search($current_status, $statuses) > $idx);
                    $badge_class = $is_active ? \Modules\Manufacturing\Utils\ManufacturingUtil::getProductionStatusBadge($status) : ($is_done ? 'bg-success' : 'bg-light text-dark');
                ?>
                <span class="badge <?php echo e($badge_class, false); ?> p-2">
                    <?php if($is_done): ?> <i class="fas fa-check"></i> <?php endif; ?>
                    <?php echo e(\Modules\Manufacturing\Utils\ManufacturingUtil::getProductionStatusLabel($status), false); ?>

                </span>
                <?php if($idx < count($statuses) - 1): ?>
                    <i class="fas fa-arrow-right text-muted"></i>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if(in_array($current_status, ['on_hold', 'cancelled'])): ?>
                <span class="badge <?php echo e(\Modules\Manufacturing\Utils\ManufacturingUtil::getProductionStatusBadge($current_status), false); ?> p-2 ms-2">
                    <?php echo e(\Modules\Manufacturing\Utils\ManufacturingUtil::getProductionStatusLabel($current_status), false); ?>

                </span>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>


<div class="row mb-3">
    <?php if(!empty($production_purchase->mfg_priority)): ?>
    <div class="col-md-3">
        <strong><?php echo app('translator')->get('manufacturing::lang.priority'); ?>:</strong>
        <span class="badge <?php echo e(\Modules\Manufacturing\Utils\ManufacturingUtil::getPriorityBadge($production_purchase->mfg_priority), false); ?>">
            <?php echo e(ucfirst($production_purchase->mfg_priority), false); ?>

        </span>
    </div>
    <?php endif; ?>

    <?php if(!empty($production_purchase->mfg_due_date)): ?>
    <div class="col-md-3">
        <strong><?php echo app('translator')->get('manufacturing::lang.due_date'); ?>:</strong>
        <?php echo e(\Carbon::createFromTimestamp(strtotime($production_purchase->mfg_due_date))->format(session('business.date_format')), false); ?>

        <?php if($production_purchase->mfg_due_date < now()->toDateString() && !in_array($production_purchase->mfg_production_status, ['completed', 'cancelled'])): ?>
            <span class="badge bg-danger"><?php echo app('translator')->get('manufacturing::lang.overdue'); ?></span>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php if(!empty($production_purchase->mfg_batch_number)): ?>
    <div class="col-md-3">
        <strong><?php echo app('translator')->get('manufacturing::lang.batch_number'); ?>:</strong>
        <?php echo e($production_purchase->mfg_batch_number, false); ?>

    </div>
    <?php endif; ?>
</div>


<?php if(!empty($production_purchase->mfg_expected_quantity) || !empty($production_purchase->mfg_actual_quantity)): ?>
<div class="row mb-3">
    <div class="col-md-12">
        <h5><i class="fas fa-chart-bar"></i> <?php echo app('translator')->get('manufacturing::lang.yield_tracking'); ?></h5>
        <div class="row">
            <div class="col-md-3">
                <strong><?php echo app('translator')->get('manufacturing::lang.expected_quantity'); ?>:</strong>
                <span class="display_currency" data-currency_symbol="false" data-is_quantity="true"><?php echo e($production_purchase->mfg_expected_quantity ?? 0, false); ?></span>
            </div>
            <div class="col-md-3">
                <strong><?php echo app('translator')->get('manufacturing::lang.actual_quantity'); ?>:</strong>
                <span class="display_currency" data-currency_symbol="false" data-is_quantity="true"><?php echo e($production_purchase->mfg_actual_quantity ?? 0, false); ?></span>
            </div>
            <?php if(!empty($production_purchase->mfg_expected_quantity) && !empty($production_purchase->mfg_actual_quantity)): ?>
                <?php
                    $efficiency = $production_purchase->mfg_expected_quantity > 0 
                        ? round(($production_purchase->mfg_actual_quantity / $production_purchase->mfg_expected_quantity) * 100, 1) 
                        : 0;
                ?>
                <div class="col-md-6">
                    <strong><?php echo app('translator')->get('manufacturing::lang.yield_efficiency'); ?>:</strong>
                    <div class="progress" style="height: 25px;">
                        <div class="progress-bar <?php echo e($efficiency >= 90 ? 'bg-success' : ($efficiency >= 70 ? 'bg-warning' : 'bg-danger'), false); ?>" 
                             role="progressbar" 
                             style="width: <?php echo e(min($efficiency, 100), false); ?>%" 
                             aria-valuenow="<?php echo e($efficiency, false); ?>" 
                             aria-valuemin="0" 
                             aria-valuemax="100">
                            <?php echo e($efficiency, false); ?>%
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>


<?php if(!empty($production_purchase->mfg_labor_cost) || !empty($production_purchase->mfg_overhead_cost)): ?>
<div class="row mb-3">
    <div class="col-md-12">
        <h5><i class="fas fa-coins"></i> <?php echo app('translator')->get('manufacturing::lang.enhanced_cost_breakdown'); ?></h5>
        <table class="table table-sm table-bordered">
            <tr>
                <td><?php echo app('translator')->get('manufacturing::lang.labor_cost'); ?>:</td>
                <td class="text-end"><span class="display_currency" data-currency_symbol="true"><?php echo e($production_purchase->mfg_labor_cost ?? 0, false); ?></span></td>
            </tr>
            <tr>
                <td><?php echo app('translator')->get('manufacturing::lang.overhead_cost'); ?>:</td>
                <td class="text-end"><span class="display_currency" data-currency_symbol="true"><?php echo e($production_purchase->mfg_overhead_cost ?? 0, false); ?></span></td>
            </tr>
        </table>
    </div>
</div>
<?php endif; ?>


<?php if(!empty($production_purchase->mfg_notes)): ?>
<div class="row mb-3">
    <div class="col-md-12">
        <strong><?php echo app('translator')->get('manufacturing::lang.production_notes'); ?>:</strong>
        <p><?php echo e($production_purchase->mfg_notes, false); ?></p>
    </div>
</div>
<?php endif; ?>
