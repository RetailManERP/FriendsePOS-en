
<?php $__env->startSection('title', __('crm::lang.add_schedule')); ?>
<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('crm::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<!-- Content Header (Page header) -->
	<section class="content-header no-print">
	   <h1><?php echo app('translator')->get('crm::lang.add_schedule'); ?></h1>
	</section>
	<section class="content no-print">
		<?php echo Form::open(['url' => action([\Modules\Crm\Http\Controllers\ScheduleController::class, 'store']), 'method' => 'post', 'id' => 'add_advance_schedule' ]); ?>


		<div class="box box-primary">
        	<div class="box-body">
        		<div class="row">
        			<div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('followup_category_id', __('crm::lang.followup_category') .':*'); ?>

                            <?php echo Form::select('followup_category_id', $followup_category, null, ['class' => 'form-control select2', 'required', 'style' => 'width: 100%;', 'placeholder' => __('messages.please_select')]); ?>

                        </div>
                    </div>
                    
        			<div class="col-md-4">
		               <div class="form-group">
		                    <?php echo Form::label('follow_up_by', __('crm::lang.follow_up_by') .':'); ?>

		                    <select class="form-control" id="follow_up_by">
		                    		<option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
								  	<optgroup label="<?php echo app('translator')->get('sale.payment_status'); ?>">
								    	<option value="all" data-category="payment_status"><?php echo app('translator')->get('lang_v1.all'); ?></option>
								    	<option value="due" data-category="payment_status"><?php echo app('translator')->get('lang_v1.due'); ?></option>
								    	<option value="partial" data-category="payment_status"><?php echo app('translator')->get('lang_v1.partial'); ?></option>
								    	<option value="overdue" data-category="payment_status"><?php echo app('translator')->get('lang_v1.overdue'); ?></option>
								  	</optgroup>
								  	<optgroup label="<?php echo app('translator')->get('restaurant.orders'); ?>">
								    	<option value="has_transactions" data-category="orders">
								    		<?php echo app('translator')->get('crm::lang.has_transactions'); ?>
								    	</option>
								    	<option value="has_no_transactions" data-category="orders">
								    		<?php echo app('translator')->get('crm::lang.has_no_transactions'); ?>
								    	</option>
								  	</optgroup>
								  	<optgroup label="<?php echo app('translator')->get('contact.contact'); ?>">
								    	<option value="contact_name" data-category="contact_name">
								    		<?php echo app('translator')->get('user.name'); ?>
								    	</option>
								  	</optgroup>
							</select>

							<input type="hidden" name="follow_up_by" id="follow_up_by_category" value="">

		               </div>
		            </div>

		            <div class="col-md-4 hide follow_up_by_order_field">
		               	<div class="form-group">
		                    <label for="in_days"><?php echo e(__('crm::lang.in_days'), false); ?>:*</label>
		                    <div class="input-group">
		                        <div class="input-group-text"><?php echo e(__('crm::lang.in'), false); ?></div>
		                            <input type="text" class="form-control input_number" id="in_days" placeholder="<?php echo app('translator')->get('crm::lang.enter_days'); ?>" name="in_days" required>
		                        <div class="input-group-text"><?php echo e(__('lang_v1.days'), false); ?></div>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-2 hide follow_up_by_order_field" >
		               <div class="form-group">
		               		<br>
		               		<button type="button" class="btn btn-primary" id="group_customers"><?php echo app('translator')->get('pagination.next'); ?></button>
		               </div>
		            </div>
		            <div class="col-md-6 hide follow_up_by_payment_field" >
		               <div class="form-group">
		                    <?php echo Form::label('invoices', __('lang_v1.invoices') .':'); ?>

		                    <button type="button" class="btn btn-primary btn-xs select-all">
		                        <?php echo app('translator')->get('lang_v1.select_all'); ?>
		                    </button>
		                    <button type="button" class="btn btn-primary btn-xs deselect-all">
		                        <?php echo app('translator')->get('lang_v1.deselect_all'); ?>
		                    </button>
		                    <?php echo Form::select('invoices', [], null, ['class' => 'form-control select2', 'style' => 'width: 100%;', 'id' => 'invoices', 'multiple']); ?>

		               </div>
		            </div>
		            <div class="col-md-2 hide follow_up_by_payment_field" >
		               <div class="form-group">
		               		<br>
		               		<button type="button" class="btn btn-primary" id="group_invoices"><?php echo app('translator')->get('pagination.next'); ?></button>
		               </div>
		            </div>
		            <div class="col-md-6 hide follow_up_by_contact_name" >
		            	<div class="form-group">
		                    <?php echo Form::label('contact_ids', __('lang_v1.customers') .':'); ?>

		                    <button type="button" class="btn btn-primary btn-xs select-all">
		                        <?php echo app('translator')->get('lang_v1.select_all'); ?>
		                    </button>
		                    <button type="button" class="btn btn-primary btn-xs deselect-all">
		                        <?php echo app('translator')->get('lang_v1.deselect_all'); ?>
		                    </button>
		                    <?php echo Form::select('contact_ids', $customers, null, ['class' => 'form-control select2', 'style' => 'width: 100%;', 'id' => 'contact_ids', 'multiple']); ?>

		               </div>
		            </div>
		            <div class="col-md-2 hide follow_up_by_contact_name" >
		               <div class="form-group">
		               		<br>
		               		<button type="button" class="btn btn-primary" id="group_customers_by_name"><?php echo app('translator')->get('pagination.next'); ?></button>
		               </div>
		            </div>
        		</div>
        	</div>
       	</div>

       	<div class="box box-primary hide hidden_box">
        	<div class="box-body">
        		<div class="row">
        			<div class="col-md-12" id="group_invoices_div">
		            </div>
        		</div>
        	</div>
        </div>
        <div class="box box-primary hide hidden_box">
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
								<span class="text-primary invoice_tags" id="title_invoice_tags">
									<?php echo e(implode(', ', $followup_tags['invoice']), false); ?>

								</span>
								<span class="text-primary trans_days_tags" id="title_trans_days_tags">
									<?php echo e(implode(', ', $followup_tags['trans_days']), false); ?>

								</span>
								<span class="text-primary contact_name_tags" id="title_contact_name_tags">
									<?php echo e(implode(', ', $followup_tags['contact_name']), false); ?>

								</span>
							</p>
		               </div>
		            </div>
		        </div>
		        <div class="row">
		            <div class="col-md-4">
		               <div class="form-group">
		                    <?php echo Form::label('status', __('sale.status') .':'); ?>

		                    <?php echo Form::select('status', $statuses, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;', 'id' => 'follow_up_create_status']); ?>

		               </div>
		            </div>
		            <div class="col-md-4">
		               <div class="form-group">
		                    <?php echo Form::label('start_datetime', __('crm::lang.start_datetime') . ':*' ); ?>

		                    <?php echo Form::text('start_datetime', null, ['class' => 'form-control datetimepicker', 'required', 'readonly']); ?>

		               </div>
		            </div>
		            <div class="col-md-4">
		               <div class="form-group">
		                    <?php echo Form::label('end_datetime', __('crm::lang.end_datetime') . ':*' ); ?>

		                    <?php echo Form::text('end_datetime', null, ['class' => 'form-control datetimepicker', 'required', 'readonly']); ?>

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
								<span class="text-primary invoice_tags">
									<?php echo e(implode(', ', $followup_tags['invoice']), false); ?>

								</span>
								<span class="text-primary trans_days_tags">
									<?php echo e(implode(', ', $followup_tags['trans_days']), false); ?>

								</span>
								<span class="text-primary contact_name_tags">
									<?php echo e(implode(', ', $followup_tags['contact_name']), false); ?>

								</span>
							</p>
		                </div>
		            </div>
		        </div>
		        <div class="row">
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
		                <small class="float-end text-muted mt-5 mr-8">
		        			<?php echo app('translator')->get('crm::lang.multiple_followups_will_be_created'); ?>
		        		</small>
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
	    $('#invoices').change( function(){
	    	$('#group_invoices_div').html('');
	    	$('.hidden_box').addClass('hide');
	    });
		$('#follow_up_by').change( function(){
			$('#group_invoices_div').html('');
			$('.hidden_box').addClass('hide');
			var follow_up_by = $(this).val();
			
			let category = $("#follow_up_by :selected").data('category');
			
			if (category == 'payment_status') {
				$('span.trans_days_tags').hide();
				$('span.contact_name_tags').hide();
				$('span.invoice_tags').show();
				$("input#title").val('Payment followup: ' +$('span#title_invoice_tags').text().trim());
			} else if (category == 'contact_name') {
				$('span.invoice_tags').hide();
				$('span.trans_days_tags').hide();
				$('span.contact_name_tags').show();
				$("input#title").val('Followup: ' + $('span#title_contact_name_tags').text().trim());
			} else if (category == 'orders') {
				$('span.invoice_tags').hide();
				$('span.contact_name_tags').hide();
				$('span.trans_days_tags').show();
				$("input#title").val('Sales followup: ' +$('span#title_trans_days_tags').text().trim());
			}

			$("input#follow_up_by_category").val(category);
			if (follow_up_by !== '') {
				var arr = ['all', 'due', 'partial', 'overdue'];
				if (arr.indexOf(follow_up_by) >= 0) {
					$('.follow_up_by_payment_field').removeClass('hide');
					$('.follow_up_by_order_field').addClass('hide');
					var data = {
						follow_up_by: 'payment_status',
						payment_status: follow_up_by
					}

					$.ajax({
			            url: '<?php echo e(action([\Modules\Crm\Http\Controllers\ScheduleController::class, 'getInvoicesForFollowUp']), false); ?>',
			            dataType: 'json',
			            data: data,
			            success: function(data) {
			                $('#invoices').select2('destroy').empty().select2({data: data});
			            },
			        });
				} else if(follow_up_by == 'contact_name') {
					$('.follow_up_by_payment_field').addClass('hide');
					$('.follow_up_by_order_field').addClass('hide');
					$('.follow_up_by_contact_name').removeClass('hide');
				} else {
					$('.follow_up_by_payment_field').addClass('hide');
					$('.follow_up_by_contact_name').addClass('hide');
					$('.follow_up_by_order_field').removeClass('hide');
				}
			}  else {
				$('.follow_up_by_payment_field').addClass('hide');
				$('.follow_up_by_order_field').addClass('hide');
				$('.follow_up_by_contact_name').addClass('hide');
			}
		});
	});

	$(document).on('click', '#group_customers', function(){
		$('#group_invoices_div').html('');
		var days = $('#in_days').val();
		var follow_up_by = $('#follow_up_by').val();

		if (days != '') {
			$('.hidden_box').removeClass('hide');
			$.ajax({
	            url: '<?php echo e(action([\Modules\Crm\Http\Controllers\ScheduleController::class, 'getFollowUpGroups']), false); ?>',
	            dataType: 'html',
	            data: {days: days, follow_up_by: follow_up_by},
	            success: function(result) {
	                $('#group_invoices_div').html(result);
	                $('#group_invoices_div').find('.select2').each( function(){
	                	$(this).select2();
	                });
	            },
	        });
		} else {
			$('.hidden_box').addClass('hide');
			alert('<?php echo e(__("crm::lang.enter_days"), false); ?>');
		}
	});

	$(document).on('click', '#group_customers_by_name', function(){
		$('#group_invoices_div').html('');
		var follow_up_by = $('#follow_up_by').val();
		var contact_ids = $('#contact_ids').val();
		if (contact_ids != '') {
			$('.hidden_box').removeClass('hide');
			$.ajax({
	            url: '<?php echo e(action([\Modules\Crm\Http\Controllers\ScheduleController::class, 'getFollowUpGroups']), false); ?>',
	            dataType: 'html',
	            data: {contact_ids: contact_ids, follow_up_by: follow_up_by},
	            success: function(result) {
	                $('#group_invoices_div').html(result);
	                $('#group_invoices_div').find('.select2').each( function(){
	                	$(this).select2();
	                });
	            },
	        });
		} else {
			$('.hidden_box').addClass('hide');
		}
	});

	$(document).on('click', '#group_invoices', function(){
		var invoices = $('#invoices').val();
		$('#group_invoices_div').html('');
		if (invoices != '') {
			$('.hidden_box').removeClass('hide');
			$.ajax({
	            url: '<?php echo e(action([\Modules\Crm\Http\Controllers\ScheduleController::class, 'getFollowUpGroups']), false); ?>',
	            dataType: 'html',
	            data: {invoices: invoices, follow_up_by: 'payment_status'},
	            success: function(result) {
	                $('#group_invoices_div').html(result);
	                $('#group_invoices_div').find('.select2').each( function(){
	                	$(this).select2();
	                });
	            },
	        });
		} else {
			alert('<?php echo e(__("crm::lang.select_invoices"), false); ?>');
			$('.hidden_box').addClass('hide');
		}
	});

	$(document).on('submit', '#add_advance_schedule', function(){
		if ($("#customer_invoice_table tr").length <= 1) {
			alert('<?php echo e(__("crm::lang.there_is_no_customer_to_add_follow_up"), false); ?>');
			$(this).find('button[type="submit"]').attr('disabled', false);
			return false;
		}
	});

	$(document).on('click', '.remove-follow-up', function(){
		$(this).closest('tr').remove();
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>