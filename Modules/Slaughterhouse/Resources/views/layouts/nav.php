<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="<?php echo e(request()->segment(2) == 'dashboard' || request()->segment(2) == null ? 'active' : '', false); ?>">
            <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterhouseDashboardController::class, 'index']), false); ?>">
                <i class="fa fas fa-tachometer-alt"></i> <?php echo app('translator')->get('slaughterhouse::lang.dashboard'); ?>
            </a>
        </li>
        <li class="<?php echo e(request()->segment(2) == 'eid-bookings' ? 'active' : '', false); ?>">
            <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\EidBookingController::class, 'index']), false); ?>">
                <i class="fa fas fa-calendar-check"></i> <?php echo app('translator')->get('slaughterhouse::lang.eid_bookings'); ?>
            </a>
        </li>
        <li class="<?php echo e(request()->segment(2) == 'animal-numbers' ? 'active' : '', false); ?>">
            <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterAnimalNumberController::class, 'index']), false); ?>">
                <i class="fa fas fa-barcode"></i> <?php echo app('translator')->get('slaughterhouse::lang.animal_numbers'); ?>
            </a>
        </li>
        <li class="<?php echo e(request()->segment(2) == 'eid-seasons' ? 'active' : '', false); ?>">
            <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\EidSeasonController::class, 'index']), false); ?>">
                <i class="fa fas fa-calendar-alt"></i> <?php echo app('translator')->get('slaughterhouse::lang.eid_seasons'); ?>
            </a>
        </li>
        <li class="<?php echo e(request()->segment(2) == 'batches' ? 'active' : '', false); ?>">
            <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterBatchController::class, 'index']), false); ?>">
                <i class="fa fas fa-layer-group"></i> <?php echo app('translator')->get('slaughterhouse::lang.slaughter_batches'); ?>
            </a>
        </li>
        <li class="<?php echo e(request()->segment(2) == 'scan' ? 'active' : '', false); ?>">
            <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterScanController::class, 'index']), false); ?>">
                <i class="fa fas fa-qrcode"></i> <?php echo app('translator')->get('slaughterhouse::lang.floor_scanning'); ?>
            </a>
        </li>
        <li class="<?php echo e(request()->segment(2) == 'display' ? 'active' : '', false); ?>">
            <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterDisplayController::class, 'index']), false); ?>">
                <i class="fa fas fa-tv"></i> <?php echo app('translator')->get('slaughterhouse::lang.display_screen'); ?>
            </a>
        </li>
        <li class="<?php echo e(request()->segment(2) == 'service-options' ? 'active' : '', false); ?>">
            <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterServiceOptionController::class, 'index']), false); ?>">
                <i class="fa fas fa-cog"></i> <?php echo app('translator')->get('slaughterhouse::lang.service_options'); ?>
            </a>
        </li>
        <li class="<?php echo e(request()->segment(2) == 'cutting-types' ? 'active' : '', false); ?>">
            <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterCuttingTypeController::class, 'index']), false); ?>">
                <i class="fa fas fa-cut"></i> <?php echo app('translator')->get('slaughterhouse::lang.cutting_types'); ?>
            </a>
        </li>
        <li class="<?php echo e(request()->segment(2) == 'freezing-services' ? 'active' : '', false); ?>">
            <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterFreezingServiceController::class, 'index']), false); ?>">
                <i class="fa fas fa-archive"></i> <?php echo app('translator')->get('slaughterhouse::lang.freezing_services'); ?>
            </a>
        </li>
        <li class="<?php echo e(request()->segment(2) == 'freezers' ? 'active' : '', false); ?>">
            <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterFreezerController::class, 'index']), false); ?>">
                <i class="fa fas fa-snowflake"></i> <?php echo app('translator')->get('slaughterhouse::lang.freezers'); ?>
            </a>
        </li>
    </ul>
</div>
