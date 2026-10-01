
<?php $__env->startSection('title', __('tailorpro::lang.custom_fields')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('tailorpro::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header no-print">
    <h1><i class="fas fa-sliders-h" style="color:#6f42c1;"></i> <?php echo app('translator')->get('tailorpro::lang.custom_fields'); ?></h1>
</section>

<section class="content no-print">
    <div class="box" style="border-radius:10px;">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo app('translator')->get('tailorpro::lang.all_custom_fields'); ?></h3>
            <div class="box-tools">
                <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\CustomFieldController::class, 'create']), false); ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus-circle"></i> <?php echo app('translator')->get('tailorpro::lang.add_custom_field'); ?>
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover" id="tailorpro_custom_fields_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('tailorpro::lang.field_label'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.field_name'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.field_type'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.entity_type'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.is_required'); ?></th>
                            <th><?php echo app('translator')->get('sale.status'); ?></th>
                            <th><?php echo app('translator')->get('messages.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($field->field_label, false); ?></td>
                            <td><code><?php echo e($field->field_name, false); ?></code></td>
                            <td><span class="badge badge-info"><?php echo e(ucfirst($field->field_type), false); ?></span></td>
                            <td><?php echo e(ucfirst(str_replace('_', ' ', $field->entity_type)), false); ?></td>
                            <td><?php echo $field->is_required ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-muted"></i>'; ?></td>
                            <td>
                                <span class="badge badge-<?php echo e($field->is_active ? 'success' : 'secondary', false); ?>">
                                    <?php echo e($field->is_active ? __('tailorpro::lang.active') : __('tailorpro::lang.inactive'), false); ?>

                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\CustomFieldController::class, 'edit'], [$field->id]), false); ?>" class="btn btn-xs btn-primary"><i class="fas fa-edit"></i></a>
                                    <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\CustomFieldController::class, 'destroy'], [$field->id]), false); ?>" class="btn btn-xs btn-danger delete_custom_field"><i class="fas fa-trash"></i></a>
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
    $('#tailorpro_custom_fields_table').DataTable({ ordering: true, searching: true });
    $(document).on('click', '.delete_custom_field', function(e) {
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