<?php
    $custom_labels = ! empty(session()->get('business.custom_labels')) ? json_decode(session()->get('business.custom_labels'), true) : [] ;
?>
<section class="no-print">
    <nav class="navbar navbar-expand-lg tm-nav">
        <div class="container-fluid px-0">
            <a class="navbar-brand" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\DashboardController::class, 'index']), false); ?>"><i class="fas fa-truck"></i> <?php echo e(!empty($custom_labels['truckmate_label']) ? $custom_labels['truckmate_label'] : __('truckmate::lang.truckmate'), false); ?></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#truckmate-driver-navbar" aria-controls="truckmate-driver-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="truckmate-driver-navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if(auth()->user()->can('truckmate_driver.dashboard')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'driver-dashboard'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\DriverController::class, 'dashboard']), false); ?>">
                                <i class="fas fa-tachometer-alt"></i> <?php echo app('translator')->get('lang_v1.dashboard'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('truckmate_driver.view_all')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'drivers' && empty(request()->segment(3))): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\DriverController::class, 'index']), false); ?>">
                                <i class="fas fa-id-card"></i> <?php echo app('translator')->get('truckmate::lang.drivers'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('truckmate_driver.view_all_invoices') || auth()->user()->can('truckmate_driver.view_own_invoices')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'driver-invoices' && empty(request()->segment(3))): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\TruckmateController::class, 'driverInvoices']), false); ?>"><i class="fas fa-file-invoice"></i> <?php echo app('translator')->get('truckmate::lang.list_invoices'); ?></a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('truckmate_driver.add_invoice')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'driver-invoices' && request()->segment(3) == 'create'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\TruckmateController::class, 'createDriverInvoice']), false); ?>"><i class="fas fa-plus-circle"></i> <?php echo app('translator')->get('truckmate::lang.add_invoice'); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div><!-- /.container-fluid -->
    </nav>
</section>