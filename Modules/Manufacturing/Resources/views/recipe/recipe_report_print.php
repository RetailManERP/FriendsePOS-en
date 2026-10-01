<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('manufacturing/recipe-report-print');
    $total_pages = count($row_pages ?? [[]]);
    $qty_precision = $quantity_precision ?? session('business.quantity_precision', 2);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';
    $page_label = __('lang_v1.page');
    if ($page_label == 'lang_v1.page') {
        $page_label = 'Page';
    }

    if (! function_exists('_recipe_report_print_number')) {
        function _recipe_report_print_number($value, $precision, $decimal_separator, $thousand_separator) {
            return number_format((float) $value, $precision, $decimal_separator, $thousand_separator);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($report_title, false); ?></title>
    <?php echo $__env->make('report.partials.crystal_report_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        @page { size: <?php echo e($page_size, false); ?>; margin: 0; }
        <?php if($is_pdf): ?>
        html, body { background: #fff !important; }
        .cr-stage { margin-top: 0; padding: 0; }
        .cr-sheet { box-shadow: none; }
        <?php endif; ?>

        .recipe-report-print table {
            border-collapse: collapse;
            font-size: 6.4pt;
            table-layout: fixed;
            width: 100%;
        }
        .recipe-report-print th,
        .recipe-report-print td {
            border: 1px solid #d2d2d2;
            line-height: 1.12;
            overflow-wrap: anywhere;
            padding: 3px 4px;
            text-align: left;
            vertical-align: top;
            white-space: normal;
            word-break: break-word;
        }
        .recipe-report-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: 5.8pt;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .recipe-report-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .recipe-report-print .product-row td {
            background: #d9e8fb !important;
            border-left: 4px solid #3c8dbc;
            font-weight: 700;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .recipe-report-print .ingredient-row td {
            background: #fdf6e3 !important;
            border-left: 4px solid #f0ad4e;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .recipe-report-print .text-right {
            text-align: right;
            white-space: nowrap;
        }
        .recipe-report-print .money-cell {
            background: #f8fbff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .recipe-report-print .total-row td {
            background: #e8e8e8 !important;
            border-top: 2px solid #1a1a1a;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .recipe-report-print .empty-row {
            color: #777;
            padding: 28px 0;
            text-align: center;
        }
    </style>
</head>
<body>
<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="cr-stage recipe-report-print" id="crStage">
    <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
            <?php echo $__env->make('manufacturing::recipe.partials.recipe_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <table>
                <thead>
                    <tr>
                        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $type = $column['type'] ?? 'text'; ?>
                            <th class="<?php echo e(in_array($type, ['money', 'qty', 'percent'], true) ? 'text-right' : '', false); ?>">
                                <?php echo e($column['label'], false); ?>

                                <?php if($type === 'money' && ! empty($currency_symbol)): ?>
                                    (<?php echo e($currency_symbol, false); ?>)
                                <?php endif; ?>
                            </th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($rows)): ?>
                        <tr>
                            <td colspan="<?php echo e(max(count($columns), 1), false); ?>" class="empty-row"><?php echo e(__('lang_v1.no_records_found'), false); ?></td>
                        </tr>
                    <?php else: ?>
                        <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="<?php echo e(($row['_row_class'] ?? '') == 'product' ? 'product-row' : 'ingredient-row', false); ?>">
                                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $key = $column['key'];
                                        $type = $column['type'] ?? 'text';
                                        $value = $row[$key] ?? '';
                                    ?>
                                    <td class="<?php echo e(in_array($type, ['money', 'qty', 'percent'], true) ? 'text-right' : '', false); ?> <?php echo e($type === 'money' ? 'money-cell' : '', false); ?>">
                                        <?php if($value === '' || $value === null): ?>
                                            <?php echo e('', false); ?>

                                        <?php elseif($type === 'money'): ?>
                                            <?php echo e(_recipe_report_print_number($value, 2, $decimal_separator, $thousand_separator), false); ?>

                                        <?php elseif($type === 'qty'): ?>
                                            <?php echo e(_recipe_report_print_number($value, $qty_precision, $decimal_separator, $thousand_separator), false); ?>

                                        <?php elseif($type === 'percent'): ?>
                                            <?php echo e(_recipe_report_print_number($value, 2, $decimal_separator, $thousand_separator), false); ?>%
                                        <?php else: ?>
                                            <?php echo e($value, false); ?>

                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>

                <?php if(! empty($rows) && $loop->last): ?>
                    <tfoot>
                        <tr class="total-row">
                            <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $type = $column['type'] ?? 'text'; ?>
                                <?php if($loop->first): ?>
                                    <td><?php echo e(__('sale.total'), false); ?></td>
                                <?php elseif(! empty($column['total']) && $type === 'money'): ?>
                                    <td class="text-right"><?php echo e(_recipe_report_print_number($totals[$column['key']] ?? 0, 2, $decimal_separator, $thousand_separator), false); ?></td>
                                <?php else: ?>
                                    <td></td>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </tfoot>
                <?php endif; ?>
            </table>

            <div class="cr-foot">
                <span><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?></span>
                <span><?php echo e($page_label, false); ?> <?php echo e($page_index + 1, false); ?> / <?php echo e($total_pages, false); ?></span>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
</body>
</html>
