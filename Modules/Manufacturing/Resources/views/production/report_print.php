<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('manufacturing/report-print');
    $total_pages = count($row_pages ?? [[]]);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';
    $page_label = __('lang_v1.page');
    if ($page_label == 'lang_v1.page') {
        $page_label = 'Page';
    }

    if (! function_exists('_mfg_report_print_money')) {
        function _mfg_report_print_money($value, $decimal_separator, $thousand_separator) {
            return number_format((float) $value, 2, $decimal_separator, $thousand_separator);
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

        .mfg-report-print table {
            border-collapse: collapse;
            font-size: 9pt;
            table-layout: fixed;
            width: 100%;
        }
        .mfg-report-print th,
        .mfg-report-print td {
            border: 1px solid #d2d2d2;
            line-height: 1.25;
            padding: 7px 8px;
            text-align: left;
            vertical-align: top;
        }
        .mfg-report-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: 8pt;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .mfg-report-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .mfg-report-print .text-right {
            text-align: right;
            white-space: nowrap;
        }
        .mfg-report-print .metric {
            font-weight: 700;
        }
        .mfg-report-print .amount-cell {
            background: #f8fbff !important;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    </style>
</head>
<body>
<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="cr-stage mfg-report-print" id="crStage">
    <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
            <?php echo $__env->make('manufacturing::production.partials.report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <table>
                <thead>
                    <tr>
                        <th><?php echo e(__('lang_v1.description'), false); ?></th>
                        <th class="text-right">
                            <?php echo e(__('sale.amount'), false); ?>

                            <?php if(! empty($currency_symbol)): ?>
                                (<?php echo e($currency_symbol, false); ?>)
                            <?php endif; ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="metric"><?php echo e($row['metric'], false); ?></td>
                            <td class="text-right amount-cell"><?php echo e(_mfg_report_print_money($row['amount'], $decimal_separator, $thousand_separator), false); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
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
