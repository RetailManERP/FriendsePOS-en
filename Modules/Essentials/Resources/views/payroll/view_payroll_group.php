
<?php $__env->startSection('title', __('essentials::lang.view_payroll_group')); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('essentials::layouts.nav_hrm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header">
	<h1>
    	<?php echo app('translator')->get('essentials::lang.view_payroll_group'); ?>
    	<small><code>(<?php echo e($payroll_group->name, false); ?>)</code></small>
    </h1>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary" id="payroll-group">
				<div class="box-header no-print">
					<div class="box-tools">
						<button type="button" class="btn btn-primary" aria-label="Print" id="print_payrollgroup">
							<i class="fa fa-print"></i>
							<?php echo app('translator')->get( 'messages.print' ); ?>
				      	</button>
			      	</div>
			    </div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<h3 class="text-center">
	                            <u><?php echo __('essentials::lang.payroll_for_month', ['date' => $month_name . ' ' . $year]); ?></u>
	                        </h3>
						</div>
					</div>
					<div class="row margin-bottom-20">
						<div class="col-md-6 text-center mt-5">
							<strong class="font-23"><?php echo e($payroll_group->business->name, false); ?></strong> <br>
							<?php if(!empty($payroll_group->businessLocation)): ?>
								<?php echo e($payroll_group->businessLocation->name, false); ?> <br>
								<?php echo $payroll_group->businessLocation->location_address; ?>

							<?php else: ?>
								<?php echo e(__('report.all_locations'), false); ?>

							<?php endif; ?>
						</div>
						<div class="col-md-6 text-center mt-5">
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
	                <div class="table-responsive mt-15">
	                    <table class="table table-th-skin" id="payroll-group-table" style="width: 100% !important;">
	                        <thead>
	                            <tr>
	                                <th style="width: 12% !important;"><?php echo app('translator')->get( 'essentials::lang.employee' ); ?></th>
	                                <th style="width: 20% !important;"><?php echo app('translator')->get( 'essentials::lang.allowances' ); ?></th>
	                                <th style="width: 20% !important;"><?php echo app('translator')->get( 'essentials::lang.deductions' ); ?></th>
	                                <th style="width: 10% !important;"><?php echo app('translator')->get( 'essentials::lang.gross_amount' ); ?></th>
	                                <th style="width: 10% !important;"><?php echo app('translator')->get( 'essentials::lang.paid_amount' ); ?></th>
	                                <th style="width: 10% !important;"><?php echo app('translator')->get( 'essentials::lang.due_amount' ); ?></th>
	                                <th style="width: 22% !important;"><?php echo app('translator')->get('lang_v1.bank_details'); ?></th>
	                                <th><?php echo app('translator')->get('sale.payment_status'); ?></th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        	<?php $__currentLoopData = $payrolls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $payroll): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                        	<tr>
		                        		<td>
		                        			<?php echo e($payroll['employee'], false); ?>

		                        		</td>
										<td>
											<?php
												$total_earnings = $payroll['essentials_duration'] * $payroll['essentials_amount_per_unit_duration'];
											?>
											<div style="width: 50% !important; float: left;">
												<?php echo app('translator')->get('essentials::lang.salary'); ?>
											</div>
											<div style="width: 50% !important;float: right;">
												<span class="display_currency" data-currency_symbol="true">
													<?php echo e($payroll['essentials_duration'] * $payroll['essentials_amount_per_unit_duration'], false); ?>

												</span>
												
											</div>
											<br>
											<?php $__currentLoopData = $payroll['allowances']['allowance_names']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<div style="width: 50% !important; float: left;">
													<?php echo e($value, false); ?>

												</div>
												<div style="width: 50% !important;float: right;">
													<span class="display_currency" data-currency_symbol="true">
														<?php echo e($payroll['allowances']['allowance_amounts'][$key], false); ?>

													</span>
												</div>
												<div style="width: 100% !important;float: right;">
													<?php if(!empty($payroll['allowances']['allowance_types'][$key]) 
													&& $payroll['allowances']['allowance_types'][$key] == 'percent'): ?>
														<?php echo e(number_format($payroll['allowances']['allowance_percents'][$key], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>%
													<?php endif; ?>
												</div>
												<?php
													$total_earnings += !empty($payroll['allowances']['allowance_amounts'][$key]) ? $payroll['allowances']['allowance_amounts'][$key] : 0;
												?>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<br>
											<div style="width: 50% !important; float: left;">
													<?php echo app('translator')->get('essentials::lang.total_earnings'); ?>:
											</div>
											<div style="width: 50% !important;float: right;">
													<span class="display_currency" data-currency_symbol="true">
														<?php echo e($total_earnings, false); ?>

													</span>
											</div>
		                        		</td>
										<td>
		                        			<?php
												$total_deduction = 0;
											?>
											<?php $__empty_18 = true; $__currentLoopData = $payroll['deductions']['deduction_names']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
												<div style="width: 50% !important; float: left;">
													<?php echo e($value, false); ?>

												</div>
												<div style="width: 30% !important;float: right;">
													<span class="display_currency" data-currency_symbol="true">
														<?php echo e($payroll['deductions']['deduction_amounts'][$key], false); ?>

													</span>
												</div>
												<div style="width: 20% !important;float: right;">
													<?php if(!empty($payroll['deductions']['deduction_types'][$key]) 
														&& $payroll['deductions']['deduction_types'][$key] == 'percent'): ?>
														<?php echo e(number_format($payroll['deductions']['deduction_percents'][$key], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>%
													<?php endif; ?>
												</div>
												<?php
													$total_deduction += !empty($payroll['deductions']['deduction_amounts'][$key]) ? $payroll['deductions']['deduction_amounts'][$key] : 0;
												?>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
											<div style="width: 100% !important; text-align: center;">
													<?php echo app('translator')->get('lang_v1.none'); ?>
											</div>
											<?php endif; ?>
											<br><br>
											<div style="width: 50% !important; float: left;margin-top:25px">
												<?php echo app('translator')->get('essentials::lang.total_deductions'); ?>:
											</div>
											<div style="width: 50% !important;float: right;margin-top:25px">
												<span class="display_currency" data-currency_symbol="true">
													<?php echo e($total_deduction, false); ?>

												</span>
											</div>
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
		                        			<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $payroll['paid_total'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
		                        		</td>
										<td>
		                        			<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $payroll['due_total'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

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
		                        		<td>
		                        			<?php echo e(__('lang_v1.'. $payroll['payment_status']), false); ?>

		                        		</td>
		                        	</tr>
		                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                        </tbody>
	                    </table>
	                </div>
            	</div>
            </div>
		</div>
  	</div>
</section>
<?php $__env->stopSection(); ?>
<style type="text/css">
	#payroll-group-table>thead>tr>th, #payroll-group-table>tbody>tr>th,
	#payroll-group-table>tfoot>tr>th, #payroll-group-table>thead>tr>td,
	#payroll-group-table>tbody>tr>td, #payroll-group-table>tfoot>tr>td {
		border: 1px solid #1d1a1a;
	}
</style>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	$(document).ready(function () {
		$('#print_payrollgroup').click( function(){
			$('#payroll-group').printThis();
		});
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>