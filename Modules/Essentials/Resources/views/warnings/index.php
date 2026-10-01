
<?php $__env->startSection('title', __('essentials::lang.warnings')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('essentials::layouts.nav_hrm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header">
    <h1><?php echo app('translator')->get('essentials::lang.warnings'); ?></h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters'), 'class' => 'box-primary']); ?>
                <?php if($is_admin): ?>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('warning_employee_id', __('essentials::lang.employee') . ':'); ?>

                        <?php echo Form::select('warning_employee_id', $employees, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                    </div>
                </div>
                <?php endif; ?>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('warning_type_filter', __('essentials::lang.warning_type') . ':'); ?>

                        <?php echo Form::select('warning_type_filter', $warning_types, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('warning_status_filter', __('essentials::lang.status') . ':'); ?>

                        <?php echo Form::select('warning_status_filter', $warning_statuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('essentials::lang.all_warnings')]); ?>
                <?php if($is_admin): ?>
                <?php $__env->slot('tool'); ?>
                    <div class="box-tools">
                        <button type="button" class="btn btn-block btn-primary btn-modal"
                            data-href="<?php echo e(action([\Modules\Essentials\Http\Controllers\WarningController::class, 'create']), false); ?>"
                            data-container="#warning_modal">
                            <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
                        </button>
                    </div>
                <?php $__env->endSlot(); ?>
                <?php endif; ?>
                <div class="table-responsive" style="min-height: 80vh">
                    <table class="table table-bordered table-striped table-hover table-th-skin" id="warnings_table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('essentials::lang.employee'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.subject'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.warning_type'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.warning_date'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.status'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.issued_by'); ?></th>
                                <th><?php echo app('translator')->get('messages.action'); ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<div class="modal fade" id="warning_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
<div class="modal fade" id="view_warning_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
$(document).ready(function() {
    var warnings_table = $('#warnings_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?php echo e(action([\Modules\Essentials\Http\Controllers\WarningController::class, 'index']), false); ?>",
            data: function(d) {
                d.employee_id = $('#warning_employee_id').val();
                d.warning_type = $('#warning_type_filter').val();
                d.warning_status = $('#warning_status_filter').val();
            }
        },
        columns: [
            { data: 'employee_name', name: 'employee_name' },
            { data: 'subject', name: 'essentials_warnings.subject' },
            { data: 'warning_type', name: 'essentials_warnings.warning_type' },
            { data: 'warning_date', name: 'essentials_warnings.warning_date' },
            { data: 'status', name: 'essentials_warnings.status' },
            { data: 'issued_by_name', name: 'issued_by_name' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
    });

    $('#warning_employee_id, #warning_type_filter, #warning_status_filter').change(function() {
        warnings_table.ajax.reload();
    });

    $(document).on('click', '.view_warning', function() {
        var href = $(this).data('href');
        $.ajax({
            url: href,
            dataType: 'html',
            success: function(result) {
                $('#view_warning_modal').html(result).modal('show');
            }
        });
    });

    $(document).on('click', '.delete_warning', function() {
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
                            warnings_table.ajax.reload();
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