
<?php $__env->startSection('title', __('superadmin::lang.affiliate_dashboard')); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">
        <?php echo app('translator')->get('superadmin::lang.affiliate_dashboard'); ?>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <?php echo $__env->make('superadmin::layouts.partials.currency', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-xs-12">
            <?php $__env->startComponent('components.widget', ['title' => __('superadmin::lang.referral_link')]); ?>
                <?php echo $__env->make('superadmin::affiliate.partials.referral_link', [
                    'link' => $affiliate->referral_link,
                    'help' => __('superadmin::lang.referral_link_help'),
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    
    <div class="tw-grid tw-grid-cols-1 tw-gap-4 tw-mb-4 sm:tw-grid-cols-2 xl:tw-grid-cols-4 sm:tw-gap-5">
        <?php echo $__env->make('superadmin::affiliate.partials.stat_card', [
            'label' => __('superadmin::lang.click_count'),
            'value' => $stats['click_count'],
            'bg' => 'tw-bg-sky-100', 'text' => 'tw-text-sky-500',
            'icon' => '<path d="M7.904 17.563a1.2 1.2 0 0 0 2.228 .308l2.09 -3.093l4.907 4.907a1.067 1.067 0 0 0 1.509 0l1.047 -1.047a1.067 1.067 0 0 0 0 -1.509l-4.907 -4.907l3.113 -2.09a1.2 1.2 0 0 0 -.309 -2.228l-13.582 -3.904l3.904 13.563z"></path>',
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('superadmin::affiliate.partials.stat_card', [
            'label' => __('superadmin::lang.registration_count'),
            'value' => $stats['registration_count'],
            'bg' => 'tw-bg-green-100', 'text' => 'tw-text-green-600',
            'icon' => '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path><path d="M16 19h6"></path><path d="M19 16v6"></path><path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>',
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('superadmin::affiliate.partials.stat_card', [
            
            'label' => __('superadmin::lang.payable_amount'),
            'value' => $stats['payable_commission'], 'is_currency' => true,
            'bg' => 'tw-bg-yellow-100', 'text' => 'tw-text-yellow-600',
            'icon' => '<path d="M6.5 7h11"></path><path d="M6.5 17h11"></path><path d="M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z"></path><path d="M6 4v2a6 6 0 1 0 12 0v-2a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1z"></path>',
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('superadmin::affiliate.partials.stat_card', [
            'label' => __('superadmin::lang.paid_amount'),
            'value' => $stats['paid_commission'], 'is_currency' => true,
            'bg' => 'tw-bg-sky-100', 'text' => 'tw-text-sky-600',
            'icon' => '<path d="M3 6m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path><path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path><path d="M6 12l.01 0"></path><path d="M18 12l.01 0"></path>',
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <?php echo $__env->make('superadmin::affiliate.partials.referral_history', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <?php echo $__env->make('superadmin::affiliate.partials.commission_history', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <?php echo $__env->make('superadmin::affiliate.partials.payout_history', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <?php echo $__env->make('superadmin::affiliate.partials.referral_link_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>