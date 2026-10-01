
<?php $__env->startSection('title', __('tailorpro::lang.orders')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('tailorpro::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<style>
    .tp-overdue-row { background: #fff5f5 !important; }
    .tp-overdue-row td { border-left: 3px solid #dc3545 !important; }
    .tp-priority-urgent { color: #856404; font-weight: bold; }
    .tp-priority-express { color: #721c24; font-weight: bold; }
    .tp-payment-paid { color: #28a745; }
    .tp-payment-partial { color: #ffc107; }
    .tp-payment-due { color: #dc3545; }
</style>

<section class="content-header no-print">
    <h1>
        <i class="fas fa-clipboard-list" style="color:#6f42c1;"></i> <?php echo app('translator')->get('tailorpro::lang.orders'); ?>
    </h1>
</section>

<section class="content no-print">
    <div class="box" style="border-radius:10px;">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo app('translator')->get('tailorpro::lang.all_orders'); ?></h3>
            <div class="box-tools">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tailorpro_order.create')): ?>
                <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\OrderController::class, 'create']), false); ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus-circle"></i> <?php echo app('translator')->get('tailorpro::lang.add_order'); ?>
                </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover" id="tailorpro_orders_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('tailorpro::lang.order_no'); ?></th>
                            <th><?php echo app('translator')->get('role.customer'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.garment_type'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.fabric'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.tailor'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.order_date'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.delivery_date'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.priority'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.payment_status'); ?></th>
                            <th><?php echo app('translator')->get('sale.status'); ?></th>
                            <th><?php echo app('translator')->get('messages.action'); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="status_modal" tabindex="-1" role="dialog"></div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
$(document).ready(function () {
    $('#status_modal').appendTo('body');

    var orders_table = $("#tailorpro_orders_table").DataTable({
        processing: true,
        serverSide: true,
        ajax: '<?php echo e(action([\Modules\TailorPro\Http\Controllers\OrderController::class, "index"]), false); ?>',
        columns: [
            { data: 'order_no', name: 'order_no' },
            { data: 'customer_name', name: 'contacts.name' },
            { data: 'garment_type', name: 'garment_type' },
            { data: 'fabric_name', name: 'fabric.name' },
            { data: 'tailor_name', name: 'tailor.first_name' },
            { data: 'order_date', name: 'order_date', searchable: false },
            { data: 'delivery_date', name: 'delivery_date', searchable: false },
            { data: 'priority_badge', name: 'priority' },
            { data: 'payment_status', name: 'payment_status', orderable: false, searchable: false },
            { data: 'status', name: 'ts.name' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        createdRow: function(row, data) {
            if (data.is_overdue) {
                $(row).addClass('tp-overdue-row');
            }
        },
    });

    $(document).on('click', '.edit_order_status', function (e) {
        e.preventDefault();
        var url = $(this).data('href');
        $.ajax({
            method: 'GET',
            url: url,
            dataType: 'html',
            success: function(result) {
                $('#status_modal').html(result).modal('show');
                $('#status_modal .select2').select2({
                    dropdownParent: $('#status_modal')
                });
            }
        });
    });

    $(document).on('submit', 'form#update_status_form', function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            method: $(this).attr("method"),
            url: $(this).attr("action"),
            dataType: "json",
            data: data,
            success: function(result) {
                if (result.success == true) {
                    $('#status_modal').modal('hide');
                    toastr.success(result.msg);
                    orders_table.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
            }
        });
    });

    $(document).on('click', '.delete_order', function(e) {
        e.preventDefault();
        swal({
            title: LANG.sure,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var href = $(this).attr('href');
                $.ajax({
                    method: "DELETE",
                    url: href,
                    dataType: "json",
                    success: function(result) {
                        if (result.success == true) {
                            toastr.success(result.msg);
                            orders_table.ajax.reload();
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