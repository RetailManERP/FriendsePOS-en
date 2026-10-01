<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(__('manufacturing::lang.recipe'), false); ?> — <?php echo e($recipe->variation->full_name, false); ?></title>
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
        .rp-page {
            max-width: 190mm;
            margin: 0 auto;
            padding: 10mm 8mm 14mm;
        }

        /* === Print Controls (hidden on print) === */
        .rp-controls {
            position: fixed;
            top: 10px;
            right: 14px;
            display: flex;
            gap: 8px;
            z-index: 100;
        }
        .rp-controls button {
            padding: 7px 18px;
            font-size: 10.5pt;
            font-weight: 600;
            cursor: pointer;
            border: 2px solid #000;
            background: #fff;
            color: #000;
        }
        .rp-controls button.rp-btn-print {
            background: #000;
            color: #fff;
        }
        .rp-controls button:hover { opacity: .85; }

        /* === Document Header === */
        .rp-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2.5px solid #000;
            padding-bottom: 10px;
            margin-bottom: 14px;
        }
        .rp-header-biz-name {
            font-size: 15pt;
            font-weight: 700;
            line-height: 1.2;
        }
        .rp-header-right {
            text-align: right;
        }
        .rp-header-title {
            font-size: 17pt;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            line-height: 1.1;
        }
        .rp-header-sub {
            font-size: 10pt;
            margin-top: 4px;
        }

        /* === Recipe Title Block === */
        .rp-recipe-title {
            font-size: 14pt;
            font-weight: 700;
            margin-bottom: 4px;
        }
        .rp-recipe-sku {
            font-size: 9.5pt;
            color: #444;
        }

        /* === Summary Row === */
        .rp-summary {
            display: flex;
            gap: 30px;
            margin: 12px 0 14px;
            border-top: 1px solid #bbb;
            border-bottom: 1px solid #bbb;
            padding: 8px 0;
        }
        .rp-summary-item {
            flex: 1;
            font-size: 10.5pt;
        }
        .rp-summary-label {
            font-weight: 700;
            display: block;
            font-size: 9pt;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #444;
            margin-bottom: 2px;
        }

        /* === Section Title === */
        .rp-section-title {
            font-size: 9.5pt;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .07em;
            border-bottom: 1.5px solid #000;
            padding-bottom: 4px;
            margin: 16px 0 8px;
        }

        /* === Ingredients Table === */
        .rp-table {
            width: 100%;
            border-collapse: collapse;
        }
        .rp-table thead tr th {
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
        .rp-table thead tr th.r { text-align: right; }
        .rp-table tbody tr td {
            font-size: 10pt;
            padding: 5px 6px;
            border: 1px solid #ccc;
            vertical-align: top;
        }
        .rp-table tbody tr:nth-child(even) td {
            background: #f2f2f2;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .rp-table td.r { text-align: right; }
        .rp-table tfoot tr td {
            font-size: 10.5pt;
            font-weight: 700;
            padding: 6px 6px;
            border-top: 2px solid #000;
            border-left: 0;
            border-right: 0;
            border-bottom: 0;
            background: #fff;
        }
        .rp-table tfoot tr td.r { text-align: right; }

        /* === Group Row === */
        .rp-group-row td {
            background: #e8e8e8 !important;
            font-weight: 700;
            font-size: 10pt;
            padding: 4px 6px !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* === Instructions === */
        .rp-instructions {
            font-size: 10.5pt;
            line-height: 1.6;
            margin-top: 6px;
        }
        .rp-instructions p { margin-bottom: 6px; }

        /* === Footer === */
        .rp-footer {
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
            .rp-page {
                max-width: 100%;
                padding: 0;
                margin: 0;
            }
            .rp-controls { display: none !important; }
        }
    </style>
</head>
<body>

    <!-- Print Controls -->
    <div class="rp-controls">
        <button class="rp-btn-print" onclick="window.print();">
            &#9113; <?php echo e(__('messages.print'), false); ?>

        </button>
        <button onclick="window.close();">
            &times; <?php echo e(__('messages.close'), false); ?>

        </button>
    </div>

    <div class="rp-page">

        <!-- Document Header -->
        <div class="rp-header">
            <div>
                <div class="rp-header-biz-name"><?php echo e($business_name, false); ?></div>
            </div>
            <div class="rp-header-right">
                <div class="rp-header-title"><?php echo e(__('manufacturing::lang.recipe'), false); ?></div>
                <div class="rp-header-sub"><?php echo e(now()->format('d/m/Y H:i'), false); ?></div>
            </div>
        </div>

        <!-- Recipe Identity -->
        <div class="rp-recipe-title"><?php echo e($recipe->variation->full_name, false); ?></div>
        <div class="rp-recipe-sku"><?php echo e(__('lang_v1.sku'), false); ?>: <?php echo e($recipe->variation->sub_sku, false); ?></div>

        <!-- Summary -->
        <?php
            $total_output_qty = $recipe->total_quantity ?? 0;
            $unit_label = !empty($recipe->sub_unit) ? $recipe->sub_unit->short_name : ($recipe->variation->product->unit->short_name ?? '');
            if (!empty($recipe->waste_percent)) {
                $net_output = $total_output_qty - ($total_output_qty * $recipe->waste_percent / 100);
            } else {
                $net_output = $total_output_qty;
            }
        ?>
        <div class="rp-summary">
            <div class="rp-summary-item">
                <span class="rp-summary-label"><?php echo e(__('manufacturing::lang.total_output_quantity'), false); ?></span>
                <?php echo e(number_format($total_output_qty, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($unit_label, false); ?>

            </div>
            <div class="rp-summary-item">
                <span class="rp-summary-label"><?php echo e(__('manufacturing::lang.wastage'), false); ?></span>
                <?php echo e($recipe->waste_percent ?? 0, false); ?> %
            </div>
            <div class="rp-summary-item">
                <span class="rp-summary-label"><?php echo e(__('manufacturing::lang.extra_cost'), false); ?></span>
                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $recipe->extra_cost, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                <?php if($recipe->production_cost_type == 'percentage'): ?> % <?php elseif($recipe->production_cost_type == 'per_unit'): ?> (<?php echo e(__('manufacturing::lang.per_unit'), false); ?>) <?php endif; ?>
            </div>
            <div class="rp-summary-item">
                <span class="rp-summary-label"><?php echo e(__('sale.total'), false); ?></span>
                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $recipe->final_price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
            </div>
        </div>

        <!-- Ingredients -->
        <div class="rp-section-title"><?php echo e(__('manufacturing::lang.ingredients'), false); ?></div>

        <?php
            $ingredient_groups = [];
            $ingredient_total_price = 0;
            $ingredient_total_qty = 0;
            $ungrouped = [];
            foreach ($ingredients as $ingredient) {
                $ing = (object) $ingredient;
                $line_price = $ingredient['quantity'] * $ingredient['dpp_inc_tax'] * $ingredient['multiplier'];
                $ingredient_total_price += $line_price;
                $ingredient_total_qty += $ingredient['quantity'];
                if (empty($ingredient['mfg_ingredient_group_id'])) {
                    $ungrouped[] = array_merge($ingredient, ['_line_price' => $line_price]);
                } else {
                    $ingredient_groups[$ingredient['mfg_ingredient_group_id']][] = array_merge($ingredient, ['_line_price' => $line_price]);
                }
            }
        ?>

        <table class="rp-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo e(__('manufacturing::lang.ingredient'), false); ?></th>
                    <th class="r"><?php echo e(__('lang_v1.quantity'), false); ?></th>
                    <th class="r"><?php echo e(__('manufacturing::lang.waste_percent'), false); ?></th>
                    <th class="r"><?php echo e(__('lang_v1.price'), false); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $row_num = 1; ?>

                
                <?php $__currentLoopData = $ungrouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($row_num++, false); ?></td>
                    <td><?php echo e($ingredient['full_name'], false); ?></td>
                    <td class="r">
                        <?php echo e(number_format($ingredient['quantity'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                        <?php echo e($ingredient['unit'], false); ?>

                    </td>
                    <td class="r"><?php echo e(number_format($ingredient['waste_percent'], 2), false); ?> %</td>
                    <td class="r"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $ingredient['_line_price'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                <?php $__currentLoopData = $ingredient_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group_id => $group_items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="rp-group-row">
                    <td colspan="5">
                        <?php echo e($group_items[0]['ingredient_group_name'], false); ?>

                        <?php if(!empty($group_items[0]['ig_description'])): ?>
                            &mdash; <?php echo e($group_items[0]['ig_description'], false); ?>

                        <?php endif; ?>
                    </td>
                </tr>
                <?php $__currentLoopData = $group_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($row_num++, false); ?></td>
                    <td>&nbsp;&nbsp;<?php echo e($ingredient['full_name'], false); ?></td>
                    <td class="r">
                        <?php echo e(number_format($ingredient['quantity'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                        <?php echo e($ingredient['unit'], false); ?>

                    </td>
                    <td class="r"><?php echo e(number_format($ingredient['waste_percent'], 2), false); ?> %</td>
                    <td class="r"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $ingredient['_line_price'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

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
                    <td colspan="2" class="r"><?php echo e(__('manufacturing::lang.ingredients_quantity'), false); ?>:</td>
                    <td class="r">
                        <?php echo e(number_format($ingredient_total_qty, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4" class="r"><?php echo e(__('manufacturing::lang.ingredients_cost'), false); ?>:</td>
                    <td class="r"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $ingredient_total_price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                </tr>
                <tr>
                    <td colspan="4" class="r"><?php echo e(__('sale.total'), false); ?>:</td>
                    <td class="r"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $recipe->final_price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                </tr>
            </tfoot>
        </table>

        <?php if(!empty($recipe->instructions)): ?>
        <div class="rp-section-title"><?php echo e(__('lang_v1.instructions'), false); ?></div>
        <div class="rp-instructions"><?php echo $recipe->instructions; ?></div>
        <?php endif; ?>

        <!-- Footer -->
        <div class="rp-footer">
            <span><?php echo e($recipe->variation->full_name, false); ?> &mdash; <?php echo e($business_name, false); ?></span>
            <span><?php echo e(__('manufacturing::lang.printed_on'), false); ?>: <?php echo e(now()->format('d/m/Y H:i'), false); ?></span>
        </div>

    </div><!-- /.rp-page -->

    <script>
        window.onload = function () {
            window.print();
        };
    </script>
</body>
</html>
