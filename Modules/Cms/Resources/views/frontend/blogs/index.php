
<?php $__env->startSection('title', 'POS & ERP Insights'); ?>
<?php $__env->startSection('css'); ?>
<style type="text/css">
    .blog-img {
        height: 220px !important;
        object-fit: cover !important;
        max-width: 100% !important;
        border-radius: var(--cms-radius-lg) var(--cms-radius-lg) 0 0;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php if ($__env->exists('cms::frontend.layouts.header')) echo $__env->make('cms::frontend.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="article-block space-between-blocks">
    <div class="container col-xxl-10 px-xxl-0">
        
        <div class="text-center mb-5">
            <div class="section-badge mx-auto mb-3">
                <i class="fas fa-rss"></i>
                <span>Insights & Resources</span>
            </div>
            <h1 class="section-title">POS &amp; ERP Insights</h1>
            <p class="section-subtitle mx-auto">Articles about Point of Sale, inventory management and everyday business operations.</p>
        </div>
        
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            <?php $__empty_18 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                <div class="col">
                    <div class="blog-card">
                        <img src="<?php echo e($blog->feature_image_url ?? asset('modules/cms/img/default.png'), false); ?>"
                            class="blog-card__img" 
                            alt="<?php echo e($blog->title, false); ?>"
                            loading="lazy">
                        <div class="blog-card__body">
                            <a href="<?php echo e(action([\Modules\Cms\Http\Controllers\CmsController::class, 'viewBlog'], ['id' => $blog->id, 'slug' => $blog->slug]), false); ?>" class="text-decoration-none">
                                <h2 class="blog-card__title">
                                    <?php echo e($blog->title, false); ?>

                                </h2>
                            </a>
                            <?php if(!empty($blog->meta_description)): ?>
                                <p class="blog-card__excerpt" title="<?php echo e($blog->meta_description, false); ?>">
                                    <?php echo e(substr($blog->meta_description, 0, 160), false); ?>...
                                </p>
                            <?php endif; ?>
                            <div class="blog-card__meta d-flex justify-content-between align-items-center">
                                <a class="btn btn-sm btn-primary"
                                    href="<?php echo e(action([\Modules\Cms\Http\Controllers\CmsController::class, 'viewBlog'], ['id' => $blog->id, 'slug' => $blog->slug]), false); ?>">
                                    <span>Read more</span>
                                    <i class="fas fa-arrow-right" style="font-size: 0.7rem;"></i>
                                </a>
                                <small class="text-muted" title="last updated">
                                    <?php echo e(\Carbon\Carbon::parse($blog->created_at)->diffForHumans(), false); ?>

                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                <div class="col-12 text-center py-5">
                    <div class="icon-box icon-box--lg icon-box--primary mx-auto mb-3">
                        <i class="fas fa-pen-fancy"></i>
                    </div>
                    <h3 class="section-title" style="font-size: 1.5rem;">Fresh Content Coming Soon</h3>
                    <p class="section-subtitle mx-auto">We're preparing valuable insights for you. Check back shortly!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('cms::frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>