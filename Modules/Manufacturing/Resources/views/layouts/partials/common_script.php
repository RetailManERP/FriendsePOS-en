<script type="text/javascript">
	$(document).ready( function () {

        var production_list_default_today = $('#productions_table').length == 1;
        var production_list_default_date = moment();
        var production_list_date_range_settings = production_list_default_today
            ? $.extend({}, dateRangeSettings, {
                startDate: production_list_default_date.clone(),
                endDate: production_list_default_date.clone(),
            })
            : dateRangeSettings;

		$('#production_list_filter_date_range').daterangepicker(
        production_list_date_range_settings,
	        function (start, end) {
	            $('#production_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
	            productions_table.ajax.reload();
                reverse_productions_table.ajax.reload();
	        }
	    );
        if (production_list_default_today) {
            $('#production_list_filter_date_range').val(
                production_list_default_date.format(moment_date_format) +
                    ' ~ ' +
                    production_list_default_date.format(moment_date_format)
            );
        }
	    $('#production_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
	        $('#production_list_filter_date_range').val('');
	        productions_table.ajax.reload();
            reverse_productions_table.ajax.reload();
	    });
		
        // ── Production filter: Save / Reset ─────────────────────────────────
        var _productionFilterKey = 'production_filters_<?php echo e(auth()->id(), false); ?>';

        function _productionRestoreFilters() {
            var saved = null;
            try { saved = JSON.parse(localStorage.getItem(_productionFilterKey)); } catch(e) {}
            if (!saved) return;

            if (saved.location_id) {
                $('#productstion_list_filter_location_id').val(saved.location_id).trigger('change.select2');
            }

            if (saved.date_range) {
                var parts = saved.date_range.split(' ~ ');
                if (parts.length === 2) {
                    var drp = $('#production_list_filter_date_range').data('daterangepicker');
                    if (drp) { drp.setStartDate(parts[0]); drp.setEndDate(parts[1]); }
                    $('#production_list_filter_date_range').val(saved.date_range);
                }
            }

            if (saved.is_final) {
                $('#production_list_is_final').prop('checked', true);
            }

            if (saved.status) {
                $('#production_list_filter_status').val(saved.status).trigger('change.select2');
            }

            if (saved.category_id) {
                $('#production_list_filter_category_id').val(saved.category_id).trigger('change.select2');
            }

            if (saved.sub_category_id) {
                var subEl = $('#production_list_filter_sub_category_id');
                subEl.append('<option value="' + $('<div>').text(saved.sub_category_id).html() + '">' + $('<div>').text(saved.sub_text || saved.sub_category_id).html() + '</option>');
                subEl.val(saved.sub_category_id).trigger('change.select2');
            }

            if (saved.sub2_category_id) {
                var sub2El = $('#production_list_filter_sub2_category_id');
                sub2El.append('<option value="' + $('<div>').text(saved.sub2_category_id).html() + '">' + $('<div>').text(saved.sub2_text || saved.sub2_category_id).html() + '</option>');
                sub2El.val(saved.sub2_category_id).trigger('change.select2');
            }
        }

        $('#production_filter_save').on('click', function() {
            var cat  = $('#production_list_filter_category_id');
            var sub  = $('#production_list_filter_sub_category_id');
            var sub2 = $('#production_list_filter_sub2_category_id');
            var data = {
                location_id:      $('#productstion_list_filter_location_id').val() || '',
                date_range:       $('#production_list_filter_date_range').val() || '',
                is_final:         $('#production_list_is_final').is(':checked') ? 1 : 0,
                status:           $('#production_list_filter_status').val() || '',
                category_id:      cat.val()  || '',
                sub_category_id:  sub.val()  || '',
                sub2_category_id: sub2.val() || '',
                sub_text:         sub.find('option:selected').text()  || '',
                sub2_text:        sub2.find('option:selected').text() || '',
            };
            localStorage.setItem(_productionFilterKey, JSON.stringify(data));
            toastr.success('<?php echo e(__("lang_v1.success"), false); ?>');
        });

        $('#production_filter_reset').on('click', function() {
            localStorage.removeItem(_productionFilterKey);
            $('#productstion_list_filter_location_id').val('').trigger('change.select2');
            var drp = $('#production_list_filter_date_range').data('daterangepicker');
            if (drp) { drp.setStartDate(moment()); drp.setEndDate(moment()); }
            $('#production_list_filter_date_range').val('');
            $('#production_list_is_final').prop('checked', false);
            $('#production_list_filter_status').val('').trigger('change.select2');
            $('#production_list_filter_category_id').val('').trigger('change.select2');
            $('#production_list_filter_sub_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>').trigger('change.select2');
            $('#production_list_filter_sub2_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>').trigger('change.select2');
            if (typeof productions_table !== 'undefined' && productions_table) { productions_table.ajax.reload(); }
            if (typeof reverse_productions_table !== 'undefined' && reverse_productions_table) { reverse_productions_table.ajax.reload(); }
        });

        _productionRestoreFilters();
        // ─────────────────────────────────────────────────────────────────────

        //Purchase table
	    productions_table = $('#productions_table').DataTable({
	        processing: true,
	        serverSide: true,
	        scrollX: true,
	        aaSorting: [[1, 'desc']],
	        ajax: {
	            url: '<?php echo e(action([\Modules\Manufacturing\Http\Controllers\ProductionController::class, 'index']), false); ?>',
	            "data": function ( d ) {
	                if($('#production_list_filter_date_range').val()) {
	                    var start = $('#production_list_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
	                    var end = $('#production_list_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
	                    d.start_date = start;
	                    d.end_date = end;
	                }
	                d.location_id = $('#productstion_list_filter_location_id').val();
	                if($('#production_list_is_final').is(':checked')) {
                        d.is_final = 1;
                    }
                    d.production_status = $('#production_list_filter_status').val();                    d.category_id = $('#production_list_filter_category_id').val();
                    d.sub_category_id = $('#production_list_filter_sub_category_id').val();
                    d.sub2_category_id = $('#production_list_filter_sub2_category_id').val();                    d.show_deleted = $('#show_deleted').is(':checked');
	                d = __datatable_ajax_callback(d);
	            },
	        },
	        columnDefs: [
	            {
	                targets: [0],
	                orderable: false,
	                searchable: false,
	            },
	        ],
	        columns: [
	            { data: 'action', name: 'action' },
	            { data: 'transaction_date', name: 'transaction_date' },
	            { data: 'ref_no', name: 'ref_no' },
	            { data: 'product_name', name: 'product_name' },
	            { data: 'quantity', searchable: false, className: 'text-right' },
	            { data: 'mfg_status', name: 'mfg_production_status' },
	            { data: 'mfg_priority_badge', name: 'mfg_priority', searchable: false },
	            { data: 'final_total', name: 'final_total', className: 'text-right' },
	            { data: 'selling_price', name: 'selling_price', searchable: false, orderable: false, className: 'text-right' },
	            { data: 'created_by_name', name: 'cr.first_name' },
	            { data: 'location_name', name: 'bl.name' },
	        ],
	        fnDrawCallback: function(oSettings) {
	            __currency_convert_recursively($('#productions_table'));
	        },
	        footerCallback: function(row, data, start, end, display) {
	            var total_cost = 0;
	            var total_selling = 0;
	            for (var r in data) {
	                total_cost += $(data[r].final_total).data('orig-value') ? parseFloat($(data[r].final_total).data('orig-value')) : 0;
	                total_selling += $(data[r].selling_price).data('orig-value') ? parseFloat($(data[r].selling_price).data('orig-value')) : 0;
	            }
	            $('.footer_total_cost').html(__currency_trans_from_en(total_cost));
	            $('.footer_total_selling_price').html(__currency_trans_from_en(total_selling));
	        }
	    });

        //Reverse Purchase table
	    reverse_productions_table = $('#reverse_productions_table').DataTable({
	        processing: true,
	        serverSide: true,
	        aaSorting: [[0, 'desc']],
	        ajax: {
	            url: '<?php echo e(action([\Modules\Manufacturing\Http\Controllers\ReverseProductionController::class, 'index']), false); ?>',
	            "data": function ( d ) {
	                if($('#production_list_filter_date_range').val()) {
	                    var start = $('#production_list_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
	                    var end = $('#production_list_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
	                    d.start_date = start;
	                    d.end_date = end;
	                }
	                d.location_id = $('#productstion_list_filter_location_id').val();
	                if($('#production_list_is_final').is(':checked')) {
                        d.is_final = 1;
                    }
                    d.category_id = $('#production_list_filter_category_id').val();
                    d.sub_category_id = $('#production_list_filter_sub_category_id').val();
                    d.sub2_category_id = $('#production_list_filter_sub2_category_id').val();
                    d.show_deleted = $('#show_deleted').is(':checked');
	                d = __datatable_ajax_callback(d);
	            },
	        },
	        columnDefs: [
	            {
	                targets: [6],
	                orderable: false,
	                searchable: false,
	            },
	        ],
	        columns: [
	            { data: 'transaction_date', name: 'transaction_date' },
	            { data: 'ref_no', name: 'ref_no' },
	            { data: 'location_name', name: 'bl.name' },
	            { data: 'product_name', name: 'product_name' },
	            { data: 'quantity', searchable: false },
	            { data: 'final_total', name: 'final_total' },
	            { data: 'action', name: 'action' },
	        ],
	        fnDrawCallback: function(oSettings) {
	            __currency_convert_recursively($('#reverse_productions_table'));
	        }
	    });

	    $(document).on('change', '#production_list_filter_date_range, #productstion_list_filter_location_id',  function() {
        	productions_table.ajax.reload();
            reverse_productions_table.ajax.reload();
    	});
    	$('#production_list_is_final').on('change', function(event){
            productions_table.ajax.reload();
            reverse_productions_table.ajax.reload();
        });
        $('#production_list_filter_status').on('change', function(event){
            productions_table.ajax.reload();
        });        // Category cascade filters for production
        $(document).on('change', '#production_list_filter_category_id', function() {
            var cat_id = $(this).val();
            $('#production_list_filter_sub_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
            $('#production_list_filter_sub2_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
            if (cat_id) {
                $.ajax({
                    method: 'POST',
                    url: '/products/get_sub_categories',
                    dataType: 'html',
                    data: { cat_id: cat_id },
                    success: function(result) {
                        $('#production_list_filter_sub_category_id').append(result);
                    },
                });
            }
            if (typeof productions_table !== 'undefined' && productions_table) { productions_table.ajax.reload(); }
            if (typeof reverse_productions_table !== 'undefined' && reverse_productions_table) { reverse_productions_table.ajax.reload(); }
        });
        $(document).on('change', '#production_list_filter_sub_category_id', function() {
            var cat_id = $(this).val();
            $('#production_list_filter_sub2_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
            if (cat_id) {
                $.ajax({
                    method: 'POST',
                    url: '/products/get_sub_categories',
                    dataType: 'html',
                    data: { cat_id: cat_id },
                    success: function(result) {
                        $('#production_list_filter_sub2_category_id').append(result);
                    },
                });
            }
            if (typeof productions_table !== 'undefined' && productions_table) { productions_table.ajax.reload(); }
            if (typeof reverse_productions_table !== 'undefined' && reverse_productions_table) { reverse_productions_table.ajax.reload(); }
        });
        $(document).on('change', '#production_list_filter_sub2_category_id', function() {
            if (typeof productions_table !== 'undefined' && productions_table) { productions_table.ajax.reload(); }
            if (typeof reverse_productions_table !== 'undefined' && reverse_productions_table) { reverse_productions_table.ajax.reload(); }
        });        $('#show_deleted').on('change', function(event){
            productions_table.ajax.reload();
            recipe_table.ajax.reload();
            reverse_productions_table.ajax.reload();
        });
        $('#recipe_filter_category_id').on('change', function() {
            var cat_id = $(this).val();
            $('#recipe_filter_sub_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
            $('#recipe_filter_sub2_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
            if (cat_id) {
                $.ajax({
                    method: 'POST',
                    url: '/products/get_sub_categories',
                    dataType: 'html',
                    data: { cat_id: cat_id },
                    success: function(result) {
                        $('#recipe_filter_sub_category_id').append(result);
                    },
                });
            }
            recipe_table.ajax.reload();
        });
        $('#recipe_filter_sub_category_id').on('change', function() {
            var cat_id = $(this).val();
            $('#recipe_filter_sub2_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
            if (cat_id) {
                $.ajax({
                    method: 'POST',
                    url: '/products/get_sub_categories',
                    dataType: 'html',
                    data: { cat_id: cat_id },
                    success: function(result) {
                        $('#recipe_filter_sub2_category_id').append(result);
                    },
                });
            }
            recipe_table.ajax.reload();
        });
        $('#recipe_filter_sub2_category_id').on('change', function() {
            recipe_table.ajax.reload();
        });

        // ── Recipe filter: Save / Reset ──────────────────────────────────────
        var _recipeFilterKey = 'recipe_filters_<?php echo e(auth()->id(), false); ?>';

        function _recipeRestoreFilters(callback) {
            var saved = null;
            try { saved = JSON.parse(localStorage.getItem(_recipeFilterKey)); } catch(e) {}
            if (!saved) { if (callback) callback(); return; }

            if (saved.category_id) {
                $('#recipe_filter_category_id').val(saved.category_id).trigger('change.select2');
            }

            if (saved.sub_category_id) {
                var subEl = $('#recipe_filter_sub_category_id');
                subEl.append('<option value="' + $('<div>').text(saved.sub_category_id).html() + '">' + $('<div>').text(saved.sub_text || saved.sub_category_id).html() + '</option>');
                subEl.val(saved.sub_category_id).trigger('change.select2');
            }

            if (saved.sub2_category_id) {
                var sub2El = $('#recipe_filter_sub2_category_id');
                sub2El.append('<option value="' + $('<div>').text(saved.sub2_category_id).html() + '">' + $('<div>').text(saved.sub2_text || saved.sub2_category_id).html() + '</option>');
                sub2El.val(saved.sub2_category_id).trigger('change.select2');
            }

            if (callback) callback();
        }

        $('#recipe_filter_save').on('click', function() {
            var cat  = $('#recipe_filter_category_id');
            var sub  = $('#recipe_filter_sub_category_id');
            var sub2 = $('#recipe_filter_sub2_category_id');
            var data = {
                category_id:     cat.val()  || '',
                sub_category_id: sub.val()  || '',
                sub2_category_id: sub2.val() || '',
                sub_text:  sub.find('option:selected').text()  || '',
                sub2_text: sub2.find('option:selected').text() || '',
            };
            localStorage.setItem(_recipeFilterKey, JSON.stringify(data));
            toastr.success('<?php echo e(__("lang_v1.success"), false); ?>');
        });

        $('#recipe_filter_reset').on('click', function() {
            localStorage.removeItem(_recipeFilterKey);
            $('#recipe_filter_category_id').val('').trigger('change.select2');
            $('#recipe_filter_sub_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>').trigger('change.select2');
            $('#recipe_filter_sub2_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>').trigger('change.select2');
            recipe_table.ajax.reload();
        });

        _recipeRestoreFilters();
        // ────────────────────────────────────────────────────────────────────

    	recipe_table = $('#recipe_table').DataTable({
	        processing: true,
	        serverSide: true,
	        scrollX: true,
	        ajax: {
	            url: '<?php echo e(action([\Modules\Manufacturing\Http\Controllers\RecipeController::class, 'index']), false); ?>',
	            "data": function ( d ) {
                    d.show_deleted = $('#show_deleted').is(':checked');
                    d.category_id = $('#recipe_filter_category_id').val();
                    d.sub_category_id = $('#recipe_filter_sub_category_id').val();
                    d.sub2_category_id = $('#recipe_filter_sub2_category_id').val();
	            },
	        },
            columnDefs: [
	            {
	                targets: [0, 6, 7, 8],
	                orderable: false,
	                searchable: false,
	            },
	        ],
	        "order": [[ 1, "desc" ]],
	        columns: [
	        	{ data: 'row_select' },
	            { data: 'recipe_name', name: 'recipe_name' },
	            { data: 'category', name: 'c.name' },
	            { data: 'sub_category', name: 'sub_category' },
	            { data: 'sub2_category', name: 'sub2_category' },
	            { data: 'total_quantity', name: 'total_quantity', className: 'text-right' },
	            { data: 'recipe_total', className: 'text-right' },
	            { data: 'unit_cost', className: 'text-right' },
	            { data: 'action', name: 'action' },
	        ],
	        fnDrawCallback: function(oSettings) {
	            __currency_convert_recursively($('#recipe_table'));
	        },
	    });

        calculateRecipeTotal();
	
    });

	$(document).on('shown.bs.modal', '#recipe_modal', function(){
		initSelect2($(this).find('#variation_id'), $('#recipe_modal'));
        $(this).find('#copy_recipe_id').select2({
            dropdownParent: $('#recipe_modal')
        });
	});

	$(document).on('shown.bs.modal', '.view_modal', function(){
		__currency_convert_recursively($('.view_modal'));
	});

	$(document).on('change', '.quantity, .row_sub_unit_id, #total_quantity, #extra_cost, #sub_unit_id, #production_cost_type', function(){
		calculateRecipeTotal();
	});

    async function addIngredientRow(variation_id, search_element) {
    	var row_index = parseInt($('#row_index').val());
    	var ingredient_group = search_element.closest('.box').find('.ingredient_group');
        var row_ig_index = ingredient_group.length ? ingredient_group.data('ig_index') : '';
        var sort_order = ++(search_element.closest('.box').find('.ingredient-row-sortable').children().length);

         $.ajax({
            url: base_path + "/manufacturing/get-ingredient-row/" + variation_id + '?row_index=' + row_index + '&row_ig_index=' + row_ig_index + '&sort_order=' + sort_order,
            dataType: 'html',
            success: await function(result) {
                search_element.closest('.box').find('table.ingredients_table tbody').append(result);
                row_index++;
                $('#row_index').val(row_index);
                calculateRecipeTotal();
            },
        });
    }

	function calculateRecipeTotal() {
    var total = 0;
    var totalQuantity = 0;
    var ingredient_pl = [];
	$('.ingredients_table tbody tr').each( function() {
        var line_unit_price = $(this).find('.ingredient_price').val();        
        var quantity = __read_number($(this).find('.quantity'));
        var multiplier = 1;
        if ($(this).find('.row_sub_unit_id').length) {
            multiplier = parseFloat(
                $(this).find('.row_sub_unit_id')
                    .find(':selected')
                    .data('multiplier')
            );
        }

        $(this).find('.ingredient_pl').each(function(index) {
            let pl_qty = $(this).data('quantity');
            let pl_price = $(this).data('price');   
            ingredient_pl.push({ quantity: pl_qty, price: pl_price });
        });

        var line_total = 0;
        if(ingredient_pl.length > 0){
            let remainingQuantity = quantity;
            let last_price = 0;
            // Iterate through each purchase line
            for (let i = 0; i < ingredient_pl.length; i++) {
                let availableQuantity = Math.min(ingredient_pl[i].quantity, remainingQuantity);
                last_price = ingredient_pl[i].price;
                
                // Calculate the price for the available quantity
                line_total += availableQuantity * parseFloat(ingredient_pl[i].price) * multiplier;
                
                // Update the remaining quantity
                remainingQuantity -= availableQuantity;
                
                // If remaining quantity becomes zero, break the loop
                if (remainingQuantity === 0) {
                    break;
                }
            }
            //if user input over the available quantity use the last price
            if(remainingQuantity !== 0){
                line_total += last_price * remainingQuantity * multiplier; 
            }

            $(this).find('span.ingredient_price').text(__currency_trans_from_en(line_total, true));
            total += line_total;
            totalQuantity += quantity * multiplier;
            
        }else{
            line_total = line_unit_price * quantity * multiplier;
            $(this).find('span.ingredient_price').text(__currency_trans_from_en(line_total, true));
            total += line_total;
            totalQuantity += quantity * multiplier;
        }
        ingredient_pl = [];
    });

    // Update the ingredients quantity
    $('span#ingredients_quantity_text').text(__currency_trans_from_en(totalQuantity, false));
    $('#ingredients_quantity').val(totalQuantity);

    // Update the ingredients cost
    $('span#ingredients_cost_text').text(__currency_trans_from_en(total, true));
    $('#ingredients_cost').val(total);

    var production_cost = __read_number($('#extra_cost'));
    var production_cost_type = $('#production_cost_type').val();
    if (production_cost_type == 'percentage') {
        production_cost = __calculate_amount('percentage', production_cost, total);
    } else if(production_cost_type == 'per_unit') {
        var totalQuantity = __read_number($('#total_quantity'));
        production_cost = totalQuantity * production_cost;
    }

    $('span#total_production_cost').text(__currency_trans_from_en(production_cost, true));

    total += production_cost;
    __write_number($('#total'), total);
    }

	function initSelect2(element, dropdownParent = $('body')) {
		element.select2({
	        ajax: {
	            url: base_path + '/products/list',
	            dataType: 'json',
	            delay: 250,
	            data: function(params) {
	                return {
	                    term: params.term, // search term
	                    'product_types[]': ['single', 'variable'],
	                };
	            },
	            processResults: function(data) {
	            	return {
			            results: $.map(data, function (value, key) {
			            	var name = value.type == 'variable' ? value.name + ' - ' + value.variation : value.name;
			            	name += ' (' + value.sub_sku + ')';
			                return {
			                    id: value.variation_id,
			                    text: name
			                }
			            })
			        };
	            },
	        },
	        minimumInputLength: 1,
	        escapeMarkup: function(markup) {
	            return markup;
	        },
	        dropdownParent: dropdownParent
	    });
	}

	$(document).on('click', 'button.remove_ingredient', function() {
        
        element = $(this).closest('tbody.ingredient-row-sortable');

		$(this).closest('tr').remove();

        //set the order of ingredient
        $(element).children().each(function(index) {
            $(this).find('input.sort_order').val(++index)
        });

		calculateRecipeTotal();
	});
    
	$(document).on('submit', '#recipe_form', function (e) {
		// Validation for ingredients length removed to allow saving without ingredients
	});

	$(document).on('click', 'button#add_ingredient_group', function() {
		var ig_index = parseInt($('#ig_index').val());
    	$.ajax({
            url: base_path + "/manufacturing/ingredient-group-form" + '?ig_index=' + ig_index,
            dataType: 'html',
            success: function(result) {
            	var el = $(result);
                $('#box_group').append(el);
                initialize_search(el.find('.search_product'));
                el.find('.ingredient_group').focus();
                ig_index++;
                $('#ig_index').val(ig_index);
            },
        });
	});

	function initialize_search(element) {
        if (element.data('ui-autocomplete')) {
            return;
        }

		// element.autocomplete({
        //     source: function(request, response) {
        //         $.getJSON(
        //             '/products/list',
        //             {
        //                 term: request.term,
        //                 product_types: ['single', 'variable']
        //             },
        //             response
        //         );
        //     },
        //     minLength: 2,
        //     response: function(event, ui) {
        //         if (ui.content.length == 0) {
        //             toastr.error(LANG.no_products_found);
        //             $('input#search_product').select();
        //         }
        //     },
        //     select: function(event, ui) {
        //         addIngredientRow(ui.item.variation_id, $(this));
        //     },
        // }).autocomplete('instance')._renderItem = function(ul, item) {
	    //     var string = '<li>' + item.name;
        //     if (item.type == 'variable') {
        //         string += '-' + item.variation;
        //     }
        //     string +=
        //         ' (' +
        //         item.sub_sku +
        //         ')' +
        //         '</li>';
        //     return $(string).appendTo(ul);
        // }
        element.autocomplete({
                source: function(request, response) {
                    $.getJSON(
                        base_path + '/purchases/get_products',
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
                    addIngredientRow(ui.item.variation_id, $(this));
                },
            })
            .autocomplete('instance')._renderItem = function(ul, item) {
            return $('<li>')
                .append('<div>' + item.text + '</div>')
                .appendTo(ul);
        };
	}
	$(document).on('click', 'button.remove_ingredient_group', function() {
	$(this).closest('.box').remove();
	calculateRecipeTotal();
});

$(document).on('click', '#mass_update_product_price', function(e){
    e.preventDefault();
    var selected_rows = [];
    var unit_prices = [];
    var i = 0;
    $('.row-select:checked').each(function () {
    	var recipe_id = $(this).val();
        selected_rows[i++] = recipe_id;
        unit_prices[recipe_id] = $(this).closest('tr').find('span.unit_cost').data('unit_cost');
    });
    
    if(selected_rows.length > 0){
        swal({
            title: LANG.sure,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var data = {
                	recipe_ids: selected_rows,
                	unit_prices: unit_prices
                }
                $.ajax({
                    method: "post",
                    url: "/manufacturing/update-product-prices",
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if (result.success == true) {
                            toastr.success(result.msg);
                            recipe_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            }
        });
    } else{
        swal('<?php echo app('translator')->get("lang_v1.no_row_selected"); ?>');
    }    
});
$(document).on('click', 'button.delete_recipe, a.delete_recipe', function(e) {
    e.preventDefault();
    swal({
        title: LANG.sure,
        icon: 'warning',
        buttons: true,
        dangerMode: true,
    }).then(willDelete => {
        if (willDelete) {
            var href = $(this).data('href');
            var data = $(this).serialize();
            $.ajax({
                method: 'DELETE',
                url: href,
                dataType: 'json',
                data: data,
                success: function(result) {
                    if (result.success == true) {
                        toastr.success(result.msg);
                        recipe_table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                },
            });
        }
    });
});

$(document).on('click', 'button.restore_recipe', function() {
    swal({
        title: LANG.sure,
        icon: 'info',
        buttons: true,
    }).then(willDelete => {
        if (willDelete) {
            var href = $(this).data('href');
            var data = $(this).serialize();
            $.ajax({
                method: 'GET',
                url: href,
                dataType: 'json',
                data: data,
                success: function(result) {
                    if (result.success == true) {
                        toastr.success(result.msg);
                        recipe_table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                },
            });
        }
    });
});

$(document).on('click', '.delete-production', function(e) {
	e.preventDefault();
    swal({
        title: LANG.sure,
        icon: 'warning',
        buttons: true,
        dangerMode: true,
    }).then(willDelete => {
        if (willDelete) {
            var href = $(this).data('href');
            var data = $(this).serialize();
            $.ajax({
                method: 'DELETE',
                url: href,
                dataType: 'json',
                data: data,
                success: function(result) {
                    if (result.success == true) {
                        toastr.success(result.msg);
                        productions_table.ajax.reload();
                        reverse_productions_table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                },
            });
        }
    });
});

$(document).on('change', '#choose_product_form #variation_id', function() {
    var variation_id = $(this).val();
    if (variation_id) {
        $.ajax({
            method: 'get',
            url: base_path + "/manufacturing/is-recipe-exist/" + variation_id,
            dataType: 'json',
            success: function(result) {
                if (result == 1) {
                    $('#choose_product_form #recipe_selection').addClass('hide');
                } else {
                    $('#choose_product_form #recipe_selection').removeClass('hide');
                }
            },
        });
    } else {
        $('#choose_product_form #recipe_selection').removeClass('hide');
    }
})

$(document).on('click', '#open_products_search_modal', function(){
    $.ajax({
        url: base_path + '/products/products-search',
        dataType: 'html',
        success: function(result) {
            $('#products_search_modal').html(result);
            $('#products_search_modal').modal('show');
            setTimeout(() => {
                $('#products_search_text').trigger('click'); 
            }, 1000);     
        },
    });
});

$(document).on('change',
    '#product_search_filter_type, #product_search_filter_category_id, #product_search_filter_brand_id, #product_search_filter_unit_id',
    function() {
        product_search_table.ajax.reload();
    });

$(document).on('input','#products_search_text', function(){
    if($(this).val().length > 2 || $(this).val().length == 0){
        setTimeout(() => {
            // product_search_table.ajax.reload();
            product_search_table.search($(this).val()).draw();
        }, 1000);
    }
});

$(document).on('click', '#ps_show_product_qty_details', function(e){
    e.preventDefault();
    if($('#products_search_results .ps-row-select:checked').length){
        
        if($('#products_search_results .ps-row-select:checked').length > 1){
            toastr.warning('Multiple Products Selected - Showing Qty of First Selected Product');
        }
        
        let variation_id = $('#products_search_results .ps-row-select:checked').first().val();
        
        $.ajax({
            url: base_path + '/products/qty-detail',
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

// ── Production Status Change (inline badge click) ─────────────────────────
$(document).on('click', '.change-prod-status', function() {
    var id = $(this).data('id');
    var status = $(this).data('status');
    $('#prod_status_change_id').val(id);
    $('#prod_status_new_status').val(status);
    $('#production_status_modal').modal('show');
});

$(document).on('click', '#prod_status_save_btn', function() {
    var id = $('#prod_status_change_id').val();
    var new_status = $('#prod_status_new_status').val();
    if (!id || !new_status) {
        toastr.error('<?php echo e(__("messages.something_went_wrong"), false); ?>');
        return;
    }
    var btn = $(this);
    btn.prop('disabled', true);
    $.ajax({
        method: 'POST',
        url: '/manufacturing/production/' + id + '/update-status',
        dataType: 'json',
        data: {
            mfg_production_status: new_status,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(result) {
            btn.prop('disabled', false);
            if (result.success) {
                toastr.success(result.msg);
                $('#production_status_modal').modal('hide');
                if (typeof productions_table !== 'undefined' && productions_table) {
                    productions_table.ajax.reload();
                }
            } else {
                toastr.error(result.msg);
            }
        },
        error: function() {
            btn.prop('disabled', false);
            toastr.error('<?php echo e(__("messages.something_went_wrong"), false); ?>');
        }
    });
});
</script>
