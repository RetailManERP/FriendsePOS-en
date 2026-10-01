
<?php $__env->startSection('title', __('warehouse::lang.warehouses')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('warehouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('warehouse::lang.warehouses'); ?>
        <small><?php echo app('translator')->get('warehouse::lang.warehouse_management'); ?></small>
    </h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('warehouse.create')): ?>
                    <?php if(!empty($can_create_warehouse)): ?>
                    <a class="btn btn-block btn-primary" href="<?php echo e(route('warehouse.create'), false); ?>">
                        <i class="fas fa-plus"></i> <?php echo app('translator')->get('warehouse::lang.add_warehouse'); ?>
                    </a>
                    <?php else: ?>
                    <button class="btn btn-block btn-primary disabled" title="<?php echo app('translator')->get('superadmin::lang.max_warehouses'); ?>">
                        <i class="fas fa-plus"></i> <?php echo app('translator')->get('warehouse::lang.add_warehouse'); ?>
                    </button>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php $__env->endSlot(); ?>

        <table class="table table-bordered table-striped" id="warehouses_table">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo app('translator')->get('warehouse::lang.warehouse_name'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.warehouse_code'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.warehouse_type'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.business_location'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.warehouse_manager'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.active'); ?></th>
                    <th><?php echo app('translator')->get('messages.action'); ?></th>
                </tr>
            </thead>
        </table>
    <?php echo $__env->renderComponent(); ?>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        var warehouses_table = $('#warehouses_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?php echo e(route("warehouse.list"), false); ?>',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'location_id', name: 'location_id' },
                { data: 'warehouse_type', name: 'warehouse_type' },
                { data: 'location_name', name: 'location_name', orderable: false, searchable: false },
                { data: 'manager_name', name: 'manager_name', orderable: false, searchable: false },
                { data: 'is_active', name: 'is_active' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        $(document).on('click', '.delete-warehouse', function(e) {
            e.preventDefault();
            swal({
                title: LANG.sure,
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    var href = $(this).attr('href');
                    $.ajax({
                        url: href,
                        method: 'DELETE',
                        dataType: 'json',
                        success: function(result) {
                            if (result.success) {
                                toastr.success(result.msg);
                                warehouses_table.ajax.reload();
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