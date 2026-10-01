
<?php $__env->startSection('title', __('truckmate::lang.driver_invoice')); ?>
<?php $__env->startSection('css'); ?>
    <style>
        .bootstrap-datetimepicker-widget.dropdown-menu {
            z-index: 99999 !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('truckmate::driver.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
	$user_settings = json_decode(auth()->user()->user_settings,true);
?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <div class="tm-page-header">
        <h1><i class="fas fa-plus-circle" style="color:var(--tm-primary)"></i> <?php echo app('translator')->get('truckmate::lang.driver_invoice'); ?></h1>
    </div>
</section>

<!-- Main content -->
<section class="content tm-content">
	<?php echo Form::open(['url' => action([\Modules\Truckmate\Http\Controllers\TruckmateController::class, 'storeDriverInvoice']), 'method' => 'post', 'id' => 'add_driver_invoice', 'files' => true ]); ?>

	<div class="box box-primary">
		<div class="box-body box box-primary">
			<div class="row">

				<?php if(count($business_locations) == 1): ?>
					<?php 
						$default_location = current(array_keys($business_locations->toArray())) 
					?>
				<?php else: ?>
					<?php $default_location = null; ?>
				<?php endif; ?>
				<div class="col-sm-4">
					<div class="form-group">
						<?php echo Form::label('location_id', __('purchase.business_location').':*'); ?>

						<?php echo Form::select('location_id', $business_locations, $default_location, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required'], $bl_attributes); ?>

					</div>
				</div>

				<div class="col-sm-4">
					<div class="form-group">
						<?php echo Form::label('ref_no', __('purchase.ref_no').':'); ?>

						<?php echo Form::text('ref_no', null, ['class' => 'form-control']); ?>

						<p class="help-block">
			                <?php echo app('translator')->get('lang_v1.leave_empty_to_autogenerate'); ?>
			            </p>
					</div>
				</div>
				<?php
                    $is_readonly = empty($user_settings['enable_expense_transaction_date']) ? 'disabled' : '';
                ?>

				<div class="col-sm-4">
					<div class="form-group">
						<?php echo Form::hidden('transaction_date', \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format') . ' ' . 'h:i A'), ['id' => 'expense_transaction_date', 'class' => 'form-control', 'required']); ?>

						<?php echo Form::label('transaction_date', __('messages.date') . ':*'); ?>

						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</span>
							<?php echo Form::text('transaction_date_text', \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format') . ' ' . 'h:i A'), ['id' => 'expense_transaction_date_text', 'class' => 'form-control', $is_readonly, 'required']); ?>

						</div>
					</div>
				</div>
				<div class="clearfix"></div>

				<div class="col-sm-4">
					<div class="form-group">
						<?php echo Form::label('expense_for', __('truckmate::lang.driver').':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.expense_for') . '"></i>';
                }
            ?>
						<?php echo Form::select('expense_for', $users, null, ['class' => 'form-control select2', 'required', 'placeholder' => __('messages.please_select')]); ?>

					</div>
				</div>
				

				<?php if(in_array('upload_documents', $enabled_modules)): ?>
				<div class="col-sm-4">
                    <div class="form-group">
                        <?php echo Form::label('document', __('purchase.attach_document') . ':'); ?>

                        <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
                        <?php echo Form::file('document', ['id' => 'upload_document', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); ?>

                    </div>
                </div>
                <?php endif; ?>
				<div class="clearfix"></div>
				
				<div class="clearfix"></div>
				
				
			</div>
		</div>
	</div> <!--box end-->

	<div class="box box-primary">
		<div class="box-body box box-primary">
			<div class="row">
				<div class="col-sm-5">
					<div class="form-group">
						<?php echo Form::label('truckmate_week_start', __('truckmate::lang.truckmate_week_start') . ':*'); ?>

						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</span>
							<?php echo Form::text('truckmate_week_start', null, ['class' => 'form-control', 'readonly', 'required']); ?>

						</div>
					</div>
				</div>
				<div class="col-sm-5">
					<div class="form-group">
						<?php echo Form::label('truckmate_week_end', __('truckmate::lang.truckmate_week_end') . ':*'); ?>

						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</span>
							<?php echo Form::text('truckmate_week_end', null, ['class' => 'form-control', 'readonly', 'required']); ?>

						</div>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<br>
						<button type="button" id="generate_dates" class="mt-5 btn btn-primary">Generate Weekdays</button>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-12" style="min-height: 50vh">
					<div id="table-responsive">
						<table class="table table-bordered table-striped" id="weekdays_table">
								<thead>
									<tr>
										<th class="col-md-2">Day & Date</th>
										<th class="col-md-1">Hours</th>
										<th class="col-md-1">Shift</th>
										<th class="col-md-1">Hourly Rate</th>
										<th class="col-md-1">Total Amount</th>
										<th class="col-md-3">Remarks</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="box box-primary">
		<div class="box-body box box-primary">
			<div class="row">
				<div class="col-sm-8">
					<div class="form-group">
						<?php echo Form::label('staff_note', __('expense.expense_note') . ':'); ?>

						<?php echo Form::textarea('staff_note', null, ['class' => 'form-control', 'rows' => 3]); ?>

					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<?php echo Form::label('final_total', __('sale.total_amount') . ':*'); ?>

						<?php echo Form::text('final_total', null, ['class' => 'form-control input_number', 'readonly', 'placeholder' => __('sale.total_amount'), 'required']); ?>

					</div>
				</div>

			</div>
		</div>
	</div>
	<?php $__env->startComponent('components.widget', ['class' => 'box-solid', 'id' => "payment_rows_div", 'title' => __('purchase.add_payment')]); ?>
	<div class="payment_row">
		<?php echo $__env->make('sale_pos.partials.payment_row_form', ['row_index' => 0, 'show_date' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<hr>
		<div class="row">
			<div class="col-sm-12">
				<div class="pull-right">
					<strong><?php echo app('translator')->get('purchase.payment_due'); ?>:</strong>
					<span id="payment_due"><?php echo e(number_format(0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
				</div>
			</div>
		</div>
	</div>
	<?php echo $__env->renderComponent(); ?>
<?php echo Form::close(); ?>


<div id="driver-invoice-footer-actions-template" class="d-none">
	<div>
		<button type="button" class="btn btn-primary" id="footer_driver_invoice_save">
			<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>
		</button>
	</div>
</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	$(document).ready( function(){
		// Footer button handler
		$(document).on('click', '#footer_driver_invoice_save', function() {
			$('form#add_driver_invoice').submit();
		});

		$('.paid_on').datetimepicker({
            format: moment_date_format + ' ' + moment_time_format,
            ignoreReadonly: true,
        });

		$('#truckmate_week_start, #truckmate_week_end').datetimepicker({
	        format: moment_date_format,
	        ignoreReadonly: true,
	    });

		set_payment_type_dropdown();
		$('select#location_id').change(function() {
			set_payment_type_dropdown();
		});
		if($('.payment_types_dropdown').length){
			$('.payment_types_dropdown').change();
		}
		if($('select.acc_account_id').length){
			$('select.acc_account_id').select2();
		}
		calculate_invoice_total();
	});
	
	__page_leave_confirmation('#add_driver_invoice');
	
	$(document).on('click', '#generate_dates', function() {	
		let start = $('input#truckmate_week_start').val();
		let end = $('input#truckmate_week_end').val();
		if(start && end){
			$.ajax({
				method: 'GET',
				url: '/truckmate/driver-invoices/generate-weekdays',
				data: { start: start, end: end },
				dataType: 'html',
				success: function(result) {
					if (result) {
						$('#weekdays_table tbody').append(result);
						$('#generate_dates').remove();
						$('input#truckmate_week_start').attr('style', 'pointer-events: none;background-color:#F5F5F5;');
						$('input#truckmate_week_end').attr('style', 'pointer-events: none;background-color:#F5F5F5;');
					}
				},
			});
		}
	});


	$(document).on('focus', 'input.payment-amount', function() {
		var final_total = __read_number($('input#final_total'));
		__write_number($('input.payment-amount'), final_total);
		$('input.payment-amount').change();
	});


	$(document).on('change', 'input.weekday_hours, input.weekday_rate', function() {
		var row = $(this).closest('tr');
		var rate = __read_number(row.find('.weekday_rate'));
		var hours = __read_number(row.find('.weekday_hours'));
		var total = rate * hours;
		__write_number(row.find('.weekday_total'), total);
		calculate_invoice_total();
	});

	function calculate_invoice_total() {
		var final_total = 0;
		$('#weekdays_table tbody').find('tr').each(function() {
			final_total += __read_number($(this).find('.weekday_total'));
		});
		__write_number($('input#final_total'), final_total);
		calculateTotalPayment();
	}

	$(document).on('change', 'input#final_total, input.payment-amount', function() {
		calculateTotalPayment();
	});

	function calculateTotalPayment() {
		var final_total = __read_number($('input#final_total'));
		var payment_amount = __read_number($('input.payment-amount'));
		var payment_due = final_total - payment_amount;
		$('#payment_due').text(__currency_trans_from_en(payment_due, true, false));
	}

	//Finalize invoice, open payment modal
    $('button#save_btn').click(function() {
        //Check if product is present or not.
        if ($('#weekdays_table tbody tr').length <= 0) {
            toastr.warning('No Weekdays Generated');
            return false;
        }
	});

	$(document).on('change', '.payment_types_dropdown, #location_id', function(e) {
	    var default_accounts = $('select#location_id').length ? 
	                $('select#location_id')
	                .find(':selected')
	                .data('default_payment_accounts') : [];
	    var payment_types_dropdown = $('.payment_types_dropdown');
	    var payment_type = payment_types_dropdown.val();
	    if (payment_type) {
	        var default_account = default_accounts && default_accounts[payment_type]['account'] ? 
	            default_accounts[payment_type]['account'] : '';
	        var payment_row = payment_types_dropdown.closest('.payment_row');
	        var row_index = payment_row.find('.payment_row_index').val();

	        var account_dropdown = payment_row.find('select#account_' + row_index);
	        if (account_dropdown.length && default_accounts) {
	            account_dropdown.val(default_account);
	            account_dropdown.change();
	        }
	    }
	});

	function set_payment_type_dropdown() {
		var payment_settings = $('#location_id').find(':selected').data('default_payment_accounts');
		payment_settings = payment_settings ? payment_settings : [];
		enabled_payment_types = [];
		for (var key in payment_settings) {
			if (payment_settings[key] && payment_settings[key]['is_enabled']) {
				enabled_payment_types.push(key);
			}
		}
		if (enabled_payment_types.length) {
			$(".payment_types_dropdown > option").each(function() {
				//skip if advance
				if ($(this).val() && $(this).val() != 'advance') {
					if (enabled_payment_types.indexOf($(this).val()) != -1) {
						$(this).removeClass('hide');
					} else {
						$(this).addClass('hide');
					}
				}
			});
		}
	}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>