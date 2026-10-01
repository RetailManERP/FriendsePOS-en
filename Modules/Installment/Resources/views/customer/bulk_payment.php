<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action('\Modules\Installment\Http\Controllers\InstallmentController@processBulkPayment'), 'method' => 'post', 'id' => 'bulk_payment_form']); ?>

        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="fa fa-layer-group"></i> <?php echo app('translator')->get('installment::lang.bulk_payment'); ?> - <?php echo e($contact->name, false); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle"></i> <?php echo app('translator')->get('installment::lang.bulk_payment_info'); ?>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 40px;">
                                <input type="checkbox" id="select_all_installments" checked>
                            </th>
                            <th>#</th>
                            <th><?php echo app('translator')->get('installment::lang.due_date'); ?></th>
                            <th><?php echo app('translator')->get('installment::lang.principal'); ?></th>
                            <th><?php echo app('translator')->get('installment::lang.interest'); ?></th>
                            <th><?php echo app('translator')->get('installment::lang.total'); ?></th>
                            <th><?php echo app('translator')->get('installment::lang.status_label'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $selectedTotal = 0; ?>
                        <?php $__currentLoopData = $unpaidInstallments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php 
                                $instTotal = $inst->installment_value + $inst->benefit_value;
                                $selectedTotal += $instTotal;
                                $isOverdue = $inst->installmentdate < now()->format('Y-m-d');
                            ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="installment_ids[]" 
                                           value="<?php echo e($inst->id, false); ?>" 
                                           class="installment_checkbox"
                                           data-amount="<?php echo e($instTotal, false); ?>"
                                           checked>
                                </td>
                                <td><?php echo e($inst->installment_number, false); ?></td>
                                <td>
                                    <?php echo e($inst->installmentdate ? $inst->installmentdate->format('Y-m-d') : $inst->installmentdate, false); ?>

                                    <?php if($isOverdue): ?>
                                        <span class="label label-danger"><?php echo app('translator')->get('installment::lang.overdue'); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e(number_format($inst->installment_value, 2), false); ?></td>
                                <td><?php echo e(number_format($inst->benefit_value, 2), false); ?></td>
                                <td><strong><?php echo e(number_format($instTotal, 2), false); ?></strong></td>
                                <td>
                                    <?php if($isOverdue): ?>
                                        <span class="label label-danger"><?php echo app('translator')->get('installment::lang.late_installment'); ?></span>
                                    <?php else: ?>
                                        <span class="label label-warning"><?php echo app('translator')->get('installment::lang.due_installment'); ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr class="bg-info">
                            <td colspan="5" class="text-right"><strong><?php echo app('translator')->get('installment::lang.selected_total'); ?>:</strong></td>
                            <td colspan="2"><strong id="bulk_total"><?php echo e(number_format($selectedTotal, 2), false); ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
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
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-money-bill-wave"></i> <?php echo app('translator')->get('installment::lang.pay_selected'); ?>
            </button>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>

<script>
$(document).ready(function() {
    function updateBulkTotal() {
        var total = 0;
        $('.installment_checkbox:checked').each(function() {
            total += parseFloat($(this).data('amount'));
        });
        $('#bulk_total').text(total.toFixed(2));
    }

    $('#select_all_installments').on('change', function() {
        $('.installment_checkbox').prop('checked', $(this).is(':checked'));
        updateBulkTotal();
    });

    $('.installment_checkbox').on('change', function() {
        updateBulkTotal();
    });
});

$(document).on('submit', 'form#bulk_payment_form', function(e) {
    e.preventDefault();
    var form = $(this);
    var checked = form.find('.installment_checkbox:checked').length;
    if (checked === 0) {
        toastr.error('<?php echo app('translator')->get("installment::lang.select_installments"); ?>');
        return;
    }
    
    swal({
        title: LANG.sure,
        text: '<?php echo app('translator')->get("installment::lang.confirm_bulk_payment"); ?>',
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
