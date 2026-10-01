<?php
    $is_pdf = ! empty($is_pdf);
    // PDF engines need a concrete point size (1 CSS pixel = 0.75 points).
    $table_font_offset = max(-6, min(12, filter_var(request('font_offset', 0), FILTER_VALIDATE_INT) ?: 0)) * 0.75;
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('accounting/cash-flow-report/'.$account->id.'/print');
    $show_parallel_flows = count($sections) === 2;
    $inflow_section = $sections[0] ?? null;
    $outflow_section = $sections[1] ?? null;
    $parallel_page_count = 0;

    if ($show_parallel_flows) {
        $parallel_page_count = max(
            count($inflow_section['pages'] ?? [[]]),
            count($outflow_section['pages'] ?? [[]]),
            1
        );
        $total_pages = $parallel_page_count;
    } else {
        $total_pages = 0;
        foreach ($sections as $section) {
            $total_pages += count($section['pages'] ?? [[]]);
        }
        $total_pages = max($total_pages, 1);
    }

    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';
    $page_label = __('lang_v1.page');
    if ($page_label == 'lang_v1.page') {
        $page_label = 'Page';
    }

    if (! function_exists('_acfr_print_money')) {
        function _acfr_print_money($value, $decimal_separator, $thousand_separator) {
            return number_format((float) $value, 2, $decimal_separator, $thousand_separator);
        }
    }
    if (! function_exists('_acfr_print_date_lines')) {
        function _acfr_print_date_lines($value) {
            $value = trim((string) $value);
            if ($value === '') {
                return '';
            }

            if (preg_match('/^(.+?)\s+(\d{1,2}:\d{2}(?::\d{2})?(?:\s*[AP]M)?)$/i', $value, $matches)) {
                return e($matches[1]).'<br>'.e($matches[2]);
            }

            return e($value);
        }
    }
    if (! function_exists('_acfr_print_description_lines')) {
        function _acfr_print_description_lines($value) {
            return preg_replace('/<br>\s*/', '<br>', nl2br(e(trim((string) $value)), false));
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

        .accounting-cash-flow-print table {
            border-collapse: collapse;
            font-size: <?php echo e($is_pdf ? (7 + $table_font_offset).'pt' : 'calc(7pt + var(--cr-table-font-offset, 0px))', false); ?>;
            table-layout: fixed;
            width: 100%;
        }
        .accounting-cash-flow-print th,
        .accounting-cash-flow-print td {
            border: 1px solid #d2d2d2;
            line-height: 1.15;
            overflow-wrap: anywhere;
            padding: 4px 5px;
            text-align: left;
            vertical-align: top;
            white-space: normal;
            word-break: break-word;
        }
        .accounting-cash-flow-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: <?php echo e($is_pdf ? (6.2 + $table_font_offset).'pt' : 'calc(6.2pt + var(--cr-table-font-offset, 0px))', false); ?>;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .accounting-cash-flow-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .accounting-cash-flow-print .text-right {
            text-align: right;
            white-space: nowrap;
        }
        .accounting-cash-flow-print .money-cell {
            background: #f8fbff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .accounting-cash-flow-print .pre-line {
            white-space: pre-line;
        }
        .accounting-cash-flow-print .summary-grid {
            display: grid;
            gap: 8px;
            grid-template-columns: repeat(5, 1fr);
            margin-bottom: 10px;
        }
        .accounting-cash-flow-print .summary-card {
            border: 1px solid #d2d2d2;
            padding: 7px 8px;
        }
        .accounting-cash-flow-print .summary-card b {
            display: block;
            font-size: 6.4pt;
            text-transform: uppercase;
        }
        .accounting-cash-flow-print .summary-card span {
            display: block;
            font-size: 9pt;
            font-weight: 800;
            margin-top: 3px;
            text-align: right;
        }
        .accounting-cash-flow-print .section-title {
            border-bottom: 1px solid #333;
            font-size: 11pt;
            font-weight: 800;
            margin: 0 0 8px;
            padding-bottom: 4px;
            text-transform: uppercase;
        }
        .accounting-cash-flow-print .parallel-flows {
            display: grid;
            gap: 8mm;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            align-items: start;
        }
        .accounting-cash-flow-print .flow-panel {
            min-width: 0;
        }
        .accounting-cash-flow-print .flow-panel .section-title {
            font-size: 10pt;
            margin-bottom: 6px;
        }
        .accounting-cash-flow-print .flow-panel table {
            font-size: <?php echo e($is_pdf ? (6.3 + $table_font_offset).'pt' : 'calc(6.3pt + var(--cr-table-font-offset, 0px))', false); ?>;
        }
        .accounting-cash-flow-print .flow-panel th {
            font-size: <?php echo e($is_pdf ? (5.6 + $table_font_offset).'pt' : 'calc(5.6pt + var(--cr-table-font-offset, 0px))', false); ?>;
            padding: 3px 3px;
        }
        .accounting-cash-flow-print .flow-panel td {
            padding: 3px 3px;
        }
        .accounting-cash-flow-print .flow-panel .empty-row {
            padding: 20px 0;
        }
        .accounting-cash-flow-print .cash-flow-report-table {
            table-layout: auto;
        }
        .accounting-cash-flow-print .cash-flow-report-table col.auto-column {
            width: 1%;
        }
        .accounting-cash-flow-print .cash-flow-report-table col.description-column {
            width: auto;
        }
        .accounting-cash-flow-print .cash-flow-report-table th.auto-fit,
        .accounting-cash-flow-print .cash-flow-report-table td.auto-fit {
            overflow-wrap: normal;
            white-space: nowrap;
            width: 1%;
            word-break: normal;
        }
        .accounting-cash-flow-print .cash-flow-report-table th.description-column,
        .accounting-cash-flow-print .cash-flow-report-table td.description-column {
            overflow-wrap: anywhere;
            white-space: normal;
            width: auto;
            word-break: normal;
        }
        .accounting-cash-flow-print .cash-flow-report-table .date-cell {
            line-height: 1.2;
            text-align: left;
        }
        .accounting-cash-flow-print .total-row td {
            background: #e8e8e8 !important;
            border-top: 2px solid #1a1a1a;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .accounting-cash-flow-print .empty-row {
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

<div class="cr-stage accounting-cash-flow-print" id="crStage">
    <?php if($show_parallel_flows): ?>
        <?php for($page_no = 1; $page_no <= $parallel_page_count; $page_no++): ?>
            <div class="cr-sheet" id="crPage<?php echo e($page_no, false); ?>">
                <?php echo $__env->make('account.partials.cash_flow_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php if($page_no === 1): ?>
                    <?php echo $__env->make('accounting::chart_of_accounts.partials.cash_flow_report_summary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>

                <div class="parallel-flows">
                    <?php $__currentLoopData = [$inflow_section, $outflow_section]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $page_index = $page_no - 1;
                            $page_rows = $section['pages'][$page_index] ?? [];
                            $is_last_section_page = $page_index === count($section['pages'] ?? [[]]) - 1;
                        ?>
                        <div class="flow-panel">
                            <div class="section-title"><?php echo e($section['title'], false); ?></div>
                            <?php echo $__env->make('accounting::chart_of_accounts.partials.cash_flow_report_table', [
                                'section' => $section,
                                'page_rows' => $page_rows,
                                'show_totals' => ! empty($section['rows']) && $is_last_section_page,
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="cr-foot">
                    <span><?php echo e($business_name, false); ?> - <?php echo app('translator')->get('lang_v1.cash_inflows'); ?> / <?php echo app('translator')->get('lang_v1.cash_outflows'); ?></span>
                    <span><?php echo e($page_label, false); ?> <?php echo e($page_no, false); ?> / <?php echo e($total_pages, false); ?></span>
                </div>
            </div>
        <?php endfor; ?>
    <?php else: ?>
        <?php $page_no = 0; ?>
        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $section['pages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section_page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $page_no++; ?>
                <div class="cr-sheet" id="crPage<?php echo e($page_no, false); ?>">
                    <?php echo $__env->make('account.partials.cash_flow_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php if($page_no === 1): ?>
                        <?php echo $__env->make('accounting::chart_of_accounts.partials.cash_flow_report_summary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>

                    <div class="section-title"><?php echo e($section['title'], false); ?></div>
                    <?php echo $__env->make('accounting::chart_of_accounts.partials.cash_flow_report_table', [
                        'section' => $section,
                        'page_rows' => $page_rows,
                        'show_totals' => ! empty($section['rows']) && $loop->last,
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="cr-foot">
                        <span><?php echo e($business_name, false); ?> - <?php echo e($section['title'], false); ?></span>
                        <span><?php echo e($page_label, false); ?> <?php echo e($page_no, false); ?> / <?php echo e($total_pages, false); ?></span>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>

<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
</body>
</html>
