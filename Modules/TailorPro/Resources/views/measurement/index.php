
<?php $__env->startSection('title', __('tailorpro::lang.measurements')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('tailorpro::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header no-print">
    <h1>
        <i class="fas fa-ruler-combined" style="color:#6f42c1;"></i> <?php echo app('translator')->get('tailorpro::lang.measurements'); ?>
    </h1>
</section>

<section class="content no-print">
    <div class="box" style="border-radius:10px;">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo app('translator')->get('tailorpro::lang.all_measurements'); ?></h3>
            <div class="box-tools">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tailorpro_measurement.create')): ?>
                <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\MeasurementController::class, 'create']), false); ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus-circle"></i> <?php echo app('translator')->get('tailorpro::lang.add_measurement'); ?>
                </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover" id="measurements_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('role.customer'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.type'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.version'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.date'); ?></th>
                            <th><?php echo app('translator')->get('messages.action'); ?></th>
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
    var measurements_table = $("#measurements_table").DataTable({
        processing: true,
        serverSide: true,
        ajax: '<?php echo e(action([\Modules\TailorPro\Http\Controllers\MeasurementController::class, "index"]), false); ?>',
        columns: [
            { data: 'customer_name', name: 'contacts.name' },
            { data: 'type', name: 'type' },
            { data: 'version', name: 'version' },
            { data: 'created_at', name: 'created_at', searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
    });

    $(document).on('click', '.delete_measurement', function(e) {
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
                            measurements_table.ajax.reload();
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