<script type="text/javascript">
	$(document).ready( function() {
        jQuery.validator.addMethod("notEmpty", function(value, element, param) {
            return __number_uf(value) > 0
        }, "<?php echo e(__('manufacturing::lang.quantity_greater_than_zero'), false); ?>");

        jQuery.validator.addMethod("notEqualToWastedQuantity", function(value, element, param) {
            var waste_qty = __read_number($('#mfg_wasted_units'));
            var qty = __number_uf(value);
            return qty > waste_qty;
        }, "<?php echo e(__('manufacturing::lang.waste_qty_less_than_qty'), false); ?>");

		$('#transaction_date').datetimepicker({
	        format: moment_date_format + ' ' + moment_time_format,
	        ignoreReadonly: true,
	    });

	    $('#exp_date').datepicker({
            autoclose: true,
            format: datepicker_date_format,
        });

        $('#mfg_due_date').datepicker({
            autoclose: true,
            format: datepicker_date_format,
        });

	    production_form_validator = $('#production_form').validate();

	    // Disable product dropdown until a business location is chosen (create page only)
	    if ($('#production_form #location_id').length && $('#production_form #variation_id').length) {
	        var $variationSelect = $('#production_form #variation_id');
	        var $locationSelect  = $('#production_form #location_id');

	        // On location change: enable/disable product dropdown
	        $locationSelect.on('change', function () {
	            var hasLocation = $(this).val() !== '' && $(this).val() !== null;
	            if (!hasLocation) {
	                $variationSelect.val(null).trigger('change');
	            }
	            $variationSelect.prop('disabled', !hasLocation);
	        });
	    }
    
	});


    function initialize_search(element) {
        element.autocomplete({
                source: function(request, response) {
                    $.getJSON(
                        '/purchases/get_products',
                        { location_id: $('#location_id').val(), term: request.term, check_enable_stock: false },
                        response
                    );
                },
                minLength: 2,
                response: function(event, ui) {
                    if (ui.content.length == 1) {
                        ui.item = ui.content[0];
                        $(this)
                            .data('ui-autocomplete')
                            ._trigger('select', 'autocompleteselect', ui);
                        $(this).autocomplete('close');
                    } else if (ui.content.length == 0) {
                        var term = $(this).data('ui-autocomplete').term;
                        toastr.error(LANG.no_products_found);
                    }
                },
                select: function(event, ui) {
                    $(this).val(null);
                    addIngredientRowProduction(ui.item.variation_id, $(this));
                },
            })
            .autocomplete('instance')._renderItem = function(ul, item) {
            return $('<li>')
                .append('<div>' + item.text + '</div>')
                .appendTo(ul);
        };
	}
    if ($('#search_product').length) {
        initialize_search($('#search_product'));
    }

    function isIngredientQtyEditingDisabled() {
        return $('#ingredients_for_unit_recipe_table').data('disable-editing-ingredient-qty') == 1;
    }

	$(document).on('change', '#production_form #variation_id, #production_form #location_id', function () {
		if (window.is_fetching_so_recipe) return;
		var variation_id = $("#variation_id").val();
		var location_id = $("#location_id").val();
		
		if(variation_id && location_id) {
			$.ajax({
	            url: "/manufacturing/get-recipe-details?variation_id=" + variation_id + "&location_id=" + location_id + "&_=" + Date.now(),
                cache: false,
	            dataType: 'json',
	            success: function(result) {
	                $('#enter_ingredients_table').html(result.ingredient_table);
	                if (result.is_sub_unit) {
	                	$('#recipe_quantity_input').removeClass('input-group');
	                	$('#recipe_quantity_input').addClass('input_inline');
	                	$('#unit_html').removeClass('input-group-text');

                        $('#number_of_batches_input').removeClass('input-group');
	                	$('#number_of_batches_input').addClass('input_inline');
	                	$('#unit_html_no').removeClass('input-group-text');
	                } else {
	                	$('#recipe_quantity_input').addClass('input-group');
	                	$('#recipe_quantity_input').removeClass('input_inline');
	                	$('#unit_html').addClass('input-group-text');

                        $('#number_of_batches_input').addClass('input-group');
	                	$('#number_of_batches_input').removeClass('input_inline');
	                	$('#unit_html_no').addClass('input-group-text');
	                }
	                __write_number($('#recipe_quantity'), result.recipe.total_quantity);
                    $('#recipe_quantity').attr('default_quantity', __read_number($('#recipe_quantity')));
	                $('#unit_html').html(result.unit_html);
	                $('#wasted_units_text').text(result.unit_name);

                    __write_number($('#number_of_batches'), result.recipe.no_of_batches);
	                $('#unit_html_no').html(result.unit_html);
	                $('#wasted_units_text').text(result.unit_name);

                    var mfg_wasted_units = __calculate_amount('percentage', $('#waste_percent').val(), result.recipe.total_quantity);
                    __write_number($('#mfg_wasted_units'), mfg_wasted_units);
                    __write_number($('#production_cost'), result.recipe.extra_cost);
                    $('#mfg_production_cost_type').val(result.recipe.production_cost_type);
                    var raw_instructions = result.recipe.instructions || '';
                    var plain_instructions = $('<div>').html(raw_instructions).text();
                    $('#recipe_instructions_display').val(plain_instructions);
                    updateProductionCurrentStock(
                        result.formatted_current_stock,
                        result.current_stock_unit,
                        result.formatted_last_production_unit_cost,
                        result.last_production_unit_cost_unit,
                        result.last_production_unit_cost
                    );

	                __currency_convert_recursively($('#enter_ingredients_table'));
                    updateIngredientCurrentStocks();
                    calculateRecipeTotal();

                    if ($('#search_product').length) {
                        initialize_search($('#search_product'));
                    }
	            },
	        });
		} else {
			$('#enter_ingredients_table').html('');
			$('#recipe_instructions_display').val('');
            updateProductionCurrentStock();
	        calculateRecipeTotal();
		}
	});

    function updateProductionCurrentStock(quantity, unit, lastUnitCost, lastUnitCostUnit, lastUnitCostValue) {
        var $stockBlock = $('#production_current_stock');
        if (!$stockBlock.length) {
            return;
        }

        if (quantity === undefined || quantity === null || quantity === '') {
            $stockBlock.hide();
            $('#production_current_stock_qty').text('0.00');
            $('#production_current_stock_unit').text('');
            $('#production_last_unit_cost').text('--');
            $('#production_last_unit_cost_unit').text('');
            $('#production_current_unit_cost').text('--');
            $('#production_current_unit_cost_unit').text('');
            $('#production_unit_cost_difference')
                .text('--')
                .removeClass('text-danger text-success')
                .addClass('text-muted');
            $stockBlock.removeData('last-production-unit-cost');
            return;
        }

        $('#production_current_stock_qty').text(quantity);
        $('#production_current_stock_unit').text(unit || '');
        $('#production_last_unit_cost').text(lastUnitCost || '--');
        $('#production_last_unit_cost_unit').text(lastUnitCostUnit ? '/ ' + lastUnitCostUnit : '');
        $('#production_current_unit_cost_unit').text(unit ? '/ ' + unit : '');
        if (lastUnitCostValue === undefined || lastUnitCostValue === null || lastUnitCostValue === '') {
            $stockBlock.removeData('last-production-unit-cost');
        } else {
            $stockBlock.data('last-production-unit-cost', parseFloat(lastUnitCostValue));
        }
        $stockBlock.show();
    }

    function updateProductionUnitCost(finalPrice) {
        var $currentCost = $('#production_current_unit_cost');
        var $difference = $('#production_unit_cost_difference');
        if (!$currentCost.length || !$difference.length) {
            return;
        }

        var currentUnitCost = getCurrentProductionUnitCost(finalPrice);
        if (currentUnitCost === null) {
            $currentCost.text('--');
            $difference
                .text('--')
                .removeClass('text-danger text-success')
                .addClass('text-muted');
            return;
        }

        $currentCost.text(__currency_trans_from_en(currentUnitCost, true));

        var previousUnitCost = parseFloat($('#production_current_stock').data('last-production-unit-cost'));
        if (isNaN(previousUnitCost)) {
            $difference
                .text('--')
                .removeClass('text-danger text-success')
                .addClass('text-muted');
            return;
        }

        var difference = currentUnitCost - previousUnitCost;
        if (Math.abs(difference) < 0.000001) {
            difference = 0;
        }
        var formattedDifference = (difference > 0 ? '+' : difference < 0 ? '-' : '') +
            __currency_trans_from_en(Math.abs(difference), true);

        $difference
            .text(formattedDifference)
            .removeClass('text-danger text-success text-muted')
            .addClass(difference > 0 ? 'text-danger' : (difference < 0 ? 'text-success' : 'text-muted'));
    }

    function getCurrentProductionUnitCost(finalPrice) {
        finalPrice = parseFloat(finalPrice);
        if (isNaN(finalPrice)) {
            return null;
        }

        var outputQuantity = __read_number($('#recipe_quantity')) - __read_number($('#mfg_wasted_units'));
        var multiplier = 1;
        if ($('#sub_unit_id').length) {
            multiplier = parseFloat($('#sub_unit_id').find(':selected').data('multiplier')) || 1;
        }

        outputQuantity = outputQuantity * multiplier;
        if (outputQuantity <= 0) {
            return null;
        }

        return finalPrice / outputQuantity;
    }

    function updateIngredientCurrentStocks() {
        $('#ingredients_for_unit_recipe_table tbody tr').each(function() {
            updateIngredientCurrentStock($(this));
        });
    }

    function updateIngredientCurrentStock($row) {
        var $stockQty = $row.find('.ingredient_current_stock_qty');
        if (!$stockQty.length) {
            return;
        }

        var currentStock = parseFloat($stockQty.data('current-stock-base'));
        if (isNaN(currentStock)) {
            currentStock = 0;
        }

        var multiplier = 1;
        var unitName = $.trim($row.find('.line_unit_span').text());
        var $subUnit = $row.find('select.sub_unit');
        if ($subUnit.length) {
            var $selectedOption = $subUnit.find(':selected');
            multiplier = parseFloat($selectedOption.data('multiplier')) || 1;
            unitName = $.trim($selectedOption.text());
        }

        var precision = typeof __quantity_precision !== 'undefined' ? __quantity_precision : __currency_precision;
        $stockQty.text(__number_f(currentStock / multiplier, false, false, precision));
        $row.find('.ingredient_current_stock_unit').text(unitName);
    }

	$(document).on('change', '#production_cost, #mfg_wasted_units, select.sub_unit, input.mfg_waste_percent, #mfg_production_cost_type', function(){
		calculateRecipeTotal();
	});
    
    $(document).on('change', '#recipe_quantity, #sub_unit_id', function(){
        var recipe_quantity = __read_number($('#recipe_quantity'));
        var recipe_batches = __read_number($('#number_of_batches'));

        var mfg_wasted_units = __calculate_amount('percentage', $('#waste_percent').val(), recipe_quantity);
        __write_number($('#mfg_wasted_units'), mfg_wasted_units);

        var multiplier = 1;
        if ($('#sub_unit_id').length) {
            multiplier = parseFloat(
            $('#sub_unit_id')
                .find(':selected')
                .data('multiplier')
            );
            recipe_quantity = recipe_quantity * multiplier; 
        }
    
        var total_quantity = 0;
        // var total_recipe_batches = 0;
        $('#ingredients_for_unit_recipe_table tbody tr').each( function() {
            var line_unit_quantity = parseFloat($(this).find('.unit_quantity').val());
            var line_total_quantity = parseFloat($(this).find('.total_quantity').val());
            total_quantity += line_total_quantity;
            var line_multiplier = __getUnitMultiplier($(this));
            var line_total_quantity = (recipe_quantity * line_unit_quantity) / line_multiplier;
            __write_number($(this).find('.total_quantities'), line_total_quantity);
            $(this).find('.total_quantities').change();
        });
        // total_recipe_batches = recipe_quantity / total_quantity;
        // $('#number_of_batches').val(total_recipe_batches);
    });

    // quantity batches
    $(document).on('change', '#number_of_batches', function(){
        var recipe_quantity = $('#recipe_quantity').attr('default_quantity');
        var recipe_batches = __read_number($('#number_of_batches'));
        
        var mfg_wasted_units = __calculate_amount('percentage', $('#waste_percent').val(), recipe_batches);
        __write_number($('#mfg_wasted_units'), mfg_wasted_units);

        var multiplier = 1;
        if ($('#sub_unit_id').length) {
            multiplier = parseFloat(
            $('#sub_unit_id')
                .find(':selected')
                .data('multiplier')
            );
            recipe_batches = recipe_batches * recipe_quantity; 
            // Trigger the change event on quantity input to recalculate other values
            $('#recipe_quantity').val(recipe_batches);
            $('#recipe_quantity').change();
            $('#sub_unit_id').change();
        }   
        // var recipe_quantity = __read_number($('#recipe_quantity'));
        // $('#ingredients_for_unit_recipe_table tbody tr').each( function() {
        //     var line_unit_quantity = parseFloat($(this).find('.unit_quantity').val());
        //     var line_multiplier = __getUnitMultiplier($(this));
        //     var line_total_quantity = (recipe_quantity * line_unit_quantity) / line_multiplier;
        //     __write_number($(this).find('.total_quantities'), line_total_quantity);
        //     $(this).find('.total_quantities').change();
        // });

    });

	$(document).on('change', '#sub_unit_id', function(){
		var unit_name = $(this)
                .find(':selected')
                .data('unit_name');
            $('#wasted_units_text').text(unit_name);
	});

	$(document).on('change', '.total_quantities', function(){
		if (production_form_validator) {
    		production_form_validator.element($(this));
		}
		calculateRecipeTotal();
	});

    $(document).on('change', '.total_batches', function(){
		if (production_form_validator) {
    		production_form_validator.element($(this));
		}
		calculateBatchesRecipeTotal();
	});

	function calculateRecipeTotal() {
		var recipe_quantity = __read_number($('#recipe_quantity'));
        var multiplier = 1;
        if ($('#sub_unit_id').length) {
            multiplier = parseFloat(
            $('#sub_unit_id')
                .find(':selected')
                .data('multiplier')
            );
            recipe_quantity = recipe_quantity * multiplier; 
        }
        
        // Add in ingredients quantity to show the result in runtime by Hur Hussain 
        var total_ingredients_cost = 0;
        var ingredients_quantity = 0;
        var ingredient_pl = [];
        $('#ingredients_for_unit_recipe_table tbody tr').each( function() {
            if ($(this).find('.ingredient_price').length > 0) {
                var line_unit_price = parseFloat($(this).find('.ingredient_price').val());
                var line_unit_quantity = parseFloat($(this).find('.unit_quantity').val());
                var line_unit_total = line_unit_price * line_unit_quantity;
                var line_total_quantity = __read_number($(this).find('.total_quantities'));
                var line_multiplier = __getUnitMultiplier($(this));
                var line_waste_percent = __read_number($(this).find('.mfg_waste_percent'));

                var line_final_quantity = __substract_percent(line_total_quantity, line_waste_percent);

                $(this).find('.ingredient_pl').each(function(index) {
                    let pl_qty = $(this).data('quantity');
                    let pl_price = $(this).data('price');   
                    ingredient_pl.push({ quantity: pl_qty, price: pl_price });
                });

                var line_total = 0;
                var totalQuantity = 0;
                if(ingredient_pl.length > 0){
                    let remainingQuantity = line_final_quantity;
                    let last_price = 0;
                    for (let i = 0; i < ingredient_pl.length; i++) {
                        let availableQuantity = Math.min(ingredient_pl[i].quantity, remainingQuantity);
                        last_price = ingredient_pl[i].price;
                        line_total += availableQuantity * parseFloat(ingredient_pl[i].price) * line_multiplier;
                        remainingQuantity -= availableQuantity;
                        if (remainingQuantity === 0) {
                            break;
                        }
                    }
                    if(remainingQuantity !== 0){
                        line_total += last_price * remainingQuantity * line_multiplier; 
                    }
                    
                }else{
                    line_total = line_unit_price * line_final_quantity * line_multiplier;
                }
                ingredient_pl = [];
                
                // var line_total = line_unit_price * line_total_quantity * line_multiplier;
                $(this).find('span.ingredient_total_price').text(__currency_trans_from_en(line_total, true));
                $(this).find('span.row_final_quantity').text(__currency_trans_from_en(line_final_quantity, false));

                var line_unit_name = '';

                if ($(this).find('.sub_unit').length) {
                    line_unit_name = $(this).find('.sub_unit')
                    .find('option:selected')
                    .text();
                    let new_sub_unit_quantity = $(this).find('.total_quantities').attr('data-qty_available') / $(this).find('.sub_unit').find('option:selected').data('multiplier');
                    $(this).find('.total_quantities').attr('data-rule-max-value', new_sub_unit_quantity);
                    $(this).find('.total_quantities').attr('data-qty_available', new_sub_unit_quantity);
                } else {
                    line_unit_name = $(this).find('.line_unit_span').text();
                }
                $(this).find('.row_unit_text').text(line_unit_name);

                total_ingredients_cost += line_total;
                ingredients_quantity += line_final_quantity * line_multiplier;
            }
        });

        $('#total_ingredient_price').text(__currency_trans_from_en(total_ingredients_cost, true));
        $('#total_ingredient_quantity').text(__currency_trans_from_en(ingredients_quantity, false));

        var production_cost = __read_number($('#production_cost'));
        var production_cost_type = $('#mfg_production_cost_type').val();
        if (production_cost_type == 'percentage') {
            production_cost = __calculate_amount('percentage', production_cost, total_ingredients_cost);
        } else if(production_cost_type == 'per_unit') {
            production_cost = production_cost * __read_number($('#recipe_quantity'));
        }
        $('span#total_production_cost').text(__currency_trans_from_en(production_cost, true));
        var final_price = total_ingredients_cost + production_cost;
        __write_number($('#final_total'), final_price);
        $('span#final_total_text').text(__currency_trans_from_en(final_price, true));
        __write_number($('#total'), total_ingredients_cost);
        updateProductionUnitCost(final_price);
    }

    // no of batches added by Hur Hussain
    function calculateBatchesRecipeTotal() {
		var recipe_quantity = __read_number($('#number_of_batches'));
        var multiplier = 1;
        if ($('#sub_unit_id').length) {
            multiplier = parseFloat(
            $('#sub_unit_id')
                .find(':selected')
                .data('multiplier')
            );
            recipe_quantity = recipe_quantity * multiplier; 
        }
        // Add in ingredients quantity to show the result in runtime by Hur Hussain 
        var total_ingredients_cost = 0;
        var ingredients_quantity = 0;
        var ingredient_pl = [];
        $('#ingredients_for_unit_recipe_table tbody tr').each( function() {
            if ($(this).find('.ingredient_price').length > 0) {
                var line_unit_price = parseFloat($(this).find('.ingredient_price').val());
                var line_unit_quantity = parseFloat($(this).find('.unit_quantity').val());
                var line_unit_total = line_unit_price * line_unit_quantity;
                var line_total_quantity = __read_number($(this).find('.total_batches'));
                var line_multiplier = __getUnitMultiplier($(this));
                var line_waste_percent = __read_number($(this).find('.mfg_waste_percent'));

                var line_final_quantity = __substract_percent(line_total_quantity, line_waste_percent);

                $(this).find('.ingredient_pl').each(function(index) {
                    let pl_qty = $(this).data('quantity');
                    let pl_price = $(this).data('price');   
                    ingredient_pl.push({ quantity: pl_qty, price: pl_price });
                });

                var line_total = 0;
                var totalQuantity = 0;
                if(ingredient_pl.length > 0){
                    let remainingQuantity = line_final_quantity;
                    let last_price = 0;
                    for (let i = 0; i < ingredient_pl.length; i++) {
                        let availableQuantity = Math.min(ingredient_pl[i].quantity, remainingQuantity);
                        last_price = ingredient_pl[i].price;
                        line_total += availableQuantity * parseFloat(ingredient_pl[i].price) * line_multiplier;
                        remainingQuantity -= availableQuantity;
                        if (remainingQuantity === 0) {
                            break;
                        }
                    }
                    if(remainingQuantity !== 0){
                        line_total += last_price * remainingQuantity * line_multiplier; 
                    }
                    
                }else{
                    line_total = line_unit_price * line_final_quantity * line_multiplier;
                }
                ingredient_pl = [];

                // var line_total = line_unit_price * line_total_quantity * line_multiplier;
                $(this).find('span.ingredient_total_price').text(__currency_trans_from_en(line_total, true));
                $(this).find('span.row_final_quantity').text(__currency_trans_from_en(line_final_quantity, false));

                var line_unit_name = '';

                if ($(this).find('.sub_unit').length) {
                    line_unit_name = $(this).find('.sub_unit')
                    .find('option:selected')
                    .text();
                } else {
                    line_unit_name = $(this).find('.line_unit_span').text();
                }
                $(this).find('.row_unit_text').text(line_unit_name);

                total_ingredients_cost += line_total;
                ingredients_quantity += line_final_quantity * line_multiplier;
            }
        });

        $('#total_ingredient_price').text(__currency_trans_from_en(total_ingredients_cost, true));
        var production_cost = __read_number($('#production_cost'));
        var production_cost_type = $('#mfg_production_cost_type').val();
        if (production_cost_type == 'percentage') {
            production_cost = __calculate_amount('percentage', production_cost, total_ingredients_cost);
        } else if(production_cost_type == 'per_unit') {
            production_cost = production_cost * __read_number($('#recipe_quantity'));
        }
        $('span#total_production_cost').text(__currency_trans_from_en(production_cost, true));
        var final_price = total_ingredients_cost + production_cost;
        __write_number($('#final_total'), final_price);
        $('span#final_total_text').text(__currency_trans_from_en(final_price, true));
        __write_number($('#total'), total_ingredients_cost);
        updateProductionUnitCost(final_price);

        $('#total_ingredient_quantity').text(__currency_trans_from_en(ingredients_quantity, false));
    }

    $(document).on('change', 'select.sub_unit', function() {
        var tr = $(this).closest('tr');
        updateIngredientCurrentStock(tr);
        var selected_option = $(this).find(':selected');
        var multiplier = parseFloat(selected_option.data('multiplier'));
        var allow_decimal = parseInt(selected_option.data('allow_decimal'));

        var qty_element = tr.find('input.total_quantities');
        var base_max_avlbl = qty_element.data('qty_available');
        var error_msg_line = 'pos_max_qty_error';
        console.log(base_max_avlbl);
        qty_element.attr('data-decimal', allow_decimal);
        var abs_digit = true;
        if (allow_decimal) {
            abs_digit = false;
        }
        qty_element.rules('add', {
            abs_digit: abs_digit,
        });

        if (base_max_avlbl) {
            var max_avlbl = parseFloat(base_max_avlbl) / multiplier;
            var formated_max_avlbl = __number_f(max_avlbl);
            var unit_name = selected_option.data('unit_name');
            var max_err_msg = __translate(error_msg_line, {
                max_val: formated_max_avlbl,
                unit_name: unit_name,
            });
            qty_element.attr('data-rule-max-value', max_avlbl);
            qty_element.attr('data-msg-max-value', max_err_msg);
            qty_element.rules('add', {
                'max-value': max_avlbl,
                messages: {
                    'max-value': max_err_msg,
                },
            });
            qty_element.trigger('change');
        }
    });

    function addIngredientRowProduction(variation_id, search_element) {
        if (isIngredientQtyEditingDisabled()) {
            return;
        }

    	var location_id = $('#location_id').val();

    	$.ajax({
            url: "/manufacturing/get-ingredient-row-production/" + variation_id + '?location_id=' + location_id + '&_=' + Date.now(),
            cache: false,
            dataType: 'html',
            success: function(result) {
                $('table#ingredients_for_unit_recipe_table tbody').append(result);
                updateIngredientCurrentStock($('table#ingredients_for_unit_recipe_table tbody tr:last'));
                calculateRecipeTotal();
            },
        });
    }

    $(document).on('click', 'button.remove_ingredient', function() {
        if (isIngredientQtyEditingDisabled()) {
            return;
        }

		$(this).closest('tr').remove();
		calculateRecipeTotal();
	});

    $(document).on('click', '#ps_show_product_qty_details', function(e){
    e.preventDefault();
    if($('#products_search_results .ps-row-select:checked').length){
        
        if($('#products_search_results .ps-row-select:checked').length > 1){
            toastr.warning('Multiple Products Selected - Showing Qty of First Selected Product');
        }
        
        let variation_id = $('#products_search_results .ps-row-select:checked').first().val();
        
        $.ajax({
            url: '/products/qty-detail',
            data: { 
                variation_id: variation_id,
            },
            dataType: 'html',
            success: function(result) {
                $('#product_qty_detail_modal').html(result);
                $('#product_qty_detail_modal').modal('show');
            },
        });
        
    }else{
        toastr.error('No products selected');
    }
});

$(document).on('hidden.bs.modal', '#product_qty_detail_modal', function(){
    $(this).html('');
});

document.addEventListener('keydown', function(event) {
    if (event.key === 'F10') {
        event.preventDefault();
        if (keyBindingEnabled) {
            keyBindingEnabled = false;
            $('button#open_products_search_modal').trigger('click');
            setTimeout(() => {
                keyBindingEnabled = true;
            }, 1000);
        }
    }
});

//Product Search Screen Functonality
$(document).on('click', '#ps_select_products', function(e){
    e.preventDefault();
    if($('#products_search_results .ps-row-select:checked').length){
        toastr.success('Adding Products');
        $('#products_search_results .ps-row-select:checked').each(function() {
            addIngredientRowProduction($(this).val(), $('input#search_product'));
        });
        $('#products_search_modal').modal('hide');

    }else if($('#products_search_results .ps-row-select:focus').length){
        toastr.success('Adding Product');
        addIngredientRowProduction($(this).val(), $('input#search_product'));
        $('#products_search_modal').modal('hide');

    }else{
        toastr.error('No products selected');
    }
});

$(document).on('dblclick', '#products_search_results tbody tr', function () {
    toastr.success('Adding Product');
    let variation_id = $(this).find('.ps-row-select').val();
    addIngredientRowProduction(variation_id, $('input#search_product'));
    $('#products_search_modal').modal('hide');
});

    // Sales Orders Modal Logic
    var sales_orders_table = null;
    $('#sales_orders_modal').on('shown.bs.modal', function () {
        if (!sales_orders_table) {
            sales_orders_table = $('#sales_orders_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/manufacturing/sales-order-lines',
                columns: [
                    { data: 'transaction_date', name: 'transactions.transaction_date' },
                    { data: 'ref_no', name: 'transactions.ref_no' },
                    { data: 'invoice_no', name: 'transactions.invoice_no' },
                    { data: 'product_name', name: 'products.name' },
                    { data: 'sub_sku', name: 'variations.sub_sku' },
                    { data: 'quantity', name: 'transaction_sell_lines.quantity' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        } else {
            sales_orders_table.ajax.reload(null, false);
        }
    });

    $(document).on('click', '.select_so_line', function() {
        var sell_line_id = $(this).data('sell_line_id');
        var variation_id = $(this).data('variation_id');
        var quantity = $(this).data('quantity');

        $('#sales_order_line_id').val(sell_line_id);
        
        window.is_fetching_so_recipe = true;
        $('#variation_id').val(variation_id).trigger('change.select2');
        
        $('#sales_orders_modal').modal('hide');

        var location_id = $("#location_id").val();
        
        if(variation_id && location_id) {
            $.ajax({
                url: "/manufacturing/sales-order-line-recipe?sell_line_id=" + sell_line_id + "&location_id=" + location_id + "&_=" + Date.now(),
                cache: false,
                dataType: 'json',
                success: function(result) {
                    $('#enter_ingredients_table').html(result.ingredient_table);
                    
                    $('#recipe_quantity_input').addClass('input-group');
                    $('#recipe_quantity_input').removeClass('input_inline');
                    $('#unit_html').addClass('input-group-text');

                    $('#number_of_batches_input').addClass('input-group');
                    $('#number_of_batches_input').removeClass('input_inline');
                    $('#unit_html_no').addClass('input-group-text');
                    
                    __write_number($('#recipe_quantity'), quantity);
                    $('#recipe_quantity').attr('default_quantity', __read_number($('#recipe_quantity')));

                    __write_number($('#number_of_batches'), quantity);

                    var mfg_wasted_units = __calculate_amount('percentage', $('#waste_percent').val() || 0, quantity);
                    __write_number($('#mfg_wasted_units'), mfg_wasted_units);

                    __currency_convert_recursively($('#enter_ingredients_table'));
                    updateIngredientCurrentStocks();
                    calculateRecipeTotal();
                    window.is_fetching_so_recipe = false;
                },
                error: function() {
                    window.is_fetching_so_recipe = false;
                }
            });
        } else {
            window.is_fetching_so_recipe = false;
        }
    });

</script>
