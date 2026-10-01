<?php
	$truckmate = [];
	if (!empty($view_data['job_sheet'])) {
		$truckmate['truckmate_status_id'] = $view_data['job_sheet']['status_id'];
		$truckmate['customer_id'] = $view_data['job_sheet']['contact_id'];
	} elseif (!empty($transaction)) {
		$truckmate['truckmate_status_id'] = $transaction['truckmate_status_id'];
	}
?>
<style>
	.bootstrap-datetimepicker-widget.dropdown-menu {
		z-index: 99999 !important;
	}
</style>
<script type="text/javascript">
	// override the default walk-in-customer
	<?php if(!empty($truckmate['customer_id'])): ?>
		$("input#default_customer_id").val(<?php echo e($truckmate['customer_id'], false); ?>);
		$("input#default_customer_name").val("<?php echo e($view_data['job_sheet']->customer->name, false); ?>");
		$("input#default_customer_balance").val(<?php echo e($view_data['job_sheet']->customer->balance, false); ?>);
	<?php endif; ?>

	$(document).ready( function() {
		if ($('#job_sheet_location_id').length && $('select#select_location_id').length) {
			$('select#select_location_id').val($('#job_sheet_location_id').val());
			$('select#select_location_id').trigger('change');
		}

		$('#truckmate_completed_on, #truckmate_due_date').datetimepicker({
	        format: moment_date_format + ' ' + moment_time_format,
	        ignoreReadonly: true,
	    });

		$('#truckmate_week_start, #truckmate_week_end').datetimepicker({
	        format: moment_date_format,
	        ignoreReadonly: true,
	    });

		// Initialize payment footer date picker
		$('.paid_on').datetimepicker({
			format: moment_date_format + ' ' + moment_time_format,
			ignoreReadonly: true,
		});

		$(document).on('click', '.clear_truckmate_completed_on', function() {
			$('#truckmate_completed_on').data("DateTimePicker").clear();
		});

		$(document).on('click', '.clear_truckmate_due_date', function() {
			$('#truckmate_due_date').data("DateTimePicker").clear();
		});

		var fileinput_setting = {
	        showUpload: false,
	        showPreview: true,
	        browseLabel: '',
	        removeLabel: '',
	        cancelLabel: '',
	        previewSettings: {
	            image: { width: '70px', height: '70px' },
	        },
	    };

		$('#documents').fileinput(fileinput_setting);
		//set truckmate status
		<?php if(!empty($truckmate['truckmate_status_id'])): ?>
			$("select#truckmate_status_id").val(<?php echo e($truckmate['truckmate_status_id'], false); ?>).change();
		<?php elseif(!empty($view_data['default_status'])): ?>
			$("select#truckmate_status_id").val(<?php echo e($view_data['default_status'], false); ?>).change();
		<?php endif; ?>


		var data = [{
			id: "",
			text: '<?php echo app('translator')->get("messages.please_select"); ?>',
			html: '<?php echo app('translator')->get("messages.please_select"); ?>',
			is_complete : '0',
		}, 
		<?php $__currentLoopData = $truckmate_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $truckmate_status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			{
			id: <?php echo e($truckmate_status->id, false); ?>,
			is_complete : '<?php echo e($truckmate_status->is_completed_status, false); ?>',
			<?php if(!empty($truckmate_status->color)): ?>
				text: '<i class="fa fa-circle" aria-hidden="true" style="color: <?php echo e($truckmate_status->color, false); ?>;"></i> <?php echo e($truckmate_status->name, false); ?>',
				title: '<?php echo e($truckmate_status->name, false); ?>'
			<?php else: ?>
				text: "<?php echo e($truckmate_status->name, false); ?>"
			<?php endif; ?>
			},
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		];

		$("select#truckmate_status_id").select2({
			data: data,
			escapeMarkup: function(markup) {
				return markup;
			},
			templateSelection: function (data, container) {
				$(data.element).attr('data-is_complete', data.is_complete);
				return data.text;
			}
		});

		<?php if(!empty($default_status)): ?>
			$("select#truckmate_status_id").val(<?php echo e($default_status, false); ?>).change();
		<?php endif; ?>

		$('select#discount_type, input#discount_amount').change(function() {
			job_total_row();
		});

		$('select#tax_rate_id').change(function() {
			var tax_rate = $(this).find(':selected').data('rate');
			var tax_type = $(this).find(':selected').data('type');
			
			__write_number($('input#tax_calculation_amount'), tax_rate);
			$('input#tax_calculation_type').val(tax_type);
			job_total_row();
		});

		$(document).on('change', '.payment-amount', function() {
			let contact_id = $('#customer_id').val();
			let total_payable = __read_number($('#final_total_input'));
			// let total_paying = __read_number($(this));
			let total_paying = __read_number($('#total_paying_input'));
			//Check Credit Limit 
			//AT 24 Apr 2025 - Check removed 
			// $.ajax({
			//     method: 'GET',
			//     url: "/contacts/check-credit-limit",
			//     data: { final_amount : total_payable , amount : total_paying, contact_id:contact_id},
			//     success: function(result) {
			//         if(result.msg){
			//             toastr.error(result.msg);
			//         }
			//     },
			// });

			calculate_balance_due();
		});

		$(document).on('keyup', '.payment-amount', function(e) {
			calculate_balance_due();
		});

		$(document).on('focus', '.payment-amount', function() {
			job_total_row();
		});

		//Direct sell submit
		sell_form = $('form#add_truckmate_invoice_form');
		if ($('form#edit_sell_form').length) {
			sell_form = $('form#edit_sell_form');
			job_total_row();
		}
		sell_form_validator = sell_form.validate();

		$('button#submit-sell, button#save-and-print').click(async function(e) {
			console.log('sales');
			$(this).attr('disabled', true);

			//Check if product is present or not.
			if ($('table#job_table tbody').find('.job_sheet_row').length <= 0) {
				toastr.warning(LANG.no_job_sheets_added);
				$(this).attr('disabled', false);
				return false;
			}

			if ($(this).attr('id') == 'save-and-print') {
				$('#is_save_and_print').val(1);           
			} else {
				$('#is_save_and_print').val(0);
			}

			var is_edit = $('form#edit_sell_form').length || $('form#edit_pos_sell_form').length ? true : false;
			var is_draft=false;

			if(!is_draft){
				let contact_id = $('#customer_id').val();
				let total_payable = __read_number($('#final_total_input'));
				let total_paying = 0;
				if($('#total_paying_input').length > 0){
					total_paying = __read_number($('#total_paying_input'));
				}else{
					$('.payment-amount').each(function(){
						total_paying += __read_number($(this));
					});
				}

				var limit_exceed = false;
				let exclude_transaction_id = 0;
				if(is_edit){
					exclude_transaction_id = $('#edit_transaction_id').val();
				}
				//Check Credit Limit
				await $.ajax({
					method: 'GET',
					url: "/contacts/check-credit-limit",
					data: { final_amount : total_payable , amount : total_paying, contact_id:contact_id, exclude_transaction_id: exclude_transaction_id},
					success: function(result) {
						if(result.msg){
							toastr.error(result.msg);
							limit_exceed = true;
						}
					},
				});
				if(limit_exceed){
					$(this).attr('disabled', false);
					return false;
				}
			}

			$('#customer_id').removeAttr('disabled'); 

			if (sell_form.valid()) {
				window.onbeforeunload = null;
				if($('.loading').length > 0){
					$('.loading').attr('style', '');
				}
				$(this).attr('disabled', true);
				sell_form.submit();
			}else{
				if($('.loading').length > 0){
					$('.loading').attr('style', 'display:none');
				}
				$(this).attr('disabled', false);
			}
		});

	});

	$(document).on('change', 'select#customer_id', function(){
		get_job_sheets();
	});

	// $(document).on('change', '#discount_amount', function(){
	// 	job_total_row();
	// });

	// $(document).on('change', '#discount_type', function(){
	// 	job_total_row();
	// });

	function get_job_sheets() {
		var customer_id = $('select#customer_id').val();
		var location_id = $('input#location_id').val();	
		if ($('#job_sheet_ids').length && customer_id && location_id) {
			if ($('#job_sheet_ids').hasClass('not_loaded')) {
				$('#job_sheet_ids').removeClass('not_loaded');
				return false;
			}
			$.ajax({
				url: '/truckmate/get-customer-job-sheets/' + customer_id + '?location_id=' + location_id,
				dataType: 'json',
				success: function(data) {
					if(data.length > 1){
						$('#job_sheet_ids').select2('destroy').empty().select2({data: data});
						if(!$('#hidden_invoice_id').length){
							let load_job_sheet_id = $('#job_sheet_id').val();
							$('table#job_table tbody').find('tr').each( function(){
								if($(this).find('.hidden_job_sheet_id').val() != load_job_sheet_id){
									$(this).remove();	
								}	
							});
						}
						
					}else{
						if(!$('#hidden_invoice_id').length){
							toastr.warning('All Job Sheets Invoiced');
							$('#job_sheet_ids').select2('destroy').empty().select2({data: {}});
							$('table#job_table tbody').find('tr').each( function(){
								$(this).remove();
							});
						}
					}
				},
			});
		}
	}

	$("#job_sheet_ids").on("select2:select", function (e) {
		var job_sheet_id = e.params.data.id;
		var job_row_count = $('input#job_row_count').val();
		var location_id = $('input#location_id').val();
		add_via_ajax = true;

		$('table#job_table tbody').find('tr').each( function(){
			if($(this).find('.hidden_job_sheet_id').val() == job_sheet_id){
				add_via_ajax = false;
				toastr.warning('Job Sheet Already Added');
				return false;
			}
		});

		if(add_via_ajax){
			$.ajax({
				method: 'GET',
				url: '/truckmate/get-job-sheet-lines',
				async: false,
				data: {
					job_row_count: job_row_count,
					job_sheet_id: job_sheet_id, 
				},
				dataType: 'json',
				success: function(result) {
					if (result.success) {

						$('table#job_table tbody').append(result.html);
						var this_row = $('table#job_table tbody').find('tr').last();
						job_row_count = parseInt(job_row_count) + 1;

						job_each_row(this_row);
						__currency_convert_recursively(this_row);

						//increment row count
						$('input#job_row_count').val(job_row_count);
						
						job_total_row();
					
					} else {
						toastr.error(result.msg);
						// $('input#search_product')
						// 	.focus()
						// 	.select();
					}
				},
			});
		}
		setTimeout(() => {
			$('#job_sheet_ids').val('Click to Select').change();
		}, 1000);
	});

	//Remove row on click on remove row
	$('table#job_table tbody').on('click', 'i.job_remove_row', function() {
		//Delete Row
		$(this).parents('tr').remove();		
		//reaclculate totals
		job_total_row();
	});

	//Remove row on click on remove row
	$('input.row_extra_charges').on('change', 'i.job_remove_row', function() {
		//Delete Row
		$(this).parents('tr').remove();		
		//reaclculate totals
		job_total_row();
	});

	$(document).on('change', 'input.row_extra_charges', function(){
		var tr = $(this).parents('tr');
		job_each_row(tr);
		job_total_row();
	});

	function job_each_row(tr){
		var price = __read_number(tr.find('.hidden_price'));
		var extra_charges = __read_number(tr.find('input.row_extra_charges'));
		var line_total = price + extra_charges;
		tr.find('input.hidden_line_total').val(line_total);
    	tr.find('span.line_total_text').text(__currency_trans_from_en(line_total, true));
	}

	function job_total_row(){
		var total = 0; 
		$('table#job_table tbody tr').each(function() {
			total += __read_number($(this).find('input.hidden_line_total')); 
		});

		$('span.price_total').html(__currency_trans_from_en(total, false));
		
		calculate_billing_details(total);
	}

	function calculate_billing_details(price_total) {
    
		var discount = pos_discount(price_total);

		var order_tax = pos_order_tax(price_total, discount);
		
		var total_payable = price_total + order_tax - discount;

		var rounding_multiple = $('#amount_rounding_method').val() ? parseFloat($('#amount_rounding_method').val()) : 0;
		var round_off_data = __round(total_payable, rounding_multiple);
		var total_payable_rounded = round_off_data.number;

		var round_off_amount = round_off_data.diff;
		if (round_off_amount != 0) {
			$('span#round_off_text').text(__currency_trans_from_en(round_off_amount, false));
		} else {
			$('span#round_off_text').text(0);
		}
		$('input#round_off_amount').val(round_off_amount);

		__write_number($('input#final_total_input'), total_payable_rounded);

		var curr_exchange_rate = 1;
		if ($('#exchange_rate').length > 0 && $('#exchange_rate').val()) {
			curr_exchange_rate = __read_number($('#exchange_rate'));
		}
		var shown_total = total_payable_rounded * curr_exchange_rate;
		$('span#total_payable').text(__currency_trans_from_en(shown_total, false));

		$('span.total_payable_span').text(__currency_trans_from_en(total_payable_rounded, true));

		// //Check if edit form then don't update price.
		// if ($('form#edit_pos_sell_form').length == 0 && $('form#edit_sell_form').length == 0) {
		// 	//Check if Sale Amount set to zero is not true
		// 	if($('input#set_sale_invoice_payment_zero').val() != 'true'){
		// 		__write_number($('.payment-amount').first(), total_payable_rounded);
		// 	}
		// }

		$(document).trigger('invoice_total_calculated');

		calculate_balance_due();
	}
	
	function calculate_balance_due() {
		var total_payable = __read_number($('#final_total_input'));
		var total_paying = 0;
		$('#payment_rows_div')
			.find('.payment-amount')
			.each(function() {
				if (parseFloat($(this).val())) {
					total_paying += __read_number($(this));
				}
				if(total_paying == null || total_paying == ""){
					__write_number($(this), 0);
				}
			});
		var bal_due = total_payable - total_paying;
		var change_return = 0;

		var disable_change_return = false;
		if($('input#disable_change_return_on_sale').length) {
			disable_change_return = true;
		}
		if(!disable_change_return){
			//change_return
			if (bal_due < 0 || Math.abs(bal_due) < 0.05) {
				__write_number($('input#change_return'), bal_due * -1);
				$('span.change_return_span').text(__currency_trans_from_en(bal_due * -1, true));
				change_return = bal_due * -1;
				bal_due = 0;
			} else {
				__write_number($('input#change_return'), 0);
				$('span.change_return_span').text(__currency_trans_from_en(0, true));
				change_return = 0;
			}
		}

		if (change_return !== 0) {
			$('#change_return_payment_data').removeClass('hide');
			// $('#change_return_payment_data')
		} else {
			$('#change_return_payment_data').addClass('hide');
		}

		__write_number($('input#total_paying_input'), total_paying);
		$('span.total_paying').text(__currency_trans_from_en(total_paying, true));
		
		__write_number($('input#in_balance_due'), bal_due);
		$('span.balance_due').text(__currency_trans_from_en(bal_due, true));

		__highlight(bal_due * -1, $('span.balance_due'));
		__highlight(change_return * -1, $('span.change_return_span'));
	}

</script>
