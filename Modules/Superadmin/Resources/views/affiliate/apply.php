
<?php $__env->startSection('title', __('superadmin::lang.become_an_affiliate')); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black"><?php echo app('translator')->get('superadmin::lang.become_an_affiliate'); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <?php if(!empty($affiliate)): ?>
                
                <?php $__env->startComponent('components.widget', ['title' => __('superadmin::lang.affiliate_application_status')]); ?>
                    <div class="col-xs-12">
                        <p>
                            <strong><?php echo app('translator')->get('superadmin::lang.account_status'); ?>:</strong>
                            <?php if($affiliate->status == 'approved'): ?>
                                <span class="label bg-light-green"><?php echo e(__('superadmin::lang.affiliate_approved'), false); ?></span>
                            <?php elseif($affiliate->status == 'pending'): ?>
                                <span class="label bg-aqua"><?php echo e(__('superadmin::lang.affiliate_pending'), false); ?></span>
                            <?php elseif($affiliate->status == 'suspended'): ?>
                                <span class="label bg-yellow"><?php echo e(__('superadmin::lang.affiliate_suspended'), false); ?></span>
                            <?php else: ?>
                                <span class="label bg-red"><?php echo e(__('superadmin::lang.affiliate_rejected'), false); ?></span>
                            <?php endif; ?>
                        </p>

                        <div class="alert
                            <?php if($affiliate->status == 'approved'): ?> alert-success
                            <?php elseif($affiliate->status == 'pending'): ?> alert-info
                            <?php else: ?> alert-warning <?php endif; ?>">
                            <?php if($affiliate->status == 'approved'): ?>
                                <?php echo app('translator')->get('superadmin::lang.affiliate_status_approved_msg'); ?>
                            <?php elseif($affiliate->status == 'pending'): ?>
                                <?php echo app('translator')->get('superadmin::lang.affiliate_status_pending_msg'); ?>
                            <?php elseif($affiliate->status == 'suspended'): ?>
                                <?php echo app('translator')->get('superadmin::lang.affiliate_status_suspended_msg'); ?>
                            <?php else: ?>
                                <?php echo app('translator')->get('superadmin::lang.affiliate_status_rejected_msg'); ?>
                            <?php endif; ?>
                        </div>

                        <?php if($affiliate->status == 'approved'): ?>
                            <div class="form-group">
                                <?php echo Form::label('referral_link', __('superadmin::lang.referral_link') . ':'); ?>

                                <?php echo Form::text('referral_link', $affiliate->referral_link, ['class' => 'form-control', 'readonly']); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            <?php else: ?>
                
                <?php echo Form::open([
                    'action' => '\Modules\Superadmin\Http\Controllers\AffiliateController@store',
                    'method' => 'post',
                    'id' => 'affiliate_apply_form',
                ]); ?>


                <?php $__env->startComponent('components.widget', ['title' => __('superadmin::lang.affiliate_program_details')]); ?>
                    <div class="col-xs-12">
                        <div class="tw-grid tw-grid-cols-1 tw-gap-4 sm:tw-grid-cols-2 xl:tw-grid-cols-4 sm:tw-gap-5">
                            <?php echo $__env->make('superadmin::affiliate.partials.stat_card', [
                                'label' => __('superadmin::lang.commission_percentage'),
                                'value' => $commission_percentage . '%',
                                'bg' => 'tw-bg-green-100', 'text' => 'tw-text-green-600',
                                'icon' => '<path d="M17 17m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path><path d="M7 7m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path><path d="M6 18l12 -12"></path>',
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <?php echo $__env->make('superadmin::affiliate.partials.stat_card', [
                                'label' => __('superadmin::lang.affiliate_cookie_duration'),
                                'value' => $cookie_days . ' ' . __('superadmin::lang.days'),
                                'bg' => 'tw-bg-sky-100', 'text' => 'tw-text-sky-500',
                                'icon' => '<path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path><path d="M12 7v5l3 3"></path>',
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            
                            <?php if($minimum_payout > 0): ?>
                                <?php echo $__env->make('superadmin::affiliate.partials.stat_card', [
                                    'label' => __('superadmin::lang.minimum_payout'),
                                    'value' => $minimum_payout, 'is_currency' => true,
                                    'bg' => 'tw-bg-primary-100', 'text' => 'tw-text-primary-600',
                                    'icon' => '<path d="M3 6m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path><path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path><path d="M6 12l.01 0"></path><path d="M18 12l.01 0"></path>',
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php echo $__env->renderComponent(); ?>

                <?php $__env->startComponent('components.widget', ['title' => __('superadmin::lang.affiliate_terms_and_conditions')]); ?>
                    <div class="col-xs-12">
                        <?php if(!empty($terms)): ?>
                            <div class="well" style="max-height: 400px; overflow-y: auto;">
                                <?php echo $terms; ?>

                            </div>
                        <?php else: ?>
                            <div class="alert alert-info">
                                <?php echo app('translator')->get('superadmin::lang.affiliate_terms_not_configured'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label>
                                <?php echo Form::checkbox('accept_tc', 1, false, ['class' => 'input-icheck', 'required']); ?>

                                <?php echo app('translator')->get('superadmin::lang.i_accept_the_affiliate_tc'); ?>
                            </label>
                            <?php if($errors->has('accept_tc')): ?>
                                <br><span class="text-danger"><?php echo e($errors->first('accept_tc'), false); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="form-group">
                            <?php echo e(Form::submit(__('superadmin::lang.submit_affiliate_application'), ['class' => "tw-dw-btn tw-bg-gradient-to-r tw-from-indigo-600 tw-to-blue-500 tw-font-bold tw-text-white tw-border-none tw-rounded-full"]), false); ?>

                        </div>
                    </div>
                <?php echo $__env->renderComponent(); ?>
                <?php echo Form::close(); ?>

            <?php endif; ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('form#affiliate_apply_form').validate({
            /*
             * iCheck hides the real checkbox and shows its own markup, so the
             * default ":hidden" ignore rule would skip accept_tc entirely and
             * let the form submit without it being ticked.
             */
            ignore: [],
            rules: {
                accept_tc: {
                    required: true
                }
            },
            messages: {
                accept_tc: {
                    required: "<?php echo e(__('superadmin::lang.please_accept_affiliate_tc'), false); ?>"
                }
            },
            errorPlacement: function(error, element) {
                //The checkbox itself is hidden, so hang its error off the label.
                if (element.attr('name') === 'accept_tc') {
                    error.insertAfter(element.closest('.form-group').find('label').last());
                } else {
                    error.insertAfter(element);
                }
            },
            /*
             * Only reached once the form is valid, so a failed validation never
             * leaves the button stuck. Disabling it here is what stops a double
             * submit creating a second application.
             */
            submitHandler: function(form) {
                $(form).find('input[type="submit"], button[type="submit"]').prop('disabled', true);

                form.submit();
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>