

<?php $__env->startSection('title', __('accounting::lang.bank_reconciliation')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('accounting::lang.bank_reconciliation'); ?>
        <small><?php echo app('translator')->get('accounting::lang.bank_reconciliation_sub'); ?></small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0" style="border-radius:12px;overflow:hidden;">
                <div class="card-header bg-white py-2 px-3" style="border-bottom:1px solid #f0f0f0;">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <h6 class="mb-0 fw-bold" style="font-size:14px;"><i class="fas fa-university me-2 text-primary"></i><?php echo app('translator')->get('accounting::lang.bank_reconciliation'); ?></h6>
                        <button class="btn btn-primary btn-sm btn-modal"
                            data-href="<?php echo e(action([\Modules\Accounting\Http\Controllers\BankReconciliationController::class, 'create']), false); ?>"
                            data-container="#reconciliation_modal">
                            <i class="fas fa-plus me-1"></i><?php echo app('translator')->get('accounting::lang.new_reconciliation'); ?>
                        </button>
                    </div>
                    
                    <div class="row mt-2 g-2">
                        <div class="col-md-3">
                            <select class="form-control form-control-sm select2" id="filter_account">
                                <option value=""><?php echo app('translator')->get('accounting::lang.all_accounts'); ?></option>
                                <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($id, false); ?>"><?php echo e($name, false); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-control form-control-sm" id="filter_status">
                                <option value=""><?php echo app('translator')->get('accounting::lang.all_statuses'); ?></option>
                                <option value="draft">Draft</option>
                                <option value="completed">Completed</option>
                                <option value="locked">Locked</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="date" class="form-control form-control-sm" id="filter_start_date">
                        </div>
                        <div class="col-md-2">
                            <input type="date" class="form-control form-control-sm" id="filter_end_date">
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-info btn-sm" id="btn_filter">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="reconciliation_table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('accounting::lang.reference_no'); ?></th>
                                    <th><?php echo app('translator')->get('accounting::lang.bank_account'); ?></th>
                                    <th><?php echo app('translator')->get('accounting::lang.statement_date'); ?></th>
                                    <th><?php echo app('translator')->get('accounting::lang.opening_balance'); ?></th>
                                    <th><?php echo app('translator')->get('accounting::lang.closing_balance'); ?></th>
                                    <th><?php echo app('translator')->get('accounting::lang.cleared_debits'); ?></th>
                                    <th><?php echo app('translator')->get('accounting::lang.cleared_credits'); ?></th>
                                    <th><?php echo app('translator')->get('accounting::lang.difference'); ?></th>
                                    <th><?php echo app('translator')->get('sale.status'); ?></th>
                                    <th><?php echo app('translator')->get('messages.action'); ?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="reconciliation_modal" tabindex="-1" role="dialog"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function () {

    var table = $('#reconciliation_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?php echo e(action([\Modules\Accounting\Http\Controllers\BankReconciliationController::class, "index"]), false); ?>',
            data: function (d) {
                d.account_id   = $('#filter_account').val();
                d.status       = $('#filter_status').val();
                d.start_date   = $('#filter_start_date').val();
                d.end_date     = $('#filter_end_date').val();
            }
        },
        columns: [
            { data: 'reference_no',              name: 'reference_no' },
            { data: 'account_name',              name: 'accounting_accounts.name' },
            { data: 'statement_date',            name: 'statement_date' },
            { data: 'system_opening_balance',    name: 'system_opening_balance',    render: $.fn.dataTable.render.number(',', '.', 2) },
            { data: 'statement_closing_balance', name: 'statement_closing_balance' },
            { data: 'cleared_debit_total',       name: 'cleared_debit_total',       render: $.fn.dataTable.render.number(',', '.', 2) },
            { data: 'cleared_credit_total',      name: 'cleared_credit_total',      render: $.fn.dataTable.render.number(',', '.', 2) },
            { data: 'difference',                name: 'difference' },
            { data: 'status',                    name: 'status' },
            { data: 'action',                    name: 'action', orderable: false, searchable: false },
        ],
        order: [[2, 'desc']],
    });

    $('#btn_filter').on('click', function () { table.ajax.reload(); });

    // Delete
    $(document).on('click', '.delete-reconciliation', function (e) {
        e.preventDefault();
        var href = $(this).data('href');
        swal({
            title: '<?php echo e(__("messages.are_you_sure"), false); ?>',
            text: '<?php echo e(__("accounting::lang.delete_reconciliation_confirm"), false); ?>',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(function (confirmed) {
            if (confirmed) {
                $.ajax({
                    method: 'DELETE',
                    url: href,
                    data: { _token: '<?php echo e(csrf_token(), false); ?>' },
                    success: function (result) {
                        if (result.success) {
                            toastr.success(result.msg);
                            table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>