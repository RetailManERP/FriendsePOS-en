

<?php $__env->startSection('title', __('rental::lang.add_rental_agreement')); ?>

<?php $__env->startSection('css'); ?>
<style>
    .rental-customer-input-group .select2-container {
        flex: 1 1 auto;
        min-width: 0;
        width: 1% !important;
    }
    .rental-customer-input-group .select2-selection--single {
        height: 34px;
        border-radius: 0;
    }
    .rental-customer-input-group .select2-selection__rendered {
        line-height: 32px;
    }
    .rental-customer-input-group .select2-selection__arrow {
        height: 32px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('rental::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">
    <?php echo Form::open(['url' => action([\Modules\Rental\Http\Controllers\RentalAgreementController::class, 'store']), 'method' => 'post', 'id' => 'rental_agreement_form']); ?>


    <div class="row">
        
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('rental::lang.agreement_details')]); ?>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('contact_id', __('rental::lang.customer') . ':*'); ?>

                            <div class="input-group rental-customer-input-group">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <?php echo Form::select('contact_id', [], null, [
                                    'class' => 'form-control',
                                    'id' => 'rental_customer_id',
                                    'required',
                                    'style' => 'width:100%',
                                    'placeholder' => 'Enter Customer name / phone',
                                ]); ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customer.create')): ?>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default bg-white btn-sm btn-flat" id="rental_add_customer" title="<?php echo e(__('messages.add'), false); ?>">
                                            <i class="fa fa-plus-circle text-primary fa-lg"></i>
                                        </button>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('location_id', __('purchase.business_location') . ':*'); ?>

                            <?php echo Form::select('location_id', $business_locations, $default_location_id, ['class' => 'form-control select2', 'required', 'style' => 'width:100%', 'placeholder' => __('messages.please_select')]); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('rental_start', __('rental::lang.rental_start_date') . ':*'); ?>

                            <?php echo Form::text('rental_start', null, ['class' => 'form-control datetimepicker', 'required', 'readonly']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('rental_end_expected', __('rental::lang.rental_end_date') . ':*'); ?>

                            <?php echo Form::text('rental_end_expected', null, ['class' => 'form-control datetimepicker', 'required', 'readonly']); ?>

                        </div>
                        <p class="rental_days_count text-success" style="margin-top:-15px; margin-bottom:10px;"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('rental_period_type', __('rental::lang.rental_period_type') . ':*'); ?>

                            <?php echo Form::select('rental_period_type', ['hourly' => __('rental::lang.hourly'), 'daily' => __('rental::lang.daily'), 'weekly' => __('rental::lang.weekly'), 'monthly' => __('rental::lang.monthly')], $settings['default_rental_period'] ?? 'daily', ['class' => 'form-control select2', 'required', 'style' => 'width:100%']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('discount_type', __('sale.discount_type') . ':'); ?>

                            <?php echo Form::select('discount_type', ['' => __('lang_v1.none'), 'fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage')], null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('discount_amount', __('sale.discount_amount') . ':'); ?>

                            <?php echo Form::text('discount_amount', 0, ['class' => 'form-control input_number']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('tax_id', __('sale.order_tax') . ':'); ?>

                            <?php echo Form::select('tax_id', $taxes, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('messages.please_select')]); ?>

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
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-right"><strong><?php echo app('translator')->get('rental::lang.subtotal'); ?>:</strong></td>
                                <td id="total_deposit"><span class="display_currency" data-currency_symbol="true">0</span></td>
                                <td id="total_amount"><span class="display_currency" data-currency_symbol="true">0</span></td>
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

                    <?php echo Form::textarea('rental_terms', $default_terms ?? '', ['class' => 'form-control', 'rows' => 4]); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('staff_note', __('rental::lang.notes') . ':'); ?>

                    <?php echo Form::textarea('staff_note', null, ['class' => 'form-control', 'rows' => 3]); ?>

                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-warning', 'title' => __('rental::lang.summary')]); ?>
                <table class="table no-border">
                    <tr>
                        <th><?php echo app('translator')->get('rental::lang.subtotal'); ?>:</th>
                        <td class="text-right" id="summary_subtotal"><span class="display_currency" data-currency_symbol="true">0</span></td>
                    </tr>
                    <tr>
                        <th><?php echo app('translator')->get('sale.discount'); ?>:</th>
                        <td class="text-right" id="summary_discount">(-) <span class="display_currency" data-currency_symbol="true">0</span></td>
                    </tr>
                    <tr>
                        <th><?php echo app('translator')->get('sale.tax'); ?>:</th>
                        <td class="text-right" id="summary_tax">(+) <span class="display_currency" data-currency_symbol="true">0</span></td>
                    </tr>
                    <tr class="bg-light-blue">
                        <th><h4><?php echo app('translator')->get('rental::lang.total_amount'); ?>:</h4></th>
                        <td class="text-right"><h4 id="summary_total"><span class="display_currency" data-currency_symbol="true">0</span></h4></td>
                    </tr>
                    <tr>
                        <th><?php echo app('translator')->get('rental::lang.total_deposit'); ?>:</th>
                        <td class="text-right" id="summary_deposit"><span class="display_currency" data-currency_symbol="true">0</span></td>
                    </tr>
                </table>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <?php echo Form::close(); ?>


    <div id="rental-agreement-footer-actions-template" class="d-none">
        <button type="submit" name="status" value="draft" class="btn btn-warning" form="rental_agreement_form">
            <i class="fas fa-save"></i> <?php echo app('translator')->get('rental::lang.save_as_draft'); ?>
        </button>
        <button type="submit" name="status" value="confirmed" class="btn btn-primary" form="rental_agreement_form">
            <i class="fas fa-check"></i> <?php echo app('translator')->get('rental::lang.confirm_agreement'); ?>
        </button>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modals'); ?>
    <div class="modal fade rental_customer_modal" tabindex="-1" role="dialog" aria-labelledby="rentalCustomerModalTitle"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php
    $rental_customer_create_url = action(
        [\App\Http\Controllers\ContactController::class, 'create'],
        ['type' => 'customer', 'quick_add' => 1]
    );
?>
<script>
    window.rentalTaxRates = <?php echo json_encode($tax_rates, 15, 512) ?>;

    $(document).ready(function() {
        var line_index = 0;
        var rentalCustomerCreateUrl = <?php echo json_encode($rental_customer_create_url, 15, 512) ?>;

        var discountTypeSelect = $('#discount_type');
        if (discountTypeSelect.hasClass('select2-hidden-accessible')) {
            discountTypeSelect.select2('destroy');
        }
        discountTypeSelect.select2({
            width: '100%',
            closeOnSelect: true
        }).on('select2:select', function() {
            var select = $(this);
            setTimeout(function() {
                select.select2('close');
            }, 0);
        });

        $('#rental_add_customer').on('click', function() {
            var modal = $('.rental_customer_modal');
            modal.load(rentalCustomerCreateUrl, function(response, status) {
                if (status !== 'success') {
                    toastr.error('<?php echo e(__('messages.something_went_wrong'), false); ?>');
                    return;
                }
                modal.find('.select2').select2({
                    dropdownParent: modal,
                    width: '100%'
                });
                updateRentalContactNameFields(modal);
                modal.modal('show');
            });
        });

        $(document).on('change', '.rental_customer_modal input[name="contact_type_radio"]', function() {
            updateRentalContactNameFields($('.rental_customer_modal'));
        });

        function updateRentalContactNameFields(modal) {
            var isBusiness = modal.find('input[name="contact_type_radio"]:checked').val() === 'business';
            modal.find('.business').toggle(isBusiness);
            modal.find('.individual').toggle(!isBusiness);
            modal.find('#first_name').prop('required', !isBusiness);
            modal.find('#supplier_business_name').prop('required', isBusiness);
        }

        $(document).on('submit', '.rental_customer_modal form#quick_add_contact', function(e) {
            e.preventDefault();
            var form = $(this);
            var submitButton = form.find('#contact_form_submit');
            if (form[0] && !form[0].checkValidity()) {
                form[0].reportValidity();
                return;
            }

            submitButton.prop('disabled', true);
            $.ajax({
                method: 'POST',
                url: form.attr('action'),
                data: form.serialize(),
                dataType: 'json',
                success: function(result) {
                    if (!result.success || !result.data) {
                        toastr.error(result.msg || '<?php echo e(__('messages.something_went_wrong'), false); ?>');
                        submitButton.prop('disabled', false);
                        return;
                    }

                    var contact = result.data;
                    var label = contact.name || contact.supplier_business_name || '';
                    if (contact.contact_id) {
                        label += ' (' + contact.contact_id + ')';
                    }
                    var option = new Option(label, contact.id, true, true);
                    $('#rental_customer_id').append(option).trigger('change');
                    $('.rental_customer_modal').modal('hide');
                    toastr.success(result.msg);
                },
                error: function(xhr) {
                    var message = xhr.responseJSON && xhr.responseJSON.message
                        ? xhr.responseJSON.message
                        : '<?php echo e(__('messages.something_went_wrong'), false); ?>';
                    toastr.error(message);
                    submitButton.prop('disabled', false);
                }
            });
        });

        // Search rental items via AJAX
        $('#rental_customer_id').select2({
            ajax: {
                url: '<?php echo e(action([\App\Http\Controllers\ContactController::class, "getCustomers"]), false); ?>',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term,
                        location_id: $('#location_id').val()
                    };
                },
                processResults: function(data) {
                    return { results: data };
                }
            },
            templateResult: function(data) {
                if (!data.id) return data.text;
                var details = data.text || '';
                if (data.mobile) {
                    details += '<br><?php echo e(__('contact.mobile'), false); ?>: ' + data.mobile;
                }
                return details;
            },
            minimumInputLength: 1,
            escapeMarkup: function(markup) { return markup; },
            placeholder: 'Enter Customer name / phone'
        });

        // Search rental items via AJAX
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

        // Add item to lines table
        $('#search_rental_item').on('select2:select', function(e) {
            var item = e.params.data;
            var period_type = $('#rental_period_type').val();
            var rate_field = period_type + '_rate';
            var rate = item[rate_field] || item.daily_rate || 0;

            var row = '<tr class="agreement_line" data-item-id="' + item.id + '">' +
                '<td>' + item.name + '<input type="hidden" name="rental_lines[' + line_index + '][rental_item_id]" value="' + item.id + '"></td>' +
                '<td><input type="number" name="rental_lines[' + line_index + '][quantity]" class="form-control input-sm line_quantity" value="1" min="1" max="' + item.available_quantity + '"></td>' +
                '<td><select name="rental_lines[' + line_index + '][rate_type]" class="form-control input-sm line_rate_type">' +
                    '<option value="hourly"' + (period_type == 'hourly' ? ' selected' : '') + '><?php echo e(__("rental::lang.hourly"), false); ?></option>' +
                    '<option value="daily"' + (period_type == 'daily' ? ' selected' : '') + '><?php echo e(__("rental::lang.daily"), false); ?></option>' +
                    '<option value="weekly"' + (period_type == 'weekly' ? ' selected' : '') + '><?php echo e(__("rental::lang.weekly"), false); ?></option>' +
                    '<option value="monthly"' + (period_type == 'monthly' ? ' selected' : '') + '><?php echo e(__("rental::lang.monthly"), false); ?></option>' +
                '</select></td>' +
                '<td><input type="text" name="rental_lines[' + line_index + '][unit_rate]" class="form-control input-sm input_number line_rate_amount" value="' + rate + '"' +
                    ' data-hourly="' + (item.hourly_rate || 0) + '"' +
                    ' data-daily="' + (item.daily_rate || 0) + '"' +
                    ' data-weekly="' + (item.weekly_rate || 0) + '"' +
                    ' data-monthly="' + (item.monthly_rate || 0) + '"></td>' +
                '<td><input type="number" name="rental_lines[' + line_index + '][duration]" class="form-control input-sm line_duration" value="1" min="1"></td>' +
                '<td><input type="text" name="rental_lines[' + line_index + '][deposit_per_unit]" class="form-control input-sm input_number line_deposit" value="' + (item.deposit_amount || 0) + '"></td>' +
                '<td class="line_total_cell"><span class="display_currency" data-currency_symbol="true">0</span><input type="hidden" name="rental_lines[' + line_index + '][line_total]" class="line_total_input" value="0"></td>' +
                '<td><button type="button" class="btn btn-danger btn-xs remove_line"><i class="fas fa-times"></i></button></td>' +
                '</tr>';

            $('#agreement_lines_body').append(row);
            line_index++;
            $(this).val(null).trigger('change');
            updateLineDurations();
            calculateTotals();
        });

        // Remove line
        $(document).on('click', '.remove_line', function() {
            $(this).closest('tr').remove();
            calculateTotals();
        });

        // Rate type change updates rate amount
        $(document).on('change', '.line_rate_type', function() {
            var row = $(this).closest('tr');
            var type = $(this).val();
            var rate_input = row.find('.line_rate_amount');
            rate_input.val(rate_input.data(type) || 0);
            updateLineDurations();
            calculateTotals();
        });

        // Keep each product's duration in sync with the agreement date range.
        $(document).on('change dp.change', '#rental_start, #rental_end_expected', function() {
            updateRentalDaysCount();
            updateLineDurations();
            calculateTotals();
        });

        // Changing the agreement period updates each line's rate type and duration.
        $(document).on('change', '#rental_period_type', function() {
            var periodType = $(this).val();
            $('.agreement_line').each(function() {
                var row = $(this);
                row.find('.line_rate_type').val(periodType);
                var rateInput = row.find('.line_rate_amount');
                rateInput.val(rateInput.data(periodType) || 0);
            });
            updateLineDurations();
            calculateTotals();
        });

        // Recalculate on input change
        $(document).on('change keyup', '.line_quantity, .line_rate_amount, .line_duration, .line_deposit, #discount_type, #discount_amount, #tax_id', function() {
            calculateTotals();
        });

        function updateLineDurations() {
            var start = parseRentalDateTime('#rental_start');
            var end = parseRentalDateTime('#rental_end_expected');
            if (!start.isValid() || !end.isValid() || !end.isAfter(start)) {
                return;
            }

            $('.agreement_line').each(function() {
                var row = $(this);
                var type = row.find('.line_rate_type').val() || $('#rental_period_type').val();
                var duration;
                var elapsed;

                if (type === 'hourly') {
                    elapsed = end.diff(start, 'hours', true);
                    duration = Math.ceil(elapsed);
                } else if (type === 'weekly') {
                    elapsed = end.diff(start, 'days', true) / 7;
                    duration = Math.ceil(elapsed);
                } else if (type === 'monthly') {
                    elapsed = end.diff(start, 'months', true);
                    duration = Math.ceil(elapsed);
                } else {
                    elapsed = end.diff(start, 'days', true);
                    duration = Math.ceil(elapsed);
                }

                row.find('.line_duration').val(Math.max(1, duration));
            });
        }

        function updateRentalDaysCount() {
            var start = parseRentalDateTime('#rental_start');
            var end = parseRentalDateTime('#rental_end_expected');
            var days = 0;

            if (start.isValid() && end.isValid() && end.isAfter(start)) {
                // Rental days are counted inclusively, like the HMS booking form.
                days = Math.max(1, end.clone().startOf('day').diff(start.clone().startOf('day'), 'days'));
            }

            $('.rental_days_count').text(days ? days + ' Days' : '');
            return days;
        }

        function parseRentalDateTime(selector) {
            var input = $(selector);
            var picker = input.data('DateTimePicker');
            if (picker && picker.date && picker.date()) {
                return picker.date().clone();
            }

            var value = input.val();
            var formats = [
                moment_date_format + ' HH:mm',
                moment_date_format + ' hh:mm A',
                moment_date_format + ' HH:mm A',
                moment_date_format + ' hh:mm a',
                moment_date_format
            ];
            var parsed = moment(value, formats, true);
            return parsed.isValid() ? parsed : moment(value);
        }

        function calculateTotals() {
            var subtotal = 0;
            var total_deposit = 0;

            $('.agreement_line').each(function() {
                var qty = Number($(this).find('.line_quantity').val()) || 0;
                var rate = parseRentalNumber($(this).find('.line_rate_amount').val());
                var duration = Number($(this).find('.line_duration').val()) || 0;
                var deposit = parseRentalNumber($(this).find('.line_deposit').val());
                var line_total = qty * rate * duration;

                $(this).find('.line_total_cell .display_currency').text(formatRentalAmount(line_total));
                $(this).find('.line_total_input').val(line_total);
                subtotal += line_total;
                total_deposit += deposit * qty;
            });

            // Discount
            var discount_type = $('#discount_type').val();
            var discount_amount = parseRentalNumber($('#discount_amount').val());
            var discount = 0;
            if (discount_type == 'fixed') {
                discount = discount_amount;
            } else if (discount_type == 'percentage') {
                discount = subtotal * (discount_amount / 100);
            }

            var after_discount = subtotal - discount;

            var tax_rate = Number(window.rentalTaxRates[$('#tax_id').val()]) || 0;
            var tax = subtotal * (tax_rate / 100);
            var total = after_discount + tax;

            $('#total_deposit .display_currency').text(formatRentalAmount(total_deposit));
            $('#total_amount .display_currency').text(formatRentalAmount(subtotal));
            $('#summary_subtotal .display_currency').text(formatRentalAmount(subtotal));
            $('#summary_discount .display_currency').text(formatRentalAmount(discount));
            $('#summary_tax .display_currency').text(formatRentalAmount(tax));
            $('#summary_total .display_currency').text(formatRentalAmount(total));
            $('#summary_deposit .display_currency').text(formatRentalAmount(total_deposit));
        }

        function parseRentalNumber(value) {
            if (typeof __number_uf === 'function') {
                return Number(__number_uf(value || 0)) || 0;
            }
            return Number(String(value || 0).replace(/,/g, '')) || 0;
        }

        function formatRentalAmount(value) {
            return typeof __currency_trans_from_en === 'function'
                ? __currency_trans_from_en(value, false)
                : Number(value || 0).toFixed(2);
        }

        // Datetimepicker
        if ($.fn.datetimepicker) {
            $('.datetimepicker').datetimepicker({
                format: moment_date_format + ' HH:mm',
                ignoreReadonly: true
            });

            var startTime = '<?php echo e(substr($settings['default_rental_start_time'] ?? '09:00', 0, 5), false); ?>'.split(':');
            var endTime = '<?php echo e(substr($settings['default_rental_end_time'] ?? '17:00', 0, 5), false); ?>'.split(':');
            var startDate = moment().set({hour: Number(startTime[0]) || 0, minute: Number(startTime[1]) || 0, second: 0});
            var endDate = moment().set({hour: Number(endTime[0]) || 0, minute: Number(endTime[1]) || 0, second: 0});
            if (!endDate.isAfter(startDate)) {
                endDate.add(1, 'day');
            }
            $('#rental_start').val(startDate.format(moment_date_format + ' HH:mm'));
            $('#rental_end_expected').val(endDate.format(moment_date_format + ' HH:mm'));
            updateRentalDaysCount();
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>