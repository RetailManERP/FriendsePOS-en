<?php
    $custom_labels = ! empty(session()->get('business.custom_labels')) ? json_decode(session()->get('business.custom_labels'), true) : [] ;
    $is_truckmate_admin = auth()->user()->can('superadmin') || auth()->user()->hasRole('Admin#'.session('business.id'));
?>
<section class="no-print">
    <nav class="navbar navbar-expand-lg tm-nav">
        <div class="container-fluid px-0">
            <a class="navbar-brand" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\DashboardController::class, 'index']), false); ?>"><i class="fas fa-truck"></i> <?php echo e(!empty($custom_labels['truckmate_label']) ? $custom_labels['truckmate_label'] : __('truckmate::lang.truckmate'), false); ?></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#truckmate-jobsheet-navbar" aria-controls="truckmate-jobsheet-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="truckmate-jobsheet-navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if(auth()->user()->can('truckmate_job_sheet.create') || auth()->user()->can('truckmate_job_sheet.view_assigned') || auth()->user()->can('truckmate_job_sheet.view_all')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'job-sheet' && empty(request()->segment(3))): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\JobSheetController::class, 'index']), false); ?>">
                                <i class="fas fa-clipboard-list"></i> <?php echo app('translator')->get('truckmate::lang.job_sheets'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('truckmate_job_sheet.create')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'job-sheet' && request()->segment(3) == 'create'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\JobSheetController::class, 'create']), false); ?>">
                                <i class="fas fa-plus-circle"></i> <?php echo app('translator')->get('truckmate::lang.add_job_sheet'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('truckmate.view') || auth()->user()->can('truckmate.view_own')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'truckmate' && empty(request()->segment(3))): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\TruckmateController::class, 'index']), false); ?>"><i class="fas fa-file-invoice"></i> <?php echo app('translator')->get('truckmate::lang.list_invoices'); ?></a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('truckmate.add')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'truckmate' && request()->segment(3) == 'create'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\TruckmateController::class, 'create']), false); ?>"><i class="fas fa-plus-circle"></i> <?php echo app('translator')->get('truckmate::lang.add_invoice'); ?></a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('edit_truckmate_settings')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(1) == 'truckmate' && request()->segment(2) == 'truckmate-settings'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\TruckmateSettingsController::class, 'index']), false); ?>"><i class="fas fa-cog"></i> <?php echo app('translator')->get('messages.settings'); ?></a>
                        </li>
                    <?php endif; ?>

                    <?php if($is_truckmate_admin): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(1) == 'truckmate' && request()->segment(2) == 'hard-reset'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\TruckmateSettingsController::class, 'hardReset']), false); ?>"><i class="fas fa-sync-alt"></i> <?php echo app('translator')->get('truckmate::lang.hard_reset_options'); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div><!-- /.container-fluid -->
    </nav>
</section>
