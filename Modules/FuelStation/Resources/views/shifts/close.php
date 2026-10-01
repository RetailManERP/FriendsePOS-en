
<?php $__env->startSection('title', __('fuelstation::lang.close_shift')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('fuelstation::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header"><h1><?php echo app('translator')->get('fuelstation::lang.close_shift'); ?> — <?php echo e($shift->shift_no, false); ?></h1></section>

<section class="content">
    <?php echo Form::open(['url' => action([\Modules\FuelStation\Http\Controllers\FuelShiftController::class, 'close'], [$shift->id]), 'method' => 'PUT', 'id' => 'close_shift_form']); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-warning', 'title' => __('fuelstation::lang.closing_readings')]); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="closing_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('fuelstation::lang.nozzle'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.opening_reading'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.closing_reading'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.test_quantity'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.rate_per_liter'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.liters_sold'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.amount'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $shift->readings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reading): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="reading-row">
                        <td><?php echo e(optional($reading->nozzle)->name ?? '-', false); ?></td>
                        <td class="opening" data-val="<?php echo e($reading->opening_reading, false); ?>"><?php echo e(number_format($reading->opening_reading, 2), false); ?></td>
                        <td><input type="number" step="any" class="form-control input-sm closing-reading" name="readings[<?php echo e($reading->id, false); ?>][closing_reading]" value="<?php echo e($reading->opening_reading, false); ?>"></td>
                        <td><input type="number" step="any" class="form-control input-sm test-qty" name="readings[<?php echo e($reading->id, false); ?>][test_quantity]" value="0"></td>
                        <td><input type="number" step="any" class="form-control input-sm rate" name="readings[<?php echo e($reading->id, false); ?>][rate_per_liter]" value="<?php echo e($reading->rate_per_liter, false); ?>"></td>
                        <td class="liters-sold">0</td>
                        <td class="line-amount">0</td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" class="text-right"><?php echo app('translator')->get('fuelstation::lang.total'); ?></th>
                        <th id="total_liters">0</th>
                        <th id="total_amount">0</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('fuelstation::lang.collection')]); ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('cash_received', __('fuelstation::lang.cash_received') . ':'); ?>

                    <?php echo Form::number('cash_received', 0, ['class' => 'form-control payment-input', 'step' => 'any', 'id' => 'cash_received']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('card_amount', __('fuelstation::lang.card_amount') . ':'); ?>

                    <?php echo Form::number('card_amount', 0, ['class' => 'form-control payment-input', 'step' => 'any', 'id' => 'card_amount']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('bank_amount', __('fuelstation::lang.bank_amount') . ':'); ?>

                    <?php echo Form::number('bank_amount', 0, ['class' => 'form-control payment-input', 'step' => 'any', 'id' => 'bank_amount']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('credit_amount', __('fuelstation::lang.credit_amount') . ':'); ?>

                    <?php echo Form::number('credit_amount', 0, ['class' => 'form-control payment-input', 'step' => 'any', 'id' => 'credit_amount']); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('end_time', __('fuelstation::lang.end_time') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        <?php echo Form::text('end_time', \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control shift-datetimepicker', 'id' => 'end_time', 'readonly']); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label><?php echo app('translator')->get('fuelstation::lang.expected_cash'); ?>:</label>
                    <p class="form-control-static"><strong id="expected_cash_lbl">0.00</strong></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label><?php echo app('translator')->get('fuelstation::lang.short_excess'); ?>:</label>
                    <p class="form-control-static"><strong id="short_excess_lbl">0.00</strong></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo Form::label('notes', __('fuelstation::lang.notes') . ':'); ?>

                    <?php echo Form::textarea('notes', $shift->notes, ['class' => 'form-control', 'rows' => 2]); ?>

                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>
    <?php echo Form::close(); ?>


    <div id="close-shift-footer-actions-template" class="d-none">
        <button type="submit" class="btn btn-warning" form="close_shift_form"><i class="fas fa-check"></i> <?php echo app('translator')->get('fuelstation::lang.close_shift'); ?></button>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(function () {
    if ($.fn.datetimepicker) {
        $('.shift-datetimepicker').datetimepicker({
            format: moment_date_format + ' ' + moment_time_format,
            ignoreReadonly: true,
        });
    }

    function toNumber(value) {
        value = value === undefined || value === null ? '' : value.toString().replace(/,/g, '');
        return parseFloat(value) || 0;
    }

    function recalc() {
        var totalLiters = 0, totalAmount = 0;
        $('.reading-row').each(function () {
            var row = $(this);
            var opening = toNumber(row.find('.opening').data('val'));
            var closing = toNumber(row.find('.closing-reading').val());
            var test = toNumber(row.find('.test-qty').val());
            var rate = toNumber(row.find('.rate').val());
            if (closing < opening) { closing = opening; }
            var meterDiff = Math.max(0, closing - opening);
            var testInput = row.find('.test-qty');
            if (test > meterDiff) {
                testInput.addClass('is-invalid').attr('title', <?php echo json_encode(__('fuelstation::lang.test_exceeds_meter_difference'), 15, 512) ?>);
            } else {
                testInput.removeClass('is-invalid').removeAttr('title');
            }
            var sold = Math.max(0, meterDiff - test);
            var amount = sold * rate;
            row.find('.liters-sold').text(sold.toFixed(2));
            row.find('.line-amount').text(amount.toFixed(2));
            totalLiters += sold;
            totalAmount += amount;
        });
        $('#total_liters').text(totalLiters.toFixed(2));
        $('#total_amount').text(totalAmount.toFixed(2));

        var card = parseFloat($('#card_amount').val()) || 0;
        var bank = parseFloat($('#bank_amount').val()) || 0;
        var credit = parseFloat($('#credit_amount').val()) || 0;
        var cash = parseFloat($('#cash_received').val()) || 0;
        var expected = totalAmount - card - bank - credit;
        var shortExcess = cash - expected;
        $('#expected_cash_lbl').text(expected.toFixed(2));
        $('#short_excess_lbl').text(shortExcess.toFixed(2))
            .css('color', shortExcess < 0 ? 'red' : 'green');
    }
    $(document).on('keyup input change', '.closing-reading, .test-qty, .rate, .payment-input', recalc);
    recalc();
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>