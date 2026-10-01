
<?php $__env->startSection('title', __('tailorpro::lang.fabric_consumption_report')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('tailorpro::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><i class="fas fa-box-open" style="color:#6f42c1;"></i> <?php echo app('translator')->get('tailorpro::lang.fabric_consumption_report'); ?></h1>
</section>

<section class="content">
    <div class="box" style="border-radius:10px;">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo app('translator')->get('tailorpro::lang.filters'); ?></h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label><?php echo app('translator')->get('tailorpro::lang.date_range'); ?>:</label>
                        <input type="text" class="form-control" id="fc_date_range" placeholder="<?php echo app('translator')->get('tailorpro::lang.select_date_range'); ?>" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><?php echo app('translator')->get('business.location'); ?>:</label>
                        <?php echo Form::select('location_id', $locations, null, ['class' => 'form-control select2', 'id' => 'fc_location_filter', 'placeholder' => __('messages.all')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>&nbsp;</label><br>
                        <button type="button" class="btn btn-primary" id="apply_fc_filter">
                            <i class="fas fa-filter"></i> <?php echo app('translator')->get('tailorpro::lang.apply_filter'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="box" style="border-radius:10px;">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo app('translator')->get('tailorpro::lang.fabric_usage_details'); ?></h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover" id="fabric_report_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('product.product_name'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.order_no'); ?></th>
                            <th><?php echo app('translator')->get('role.customer'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.quantity_consumed'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.transaction_type'); ?></th>
                            <th><?php echo app('translator')->get('business.location'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.date'); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
$(document).ready(function () {
    $('#fc_location_filter').select2();

    $('#fc_date_range').daterangepicker({
        autoUpdateInput: false,
        locale: { cancelLabel: 'Clear' }
    });
    $('#fc_date_range').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });
    $('#fc_date_range').on('cancel.daterangepicker', function() {
        $(this).val('');
    });

    var fc_table = $('#fabric_report_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?php echo e(action([\Modules\TailorPro\Http\Controllers\ReportController::class, "fabricConsumptionReport"]), false); ?>',
            data: function (d) {
                d.date_range = $('#fc_date_range').val();
                d.location_id = $('#fc_location_filter').val();
            }
        },
        columns: [
            { data: 'product_name', name: 'products.name' },
            { data: 'order_no', name: 'order.order_no' },
            { data: 'customer_name', name: 'order.customer.name' },
            { data: 'quantity', name: 'quantity' },
            { data: 'transaction_type', name: 'transaction_type' },
            { data: 'location_name', name: 'location.name' },
            { data: 'created_at', name: 'created_at' }
        ]
    });

    $('#apply_fc_filter').on('click', function () {
        fc_table.ajax.reload();
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>