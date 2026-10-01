

<?php $__env->startSection('title', __('accounting::lang.reports')); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'accounting_ledger_filter_date_range', 'date_range_setting_input_id' => 'accounting_ledger_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'accounting_cash_flow_filter_date_range', 'date_range_setting_input_id' => 'accounting_cash_flow_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'accounting_trial_balance_filter_date_range', 'date_range_setting_input_id' => 'accounting_trial_balance_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'accounting_balance_sheet_filter_date_range', 'date_range_setting_input_id' => 'accounting_balance_sheet_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'accounting_profit_loss_filter_date_range', 'date_range_setting_input_id' => 'accounting_profit_loss_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'accounting_daily_transactions_filter_date_range', 'date_range_setting_input_id' => 'accounting_daily_transactions_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('accounting::lang.reports'); ?></h1>
</section>

<section class="content">
<style>
.report-card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    margin-bottom: 24px;
    transition: box-shadow 0.2s, transform 0.2s;
    overflow: hidden;
}
.report-card:hover {
    box-shadow: 0 6px 24px rgba(0,0,0,0.13);
    transform: translateY(-2px);
}
.report-card .card-header {
    background: linear-gradient(135deg, var(--rc-from), var(--rc-to));
    border-bottom: none;
    padding: 16px 20px;
}
.report-card .card-header h5 {
    font-size: 15px;
    font-weight: 600;
    color: #fff;
    margin: 0;
    letter-spacing: 0.2px;
}
.report-card .card-header .rc-icon {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    background: rgba(255,255,255,0.25);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    color: #fff;
    margin-right: 12px;
    flex-shrink: 0;
}
.report-card .filters-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #6c757d;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 5px;
}
.report-card .card-body {
    padding: 20px;
}
.report-card .card-footer {
    background: transparent;
    border-top: 1px solid rgba(0,0,0,0.06);
    padding: 12px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.report-card .card-footer .desc-text {
    font-size: 12px;
    color: #6c757d;
    line-height: 1.4;
}
.report-card .btn-view-report {
    font-size: 12px;
    font-weight: 600;
    border-radius: 6px;
    padding: 6px 16px;
    white-space: nowrap;
}
.report-card .form-label {
    font-size: 12px;
    font-weight: 600;
    color: #495057;
    margin-bottom: 4px;
}
.report-card .form-control,
.report-card .select2-container--default .select2-selection--single {
    border-radius: 6px;
    font-size: 13px;
}
</style>

    <div class="row">

        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.ledger_report.view')): ?>
        <div class="col-md-6">
            <div class="card report-card" style="--rc-from:#4f6ef7;--rc-to:#6a82fb;">
                <div class="card-header d-flex align-items-center">
                    <div class="rc-icon"><i class="fas fa-book"></i></div>
                    <h5><?php echo app('translator')->get('accounting::lang.ledger_report'); ?></h5>
                </div>
                <div class="card-body">
                    <div class="filters-label"><i class="fas fa-filter"></i> <?php echo app('translator')->get('report.filters'); ?></div>
                    <div class="row g-2">
                        <div class="col-sm-6">
                            <div class="mb-2">
                                <?php echo Form::label('ledger_location_id', __('purchase.business_location') . ':', ['class' => 'form-label']); ?>

                                <?php echo Form::select('ledger_location_id', $report_business_locations['ledger'], null, ['class' => 'form-control select2 w-100']); ?>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-2">
                                <?php echo Form::label('ledger_daterange_filter', __('report.date_range') . ':', ['class' => 'form-label']); ?>

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    <?php echo Form::text('ledger_daterange_filter', null, ['class' => 'form-control', 'readonly', 'placeholder' => __('report.date_range')]); ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-1">
                                <?php echo Form::label('all_accounts', __('accounting::lang.account') . ':', ['class' => 'form-label']); ?>

                                <?php echo Form::select('ledger_account_filter', $accounts, $account->id ?? null, ['class' => 'form-control accounts-dropdown w-100', 'id' => 'ledger_account_filter', 'data-default' => $account->id ?? null]); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="desc-text"><?php echo app('translator')->get('accounting::lang.ledger_report_description'); ?></span>
                    <a href="#" class="btn btn-primary btn-view-report" id="view_ledger_btn">
                        <i class="fas fa-external-link-alt me-1"></i><?php echo app('translator')->get('accounting::lang.view_report'); ?>
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>

        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.cash_flow_report.view')): ?>
        <div class="col-md-6">
            <div class="card report-card" style="--rc-from:#11998e;--rc-to:#38ef7d;">
                <div class="card-header d-flex align-items-center">
                    <div class="rc-icon"><i class="fas fa-money-bill-wave"></i></div>
                    <h5><?php echo app('translator')->get('accounting::lang.cash_flow_report'); ?></h5>
                </div>
                <div class="card-body">
                    <div class="filters-label"><i class="fas fa-filter"></i> <?php echo app('translator')->get('report.filters'); ?></div>
                    <div class="row g-2">
                        <div class="col-sm-6">
                            <div class="mb-2">
                                <?php echo Form::label('cash_flow_location_id', __('purchase.business_location') . ':', ['class' => 'form-label']); ?>

                                <?php echo Form::select('cash_flow_location_id', $report_business_locations['cash_flow'], null, ['class' => 'form-control select2 w-100']); ?>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-2">
                                <?php echo Form::label('cash_flow_daterange_filter', __('report.date_range') . ':', ['class' => 'form-label']); ?>

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    <?php echo Form::text('cash_flow_daterange_filter', null, ['class' => 'form-control', 'readonly', 'id' => 'cash_flow_daterange_filter', 'placeholder' => __('report.date_range')]); ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-1">
                                <?php echo Form::label('all_accounts', __('accounting::lang.account') . ':', ['class' => 'form-label']); ?>

                                <?php echo Form::select('cash_flow_account_filter', $cash_flow_accounts, $account->id ?? null, ['class' => 'form-control cash-flow-accounts-dropdown w-100', 'id' => 'cash_flow_account_filter', 'data-default' => $account->id ?? null]); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="desc-text"><?php echo app('translator')->get('accounting::lang.cash_flow_report_description'); ?></span>
                    <a href="#" class="btn btn-success btn-view-report" id="view_cash_flow_btn">
                        <i class="fas fa-external-link-alt me-1"></i><?php echo app('translator')->get('accounting::lang.view_report'); ?>
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>

        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.trial_balance.view')): ?>
        <div class="col-md-6">
            <div class="card report-card" style="--rc-from:#f7971e;--rc-to:#ffd200;">
                <div class="card-header d-flex align-items-center">
                    <div class="rc-icon"><i class="fas fa-balance-scale"></i></div>
                    <h5><?php echo app('translator')->get('accounting::lang.trial_balance'); ?></h5>
                </div>
                <div class="card-body">
                    <div class="filters-label"><i class="fas fa-filter"></i> <?php echo app('translator')->get('report.filters'); ?></div>
                    <div class="row g-2">
                        <div class="col-sm-6">
                            <div class="mb-2">
                                <?php echo Form::label('trial_type', __('lang_v1.type') . ':', ['class' => 'form-label']); ?>

                                <?php echo Form::select('trial_type', ['summary' => __('lang_v1.summary'), 'detailed' => __('lang_v1.detailed')], 'detailed', ['class' => 'form-control select2']); ?>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-2">
                                <?php echo Form::label('trial_location_id', __('purchase.business_location') . ':', ['class' => 'form-label']); ?>

                                <?php echo Form::select('trial_location_id', $report_business_locations['trial_balance'], null, ['class' => 'form-control select2']); ?>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-1">
                                <?php echo Form::label('trial_date_range_filter', __('report.date_range') . ':', ['class' => 'form-label']); ?>

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    <?php echo Form::text('trial_date_range_filter', null, ['class' => 'form-control', 'readonly', 'placeholder' => __('report.date_range')]); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="desc-text"><?php echo app('translator')->get('accounting::lang.trial_balance_description'); ?></span>
                    <a href="<?php echo e(route('accounting.trialBalance'), false); ?>" id="view_trial_balance_btn" class="btn btn-warning btn-view-report text-white">
                        <i class="fas fa-external-link-alt me-1"></i><?php echo app('translator')->get('accounting::lang.view_report'); ?>
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>

        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.balance_sheet.view')): ?>
        <div class="col-md-6">
            <div class="card report-card" style="--rc-from:#6a3093;--rc-to:#a044ff;">
                <div class="card-header d-flex align-items-center">
                    <div class="rc-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                    <h5><?php echo app('translator')->get('accounting::lang.balance_sheet'); ?></h5>
                </div>
                <div class="card-body">
                    <div class="filters-label"><i class="fas fa-filter"></i> <?php echo app('translator')->get('report.filters'); ?></div>
                    <div class="row g-2">
                        <div class="col-sm-6">
                            <div class="mb-2">
                                <?php echo Form::label('balance_type', __('lang_v1.type') . ':', ['class' => 'form-label']); ?>

                                <?php echo Form::select('balance_type', ['summary' => __('lang_v1.summary'), 'detailed' => __('lang_v1.detailed')], 'detailed', ['class' => 'form-control select2']); ?>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-2">
                                <?php echo Form::label('balance_location_id', __('purchase.business_location') . ':', ['class' => 'form-label']); ?>

                                <?php echo Form::select('balance_location_id', $report_business_locations['balance_sheet'], null, ['class' => 'form-control select2']); ?>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-1">
                                <?php echo Form::label('balance_date_range_filter', __('report.date_range') . ':', ['class' => 'form-label']); ?>

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    <?php echo Form::text('balance_date_range_filter', null, ['class' => 'form-control', 'readonly', 'placeholder' => __('report.date_range')]); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="desc-text"><?php echo app('translator')->get('accounting::lang.balance_sheet_description'); ?></span>
                    <a href="<?php echo e(route('accounting.balanceSheet'), false); ?>" id="view_balance_sheet_btn" class="btn btn-view-report text-white" style="background:#6a3093;">
                        <i class="fas fa-external-link-alt me-1"></i><?php echo app('translator')->get('accounting::lang.view_report'); ?>
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>

        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.profit_loss.view')): ?>
        <div class="col-md-6">
            <div class="card report-card" style="--rc-from:#f953c6;--rc-to:#b91d73;">
                <div class="card-header d-flex align-items-center">
                    <div class="rc-icon"><i class="fas fa-chart-line"></i></div>
                    <h5><?php echo app('translator')->get('accounting::lang.profit_loss'); ?></h5>
                </div>
                <div class="card-body">
                    <div class="filters-label"><i class="fas fa-filter"></i> <?php echo app('translator')->get('report.filters'); ?></div>
                    <div class="row g-2">
                        <div class="col-sm-6">
                            <div class="mb-2">
                                <?php echo Form::label('profit_loss_location_id', __('purchase.business_location') . ':', ['class' => 'form-label']); ?>

                                <?php echo Form::select('profit_loss_location_id', $report_business_locations['profit_loss'], null, ['class' => 'form-control select2']); ?>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-1">
                                <?php echo Form::label('profit_loss_date_range_filter', __('report.date_range') . ':', ['class' => 'form-label']); ?>

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    <?php echo Form::text('profit_loss_date_range_filter', null, ['class' => 'form-control', 'readonly', 'placeholder' => __('report.date_range')]); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="desc-text"><?php echo app('translator')->get('accounting::lang.profit_loss_report_description'); ?></span>
                    <a href="<?php echo e(route('accounting.profitLoss'), false); ?>" id="view_profit_loss_btn" class="btn btn-view-report text-white" style="background:#b91d73;">
                        <i class="fas fa-external-link-alt me-1"></i><?php echo app('translator')->get('accounting::lang.view_report'); ?>
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>

        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.daily_transactions_report.view')): ?>
        <div class="col-md-6">
            <div class="card report-card" style="--rc-from:#1a6fc4;--rc-to:#2195f3;">
                <div class="card-header d-flex align-items-center">
                    <div class="rc-icon"><i class="fas fa-calendar-day"></i></div>
                    <h5><?php echo app('translator')->get('accounting::lang.daily_transactions_report'); ?></h5>
                </div>
                <div class="card-body">
                    <div class="filters-label"><i class="fas fa-filter"></i> <?php echo app('translator')->get('report.filters'); ?></div>
                    <div class="row g-2">
                        <div class="col-sm-6">
                            <div class="mb-2">
                                <?php echo Form::label('daily_txn_location_id_index', __('purchase.business_location') . ':', ['class' => 'form-label']); ?>

                                <?php echo Form::select('daily_txn_location_id_index', $report_business_locations['daily_transactions'], null, ['class' => 'form-control select2']); ?>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-1">
                                <?php echo Form::label('daily_txn_date_index', __('accounting::lang.transaction_date') . ':', ['class' => 'form-label']); ?>

                                <div class="input-group input-group-sm">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    <?php echo Form::text('daily_txn_date_index', null, ['class' => 'form-control', 'readonly', 'id' => 'daily_txn_date_index', 'placeholder' => __('accounting::lang.transaction_date')]); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="desc-text"><?php echo app('translator')->get('accounting::lang.daily_transactions_report_description'); ?></span>
                    <a href="<?php echo e(route('accounting.daily_transactions'), false); ?>" id="view_daily_txn_btn" class="btn btn-view-report text-white" style="background:#1a6fc4;">
                        <i class="fas fa-external-link-alt me-1"></i><?php echo app('translator')->get('accounting::lang.view_report'); ?>
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>

        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.chart_of_account_report.view')): ?>
        <div class="col-md-6">
            <div class="card report-card" style="--rc-from:#00b09b;--rc-to:#96c93d;">
                <div class="card-header d-flex align-items-center">
                    <div class="rc-icon"><i class="fas fa-sitemap"></i></div>
                    <h5><?php echo app('translator')->get('accounting::lang.chart_of_account_report'); ?></h5>
                </div>
                <div class="card-body">
                    <div class="filters-label"><i class="fas fa-filter"></i> <?php echo app('translator')->get('report.filters'); ?></div>
                    <div class="row g-2">
                        <div class="col-sm-6">
                            <div class="mb-2">
                                <?php echo Form::label('coa_report_location_id', __('purchase.business_location') . ':', ['class' => 'form-label']); ?>

                                <?php echo Form::select('coa_report_location_id', $report_business_locations['chart_of_account'], null, ['class' => 'form-control select2 w-100']); ?>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" id="coa_report_show_balances">
                                <label class="form-check-label" for="coa_report_show_balances" style="font-size:13px;">
                                    <?php echo app('translator')->get('accounting::lang.show_balances'); ?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="desc-text"><?php echo app('translator')->get('accounting::lang.chart_of_account_report_description'); ?></span>
                    <a href="<?php echo e(route('accounting.chart_of_account_report'), false); ?>" id="view_coa_report_btn" class="btn btn-view-report text-white" style="background:#00b09b;">
                        <i class="fas fa-external-link-alt me-1"></i><?php echo app('translator')->get('accounting::lang.view_report'); ?>
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>

        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.account_receivable_ageing_report.view')): ?>
        <div class="col-md-6">
            <div class="card report-card" style="--rc-from:#11998e;--rc-to:#2ecc71;">
                <div class="card-header d-flex align-items-center">
                    <div class="rc-icon"><i class="fas fa-arrow-circle-down"></i></div>
                    <h5><?php echo app('translator')->get('accounting::lang.account_recievable_ageing_report'); ?></h5>
                </div>
                <div class="card-body">
                    <div class="filters-label"><i class="fas fa-filter"></i> <?php echo app('translator')->get('report.filters'); ?></div>
                    <div class="row g-2">
                        <div class="col-sm-6">
                            <div class="mb-1">
                                <?php echo Form::label('ar_ageing_location_id', __('purchase.business_location') . ':', ['class' => 'form-label']); ?>

                                <?php echo Form::select('ar_ageing_location_id', $report_business_locations['account_receivable_ageing_report'], request()->input('location_id'), ['class' => 'form-control select2 w-100']); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="desc-text"><?php echo app('translator')->get('accounting::lang.account_recievable_ageing_report_description'); ?></span>
                    <a href="<?php echo e(route('accounting.account_receivable_ageing_report'), false); ?>" class="btn btn-view-report text-white" id="view_ar_ageing_btn" style="background:#11998e;">
                        <i class="fas fa-external-link-alt me-1"></i><?php echo app('translator')->get('accounting::lang.view_report'); ?>
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>

        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.account_receivable_ageing_details.view')): ?>
        <div class="col-md-6">
            <div class="card report-card" style="--rc-from:#1d976c;--rc-to:#93f9b9;">
                <div class="card-header d-flex align-items-center">
                    <div class="rc-icon"><i class="fas fa-list-alt"></i></div>
                    <h5><?php echo app('translator')->get('accounting::lang.account_receivable_ageing_details'); ?></h5>
                </div>
                <div class="card-body">
                    <div class="filters-label"><i class="fas fa-filter"></i> <?php echo app('translator')->get('report.filters'); ?></div>
                    <div class="row g-2">
                        <div class="col-sm-6">
                            <div class="mb-1">
                                <?php echo Form::label('ar_ageing_details_location_id', __('purchase.business_location') . ':', ['class' => 'form-label']); ?>

                                <?php echo Form::select('ar_ageing_details_location_id', $report_business_locations['account_receivable_ageing_details'], request()->input('location_id'), ['class' => 'form-control select2 w-100']); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="desc-text"><?php echo app('translator')->get('accounting::lang.account_receivable_ageing_details_description'); ?></span>
                    <a href="<?php echo e(route('accounting.account_receivable_ageing_details'), false); ?>" class="btn btn-view-report text-white" id="view_ar_ageing_details_btn" style="background:#1d976c;">
                        <i class="fas fa-external-link-alt me-1"></i><?php echo app('translator')->get('accounting::lang.view_report'); ?>
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>

        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.account_payable_ageing_report.view')): ?>
        <div class="col-md-6">
            <div class="card report-card" style="--rc-from:#c0392b;--rc-to:#e74c3c;">
                <div class="card-header d-flex align-items-center">
                    <div class="rc-icon"><i class="fas fa-arrow-circle-up"></i></div>
                    <h5><?php echo app('translator')->get('accounting::lang.account_payable_ageing_report'); ?></h5>
                </div>
                <div class="card-body">
                    <div class="filters-label"><i class="fas fa-filter"></i> <?php echo app('translator')->get('report.filters'); ?></div>
                    <div class="row g-2">
                        <div class="col-sm-6">
                            <div class="mb-1">
                                <?php echo Form::label('ap_ageing_location_id', __('purchase.business_location') . ':', ['class' => 'form-label']); ?>

                                <?php echo Form::select('ap_ageing_location_id', $report_business_locations['account_payable_ageing_report'], request()->input('location_id'), ['class' => 'form-control select2 w-100']); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="desc-text"><?php echo app('translator')->get('accounting::lang.account_payable_ageing_report_description'); ?></span>
                    <a href="<?php echo e(route('accounting.account_payable_ageing_report'), false); ?>" class="btn btn-view-report text-white" id="view_ap_ageing_btn" style="background:#c0392b;">
                        <i class="fas fa-external-link-alt me-1"></i><?php echo app('translator')->get('accounting::lang.view_report'); ?>
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>

        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.account_payable_ageing_details.view')): ?>
        <div class="col-md-6">
            <div class="card report-card" style="--rc-from:#a00000;--rc-to:#e96b6b;">
                <div class="card-header d-flex align-items-center">
                    <div class="rc-icon"><i class="fas fa-clipboard-list"></i></div>
                    <h5><?php echo app('translator')->get('accounting::lang.account_payable_ageing_details'); ?></h5>
                </div>
                <div class="card-body">
                    <div class="filters-label"><i class="fas fa-filter"></i> <?php echo app('translator')->get('report.filters'); ?></div>
                    <div class="row g-2">
                        <div class="col-sm-6">
                            <div class="mb-1">
                                <?php echo Form::label('ap_ageing_details_location_id', __('purchase.business_location') . ':', ['class' => 'form-label']); ?>

                                <?php echo Form::select('ap_ageing_details_location_id', $report_business_locations['account_payable_ageing_details'], request()->input('location_id'), ['class' => 'form-control select2 w-100']); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="desc-text"><?php echo app('translator')->get('accounting::lang.account_payable_ageing_details_description'); ?></span>
                    <a href="<?php echo e(route('accounting.account_payable_ageing_details'), false); ?>" class="btn btn-view-report text-white" id="view_ap_ageing_details_btn" style="background:#a00000;">
                        <i class="fas fa-external-link-alt me-1"></i><?php echo app('translator')->get('accounting::lang.view_report'); ?>
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<?php echo $__env->make('accounting::accounting.common_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
    $(document).ready(function(){        
        function getAccountingReportDateRangeSettings(defaultSelector, fallbackStart, fallbackEnd) {
            var settings = $(defaultSelector).length
                ? window.getAdminReportDateRangeSettings(defaultSelector)
                : $.extend({}, dateRangeSettings);

            if (! $(defaultSelector).length) {
                settings.startDate = fallbackStart;
                settings.endDate = fallbackEnd;
            }

            return settings;
        }

        function setDateRangeFilterValue(selector) {
            var picker = $(selector).data('daterangepicker');
            if (picker) {
                $(selector).val(picker.startDate.format(moment_date_format) + ' ~ ' + picker.endDate.format(moment_date_format));
            }
        }

        var ledgerDateRangeSettings = getAccountingReportDateRangeSettings('#accounting_ledger_filter_date_range', moment(), moment());
        
        $('#ledger_daterange_filter').daterangepicker(
            ledgerDateRangeSettings,
            function (start, end) {
                $('#ledger_daterange_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            }
        );
        setDateRangeFilterValue('#ledger_daterange_filter');

        var trialDateRangeSettings = getAccountingReportDateRangeSettings('#accounting_trial_balance_filter_date_range', moment().startOf('year'), moment());
        
        $('#view_ledger_btn').click(function(e){
            e.preventDefault();
            var account_id = $('#ledger_account_filter').val();
            var location_id = $('#ledger_location_id').val();
            var start = '';
            var end = '';
            if($('#ledger_daterange_filter').val()){
                start = $('input#ledger_daterange_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                end = $('input#ledger_daterange_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
            }
            if(account_id != '' && account_id != undefined){
                url = base_path + '/accounting/ledger/' + account_id +'?location_id='+location_id+'&start='+start+'&end='+end;
                window.location = url;
            }else{
                toastr.warning('Please Select Account');
            }    
        });

        $('#trial_date_range_filter').daterangepicker(
            trialDateRangeSettings,
            function (start, end) {
                $('#trial_date_range_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            }
        );
        setDateRangeFilterValue('#trial_date_range_filter');

        var balanceDateRangeSettings = getAccountingReportDateRangeSettings('#accounting_balance_sheet_filter_date_range', moment().startOf('year'), moment());

        $('#view_trial_balance_btn').click(function(e){
            e.preventDefault();
            var location_id = $('#trial_location_id').val();
            var start = '';
            var end = '';
            if($('#trial_date_range_filter').val()){
                start = $('input#trial_date_range_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                end = $('input#trial_date_range_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
            }
            var type = $('#trial_type').val();
            url = $(this).attr('href');
            url +='?type='+type+'&location_id='+location_id+'&start_date='+start+'&end_date='+end;
            window.location = url;
        });

        $('#balance_date_range_filter').daterangepicker(
            balanceDateRangeSettings,
            function (start, end) {
                $('#balance_date_range_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            }
        );
        setDateRangeFilterValue('#balance_date_range_filter');

        var profitLossDateRangeSettings = getAccountingReportDateRangeSettings('#accounting_profit_loss_filter_date_range', moment().startOf('year'), moment());

        $('#view_balance_sheet_btn').click(function(e){
            e.preventDefault();
            var location_id = $('#balance_location_id').val();
            var start = '';
            var end = '';
            if($('#balance_date_range_filter').val()){
                start = $('input#balance_date_range_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                end = $('input#balance_date_range_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
            }
            var type = $('#balance_type').val();
            url = $(this).attr('href');
            url +='?type='+type+'&location_id='+location_id+'&start_date='+start+'&end_date='+end;
            window.location = url;
        });

        $('#profit_loss_date_range_filter').daterangepicker(
            profitLossDateRangeSettings,
            function (start, end) {
                $('#profit_loss_date_range_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            }
        );
        setDateRangeFilterValue('#profit_loss_date_range_filter');

        $('#view_profit_loss_btn').click(function(e){
            e.preventDefault();
            var location_id = $('#profit_loss_location_id').val();
            var start = '';
            var end = '';
            if($('#profit_loss_date_range_filter').val()){
                start = $('input#profit_loss_date_range_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                end = $('input#profit_loss_date_range_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
            }
            url = $(this).attr('href');
            url +='?location_id='+location_id+'&start_date='+start+'&end_date='+end;
            window.location = url;
        });
        
        var cashFlowDateRangeSettings = getAccountingReportDateRangeSettings('#accounting_cash_flow_filter_date_range', moment(), moment());

        $('#cash_flow_daterange_filter').daterangepicker(
            cashFlowDateRangeSettings,
            function (start, end) {
                $('#cash_flow_daterange_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            }
        );
        setDateRangeFilterValue('#cash_flow_daterange_filter');
        
        $('#view_cash_flow_btn').click(function(e){
            e.preventDefault();
            var account_id = $('#cash_flow_account_filter').val();
            var location_id = $('#cash_flow_location_id').val();
            var start = '';
            var end = '';
            if($('#cash_flow_daterange_filter').val()){
                start = $('input#cash_flow_daterange_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                end = $('input#cash_flow_daterange_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
            }
            if(account_id != '' && account_id != undefined){
                url = base_path + '/accounting/cash-flow-report/' + account_id +'?location_id='+location_id+'&start='+start+'&end='+end;
                window.location = url;
            }else{
                toastr.warning('Please Select Account');
            }    
        });

        // Daily Transactions Report
        var dailyTxnDateRangeSettings = getAccountingReportDateRangeSettings('#accounting_daily_transactions_filter_date_range', moment(), moment());
        var dailyTxnDefaultDate = dailyTxnDateRangeSettings.endDate ? dailyTxnDateRangeSettings.endDate.clone() : moment();
        $('#daily_txn_date_index').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            autoUpdateInput: true,
            startDate: dailyTxnDefaultDate,
            locale: {
                format: moment_date_format
            }
        });

        $('#view_daily_txn_btn').click(function(e){
            e.preventDefault();
            var location_id = $('#daily_txn_location_id_index').val();
            var date = '';
            if($('#daily_txn_date_index').val()){
                date = moment($('#daily_txn_date_index').val(), moment_date_format).format('YYYY-MM-DD');
            } else {
                date = moment().format('YYYY-MM-DD');
            }
            var url = $(this).attr('href');
            url += '?date=' + date + '&location_id=' + location_id;
            window.location = url;
        });

        // Chart of Account Report
        $('#view_coa_report_btn').click(function(e){
            e.preventDefault();
            var showBalances = $('#coa_report_show_balances').is(':checked') ? 1 : 0;
            var location_id = $('#coa_report_location_id').val();
            var url = $(this).attr('href') + '?show_balances=' + showBalances + '&location_id=' + location_id;
            window.location = url;
        });

        $('#view_ar_ageing_btn').click(function(e){
            e.preventDefault();
            window.location = $(this).attr('href') + '?location_id=' + $('#ar_ageing_location_id').val();
        });

        $('#view_ar_ageing_details_btn').click(function(e){
            e.preventDefault();
            window.location = $(this).attr('href') + '?location_id=' + $('#ar_ageing_details_location_id').val();
        });

        $('#view_ap_ageing_btn').click(function(e){
            e.preventDefault();
            window.location = $(this).attr('href') + '?location_id=' + $('#ap_ageing_location_id').val();
        });

        $('#view_ap_ageing_details_btn').click(function(e){
            e.preventDefault();
            window.location = $(this).attr('href') + '?location_id=' + $('#ap_ageing_details_location_id').val();
        });

        
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>