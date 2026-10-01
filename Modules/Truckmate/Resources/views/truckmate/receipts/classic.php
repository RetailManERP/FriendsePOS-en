<!-- business information here -->

<style>
/* Product table borders for print */
    .print-table-bordered {
        border: 1px solid #000;
    }
    .print-table-bordered > thead > tr > th,
    .print-table-bordered > thead > tr > td,
    .print-table-bordered > tbody > tr > th,
    .print-table-bordered > tbody > tr > td,
    .print-table-bordered > tfoot > tr > th,
    .print-table-bordered > tfoot > tr > td {
        border: 1px solid #000;
        padding: 4px 6px;
    }
</style>
<div class="row">

	<!-- Logo -->
	<?php if(!empty($receipt_details->logo)): ?>
		<img src="<?php echo e($receipt_details->logo, false); ?>" class="img img-responsive center-block">
	<?php endif; ?>

	<!-- Header text -->
	<?php if(!empty($receipt_details->header_text)): ?>
		<div class="col-xs-12">
			<?php echo $receipt_details->header_text; ?>

		</div>
	<?php endif; ?>

	<!-- business information here -->
	<div class="col-xs-12 text-center">
		<h2 class="text-center">
			<!-- Shop & Location Name  -->
			<?php if(!empty($receipt_details->display_name)): ?>
				<?php echo e($receipt_details->display_name, false); ?>

			<?php endif; ?>
		</h2>

		<!-- Address -->
		<p>
		<?php if(!empty($receipt_details->address)): ?>
				<small class="text-center">
				<?php echo $receipt_details->address; ?>

				</small>
		<?php endif; ?>
		<?php if(!empty($receipt_details->contact)): ?>
			<br/><?php echo $receipt_details->contact; ?>

		<?php endif; ?>	
		<?php if(!empty($receipt_details->contact) && !empty($receipt_details->website)): ?>
			, 
		<?php endif; ?>
		<?php if(!empty($receipt_details->website)): ?>
			<?php echo e($receipt_details->website, false); ?>

		<?php endif; ?>
		<?php if(!empty($receipt_details->location_custom_fields)): ?>
			<br><?php echo e($receipt_details->location_custom_fields, false); ?>

		<?php endif; ?>
		</p>
		<p>
		<?php if(!empty($receipt_details->sub_heading_line1)): ?>
			<?php echo e($receipt_details->sub_heading_line1, false); ?>

		<?php endif; ?>
		<?php if(!empty($receipt_details->sub_heading_line2)): ?>
			<br><?php echo e($receipt_details->sub_heading_line2, false); ?>

		<?php endif; ?>
		<?php if(!empty($receipt_details->sub_heading_line3)): ?>
			<br><?php echo e($receipt_details->sub_heading_line3, false); ?>

		<?php endif; ?>
		<?php if(!empty($receipt_details->sub_heading_line4)): ?>
			<br><?php echo e($receipt_details->sub_heading_line4, false); ?>

		<?php endif; ?>		
		<?php if(!empty($receipt_details->sub_heading_line5)): ?>
			<br><?php echo e($receipt_details->sub_heading_line5, false); ?>

		<?php endif; ?>
		</p>
		<p>
		<?php if(!empty($receipt_details->tax_info1)): ?>
			<b><?php echo e($receipt_details->tax_label1, false); ?></b> <?php echo e($receipt_details->tax_info1, false); ?>

		<?php endif; ?>

		<?php if(!empty($receipt_details->tax_info2)): ?>
			<b><?php echo e($receipt_details->tax_label2, false); ?></b> <?php echo e($receipt_details->tax_info2, false); ?>

		<?php endif; ?>
		</p>

		<!-- Title of receipt -->
		<?php if(!empty($receipt_details->invoice_heading)): ?>
			<h3 class="text-center">
				<?php echo $receipt_details->invoice_heading; ?>

			</h3>
		<?php endif; ?>

		<!-- Invoice  number, Date  -->
		<table style="width:100%; border:none; border-collapse:collapse; margin-bottom:0;">
                <tr>
                    <td style="width:50%; vertical-align:top; text-align:left; padding:5px; border:none;">
				<?php if(!empty($receipt_details->invoice_no_prefix)): ?>
					<b><?php echo $receipt_details->invoice_no_prefix; ?></b>
				<?php endif; ?>
				<?php echo e($receipt_details->invoice_no, false); ?>


				<?php if(!empty($receipt_details->types_of_service)): ?>
					<br/>
					<span class="pull-left text-left">
						<strong><?php echo $receipt_details->types_of_service_label; ?>:</strong>
						<?php echo e($receipt_details->types_of_service, false); ?>

						<!-- Waiter info -->
						<?php if(!empty($receipt_details->types_of_service_custom_fields)): ?>
							<?php $__currentLoopData = $receipt_details->types_of_service_custom_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<br><strong><?php echo e($key, false); ?>: </strong> <?php echo e($value, false); ?>

							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>
					</span>
				<?php endif; ?>

				<!-- Table information-->
		        <?php if(!empty($receipt_details->table_label) || !empty($receipt_details->table)): ?>
		        	<br/>
					<span class="pull-left text-left">
						<?php if(!empty($receipt_details->table_label)): ?>
							<b><?php echo $receipt_details->table_label; ?></b>
						<?php endif; ?>
						<?php echo e($receipt_details->table, false); ?>


						<!-- Waiter info -->
					</span>
		        <?php endif; ?>

				<!-- customer info -->
				<?php if(!empty($receipt_details->customer_name)): ?>
					<br/>
					<b><?php echo e($receipt_details->customer_label, false); ?></b> <?php echo e($receipt_details->customer_name, false); ?> <br>
				<?php endif; ?>
				<?php if(!empty($receipt_details->customer_info)): ?>
					<?php echo $receipt_details->customer_info; ?>

				<?php endif; ?>
				<?php if(!empty($receipt_details->client_id_label)): ?>
					<br/>
					<b><?php echo e($receipt_details->client_id_label, false); ?></b> <?php echo e($receipt_details->client_id, false); ?>

				<?php endif; ?>
				<?php if(!empty($receipt_details->customer_tax_label)): ?>
					<br/>
					<b><?php echo e($receipt_details->customer_tax_label, false); ?></b> <?php echo e($receipt_details->customer_tax_number, false); ?>

				<?php endif; ?>
				<?php if(!empty($receipt_details->customer_custom_fields)): ?>
					<br/><?php echo $receipt_details->customer_custom_fields; ?>

				<?php endif; ?>
				<?php if(!empty($receipt_details->sales_person_label)): ?>
					<br/>
					<b><?php echo e($receipt_details->sales_person_label, false); ?></b> <?php echo e($receipt_details->sales_person, false); ?>

				<?php endif; ?>
				<?php if(!empty($receipt_details->customer_rp_label)): ?>
					<br/>
					<strong><?php echo e($receipt_details->customer_rp_label, false); ?></strong> <?php echo e($receipt_details->customer_total_rp, false); ?>

				<?php endif; ?>
			</td>
                    <td style="width:50%; vertical-align:top; text-align:right; padding:5px; border:none;">
				<b><?php echo e($receipt_details->date_label, false); ?></b> <?php echo e($receipt_details->invoice_date, false); ?>


				<?php if(!empty($receipt_details->due_date_label)): ?>
				<br><b><?php echo e($receipt_details->due_date_label, false); ?></b> <?php echo e($receipt_details->due_date ?? '', false); ?>

				<?php endif; ?>

				<?php if(!empty($receipt_details->brand_label) || !empty($receipt_details->truckmate_brand)): ?>
					<br>
					<?php if(!empty($receipt_details->brand_label)): ?>
						<b><?php echo $receipt_details->brand_label; ?></b>
					<?php endif; ?>
					<?php echo e($receipt_details->truckmate_brand, false); ?>

		        <?php endif; ?>


		        <?php if(!empty($receipt_details->device_label) || !empty($receipt_details->truckmate_device)): ?>
					<br>
					<?php if(!empty($receipt_details->device_label)): ?>
						<b><?php echo $receipt_details->device_label; ?></b>
					<?php endif; ?>
					<?php echo e($receipt_details->truckmate_device, false); ?>

		        <?php endif; ?>

				<?php if(!empty($receipt_details->model_no_label) || !empty($receipt_details->truckmate_model_no)): ?>
					<br>
					<?php if(!empty($receipt_details->model_no_label)): ?>
						<b><?php echo $receipt_details->model_no_label; ?></b>
					<?php endif; ?>
					<?php echo e($receipt_details->truckmate_model_no, false); ?>

		        <?php endif; ?>

				<?php if(!empty($receipt_details->serial_no_label) || !empty($receipt_details->truckmate_serial_no)): ?>
					<br>
					<?php if(!empty($receipt_details->serial_no_label)): ?>
						<b><?php echo $receipt_details->serial_no_label; ?></b>
					<?php endif; ?>
					<?php echo e($receipt_details->truckmate_serial_no, false); ?><br>
		        <?php endif; ?>
				<?php if(!empty($receipt_details->truckmate_status_label) || !empty($receipt_details->truckmate_status)): ?>
					<?php if(!empty($receipt_details->truckmate_status_label)): ?>
						<b><?php echo $receipt_details->truckmate_status_label; ?></b>
					<?php endif; ?>
					<?php echo e($receipt_details->truckmate_status, false); ?><br>
		        <?php endif; ?>
		        
		        <?php if(!empty($receipt_details->truckmate_warranty_label) || !empty($receipt_details->truckmate_warranty)): ?>
					<?php if(!empty($receipt_details->truckmate_warranty_label)): ?>
						<b><?php echo $receipt_details->truckmate_warranty_label; ?></b>
					<?php endif; ?>
					<?php echo e($receipt_details->truckmate_warranty, false); ?>

					<br>
		        <?php endif; ?>
		        
				<!-- Waiter info -->
				<?php if(!empty($receipt_details->service_staff_label) || !empty($receipt_details->service_staff)): ?>
		        	<br/>
					<?php if(!empty($receipt_details->service_staff_label)): ?>
						<b><?php echo $receipt_details->service_staff_label; ?></b>
					<?php endif; ?>
					<?php echo e($receipt_details->service_staff, false); ?>

		        <?php endif; ?>
			</td>
                </tr>
            </table>
	</div>
</div>

<div class="row">
	<?php if ($__env->exists('sale_pos.receipts.partial.common_truckmate_invoice')) echo $__env->make('sale_pos.receipts.partial.common_truckmate_invoice', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<div class="row">
	<div class="col-xs-12">
		<br/>
		<div class="table-responsive">
		<table class="table table-slim">
			<thead>
				<tr>
					<th>	
						<?php echo app('translator')->get('lang_v1.date'); ?>
					</th>
					<th>	
						<?php echo app('translator')->get('truckmate::lang.job_sheet'); ?>
					</th>
					<th>	
						<?php echo app('translator')->get('truckmate::lang.collection'); ?>
					</th>
					<th>	
						<?php echo app('translator')->get('truckmate::lang.drop_off'); ?>
					</th>
					<th>	
						<?php echo app('translator')->get('truckmate::lang.price'); ?>
					</th>
					<th>	
						<?php echo app('translator')->get('truckmate::lang.waiting_charges'); ?>
					</th>
					<th>
						<?php echo app('translator')->get('sale.subtotal'); ?>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php $__empty_18 = true; $__currentLoopData = $receipt_details->job_sheets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job_sheet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
				  <tr class="">
                    <td><?php echo e(\Carbon::createFromTimestamp(strtotime($job_sheet->start_date))->format(session('business.date_format')), false); ?></td>
                    <td><?php echo e($job_sheet->job_sheet_no, false); ?></td>
                    <td><?php echo e($job_sheet->load_point, false); ?></td>
                    <td><?php echo e($job_sheet->dest_point, false); ?></td>
                    <td><?php echo e(number_format($job_sheet->price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                    <td><?php echo e(number_format($job_sheet->extra_charges, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                    <td><?php echo e(number_format($job_sheet->line_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                  </tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
					<tr>
						<td colspan="7">&nbsp;</td>
					</tr>
				<?php endif; ?>
			</tbody>
		</table>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12"><hr/></div>
	<div class="col-xs-6">

		<table class="table table-slim">

			<?php if(!empty($receipt_details->payments)): ?>
				<?php $__currentLoopData = $receipt_details->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($payment['method'], false); ?></td>
						<td class="text-right" ><?php echo e($payment['amount'], false); ?></td>
						<td class="text-right"><?php echo e($payment['date'], false); ?></td>
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php endif; ?>

			<!-- Total Paid-->
			<?php if(!empty($receipt_details->total_paid)): ?>
				<tr>
					<th>
						<?php echo $receipt_details->total_paid_label; ?>

					</th>
					<td class="text-right">
						<?php echo e($receipt_details->total_paid, false); ?>

					</td>
				</tr>
			<?php endif; ?>

			<!-- Total Due-->
			<?php if(!empty($receipt_details->total_due)): ?>
			<tr>
				<th>
					<?php echo $receipt_details->total_due_label; ?>

				</th>
				<td class="text-right">
					<?php echo e($receipt_details->total_due, false); ?>

				</td>
			</tr>
			<?php endif; ?>

			<?php if(!empty($receipt_details->all_due)): ?>
			<tr>
				<th>
					<?php echo $receipt_details->all_bal_label; ?>

				</th>
				<td class="text-right">
					<?php echo e($receipt_details->all_due, false); ?>

				</td>
			</tr>
			<?php endif; ?>
		</table>
	</div>

	<div class="col-xs-6">
        <div class="table-responsive">
          	<table class="table table-slim">
				<tbody>
					<?php if(!empty($receipt_details->total_quantity_label)): ?>
						<tr class="color-555">
							<th style="width:70%">
								<?php echo $receipt_details->total_quantity_label; ?>

							</th>
							<td class="text-right">
								<?php echo e(implode(', ',$receipt_details->total_quantity), false); ?>

							</td>
						</tr>
					<?php endif; ?>
					<tr <?php if(!empty($receipt_details->sub_total_inc_tax_bold)): ?> style="font-weight: bold;" <?php endif; ?>>
						<th style="width:70%">
							<?php echo $receipt_details->subtotal_label; ?>

						</th>
						<td class="text-right">
							<?php echo e($receipt_details->subtotal, false); ?>

						</td>
					</tr>
					<?php if(!empty($receipt_details->total_exempt_uf)): ?>
					<tr>
						<th style="width:70%">
							<?php echo app('translator')->get('lang_v1.exempt'); ?>
						</th>
						<td class="text-right">
							<?php echo e($receipt_details->total_exempt, false); ?>

						</td>
					</tr>
					<?php endif; ?>
					<!-- Shipping Charges -->
					<?php if(!empty($receipt_details->shipping_charges)): ?>
						<tr>
							<th style="width:70%">
								<?php echo $receipt_details->shipping_charges_label; ?>

							</th>
							<td class="text-right">
								<?php echo e($receipt_details->shipping_charges, false); ?>

							</td>
						</tr>
					<?php endif; ?>

					<?php if(!empty($receipt_details->packing_charge)): ?>
						<tr>
							<th style="width:70%">
								<?php echo $receipt_details->packing_charge_label; ?>

							</th>
							<td class="text-right">
								<?php echo e($receipt_details->packing_charge, false); ?>

							</td>
						</tr>
					<?php endif; ?>

					<!-- Discount -->
					<?php if( !empty($receipt_details->discount) ): ?>
						<tr>
							<th>
								<?php echo $receipt_details->discount_label; ?>

							</th>

							<td class="text-right">
								(-) <?php echo e($receipt_details->discount, false); ?>

							</td>
						</tr>
					<?php endif; ?>

					<?php if( !empty($receipt_details->reward_point_label) ): ?>
						<tr>
							<th>
								<?php echo $receipt_details->reward_point_label; ?>

							</th>

							<td class="text-right">
								(-) <?php echo e($receipt_details->reward_point_amount, false); ?>

							</td>
						</tr>
					<?php endif; ?>

					<!-- Tax -->
					<?php if( !empty($receipt_details->tax) ): ?>
						<tr>
							<th>
								<?php echo $receipt_details->tax_label; ?>

							</th>
							<td class="text-right">
								(+) <?php echo e($receipt_details->tax, false); ?>

							</td>
						</tr>
					<?php endif; ?>

					<?php if( $receipt_details->round_off_amount > 0): ?>
						<tr>
							<th>
								<?php echo $receipt_details->round_off_label; ?>

							</th>
							<td class="text-right">
								<?php echo e($receipt_details->round_off, false); ?>

							</td>
						</tr>
					<?php endif; ?>

					<!-- Total -->
					<tr>
						<th>
							<?php echo $receipt_details->total_label; ?>

						</th>
						<td class="text-right">
							<?php echo e($receipt_details->total, false); ?>

							<?php if(!empty($receipt_details->total_in_words)): ?>
								<br>
								<small>(<?php echo e($receipt_details->total_in_words, false); ?>)</small>
							<?php endif; ?>
						</td>
					</tr>
				</tbody>
        	</table>
        </div>
    </div>
    <div class="col-xs-12">
    	<p><?php echo nl2br($receipt_details->additional_notes); ?></p>
    </div>
</div>

<?php if($receipt_details->show_barcode): ?>
	<div class="row">
		<div class="col-xs-12">
			
			<img class="center-block" src="data:image/png;base64,<?php echo e(DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2,30,array(39, 48, 54), true), false); ?>">
		</div>
	</div>
<?php endif; ?>

<?php if(!empty($receipt_details->footer_text)): ?>
	<div class="row">
		<div class="col-xs-12">
			<?php echo $receipt_details->footer_text; ?>

		</div>
	</div>
<?php endif; ?>