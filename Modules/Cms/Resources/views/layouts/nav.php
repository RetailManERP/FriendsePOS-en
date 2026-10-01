<section class="no-print">
    <nav class="navbar navbar-expand-lg cms-admin-nav">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo e(action([\Modules\Cms\Http\Controllers\CmsPageController::class, 'index'], ['type' => 'page']), false); ?>">
                <i class="fas fa-globe"></i> <?php echo app('translator')->get('cms::lang.cms'); ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#cmsNavbarContent" aria-controls="cmsNavbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="cmsNavbarContent">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link <?php if(request()->segment(2) == 'site-details'): ?> active <?php endif; ?>" 
                        href="<?php echo e(action([\Modules\Cms\Http\Controllers\SettingsController::class, 'index']), false); ?>">
                        <i class="fas fa-cog me-1"></i> <?php echo app('translator')->get('cms::lang.site_details'); ?>
                    </a>
                    <a class="nav-link <?php if(request()->segment(2) == 'content-files'): ?> active <?php endif; ?>"
                        href="<?php echo e(action([\Modules\Cms\Http\Controllers\CmsContentController::class, 'index']), false); ?>">
                        <i class="fas fa-file-code me-1"></i> <?php echo app('translator')->get('cms::lang.content_files'); ?>
                    </a>
                    <a class="nav-link <?php if(request()->type == 'page'): ?> active <?php endif; ?>"
                        href="<?php echo e(action([\Modules\Cms\Http\Controllers\CmsPageController::class, 'index'], ['type' => 'page']), false); ?>">
                        <i class="fas fa-file-alt me-1"></i> <?php echo app('translator')->get('cms::lang.page'); ?>
                    </a>
                    <a class="nav-link <?php if(request()->type == 'blog'): ?> active <?php endif; ?>"
                        href="<?php echo e(action([\Modules\Cms\Http\Controllers\CmsPageController::class, 'index'], ['type' => 'blog']), false); ?>">
                        <i class="fas fa-rss me-1"></i> <?php echo app('translator')->get('cms::lang.blog'); ?>
                    </a>
                    <a class="nav-link <?php if(request()->type == 'testimonial'): ?> active <?php endif; ?>"
                        href="<?php echo e(action([\Modules\Cms\Http\Controllers\CmsPageController::class, 'index'], ['type' => 'testimonial']), false); ?>">
                        <i class="fas fa-quote-right me-1"></i> <?php echo app('translator')->get('cms::lang.testimonial'); ?>
                    </a>
                    <?php if(auth()->user()->can('superadmin') || auth()->user()->can('cms.view_leads') || auth()->user()->can('cms.manage_leads')): ?>
                    <a class="nav-link <?php if(request()->segment(2) == 'leads'): ?> active <?php endif; ?>"
                        href="<?php echo e(action([\Modules\Cms\Http\Controllers\CmsLeadController::class, 'index']), false); ?>">
                        <i class="fas fa-address-book me-1"></i> <?php echo app('translator')->get('cms::lang.contact_leads'); ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</section>
