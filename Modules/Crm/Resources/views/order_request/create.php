

<?php
	$title = __('crm::lang.add_order_request');
?>

<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e($title, false); ?></h1>
</section>
<!-- Main content -->
<section class="content no-print">
<input type="hidden" id="amount_rounding_method" value="<?php echo e($pos_settings['amount_rounding_method'] ?? '', false); ?>">
<?php if(count($business_locations) > 0): ?>
<div class="row">
	<div class="col-sm-3">
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-text">
					<i class="fa fa-map-marker"></i>
				</span>
			<?php echo Form::select('select_location_id', $business_locations, $default_location->id ?? null, ['class' => 'form-control input-sm',
			'id' => 'select_location_id', 
			'required', 'autofocus'], $bl_attributes); ?>

			<span class="input-group-text">
					<?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.sale_location') . '"></i>';
                }
            ?>
				</span> 
			</div>
		</div>
	</div>
</div>
<?php endif; ?>

<?php
	$custom_labels = json_decode(session('business.custom_labels'), true);
	// Phase 62: prefer controller-supplied per-branch overlay; session is the fallback.
	$common_settings = isset($common_settings) && ! empty($common_settings)
		? $common_settings
		: session()->get('business.common_settings');
?>
<input type="hidden" id="item_addition_method" value="<?php echo e($business_details->item_addition_method, false); ?>">
	<?php echo Form::open(['url' => action([\Modules\Crm\Http\Controllers\OrderRequestController::class, 'store']), 'method' => 'post', 'id' => 'add_sell_form', 'files' => true ]); ?>

	<input type="hidden" id="customer_id" name="contact_id" value="<?php echo e($contact->id, false); ?>">
	 <input type="hidden" id="sale_type" name="type" value="crm_order_request">
	<div class="row">
		<div class="col-md-8 col-sm-12">
			<?php echo Form::hidden('location_id', !empty($default_location) ? $default_location->id : null , ['id' => 'location_id', 'data-receipt_printer_type' => !empty($default_location->receipt_printer_type) ? $default_location->receipt_printer_type : 'browser', 'data-default_payment_accounts' => !empty($default_location) ? $default_location->default_payment_accounts : '']); ?>


			<?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
			<div class="row">

				<div class="col-sm-3">
					<div class="form-group">
						<?php echo Form::label('ref_no',__('sale.ref_no') . ':',); ?>

						<?php echo Form::text('ref_no', null, ['class' => 'form-control','placeholder' => __('sale.ref_no'),]); ?>

					</div>
				</div>

				<?php if(!empty($pos_settings['enable_order_request_custom1'])): ?>
				<div class="col-sm-9">
					<div class="form-group">
						<?php echo Form::label('select_blind_type',__('lang_v1.select_blind_type') . ':',); ?><br>
						<?php $__currentLoopData = $blind_products['blinds']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blind_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<button class="btn btn-primary btn-blind-custom" data-blind_sku="<?php echo e($blind_type['sku'], false); ?>" data-variation_id="<?php echo e($blind_type['variations'][0]['id'], false); ?>" type="button" id="<?php echo e($blind_type['sku'], false); ?>"><?php echo e($blind_type['name'], false); ?></button>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
				<?php endif; ?>
					
			</div>
			<?php echo $__env->renderComponent(); ?>
			<?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
				<div class="col-sm-12">
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-btn">
								<button type="button" class="btn btn-default bg-white btn-flat" data-bs-toggle="modal" data-bs-target="#configure_search_modal" title="<?php echo e(__('lang_v1.configure_product_search'), false); ?>"><i class="fas fa-search-plus"></i></button>
							</div>
							<?php echo Form::text('or_search_product', null, ['class' => 'form-control mousetrap', 'id' => 'or_search_product', 'placeholder' => __('lang_v1.search_product_placeholder'),
							'disabled' => is_null($default_location)? true : false,
							'autofocus' => is_null($default_location)? false : true,
							]); ?>

						</div>
					</div>
				</div>

				<div class="row col-sm-12 pos_product_div" style="min-height: 0">

					<input type="hidden" name="sell_price_tax" id="sell_price_tax" value="<?php echo e($business_details->sell_price_tax, false); ?>">

					<!-- Keeps count of product rows -->
					<input type="hidden" id="product_row_count" 
						value="0">
					<div class="table-responsive">
					<table class="table table-condensed table-bordered table-striped table-th-skin" id="pos_table">
						<thead>
							<tr>
								<th class="text-center">	
									<?php echo app('translator')->get('sale.product'); ?>
								</th>
								<th class="text-center">
									<?php echo app('translator')->get('sale.qty'); ?>
								</th>
								<th class="text-center">
									<?php echo app('translator')->get('sale.price_inc_tax'); ?>
								</th>
								<th class="text-center">
									<?php echo app('translator')->get('sale.subtotal'); ?>
								</th>
								<th class="text-center"><i class="fas fa-times" aria-hidden="true"></i></th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
					</div>
					<div class="table-responsive">
					<table class="table table-condensed table-bordered table-striped table-th-skin">
						<tr>
							<td>
								<div class="float-end">
								<b><?php echo app('translator')->get('sale.item'); ?>:</b> 
								<span class="total_quantity">0</span>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<b><?php echo app('translator')->get('sale.total'); ?>: </b>
									<span class="price_total">0</span>
								</div>
							</td>
						</tr>
					</table>
					</div>
				</div>
			<?php echo $__env->renderComponent(); ?>
		</div>

		<div class="col-md-4 col-sm-12">
			<div class="box box-primary order-request-suggestions-panel">
				<div class="box-header with-border">
					<h3 class="box-title">Suggested Products</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-6 mb-2">
							<select id="or_suggestion_category" class="form-control select2" style="width:100%">
								<option value="all"><?php echo app('translator')->get('lang_v1.all_category'); ?></option>
								<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category_id => $category_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($category_id, false); ?>"><?php echo e($category_name, false); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<div class="col-6 mb-2">
							<select id="or_suggestion_brand" class="form-control select2" style="width:100%">
								<option value="all"><?php echo app('translator')->get('lang_v1.all_brands'); ?></option>
								<?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand_id => $brand_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if($brand_id !== ''): ?>
										<option value="<?php echo e($brand_id, false); ?>"><?php echo e($brand_name, false); ?></option>
									<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<div class="col-12 mb-2">
							<input type="search" id="or_suggestion_search" class="form-control" placeholder="<?php echo e(__('lang_v1.search_product_placeholder'), false); ?>">
						</div>
					</div>
					<div id="or_suggestion_products" class="order-request-suggestion-grid" aria-live="polite"></div>
					<div id="or_suggestion_loading" class="text-center text-muted py-2" style="display:none"><i class="fa fa-spinner fa-spin"></i></div>
					<button type="button" id="or_suggestion_load_more" class="btn btn-default btn-block mt-2" style="display:none"><?php echo app('translator')->get('lang_v1.load_more'); ?></button>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 col-sm-12">
			<?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
			    <div class="col-md-6">
			    	<div class="form-group">
						<?php echo Form::label('sell_note',__('purchase.additional_notes')); ?>

						<?php echo Form::textarea('sale_note', null, ['class' => 'form-control', 'rows' => 3]); ?>

					</div>
			    </div>
			    <div class="col-md-6">
					<div class="form-group">
			            <?php echo Form::label('shipping_address', __('lang_v1.shipping_address')); ?>

			            <?php echo Form::textarea('shipping_address',null, ['class' => 'form-control','placeholder' => __('lang_v1.shipping_address') ,'rows' => '3', 'cols'=>'30']); ?>

			        </div>
				</div>
				<div class="col-md-4 col-md-offset-8">
			    	<?php if(!empty($pos_settings['amount_rounding_method']) && $pos_settings['amount_rounding_method'] > 0): ?>
			    	<small id="round_off"><br>(<?php echo app('translator')->get('lang_v1.round_off'); ?>: <span id="round_off_text">0</span>)</small>
					<br/>
					<input type="hidden" name="round_off_amount" 
						id="round_off_amount" value=0>
					<?php endif; ?>
			    	<div><b><?php echo app('translator')->get('sale.total_payable'); ?>: </b>
						<input type="hidden" name="final_total" id="final_total_input">
						<span id="total_payable">0</span>
					</div>
			    </div>
				<input type="hidden" name="is_direct_sale" value="1">
			<?php echo $__env->renderComponent(); ?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-12 text-center">
			<button type="button" id="submit-sell" class="btn btn-primary btn-big"><?php echo app('translator')->get('messages.save'); ?></button>
		</div>
	</div>
	
	<?php echo Form::close(); ?>

</section>

<?php echo $__env->make('sale_pos.partials.configure_search_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if(!empty($pos_settings['enable_order_request_custom1'])): ?>
	<?php echo $__env->make('crm::order_request.custom_blind_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style>
	.order-request-suggestions-panel { position: sticky; top: 12px; }
	.order-request-suggestion-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:8px; max-height:68vh; overflow-y:auto; }
	.order-request-suggestion { display:flex; min-width:0; flex-direction:column; align-items:center; gap:7px; padding:8px; border:1px solid #d7e1e8; border-radius:8px; background:#fff; color:#263746; text-align:center; box-shadow:0 2px 5px rgba(0,0,0,.06); }
	.order-request-suggestion-image-button { display:flex; align-items:center; justify-content:center; width:100%; height:112px; padding:0; border:0; background:#f5f7f8; cursor:zoom-in; }
	.order-request-suggestion-image-button.is-unavailable { cursor:default; }
	.order-request-suggestion-image { max-width:100%; max-height:100%; object-fit:contain; }
	.order-request-suggestion-name { width:100%; overflow:hidden; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; }
	.order-request-suggestion strong { white-space:nowrap; }
	.order-request-suggestion .js-order-request-add { width:100%; margin-top:4px; }
	#or_product_gallery_modal .modal-body { display:flex; align-items:center; justify-content:center; min-height:55vh; padding:12px 55px; background:#151515; }
	#or_product_gallery_modal_image { display:block; max-width:100%; max-height:70vh; object-fit:contain; }
	#or_product_gallery_modal .gallery-nav { position:absolute; top:50%; z-index:2; transform:translateY(-50%); border:0; border-radius:50%; width:42px; height:42px; background:rgba(255,255,255,.9); color:#222; font-size:22px; }
	#or_product_gallery_prev { left:10px; }
	#or_product_gallery_next { right:10px; }
	@media (max-width:767px) { .order-request-suggestions-panel { position:static; } .order-request-suggestion-grid { max-height:45vh; } }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('js/pos.js?v=' . $asset_v), false); ?>"></script>
	<script src="<?php echo e(asset('js/product.js?v=' . $asset_v), false); ?>"></script>
    <script type="text/javascript">
    	$(document).ready( function() {
			var suggestionPage = 1;
			var suggestionHasMore = false;
			var suggestionRequest = null;

			function loadOrderRequestSuggestions(reset) {
				var locationId = $('#location_id').val();
				if (!locationId) {
					$('#or_suggestion_products').empty();
					$('#or_suggestion_load_more').hide();
					return;
				}

				if (reset) {
					suggestionPage = 1;
					suggestionHasMore = false;
					$('#or_suggestion_products').empty();
				}
				if (suggestionRequest) {
					suggestionRequest.abort();
				}
				$('#or_suggestion_loading').show();
				var currentRequest = $.ajax({
					url: <?php echo json_encode(action([\Modules\Crm\Http\Controllers\OrderRequestController::class, 'getProductSuggestions']), 512) ?>,
					data: {
						location_id: locationId,
						category_id: $('#or_suggestion_category').val(),
						brand_id: $('#or_suggestion_brand').val(),
						term: $('#or_suggestion_search').val(),
						page: suggestionPage
					},
					success: function (result) {
						$('#or_suggestion_products').append(result.html || '');
						suggestionHasMore = !!result.has_more;
						suggestionPage = result.next_page || suggestionPage + 1;
						$('#or_suggestion_load_more').toggle(suggestionHasMore);
					},
					error: function (xhr, status) {
						if (status !== 'abort') {
							toastr.error(LANG.something_went_wrong);
						}
					},
					complete: function () {
						$('#or_suggestion_loading').hide();
						if (suggestionRequest === currentRequest) {
							suggestionRequest = null;
						}
					}
				});
				suggestionRequest = currentRequest;
			}

			$('#or_suggestion_category, #or_suggestion_brand').select2({width: '100%'});
			$('#or_suggestion_category, #or_suggestion_brand').on('change', function () {
				loadOrderRequestSuggestions(true);
			});
			var suggestionSearchTimer;
			$('#or_suggestion_search').on('input', function () {
				clearTimeout(suggestionSearchTimer);
				suggestionSearchTimer = setTimeout(function () { loadOrderRequestSuggestions(true); }, 300);
			});
			$('#or_suggestion_load_more').on('click', function () {
				if (suggestionHasMore) { loadOrderRequestSuggestions(false); }
			});
			$(document).on('click', '.js-order-request-add', function () {
				or_product_row($(this).data('variation-id'));
			});

			var orderRequestGallery = [];
			var orderRequestGalleryIndex = 0;
			function showOrderRequestGalleryImage() {
				if (!orderRequestGallery.length) { return; }
				$('#or_product_gallery_modal_image').attr('src', orderRequestGallery[orderRequestGalleryIndex]);
				$('#or_product_gallery_prev, #or_product_gallery_next').toggle(orderRequestGallery.length > 1);
			}
			$(document).on('click', '.js-order-request-gallery:not(:disabled)', function () {
				try {
					orderRequestGallery = JSON.parse($(this).attr('data-gallery') || '[]');
				} catch (error) {
					orderRequestGallery = [];
				}
				if (!orderRequestGallery.length) { return; }
				orderRequestGalleryIndex = 0;
				showOrderRequestGalleryImage();
				$('#or_product_gallery_modal').modal('show');
			});
			$('#or_product_gallery_prev').on('click', function () {
				orderRequestGalleryIndex = (orderRequestGalleryIndex - 1 + orderRequestGallery.length) % orderRequestGallery.length;
				showOrderRequestGalleryImage();
			});
			$('#or_product_gallery_next').on('click', function () {
				orderRequestGalleryIndex = (orderRequestGalleryIndex + 1) % orderRequestGallery.length;
				showOrderRequestGalleryImage();
			});
			$('#or_product_gallery_modal_close').on('click', function () {
				var galleryModal = document.getElementById('or_product_gallery_modal');
				if (window.bootstrap && bootstrap.Modal) {
					bootstrap.Modal.getOrCreateInstance(galleryModal).hide();
				} else {
					$('#or_product_gallery_modal').modal('hide');
				}
			});
			$('#select_location_id').on('change', function () {
				$('#location_id').val($(this).val());
				loadOrderRequestSuggestions(true);
			});
			loadOrderRequestSuggestions(true);

    		$('#or_search_product')
	            .autocomplete({
	                delay: 1000,
	                source: function(request, response) {
	                    var price_group = '';
						var search_fields = [];
						$('.search_fields:checked').each(function(i){
						search_fields[i] = $(this).val();
						});

						if ($('#price_group').length > 0) {
							price_group = $('#price_group').val();
						}
						search_term = request.term;
	                    $.getJSON(
	                        '/contact/products/list',
	                        {
	                            price_group: price_group,
	                            location_id: $('input#location_id').val(),
	                            term: search_term,
	                            not_for_selling: 0,
	                            search_fields: search_fields
	                        },
	                        response
	                    );
	                },
	                minLength: 2,
	                response: function(event, ui) {
	                    if (ui.content.length == 1) {
	                        ui.item = ui.content[0];
	                        // if ((ui.item.enable_stock == 1 && ui.item.qty_available > 0) || 
	                        //         (ui.item.enable_stock == 0)) {
	                            $(this)
	                                .data('ui-autocomplete')
	                                ._trigger('select', 'autocompleteselect', ui);
	                            $(this).autocomplete('close');
	                        // }
	                    } else if (ui.content.length == 0) {
	                        toastr.error(LANG.no_products_found);
	                        $('input#search_product').select();
	                    }
	                },
	                focus: function(event, ui) {
	                    // if (ui.item.qty_available <= 0) {
	                    //     return false;
	                    // }
	                },
	                select: function(event, ui) {
	                    var searched_term = $(this).val();
	                    var is_overselling_allowed = true; // Allow Products if out of stock manually by AT
	                    // if($('input#is_overselling_allowed').length) {
	                    //     is_overselling_allowed = true;
	                    // }

	                    // if (ui.item.enable_stock != 1 || ui.item.qty_available > 0 || is_overselling_allowed) {
	                        $(this).val(null);

	                        //Pre select lot number only if the searched term is same as the lot number
	                        var purchase_line_id = ui.item.purchase_line_id && searched_term == ui.item.lot_number ? ui.item.purchase_line_id : null;
	                        or_product_row(ui.item.variation_id, purchase_line_id);
	                    // } else {
	                    //     alert(LANG.out_of_stock);
	                    // }
	                },
	            })
	            .autocomplete('instance')._renderItem = function(ul, item) {
	                var is_overselling_allowed = true; // Allow Products if out of stock manually by AT
	                // if($('input#is_overselling_allowed').length) {
	                //     is_overselling_allowed = true;
	                // }
	            if (item.enable_stock == 1 && item.qty_available <= 0 && !is_overselling_allowed) {
	                var string = '<li class="ui-state-disabled">' + item.name;
	                if (item.type == 'variable') {
	                    string += '-' + item.variation;
	                }
	                var selling_price = item.selling_price;
	                if (item.variation_group_price) {
	                    selling_price = item.variation_group_price;
	                }
	                string +=
	                    ' (' +
	                    item.sub_sku +
	                    ')' +
	                    '<br> Price: ' +
	                    selling_price +
	                    ' (Out of stock) </li>';
	                return $(string).appendTo(ul);
	            } else {
	                var string = '<div>' + item.name;
	                if (item.type == 'variable') {
	                    string += '-' + item.variation;
	                }

	                var selling_price = item.selling_price;
	                if (item.variation_group_price) {
	                    selling_price = item.variation_group_price;
	                }

	                string += ' (' + item.sub_sku + ')' + '<br> Price: ' + selling_price;
	                string += '</div>';

	                return $('<li>')
	                    .append(string)
	                    .appendTo(ul);
	            }
	        };

	        //variation_id is null when weighing_scale_barcode is used.
function or_product_row(variation_id = null, purchase_line_id = null, weighing_scale_barcode = null, quantity = 1) {

    //Get item addition method
    var item_addtn_method = 0;
    var add_via_ajax = true;

    if (variation_id != null && $('#item_addition_method').length) {
        item_addtn_method = $('#item_addition_method').val();
    }

    if (item_addtn_method == 0) {
        add_via_ajax = true;
    } else {
        var is_added = false;

        //Search for variation id in each row of pos table
        $('#pos_table tbody')
            .find('tr')
            .each(function() {
                var row_v_id = $(this)
                    .find('.row_variation_id')
                    .val();
                var enable_sr_no = $(this)
                    .find('.enable_sr_no')
                    .val();
                var modifiers_exist = false;
                if ($(this).find('input.modifiers_exist').length > 0) {
                    modifiers_exist = true;
                }

                if (
                    row_v_id == variation_id &&
                    enable_sr_no !== '1' &&
                    !modifiers_exist &&
                    !is_added
                ) {
                    add_via_ajax = false;
                    is_added = true;

                    //Increment product quantity
                    qty_element = $(this).find('.pos_quantity');
                    var qty = __read_number(qty_element);
                    __write_number(qty_element, qty + 1);
                    qty_element.change();

                    round_row_to_iraqi_dinnar($(this));

                    $('input#search_product')
                        .focus()
                        .select();
                }
        });
    }

    if (add_via_ajax) {
        var product_row = $('input#product_row_count').val();
        var location_id = $('input#location_id').val();
        var customer_id = $('input#customer_id').val();
        var is_direct_sell = false;
        if (
            $('input[name="is_direct_sale"]').length > 0 &&
            $('input[name="is_direct_sale"]').val() == 1
        ) {
            is_direct_sell = true;
        }

        var is_sales_order = $('#sale_type').length && $('#sale_type').val() == 'sales_order' ? true : false;

        var price_group = '';
        if ($('#price_group').length > 0) {
            price_group = parseInt($('#price_group').val());
        }

        //If default price group present
        if ($('#default_price_group').length > 0 && 
            price_group === '') {
            price_group = $('#default_price_group').val();
        }

        //If types of service selected give more priority
        if ($('#types_of_service_price_group').length > 0 && 
            $('#types_of_service_price_group').val()) {
            price_group = $('#types_of_service_price_group').val();
        }
        
        $.ajax({
            method: 'GET',
            url: '/contact/order-request/get_product_row/' + variation_id + '/' + location_id,
            async: false,
            data: {
                product_row: product_row,
                customer_id: customer_id,
                price_group: price_group,
                is_direct_sell: true,
                quantity: quantity,
            },
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    $('table#pos_table tbody')
                        .append(result.html_content)
                        .find('input.pos_quantity');
                    //increment row count
                    $('input#product_row_count').val(parseInt(product_row) + 1);
                    var this_row = $('table#pos_table tbody')
                        .find('tr')
                        .last();
                    pos_each_row(this_row);

                    //For initial discount if present
                    var line_total = __read_number(this_row.find('input.pos_line_total'));
                    this_row.find('span.pos_line_total_text').text(line_total);

                    pos_total_row();

                    //Check if multipler is present then multiply it when a new row is added.
                    if(__getUnitMultiplier(this_row) > 1){
                        this_row.find('select.sub_unit').trigger('change');
                    }

                    if (result.enable_sr_no == '1') {
                        var new_row = $('table#pos_table tbody')
                            .find('tr')
                            .last();
                        new_row.find('.row_edit_product_price_model').modal('show');
                    }

                    round_row_to_iraqi_dinnar(this_row);
                    __currency_convert_recursively(this_row);

                    $('input#search_product')
                        .focus()
                        .select();

                    //Used in restaurant module
                    if (result.html_modifier) {
                        $('table#pos_table tbody')
                            .find('tr')
                            .last()
                            .find('td:first')
                            .append(result.html_modifier);
                    }

                    //scroll bottom of items list
                    $(".pos_product_div").animate({ scrollTop: $('.pos_product_div').prop("scrollHeight")}, 1000);
                } else {
                    toastr.error(result.msg);
                    $('input#search_product')
                        .focus()
                        .select();
                }
            },
        });
    }
}

            $('#shipping_documents').fileinput({
		        showUpload: false,
		        showPreview: false,
		        browseLabel: '',
		        removeLabel: '',
		        cancelLabel: '',
		    });

            // Initialize select2 for modal dropdowns to fix z-index issue
            $('#custom_blind_modal').on('shown.bs.modal', function () {
                $('#cb_fabric, #cb_motor, #cb_controller').select2({
                    dropdownParent: $('#custom_blind_modal')
                });
            });

            // Custom Blind Modal Logic
            $('.btn-blind-custom').click(function() {
                var blind_sku = $(this).data('blind_sku');
                var variation_id = $(this).data('variation_id');
                $('#cb_blind_type').val(blind_sku);
                $('#cb_blind_type').data('variation_id', variation_id);
                
                // Reset form
                $('#cb_fabric').val('').trigger('change');
                $('#cb_width').val('');
                $('#cb_height').val('');
                $('#cb_quantity').val(1);
                $('#cb_sqft').val('');
                $('#cb_controller').val('').trigger('change');
                $('#cb_motor_selection_div').hide();
                $('#cb_motor').val('').trigger('change');
                
                $('#custom_blind_modal').modal('show');
            });

            $('#cb_controller').change(function() {
                if ($(this).val() == 'motor') {
                    $('#cb_motor_selection_div').show();
                } else {
                    $('#cb_motor_selection_div').hide();
                }
            });

            function calculateSqFt() {
                var width = parseFloat($('#cb_width').val()) || 0;
                var height = parseFloat($('#cb_height').val()) || 0;
                var qty = parseInt($('#cb_quantity').val()) || 1;
                
                var sqft_per_item = (width * height) / 144;
                if (sqft_per_item < 16 && (width > 0 && height > 0)) {
                    sqft_per_item = 16;
                }
                var total_sqft = sqft_per_item * qty;
                $('#cb_sqft').val(total_sqft.toFixed(2));
            }

            $('#cb_width, #cb_height, #cb_quantity').on('input', calculateSqFt);

            $('#cb_add_btn').click(function() {
                var variation_id = $('#cb_blind_type').data('variation_id');
                var blind_sku = $('#cb_blind_type').val();
                var fabric_variation_id = $('#cb_fabric').val();
                var width = $('#cb_width').val();
                var height = $('#cb_height').val();
                var quantity = $('#cb_quantity').val();
                var controller = $('#cb_controller').val();
                var motor_variation_id = $('#cb_motor').val();

                if (!fabric_variation_id || !width || !height || !quantity) {
                    toastr.error('Please fill all required fields (Fabric, Width, Height, Quantity).');
                    return;
                }

                if (!controller) {
                    toastr.error('Please select a controller option.');
                    return;
                }

                if (controller == 'motor' && !motor_variation_id) {
                    toastr.error('Please select a motor.');
                    return;
                }

                // Add via AJAX but with custom parameters
                var product_row = $('input#product_row_count').val();
                var location_id = $('input#location_id').val();
                var customer_id = $('input#customer_id').val();
                
                $.ajax({
                    method: 'GET',
                    url: '/contact/order-request/get_product_row/' + variation_id + '/' + location_id,
                    data: {
                        product_row: product_row,
                        customer_id: customer_id,
                        is_direct_sell: true,
                        quantity: quantity,
                        custom_blind: 1,
                        blind_sku: blind_sku,
                        fabric_variation_id: fabric_variation_id,
                        width: width,
                        height: height,
                        controller: controller,
                        motor_variation_id: motor_variation_id
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.success) {
                            $('table#pos_table tbody')
                                .append(result.html_content)
                                .find('input.pos_quantity');
                            //increment row count
                            $('input#product_row_count').val(parseInt(product_row) + 1);
                            var this_row = $('table#pos_table tbody')
                                .find('tr')
                                .last();
                            pos_each_row(this_row);

                            var line_total = __read_number(this_row.find('input.pos_line_total'));
                            this_row.find('span.pos_line_total_text').text(line_total);

                            pos_total_row();

                            round_row_to_iraqi_dinnar(this_row);
                            __currency_convert_recursively(this_row);

                            $('#custom_blind_modal').modal('hide');
                            
                            $(".pos_product_div").animate({ scrollTop: $('.pos_product_div').prop("scrollHeight")}, 1000);
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            });
    	});
    </script>
	<div class="modal fade" id="or_product_gallery_modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<button type="button" class="gallery-nav" id="or_product_gallery_prev" aria-label="Previous image">&#8249;</button>
					<img id="or_product_gallery_modal_image" src="" alt="Product image">
					<button type="button" class="gallery-nav" id="or_product_gallery_next" aria-label="Next image">&#8250;</button>
					<button type="button" class="close" id="or_product_gallery_modal_close" data-bs-dismiss="modal" aria-label="Close" style="position:absolute;right:10px;top:6px;color:#fff;opacity:1;font-size:30px"><span aria-hidden="true">&times;</span></button>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('crm::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>