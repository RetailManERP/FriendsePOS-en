
<?php $__env->startSection('title', __('essentials::lang.leave_quotas')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('essentials::layouts.nav_hrm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header">
    <h1><?php echo app('translator')->get('essentials::lang.leave_quotas'); ?></h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters'), 'class' => 'box-primary']); ?>
                <?php if($is_admin): ?>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('quota_employee_id', __('essentials::lang.employee') . ':'); ?>

                        <?php echo Form::select('quota_employee_id', $employees, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                    </div>
                </div>
                <?php endif; ?>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('quota_leave_type', __('essentials::lang.leave_type') . ':'); ?>

                        <?php echo Form::select('quota_leave_type', $leave_types, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('quota_fiscal_year', __('essentials::lang.fiscal_year') . ':'); ?>

                        <?php echo Form::select('quota_fiscal_year', $fiscal_years, date('Y'), ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('essentials::lang.all_leave_quotas')]); ?>
                <?php if($is_admin): ?>
                <?php $__env->slot('tool'); ?>
                    <div class="box-tools">
                        <button type="button" class="btn btn-block btn-primary btn-modal"
                            data-href="<?php echo e(action([\Modules\Essentials\Http\Controllers\LeaveQuotaController::class, 'create']), false); ?>"
                            data-container="#leave_quota_modal">
                            <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
                        </button>
                    </div>
                <?php $__env->endSlot(); ?>
                <?php endif; ?>
                <div class="table-responsive" style="min-height: 80vh">
                    <table class="table table-bordered table-striped table-hover table-th-skin" id="leave_quotas_table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('essentials::lang.employee'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.leave_type'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.fiscal_year'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.allocated_days'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.carried_forward'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.used_days'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.remaining_days'); ?></th>
                                <?php if($is_admin): ?>
                                <th><?php echo app('translator')->get('messages.action'); ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<div class="modal fade" id="leave_quota_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
<div class="modal fade" id="edit_quota_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
$(document).ready(function() {
    var leave_quotas_table = $('#leave_quotas_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?php echo e(action([\Modules\Essentials\Http\Controllers\LeaveQuotaController::class, 'index']), false); ?>",
            data: function(d) {
                d.employee_id = $('#quota_employee_id').val();
                d.leave_type_id = $('#quota_leave_type').val();
                d.fiscal_year = $('#quota_fiscal_year').val();
            }
        },
        columns: [
            { data: 'employee_name', name: 'employee_name' },
            { data: 'leave_type', name: 'lt.leave_type' },
            { data: 'fiscal_year', name: 'essentials_leave_quotas.fiscal_year' },
            { data: 'allocated_days', name: 'essentials_leave_quotas.allocated_days' },
            { data: 'carried_forward', name: 'essentials_leave_quotas.carried_forward' },
            { data: 'used_days', name: 'essentials_leave_quotas.used_days' },
            { data: 'remaining_days', name: 'essentials_leave_quotas.remaining_days' },
            <?php if($is_admin): ?>
            { data: 'action', name: 'action', orderable: false, searchable: false },
            <?php endif; ?>
        ],
    });

    $('#quota_employee_id, #quota_leave_type, #quota_fiscal_year').change(function() {
        leave_quotas_table.ajax.reload();
    });

    $(document).on('click', '.edit_quota', function() {
        var href = $(this).data('href');
        $.ajax({
            url: href,
            dataType: 'html',
            success: function(result) {
                $('#edit_quota_modal').html(result).modal('show');
            }
        });
    });

    $(document).on('click', '.delete_quota', function() {
        swal({
            title: LANG.sure,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((confirmed) => {
            if (confirmed) {
                var href = $(this).data('href');
                $.ajax({
                    method: "DELETE",
                    url: href,
                    dataType: "json",
                    success: function(result) {
                        if (result.success) {
                            toastr.success(result.msg);
                            leave_quotas_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>