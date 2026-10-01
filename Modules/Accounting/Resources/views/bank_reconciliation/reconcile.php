

<?php $__env->startSection('title', __('accounting::lang.bank_reconciliation') . ' - ' . $reconciliation->reference_no); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1>
        <i class="fas fa-balance-scale me-2 text-primary"></i>
        <?php echo app('translator')->get('accounting::lang.bank_reconciliation'); ?>
        <small><?php echo e($reconciliation->reference_no, false); ?> &mdash; <?php echo e($reconciliation->account->name, false); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo e(action([\Modules\Accounting\Http\Controllers\BankReconciliationController::class, 'index']), false); ?>">
                <?php echo app('translator')->get('accounting::lang.bank_reconciliation'); ?>
            </a>
        </li>
        <li class="breadcrumb-item active"><?php echo e($reconciliation->reference_no, false); ?></li>
    </ol>
</section>

<section class="content">

    
    <div class="row mb-3" id="summary_bar">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <div class="text-muted small"><?php echo app('translator')->get('accounting::lang.statement_opening_balance'); ?></div>
                <div class="fs-5 fw-bold"><?php echo e(number_format($reconciliation->statement_opening_balance, 2), false); ?></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <div class="text-muted small"><?php echo app('translator')->get('accounting::lang.statement_closing_balance'); ?></div>
                <div class="fs-5 fw-bold text-primary"><?php echo e(number_format($reconciliation->statement_closing_balance, 2), false); ?></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card border-0 shadow-sm text-center p-3">
                <div class="text-muted small"><?php echo app('translator')->get('accounting::lang.cleared_deposits'); ?></div>
                <div class="fs-5 fw-bold text-success" id="summary_credits">
                    <?php echo e(number_format($reconciliation->cleared_credit_total, 2), false); ?>

                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card border-0 shadow-sm text-center p-3">
                <div class="text-muted small"><?php echo app('translator')->get('accounting::lang.cleared_payments'); ?></div>
                <div class="fs-5 fw-bold text-warning" id="summary_debits">
                    <?php echo e(number_format($reconciliation->cleared_debit_total, 2), false); ?>

                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card border-0 shadow-sm text-center p-3">
                <div class="text-muted small"><?php echo app('translator')->get('accounting::lang.difference'); ?></div>
                <div class="fs-5 fw-bold <?php echo e(abs($reconciliation->difference) < 0.01 ? 'text-success' : 'text-danger', false); ?>" id="summary_difference">
                    <?php echo e(number_format($reconciliation->difference, 2), false); ?>

                </div>
                <div class="small" id="difference_label">
                    <?php if(abs($reconciliation->difference) < 0.01): ?>
                        <span class="text-success"><i class="fas fa-check-circle"></i> <?php echo app('translator')->get('accounting::lang.balanced'); ?></span>
                    <?php else: ?>
                        <span class="text-danger"><i class="fas fa-exclamation-circle"></i> <?php echo app('translator')->get('accounting::lang.not_balanced'); ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    
    <div class="mb-3 d-flex gap-2">
        <?php if($reconciliation->status !== 'locked'): ?>
            <button class="btn btn-success" id="btn_complete_reconciliation"
                <?php echo e(abs($reconciliation->difference) >= 0.01 ? 'disabled' : '', false); ?>>
                <i class="fas fa-check-double me-1"></i>
                <?php echo app('translator')->get('accounting::lang.complete_reconciliation'); ?>
            </button>
        <?php endif; ?>

        <?php if($reconciliation->status === 'completed'): ?>
            <button class="btn btn-info" id="btn_lock_reconciliation">
                <i class="fas fa-lock me-1"></i>
                <?php echo app('translator')->get('accounting::lang.lock_reconciliation'); ?>
            </button>
        <?php endif; ?>

        <button class="btn btn-secondary" id="btn_add_manual_item">
            <i class="fas fa-plus me-1"></i>
            <?php echo app('translator')->get('accounting::lang.add_bank_entry'); ?>
        </button>

        <a href="<?php echo e(action([\Modules\Accounting\Http\Controllers\BankReconciliationController::class, 'show'], [$reconciliation->id]), false); ?>?print=1"
            class="btn btn-outline-secondary ms-auto" target="_blank">
            <i class="fas fa-print me-1"></i> <?php echo app('translator')->get('messages.print'); ?>
        </a>
        <a href="<?php echo e(action([\Modules\Accounting\Http\Controllers\BankReconciliationController::class, 'index']), false); ?>"
            class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> <?php echo app('translator')->get('messages.back'); ?>
        </a>
    </div>

    <div class="row">

        
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-success']); ?>
                <?php $__env->slot('title'); ?>
                    <i class="fas fa-arrow-down text-success me-1"></i>
                    <?php echo app('translator')->get('accounting::lang.deposits_credits'); ?>
                    <span class="badge bg-secondary ms-2" id="credit_count"><?php echo e($items_credit->count(), false); ?></span>
                <?php $__env->endSlot(); ?>

                <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                    <table class="table table-sm table-hover" id="credit_table">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th style="width:40px;"><input type="checkbox" id="check_all_credits" title="<?php echo app('translator')->get('role.select_all'); ?>"></th>
                                <th><?php echo app('translator')->get('accounting::lang.date'); ?></th>
                                <th><?php echo app('translator')->get('accounting::lang.description'); ?></th>
                                <th class="text-end"><?php echo app('translator')->get('accounting::lang.amount'); ?></th>
                            </tr>
                        </thead>
                        <tbody id="credit_tbody">
                            <?php $__currentLoopData = $items_credit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="<?php echo e($item->is_cleared ? 'table-success' : '', false); ?> recon-item-row"
                                    data-item-id="<?php echo e($item->id, false); ?>"
                                    data-type="credit"
                                    data-amount="<?php echo e($item->amount, false); ?>">
                                    <td>
                                        <input type="checkbox"
                                            class="item-check credit-check"
                                            data-item-id="<?php echo e($item->id, false); ?>"
                                            <?php echo e($item->is_cleared ? 'checked' : '', false); ?>

                                            <?php echo e($reconciliation->status === 'locked' ? 'disabled' : '', false); ?>>
                                    </td>
                                    <td class="small"><?php echo e($item->transaction_date->format('d/m/Y'), false); ?></td>
                                    <td class="small">
                                        <?php echo e($item->description ?: ($item->reference_no ?: '—'), false); ?>

                                        <?php if($item->is_manually_added): ?>
                                            <span class="badge bg-info ms-1" style="font-size:9px;">Manual</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end small fw-semibold text-success">
                                        <?php echo e(number_format($item->amount, 2), false); ?>

                                    </td>
                                </tr>
                                <?php if($item->is_manually_added && $reconciliation->status !== 'locked'): ?>
                                    
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr class="table-light fw-semibold">
                                <td colspan="3" class="text-end"><?php echo app('translator')->get('accounting::lang.cleared_total'); ?></td>
                                <td class="text-end text-success" id="cleared_credits_total">
                                    <?php echo e(number_format($reconciliation->cleared_credit_total, 2), false); ?>

                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>

        
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-warning']); ?>
                <?php $__env->slot('title'); ?>
                    <i class="fas fa-arrow-up text-warning me-1"></i>
                    <?php echo app('translator')->get('accounting::lang.payments_debits'); ?>
                    <span class="badge bg-secondary ms-2" id="debit_count"><?php echo e($items_debit->count(), false); ?></span>
                <?php $__env->endSlot(); ?>

                <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                    <table class="table table-sm table-hover" id="debit_table">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th style="width:40px;"><input type="checkbox" id="check_all_debits" title="<?php echo app('translator')->get('role.select_all'); ?>"></th>
                                <th><?php echo app('translator')->get('accounting::lang.date'); ?></th>
                                <th><?php echo app('translator')->get('accounting::lang.description'); ?></th>
                                <th class="text-end"><?php echo app('translator')->get('accounting::lang.amount'); ?></th>
                            </tr>
                        </thead>
                        <tbody id="debit_tbody">
                            <?php $__currentLoopData = $items_debit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="<?php echo e($item->is_cleared ? 'table-warning' : '', false); ?> recon-item-row"
                                    data-item-id="<?php echo e($item->id, false); ?>"
                                    data-type="debit"
                                    data-amount="<?php echo e($item->amount, false); ?>">
                                    <td>
                                        <input type="checkbox"
                                            class="item-check debit-check"
                                            data-item-id="<?php echo e($item->id, false); ?>"
                                            <?php echo e($item->is_cleared ? 'checked' : '', false); ?>

                                            <?php echo e($reconciliation->status === 'locked' ? 'disabled' : '', false); ?>>
                                    </td>
                                    <td class="small"><?php echo e($item->transaction_date->format('d/m/Y'), false); ?></td>
                                    <td class="small">
                                        <?php echo e($item->description ?: ($item->reference_no ?: '—'), false); ?>

                                        <?php if($item->is_manually_added): ?>
                                            <span class="badge bg-info ms-1" style="font-size:9px;">Manual</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end small fw-semibold text-warning">
                                        <?php echo e(number_format($item->amount, 2), false); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr class="table-light fw-semibold">
                                <td colspan="3" class="text-end"><?php echo app('translator')->get('accounting::lang.cleared_total'); ?></td>
                                <td class="text-end text-warning" id="cleared_debits_total">
                                    <?php echo e(number_format($reconciliation->cleared_debit_total, 2), false); ?>

                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>

    </div>

    
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-default']); ?>
                <?php $__env->slot('title'); ?>
                    <i class="fas fa-clock text-secondary me-1"></i>
                    <?php echo app('translator')->get('accounting::lang.outstanding_uncleared'); ?>
                <?php $__env->endSlot(); ?>
                <p class="text-muted small mb-2"><?php echo app('translator')->get('accounting::lang.outstanding_help'); ?></p>
                <div class="row">
                    <div class="col-md-6">
                        <strong><?php echo app('translator')->get('accounting::lang.outstanding_deposits'); ?></strong>
                        <ul class="list-group list-group-flush mt-1">
                            <?php $__empty_18 = true; $__currentLoopData = $items_credit->where('is_cleared', false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                <li class="list-group-item d-flex justify-content-between px-0 py-1">
                                    <span class="small"><?php echo e($item->transaction_date->format('d/m/Y'), false); ?> — <?php echo e($item->description ?: '—', false); ?></span>
                                    <span class="small text-success fw-semibold"><?php echo e(number_format($item->amount, 2), false); ?></span>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                <li class="list-group-item px-0 py-1 text-muted small"><?php echo app('translator')->get('accounting::lang.none'); ?></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <strong><?php echo app('translator')->get('accounting::lang.outstanding_payments'); ?></strong>
                        <ul class="list-group list-group-flush mt-1">
                            <?php $__empty_18 = true; $__currentLoopData = $items_debit->where('is_cleared', false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                <li class="list-group-item d-flex justify-content-between px-0 py-1">
                                    <span class="small"><?php echo e($item->transaction_date->format('d/m/Y'), false); ?> — <?php echo e($item->description ?: '—', false); ?></span>
                                    <span class="small text-warning fw-semibold"><?php echo e(number_format($item->amount, 2), false); ?></span>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                <li class="list-group-item px-0 py-1 text-muted small"><?php echo app('translator')->get('accounting::lang.none'); ?></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

</section>


<div class="modal fade" id="manual_item_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus-circle me-2"></i><?php echo app('translator')->get('accounting::lang.add_bank_entry'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold"><?php echo app('translator')->get('accounting::lang.transaction_type'); ?> <span class="text-danger">*</span></label>
                    <select id="manual_type" class="form-control" required>
                        <option value="credit"><?php echo app('translator')->get('accounting::lang.deposit_credit'); ?></option>
                        <option value="debit"><?php echo app('translator')->get('accounting::lang.payment_debit'); ?></option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold"><?php echo app('translator')->get('accounting::lang.date'); ?> <span class="text-danger">*</span></label>
                    <input type="date" id="manual_date" class="form-control" value="<?php echo e(date('Y-m-d'), false); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold"><?php echo app('translator')->get('accounting::lang.amount'); ?> <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" id="manual_amount" class="form-control" min="0.01" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold"><?php echo app('translator')->get('accounting::lang.description'); ?></label>
                    <input type="text" id="manual_description" class="form-control" maxlength="500">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold"><?php echo app('translator')->get('accounting::lang.reference_no'); ?></label>
                    <input type="text" id="manual_reference" class="form-control" maxlength="100">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.cancel'); ?></button>
                <button type="button" class="btn btn-primary" id="btn_save_manual">
                    <i class="fas fa-save me-1"></i> <?php echo app('translator')->get('messages.save'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function () {

    var reconciliationId = <?php echo e($reconciliation->id, false); ?>;
    var toggleUrl        = '/accounting/bank-reconciliation/' + reconciliationId + '/toggle-item';
    var manualUrl        = '/accounting/bank-reconciliation/' + reconciliationId + '/manual-item';
    var completeUrl      = '/accounting/bank-reconciliation/' + reconciliationId + '/complete';
    var lockUrl          = '/accounting/bank-reconciliation/' + reconciliationId + '/lock';

    // ── Toggle Item ──────────────────────────────────────────────────────────

    $(document).on('change', '.item-check', function () {
        var $chk      = $(this);
        var item_id   = $chk.data('item-id');
        var $row      = $chk.closest('tr');

        $.ajax({
            method : 'POST',
            url    : toggleUrl,
            data   : { _token: '<?php echo e(csrf_token(), false); ?>', item_id: item_id },
            success: function (res) {
                if (res.success) {
                    // Update row highlight
                    var type = $row.data('type');
                    $row.toggleClass('table-success', res.is_cleared && type === 'credit');
                    $row.toggleClass('table-warning', res.is_cleared && type === 'debit');
                    if (!res.is_cleared) $row.removeClass('table-success table-warning');

                    updateSummary(res);
                } else {
                    $chk.prop('checked', !$chk.prop('checked'));
                    toastr.error(res.msg);
                }
            },
            error: function () {
                $chk.prop('checked', !$chk.prop('checked'));
                toastr.error('Something went wrong.');
            },
        });
    });

    // ── Select All ───────────────────────────────────────────────────────────

    $('#check_all_credits').on('change', function () {
        $('.credit-check').prop('checked', $(this).is(':checked')).trigger('change');
    });
    $('#check_all_debits').on('change', function () {
        $('.debit-check').prop('checked', $(this).is(':checked')).trigger('change');
    });

    // ── Update Summary Bar ────────────────────────────────────────────────────

    function updateSummary(res) {
        var diff    = parseFloat(res.difference);
        var credits = parseFloat(res.cleared_credit_total);
        var debits  = parseFloat(res.cleared_debit_total);

        $('#summary_credits').text(credits.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
        $('#summary_debits').text(debits.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
        $('#cleared_credits_total').text(credits.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
        $('#cleared_debits_total').text(debits.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ','));

        var $diffEl = $('#summary_difference');
        $diffEl.text(diff.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ','));

        if (Math.abs(diff) < 0.01) {
            $diffEl.removeClass('text-danger').addClass('text-success');
            $('#difference_label').html('<span class="text-success"><i class="fas fa-check-circle"></i> <?php echo app('translator')->get("accounting::lang.balanced"); ?></span>');
            $('#btn_complete_reconciliation').prop('disabled', false);
        } else {
            $diffEl.removeClass('text-success').addClass('text-danger');
            $('#difference_label').html('<span class="text-danger"><i class="fas fa-exclamation-circle"></i> <?php echo app('translator')->get("accounting::lang.not_balanced"); ?></span>');
            $('#btn_complete_reconciliation').prop('disabled', true);
        }
    }

    // ── Add Manual Item ───────────────────────────────────────────────────────

    $('#btn_add_manual_item').on('click', function () {
        $('#manual_item_modal').modal('show');
    });

    $('#btn_save_manual').on('click', function () {
        var $btn = $(this).prop('disabled', true);

        $.ajax({
            method : 'POST',
            url    : manualUrl,
            data   : {
                _token      : '<?php echo e(csrf_token(), false); ?>',
                type        : $('#manual_type').val(),
                amount      : $('#manual_amount').val(),
                transaction_date: $('#manual_date').val(),
                description : $('#manual_description').val(),
                reference_no: $('#manual_reference').val(),
            },
            success: function (res) {
                if (res.success) {
                    toastr.success(res.msg);
                    $('#manual_item_modal').modal('hide');
                    // Reload page to show new item
                    location.reload();
                } else {
                    toastr.error(res.msg);
                    $btn.prop('disabled', false);
                }
            },
            error: function () {
                toastr.error('Something went wrong.');
                $btn.prop('disabled', false);
            },
        });
    });

    // ── Complete ──────────────────────────────────────────────────────────────

    $('#btn_complete_reconciliation').on('click', function () {
        var $btn = $(this).prop('disabled', true);

        swal({
            title : '<?php echo e(__("accounting::lang.complete_reconciliation"), false); ?>',
            text  : '<?php echo e(__("accounting::lang.complete_reconciliation_confirm"), false); ?>',
            icon  : 'warning',
            buttons: true,
        }).then(function (ok) {
            if (ok) {
                $.ajax({
                    method : 'POST',
                    url    : completeUrl,
                    data   : { _token: '<?php echo e(csrf_token(), false); ?>' },
                    success: function (res) {
                        if (res.success) {
                            toastr.success(res.msg);
                            setTimeout(function () { location.reload(); }, 1200);
                        } else {
                            toastr.error(res.msg);
                            $btn.prop('disabled', false);
                        }
                    },
                });
            } else {
                $btn.prop('disabled', false);
            }
        });
    });

    // ── Lock ──────────────────────────────────────────────────────────────────

    $('#btn_lock_reconciliation').on('click', function () {
        var $btn = $(this).prop('disabled', true);
        $.ajax({
            method : 'POST',
            url    : lockUrl,
            data   : { _token: '<?php echo e(csrf_token(), false); ?>' },
            success: function (res) {
                if (res.success) {
                    toastr.success(res.msg);
                    setTimeout(function () { location.reload(); }, 1200);
                } else {
                    toastr.error(res.msg);
                    $btn.prop('disabled', false);
                }
            },
        });
    });

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>