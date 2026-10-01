
<?php $__env->startSection('title', __('tailorpro::lang.measurement_templates')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('tailorpro::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header no-print">
    <h1><i class="fas fa-drafting-compass" style="color:#6f42c1;"></i> <?php echo app('translator')->get('tailorpro::lang.measurement_templates'); ?></h1>
</section>

<section class="content no-print">
    <div class="box" style="border-radius:10px;">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo app('translator')->get('tailorpro::lang.all_measurement_templates'); ?></h3>
            <div class="box-tools">
                <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\MeasurementTemplateController::class, 'create']), false); ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus-circle"></i> <?php echo app('translator')->get('tailorpro::lang.add_measurement_template'); ?>
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover" id="tailorpro_templates_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('tailorpro::lang.template_name'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.garment_type'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.template_fields'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.is_default'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.sort_order'); ?></th>
                            <th><?php echo app('translator')->get('messages.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($template->name, false); ?></td>
                            <td><?php echo e(ucfirst($template->garment_type ?? '-'), false); ?></td>
                            <td><span class="badge badge-info"><?php echo e(is_array($template->fields) ? count($template->fields) : 0, false); ?> fields</span></td>
                            <td><?php echo $template->is_default ? '<i class="fas fa-check text-success"></i>' : ''; ?></td>
                            <td><?php echo e($template->sort_order, false); ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\MeasurementTemplateController::class, 'edit'], [$template->id]), false); ?>" class="btn btn-xs btn-primary"><i class="fas fa-edit"></i></a>
                                    <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\MeasurementTemplateController::class, 'destroy'], [$template->id]), false); ?>" class="btn btn-xs btn-danger delete_template"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function () {
    $('#tailorpro_templates_table').DataTable({ ordering: true, searching: true });
    $(document).on('click', '.delete_template', function(e) {
        e.preventDefault();
        swal({ title: LANG.sure, icon: "warning", buttons: true, dangerMode: true }).then((willDelete) => {
            if (willDelete) {
                $.ajax({ method: "DELETE", url: $(this).attr('href'), dataType: "json", success: function(r) { if (r.success) { toastr.success(r.msg); location.reload(); } else { toastr.error(r.msg); } } });
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>