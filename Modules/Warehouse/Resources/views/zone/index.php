
<?php $__env->startSection('title', __('warehouse::lang.zones') . ' - ' . $warehouse->name); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('warehouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('warehouse::lang.zones'); ?>
        <small><?php echo e($warehouse->name, false); ?></small>
    </h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addZoneModal">
                    <i class="fas fa-plus"></i> <?php echo app('translator')->get('warehouse::lang.add_zone'); ?>
                </button>
            </div>
        <?php $__env->endSlot(); ?>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo app('translator')->get('warehouse::lang.zone_name'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.zone_code'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.zone_type'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.bin_locations'); ?></th>
                    <th><?php echo app('translator')->get('messages.action'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $zones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration, false); ?></td>
                        <td><?php echo e($zone->name, false); ?></td>
                        <td><?php echo e($zone->code ?? '-', false); ?></td>
                        <td><?php echo app('translator')->get('warehouse::lang.zone_type_' . $zone->type); ?></td>
                        <td><?php echo e($zone->binLocations->count(), false); ?></td>
                        <td>
                            <button class="btn btn-info btn-xs edit-zone" data-url="<?php echo e(route('warehouse.zones.edit', [$warehouse->id, $zone->id]), false); ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="<?php echo e(route('warehouse.zones.destroy', [$warehouse->id, $zone->id]), false); ?>" class="btn btn-danger btn-xs delete-zone">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php echo $__env->renderComponent(); ?>

    <!-- Add Zone Modal -->
    <div class="modal fade" id="addZoneModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php echo Form::open(['route' => ['warehouse.zones.store', $warehouse->id], 'method' => 'POST']); ?>

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php echo app('translator')->get('warehouse::lang.add_zone'); ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <?php echo Form::label('name', __('warehouse::lang.zone_name') . ':*'); ?>

                        <?php echo Form::text('name', null, ['class' => 'form-control', 'required']); ?>

                    </div>
                    <div class="form-group">
                        <?php echo Form::label('code', __('warehouse::lang.zone_code') . ':'); ?>

                        <?php echo Form::text('code', null, ['class' => 'form-control']); ?>

                    </div>
                    <div class="form-group">
                        <?php echo Form::label('type', __('warehouse::lang.zone_type') . ':*'); ?>

                        <?php echo Form::select('type', $zone_types, null, ['class' => 'form-control', 'required']); ?>

                    </div>
                    <div class="form-group">
                        <?php echo Form::label('description', __('warehouse::lang.zone_description') . ':'); ?>

                        <?php echo Form::textarea('description', null, ['class' => 'form-control', 'rows' => 2]); ?>

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
    $(document).on('click', '.delete-zone', function(e) {
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