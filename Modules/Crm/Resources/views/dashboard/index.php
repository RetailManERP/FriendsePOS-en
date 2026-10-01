

<?php $__env->startSection('title', __('home.home')); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard-enhanced.css?v=' . $asset_v), false); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content content-custom no-print">
    <!-- Dashboard Header -->
    <div class="dashboard-header mb-3">
        <div class="row align-items-center">
            <div class="col-md-6 col-12">
                <h2 class="greeting-text"><?php echo e(__('home.welcome_message', ['name' => Session::get('user.first_name')]), false); ?></h2>
                <p class="greeting-subtitle">
                    <span class="dashboard-datetime">
                        <i class="fas fa-calendar-alt"></i>
                        <?php echo e(\Carbon::now()->format('l, F j, Y'), false); ?>

                    </span>
                </p>
            </div>
        </div>
    </div>

    <div class="row">
        <?php if( $contact->type == 'supplier' || $contact->type == 'both'): ?>
            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <div class="info-box kpi-card-enhanced">
                    <span class="info-box-icon kpi-icon-sales"><i class="fas fa-shopping-bag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo app('translator')->get('report.total_purchase'); ?></span>
                        <span class="info-box-number display_currency" data-currency_symbol="true">
                            <?php echo e($contact->total_purchase, false); ?>

                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <div class="info-box kpi-card-enhanced">
                    <span class="info-box-icon kpi-icon-net"><i class="fas fa-money-check-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo app('translator')->get('contact.total_purchase_paid'); ?></span>
                        <span class="info-box-number display_currency" data-currency_symbol="true">
                            <?php echo e($contact->purchase_paid, false); ?>

                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <div class="info-box kpi-card-enhanced">
                    <span class="info-box-icon kpi-icon-due"><i class="fas fa-exclamation-circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo app('translator')->get('contact.total_purchase_due'); ?></span>
                        <span class="info-box-number display_currency" data-currency_symbol="true">
                            <?php echo e($contact->total_purchase - $contact->purchase_paid, false); ?>

                        </span>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if( $contact->type == 'customer' || $contact->type == 'both'): ?>
            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <div class="info-box kpi-card-enhanced">
                    <span class="info-box-icon kpi-icon-sales"><i class="fas fa-shopping-cart"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo app('translator')->get('report.total_sell'); ?></span>
                        <span class="info-box-number display_currency" data-currency_symbol="true">
                            <?php echo e($contact->total_invoice, false); ?>

                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <div class="info-box kpi-card-enhanced">
                    <span class="info-box-icon kpi-icon-net"><i class="fas fa-money-check-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo app('translator')->get('contact.total_sale_paid'); ?></span>
                        <span class="info-box-number display_currency" data-currency_symbol="true">
                            <?php echo e($contact->invoice_received, false); ?>

                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <div class="info-box kpi-card-enhanced">
                    <span class="info-box-icon kpi-icon-due"><i class="fas fa-exclamation-circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo app('translator')->get('contact.total_sale_due'); ?></span>
                        <span class="info-box-number display_currency" data-currency_symbol="true">
                            <?php echo e($contact->total_invoice - $contact->invoice_received, false); ?>

                        </span>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if(!empty($contact->opening_balance) && $contact->opening_balance != '0.00'): ?>
            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <div class="info-box kpi-card-enhanced">
                    <span class="info-box-icon kpi-icon-sales"><i class="fas fa-donate"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo app('translator')->get('lang_v1.opening_balance'); ?></span>
                        <span class="info-box-number display_currency" data-currency_symbol="true">
                            <?php echo e($contact->opening_balance, false); ?>

                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <div class="info-box kpi-card-enhanced">
                    <span class="info-box-icon kpi-icon-due"><i class="fas fa-donate"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo app('translator')->get('lang_v1.opening_balance_due'); ?></span>
                        <span class="info-box-number display_currency" data-currency_symbol="true">
                            <?php echo e($contact->opening_balance - $contact->opening_balance_paid, false); ?>

                        </span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('crm::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>