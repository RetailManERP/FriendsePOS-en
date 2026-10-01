
<?php $__env->startSection('title', __('superadmin::lang.superadmin') . ' | ' . __('superadmin::lang.affiliate_details')); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('superadmin::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">
            <?php echo app('translator')->get('superadmin::lang.affiliate_details'); ?>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php echo $__env->make('superadmin::layouts.partials.currency', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-xs-12">
                <?php $__env->startComponent('components.widget', ['title' => __('superadmin::lang.account')]); ?>
                    
                    <div class="col-sm-4">
                        <strong><?php echo e(optional($affiliate->user)->user_full_name, false); ?></strong><br>
                        <small class="text-muted"><?php echo e(optional($affiliate->user)->email, false); ?></small>
                    </div>
                    <div class="col-sm-4">
                        <strong><?php echo app('translator')->get('superadmin::lang.account_status'); ?>:</strong><br>
                        <?php if($affiliate->status == 'approved'): ?>
                            <span class="label bg-light-green"><?php echo e(__('superadmin::lang.affiliate_approved'), false); ?></span>
                        <?php elseif($affiliate->status == 'pending'): ?>
                            <span class="label bg-aqua"><?php echo e(__('superadmin::lang.affiliate_pending'), false); ?></span>
                        <?php elseif($affiliate->status == 'suspended'): ?>
                            <span class="label bg-yellow"><?php echo e(__('superadmin::lang.affiliate_suspended'), false); ?></span>
                        <?php else: ?>
                            <span class="label bg-red"><?php echo e(__('superadmin::lang.affiliate_rejected'), false); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12" style="margin-top: 15px;">
                        <?php echo $__env->make('superadmin::affiliate.partials.referral_link', [
                            'link' => $affiliate->referral_link,
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
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
                <?php $__env->startComponent('components.widget', ['title' => __('superadmin::lang.pay_this_affiliate')]); ?>
                    <div class="col-xs-12">
                        <p class="text-muted"><?php echo app('translator')->get('superadmin::lang.payout_help'); ?></p>

                        <?php if($payable_amount > 0 && $payable_amount >= $minimum_payout): ?>
                            
                            <p class="tw-text-sm tw-font-medium tw-text-gray-500 tw-mb-1">
                                <?php echo app('translator')->get('superadmin::lang.payable_amount'); ?>
                            </p>
                            <p class="tw-block tw-mb-3 tw-text-2xl tw-font-semibold tw-text-gray-900 tw-font-mono display_currency"
                                data-currency_symbol="true"><?php echo e($payable_amount, false); ?></p>

                            
                            <?php echo Form::open([
                                'action' => ['\Modules\Superadmin\Http\Controllers\SuperadminAffiliatesController@storePayout', $affiliate->id],
                                'method' => 'post',
                                'id' => 'affiliate_payout_form',
                            ]); ?>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <?php echo Form::label('amount', __('superadmin::lang.paying_amount') . ':'); ?>

                                            
                                            <?php echo Form::text('amount', number_format($payable_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), [
                                                'class' => 'form-control input_number',
                                                'required',
                                                'data-rule-max-value' => $payable_amount,
                                                'data-msg-max-value' => __('superadmin::lang.payout_exceeds_owed', ['owed' => number_format($payable_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator'])]),
                                                'data-rule-min-value' => $minimum_payout,
                                                'data-msg-min-value' => __('superadmin::lang.below_minimum_payout', ['minimum' => number_format($minimum_payout, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator'])]),
                                                'data-min-value' => __('superadmin::lang.below_minimum_payout', ['minimum' => number_format($minimum_payout, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator'])]),
                                            ]); ?>

                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <?php echo Form::label('transaction_id', __('superadmin::lang.payment_transaction_id') . ':'); ?>

                                            <?php echo Form::text('transaction_id', null, [
                                                'class' => 'form-control',
                                                'maxlength' => 255,
                                                'placeholder' => __('superadmin::lang.payment_transaction_id_placeholder'),
                                            ]); ?>

                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group" style="margin-top: 25px;">
                                            <button type="submit" class="tw-dw-btn tw-bg-gradient-to-r tw-from-indigo-600 tw-to-blue-500 tw-font-bold tw-text-white tw-border-none tw-rounded-full">
                                                <?php echo app('translator')->get('superadmin::lang.payout'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php echo Form::close(); ?>

                        <?php else: ?>
                            <div class="alert alert-info">
                                <?php if($payable_amount <= 0): ?>
                                    <?php echo app('translator')->get('superadmin::lang.no_payable_commission'); ?>
                                <?php else: ?>
                                    <?php echo e(__('superadmin::lang.below_minimum_payout', ['minimum' => number_format($minimum_payout, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator'])]), false); ?>

                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <?php echo $__env->make('superadmin::affiliate.partials.referral_history', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <?php echo $__env->make('superadmin::affiliate.partials.commission_history', ['show_actions' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
    <?php echo $__env->make('superadmin::affiliate.partials.disable_on_submit_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            /*
             * The payout form is only present when there is something to pay,
             * so the rules are attached from the markup and the button is
             * disabled from the submit handler rather than by
             * .disable-on-submit, which fires even when the form is invalid.
             */
            $('#affiliate_payout_form').validate({
                submitHandler: function(form) {
                    $(form).find('button[type="submit"]').prop('disabled', true);

                    form.submit();
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>