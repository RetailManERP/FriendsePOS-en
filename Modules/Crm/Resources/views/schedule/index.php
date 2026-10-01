
<?php $__env->startSection('title', __('crm::lang.follow_ups')); ?>
<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('crm::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<!-- Content Header (Page header) -->
	<section class="content-header no-print">
	   <h1><?php echo app('translator')->get('crm::lang.follow_ups'); ?></h1>
	</section>
	<section class="content no-print">
		<?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
	        <div class="row">
	            <div class="col-md-4">
	                <div class="form-group">
	                    <?php echo Form::label('contact_id_filter', __('contact.contact') . ':'); ?>

	                    <?php echo Form::select('contact_id_filter', $contacts, null, ['class' => 'form-control select2', 'id' => 'contact_id_filter', 'placeholder' => __('messages.all'), 'style' => 'width:100%']); ?>

	                </div>    
	            </div>
	            <?php if(auth()->user()->can('crm.access_all_schedule')): ?>
		            <div class="col-md-4">
		                <div class="form-group">
		                    <?php echo Form::label('assgined_to_filter', __('crm::lang.assgined') . ':'); ?>

		                    <?php echo Form::select('assgined_to_filter', $assigned_to, $default_user, ['class' => 'form-control select2', 'id' => 'assgined_to_filter', 'placeholder' => __('messages.all'), 'style' => 'width:100%']); ?>

		                </div>    
		            </div>
		        <?php endif; ?>
	            <div class="col-md-4">
	                <div class="form-group">
	                    <?php echo Form::label('status_filter', __('sale.status') . ':'); ?>

	                    <?php echo Form::select('status_filter', $statuses, $default_status, ['class' => 'form-control select2', 'id' => 'status_filter', 'placeholder' => __('messages.all'), 'style' => 'width:100%']); ?>

	                </div>    
	            </div>
	            <div class="clearfix">
	            </div>
	            <div class="col-md-3">
	                <div class="form-group">
	                    <?php echo Form::label('schedule_type_filter', __('crm::lang.schedule_type') . ':'); ?>

	                    <?php echo Form::select('schedule_type_filter', $follow_up_types, null, ['class' => 'form-control select2', 'id' => 'schedule_type_filter', 'placeholder' => __('messages.all'), 'style' => 'width:100%']); ?>

	                </div>    
	            </div>
	            <div class="col-md-3">
	            	<div class="form-group">
	            		<?php echo Form::label('follow_up_date_range', __('report.date_range') . ':'); ?>

	            		<?php echo Form::text('follow_up_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

	            	</div>
	            </div>
	            <div class="col-md-3">
	                <div class="form-group">
	                    <?php echo Form::label('follow_up_by_filter', __('crm::lang.follow_up_by') . ':'); ?>

	                    <?php echo Form::select('follow_up_by_filter', ['payment_status' => __('sale.payment_status'), 'orders' => __('restaurant.orders')], null, ['class' => 'form-control select2', 'id' => 'follow_up_by_filter', 'placeholder' => __('messages.all'), 'style' => 'width:100%']); ?>

	                </div>    
	            </div>
	            <div class="col-md-3">
	                <div class="form-group">
	                    <?php echo Form::label('followup_category_id_filter', __('crm::lang.followup_category') . ':'); ?>

	                    <?php echo Form::select('followup_category_id_filter', $followup_category, $default_followup_category_id, ['class' => 'form-control select2', 'id' => 'followup_category_id_filter', 'placeholder' => __('messages.all'), 'style' => 'width:100%']); ?>

	                </div>    
	            </div>
	        </div>
	    <?php echo $__env->renderComponent(); ?>
		<div class="row">
			<div class="col-md-12">
				<?php $__env->startComponent('components.widget', ['class' => 'box box-primary', 'title' => __('crm::lang.all_schedules')]); ?>
					<?php $__env->slot('tool'); ?>
			            <div class="box-tools">
			                <button type="button" class="btn btn-primary btn-add-schedule">
			                <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?></button>

			                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#advance_followup_modal">
			                <i class="fa fa-plus"></i> <?php echo app('translator')->get('crm::lang.add_advance_follow_up'); ?></button>
			            </div>
			            <input type="hidden" name="schedule_create_url" id="schedule_create_url" value="<?php echo e(action([\Modules\Crm\Http\Controllers\ScheduleController::class, 'create']), false); ?>">
		        	<?php $__env->endSlot(); ?>
			        <div class="col-sm-12">
			        	<div class="card">
			        	    <div class="card-header p-0">
			                    <ul class="nav nav-tabs" role="tablist">
			                        <li class="nav-item">
			                            <a class="nav-link active" href="#all_followup_tab" data-bs-toggle="tab" aria-expanded="true"> <?php echo app('translator')->get('crm::lang.follow_ups'); ?></a>
			                        </li>
			                        <li class="nav-item">
			                            <a class="nav-link" href="#recur_followup_tab" data-bs-toggle="tab" aria-expanded="true"> <?php echo app('translator')->get('crm::lang.recur_follow_ups'); ?></a>
			                        </li>
			                    </ul>
			                </div>
			                <div class="card-body">
			                    <div class="tab-content">
                    			    <div class="tab-pane fade show active" id="all_followup_tab">
                    				<div class="table-responsive">
						            	<table class="table table-bordered table-striped table-th-skin" id="follow_up_table" style="width: 100%">
									        <thead>
									            <tr>
									            	<th><?php echo app('translator')->get('messages.action'); ?></th>
									            	<th>
									            		<?php echo app('translator')->get('contact.contact'); ?>
									            	</th>
									            	<th><?php echo app('translator')->get('crm::lang.start_datetime'); ?></th>
									                <th><?php echo app('translator')->get('crm::lang.end_datetime'); ?></th>
									                <th><?php echo app('translator')->get('sale.status'); ?></th>
									                <th><?php echo app('translator')->get('crm::lang.schedule_type'); ?></th>
									                <th><?php echo app('translator')->get('crm::lang.followup_category'); ?></th>
									                <th><?php echo app('translator')->get('lang_v1.assigned_to'); ?></th>
									                <th>
									                	<?php echo app('translator')->get('crm::lang.description'); ?>
									                </th>
									                <th>
									                	<?php echo app('translator')->get('crm::lang.additional_info'); ?>
									                </th>
									                <th><?php echo app('translator')->get('crm::lang.title'); ?></th>
									                <th>
									                	<?php echo app('translator')->get('lang_v1.added_by'); ?>
									                </th>
									                <th>
									                	<?php echo app('translator')->get('lang_v1.added_on'); ?>
									                </th>
									            </tr>
									        </thead>
									        <tbody></tbody>
									        <tfoot>
			                                    <tr class="bg-gray font-17 footer-total text-center">
			                                        <td colspan="5">
			                                            <strong><?php echo app('translator')->get('sale.total'); ?>:</strong>
			                                        </td>
			                                        <td class="footer_follow_up_status_count"></td>
			                                        <td class="footer_follow_up_type_count"></td>
			                                        <td colspan="6"></td>
			                                    </tr>
			                                </tfoot>
									    </table>
						            </div>
                    \t\t\t</div>\n                    \t\t\t<div class=\"tab-pane fade\" id=\"recur_followup_tab\">
                    				<div class="table-responsive">
						            	<table class="table table-bordered table-striped table-th-skin" id="recursive_follow_up_table" style="width: 100%">
									        <thead>
									            <tr>
									            	<th><?php echo app('translator')->get('messages.action'); ?></th>
									                <th><?php echo app('translator')->get('sale.status'); ?></th>
									                <th><?php echo app('translator')->get('crm::lang.schedule_type'); ?></th>
									                <th><?php echo app('translator')->get('crm::lang.followup_category'); ?></th>
									                <th><?php echo app('translator')->get('crm::lang.follow_up_by'); ?></th>
									                <th><?php echo app('translator')->get('crm::lang.in_days'); ?></th>
									                <th><?php echo app('translator')->get('lang_v1.assigned_to'); ?></th>
									                <th>
									                	<?php echo app('translator')->get('crm::lang.description'); ?>
									                </th>
									                <th>
									                	<?php echo app('translator')->get('crm::lang.additional_info'); ?>
									                </th>
									                <th><?php echo app('translator')->get('crm::lang.title'); ?></th>
									                <th>
									                	<?php echo app('translator')->get('lang_v1.added_by'); ?>
									                </th>
									                <th>
									                	<?php echo app('translator')->get('lang_v1.added_on'); ?>
									                </th>
									            </tr>
									        </thead>
									    </table>
						            </div>
                    			</div>
                    		</div>
			            </div>
			        </div>
		    	<?php echo $__env->renderComponent(); ?>
			</div>
		</div>
	</section>
	<div class="modal fade schedule" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
    <div class="modal fade edit_schedule" tabindex="-1" role="dialog"></div>

	<div class="modal fade schedule_log_modal" tabindex="-1" role="dialog"></div>

    <?php echo $__env->make('crm::schedule.partial.advance_followup_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('modules/crm/js/crm.js?v=' . $asset_v), false); ?>"></script>
	<script type="text/javascript">
		$(function () {
			$('#follow_up_date_range').daterangepicker(
		        dateRangeSettings,
		        function (start, end) {
		            $('#follow_up_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
		            follow_up_datatable.ajax.reload();
		        }
		    );
		    $('#follow_up_date_range').on('cancel.daterangepicker', function(ev, picker) {
		        $('#follow_up_date_range').val('');
		        follow_up_datatable.ajax.reload();
		    });
		    $('#followup_category_id_filter').change(function(){
		    	follow_up_datatable.ajax.reload();
		    })

		    follow_up_datatable = $("#follow_up_table").DataTable({
				processing: true,
		        serverSide: true,
		        scrollY: "80vh",
				scrollX: true,
				scrollCollapse: true,
		        ajax: {
		            url: "/crm/follow-ups",
		            data:function(d) {
		            	d.contact_id = $("#contact_id_filter").val();
		            	d.assgined_to = $("#assgined_to_filter").val();
		            	d.status = $("#status_filter").val();
		            	d.schedule_type = $("#schedule_type_filter").val();
		            	d.follow_up_by = $("#follow_up_by_filter").val();
		            	d.followup_category_id = $("#followup_category_id_filter").val();

		            	if ($('#follow_up_date_range').val()) {
		            		d.start_date_time = $('#follow_up_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
		            		d.end_date_time = $('#follow_up_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
		            	}
		            }
		        },
		        columnDefs: [
		            {
		                targets: [0, 7, 9],
		                orderable: false,
		                searchable: false,
		            },
		        ],
		        aaSorting: [[2, 'desc']],
		        columns: [
		        	{ data: 'action', name: 'action' },
		        	{ data: 'contact', name: 'contacts.name' },
		        	{ data: 'start_datetime', name: 'start_datetime' },
		            { data: 'end_datetime', name: 'end_datetime' },
		            { data: 'status', name: 'crm_schedules.status' },
		            { data: 'schedule_type', name: 'schedule_type' },
		            { data: 'followup_category', name: 'C.name' },
		            { data: 'users', name: 'users' },
		            { data: 'description', name: 'description'},
		            { data: 'additional_info', name: 'additional_info' },
		            { data: 'title', name: 'title' },
		            { data: 'added_by', name: 'added_by' },
		            { data: 'added_on', name: 'crm_schedules.created_at' },
		        ],
		        "fnDrawCallback": function( oSettings ) {
		        	__show_date_diff_for_human($("#follow_up_table"));

		        	$('a.view_schedule_log').click(function(){
		        		getScheduleLog($(this).data('schedule_id'), true);
		        	})
			    },
		        "footerCallback": function ( row, data, start, end, display ) {
		        	$('.footer_follow_up_status_count').html(__count_status(data, 'status'));
		            $('.footer_follow_up_type_count').html(__count_status(data, 'schedule_type'));
		        }
			});

			recursive_follow_up_table = $("#recursive_follow_up_table").DataTable({
				processing: true,
		        serverSide: true,
		        scrollY: "80vh",
				scrollX: true,
				scrollCollapse: true,
		        ajax: {
		            url: "/crm/follow-ups",
		            data:function(d) {
		            	d.assgined_to = $("#assgined_to_filter").val();
		            	d.is_recursive = 1;
		            }
		        },
		        columnDefs: [
		            {
		                targets: [0, 6],
		                orderable: false,
		                searchable: false,
		            },
		        ],
		        aaSorting: [[2, 'desc']],
		        columns: [
		        	{ data: 'action', name: 'action' },
		            { data: 'status', name: 'crm_schedules.status' },
		            { data: 'schedule_type', name: 'schedule_type' },
		            { data: 'followup_category', name: 'C.name' },
		            { data: 'follow_up_by', name: 'crm_schedules.follow_up_by' },
		            { data: 'recursion_days', name: 'crm_schedules.recursion_days' },
		            { data: 'users', name: 'users' },
		            { data: 'description', name: 'description'},
		            { data: 'additional_info', name: 'additional_info' },
		            { data: 'title', name: 'title' },
		            { data: 'added_by', name: 'added_by' },
		            { data: 'added_on', name: 'crm_schedules.created_at' },
		        ]
			});

			$(document).on('change', '#contact_id_filter, #assgined_to_filter, #status_filter, #schedule_type_filter, #follow_up_by_filter', function() {
			    follow_up_datatable.ajax.reload();
			});
			
			// Set default date from get parameter
	        <?php if(!empty($default_start_date) && !empty($default_end_date)): ?>
	            $('#follow_up_date_range').val(<?php echo e($default_start_date . ' - ' . $default_end_date, false); ?>);
	            $('#follow_up_date_range').data('daterangepicker').setStartDate('<?php echo e($default_start_date, false); ?>');
	            $('#follow_up_date_range').data('daterangepicker').setEndDate('<?php echo e($default_end_date, false); ?>');
	            follow_up_datatable.ajax.reload();
	        <?php endif; ?>
		        
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>