<section class="no-print">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm m-4 px-3">
        <div class="container-fluid px-0">
            <a class="navbar-brand fw-semibold" href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\ProductionDashboardController::class, 'index']), false); ?>"><i class="fas fa-industry me-2"></i><?php echo e(__('manufacturing::lang.manufacturing'), false); ?></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#manufacturing-navbar" aria-controls="manufacturing-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php
              $manufacturing_settings  = json_decode(session()->get('business.manufacturing_settings'), true);
              $__mfg_can_demand_reports = auth()->user()->can('manufacturing.demand_order_report.view')
                || auth()->user()->can('manufacturing.demand_ingredient_report.view')
                || auth()->user()->can('manufacturing.access_reports');
              $__mfg_can_production_reports = auth()->user()->can('manufacturing.manufacturing_report.view')
                || auth()->user()->can('manufacturing.recipe_report.view')
                || auth()->user()->can('manufacturing.productions_report.view')
                || auth()->user()->can('manufacturing.production_transfer_products_summary.view')
                || auth()->user()->can('manufacturing.access_reports');
            ?>
            <div class="collapse navbar-collapse" id="manufacturing-navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manufacturing.access_recipe')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(1) == 'manufacturing' && in_array(request()->segment(2), ['recipe', 'add-ingredient'])): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\RecipeController::class, 'index']), false); ?>"><?php echo app('translator')->get('manufacturing::lang.recipe'); ?></a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manufacturing.access_production')): ?>
                        
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'production'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\ProductionController::class, 'index']), false); ?>"><?php echo app('translator')->get('manufacturing::lang.production'); ?></a>
                        </li>

                        <?php if(!empty($manufacturing_settings['enable_reverse_production'])): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'reverse-production'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\ReverseProductionController::class, 'index']), false); ?>"><?php echo app('translator')->get('manufacturing::lang.reverse_production'); ?></a>
                        </li>
                        <?php endif; ?>
                    <?php endif; ?>

                    
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manufacturing.access_demand_order')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'demand-order'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\DemandOrderController::class, 'index']), false); ?>">
                                <?php echo app('translator')->get('manufacturing::lang.demand_order'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(!empty($manufacturing_settings['enable_quality_control'])): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manufacturing.access_quality_control')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'quality-inspection'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\QualityInspectionController::class, 'index']), false); ?>">
                                <i class="fas fa-clipboard-check"></i> <?php echo app('translator')->get('manufacturing::lang.quality_control'); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php endif; ?>

                    
                    <?php if($__mfg_can_demand_reports || $__mfg_can_production_reports): ?>
                        <?php
                            $__mfg_reports_active = request()->segment(2) == 'demand-ingredient-report'
                                || request()->segment(2) == 'report'
                                || request()->segment(2) == 'recipe-report'
                                || request()->segment(2) == 'productions-report'
                                || request()->segment(2) == 'production-transfer-products-summary'
                                || (request()->segment(2) == 'demand-order' && !auth()->user()->can('manufacturing.access_demand_order'));
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php if($__mfg_reports_active): ?> active <?php endif; ?>" href="#" id="mfgReportsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-chart-bar"></i> <?php echo app('translator')->get('manufacturing::lang.reports'); ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="mfgReportsDropdown">
                                <?php if(!auth()->user()->can('manufacturing.access_demand_order') && (auth()->user()->can('manufacturing.demand_order_report.view') || auth()->user()->can('manufacturing.access_reports'))): ?>
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\DemandOrderController::class, 'index']), false); ?>">
                                        <i class="fas fa-list-alt"></i> <?php echo app('translator')->get('manufacturing::lang.demand_order'); ?>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('manufacturing.demand_ingredient_report.view') || auth()->user()->can('manufacturing.access_reports')): ?>
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\DemandIngredientReportController::class, 'index']), false); ?>">
                                        <i class="fas fa-flask"></i> <?php echo app('translator')->get('manufacturing::lang.demand_ingredient_report'); ?>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php if($__mfg_can_demand_reports && $__mfg_can_production_reports): ?>
                                <li><hr class="dropdown-divider"></li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('manufacturing.manufacturing_report.view') || auth()->user()->can('manufacturing.access_reports')): ?>
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\ProductionController::class, 'getManufacturingReport']), false); ?>">
                                        <i class="fas fa-chart-line"></i> <?php echo app('translator')->get('manufacturing::lang.manufacturing_report'); ?>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('manufacturing.recipe_report.view') || auth()->user()->can('manufacturing.access_reports')): ?>
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\RecipeController::class, 'getRecipeReport']), false); ?>">
                                        <i class="fas fa-utensils"></i> <?php echo app('translator')->get('manufacturing::lang.recipe_report'); ?>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('manufacturing.productions_report.view') || auth()->user()->can('manufacturing.access_reports')): ?>
                                <li>
                                    <a class="dropdown-item <?php if(request()->segment(2) == 'productions-report'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\ProductionsReportController::class, 'index']), false); ?>">
                                        <i class="fas fa-chart-area"></i> <?php echo app('translator')->get('manufacturing::lang.productions_report'); ?>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php if(auth()->user()->can('manufacturing.production_transfer_products_summary.view') || auth()->user()->can('manufacturing.access_reports')): ?>
                                <li>
                                    <a class="dropdown-item <?php if(request()->segment(2) == 'production-transfer-products-summary'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\ProductionsReportController::class, 'productionTransferProductsSummary']), false); ?>">
                                        <i class="fas fa-balance-scale"></i> <?php echo app('translator')->get('manufacturing::lang.production_transfer_products_summary'); ?>
                                    </a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(auth()->user()->can('superadmin') || auth()->user()->hasRole('Admin#' . session()->get('user.business_id')) || auth()->user()->can('manufacturing.access_settings')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(1) == 'manufacturing' && request()->segment(2) == 'settings'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\SettingsController::class, 'index']), false); ?>"><?php echo app('translator')->get('messages.settings'); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</section>
