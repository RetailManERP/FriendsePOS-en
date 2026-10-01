
<?php $__env->startSection('title', __('warehouse::lang.stock_adjustment')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('warehouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('warehouse::lang.stock_adjustment'); ?></h1>
</section>

<section class="content">
    <?php echo Form::open(['route' => 'warehouse.stock.process-adjustment', 'method' => 'POST']); ?>


    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('warehouse_id', __('warehouse::lang.select_warehouse') . ':*'); ?>

                    <?php echo Form::select('warehouse_id', $warehouses, null, ['class' => 'form-control select2', 'required', 'placeholder' => __('messages.please_select')]); ?>

                </div>
            </div>
        </div>

        <table class="table table-bordered" id="adjustment_table">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('warehouse::lang.product'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.adjustment_type'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.quantity'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.lot_number'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.adjustment_reason'); ?></th>
                    <th><button type="button" class="btn btn-success btn-xs add-adjustment-row"><i class="fas fa-plus"></i></button></th>
                </tr>
            </thead>
            <tbody>
                <tr class="adjustment-row">
                    <td>
                        <select name="adjustments[0][product_id]" class="form-control" required>
                            <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                        </select>
                        <input type="hidden" name="adjustments[0][variation_id]" value="">
                    </td>
                    <td>
                        <select name="adjustments[0][type]" class="form-control" required>
                            <option value="add"><?php echo app('translator')->get('warehouse::lang.add_stock'); ?></option>
                            <option value="subtract"><?php echo app('translator')->get('warehouse::lang.subtract_stock'); ?></option>
                        </select>
                    </td>
                    <td><input type="number" name="adjustments[0][quantity]" class="form-control" step="0.01" min="0.01" required></td>
                    <td><input type="text" name="adjustments[0][lot_number]" class="form-control"></td>
                    <td><input type="text" name="adjustments[0][reason]" class="form-control"></td>
                    <td><button type="button" class="btn btn-danger btn-xs remove-row"><i class="fas fa-times"></i></button></td>
                </tr>
            </tbody>
        </table>

        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary pull-right">
                    <i class="fas fa-save"></i> <?php echo app('translator')->get('warehouse::lang.adjust_stock'); ?>
                </button>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php echo Form::close(); ?>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        var rowIdx = 1;

        $(document).on('click', '.add-adjustment-row', function() {
            var newRow = `<tr class="adjustment-row">
                <td>
                    <select name="adjustments[${rowIdx}][product_id]" class="form-control" required>
                        <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                    </select>
                    <input type="hidden" name="adjustments[${rowIdx}][variation_id]" value="">
                </td>
                <td>
                    <select name="adjustments[${rowIdx}][type]" class="form-control" required>
                        <option value="add"><?php echo app('translator')->get('warehouse::lang.add_stock'); ?></option>
                        <option value="subtract"><?php echo app('translator')->get('warehouse::lang.subtract_stock'); ?></option>
                    </select>
                </td>
                <td><input type="number" name="adjustments[${rowIdx}][quantity]" class="form-control" step="0.01" min="0.01" required></td>
                <td><input type="text" name="adjustments[${rowIdx}][lot_number]" class="form-control"></td>
                <td><input type="text" name="adjustments[${rowIdx}][reason]" class="form-control"></td>
                <td><button type="button" class="btn btn-danger btn-xs remove-row"><i class="fas fa-times"></i></button></td>
            </tr>`;
            $('#adjustment_table tbody').append(newRow);
            rowIdx++;
        });

        $(document).on('click', '.remove-row', function() {
            if ($('.adjustment-row').length > 1) {
                $(this).closest('tr').remove();
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>