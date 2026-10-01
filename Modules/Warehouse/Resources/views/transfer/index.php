
<?php $__env->startSection('title', __('warehouse::lang.stock_transfers')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('warehouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('warehouse::lang.stock_transfers'); ?></h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('warehouse.transfer.create')): ?>
                    <a class="btn btn-block btn-primary" href="<?php echo e(route('warehouse.transfers.create'), false); ?>">
                        <i class="fas fa-plus"></i> <?php echo app('translator')->get('warehouse::lang.create_transfer'); ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php $__env->endSlot(); ?>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label><?php echo app('translator')->get('warehouse::lang.transfer_status'); ?>:</label>
                    <select class="form-control select2" id="status_filter">
                        <option value=""><?php echo app('translator')->get('messages.all'); ?></option>
                        <option value="draft"><?php echo app('translator')->get('warehouse::lang.status_draft'); ?></option>
                        <option value="pending"><?php echo app('translator')->get('warehouse::lang.status_pending'); ?></option>
                        <option value="in_transit"><?php echo app('translator')->get('warehouse::lang.status_in_transit'); ?></option>
                        <option value="partial"><?php echo app('translator')->get('warehouse::lang.status_partial'); ?></option>
                        <option value="completed"><?php echo app('translator')->get('warehouse::lang.status_completed'); ?></option>
                        <option value="cancelled"><?php echo app('translator')->get('warehouse::lang.status_cancelled'); ?></option>
                    </select>
                </div>
            </div>
        </div>

        <table class="table table-bordered table-striped" id="transfers_table" style="width: 100%">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('messages.date'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.reference_no'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.source_warehouse'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.destination_warehouse'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.transfer_status'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.priority'); ?></th>
                    <th><?php echo app('translator')->get('purchase.additional_notes'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                    <th><?php echo app('translator')->get('messages.action'); ?></th>
                </tr>
            </thead>
        </table>
    <?php echo $__env->renderComponent(); ?>
</section>


<div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" style="z-index: 9999;">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo app('translator')->get('warehouse::lang.change_status'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label><?php echo app('translator')->get('warehouse::lang.transfer_status'); ?>:</label>
                    <select class="form-control" id="new_status_select">
                        <option value="draft"><?php echo app('translator')->get('warehouse::lang.status_draft'); ?></option>
                        <option value="pending"><?php echo app('translator')->get('warehouse::lang.status_pending'); ?></option>
                        <option value="in_transit"><?php echo app('translator')->get('warehouse::lang.status_in_transit'); ?></option>
                        <option value="completed"><?php echo app('translator')->get('warehouse::lang.status_completed'); ?></option>
                        <option value="cancelled"><?php echo app('translator')->get('warehouse::lang.status_cancelled'); ?></option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
                <button type="button" class="btn btn-primary" id="save_status_btn"><?php echo app('translator')->get('messages.update'); ?></button>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        // Move modal to body to avoid z-index issues from positioned parents
        $('#changeStatusModal').appendTo('body');
        var transfers_table = $('#transfers_table').DataTable({
            processing: true,
            serverSide: true,
            scrollY: "75vh",
            scrollX: true,
            scrollCollapse: true,
            ajax: {
                url: '<?php echo e(route("warehouse.transfers"), false); ?>',
                data: function(d) {
                    d.status = $('#status_filter').val();
                }
            },
            columns: [
                { data: 'transaction_date', name: 'transaction_date', orderable: true, searchable: false },
                { data: 'ref_no', name: 'ref_no', orderable: true },
                { data: 'location_from', name: 'l1.name', orderable: false, searchable: false },
                { data: 'location_to', name: 'l2.name', orderable: false, searchable: false },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'sub_status', name: 'sub_status', orderable: false, searchable: false },
                { data: 'additional_notes', name: 'additional_notes', orderable: false, searchable: false },
                { data: 'created_by_name', orderable: false, searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            order: [[0, 'desc']],
            fnDrawCallback: function (oSettings) {
                __currency_convert_recursively($('#transfers_table'));
            },
        });

        $('#status_filter').change(function() {
            transfers_table.ajax.reload();
        });

        // Status change modal
        var statusChangeUrl = '';
        $(document).on('click', '.change-status-btn', function(e) {
            e.preventDefault();
            var currentStatus = $(this).data('status');
            statusChangeUrl = $(this).data('href');
            $('#new_status_select').val(currentStatus);
            $('#changeStatusModal').modal('show');
        });

        $('#save_status_btn').click(function() {
            var newStatus = $('#new_status_select').val();
            var btn = $(this);
            btn.prop('disabled', true).text('...');
            $.ajax({
                url: statusChangeUrl,
                type: 'POST',
                data: {
                    status: newStatus,
                    _token: '<?php echo e(csrf_token(), false); ?>'
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.msg);
                        transfers_table.ajax.reload(null, false);
                        $('#changeStatusModal').modal('hide');
                    } else {
                        toastr.error(response.msg);
                    }
                },
                error: function() {
                    toastr.error("<?php echo e(__('messages.something_went_wrong'), false); ?>");
                },
                complete: function() {
                    btn.prop('disabled', false).text("<?php echo e(__('messages.update'), false); ?>");
                }
            });
        });

        // Delete transfer
        $(document).on('click', '.delete-transfer', function(e) {
            e.preventDefault();
            var url = $(this).data('href');
            swal({
                title: LANG.sure,
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(function(willDelete) {
                if (willDelete) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: { _token: '<?php echo e(csrf_token(), false); ?>' },
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.msg);
                                transfers_table.ajax.reload(null, false);
                            } else {
                                toastr.error(response.msg);
                            }
                        },
                        error: function() {
                            toastr.error("<?php echo e(__('messages.something_went_wrong'), false); ?>");
                        }
                    });
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>