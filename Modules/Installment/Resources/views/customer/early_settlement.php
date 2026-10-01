<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action('\Modules\Installment\Http\Controllers\InstallmentController@processEarlySettlement'), 'method' => 'post', 'id' => 'early_settlement_form']); ?>

        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="fa fa-calculator"></i> <?php echo app('translator')->get('installment::lang.early_settlement'); ?></h4>
        </div>
        <div class="modal-body">
            <input type="hidden" name="plan_id" value="<?php echo e($plan->id, false); ?>">

            <div class="row">
                <div class="col-md-6">
                    <div class="well">
                        <h4><?php echo app('translator')->get('installment::lang.customer_info'); ?></h4>
                        <p><strong><?php echo app('translator')->get('installment::lang.customer_name'); ?>:</strong> <?php echo e($contact->name, false); ?></p>
                        <p><strong><?php echo app('translator')->get('installment::lang.plan_total'); ?>:</strong> <?php echo e(number_format($plan->total, 2), false); ?></p>
                        <p><strong><?php echo app('translator')->get('installment::lang.installments_paid'); ?>:</strong> <?php echo e($plan->paidnumber, false); ?> / <?php echo e($plan->number, false); ?></p>
                        <p><strong><?php echo app('translator')->get('installment::lang.progress'); ?>:</strong> <?php echo e($plan->progress_percent, false); ?>%</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="well bg-success" style="color: #fff;">
                        <h4><?php echo app('translator')->get('installment::lang.settlement_details'); ?></h4>
                        <p><strong><?php echo app('translator')->get('installment::lang.remaining_principal'); ?>:</strong> <?php echo e(number_format($settlement['remaining_principal'], 2), false); ?></p>
                        <p><strong><?php echo app('translator')->get('installment::lang.remaining_interest'); ?>:</strong> <?php echo e(number_format($settlement['remaining_interest'], 2), false); ?></p>
                        <?php if($discountPercent > 0): ?>
                            <p><strong><?php echo app('translator')->get('installment::lang.discount'); ?> (<?php echo e($discountPercent, false); ?>%):</strong> 
                                <span class="text-danger">-<?php echo e(number_format($settlement['discount_amount'], 2), false); ?></span>
                            </p>
                        <?php endif; ?>
                        <hr style="border-color: rgba(255,255,255,0.3);">
                        <h3 style="margin: 5px 0;">
                            <?php echo app('translator')->get('installment::lang.settlement_amount'); ?>: <?php echo e(number_format($settlement['settlement_amount'], 2), false); ?>

                        </h3>
                        <p><small><?php echo e($settlement['remaining_count'], false); ?> <?php echo app('translator')->get('installment::lang.remaining_installments'); ?></small></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('payment_method', __('installment::lang.payment_method') . ':'); ?>

                        <select name="payment_method" class="form-control" required>
                            <option value="cash"><?php echo app('translator')->get('lang_v1.cash'); ?></option>
                            <option value="card"><?php echo app('translator')->get('lang_v1.card'); ?></option>
                            <option value="cheque"><?php echo app('translator')->get('lang_v1.cheque'); ?></option>
                            <option value="bank_transfer"><?php echo app('translator')->get('lang_v1.bank_transfer'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('account_id', __('installment::lang.account') . ':'); ?>

                        <?php echo Form::select('account_id', $accounts, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-check"></i> <?php echo app('translator')->get('installment::lang.confirm_settlement'); ?>
            </button>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>

<script>
$(document).on('submit', 'form#early_settlement_form', function(e) {
    e.preventDefault();
    var form = $(this);
    swal({
        title: LANG.sure,
        text: '<?php echo app('translator')->get("installment::lang.confirm_settlement_text"); ?>',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
    }).then(willProceed => {
        if (willProceed) {
            var data = form.serialize();
            __disable_submit_button(form.find('button[type="submit"]'));
            $.ajax({
                method: 'POST',
                url: form.attr('action'),
                dataType: 'json',
                data: data,
                success: function(result) {
                    if (result.success) {
                        $('div.div_modal').modal('hide');
                        toastr.success(result.msg);
                        if (typeof installments_table !== 'undefined') installments_table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                },
            });
        }
    });
});
</script>
