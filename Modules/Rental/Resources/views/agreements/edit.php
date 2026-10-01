

<?php $__env->startSection('title', __('rental::lang.edit_rental_agreement')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('rental::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">
    <?php echo Form::open(['url' => action([\Modules\Rental\Http\Controllers\RentalAgreementController::class, 'update'], [$agreement->id]), 'method' => 'put', 'id' => 'rental_agreement_form']); ?>


    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('rental::lang.agreement_details') . ' - ' . $agreement->agreement_no]); ?>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('contact_id', __('rental::lang.customer') . ':*'); ?>

                            <?php echo Form::select('contact_id', $customers, $agreement->contact_id, ['class' => 'form-control select2', 'required', 'style' => 'width:100%']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('location_id', __('purchase.business_location') . ':*'); ?>

                            <?php echo Form::select('location_id', $locations, $agreement->location_id, ['class' => 'form-control select2', 'required', 'style' => 'width:100%']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('rental_start_date', __('rental::lang.rental_start_date') . ':*'); ?>

                            <?php echo Form::text('rental_start_date', $agreement->rental_start_date ? $agreement->rental_start_date->format('m/d/Y H:i') : null, ['class' => 'form-control datetimepicker', 'required', 'readonly']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('rental_end_date', __('rental::lang.rental_end_date') . ':*'); ?>

                            <?php echo Form::text('rental_end_date', $agreement->rental_end_date ? $agreement->rental_end_date->format('m/d/Y H:i') : null, ['class' => 'form-control datetimepicker', 'required', 'readonly']); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('rental_period_type', __('rental::lang.rental_period_type') . ':*'); ?>

                            <?php echo Form::select('rental_period_type', ['hourly' => __('rental::lang.hourly'), 'daily' => __('rental::lang.daily'), 'weekly' => __('rental::lang.weekly'), 'monthly' => __('rental::lang.monthly')], $agreement->rental_period_type, ['class' => 'form-control select2', 'required', 'style' => 'width:100%']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('discount_type', __('sale.discount_type') . ':'); ?>

                            <?php echo Form::select('discount_type', ['' => __('lang_v1.none'), 'fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage')], $agreement->discount_type, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('discount_amount', __('sale.discount_amount') . ':'); ?>

                            <?php echo Form::text('discount_amount', number_format($agreement->discount_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('tax_id', __('sale.order_tax') . ':'); ?>

                            <?php echo Form::select('tax_id', $taxes, $agreement->tax_id, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('messages.please_select')]); ?>

                        </div>
                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-success', 'title' => __('rental::lang.rental_items')]); ?>
                <div class="row mb-10">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('search_rental_item', __('rental::lang.search_item') . ':'); ?>

                            <?php echo Form::select('search_rental_item', [], null, ['class' => 'form-control select2', 'id' => 'search_rental_item', 'style' => 'width:100%', 'placeholder' => __('rental::lang.search_item_placeholder')]); ?>

                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-condensed" id="agreement_lines_table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('rental::lang.item'); ?></th>
                                <th style="width:80px;"><?php echo app('translator')->get('rental::lang.quantity'); ?></th>
                                <th><?php echo app('translator')->get('rental::lang.rate_type'); ?></th>
                                <th style="width:120px;"><?php echo app('translator')->get('rental::lang.rate_amount'); ?></th>
                                <th style="width:80px;"><?php echo app('translator')->get('rental::lang.duration'); ?></th>
                                <th style="width:120px;"><?php echo app('translator')->get('rental::lang.deposit'); ?></th>
                                <th style="width:120px;"><?php echo app('translator')->get('rental::lang.line_total'); ?></th>
                                <th style="width:40px;"><i class="fas fa-times"></i></th>
                            </tr>
                        </thead>
                        <tbody id="agreement_lines_body">
                            <?php $__currentLoopData = $agreement->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="agreement_line" data-item-id="<?php echo e($line->rental_item_id, false); ?>">
                                <td><?php echo e($line->item ? $line->item->name : '-', false); ?>

                                    <input type="hidden" name="lines[<?php echo e($index, false); ?>][rental_item_id]" value="<?php echo e($line->rental_item_id, false); ?>">
                                    <input type="hidden" name="lines[<?php echo e($index, false); ?>][id]" value="<?php echo e($line->id, false); ?>">
                                </td>
                                <td><input type="number" name="lines[<?php echo e($index, false); ?>][quantity]" class="form-control input-sm line_quantity" value="<?php echo e($line->quantity, false); ?>" min="1"></td>
                                <td>
                                    <select name="lines[<?php echo e($index, false); ?>][rate_type]" class="form-control input-sm line_rate_type">
                                        <option value="hourly" <?php echo e($line->rate_type == 'hourly' ? 'selected' : '', false); ?>><?php echo app('translator')->get('rental::lang.hourly'); ?></option>
                                        <option value="daily" <?php echo e($line->rate_type == 'daily' ? 'selected' : '', false); ?>><?php echo app('translator')->get('rental::lang.daily'); ?></option>
                                        <option value="weekly" <?php echo e($line->rate_type == 'weekly' ? 'selected' : '', false); ?>><?php echo app('translator')->get('rental::lang.weekly'); ?></option>
                                        <option value="monthly" <?php echo e($line->rate_type == 'monthly' ? 'selected' : '', false); ?>><?php echo app('translator')->get('rental::lang.monthly'); ?></option>
                                    </select>
                                </td>
                                <td><input type="text" name="lines[<?php echo e($index, false); ?>][rate_amount]" class="form-control input-sm input_number line_rate_amount" value="number_format($line->rate_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator'])"></td>
                                <td><input type="number" name="lines[<?php echo e($index, false); ?>][duration]" class="form-control input-sm line_duration" value="<?php echo e($line->duration, false); ?>" min="1"></td>
                                <td><input type="text" name="lines[<?php echo e($index, false); ?>][deposit_amount]" class="form-control input-sm input_number line_deposit" value="number_format($line->deposit_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator'])"></td>
                                <td class="line_total_cell"><span class="display_currency" data-currency_symbol="true"><?php echo e($line->line_total, false); ?></span><input type="hidden" name="lines[<?php echo e($index, false); ?>][line_total]" class="line_total_input" value="<?php echo e($line->line_total, false); ?>"></td>
                                <td><button type="button" class="btn btn-danger btn-xs remove_line"><i class="fas fa-times"></i></button></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-right"><strong><?php echo app('translator')->get('rental::lang.subtotal'); ?>:</strong></td>
                                <td id="total_deposit"><span class="display_currency" data-currency_symbol="true"><?php echo e($agreement->deposit_amount, false); ?></span></td>
                                <td id="total_amount"><span class="display_currency" data-currency_symbol="true"><?php echo e($agreement->subtotal, false); ?></span></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-info', 'title' => __('rental::lang.terms_and_notes')]); ?>
                <div class="form-group">
                    <?php echo Form::label('rental_terms', __('rental::lang.rental_terms') . ':'); ?>

                    <?php echo Form::textarea('rental_terms', $agreement->rental_terms, ['class' => 'form-control', 'rows' => 4]); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('staff_note', __('rental::lang.notes') . ':'); ?>

                    <?php echo Form::textarea('staff_note', $agreement->staff_note, ['class' => 'form-control', 'rows' => 3]); ?>

                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-warning', 'title' => __('rental::lang.summary')]); ?>
                <table class="table no-border">
                    <tr>
                        <th><?php echo app('translator')->get('rental::lang.subtotal'); ?>:</th>
                        <td class="text-right" id="summary_subtotal"><span class="display_currency" data-currency_symbol="true"><?php echo e($agreement->subtotal, false); ?></span></td>
                    </tr>
                    <tr>
                        <th><?php echo app('translator')->get('sale.discount'); ?>:</th>
                        <td class="text-right" id="summary_discount">(-) <span class="display_currency" data-currency_symbol="true"><?php echo e($agreement->discount_amount, false); ?></span></td>
                    </tr>
                    <tr>
                        <th><?php echo app('translator')->get('sale.tax'); ?>:</th>
                        <td class="text-right" id="summary_tax">(+) <span class="display_currency" data-currency_symbol="true"><?php echo e($agreement->tax_amount, false); ?></span></td>
                    </tr>
                    <tr class="bg-light-blue">
                        <th><h4><?php echo app('translator')->get('rental::lang.total_amount'); ?>:</h4></th>
                        <td class="text-right"><h4 id="summary_total"><span class="display_currency" data-currency_symbol="true"><?php echo e($agreement->total_amount, false); ?></span></h4></td>
                    </tr>
                    <tr>
                        <th><?php echo app('translator')->get('rental::lang.total_deposit'); ?>:</th>
                        <td class="text-right" id="summary_deposit"><span class="display_currency" data-currency_symbol="true"><?php echo e($agreement->deposit_amount, false); ?></span></td>
                    </tr>
                </table>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <?php echo Form::close(); ?>


    <div id="rental-agreement-footer-actions-template" class="d-none">
        <?php if(in_array($agreement->status, ['draft'])): ?>
            <button type="submit" name="status" value="draft" class="btn btn-warning" form="rental_agreement_form">
                <i class="fas fa-save"></i> <?php echo app('translator')->get('rental::lang.save_as_draft'); ?>
            </button>
            <button type="submit" name="status" value="confirmed" class="btn btn-primary" form="rental_agreement_form">
                <i class="fas fa-check"></i> <?php echo app('translator')->get('rental::lang.confirm_agreement'); ?>
            </button>
        <?php elseif(in_array($agreement->status, ['confirmed'])): ?>
            <button type="submit" name="status" value="confirmed" class="btn btn-primary" form="rental_agreement_form">
                <i class="fas fa-save"></i> <?php echo app('translator')->get('messages.update'); ?>
            </button>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        var line_index = <?php echo e(count($agreement->lines), false); ?>;

        $('#search_rental_item').select2({
            ajax: {
                url: '<?php echo e(action([\Modules\Rental\Http\Controllers\RentalItemController::class, "index"]), false); ?>',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return { term: params.term, location_id: $('#location_id').val(), for_agreement: true };
                },
                processResults: function(data) {
                    return { results: data };
                }
            },
            minimumInputLength: 1,
            escapeMarkup: function(m) { return m; }
        });

        $('#search_rental_item').on('select2:select', function(e) {
            var item = e.params.data;
            var period_type = $('#rental_period_type').val();
            var rate = item[period_type + '_rate'] || item.daily_rate || 0;

            var row = '<tr class="agreement_line" data-item-id="' + item.id + '">' +
                '<td>' + item.name + '<input type="hidden" name="lines[' + line_index + '][rental_item_id]" value="' + item.id + '"></td>' +
                '<td><input type="number" name="lines[' + line_index + '][quantity]" class="form-control input-sm line_quantity" value="1" min="1" max="' + item.available_quantity + '"></td>' +
                '<td><select name="lines[' + line_index + '][rate_type]" class="form-control input-sm line_rate_type">' +
                    '<option value="hourly"' + (period_type == 'hourly' ? ' selected' : '') + '><?php echo e(__("rental::lang.hourly"), false); ?></option>' +
                    '<option value="daily"' + (period_type == 'daily' ? ' selected' : '') + '><?php echo e(__("rental::lang.daily"), false); ?></option>' +
                    '<option value="weekly"' + (period_type == 'weekly' ? ' selected' : '') + '><?php echo e(__("rental::lang.weekly"), false); ?></option>' +
                    '<option value="monthly"' + (period_type == 'monthly' ? ' selected' : '') + '><?php echo e(__("rental::lang.monthly"), false); ?></option>' +
                '</select></td>' +
                '<td><input type="text" name="lines[' + line_index + '][rate_amount]" class="form-control input-sm input_number line_rate_amount" value="' + rate + '"></td>' +
                '<td><input type="number" name="lines[' + line_index + '][duration]" class="form-control input-sm line_duration" value="1" min="1"></td>' +
                '<td><input type="text" name="lines[' + line_index + '][deposit_amount]" class="form-control input-sm input_number line_deposit" value="' + (item.deposit_amount || 0) + '"></td>' +
                '<td class="line_total_cell"><span class="display_currency" data-currency_symbol="true">0</span><input type="hidden" name="lines[' + line_index + '][line_total]" class="line_total_input" value="0"></td>' +
                '<td><button type="button" class="btn btn-danger btn-xs remove_line"><i class="fas fa-times"></i></button></td>' +
                '</tr>';

            $('#agreement_lines_body').append(row);
            line_index++;
            $(this).val(null).trigger('change');
            calculateTotals();
        });

        $(document).on('click', '.remove_line', function() {
            $(this).closest('tr').remove();
            calculateTotals();
        });

        $(document).on('change', '.line_rate_type', function() {
            var row = $(this).closest('tr');
            var type = $(this).val();
            var rate_input = row.find('.line_rate_amount');
            if (rate_input.data(type)) {
                rate_input.val(rate_input.data(type));
            }
            calculateTotals();
        });

        $(document).on('change keyup', '.line_quantity, .line_rate_amount, .line_duration, .line_deposit, #discount_type, #discount_amount, #tax_id', function() {
            calculateTotals();
        });

        function calculateTotals() {
            var subtotal = 0;
            var total_deposit = 0;

            $('.agreement_line').each(function() {
                var qty = parseFloat($(this).find('.line_quantity').val()) || 0;
                var rate = parseFloat($(this).find('.line_rate_amount').val()) || 0;
                var duration = parseFloat($(this).find('.line_duration').val()) || 0;
                var deposit = parseFloat($(this).find('.line_deposit').val()) || 0;
                var line_total = qty * rate * duration;

                $(this).find('.line_total_cell .display_currency').text(__currency_trans_from_en(line_total, false, true));
                $(this).find('.line_total_input').val(line_total);
                subtotal += line_total;
                total_deposit += deposit * qty;
            });

            var discount_type = $('#discount_type').val();
            var discount_amount = parseFloat($('#discount_amount').val()) || 0;
            var discount = 0;
            if (discount_type == 'fixed') discount = discount_amount;
            else if (discount_type == 'percentage') discount = subtotal * (discount_amount / 100);

            var total = subtotal - discount;

            $('#total_deposit .display_currency').text(__currency_trans_from_en(total_deposit, false, true));
            $('#total_amount .display_currency').text(__currency_trans_from_en(subtotal, false, true));
            $('#summary_subtotal .display_currency').text(__currency_trans_from_en(subtotal, false, true));
            $('#summary_discount .display_currency').text(__currency_trans_from_en(discount, false, true));
            $('#summary_total .display_currency').text(__currency_trans_from_en(total, false, true));
            $('#summary_deposit .display_currency').text(__currency_trans_from_en(total_deposit, false, true));
        }

        if ($.fn.datetimepicker) {
            $('.datetimepicker').datetimepicker({
                format: moment_date_format + ' HH:mm',
                ignoreReadonly: true
            });
        }

        calculateTotals();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>