<?php
    $can_view_accounting_reports =
        auth()->user()->can('accounting.ledger_report.view') ||
        auth()->user()->can('accounting.cash_flow_report.view') ||
        auth()->user()->can('accounting.trial_balance.view') ||
        auth()->user()->can('accounting.balance_sheet.view') ||
        auth()->user()->can('accounting.profit_loss.view') ||
        auth()->user()->can('accounting.account_receivable_ageing_report.view') ||
        auth()->user()->can('accounting.account_receivable_ageing_details.view') ||
        auth()->user()->can('accounting.account_payable_ageing_report.view') ||
        auth()->user()->can('accounting.account_payable_ageing_details.view') ||
        auth()->user()->can('accounting.daily_transactions_report.view') ||
        auth()->user()->can('accounting.chart_of_account_report.view');
?>

<section class="no-print">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm m-4 px-3">
        <div class="container-fluid px-0">
            <a class="navbar-brand fw-semibold" href="<?php echo e(action([\Modules\Accounting\Http\Controllers\AccountingController::class, 'dashboard']), false); ?>"><i class="fas fa-broadcast-tower me-2"></i><?php echo e(__('accounting::lang.accounting'), false); ?></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#accounting-navbar" aria-controls="accounting-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="accounting-navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if(auth()->user()->can('accounting.manage_accounts')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'chart-of-accounts'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'index']), false); ?>"><?php echo app('translator')->get('accounting::lang.chart_of_accounts'); ?></a>
                        </li>
                    <?php endif; ?>
                    
                    <?php if(auth()->user()->can('accounting.view_journal')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'journal-entry'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Accounting\Http\Controllers\JournalEntryController::class, 'index']), false); ?>"><?php echo app('translator')->get('accounting::lang.journal_entry'); ?></a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('accounting.view_transfer')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'transfer'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Accounting\Http\Controllers\TransferController::class, 'index']), false); ?>">
                                <?php echo app('translator')->get('accounting::lang.transfer'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('accounting.view_transactions') || auth()->user()->can('accounting.map_transactions')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'transactions'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Accounting\Http\Controllers\TransactionController::class, 'index']), false); ?>"><?php echo app('translator')->get('accounting::lang.transactions'); ?></a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('accounting.manage_budget')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'budget'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Accounting\Http\Controllers\BudgetController::class, 'index']), false); ?>">
                                <?php echo app('translator')->get('accounting::lang.budget'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('accounting.manage_cheque_books')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'cheque-book'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Accounting\Http\Controllers\ChequeBookController::class, 'index']), false); ?>">
                                <i class="fas fa-money-check me-1"></i><?php echo app('translator')->get('accounting::lang.cheque_books'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->user()->can('accounting.manage_bank_reconciliation')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'bank-reconciliation'): ?> active <?php endif; ?>"
                                href="<?php echo e(action([\Modules\Accounting\Http\Controllers\BankReconciliationController::class, 'index']), false); ?>">
                                <i class="fas fa-balance-scale me-1"></i><?php echo app('translator')->get('accounting::lang.bank_reconciliation'); ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if($can_view_accounting_reports): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'reports'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Accounting\Http\Controllers\ReportController::class, 'index']), false); ?>"><?php echo app('translator')->get('accounting::lang.reports'); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(auth()->user()->can('accounting.access_settings') || auth()->user()->can('accounting.map_transactions')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'settings'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Accounting\Http\Controllers\SettingsController::class, 'index']), false); ?>"><?php echo app('translator')->get('messages.settings'); ?></a>
                    </li>
                    <?php endif; ?>
                </ul>

            </div>
        </div>
    </nav>
</section>
