
<?php $__env->startSection('title', __('essentials::lang.employee_documents')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('essentials::layouts.nav_hrm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header">
    <h1><?php echo app('translator')->get('essentials::lang.employee_documents'); ?></h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters'), 'class' => 'box-primary']); ?>
                <?php if($is_admin): ?>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('emp_doc_employee_id', __('essentials::lang.employee') . ':'); ?>

                        <?php echo Form::select('emp_doc_employee_id', $employees, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                    </div>
                </div>
                <?php endif; ?>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('emp_doc_type_filter', __('essentials::lang.document_type') . ':'); ?>

                        <?php echo Form::select('emp_doc_type_filter', $document_types, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('essentials::lang.all_employee_documents')]); ?>
                <?php if($is_admin): ?>
                <?php $__env->slot('tool'); ?>
                    <div class="box-tools">
                        <button type="button" class="btn btn-block btn-primary btn-modal"
                            data-href="<?php echo e(action([\Modules\Essentials\Http\Controllers\EmployeeDocumentController::class, 'create']), false); ?>"
                            data-container="#employee_document_modal">
                            <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
                        </button>
                    </div>
                <?php $__env->endSlot(); ?>
                <?php endif; ?>
                <div class="table-responsive" style="min-height: 80vh">
                    <table class="table table-bordered table-striped table-hover table-th-skin" id="employee_documents_table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('essentials::lang.employee'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.document_name'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.document_type'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.document_number'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.issue_date'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.expiry_date'); ?></th>
                                <th><?php echo app('translator')->get('messages.action'); ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<div class="modal fade" id="employee_document_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
$(document).ready(function() {
    window.employee_documents_table = $('#employee_documents_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?php echo e(action([\Modules\Essentials\Http\Controllers\EmployeeDocumentController::class, 'index']), false); ?>",
            data: function(d) {
                d.employee_id = $('#emp_doc_employee_id').val();
                d.document_type = $('#emp_doc_type_filter').val();
            }
        },
        columns: [
            { data: 'employee_name', name: 'employee_name' },
            { data: 'document_name', name: 'essentials_employee_documents.document_name' },
            { data: 'document_type', name: 'essentials_employee_documents.document_type' },
            { data: 'document_number', name: 'essentials_employee_documents.document_number' },
            { data: 'issue_date', name: 'essentials_employee_documents.issue_date' },
            { data: 'expiry_date', name: 'essentials_employee_documents.expiry_date' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
    });
    window.reloadEmployeeDocumentsTable = function(resetPaging) {
        if ($.fn.dataTable && $.fn.dataTable.isDataTable('#employee_documents_table')) {
            $('#employee_documents_table').DataTable().ajax.reload(null, resetPaging !== false);
        }
    };

    $('#emp_doc_employee_id, #emp_doc_type_filter').change(function() {
        window.reloadEmployeeDocumentsTable();
    });

    $(document).on('click', '.delete_employee_document', function() {
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
                            window.reloadEmployeeDocumentsTable(false);
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