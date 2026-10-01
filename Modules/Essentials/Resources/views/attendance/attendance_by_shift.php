<div class="row">
	<div class="col-md-4">
		<div class="input-group date">
    		<?php echo Form::text('attendance_by_shift_date_filter', \Carbon::createFromTimestamp(strtotime('today'))->format(session('business.date_format')), ['class' => 'form-control', 'id' => 'attendance_by_shift_date_filter', 'readonly' ]); ?>

    		<span class="input-group-text"><i class="fas fa-calendar"></i></span>
    	</div>
	</div>
	<div class="col-md-12">
		<br>
		<div class="table-responsive">
<table class="table table-th-skin" id="attendance_by_shift_table">
			<thead>
				<tr>
					<th>
						<?php echo app('translator')->get('essentials::lang.shift'); ?>
					</th>
					<th>
						<?php echo app('translator')->get('essentials::lang.present'); ?>
					</th>
					<th>
						<?php echo app('translator')->get('essentials::lang.absent'); ?>
					</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
</div>
	</div>
</div>
