
<?php $__env->startSection('title', __('tailorpro::lang.statuses')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('tailorpro::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header no-print">
    <h1><i class="fas fa-tags" style="color:#6f42c1;"></i> <?php echo app('translator')->get('tailorpro::lang.statuses'); ?></h1>
</section>

<section class="content no-print">
    <div class="box" style="border-radius:10px;">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo app('translator')->get('tailorpro::lang.manage_statuses'); ?></h3>
            <div class="box-tools">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tailorpro_status.create')): ?>
                <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\StatusController::class, 'create']), false); ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus-circle"></i> <?php echo app('translator')->get('tailorpro::lang.add_status'); ?>
                </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover" id="statuses_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('tailorpro::lang.status_name'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.color'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.sort_order'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.is_completed'); ?></th>
                            <th><?php echo app('translator')->get('messages.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <span class="label" style="background-color:<?php echo e($status->color, false); ?>;"><?php echo e($status->name, false); ?></span>
                            </td>
                            <td><?php echo e($status->color, false); ?></td>
                            <td><?php echo e($status->sort_order, false); ?></td>
                            <td>
                                <?php if($status->is_completed_status): ?>
                                    <span class="label label-success"><?php echo app('translator')->get('messages.yes'); ?></span>
                                <?php else: ?>
                                    <span class="label label-default"><?php echo app('translator')->get('messages.no'); ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tailorpro_status.update')): ?>
                                <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\StatusController::class, 'edit'], [$status->id]), false); ?>" class="btn btn-xs btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tailorpro_status.delete')): ?>
                                <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\StatusController::class, 'destroy'], [$status->id]), false); ?>" class="btn btn-xs btn-danger delete_status">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <?php endif; ?>
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
<script type="text/javascript">
$(document).ready(function () {
    $(document).on('click', '.delete_status', function(e) {
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
                            location.reload();
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