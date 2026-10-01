
<?php $__env->startSection('title', __('fuelstation::lang.tank_adjustments')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('fuelstation::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header"><h1><?php echo app('translator')->get('fuelstation::lang.tank_adjustments'); ?></h1></section>

<section class="content">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <div class="col-md-4">
            <div class="form-group">
                <?php echo Form::label('filter_location_id', __('fuelstation::lang.location') . ':'); ?>

                <?php echo Form::select('filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('fuelstation::lang.all')]); ?>

            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php echo Form::label('filter_status', __('fuelstation::lang.status') . ':'); ?>

                <?php echo Form::select('filter_status', ['pending' => __('fuelstation::lang.status_pending'), 'approved' => __('fuelstation::lang.status_approved'), 'rejected' => __('fuelstation::lang.status_rejected')], null, ['class' => 'form-control', 'placeholder' => __('fuelstation::lang.all')]); ?>

            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('fuelstation::lang.tank_adjustments')]); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <a href="<?php echo e(action([\Modules\FuelStation\Http\Controllers\FuelTankAdjustmentController::class, 'create']), false); ?>" class="btn btn-block btn-primary"><i class="fa fa-plus"></i> <?php echo app('translator')->get('fuelstation::lang.add_adjustment'); ?></a>
            </div>
        <?php $__env->endSlot(); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="fuel_adjustments_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('fuelstation::lang.ref_no'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.tank'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.type'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.quantity'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.adjustment_date'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.status'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.actions'); ?></th>
                    </tr>
                </thead>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(function () {
    var table = $('#fuel_adjustments_table').DataTable({
        processing: true, serverSide: true,
        ajax: {
            url: '<?php echo e(action([\Modules\FuelStation\Http\Controllers\FuelTankAdjustmentController::class, 'index']), false); ?>',
            data: function (d) { d.location_id = $('#filter_location_id').val(); d.status = $('#filter_status').val(); }
        },
        columns: [
            { data: 'ref_no', name: 'ref_no' },
            { data: 'tank_name', name: 'tank_name', orderable: false },
            { data: 'type', name: 'type' },
            { data: 'quantity', name: 'quantity' },
            { data: 'adjustment_date', name: 'adjustment_date' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
    });
    $('#filter_location_id, #filter_status').change(function () { table.ajax.reload(); });

    $(document).on('click', '.decide-adjustment', function (e) {
        e.preventDefault();
        var href = $(this).data('href');
        var decision = $(this).data('decision');
        swal({ title: LANG.sure, icon: 'warning', buttons: true, dangerMode: true }).then(c => {
            if (c) {
                $.ajax({ method: 'POST', url: href, dataType: 'json', data: { _token: '<?php echo e(csrf_token(), false); ?>', decision: decision },
                    success: function (result) {
                        if (result.success) { toastr.success(result.msg); table.ajax.reload(); }
                        else { toastr.error(result.msg); }
                    }
                });
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>