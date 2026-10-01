
<?php $__env->startSection('title', __('business.dashboard')); ?>
<?php $__env->startSection('css'); ?>
    <style>
        .bootstrap-datetimepicker-widget.dropdown-menu {
            z-index: 99999 !important;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php
    $custom_labels = ! empty(session()->get('business.custom_labels')) ? json_decode(session()->get('business.custom_labels'), true) : [] ;
?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('truckmate::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <div class="tm-page-header d-flex flex-wrap justify-content-between align-items-center">
        <h1>
            <i class="fas fa-truck" style="color: var(--tm-primary);"></i>
            <?php if(!empty($custom_labels['truckmate_label'])): ?>
            <?php echo e($custom_labels['truckmate_label'] .' ', false); ?><?php echo app('translator')->get('truckmate::lang.workshop_management'); ?>
            <?php else: ?>
            <?php echo app('translator')->get('truckmate::lang.truckmate_workshop_management'); ?>
            <?php endif; ?>
            <small><?php echo app('translator')->get('business.dashboard'); ?></small>
        </h1>
        <div class="d-flex gap-2" style="gap:0.5rem;">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('truckmate_job_sheet.create')): ?>
            <a href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\JobSheetController::class, 'create']), false); ?>" class="btn btn-sm btn-primary">
                <i class="fas fa-plus-circle"></i> <?php echo app('translator')->get('truckmate::lang.add_job_sheet'); ?>
            </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('truckmate_vehicle.dashboard')): ?>
            <a href="<?php echo e(url('/truckmate/vehicle-dashboard'), false); ?>" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-truck-moving"></i> <?php echo app('translator')->get('truckmate::lang.vehicles'); ?>
            </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('truckmate_driver.dashboard')): ?>
            <a href="<?php echo e(url('/truckmate/driver-dashboard'), false); ?>" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-id-card"></i> <?php echo app('translator')->get('truckmate::lang.drivers'); ?>
            </a>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- Main content -->
<section class="content tm-content no-print">

    <!-- KPI Summary Stats -->
    <div class="row mb-3">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="tm-stat-card">
                <div class="tm-stat-icon bg-primary-soft">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="tm-stat-content">
                    <h4><?php echo e($dashboard_stats['total_jobs_today'], false); ?></h4>
                    <p><?php echo app('translator')->get('truckmate::lang.job_sheets'); ?> — <?php echo e($today->format('d M'), false); ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="tm-stat-card">
                <div class="tm-stat-icon bg-success-soft">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="tm-stat-content">
                    <h4><?php echo e($dashboard_stats['completed_count'], false); ?></h4>
                    <p><?php echo app('translator')->get('truckmate::lang.completed'); ?> — <?php echo e($today->format('d M'), false); ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="tm-stat-card">
                <div class="tm-stat-icon bg-info-soft">
                    <i class="fas fa-truck-moving"></i>
                </div>
                <div class="tm-stat-content">
                    <h4><?php echo e($dashboard_stats['total_vehicles'], false); ?></h4>
                    <p><?php echo app('translator')->get('truckmate::lang.vehicles'); ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="tm-stat-card">
                <div class="tm-stat-icon bg-warning-soft">
                    <i class="fas fa-users"></i>
                </div>
                <div class="tm-stat-content">
                    <h4><?php echo e($dashboard_stats['total_drivers'], false); ?></h4>
                    <p><?php echo app('translator')->get('truckmate::lang.drivers'); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Row: Day Drivers | Calendar | Night Drivers -->
    <div class="row">
        
        <div class="col-md-4">
            <div class="tm-card tm-card-primary">
                <div class="tm-card-header">
                    <div class="tm-card-title">
                        <i class="fas fa-sun text-warning"></i>
                        <?php echo app('translator')->get('truckmate::lang.day_shift'); ?>
                    </div>
                    <span class="tm-badge tm-badge-primary"><?php echo e(count($day_drivers), false); ?> <?php echo app('translator')->get('truckmate::lang.driver'); ?></span>
                </div>
                <div class="tm-card-body p-0">
                    <div class="table-responsive">
                        <table class="table tm-driver-table mb-0">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('truckmate::lang.driver'); ?></th>
                                    <th><?php echo app('translator')->get('truckmate::lang.job_sheets'); ?></th>
                                    <th><?php echo app('translator')->get('truckmate::lang.available_after'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_18 = true; $__currentLoopData = $day_drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center gap-2">
                                                <div class="tm-stat-icon bg-primary-soft" style="width:32px;height:32px;border-radius:8px;font-size:0.75rem;">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                                <span class="fw-medium"><?php echo e($d->user_full_name, false); ?></span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <?php $dj = $driver_job_counts[$d->id] ?? 0; ?>
                                            <span class="tm-badge <?php echo e($dj > 0 ? 'tm-badge-success' : 'tm-badge-secondary', false); ?>"><?php echo e($dj, false); ?></span>
                                        </td>
                                        <td><span class="tm-badge tm-badge-success"><?php echo e(\Carbon::createFromTimestamp(strtotime('03:00:00'))->format('h:i A'), false); ?></span></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                    <tr>
                                        <td colspan="3">
                                            <div class="tm-empty-state" style="padding:1.5rem 0;">
                                                <i class="fas fa-user-clock"></i>
                                                <p class="mb-0">No drivers on day shift</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="tm-card" style="overflow:visible;">
                <div class="tm-card-body">
                    <div class="tm-day-display">
                        <div class="tm-day-name"><?php echo e($today->format('l'), false); ?></div>
                        <div class="tm-date-badge">
                            <div class="tm-date-day"><?php echo e($today->format('d'), false); ?></div>
                            <div class="tm-date-month"><?php echo e($today->format('F'), false); ?></div>
                            <div class="tm-date-year"><?php echo e($today->format('Y'), false); ?></div>
                        </div>
                    </div>
                    <input type="hidden" name="date" id="dashboard_date" value="<?php echo e($today->toDateString(), false); ?>">
                    <div class="tm-date-navigator mt-3">
                        <?php for($i = -4; $i <= 4; $i++): ?>
                            <?php
                                $date = $today->copy()->addDays($i);
                            ?>
                            <a href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\DashboardController::class, 'index'], ['date' => $date->toDateString()]), false); ?>"
                               class="tm-date-btn <?php if($i == 0): ?> active <?php endif; ?>">
                                <?php echo e($date->format('D, d M'), false); ?>

                            </a>
                        <?php endfor; ?>
                    </div>
                    
                    <div class="text-center mt-2">
                        <div class="input-group input-group-sm" style="max-width:220px;margin:0 auto;">
                            <input type="text" class="form-control" id="dashboard_jump_date" placeholder="<?php echo app('translator')->get('truckmate::lang.jump_to_date'); ?>" readonly>
                            <span class="input-group-btn">
                                <button class="btn btn-primary btn-sm" type="button" id="dashboard_jump_btn">
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="tm-card tm-card-info">
                <div class="tm-card-header">
                    <div class="tm-card-title">
                        <i class="fas fa-moon text-info"></i>
                        <?php echo app('translator')->get('truckmate::lang.night_shift'); ?>
                    </div>
                    <span class="tm-badge tm-badge-info"><?php echo e(count($night_drivers), false); ?> <?php echo app('translator')->get('truckmate::lang.driver'); ?></span>
                </div>
                <div class="tm-card-body p-0">
                    <div class="table-responsive">
                        <table class="table tm-driver-table mb-0">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('truckmate::lang.driver'); ?></th>
                                    <th><?php echo app('translator')->get('truckmate::lang.job_sheets'); ?></th>
                                    <th><?php echo app('translator')->get('truckmate::lang.available_after'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_18 = true; $__currentLoopData = $night_drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center gap-2">
                                                <div class="tm-stat-icon bg-info-soft" style="width:32px;height:32px;border-radius:8px;font-size:0.75rem;">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                                <span class="fw-medium"><?php echo e($d->user_full_name, false); ?></span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <?php $nj = $driver_job_counts[$d->id] ?? 0; ?>
                                            <span class="tm-badge <?php echo e($nj > 0 ? 'tm-badge-success' : 'tm-badge-secondary', false); ?>"><?php echo e($nj, false); ?></span>
                                        </td>
                                        <td><span class="tm-badge tm-badge-info"><?php echo e(\Carbon::createFromTimestamp(strtotime('15:00:00'))->format('h:i A'), false); ?></span></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                    <tr>
                                        <td colspan="3">
                                            <div class="tm-empty-state" style="padding:1.5rem 0;">
                                                <i class="fas fa-user-clock"></i>
                                                <p class="mb-0">No drivers on night shift</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Overview Bar -->
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="tm-card">
                <div class="tm-card-body py-2">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <div class="tm-status-pills">
                            <?php $__currentLoopData = $job_sheet_counts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jbc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="tm-status-pill tm-status-pill-clickable" data-status-name="<?php echo e($jbc['name'], false); ?>">
                                    <span class="tm-dot" style="background:<?php echo e($jbc['color'], false); ?>"></span>
                                    <?php echo e($jbc['name'], false); ?>: <strong><?php echo e($jbc['count'], false); ?></strong>
                                </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="d-flex align-items-center gap-2" style="gap:0.5rem;">
                            <button class="btn btn-sm tm-toggle-completed <?php echo e(request()->get('is_completed_status') === '1' ? 'btn-success' : 'btn-outline-secondary', false); ?>" id="toggle_completed_jobs">
                                <i class="fas fa-check-double"></i> <?php echo app('translator')->get('truckmate::lang.completed'); ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Job Sheets Table Section -->
    <div class="row">
        <div class="col-md-12">
            <div class="tm-card">
                <div class="tm-card-header">
                    <div class="tm-card-title">
                        <i class="fas fa-clipboard-list"></i>
                        <?php echo app('translator')->get('truckmate::lang.job_sheets'); ?>
                        <span class="tm-badge tm-badge-primary ms-2" id="active_jobs_count"><?php echo e($dashboard_stats['total_jobs_today'], false); ?></span>
                    </div>
                    <div class="d-flex align-items-center gap-2" style="gap:0.75rem;">
                        <select class="form-control form-control-sm" id="jobsheet_status" style="width:200px;border-radius:8px;">
                            <option value=""><?php echo app('translator')->get('lang_v1.change_to_filter'); ?></option>
                            <?php $__currentLoopData = $truckmate_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $truckmate_status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($truckmate_status->id, false); ?>"><?php echo e($truckmate_status->name, false); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="tm-card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="job_sheets_table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('truckmate::lang.job_sheet_no'); ?></th>
                                    <th><?php echo app('translator')->get('role.customer'); ?></th>
                                    <th><?php echo app('translator')->get('lang_v1.start_time'); ?></th>
                                    <th><?php echo app('translator')->get('truckmate::lang.loading_point'); ?></th>
                                    <th><?php echo app('translator')->get('truckmate::lang.destination_point'); ?></th>
                                    <th><?php echo app('translator')->get('lang_v1.end_time'); ?></th>
                                    <th><?php echo app('translator')->get('truckmate::lang.loading_address'); ?></th>
                                    <th><?php echo app('translator')->get('truckmate::lang.destination_address'); ?></th>
                                    <th><?php echo app('translator')->get('truckmate::lang.driver'); ?></th>
                                    <th><?php echo app('translator')->get('truckmate::lang.vehicle'); ?></th>
                                    <th><?php echo app('translator')->get('sale.status'); ?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="status_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
        $(document).ready(function () {
            var showCompleted = false;

            job_sheets_table = $("#job_sheets_table").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax:{
                        url: '/truckmate/dashboard-job-sheets',
                        data: function(d) {
                            d.date = $('#dashboard_date').val();
                            d.status_id = $('#jobsheet_status').val();
                            d.is_completed_status = showCompleted ? '1' : '0';
                        },
                    },
                    columns:[
                        { data: 'job_sheet_no', name: 'job_sheet_no' },
                        { data: 'customer', name: 'contacts.name' },
                        { data: 'start_time', name: 'start_time' , searchable : false},
                        { data: 'load_point', name: 'load_point'},
                        { data: 'dest_point', name: 'dest_point' },
                        { data: 'end_time', name: 'end_time' , searchable : false},
						{ data: 'load_address', name: 'load_address' },
						{ data: 'dest_address', name: 'dest_address' },
                        { data: 'driver', name: 'driver.first_name' },
                        { data: 'vehicle_number', name: 'vehicle.number' },
                        { data: 'status', name: 'ts.name' }
                    ],
                    "fnDrawCallback": function (oSettings) {
                        // __currency_convert_recursively($('#job_sheets_table'));
                    }
            });

            $(document).on('change', 'select#jobsheet_status', function () {
                job_sheets_table.ajax.reload();
            });

            // Toggle completed jobs view
            $(document).on('click', '#toggle_completed_jobs', function() {
                showCompleted = !showCompleted;
                $(this).toggleClass('btn-success btn-outline-secondary');
                job_sheets_table.ajax.reload();
            });

            // Jump to date via datepicker
            $('#dashboard_jump_date').datetimepicker({
                format: moment_date_format,
                ignoreReadonly: true,
            });

            $(document).on('click', '#dashboard_jump_btn', function() {
                var jumpVal = $('#dashboard_jump_date').val();
                if (jumpVal) {
                    var parsedDate = moment(jumpVal, moment_date_format);
                    if (parsedDate.isValid()) {
                        window.location.href = '<?php echo e(action([\Modules\Truckmate\Http\Controllers\DashboardController::class, "index"]), false); ?>?date=' + parsedDate.format('YYYY-MM-DD');
                    }
                }
            });

            // Allow Enter key to trigger jump
            $('#dashboard_jump_date').on('keypress', function(e) {
                if (e.which === 13) {
                    e.preventDefault();
                    $('#dashboard_jump_btn').trigger('click');
                }
            });

			<?php if(auth()->user()->can('truckmate_job_sheet.create') || auth()->user()->can('truckmate_job_sheet.edit') || auth()->user()->can('truckmate_job_sheet.update_status')): ?>
                $(document).on('click', '.edit_job_sheet_status', function () {
                    var url = $(this).data('href');
                    $.ajax({
                        method: 'GET',
                        url: url,
                        dataType: 'html',
                        success: function(result) {
                            $('#status_modal').html(result).modal('show');
                        }
                    });
                });
            <?php endif; ?>

            $(document).on('click', '#status_modal [data-bs-dismiss="modal"], #status_modal [data-dismiss="modal"]', function() {
                $('#status_modal').modal('hide');
            });

            $('#status_modal').on('shown.bs.modal', function (e) {

                //initialize editor
                tinymce.init({
                    selector: 'textarea#email_body',
                });

                $('#send_sms').change(function() {
                    if ($(this). is(":checked")) {
                        $('div.sms_body').fadeIn();
                    } else {
                        $('div.sms_body').fadeOut();
                    }
                });

                $('#send_email').change(function() {
                    if ($(this). is(":checked")) {
                        $('div.email_template').fadeIn();
                    } else {
                        $('div.email_template').fadeOut();
                    }
                });

                if ($('#status_id_modal').length) {
                    ;
                    $("#sms_body").val($("#status_id_modal :selected").data('sms_template'));
                    $("#email_subject").val($("#status_id_modal :selected").data('email_subject'));
                    tinymce.activeEditor.setContent($("#status_id_modal :selected").data('email_body'));  
                }

                $('#status_id_modal').on('change', function() {
                    var sms_template = $(this).find(':selected').data('sms_template');
                    var email_subject = $(this).find(':selected').data('email_subject');
                    var email_body = $(this).find(':selected').data('email_body');

                    $("#sms_body").val(sms_template);
                    $("#email_subject").val(email_subject);
                    tinymce.activeEditor.setContent(email_body);

                    if ($('#status_modal .mark-as-complete-btn').length) {
                        // if ($(this).find(':selected').data('is_completed_status') == 1) 
                        // {
                        //     $('#status_modal').find('.mark-as-complete-btn').removeClass('hide');
                        //     $('#status_modal').find('.mark-as-incomplete-btn').addClass('hide');
                        // } else {
                        //     $('#status_modal').find('.mark-as-complete-btn').addClass('hide');
                        //     $('#status_modal').find('.mark-as-incomplete-btn').removeClass('hide');
                        // }
                    }
                });
            });
            
            $('#status_modal').on('hidden.bs.modal', function(){
                tinymce.remove("textarea#email_body");
            });
            
            $(document).on('click', '.update_status_button', function(){
                $('#status_form_redirect').val($(this).data('href'));
            })
            $(document).on('submit', 'form#update_status_form', function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var ladda = Ladda.create(document.querySelector('.ladda-button'));
                ladda.start();
                $.ajax({
                    method: $(this).attr("method"),
                    url: $(this).attr("action"),
                    dataType: "json",
                    data: data,
                    success: function(result){
                        ladda.stop();
                        if(result.success == true){
                            $('#status_modal').modal('hide');
                            if (result.msg) {
                                toastr.success(result.msg);
                            }

                            if ($('#status_form_redirect').val()) {
                                window.location = $('#status_form_redirect').val();
                            }
                            job_sheets_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            });

        });
    </script>
	
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>