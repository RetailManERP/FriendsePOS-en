<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(__('manufacturing::lang.demand_order_details'), false); ?> — <?php echo e($demand_order->ref_no, false); ?></title>
    <style>
        /* === Reset & Base === */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html, body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            color: #000;
            background: #fff;
        }

        /* === Page Wrapper === */
        .do-page {
            max-width: 190mm;
            margin: 0 auto;
            padding: 10mm 8mm 14mm;
        }

        /* === Print Controls (hidden on print) === */
        .do-controls {
            position: fixed;
            top: 10px;
            right: 14px;
            display: flex;
            gap: 8px;
            z-index: 100;
        }
        .do-controls button {
            padding: 7px 18px;
            font-size: 10.5pt;
            font-weight: 600;
            cursor: pointer;
            border: 2px solid #000;
            background: #fff;
            color: #000;
        }
        .do-controls button.do-btn-print {
            background: #000;
            color: #fff;
        }
        .do-controls button:hover {
            opacity: .85;
        }

        /* === Document Header === */
        .do-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2.5px solid #000;
            padding-bottom: 10px;
            margin-bottom: 14px;
        }
        .do-header-biz-name {
            font-size: 15pt;
            font-weight: 700;
            line-height: 1.2;
        }
        .do-header-biz-loc {
            font-size: 10pt;
            margin-top: 3px;
        }
        .do-header-right {
            text-align: right;
        }
        .do-header-title {
            font-size: 17pt;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            line-height: 1.1;
        }
        .do-header-ref {
            font-size: 10pt;
            margin-top: 4px;
        }
        .do-header-date {
            font-size: 10pt;
            margin-top: 2px;
        }

        /* === Meta Grid === */
        .do-meta-wrap {
            display: flex;
            gap: 30px;
            margin-bottom: 14px;
        }
        .do-meta-col {
            flex: 1;
            min-width: 0;
        }
        .do-meta-row {
            display: flex;
            align-items: baseline;
            margin-bottom: 4px;
            font-size: 10.5pt;
            line-height: 1.5;
        }
        .do-meta-label {
            width: 130px;
            flex-shrink: 0;
            font-weight: 700;
        }
        .do-meta-value {
            flex: 1;
        }

        /* === Status / Priority text tags === */
        .do-status-tag {
            display: inline-block;
            border: 1px solid #000;
            padding: 1px 6px;
            font-size: 9.5pt;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        /* === Section Title === */
        .do-section-title {
            font-size: 9.5pt;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .07em;
            border-bottom: 1.5px solid #000;
            padding-bottom: 4px;
            margin: 16px 0 8px;
        }

        /* === Notes === */
        .do-notes {
            font-size: 10.5pt;
            margin-bottom: 14px;
            line-height: 1.5;
        }
        .do-notes strong {
            font-weight: 700;
        }

        /* === Items Table === */
        .do-lines-table {
            width: 100%;
            border-collapse: collapse;
        }
        .do-lines-table thead tr th {
            font-size: 9pt;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .03em;
            background: #000;
            color: #fff;
            padding: 5px 6px;
            border: 1px solid #000;
            text-align: left;
            white-space: nowrap;
        }
        .do-lines-table thead tr th.r {
            text-align: right;
        }
        .do-lines-table tbody tr td {
            font-size: 10pt;
            padding: 5px 6px;
            border: 1px solid #bbb;
            vertical-align: top;
        }
        .do-lines-table tbody tr:nth-child(even) td {
            background: #f2f2f2;
        }
        .do-lines-table td.r {
            text-align: right;
        }
        .do-lines-table tfoot tr td {
            font-size: 10.5pt;
            font-weight: 700;
            padding: 6px 6px;
            border-top: 2px solid #000;
            border-left: 0;
            border-right: 0;
            border-bottom: 0;
            background: #fff;
        }
        .do-lines-table tfoot tr td.r {
            text-align: right;
        }

        .do-sku {
            font-size: 9pt;
            color: #555;
        }

        /* === Signatures === */
        .do-sig-wrap {
            display: flex;
            gap: 0;
            margin-top: 36px;
        }
        .do-sig-col {
            flex: 1;
            text-align: center;
            padding: 0 16px;
        }
        .do-sig-line {
            border-top: 1px solid #000;
            padding-top: 6px;
            margin-top: 44px;
            font-size: 10pt;
            font-weight: 700;
        }

        /* === Footer === */
        .do-footer {
            border-top: 1px solid #ccc;
            margin-top: 20px;
            padding-top: 6px;
            font-size: 9pt;
            color: #444;
            display: flex;
            justify-content: space-between;
        }

        /* === Print Media === */
        @media print {
            @page {
                size: auto;
                margin: 10mm 10mm 12mm 10mm;
            }
            html, body {
                font-size: 10pt;
                background: #fff !important;
            }
            .do-page {
                max-width: 100%;
                padding: 0;
                margin: 0;
            }
            .do-controls {
                display: none !important;
            }
            .do-lines-table thead tr th {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .do-lines-table tbody tr:nth-child(even) td {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>

    <!-- Print Controls -->
    <div class="do-controls">
        <button class="do-btn-print" onclick="window.print();">
            &#9113; <?php echo e(__('messages.print'), false); ?>

        </button>
        <button onclick="window.close();">
            &times; <?php echo e(__('messages.close'), false); ?>

        </button>
    </div>

    <div class="do-page">

        <!-- Document Header -->
        <div class="do-header">
            <div>
                <div class="do-header-biz-name"><?php echo e($business_name, false); ?></div>
                <?php if($demand_order->location): ?>
                    <div class="do-header-biz-loc"><?php echo e($demand_order->location->name, false); ?></div>
                <?php endif; ?>
            </div>
            <div class="do-header-right">
                <div class="do-header-title"><?php echo e(__('manufacturing::lang.demand_order_details'), false); ?></div>
                <div class="do-header-ref"><?php echo e(__('purchase.ref_no'), false); ?>: <strong><?php echo e($demand_order->ref_no, false); ?></strong></div>
                <div class="do-header-date"><?php echo e(__('manufacturing::lang.demand_date'), false); ?>: <strong><?php echo e($demand_order->demand_date->format(session('business.date_format', 'd/m/Y')), false); ?></strong></div>
            </div>
        </div>

        <!-- Order Meta -->
        <div class="do-meta-wrap">
            <div class="do-meta-col">
                <div class="do-meta-row">
                    <span class="do-meta-label"><?php echo e(__('purchase.location'), false); ?>:</span>
                    <span class="do-meta-value"><?php echo e($demand_order->location->name ?? '--', false); ?></span>
                </div>
                <div class="do-meta-row">
                    <span class="do-meta-label"><?php echo e(__('manufacturing::lang.demand_date'), false); ?>:</span>
                    <span class="do-meta-value"><?php echo e($demand_order->demand_date->format(session('business.date_format', 'd/m/Y')), false); ?></span>
                </div>
                <div class="do-meta-row">
                    <span class="do-meta-label"><?php echo e(__('manufacturing::lang.required_date'), false); ?>:</span>
                    <span class="do-meta-value">
                        <?php echo e(!empty($demand_order->required_date) ? \Carbon\Carbon::parse($demand_order->required_date)->format(session('business.date_format', 'd/m/Y')) : '--', false); ?>

                    </span>
                </div>
            </div>
            <div class="do-meta-col">
                <div class="do-meta-row">
                    <span class="do-meta-label"><?php echo e(__('sale.status'), false); ?>:</span>
                    <span class="do-meta-value">
                        <span class="do-status-tag"><?php echo e(str_replace('_', ' ', strtoupper($demand_order->status)), false); ?></span>
                    </span>
                </div>
                <div class="do-meta-row">
                    <span class="do-meta-label"><?php echo e(__('manufacturing::lang.priority'), false); ?>:</span>
                    <span class="do-meta-value">
                        <span class="do-status-tag"><?php echo e(strtoupper($demand_order->priority), false); ?></span>
                    </span>
                </div>
                <div class="do-meta-row">
                    <span class="do-meta-label"><?php echo e(__('business.created_by'), false); ?>:</span>
                    <span class="do-meta-value">
                        <?php echo e($demand_order->createdBy
                            ? trim($demand_order->createdBy->surname . ' ' . $demand_order->createdBy->first_name . ' ' . $demand_order->createdBy->last_name)
                            : '--', false); ?>

                    </span>
                </div>
                <?php if($demand_order->approved_by): ?>
                <div class="do-meta-row">
                    <span class="do-meta-label"><?php echo e(__('manufacturing::lang.approved_by'), false); ?>:</span>
                    <span class="do-meta-value">
                        <?php echo e($demand_order->approvedBy
                            ? trim($demand_order->approvedBy->surname . ' ' . $demand_order->approvedBy->first_name . ' ' . $demand_order->approvedBy->last_name)
                            : '--', false); ?>

                        <?php if($demand_order->approved_at): ?>
                            (<?php echo e(\Carbon\Carbon::parse($demand_order->approved_at)->format(session('business.date_format', 'd/m/Y')), false); ?>)
                        <?php endif; ?>
                    </span>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if($demand_order->notes): ?>
        <div class="do-notes">
            <strong><?php echo e(__('manufacturing::lang.do_notes'), false); ?>:</strong>
            <?php echo e($demand_order->notes, false); ?>

        </div>
        <?php endif; ?>

        <!-- Items Section -->
        <div class="do-section-title"><?php echo e(__('manufacturing::lang.demand_order_items'), false); ?></div>

        <table class="do-lines-table">
            <thead>
                <tr>
                    <th style="width:32px;">#</th>
                    <th><?php echo e(__('sale.product'), false); ?></th>
                    <th><?php echo e(__('product.category'), false); ?></th>
                    <th class="r"><?php echo e(__('stock_adjustment.on_hand'), false); ?></th>
                    <th class="r"><?php echo e(__('lang_v1.quantity'), false); ?></th>
                    <th class="r"><?php echo e(__('lang_v1.batch_quantity'), false); ?></th>
                    <th class="r"><?php echo e(__('manufacturing::lang.produced_qty'), false); ?></th>
                    <th style="width:90px;"><?php echo e(__('sale.status'), false); ?></th>
                    <th class="r"><?php echo e(__('manufacturing::lang.estimated_cost'), false); ?></th>
                    <th class="r"><?php echo e(__('manufacturing::lang.total_selling_price'), false); ?></th>
                    <th><?php echo e(__('manufacturing::lang.line_notes'), false); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $demand_order->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $product_name = $line->product->type == 'variable'
                        ? $line->product->name . ' - ' . $line->variation->product_variation->name . ' - ' . $line->variation->name
                        : $line->product->name;
                    $unit_name = $line->subUnit
                        ? $line->subUnit->short_name
                        : ($line->product->unit->short_name ?? '');
                ?>
                <tr>
                    <td><?php echo e($index + 1, false); ?></td>
                    <td>
                        <?php echo e($product_name, false); ?>

                        <span class="do-sku">(<?php echo e($line->variation->sub_sku, false); ?>)</span>
                    </td>
                    <td><?php echo e($line->product->category->name ?? '--', false); ?></td>
                    <td class="r"><?php echo e(number_format($line->on_hand_qty ?? 0, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($unit_name, false); ?></td>
                    <td class="r"><?php echo e(number_format($line->quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($unit_name, false); ?></td>
                    <td class="r"><?php echo e(number_format($line->batch_quantity ?? 0, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($unit_name, false); ?></td>
                    <td class="r"><?php echo e(number_format($line->produced_quantity ?? 0, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($unit_name, false); ?></td>
                    <td><?php echo e(str_replace('_', ' ', ucfirst($line->line_status ?? 'pending')), false); ?></td>
                    <td class="r"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $line->estimated_cost, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                    <td class="r"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $line->quantity * ($line->variation->sell_price_inc_tax ?? 0), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                    <td><?php echo e($line->line_notes ?? '--', false); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8" class="r"><?php echo e(__('manufacturing::lang.total_estimated_cost'), false); ?>:</td>
                    <td class="r"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $demand_order->total_estimated_cost, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                    <td class="r"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $demand_order->lines->sum(fn($l) => $l->quantity * ($l->variation->sell_price_inc_tax ?? 0)), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        <!-- Signature Block -->
        <div class="do-sig-wrap">
            <div class="do-sig-col">
                <div class="do-sig-line"><?php echo e(__('manufacturing::lang.prepared_by'), false); ?></div>
            </div>
            <div class="do-sig-col">
                <div class="do-sig-line"><?php echo e(__('manufacturing::lang.received_by'), false); ?></div>
            </div>
            <div class="do-sig-col">
                <div class="do-sig-line"><?php echo e(__('manufacturing::lang.approved_by'), false); ?></div>
            </div>
        </div>

        <!-- Footer -->
        <div class="do-footer">
            <span><?php echo e($demand_order->ref_no, false); ?> &mdash; <?php echo e($business_name, false); ?></span>
            <span><?php echo e(__('manufacturing::lang.printed_on'), false); ?>: <?php echo e(now()->format('d/m/Y H:i'), false); ?></span>
        </div>

    </div><!-- /.do-page -->

    <script>
        window.onload = function () {
            window.print();
        };
    </script>
</body>
</html>
