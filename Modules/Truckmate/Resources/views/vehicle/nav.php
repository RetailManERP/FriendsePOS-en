<?php
    $custom_labels = ! empty(session()->get('business.custom_labels')) ? json_decode(session()->get('business.custom_labels'), true) : [] ;
?>
<section class="no-print">
    <nav class="navbar navbar-expand-lg tm-nav">
        <div class="container-fluid px-0">
            <a class="navbar-brand" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\DashboardController::class, 'index']), false); ?>"><i class="fas fa-truck"></i> <?php echo e(!empty($custom_labels['truckmate_label']) ? $custom_labels['truckmate_label'] : __('truckmate::lang.truckmate'), false); ?></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#truckmate-vehicle-navbar" aria-controls="truckmate-vehicle-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="truckmate-vehicle-navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if(auth()->user()->can('truckmate_vehicle.dashboard')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'vehicle-dashboard'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\VehicleController::class, 'dashboard']), false); ?>">
                                <i class="fas fa-tachometer-alt"></i> <?php echo app('translator')->get('lang_v1.dashboard'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('truckmate_vehicle.view_all')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'vehicles' && empty(request()->segment(3))): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\VehicleController::class, 'index']), false); ?>">
                                <i class="fas fa-list"></i> <?php echo app('translator')->get('truckmate::lang.vehicles'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('truckmate_vehicle.create')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'vehicles' && request()->segment(3) == 'create'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\VehicleController::class, 'create']), false); ?>">
                                <i class="fas fa-plus-circle"></i> <?php echo app('translator')->get('truckmate::lang.add_vehicle'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('truckmate_vehicle.dashboard')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'vehicle-future-pmi'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\VehicleController::class, 'future_pmi']), false); ?>">
                                <i class="fas fa-calendar-check"></i> <?php echo app('translator')->get('truckmate::lang.future_pmi'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('truckmate_vehicle.view_all') || auth()->user()->can('truckmate_vehicle.create') || auth()->user()->can('truckmate_vehicle.edit')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'containers'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\ContainerController::class, 'index']), false); ?>">
                                <i class="fas fa-folder-open"></i> <?php echo app('translator')->get('truckmate::lang.container_docs'); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div><!-- /.container-fluid -->
    </nav>
</section>
