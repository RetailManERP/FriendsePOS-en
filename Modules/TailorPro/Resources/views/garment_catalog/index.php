
<?php $__env->startSection('title', __('tailorpro::lang.garment_catalog')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('tailorpro::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header no-print">
    <h1>
        <i class="fas fa-tshirt" style="color:#6f42c1;"></i> <?php echo app('translator')->get('tailorpro::lang.garment_catalog'); ?>
    </h1>
</section>

<section class="content no-print">
    <div class="box" style="border-radius:10px;">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo app('translator')->get('tailorpro::lang.all_catalog_items'); ?></h3>
            <div class="box-tools">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tailorpro_catalog.create')): ?>
                <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\GarmentCatalogController::class, 'create']), false); ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus-circle"></i> <?php echo app('translator')->get('tailorpro::lang.add_catalog_item'); ?>
                </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover" id="tailorpro_catalog_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('tailorpro::lang.catalog_image'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.catalog_name'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.default_price'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.linked_template'); ?></th>
                            <th><?php echo app('translator')->get('tailorpro::lang.sort_order'); ?></th>
                            <th><?php echo app('translator')->get('sale.status'); ?></th>
                            <th><?php echo app('translator')->get('messages.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $catalog_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php if($item->image): ?>
                                    <img src="<?php echo e(asset($item->image), false); ?>" alt="" style="width:50px;height:50px;object-fit:cover;border-radius:6px;">
                                <?php else: ?>
                                    <span class="text-muted"><i class="fas fa-image"></i></span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($item->name, false); ?></td>
                            <td><?php echo e(number_format($item->default_price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                            <td><?php echo e($item->measurementTemplate->name ?? '-', false); ?></td>
                            <td><?php echo e($item->sort_order, false); ?></td>
                            <td>
                                <span class="badge badge-<?php echo e($item->is_active ? 'success' : 'secondary', false); ?>">
                                    <?php echo e($item->is_active ? __('tailorpro::lang.active') : __('tailorpro::lang.inactive'), false); ?>

                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tailorpro_catalog.edit')): ?>
                                    <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\GarmentCatalogController::class, 'edit'], [$item->id]), false); ?>" class="btn btn-xs btn-primary" title="<?php echo app('translator')->get('messages.edit'); ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tailorpro_catalog.delete')): ?>
                                    <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\GarmentCatalogController::class, 'destroy'], [$item->id]), false); ?>" class="btn btn-xs btn-danger delete_catalog_item" title="<?php echo app('translator')->get('messages.delete'); ?>">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <?php endif; ?>
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
<script type="text/javascript">
$(document).ready(function () {
    $('#tailorpro_catalog_table').DataTable({ ordering: true, searching: true });

    $(document).on('click', '.delete_catalog_item', function(e) {
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