<?php
    $is_pdf = ! empty($is_pdf);
    // PDF engines need a concrete point size (1 CSS pixel = 0.75 points).
    $table_font_offset = max(-6, min(12, filter_var(request('font_offset', 0), FILTER_VALIDATE_INT) ?: 0)) * 0.75;
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? route('accounting.trialBalance.print');
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

    if (! function_exists('_trial_balance_print_money')) {
        function _trial_balance_print_money($value, $decimal_separator, $thousand_separator) {
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

        .trial-balance-print table {
            border-collapse: collapse;
            font-size: <?php echo e($is_pdf ? (7.2 + $table_font_offset).'pt' : 'calc(7.2pt + var(--cr-table-font-offset, 0px))', false); ?>;
            table-layout: fixed;
            width: 100%;
        }
        .trial-balance-print th,
        .trial-balance-print td {
            border: 1px solid #d2d2d2;
            line-height: 1.16;
            overflow-wrap: anywhere;
            padding: 4px 5px;
            text-align: left;
            vertical-align: top;
            white-space: normal;
            word-break: break-word;
        }
        .trial-balance-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: <?php echo e($is_pdf ? (6.4 + $table_font_offset).'pt' : 'calc(6.4pt + var(--cr-table-font-offset, 0px))', false); ?>;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .trial-balance-print th:first-child { width: 60%; }
        .trial-balance-print th:nth-child(2),
        .trial-balance-print th:nth-child(3) { width: 20%; }
        .trial-balance-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .trial-balance-print .text-right {
            text-align: right;
            white-space: nowrap;
        }
        .trial-balance-print .money-cell {
            background: #f8fbff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .trial-balance-print .row-account_type td {
            background: #1f2933 !important;
            color: #fff !important;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .trial-balance-print .row-sub_type td,
        .trial-balance-print .row-parent td {
            font-weight: 700;
        }
        .trial-balance-print .section-title {
            border-bottom: 1px solid #333;
            font-size: 11pt;
            font-weight: 800;
            margin: 0 0 8px;
            padding-bottom: 4px;
            text-transform: uppercase;
        }
        .trial-balance-print .total-row td {
            background: #e8e8e8 !important;
            border-top: 2px solid #1a1a1a;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .trial-balance-print .empty-row {
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

<div class="cr-stage trial-balance-print" id="crStage">
    <?php $page_no = 0; ?>
    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $section['pages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section_page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $page_no++; ?>
            <div class="cr-sheet" id="crPage<?php echo e($page_no, false); ?>">
                <?php echo $__env->make('account.partials.cash_flow_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="section-title"><?php echo e($section['title'], false); ?></div>
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
                                        <td class="<?php echo e($type === 'money' ? 'text-right money-cell' : '', false); ?>" <?php if($key === 'account'): ?> style="padding-left: <?php echo e(5 + (($row['level'] ?? 0) * 13), false); ?>px;" <?php endif; ?>>
                                            <?php if($type === 'money'): ?>
                                                <?php echo e(_trial_balance_print_money($value, $decimal_separator, $thousand_separator), false); ?>

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
                                        <td><?php echo app('translator')->get('sale.total'); ?></td>
                                    <?php elseif(! empty($column['total']) && $type === 'money'): ?>
                                        <td class="text-right"><?php echo e(_trial_balance_print_money($total, $decimal_separator, $thousand_separator), false); ?></td>
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
