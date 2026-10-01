<div class="modal-dialog modal-lg" role="document">
  	<div class="modal-content">
  		<div class="modal-header no-print">
	      	<h4 class="modal-title no-print">
	      		<?php echo __('essentials::lang.payroll_of_employee', ['employee' => $payroll->transaction_for->user_full_name, 'date' => $month_name . ' ' . $year]); ?>

	      	</h4>
	      	<button type="button" class="btn-close no-print" data-bs-dismiss="modal" aria-label="Close"></button>
	    </div>
	    <div class="modal-body">
	    	<div class="table-responsive">
		      	<table class="table table-bordered table-th-skin" id="payroll-view">
		      		<tr>
		      			<td colspan="3">
			      			<?php if(!empty(Session::get('business.logo'))): ?>
							<div class="text-center">
							  <?php
							    $logo_path = 'uploads/business_logos/'.Session::get('business.logo');
								if(!file_exists(public_path($logo_path))){
									$logo_path = 'uploads/'.Session::get('business.id').'/business_logos/'.Session::get('business.logo');            
								}
							  ?>
								<img src="<?php echo e(asset($logo_path), false); ?>" alt="Logo" style="width: auto; max-height: 80px; margin: auto;">
							</div>
			                <?php endif; ?>
			                <div class="float-end text-center">
			                	<strong class="font-23">
			                		<?php echo e(Session::get('business.name') ?? '', false); ?>

			                	</strong>
			                	<br>
			                	<?php echo Session::get('business.business_address') ?? ''; ?>

			                </div>
			                <br>
			                <div style="text-align: center;padding-top: 40px;">
			                	<?php echo app('translator')->get('essentials::lang.payslip_for_the_month', ['month' => $month_name, 'year' => $year]); ?>
			                </div>
		                </td>
		      		</tr>
		      		<tr>
		      			<td colspan="3">
		      				<div class="float-start" style="width: 50% !important;">
		      					<strong><?php echo app('translator')->get('essentials::lang.employee'); ?>:</strong>
		      					<?php echo e($payroll->transaction_for->user_full_name, false); ?><br>

		      					<strong><?php echo app('translator')->get('essentials::lang.department'); ?>:</strong>
		      					<?php echo e($department->name ?? '', false); ?>

		      					<br>

		      					<strong><?php echo app('translator')->get('essentials::lang.designation'); ?>:</strong>
		      					<?php echo e($designation->name ?? '', false); ?>


		      					<br>
		      					<strong><?php echo app('translator')->get('lang_v1.primary_work_location'); ?>:</strong>
		      					<?php if(!empty($location)): ?>
		      						<?php echo e($location->name, false); ?>

		      					<?php else: ?>
		      						<?php echo e(__('report.all_locations'), false); ?>

		      					<?php endif; ?>
		      					<br>

		      					<?php if(!empty($payroll->transaction_for->id_proof_name) && !empty($payroll->transaction_for->id_proof_number)): ?>
		      						<strong>
		      							<?php echo e(ucfirst($payroll->transaction_for->id_proof_name), false); ?>:
		      						</strong>
		      						<?php echo e($payroll->transaction_for->id_proof_number, false); ?>

		      						<br>
		      					<?php endif; ?>

		      					<strong><?php echo app('translator')->get('lang_v1.tax_payer_id'); ?>:</strong>
		      					<?php echo e($bank_details['tax_payer_id'] ?? '', false); ?>

		      					<br>
		      				</div>
		      				<div class="float-end" style="width: 50% !important;">
		      					<strong><?php echo app('translator')->get('lang_v1.bank_name'); ?>:</strong>
		      					<?php echo e($bank_details['bank_name'] ?? '', false); ?>

		      					<br>

		      					<strong><?php echo app('translator')->get('lang_v1.branch'); ?>:</strong>
		      					<?php echo e($bank_details['branch'] ?? '', false); ?>

		      					<br>

		      					<strong><?php echo app('translator')->get('lang_v1.bank_code'); ?>:</strong>
		      					<?php echo e($bank_details['bank_code'] ?? '', false); ?>

		      					<br>
		      					
		      					<strong><?php echo app('translator')->get('lang_v1.account_holder_name'); ?>:</strong>
		      					<?php echo e($bank_details['account_holder_name'] ?? '', false); ?>

		      					<br>

		      					<strong><?php echo app('translator')->get('lang_v1.bank_account_no'); ?>:</strong>
		      					<?php echo e($bank_details['account_number'] ?? '', false); ?>

		      					<br>
		      				</div>
		      			</td>
		      		</tr>
		      		<tr>
		      			<td>
		      				<strong><?php echo app('translator')->get('essentials::lang.total_work_duration'); ?>:</strong>
		      				<?php echo e((int)$total_work_duration, false); ?>

		      			</td>
		      			<td>
		      				<strong><?php echo app('translator')->get('essentials::lang.days_present'); ?>:</strong>
		      				<?php echo e($total_days_present, false); ?>

		      			</td>
		      			<td>
		      				<strong><?php echo app('translator')->get('essentials::lang.days_absent'); ?>:</strong>
		      				<?php echo e($total_leaves, false); ?>

		      			</td>
		      		</tr>
		      		<tr>
		      			<td colspan="3"></td>
		      		</tr>
		      		<tr>
						<td colspan="2" style="width: 50% !important;">
							<div style="width: 50% !important; float: left;">
								<strong><?php echo app('translator')->get('essentials::lang.allowances'); ?></strong>
							</div>
							<div style="width: 30% !important;float: right;">
								<strong><?php echo app('translator')->get('sale.amount'); ?></strong>
							</div>
							<div style="width: 20% !important;float: right;">
								<strong><?php echo app('translator')->get('essentials::lang.rate'); ?></strong>
							</div>
						</td>
						<td style="width: 50% !important;">
							<div style="width: 50% !important; float: left;">
								<strong><?php echo app('translator')->get('essentials::lang.deductions'); ?></strong>
							</div>
							<div style="width: 30% !important;float: right;">
								<strong><?php echo app('translator')->get('sale.amount'); ?></strong>
							</div>
							<div style="width: 20% !important;float: right;">
								<strong><?php echo app('translator')->get('essentials::lang.rate'); ?></strong>
							</div>
						</td>
					</tr>
		      		<tr>
						<td colspan="2" style="width: 50% !important;">
							<?php
		                        $total_earnings = $payroll->essentials_duration * $payroll->essentials_amount_per_unit_duration;
		                    ?>
		                    <div style="width: 50% !important; float: left;">
								<?php echo app('translator')->get('essentials::lang.salary'); ?> 12
							</div>
							<div style="width: 30% !important;float: right;">
								<span class="display_currency" data-currency_symbol="true">
									<?php echo e($payroll->essentials_duration * $payroll->essentials_amount_per_unit_duration, false); ?>

								</span>
								<br>
								<small>
									(
									<?php echo e(number_format($payroll->essentials_duration, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($payroll->essentials_duration_unit, false); ?> * <?php echo e(number_format($payroll->essentials_amount_per_unit_duration, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

									)
								</small>
							</div>
							<div style="width: 20% !important;float: right;">
								
							</div><br><br>
		                    <?php $__empty_18 = true; $__currentLoopData = $allowances['allowance_names']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
								<div style="width: 50% !important; float: left;">
									<?php echo e($value, false); ?>

								</div>
								<div style="width: 30% !important;float: right;">
									<span class="display_currency" data-currency_symbol="true">
										<?php echo e($allowances['allowance_amounts'][$key], false); ?>

									</span>
								</div>
								<div style="width: 20% !important;float: right;">
									<?php if(!empty($allowances['allowance_types'][$key]) 
		                    		&& $allowances['allowance_types'][$key] == 'percent'): ?>
		                    			<?php echo e(number_format($allowances['allowance_percents'][$key], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>%
		                    		<?php endif; ?>
								</div>
								<?php
		                            $total_earnings += !empty($allowances['allowance_amounts'][$key]) ? $allowances['allowance_amounts'][$key] : 0;
		                        ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
		                       
		                    <?php endif; ?>
						</td>
						<td colspan="2" style="width: 50% !important;">
							<?php
		                        $total_deduction = 0;
		                    ?>
		                    <?php $__empty_18 = true; $__currentLoopData = $deductions['deduction_names']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
								<div style="width: 50% !important; float: left;">
									<?php echo e($value, false); ?>

								</div>
								<div style="width: 30% !important;float: right;">
									<span class="display_currency" data-currency_symbol="true">
										<?php echo e($deductions['deduction_amounts'][$key], false); ?>

									</span>
								</div>
								<div style="width: 20% !important;float: right;">
									<?php if(!empty($deductions['deduction_types'][$key]) 
			                    		&& $deductions['deduction_types'][$key] == 'percent'): ?>
		                    			<?php echo e(number_format($deductions['deduction_percents'][$key], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>%
		                    		<?php endif; ?>
								</div>
								<?php
		                            $total_deduction += !empty($deductions['deduction_amounts'][$key]) ? $deductions['deduction_amounts'][$key] : 0;
		                        ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
								<?php if(empty($payroll->essentials_salary_tax)): ?>
								<div style="width: 100% !important; text-align: center;">
		                       		<?php echo app('translator')->get('lang_v1.none'); ?>
								</div>
		                       <?php endif; ?>
		                    <?php endif; ?>
		                    <?php if(!empty($payroll->essentials_salary_tax)): ?>
								<div style="width: 50% !important; float: left;">
									<?php echo app('translator')->get('essentials::lang.salary_tax'); ?> (TY <?php echo e($payroll->essentials_tax_year, false); ?>)
								</div>
								<div style="width: 30% !important;float: right;">
									<span class="display_currency" data-currency_symbol="true"><?php echo e($payroll->essentials_salary_tax, false); ?></span>
								</div>
								<div style="width: 20% !important;float: right;"></div>
								<?php $total_deduction += $payroll->essentials_salary_tax; ?>
		                    <?php endif; ?>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="width: 50% !important;">
							<div style="width: 50% !important; float: left;">
								<strong>
									<?php echo app('translator')->get('essentials::lang.total_earnings'); ?>:
								</strong>
							</div>
							<div style="width: 30% !important;float: right;">
								<strong>
									<span class="display_currency" data-currency_symbol="true">
										<?php echo e($total_earnings, false); ?>

									</span>
								</strong>
							</div>
							<div style="width: 20% !important;float: right;">
								
							</div>
						</td>
						<td style="width: 50% !important;">
							<div style="width: 50% !important; float: left;">
								<strong>
									<?php echo app('translator')->get('essentials::lang.total_deductions'); ?>:
								</strong>
							</div>
							<div style="width: 30% !important;float: right;">
								<strong>
									<span class="display_currency" data-currency_symbol="true">
										<?php echo e($total_deduction, false); ?>

									</span>
								</strong>
							</div>
							<div style="width: 20% !important;float: right;">
								
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="3" style="text-align: right;">
							<div style="width: 43% !important;float: right;padding-right: 49px">
								<span class="display_currency" data-currency_symbol="true">
									<?php echo e($total_earnings - $total_deduction, false); ?>

								</span>
							</div>
							<div style="width: 57% !important;">
								<strong>
									<?php echo app('translator')->get('essentials::lang.net_pay'); ?>
								</strong>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="3">
							<strong><?php echo app('translator')->get('essentials::lang.in_words'); ?>:</strong> <?php echo e(ucfirst($final_total_in_words), false); ?>

						</td>
					</tr>
					<tr>
						<td colspan="3">
							<strong><?php echo e(__('sale.payment_info'), false); ?>:</strong>
							<table class="table bg-gray table-slim table-th-skin">
							<tr class="bg-green">
								<th>#</th>
								<th><?php echo e(__('messages.date'), false); ?></th>
								<th><?php echo e(__('purchase.ref_no'), false); ?></th>
								<th><?php echo e(__('sale.amount'), false); ?></th>
								<th><?php echo e(__('sale.payment_mode'), false); ?></th>
								<th><?php echo e(__('sale.payment_note'), false); ?></th>
							</tr>
							<?php
								$total_paid = 0;
							?>
							<?php $__empty_18 = true; $__currentLoopData = $payroll->payment_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
								<?php
									if($payment_line->is_return == 1){
									  $total_paid -= $payment_line->amount;
									} else {
									  $total_paid += $payment_line->amount;
									}
								?>
								<tr>
									<td><?php echo e($loop->iteration, false); ?></td>
									<td><?php echo e(\Carbon::createFromTimestamp(strtotime($payment_line->paid_on))->format(session('business.date_format')), false); ?></td>
									<td><?php echo e($payment_line->payment_ref_no, false); ?></td>
									<td><span class="display_currency" data-currency_symbol="true"><?php echo e($payment_line->amount, false); ?></span></td>
									<td>
									  	<?php echo e($payment_types[$payment_line->method], false); ?>

									</td>
									<td><?php if($payment_line->note): ?> 
									  <?php echo e(ucfirst($payment_line->note), false); ?>

									  <?php else: ?>
									  --
									  <?php endif; ?>
									</td>
								</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
								<tr><td colspan="6" class="text-center"><?php echo app('translator')->get('purchase.no_records_found'); ?></td></tr>
							<?php endif; ?>
							<tr>
								<td colspan="3" style="text-align: right;color: #525f7f;">
									<strong><?php echo app('translator')->get('lang_v1.paid'); ?>:</strong>
								</td>
								<td>
								<span class="display_currency" data-currency_symbol="true">
									<?php echo e($total_paid, false); ?>

								</span>
								</td>
								<td colspan="2"></td>
							</tr>
						</table>
						<tr>
							<td colspan="3" style="text-align: right;">
								<div style="width: 40% !important;float: right;padding-right: 49px">
									<span class="display_currency" data-currency_symbol="true">
										<?php echo e(($total_earnings - $total_deduction) - $total_paid, false); ?>

									</span>
								</div>
								<div style="width: 60% !important;">
									<strong>
										<?php echo app('translator')->get('essentials::lang.net_payable'); ?>
									</strong>
								</div>
							</td>
								
						</tr>
						</td>
					</tr>
					<tr>
						<td colspan="3">
							<strong><?php echo app('translator')->get('brand.note'); ?>:</strong><br>
							<?php echo e($payroll->staff_note ?? '', false); ?>

						</td>
					</tr>
		      	</table>
	      	</div>
	    </div>
	    <div class="modal-footer no-print">
	      	<button type="button" class="btn btn-primary" aria-label="Print" onclick="$(this).closest('div.modal-content').find('.modal-body').printThis();">
	      		<i class="fa fa-print"></i> <?php echo app('translator')->get( 'messages.print' ); ?>
      		</button>
	      	<button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
	    </div>
  	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<style type="text/css">
	#payroll-view>thead>tr>th, #payroll-view>tbody>tr>th,
	#payroll-view>tfoot>tr>th, #payroll-view>thead>tr>td,
	#payroll-view>tbody>tr>td, #payroll-view>tfoot>tr>td {
		border: 1px solid #1d1a1a;
	}
</style>
