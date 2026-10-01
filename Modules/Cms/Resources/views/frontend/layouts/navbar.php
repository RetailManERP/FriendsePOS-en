<div class="fixed-nav-container">
    <nav class="hero-nav position-relative container mx-auto px-0">
        <ul class="nav w-100 list-unstyled align-items-center p-0">
            
            <li class="hero-nav__item hero-nav__brand-item">
                <a href="<?php echo e(url('/'), false); ?>" class="hero-nav__brand" aria-label="<?php echo e(config('app.name', 'BitorePOS'), false); ?> home">
                    <span class="hero-nav__logo-frame">
                    <img class="hero-nav__logo" src="<?php echo e($__logo_url, false); ?>"
                        change-src-onscroll="<?php echo e($__logo_url, false); ?>" alt="" width="48" height="48" loading="eager" fetchpriority="high">
                    </span>
                    <span class="hero-nav__brand-name"><?php echo e(config('app.name', 'BitorePOS'), false); ?></span>
                </a>
            </li>

            
            <li id="hero-menu" class="flex-grow-1 hero__nav-list hero__nav-list--mobile-menu ft-menu">
                <ul class="hero__menu-content nav flex-column flex-lg-row ft-menu__slider animated list-unstyled p-3 p-lg-0">
                    <li class="flex-grow-1">
                        <ul class="nav nav--lg-side flex-column-reverse flex-lg-row-reverse list-unstyled align-items-center p-0">
                            
                            <li class="flex-grow-1">
                                <ul class="nav nav--lg-side flex-column-reverse flex-lg-row-reverse list-unstyled align-items-center p-0">
                                    <li class="hero-nav__item">
                                        <a href="<?php echo e($navbar_btn['link'], false); ?>" target="_blank" rel="noopener noreferrer"
                                            class="btn btn-primary btn-sm">
                                            <span><?php echo e($navbar_btn['text'], false); ?></span>
                                            <i class="fas fa-arrow-right" style="font-size: 0.75rem;"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            
                            <?php if(Auth::check()): ?>
                                <li class="hero-nav__item">
                                    <a href="<?php echo e(route('home'), false); ?>" class="hero-nav__link">
                                        <i class="fas fa-th-large me-1" style="font-size: 0.8rem;"></i>
                                        <?php echo app('translator')->get('cms::lang.dashboard'); ?>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if(Route::has('login')): ?>
                                <?php if(!Auth::check()): ?>
                                    <li class="hero-nav__item">
                                        <a href="<?php echo e(route('login'), false); ?>" class="hero-nav__link">
                                            <i class="fas fa-sign-in-alt me-1" style="font-size: 0.8rem;"></i>
                                            <?php echo app('translator')->get('lang_v1.login'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>

                            
                            <?php if($__blog_count >= 1): ?>
                                <li class="hero-nav__item">
                                    <a href="<?php echo e(action([\Modules\Cms\Http\Controllers\CmsController::class, 'getBlogList']), false); ?>" class="hero-nav__link">
                                        <?php echo e(__('cms::lang.blogs'), false); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            
                            <?php if(count($__pages) > 0): ?>
                                <li class="hero-nav__item hero-nav__item--with-dropdown">
                                    <span class="hero-nav__link" tabindex="0" role="button" aria-haspopup="true" aria-expanded="false">
                                        <span class="flex-grow-1 me-1">Pages</span>
                                        <svg class="hero-nav__item-chevron bi bi-chevron-down" width=".7em" height=".7em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"></path>
                                        </svg>
                                    </span>
                                    <div class="hero-nav__dropdown dropdown dropdown--of-1-columns">
                                        <div class="row flex-wrap">
                                            <div class="col-lg-12">
                                                <?php $__currentLoopData = $__pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(action([\Modules\Cms\Http\Controllers\CmsPageController::class, 'showPage'], ['page' => $page->slug]), false); ?>" class="dropdown__link">
                                                        <i class="fas fa-file-alt me-2" style="font-size: 0.8rem; opacity: 0.5;"></i>
                                                        <div class="dropdown__item">
                                                            <span class="dropdown__item-title">
                                                                <?php echo e($page->title, false); ?>

                                                            </span>
                                                        </div>
                                                    </a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; ?>

                            
                            <li class="hero-nav__item">
                                <a href="<?php echo e(route('cms.contact.us'), false); ?>" class="hero-nav__link"><?php echo e(__('cms::lang.contact_us') ?? 'Contact Us', false); ?></a>
                            </li>

                            <?php if(Route::has('cms.commercial')): ?>
                                <li class="hero-nav__item"><a href="<?php echo e(url('features'), false); ?>" class="hero-nav__link">Features</a></li>
                                <li class="hero-nav__item"><a href="<?php echo e(url('industries'), false); ?>" class="hero-nav__link">Industries</a></li>
                            <?php endif; ?>
                            
                            <li class="hero-nav__item">
                                <a href="<?php echo e(route('docs.public'), false); ?>" target="_blank" rel="noopener noreferrer" class="hero-nav__link">Public Docs</a>
                            </li>

                            
                            <?php if(Route::has('pricing') && config('app.env') != 'demo' && empty(\App\System::getProperty('disable_pricing'))): ?>
                                <li class="hero-nav__item">
                                    <a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\PricingController::class, 'index']), false); ?>" class="hero-nav__link">
                                        <?php echo app('translator')->get('superadmin::lang.pricing'); ?>
                                    </a>
                                </li>
                            <?php endif; ?>

                            
                            <li class="hero-nav__item">
                                <a href="<?php echo e(url('/'), false); ?>" class="hero-nav__link">
                                    <?php echo e(__('cms::lang.home') ?? 'Home', false); ?>

                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <button close-nav-menu="" type="button" class="ft-menu__close-btn animated" aria-label="Close navigation menu">
                    <svg class="bi bi-x" width="1.25em" height="1.25em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 010 .708l-7 7a.5.5 0 01-.708-.708l7-7a.5.5 0 01.708 0z" clip-rule="evenodd"></path>
                        <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 000 .708l7 7a.5.5 0 00.708-.708l-7-7a.5.5 0 00-.708 0z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </li>

            
            <li class="hero-nav__item d-lg-none d-flex flex-row-reverse">
                <button open-nav-menu="" type="button" class="text-center" aria-label="Open navigation menu">
                    <i class="fas fa-bars" aria-hidden="true"></i>
                </button>
            </li>
        </ul>
    </nav>
</div>
