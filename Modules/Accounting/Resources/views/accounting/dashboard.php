

<?php $__env->startSection('title', __('accounting::lang.accounting')); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<style>
/* ── Dashboard hero header ── */
.acct-dash-header {
    background: linear-gradient(135deg, #1a1f5e 0%, #3a7bd5 60%, #00d2ff 100%);
    border-radius: 16px;
    padding: 28px 32px;
    margin-bottom: 28px;
    color: #fff;
    position: relative;
    overflow: hidden;
}
.acct-dash-header::after {
    content: '';
    position: absolute;
    right: -40px; top: -40px;
    width: 220px; height: 220px;
    border-radius: 50%;
    background: rgba(255,255,255,0.06);
    pointer-events: none;
}
.acct-dash-header::before {
    content: '';
    position: absolute;
    right: 60px; bottom: -60px;
    width: 160px; height: 160px;
    border-radius: 50%;
    background: rgba(255,255,255,0.04);
    pointer-events: none;
}
.acct-dash-header h2 {
    font-size: 22px;
    font-weight: 700;
    margin: 0 0 4px;
    letter-spacing: 0.3px;
}
.acct-dash-header p {
    margin: 0;
    font-size: 13px;
    opacity: 0.8;
}
.acct-dash-header .date-btn {
    background: rgba(255,255,255,0.18);
    border: 1px solid rgba(255,255,255,0.35);
    color: #fff;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    padding: 8px 18px;
    backdrop-filter: blur(4px);
    transition: background 0.2s;
}
.acct-dash-header .date-btn:hover {
    background: rgba(255,255,255,0.28);
    color: #fff;
}

/* ── KPI cards ── */
.kpi-card {
    border: none;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 3px 14px rgba(0,0,0,0.10);
    margin-bottom: 20px;
    transition: transform 0.18s, box-shadow 0.18s;
}
.kpi-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,0.14); }
.kpi-card .kpi-inner {
    padding: 14px 12px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.kpi-card .kpi-icon {
    width: 42px; height: 42px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
    background: rgba(255,255,255,0.22);
    color: #fff;
}
/* Allow text area to shrink and not overflow the card */
.kpi-card .kpi-inner > div:not(.kpi-icon) {
    min-width: 0;
    flex: 1 1 0;
    overflow: hidden;
}
.kpi-card .kpi-label {
    font-size: 9.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    opacity: 0.85;
    color: #fff;
    margin-bottom: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.kpi-card .kpi-value {
    font-size: 13px;
    font-weight: 800;
    color: #fff;
    line-height: 1.3;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.kpi-card .kpi-sub {
    font-size: 10px;
    opacity: 0.75;
    color: #fff;
}

/* ── Section cards ── */
.dash-card {
    border: none;
    border-radius: 14px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    margin-bottom: 24px;
    overflow: hidden;
}
.dash-card .dash-card-header {
    padding: 14px 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    border-bottom: 1px solid rgba(0,0,0,0.06);
}
.dash-card .dash-card-header .dch-icon {
    width: 34px; height: 34px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px;
    flex-shrink: 0;
}
.dash-card .dash-card-header h6 {
    margin: 0;
    font-size: 14px;
    font-weight: 700;
    color: #343a40;
    letter-spacing: 0.1px;
}
.dash-card .dash-card-body { padding: 18px 20px; }

/* metric rows inside cards */
.metric-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 12px;
    border-radius: 8px;
    background: #f8f9fa;
    margin-bottom: 8px;
}
.metric-row:last-child { margin-bottom: 0; }
.metric-row .metric-label { font-size: 13px; font-weight: 500; color: #495057; }
.metric-row .metric-value { font-size: 14px; font-weight: 700; }

/* overview badge counters */
.overview-pill {
    border-radius: 10px;
    padding: 12px 8px;
    text-align: center;
    background: #f1f3f9;
}
.overview-pill .pill-num { font-size: 26px; font-weight: 800; line-height: 1; }
.overview-pill .pill-lbl { font-size: 11px; color: #6c757d; margin-top: 3px; }

/* Recent transactions table */
.txn-table thead th {
    background: #f1f3f9;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    color: #6c757d;
    border: none;
    padding: 10px 14px;
}
.txn-table tbody td {
    font-size: 13px;
    padding: 10px 14px;
    vertical-align: middle;
    border-color: #f1f3f9;
}
.txn-table tbody tr:hover { background: #f8f9fa; }
</style>

    <section class="content">

        
        <div class="acct-dash-header d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h2><i class="fas fa-chart-pie me-2"></i><?php echo app('translator')->get('accounting::lang.accounting'); ?></h2>
                <p><?php echo app('translator')->get('accounting::lang.chart_of_account_overview'); ?> &mdash; <?php echo app('translator')->get('messages.filter_by_date'); ?></p>
            </div>
            <button type="button" class="btn acct-dash-header date-btn" id="dashboard_date_filter">
                <i class="fa fa-calendar me-1"></i>
                <span><?php echo e(__('messages.filter_by_date'), false); ?></span>
                <i class="fa fa-caret-down ms-1"></i>
            </button>
        </div>

        
        <div class="row">
            <div class="col-xl-2 col-lg-4 col-sm-6">
                <div class="kpi-card" style="background: linear-gradient(135deg,#4f6ef7,#6a82fb);">
                    <div class="kpi-inner">
                        <div class="kpi-icon"><i class="fas fa-building"></i></div>
                        <div>
                            <div class="kpi-label"><?php echo app('translator')->get('accounting::lang.total_assets'); ?></div>
                            <div class="kpi-value" title="<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) abs($kpi_data['total_assets']), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) abs($kpi_data['total_assets']), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-sm-6">
                <div class="kpi-card" style="background: linear-gradient(135deg,#e74c3c,#f17b72);">
                    <div class="kpi-inner">
                        <div class="kpi-icon"><i class="fas fa-hand-holding-usd"></i></div>
                        <div>
                            <div class="kpi-label"><?php echo app('translator')->get('accounting::lang.total_liabilities'); ?></div>
                            <div class="kpi-value" title="<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) abs($kpi_data['total_liabilities']), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) abs($kpi_data['total_liabilities']), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-sm-6">
                <div class="kpi-card" style="background: linear-gradient(135deg,#0f9b8e,#23d4c5);">
                    <div class="kpi-inner">
                        <div class="kpi-icon"><i class="fas fa-balance-scale"></i></div>
                        <div>
                            <div class="kpi-label"><?php echo app('translator')->get('accounting::lang.total_equity'); ?></div>
                            <div class="kpi-value" title="<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) abs($kpi_data['total_equity']), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) abs($kpi_data['total_equity']), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-sm-6">
                <div class="kpi-card" style="background: linear-gradient(135deg,#11998e,#38ef7d);">
                    <div class="kpi-inner">
                        <div class="kpi-icon"><i class="fas fa-arrow-up"></i></div>
                        <div>
                            <div class="kpi-label"><?php echo app('translator')->get('accounting::lang.total_income'); ?></div>
                            <div class="kpi-value" title="<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) abs($kpi_data['total_income']), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) abs($kpi_data['total_income']), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-sm-6">
                <div class="kpi-card" style="background: linear-gradient(135deg,#f7971e,#ffd200);">
                    <div class="kpi-inner">
                        <div class="kpi-icon"><i class="fas fa-arrow-down"></i></div>
                        <div>
                            <div class="kpi-label"><?php echo app('translator')->get('accounting::lang.total_expenses'); ?></div>
                            <div class="kpi-value" title="<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) abs($kpi_data['total_expenses']), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) abs($kpi_data['total_expenses']), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-sm-6">
                <?php $np = $kpi_data['net_profit']; ?>
                <div class="kpi-card" style="background: linear-gradient(135deg,<?php echo e($np >= 0 ? '#1d976c,#93f9b9' : '#c0392b,#e74c3c', false); ?>);">
                    <div class="kpi-inner">
                        <div class="kpi-icon"><i class="fas fa-chart-line"></i></div>
                        <div>
                            <div class="kpi-label"><?php echo app('translator')->get('accounting::lang.net_profit_loss'); ?></div>
                            <div class="kpi-value" title="<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) abs($np), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) abs($np), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                            <?php if($np < 0): ?><div class="kpi-sub">(Loss)</div><?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row">
            
            <div class="col-md-4">
                <div class="dash-card h-100">
                    <div class="dash-card-header">
                        <div class="dch-icon" style="background:#e8f5e9;color:#2e7d32;"><i class="fas fa-file-invoice-dollar"></i></div>
                        <h6><?php echo app('translator')->get('accounting::lang.receivable_payable_summary'); ?></h6>
                    </div>
                    <div class="dash-card-body">
                        <div class="metric-row">
                            <span class="metric-label"><i class="fas fa-arrow-circle-down text-success me-2"></i><?php echo app('translator')->get('accounting::lang.accounts_receivable'); ?></span>
                            <span class="metric-value text-success"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) abs($ar_total), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span>
                        </div>
                        <div class="metric-row">
                            <span class="metric-label"><i class="fas fa-arrow-circle-up text-danger me-2"></i><?php echo app('translator')->get('accounting::lang.accounts_payable'); ?></span>
                            <span class="metric-value text-danger"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) abs($ap_total), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span>
                        </div>
                        <hr class="my-3">
                        <div class="d-flex justify-content-between align-items-center px-2">
                            <span class="fw-semibold text-muted" style="font-size:13px;"><?php echo app('translator')->get('accounting::lang.net_receivable'); ?></span>
                            <span class="fw-bold fs-5 <?php echo e(($ar_total - $ap_total) >= 0 ? 'text-success' : 'text-danger', false); ?>">
                                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) abs($ar_total - $ap_total), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-md-4">
                <div class="dash-card h-100">
                    <div class="dash-card-header">
                        <div class="dch-icon" style="background:#e3f2fd;color:#1565c0;"><i class="fas fa-university"></i></div>
                        <h6><?php echo app('translator')->get('accounting::lang.bank_cash_balances'); ?></h6>
                    </div>
                    <div class="dash-card-body">
                        <?php $__empty_18 = true; $__currentLoopData = $bank_accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ba): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <div class="metric-row">
                            <div>
                                <i class="fas fa-piggy-bank text-primary me-1"></i>
                                <span class="metric-label d-inline"><?php echo e($ba->name, false); ?></span>
                                <?php if($ba->bank_name): ?><br><small class="text-muted ms-3"><?php echo e($ba->bank_name, false); ?></small><?php endif; ?>
                            </div>
                            <span class="metric-value <?php echo e(($ba->balance ?? 0) >= 0 ? 'text-success' : 'text-danger', false); ?>">
                                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) abs($ba->balance ?? 0), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                            </span>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-info-circle fa-2x mb-2 d-block opacity-50"></i>
                            <?php echo app('translator')->get('accounting::lang.no_bank_accounts'); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            
            <div class="col-md-4">
                <div class="dash-card h-100">
                    <div class="dash-card-header">
                        <div class="dch-icon" style="background:#f3e5f5;color:#6a1b9a;"><i class="fas fa-tachometer-alt"></i></div>
                        <h6><?php echo app('translator')->get('accounting::lang.quick_overview'); ?></h6>
                    </div>
                    <div class="dash-card-body">
                        <div class="row g-2 mb-3">
                            <div class="col-4">
                                <div class="overview-pill">
                                    <div class="pill-num text-primary"><?php echo e($account_counts['total'], false); ?></div>
                                    <div class="pill-lbl"><?php echo app('translator')->get('accounting::lang.total_accounts'); ?></div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="overview-pill">
                                    <div class="pill-num text-success"><?php echo e($account_counts['active'], false); ?></div>
                                    <div class="pill-lbl"><?php echo app('translator')->get('accounting::lang.active'); ?></div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="overview-pill">
                                    <div class="pill-num text-danger"><?php echo e($account_counts['inactive'], false); ?></div>
                                    <div class="pill-lbl"><?php echo app('translator')->get('lang_v1.inactive'); ?></div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="d-grid gap-2">
                            <a href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'index']), false); ?>" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-sitemap me-1"></i><?php echo app('translator')->get('accounting::lang.chart_of_accounts'); ?>
                            </a>
                            <a href="<?php echo e(action([\Modules\Accounting\Http\Controllers\JournalEntryController::class, 'index']), false); ?>" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-book me-1"></i><?php echo app('translator')->get('accounting::lang.journal_entry'); ?>
                            </a>
                            <a href="<?php echo e(action([\Modules\Accounting\Http\Controllers\ReportController::class, 'index']), false); ?>" class="btn btn-outline-info btn-sm">
                                <i class="fas fa-chart-bar me-1"></i><?php echo app('translator')->get('accounting::lang.reports'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-md-12">
                <div class="dash-card">
                    <div class="dash-card-header">
                        <div class="dch-icon" style="background:#e8f5e9;color:#2e7d32;"><i class="fas fa-chart-bar"></i></div>
                        <h6><?php echo app('translator')->get('accounting::lang.income_vs_expenses_trend'); ?></h6>
                    </div>
                    <div class="dash-card-body">
                        <div id="income_expenses_trend_chart" style="min-height: 350px;"></div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-md-12">
                <div class="dash-card">
                    <div class="dash-card-header">
                        <div class="dch-icon" style="background:#e3f2fd;color:#1565c0;"><i class="fas fa-sitemap"></i></div>
                        <h6><?php echo app('translator')->get('accounting::lang.chart_of_account_overview'); ?></h6>
                    </div>
                    <div class="dash-card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <table class="table table-sm table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th style="font-size:12px;text-transform:uppercase;letter-spacing:.6px;color:#6c757d;border:none;background:#f1f3f9;padding:9px 12px;"><?php echo app('translator')->get('accounting::lang.account_type'); ?></th>
                                            <th style="font-size:12px;text-transform:uppercase;letter-spacing:.6px;color:#6c757d;border:none;background:#f1f3f9;padding:9px 12px;"><?php echo app('translator')->get('accounting::lang.current_balance'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $account_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $bal = 0;
                                                foreach($coa_overview as $overview) {
                                                    if($overview->account_primary_type==$k && !empty($overview->balance)) {
                                                        $bal = (float)$overview->balance;
                                                    }
                                                }
                                            ?>
                                            <tr>
                                                <td style="font-size:13px;padding:9px 12px;border-color:#f1f3f9;">
                                                    <?php echo e($v['label'], false); ?>

                                                    <?php if($bal < 0): ?>
                                                        <small class="text-muted"><?php echo e(in_array($v['label'], ['Asset', 'Expenses']) ? '(CR)' : '(DR)', false); ?></small>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="font-size:13px;font-weight:600;padding:9px 12px;border-color:#f1f3f9;"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) abs($bal), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-8">
                                <?php echo $coa_overview_chart->container(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-md-12">
                <div class="dash-card">
                    <div class="dash-card-header">
                        <div class="dch-icon" style="background:#fff3e0;color:#e65100;"><i class="fas fa-exchange-alt"></i></div>
                        <h6><?php echo app('translator')->get('accounting::lang.recent_transactions'); ?></h6>
                    </div>
                    <div class="dash-card-body p-0">
                        <div class="table-responsive">
                            <table class="table txn-table mb-0">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('lang_v1.date'); ?></th>
                                        <th><?php echo app('translator')->get('accounting::lang.account'); ?></th>
                                        <th><?php echo app('translator')->get('accounting::lang.type'); ?></th>
                                        <th><?php echo app('translator')->get('accounting::lang.amount'); ?></th>
                                        <th><?php echo app('translator')->get('accounting::lang.note'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_18 = true; $__currentLoopData = $recent_transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                    <tr>
                                        <td><?php echo e(\Carbon\Carbon::parse($rt->operation_date)->format('d/m/Y'), false); ?></td>
                                        <td><span class="fw-semibold"><?php echo e($rt->account_name, false); ?></span></td>
                                        <td>
                                            <?php if($rt->type == 'debit'): ?>
                                                <span class="badge rounded-pill" style="background:#e3f2fd;color:#1565c0;font-size:11px;">
                                                    <i class="fas fa-arrow-right me-1"></i><?php echo app('translator')->get('accounting::lang.debit'); ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="badge rounded-pill" style="background:#fff3e0;color:#e65100;font-size:11px;">
                                                    <i class="fas fa-arrow-left me-1"></i><?php echo app('translator')->get('accounting::lang.credit'); ?>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="fw-semibold"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $rt->amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                                        <td class="text-muted"><?php echo e($rt->note ?? '—', false); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            <i class="fas fa-inbox fa-2x mb-2 d-block opacity-40"></i>
                                            <?php echo app('translator')->get('accounting::lang.no_recent_transactions'); ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row">
            <?php $__currentLoopData = $all_charts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $chart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6">
                <div class="dash-card">
                    <div class="dash-card-header">
                        <div class="dch-icon" style="background:#f3e5f5;color:#6a1b9a;"><i class="fas fa-chart-pie"></i></div>
                        <h6><?php echo app('translator')->get('accounting::lang.' . $key); ?></h6>
                    </div>
                    <div class="dash-card-body">
                        <?php echo $chart->container(); ?>

                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php echo $coa_overview_chart->script(); ?>

<?php $__currentLoopData = $all_charts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $chart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php echo $chart->script(); ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    $(document).ready( function(){
        // Date Range Picker
        dateRangeSettings.startDate = moment('<?php echo e($start_date, false); ?>', 'YYYY-MM-DD');
        dateRangeSettings.endDate = moment('<?php echo e($end_date, false); ?>', 'YYYY-MM-DD');
        $('#dashboard_date_filter').daterangepicker(dateRangeSettings, function(start, end) {
            $('#dashboard_date_filter span').html(
                start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
            );  
            
            var start = $('#dashboard_date_filter')
                    .data('daterangepicker')
                    .startDate.format('YYYY-MM-DD');

            var end = $('#dashboard_date_filter')
                    .data('daterangepicker')
                    .endDate.format('YYYY-MM-DD');
            var url = "<?php echo e(action([\Modules\Accounting\Http\Controllers\AccountingController::class, 'dashboard']), false); ?>?start_date=" + start + '&end_date=' + end;

            window.location.href = url;
        });

        // ──────────── Income vs Expenses Trend Chart ────────────
        Highcharts.chart('income_expenses_trend_chart', {
            chart: { type: 'column' },
            title: { text: '' },
            xAxis: {
                categories: <?php echo json_encode(array_values($trend_labels)); ?>,
                crosshair: true,
                labels: { rotation: -45 }
            },
            yAxis: {
                min: 0,
                title: { text: '<?php echo e(__("accounting::lang.amount"), false); ?>' }
            },
            tooltip: { shared: true },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    borderRadius: 3
                }
            },
            colors: ['#28a745', '#dc3545', '#17a2b8'],
            series: [
                {
                    name: '<?php echo e(__("accounting::lang.income"), false); ?>',
                    data: <?php echo json_encode(array_values($trend_income)); ?>,
                    color: '#28a745'
                },
                {
                    name: '<?php echo e(__("accounting::lang.expenses"), false); ?>',
                    data: <?php echo json_encode(array_values($trend_expenses)); ?>,
                    color: '#dc3545'
                },
                {
                    name: '<?php echo e(__("accounting::lang.net_profit_loss"), false); ?>',
                    type: 'spline',
                    data: (function() {
                        var income = <?php echo json_encode(array_values($trend_income)); ?>;
                        var expenses = <?php echo json_encode(array_values($trend_expenses)); ?>;
                        var result = [];
                        for (var i = 0; i < income.length; i++) {
                            result.push(income[i] - expenses[i]);
                        }
                        return result;
                    })(),
                    color: '#17a2b8',
                    marker: { radius: 4 }
                }
            ],
            credits: { enabled: false }
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>