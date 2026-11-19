
<?php $__env->startSection('title', __('warehouse::lang.edit_transfer')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('warehouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('warehouse::lang.edit_transfer'); ?> - <?php echo e($sell_transfer->ref_no, false); ?></h1>
</section>

<?php ($show_lot_column = (bool) session('business.enable_lot_number')); ?>
<section class="content">
    <input type="hidden" id="page_type" value="purchase">
    <input type="hidden" id="wh_transfer_page" value="1">
    <?php echo Form::open(['route' => ['warehouse.transfers.update', $sell_transfer->id], 'method' => 'PUT', 'id' => 'warehouse_transfer_form']); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('warehouse::lang.transfer_details')]); ?>
        <div class="row mb-3">
            <div class="col-md-3">
                <strong><?php echo app('translator')->get('warehouse::lang.source_warehouse'); ?></strong>
                <div><?php echo e($sell_transfer->location?->name ?? '-', false); ?></div>
            </div>
            <div class="col-md-3">
                <strong><?php echo app('translator')->get('warehouse::lang.destination_warehouse'); ?></strong>
                <div><?php echo e($purchase_transfer?->location?->name ?? '-', false); ?></div>
            </div>
            <div class="col-md-3">
                <strong><?php echo app('translator')->get('warehouse::lang.transfer_status'); ?></strong>
                <div><?php echo app('translator')->get('warehouse::lang.status_completed'); ?></div>
            </div>
            <div class="col-md-3">
                <strong><?php echo app('translator')->get('messages.date'); ?></strong>
                <div><?php echo e(\Carbon::createFromTimestamp(strtotime($sell_transfer->transaction_date))->format(session('business.date_format') . ' ' . 'h:i A'), false); ?></div>
            </div>
        </div>
        <div class="mb-3">
            <label for="completed_transfer_product"><?php echo app('translator')->get('stock_adjustment.search_products'); ?></label>
            <div class="input-group">
                <button type="button" id="wh_open_products_search_modal" class="btn btn-secondary" aria-label="<?php echo e(__('lang_v1.products_search'), false); ?>">
                    <i class="fas fa-search" aria-hidden="true"></i>
                </button>
                <input id="completed_transfer_product" class="form-control" autocomplete="off"
                    placeholder="<?php echo e(__('stock_adjustment.search_product_trasfer'), false); ?>">
            </div>
            <?php $__currentLoopData = $errors->get('new_quantities*'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $messages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="text-danger"><?php echo e($message, false); ?></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-th-skin">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('product.sku'); ?></th>
                        <th><?php echo app('translator')->get('sale.product'); ?></th>
                        <?php if($show_lot_column): ?>
                            <th><?php echo app('translator')->get('warehouse::lang.lot_number'); ?></th>
                        <?php endif; ?>
                        <th class="text-end"><?php echo app('translator')->get('warehouse::lang.quantity_sent'); ?></th>
                        <?php if($show_cost_value): ?>
                            <th class="text-end"><?php echo app('translator')->get('sale.unit_price'); ?></th>
                            <th class="text-end"><?php echo app('translator')->get('sale.subtotal'); ?></th>
                        <?php endif; ?>
                        <th><?php echo e(__('messages.actions'), false); ?></th>
                    </tr>
                </thead>
                <tbody id="completed_transfer_products">
                    <?php $__currentLoopData = $sell_transfer->sell_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr data-variation="<?php echo e($line->variation_id, false); ?>">
                            <td><?php echo e($line->variations?->sub_sku ?? $line->product?->sku, false); ?></td>
                            <td>
                                <?php echo e($line->product?->name, false); ?>

                                <?php if($line->variations && $line->variations->name !== 'DUMMY'): ?>
                                    - <?php echo e($line->variations->name, false); ?>

                                <?php endif; ?>
                            </td>
                            <?php if($show_lot_column): ?>
                            <td><?php echo e($line->lot_details?->lot_number ?? '-', false); ?></td>
                        <?php endif; ?>
                            <td class="text-end">
                                <input type="hidden" name="original_quantities[<?php echo e($line->id, false); ?>]" value="<?php echo e($line->quantity, false); ?>">
                                <input type="number" name="quantities[<?php echo e($line->id, false); ?>]"
                                    value="<?php echo e(old('quantities.'.$line->id, $line->quantity), false); ?>"
                                    class="form-control text-end existing-quantity" min="0" step="0.0001" required
                                    aria-label="<?php echo e(__('warehouse::lang.quantity_sent'), false); ?> <?php echo e($line->variations?->sub_sku, false); ?>">
                                <?php $__errorArgs = ['quantities.'.$line->id];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message, false); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </td>
                            <?php if($show_cost_value): ?>
                                <td class="text-end"><?php echo e(number_format($line->unit_price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                                <td class="text-end"><?php echo e(number_format($line->quantity * $line->unit_price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                            <?php endif; ?>
                            <td><button type="button" class="btn btn-outline-danger btn-sm remove-transfer-product"><?php echo e(__('messages.delete'), false); ?></button></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <?php if($show_cost_value): ?>
                    <tfoot>
                        <tr>
                            <th colspan="<?php echo e($show_lot_column ? 5 : 4, false); ?>" class="text-end"><?php echo app('translator')->get('sale.total'); ?></th>
                            <th class="text-end"><?php echo e(number_format($sell_transfer->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></th>
                            <td></td>
                        </tr>
                    </tfoot>
                <?php endif; ?>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row">
            <div class="col-md-4 form-group">
                <?php echo Form::label('priority', __('warehouse::lang.priority')); ?>

                <?php echo Form::select('priority', [
                    'low' => __('warehouse::lang.priority_low'),
                    'normal' => __('warehouse::lang.priority_normal'),
                    'high' => __('warehouse::lang.priority_high'),
                    'urgent' => __('warehouse::lang.priority_urgent'),
                ], $sell_transfer->sub_status ?: 'normal', ['class' => 'form-control']); ?>

            </div>
            <div class="col-md-4 form-group">
                <?php echo Form::label('shipping_method', __('warehouse::lang.shipping_method')); ?>

                <?php echo Form::text('shipping_method', $sell_transfer->shipping_details, ['class' => 'form-control']); ?>

            </div>
            <div class="col-md-4 form-group">
                <?php echo Form::label('expected_date', __('warehouse::lang.expected_date')); ?>

                <?php echo Form::input('datetime-local', 'expected_date', $sell_transfer->delivery_date ? \Carbon\Carbon::parse($sell_transfer->delivery_date)->format('Y-m-d\TH:i') : null, ['class' => 'form-control']); ?>

            </div>
            <div class="col-12 form-group">
                <?php echo Form::label('notes', __('warehouse::lang.warehouse_notes')); ?>

                <?php echo Form::textarea('notes', $sell_transfer->additional_notes, ['class' => 'form-control', 'rows' => 2]); ?>

            </div>
        </div>
        <div id="completed_transfer_actions" class="d-flex gap-2 justify-content-end">
            <a href="<?php echo e(route('warehouse.transfers'), false); ?>" class="btn btn-secondary"><?php echo app('translator')->get('messages.cancel'); ?></a>
            <button type="submit" form="warehouse_transfer_form" class="btn btn-primary">
                <i class="fas fa-save" aria-hidden="true"></i> <?php echo app('translator')->get('messages.update'); ?>
            </button>
        </div>
    <?php echo $__env->renderComponent(); ?>
    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(function () {
    var $rows = $('#completed_transfer_products');
    var showLot = <?php echo json_encode($show_lot_column, 15, 512) ?>;
    var showCost = <?php echo json_encode($show_cost_value, 15, 512) ?>;
    var removeLabel = <?php echo json_encode(__('messages.delete'), 15, 512) ?>;
    $rows.on('click', '.remove-transfer-product', function () {
        var $row = $(this).closest('tr');
        var $quantity = $row.find('.existing-quantity');
        if ($quantity.length) {
            $quantity.val(0);
            $row.hide();
        } else {
            $row.remove();
        }
    });

    var $search = $('#completed_transfer_product');
    $rows.on('keydown', 'input[type="number"]', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            $search.trigger('focus');
        }
    });

    function addProduct(product) {
            var id = Number(product.variation_id);
            if (!Number.isInteger(id) || id <= 0) {
                return false;
            }
        var $existing = $rows.children('[data-variation="' + id + '"]');
        $search.val('');
        if ($existing.length) {
            var $qty = $existing.first().find('input[type=number]');
            if ($qty.val() === '0') {
                $qty.val($existing.first().find('input[type=hidden]').val());
                $existing.first().show();
            }
            $qty.focus();
            return $qty;
        }
        var $row = $('<tr>').attr('data-variation', id);
        $('<td>').text(product.sub_sku).appendTo($row);
        $('<td>').text(product.label).appendTo($row);
        if (showLot) {
            $('<td>').text('-').appendTo($row);
        }
        var $quantity = $('<input>', {
            type: 'number', name: 'new_quantities[' + id + ']', value: 1,
            min: 0.0001, step: 0.0001, required: true, class: 'form-control text-end',
            'aria-label': product.label
        }).appendTo($('<td>').appendTo($row));
        if (showCost) {
            $row.append('<td></td><td></td>');
        }
        $('<button>', { type: 'button', class: 'btn btn-outline-danger btn-sm remove-transfer-product' })
            .text(removeLabel).appendTo($('<td>').appendTo($row));
        $rows.append($row);
        $quantity.focus().select();
        return $quantity;
    }

    $search.autocomplete({
        minLength: 2,
        source: function (request, response) {
            $.getJSON('/products/list', {
                location_id: <?php echo json_encode($sell_transfer->location_id, 15, 512) ?>,
                term: request.term,
                product_types: ['single', 'variable']
            }, function (products) {
                response(products.map(function (product) {
                    product.label = product.text || product.name || product.sub_sku;
                    return product;
                }));
            }).fail(function () {
                response([]);
                toastr.error(LANG.something_went_wrong);
            });
        },
        select: function (event, ui) {
            addProduct(ui.item);
            return false;
        }
    });

    function addModalProducts($selected) {
        if (!$selected.length) {
            toastr.error('No products selected');
            return;
        }

        var $quantity;
        $selected.each(function () {
            var row = $('#products_search_results').DataTable().row($(this).closest('tr')).data();
            var label = row ? $('<div>').html(row.product || '').text().trim() : '';
            $quantity = addProduct({
                variation_id: this.value,
                sub_sku: $(this).data('product-sku'),
                label: label || $(this).data('product-sku')
            }) || $quantity;
        });
        if ($quantity) {
            $('#products_search_modal').one('hidden.bs.modal.completedTransfer', function () {
                $quantity.trigger('focus').select();
            }).modal('hide');
        }
    }

    $(document).on('click', '#ps_select_products', function (event) {
        event.preventDefault();
        var $selected = $('#products_search_results .ps-row-select:checked');
        addModalProducts($selected.length ? $selected : $('#products_search_results .ps-row-select:focus'));
    });
    $(document).on('dblclick', '#products_search_results tbody tr', function () {
        addModalProducts($(this).find('.ps-row-select'));
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>