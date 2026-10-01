
<?php $__env->startSection('title', __('essentials::lang.payroll')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('essentials::layouts.nav_hrm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header">
    <h1><?php echo app('translator')->get('essentials::lang.payroll'); ?>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget'); ?>
                <div class="card-header p-0">
                    <ul class="nav nav-tabs" role="tablist">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.view_all_payroll')): ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="#payroll_group_tab" data-bs-toggle="tab" aria-expanded="true">
                                    <i class="fas fa-layer-group" aria-hidden="true"></i>
                                    <?php echo app('translator')->get('essentials::lang.all_payroll_groups'); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#payroll_tab" data-bs-toggle="tab" aria-expanded="true">
                                <i class="fas fa-coins" aria-hidden="true"></i>
                                <?php echo app('translator')->get('essentials::lang.all_payrolls'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#monthly_payroll_tab" data-bs-toggle="tab" aria-expanded="true">
                                <i class="fas fa-coins" aria-hidden="true"></i>
                                <?php echo app('translator')->get('essentials::lang.monthly_payroll_tab'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pay_advance_tab" data-bs-toggle="tab" aria-expanded="true">
                                <i class="fas fa-coins" aria-hidden="true"></i>
                                <?php echo app('translator')->get('essentials::lang.advance_payments'); ?>
                            </a>
                        </li>
                        <?php if(auth()->user()->can('essentials.view_allowance_and_deduction') || auth()->user()->can('essentials.add_allowance_and_deduction')): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#pay_component_tab" data-bs-toggle="tab" aria-expanded="true">
                                    <i class="fab fa-gg-circle" aria-hidden="true"></i>
                                    <?php echo app('translator')->get( 'essentials::lang.pay_components' ); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.view_all_payroll')): ?>
                            <div class="tab-pane fade show active" id="payroll_group_tab">
                            <div class="row">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.create_payroll')): ?>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#payroll_modal">
                                        <i class="fa fa-plus"></i>
                                        <?php echo app('translator')->get( 'messages.add' ); ?>
                                    </button>
                                </div>
                                <br><br><br>
                                <?php endif; ?>
                                <div class="col-md-12">
                                    <div class="table-responsive" style="min-height: 80vh">
                                        <table class="table table-bordered table-striped table-hover table-th-skin" id="payroll_group_table" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th><?php echo app('translator')->get('essentials::lang.name'); ?></th>
                                                    <th><?php echo app('translator')->get( 'essentials::lang.employee' ); ?></th>
                                                    <th><?php echo app('translator')->get('sale.status'); ?></th>
                                                    <th><?php echo app('translator')->get( 'sale.payment_status' ); ?></th>
                                                    <th><?php echo app('translator')->get('essentials::lang.total_gross_amount'); ?></th>
                                                    <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                                                    <th><?php echo app('translator')->get('business.location'); ?></th>
                                                    <th><?php echo app('translator')->get('lang_v1.created_at'); ?></th>
                                                    <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="tab-pane" id="payroll_tab">
                        <div class="row">
                            <div class="col-md-12">
                                <?php $__env->startComponent('components.filters', ['title' => __('report.filters'), 'class' => 'box-solid', 'closed' => true]); ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.view_all_payroll')): ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php echo Form::label('user_id_filter', __('essentials::lang.employee') . ':'); ?>

                                                <?php echo Form::select('user_id_filter', $employees, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php echo Form::label('location_id_filter',  __('purchase.business_location') . ':'); ?>


                                                <?php echo Form::select('location_id_filter', $locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all') ]); ?>

                                            </div>
                                        </div>
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
                                    <?php endif; ?>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <?php echo Form::label('month_year_filter', __( 'essentials::lang.month_year' ) . ':'); ?>

                                            <div class="input-group">
                                                <?php echo Form::text('month_year_filter', null, ['class' => 'form-control', 'placeholder' => __( 'essentials::lang.month_year' ) ]); ?>

                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php echo $__env->renderComponent(); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive" style="min-height: 80vh">
                                    <table class="table table-bordered table-striped table-hover table-th-skin" id="payrolls_table" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th><?php echo app('translator')->get( 'essentials::lang.employee' ); ?></th>
                                                <th><?php echo app('translator')->get( 'essentials::lang.department' ); ?></th>
                                                <th><?php echo app('translator')->get( 'essentials::lang.sub_department' ); ?></th>
                                                <th><?php echo app('translator')->get( 'essentials::lang.designation' ); ?></th>
                                                <th><?php echo app('translator')->get( 'essentials::lang.month_year' ); ?></th>
                                                <th><?php echo app('translator')->get( 'purchase.ref_no' ); ?></th>
                                                <th><?php echo app('translator')->get( 'sale.total_amount' ); ?></th>
                                                <th><?php echo app('translator')->get( 'sale.payment_status' ); ?></th>
                                                <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="monthly_payroll_tab">
                        <div class="row">
                            <div class="col-md-12">
                                
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.view_all_payroll')): ?>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php echo Form::label('mp_employee_id', __('essentials::lang.employee') . ':'); ?>

                                                <?php echo Form::select('mp_employee_id', $employees, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php echo Form::label('mp_department_id', __('essentials::lang.department') . ':'); ?>

                                                <?php echo Form::select('mp_department_id', $departments, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php echo Form::label('mp_sub_department_id', __('essentials::lang.sub_department') . ':'); ?>

                                                <?php echo Form::select('mp_sub_department_id', [], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php echo Form::label('mp_designation_id', __('essentials::lang.designation') . ':'); ?>

                                                <?php echo Form::select('mp_designation_id', $designations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php echo Form::label('mp_month_year', __( 'essentials::lang.month_year' ) . ':'); ?>

                                                <div class="input-group">
                                                    <?php echo Form::text('mp_month_year', null, ['class' => 'form-control', 'placeholder' => __( 'essentials::lang.month_year' ) ]); ?>

                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php echo Form::label('mp_payroll_group_id', __('essentials::lang.payroll_group') . ':'); ?>

                                                <?php echo Form::select('mp_payroll_group_id', $mp_payroll_groups, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <br>
                                                <button type="button" class="btn btn-primary" id="mp_report_btn">Generate</button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    
                                
                            </div>
                        </div>
                        <div id="monthly_payroll_report"></div>
                    </div>
                    <div class="tab-pane" id="pay_advance_tab">
                        <div class="row">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.add_allowance_and_deduction')): ?>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary btn-modal pull-right" data-href="<?php echo e(action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'getAddAdvancePayment']), false); ?>" data-container="#add_advance_payment_modal">
                                            <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?>
                                    </button>
                                </div><br><br><br>
                            <?php endif; ?>
                            <div class="col-md-12">
                                <div class="table-responsive" style="min-height: 80vh">
                                    <table class="table table-bordered table-striped table-hover table-th-skin" id="advance_payments_table" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th><?php echo app('translator')->get( 'messages.date' ); ?></th>
                                                <th><?php echo app('translator')->get( 'purchase.ref_no_short' ); ?></th>
                                                <th><?php echo app('translator')->get( 'lang_v1.type' ); ?></th>
                                                <th><?php echo app('translator')->get( 'essentials::lang.employee' ); ?></th>
                                                <th><?php echo app('translator')->get( 'sale.amount' ); ?></th>
                                                <th><?php echo app('translator')->get( 'lang_v1.status' ); ?></th>
                                                <th><?php echo app('translator')->get( 'essentials::lang.installments' ); ?></th>
                                                <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(auth()->user()->can('essentials.view_allowance_and_deduction') || auth()->user()->can('essentials.add_allowance_and_deduction')): ?>
                        <div class="tab-pane fade" id="pay_component_tab">
                            <div class="row">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.add_allowance_and_deduction')): ?>
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary btn-modal float-end" data-href="<?php echo e(action([\Modules\Essentials\Http\Controllers\EssentialsAllowanceAndDeductionController::class, 'create']), false); ?>" data-container="#add_allowance_deduction_modal">
                                                <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?>
                                        </button>
                                    </div><br><br><br>
                                <?php endif; ?>
                                <div class="col-md-12">
                                    <div class="table-responsive" style="min-height: 80vh">
                                        <table class="table table-bordered table-striped table-hover table-th-skin" id="ad_pc_table" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th><?php echo app('translator')->get( 'lang_v1.description' ); ?></th>
                                                    <th><?php echo app('translator')->get( 'lang_v1.type' ); ?></th>
                                                    <th><?php echo app('translator')->get( 'sale.amount' ); ?></th>
                                                    <th><?php echo app('translator')->get( 'essentials::lang.applicable_date' ); ?></th>
                                                    <th><?php echo app('translator')->get( 'essentials::lang.employee' ); ?></th>
                                                    <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="user_leave_summary"></div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="modal fade" id="add_allowance_deduction_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
    <div class="modal fade" id="add_advance_payment_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</section>
<!-- /.content -->
<!-- /.content -->


<?php $__env->stopSection(); ?>

<?php $__env->startSection('modals'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.create_payroll')): ?>
        <?php if ($__env->exists('essentials::payroll.payroll_modal')) echo $__env->make('essentials::payroll.payroll_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready( function(){
            payrolls_table = $('#payrolls_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "<?php echo e(action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'index']), false); ?>",
                    data: function (d) {
                        if ($('#user_id_filter').length) {
                            d.user_id = $('#user_id_filter').val();
                        }
                        if ($('#location_id_filter').length) {
                            d.location_id = $('#location_id_filter').val();
                        }
                        d.month_year = $('#month_year_filter').val();
                        if ($('#department_id').length) {
                            d.department_id = $('#department_id').val();
                        }
                        if ($('#sub_department_id').length) {
                            d.sub_department_id = $('#sub_department_id').val();
                        }
                        if ($('#designation_id').length) {
                            d.designation_id = $('#designation_id').val();
                        }
                    },
                },
                columnDefs: [
                    {
                        targets: 7,
                        orderable: false,
                        searchable: false,
                    },
                ],
                aaSorting: [[4, 'desc']],
                columns: [
                    { data: 'user', name: 'user' },
                    { data: 'department', name: 'dept.name' },
                    { data: 'sub_department', name: 'sub_dept.name' },
                    { data: 'designation', name: 'dsgn.name' },
                    { data: 'transaction_date', name: 'transaction_date'},
                    { data: 'ref_no', name: 'ref_no'},
                    { data: 'final_total', name: 'final_total'},
                    { data: 'payment_status', name: 'payment_status'},
                    { data: 'action', name: 'action' },
                ],
                fnDrawCallback: function(oSettings) {
                    __currency_convert_recursively($('#payrolls_table'));
                },
            });

            $(document).on('change', '#user_id_filter, #month_year_filter, #department_id, #sub_department_id, #designation_id, #location_id_filter', function() {
                payrolls_table.ajax.reload();
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

            $(document).on('change', '#mp_department_id', function(){
                if($(this).val() !== '') {
                    $.ajax({
                        url: '/get-sub-taxonomies?type=hrm_department&parent_category=' + $(this).val(),
                        dataType: 'json',
                        success: function(result) {
                            $('#mp_sub_department_id').select2('destroy')
                                .empty()
                                .select2({
                                    data: result.sub_categories,
                                });
                                $('#mp_sub_department_id').change();
                        },
                    });
                }else{
                    $('#mp_sub_department_id').select2('destroy')
                                .empty()
                                .select2({
                                    data: [{id: null, text: "All"}],
                                });
                                $('#mp_sub_department_id').change();
                }
            });

            if ($('#add_payroll_step1').length) {
                $('#add_payroll_step1').validate();
                $('#primary_work_location').select2({
                    dropdownParent: $('#payroll_modal')
                });
                $('#employee_id').select2({
                    dropdownParent: $('#payroll_modal')
                });
                $('#department').select2({
                    dropdownParent: $('#payroll_modal')
                });
                $('#sub_department').select2({
                    dropdownParent: $('#payroll_modal')
                });
                $('#designation').select2({
                    dropdownParent: $('#payroll_modal')
                });
                $('#employee_ids').select2({
                    dropdownParent: $('#payroll_modal')
                });
            }

            $('div.view_modal').on('shown.bs.modal', function(e) {
                __currency_convert_recursively($('.view_modal'));
            });

            $('#month_year_filter, #mp_month_year').datepicker({
                autoclose: true,
                format: 'mm/yyyy',
                minViewMode: "months"
            });

            $('#month_year').datepicker({
                autoclose: true,
                format: 'mm/yyyy',
                minViewMode: "months",
                container: '#payroll_modal'
            });
            
            $(document).on('change', '#department', function () {
                let department_id = $(this).val();
                let sub_department_id = $('#sub_department').val();
                let designation_id = $('#designation').val();
                let location_id = $('#primary_work_location').val();
                $.ajax({
                    method: 'GET',
                    url: "<?php echo e(action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'getEmployeesBasedOnDepartment']), false); ?>",
                    dataType: 'json',
                    data: {
                        'department_id' : department_id,
                        'sub_department_id' : sub_department_id,
                        'designation_id' : designation_id,
                        'location_id' : location_id,
                    },
                    success: function(result) {
                        if (result.success == true) {
                            $('select#employee_ids').html('');
                            $('select#employee_ids').html(result.employees_html);
                            if(department_id){
                                $('.select-all').click();
                            }
                        }
                    }
                });

                if(department_id != '') {
                    $.ajax({
                        url: '/get-sub-taxonomies?type=hrm_department&parent_category=' + $(this).val(),
                        dataType: 'json',
                        success: function(result) {
                            $('#sub_department').select2('destroy')
                                .empty()
                                .select2({
                                    data: result.sub_categories,
                                    dropdownParent: $('#payroll_modal')
                                });
                                $('#sub_department').change();
                        },
                    });
                }else{
                    $('#sub_department').select2('destroy')
                                .empty()
                                .select2({
                                    data: [{id: null, text: "Please Select"}],
                                    dropdownParent: $('#payroll_modal')
                                });
                                $('#sub_department').change();
                }
            });

            $(document).on('change', '#sub_department', function () {
                let sub_department_id = $(this).val();
                let department_id = $('#department').val();
                let designation_id = $('#designation').val();
                let location_id = $('#primary_work_location').val();
                if(sub_department_id != ''){
                    $.ajax({
                        method: 'GET',
                        url: "<?php echo e(action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'getEmployeesBasedOnDepartment']), false); ?>",
                        dataType: 'json',
                        data: {
                            'department_id' : department_id,
                            'sub_department_id' : sub_department_id,
                            'designation_id' : designation_id,
                            'location_id' : location_id,
                        },
                        success: function(result) {
                            if (result.success == true) {
                                $('select#employee_ids').html('');
                                $('select#employee_ids').html(result.employees_html);
                                if(sub_department_id){
                                    $('.select-all').click();
                                }
                            }
                        }
                    });
                }
            });

            $(document).on('change', '#designation', function () {
                let designation_id = $(this).val();
                let department_id = $('#department').val();
                let sub_department_id = $('#sub_department').val();
                let location_id = $('#primary_work_location').val();
                $.ajax({
                    method: 'GET',
                    url: "<?php echo e(action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'getEmployeesBasedOnDepartment']), false); ?>",
                    dataType: 'json',
                    data: {
                        'department_id' : department_id,
                        'sub_department_id' : sub_department_id,
                        'designation_id' : designation_id,
                        'location_id' : location_id,
                    },
                    success: function(result) {
                        if (result.success == true) {
                            $('select#employee_ids').html('');
                            $('select#employee_ids').html(result.employees_html);
                            if(designation){
                                $('.select-all').click();
                            }
                        }
                    }
                });
            });

            $('div.payment_modal').on('hidden.bs.modal', function(e) {
                payroll_group_table.ajax.reload();
            });

            //pay components
            <?php if(auth()->user()->can('essentials.view_allowance_and_deduction') || auth()->user()->can('essentials.add_allowance_and_deduction')): ?>
                $('#add_allowance_deduction_modal').on('shown.bs.modal', function(e) {
                    var $p = $(this);
                    $('#add_allowance_deduction_modal .select2').select2({dropdownParent:$p});
                    $('#add_allowance_deduction_modal #applicable_date').datepicker();
                    
                });

                $(document).on('submit', 'form#add_allowance_form', function(e) {
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
                                $('div#add_allowance_deduction_modal').modal('hide');
                                toastr.success(result.msg);
                                ad_pc_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                });
                
                ad_pc_table = $('#ad_pc_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "<?php echo e(action([\Modules\Essentials\Http\Controllers\EssentialsAllowanceAndDeductionController::class, 'index']), false); ?>",
                    columns: [
                        { data: 'description', name: 'description' },
                        { data: 'type', name: 'type' },
                        { data: 'amount', name: 'amount' },
                        { data: 'applicable_date', name: 'applicable_date' },
                        { data: 'employees', searchable: false, orderable: false },
                        { data: 'action', name: 'action' }
                    ],
                    fnDrawCallback: function(oSettings) {
                        __currency_convert_recursively($('#ad_pc_table'));
                    },
                });

                $(document).on('click', '.delete-allowance', function(e) {
                    e.preventDefault();
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
                                        ad_pc_table.ajax.reload();
                                    } else {
                                        toastr.error(result.msg);
                                    }
                                },
                            });
                        }
                    });
                });
            <?php endif; ?>
            //payroll groups
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.view_all_payroll')): ?>
                payroll_group_table = $('#payroll_group_table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "<?php echo e(action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'payrollGroupDatatable']), false); ?>",
                        aaSorting: [[6, 'desc']],
                        columns: [
                            { data: 'name', name: 'essentials_payroll_groups.name' },
                            { data: 'expense_for', name: 'expense_for' },
                            { data: 'status', name: 'essentials_payroll_groups.status' },
                            { data: 'payment_status', name: 'essentials_payroll_groups.payment_status' },
                            { data: 'gross_total', name: 'essentials_payroll_groups.gross_total' },
                            { data: 'added_by', name: 'added_by' },
                            { data: 'location_name', name: 'BL.name' },
                            { data: 'created_at', name: 'essentials_payroll_groups.created_at', searchable: false},
                            { data: 'action', name: 'action', searchable: false, orderable: false}
                        ]
                    });
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.delete_payroll')): ?>
                $(document).on('click', '.delete-payroll', function(e) {
                    e.preventDefault();
                    swal({
                        title: LANG.sure,
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    }).then(willDelete => {
                        if (willDelete) {
                            var href = $(this).attr('href');
                            var data = $(this).serialize();

                            $.ajax({
                                method: 'DELETE',
                                url: href,
                                dataType: 'json',
                                data: data,
                                success: function(result) {
                                    if (result.success == true) {
                                        toastr.success(result.msg);
                                        payroll_group_table.ajax.reload();
                                    } else {
                                        toastr.error(result.msg);
                                    }
                                },
                            });
                        }
                    });
                });
            <?php endif; ?>

            $(document).on('change', '#primary_work_location', function () {
                let location_id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "<?php echo e(action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'getEmployeesBasedOnLocation']), false); ?>",
                    dataType: 'json',
                    data: {
                        'location_id' : location_id
                    },
                    success: function(result) {
                        if (result.success == true) {
                            $('select#employee_ids').html('');
                            $('select#employee_ids').html(result.employees_html);
                        }
                    }
                });
            });

            // Re-initialize Bootstrap 5 dropdowns after DataTable redraws
            $('#payrolls_table').on('draw.dt', function() {
                $(this).find('[data-bs-toggle="dropdown"]').each(function() {
                    new bootstrap.Dropdown(this);
                });
            });

            $('#payroll_group_table').on('draw.dt', function() {
                $(this).find('[data-bs-toggle="dropdown"]').each(function() {
                    new bootstrap.Dropdown(this);
                });
            });

            // Fix dropdown clipped by table-responsive overflow
            $(document).on('show.bs.dropdown', '#payroll_group_table .btn-group, #payrolls_table .btn-group', function () {
                $(this).closest('.table-responsive').css('overflow', 'visible');
            });
            $(document).on('hide.bs.dropdown', '#payroll_group_table .btn-group, #payrolls_table .btn-group', function () {
                $(this).closest('.table-responsive').css('overflow', 'auto');
            });

            $(document).on('click', 'button#mp_report_btn', function() {
                var loader = __fa_awesome();
                $('#monthly_payroll_report').html(`
                    <div class="container text-center" style="justify-content: space-around;display: flex;">
                        <div style="padding: 15px;margin: 25px;font-size: 1.4em;background-color: #d0f5be;width: 40%;">Processing Report ${loader}</div>
                    </div>
                `);
                $.ajax({
                    url: "<?php echo e(action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'monthlyPayroll']), false); ?>",
                    data: {
                        employee_id : $('#mp_employee_id').val(),
                        department_id : $('#mp_department_id').val(),
                        sub_department_id : $('#mp_sub_department_id').val(),
                        designation_id : $('#mp_designation_id').val(),
                        payroll_group_id : $('#mp_payroll_group_id').val(),
                        month_year : $('#mp_month_year').val(),
                    },
                    method: 'GET',
                    dataType: 'html',
                    success: function(html) {
                        $('#monthly_payroll_report').html(html);
                    },
                    error: function(){
                        loading.toggleClass('hide');
                        toastr.error('Report Not Generated - Some Error');
                    },
                });
            });

            $(document).on('click', '.toggle-tr', function(){
                let payroll_tr_class = $(this).data('payroll-tr-class');
                // $(this).closest('tr.'+atten-tr-class).toggleClass('collapse-tr');
                $('.' + payroll_tr_class).toggleClass('collapse-tr');
                $(this).find('.collapse-icon').toggleClass('collapsed');
                var html = $(this).find('.collapse-icon').hasClass('collapsed') ? 
                '<i class="fas fa-arrow-circle-right"></i>' : '<i class="fas fa-arrow-circle-down"></i>';
                $(this).find('.collapse-icon').html(html);
            });

            $(document).on('click', '#print_monthly_payroll_report', function(){
                // $('#monthly_payroll_report .filters').toggleClass('hide');
                // setTimeout(() => {
                //     $('#monthly_payroll_report .filters').toggleClass('hide');
                // }, 2000);
                // $('#monthly_payroll_report').printThis();
                const url = "<?php echo e(action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'monthlyPayroll']), false); ?>?" +
                    $.param({
                        employee_id: $('#mp_employee_id').val(),
                        department_id: $('#mp_department_id').val(),
                        sub_department_id: $('#mp_sub_department_id').val(),
                        designation_id: $('#mp_designation_id').val(),
                        month_year: $('#mp_month_year').val(),
                        action: 'print'
                    });

                window.open(url, '_blank');
            });


            $('#add_advance_payment_modal').on('shown.bs.modal', function(e) {
                var $p = $(this);
                $('#add_advance_payment_modal .select2').select2({dropdownParent:$p});
                $('#add_advance_payment_modal #paid_on').datetimepicker({
                    format: moment_date_format + ' ' + moment_time_format,
                    ignoreReadonly: true,
                });
                
                $(document).on('change', '#add_advance_payment_modal #advance_pay_type', function () {
                    let type = $(this).val();
                    if(type == 'loan_payment'){
                        $('.loan_fields').removeClass('hide');
                    }else{
                        $('.loan_fields').addClass('hide');
                    }
                });
                
            });

            // Reload employee list when location changes in advance payment modal
            $(document).on('change', '#add_advance_payment_modal #location_id', function () {
                let location_id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "<?php echo e(action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'getEmployeesBasedOnLocation']), false); ?>",
                    dataType: 'json',
                    data: { 'location_id': location_id },
                    success: function(result) {
                        if (result.success == true) {
                            var $emp = $('#add_advance_payment_modal #employee_id');
                            $emp.html('<option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>' + result.employees_html);
                            $emp.trigger('change.select2');
                        }
                    }
                });
            });

            advance_payments_table = $('#advance_payments_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "<?php echo e(action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'indexAdvancePayments']), false); ?>",
                columns: [
                    { data: 'transaction_date', name: 'transaction_date' },
                    { data: 'ref_no', name: 'ref_no' },
                    { data: 'sub_type', name: 'sub_type' },
                    { data: 'employee', name: 'expense_for'},
                    { data: 'final_total', name: 'final_total' },
                    { data: 'payment_status', name: 'payment_status' },
                    { data: 'installments'},
                    { data: 'action', name: 'action' }
                ],
                fnDrawCallback: function(oSettings) {
                    __currency_convert_recursively($('#advance_payments_table'));
                },
            });

            $(document).on('click', '.delete_advance_payment', function(e) {
                e.preventDefault();
                swal({
                    title: LANG.sure,
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then(willDelete => {
                    if (willDelete) {
                        console.log(href);
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
                                    advance_payments_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                        });
                    }
                });
            });

            $(document).on('submit', 'form#add_advance_payment_form', function(e) {
                e.preventDefault();
                var form = $(this);
                __disable_submit_button(form.find('button[type="submit"]'));

                var data = form.serialize();
                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'),
                    dataType: 'json',
                    data: data,
                    beforeSend: function(xhr) {
                        __disable_submit_button(form.find('button[type="submit"]'));
                    },
                    success: function(result) {
                        if (result.success == true) {
                            $('div#add_advance_payment_modal').modal('hide');
                            toastr.success(result.msg);
                            advance_payments_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                    error: function(e){
                        __enable_submit_button(form.find('button[type="submit"]'));
                    },
                });
            });

            
        });
        
    </script>
    <script src="<?php echo e(asset('js/payment.js?v=' . $asset_v), false); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>