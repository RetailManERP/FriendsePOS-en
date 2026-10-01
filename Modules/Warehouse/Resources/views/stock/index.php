
<?php $__env->startSection('title', __('warehouse::lang.warehouse_stock')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('warehouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('warehouse::lang.warehouse_stock'); ?>
        <small><?php echo app('translator')->get('warehouse::lang.stock_overview'); ?></small>
    </h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('warehouse.stock.adjust')): ?>
                    <a class="btn btn-primary btn-sm" href="<?php echo e(route('warehouse.stock.adjust'), false); ?>">
                        <i class="fas fa-sliders-h"></i> <?php echo app('translator')->get('warehouse::lang.adjust_stock'); ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php $__env->endSlot(); ?>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo app('translator')->get('warehouse::lang.select_warehouse'); ?>:</label>
                    <select class="form-control select2" id="warehouse_filter">
                        <option value=""><?php echo app('translator')->get('warehouse::lang.all_warehouses'); ?></option>
                        <?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($id, false); ?>" <?php echo e($warehouse_id == $id ? 'selected' : '', false); ?>><?php echo e($name, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>

        <table class="table table-bordered table-striped" id="stock_table">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('warehouse::lang.warehouse'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.product'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.sku'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.quantity'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.reserved'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.available'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.expiry_date'); ?></th>
                </tr>
            </thead>
        </table>
    <?php echo $__env->renderComponent(); ?>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        var stock_table = $('#stock_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?php echo e(route("warehouse.stock"), false); ?>',
                data: function(d) {
                    d.warehouse_id = $('#warehouse_filter').val();
                }
            },
            columns: [
                { data: 'warehouse_name', name: 'warehouses.name' },
                { data: 'product_display', name: 'products.name' },
                { data: 'sku', name: 'variations.sub_sku' },
                { data: 'quantity', name: 'quantity' },
                { data: 'reserved_quantity', name: 'reserved_quantity' },
                { data: 'available', name: 'available', orderable: false, searchable: false },
                { data: 'expiry_date', name: 'expiry_date' },
            ]
        });

        $('#warehouse_filter').change(function() {
            stock_table.ajax.reload();
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>