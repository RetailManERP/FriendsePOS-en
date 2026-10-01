
<?php $__env->startSection('title', __('manufacturing::lang.quality_inspections')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('manufacturing::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><i class="fas fa-clipboard-check"></i> <?php echo app('translator')->get('manufacturing::lang.quality_inspections'); ?></h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('qc_filter_status', __('sale.status') . ':'); ?>

                <?php echo Form::select('qc_filter_status', ['' => __('lang_v1.all'), 'pending' => __('manufacturing::lang.qc_pending'), 'passed' => __('manufacturing::lang.qc_passed'), 'failed' => __('manufacturing::lang.qc_failed'), 'conditional' => __('manufacturing::lang.qc_conditional')], null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('qc_filter_date_range', __('report.date_range') . ':'); ?>

                <?php echo Form::text('qc_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manufacturing.add_quality_inspection')): ?>
                <a class="btn btn-block btn-primary" href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\QualityInspectionController::class, 'create']), false); ?>">
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get('manufacturing::lang.add_inspection'); ?></a>
                <?php endif; ?>
            </div>
        <?php $__env->endSlot(); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-th-skin" id="qc_inspections_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                        <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                        <th><?php echo app('translator')->get('sale.product'); ?></th>
                        <th><?php echo app('translator')->get('manufacturing::lang.inspector'); ?></th>
                        <th><?php echo app('translator')->get('manufacturing::lang.batch_number'); ?></th>
                        <th><?php echo app('translator')->get('sale.status'); ?></th>
                        <th><?php echo app('translator')->get('messages.action'); ?></th>
                    </tr>
                </thead>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>
</section>

<div class="modal fade view_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function() {
    var qc_table = $('#qc_inspections_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?php echo e(action([\Modules\Manufacturing\Http\Controllers\QualityInspectionController::class, "index"]), false); ?>',
            data: function(d) {
                d.status = $('#qc_filter_status').val();
                var date_range = $('#qc_filter_date_range').val();
                if (date_range) {
                    var dates = date_range.split(' ~ ');
                    d.start_date = dates[0];
                    d.end_date = dates[1];
                }
            }
        },
        columns: [
            { data: 'inspection_date', name: 'mfg_quality_inspections.inspection_date' },
            { data: 'ref_no', name: 'transactions.ref_no' },
            { data: 'product_name', name: 'product_name', orderable: false },
            { data: 'inspector_name', name: 'inspector_name', orderable: false },
            { data: 'batch_number', name: 'mfg_quality_inspections.batch_number' },
            { data: 'status', name: 'mfg_quality_inspections.status' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        order: [[0, 'desc']]
    });

    $('#qc_filter_status, #qc_filter_date_range').on('change', function() {
        qc_table.ajax.reload();
    });

    if ($('#qc_filter_date_range').length) {
        $('#qc_filter_date_range').daterangepicker(dateRangeSettings, function(start, end) {
            $('#qc_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            qc_table.ajax.reload();
        });
        $('#qc_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            qc_table.ajax.reload();
        });
    }

    // Delete QC inspection
    $(document).on('click', '.delete_qc_inspection', function(e) {
        e.preventDefault();
        swal({
            title: LANG.sure,
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var href = $(this).data('href');
                $.ajax({
                    method: 'DELETE',
                    url: href,
                    dataType: 'json',
                    success: function(result) {
                        if (result.success) {
                            toastr.success(result.msg);
                            qc_table.ajax.reload();
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