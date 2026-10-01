<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(__('manufacturing::lang.production_details'), false); ?> — <?php echo e($production_purchase->ref_no, false); ?></title>
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
        .pp-page {
            max-width: 190mm;
            margin: 0 auto;
            padding: 10mm 8mm 14mm;
        }

        /* === Print Controls === */
        .pp-controls {
            position: fixed;
            top: 10px;
            right: 14px;
            display: flex;
            gap: 8px;
            z-index: 100;
        }
        .pp-controls button {
            padding: 7px 18px;
            font-size: 10.5pt;
            font-weight: 600;
            cursor: pointer;
            border: 2px solid #000;
            background: #fff;
            color: #000;
        }
        .pp-controls button.pp-btn-print {
            background: #000;
            color: #fff;
        }
        .pp-controls button:hover { opacity: .85; }

        /* === Document Header === */
        .pp-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2.5px solid #000;
            padding-bottom: 10px;
            margin-bottom: 14px;
        }
        .pp-header-biz-name {
            font-size: 15pt;
            font-weight: 700;
            line-height: 1.2;
        }
        .pp-header-biz-loc {
            font-size: 10pt;
            margin-top: 3px;
        }
        .pp-header-right { text-align: right; }
        .pp-header-title {
            font-size: 17pt;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            line-height: 1.1;
        }
        .pp-header-ref {
            font-size: 10pt;
            margin-top: 4px;
        }

        /* === Meta Grid === */
        .pp-meta-wrap {
            display: flex;
            gap: 30px;
            margin-bottom: 14px;
        }
        .pp-meta-col { flex: 1; min-width: 0; }
        .pp-meta-row {
            display: flex;
            align-items: baseline;
            margin-bottom: 4px;
            font-size: 10.5pt;
            line-height: 1.5;
        }
        .pp-meta-label {
            width: 140px;
            flex-shrink: 0;
            font-weight: 700;
        }
        .pp-meta-value { flex: 1; }

        /* === Status Tag === */
        .pp-status-tag {
            display: inline-block;
            border: 1px solid #000;
            padding: 1px 6px;
            font-size: 9.5pt;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        /* === Section Title === */
        .pp-section-title {
            font-size: 9.5pt;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .07em;
            border-bottom: 1.5px solid #000;
            padding-bottom: 4px;
            margin: 16px 0 8px;
        }

        /* === Summary Strip === */
        .pp-summary {
            display: flex;
            gap: 0;
            border-top: 1px solid #bbb;
            border-bottom: 1px solid #bbb;
            margin-bottom: 14px;
        }
        .pp-summary-item {
            flex: 1;
            padding: 7px 10px;
            border-right: 1px solid #bbb;
        }
        .pp-summary-item:last-child { border-right: 0; }
        .pp-summary-label {
            display: block;
            font-size: 8.5pt;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #444;
            margin-bottom: 2px;
        }
        .pp-summary-value { font-size: 11pt; font-weight: 700; }

        /* === Ingredients Table === */
        .pp-table {
            width: 100%;
            border-collapse: collapse;
        }
        .pp-table thead tr th {
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
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .pp-table thead tr th.r { text-align: right; }
        .pp-table tbody tr td {
            font-size: 10pt;
            padding: 5px 6px;
            border: 1px solid #ccc;
            vertical-align: top;
        }
        .pp-table tbody tr:nth-child(even) td {
            background: #f2f2f2;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .pp-table td.r { text-align: right; }
        .pp-table tfoot tr td {
            font-size: 10.5pt;
            font-weight: 700;
            padding: 6px 6px;
            border-top: 2px solid #000;
            border-left: 0;
            border-right: 0;
            border-bottom: 0;
            background: #fff;
        }
        .pp-table tfoot tr td.r { text-align: right; }
        .pp-lot { font-size: 9pt; color: #555; }

        /* === Group Row === */
        .pp-group-row td {
            background: #e8e8e8 !important;
            font-weight: 700;
            font-size: 10pt;
            padding: 4px 6px !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* === Notes === */
        .pp-notes {
            font-size: 10.5pt;
            margin-top: 6px;
            line-height: 1.6;
        }

        /* === Footer === */
        .pp-footer {
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
            .pp-page { max-width: 100%; padding: 0; margin: 0; }
            .pp-controls { display: none !important; }
        }
    </style>
</head>
<body>

    <!-- Print Controls -->
    <div class="pp-controls">
        <button class="pp-btn-print" onclick="window.print();">
            &#9113; <?php echo e(__('messages.print'), false); ?>

        </button>
        <button onclick="window.close();">
            &times; <?php echo e(__('messages.close'), false); ?>

        </button>
    </div>

    <div class="pp-page">

        <!-- Document Header -->
        <div class="pp-header">
            <div>
                <div class="pp-header-biz-name"><?php echo e($business_name, false); ?></div>
                <?php if($production_purchase->location): ?>
                    <div class="pp-header-biz-loc"><?php echo e($production_purchase->location->name, false); ?></div>
                <?php endif; ?>
            </div>
            <div class="pp-header-right">
                <div class="pp-header-title"><?php echo e(__('manufacturing::lang.production_details'), false); ?></div>
                <div class="pp-header-ref"><?php echo e(__('purchase.ref_no'), false); ?>: <strong><?php echo e($production_purchase->ref_no, false); ?></strong></div>
                <div class="pp-header-ref"><?php echo e(__('messages.date'), false); ?>: <strong><?php echo e(\Carbon\Carbon::parse($production_purchase->transaction_date)->format(session('business.date_format', 'd/m/Y')), false); ?></strong></div>
            </div>
        </div>

        <!-- Summary Strip -->
        <div class="pp-summary">
            <div class="pp-summary-item">
                <span class="pp-summary-label"><?php echo e(__('sale.product'), false); ?></span>
                <span class="pp-summary-value"><?php echo e($purchase_line->variations->full_name, false); ?></span>
            </div>
            <div class="pp-summary-item">
                <span class="pp-summary-label"><?php echo e(__('lang_v1.quantity'), false); ?></span>
                <span class="pp-summary-value">
                    <?php echo e(number_format($quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($unit_name, false); ?>

                </span>
            </div>
            <div class="pp-summary-item">
                <span class="pp-summary-label"><?php echo e(__('manufacturing::lang.waste_units'), false); ?></span>
                <span class="pp-summary-value">
                    <?php echo e(number_format($quantity_wasted, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($unit_name, false); ?>

                </span>
            </div>
            <div class="pp-summary-item">
                <span class="pp-summary-label"><?php echo e(__('manufacturing::lang.total_cost'), false); ?></span>
                <span class="pp-summary-value"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $production_purchase->final_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span>
            </div>
        </div>

        <!-- Order Meta -->
        <div class="pp-meta-wrap">
            <div class="pp-meta-col">
                <div class="pp-meta-row">
                    <span class="pp-meta-label"><?php echo e(__('purchase.purchase_status'), false); ?>:</span>
                    <span class="pp-meta-value"><?php echo e(ucfirst($production_purchase->status), false); ?></span>
                </div>
                <div class="pp-meta-row">
                    <span class="pp-meta-label"><?php echo e(__('purchase.payment_status'), false); ?>:</span>
                    <span class="pp-meta-value"><?php echo e(ucfirst($production_purchase->payment_status), false); ?></span>
                </div>
                <?php if(!empty($production_purchase->mfg_production_status)): ?>
                <div class="pp-meta-row">
                    <span class="pp-meta-label"><?php echo e(__('manufacturing::lang.production_status'), false); ?>:</span>
                    <span class="pp-meta-value">
                        <span class="pp-status-tag"><?php echo e(str_replace('_', ' ', strtoupper($production_purchase->mfg_production_status)), false); ?></span>
                    </span>
                </div>
                <?php endif; ?>
                <?php if(!empty($production_purchase->mfg_priority)): ?>
                <div class="pp-meta-row">
                    <span class="pp-meta-label"><?php echo e(__('manufacturing::lang.priority'), false); ?>:</span>
                    <span class="pp-meta-value">
                        <span class="pp-status-tag"><?php echo e(strtoupper($production_purchase->mfg_priority), false); ?></span>
                    </span>
                </div>
                <?php endif; ?>
            </div>
            <div class="pp-meta-col">
                <?php if(!empty($production_purchase->mfg_batch_number)): ?>
                <div class="pp-meta-row">
                    <span class="pp-meta-label"><?php echo e(__('manufacturing::lang.batch_number'), false); ?>:</span>
                    <span class="pp-meta-value"><?php echo e($production_purchase->mfg_batch_number, false); ?></span>
                </div>
                <?php endif; ?>
                <?php if(!empty($production_purchase->mfg_due_date)): ?>
                <div class="pp-meta-row">
                    <span class="pp-meta-label"><?php echo e(__('manufacturing::lang.due_date'), false); ?>:</span>
                    <span class="pp-meta-value"><?php echo e(\Carbon\Carbon::parse($production_purchase->mfg_due_date)->format(session('business.date_format', 'd/m/Y')), false); ?></span>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_lot_number') == 1): ?>
                <div class="pp-meta-row">
                    <span class="pp-meta-label"><?php echo e(__('lang_v1.lot_number'), false); ?>:</span>
                    <span class="pp-meta-value"><?php echo e($purchase_line->lot_number ?? '--', false); ?></span>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_product_expiry') && !empty($purchase_line->exp_date)): ?>
                <div class="pp-meta-row">
                    <span class="pp-meta-label"><?php echo e(__('product.exp_date'), false); ?>:</span>
                    <span class="pp-meta-value"><?php echo e(\Carbon\Carbon::parse($purchase_line->exp_date)->format(session('business.date_format', 'd/m/Y')), false); ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Ingredients -->
        <div class="pp-section-title"><?php echo e(__('manufacturing::lang.ingredients'), false); ?></div>

        <table class="pp-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo e(__('manufacturing::lang.ingredient'), false); ?></th>
                    <th class="r"><?php echo e(__('manufacturing::lang.input_quantity'), false); ?></th>
                    <th class="r"><?php echo e(__('manufacturing::lang.waste_percent'), false); ?></th>
                    <th class="r"><?php echo e(__('manufacturing::lang.final_quantity'), false); ?></th>
                    <th class="r"><?php echo e(__('manufacturing::lang.total_price'), false); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $row_num = 1; ?>

                
                <?php $__currentLoopData = $ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($row_num++, false); ?></td>
                    <td>
                        <?php echo e($ingredient['full_name'], false); ?>

                        <?php if(!empty($ingredient['lot_numbers'])): ?>
                            <span class="pp-lot"><br><?php echo e(__('lang_v1.lot_n_expiry'), false); ?>: <?php echo e($ingredient['lot_numbers'], false); ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="r"><?php echo e(number_format($ingredient['quantity'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($ingredient['unit'], false); ?></td>
                    <td class="r"><?php echo e(number_format($ingredient['waste_percent'], 2), false); ?> %</td>
                    <td class="r"><?php echo e(number_format($ingredient['final_quantity'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($ingredient['unit'], false); ?></td>
                    <td class="r"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $ingredient['total_price'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                <?php $__currentLoopData = $ingredient_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="pp-group-row">
                    <td colspan="6">
                        <?php echo e($group['ig_name'] ?? '', false); ?>

                        <?php if(!empty($group['ig_description'])): ?> &mdash; <?php echo e($group['ig_description'], false); ?> <?php endif; ?>
                    </td>
                </tr>
                <?php $__currentLoopData = $group['ig_ingredients']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($row_num++, false); ?></td>
                    <td>
                        &nbsp;&nbsp;<?php echo e($ingredient['full_name'], false); ?>

                        <?php if(!empty($ingredient['lot_numbers'])): ?>
                            <span class="pp-lot"><br><?php echo e(__('lang_v1.lot_n_expiry'), false); ?>: <?php echo e($ingredient['lot_numbers'], false); ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="r"><?php echo e(number_format($ingredient['quantity'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($ingredient['unit'], false); ?></td>
                    <td class="r"><?php echo e(number_format($ingredient['waste_percent'], 2), false); ?> %</td>
                    <td class="r"><?php echo e(number_format($ingredient['final_quantity'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($ingredient['unit'], false); ?></td>
                    <td class="r"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $ingredient['total_price'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="r"><?php echo e(__('manufacturing::lang.ingredients_cost'), false); ?>:</td>
                    <td class="r"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_ingredients_price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                </tr>
                <?php if(!empty($total_production_cost) && $total_production_cost > 0): ?>
                <tr>
                    <td colspan="5" class="r"><?php echo e(__('manufacturing::lang.production_cost'), false); ?>:</td>
                    <td class="r"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_production_cost, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                </tr>
                <?php endif; ?>
                <?php if(!empty($production_purchase->mfg_labor_cost) && $production_purchase->mfg_labor_cost > 0): ?>
                <tr>
                    <td colspan="5" class="r"><?php echo e(__('manufacturing::lang.labor_cost'), false); ?>:</td>
                    <td class="r"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $production_purchase->mfg_labor_cost, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                </tr>
                <?php endif; ?>
                <?php if(!empty($production_purchase->mfg_overhead_cost) && $production_purchase->mfg_overhead_cost > 0): ?>
                <tr>
                    <td colspan="5" class="r"><?php echo e(__('manufacturing::lang.overhead_cost'), false); ?>:</td>
                    <td class="r"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $production_purchase->mfg_overhead_cost, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                </tr>
                <?php endif; ?>
                <tr>
                    <td colspan="5" class="r"><?php echo e(__('manufacturing::lang.total_cost'), false); ?>:</td>
                    <td class="r"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $production_purchase->final_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                </tr>
            </tfoot>
        </table>

        
        <?php if(!empty($production_purchase->mfg_expected_quantity) || !empty($production_purchase->mfg_actual_quantity)): ?>
        <?php
            $yield_eff = 0;
            if (!empty($production_purchase->mfg_expected_quantity) && $production_purchase->mfg_expected_quantity > 0 && !empty($production_purchase->mfg_actual_quantity)) {
                $yield_eff = round(($production_purchase->mfg_actual_quantity / $production_purchase->mfg_expected_quantity) * 100, 2);
            }
        ?>
        <div class="pp-section-title"><?php echo e(__('manufacturing::lang.yield_tracking'), false); ?></div>
        <div class="pp-meta-wrap">
            <div class="pp-meta-col">
                <div class="pp-meta-row">
                    <span class="pp-meta-label"><?php echo e(__('manufacturing::lang.expected_quantity'), false); ?>:</span>
                    <span class="pp-meta-value">
                        <?php echo e(!empty($production_purchase->mfg_expected_quantity)
                            ? number_format($production_purchase->mfg_expected_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) . ' ' . $unit_name
                            : '--', false); ?>

                    </span>
                </div>
            </div>
            <div class="pp-meta-col">
                <div class="pp-meta-row">
                    <span class="pp-meta-label"><?php echo e(__('manufacturing::lang.actual_quantity'), false); ?>:</span>
                    <span class="pp-meta-value">
                        <?php echo e(!empty($production_purchase->mfg_actual_quantity)
                            ? number_format($production_purchase->mfg_actual_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) . ' ' . $unit_name
                            : '--', false); ?>

                    </span>
                </div>
            </div>
            <div class="pp-meta-col">
                <div class="pp-meta-row">
                    <span class="pp-meta-label"><?php echo e(__('manufacturing::lang.yield_efficiency'), false); ?>:</span>
                    <span class="pp-meta-value"><strong><?php echo e($yield_eff, false); ?>%</strong></span>
                </div>
            </div>
        </div>
        <?php endif; ?>

        
        <?php if(!empty($production_purchase->mfg_notes)): ?>
        <div class="pp-section-title"><?php echo e(__('manufacturing::lang.production_notes'), false); ?></div>
        <div class="pp-notes"><?php echo e($production_purchase->mfg_notes, false); ?></div>
        <?php endif; ?>

        <!-- Footer -->
        <div class="pp-footer">
            <span><?php echo e($production_purchase->ref_no, false); ?> &mdash; <?php echo e($business_name, false); ?></span>
            <span><?php echo e(__('manufacturing::lang.printed_on'), false); ?>: <?php echo e(now()->format('d/m/Y H:i'), false); ?></span>
        </div>

    </div><!-- /.pp-page -->

    <script>
        window.onload = function () {
            window.print();
        };
    </script>
</body>
</html>
