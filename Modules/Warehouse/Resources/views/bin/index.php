
<?php $__env->startSection('title', __('warehouse::lang.bin_locations') . ' - ' . $warehouse->name); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('warehouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('warehouse::lang.bin_locations'); ?>
        <small><?php echo e($warehouse->name, false); ?></small>
    </h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addBinModal">
                    <i class="fas fa-plus"></i> <?php echo app('translator')->get('warehouse::lang.add_bin_location'); ?>
                </button>
            </div>
        <?php $__env->endSlot(); ?>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo app('translator')->get('warehouse::lang.bin_code'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.zone_name'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.bin_aisle'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.bin_rack'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.bin_shelf'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.bin_number'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.is_pickable'); ?></th>
                    <th><?php echo app('translator')->get('messages.action'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $bins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration, false); ?></td>
                        <td><?php echo e($bin->code ?? $bin->location_label, false); ?></td>
                        <td><?php echo e(optional($bin->zone)->name ?? '-', false); ?></td>
                        <td><?php echo e($bin->aisle ?? '-', false); ?></td>
                        <td><?php echo e($bin->rack ?? '-', false); ?></td>
                        <td><?php echo e($bin->shelf ?? '-', false); ?></td>
                        <td><?php echo e($bin->bin ?? '-', false); ?></td>
                        <td>
                            <?php if($bin->is_pickable): ?>
                                <span class="badge bg-success"><?php echo app('translator')->get('messages.yes'); ?></span>
                            <?php else: ?>
                                <span class="badge bg-danger"><?php echo app('translator')->get('messages.no'); ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button class="btn btn-info btn-xs edit-bin" data-url="<?php echo e(route('warehouse.bins.edit', [$warehouse->id, $bin->id]), false); ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="<?php echo e(route('warehouse.bins.destroy', [$warehouse->id, $bin->id]), false); ?>" class="btn btn-danger btn-xs delete-bin">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php echo $__env->renderComponent(); ?>

    <!-- Add Bin Modal -->
    <div class="modal fade" id="addBinModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php echo Form::open(['route' => ['warehouse.bins.store', $warehouse->id], 'method' => 'POST']); ?>

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php echo app('translator')->get('warehouse::lang.add_bin_location'); ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <?php echo Form::label('zone_id', __('warehouse::lang.zone_name') . ':'); ?>

                        <?php echo Form::select('zone_id', $zones, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

                    </div>
                    <div class="form-group">
                        <?php echo Form::label('code', __('warehouse::lang.bin_code') . ':'); ?>

                        <?php echo Form::text('code', null, ['class' => 'form-control']); ?>

                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('aisle', __('warehouse::lang.bin_aisle') . ':'); ?>

                                <?php echo Form::text('aisle', null, ['class' => 'form-control']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('rack', __('warehouse::lang.bin_rack') . ':'); ?>

                                <?php echo Form::text('rack', null, ['class' => 'form-control']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('shelf', __('warehouse::lang.bin_shelf') . ':'); ?>

                                <?php echo Form::text('shelf', null, ['class' => 'form-control']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('bin', __('warehouse::lang.bin_number') . ':'); ?>

                                <?php echo Form::text('bin', null, ['class' => 'form-control']); ?>

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('is_pickable', 1, true); ?> <?php echo app('translator')->get('warehouse::lang.is_pickable'); ?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.save'); ?></button>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).on('click', '.delete-bin', function(e) {
        e.preventDefault();
        swal({ title: LANG.sure, icon: 'warning', buttons: true, dangerMode: true }).then((willDelete) => {
            if (willDelete) {
                $.ajax({ url: $(this).attr('href'), method: 'DELETE', dataType: 'json',
                    success: function(result) {
                        if (result.success) { toastr.success(result.msg); location.reload(); } else { toastr.error(result.msg); }
                    }
                });
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>