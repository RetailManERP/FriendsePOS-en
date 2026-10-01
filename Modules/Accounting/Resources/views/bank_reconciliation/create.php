<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">

<div class="modal-header">
    <h4 class="modal-title">
        <i class="fas fa-balance-scale me-2"></i>
        <?php echo app('translator')->get('accounting::lang.new_reconciliation'); ?>
    </h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<form id="reconciliation_form"
    action="<?php echo e(action([\Modules\Accounting\Http\Controllers\BankReconciliationController::class, 'store']), false); ?>"
    method="POST">
    <?php echo csrf_field(); ?>

    <div class="modal-body">
        
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        <?php echo app('translator')->get('accounting::lang.bank_account'); ?> <span class="text-danger">*</span>
                    </label>
                    <select name="accounting_account_id" id="recon_account_id"
                        class="form-control select2" required>
                        <option value="">-- <?php echo app('translator')->get('accounting::lang.select_account'); ?> --</option>
                        <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($id, false); ?>"><?php echo e($name, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>

        
        <div id="last_recon_info" class="alert alert-info d-none">
            <i class="fas fa-info-circle me-1"></i>
            <span id="last_recon_text"></span>
        </div>

        
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label fw-semibold"><?php echo app('translator')->get('accounting::lang.statement_from_date'); ?></label>
                    <input type="date" name="statement_from_date" id="recon_from_date"
                        class="form-control">
                    <small class="text-muted"><?php echo app('translator')->get('accounting::lang.statement_from_date_help'); ?></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        <?php echo app('translator')->get('accounting::lang.statement_date'); ?> <span class="text-danger">*</span>
                    </label>
                    <input type="date" name="statement_date" id="recon_statement_date"
                        class="form-control" required
                        value="<?php echo e(date('Y-m-d'), false); ?>">
                </div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label fw-semibold"><?php echo app('translator')->get('accounting::lang.statement_opening_balance'); ?></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                        <input type="number" step="0.01" name="statement_opening_balance"
                            id="recon_opening_balance" class="form-control" value="0.00">
                    </div>
                    <small class="text-muted"><?php echo app('translator')->get('accounting::lang.opening_balance_help'); ?></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        <?php echo app('translator')->get('accounting::lang.statement_closing_balance'); ?> <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                        <input type="number" step="0.01" name="statement_closing_balance"
                            id="recon_closing_balance" class="form-control" required value="0.00">
                    </div>
                    <small class="text-muted"><?php echo app('translator')->get('accounting::lang.closing_balance_help'); ?></small>
                </div>
            </div>
        </div>

        
        <div class="mb-3">
            <label class="form-label fw-semibold"><?php echo app('translator')->get('accounting::lang.note'); ?></label>
            <textarea name="note" class="form-control" rows="2"
                placeholder="<?php echo app('translator')->get('accounting::lang.reconciliation_note_placeholder'); ?>"></textarea>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <?php echo app('translator')->get('messages.cancel'); ?>
        </button>
        <button type="submit" class="btn btn-primary" id="recon_submit_btn">
            <i class="fas fa-rocket me-1"></i> <?php echo app('translator')->get('accounting::lang.start_reconciliation'); ?>
        </button>
    </div>
</form>

<script>
$(document).ready(function () {
    // Load last reconciliation info when account changes
    $('#recon_account_id').on('change', function () {
        var account_id = $(this).val();
        if (!account_id) {
            $('#last_recon_info').addClass('d-none');
            return;
        }

        $.get('<?php echo e(action([\Modules\Accounting\Http\Controllers\BankReconciliationController::class, "getLastReconciliation"]), false); ?>',
            { account_id: account_id },
            function (res) {
                if (res.found) {
                    var msg = '<?php echo app('translator')->get("accounting::lang.last_reconciliation_info"); ?>'
                        .replace(':date', res.statement_date)
                        .replace(':balance', parseFloat(res.statement_closing_balance).toFixed(2));
                    $('#last_recon_text').html(msg);
                    $('#last_recon_info').removeClass('d-none');
                    $('#recon_opening_balance').val(parseFloat(res.statement_closing_balance).toFixed(2));
                    // Default from-date to day after last statement
                    if (res.statement_date) {
                        var nextDay = new Date(res.statement_date);
                        nextDay.setDate(nextDay.getDate() + 1);
                        $('#recon_from_date').val(nextDay.toISOString().split('T')[0]);
                    }
                } else {
                    $('#last_recon_info').addClass('d-none');
                    $('#recon_opening_balance').val('0.00');
                }
            }
        );
    });

    // Submit
    $('#reconciliation_form').on('submit', function (e) {
        e.preventDefault();
        var $btn = $('#recon_submit_btn').prop('disabled', true);

        $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    toastr.success(result.msg);
                    $('#reconciliation_modal').modal('hide');
                    // Redirect to reconcile worksheet
                    window.location.href = '/accounting/bank-reconciliation/' + result.reconciliation_id + '/reconcile';
                } else {
                    toastr.error(result.msg);
                    $btn.prop('disabled', false);
                }
            },
            error: function () {
                toastr.error('Something went wrong.');
                $btn.prop('disabled', false);
            },
        });
    });
});
</script>

</div>
</div>
