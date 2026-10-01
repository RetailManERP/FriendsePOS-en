

<?php $__env->startSection('title', __('superadmin::lang.superadmin') . ' | ' . __('superadmin::lang.record_payouts')); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('superadmin::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <section class="content-header">
        <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">
            <?php echo app('translator')->get('superadmin::lang.record_payouts'); ?>
        </h1>
    </section>

    <section class="content">
    <?php echo $__env->make('superadmin::layouts.partials.currency', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-xs-12">
                
                <?php $__env->startComponent('components.widget'); ?>
                    <div class="col-xs-12">
                        <p class="text-muted"><?php echo app('translator')->get('superadmin::lang.record_payouts_help'); ?></p>

                        <?php echo Form::open([
                            'url' => action([\Modules\Superadmin\Http\Controllers\SuperadminAffiliatesController::class, 'storeBulkPayout']),
                            'method' => 'post',
                            'id' => 'affiliate_payout_form',
                        ]); ?>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped tw-w-full" id="affiliate_payout_table">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('superadmin::lang.affiliate'); ?></th>
                                        <th class="tw-text-right"><?php echo app('translator')->get('superadmin::lang.payable_amount'); ?></th>
                                        <th><?php echo app('translator')->get('superadmin::lang.paying_amount'); ?></th>
                                        <th><?php echo app('translator')->get('superadmin::lang.payment_transaction_id'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        
                                        <?php
                                            $below_minimum = $row->owed < $minimum_payout;
                                        ?>
                                        <tr>
                                            <td>
                                                <strong><?php echo e(optional($row->user)->user_full_name, false); ?></strong><br>
                                                <small class="text-muted"><?php echo e(optional($row->user)->email, false); ?></small>
                                            </td>
                                            <td class="tw-text-right">
                                                <span class="display_currency tw-font-mono" data-currency_symbol="true" data-use_page_currency="true"><?php echo e($row->owed, false); ?></span>
                                            </td>
                                            <td>
                                                <?php if($below_minimum): ?>
                                                    <span class="text-muted">
                                                        <?php echo e(__('superadmin::lang.below_minimum_payout', ['minimum' => number_format($minimum_payout, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator'])]), false); ?>

                                                    </span>
                                                <?php else: ?>
                                                    
                                                    <?php echo Form::text('payouts[' . $row->id . '][amount]', number_format($row->owed, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), [
                                                        'class' => 'form-control input_number payout-amount',
                                                        'data-rule-max-value' => $row->owed,
                                                        'data-msg-max-value' => __('superadmin::lang.payout_exceeds_owed', ['owed' => number_format($row->owed, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator'])]),
                                                        'data-rule-min-value' => $minimum_payout,
                                                        'data-msg-min-value' => __('superadmin::lang.below_minimum_payout', ['minimum' => number_format($minimum_payout, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator'])]),
                                                        'data-min-value' => __('superadmin::lang.below_minimum_payout', ['minimum' => number_format($minimum_payout, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator'])]),
                                                    ]); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if(! $below_minimum): ?>
                                                    <?php echo Form::text('payouts[' . $row->id . '][transaction_id]', null, [
                                                        'class' => 'form-control',
                                                        'maxlength' => 255,
                                                        'placeholder' => __('superadmin::lang.payment_transaction_id_placeholder'),
                                                    ]); ?>

                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="tw-text-right"><?php echo app('translator')->get('superadmin::lang.total'); ?></th>
                                        <th class="tw-text-right">
                                            <span class="display_currency tw-font-mono" data-currency_symbol="true" data-use_page_currency="true"><?php echo e($rows->sum('owed'), false); ?></span>
                                        </th>
                                        
                                        <th class="tw-text-right">
                                            <span id="payout_total" class="tw-font-mono"></span>
                                        </th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <p class="text-muted"><?php echo app('translator')->get('superadmin::lang.record_payouts_skip_help'); ?></p>

                        <div class="tw-flex tw-gap-3 tw-mt-4">
                            <button type="submit"
                                class="tw-dw-btn tw-bg-gradient-to-r tw-from-indigo-600 tw-to-blue-500 tw-font-bold tw-text-white tw-border-none tw-rounded-full">
                                <?php echo app('translator')->get('superadmin::lang.record_payments'); ?>
                            </button>
                            <a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\AffiliateSettingsController::class, 'edit']), false); ?>"
                                class="tw-dw-btn tw-dw-btn-outline tw-rounded-full">
                                <?php echo app('translator')->get('messages.cancel'); ?>
                            </a>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            /*
             * The running total is the sum of what is actually in the boxes,
             * not of what is owed: a cleared or reduced amount has to be
             * visible in the figure before the payments are recorded.
             */
            var refreshTotal = function() {
                var total = 0;

                /*
                 * __number_uf reads a value written in the business's own
                 * number format, and __currency_trans_from_en writes it back
                 * the same way. parseFloat and toFixed would disagree with the
                 * rest of the page anywhere a comma is the decimal separator.
                 */
                $('.payout-amount').each(function() {
                    total += __number_uf($(this).val()) || 0;
                });

                $('#payout_total').text(__currency_trans_from_en(total, true));
            };

            $('#affiliate_payout_table').on('input', '.payout-amount', refreshTotal);

            refreshTotal();

            $('#affiliate_payout_form').validate({
                submitHandler: function(form) {
                    //Every box cleared means nothing was chosen to pay.
                    var filled = $('.payout-amount').filter(function() {
                        return $.trim($(this).val()) !== '';
                    });

                    if (filled.length === 0) {
                        toastr.error(<?php echo json_encode(__('superadmin::lang.payout_amount_required'), 15, 512) ?>);

                        return false;
                    }

                    //Disabled only now that the form is known to be valid.
                    $(form).find('button[type="submit"]').prop('disabled', true);

                    form.submit();
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>