
<?php $__env->startSection('title', __('manufacturing::lang.edit_demand_order')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('manufacturing::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><i class="fas fa-edit"></i> <?php echo app('translator')->get('manufacturing::lang.edit_demand_order'); ?> - <?php echo e($demand_order->ref_no, false); ?></h1>
</section>

<section class="content">
    <?php echo Form::open(['url' => action([\Modules\Manufacturing\Http\Controllers\DemandOrderController::class, 'update'], $demand_order->id), 'method' => 'put', 'id' => 'demand_order_form']); ?>


    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('manufacturing::lang.demand_order_details')]); ?>
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <?php echo Form::label('location_id', __('purchase.business_location') . ':*'); ?>

                    <?php echo Form::select('location_id', $business_locations, $demand_order->location_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'id' => 'location_id']); ?>

                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <?php echo Form::label('ref_no', __('purchase.ref_no') . ':'); ?>

                    <?php echo Form::text('ref_no', $demand_order->ref_no, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <?php echo Form::label('demand_date', __('manufacturing::lang.demand_date') . ':*'); ?>

                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        <?php echo Form::text('demand_date', \Carbon::createFromTimestamp(strtotime($demand_order->demand_date))->format(session('business.date_format')), ['class' => 'form-control', 'readonly', 'required']); ?>

                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <?php echo Form::label('required_date', __('manufacturing::lang.required_date') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        <?php echo Form::text('required_date', !empty($demand_order->required_date) ? \Carbon::createFromTimestamp(strtotime($demand_order->required_date))->format(session('business.date_format')) : null, ['class' => 'form-control', 'readonly', 'id' => 'required_date']); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <?php echo Form::label('status', __('sale.status') . ':'); ?>

                    <?php echo Form::select('status', [
                        'draft' => __('manufacturing::lang.do_status_draft'),
                        'pending' => __('manufacturing::lang.do_status_pending'),
                    ], $demand_order->status, ['class' => 'form-control select2']); ?>

                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <?php echo Form::label('priority', __('manufacturing::lang.priority') . ':'); ?>

                    <?php echo Form::select('priority', [
                        'low' => __('manufacturing::lang.priority_low'),
                        'normal' => __('manufacturing::lang.priority_normal'),
                        'high' => __('manufacturing::lang.priority_high'),
                        'urgent' => __('manufacturing::lang.priority_urgent'),
                    ], $demand_order->priority, ['class' => 'form-control select2']); ?>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <?php echo Form::label('notes', __('manufacturing::lang.do_notes') . ':'); ?>

                    <?php echo Form::textarea('notes', $demand_order->notes, ['class' => 'form-control', 'rows' => 2]); ?>

                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('manufacturing::lang.demand_items')]); ?>
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('add_product', __('manufacturing::lang.select_recipe_product') . ':'); ?>

                    <?php echo Form::select('add_product', $recipe_dropdown, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'id' => 'add_demand_product']); ?>

                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="demand_lines_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('sale.product'); ?></th>
                        <th style="width: 120px;"><?php echo app('translator')->get('stock_adjustment.on_hand'); ?></th>
                        <th style="width: 120px;"><?php echo app('translator')->get('lang_v1.quantity'); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.unit'); ?></th>
                        <th style="width: 120px;"><?php echo app('translator')->get('lang_v1.batch_quantity'); ?></th>
                        <th><?php echo app('translator')->get('manufacturing::lang.recipe'); ?></th>
                        <th><?php echo app('translator')->get('manufacturing::lang.est_unit_cost'); ?></th>
                        <th><?php echo app('translator')->get('manufacturing::lang.est_line_total'); ?></th>
                        <th style="width: 200px;"><?php echo app('translator')->get('manufacturing::lang.line_notes'); ?></th>
                        <th style="width: 50px;"><i class="fa fa-trash"></i></th>
                    </tr>
                </thead>
                <tbody id="demand_lines_body">
                    <?php $__currentLoopData = $demand_order->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $product_name = $line->product->type == 'variable' 
                            ? $line->product->name . ' - ' . $line->variation->product_variation->name . ' - ' . $line->variation->name . ' (' . $line->variation->sub_sku . ')'
                            : $line->product->name . ' (' . $line->variation->sub_sku . ')';
                        $unit_cost = $line->quantity > 0 ? $line->estimated_cost / $line->quantity : 0;
                        $cost_decimal = session('business.cost_decimal', 2);
                    ?>
                    <tr class="demand-line-row" data-row-index="<?php echo e($index, false); ?>">
                        <td>
                            <?php echo e($product_name, false); ?>

                            <input type="hidden" name="demand_lines[<?php echo e($index, false); ?>][variation_id]" value="<?php echo e($line->variation_id, false); ?>">
                        </td>
                        <td>
                            <span class="display_currency demand-line-on-hand"
                                  data-currency_symbol="false"
                                  data-is_quantity="true"
                                  data-orig-value="<?php echo e($line->on_hand_qty ?? 0, false); ?>">
                                <?php echo e($line->on_hand_qty ?? 0, false); ?>

                            </span>
                        </td>
                        <td>
                            <input type="text" name="demand_lines[<?php echo e($index, false); ?>][quantity]" 
                                   class="form-control input_number demand-line-qty" 
                                   value="<?php echo e(number_format($line->quantity, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" required>
                        </td>
                        <td><?php echo e($line->product->unit->short_name ?? '', false); ?></td>
                        <td>
                            <input type="text" name="demand_lines[<?php echo e($index, false); ?>][batch_quantity]" 
                                class="form-control input_number input_quantity demand-line-batch-qty bg-gray" data-orig-value="<?php echo e($line->recipe->total_quantity, false); ?>"
                                value="<?php echo e(number_format($line->batch_quantity ?? 0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>" required readonly>
                        </td>
                        <td>
                            <?php if($line->recipe): ?>
                                <span class="badge bg-success"><i class="fas fa-check"></i> <?php echo app('translator')->get('manufacturing::lang.recipe_available'); ?></span>
                            <?php else: ?>
                                <span class="badge bg-warning"><i class="fas fa-exclamation-triangle"></i> <?php echo app('translator')->get('manufacturing::lang.no_recipe'); ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="est-unit-cost display_currency" data-currency_symbol="true" data-orig-value="<?php echo e($unit_cost, false); ?>"><?php echo e(number_format($unit_cost, $cost_decimal), false); ?></span>
                        </td>
                        <td>
                            <span class="est-line-total display_currency" data-currency_symbol="true" data-orig-value="<?php echo e($line->estimated_cost, false); ?>"><?php echo e(number_format($line->estimated_cost, $cost_decimal), false); ?></span>
                        </td>
                        <td>
                            <input type="text" name="demand_lines[<?php echo e($index, false); ?>][line_notes]" class="form-control" value="<?php echo e($line->line_notes, false); ?>">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-xs remove-demand-line"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7" class="text-end"><strong><?php echo app('translator')->get('manufacturing::lang.total_estimated_cost'); ?>:</strong></td>
                        <td><strong><span id="grand_total_estimated" class="display_currency" data-currency_symbol="true"><?php echo e($demand_order->total_estimated_cost, false); ?></span></strong></td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-md-12 text-center">
            <?php echo Form::hidden('save_and_print', 0, ['id' => 'save_and_print_flag']); ?>

        </div>
    </div>

    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function() {
    var row_index = <?php echo e($demand_order->lines->count(), false); ?>;

    if ($('#required_date').length) {
        $('#required_date').datepicker({ autoclose: true });
    }

    // Add product row
    $('#add_demand_product').on('change', function() {
        var variation_id = $(this).val();
        var location_id = $('#location_id').val();
        if (!variation_id) return;

        if (!location_id) {
            toastr.error("<?php echo app('translator')->get('purchase.business_location'); ?> <?php echo app('translator')->get('messages.is_required'); ?>");
            $(this).val('').trigger('change');
            return;
        }

        if ($('#demand_lines_body').find('input[name$="[variation_id]"][value="' + variation_id + '"]').length > 0) {
            toastr.warning("<?php echo app('translator')->get('manufacturing::lang.product_already_added'); ?>");
            $(this).val('').trigger('change');
            return;
        }

        $.ajax({
            url: '<?php echo e(action([\Modules\Manufacturing\Http\Controllers\DemandOrderController::class, "getProductRow"]), false); ?>',
            data: { variation_id: variation_id, row_index: row_index, location_id: location_id },
            success: function(html) {
                $('#demand_lines_body').append(html);
                row_index++;
                calculateGrandTotal();
                __currency_convert_recursively($('#demand_lines_table'));
            }
        });

        $(this).val('').trigger('change');
    });

    $('#location_id').on('change', function() {
        var location_id = $(this).val();

        $('#demand_lines_body tr').each(function() {
            var $row = $(this);
            var variation_id = $row.find('input[name$="[variation_id]"]').val();
            var $onHand = $row.find('.demand-line-on-hand');

            if (!variation_id || !$onHand.length) {
                return;
            }

            if (!location_id) {
                $onHand.text('0').data('orig-value', 0);
                return;
            }

            $.ajax({
                url: '<?php echo e(action([\Modules\Manufacturing\Http\Controllers\DemandOrderController::class, "getProductRow"]), false); ?>',
                data: { variation_id: variation_id, row_index: $row.data('row-index'), location_id: location_id },
                success: function(html) {
                    var on_hand = $(html).find('.demand-line-on-hand').data('orig-value');
                    on_hand = parseFloat(on_hand) || 0;
                    $onHand.text(on_hand).data('orig-value', on_hand);
                    __currency_convert_recursively($row);
                }
            });
        });
    });

    // Remove row
    $(document).on('click', '.remove-demand-line', function() {
        $(this).closest('tr').remove();
        calculateGrandTotal();
    });

    // Recalculate on quantity change
    $(document).on('change keyup', '.demand-line-qty', function() {
        var $row = $(this).closest('tr');
        var qty = parseFloat(__read_number($(this))) || 0;
        updateBatchQty($row, qty);

        var unit_cost = parseFloat($row.find('.est-unit-cost').data('orig-value')) || 0;
        var line_total = qty * unit_cost;
        $row.find('.est-line-total').text(__currency_trans_from_en(line_total, true, false));
        $row.find('.est-line-total').data('orig-value', line_total);
        calculateGrandTotal();
    });

    function updateBatchQty($row, qty) {
        var $batchQty = $row.find('.demand-line-batch-qty');
        var orig_batch_qty = parseFloat($batchQty.data('orig-value')) || 0;

        if (orig_batch_qty <= 0) {
            return;
        }

        var multiplier = Math.max(1, Math.ceil(qty / orig_batch_qty));
        var batch_qty = parseFloat((multiplier * orig_batch_qty).toFixed(8));

        __write_number($batchQty, batch_qty);
    }

    function calculateGrandTotal() {
        var total = 0;
        $('#demand_lines_body tr').each(function() {
            var line_total = parseFloat($(this).find('.est-line-total').data('orig-value')) || 0;
            total += line_total;
        });
        $('#grand_total_estimated').text(__currency_trans_from_en(total, true, true));
    }

    // Prevent double submit
    $('#demand_order_form').on('submit', function(e) {
        if (!$('#location_id').val()) {
            e.preventDefault();
            toastr.error("<?php echo app('translator')->get('purchase.business_location'); ?> <?php echo app('translator')->get('messages.is_required'); ?>");
            return false;
        }

        if ($('#demand_lines_body tr').length === 0) {
            e.preventDefault();
            toastr.error("<?php echo app('translator')->get('manufacturing::lang.please_add_at_least_one_item'); ?>");
            return false;
        }
        $(this).find('button[type=submit]').attr('disabled', true);
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>