
<?php $__env->startSection('title', $blog->title); ?>
<?php $__env->startSection('content'); ?>
<?php if ($__env->exists('cms::frontend.layouts.header')) echo $__env->make('cms::frontend.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="article-block space-between-blocks">
        <div class="container col-xxl-10 px-xxl-0">
            <div class="article col-xl-10 mx-auto">
                <div class="px-4 mb-4 text-center">
                    <p class="article-block__info mb-3">
                        <span class="article-block__author">
                            <?php echo e($blog->createdBy->user_full_name ?? '', false); ?>

                        </span>
                        <span class="article-block__time">
                            <?php echo e(\Carbon\Carbon::parse($blog->created_at)->diffForHumans(), false); ?>

                        </span>
                    </p>
                    <h1 class="article-block__title">
                        <?php echo e($blog->title, false); ?>

                    </h1>
                </div>
                <div class="article-block__header mb-5 py-4 px-xxl-5">
                    <img src="<?php echo e($blog->feature_image_url ?? asset('modules/cms/img/default.png'), false); ?>" 
                        class="article-block__header-img w-100" 
                        alt="<?php echo e($blog->title, false); ?>"
                        loading="lazy">
                </div>
                <div class="article-content">
                    <?php echo $blog->content; ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('cms::frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>