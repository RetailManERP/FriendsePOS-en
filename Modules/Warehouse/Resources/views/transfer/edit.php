
<?php $__env->startSection('title', __('warehouse::lang.edit_transfer')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('warehouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('warehouse::lang.edit_transfer'); ?> - <?php echo e($sell_transfer->ref_no, false); ?></h1>
</section>

<section class="content">
    
    <input type="hidden" id="page_type" value="purchase">
    
    <input type="hidden" id="wh_transfer_page" value="1">
    <?php echo Form::open(['route' => ['warehouse.transfers.update', $sell_transfer->id], 'method' => 'PUT', 'id' => 'warehouse_transfer_form']); ?>


    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('location_id', __('warehouse::lang.source_warehouse') . ':*'); ?>

                    <?php echo Form::select('location_id', $locations, $source_location_id, ['class' => 'form-control select2', 'required', 'placeholder' => __('messages.please_select'), 'id' => 'location_id']); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('transfer_location_id', __('warehouse::lang.destination_warehouse') . ':*'); ?>

                    <?php echo Form::select('transfer_location_id', $locations, $destination_location_id, ['class' => 'form-control select2', 'required', 'placeholder' => __('messages.please_select'), 'id' => 'transfer_location_id']); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('priority', __('warehouse::lang.priority') . ':'); ?>

                    <?php echo Form::select('priority', [
                        'low' => __('warehouse::lang.priority_low'),
                        'normal' => __('warehouse::lang.priority_normal'),
                        'high' => __('warehouse::lang.priority_high'),
                        'urgent' => __('warehouse::lang.priority_urgent'),
                    ], $sell_transfer->sub_status, ['class' => 'form-control select2']); ?>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('expected_date', __('warehouse::lang.expected_date') . ':'); ?>

                    <?php echo Form::text('expected_date',  \Carbon::createFromTimestamp(strtotime($sell_transfer->delivery_date))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'id' => 'transaction_date_text']); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('shipping_method', __('warehouse::lang.shipping_method') . ':'); ?>

                    <?php echo Form::text('shipping_method', $sell_transfer->shipping_details, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('status', __('warehouse::lang.transfer_status') . ':'); ?>

                    <?php echo Form::select('status', [
                        'draft' => __('warehouse::lang.status_draft'),
                        'pending' => __('warehouse::lang.status_pending'),
                        'in_transit' => __('warehouse::lang.status_in_transit'),
                        'partial' => __('warehouse::lang.status_partial'),
                        'completed' => __('warehouse::lang.status_completed'),
                        'cancelled' => __('warehouse::lang.status_cancelled'),
                    ], $sell_transfer->status == 'final' ? 'completed' : $sell_transfer->status, ['class' => 'form-control']); ?>

                </div>
            </div>
        </div>
        <?php if(!empty($pos_settings['allow_overselling'])): ?>
            <input type="hidden" id="is_overselling_allowed">
        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>

    
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('stock_adjustment.search_products')]); ?>
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <div class="form-group">
                    <div class="input-group">
                        <button type="button" class="btn btn-secondary btn-flat" id="wh_open_products_search_modal" title="<?php echo e(__('lang_v1.products_search'), false); ?>"><i class="fas fa-search"></i></button>
                        <?php echo Form::text('search_product', null, ['class' => 'form-control', 'id' => 'wh_search_product', 'placeholder' => __('stock_adjustment.search_product_trasfer')]); ?>

                    </div>
                </div>
            </div>
        </div>

        <?php
			$is_admin = auth()->user()->hasRole('Admin#'.auth()->user()->business_id);
			$hide_brand = '';
			$colspan = '7';
			if (empty($user_settings['stock_transfer_show_brand_column']) && !$is_admin) {
				$colspan = '6';
				$hide_brand = 'hide';
			}
			if(empty(session('business.enable_brand'))){
				$hide_brand = 'hide';
				$colspan = '6';
			}
			$hide_category = '';
			if (empty($user_settings['stock_transfer_show_category_column']) && !$is_admin) {
				$hide_category = 'hide';
				$colspan = '6';
			}
			if(empty(session('business.enable_category'))){
				$hide_category = 'hide';
				$colspan = '6';
			}
			$hide_price = '';
			if (empty($user_settings['stock_transfer_show_price_column']) && !$is_admin) {
				$hide_price = 'hide';
			}

            $check_qty = !empty($pos_settings['allow_overselling']) ? false : true;
            $product_row_index = 0;
            $subtotal = 0;
		?>
        <div class="row">
				<div class="col-sm-12 sell_product_div">
					<input type="hidden" id="product_row_index" value="0">
					<input type="hidden" id="total_amount" name="final_total" value="0">
					<div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
					<table class="table table-bordered table-striped table-condensed table-th-skin" id="stock_transfer_product_table">
						<thead>
							<tr>
								<th class="text-nowrap" style="width:1%; min-width:30px">#</th>
								<th class="text-nowrap" style="width:1%; min-width:50px">	
									<?php echo app('translator')->get('product.sku'); ?>
								</th>	
								<th class="text-nowrap" style="width:100%">	
									<?php echo app('translator')->get('sale.product'); ?>
								</th>
								<th class="text-nowrap <?php echo e($hide_brand, false); ?>">	
									<?php echo app('translator')->get('product.brand'); ?>
								</th>
								<th class="text-nowrap <?php echo e($hide_category, false); ?>">	
									<?php echo app('translator')->get('product.category'); ?>
								</th>
								<th class="text-nowrap" style="width:1%">
									<?php echo app('translator')->get('sale.qty'); ?>
								</th>
								<th class="text-nowrap text-end <?php echo e($hide_price, false); ?>">
									<?php echo app('translator')->get('sale.unit_price'); ?> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span>
								</th>
								<th class="text-nowrap text-end <?php echo e($hide_price, false); ?>">
									<?php echo app('translator')->get('sale.subtotal'); ?> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span>
								</th>
								<th class="text-nowrap" style="width:1%; min-width:30px"><i class="fa fa-trash" aria-hidden="true"></i></th>
							</tr>
						</thead>
						<tbody>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('stock_transfer.partials.product_table_row', ['product' => $product, 'row_index' => $loop->index, 'sub_units' => !empty($product->unit_details) ? $product->unit_details : [], 'user_settings'=> $user_settings, 'is_admin'=> $is_admin, 'purchase_lines' => $product->purchase_lines ?? collect()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php
                                    $product_row_index = $loop->index + 1;
                                    $subtotal += ($product->quantity_ordered * $product->last_purchased_price);
                                ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
						<tfoot>
						<?php if(!empty($user_settings['stock_transfer_show_price_column']) || $is_admin): ?>
							<tr class="text-center">
								<td colspan="<?php echo e($colspan, false); ?>"></td>
								<td><div class="float-end"><b><?php echo app('translator')->get('sale.total'); ?>:</b> <span id="total_adjustment"><?php echo e(number_format($subtotal, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span></div>
								</td>
							</tr>
						<?php endif; ?>
						</tfoot>
					</table>
					</div>
				</div>
			</div>

        <div class="row">
            <div class="col-md-12 text-end">
                <b><?php echo app('translator')->get('warehouse::lang.total_products'); ?>:</b> <span id="wh_total_products">0</span> &nbsp; | &nbsp;
                <b><?php echo app('translator')->get('warehouse::lang.total_quantity'); ?>:</b> <span id="wh_total_quantity">0</span>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo Form::label('notes', __('warehouse::lang.warehouse_notes') . ':'); ?>

                <?php echo Form::textarea('notes', $sell_transfer->additional_notes, ['class' => 'form-control', 'rows' => 2]); ?>

            </div>
        </div>
    </div>
    <input type="hidden" id="print_after_save" name="print_after_save" value="0">

    <?php echo Form::close(); ?>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function() {

    // Set initial product row index from pre-populated products
    $('#product_row_index').val(<?php echo e($product_row_index, false); ?>);

    // Helper: extract numeric ID from prefixed location value (BL_60 -> 60, WH_50 -> 50)
    function getLocationId(val) {
        if (!val) return '';
        return val.replace(/^(BL_|WH_)/, '');
    }

    // Enable product search only when source is selected
    $('select#location_id').change(function() {
        if ($(this).val()) {
            $('#wh_search_product').removeAttr('disabled');
        } else {
            $('#wh_search_product').attr('disabled', 'disabled');
        }
        // Clear product table when source changes
        $('table#stock_transfer_product_table tbody').html('');
        $('#product_row_index').val(0);
        update_table_sr_number();
        update_table_total();
    });

    //Date picker
    $('#transaction_date_text').datetimepicker({
        format: moment_date_format + ' ' + moment_time_format,
        ignoreReadonly: true,
    });

    //Add Product
        $('#wh_search_product')
            .autocomplete({
                source: function (request, response) {
                    $.getJSON(
                        '/products/list',
                        { location_id: getLocationId($('#location_id').val()), term: request.term, product_types: ['single', 'variable'] },
                        response
                    );
                },
                minLength: 2,
                response: function (event, ui) {
                    if (ui.content.length == 1) {
                        var is_overselling_allowed = false;
                        if ($('input#is_overselling_allowed').length) {
                            is_overselling_allowed = true;
                        }
                        ui.item = ui.content[0];
                        if ((ui.item.qty_available > 0 && ui.item.enable_stock == 1) || is_overselling_allowed) {
                            $(this)
                                .data('ui-autocomplete')
                                ._trigger('select', 'autocompleteselect', ui);
                            $(this).autocomplete('close');
                        }
                    } else if (ui.content.length == 0) {
                        swal(LANG.no_products_found);
                    }
                },
                focus: function (event, ui) {
                    if (ui.item.qty_available <= 0) {
                        return false;
                    }
                },
                select: function (event, ui) {
                    var is_overselling_allowed = false;
                    if ($('input#is_overselling_allowed').length) {
                        is_overselling_allowed = true;
                    }
                    if (ui.item.qty_available > 0 || is_overselling_allowed) {
                        $(this).val(null);
                        stock_transfer_product_row(ui.item.variation_id);
                    } else {
                        alert(LANG.out_of_stock);
                    }
                },
            })
            .autocomplete('instance')._renderItem = function (ul, item) {
                var is_overselling_allowed = false;
                if ($('input#is_overselling_allowed').length) {
                    is_overselling_allowed = true;
                }
                if (item.qty_available <= 0 && !is_overselling_allowed) {
                    var string = '<li class="ui-state-disabled">' + item.name;
                    if (item.type == 'variable') {
                        string += '-' + item.variation;
                    }
                    string += ' (' + item.sub_sku + ') (Out of stock) </li>';
                    return $(string).appendTo(ul);
                } else if (item.enable_stock != 1) {
                    return ul;
                } else {
                    var string = '<div>' + item.name;
                    if (item.type == 'variable') {
                        string += '-' + item.variation;
                    }
                    string += ' (' + item.sub_sku + ') </div>';
                    return $('<li>')
                        .append(string)
                        .appendTo(ul);
                }
            };
            // Prevent form submit on Enter in search box
        $('#wh_search_product').keydown(function(e) {
            if (e.keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });

        $(document).on('change', 'input.product_quantity', function () {
            update_table_row($(this).closest('tr'));
        });
        $(document).on('change', 'input.product_unit_price', function () {
            $(this).closest('tr').find('.hidden_base_unit_price').val($(this).val());
            update_table_row($(this).closest('tr'));
        });

        $(document).on('click', '.remove_product_row', function () {
            swal({
                title: LANG.sure,
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(willDelete => {
                if (willDelete) {
                    $(this)
                        .closest('tr')
                        .remove();
                    update_table_total();
                    update_table_sr_number();
                }
            });
    });

    async function stock_transfer_product_row(variation_id) {
        var row_index = parseInt($('#product_row_index').val());
        $('#product_row_index').val(row_index + 1);

        var location_id = getLocationId($('select#location_id').val());
        $.ajax({
            method: 'POST',
            url: '/stock-adjustments/get_product_row',
            data: { row_index: row_index, variation_id: variation_id, location_id: location_id, type: 'stock_transfer' },
            dataType: 'html',
            success: await function (result) {
                $('table#stock_transfer_product_table tbody').append(result);
                var added_row = $('table#stock_transfer_product_table tbody tr.product_row').last();
                update_table_row(added_row);
                update_table_total();
                update_table_sr_number();
            },
        });
    }

    function update_table_total() {
        var table_total = 0;
        $('table#stock_transfer_product_table tbody tr').each(function () {
            var this_total = parseFloat(__read_number($(this).find('input.product_line_total')));
            if (this_total) {
                table_total += this_total;
            }
        });

        $('span#total_adjustment').text(__number_f(table_total));

        if ($('input#shipping_charges').length) {
            var shipping_charges = __read_number($('input#shipping_charges'));
            table_total += shipping_charges;
        }

        $('span#final_total_text').text(__number_f(table_total));
        $('input#total_amount').val(table_total);

        // Update warehouse total products and quantity counters
        var total_products = $('table#stock_transfer_product_table tbody tr.product_row').length;
        var total_qty = 0;
        $('table#stock_transfer_product_table tbody tr.product_row').each(function () {
            var qty = parseFloat(__read_number($(this).find('input.product_quantity')));
            if (qty) { total_qty += qty; }
        });
        $('#wh_total_products').text(total_products);
        $('#wh_total_quantity').text(__number_f(total_qty));
    }

    function update_table_sr_number() {
                var sr_number = 1;
                $('.sr_number')
                    .each(function () {
                        $(this).text(sr_number);
                        sr_number++;
                    });

            }

            $(document).on('change', 'select.sub_unit', function () {
            var tr = $(this).closest('tr');
            var selected_option = $(this).find(':selected');
            var multiplier = parseFloat(selected_option.data('multiplier'));
            var allow_decimal = parseInt(selected_option.data('allow_decimal'));
            tr.find('input.base_unit_multiplier').val(multiplier);

            var base_unit_price = tr.find('input.hidden_base_unit_price').val();

            var unit_price = base_unit_price * multiplier;
            var unit_price_element = tr.find('input.product_unit_price');
            __write_number(unit_price_element, unit_price);

            var qty_element = tr.find('input.product_quantity');
            var base_max_avlbl = qty_element.data('qty_available');
            var error_msg_line = 'pos_max_qty_error';

            if (tr.find('select.lot_number').length > 0) {
                var lot_select = tr.find('select.lot_number');
                if (lot_select.val()) {
                    base_max_avlbl = lot_select.find(':selected').data('qty_available');
                    error_msg_line = 'lot_max_qty_error';
                }
            }
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
            qty_element.valid();
            update_table_row($(this).closest('tr'));
        });

        function update_table_row(tr) {
            var quantity = parseFloat(__read_number(tr.find('input.product_quantity')));
            var multiplier = 1;

            if (tr.find('select.sub_unit').length) {
                multiplier = parseFloat(
                    tr.find('select.sub_unit')
                        .find(':selected')
                        .data('multiplier')
                );
            }
            var base_quantity = quantity * multiplier;

            // Collect purchase lines for FIFO pricing
            var stock_pl = [];
            tr.find('.stock_pl').each(function () {
                stock_pl.push({
                    quantity: parseFloat($(this).data('quantity')),
                    price: parseFloat($(this).data('price')),
                });
            });

            var row_total = 0;
            var unit_price;

            if (stock_pl.length > 0 && base_quantity > 0) {
                var remainingQuantity = base_quantity;
                var last_price = 0;
                for (var i = 0; i < stock_pl.length; i++) {
                    var availableQuantity = Math.min(stock_pl[i].quantity, remainingQuantity);
                    last_price = stock_pl[i].price;
                    row_total += availableQuantity * stock_pl[i].price;
                    remainingQuantity -= availableQuantity;
                    if (remainingQuantity === 0) break;
                }
                if (remainingQuantity !== 0) {
                    row_total += last_price * remainingQuantity;
                }
                unit_price = row_total / base_quantity;
                tr.find('input.hidden_base_unit_price').val(unit_price * multiplier);
                tr.find('input.product_unit_price').val(__number_f(unit_price * multiplier));
            } else {
                unit_price = parseFloat(tr.find('input.hidden_base_unit_price').val());
                if (base_quantity && unit_price) {
                    row_total = base_quantity * unit_price;
                }
            }

            tr.find('input.product_line_total').val(__number_f(row_total));
            update_table_total();
            update_table_sr_number();
        }

        //Product Search Screen Functonality for POS
        $(document).on('click', '#ps_select_products', function (e) {
            e.preventDefault();
            let search_enabled = ($('#wh_search_product').prop('disabled')) ? false : true;
            if (search_enabled) {
                if ($('#products_search_results .ps-row-select:checked').length) {
                    $('#products_search_results .ps-row-select:checked').each(function () {
                        stock_transfer_product_row($(this).val());
                    });
                    $('#products_search_modal').modal('hide');

                } else if ($('#products_search_results .ps-row-select:focus').length) {
                    stock_transfer_product_row($('#products_search_results .ps-row-select:focus').val());
                    $('#products_search_modal').modal('hide');

                } else {
                    toastr.error('No products selected');
                }
            } else {
                toastr.error('Please Select Location');
            }
        });

        $(document).on('dblclick', '#products_search_results tbody tr', function () {
            let search_enabled = ($('#wh_search_product').prop('disabled')) ? false : true;
            if (search_enabled) {
                let variation_id = $(this).find('.ps-row-select').val();
                stock_transfer_product_row(variation_id);
                $('#products_search_modal').modal('hide');
            } else {
                toastr.error('Please Select Location');
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'F10') {
                event.preventDefault();
                if (keyBindingEnabled) {
                    keyBindingEnabled = false;
                    $('button#wh_open_products_search_modal').trigger('click');
                    setTimeout(() => {
                        keyBindingEnabled = true;
                    }, 1000);
                }
            }
        });

        $(document).on('keydown', '#wh_search_product', function (event) {
            if (event.key === 'Tab') {
                event.preventDefault();
                let lastElement = $('tr.product_row').find('input.product_quantity').last();
                if (lastElement.length) {
                    lastElement.click();
                } else {
                    $('#wh_search_product').focus();
                }
            }
        });
        $(document).on('keydown', '.product_row input[type=text]:last', function (event) {
            if (event.key === 'Tab') {
                event.preventDefault();
                $('#wh_search_product').focus();
            }
        });

        // Enter on quantity field -> focus back to search field
        $(document).on('keydown', '.product_row input.product_quantity', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                $('#wh_search_product').focus();
            }
        });

        // After product search modal closes, return focus to search field
        $(document).on('hidden.bs.modal', '#products_search_modal', function () {
            setTimeout(function () {
                $('#wh_search_product').focus();
            }, 100);
        });

        // Initialize totals and row calculations on page load
        $('table#stock_transfer_product_table tbody tr.product_row').each(function() {
            update_table_row($(this));
        });
        update_table_total();
        update_table_sr_number();

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>