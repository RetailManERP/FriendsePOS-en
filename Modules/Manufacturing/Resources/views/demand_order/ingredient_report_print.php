<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('manufacturing/demand-ingredient-report-print');
    $total_pages = 0;
    $max_columns = 0;
    foreach ($sections as $section) {
        $total_pages += count($section['pages'] ?? [[]]);
        $max_columns = max($max_columns, count($section['columns'] ?? []));
    }
    $total_pages = max($total_pages, 1);
    $qty_precision = $quantity_precision ?? session('business.quantity_precision', 2);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';
    $page_label = __('lang_v1.page');
    if ($page_label == 'lang_v1.page') {
        $page_label = 'Page';
    }

    if (! function_exists('_dir_print_table_font')) {
        function _dir_print_table_font($column_count, $section_key = '', $orientation = 'landscape') {
            if ($section_key === 'product_wise') {
                if ($orientation === 'portrait') {
                    return ['5.5pt', '5pt', '1px 1.5px'];
                }

                return ['7.6pt', '6.8pt', '3px 5px'];
            }

            if ($section_key === 'category_wise') {
                if ($orientation === 'portrait') {
                    return ['8pt', '7pt', '2px 3.5px'];
                }

                return ['7.6pt', '6.8pt', '3px 5px'];
            }

            if (in_array($section_key, ['all_ingredients_summary', 'batch_ingredients_summary'], true)) {
                if ($orientation === 'portrait') {
                    return ['5.8pt', '5.1pt', '1px 1.5px'];
                }

                return ['7.6pt', '6.8pt', '3px 5px'];
            }

            if ($section_key === 'all_ingredients') {
                return ['6.2pt', '5.5pt', '1.5px 2px'];
            }

            if ($column_count >= 13) {
                return ['5.8pt', '5.2pt', '2px 3px'];
            }

            if ($column_count >= 10) {
                return ['6.8pt', '6pt', '3px 4px'];
            }

            return ['7.6pt', '6.8pt', '3px 5px'];
        }
    }

    if (! function_exists('_dir_print_number')) {
        function _dir_print_number($value, $precision, $decimal_separator, $thousand_separator) {
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

        .dir-print table {
            border-collapse: collapse;
            font-size: var(--dir-table-font-size, 7pt);
            max-width: 100%;
            table-layout: auto;
            width: auto;
        }
        .dir-print table.dir-product-wise-table {
            font-size: 5.5pt !important;
            table-layout: fixed;
            width: 100%;
        }
        .dir-print table.dir-category-wise-table {
            font-size: 8pt !important;
            table-layout: fixed;
            width: 100%;
        }
        .dir-print table.dir-all-ingredients-summary-table {
            font-size: 5.8pt !important;
            table-layout: fixed;
            width: 100%;
        }
        .dir-print table.dir-all-ingredients-detail-table {
            font-size: 6.2pt !important;
            table-layout: fixed;
            width: 100%;
        }
        .dir-print .dir-product-wise-table th {
            font-size: 5pt !important;
            line-height: 1 !important;
            padding: 1px !important;
        }
        .dir-print .dir-category-wise-table th {
            font-size: 7pt !important;
            line-height: 1.05 !important;
            padding: 2px 3px !important;
        }
        .dir-print .dir-all-ingredients-summary-table th {
            font-size: 5.1pt !important;
            line-height: 1 !important;
            padding: 1px !important;
        }
        .dir-print .dir-all-ingredients-detail-table th {
            font-size: 5.5pt !important;
            line-height: 1 !important;
            padding: 1.5px !important;
        }
        .dir-print .dir-product-wise-table td {
            font-size: 5.5pt !important;
            line-height: 1.02 !important;
            padding: 1px 1.5px !important;
        }
        .dir-print .dir-category-wise-table td {
            font-size: 8pt !important;
            line-height: 1.1 !important;
            padding: 2px 3.5px !important;
        }
        .dir-print .dir-all-ingredients-summary-table td {
            font-size: 5.8pt !important;
            line-height: 1.04 !important;
            padding: 1px 1.5px !important;
        }
        .dir-print .dir-all-ingredients-detail-table td {
            font-size: 6.2pt !important;
            line-height: 1.05 !important;
            padding: 1.5px 2px !important;
        }
        .dir-print .dir-product-wise-table th:nth-child(1),
        .dir-print .dir-product-wise-table td:nth-child(1) { width: 3%; }
        .dir-print .dir-product-wise-table th:nth-child(2),
        .dir-print .dir-product-wise-table td:nth-child(2) { width: 15%; }
        .dir-print .dir-product-wise-table th:nth-child(3),
        .dir-print .dir-product-wise-table td:nth-child(3) { width: 6%; }
        .dir-print .dir-product-wise-table th:nth-child(4),
        .dir-print .dir-product-wise-table td:nth-child(4) { width: 9%; }
        .dir-print .dir-product-wise-table th:nth-child(5),
        .dir-print .dir-product-wise-table td:nth-child(5) { width: 20%; }
        .dir-print .dir-product-wise-table th:nth-child(6),
        .dir-print .dir-product-wise-table td:nth-child(6) { width: 13%; }
        .dir-print .dir-product-wise-table th:nth-child(7),
        .dir-print .dir-product-wise-table td:nth-child(7) { width: 8%; }
        .dir-print .dir-product-wise-table th:nth-child(8),
        .dir-print .dir-product-wise-table td:nth-child(8) { width: 4%; }
        .dir-print .dir-product-wise-table th:nth-child(9),
        .dir-print .dir-product-wise-table td:nth-child(9) { width: 11%; }
        .dir-print .dir-product-wise-table th:nth-child(10),
        .dir-print .dir-product-wise-table td:nth-child(10) { width: 11%; }
        .dir-print .dir-category-wise-table th:nth-child(1),
        .dir-print .dir-category-wise-table td:nth-child(1) { width: 4%; }
        .dir-print .dir-category-wise-table th:nth-child(2),
        .dir-print .dir-category-wise-table td:nth-child(2) { width: 22%; }
        .dir-print .dir-category-wise-table th:nth-child(3),
        .dir-print .dir-category-wise-table td:nth-child(3) { width: 21%; }
        .dir-print .dir-category-wise-table th:nth-child(4),
        .dir-print .dir-category-wise-table td:nth-child(4) { width: 16%; }
        .dir-print .dir-category-wise-table th:nth-child(5),
        .dir-print .dir-category-wise-table td:nth-child(5) { width: 8%; }
        .dir-print .dir-category-wise-table th:nth-child(6),
        .dir-print .dir-category-wise-table td:nth-child(6) { width: 11%; }
        .dir-print .dir-category-wise-table th:nth-child(7),
        .dir-print .dir-category-wise-table td:nth-child(7) { width: 11%; }
        .dir-print .dir-category-wise-table th:nth-child(8),
        .dir-print .dir-category-wise-table td:nth-child(8) { width: 7%; }
        .dir-print .dir-all-ingredients-summary-table th:nth-child(1),
        .dir-print .dir-all-ingredients-summary-table td:nth-child(1) { width: 3%; }
        .dir-print .dir-all-ingredients-summary-table th:nth-child(2),
        .dir-print .dir-all-ingredients-summary-table td:nth-child(2) { width: 18%; }
        .dir-print .dir-all-ingredients-summary-table th:nth-child(3),
        .dir-print .dir-all-ingredients-summary-table td:nth-child(3) { width: 6%; }
        .dir-print .dir-all-ingredients-summary-table th:nth-child(4),
        .dir-print .dir-all-ingredients-summary-table td:nth-child(4) { width: 10%; }
        .dir-print .dir-all-ingredients-summary-table th:nth-child(5),
        .dir-print .dir-all-ingredients-summary-table td:nth-child(5) { width: 17%; }
        .dir-print .dir-all-ingredients-summary-table th:nth-child(6),
        .dir-print .dir-all-ingredients-summary-table td:nth-child(6) { width: 12%; }
        .dir-print .dir-all-ingredients-summary-table th:nth-child(7),
        .dir-print .dir-all-ingredients-summary-table td:nth-child(7) { width: 8%; }
        .dir-print .dir-all-ingredients-summary-table th:nth-child(8),
        .dir-print .dir-all-ingredients-summary-table td:nth-child(8) { width: 4%; }
        .dir-print .dir-all-ingredients-summary-table th:nth-child(9),
        .dir-print .dir-all-ingredients-summary-table td:nth-child(9) { width: 7%; }
        .dir-print .dir-all-ingredients-summary-table th:nth-child(10),
        .dir-print .dir-all-ingredients-summary-table td:nth-child(10) { width: 8%; }
        .dir-print .dir-all-ingredients-summary-table th:nth-child(11),
        .dir-print .dir-all-ingredients-summary-table td:nth-child(11) { width: 7%; }
        .dir-print .dir-all-ingredients-detail-table th:nth-child(1),
        .dir-print .dir-all-ingredients-detail-table td:nth-child(1) { width: 3%; }
        .dir-print .dir-all-ingredients-detail-table th:nth-child(2),
        .dir-print .dir-all-ingredients-detail-table td:nth-child(2) { width: 8%; }
        .dir-print .dir-all-ingredients-detail-table th:nth-child(3),
        .dir-print .dir-all-ingredients-detail-table td:nth-child(3) { width: 14%; }
        .dir-print .dir-all-ingredients-detail-table th:nth-child(4),
        .dir-print .dir-all-ingredients-detail-table td:nth-child(4) { width: 5%; }
        .dir-print .dir-all-ingredients-detail-table th:nth-child(5),
        .dir-print .dir-all-ingredients-detail-table td:nth-child(5) { width: 8%; }
        .dir-print .dir-all-ingredients-detail-table th:nth-child(6),
        .dir-print .dir-all-ingredients-detail-table td:nth-child(6) { width: 12%; }
        .dir-print .dir-all-ingredients-detail-table th:nth-child(7),
        .dir-print .dir-all-ingredients-detail-table td:nth-child(7) { width: 10%; }
        .dir-print .dir-all-ingredients-detail-table th:nth-child(8),
        .dir-print .dir-all-ingredients-detail-table td:nth-child(8) { width: 7%; }
        .dir-print .dir-all-ingredients-detail-table th:nth-child(9),
        .dir-print .dir-all-ingredients-detail-table td:nth-child(9) { width: 7%; }
        .dir-print .dir-all-ingredients-detail-table th:nth-child(10),
        .dir-print .dir-all-ingredients-detail-table td:nth-child(10) { width: 7%; }
        .dir-print .dir-all-ingredients-detail-table th:nth-child(11),
        .dir-print .dir-all-ingredients-detail-table td:nth-child(11) { width: 4%; }
        .dir-print .dir-all-ingredients-detail-table th:nth-child(12),
        .dir-print .dir-all-ingredients-detail-table td:nth-child(12) { width: 5%; }
        .dir-print .dir-all-ingredients-detail-table th:nth-child(13),
        .dir-print .dir-all-ingredients-detail-table td:nth-child(13) { width: 5%; }
        .dir-print .dir-all-ingredients-detail-table th:nth-child(14),
        .dir-print .dir-all-ingredients-detail-table td:nth-child(14) { width: 5%; }
        .dir-print th,
        .dir-print td {
            border: 1px solid #d2d2d2;
            line-height: 1.12;
            overflow-wrap: anywhere;
            padding: var(--dir-table-cell-padding, 3px 4px);
            text-align: left;
            vertical-align: top;
            white-space: normal;
            word-break: break-word;
        }
        .dir-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: var(--dir-table-header-font-size, 6.4pt);
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .dir-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .dir-print .child-row td {
            color: #333;
            font-size: 92%;
        }
        .dir-print .text-right {
            text-align: right;
            white-space: nowrap;
        }
        .dir-print .dir-table-wrap {
            max-width: 100%;
            overflow: visible;
        }
        .dir-print .money-cell {
            background: #f8fbff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .dir-print .section-title {
            border-bottom: 1px solid #333;
            font-size: 11pt;
            font-weight: 800;
            margin: 0 0 8px;
            padding-bottom: 4px;
            text-transform: uppercase;
        }
        .dir-print .total-row td {
            background: #e8e8e8 !important;
            border-top: 2px solid #1a1a1a;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .dir-print .empty-row {
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

<div class="cr-stage dir-print" id="crStage">
    <?php $page_no = 0; ?>
    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $section['pages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $page_no++; ?>
            <div class="cr-sheet" id="crPage<?php echo e($page_no, false); ?>">
                <?php echo $__env->make('manufacturing::demand_order.partials.ingredient_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="section-title"><?php echo e($section['title'], false); ?></div>
                <?php
                    [$section_font_size, $section_header_font_size, $section_cell_padding] = _dir_print_table_font(
                        count($section['columns'] ?? []),
                        $section['key'] ?? '',
                        $orientation
                    );
                ?>
                <div class="dir-table-wrap">
                    <table class="<?php if(($section['key'] ?? '') === 'product_wise'): ?> dir-product-wise-table <?php elseif(($section['key'] ?? '') === 'category_wise'): ?> dir-category-wise-table <?php elseif(in_array(($section['key'] ?? ''), ['all_ingredients_summary', 'batch_ingredients_summary'], true)): ?> dir-all-ingredients-summary-table <?php elseif(($section['key'] ?? '') === 'all_ingredients'): ?> dir-all-ingredients-detail-table <?php endif; ?>" style="--dir-table-font-size: <?php echo e($section_font_size, false); ?>; --dir-table-header-font-size: <?php echo e($section_header_font_size, false); ?>; --dir-table-cell-padding: <?php echo e($section_cell_padding, false); ?>;">
                        <thead>
                            <tr>
                                <?php $__currentLoopData = $section['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $type = $column['type'] ?? 'text'; ?>
                                    <th class="<?php echo e(in_array($type, ['money', 'qty', 'number', 'percent'], true) ? 'text-right' : '', false); ?>">
                                        <?php echo e($column['label'], false); ?>

                                        <?php if($type === 'money' && ! empty($currency_symbol)): ?>
                                            (<?php echo e($currency_symbol, false); ?>)
                                        <?php endif; ?>
                                    </th>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($section['rows'])): ?>
                                <tr>
                                    <td colspan="<?php echo e(max(count($section['columns']), 1), false); ?>" class="empty-row"><?php echo e(__('lang_v1.no_records_found'), false); ?></td>
                                </tr>
                            <?php else: ?>
                                <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="<?php echo e(($row['_row_type'] ?? '') == 'child' ? 'child-row' : '', false); ?>">
                                        <?php $__currentLoopData = $section['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $key = $column['key'];
                                                $type = $column['type'] ?? 'text';
                                                $value = $row[$key] ?? '';
                                            ?>
                                            <td class="<?php echo e(in_array($type, ['money', 'qty', 'number', 'percent'], true) ? 'text-right' : '', false); ?> <?php echo e($type === 'money' ? 'money-cell' : '', false); ?>">
                                                <?php if($value === '' || $value === null): ?>
                                                    <?php echo e('', false); ?>

                                                <?php elseif($type === 'money'): ?>
                                                    <?php echo e(_dir_print_number($value, 2, $decimal_separator, $thousand_separator), false); ?>

                                                <?php elseif($type === 'qty'): ?>
                                                    <?php echo e(_dir_print_number($value, $qty_precision, $decimal_separator, $thousand_separator), false); ?>

                                                <?php elseif($type === 'number'): ?>
                                                    <?php echo e(_dir_print_number($value, 0, $decimal_separator, $thousand_separator), false); ?>

                                                <?php elseif($type === 'percent'): ?>
                                                    <?php echo e(_dir_print_number($value, 1, $decimal_separator, $thousand_separator), false); ?>%
                                                <?php else: ?>
                                                    <?php echo e($value, false); ?>

                                                <?php endif; ?>
                                            </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>

                        <?php if(! empty($section['rows']) && $loop->last): ?>
                            <tfoot>
                                <tr class="total-row">
                                    <?php $__currentLoopData = $section['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $type = $column['type'] ?? 'text';
                                            $total = $section['totals'][$column['key']] ?? null;
                                        ?>
                                        <?php if($loop->first): ?>
                                            <td><?php echo e(__('sale.total'), false); ?></td>
                                        <?php elseif(! empty($column['total']) && $total !== null): ?>
                                            <td class="text-right">
                                                <?php if($type === 'money'): ?>
                                                    <?php echo e(_dir_print_number($total, 2, $decimal_separator, $thousand_separator), false); ?>

                                                <?php elseif($type === 'qty'): ?>
                                                    <?php echo e(_dir_print_number($total, $qty_precision, $decimal_separator, $thousand_separator), false); ?>

                                                <?php else: ?>
                                                    <?php echo e(_dir_print_number($total, 0, $decimal_separator, $thousand_separator), false); ?>

                                                <?php endif; ?>
                                            </td>
                                        <?php else: ?>
                                            <td></td>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                            </tfoot>
                        <?php endif; ?>
                    </table>
                </div>

                <div class="cr-foot">
                    <span><?php echo e($business_name, false); ?> - <?php echo e($section['title'], false); ?></span>
                    <span><?php echo e($page_label, false); ?> <?php echo e($page_no, false); ?> / <?php echo e($total_pages, false); ?></span>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
</body>
</html>
