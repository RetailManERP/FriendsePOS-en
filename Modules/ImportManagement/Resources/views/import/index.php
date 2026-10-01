
<?php $__env->startSection('title', __('importmanagement::lang.import_management')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header no-print">
    <h1><?php echo app('translator')->get('importmanagement::lang.import_management'); ?>
        <small><?php echo app('translator')->get('importmanagement::lang.all_imports'); ?></small>
    </h1>
</section>

<section class="content no-print">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <div class="col-md-3">
            <div class="form-group mb-2">
                <?php echo Form::label('import_filter_location', __('importmanagement::lang.business_location') . ':'); ?>

                <?php echo Form::select('import_filter_location', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-2">
                <?php echo Form::label('import_filter_supplier', __('importmanagement::lang.supplier_importer') . ':'); ?>

                <?php echo Form::select('import_filter_supplier', $suppliers, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-2">
                <?php echo Form::label('import_filter_status', __('importmanagement::lang.import_status') . ':'); ?>

                <?php echo Form::select('import_filter_status', $statuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-2">
                <?php echo Form::label('import_filter_date_range', __('report.date_range') . ':'); ?>

                <?php echo Form::text('import_filter_date_range', null, ['class' => 'form-control', 'id' => 'import_filter_date_range', 'readonly', 'placeholder' => __('lang_v1.select_a_date_range')]); ?>

            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('import_management.create')): ?>
            <?php $__env->slot('tool'); ?>
                <div class="box-tools">
                    <a class="btn btn-block btn-primary" href="<?php echo e(action([\Modules\ImportManagement\Http\Controllers\ImportController::class, 'create']), false); ?>">
                        <i class="fa fa-plus"></i> <?php echo app('translator')->get('importmanagement::lang.add_import'); ?>
                    </a>
                </div>
            <?php $__env->endSlot(); ?>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="imports_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('importmanagement::lang.import_ref_no'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.import_date'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.supplier_importer'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.business_location'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.import_status'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.shipping_method'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.total_items_cost'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.total_charges'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.grand_total'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.payment_status'); ?></th>
                        <th><?php echo app('translator')->get('messages.action'); ?></th>
                    </tr>
                </thead>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>
</section>


<div class="modal fade" id="receive_import_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="receive_import_modal_content">
        </div>
    </div>
</div>


<div class="modal fade" id="update_status_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title"><?php echo app('translator')->get('importmanagement::lang.update_status'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <?php echo Form::label('new_status', __('importmanagement::lang.import_status') . ':'); ?>

                    <?php echo Form::select('new_status', $statuses, null, ['class' => 'form-control select2', 'id' => 'new_status_select']); ?>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
                <button type="button" class="btn btn-primary" id="save_status_btn"><?php echo app('translator')->get('messages.save'); ?></button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function() {
    // Initialize DataTable
    var imports_table = $('#imports_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?php echo e(action([\Modules\ImportManagement\Http\Controllers\ImportController::class, "index"]), false); ?>',
            data: function(d) {
                d.location_id = $('#import_filter_location').val();
                d.contact_id = $('#import_filter_supplier').val();
                d.status = $('#import_filter_status').val();

                var dateRange = $('#import_filter_date_range').val();
                if (dateRange) {
                    var dates = dateRange.split(' ~ ');
                    d.start_date = dates[0];
                    d.end_date = dates[1];
                }
            }
        },
        columns: [
            { data: 'import_ref_no', name: 'imports.import_ref_no' },
            { data: 'import_date', name: 'imports.import_date' },
            { data: 'supplier_name', name: 'contacts.name' },
            { data: 'location_name', name: 'business_locations.name' },
            { data: 'status', name: 'imports.status' },
            { data: 'shipping_method', name: 'imports.shipping_method' },
            { data: 'total_items_cost', name: 'imports.total_items_cost' },
            { data: 'total_charges', name: 'imports.total_charges' },
            { data: 'final_total', name: 'imports.final_total' },
            { data: 'payment_status', name: 'imports.payment_status' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        order: [[1, 'desc']],
    });

    // Filter change handlers
    $('#import_filter_location, #import_filter_supplier, #import_filter_status').change(function() {
        imports_table.ajax.reload();
    });

    // Date range picker
    if ($('#import_filter_date_range').length) {
        $('#import_filter_date_range').daterangepicker({
            autoUpdateInput: false,
            locale: { cancelLabel: 'Clear', format: 'YYYY-MM-DD' }
        });
        $('#import_filter_date_range').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' ~ ' + picker.endDate.format('YYYY-MM-DD'));
            imports_table.ajax.reload();
        });
        $('#import_filter_date_range').on('cancel.daterangepicker', function() {
            $(this).val('');
            imports_table.ajax.reload();
        });
    }

    // Delete import
    $(document).on('click', '.delete-import', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        swal({
            title: LANG.sure,
            text: '<?php echo __("importmanagement::lang.confirm_delete"); ?>',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(function(willDelete) {
            if (willDelete) {
                $.ajax({
                    method: 'DELETE',
                    url: url,
                    dataType: 'json',
                    success: function(result) {
                        if (result.success) {
                            toastr.success(result.msg);
                            imports_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            }
        });
    });

    // Receive stock modal
    $(document).on('click', '.receive-import-btn', function(e) {
        e.preventDefault();
        var url = $(this).data('href');
        $.ajax({
            url: url,
            dataType: 'html',
            success: function(result) {
                $('#receive_import_modal_content').html(result);
                $('#receive_import_modal').modal('show');
            }
        });
    });

    // Update status
    var currentImportId = null;
    var currentStatusUrl = null;

    $(document).on('click', '.update-status-btn', function(e) {
        e.preventDefault();
        currentStatusUrl = $(this).data('href');
        currentImportId = $(this).data('import-id');
        $('#update_status_modal').modal('show');
    });

    $('#save_status_btn').click(function() {
        var newStatus = $('#new_status_select').val();
        $.ajax({
            method: 'POST',
            url: currentStatusUrl,
            data: { status: newStatus },
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    toastr.success(result.msg);
                    imports_table.ajax.reload();
                    $('#update_status_modal').modal('hide');
                } else {
                    toastr.error(result.msg);
                }
            }
        });
    });

    // Confirm receive stock
    $(document).on('click', '#confirm_receive_btn', function(e) {
        e.preventDefault();
        var form = $('#receive_stock_form');
        $.ajax({
            method: 'POST',
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    toastr.success(result.msg);
                    imports_table.ajax.reload();
                    $('#receive_import_modal').modal('hide');
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