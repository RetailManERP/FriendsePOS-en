<div class="modal-dialog" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\Modules\Essentials\Http\Controllers\EmployeeDocumentController::class, 'update'], $document->id), 'method' => 'put', 'id' => 'edit_employee_document_form', 'files' => true]); ?>


        <div class="modal-header">
            <h4 class="modal-title"><?php echo app('translator')->get('messages.edit'); ?> <?php echo app('translator')->get('essentials::lang.employee_documents'); ?></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('user_id', __('essentials::lang.employee') . ':*'); ?>

                        <?php echo Form::select('user_id', $employees, $document->user_id, ['class' => 'form-control select2', 'required', 'style' => 'width: 100%;', 'placeholder' => __('messages.please_select')]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('document_type', __('essentials::lang.document_type') . ':*'); ?>

                        <?php echo Form::select('document_type', $document_types, $document->document_type, ['class' => 'form-control select2', 'required', 'style' => 'width: 100%;', 'placeholder' => __('messages.please_select')]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('document_name', __('essentials::lang.document_name') . ':*'); ?>

                        <?php echo Form::text('document_name', $document->document_name, ['class' => 'form-control', 'required', 'placeholder' => __('essentials::lang.document_name')]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('document_number', __('essentials::lang.document_number') . ':'); ?>

                        <?php echo Form::text('document_number', $document->document_number, ['class' => 'form-control', 'placeholder' => __('essentials::lang.document_number')]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('issue_date', __('essentials::lang.issue_date') . ':'); ?>

                        <?php echo Form::text('issue_date', $issue_date, ['class' => 'form-control', 'placeholder' => __('essentials::lang.issue_date'), 'readonly', 'id' => 'emp_doc_issue_date']); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('expiry_date', __('essentials::lang.expiry_date') . ':'); ?>

                        <?php echo Form::text('expiry_date', $expiry_date, ['class' => 'form-control', 'placeholder' => __('essentials::lang.expiry_date'), 'readonly', 'id' => 'emp_doc_expiry_date']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('document_file', __('essentials::lang.upload_document') . ':'); ?>

                        <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('lang_v1.previous_file_will_be_replaced'); ?><br><?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
                        <?php echo Form::file('document_file', ['class' => 'form-control', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); ?>

                        <?php if($has_document_file): ?>
                        <div class="mt-2">
                            <a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\EmployeeDocumentController::class, 'view'], $document->id), false); ?>" class="btn btn-xs btn-primary" target="_blank">
                                <i class="fas fa-eye"></i> <?php echo app('translator')->get('messages.view'); ?>
                            </a>
                            <a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\EmployeeDocumentController::class, 'download'], $document->id), false); ?>" class="btn btn-xs btn-info">
                                <i class="fas fa-download"></i> <?php echo app('translator')->get('essentials::lang.download'); ?>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('description', __('essentials::lang.description') . ':'); ?>

                        <?php echo Form::textarea('description', $document->description, ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('essentials::lang.description')]); ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.update'); ?></button>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>

        <?php echo Form::close(); ?>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var $modal = $('#employee_document_modal');
        $modal.find('.select2').each(function() {
            $(this).select2({ dropdownParent: $modal });
        });

        $('#emp_doc_issue_date, #emp_doc_expiry_date').datepicker({
            autoclose: true,
            format: 'mm/dd/yyyy',
        });

        $('#edit_employee_document_form').off('submit.employee_document').on('submit.employee_document', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                method: 'POST',
                url: $(this).attr('action'),
                dataType: 'json',
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {
                    if (result.success) {
                        $('#employee_document_modal').modal('hide');
                        toastr.success(result.msg);
                        if (typeof window.reloadEmployeeDocumentsTable === 'function') {
                            window.reloadEmployeeDocumentsTable(false);
                        } else if ($.fn.dataTable && $.fn.dataTable.isDataTable('#employee_documents_table')) {
                            $('#employee_documents_table').DataTable().ajax.reload(null, false);
                        }
                    } else {
                        toastr.error(result.msg);
                    }
                }
            });
        });
    });
</script>
