<div class="modal-dialog modal-xl" role="document">
	<?php
		$display_status = $sell_transfer->status === 'final' ? 'completed' : $sell_transfer->status;
		$priority = $sell_transfer->sub_status ?: 'normal';
		$is_received = !empty($purchase_transfer) && in_array($purchase_transfer->status, ['received', 'final', 'completed']);
	?>
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"><?php echo app('translator')->get('warehouse::lang.transfer_details'); ?> (#<?php echo e($sell_transfer->ref_no, false); ?>)</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <table class="table table-condensed">
                        <tr><th><?php echo app('translator')->get('warehouse::lang.reference_no'); ?></th><td><?php echo e($sell_transfer->ref_no, false); ?></td></tr>
                        <tr>
                            <th><?php echo app('translator')->get('warehouse::lang.transfer_status'); ?></th>
                            <td>
                                <?php
                                    $badges = ['draft' => 'secondary', 'pending' => 'warning', 'in_transit' => 'info', 'partial' => 'primary', 'completed' => 'success', 'cancelled' => 'danger'];
                                ?>
                                <span class="badge bg-<?php echo e($badges[$display_status] ?? 'secondary', false); ?>">
                                    <?php echo app('translator')->get('warehouse::lang.status_' . $display_status); ?>
                                </span>
                            </td>
                        </tr>
                        <tr><th><?php echo app('translator')->get('warehouse::lang.priority'); ?></th><td><?php echo app('translator')->get('warehouse::lang.priority_' . $priority); ?></td></tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table table-condensed">
                        <tr><th><?php echo app('translator')->get('warehouse::lang.source_warehouse'); ?></th><td><?php echo e(optional($sell_transfer->location)->name ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('warehouse::lang.destination_warehouse'); ?></th><td><?php echo e(optional(optional($purchase_transfer)->location)->name ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('warehouse::lang.shipping_method'); ?></th><td><?php echo e($sell_transfer->shipping_details ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('sale.shipping_charges'); ?></th><td><?php echo e(number_format($sell_transfer->shipping_charges ?? 0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td></tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table table-condensed">
                        <tr><th><?php echo app('translator')->get('warehouse::lang.expected_date'); ?></th><td><?php echo e(!empty($sell_transfer->delivery_date) ? \Carbon::createFromTimestamp(strtotime($sell_transfer->delivery_date))->format(session('business.date_format') . ' ' . 'h:i A') : '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('warehouse::lang.shipped_date'); ?></th><td><?php echo e($display_status === 'in_transit' ? \Carbon::createFromTimestamp(strtotime($sell_transfer->updated_at))->format(session('business.date_format') . ' ' . 'h:i A') : '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('warehouse::lang.received_date'); ?></th><td><?php echo e($is_received ? \Carbon::createFromTimestamp(strtotime(optional($purchase_transfer)->updated_at))->format(session('business.date_format') . ' ' . 'h:i A') : '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('lang_v1.added_by'); ?></th><td><?php echo e(optional($sell_transfer->sales_person)->user_full_name ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('sale.total'); ?></th><td><?php echo e(number_format($sell_transfer->final_total ?? 0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td></tr>
                    </table>
                </div>
            </div>

            <?php if($sell_transfer->additional_notes): ?>
                <div class="row">
                    <div class="col-md-12">
                        <strong><?php echo app('translator')->get('warehouse::lang.warehouse_notes'); ?>:</strong> <?php echo e($sell_transfer->additional_notes, false); ?>

                    </div>
                </div>
            <?php endif; ?>

            <hr>
            <h4><?php echo app('translator')->get('warehouse::lang.product'); ?> Lines</h4>
            <?php
                $line_total_amount = $sell_transfer->sell_lines->sum(function ($line) {
                    return ($line->quantity ?? 0) * ($line->unit_price ?? 0);
                });
                $total_products = $sell_transfer->sell_lines->count();
                $total_quantity = $sell_transfer->sell_lines->sum('quantity');
            ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo app('translator')->get('warehouse::lang.product'); ?></th>
                        <th><?php echo app('translator')->get('warehouse::lang.sku'); ?></th>
                        <th><?php echo app('translator')->get('warehouse::lang.lot_number'); ?></th>
                        <th><?php echo app('translator')->get('warehouse::lang.quantity_sent'); ?></th>
                        <th>Cost Price</th>
                        <th><?php echo app('translator')->get('sale.subtotal'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $sell_transfer->sell_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration, false); ?></td>
                            <td>
                                <?php echo e(optional($line->product)->name, false); ?>

                                <?php if($line->variations && $line->variations->name !== 'DUMMY'): ?>
                                    - <?php echo e($line->variations->name, false); ?>

                                <?php endif; ?>
                            </td>
                            <td><?php echo e(optional($line->variations)->sub_sku ?? optional($line->product)->sku, false); ?></td>
                            <td><?php echo e(optional($line->lot_details)->lot_number ?? '-', false); ?></td>
                            <td><?php echo e(number_format($line->quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                            <td><?php echo e(number_format($line->unit_price ?? 0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                            <td><?php echo e(number_format(($line->quantity ?? 0) * ($line->unit_price ?? 0), session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <div class="row">
                <div class="col-md-12 text-end">
                    <strong><?php echo app('translator')->get('sale.total'); ?>:</strong> <?php echo e(number_format($line_total_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-12 text-end">
                    <strong><?php echo app('translator')->get('warehouse::lang.total_products'); ?>:</strong> <?php echo e($total_products, false); ?>

                    &nbsp; | &nbsp;
                    <strong><?php echo app('translator')->get('warehouse::lang.total_quantity'); ?>:</strong> <?php echo e(number_format($total_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary no-print" aria-label="Print"
                    onclick="$(this).closest('div.modal-content').printThis();">
                <i class="fas fa-print"></i> <?php echo app('translator')->get('messages.print'); ?>
            </button>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
    </div>
</div>
