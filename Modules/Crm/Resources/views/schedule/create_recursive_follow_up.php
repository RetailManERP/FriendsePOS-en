
<?php $__env->startSection('title', __('crm::lang.add_recursive_follow_up')); ?>
<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('crm::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<!-- Content Header (Page header) -->
	<section class="content-header no-print">
	   <h1><?php echo app('translator')->get('crm::lang.add_recursive_follow_up'); ?></h1>
	</section>
	<section class="content no-print">
		<?php echo Form::open(['url' => action([\Modules\Crm\Http\Controllers\ScheduleController::class, 'store']), 'method' => 'post', 'id' => 'add_advance_schedule' ]); ?>

		<input type="hidden" name="is_recursive" value="true" id="is_recursive">
		<div class="box box-primary">
        	<div class="box-body">
        		<div class="row">
        			<div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('followup_category_id', __('crm::lang.followup_category') .':*'); ?>

                            <?php echo Form::select('followup_category_id', $followup_category, null, ['class' => 'form-control select2', 'required', 'style' => 'width: 100%;', 'placeholder' => __('messages.please_select')]); ?>

                        </div>
                    </div>

        			<div class="col-md-3">
		               <div class="form-group">
		                    <?php echo Form::label('follow_up_by', __('crm::lang.follow_up_by') .':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('crm::lang.follow_up_help') . '"></i>';
                }
            ?>
		                    <select name="follow_up_by_value" class="form-control" id="recur_follow_up_by" required>
	                    		<option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
							  	<optgroup label="<?php echo app('translator')->get('sale.payment_status'); ?>">
							    	<option value="all" data-category="payment_status"><?php echo app('translator')->get('lang_v1.all'); ?></option>
							    	<option value="due" data-category="payment_status"><?php echo app('translator')->get('lang_v1.due'); ?></option>
							    	<option value="partial" data-category="payment_status"><?php echo app('translator')->get('lang_v1.partial'); ?></option>
							    	<option value="overdue" data-category="payment_status"><?php echo app('translator')->get('lang_v1.overdue'); ?></option>
							  	</optgroup>
							  	<optgroup label="<?php echo app('translator')->get('restaurant.orders'); ?>">
							    	<option value="has_no_transactions" data-category="orders">
							    		<?php echo app('translator')->get('crm::lang.has_no_transactions'); ?>
							    	</option>
							  	</optgroup>
							</select>
							<input type="hidden" name="follow_up_by" id="follow_up_by_category" value="">
		               </div>
		            </div>

		            <div class="col-md-3">
		               	<div class="form-group">
		                    <label for="in_days"><?php echo e(__('crm::lang.in_days'), false); ?>:*</label>
		                    <div class="input-group">
		                        <div class="input-group-text"><?php echo e(__('crm::lang.in'), false); ?></div>
		                            <input type="text" class="form-control input_number" id="in_days" placeholder="<?php echo app('translator')->get('crm::lang.enter_days'); ?>" name="recursion_days" required>
		                        <div class="input-group-text"><?php echo e(__('lang_v1.days'), false); ?></div>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('user_id', __('crm::lang.assgined') .':*'); ?>

                            <?php echo Form::select('user_id[]', $users, null, ['class' => 'form-control select2', 'multiple', 'required', 'style' => 'width: 100%;']); ?>

                        </div>
                    </div>
		        </div>
        	</div>
       	</div>
        <div class="box box-primary">
        	<div class="box-body">
				<div class="row">
		            <div class="col-md-12">
		               <div class="form-group">
		                    <?php echo Form::label('title', __('crm::lang.title') . ':*' ); ?>

		                    <?php echo Form::text('title', null, ['class' => 'form-control', 'required' ]); ?>

		                    <p>
								<strong>
									<?php echo e($followup_tags['help_text'], false); ?>:
								</strong>
								<span class="text-primary invoice_tags" id="title_invoice_tags" style="display: none;">
									<?php echo e(implode(', ', $followup_tags['invoice']), false); ?>

								</span>
								<span class="text-primary trans_days_tags" id="title_trans_days_tags" style="display: none;">
									<?php echo e(implode(', ', $followup_tags['trans_days']), false); ?>

								</span>
							</p>
		               </div>
		            </div>
		        </div>
		        <div class="row">
		            <div class="col-md-12">
		                <div class="form-group">
		                    <?php echo Form::label('description', __('crm::lang.description') . ':'); ?>

		                    <?php echo Form::textarea('description', null, ['class' => 'form-control ', 'id' => 'description']); ?>

		                    <p>
								<strong>
									<?php echo e($followup_tags['help_text'], false); ?>:
								</strong>
								<span class="text-primary invoice_tags" style="display: none;">
									<?php echo e(implode(', ', $followup_tags['invoice']), false); ?>

								</span>
								<span class="text-primary trans_days_tags" style="display: none;">
									<?php echo e(implode(', ', $followup_tags['trans_days']), false); ?>

								</span>
							</p>
		                </div>
		            </div>
		        </div>
		        <div class="row">
		        	<div class="col-md-6">
		               <div class="form-group">
		                    <?php echo Form::label('status', __('sale.status') .':'); ?>

		                    <?php echo Form::select('status', $statuses, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;', 'id' => 'follow_up_create_status']); ?>

		               </div>
		            </div>
		            <div class="col-md-6">
		                <div class="form-group">
		                    <?php echo Form::label('schedule_type', __('crm::lang.schedule_type') .':*'); ?>

		                    <?php echo Form::select('schedule_type', $follow_up_types, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

		                </div>
		            </div>
		            <div class="col-md-6">
		                <div class="form-group">
		                	<br>
		                    <label class="form-check-label">
<?php echo Form::checkbox('allow_notification', 1, false, ['class' => 'form-check-input', 'id' => 'allow_notification']); ?>

		                        <?php echo app('translator')->get('crm::lang.send_notification'); ?>
		                    </label>
		                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('crm::lang.send_schedule_notificatoion') . '"></i>';
                }
            ?>
		                </div>
		            </div>
		        </div>
		        <div class="row">
		            <div class="allow_notification_elements hide">
		                <div class="col-md-6">
		                    <?php echo Form::label('notify_via', __('crm::lang.notify_via') .':*'); ?> 
		                    <div class="form-group checkbox-inline">
		                        <label class="form-check-label">
<?php echo Form::checkbox('notify_via[sms]', 1, false, ['class' => 'form-check-input']); ?>

		                            <?php echo app('translator')->get('crm::lang.sms'); ?>
		                        </label>
		                    </div>
		                    <div class="form-group checkbox-inline">
		                        <label class="form-check-label">
<?php echo Form::checkbox('notify_via[mail]', 1, true, ['class' => 'form-check-input']); ?>

		                            <?php echo app('translator')->get('business.email'); ?>
		                        </label>
		                    </div>
		                </div>
		                <div class="col-md-6">
		                    <div class="form-group">
		                        <div class="multi-input">
		                            <?php echo Form::label('notify_before', __('crm::lang.notify_before') . ':*'); ?>

		                            <br/>
		                            <?php echo Form::number('notify_before', 1, ['class' => 'form-control width-40 float-start', 'placeholder' => __('crm::lang.notify_before'), 'required']); ?>


		                            <?php echo Form::select('notify_type', $notify_type, 'hour', ['class' => 'form-control width-60 float-start']); ?>

		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>

		        <div class="row">
		        	<div class="col-md-12">
		        		<button type="submit" class="btn btn-primary float-end">
		                    <?php echo app('translator')->get('messages.save'); ?>
		                </button>
		            </div>
		        </div>
		    </div>
	     </div>

        <?php echo Form::close(); ?>

	</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	$(document).ready( function(){
		$('form#add_advance_schedule').validate();
		$('form#add_advance_schedule .datetimepicker').datetimepicker({
	        ignoreReadonly: true,
	        format: moment_date_format + ' ' + moment_time_format
	    });

	    //initialize editor
	    tinymce.init({
	        selector: 'textarea#description',
	    });

	    $(document).on('change', '#allow_notification', function() {
	    	if ($(this).is(':checked')) {
	    		$("div").find('.allow_notification_elements').removeClass('hide');
	    	} else {
	    		$("div").find('.allow_notification_elements').addClass('hide');
	    	}
	    });
		$('#recur_follow_up_by').change( function(){
			var follow_up_by = $(this).val();
			
			let category = $("#recur_follow_up_by :selected").data('category');
			if (category == 'payment_status') {
				$('span.trans_days_tags').hide();
				$('span.invoice_tags').show();
			} else if (category == 'orders') {
				$('span.invoice_tags').hide();
				$('span.trans_days_tags').show();
			}
			$("input#follow_up_by_category").val(category);
		});
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>