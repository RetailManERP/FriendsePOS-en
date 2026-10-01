<?php
    $is_pdf = ! empty($is_pdf);
    // PDF engines need a concrete point size (1 CSS pixel = 0.75 points).
    $table_font_offset = max(-6, min(12, filter_var(request('font_offset', 0), FILTER_VALIDATE_INT) ?: 0)) * 0.75;
    $orientation = $orientation ?? 'portrait';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? route('accounting.profitLoss.print');
    $total_pages = 0;
    foreach ($sections as $section) {
        $total_pages += count($section['pages'] ?? [[]]);
    }
    $total_pages = max($total_pages, 1);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';
    $page_label = __('lang_v1.page');
    if ($page_label == 'lang_v1.page') {
        $page_label = 'Page';
    }

    if (! function_exists('_profit_loss_print_money')) {
        function _profit_loss_print_money($value, $decimal_separator, $thousand_separator) {
            if ($value === '' || $value === null) {
                return '';
            }

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

        .profit-loss-print table {
            border-collapse: collapse;
            font-size: <?php echo e($is_pdf ? (8.2 + $table_font_offset).'pt' : 'calc(8.2pt + var(--cr-table-font-offset, 0px))', false); ?>;
            table-layout: fixed;
            width: 100%;
        }
        .profit-loss-print th,
        .profit-loss-print td {
            border: 1px solid #d2d2d2;
            line-height: 1.2;
            overflow-wrap: anywhere;
            padding: 5px 6px;
            text-align: left;
            vertical-align: top;
            white-space: normal;
            word-break: break-word;
        }
        .profit-loss-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: <?php echo e($is_pdf ? (7.2 + $table_font_offset).'pt' : 'calc(7.2pt + var(--cr-table-font-offset, 0px))', false); ?>;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .profit-loss-print th:first-child { width: 70%; }
        .profit-loss-print th:nth-child(2) { width: 30%; }
        .profit-loss-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .profit-loss-print .text-right {
            text-align: right;
            white-space: nowrap;
        }
        .profit-loss-print .money-cell {
            background: #f8fbff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .profit-loss-print .section-title {
            border-bottom: 1px solid #333;
            font-size: 11pt;
            font-weight: 800;
            margin: 0 0 8px;
            padding-bottom: 4px;
            text-transform: uppercase;
        }
        .profit-loss-print .profit-summary {
            display: grid;
            gap: 7px;
            grid-template-columns: repeat(5, 1fr);
            margin: 0 0 8px;
        }
        .profit-loss-print .profit-summary div {
            border: 1px solid #d2d2d2;
            padding: 6px 7px;
        }
        .profit-loss-print .profit-summary span {
            color: #555;
            display: block;
            font-size: 6.8pt;
            margin-bottom: 2px;
        }
        .profit-loss-print .profit-summary strong {
            font-size: 8.2pt;
        }
        .profit-loss-print .row-income td,
        .profit-loss-print .row-cost_of_sales td,
        .profit-loss-print .row-expenses td {
            background: #1f2933 !important;
            color: #fff !important;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .profit-loss-print .row-total td {
            font-weight: 800;
        }
        .profit-loss-print .row-result td {
            background: #fff3cd !important;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .profit-loss-print .row-net_result td {
            background: #d9edf7 !important;
            border-top: 2px solid #1a1a1a;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .profit-loss-print .row-spacer td {
            background: #fff !important;
            border-left-color: #fff;
            border-right-color: #fff;
            height: 8px;
            padding: 2px;
        }
        .profit-loss-print .empty-row {
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

<div class="cr-stage profit-loss-print" id="crStage">
    <?php $page_no = 0; ?>
    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $section['pages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section_page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $page_no++;
                $totals = $section['totals'] ?? [];
            ?>
            <div class="cr-sheet" id="crPage<?php echo e($page_no, false); ?>">
                <?php echo $__env->make('account.partials.cash_flow_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="section-title"><?php echo e($section['title'], false); ?></div>
                <?php if($section_page_index == 0): ?>
                    <div class="profit-summary">
                        <div>
                            <span><?php echo app('translator')->get('accounting::lang.income'); ?></span>
                            <strong><?php echo e(_profit_loss_print_money($totals['income'] ?? 0, $decimal_separator, $thousand_separator), false); ?></strong>
                        </div>
                        <div>
                            <span><?php echo app('translator')->get('accounting::lang.cos'); ?></span>
                            <strong><?php echo e(_profit_loss_print_money($totals['cost_of_sales'] ?? 0, $decimal_separator, $thousand_separator), false); ?></strong>
                        </div>
                        <div>
                            <span><?php echo app('translator')->get('accounting::lang.gross_profit_loss'); ?></span>
                            <strong><?php echo e(_profit_loss_print_money($totals['gross_profit_loss'] ?? 0, $decimal_separator, $thousand_separator), false); ?></strong>
                        </div>
                        <div>
                            <span><?php echo app('translator')->get('accounting::lang.expenses'); ?></span>
                            <strong><?php echo e(_profit_loss_print_money($totals['expenses'] ?? 0, $decimal_separator, $thousand_separator), false); ?></strong>
                        </div>
                        <div>
                            <span><?php echo app('translator')->get('accounting::lang.net_profit_loss'); ?></span>
                            <strong><?php echo e(_profit_loss_print_money($totals['net_profit_loss'] ?? 0, $decimal_separator, $thousand_separator), false); ?></strong>
                        </div>
                    </div>
                <?php endif; ?>

                <table>
                    <thead>
                        <tr>
                            <?php $__currentLoopData = $section['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $type = $column['type'] ?? 'text'; ?>
                                <th class="<?php echo e($type === 'money' ? 'text-right' : '', false); ?>">
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
                                <td colspan="<?php echo e(max(count($section['columns']), 1), false); ?>" class="empty-row"><?php echo app('translator')->get('lang_v1.no_records_found'); ?></td>
                            </tr>
                        <?php else: ?>
                            <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="row-<?php echo e($row['row_type'] ?? 'account', false); ?>">
                                    <?php $__currentLoopData = $section['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $key = $column['key'];
                                            $type = $column['type'] ?? 'text';
                                            $value = $row[$key] ?? '';
                                        ?>
                                        <td class="<?php echo e($type === 'money' ? 'text-right money-cell' : '', false); ?>" <?php if($key === 'account'): ?> style="padding-left: <?php echo e(6 + (($row['level'] ?? 0) * 14), false); ?>px;" <?php endif; ?>>
                                            <?php if($type === 'money'): ?>
                                                <?php echo e(_profit_loss_print_money($value, $decimal_separator, $thousand_separator), false); ?>

                                            <?php else: ?>
                                                <?php echo e($value, false); ?>

                                            <?php endif; ?>
                                        </td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
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
