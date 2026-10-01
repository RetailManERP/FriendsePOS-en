
<?php $__env->startSection('title', __('repair::lang.repair_status')); ?>
<?php $__env->startSection('content'); ?>
<div class="login-form col-md-12 col-xs-12 right-col-content">
    <p class="form-header text-white"><?php echo e(__('repair::lang.repair_status'), false); ?></p>
    <form method="POST" action="<?php echo e(action([\Modules\Repair\Http\Controllers\CustomerRepairStatusController::class, 'postRepairStatus']), false); ?>" id="check_repair_status">
        <div class="form-group">
        	<?php
        		$search_options = [
        			'job_sheet_no' => __('repair::lang.job_sheet_no'), 
		      		'invoice_no' => __('sale.invoice_no')
		      	];

		      	$placeholder = __('repair::lang.job_sheet_or_invoice_no');

        		if (config('repair.enable_repair_check_using_mobile_num')) {
        			$search_options['mobile_num'] = __('lang_v1.mobile_number');
        			$placeholder .= ' / '.__('lang_v1.mobile_number');
        		}
        	?>
    		<div class="multi-input">
		    	<?php echo Form::select('search_type', 
		      	$search_options, 
		      	null, 
		      	['class' => 'form-control width-60 float-start']); ?>


		    	<?php echo Form::text('search_number', null, ['class' => 'form-control width-40 float-start', 'required', 'placeholder' => $placeholder]); ?>

		    </div>
        </div><br><br>
        <div class="form-group">
    		<div class="input-group">
    			<div class="input-group-text"><i class="fas fa-microchip"></i></div>
            	<input type="text" name="serial_no" class="form-control" id="repair_serial_no" placeholder="<?php echo app('translator')->get('repair::lang.serial_no'); ?>">
    		</div>
        </div>
        <div class="form-group">
	        <button type="submit" class="btn-login btn btn-primary btn-flat ladda-button">
	        	<?php echo app('translator')->get('lang_v1.search'); ?>
	       	</button>
	    </div>
   </form>
</div>
<div class="col-md-12 col-xs-12">
 	<div class="row repair_status_details"></div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('submit', 'form#check_repair_status', function(e) {
	        e.preventDefault();
		    var data = $('form#check_repair_status').serialize();
		    var url = $('form#check_repair_status').attr('action');
		    var ladda = Ladda.create(document.querySelector('.ladda-button'));
	    	ladda.start();
		    $.ajax({
		        method: 'POST',
		        url: url,
		        dataType: 'json',
		        data: data,
		        success: function(result) {
		        	ladda.stop();
		            if (result.success) {
		            	$(".repair_status_details").html(result.repair_html);
		                toastr.success(result.msg);
		            } else {
		                toastr.error(result.msg);
		            }
		        }
		    });
	   	});
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('repair::layouts.repair_status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>