
<?php $__env->startSection('title', __('essentials::lang.attendance')); ?>
<?php $__env->startSection('content'); ?>

<?php echo $__env->make('essentials::layouts.nav_hrm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header">
    <h1><?php echo app('translator')->get('essentials::lang.attendance'); ?>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <?php
        $date_loc = array_key_first($date_settings ?? []);
        $hrm_attendance_filter_date_range = ! is_null($date_loc) && is_array($date_settings[$date_loc] ?? null)
            ? ($date_settings[$date_loc]['hrm_attendance_filter_date_range'] ?? null)
            : ($date_settings['hrm_attendance_filter_date_range'] ?? null);
        $hrm_attendance_by_date_filter_date_range = ! is_null($date_loc) && is_array($date_settings[$date_loc] ?? null)
            ? ($date_settings[$date_loc]['hrm_attendance_by_date_filter_date_range'] ?? null)
            : ($date_settings['hrm_attendance_by_date_filter_date_range'] ?? null);
    ?>
    <?php if(!empty($hrm_attendance_filter_date_range)): ?>
        <?php echo Form::hidden('hrm_attendance_filter_date_range', $hrm_attendance_filter_date_range, ['id' => 'hrm_attendance_filter_date_range']); ?>

    <?php endif; ?>
    <?php if(!empty($hrm_attendance_by_date_filter_date_range)): ?>
        <?php echo Form::hidden('hrm_attendance_by_date_filter_date_range', $hrm_attendance_by_date_filter_date_range, ['id' => 'hrm_attendance_by_date_filter_date_range']); ?>

    <?php endif; ?>
    <?php if(session('notification') || !empty($notification)): ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>
                    <?php if(!empty($notification['msg'])): ?>
                        <?php echo e($notification['msg'], false); ?>

                    <?php elseif(session('notification.msg')): ?>
                        <?php echo e(session('notification.msg'), false); ?>

                    <?php endif; ?>
                </div>
            </div>  
        </div>     
    <?php endif; ?>
    <?php if($is_employee_allowed): ?>
        <div class="row no-print">
            <div class="col-md-12 text-center">
                <button 
                    type="button" 
                    class="btn btn-app bg-blue clock_in_btn
                        <?php if(!empty($clock_in)): ?>
                            hide
                        <?php endif; ?>
                    "
                    data-type="clock_in"
                    >
                    <i class="fas fa-arrow-circle-down"></i> <?php echo app('translator')->get('essentials::lang.clock_in'); ?>
                </button>
            &nbsp;&nbsp;&nbsp;
                <button 
                    type="button" 
                    class="btn btn-app bg-yellow clock_out_btn
                        <?php if(empty($clock_in)): ?>
                            hide
                        <?php endif; ?>
                    "  
                    data-type="clock_out"
                    >
                    <i class="fas fa-hourglass-half fa-spin"></i> <?php echo app('translator')->get('essentials::lang.clock_out'); ?>
                </button>
                <?php if(!empty($clock_in)): ?>
                    <br>
                    <small class="text-muted"><?php echo app('translator')->get('essentials::lang.clocked_in_at'); ?>: <?php echo format_datetime_br($clock_in->clock_in_time); ?></small>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget'); ?>
                <div class="card-header p-0">
                    <ul class="nav nav-tabs no-print" role="tablist">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.crud_all_attendance')): ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="#shifts_tab" data-bs-toggle="tab" aria-expanded="true">
                                    <i class="fas fa-user-clock" aria-hidden="true"></i>
                                    <?php echo app('translator')->get('essentials::lang.shifts'); ?>
                                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('essentials::lang.shift_datatable_tooltip') . '"></i>';
                }
            ?>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(!auth()->user()->can('essentials.crud_all_attendance')): ?> active <?php endif; ?>" href="#attendance_tab" data-bs-toggle="tab" aria-expanded="true"><i class="fas fa-check-square" aria-hidden="true"></i> <?php echo app('translator')->get( 'essentials::lang.all_attendance' ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#attendance_monthly_tab" data-bs-toggle="tab" aria-expanded="true"><i class="fas fa-check-square" aria-hidden="true"></i> <?php echo app('translator')->get( 'essentials::lang.attendance_monthly_tab' ); ?></a>
                        </li>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.crud_all_attendance')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#attendance_by_shift_tab" data-bs-toggle="tab" aria-expanded="true"><i class="fas fa-user-check" aria-hidden="true"></i> <?php echo app('translator')->get('essentials::lang.attendance_by_shift'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#attendance_by_date_tab" data-bs-toggle="tab" aria-expanded="true"><i class="fas fa-calendar" aria-hidden="true"></i> <?php echo app('translator')->get('essentials::lang.attendance_by_date'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#import_attendance_tab" data-bs-toggle="tab" aria-expanded="true"><i class="fas fa-download" aria-hidden="true"></i> <?php echo app('translator')->get('essentials::lang.import_attendance'); ?></a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.crud_all_attendance')): ?>
                        <div class="tab-pane active" id="shifts_tab">
                            <button type="button" class="btn btn-primary float-end"  data-bs-toggle="modal" data-bs-target="#shift_modal"> <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></button>
                            <br><br><br>
                            <div class="table-responsive" style="min-height: 80vh">
                                <table class="table table-bordered table-striped table-hover table-th-skin" id="shift_table">
                                    <thead>
                                        <tr>
                                            <th><?php echo app('translator')->get( 'lang_v1.name' ); ?></th>
                                            <th><?php echo app('translator')->get( 'essentials::lang.shift_type' ); ?></th>
                                            <th><?php echo app('translator')->get( 'restaurant.start_time' ); ?></th>
                                            <th><?php echo app('translator')->get( 'restaurant.end_time' ); ?></th>
                                            <th><?php echo app('translator')->get( 'essentials::lang.holiday' ); ?></th>
                                            <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="tab-pane <?php if(!auth()->user()->can('essentials.crud_all_attendance')): ?> active <?php endif; ?>" id="attendance_tab">
                        <div class="row">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.crud_all_attendance')): ?>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php echo Form::label('employee_id', __('essentials::lang.employee') . ':'); ?>

                                        <?php echo Form::select('employee_id', $employees, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo Form::label('department_id', __('essentials::lang.department') . ':'); ?>

                                    <?php echo Form::select('department_id', $departments, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo Form::label('sub_department_id', __('essentials::lang.sub_department') . ':'); ?>

                                    <?php echo Form::select('sub_department_id', [], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo Form::label('designation_id', __('essentials::lang.designation') . ':'); ?>

                                    <?php echo Form::select('designation_id', $designations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo Form::label('date_range', __('report.date_range') . ':'); ?>

                                    <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

                                </div>
                            </div>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.crud_all_attendance')): ?>
                            <div class="col-md-9 spacer">
                                <button type="button" class="btn btn-warning pull-left mt-5 delete_duplicate_attendance" data-href="<?php echo e(action([\Modules\Essentials\Http\Controllers\AttendanceController::class, 'deleteDuplicates']), false); ?>">
                                    <?php echo app('translator')->get( 'essentials::lang.delete_duplicate_attendance' ); ?>
                                </button>
                                <button type="button" class="btn btn-primary btn-modal pull-right" data-href="<?php echo e(action([\Modules\Essentials\Http\Controllers\AttendanceController::class, 'create']), false); ?>" data-container="#attendance_modal">
                                    <i class="fa fa-plus"></i>
                                    <?php echo app('translator')->get( 'essentials::lang.add_latest_attendance' ); ?>
                                </button>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div id="user_attendance_summary" class="hide">
                            <h3>
                                <strong><?php echo app('translator')->get('essentials::lang.total_work_hours'); ?>:</strong>
                                <span id="total_work_hours"></span>
                            </h3>
                        </div>
                        <br><br>
                        <div class="table-responsive" style="min-height: 80vh">
                            <table class="table table-bordered table-striped table-hover table-th-skin" id="attendance_table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get( 'lang_v1.date' ); ?></th>
                                        <th><?php echo app('translator')->get('essentials::lang.employee'); ?></th>
                                        <th><?php echo app('translator')->get( 'essentials::lang.department' ); ?></th>
                                        <th><?php echo app('translator')->get( 'essentials::lang.sub_department' ); ?></th>
                                        <th><?php echo app('translator')->get( 'essentials::lang.designation' ); ?></th>
                                        <th><?php echo app('translator')->get('essentials::lang.clock_in'); ?></th>
                                        <th><?php echo app('translator')->get('essentials::lang.clock_out'); ?></th>
                                        <th><?php echo app('translator')->get('essentials::lang.work_duration'); ?></th>
                                        <th><?php echo app('translator')->get('essentials::lang.ip_address'); ?></th>
                                        <th><?php echo app('translator')->get('essentials::lang.shift'); ?></th>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.crud_all_attendance')): ?>
                                            <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="attendance_monthly_tab">
                        <div class="row no-print">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.crud_all_attendance')): ?>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php echo Form::label('am_employee_id', __('essentials::lang.employee') . ':'); ?>

                                        <?php echo Form::select('am_employee_id', $employees, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo Form::label('am_department_id', __('essentials::lang.department') . ':'); ?>

                                    <?php echo Form::select('am_department_id', $departments, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo Form::label('am_sub_department_id', __('essentials::lang.sub_department') . ':'); ?>

                                    <?php echo Form::select('am_sub_department_id', [], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo Form::label('am_designation_id', __('essentials::lang.designation') . ':'); ?>

                                    <?php echo Form::select('am_designation_id', $designations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo Form::label('am_month', __('lang_v1.month') . ':'); ?>

                                    <?php echo Form::select('am_month', [
                                        '01' => __('lang_v1.january'),
                                        '02' => __('lang_v1.february'),
                                        '03' => __('lang_v1.march'),
                                        '04' => __('lang_v1.april'),
                                        '05' => __('lang_v1.may'),
                                        '06' => __('lang_v1.june'),
                                        '07' => __('lang_v1.july'),
                                        '08' => __('lang_v1.august'),
                                        '09' => __('lang_v1.september'),
                                        '10' => __('lang_v1.october'),
                                        '11' => __('lang_v1.november'),
                                        '12' => __('lang_v1.december')
                                    ], date('m'), ['class' => 'form-control', 'required']); ?>

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo Form::label('am_year', __('lang_v1.month') . ':'); ?>

                                    <?php echo Form::select('am_year', array_combine(
                                        range(date('Y'), date('Y') - 5), 
                                        range(date('Y'), date('Y') - 5)
                                    ), date('Y'), ['class' => 'form-control', 'required']); ?>

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <br>
                                    <button type="button" class="btn btn-primary" id="am_report_btn">Generate</button>
                                </div>
                            </div>
                        </div>
                        <div id="attendance_monthly_report"></div>
                    </div>
                    
                    <div class="tab-pane" id="attendance_by_shift_tab">
                        <?php echo $__env->make('essentials::attendance.attendance_by_shift', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="tab-pane" id="attendance_by_date_tab">
                        <?php echo $__env->make('essentials::attendance.attendance_by_date', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.crud_all_attendance')): ?>
                        <div class="tab-pane fade" id="import_attendance_tab">
                            <?php echo $__env->make('essentials::attendance.import_attendance', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endif; ?>
                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    
</section>
<!-- /.content -->
<div class="modal fade" id="attendance_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel"></div>
<div class="modal fade modal-stacked" id="edit_attendance_modal" tabindex="-1" role="dialog"
        aria-labelledby="gridSystemModalLabel"></div>
<div class="modal fade" id="user_shift_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel"></div>
<div class="modal fade" id="edit_shift_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel"></div>
<div class="modal fade" id="shift_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    <?php echo $__env->make('essentials::attendance.shift_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            function get_attendance_date_range_settings(date_range_default, fallback_start, fallback_end) {
                var settings = $.extend({}, dateRangeSettings, {
                    locale: $.extend({}, dateRangeSettings.locale)
                });
                settings.startDate = fallback_start;
                settings.endDate = fallback_end;

                if(date_range_default == 'today'){
                    settings.startDate = moment();
                    settings.endDate = moment();
                }else if(date_range_default == 'last_seven_days'){
                    settings.startDate = moment().subtract(6,'day');
                    settings.endDate = moment();
                }else if(date_range_default == 'last_thirty_days'){
                    settings.startDate = moment().subtract(29,'day');
                    settings.endDate = moment();
                }else if(date_range_default == 'this_month'){
                    settings.startDate = moment().startOf('month');
                    settings.endDate = moment();
                }else if(date_range_default == 'last_month'){
                    settings.startDate = moment().subtract(1, 'month').startOf('month');
                    settings.endDate = moment().subtract(1, 'month').endOf('month');
                }else if(date_range_default == 'this_year'){
                    settings.startDate = moment().startOf('year');
                    settings.endDate = moment();
                }else if(date_range_default == 'last_year'){
                    settings.startDate = moment().subtract(1, 'year').startOf('year');
                    settings.endDate = moment().subtract(1, 'year').endOf('year');
                }else if(date_range_default == 'current_financial_year'){
                    settings.startDate = dateRangeSettings.startDate;
                    settings.endDate = dateRangeSettings.endDate;
                }else if(date_range_default == 'all_time'){
                    settings.startDate = moment(business_start_date);
                    settings.endDate = moment();
                }

                return settings;
            }

            var attendance_date_range_settings = get_attendance_date_range_settings(
                $('#hrm_attendance_filter_date_range').val(),
                moment(),
                moment()
            );
            $('#date_range').daterangepicker(
                attendance_date_range_settings,
                function (start, end) {
                    $('#date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                }
            );

            attendance_table = $('#attendance_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "<?php echo e(action([\Modules\Essentials\Http\Controllers\AttendanceController::class, 'index']), false); ?>",
                    "data" : function(d) {
                        if ($('#employee_id').length) {
                            d.employee_id = $('#employee_id').val();
                        }
                        if($('#date_range').val()) {
                            var start = $('#date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                            var end = $('#date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                            d.start_date = start;
                            d.end_date = end;
                            if ($('#department_id').length) {
                                d.department_id = $('#department_id').val();
                            }
                            if ($('#sub_department_id').length) {
                                d.sub_department_id = $('#sub_department_id').val();
                            }
                            if ($('#designation_id').length) {
                                d.designation_id = $('#designation_id').val();
                            }
                        }
                    }
                },
                columns: [
                    { data: 'date', name: 'clock_in_time' },
                    { data: 'user', name: 'user' },
                    { data: 'department', name: 'dept.name' },
                    { data: 'sub_department', name: 'sub_dept.name' },
                    { data: 'designation', name: 'dsgn.name' },
                    { data: 'clock_in', name: 'clock_in', orderable: false, searchable: false},
                    { data: 'clock_out', name: 'clock_out', orderable: false, searchable: false},
                    { data: 'work_duration', name: 'work_duration', orderable: false, searchable: false},
                    { data: 'ip_address', name: 'ip_address'},
                    { data: 'shift_name', name: 'es.name'},
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.crud_all_attendance')): ?>
                        { data: 'action', name: 'action', orderable: false, searchable: false},
                    <?php endif; ?>
                ],
            });

            $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#date_range').val('');
                attendance_table.ajax.reload();
            });

            $(document).on('change', '#employee_id, #department_id, #sub_department_id, #designation_id, #date_range', function() {
                attendance_table.ajax.reload();
            });

            $(document).on('change', '#department_id', function(){
                if($(this).val() !== '') {
                    $.ajax({
                        url: '/get-sub-taxonomies?type=hrm_department&parent_category=' + $(this).val(),
                        dataType: 'json',
                        success: function(result) {
                            $('#sub_department_id').select2('destroy')
                                .empty()
                                .select2({
                                    data: result.sub_categories,
                                });
                                $('#sub_department_id').change();
                        },
                    });
                }else{
                    $('#sub_department_id').select2('destroy')
                                .empty()
                                .select2({
                                    data: [{id: null, text: "All"}],
                                });
                                $('#sub_department_id').change();
                }
            });

            $(document).on('change', '#am_department_id', function(){
                if($(this).val() !== '') {
                    $.ajax({
                        url: '/get-sub-taxonomies?type=hrm_department&parent_category=' + $(this).val(),
                        dataType: 'json',
                        success: function(result) {
                            $('#am_sub_department_id').select2('destroy')
                                .empty()
                                .select2({
                                    data: result.sub_categories,
                                });
                                $('#am_sub_department_id').change();
                        },
                    });
                }else{
                    $('#am_sub_department_id').select2('destroy')
                                .empty()
                                .select2({
                                    data: [{id: null, text: "All"}],
                                });
                                $('#am_sub_department_id').change();
                }
            });

            $(document).on('submit', 'form#attendance_form', function(e) {
                e.preventDefault();
                if($(this).valid()) {
                    $(this).find('button[type="submit"]').attr('disabled', true);
                    var data = $(this).serialize();
                    $.ajax({
                        method: $(this).attr('method'),
                        url: $(this).attr('action'),
                        dataType: 'json',
                        data: data,
                        success: function(result) {
                            if (result.success == true) {
                                $('div#attendance_modal').modal('hide');
                                $('div#edit_attendance_modal').modal('hide');
                                toastr.success(result.msg);
                                attendance_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                }
            });

            $(document).on( 'change', '#employee_id, #date_range', function() {
                get_attendance_summary();
            });

            <?php if(!auth()->user()->can('essentials.crud_all_attendance')): ?>
                get_attendance_summary();
            <?php endif; ?>

            shift_table = $('#shift_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "<?php echo e(action([\Modules\Essentials\Http\Controllers\ShiftController::class, 'index']), false); ?>",
                },
                columnDefs: [
                    {
                        targets: 4,
                        orderable: false,
                        searchable: false,
                    },
                ],
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'type', name: 'type' },
                    { data: 'start_time', name: 'start_time'},
                    { data: 'end_time', name: 'end_time' },
                    { data: 'holidays', name: 'holidays'},
                    { data: 'action', name: 'action' },
                ],
            });

            $('#shift_modal, #edit_shift_modal').on('shown.bs.modal', function(e) {
            
                $('form#add_shift_form').validate();
                $('#shift_modal #start_time, #shift_modal #end_time, #edit_shift_modal #start_time, #edit_shift_modal #end_time').datetimepicker({
                    format: moment_time_format,
                    ignoreReadonly: true,
                });
                $('#shift_modal .select2, #edit_shift_modal .select2').each(function() {
                    $(this).select2({ dropdownParent: $(this).closest('.modal') });
                });

                if ($('select#shift_type').val() == 'fixed_shift') {
                    $('div.time_div').show();
                } else if ($('select#shift_type').val() == 'flexible_shift') {
                    $('div.time_div').hide();
                }

                $('select#shift_type').change(function() {
                    var shift_type = $(this).val();
                    if (shift_type == 'fixed_shift') {
                        $('div.time_div').fadeIn();
                    } else if (shift_type == 'flexible_shift') {
                        $('div.time_div').fadeOut();
                    }
                });

                //toggle auto clockout
                if($('#is_allowed_auto_clockout').is(':checked')) {
                    $("div.enable_auto_clock_out_time").show();
                } else {
                    $("div.enable_auto_clock_out_time").hide(); 
                }

                $('#is_allowed_auto_clockout').on('change', function(){
                    if ($(this).is(':checked')) {
                        $("div.enable_auto_clock_out_time").show();
                    } else {
                       $("div.enable_auto_clock_out_time").hide(); 
                    }
                });
                
                $('#shift_modal #auto_clockout_time, #edit_shift_modal #auto_clockout_time').datetimepicker({
                    format: moment_time_format,
                    stepping: 30,
                    ignoreReadonly: true,
                });
            });
            $('#shift_modal, #edit_shift_modal').on('hidden.bs.modal', function(e) {
                $('#shift_modal #start_time').data("DateTimePicker").destroy();
                $('#shift_modal #end_time').data("DateTimePicker").destroy();
                $('#add_shift_form')[0].reset();
                $('#add_shift_form').find('button[type="submit"]').attr('disabled', false);

                $('#is_allowed_auto_clockout').attr('checked', false);
                $('#auto_clockout_time').data("DateTimePicker").destroy();
                $("div.enable_auto_clock_out_time").hide(); 
            });
            $('#user_shift_modal').on('shown.bs.modal', function(e) {
                $('#user_shift_modal').find('.date_picker').each( function(){
                    $(this).datetimepicker({
                        format: moment_date_format,
                        ignoreReadonly: true,
                    });
                });
            });

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.crud_all_attendance')): ?>
                get_attendance_by_shift();
                $('#attendance_by_shift_date_filter').datetimepicker({
                    format: moment_date_format,
                    ignoreReadonly: true,
                });
                var attendance_by_date_range_settings = get_attendance_date_range_settings(
                    $('#hrm_attendance_by_date_filter_date_range').val(),
                    moment().subtract(6, 'days'),
                    moment()
                );
                $('#attendance_by_date_filter').daterangepicker(
                    attendance_by_date_range_settings,
                    function (start, end) {
                        $('#attendance_by_date_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                    }
                );
                get_attendance_by_date();
                $(document).on('change', '#attendance_by_date_filter', function(){
                    get_attendance_by_date();
                });
            <?php endif; ?>

            $('a[href="#attendance_tab"]').click(function(){
                attendance_table.ajax.reload();
            });
            $('a[href="#attendance_by_shift_tab"]').click(function(){
                get_attendance_by_shift();
            });
            $('a[href="#attendance_by_date_tab"]').click(function(){
                get_attendance_by_date();
            });
        });

        $(document).on('click', 'button#am_report_btn', function() {
            var loader = __fa_awesome();
            $('#attendance_monthly_report').html(`
                <div class="container text-center" style="justify-content: space-around;display: flex;">
                    <div style="padding: 15px;margin: 25px;font-size: 1.4em;background-color: #d0f5be;width: 40%;">Processing Report ${loader}</div>
                </div>
            `);
            $.ajax({
                url: "<?php echo e(action([\Modules\Essentials\Http\Controllers\AttendanceController::class, 'monthlyAttendance']), false); ?>",
                data: {
                    employee_id : $('#am_employee_id').val(),
                    department_id : $('#am_department_id').val(),
                    sub_department_id : $('#am_sub_department_id').val(),
                    designation_id : $('#am_designation_id').val(),
                    month : $('#am_month').val(),
                    year : $('#am_year').val(),
                },
                method: 'GET',
                dataType: 'html',
                success: function(html) {
                    $('#attendance_monthly_report').html(html);
                },
                error: function(){
                    loading.toggleClass('hide');
                    toastr.error('Report Not Generated - Some Error');
                },
            });
        });

        $(document).on('click', '.toggle-tr', function(){
            let atten_tr_class = $(this).data('atten-tr-class');
            // $(this).closest('tr.'+atten-tr-class).toggleClass('collapse-tr');
            $('.' + atten_tr_class).toggleClass('collapse-tr');

            $(this).find('.collapse-icon').toggleClass('collapsed');
            var html = $(this).find('.collapse-icon').hasClass('collapsed') ? 
            '<i class="fas fa-arrow-circle-right"></i>' : '<i class="fas fa-arrow-circle-down"></i>';
            $(this).find('.collapse-icon').html(html);
        });

        $(document).on('click', '#print_atten_monthly_report', function(){
            $('#attendance_monthly_report .filters').toggleClass('hide');
            setTimeout(() => {
                $('#attendance_monthly_report .filters').toggleClass('hide');
            }, 2000);
            $('#attendance_monthly_report').printThis();
        });

        $(document).on('click', 'button.delete-attendance', function() {
            swal({
                title: LANG.sure,
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(willDelete => {
                if (willDelete) {
                    var href = $(this).data('href');
                    var data = $(this).serialize();
                    $.ajax({
                        method: 'DELETE',
                        url: href,
                        dataType: 'json',
                        data: data,
                        success: function(result) {
                            if (result.success == true) {
                                toastr.success(result.msg);
                                attendance_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                }
            });
        });
        $('#edit_attendance_modal').on('hidden.bs.modal', function(e) {
            $('#edit_attendance_modal #clock_in_time').data("DateTimePicker").destroy();
            $('#edit_attendance_modal #clock_out_time').data("DateTimePicker").destroy();
        });

        $('#attendance_modal').on('shown.bs.modal', function(e) {
            $('#attendance_modal .select2').select2({dropdownParent: $('#attendance_modal')});
        });
        $('#edit_attendance_modal').on('shown.bs.modal', function(e) {
            $('#edit_attendance_modal .select2').select2();
            $('#edit_attendance_modal #clock_in_time, #edit_attendance_modal #clock_out_time').datetimepicker({
                format: moment_date_format + ' ' + moment_time_format,
                ignoreReadonly: true,
            });

            validate_clockin_clock_out = {
                url: '/hrm/validate-clock-in-clock-out',
                type: 'post',
                data: {
                    user_ids: function() {
                        return $('#employees').val();
                    },
                    clock_in_time: function() {
                        return $('#clock_in_time').val();
                    },
                    clock_out_time: function() {
                        return $('#clock_out_time').val();
                    },
                    attendance_id: function() {
                        if($('form#attendance_form #attendance_id').length) {
                           return $('form#attendance_form #attendance_id').val();
                        } else {
                            return '';
                        }
                    },
                },
            };

            $('form#attendance_form').validate({
                rules: {
                    clock_in_time: {
                        remote: validate_clockin_clock_out,
                    },
                    clock_out_time: {
                        remote: validate_clockin_clock_out,
                    },
                },
                messages: {
                    clock_in_time: {
                        remote: "<?php echo e(__('essentials::lang.clock_in_clock_out_validation_msg'), false); ?>",
                    },
                    clock_out_time: {
                        remote: "<?php echo e(__('essentials::lang.clock_in_clock_out_validation_msg'), false); ?>",
                    },
                },
            });
        });

        function get_attendance_summary() {
            $('#user_attendance_summary').addClass('hide');
            var user_id = $('#employee_id').length ? $('#employee_id').val() : '';
            
            var start = $('#date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
            var end = $('#date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
            $.ajax({
                url: '<?php echo e(action([\Modules\Essentials\Http\Controllers\AttendanceController::class, 'getUserAttendanceSummary']), false); ?>?user_id=' + user_id + '&start_date=' + start + '&end_date=' + end ,
                dataType: 'html',
                success: function(response) {
                    $('#total_work_hours').html(response);
                    $('#user_attendance_summary').removeClass('hide');
                },
            });
        }

    //Set mindate for clockout time greater than clockin time
    $('#attendance_modal').on('dp.change', '#clock_in_time', function(){
        if ($('#clock_out_time').data("DateTimePicker")) {
            $('#clock_out_time').data("DateTimePicker").options({minDate: $(this).data("DateTimePicker").date()});
            $('#clock_out_time').data("DateTimePicker").clear();
        }
    });

    $(document).on('submit', 'form#add_shift_form', function(e) {
        e.preventDefault();
        $(this).find('button[type="submit"]').attr('disabled', true);
        var data = $(this).serialize();

        $.ajax({
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            dataType: 'json',
            data: data,
            success: function(result) {
                if (result.success == true) {
                    if ($('div#edit_shift_modal').hasClass('in')) {
                        $('div#edit_shift_modal').modal("hide");
                    } else if ($('div#shift_modal').hasClass('in')) {
                        $('div#shift_modal').modal('hide');    
                    }
                    toastr.success(result.msg);
                    shift_table.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
                $('form#add_shift_form')[0].reset();
            },
        });
    });

    $(document).on('submit', 'form#add_user_shift_form', function(e) {
        e.preventDefault();
        $(this).find('button[type="submit"]').attr('disabled', true);
        var data = $(this).serialize();

        $.ajax({
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            dataType: 'json',
            data: data,
            success: function(result) {
                if (result.success == true) {
                    $('div#user_shift_modal').modal('hide');
                    toastr.success(result.msg);
                } else {
                    toastr.error(result.msg);
                }
                $('form#add_user_shift_form').find('button[type="submit"]').attr('disabled', false);
            },
        });
    });

    function get_attendance_by_shift() {
        data = {date: $('#attendance_by_shift_date_filter').val()};
        $.ajax({
            url: "<?php echo e(action([\Modules\Essentials\Http\Controllers\AttendanceController::class, 'getAttendanceByShift']), false); ?>",
            data: data,
            dataType: 'html',
            success: function(result) {
                $('table#attendance_by_shift_table tbody').html(result);
            },
        });
    }
    function get_attendance_by_date() {
        data = {
                start_date: $('#attendance_by_date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD'),
                end_date: $('#attendance_by_date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD')
            };
        $.ajax({
            url: "<?php echo e(action([\Modules\Essentials\Http\Controllers\AttendanceController::class, 'getAttendanceByDate']), false); ?>",
            data: data,
            dataType: 'html',
            success: function(result) {
                $('table#attendance_by_date_table tbody').html(result);
            },
        });
    }
    $(document).on('dp.change', '#attendance_by_shift_date_filter', function(){
        get_attendance_by_shift();
    });
    
    $(document).on('change', '#select_employee', function(e) {
        var user_id = $(this).val();
        var count = 0;
        $('table#employee_attendance_table tbody').find('tr').each( function(){
            if ($(this).data('user_id') == user_id) {
                count++;
            }
        });
        
        if (user_id && count == 0) {
            $.ajax({
                url: "/hrm/get-attendance-row/" + user_id,
                dataType: 'html',
                success: function(result) {
                    $('table#employee_attendance_table tbody').append(result);
                    var tr = $('table#employee_attendance_table tbody tr:last');

                    tr.find('.date_time_picker').each( function(){
                        $(this).datetimepicker({
                            format: moment_date_format + ' ' + moment_time_format,
                            ignoreReadonly: true,
                            maxDate: moment(),
                            widgetPositioning: {
                                horizontal: 'auto',
                                vertical: 'bottom'
                             }
                        });
                        $(this).val('');
                    });
                    $('#select_employee').val('').change();
                },
            });
        }
    });
    $(document).on('click', 'button.remove_attendance_row', function(e) {
        $(this).closest('tr').remove();
    });

    $(document).on('click', 'button.sync_attendance', function() {
        var terminal_api_key = $('input#terminal_api_key').val();
        var terminal_api_secret = $('input#terminal_api_secret').val();
        var loading = $(this).find('i');
        loading.toggleClass('hide');
        data = {
            api_key: terminal_api_key,
            api_secret: terminal_api_secret,
            device_id: 'device1',
        };

        $.ajax({
            url: "http://127.0.0.1:5000/get_attendance",
            data: data,
            method: 'GET',
            dataType: 'json',
            success: function(result) {
                if(result.success){
                    $.ajax({
                        method: 'POST',
                        url: "/hrm/sync-attendance",
                      	data: JSON.stringify(result),
                        contentType: 'application/json',
                        processData: false,
                        success: function(result2) {
                            if(result2.success){
                                toastr.success(result2.msg);
                            }else{
                                toastr.error(result2.msg);
                            }  
                            loading.toggleClass('hide');
                        },
                    });
                }else{
                    toastr.warning(result.message);
                    loading.toggleClass('hide');
                }
            },
            error: function(){
                loading.toggleClass('hide');
                toastr.error('Nothing Synced - Please Check If Conncetor Software is Running');
            },
        });
    });

    
    // $(document).on('click', 'button.clear_attendance', function() {
    //     var terminal_api_key = $('input#terminal_api_key').val();
    //     var terminal_api_secret = $('input#terminal_api_secret').val();
    //     swal({
    //         title: LANG.sure,
    //         icon: 'warning',
    //         buttons: true,
    //         dangerMode: true,
    //     }).then(willDelete => {
    //         if (willDelete) {
    //             var loading = $(this).find('i');
    //             loading.toggleClass('hide');
    //             data = {
    //                 api_key: terminal_api_key,
    //                 api_secret: terminal_api_secret,
    //                 device_id: 'device1',
    //             };
    //             $.ajax({
    //                 url: "http://127.0.0.1:5000/clear_attendance",
    //                 data: data,
    //                 method: 'DELETE',
    //                 dataType: 'json',
    //                 success: function(result) {
    //                     if(result.success){
    //                         toastr.success(result.message);
    //                         loading.toggleClass('hide');
    //                     }else{
    //                         toastr.warning(result.message);
    //                         loading.toggleClass('hide');
    //                     }
    //                 },
    //                 error: function(){
    //                     loading.toggleClass('hide');
    //                     toastr.error('Nothing Cleared - Please Check If Conncetor Software is Running');
    //                 },
    //             });
    //         }
    //     });
    // });

    //Approval Action Perform
    $(document).on('submit', '#clear-attendance-form', function(e) {
        e.preventDefault();
        $('#clear-attendance-form #submit-clear-attendance').attr('disabled', true);
        let href = $(this).attr('action');
        let formData = $(this).serialize();
        //reset the feilds on submit
        $('#clear-attendance-form #permission_username').removeClass('bg-danger');
        $('#clear-attendance-form #permission_password').removeClass('bg-danger');

        $.ajax({
            method: 'post',
            url: href,
            data: formData,
            dataType: 'json',
            success: function(result) {
                if(result.success){
                    $('.view_modal').html('').modal('hide');
                    toastr.success(result.msg);
                    var terminal_api_key = $('input#terminal_api_key').val();
                    var terminal_api_secret = $('input#terminal_api_secret').val();

                    var loading = $('a.clear_attendance').find('i');
                    loading.toggleClass('hide');
                    data = {
                        api_key: terminal_api_key,
                        api_secret: terminal_api_secret,
                        device_id: 'device1',
                    };
                    $.ajax({
                        url: "http://127.0.0.1:5000/clear_attendance",
                        data: data,
                        method: 'DELETE',
                        dataType: 'json',
                        success: function(result2) {
                            if(result2.success){
                                toastr.success(result2.message);
                                loading.toggleClass('hide');
                            }else{
                                toastr.warning(result2.message);
                                loading.toggleClass('hide');
                            }
                        },
                        error: function(){
                            loading.toggleClass('hide');
                            toastr.error('Nothing Cleared - Please Check If Conncetor Software is Running');
                        },
                    });

                }else{
                    toastr.error(result.msg);
                    if(result.username_error){
                        $('#clear-attendance-form #permission_username').addClass('bg-danger');
                    }
                    if(result.password_error){
                        $('#clear-attendance-form #permission_password').addClass('bg-danger');   
                    }
                    $('#clear-attendance-form #submit-clear-attendance').attr('disabled', false);
                } 
            },
        });
    });

    $(document).on('click', 'button.show_enrolled_users', function() {
        var terminal_api_key = $('input#terminal_api_key').val();
        var terminal_api_secret = $('input#terminal_api_secret').val();
        var loading = $(this).find('i');
        loading.toggleClass('hide');
        data = {
            api_key: terminal_api_key,
            api_secret: terminal_api_secret,
            device_id: 'device1',
        };
        $.ajax({
            url: "http://127.0.0.1:5000/get_users",
            data: data,
            method: 'GET',
            dataType: 'json',
            success: function(result) {
                if(result.success){
                    $('table#enrolled_users_table tbody').html('');
                    result.users.forEach(element => {
                        var table_row = `
                        <tr>
                            <td>${element.user_id}</td>
                            <td>${element.privilege}</td>
                            <td>${element.name}</td>
                            <td>${element.password}</td>
                        </tr>`;
                        $('table#enrolled_users_table tbody').append(table_row);
                    });
                    loading.toggleClass('hide');
                    $('div#enrolled_users_list').modal('show');
                }else{
                    toastr.warning(result.message);
                    loading.toggleClass('hide');
                }
            },
            error: function(){
                loading.toggleClass('hide');
                toastr.error('Nothing Cleared - Please Check If Conncetor Software is Running');
            },
        });
    });

    $(document).on('click', 'button.show_device_attendance', function() {
        var terminal_api_key = $('input#terminal_api_key').val();
        var terminal_api_secret = $('input#terminal_api_secret').val();
        var loading = $(this).find('i');
        loading.toggleClass('hide');
        var data = {
            api_key: terminal_api_key,
            api_secret: terminal_api_secret,
            device_id: 'device1',
        };

        function mapDeviceState(state) {
            var st = parseInt(state);
            if (st === 0) return '<span class="label label-success badge bg-success">Check In</span>';
            if (st === 1) return '<span class="label label-danger badge bg-danger">Check Out</span>';
            if (st === 2) return '<span class="label label-warning badge bg-warning">Break Out</span>';
            if (st === 3) return '<span class="label label-info badge bg-info">Break In</span>';
            if (st === 4) return '<span class="label label-success badge bg-success">Overtime In</span>';
            if (st === 5) return '<span class="label label-danger badge bg-danger">Overtime Out</span>';
            return '<span class="label label-default badge bg-secondary">' + state + '</span>';
        }

        $.ajax({
            url: "http://127.0.0.1:5000/get_attendance",
            data: data,
            method: 'GET',
            dataType: 'json',
            success: function(result) {
                if(result.success && result.attendance){
                    $('table#device_attendance_table tbody').html('');
                    if(result.attendance.length === 0){
                        $('table#device_attendance_table tbody').append('<tr><td colspan="5" class="text-center">No attendance data found on device</td></tr>');
                    } else {
                        result.attendance.forEach(function(element) {
                            var uid = element.user_id ? element.user_id.toString() : '';
                            var fullName = (window.device_users_map && window.device_users_map[uid]) ? window.device_users_map[uid] : '<span class="text-muted">Not Found</span>';
                            var stateHtml = mapDeviceState(element.state);
                            var table_row = `
                            <tr>
                                <td>${uid}</td>
                                <td><strong>${fullName}</strong></td>
                                <td>${element.timestamp || ''}</td>
                                <td>${stateHtml}</td>
                                <td>${element.mode !== undefined ? element.mode : ''}</td>
                            </tr>`;
                            $('table#device_attendance_table tbody').append(table_row);
                        });
                    }
                    loading.toggleClass('hide');
                    $('div#device_attendance_list').modal('show');
                }else{
                    toastr.warning(result.message || 'Failed to fetch attendance data');
                    loading.toggleClass('hide');
                }
            },
            error: function(){
                loading.toggleClass('hide');
                toastr.error('Could not connect - Please Check If Connector Software is Running');
            },
        });
    });

    $(document).on('click', 'button.delete_duplicate_attendance', function() {
        let href = $(this).attr('data-href');
        swal({
            title: LANG.sure,
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                $.ajax({
                    url: href,
                    method: 'GET',
                    dataType: 'json',
                    success: function(result) {
                        if(result.success){
                            toastr.success(result.message);
                            if (typeof attendance_table !== 'undefined') {
                                attendance_table.ajax.reload();
                            }
                        }else{
                            toastr.warning(result.message);
                        }
                    },
                    error: function(){
                        toastr.error('Something Went Wrong');
                    },
                });
            }
        });
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>