
<?php $__env->startSection('title', __('warehouse::lang.stock_movements')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('warehouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('warehouse::lang.stock_movements'); ?></h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label><?php echo app('translator')->get('warehouse::lang.select_warehouse'); ?>:</label>
                    <select class="form-control select2" id="warehouse_filter">
                        <option value=""><?php echo app('translator')->get('warehouse::lang.all_warehouses'); ?></option>
                        <?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($id, false); ?>"><?php echo e($name, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label><?php echo app('translator')->get('warehouse::lang.movement_type'); ?>:</label>
                    <select class="form-control select2" id="type_filter">
                        <option value=""><?php echo app('translator')->get('messages.all'); ?></option>
                        <option value="receive"><?php echo app('translator')->get('warehouse::lang.movement_receive'); ?></option>
                        <option value="issue"><?php echo app('translator')->get('warehouse::lang.movement_issue'); ?></option>
                        <option value="transfer_in"><?php echo app('translator')->get('warehouse::lang.movement_transfer_in'); ?></option>
                        <option value="transfer_out"><?php echo app('translator')->get('warehouse::lang.movement_transfer_out'); ?></option>
                        <option value="adjustment_add"><?php echo app('translator')->get('warehouse::lang.movement_adjustment_add'); ?></option>
                        <option value="adjustment_subtract"><?php echo app('translator')->get('warehouse::lang.movement_adjustment_subtract'); ?></option>
                        <option value="damage"><?php echo app('translator')->get('warehouse::lang.movement_damage'); ?></option>
                        <option value="expired"><?php echo app('translator')->get('warehouse::lang.movement_expired'); ?></option>
                    </select>
                </div>
            </div>
        </div>

        <table class="table table-bordered table-striped" id="movements_table">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('messages.date'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.warehouse'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.product'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.movement_type'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.quantity'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.lot_number'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.warehouse_notes'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                </tr>
            </thead>
        </table>
    <?php echo $__env->renderComponent(); ?>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        var movements_table = $('#movements_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?php echo e(route("warehouse.stock.movements"), false); ?>',
                data: function(d) {
                    d.warehouse_id = $('#warehouse_filter').val();
                    d.movement_type = $('#type_filter').val();
                }
            },
            columns: [
                { data: 'created_at', name: 'warehouse_stock_movements.created_at' },
                { data: 'warehouse_name', name: 'warehouses.name' },
                { data: 'product_display', name: 'products.name' },
                { data: 'type', name: 'warehouse_stock_movements.type' },
                { data: 'quantity', name: 'warehouse_stock_movements.quantity' },
                { data: 'lot_number', name: 'warehouse_stock_movements.lot_number' },
                { data: 'notes', name: 'warehouse_stock_movements.notes' },
                { data: 'user', name: 'users.first_name', orderable: false },
            ],
            order: [[0, 'desc']]
        });

        $('#warehouse_filter, #type_filter').change(function() {
            movements_table.ajax.reload();
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>