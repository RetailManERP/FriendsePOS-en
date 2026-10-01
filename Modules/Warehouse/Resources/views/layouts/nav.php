<section class="no-print">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm m-4 px-3">
        <div class="container-fluid px-0">
            <a class="navbar-brand fw-semibold" href="<?php echo e(action([\Modules\Warehouse\Http\Controllers\WarehouseController::class, 'index']), false); ?>">
                <i class="fas fa-warehouse me-2"></i><?php echo app('translator')->get('warehouse::lang.warehouse_management'); ?>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#warehouse-navbar" aria-controls="warehouse-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="warehouse-navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if(auth()->user()->can('superadmin') || auth()->user()->can('warehouse.transfer.create')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(1) == 'warehouse' && request()->segment(2) == 'transfers' && request()->segment(3) == 'create'): ?> active <?php endif; ?>"
                               href="<?php echo e(action([\Modules\Warehouse\Http\Controllers\StockTransferController::class, 'create']), false); ?>">
                                <i class="fas fa-plus"></i> <?php echo app('translator')->get('warehouse::lang.create_transfer'); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(auth()->user()->can('superadmin') || auth()->user()->can('warehouse.transfer.view')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(1) == 'warehouse' && request()->segment(2) == 'transfers' && request()->segment(3) != 'create'): ?> active <?php endif; ?>"
                               href="<?php echo e(action([\Modules\Warehouse\Http\Controllers\StockTransferController::class, 'index']), false); ?>">
                                <?php echo app('translator')->get('warehouse::lang.stock_transfers'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('superadmin') || auth()->user()->can('warehouse.report.view') || auth()->user()->can('warehouse.view') || auth()->user()->can('warehouse.stock.view')): ?>
                        <?php
                            $reportsActive = request()->segment(1) == 'warehouse' && (
                                request()->segment(2) == 'reports' ||
                                request()->segment(2) == 'warehouses' ||
                                (request()->segment(2) == 'stock')
                            );
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php if($reportsActive): ?> active <?php endif; ?>"
                               href="#" id="warehouse-reports-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo app('translator')->get('report.reports'); ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="warehouse-reports-dropdown">
                                <?php if(auth()->user()->can('superadmin') || auth()->user()->can('warehouse.view')): ?>
                                <li>
                                    <a class="dropdown-item <?php if(request()->segment(1) == 'warehouse' && request()->segment(2) == 'warehouses'): ?> active <?php endif; ?>"
                                       href="<?php echo e(action([\Modules\Warehouse\Http\Controllers\WarehouseController::class, 'list']), false); ?>">
                                        <?php echo app('translator')->get('warehouse::lang.warehouses'); ?>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('superadmin') || auth()->user()->can('warehouse.stock.view')): ?>
                                <li>
                                    <a class="dropdown-item <?php if(request()->segment(1) == 'warehouse' && request()->segment(2) == 'stock' && request()->segment(3) != 'movements'): ?> active <?php endif; ?>"
                                       href="<?php echo e(action([\Modules\Warehouse\Http\Controllers\StockController::class, 'index']), false); ?>">
                                        <?php echo app('translator')->get('warehouse::lang.warehouse_stock'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item <?php if(request()->segment(1) == 'warehouse' && request()->segment(2) == 'stock' && request()->segment(3) == 'movements'): ?> active <?php endif; ?>"
                                       href="<?php echo e(action([\Modules\Warehouse\Http\Controllers\StockController::class, 'movements']), false); ?>">
                                        <?php echo app('translator')->get('warehouse::lang.stock_movements'); ?>
                                    </a>
                                </li>
                                <?php if(auth()->user()->can('superadmin') || auth()->user()->can('warehouse.report.view')): ?>
                                <li><hr class="dropdown-divider"></li>
                                <?php endif; ?>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('superadmin') || auth()->user()->can('warehouse.report.view')): ?>
                                <li>
                                    <a class="dropdown-item <?php if(request()->segment(3) == 'stock-summary'): ?> active <?php endif; ?>"
                                       href="<?php echo e(action([\Modules\Warehouse\Http\Controllers\ReportController::class, 'stockSummary']), false); ?>">
                                        <?php echo app('translator')->get('warehouse::lang.stock_summary_report'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item <?php if(request()->segment(3) == 'transfers'): ?> active <?php endif; ?>"
                                       href="<?php echo e(action([\Modules\Warehouse\Http\Controllers\ReportController::class, 'transferReport']), false); ?>">
                                        <?php echo app('translator')->get('warehouse::lang.transfer_report'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item <?php if(request()->segment(3) == 'expiry'): ?> active <?php endif; ?>"
                                       href="<?php echo e(action([\Modules\Warehouse\Http\Controllers\ReportController::class, 'expiryReport']), false); ?>">
                                        <?php echo app('translator')->get('warehouse::lang.expiry_report'); ?>
                                    </a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('superadmin') || auth()->user()->hasRole('Admin#'.auth()->user()->business_id)): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(1) == 'warehouse' && request()->segment(2) == 'settings'): ?> active <?php endif; ?>"
                               href="<?php echo e(route('warehouse.settings'), false); ?>">
                                <i class="fas fa-cog me-1"></i><?php echo app('translator')->get('warehouse::lang.settings'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(1) == 'warehouse' && request()->segment(2) == 'hard-reset'): ?> active <?php endif; ?>"
                               href="<?php echo e(route('warehouse.hard-reset'), false); ?>">
                                <i class="fas fa-sync-alt me-1"></i><?php echo app('translator')->get('warehouse::lang.hard_reset_options'); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</section>
