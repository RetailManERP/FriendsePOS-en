
<?php $__env->startSection('title', __('fuelstation::lang.shifts')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('fuelstation::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header"><h1><?php echo app('translator')->get('fuelstation::lang.shifts'); ?></h1></section>

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

                <?php echo Form::select('filter_status', ['open' => __('fuelstation::lang.shift_status_open'), 'closed' => __('fuelstation::lang.shift_status_closed'), 'approved' => __('fuelstation::lang.shift_status_approved')], null, ['class' => 'form-control', 'placeholder' => __('fuelstation::lang.all')]); ?>

            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('fuelstation::lang.shifts')]); ?>
        <?php $__env->slot('tool'); ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('fuelstation.open_shift')): ?>
            <div class="box-tools">
                <a href="<?php echo e(action([\Modules\FuelStation\Http\Controllers\FuelShiftController::class, 'create']), false); ?>" class="btn btn-block btn-primary"><i class="fa fa-plus"></i> <?php echo app('translator')->get('fuelstation::lang.open_shift'); ?></a>
            </div>
            <?php endif; ?>
        <?php $__env->endSlot(); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="fuel_shifts_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('fuelstation::lang.shift_no'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.operator'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.location'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.dispenser'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.start_time'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.end_time'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.total_amount'); ?></th>
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
    var table = $('#fuel_shifts_table').DataTable({
        processing: true, serverSide: true,
        ajax: {
            url: '<?php echo e(action([\Modules\FuelStation\Http\Controllers\FuelShiftController::class, 'index']), false); ?>',
            data: function (d) {
                d.location_id = $('#filter_location_id').val();
                d.status = $('#filter_status').val();
            }
        },
        columns: [
            { data: 'shift_no', name: 'shift_no' },
            { data: 'operator_name', name: 'operator_name', orderable: false },
            { data: 'location_name', name: 'location_name', orderable: false },
            { data: 'dispenser_name', name: 'dispenser_name', orderable: false },
            { data: 'start_time', name: 'start_time' },
            { data: 'end_time', name: 'end_time' },
            { data: 'total_amount', name: 'total_amount' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        createdRow: function (row) { __currency_convert_recursively($(row)); }
    });
    $('#filter_location_id, #filter_status').change(function () { table.ajax.reload(); });

    $(document).on('click', '.approve-shift', function (e) {
        e.preventDefault();
        var href = $(this).data('href');
        swal({ title: LANG.sure, icon: 'warning', buttons: true, dangerMode: true }).then(confirmed => {
            if (confirmed) {
                $.ajax({ method: 'POST', url: href, dataType: 'json', data: { _token: '<?php echo e(csrf_token(), false); ?>' },
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