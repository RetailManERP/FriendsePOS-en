<section class="no-print">
    <?php
        $business_id = session('user.business_id');
        $can_use_ai = auth()->user()->can('superadmin')
            || auth()->user()->can('aiassistance.access_aiassistance_module')
            || auth()->user()->hasRole('Admin#' . $business_id);
    ?>
    <div class="card radius-10 mb-3">
        <div class="card-body py-2 px-3">
            <nav class="navbar navbar-expand-lg p-0">
                <a class="navbar-brand fw-semibold mb-0" href="<?php echo e(action([\Modules\AiAssistance\Http\Controllers\AiAssistanceController::class, 'index']), false); ?>">
                    <i class="fas fa-robot me-1"></i> <?php echo e(__('aiassistance::lang.aiassistance'), false); ?>

                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#aiassistance-navbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="aiassistance-navbar">
                    <ul class="navbar-nav me-auto">
                        <?php if($can_use_ai): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->segment(2) == 'aiassistance' && !in_array(request()->segment(3), ['history','bi','showcase'])): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\AiAssistance\Http\Controllers\AiAssistanceController::class, 'index']), false); ?>">
                                    <i class="fas fa-tools me-1"></i> <?php echo app('translator')->get('aiassistance::lang.aiassistance'); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if($can_use_ai): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->segment(3) == 'history'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\AiAssistance\Http\Controllers\AiAssistanceController::class, 'history']), false); ?>">
                                    <i class="fas fa-history me-1"></i> <?php echo app('translator')->get('aiassistance::lang.history'); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if($can_use_ai): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->segment(3) == 'bi'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\AiAssistance\Http\Controllers\AiBusinessIntelligenceController::class, 'index']), false); ?>">
                                    <i class="fas fa-brain me-1"></i> <?php echo app('translator')->get('aiassistance::lang.ai_business_intelligence'); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if($can_use_ai): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if(request()->segment(3) == 'showcase'): ?> active <?php endif; ?>" href="<?php echo e(url('/aiassistance/showcase'), false); ?>">
                                    <i class="fas fa-star me-1"></i> Showcase
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</section>
