<?php
    $custom_labels = ! empty(session()->get('business.custom_labels')) ? json_decode(session()->get('business.custom_labels'), true) : [] ;
?>
<section class="no-print">
    <nav class="navbar navbar-expand-lg tm-nav">
        <div class="container-fluid px-0">
            <a class="navbar-brand" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\DashboardController::class, 'index']), false); ?>"><i class="fas fa-truck"></i> <?php echo e(!empty($custom_labels['truckmate_label']) ? $custom_labels['truckmate_label'] : __('truckmate::lang.truckmate'), false); ?></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#truckmate-container-navbar" aria-controls="truckmate-container-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="truckmate-container-navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'containers' && empty(request()->segment(3))): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\ContainerController::class, 'index']), false); ?>">
                            <i class="fas fa-folder-open"></i> <?php echo app('translator')->get('truckmate::lang.container_docs'); ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'containers' && request()->segment(3) == 'create'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\ContainerController::class, 'create']), false); ?>">
                            <i class="fas fa-plus-circle"></i> <?php echo app('translator')->get('truckmate::lang.add_container'); ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>
