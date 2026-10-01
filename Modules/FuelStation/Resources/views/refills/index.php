
<?php $__env->startSection('title', __('fuelstation::lang.tank_refills')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('fuelstation::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header"><h1><?php echo app('translator')->get('fuelstation::lang.tank_refills'); ?></h1></section>

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
                <?php echo Form::label('filter_tank_id', __('fuelstation::lang.tank') . ':'); ?>

                <?php echo Form::select('filter_tank_id', $tanks, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('fuelstation::lang.all')]); ?>

            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('fuelstation::lang.tank_refills')]); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <a href="<?php echo e(action([\Modules\FuelStation\Http\Controllers\FuelTankRefillController::class, 'create']), false); ?>" class="btn btn-block btn-primary"><i class="fa fa-plus"></i> <?php echo app('translator')->get('fuelstation::lang.add_refill'); ?></a>
            </div>
        <?php $__env->endSlot(); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="fuel_refills_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('fuelstation::lang.ref_no'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.tank'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.supplier'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.quantity'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.total_amount'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.refill_date'); ?></th>
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
    var table = $('#fuel_refills_table').DataTable({
        processing: true, serverSide: true,
        ajax: {
            url: '<?php echo e(action([\Modules\FuelStation\Http\Controllers\FuelTankRefillController::class, 'index']), false); ?>',
            data: function (d) { d.location_id = $('#filter_location_id').val(); d.tank_id = $('#filter_tank_id').val(); }
        },
        columns: [
            { data: 'ref_no', name: 'ref_no' },
            { data: 'tank_name', name: 'tank_name', orderable: false },
            { data: 'supplier_name', name: 'supplier_name', orderable: false },
            { data: 'quantity', name: 'quantity' },
            { data: 'total_amount', name: 'total_amount' },
            { data: 'refill_date', name: 'refill_date' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        createdRow: function (row) { __currency_convert_recursively($(row)); }
    });
    $('#filter_location_id, #filter_tank_id').change(function () { table.ajax.reload(); });

    $(document).on('click', '.delete-refill', function (e) {
        e.preventDefault();
        var href = $(this).data('href');
        swal({ title: LANG.sure, icon: 'warning', buttons: true, dangerMode: true }).then(c => {
            if (c) {
                $.ajax({ method: 'DELETE', url: href, dataType: 'json', data: { _token: '<?php echo e(csrf_token(), false); ?>' },
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