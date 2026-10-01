<section class="no-print">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm m-4 px-3">
        <div class="container-fluid px-0">
            <a class="navbar-brand fw-semibold" href="<?php echo e(action('\Modules\FieldForce\Http\Controllers\FieldForceDashboardController@index'), false); ?>"><i class="fa fas fa-users-cog me-2"></i><?php echo e(__('fieldforce::lang.field_force'), false); ?></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#fieldforce-navbar" aria-controls="fieldforce-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="fieldforce-navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'visits'): ?> active <?php endif; ?>" href="<?php echo e(action('\Modules\FieldForce\Http\Controllers\FieldForceController@index'), false); ?>"><?php echo app('translator')->get('fieldforce::lang.visits'); ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>
