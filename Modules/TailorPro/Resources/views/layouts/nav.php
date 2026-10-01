<?php
    $custom_labels = ! empty(session()->get('business.custom_labels')) ? json_decode(session()->get('business.custom_labels'), true) : [] ;
?>
<section class="no-print">
    <nav class="navbar navbar-expand-lg" style="background:linear-gradient(135deg,#6f42c1,#8b5cf6);border-radius:10px;margin-bottom:1rem;padding:0.5rem 1rem;">
        <div class="container-fluid px-0">
            <a class="navbar-brand text-white" href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\DashboardController::class, 'index']), false); ?>">
                <i class="fas fa-cut"></i>
                <?php echo e(!empty($custom_labels['tailorpro_label']) ? $custom_labels['tailorpro_label'] : __('tailorpro::lang.tailorpro'), false); ?>

            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#tailorpro-navbar" style="border-color:rgba(255,255,255,0.5);">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="tailorpro-navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if(auth()->user()->can('tailorpro.dashboard') || auth()->user()->can('tailorpro_order.view_all') || auth()->user()->can('tailorpro_order.view_assigned')): ?>
                        <li class="nav-item">
                            <a class="nav-link text-white <?php if(request()->segment(2) == 'dashboard'): ?> active <?php endif; ?>"
                                href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\DashboardController::class, 'index']), false); ?>">
                                <i class="fas fa-tachometer-alt"></i> <?php echo app('translator')->get('lang_v1.dashboard'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('tailorpro_order.view_all') || auth()->user()->can('tailorpro_order.view_assigned')): ?>
                        <li class="nav-item">
                            <a class="nav-link text-white <?php if(request()->segment(2) == 'orders' && empty(request()->segment(3))): ?> active <?php endif; ?>"
                                href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\OrderController::class, 'index']), false); ?>">
                                <i class="fas fa-clipboard-list"></i> <?php echo app('translator')->get('tailorpro::lang.orders'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tailorpro_order.create')): ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\OrderController::class, 'create']), false); ?>">
                                <i class="fas fa-plus-circle"></i> <?php echo app('translator')->get('tailorpro::lang.add_order'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tailorpro_measurement.view')): ?>
                        <li class="nav-item">
                            <a class="nav-link text-white <?php if(request()->segment(2) == 'measurements'): ?> active <?php endif; ?>"
                                href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\MeasurementController::class, 'index']), false); ?>">
                                <i class="fas fa-ruler-combined"></i> <?php echo app('translator')->get('tailorpro::lang.measurements'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('tailorpro_catalog.view') || auth()->user()->can('tailorpro_catalog.create') || auth()->user()->hasRole('Admin#' . session('business.id'))): ?>
                        <li class="nav-item">
                            <a class="nav-link text-white <?php if(request()->segment(2) == 'garment-catalog'): ?> active <?php endif; ?>"
                                href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\GarmentCatalogController::class, 'index']), false); ?>">
                                <i class="fas fa-tshirt"></i> <?php echo app('translator')->get('tailorpro::lang.garment_catalog'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('tailorpro_measurement_template.manage') || auth()->user()->hasRole('Admin#' . session('business.id'))): ?>
                        <li class="nav-item">
                            <a class="nav-link text-white <?php if(request()->segment(2) == 'measurement-templates'): ?> active <?php endif; ?>"
                                href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\MeasurementTemplateController::class, 'index']), false); ?>">
                                <i class="fas fa-drafting-compass"></i> <?php echo app('translator')->get('tailorpro::lang.measurement_templates'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tailorpro_report.view')): ?>
                        <li class="nav-item">
                            <a class="nav-link text-white <?php if(request()->segment(2) == 'reports'): ?> active <?php endif; ?>"
                                href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\ReportController::class, 'index']), false); ?>">
                                <i class="fas fa-chart-bar"></i> <?php echo app('translator')->get('tailorpro::lang.reports'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('tailorpro_status.access') || auth()->user()->hasRole('Admin#' . session('business.id'))): ?>
                        <li class="nav-item">
                            <a class="nav-link text-white <?php if(request()->segment(2) == 'statuses'): ?> active <?php endif; ?>"
                                href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\StatusController::class, 'index']), false); ?>">
                                <i class="fas fa-tags"></i> <?php echo app('translator')->get('tailorpro::lang.statuses'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_tailorpro_settings')): ?>
                        <li class="nav-item">
                            <a class="nav-link text-white <?php if(request()->segment(2) == 'settings'): ?> active <?php endif; ?>"
                                href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\SettingsController::class, 'index']), false); ?>">
                                <i class="fas fa-cog"></i> <?php echo app('translator')->get('tailorpro::lang.settings'); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</section>
