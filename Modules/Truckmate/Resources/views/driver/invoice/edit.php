
<?php $__env->startSection('title', __('expense.edit_expense')); ?>
<?php $__env->startSection('css'); ?>
    <style>
        .bootstrap-datetimepicker-widget.dropdown-menu {
            z-index: 99999 !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('truckmate::driver.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <div class="tm-page-header">
        <h1><i class="fas fa-edit" style="color:var(--tm-primary)"></i> <?php echo app('translator')->get('expense.edit_expense'); ?></h1>
    </div>
</section>

<!-- Main content -->
<section class="content tm-content">
  <?php echo Form::open(['url' => action([\Modules\Truckmate\Http\Controllers\TruckmateController::class, 'updateDriverInvoice'], [$invoice->id]), 'method' => 'PUT', 'id' => 'add_driver_invoice', 'files' => true ]); ?>

  
  <div class="box box-primary">
    <div class="box-body box box-primary">
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <?php echo Form::label('location_id', __('purchase.business_location').':*'); ?>

            <?php echo Form::select('location_id', $business_locations, $invoice->location_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); ?>

          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <?php echo Form::label('ref_no', __('purchase.ref_no').':*'); ?>

            <?php echo Form::text('ref_no', $invoice->ref_no, ['class' => 'form-control', 'required']); ?>

            <p class="help-block">
                <?php echo app('translator')->get('lang_v1.leave_empty_to_autogenerate'); ?>
            </p>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <?php echo Form::label('transaction_date', __('messages.date') . ':*'); ?>

            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </span>
              <?php echo Form::text('transaction_date', \Carbon::createFromTimestamp(strtotime($invoice->transaction_date))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'readonly', 'required', 'id' => 'expense_transaction_date']); ?>

            </div>
          </div>
        </div>

        <div class="clearfix"></div>
        
        <div class="col-sm-4">
          <div class="form-group">
            <?php echo Form::label('expense_for', __('expense.expense_for').':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.expense_for') . '"></i>';
                }
            ?>
            <?php echo Form::select('expense_for', $users, $invoice->expense_for, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

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
							<?php echo Form::text('truckmate_week_start', \Carbon::createFromTimestamp(strtotime($invoice->week_start))->format(session('business.date_format')), ['class' => 'form-control', 'readonly', 'required', 'style' => 'pointer-events: none;background-color:#F5F5F5;']); ?>

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
							<?php echo Form::text('truckmate_week_end', \Carbon::createFromTimestamp(strtotime($invoice->week_end))->format(session('business.date_format')), ['class' => 'form-control', 'readonly', 'required', 'style' => 'pointer-events: none;background-color:#F5F5F5;']); ?>

						</div>
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
                  <?php echo $__env->make('truckmate::driver.invoice.weekdays_row', ['row_count' => 0, 'weekdays' => $invoice->weekdays], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

                <?php echo Form::textarea('staff_note', $invoice->staff_note, ['class' => 'form-control', 'rows' => 3]); ?>

          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <?php echo Form::label('final_total', __('sale.total_amount') . ':*'); ?>

            <?php echo Form::text('final_total', number_format($invoice->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'readonly', 'placeholder' => __('sale.total_amount'), 'required']); ?>

          </div>
        </div>
        
      </div>
    </div>
  </div>

<?php echo Form::close(); ?>


<div id="driver-invoice-footer-actions-template" class="d-none">
	<div>
		<button type="button" class="btn btn-primary" id="footer_driver_invoice_update">
			<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>
		</button>
	</div>
</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	$(document).ready( function(){
		// Footer button handler
		$(document).on('click', '#footer_driver_invoice_update', function() {
			$('form#add_driver_invoice').submit();
		});

		$('#expense_transaction_date').datetimepicker({
        format: moment_date_format + ' ' + moment_time_format,
        ignoreReadonly: true,
    });
    $('#expense_transaction_date').on('dp.change', function(e) {
        var transaction_date_value = $(this).val();
        $('#expense_transaction_date').val(transaction_date_value);
    });
    calculate_invoice_total();
  });
  __page_leave_confirmation('#add_driver_invoice');


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
	}

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>