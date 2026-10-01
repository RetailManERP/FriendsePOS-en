<div class="summary-grid">
    <div class="summary-card">
        <b><?php echo app('translator')->get('lang_v1.brought_forward'); ?></b>
        <span><?php echo e(_acfr_print_money($summary['brought_forward'] ?? 0, $decimal_separator, $thousand_separator), false); ?></span>
    </div>
    <div class="summary-card">
        <b><?php echo app('translator')->get('lang_v1.total_cash_inflows'); ?></b>
        <span><?php echo e(_acfr_print_money($summary['total_inflows'] ?? 0, $decimal_separator, $thousand_separator), false); ?></span>
    </div>
    <div class="summary-card">
        <b><?php echo app('translator')->get('lang_v1.total_cash_outflows'); ?></b>
        <span><?php echo e(_acfr_print_money($summary['total_outflows'] ?? 0, $decimal_separator, $thousand_separator), false); ?></span>
    </div>
    <div class="summary-card">
        <b><?php echo app('translator')->get('lang_v1.net_cash_flows'); ?></b>
        <span><?php echo e(_acfr_print_money($summary['net_cash_flows'] ?? 0, $decimal_separator, $thousand_separator), false); ?></span>
    </div>
    <div class="summary-card">
        <b><?php echo app('translator')->get('lang_v1.closing_balance'); ?></b>
        <span><?php echo e(_acfr_print_money($summary['closing_balance'] ?? 0, $decimal_separator, $thousand_separator), false); ?></span>
    </div>
</div>
