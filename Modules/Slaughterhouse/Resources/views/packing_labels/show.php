
<?php $__env->startSection('title', __('slaughterhouse::lang.packing_label') . ' - ' . $label->label_no); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('slaughterhouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header"><h1><?php echo app('translator')->get('slaughterhouse::lang.packing_label'); ?> <small><?php echo e($label->label_no, false); ?></small></h1></section>
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => $label->label_no]); ?>
        <div style="max-width:420px;border:1px solid #ddd;padding:16px;">
            <h3 style="margin-top:0;"><?php echo e($label->customer_name, false); ?></h3>
            <table class="table table-bordered">
                <tr><th><?php echo app('translator')->get('slaughterhouse::lang.token_no'); ?></th><td><?php echo e($label->token_no, false); ?></td></tr>
                <tr><th><?php echo app('translator')->get('slaughterhouse::lang.animal_number'); ?></th><td><?php echo e($label->animal_number, false); ?></td></tr>
                <tr><th><?php echo app('translator')->get('slaughterhouse::lang.service_option'); ?></th><td><?php echo e($label->service_name, false); ?></td></tr>
                <tr><th><?php echo app('translator')->get('slaughterhouse::lang.zone'); ?></th><td><?php echo e($label->zone, false); ?></td></tr>
                <tr><th><?php echo app('translator')->get('slaughterhouse::lang.package_count'); ?></th><td><?php echo e($label->package_count, false); ?></td></tr>
                <tr><th><?php echo app('translator')->get('slaughterhouse::lang.net_meat_weight'); ?></th><td><?php echo e($label->net_weight, false); ?></td></tr>
            </table>
            <?php if(! empty($label->notes)): ?>
                <p><strong><?php echo app('translator')->get('slaughterhouse::lang.notes'); ?>:</strong> <?php echo e($label->notes, false); ?></p>
            <?php endif; ?>
        </div>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>