
<?php $__env->startSection('title', __('tailorpro::lang.order_report')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('tailorpro::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><i class="fas fa-file-alt" style="color:#6f42c1;"></i> <?php echo app('translator')->get('tailorpro::lang.order_report'); ?></h1>
</section>

<section class="content">
    <div class="box" style="border-radius:10px;">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo app('translator')->get('tailorpro::lang.filters'); ?></h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label><?php echo app('translator')->get('tailorpro::lang.date_range'); ?>:</label>
                        <input type="text" class="form-control" id="order_report_date_range" placeholder="<?php echo app('translator')->get('tailorpro::lang.select_date_range'); ?>" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label><?php echo app('translator')->get('tailorpro::lang.status'); ?>:</label>
                        <?php echo Form::select('status_id', $statuses, null, ['class' => 'form-control', 'id' => 'or_status_filter', 'placeholder' => __('messages.all')]); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label><?php echo app('translator')->get('tailorpro::lang.tailor'); ?>:</label>
                        <?php echo Form::select('tailor_id', $tailors, null, ['class' => 'form-control select2', 'id' => 'or_tailor_filter', 'placeholder' => __('messages.all')]); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>&nbsp;</label><br>
                        <button type="button" class="btn btn-primary" id="apply_order_report_filter">
                            <i class="fas fa-filter"></i> <?php echo app('translator')->get('tailorpro::lang.apply_filter'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="box" style="border-radius:10px;">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo app('translator')->get('tailorpro::lang.order_summary'); ?></h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="info-box bg-purple" style="border-radius:8px;">
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo app('translator')->get('tailorpro::lang.total_orders'); ?></span>
                            <span class="info-box-number" id="rpt_total_orders">0</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box bg-green" style="border-radius:8px;">
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo app('translator')->get('tailorpro::lang.completed_orders'); ?></span>
                            <span class="info-box-number" id="rpt_completed">0</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box bg-yellow" style="border-radius:8px;">
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo app('translator')->get('tailorpro::lang.pending_orders'); ?></span>
                            <span class="info-box-number" id="rpt_pending">0</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box bg-aqua" style="border-radius:8px;">
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo app('translator')->get('tailorpro::lang.total_revenue'); ?></span>
                            <span class="info-box-number" id="rpt_revenue">0</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover" id="order_report_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('tailorpro::lang.order_no'); ?></th>
                            <th><?php echo app('translator')->get('role.customer'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.garment_type'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.tailor'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.status'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.total_cost'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.order_date'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.delivery_date'); ?></th>
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
    $('#or_tailor_filter').select2();

    $('#order_report_date_range').daterangepicker({
        autoUpdateInput: false,
        locale: { cancelLabel: 'Clear' }
    });
    $('#order_report_date_range').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });
    $('#order_report_date_range').on('cancel.daterangepicker', function() {
        $(this).val('');
    });

    var report_table = $('#order_report_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?php echo e(action([\Modules\TailorPro\Http\Controllers\ReportController::class, "orderReport"]), false); ?>',
            data: function (d) {
                d.date_range = $('#order_report_date_range').val();
                d.status_id = $('#or_status_filter').val();
                d.tailor_id = $('#or_tailor_filter').val();
            },
            dataSrc: function (json) {
                if (json.summary) {
                    $('#rpt_total_orders').text(json.summary.total);
                    $('#rpt_completed').text(json.summary.completed);
                    $('#rpt_pending').text(json.summary.pending);
                    $('#rpt_revenue').text(json.summary.revenue);
                }
                return json.data;
            }
        },
        columns: [
            { data: 'order_no', name: 'order_no' },
            { data: 'customer_name', name: 'customer.name' },
            { data: 'garment_type', name: 'garment_type' },
            { data: 'tailor_name', name: 'tailor.first_name' },
            { data: 'status', name: 'status.name' },
            { data: 'total_cost', name: 'total_cost' },
            { data: 'order_date', name: 'order_date' },
            { data: 'delivery_date', name: 'delivery_date' }
        ]
    });

    $('#apply_order_report_filter').on('click', function () {
        report_table.ajax.reload();
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>