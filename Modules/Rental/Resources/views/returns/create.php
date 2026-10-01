

<?php $__env->startSection('title', __('rental::lang.process_return')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('rental::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">
    <?php echo Form::open(['url' => action([\Modules\Rental\Http\Controllers\RentalReturnController::class, 'store']), 'method' => 'post', 'id' => 'rental_return_form']); ?>


    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('rental::lang.process_return') . ' - ' . $agreement->agreement_no]); ?>
                <div class="row">
                    <div class="col-md-4">
                        <table class="table table-condensed no-border">
                            <tr><th><?php echo app('translator')->get('rental::lang.agreement_no'); ?>:</th><td><?php echo e($agreement->agreement_no, false); ?></td></tr>
                            <tr><th><?php echo app('translator')->get('rental::lang.customer'); ?>:</th><td><?php echo e($agreement->contact ? $agreement->contact->name : '-', false); ?></td></tr>
                            <tr><th><?php echo app('translator')->get('rental::lang.status'); ?>:</th><td><span class="label label-<?php echo e($agreement->status == 'overdue' ? 'danger' : 'primary', false); ?>"><?php echo e(__('rental::lang.status_' . $agreement->status), false); ?></span></td></tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table class="table table-condensed no-border">
                            <tr><th><?php echo app('translator')->get('rental::lang.rental_start_date'); ?>:</th><td><?php echo e($agreement->rental_start_date ? $agreement->rental_start_date->format('M d, Y H:i') : '-', false); ?></td></tr>
                            <tr><th><?php echo app('translator')->get('rental::lang.rental_end_date'); ?>:</th><td><?php echo e($agreement->rental_end_date ? $agreement->rental_end_date->format('M d, Y H:i') : '-', false); ?></td></tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table class="table table-condensed no-border">
                            <tr><th><?php echo app('translator')->get('rental::lang.total_amount'); ?>:</th><td><span class="display_currency" data-currency_symbol="true"><?php echo e($agreement->total_amount, false); ?></span></td></tr>
                            <tr><th><?php echo app('translator')->get('rental::lang.balance_due'); ?>:</th><td class="text-danger"><span class="display_currency" data-currency_symbol="true"><?php echo e($agreement->balance_due, false); ?></span></td></tr>
                        </table>
                    </div>
                </div>
                <input type="hidden" name="rental_agreement_id" value="<?php echo e($agreement->id, false); ?>">
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-success', 'title' => __('rental::lang.items_to_return')]); ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width:30px;"><input type="checkbox" id="select_all_returns" checked></th>
                            <th><?php echo app('translator')->get('rental::lang.item'); ?></th>
                            <th><?php echo app('translator')->get('rental::lang.rented_qty'); ?></th>
                            <th><?php echo app('translator')->get('rental::lang.already_returned'); ?></th>
                            <th style="width:100px;"><?php echo app('translator')->get('rental::lang.qty_to_return'); ?></th>
                            <th><?php echo app('translator')->get('rental::lang.condition_on_return'); ?></th>
                            <th><?php echo app('translator')->get('rental::lang.inspection_notes'); ?></th>
                            <th style="width:120px;"><?php echo app('translator')->get('rental::lang.late_fee'); ?></th>
                            <th style="width:120px;"><?php echo app('translator')->get('rental::lang.damage_fee'); ?></th>
                            <th style="width:120px;"><?php echo app('translator')->get('rental::lang.deposit_refund'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $returnable_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $remaining = $line->quantity - ($line->returned_quantity ?? 0);
                            $is_overdue = $agreement->rental_end_date && $agreement->rental_end_date->isPast();
                            $late_fee = $is_overdue && $line->item ? $line->item->late_fee_per_day * now()->diffInDays($agreement->rental_end_date) : 0;
                        ?>
                        <?php if($remaining > 0): ?>
                        <tr class="return_line">
                            <td><input type="checkbox" class="return_checkbox" name="returns[<?php echo e($index, false); ?>][selected]" value="1" checked></td>
                            <td>
                                <?php echo e($line->item ? $line->item->name : '-', false); ?>

                                <input type="hidden" name="returns[<?php echo e($index, false); ?>][rental_agreement_line_id]" value="<?php echo e($line->id, false); ?>">
                                <input type="hidden" name="returns[<?php echo e($index, false); ?>][rental_item_id]" value="<?php echo e($line->rental_item_id, false); ?>">
                            </td>
                            <td><?php echo e($line->quantity, false); ?></td>
                            <td><?php echo e($line->returned_quantity ?? 0, false); ?></td>
                            <td>
                                <input type="number" name="returns[<?php echo e($index, false); ?>][quantity_returned]" class="form-control input-sm" value="<?php echo e($remaining, false); ?>" min="0" max="<?php echo e($remaining, false); ?>">
                            </td>
                            <td>
                                <?php echo Form::select('returns[' . $index . '][condition_on_return]', [
                                    'good' => __('rental::lang.condition_good'),
                                    'fair' => __('rental::lang.condition_fair'),
                                    'poor' => __('rental::lang.condition_poor'),
                                    'damaged' => __('rental::lang.condition_damaged'),
                                ], 'good', ['class' => 'form-control input-sm condition_select']); ?>

                            </td>
                            <td>
                                <input type="text" name="returns[<?php echo e($index, false); ?>][inspection_notes]" class="form-control input-sm" placeholder="<?php echo app('translator')->get('rental::lang.inspection_notes'); ?>">
                            </td>
                            <td>
                                <input type="text" name="returns[<?php echo e($index, false); ?>][late_fee]" class="form-control input-sm input_number line_late_fee" value="number_format($late_fee, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator'])">
                            </td>
                            <td>
                                <input type="text" name="returns[<?php echo e($index, false); ?>][damage_fee]" class="form-control input-sm input_number line_damage_fee" value="0">
                            </td>
                            <td>
                                <input type="text" name="returns[<?php echo e($index, false); ?>][deposit_refund]" class="form-control input-sm input_number line_deposit_refund" value="number_format($line->deposit_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator'])">
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7" class="text-right"><strong><?php echo app('translator')->get('rental::lang.totals'); ?>:</strong></td>
                            <td id="total_late_fees"><strong><span class="display_currency" data-currency_symbol="true">0</span></strong></td>
                            <td id="total_damage_fees"><strong><span class="display_currency" data-currency_symbol="true">0</span></strong></td>
                            <td id="total_deposit_refunds"><strong><span class="display_currency" data-currency_symbol="true">0</span></strong></td>
                        </tr>
                    </tfoot>
                </table>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-info', 'title' => __('rental::lang.additional_notes')]); ?>
                <div class="form-group">
                    <?php echo Form::label('additional_charges', __('rental::lang.additional_charges') . ':'); ?>

                    <?php echo Form::text('additional_charges', 0, ['class' => 'form-control input_number']); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('additional_charge_note', __('rental::lang.note') . ':'); ?>

                    <?php echo Form::textarea('additional_charge_note', null, ['class' => 'form-control', 'rows' => 3]); ?>

                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-warning', 'title' => __('rental::lang.return_summary')]); ?>
                <table class="table no-border" id="return_summary_table">
                    <tr><th><?php echo app('translator')->get('rental::lang.total_late_fees'); ?>:</th><td class="text-right" id="summary_late_fees"><span class="display_currency" data-currency_symbol="true">0</span></td></tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.total_damage_fees'); ?>:</th><td class="text-right" id="summary_damage_fees"><span class="display_currency" data-currency_symbol="true">0</span></td></tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.additional_charges'); ?>:</th><td class="text-right" id="summary_additional"><span class="display_currency" data-currency_symbol="true">0</span></td></tr>
                    <tr class="bg-light-blue"><th><h4><?php echo app('translator')->get('rental::lang.total_charges'); ?>:</h4></th><td class="text-right"><h4 id="summary_total_charges"><span class="display_currency" data-currency_symbol="true">0</span></h4></td></tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.total_deposit_refund'); ?>:</th><td class="text-right text-success" id="summary_refund"><span class="display_currency" data-currency_symbol="true">0</span></td></tr>
                </table>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-undo"></i> <?php echo app('translator')->get('rental::lang.process_return'); ?>
            </button>
        </div>
    </div>

    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        $('#select_all_returns').change(function() {
            $('.return_checkbox').prop('checked', $(this).prop('checked'));
        });

        function calculateReturnTotals() {
            var total_late = 0, total_damage = 0, total_refund = 0;

            $('.return_line').each(function() {
                if ($(this).find('.return_checkbox').prop('checked')) {
                    total_late += parseFloat($(this).find('.line_late_fee').val()) || 0;
                    total_damage += parseFloat($(this).find('.line_damage_fee').val()) || 0;
                    total_refund += parseFloat($(this).find('.line_deposit_refund').val()) || 0;
                }
            });

            var additional = parseFloat($('#additional_charges').val()) || 0;
            var total_charges = total_late + total_damage + additional;

            $('#total_late_fees .display_currency').text(__currency_trans_from_en(total_late, false, true));
            $('#total_damage_fees .display_currency').text(__currency_trans_from_en(total_damage, false, true));
            $('#total_deposit_refunds .display_currency').text(__currency_trans_from_en(total_refund, false, true));
            $('#summary_late_fees .display_currency').text(__currency_trans_from_en(total_late, false, true));
            $('#summary_damage_fees .display_currency').text(__currency_trans_from_en(total_damage, false, true));
            $('#summary_additional .display_currency').text(__currency_trans_from_en(additional, false, true));
            $('#summary_total_charges .display_currency').text(__currency_trans_from_en(total_charges, false, true));
            $('#summary_refund .display_currency').text(__currency_trans_from_en(total_refund, false, true));
        }

        $(document).on('change keyup', '.line_late_fee, .line_damage_fee, .line_deposit_refund, #additional_charges, .return_checkbox', function() {
            calculateReturnTotals();
        });

        calculateReturnTotals();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>