<section class="no-print">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm m-4 px-3">
        <div class="container-fluid px-0">
            <a class="navbar-brand fw-semibold" href="<?php echo e(action([\Modules\Recruitment\Http\Controllers\RecruitmentDashboardController::class, 'index']), false); ?>"><i class="fa fas fa-user-plus me-2"></i><?php echo app('translator')->get('recruitment::lang.recruitment'); ?></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#recruitment-navbar" aria-controls="recruitment-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="recruitment-navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'job-openings'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Recruitment\Http\Controllers\JobOpeningController::class, 'index']), false); ?>"><?php echo app('translator')->get('recruitment::lang.job_openings'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'candidates'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Recruitment\Http\Controllers\CandidateController::class, 'index']), false); ?>"><?php echo app('translator')->get('recruitment::lang.candidates'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'applications'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Recruitment\Http\Controllers\ApplicationController::class, 'index']), false); ?>"><?php echo app('translator')->get('recruitment::lang.applications'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'interviews'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Recruitment\Http\Controllers\InterviewController::class, 'index']), false); ?>"><?php echo app('translator')->get('recruitment::lang.interviews'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'offers'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Recruitment\Http\Controllers\OfferController::class, 'index']), false); ?>"><?php echo app('translator')->get('recruitment::lang.offers'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'onboardings'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Recruitment\Http\Controllers\OnboardingController::class, 'index']), false); ?>"><?php echo app('translator')->get('recruitment::lang.onboarding'); ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>
