<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\Modules\ImportManagement\Http\Controllers\ImportController::class, 'receiveStock'], [$import->id]), 'method' => 'post', 'id' => 'receive_stock_form']); ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">
                <i class="fa fa-box-open"></i> <?php echo app('translator')->get('importmanagement::lang.receive_stock'); ?> - <?php echo e($import->import_ref_no, false); ?>

            </h4>
        </div>
        <div class="modal-body">
            <div class="alert alert-info">
                <i class="fa fa-info-circle"></i>
                <?php echo app('translator')->get('importmanagement::lang.receive_stock_help'); ?>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <p><strong><?php echo app('translator')->get('importmanagement::lang.supplier_importer'); ?>:</strong> <?php echo e($import->contact->name ?? '', false); ?></p>
                </div>
                <div class="col-md-4">
                    <p><strong><?php echo app('translator')->get('importmanagement::lang.business_location'); ?>:</strong> <?php echo e($import->location->name ?? '', false); ?></p>
                </div>
                <div class="col-md-4">
                    <p><strong><?php echo app('translator')->get('importmanagement::lang.import_status'); ?>:</strong>
                        <span class="label <?php echo e($import->getStatusClasses()[$import->status] ?? 'label-default', false); ?>">
                            <?php echo e(__('importmanagement::lang.' . $import->status), false); ?>

                        </span>
                    </p>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr class="bg-light-blue-active">
                            <th><?php echo app('translator')->get('importmanagement::lang.product'); ?></th>
                            <th class="text-center" style="width: 12%;"><?php echo app('translator')->get('importmanagement::lang.ordered_qty'); ?></th>
                            <th class="text-center" style="width: 12%;"><?php echo app('translator')->get('importmanagement::lang.already_received'); ?></th>
                            <th class="text-center" style="width: 12%;"><?php echo app('translator')->get('importmanagement::lang.remaining_qty'); ?></th>
                            <th class="text-center" style="width: 15%;"><?php echo app('translator')->get('importmanagement::lang.receive_now'); ?></th>
                            <th class="text-center" style="width: 15%;"><?php echo app('translator')->get('importmanagement::lang.landed_cost_per_unit'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $has_pending = false; ?>
                        <?php $__currentLoopData = $import->importLines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $remaining = $line->quantity - $line->quantity_received;
                            ?>
                            <?php if($remaining > 0): ?>
                                <?php $has_pending = true; ?>
                                <tr>
                                    <td>
                                        <?php echo e($line->product->name ?? 'N/A', false); ?>

                                        <?php if($line->variation && $line->variation->name != 'DUMMY'): ?>
                                            - <?php echo e($line->variation->name, false); ?>

                                        <?php endif; ?>
                                        <input type="hidden" name="lines[<?php echo e($line->id, false); ?>][import_line_id]" value="<?php echo e($line->id, false); ?>">
                                    </td>
                                    <td class="text-center"><?php echo e(number_format($line->quantity, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                                    <td class="text-center"><?php echo e(number_format($line->quantity_received, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                                    <td class="text-center">
                                        <span class="label label-warning"><?php echo e(number_format($remaining, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
                                    </td>
                                    <td>
                                        <input type="number" name="lines[<?php echo e($line->id, false); ?>][quantity]" class="form-control input-sm text-center receive_qty_input" value="<?php echo e($remaining, false); ?>" min="0" max="<?php echo e($remaining, false); ?>" step="any">
                                    </td>
                                    <td class="text-center">
                                        <span class="display_currency" data-currency_symbol="true"><?php echo e($line->landed_cost_per_unit, false); ?></span>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!$has_pending): ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    <i class="fa fa-check-circle text-success"></i> <?php echo app('translator')->get('importmanagement::lang.all_items_received'); ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if($has_pending): ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('receive_date', __('importmanagement::lang.receive_date') . ':'); ?>

                            <?php echo Form::text('receive_date', date('Y-m-d'), ['class' => 'form-control', 'id' => 'receive_date', 'readonly', 'required']); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('receive_note', __('importmanagement::lang.receive_note') . ':'); ?>

                            <?php echo Form::text('receive_note', null, ['class' => 'form-control']); ?>

                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
            <?php if($has_pending): ?>
                <button type="submit" class="btn btn-primary" id="receive_stock_btn">
                    <i class="fa fa-box-open"></i> <?php echo app('translator')->get('importmanagement::lang.receive_stock'); ?>
                </button>
            <?php endif; ?>
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>

<script>
$(document).ready(function() {
    if ($('#receive_date').length) {
        $('#receive_date').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
    }

    $('#receive_stock_form').on('submit', function(e) {
        e.preventDefault();
        var btn = $('#receive_stock_btn');
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(result) {
                if (result.success) {
                    toastr.success(result.msg);
                    $('div.import_receive_modal').modal('hide');
                    if (typeof imports_table !== 'undefined') {
                        imports_table.ajax.reload();
                    } else {
                        location.reload();
                    }
                } else {
                    toastr.error(result.msg);
                    btn.prop('disabled', false).html('<i class="fa fa-box-open"></i> ' + LANG.receive_stock);
                }
            },
            error: function(xhr) {
                var msg = xhr.responseJSON ? xhr.responseJSON.msg : 'An error occurred';
                toastr.error(msg);
                btn.prop('disabled', false).html('<i class="fa fa-box-open"></i> Receive Stock');
            }
        });
    });
});
</script>
