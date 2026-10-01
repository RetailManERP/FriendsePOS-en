<?php
    $u = auth()->user();
?>
<section class="content-header" style="padding-bottom:0">
    <div class="btn-group mb-2 flex-wrap" role="group" style="display:flex; flex-wrap:wrap; gap:6px;">
        <?php if($u->can('fuelstation.view_dashboard')): ?>
            <a href="<?php echo e(action([\Modules\FuelStation\Http\Controllers\FuelDashboardController::class, 'index']), false); ?>" class="btn btn-sm <?php echo e(request()->segment(2)=='dashboard' ? 'btn-primary' : 'btn-default', false); ?>"><i class="fa fas fa-tachometer-alt"></i> <?php echo app('translator')->get('fuelstation::lang.dashboard'); ?></a>
        <?php endif; ?>
        <?php if($u->can('fuelstation.manage_tanks')): ?>
            <a href="<?php echo e(action([\Modules\FuelStation\Http\Controllers\FuelTankController::class, 'index']), false); ?>" class="btn btn-sm <?php echo e(request()->segment(2)=='tanks' ? 'btn-primary' : 'btn-default', false); ?>"><i class="fa fas fa-oil-can"></i> <?php echo app('translator')->get('fuelstation::lang.tanks'); ?></a>
        <?php endif; ?>
        <?php if($u->can('fuelstation.manage_dispensers')): ?>
            <a href="<?php echo e(action([\Modules\FuelStation\Http\Controllers\FuelDispenserController::class, 'index']), false); ?>" class="btn btn-sm <?php echo e(request()->segment(2)=='dispensers' ? 'btn-primary' : 'btn-default', false); ?>"><i class="fa fas fa-gas-pump"></i> <?php echo app('translator')->get('fuelstation::lang.dispensers'); ?></a>
        <?php endif; ?>
        <?php if($u->can('fuelstation.manage_nozzles')): ?>
            <a href="<?php echo e(action([\Modules\FuelStation\Http\Controllers\FuelNozzleController::class, 'index']), false); ?>" class="btn btn-sm <?php echo e(request()->segment(2)=='nozzles' ? 'btn-primary' : 'btn-default', false); ?>"><i class="fa fas fa-faucet"></i> <?php echo app('translator')->get('fuelstation::lang.nozzles'); ?></a>
        <?php endif; ?>
        <?php if($u->can('fuelstation.open_shift') || $u->can('fuelstation.close_shift') || $u->can('fuelstation.approve_shift')): ?>
            <a href="<?php echo e(action([\Modules\FuelStation\Http\Controllers\FuelShiftController::class, 'index']), false); ?>" class="btn btn-sm <?php echo e(request()->segment(2)=='shifts' ? 'btn-primary' : 'btn-default', false); ?>"><i class="fa fas fa-user-clock"></i> <?php echo app('translator')->get('fuelstation::lang.shifts'); ?></a>
        <?php endif; ?>
        <?php if($u->can('fuelstation.manage_tank_adjustment')): ?>
            <a href="<?php echo e(action([\Modules\FuelStation\Http\Controllers\FuelTankAdjustmentController::class, 'index']), false); ?>" class="btn btn-sm <?php echo e(request()->segment(2)=='tank-adjustments' ? 'btn-primary' : 'btn-default', false); ?>"><i class="fa fas fa-sliders-h"></i> <?php echo app('translator')->get('fuelstation::lang.tank_adjustments'); ?></a>
        <?php endif; ?>
        <?php if($u->can('fuelstation.manage_tank_transfer')): ?>
            <a href="<?php echo e(action([\Modules\FuelStation\Http\Controllers\FuelTankTransferController::class, 'index']), false); ?>" class="btn btn-sm <?php echo e(request()->segment(2)=='tank-transfers' ? 'btn-primary' : 'btn-default', false); ?>"><i class="fa fas fa-exchange-alt"></i> <?php echo app('translator')->get('fuelstation::lang.tank_transfers'); ?></a>
        <?php endif; ?>
        <?php if($u->can('fuelstation.manage_integration')): ?>
            <a href="<?php echo e(action([\Modules\FuelStation\Http\Controllers\FuelIntegrationController::class, 'index']), false); ?>" class="btn btn-sm <?php echo e(request()->segment(2)=='integration' ? 'btn-primary' : 'btn-default', false); ?>"><i class="fa fas fa-plug"></i> <?php echo app('translator')->get('fuelstation::lang.dispenser_integration'); ?></a>
        <?php endif; ?>
        <?php if($u->can('fuelstation.view_reports')): ?>
            <a href="<?php echo e(action([\Modules\FuelStation\Http\Controllers\FuelReportController::class, 'index']), false); ?>" class="btn btn-sm <?php echo e(request()->segment(2)=='reports' ? 'btn-primary' : 'btn-default', false); ?>"><i class="fa fas fa-chart-bar"></i> <?php echo app('translator')->get('fuelstation::lang.reports'); ?></a>
        <?php endif; ?>
    </div>
</section>
