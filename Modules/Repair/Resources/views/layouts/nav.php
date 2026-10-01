<section class="no-print">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm m-4 px-3">
        <div class="container-fluid px-0">
            <a class="navbar-brand fw-semibold" href="<?php echo e(action([\Modules\Repair\Http\Controllers\DashboardController::class, 'index']), false); ?>">
                <i class="fas fa-wrench me-2"></i><?php echo e(__('repair::lang.repair'), false); ?>

            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#repair-navbar" aria-controls="repair-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="repair-navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if(auth()->user()->can('job_sheet.create') || auth()->user()->can('job_sheet.view_assigned') || auth()->user()->can('job_sheet.view_all')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'job-sheet' && empty(request()->segment(3))): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Repair\Http\Controllers\JobSheetController::class, 'index']), false); ?>">
                                <?php echo app('translator')->get('repair::lang.job_sheets'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('job_sheet.create')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'job-sheet' && request()->segment(3) == 'create'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Repair\Http\Controllers\JobSheetController::class, 'create']), false); ?>">
                                <?php echo app('translator')->get('repair::lang.add_job_sheet'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('repair.view') || auth()->user()->can('repair.view_own')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'repair' && empty(request()->segment(3))): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Repair\Http\Controllers\RepairController::class, 'index']), false); ?>"><?php echo app('translator')->get('repair::lang.list_invoices'); ?></a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('repair.create')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'repair' && request()->segment(3) == 'create'): ?> active <?php endif; ?>" href="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'create']). '?sub_type=repair', false); ?>"><?php echo app('translator')->get('repair::lang.add_invoice'); ?></a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('brand.view') || auth()->user()->can('brand.create')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(1) == 'brands'): ?> active <?php endif; ?>" href="<?php echo e(action([\App\Http\Controllers\BrandController::class, 'index']), false); ?>"><?php echo app('translator')->get('brand.brands'); ?></a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('edit_repair_settings')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(1) == 'repair' && request()->segment(2) == 'repair-settings'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Repair\Http\Controllers\RepairSettingsController::class, 'index']), false); ?>"><?php echo app('translator')->get('messages.settings'); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</section>
