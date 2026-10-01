<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('manufacturing/productions-report-print');
    $total_pages = 0;
    $max_columns = 0;
    foreach ($sections as $section) {
        $total_pages += count($section['pages'] ?? [[]]);
        $max_columns = max($max_columns, count($section['columns'] ?? []));
    }
    $total_pages = max($total_pages, 1);
    $currency_precision = $currency_precision ?? session('business.currency_precision', 2);
    $qty_precision = $quantity_precision ?? session('business.quantity_precision', 2);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';
    $page_label = __('lang_v1.page');
    if ($page_label == 'lang_v1.page') {
        $page_label = 'Page';
    }

    if (! function_exists('_productions_report_print_number')) {
        function _productions_report_print_number($value, $precision, $decimal_separator, $thousand_separator) {
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

        .productions-report-print table {
            border-collapse: collapse;
            font-size: <?php echo e($max_columns >= 15 ? '5.1pt' : ($max_columns >= 10 ? '6pt' : '7pt'), false); ?>;
            table-layout: fixed;
            width: 100%;
        }
        .productions-report-print th,
        .productions-report-print td {
            border: 1px solid #d2d2d2;
            line-height: 1.12;
            overflow-wrap: anywhere;
            padding: <?php echo e($max_columns >= 15 ? '2px 3px' : '3px 4px', false); ?>;
            text-align: left;
            vertical-align: top;
            white-space: normal;
            word-break: break-word;
        }
        .productions-report-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: <?php echo e($max_columns >= 15 ? '4.7pt' : ($max_columns >= 10 ? '5.5pt' : '6.4pt'), false); ?>;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .productions-report-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .productions-report-print .text-right {
            text-align: right;
            white-space: nowrap;
        }
        .productions-report-print .money-cell {
            background: #f8fbff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .productions-report-print .section-title {
            border-bottom: 1px solid #333;
            font-size: 11pt;
            font-weight: 800;
            margin: 0 0 8px;
            padding-bottom: 4px;
            text-transform: uppercase;
        }
        .productions-report-print .total-row td {
            background: #e8e8e8 !important;
            border-top: 2px solid #1a1a1a;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .productions-report-print .empty-row {
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

<div class="cr-stage productions-report-print" id="crStage">
    <?php $page_no = 0; ?>
    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $section['pages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $page_no++; ?>
            <div class="cr-sheet" id="crPage<?php echo e($page_no, false); ?>">
                <?php echo $__env->make('manufacturing::production.partials.productions_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="section-title"><?php echo e($section['title'], false); ?></div>
                <table>
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
                                <tr>
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
                                                <?php echo e(_productions_report_print_number($value, $currency_precision, $decimal_separator, $thousand_separator), false); ?>

                                            <?php elseif($type === 'qty'): ?>
                                                <?php echo e(_productions_report_print_number($value, $qty_precision, $decimal_separator, $thousand_separator), false); ?>

                                            <?php elseif($type === 'number'): ?>
                                                <?php echo e(_productions_report_print_number($value, 0, $decimal_separator, $thousand_separator), false); ?>

                                            <?php elseif($type === 'percent'): ?>
                                                <?php echo e(_productions_report_print_number($value, 1, $decimal_separator, $thousand_separator), false); ?>%
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
                                                <?php echo e(_productions_report_print_number($total, $currency_precision, $decimal_separator, $thousand_separator), false); ?>

                                            <?php elseif($type === 'qty'): ?>
                                                <?php echo e(_productions_report_print_number($total, $qty_precision, $decimal_separator, $thousand_separator), false); ?>

                                            <?php else: ?>
                                                <?php echo e(_productions_report_print_number($total, 0, $decimal_separator, $thousand_separator), false); ?>

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
