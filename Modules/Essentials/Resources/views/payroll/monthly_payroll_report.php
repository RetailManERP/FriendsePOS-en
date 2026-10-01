<?php if(request('action') == 'print'): ?>
<style>
    .col-md-6, .col-sm-6, .col-xs-6 {
        float: left;
        width: 50%;
        box-sizing: border-box;
    }

	.col-md-12{
		float: left;
        width: 100%;
        box-sizing: border-box;
	}
    .text-right {
        text-align: right !important;
    }
    .align-right {
        text-align: right;
    }
    .align-left {
        text-align: left;
    }
	.align-center {
		text-align: center;
	}

    table {
        border: 1px solid black;
        border-spacing: 0;
        width: 100%;
        /* margin-bottom: 10px; */
    }
    
    thead {
        border: 5px solid black;
    }

    tbody {
        /* border: 5px solid black; */
    }

    tr {
        /* border: 0.5px solid black; */
    }

    th {
        border: 1px solid black;
    }
    
    td {
        border: 0.5px solid black;
		padding: 5px;
    }
	.hide {
		display: none;
	}
	.btn-modal{
		text-decoration: none;
		color:black;
	}
	.pull-right{
		float: right;
	}
	.pull-left{
		float: left;
	}
	.text-right{
		text-align: right;
	}
	.text-left{
		text-align: left;
	}
	.text-center{
		text-align: center;
	}
	.width-100{
		width: 100%
	}
	.width-60{
		width: 60%
	}
	.width-50{
		width: 50%
	}
	.width-40{
		width: 40%
	}
	.bg-gray{
		background-color : #ccc !important;
	}
	p{
		margin: 0px;
	}
	.clearfix::after {
		display: block;
		clear: both;
		content: "";
	}
	body{
		font-family: Calibri;
	}
</style>
<?php endif; ?>
<div class="filters width-100 text-center <?php if(request('action') != 'print'): ?> hide <?php endif; ?>" style="display:inline-block;">
	<h1 style="margin: 5px;text-decoration: underline;"><?php echo e(session()->get('business.name'), false); ?></h1>
	<h3 style="text-decoration: underline;margin: 5px;">Monthly Payroll Report for <?php echo e($month, false); ?> (<?php echo e($year, false); ?>)</h3>
	<br>
</div>
<div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="monthly_payroll_table" style="width: 100%;">
	<thead>
		<tr>
			<th class="text-center" style="width: 3%">#</th>
			<th class="text-center" style="width: 3%">
				Emp. ID
			</th>
			<th class="text-center" style="width: 3%"><?php echo app('translator')->get( 'lang_v1.id_proof_number' ); ?></th>
			<th class="text-center" style="width: 22%">
				<?php echo app('translator')->get('essentials::lang.employee'); ?>
			</th>
			<th class="text-center" style="width: 5%">
				<p><?php echo app('translator')->get('essentials::lang.salary'); ?></p>
				<p><?php echo app('translator')->get('essentials::lang.appointment_date_short'); ?></p>
			</th>
			<th class="text-center" style="width: 2%">
				<?php echo app('translator')->get( 'essentials::lang.net_work_days' ); ?>
			</th>
			<th class="text-center" style="width: 5%">
				<?php echo app('translator')->get( 'essentials::lang.earned_salary' ); ?>
			</th>
			<th class="text-center">
				<?php echo app('translator')->get('essentials::lang.allowances'); ?>
			</th>
			<th class="text-center">
				<?php echo app('translator')->get( 'essentials::lang.deductions' ); ?>
			</th>
			<th class="text-center" style="width: 5%">
				<?php echo app('translator')->get( 'essentials::lang.gross_payable' ); ?>
			</th>
			<th class="text-center" style="width: 5%">
				<?php echo app('translator')->get( 'sale.advance_paid' ); ?>
			</th>
			<th class="text-center" style="width: 5%">
				<?php echo app('translator')->get( 'essentials::lang.net_payable' ); ?>
			</th>
			<th class="text-center" style="width: 10%">
				<?php echo app('translator')->get( 'essentials::lang.signature_thumb' ); ?>
			</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$count = 1;
		$basic_salary_total = 0;
		$earned_salary_total = 0;
		$gross_payable_total = 0;
		$paid_total = 0;
		$due_total = 0;
		?>
		<?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr class="bg-gray">
				<td colspan="13">
					<?php echo app('translator')->get('essentials::lang.department'); ?> : <b><?php echo e($d, false); ?></b>
				</td>
			</tr>
			<?php $__currentLoopData = $payrolls[$d]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php
			$basic_salary_total += $e['essentials_amount_per_unit_duration'];
			$earned_salary_total += $e['basic_salary'];
			$gross_payable_total += $e['final_total'];
			$paid_total += $e['paid_total'];
			$due_total += $e['due_total'];
			?>
				<tr>
					<td class="text-center"><?php echo e($count, false); ?></td>
					<td class="text-center" style="width: 3%">
						<?php echo e($e['employee_id'], false); ?>

					</td>
					<td class="text-center" style="width: 3%">
						<?php echo e($e['id_proof_number'], false); ?>

					</td>
					<td style="width: 22%">
						<p class="pull-left width-50">
							<?php echo e($e['name'], false); ?> <?php if(!empty($e['guardian_name'])): ?> <br> <small>&nbsp; s/o <?php echo e($e['guardian_name'], false); ?></small> <?php endif; ?>
						</p>
						<p class="pull-right text-right width-50"><small>Cell# <?php echo e($e['contact_number'], false); ?></small></p>
						<div class="clearfix"></div>
						<br>
						<p class="pull-left width-50">
							<?php echo e($e['sub_department'] . ' - '. $e['designation'], false); ?> 
						</p>
						<p class="pull-right text-right width-50"><?php echo e($e['cnic'], false); ?> </p>
					</td>
					<td class="text-center">
						<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $e['essentials_amount_per_unit_duration'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> <br>/ <?php echo e($e['essentials_duration_unit'], false); ?>

						<br>
						<small><?php echo e($e['appointment_date'], false); ?></small>
					</td>
					<td class="text-center">
						<?php echo e($e['details']['attendance_days'], false); ?>

					</td class="text-center">
					<td class="text-center">
						<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $e['basic_salary'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
					</td>
					<td>
						<?php $__currentLoopData = $e['allowances']['allowance_names']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<p class="width-50 pull-left">
								<?php echo e($value, false); ?>:
								<?php if(!empty($e['allowances']['allowance_types'][$key]) && $e['allowances']['allowance_types'][$key] == 'percent'): ?>
									<br><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $e['allowances']['allowance_percents'][$key], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>%
								<?php endif; ?>
							</p>
							<p class="width-50 pull-left text-right">
								<span class="display_currency" data-currency_symbol="true">
									<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $e['allowances']['allowance_amounts'][$key], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
								</span>
							</p>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</td>
					<td>
						<?php $__currentLoopData = $e['deductions']['deduction_names']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<p class="width-50 pull-left">
								<?php echo e($value, false); ?>: 
								<?php if(!empty($e['deductions']['deduction_types'][$key]) && $e['deductions']['deduction_types'][$key] == 'percent'): ?>
									<br><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $e['deductions']['deduction_percents'][$key], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>%
								<?php endif; ?>
							</p>
							<p class="width-50 pull-left text-right">
								<span class="display_currency" data-currency_symbol="true">
									<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $e['deductions']['deduction_amounts'][$key], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
								</span>
							</p>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php if(!empty($e['salary_tax'])): ?>
							<p class="width-50 pull-left"><?php echo app('translator')->get('essentials::lang.salary_tax'); ?> (TY <?php echo e($e['tax_year'], false); ?>):</p>
							<p class="width-50 pull-left text-right"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $e['salary_tax'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></p>
						<?php endif; ?>
					</td>
					<td class="text-center">
						<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $e['final_total'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
					</td class="text-center">
					<td class="text-center">
						<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $e['paid_total'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
					</td>
					<td class="text-center">
						<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $e['due_total'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
					</td>
					<td></td>
				</tr>
				<?php
				$count++;
				?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<tr class="bg-gray">
			<th colspan="4"></th>
			<th><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $basic_salary_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
			<th></th>
			<th><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $earned_salary_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
			<th colspan="2"></th>
			<th><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $gross_payable_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
			<th><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $paid_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
			<th><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $due_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>	
			<th></th>
		</tr>
	</tbody>
</table>
</div>
<div class="row <?php if(request('action') == 'print'): ?> hide <?php endif; ?>">
	<div class="col-md-1 col-md-offset-11">
		<button type="button"  id="print_monthly_payroll_report" class="btn btn-success pull-right"><i class="fa fa-print"></i> Print</button>
	</div>
</div>
<?php if(request('action') == 'print'): ?>
<script>
	window.print();
</script>
<?php endif; ?>
