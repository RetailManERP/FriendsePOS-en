
<?php $__env->startSection('title', $page->title); ?>
<?php $__env->startSection('content'); ?>
<?php
    $btns = $__site_details['btns'] ?? [];

    $navbar_btn['text'] = (isset($btns['navbar']) && is_array($btns['navbar']) && array_key_exists('text', $btns['navbar'])) ? ($btns['navbar']['text'] ?? '') : 'Try For Free';
    $navbar_btn['link'] = (isset($btns['navbar']) && is_array($btns['navbar']) && array_key_exists('link', $btns['navbar'])) ? ($btns['navbar']['link'] ?? '') : registration_url();
?>
<?php if ($__env->exists('cms::frontend.layouts.header')) echo $__env->make('cms::frontend.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="article-block space-between-blocks">
    <div class="container col-xxl-10 px-xxl-0">
        <div class="article col-xl-10 mx-auto">
            <div class="px-4 mb-4 text-center">
                <h1 class="article-block__title mb-3">
                    <?php echo e($page->title, false); ?>

                </h1>
            </div>
            <?php if(!empty($page->feature_image)): ?>
                <div class="article-block__header mb-5 py-4 px-xxl-5">
                    <img src="<?php echo e($page->feature_image_url ?? asset('modules/cms/img/default.png'), false); ?>" 
                        class="article-block__header-img w-100"
                        alt="<?php echo e($page->title, false); ?>"
                        loading="lazy">
                </div>
            <?php endif; ?>
            <div class="article-content">
                <?php echo $page->content; ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    if (typeof Sticky !== "undefined") {
        new Sticky("[sticky]");
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('cms::frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>