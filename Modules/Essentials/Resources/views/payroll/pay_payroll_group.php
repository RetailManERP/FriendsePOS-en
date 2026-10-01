
<?php $__env->startSection('title', __('essentials::lang.add_payment_for_payroll_group')); ?>
<?php $__env->startSection('css'); ?>
<style>
	.payroll-group-payment-table {
		overflow: visible !important;
	}

	.payroll-group-payment-table .table {
		margin-bottom: 0;
	}

	.bootstrap-datetimepicker-widget.payroll-group-payment-picker,
	.bootstrap-datetimepicker-widget.dropdown-menu.payroll-group-payment-picker {
		z-index: 13050 !important;
	}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('essentials::layouts.nav_hrm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header">
	<h1>
    	<?php echo app('translator')->get('essentials::lang.add_payment_for_payroll_group'); ?>
    	<small><code>(<?php echo e($payroll_group->name, false); ?>)</code></small>
    </h1>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<?php echo Form::open(['url' => action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'postAddPayment']), 'method' => 'post', 'id' => 'payroll_group_payment' ]); ?>

		<?php echo Form::hidden('payroll_group_id', $payroll_group->id); ?>

		<div class="col-md-12">
			<div class="box box-primary" id="payroll-group">
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<h3 class="text-center">
	                            <u><?php echo __('essentials::lang.payroll_for_month', ['date' => $month_name . ' ' . $year]); ?></u>
	                        </h3>
						</div>
					</div>
					<div class="row margin-bottom-20">
						<div class="col-md-6 text-center">
							<strong class="font-23"><?php echo e($payroll_group->business->name, false); ?></strong> <br>
							<?php if(!empty($payroll_group->businessLocation)): ?>
								<?php echo e($payroll_group->businessLocation->name, false); ?> <br>
								<?php echo $payroll_group->businessLocation->location_address; ?>

							<?php else: ?>
								<?php echo e(__('report.all_locations'), false); ?>

							<?php endif; ?>
						</div>
						<div class="col-md-6 text-center">
							<b class="font-17">
								<?php echo app('translator')->get('essentials::lang.payroll_group'); ?>:
							</b>
							<?php echo e($payroll_group->name, false); ?> <br>
							<b class="font-17">
								<?php echo app('translator')->get('sale.status'); ?>:
							</b>
							<?php echo app('translator')->get('sale.'.$payroll_group->status); ?>
						</div>
					</div>
	                <div class="table-responsive mt-15 payroll-group-payment-table">
	                    <table class="table table-th-skin" id="payroll-group-table" style="width: 100% !important;">
                            <tr>
                                <th><?php echo app('translator')->get( 'essentials::lang.employee' ); ?></th>
                                <th><?php echo app('translator')->get( 'essentials::lang.gross_amount' ); ?></th>
                                <th><?php echo app('translator')->get('lang_v1.bank_details'); ?></th>
								<th><?php echo app('translator')->get('sale.total_paid'); ?></th>
                                <th>
                                	<?php echo app('translator')->get('purchase.add_payment'); ?>
                                </th>
                            </tr>
                        	<?php $__currentLoopData = $payrolls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $payroll): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                        	<tr data-id="<?php echo e($id, false); ?>">
	                        		<input type="hidden" name="payments[<?php echo e($id, false); ?>][transaction_id]" value="<?php echo e($payroll['transaction_id'], false); ?>">
                        			<input type="hidden" name="payments[<?php echo e($id, false); ?>][employee_id]" value="<?php echo e($payroll['employee_id'], false); ?>">
                        			<input type="hidden" name="payments[<?php echo e($id, false); ?>][final_total]" value="<?php echo e($payroll['final_total'], false); ?>">
	                        		<td>
	                        			<?php echo e($payroll['employee'], false); ?>

	                        		</td>
	                        		<td>
	                        			<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $payroll['final_total'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
	                        		</td>
	                        		<td>
	                        			<strong><?php echo app('translator')->get('lang_v1.bank_name'); ?>:</strong>
				      					<?php echo e($payroll['bank_details']['bank_name'] ?? '', false); ?>

				      					<br>

				      					<strong><?php echo app('translator')->get('lang_v1.branch'); ?>:</strong>
				      					<?php echo e($payroll['bank_details']['branch'] ?? '', false); ?>

				      					<br>

				      					<strong><?php echo app('translator')->get('lang_v1.bank_code'); ?>:</strong>
				      					<?php echo e($payroll['bank_details']['bank_code'] ?? '', false); ?>

				      					<br>
				      					
				      					<strong><?php echo app('translator')->get('lang_v1.account_holder_name'); ?>:</strong>
				      					<?php echo e($payroll['bank_details']['account_holder_name'] ?? '', false); ?>

				      					<br>

				      					<strong><?php echo app('translator')->get('lang_v1.bank_account_no'); ?>:</strong>
				      					<?php echo e($payroll['bank_details']['account_number'] ?? '', false); ?>

				      					<br>
				      					<strong><?php echo app('translator')->get('lang_v1.tax_payer_id'); ?>:</strong>
				      					<?php echo e($payroll['bank_details']['tax_payer_id'] ?? '', false); ?>

				      					<br>
	                        		</td>
									<td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $payroll['paid_amount'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
	                        		<td>
	                        			<?php if($payroll['payment_status'] == 'paid'): ?>
	                        				<span class="label bg-light-green">
	                        					<i class="fas fa-check-circle"></i>
	                        					<?php echo app('translator')->get('lang_v1.paid'); ?>
	                        				</span>
	                        			<?php else: ?>
		                        			<?php if ($__env->exists('essentials::payroll.payment_row')) echo $__env->make('essentials::payroll.payment_row', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    	<?php endif; ?>
	                        		</td>
	                        	</tr>
	                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                    </table>
	                </div>
            	</div>
            	<button type="submit" class="btn btn-primary float-end m-8" id="submit_user_button">
	                <?php echo e(__( 'lang_v1.pay' ), false); ?>

	            </button>
            </div>
		</div>
		<?php echo Form::close(); ?>

  	</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	$(function () {
		$('.paid_on').datetimepicker({
            format: moment_date_format + ' ' + moment_time_format,
            ignoreReadonly: true,
            widgetParent: 'body',
        }).on('dp.show', function () {
            $('.bootstrap-datetimepicker-widget').last().addClass('payroll-group-payment-picker');
        });

        $('select.payment_types').on('change', function () {
        	let method = $(this).find(':selected').val();
        	let id = $(this).data('id');
        	if (method == 'card') {
        		$('#card_' + id).show();
        		$(`#custom_pay_1_${id}, #custom_pay_2_${id}, #custom_pay_3_${id}, #cheque_${id}, #bank_transfer_${id}`).hide();
        	} else if (method == 'cheque') {
        		$('#cheque_' + id).show();
        		$(`#custom_pay_1_${id}, #custom_pay_2_${id}, #custom_pay_3_${id}, #bank_transfer_${id}, #card_${id}`).hide();
        	} else if (method == 'bank_transfer') {
        		$('#bank_transfer_' + id).show();
        		$(`#custom_pay_1_${id}, #custom_pay_2_${id}, #custom_pay_3_${id}, #cheque_${id}, #card_${id}`).hide();
        	} else if (method == 'custom_pay_1') {
        		$('#custom_pay_1_' + id).show();
        		$(`#custom_pay_2_${id}, #custom_pay_3_${id}, #cheque_${id}, #bank_transfer_${id}, #card_${id}`).hide();
        	} else if (method == 'custom_pay_2') {
        		$('#custom_pay_2_' + id).show();
        		$(`#custom_pay_1_${id}, #custom_pay_3_${id}, #cheque_${id}, #bank_transfer_${id}, #card_${id}`).hide();
        	} else if (method == 'custom_pay_3') {
        		$('#custom_pay_3_' + id).show();
        		$(`#custom_pay_1_${id}, #custom_pay_2_${id}, #cheque_${id}, #bank_transfer_${id}, #card_${id}`).hide();
        	} else {
        		$(`#custom_pay_1_${id}, #custom_pay_2_${id}, #custom_pay_3_${id}, #cheque_${id}, #bank_transfer_${id}, #card_${id}`).hide();
        	}
        });
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>