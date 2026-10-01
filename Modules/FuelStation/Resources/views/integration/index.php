
<?php $__env->startSection('title', __('fuelstation::lang.dispenser_integration')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('fuelstation::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header"><h1><?php echo app('translator')->get('fuelstation::lang.dispenser_integration'); ?></h1></section>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('fuelstation::lang.dispenser_integration')]); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <a href="<?php echo e(action([\Modules\FuelStation\Http\Controllers\FuelIntegrationController::class, 'create']), false); ?>" class="btn btn-block btn-primary"><i class="fa fa-plus"></i> <?php echo app('translator')->get('fuelstation::lang.add_integration'); ?></a>
            </div>
        <?php $__env->endSlot(); ?>
        <div class="callout callout-info">
            <p><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('fuelstation::lang.integration_help'); ?></p>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="fuel_integration_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('fuelstation::lang.dispenser'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.brand'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.machine_model'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.protocol'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.active'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.sync_status'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.last_reading_at'); ?></th>
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
    var table = $('#fuel_integration_table').DataTable({
        processing: true, serverSide: true,
        ajax: { url: '<?php echo e(action([\Modules\FuelStation\Http\Controllers\FuelIntegrationController::class, 'index']), false); ?>' },
        columns: [
            { data: 'dispenser_name', name: 'dispenser_name', orderable: false },
            { data: 'brand', name: 'brand' },
            { data: 'machine_model', name: 'machine_model' },
            { data: 'protocol', name: 'protocol' },
            { data: 'is_active', name: 'is_active' },
            { data: 'sync_status', name: 'sync_status' },
            { data: 'last_reading_at', name: 'last_reading_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
    });

    $(document).on('click', '.test-read', function (e) {
        e.preventDefault();
        var btn = $(this);
        var href = btn.data('href');
        btn.prop('disabled', true);
        $.ajax({ method: 'POST', url: href, dataType: 'json', data: { _token: '<?php echo e(csrf_token(), false); ?>' },
            success: function (result) {
                if (result.success) { toastr.success(result.msg); }
                else { toastr.warning(result.msg); }
                table.ajax.reload();
            },
            error: function () { toastr.error('<?php echo e(__('messages.something_went_wrong'), false); ?>'); },
            complete: function () { btn.prop('disabled', false); }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>