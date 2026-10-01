
<?php $__env->startSection('title', __('tailorpro::lang.tailor_performance_report')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('tailorpro::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><i class="fas fa-user-tie" style="color:#6f42c1;"></i> <?php echo app('translator')->get('tailorpro::lang.tailor_performance_report'); ?></h1>
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
                        <input type="text" class="form-control" id="tp_date_range" placeholder="<?php echo app('translator')->get('tailorpro::lang.select_date_range'); ?>" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><?php echo app('translator')->get('tailorpro::lang.tailor'); ?>:</label>
                        <?php echo Form::select('tailor_id', $tailors, null, ['class' => 'form-control select2', 'id' => 'tp_tailor_filter', 'placeholder' => __('messages.all')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>&nbsp;</label><br>
                        <button type="button" class="btn btn-primary" id="apply_tp_filter">
                            <i class="fas fa-filter"></i> <?php echo app('translator')->get('tailorpro::lang.apply_filter'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="box" style="border-radius:10px;">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo app('translator')->get('tailorpro::lang.performance_summary'); ?></h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover" id="tailor_perf_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('tailorpro::lang.tailor'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.total_assigned'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.completed'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.pending'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.overdue'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.avg_completion_days'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.total_revenue'); ?></th>
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
    $('#tp_tailor_filter').select2();

    $('#tp_date_range').daterangepicker({
        autoUpdateInput: false,
        locale: { cancelLabel: 'Clear' }
    });
    $('#tp_date_range').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });
    $('#tp_date_range').on('cancel.daterangepicker', function() {
        $(this).val('');
    });

    var tp_table = $('#tailor_perf_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?php echo e(action([\Modules\TailorPro\Http\Controllers\ReportController::class, "tailorPerformance"]), false); ?>',
            data: function (d) {
                d.date_range = $('#tp_date_range').val();
                d.tailor_id = $('#tp_tailor_filter').val();
            }
        },
        columns: [
            { data: 'tailor_name', name: 'tailor_name' },
            { data: 'total_assigned', name: 'total_assigned', searchable: false },
            { data: 'completed', name: 'completed', searchable: false },
            { data: 'pending', name: 'pending', searchable: false },
            { data: 'overdue', name: 'overdue', searchable: false },
            { data: 'avg_days', name: 'avg_days', searchable: false },
            { data: 'total_revenue', name: 'total_revenue', searchable: false }
        ]
    });

    $('#apply_tp_filter').on('click', function () {
        tp_table.ajax.reload();
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>