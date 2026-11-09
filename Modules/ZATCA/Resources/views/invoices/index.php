
<?php $__env->startSection('title', 'ZATCA Invoices'); ?>

<?php $__env->startSection('content'); ?>

<style>
    #zatca_invoices_table_wrapper {
        padding: 0;
    }

    #zatca_invoices_table_wrapper > .row:first-child {
        margin-bottom: 18px;
        align-items: center;
    }

    #zatca_invoices_table_wrapper > .row:last-child {
        margin-top: 14px;
    }

    #zatca_invoices_table_wrapper .dt-buttons-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
    }

    #zatca_invoices_table_wrapper .dataTables_filter input {
        max-width: 100%;
        margin-left: 6px;
    }

    #zatca_invoices_table {
        min-width: 1300px;
    }
</style>

<section class="content-header">
    <h1>ZATCA Invoices <small>E-Invoice Synchronization</small></h1>
</section>

<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php echo e(session('status.msg'), false); ?>

        </div>
    <?php endif; ?>

    <!-- Filters -->
    <div class="card mb-3">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <form method="GET" id="zatca_filter_form" class="col-md-10">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select name="status" id="zatca_filter_status" class="form-select form-select-sm">
                                <?php $__currentLoopData = $sync_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value, false); ?>" <?php echo e(request('status') === $value ? 'selected' : '', false); ?>><?php echo e($label, false); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Invoice Type</label>
                            <select name="type" id="zatca_filter_type" class="form-select form-select-sm">
                                <?php $__currentLoopData = $invoice_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value, false); ?>" <?php echo e(request('type') === $value ? 'selected' : '', false); ?>><?php echo e($label, false); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Date From</label>
                            <input type="date" name="date_from" id="zatca_filter_date_from" class="form-control form-control-sm" value="<?php echo e(request('date_from'), false); ?>">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Date To</label>
                            <input type="date" name="date_to" id="zatca_filter_date_to" class="form-control form-control-sm" value="<?php echo e(request('date_to'), false); ?>">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Filter</button>
                            <a href="<?php echo e(route('zatca.invoices.index'), false); ?>" class="btn btn-secondary btn-sm"><i class="fas fa-times"></i></a>
                        </div>
                    </div>
                </form>
                <div class="col-md-2 text-end">
                    <form action="<?php echo e(route('zatca.invoices.bulk-sync'), false); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Sync all pending invoices to ZATCA?')">
                            <i class="fas fa-sync"></i> Sync All Pending
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Invoice List -->
    <div class="card">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="zatca_invoices_table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Invoice #</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>B2B/B2C</th>
                            <th>Buyer</th>
                            <th class="text-end">Excl. VAT</th>
                            <th class="text-end">VAT</th>
                            <th class="text-end">Total</th>
                            <th>Validation</th>
                            <th>Status</th>
                            <th>Next Retry</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(function () {
    var table = $('#zatca_invoices_table').DataTable({
        processing: true,
        serverSide: true,
        deferRender: true,
        searchDelay: 400,
        dom: '<"row margin-bottom-20"<"col-sm-2 col-6 mb-2"l><"col-sm-7 col-12 mb-2 dt-buttons-wrapper"B><"col-sm-3 col-6 mb-2"f> r>tip',
        ajax: {
            url: <?php echo json_encode(route('zatca.invoices.index'), 15, 512) ?>,
            data: function (data) {
                data.status = $('#zatca_filter_status').val();
                data.type = $('#zatca_filter_type').val();
                data.date_from = $('#zatca_filter_date_from').val();
                data.date_to = $('#zatca_filter_date_to').val();
            }
        },
        columns: [
            {data: 'invoice_number', render: function (data, type, row) {
                return '<a href="' + $('<div>').text(row.invoice_url).html() + '">' + $('<div>').text(data || '').html() + '</a>';
            }},
            {data: 'invoice_date'},
            {data: 'invoice_type'},
            {data: 'invoice_sub_type', render: function (data) {
                var subtype = $('<div>').text(data || '').html();
                return '<span class="badge ' + (data === 'B2B' ? 'bg-primary' : 'bg-secondary') + '">' + subtype + '</span>';
            }},
            {data: 'buyer_name', render: $.fn.dataTable.render.text()},
            {data: 'total_excluding_vat', className: 'text-end', render: $.fn.dataTable.render.number(',', '.', 2)},
            {data: 'total_vat', className: 'text-end', render: $.fn.dataTable.render.number(',', '.', 2)},
            {data: 'total_including_vat', className: 'text-end', render: function (data, type) {
                var amount = $.fn.dataTable.render.number(',', '.', 2).display(data);
                return type === 'display' ? '<strong>' + amount + '</strong>' : amount;
            }},
            {data: 'validation_status', render: function (data, type, row) {
                return '<span class="badge ' + $('<div>').text(row.validation_badge_class || '').html() + '">' + $('<div>').text(data || '').html() + '</span>';
            }},
            {data: 'sync_status', render: function (data, type, row) {
                return '<span class="badge ' + $('<div>').text(row.sync_badge_class || '').html() + '">' + $('<div>').text(data || '').html() + '</span>';
            }},
            {data: 'next_retry_at'},
            {data: 'actions', orderable: false, searchable: false}
        ],
        buttons: [
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_export_buttons')): ?>
            {extend: 'csv', text: '<i class="fa fa-file-csv"></i> ' + LANG.export_to_csv, className: 'btn-sm btn-secondary', exportOptions: {columns: ':visible'}},
            {extend: 'excel', text: '<i class="fa fa-file-excel"></i> ' + LANG.export_to_excel, className: 'btn-sm btn-secondary', exportOptions: {columns: ':visible'}},
            {extend: 'print', text: '<i class="fa fa-print"></i> ' + LANG.print, className: 'btn-sm btn-info', exportOptions: {columns: ':visible', stripHtml: true}},
            {extend: 'colvis', text: '<i class="fa fa-columns"></i> ' + LANG.col_vis, className: 'btn-sm btn-secondary'},
            <?php if(!in_array(session()->get('user.language', config('app.locale')), config('constants.non_utf8_languages'))): ?>
            {extend: 'pdf', text: '<i class="fa fa-file-pdf"></i> ' + LANG.export_to_pdf, className: 'btn-sm btn-secondary', exportOptions: {columns: ':visible'}},
            <?php endif; ?>
            <?php endif; ?>
        ],
        aLengthMenu: [[25, 50, 100, 200, 500, -1], [25, 50, 100, 200, 500, LANG.all]],
        pageLength: 25,
        order: [[1, 'desc']],
        language: {
            emptyTable: 'No ZATCA invoices found. Invoices will appear here once synced from your POS transactions.',
            processing: LANG.processing || 'Processing...'
        }
    });

    $('#zatca_filter_form').on('submit', function (event) {
        event.preventDefault();
        table.ajax.reload();
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>