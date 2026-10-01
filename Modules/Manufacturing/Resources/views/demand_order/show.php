<style>
    .demand-order-print {
        background: #fff;
        color: #222;
    }
    .demand-order-sheet {
        padding: 10px 14px 14px;
    }
    .demand-order-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 12px;
        border-bottom: 1px solid #d9dee7;
        padding-bottom: 10px;
    }
    .demand-order-title {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
        color: #1f2d3d;
    }
    .demand-order-subtitle {
        margin-top: 4px;
        color: #6b7280;
        font-size: 12px;
    }
    .demand-order-meta {
        width: 100%;
        margin-bottom: 10px;
    }
    .demand-order-meta td,
    .demand-order-meta th {
        padding: 6px 8px !important;
        border-top: 0 !important;
        border-bottom: 1px solid #edf1f5;
        vertical-align: top;
        font-size: 12px;
    }
    .demand-order-lines th,
    .demand-order-lines td {
        padding: 7px 8px !important;
        font-size: 12px;
        vertical-align: top;
    }
    .demand-order-lines thead th {
        background: #eef5fb !important;
        color: #1d5f91;
        border-color: #d7e3ef !important;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: .03em;
    }
    .demand-order-lines tfoot td {
        background: #fafbfd;
    }
    .demand-order-notes {
        margin: 8px 0 10px;
        font-size: 12px;
    }
    .demand-order-signatures {
        margin-top: 30px;
        width: 100%;
    }
    .demand-order-signatures td {
        width: 33.33%;
        padding: 0 14px;
        text-align: center;
        vertical-align: bottom;
        border: 0 !important;
    }
    .signature-line {
        border-top: 1px solid #444;
        padding-top: 8px;
        font-size: 12px;
        font-weight: 600;
        min-height: 26px;
    }
    @media print {
        @page {
            size: auto;
            margin: 8mm 10mm 12mm 10mm;
        }
        html, body {
            background: #fff !important;
        }
        .modal-dialog {
            width: 100% !important;
            max-width: 100% !important;
            margin: 0 !important;
        }
        .modal-content {
            border: 0 !important;
            box-shadow: none !important;
        }
        .modal-header,
        .modal-footer,
        .btn-close,
        .no-print {
            display: none !important;
        }
        .modal-body {
            padding: 0 !important;
        }
        .demand-order-sheet {
            padding: 0 !important;
        }
        .demand-order-lines th,
        .demand-order-lines td,
        .demand-order-meta td,
        .demand-order-meta th {
            font-size: 11px !important;
        }
        .badge {
            border: 1px solid #999 !important;
            color: #000 !important;
            background: transparent !important;
        }
    }
</style>

<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
                <i class="fas fa-clipboard-list"></i> <?php echo app('translator')->get('manufacturing::lang.demand_order_details'); ?> - <?php echo e($demand_order->ref_no, false); ?>

            </h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body demand-order-print">
            <div class="demand-order-sheet">
                <div class="demand-order-header">
                    <div>
                        <h2 class="demand-order-title"><?php echo app('translator')->get('manufacturing::lang.demand_order_details'); ?></h2>
                        <div class="demand-order-subtitle"><?php echo e($demand_order->ref_no, false); ?></div>
                    </div>
                    <div class="text-end">
                        <strong><?php echo app('translator')->get('purchase.location'); ?>:</strong> <?php echo e($demand_order->location->name ?? '--', false); ?><br>
                        <strong><?php echo app('translator')->get('manufacturing::lang.demand_date'); ?>:</strong> <?php echo e(\Carbon::createFromTimestamp(strtotime($demand_order->demand_date))->format(session('business.date_format')), false); ?>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <table class="table demand-order-meta">
                            <tr>
                                <th width="38%"><?php echo app('translator')->get('purchase.ref_no'); ?>:</th>
                                <td><?php echo e($demand_order->ref_no, false); ?></td>
                            </tr>
                            <tr>
                                <th><?php echo app('translator')->get('purchase.location'); ?>:</th>
                                <td><?php echo e($demand_order->location->name ?? '--', false); ?></td>
                            </tr>
                            <tr>
                                <th><?php echo app('translator')->get('manufacturing::lang.demand_date'); ?>:</th>
                                <td><?php echo e(\Carbon::createFromTimestamp(strtotime($demand_order->demand_date))->format(session('business.date_format')), false); ?></td>
                            </tr>
                            <tr>
                                <th><?php echo app('translator')->get('manufacturing::lang.required_date'); ?>:</th>
                                <td><?php echo e(!empty($demand_order->required_date) ? \Carbon::createFromTimestamp(strtotime($demand_order->required_date))->format(session('business.date_format')) : '--', false); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <table class="table demand-order-meta">
                            <tr>
                                <th width="38%"><?php echo app('translator')->get('sale.status'); ?>:</th>
                                <td><?php echo \Modules\Manufacturing\Entities\MfgDemandOrder::getStatusBadge($demand_order->status); ?></td>
                            </tr>
                            <tr>
                                <th><?php echo app('translator')->get('manufacturing::lang.priority'); ?>:</th>
                                <td><span class="badge <?php echo e(\Modules\Manufacturing\Utils\ManufacturingUtil::getPriorityBadge($demand_order->priority), false); ?>"><?php echo e(ucfirst($demand_order->priority), false); ?></span></td>
                            </tr>
                            <tr>
                                <th><?php echo app('translator')->get('business.created_by'); ?>:</th>
                                <td><?php echo e($demand_order->createdBy ? trim($demand_order->createdBy->surname . ' ' . $demand_order->createdBy->first_name . ' ' . $demand_order->createdBy->last_name) : '--', false); ?></td>
                            </tr>
                            <?php if($demand_order->approved_by): ?>
                            <tr>
                                <th><?php echo app('translator')->get('manufacturing::lang.approved_by'); ?>:</th>
                                <td><?php echo e($demand_order->approvedBy ? trim($demand_order->approvedBy->surname . ' ' . $demand_order->approvedBy->first_name . ' ' . $demand_order->approvedBy->last_name) : '--', false); ?>

                                    <br><small class="text-muted"><?php echo e(\Carbon::createFromTimestamp(strtotime($demand_order->approved_at))->format(session('business.date_format') . ' ' . 'h:i A'), false); ?></small>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>

                <?php if($demand_order->notes): ?>
                <div class="demand-order-notes">
                    <strong><?php echo app('translator')->get('manufacturing::lang.do_notes'); ?>:</strong>
                    <span class="text-muted"><?php echo e($demand_order->notes, false); ?></span>
                </div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-sm demand-order-lines">
                        <thead>
                            <tr>
                                <th style="width: 40px;">#</th>
                                <th><?php echo app('translator')->get('sale.product'); ?></th>
                                <th><?php echo app('translator')->get('product.category'); ?></th>
                                <th class="text-end"><?php echo app('translator')->get('stock_adjustment.on_hand'); ?></th>
                                <th class="text-end"><?php echo app('translator')->get('lang_v1.quantity'); ?></th>
                                <th class="text-end"><?php echo app('translator')->get('lang_v1.batch_quantity'); ?></th>
                                <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.produced_qty'); ?></th>
                                <th><?php echo app('translator')->get('sale.status'); ?></th>
                                <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.estimated_cost'); ?></th>
                                <th class="text-end"><?php echo app('translator')->get('manufacturing::lang.total_selling_price'); ?></th>
                                <th><?php echo app('translator')->get('manufacturing::lang.line_notes'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $demand_order->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $product_name = $line->product->type == 'variable'
                                    ? $line->product->name . ' - ' . $line->variation->product_variation->name . ' - ' . $line->variation->name
                                    : $line->product->name;
                                $unit_name = $line->subUnit ? $line->subUnit->short_name : ($line->product->unit->short_name ?? '');
                            ?>
                            <tr>
                                <td><?php echo e($index + 1, false); ?></td>
                                <td><?php echo e($product_name, false); ?> <small class="text-muted">(<?php echo e($line->variation->sub_sku, false); ?>)</small></td>
                                <td><?php echo e($line->product->category->name ?? '--', false); ?></td>
                                <td class="text-end">
                                    <span class="display_currency" data-currency_symbol="false" data-is_quantity="true"><?php echo e($line->on_hand_qty ?? 0, false); ?></span> <?php echo e($unit_name, false); ?>

                                </td>
                                <td class="text-end">
                                    <span class="display_currency" data-currency_symbol="false" data-is_quantity="true"><?php echo e($line->quantity, false); ?></span> <?php echo e($unit_name, false); ?>

                                </td>
                                <td class="text-end">
                                    <span class="display_currency" data-currency_symbol="false" data-is_quantity="true"><?php echo e($line->batch_quantity, false); ?></span> <?php echo e($unit_name, false); ?>

                                </td>
                                <td class="text-end">
                                    <span class="display_currency" data-currency_symbol="false" data-is_quantity="true"><?php echo e($line->produced_quantity, false); ?></span> <?php echo e($unit_name, false); ?>

                                </td>
                                <td><?php echo \Modules\Manufacturing\Entities\MfgDemandOrderLine::getLineStatusBadge($line->line_status); ?></td>
                                <td class="text-end">
                                    <span class="display_currency" data-currency_symbol="true"><?php echo e($line->estimated_cost, false); ?></span>
                                </td>
                                <td class="text-end">
                                    <span class="display_currency" data-currency_symbol="true"><?php echo e(number_format($line->quantity * ($line->variation->sell_price_inc_tax ?? 0), 4, '.', ''), false); ?></span>
                                </td>
                                <td><?php echo e($line->line_notes ?? '--', false); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8" class="text-end"><strong><?php echo app('translator')->get('manufacturing::lang.total_estimated_cost'); ?>:</strong></td>
                                <td class="text-end"><strong><span class="display_currency" data-currency_symbol="true"><?php echo e($demand_order->total_estimated_cost, false); ?></span></strong></td>
                                <td class="text-end"><strong><span class="display_currency" data-currency_symbol="true"><?php echo e(number_format($demand_order->lines->sum(fn($l) => $l->quantity * ($l->variation->sell_price_inc_tax ?? 0)), 4, '.', ''), false); ?></span></strong></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <table class="table demand-order-signatures">
                    <tr>
                        <td><div class="signature-line">Prepared By</div></td>
                        <td><div class="signature-line">Received By</div></td>
                        <td><div class="signature-line">Approved By</div></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="modal-footer bg-light" style="position: sticky; bottom: 0; z-index: 1055;">
            <button type="button" class="btn btn-primary no-print" aria-label="Print" 
                onclick="$(this).closest('div.modal-content').printThis();">
                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?>
            </button>
            <?php if(in_array($demand_order->status, ['draft', 'pending'])): ?>
                <a href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\DemandOrderController::class, 'edit'], $demand_order->id), false); ?>" class="btn btn-info no-print">
                    <i class="fa fa-edit"></i> <?php echo app('translator')->get('messages.edit'); ?>
                </a>
            <?php endif; ?>
            <button type="button" class="btn btn-default no-print" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
    </div>
</div>
