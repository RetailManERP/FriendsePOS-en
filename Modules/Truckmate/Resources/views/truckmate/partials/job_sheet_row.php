<tr class="job_sheet_row text-center" data-row_index="<?php echo e($row_count, false); ?>">
	<td><?php echo e(\Carbon::createFromTimestamp(strtotime($job_sheet->start_date))->format(session('business.date_format')), false); ?></td>
	<td>
		<input name="job_sheets[<?php echo e($row_count, false); ?>][line_id]" type="hidden" value="<?php echo e($job_sheet->line_id, false); ?>">
		<?php echo e($job_sheet->job_sheet_no, false); ?>

	</td>
	<td><?php echo e($job_sheet->load_point, false); ?></td>
	<td><?php echo e($job_sheet->dest_point, false); ?></td>
	<td>
		<input name="job_sheets[<?php echo e($row_count, false); ?>][price]" class="hidden_price" type="hidden" value="<?php echo e(($edit) ? $job_sheet->price : $job_sheet->estimated_cost, false); ?>">
		<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) ($edit) ? $job_sheet->price : $job_sheet->estimated_cost, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
	</td>
	<td class="col-md-1">
		<input name="job_sheets[<?php echo e($row_count, false); ?>][job_sheet_id]" class="hidden_job_sheet_id" type="hidden" value="<?php echo e($job_sheet->id, false); ?>">
		<input name="job_sheets[<?php echo e($row_count, false); ?>][extra_charges]" type="text" class="form-control input_number input-sm row_extra_charges" value="<?php echo e(number_format(($edit) ? $job_sheet->extra_charges : 0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>">
	</td>
	<td>
		<input name="job_sheets[<?php echo e($row_count, false); ?>][line_total]" class="hidden_line_total" type="hidden" value="<?php echo e(($edit) ? $job_sheet->line_total : $job_sheet->estimated_cost, false); ?>">
		<span class="display_currency line_total_text">
			<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) ($edit) ? $job_sheet->line_total : $job_sheet->estimated_cost, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
		</span>
	</td>

	<td class="text-center v-center">
		<i class="fa fa-times text-danger job_remove_row cursor-pointer" aria-hidden="true"></i>
	</td>
</tr>