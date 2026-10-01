
<?php $__env->startSection('title', $page->title); ?>
<?php $__env->startSection('meta'); ?>
    <meta name="description" content="<?php echo e($page->meta_description, false); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="py-2 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">
                    <?php echo e($page->title, false); ?>

                </h1>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <?php if(!empty($page->feature_image)): ?>
                <div class="row">
                    <div class="col text-center">
                        <img src="<?php echo e($page->feature_image_url ?? 'https://picsum.photos/1200/800/', false); ?>"
                            style="max-width: 100%;" loading="lazy">
                    </div>
                </div>
            <?php endif; ?>
            <div class="row mt-4">
                <div class="col">
                    <?php echo $page->content; ?>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('cms::layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>