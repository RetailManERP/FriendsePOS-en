<script>
$(document).ready(function() {
    var import_row_index = 0;
    var charge_row_index = 0;
    var exchange_rate = parseFloat($('#import_exchange_rate').val()) || 1;

    // Charge categories
    var charge_categories = <?php echo json_encode($charge_categories, 15, 512) ?>;

    // ============================================
    // Multi-Currency Handling (like sell page)
    // ============================================

    // Location change → refresh currencies
    $('#import_location_id').on('change', function() {
        var location_id = $(this).val();
        if (!location_id) return;

        $.ajax({
            url: '<?php echo e(action([\Modules\ImportManagement\Http\Controllers\ImportController::class, "getLocationCurrencies"]), false); ?>',
            data: { location_id: location_id },
            dataType: 'json',
            success: function(currencies) {
                var select = $('#import_currency_select');
                select.find('option:not(:first)').remove();
                $.each(currencies, function(i, c) {
                    select.append('<option value="' + c.id + '" data-multiplier="' + c.multiplier + '" data-code="' + c.code + '" data-symbol="' + c.symbol + '" data-thousand="' + c.thousand_separator + '" data-decimal="' + c.decimal_separator + '">' + c.currency + ' (' + c.code + ') - ' + c.symbol + '</option>');
                });
                select.val('').trigger('change');
            }
        });
    });

    // Currency selection change
    $('#import_currency_select').on('change', function() {
        var selected = $(this).find(':selected');
        var multiplier = selected.data('multiplier');

        if (multiplier === undefined || multiplier === '') {
            // Default currency
            exchange_rate = 1;
            $('#import_exchange_rate').val(1).prop('readonly', true);
            $('.import_currency_label').text('');
        } else {
            exchange_rate = parseFloat(multiplier);
            $('#import_exchange_rate').val(exchange_rate).prop('readonly', false);
            var code = selected.data('code');
            var symbol = selected.data('symbol');
            $('.import_currency_label').text('(' + code + ')');
        }

        recalculateAllLines();
        recalculateTotals();
    });

    // Exchange rate manual change
    $('#import_exchange_rate').on('change keyup', function() {
        exchange_rate = parseFloat($(this).val()) || 1;
        recalculateAllLines();
        recalculateTotals();
    });

    // Refresh exchange rate
    $('.refresh_import_exchange_rate').click(function() {
        var selected = $('#import_currency_select').find(':selected');
        var code = selected.data('code');
        if (!code) return;

        $.ajax({
            url: '/get-exchange-rate',
            data: { currency_code: code },
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    exchange_rate = parseFloat(result.exchange_rate);
                    $('#import_exchange_rate').val(exchange_rate);
                    recalculateAllLines();
                    recalculateTotals();
                    toastr.success('Exchange rate refreshed');
                }
            },
            error: function() {
                toastr.error('Could not refresh exchange rate');
            }
        });
    });

    // ============================================
    // Product Search & Row Management
    // ============================================

    // Product search autocomplete
    if ($('#import_search_product').length) {
        $('#import_search_product').autocomplete({
            source: function(request, response) {
                $.getJSON('/purchases/get_products', {
                    term: request.term,
                    location_id: $('#import_location_id').val(),
                    check_enable_stock: true,
                }, function(data) {
                    response(data);
                });
            },
            minLength: 2,
            select: function(event, ui) {
                addProductRow(ui.item);
                $(this).val('');
                return false;
            }
        }).autocomplete('instance')._renderItem = function(ul, item) {
            return $('<li>')
                .append('<div>' + item.text + '</div>')
                .appendTo(ul);
        };
    }

    function addProductRow(product) {
        var row_html = getProductRowHtml(product, import_row_index);
        $('#import_items_body').append(row_html);
        import_row_index++;
        recalculateTotals();
    }

    function getProductRowHtml(product, idx) {
        var taxes_html = '<?php $tax_options = ""; foreach($taxes["tax_rates"] as $k => $v) { $tax_options .= "<option value=\"$k\">$v</option>"; } ?>';

        return '<tr class="import_item_row" data-row="' + idx + '">' +
            '<td>' +
                '<input type="hidden" name="import_lines[' + idx + '][product_id]" value="' + product.product_id + '">' +
                '<input type="hidden" name="import_lines[' + idx + '][variation_id]" value="' + product.variation_id + '">' +
                '<span class="product_name_label">' + product.text + '</span>' +
            '</td>' +
            '<td>' +
                '<input type="number" name="import_lines[' + idx + '][quantity]" class="form-control input-sm import_line_qty" value="1" min="0.0001" step="any" required>' +
            '</td>' +
            '<td>' +
                '<input type="number" name="import_lines[' + idx + '][unit_price]" class="form-control input-sm import_line_price" value="0" min="0" step="any" required>' +
            '</td>' +
            '<td>' +
                '<span class="import_line_subtotal">0.00</span>' +
            '</td>' +
            '<td>' +
                '<select name="import_lines[' + idx + '][tax_id]" class="form-control input-sm import_line_tax_select">' +
                    '<option value="">None</option>' +
                    '<?php echo $tax_options; ?>' +
                '</select>' +
                '<input type="hidden" name="import_lines[' + idx + '][item_tax]" class="import_line_item_tax" value="0">' +
            '</td>' +
            '<td>' +
                '<input type="number" name="import_lines[' + idx + '][weight_per_unit]" class="form-control input-sm" value="0" min="0" step="any">' +
            '</td>' +
            '<td>' +
                '<input type="text" name="import_lines[' + idx + '][lot_number]" class="form-control input-sm">' +
            '</td>' +
            '<td>' +
                '<button type="button" class="btn btn-danger btn-xs remove_import_line"><i class="fa fa-times"></i></button>' +
            '</td>' +
        '</tr>';
    }

    // Remove product row
    $(document).on('click', '.remove_import_line', function() {
        $(this).closest('tr').remove();
        recalculateTotals();
    });

    // Recalculate line subtotal on change
    $(document).on('change keyup', '.import_line_qty, .import_line_price', function() {
        var row = $(this).closest('tr');
        recalculateLineSubtotal(row);
        recalculateTotals();
    });

    function recalculateLineSubtotal(row) {
        var qty = parseFloat(row.find('.import_line_qty').val()) || 0;
        var price = parseFloat(row.find('.import_line_price').val()) || 0;
        var subtotal = qty * price;
        row.find('.import_line_subtotal').text(subtotal.toFixed(2));
    }

    function recalculateAllLines() {
        $('.import_item_row').each(function() {
            recalculateLineSubtotal($(this));
        });
    }

    // ============================================
    // Charge Row Management
    // ============================================

    $('#add_charge_btn').click(function() {
        addChargeRow();
    });

    function addChargeRow() {
        var cat_options = '<option value="">Select</option>';
        $.each(charge_categories, function(k, v) {
            cat_options += '<option value="' + k + '">' + v + '</option>';
        });

        var row_html = '<tr class="import_charge_row" data-charge-row="' + charge_row_index + '">' +
            '<td>' +
                '<select name="import_charges[' + charge_row_index + '][charge_category]" class="form-control input-sm">' + cat_options + '</select>' +
            '</td>' +
            '<td>' +
                '<input type="text" name="import_charges[' + charge_row_index + '][charge_name]" class="form-control input-sm" required>' +
            '</td>' +
            '<td>' +
                '<select name="import_charges[' + charge_row_index + '][charge_currency_id]" class="form-control input-sm charge_currency_select">' +
                    '<option value="" data-multiplier="1">Base Currency</option>' +
                '</select>' +
            '</td>' +
            '<td>' +
                '<input type="number" name="import_charges[' + charge_row_index + '][charge_exchange_rate]" class="form-control input-sm charge_exchange_rate" value="1" step="any" min="0.000000001">' +
            '</td>' +
            '<td>' +
                '<input type="number" name="import_charges[' + charge_row_index + '][amount]" class="form-control input-sm charge_amount" value="0" min="0" step="any" required>' +
            '</td>' +
            '<td>' +
                '<span class="charge_amount_base_display">0.00</span>' +
            '</td>' +
            '<td>' +
                '<input type="number" name="import_charges[' + charge_row_index + '][tax_amount]" class="form-control input-sm charge_tax_amount" value="0" min="0" step="any">' +
            '</td>' +
            '<td>' +
                '<input type="text" name="import_charges[' + charge_row_index + '][reference_no]" class="form-control input-sm">' +
            '</td>' +
            '<td class="text-center">' +
                '<input type="checkbox" name="import_charges[' + charge_row_index + '][include_in_landed_cost]" value="1" checked>' +
            '</td>' +
            '<td>' +
                '<button type="button" class="btn btn-danger btn-xs remove_charge_row"><i class="fa fa-times"></i></button>' +
            '</td>' +
        '</tr>';

        $('#import_charges_body').append(row_html);

        // Populate charge currency dropdown with same currencies
        var chargeSelect = $('#import_charges_body tr:last .charge_currency_select');
        $('#import_currency_select option').each(function() {
            if ($(this).val()) {
                chargeSelect.append($(this).clone());
            }
        });

        charge_row_index++;
    }

    // Remove charge row
    $(document).on('click', '.remove_charge_row', function() {
        $(this).closest('tr').remove();
        recalculateTotals();
    });

    // Recalculate charge base amount
    $(document).on('change keyup', '.charge_amount, .charge_exchange_rate', function() {
        var row = $(this).closest('tr');
        var amount = parseFloat(row.find('.charge_amount').val()) || 0;
        var rate = parseFloat(row.find('.charge_exchange_rate').val()) || 1;
        var base = amount * rate;
        row.find('.charge_amount_base_display').text(base.toFixed(2));
        recalculateTotals();
    });

    // Charge currency change
    $(document).on('change', '.charge_currency_select', function() {
        var row = $(this).closest('tr');
        var selected = $(this).find(':selected');
        var multiplier = selected.data('multiplier');
        if (multiplier !== undefined && multiplier !== '') {
            row.find('.charge_exchange_rate').val(parseFloat(multiplier));
        } else {
            row.find('.charge_exchange_rate').val(1);
        }
        row.find('.charge_amount').trigger('change');
    });

    // ============================================
    // Totals Calculation
    // ============================================

    function recalculateTotals() {
        // Items cost in import currency
        var total_items_cost = 0;
        $('.import_item_row').each(function() {
            var qty = parseFloat($(this).find('.import_line_qty').val()) || 0;
            var price = parseFloat($(this).find('.import_line_price').val()) || 0;
            total_items_cost += qty * price;
        });
        $('#total_items_cost_display').text(total_items_cost.toFixed(2));

        // Items cost in base currency
        var total_items_cost_base = total_items_cost * exchange_rate;
        $('#summary_items_cost_base').text(total_items_cost_base.toFixed(2));

        // Total charges in base currency
        var total_charges = 0;
        var total_charge_tax = 0;
        $('.import_charge_row').each(function() {
            var amount = parseFloat($(this).find('.charge_amount').val()) || 0;
            var rate = parseFloat($(this).find('.charge_exchange_rate').val()) || 1;
            var tax = parseFloat($(this).find('.charge_tax_amount').val()) || 0;
            total_charges += amount * rate;
            total_charge_tax += tax;
        });
        total_charges += total_charge_tax;
        $('#total_charges_display').text(total_charges.toFixed(2));
        $('#summary_total_charges').text(total_charges.toFixed(2));

        // Total landed cost
        var total_landed = total_items_cost_base + total_charges;
        $('#summary_landed_cost').text(total_landed.toFixed(2));

        // Tax calculation
        var tax_amount = 0;
        var tax_select = $('#import_tax_id');
        if (tax_select.val()) {
            var tax_text = tax_select.find(':selected').text();
            var tax_match = tax_text.match(/([\d.]+)%/);
            if (tax_match) {
                var tax_rate = parseFloat(tax_match[1]);
                tax_amount = (total_landed * tax_rate) / 100;
            }
        }
        $('#summary_tax_amount').text(tax_amount.toFixed(2));

        // Discount
        var discount = 0;
        var discount_type = $('#import_discount_type').val();
        var discount_amount = parseFloat($('#import_discount_amount').val()) || 0;
        if (discount_type === 'fixed') {
            discount = discount_amount;
        } else if (discount_type === 'percentage') {
            discount = (total_landed * discount_amount) / 100;
        }
        $('#summary_discount').text(discount.toFixed(2));

        // Grand total
        var grand_total = total_landed + tax_amount - discount;
        $('#summary_grand_total').text(grand_total.toFixed(2));
    }

    // Tax/Discount change triggers recalculation
    $('#import_tax_id, #import_discount_type, #import_discount_amount').on('change keyup', function() {
        recalculateTotals();
    });

    // Charge tax change
    $(document).on('change keyup', '.charge_tax_amount', function() {
        recalculateTotals();
    });

    // ============================================
    // Date picker
    // ============================================
    if ($('#import_date').length) {
        $('#import_date').datetimepicker({
            format: moment_date_format + ' ' + moment_time_format,
            ignoreReadonly: true
        });
    }

    // Initialize first recalculation
    recalculateTotals();
});
</script>
