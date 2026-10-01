
<?php $__env->startSection('title', $page->title); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $page->content; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>