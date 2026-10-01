
<?php $__env->startSection('title', __('project::lang.view_project')); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('project::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header">
    <div class="project-onedash-title">
        <div>
            <h1 class="project-title">
                <i class="fas fa-project-diagram"></i>
                <?php echo e(ucFirst($project->name), false); ?>

            </h1>
            <div class="project-meta-row">
                <span class="status-badge status-<?php echo e($project->status, false); ?>"><span class="status-dot"></span>
                    <?php echo app('translator')->get('project::lang.'.$project->status); ?>
                </span>
                <?php if(isset($project->customer->name)): ?>
                    <span class="divider">|</span>
                    <span class="text-muted"><i class="fa fa-briefcase"></i> <?php echo e($project->customer->name, false); ?></span>
                <?php endif; ?>
                <?php if(isset($project->location->name)): ?>
                    <span class="divider">|</span>
                    <span class="text-muted"><i class="fas fa-map-marker-alt"></i> <?php echo e($project->location->name, false); ?></span>
                <?php endif; ?>
                <span class="divider">|</span>
                <span class="text-muted"><i class="fas fa-user-tie"></i> <?php echo e($project->lead->user_full_name, false); ?></span>
            </div>
        </div>
        <div>
            <?php if(!empty($can_edit_project)): ?>
                <button data-href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'edit'], [$project->id]), false); ?>" class="btn btn-sm btn-primary edit_a_project">
                    <i class="fa fa-edit"></i> <?php echo app('translator')->get('messages.edit'); ?>
                </button>
            <?php endif; ?>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
           <!-- Custom Tabs -->
           <!-- project_id to be used in datatable -->
               <input type="hidden" name="project_id" id="project_id" value="<?php echo e($project->id, false); ?>">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="
                        <?php if($tab_view == 'overview'): ?>
                            active
                        <?php else: ?>
                            ''
                        <?php endif; ?>">
                        <a href="#project_overview" data-toggle="tab" aria-expanded="true" data-url="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'show'], [$project->id]).'?view=overview', false); ?>">
                            <i class="fas fa-tachometer-alt"></i>
                            <?php echo app('translator')->get('project::lang.overview'); ?>
                        </a>
                    </li>

                    <li class="
                        <?php if($tab_view == 'project_location'): ?>
                            active
                        <?php else: ?>
                            ''
                        <?php endif; ?>">
                        <a href="#project_location" data-toggle="tab" aria-expanded="true">
                            <i class="fas fa-map-marker-alt"></i>
                            <?php echo app('translator')->get('project::lang.location'); ?>
                        </a>
                    </li>

                    <?php if($can_view_activity): ?>
                        <li class="
                            <?php if($tab_view == 'activities'): ?>
                                active
                            <?php else: ?>
                                ''
                            <?php endif; ?>">
                            <a href="#activities" data-toggle="tab" aria-expanded="true">
                                <i class="fas fa-chart-line"></i>
                                <?php echo app('translator')->get('lang_v1.activities'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if($can_view_task): ?>
                        <li class="
                            <?php if($tab_view == 'project_task'): ?>
                                active
                            <?php else: ?>
                                ''
                            <?php endif; ?>">
                            <a href="#project_task" data-toggle="tab" aria-expanded="true">
                                <i class="fa fa-tasks"></i>
                                <?php echo app('translator')->get('project::lang.task'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if($can_view_timelog): ?>
                        <li class="
                            <?php if($tab_view == 'time_log'): ?>
                                active
                            <?php else: ?>
                                ''
                            <?php endif; ?>">
                            <a href="#time_log" data-toggle="tab" aria-expanded="true">
                                <i class="fas fa-clock"></i>
                                <?php echo app('translator')->get('project::lang.time_logs'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if($can_view_docus_note): ?>
                        <li class="
                            <?php if($tab_view == 'documents_and_notes'): ?>
                                active
                            <?php else: ?>
                                ''
                            <?php endif; ?>">
                            <a href="#documents_and_notes" data-toggle="tab" aria-expanded="true">
                                <i class="fas fa-file-image"></i>
                                <?php echo app('translator')->get('project::lang.documents_and_notes'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    
                    <?php if(false && $can_view_invoice && $is_lead_or_admin): ?>
                    <li class="
                        <?php if($tab_view == 'project_invoices'): ?>
                            active
                        <?php else: ?>
                            ''
                        <?php endif; ?>">
                        <a href="#project_invoices" data-toggle="tab" aria-expanded="true">
                            <i class="fa fa-file"></i>
                            <?php echo app('translator')->get('project::lang.invoices'); ?>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if($can_view_stock): ?>
                    <li class="<?php if($tab_view == 'project_stock'): ?> active <?php endif; ?>" id="project_stock_tab">
                        <a href="#project_stock" class="project-stock-tab-toggle" aria-expanded="true">
                            <i class="fa fa-boxes"></i>
                            <?php echo app('translator')->get('project::lang.stock'); ?>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if($can_view_project_expenses): ?>
                    <li class="<?php if($tab_view == 'project_expenses'): ?> active <?php endif; ?>" id="project_expenses_tab">
                        <a href="#project_expenses" data-toggle="tab" aria-expanded="true">
                            <i class="fas fa-receipt"></i>
                            <?php echo app('translator')->get('expense.expenses'); ?>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if($can_manage_settings): ?>
                    <li class="
                        <?php if($tab_view == 'project_settings'): ?>
                            active
                        <?php else: ?>
                            ''
                        <?php endif; ?>">
                        <a href="#project_settings" data-toggle="tab" aria-expanded="true">
                            <i class="fa fa-cogs"></i>
                            <?php echo app('translator')->get('role.settings'); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane
                        <?php if($tab_view == 'overview'): ?>
                            active
                        <?php else: ?>
                            ''
                        <?php endif; ?>" id="project_overview">
                        <?php if ($__env->exists('project::project.partials.overview')) echo $__env->make('project::project.partials.overview', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <div class="tab-pane
                        <?php if($tab_view == 'project_location'): ?>
                            active
                        <?php else: ?>
                            ''
                        <?php endif; ?>" id="project_location">
                        <?php if ($__env->exists('project::project.partials.location')) echo $__env->make('project::project.partials.location', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <?php if($can_view_activity): ?>
                        <div class="tab-pane
                            <?php if($tab_view == 'activities'): ?>
                                active
                            <?php else: ?>
                                ''
                            <?php endif; ?>" id="activities">
                            <ul class="timeline">
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if($can_view_task): ?>
                        <div class="tab-pane
                            <?php if($tab_view == 'project_task'): ?>
                                active
                            <?php else: ?>
                                ''
                            <?php endif; ?>" id="project_task">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php echo Form::label('assigned_to_filter', __('project::lang.assigned_to') . ':'); ?>

                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <?php echo Form::select('assigned_to_filter', $project_members, null, ['class' => 'form-control select2', 'placeholder' => __('messages.all'), 'style' => 'width: 100%;']); ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 status_filter
                                    <?php if(isset($project->settings['task_view']) &&
                                    $project->settings['task_view'] == 'kanban'): ?>
                                        hide
                                    <?php endif; ?>">
                                    <div class="form-group">
                                        <?php echo Form::label('status_filter', __('sale.status') . ':'); ?>

                                        <?php echo Form::select('status_filter', $statuses, null, ['class' => 'form-control select2', 'placeholder' => __('messages.all'), 'style' => 'width: 100%;']); ?>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php echo Form::label('priority_filter', __('project::lang.priority') .':'); ?>

                                        <?php echo Form::select('priority_filter', $priorities, null, ['class' => 'form-control select2', 'placeholder' => __('messages.all'), 'style' => 'width: 100%;']); ?>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php echo Form::label('due_date_filter', __('project::lang.due_date') . ':'); ?>

                                        <?php echo Form::select('due_date_filter', $due_dates, null, ['class' => 'form-control select2', 'placeholder' => __('messages.all'), 'style' => 'width: 100%;']); ?>

                                    </div>
                                </div>
                            </div>
                            <?php if ($__env->exists('project::task.index')) echo $__env->make('project::task.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endif; ?>

                    <?php if($can_view_timelog): ?>
                        <div class="tab-pane
                            <?php if($tab_view == 'time_log'): ?>
                                active
                            <?php else: ?>
                                ''
                            <?php endif; ?>" id="time_log">
                            <?php if ($__env->exists('project::time_logs.index')) echo $__env->make('project::time_logs.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endif; ?>

                    <?php if($can_view_docus_note): ?>
                        <!-- model id like project_id, user_id -->
                        <input type="hidden" name="notable_id" id="notable_id" value="<?php echo e($project->id, false); ?>">
                        <!-- model name like App\User -->
                        <input type="hidden" name="notable_type" id="notable_type" value="Modules\Project\Entities\Project">
                        <div class="tab-pane document_note_body
                            <?php if($tab_view == 'documents_and_notes'): ?>
                                active
                            <?php else: ?>
                                ''
                            <?php endif; ?>" id="documents_and_notes">
                        </div>
                    <?php endif; ?>

                    
                    <?php if(false && $can_view_invoice && $is_lead_or_admin): ?>
                        <div class="tab-pane
                            <?php if($tab_view == 'project_invoices'): ?>
                                active
                            <?php else: ?>
                                ''
                            <?php endif; ?>" id="project_invoices">
                            <?php if ($__env->exists('project::invoice.index')) echo $__env->make('project::invoice.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endif; ?>
                    <?php if($can_manage_settings): ?>
                        <div class="tab-pane
                            <?php if($tab_view == 'project_settings'): ?>
                                active
                            <?php else: ?>
                                ''
                            <?php endif; ?>" id="project_settings">
                            <?php if ($__env->exists('project::settings.create')) echo $__env->make('project::settings.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endif; ?>

                    <?php if($can_view_stock): ?>
                        <div class="tab-pane <?php if($tab_view == 'project_stock'): ?> active <?php endif; ?>" id="project_stock">
                            <div class="project_stock_body">
                                <p class="text-center"><i class="fa fa-spinner fa-spin"></i> <?php echo app('translator')->get('messages.loading'); ?>...</p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($can_view_project_expenses): ?>
                        <div class="tab-pane <?php if($tab_view == 'project_expenses'): ?> active <?php endif; ?>" id="project_expenses">
                            <?php if ($__env->exists('project::project.partials.expenses')) echo $__env->make('project::project.partials.expenses', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="project_model"></div>
    <div class="modal fade project_task_model" tabindex="-1" role="dialog"></div>
    <div class="modal fade" tabindex="-1" role="dialog" id="time_log_model"></div>
    <div class="modal fade view_project_task_model" tabindex="-1" role="dialog"></div>
    <div class="modal fade payment_modal" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel"></div>
    <div class="modal fade edit_payment_modal" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel"></div>
    <div class="modal fade" id="expense_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
    <?php if($can_view_project_expenses): ?>
        <?php echo $__env->make('expense.partials.update_expense_status_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('modules/project/js/project.js?v=' . $asset_v . '.' . filemtime(public_path('modules/project/js/project.js'))), false); ?>"></script>
<script src="<?php echo e(asset('js/payment.js?v=' . $asset_v), false); ?>"></script>
<script type="text/javascript">
    var tab_view = '<?php echo $tab_view; ?>';

    if (tab_view == 'activities') {
        initializeActivities();
    } else if (tab_view == 'project_task') {
        initializeProjectTaskDatatable();
    } else if (tab_view == 'time_log') {
        initializeTimeLogDatatable();
    } else if (tab_view == 'documents_and_notes') {
        initializeNotesDataTable();
    } else if (tab_view == 'project_invoices') {
        initializeInvoiceDatatable();
    } else if (tab_view == 'project_expenses') {
        initializeProjectExpenseDatatable();
    }

    var project_expense_datatable;

    function getProjectExpenseBasePath() {
        return typeof base_path !== 'undefined' ? base_path : '';
    }

    function updateProjectExpenseAddLink() {
        var addButton = $('#project_add_expense_btn');
        if (!addButton.length) {
            return;
        }

        var href = addButton.data('base-href');
        var stepId = $('#project_expense_step_filter').val();

        if (stepId) {
            href += '&pjt_project_step_id=' + encodeURIComponent(stepId);
        }

        addButton.attr('href', href).data('href', href);
    }

    function initializeProjectExpenseDatatable() {
        if (!$('#project_expense_table').length) {
            return;
        }

        updateProjectExpenseAddLink();

        if ($.fn.select2 && $('#project_expense_step_filter').length && !$('#project_expense_step_filter').hasClass('select2-hidden-accessible')) {
            $('#project_expense_step_filter').select2({ width: '100%' });
        }

        if (typeof project_expense_datatable !== 'undefined') {
            project_expense_datatable.columns.adjust();
            return;
        }

        project_expense_datatable = $('#project_expense_table').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            scrollCollapse: true,
            aaSorting: [[1, 'desc']],
            ajax: {
                url: getProjectExpenseBasePath() + '/expenses',
                data: function (d) {
                    d.pjt_project_id = $('#project_id').val();
                    d.pjt_project_step_id = $('#project_expense_step_filter').val();
                    d.project_expenses_list = 1;
                    d.expenses_list = 1;
                },
            },
            columns: [
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'transaction_date', name: 'transaction_date' },
                { data: 'ref_no', name: 'ref_no' },
                { data: 'project_step_name', name: 'pjs.name', defaultContent: '' },
                { data: 'category', name: 'ec.name' },
                { data: 'status', name: 'transactions.status' },
                { data: 'payment_status', name: 'payment_status', orderable: false },
                { data: 'final_total', name: 'final_total', className: 'text-right' },
                { data: 'payment_due', name: 'payment_due', className: 'text-right' },
                { data: 'added_by', name: 'usr.first_name' },
            ],
            fnDrawCallback: function () {
                __currency_convert_recursively($('#project_expense_table'));
                project_expense_datatable.columns.adjust();
            },
            footerCallback: function (row, data) {
                var footer_expense_total = 0;
                var footer_total_due = 0;

                for (var r in data) {
                    footer_expense_total += $(data[r].final_total).data('orig-value')
                        ? parseFloat($(data[r].final_total).data('orig-value'))
                        : 0;
                    footer_total_due += $(data[r].payment_due).data('orig-value')
                        ? parseFloat($(data[r].payment_due).data('orig-value'))
                        : 0;
                }

                $('.project_footer_expense_total').html(__currency_trans_from_en(footer_expense_total, false));
                $('.project_footer_total_due').html(__currency_trans_from_en(footer_total_due, false));
                $('.project_footer_status_count').html(__count_status(data, 'status'));
                $('.project_footer_payment_status_count').html(__count_status(data, 'payment_status'));
            },
        });
    }

    $(document).on('change', '#project_expense_step_filter', function () {
        updateProjectExpenseAddLink();
        if (typeof project_expense_datatable !== 'undefined') {
            project_expense_datatable.ajax.reload();
        }
    });

    $(document).on('shown.bs.tab', 'a[href="#project_expenses"]', function () {
        initializeProjectExpenseDatatable();
        if (history.replaceState) {
            history.replaceState(null, '', '<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'show'], [$project->id]), false); ?>?view=project_expenses');
        }
    });

    function showProjectExpenseModal($modal) {
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            bootstrap.Modal.getOrCreateInstance($modal[0]).show();
        } else {
            $modal.modal('show');
        }
    }

    function hideProjectExpenseModal() {
        var modalElement = document.getElementById('expense_modal');

        if (typeof bootstrap !== 'undefined' && bootstrap.Modal && modalElement) {
            var modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) {
                modalInstance.hide();
                return;
            }
        }

        $('#expense_modal').modal('hide');
    }

    function toggleProjectExpenseModalPaymentSection() {
        var $modal = $('#expense_modal');
        var isDraft = $modal.find('#expense_modal_status').val() == 'draft';
        var $paymentSection = $modal.find('#expense_modal_payment_section');

        if (isDraft) {
            $paymentSection.addClass('hide');
            if ($modal.find('input.payment-amount').length) {
                __write_number($modal.find('input.payment-amount'), 0);
            }
        } else {
            $paymentSection.removeClass('hide');
        }

        if (typeof calculateExpensePaymentDue === 'function') {
            calculateExpensePaymentDue();
        }
    }

    function initializeProjectExpenseModalControls() {
        var $modal = $('#expense_modal');

        if ($.fn.datetimepicker) {
            $modal.find('#expense_transaction_date, .paid_on').datetimepicker({
                format: moment_date_format + ' ' + moment_time_format,
                ignoreReadonly: true,
            });
        }

        if ($.fn.select2) {
            $modal.find('.select2').each(function () {
                if ($(this).hasClass('select2-hidden-accessible')) {
                    $(this).select2('destroy');
                }
                $(this).select2({ dropdownParent: $modal, width: '100%' });
            });
        }

        if ($.fn.validate) {
            $modal.find('#add_expense_modal_form').validate();
        }

        toggleProjectExpenseModalPaymentSection();
        $modal.find('.payment_types_dropdown').trigger('change');
    }

    $(document).on('click', '#project_add_expense_btn', function (e) {
        e.preventDefault();

        var button = $(this);
        if (button.data('project_expense_loading')) {
            return;
        }

        var href = button.data('href') || button.attr('href');
        var $modal = $('#expense_modal');

        $.ajax({
            method: 'GET',
            url: href,
            dataType: 'html',
            beforeSend: function () {
                button.data('project_expense_loading', true).addClass('disabled');
            },
            success: function (result) {
                $modal.html(result);
                showProjectExpenseModal($modal);
            },
            error: function () {
                toastr.error(typeof LANG !== 'undefined' && LANG.something_went_wrong ? LANG.something_went_wrong : '<?php echo e(__("messages.something_went_wrong"), false); ?>');
            },
            complete: function () {
                button.removeData('project_expense_loading').removeClass('disabled');
            },
        });
    });

    $(document).on('shown.bs.modal', '#expense_modal', function () {
        initializeProjectExpenseModalControls();
    });

    $(document).on('hidden.bs.modal', '#expense_modal', function () {
        $(this).html('');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });

    $(document).on('change', '#expense_modal #expense_modal_status', function () {
        toggleProjectExpenseModalPaymentSection();
    });

    $(document).on('change', '#expense_modal select#expense_location_id', function () {
        var location = $(this).val();
        var dropdown = $('#expense_modal .payment_types_dropdown');

        if (! location || ! dropdown.length) {
            return;
        }

        $.ajax({
            method: 'GET',
            url: getProjectExpenseBasePath() + '/payments/pay-payment-types/' + location + '?hide_multipay=1',
            success: function (result) {
                dropdown.empty();
                $.each(result, function (key, value) {
                    dropdown.append($('<option></option>').attr('value', key).text(value));
                });
                dropdown.val(Object.keys(result)[0]).trigger('change');
            },
        });
    });

    $(document).on('click', '#expense_modal button#expense_modal_save', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        $('#expense_save_and_print').val($(this).data('save-and-print') == true ? 1 : 0);
        $('#expense_modal form#add_expense_modal_form').submit();
    });

    $(document).on('submit', '#expense_modal form#add_expense_modal_form', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        var form = $(this);
        if (form.data('project_expense_submitting')) {
            return false;
        }

        if (form.valid && !form.valid()) {
            return false;
        }

        if (form.find('#expense_modal_status').val() == 'draft') {
            if (form.find('input.payment-amount').length) {
                __write_number(form.find('input.payment-amount'), 0);
            }
        } else {
            var final_total = __read_number(form.find('input#expense_final_total'));
            var payment_amount = __read_number(form.find('input.payment-amount'));

            if (payment_amount == 0 && final_total > 0) {
                __write_number(form.find('input.payment-amount'), final_total);
            }
        }

        var formData = new FormData(this);

        $.ajax({
            method: 'POST',
            url: form.attr('action'),
            headers: {
                'Accept': 'application/json',
            },
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                form.data('project_expense_submitting', true);
                form.find('.modal-footer button, button[type="submit"]').prop('disabled', true);
            },
            success: function (result) {
                if (result.success == true) {
                    hideProjectExpenseModal();
                    toastr.success(result.msg);

                    if (result.html_content != null) {
                        if (! $('#receipt_section').length) {
                            $('body').append('<div id="receipt_section" class="hide"></div>');
                        }
                        $('#receipt_section').html(result.html_content);
                        __print_receipt('receipt_section');
                        setTimeout(function () {
                            $('#receipt_section').empty();
                        }, 1200);
                    }

                    if (typeof project_expense_datatable !== 'undefined') {
                        project_expense_datatable.ajax.reload(null, false);
                    }
                } else {
                    toastr.error(result.msg);
                }
            },
            error: function (xhr) {
                var message = typeof LANG !== 'undefined' && LANG.something_went_wrong ? LANG.something_went_wrong : '<?php echo e(__("messages.something_went_wrong"), false); ?>';

                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }

                toastr.error(message);
            },
            complete: function () {
                form.removeData('project_expense_submitting');
                form.find('.modal-footer button, button[type="submit"]').prop('disabled', false);
            },
        });

        return false;
    });

    function cleanProjectExpenseStatusModal() {
        $('#update_expense_status_modal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    }

    $(document).on('hidden.bs.modal', '#update_expense_status_modal', function () {
        if (!$('#project_expenses').hasClass('active')) {
            return;
        }

        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });

    $(document).on('click', '#project_expenses .update_expense_status', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        var statusLink = $(this);
        $('#update_expense_status_form')
            .attr('action', statusLink.data('href'))
            .data('status-link', statusLink);
        $('#update_expense_status_form').find('#expense_status').val(statusLink.data('status'));
        $('#update_expense_status_modal').modal('show');
    });

    $(document).on('click', '#update_expense_status_btn', function(e) {
        if (!$('#project_expenses').hasClass('active')) {
            return;
        }

        e.preventDefault();
        e.stopImmediatePropagation();

        var form = $('#update_expense_status_form');
        var submitButton = $('#update_expense_status_btn');

        $.ajax({
            method: 'POST',
            url: form.attr('action'),
            headers: {
                'Accept': 'application/json',
            },
            dataType: 'json',
            data: form.serialize(),
            beforeSend: function () {
                submitButton.prop('disabled', true);
            },
            success: function (result) {
                if (result.success == true) {
                    cleanProjectExpenseStatusModal();
                    toastr.success(result.msg);
                    if (typeof project_expense_datatable !== 'undefined') {
                        project_expense_datatable.ajax.reload(null, false);
                    }
                } else {
                    toastr.error(result.msg);
                }
            },
            error: function () {
                toastr.error(typeof LANG !== 'undefined' && LANG.something_went_wrong ? LANG.something_went_wrong : '<?php echo e(__("messages.something_went_wrong"), false); ?>');
            },
            complete: function () {
                submitButton.prop('disabled', false);
                $('.dataTables_processing').hide();
            },
        });
    });

    $(document).on('submit', '#update_expense_status_form', function(e) {
        if (!$('#project_expenses').hasClass('active')) {
            return;
        }

        e.preventDefault();
        e.stopImmediatePropagation();
        $('#update_expense_status_btn').trigger('click');
    });

    // ---- Project Stock tab ----
    // The partial (with filters + scrollable body) is fetched on the first
    // Stock click; subsequent section clicks tell the partial to switch views.
    var project_stock_loaded = false;
    var project_stock_url = '<?php echo e(route('project.stock', $project->id), false); ?>';
    var pending_project_stock_section = null;

    function loadProjectStockSectionWhenReady(section, attempts) {
        pending_project_stock_section = section;

        if (typeof window.loadProjectStockSection === 'function') {
            window.loadProjectStockSection(section);
            pending_project_stock_section = null;
            return;
        }

        if (attempts > 0) {
            setTimeout(function () {
                loadProjectStockSectionWhenReady(section, attempts - 1);
            }, 50);
        }
    }

    function activateProjectStockPane(section) {
        // De-activate all tab panes / tab list items, then activate ours.
        $('.tab-content > .tab-pane').removeClass('active');
        $('.nav-tabs > li').removeClass('active');
        $('#project_stock').addClass('active');
        $('#project_stock_tab').addClass('active');

        if (!project_stock_loaded) {
            $('.project_stock_body').html('<p class="text-center"><i class="fa fa-spinner fa-spin"></i></p>');
            $.ajax({
                url: project_stock_url + '?_=' + Date.now(),
                cache: false,
                success: function (html) {
                    $('.project_stock_body').html(html);
                    project_stock_loaded = true;
                    loadProjectStockSectionWhenReady(section, 20);
                },
                error: function (xhr) {
                    var msg = (xhr.responseText && xhr.responseText.length < 500)
                        ? xhr.responseText : '<?php echo app('translator')->get('messages.something_went_wrong'); ?>';
                    $('.project_stock_body').html('<div class="alert alert-danger">' + msg + '</div>');
                }
            });
        } else {
            loadProjectStockSectionWhenReady(section, 20);
        }
    }

    $(document).on('click', '.project-stock-tab-toggle', function (e) {
        e.preventDefault();
        activateProjectStockPane('allocated');
    });

    $(document).on('click', '.project-stock-section-link', function (e) {
        e.preventDefault();
        activateProjectStockPane($(this).data('section'));
    });

    // Deep-link support: if the URL was ?view=project_stock, default to Allocated.
    if (tab_view == 'project_stock') { activateProjectStockPane('allocated'); }
    if (window.location.hash == '#project_stock') { activateProjectStockPane('allocated'); }

    // ---- Project Location map tab ----
    <?php if(!empty(env('GOOGLE_MAP_API_KEY'))): ?>
    var project_location_map = null;
    var project_location_markers = [];
    var project_location_geocoder = null;
    var project_location_map_script_requested = false;
    var project_location_can_edit = <?php echo json_encode((bool) $can_edit_project); ?>;

    function clearProjectLocationMarkers() {
        project_location_markers.forEach(function(marker) {
            marker.setMap(null);
        });
        project_location_markers = [];
    }

    function parseProjectLocationPosition() {
        var value = ($('#project_position').val() || '').split(',');
        if (value.length !== 2 || isNaN(value[0]) || isNaN(value[1])) {
            return null;
        }

        return {
            lat: parseFloat(value[0]),
            lng: parseFloat(value[1])
        };
    }

    function setProjectLocationMarker(location, title, viewport) {
        clearProjectLocationMarkers();

        project_location_markers.push(new google.maps.Marker({
            map: project_location_map,
            title: title || '',
            position: location
        }));

        if (project_location_can_edit) {
            $('#project_position').val(location.lat() + ',' + location.lng());
        }

        if (viewport) {
            project_location_map.fitBounds(viewport);
        } else {
            project_location_map.setCenter(location);
            project_location_map.setZoom(15);
        }
    }

    function refreshProjectLocationMapSize() {
        if (!project_location_map) {
            return;
        }

        var center = project_location_map.getCenter();
        google.maps.event.trigger(project_location_map, 'resize');

        if (center) {
            project_location_map.setCenter(center);
        }
    }

    function geocodeProjectLocationAddress(input) {
        var query = ($.trim(input.value || ''));
        if (!query || !project_location_geocoder || !project_location_map || !project_location_can_edit) {
            return;
        }

        project_location_geocoder.geocode({ address: query }, function(results, status) {
            if (status !== 'OK' || !results.length || !results[0].geometry) {
                return;
            }

            input.value = results[0].formatted_address || query;
            setProjectLocationMarker(
                results[0].geometry.location,
                results[0].formatted_address || query,
                results[0].geometry.viewport
            );
        });
    }

    function initializeProjectLocationMap() {
        var mapEl = document.getElementById('project_location_map');
        var input = document.getElementById('project_shipping_address');

        if (!mapEl || typeof google === 'undefined' || !google.maps) {
            return;
        }

        if (project_location_map) {
            refreshProjectLocationMapSize();
            return;
        }

        var existingPosition = parseProjectLocationPosition();
        var defaultCenter = existingPosition || {lat: -33.8688, lng: 151.2195};

        project_location_map = new google.maps.Map(mapEl, {
            center: defaultCenter,
            zoom: existingPosition ? 12 : 10,
            mapTypeId: 'roadmap'
        });

        project_location_geocoder = new google.maps.Geocoder();

        if (existingPosition) {
            clearProjectLocationMarkers();
            project_location_markers.push(new google.maps.Marker({
                map: project_location_map,
                position: defaultCenter
            }));
        } else if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                project_location_map.setCenter({
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                });
            });
        }

        if (!project_location_can_edit || !input || !google.maps.places) {
            return;
        }

        var searchBox = new google.maps.places.SearchBox(input);

        project_location_map.addListener('bounds_changed', function() {
            searchBox.setBounds(project_location_map.getBounds());
        });

        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();
            if (!places.length) {
                return;
            }

            clearProjectLocationMarkers();
            var bounds = new google.maps.LatLngBounds();

            places.forEach(function(place) {
                if (!place.geometry) {
                    return;
                }

                project_location_markers.push(new google.maps.Marker({
                    map: project_location_map,
                    title: place.name,
                    position: place.geometry.location
                }));

                $('#project_position').val(place.geometry.location.lat() + ',' + place.geometry.location.lng());

                if (place.geometry.viewport) {
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });

            project_location_map.fitBounds(bounds);
        });

        input.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                geocodeProjectLocationAddress(input);
            }
        });
        input.addEventListener('change', function() {
            geocodeProjectLocationAddress(input);
        });
        input.addEventListener('blur', function() {
            window.setTimeout(function() {
                geocodeProjectLocationAddress(input);
            }, 200);
        });
    }

    window.__initProjectLocationMap = function() {
        initializeProjectLocationMap();
    };

    function loadProjectLocationMap() {
        if (!$('#project_location_map').length) {
            return;
        }

        if (typeof google !== 'undefined' && google.maps) {
            initializeProjectLocationMap();
            return;
        }

        if (!project_location_map_script_requested) {
            project_location_map_script_requested = true;
            var mapScript = document.createElement('script');
            mapScript.src = 'https://maps.googleapis.com/maps/api/js?key=<?php echo e(env('GOOGLE_MAP_API_KEY'), false); ?>&libraries=places&callback=__initProjectLocationMap';
            mapScript.async = true;
            mapScript.defer = true;
            document.head.appendChild(mapScript);
        }
    }

    $(document).on('shown.bs.tab', 'a[href="#project_location"]', function() {
        loadProjectLocationMap();
        window.setTimeout(refreshProjectLocationMapSize, 250);
    });

    if (tab_view == 'project_location' || window.location.hash == '#project_location') {
        window.setTimeout(loadProjectLocationMap, 250);
    }
    <?php endif; ?>
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>