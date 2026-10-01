<section class="no-print">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm m-4 px-3">
        <div class="container-fluid px-0">
            <a class="navbar-brand fw-semibold" href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalController::class, 'index']), false); ?>">
                <i class="fas fa-handshake me-2"></i><?php echo app('translator')->get('rental::lang.rental_management'); ?>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#rental-navbar" aria-controls="rental-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="rental-navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 flex-wrap">
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'dashboard' || request()->segment(2) == ''): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalController::class, 'index']), false); ?>">
                            <i class="fas fa-tachometer-alt"></i> <?php echo app('translator')->get('rental::lang.dashboard'); ?>
                        </a>
                    </li>

                    <?php if(auth()->user()->can('rental.manage_rental_items') || auth()->user()->can('rental.view_rental_items')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'items'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalItemController::class, 'index']), false); ?>">
                                <i class="fas fa-boxes"></i> <?php echo app('translator')->get('rental::lang.rental_items'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('rental.manage_agreements') || auth()->user()->can('rental.view_agreements')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'agreements'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalAgreementController::class, 'index']), false); ?>">
                                <i class="fas fa-file-contract"></i> <?php echo app('translator')->get('rental::lang.rental_agreements'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('rental.manage_returns') || auth()->user()->can('rental.view_returns')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'returns'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalReturnController::class, 'index']), false); ?>">
                                <i class="fas fa-undo-alt"></i> <?php echo app('translator')->get('rental::lang.returns'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('rental.manage_payments') || auth()->user()->can('rental.view_payments')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'payments'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalPaymentController::class, 'index']), false); ?>">
                                <i class="fas fa-money-bill-wave"></i> <?php echo app('translator')->get('rental::lang.payments'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('rental.manage_agreements') || auth()->user()->can('rental.view_agreements')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'calendar'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalAgreementController::class, 'calendar']), false); ?>">
                                <i class="fas fa-calendar-alt"></i> <?php echo app('translator')->get('rental::lang.rental_calendar'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('rental.manage_damage_reports')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'damage-reports'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalDamageReportController::class, 'index']), false); ?>">
                                <i class="fas fa-exclamation-triangle"></i> <?php echo app('translator')->get('rental::lang.damage_reports'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('rental.manage_maintenance')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'maintenance'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalMaintenanceController::class, 'index']), false); ?>">
                                <i class="fas fa-tools"></i> <?php echo app('translator')->get('rental::lang.maintenance'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('rental.view_reports')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'reports'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalReportController::class, 'index']), false); ?>">
                                <i class="fas fa-chart-bar"></i> <?php echo app('translator')->get('rental::lang.reports'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('rental.manage_settings')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'settings'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalSettingController::class, 'index']), false); ?>">
                                <i class="fas fa-cog"></i> <?php echo app('translator')->get('rental::lang.settings'); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</section>
