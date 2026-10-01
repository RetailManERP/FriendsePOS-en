
<?php $__env->startSection('title', __('manufacturing::lang.manufacturing_dashboard')); ?>

<?php $__env->startSection('css'); ?>
<style>
/* ============================================================
   Manufacturing Dashboard — Modern Style
   ============================================================ */

/* KPI gradient cards */
.mfg-kpi-card {
    border: none;
    border-radius: 18px;
    overflow: hidden;
    position: relative;
    transition: transform .25s ease, box-shadow .25s ease;
    margin-bottom: 1.25rem;
}
.mfg-kpi-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 16px 40px rgba(0,0,0,.18) !important;
}
.mfg-kpi-card .card-body {
    padding: 1.4rem 1.25rem;
    position: relative;
    z-index: 1;
}
.mfg-kpi-card .kpi-icon {
    width: 48px; height: 48px;
    min-width: 48px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.25rem;
    background: rgba(255,255,255,.2);
    color: #fff;
    flex-shrink: 0;
}
.mfg-kpi-card .kpi-label {
    font-size: .72rem;
    font-weight: 700;
    letter-spacing: .5px;
    text-transform: uppercase;
    color: rgba(255,255,255,.85);
    margin-bottom: .2rem;
    white-space: normal;
    line-height: 1.3;
}
.mfg-kpi-card .kpi-value {
    font-size: 1.35rem;
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
    word-break: break-all;
    overflow-wrap: break-word;
    white-space: normal;
}
.mfg-kpi-card .kpi-sub {
    font-size: .73rem;
    color: rgba(255,255,255,.72);
    margin-top: .3rem;
    word-break: break-word;
    white-space: normal;
    line-height: 1.3;
}
.mfg-kpi-card .kpi-bg-icon {
    position: absolute;
    right: -12px; bottom: -12px;
    font-size: 5.5rem;
    opacity: .1;
    color: #fff;
    pointer-events: none;
}
/* Gradient themes */
.mfg-kpi-blue   { background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); }
.mfg-kpi-green  { background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%); }
.mfg-kpi-cyan   { background: linear-gradient(135deg, #36b9cc 0%, #1a8394 100%); }
.mfg-kpi-red    { background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%); }
.mfg-kpi-orange { background: linear-gradient(135deg, #f6c23e 0%, #d4a017 100%); }

/* Section cards */
.mfg-card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 2px 14px rgba(0,0,0,.07);
    margin-bottom: 1.25rem;
    overflow: hidden;
    transition: box-shadow .2s;
}
.mfg-card:hover { box-shadow: 0 6px 24px rgba(0,0,0,.11); }
.mfg-card .mfg-card-header {
    background: #fff;
    border-bottom: 1px solid #f2f2f2;
    font-weight: 700;
    font-size: .92rem;
    padding: .85rem 1.2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: .5rem;
}
.mfg-card .mfg-card-header .header-title {
    display: flex; align-items: center; gap: .45rem;
}
.dark-theme .mfg-card {
    background: var(--card-bg, #1e2a3a);
    box-shadow: 0 2px 14px rgba(0,0,0,.3);
}
.dark-theme .mfg-card .mfg-card-header {
    background: var(--card-bg, #1e2a3a);
    border-color: rgba(255,255,255,.07);
    color: #e0e0e0;
}

/* Filter bar */
.mfg-filter-bar {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 2px 14px rgba(0,0,0,.06);
    padding: 1.1rem 1.25rem .1rem;
    margin-bottom: 1.25rem;
}
.dark-theme .mfg-filter-bar {
    background: var(--card-bg, #1e2a3a);
}

/* Page header */
.mfg-page-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 1.25rem; flex-wrap: wrap; gap: .5rem;
    padding: .25rem 0;
}
.mfg-page-header h2 {
    font-size: 1.3rem; font-weight: 800; margin: 0;
    display: flex; align-items: center; gap: .5rem;
}

/* Status pipeline */
.mfg-pipeline {
    display: flex; flex-wrap: wrap; align-items: flex-start;
    gap: 0; justify-content: center; margin-top: 1rem;
}
.mfg-pipeline-step {
    flex: 1 1 70px; text-align: center;
    position: relative; padding: .4rem .2rem; min-width: 65px;
}
.mfg-pipeline-step::after {
    content: '\f054';
    font-family: 'Font Awesome 5 Free'; font-weight: 900;
    position: absolute; right: -7px; top: 40%;
    transform: translateY(-50%);
    font-size: .65rem; color: #ccc; z-index: 2;
}
.mfg-pipeline-step:last-child::after { display: none; }
.dark-theme .mfg-pipeline-step::after { color: #555; }
.mfg-pipeline-count {
    display: inline-flex; align-items: center; justify-content: center;
    width: 44px; height: 44px; border-radius: 50%;
    font-size: 1.15rem; font-weight: 800; color: #fff;
    margin-bottom: .3rem; box-shadow: 0 3px 8px rgba(0,0,0,.2);
}
.mfg-pipeline-label {
    font-size: .7rem; font-weight: 600; color: #666; line-height: 1.3;
}
.dark-theme .mfg-pipeline-label { color: #999; }

/* Priority bars */
.mfg-priority-row { display: flex; flex-direction: column; gap: .55rem; padding: .25rem 0; }
.mfg-priority-item { display: flex; align-items: center; gap: .55rem; }
.mfg-priority-dot { width: 9px; height: 9px; border-radius: 50%; flex-shrink: 0; }
.mfg-priority-lbl { font-size: .8rem; font-weight: 600; width: 55px; flex-shrink: 0; }
.mfg-priority-bar-track {
    flex: 1; height: 8px; border-radius: 6px;
    background: #eee; overflow: hidden;
}
.dark-theme .mfg-priority-bar-track { background: rgba(255,255,255,.1); }
.mfg-priority-bar-fill {
    height: 100%; border-radius: 6px; transition: width .9s cubic-bezier(.4,0,.2,1);
}
.mfg-priority-count { font-size: .8rem; font-weight: 700; width: 22px; text-align: right; }

/* QC stats */
.qc-stat-row { display: flex; gap: 1.2rem; justify-content: center; flex-wrap: wrap; padding: .5rem 0 .25rem; }
.qc-stat { text-align: center; }
.qc-stat-num { font-size: 1.5rem; font-weight: 800; line-height: 1; }
.qc-stat-lbl { font-size: .7rem; text-transform: uppercase; letter-spacing: .4px; opacity: .65; font-weight: 600; }

/* Recent productions table */
.mfg-recent-table thead th {
    background: #f8f9fa; font-size: .76rem;
    text-transform: uppercase; letter-spacing: .4px;
    font-weight: 700; color: #5a5a7a;
    border-top: none; padding: .65rem .85rem;
    white-space: nowrap;
}
.dark-theme .mfg-recent-table thead th {
    background: rgba(255,255,255,.04); color: #9a9ab8;
}
.mfg-recent-table tbody tr { transition: background .15s; }
.mfg-recent-table tbody tr:hover { background: rgba(78,115,223,.05); }
.mfg-recent-table td { vertical-align: middle; padding: .6rem .85rem; font-size: .86rem; }
.mfg-ref { font-family: monospace; font-weight: 700; font-size: .82rem; color: #4e73df; }
.dark-theme .mfg-ref { color: #7ba7f7; }

/* Empty state */
.mfg-empty { padding: 2.5rem; text-align: center; color: #bbb; }
.mfg-empty i { font-size: 2.5rem; margin-bottom: .75rem; opacity: .45; display: block; }

/* Date badge */
.mfg-date-badge {
    display: inline-flex; align-items: center; gap: .35rem;
    background: #f0f4ff; color: #4e73df; border-radius: 20px;
    padding: .25rem .75rem; font-size: .8rem; font-weight: 600;
}
.dark-theme .mfg-date-badge { background: rgba(78,115,223,.2); color: #8fb4ff; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('manufacturing::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">
<div class="container-fluid py-2">

    
    <div class="mfg-page-header">
        <h2>
            <i class="fas fa-industry text-primary"></i>
            <?php echo app('translator')->get('manufacturing::lang.manufacturing_dashboard'); ?>
        </h2>
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <span class="mfg-date-badge">
                <i class="fas fa-calendar-alt"></i>
                <?php echo e(\Carbon\Carbon::parse($start_date)->format('M d, Y'), false); ?>

                &ndash;
                <?php echo e(\Carbon\Carbon::parse($end_date)->format('M d, Y'), false); ?>

            </span>
            <button type="button" class="btn btn-primary btn-sm px-3" id="refresh_dashboard">
                <i class="fas fa-sync-alt me-1"></i> <?php echo app('translator')->get('manufacturing::lang.refresh'); ?>
            </button>
        </div>
    </div>

    
    <div class="mfg-filter-bar">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="form-group mb-3">
                    <?php echo Form::label('dashboard_location_id', __('purchase.business_location') . ':'); ?>

                    <?php echo Form::select('dashboard_location_id', $business_locations, $location_id ?? null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="form-group mb-3">
                    <?php echo Form::label('dashboard_date_range', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('dashboard_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly', 'id' => 'dashboard_date_range']); ?>

                </div>
            </div>
        </div>
    </div>

    
    <div class="row">

        
        <div class="col-xl-3 col-md-6">
            <div class="card mfg-kpi-card mfg-kpi-blue shadow">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="kpi-icon"><i class="fas fa-industry"></i></div>
                        <div>
                            <div class="kpi-label"><?php echo app('translator')->get('manufacturing::lang.total_productions'); ?></div>
                            <div class="kpi-value" id="kpi_total_productions"><?php echo e($dashboard_stats['status_counts']->total_count ?? 0, false); ?></div>
                            <div class="kpi-sub"><?php echo app('translator')->get('manufacturing::lang.this_period'); ?></div>
                        </div>
                    </div>
                </div>
                <i class="fas fa-industry kpi-bg-icon"></i>
            </div>
        </div>

        
        <div class="col-xl-3 col-md-6">
            <div class="card mfg-kpi-card mfg-kpi-green shadow">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="kpi-icon"><i class="fas fa-coins"></i></div>
                        <div>
                            <div class="kpi-label"><?php echo app('translator')->get('manufacturing::lang.total_production_value'); ?></div>
                            <div class="kpi-value"><span class="display_currency" data-currency_symbol="true" id="kpi_total_value"><?php echo e($dashboard_stats['total_value'], false); ?></span></div>
                            <div class="kpi-sub">
                                <?php echo app('translator')->get('manufacturing::lang.total_production_cost'); ?>:
                                <span class="display_currency" data-currency_symbol="true"><?php echo e($dashboard_stats['cost_data']->total_cost ?? 0, false); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <i class="fas fa-coins kpi-bg-icon"></i>
            </div>
        </div>

        
        <?php
            $qc_total_kpi  = $dashboard_stats['qc_stats']->total_inspections ?? 0;
            $qc_pass_kpi   = $dashboard_stats['qc_stats']->passed_count ?? 0;
            $qc_prate_kpi  = $qc_total_kpi > 0 ? round($qc_pass_kpi / $qc_total_kpi * 100, 1) : 0;
        ?>
        <?php if(!empty($manufacturing_settings['enable_yield_tracking'])): ?>
        <div class="col-xl-3 col-md-6">
            <div class="card mfg-kpi-card mfg-kpi-cyan shadow">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="kpi-icon"><i class="fas fa-chart-line"></i></div>
                        <div>
                            <div class="kpi-label"><?php echo app('translator')->get('manufacturing::lang.avg_yield_efficiency'); ?></div>
                            <div class="kpi-value" id="kpi_yield_efficiency"><?php echo e(number_format($dashboard_stats['yield_efficiency'], 1), false); ?>%</div>
                            <div class="kpi-sub"><?php echo e($dashboard_stats['yield_tracked_count'], false); ?> <?php echo app('translator')->get('manufacturing::lang.tracked'); ?></div>
                        </div>
                    </div>
                </div>
                <i class="fas fa-chart-line kpi-bg-icon"></i>
            </div>
        </div>
        <?php else: ?>
        <div class="col-xl-3 col-md-6">
            <div class="card mfg-kpi-card mfg-kpi-cyan shadow">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="kpi-icon"><i class="fas fa-clipboard-check"></i></div>
                        <div>
                            <div class="kpi-label"><?php echo app('translator')->get('manufacturing::lang.qc_pass_rate'); ?></div>
                            <div class="kpi-value"><?php echo e($qc_prate_kpi, false); ?>%</div>
                            <div class="kpi-sub"><?php echo e($qc_total_kpi, false); ?> <?php echo app('translator')->get('manufacturing::lang.inspections'); ?></div>
                        </div>
                    </div>
                </div>
                <i class="fas fa-clipboard-check kpi-bg-icon"></i>
            </div>
        </div>
        <?php endif; ?>

        
        <div class="col-xl-3 col-md-6">
            <div class="card mfg-kpi-card <?php echo e(($dashboard_stats['overdue_count'] ?? 0) > 0 ? 'mfg-kpi-red' : 'mfg-kpi-orange', false); ?> shadow">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="kpi-icon"><i class="fas fa-exclamation-circle"></i></div>
                        <div>
                            <div class="kpi-label"><?php echo app('translator')->get('manufacturing::lang.overdue_productions'); ?></div>
                            <div class="kpi-value" id="kpi_overdue"><?php echo e($dashboard_stats['overdue_count'] ?? 0, false); ?></div>
                            <div class="kpi-sub"><?php echo app('translator')->get('manufacturing::lang.need_attention'); ?></div>
                        </div>
                    </div>
                </div>
                <i class="fas fa-exclamation-circle kpi-bg-icon"></i>
            </div>
        </div>

    </div>

    
    <div class="row">

        
        <div class="col-lg-4 col-md-6">
            <div class="mfg-card">
                <div class="mfg-card-header">
                    <span class="header-title">
                        <i class="fas fa-chart-pie text-primary"></i>
                        <?php echo app('translator')->get('manufacturing::lang.production_status_overview'); ?>
                    </span>
                </div>
                <div class="card-body text-center py-3">
                    <canvas id="statusChart" style="max-height:200px;"></canvas>
                    <div class="mfg-pipeline">
                        <div class="mfg-pipeline-step">
                            <div class="mfg-pipeline-count" style="background:#0dcaf0;"><?php echo e($dashboard_stats['status_counts']->planned_count ?? 0, false); ?></div>
                            <div class="mfg-pipeline-label"><?php echo app('translator')->get('manufacturing::lang.status_planned'); ?></div>
                        </div>
                        <div class="mfg-pipeline-step">
                            <div class="mfg-pipeline-count" style="background:#0d6efd;"><?php echo e($dashboard_stats['status_counts']->in_progress_count ?? 0, false); ?></div>
                            <div class="mfg-pipeline-label"><?php echo app('translator')->get('manufacturing::lang.status_in_progress'); ?></div>
                        </div>
                        <div class="mfg-pipeline-step">
                            <div class="mfg-pipeline-count" style="background:#ffc107;"><?php echo e($dashboard_stats['status_counts']->quality_check_count ?? 0, false); ?></div>
                            <div class="mfg-pipeline-label"><?php echo app('translator')->get('manufacturing::lang.status_quality_check'); ?></div>
                        </div>
                        <div class="mfg-pipeline-step">
                            <div class="mfg-pipeline-count" style="background:#198754;"><?php echo e($dashboard_stats['status_counts']->completed_count ?? 0, false); ?></div>
                            <div class="mfg-pipeline-label"><?php echo app('translator')->get('manufacturing::lang.status_completed'); ?></div>
                        </div>
                        <div class="mfg-pipeline-step">
                            <div class="mfg-pipeline-count" style="background:#6c757d;"><?php echo e($dashboard_stats['status_counts']->on_hold_count ?? 0, false); ?></div>
                            <div class="mfg-pipeline-label"><?php echo app('translator')->get('manufacturing::lang.status_on_hold'); ?></div>
                        </div>
                        <div class="mfg-pipeline-step">
                            <div class="mfg-pipeline-count" style="background:#dc3545;"><?php echo e($dashboard_stats['status_counts']->cancelled_count ?? 0, false); ?></div>
                            <div class="mfg-pipeline-label"><?php echo app('translator')->get('manufacturing::lang.status_cancelled'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-4 col-md-6">
            <div class="mfg-card">
                <div class="mfg-card-header">
                    <span class="header-title">
                        <i class="fas fa-layer-group text-warning"></i>
                        <?php echo app('translator')->get('manufacturing::lang.active_by_priority'); ?>
                    </span>
                </div>
                <div class="card-body py-3">
                    <?php
                        $p_urgent = $dashboard_stats['priority_counts']->urgent_count ?? 0;
                        $p_high   = $dashboard_stats['priority_counts']->high_count   ?? 0;
                        $p_normal = $dashboard_stats['priority_counts']->normal_count ?? 0;
                        $p_low    = $dashboard_stats['priority_counts']->low_count    ?? 0;
                        $p_total  = max(1, $p_urgent + $p_high + $p_normal + $p_low);
                    ?>
                    <canvas id="priorityChart" style="max-height:160px;" class="mb-3"></canvas>
                    <div class="mfg-priority-row">
                        <div class="mfg-priority-item">
                            <div class="mfg-priority-dot" style="background:#dc3545;"></div>
                            <div class="mfg-priority-lbl" style="color:#dc3545;"><?php echo app('translator')->get('manufacturing::lang.priority_urgent'); ?></div>
                            <div class="mfg-priority-bar-track"><div class="mfg-priority-bar-fill" style="width:<?php echo e(round($p_urgent/$p_total*100), false); ?>%;background:#dc3545;"></div></div>
                            <div class="mfg-priority-count"><?php echo e($p_urgent, false); ?></div>
                        </div>
                        <div class="mfg-priority-item">
                            <div class="mfg-priority-dot" style="background:#fd7e14;"></div>
                            <div class="mfg-priority-lbl" style="color:#fd7e14;"><?php echo app('translator')->get('manufacturing::lang.priority_high'); ?></div>
                            <div class="mfg-priority-bar-track"><div class="mfg-priority-bar-fill" style="width:<?php echo e(round($p_high/$p_total*100), false); ?>%;background:#fd7e14;"></div></div>
                            <div class="mfg-priority-count"><?php echo e($p_high, false); ?></div>
                        </div>
                        <div class="mfg-priority-item">
                            <div class="mfg-priority-dot" style="background:#0dcaf0;"></div>
                            <div class="mfg-priority-lbl" style="color:#0dcaf0;"><?php echo app('translator')->get('manufacturing::lang.priority_normal'); ?></div>
                            <div class="mfg-priority-bar-track"><div class="mfg-priority-bar-fill" style="width:<?php echo e(round($p_normal/$p_total*100), false); ?>%;background:#0dcaf0;"></div></div>
                            <div class="mfg-priority-count"><?php echo e($p_normal, false); ?></div>
                        </div>
                        <div class="mfg-priority-item">
                            <div class="mfg-priority-dot" style="background:#6c757d;"></div>
                            <div class="mfg-priority-lbl" style="color:#6c757d;"><?php echo app('translator')->get('manufacturing::lang.priority_low'); ?></div>
                            <div class="mfg-priority-bar-track"><div class="mfg-priority-bar-fill" style="width:<?php echo e(round($p_low/$p_total*100), false); ?>%;background:#6c757d;"></div></div>
                            <div class="mfg-priority-count"><?php echo e($p_low, false); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-4 col-md-12">

            
            <div class="mfg-card mb-3">
                <div class="mfg-card-header">
                    <span class="header-title">
                        <i class="fas fa-clipboard-check text-success"></i>
                        <?php echo app('translator')->get('manufacturing::lang.quality_control_summary'); ?>
                    </span>
                </div>
                <div class="card-body py-2">
                    <?php
                        $qc_total   = $dashboard_stats['qc_stats']->total_inspections ?? 0;
                        $qc_passed  = $dashboard_stats['qc_stats']->passed_count  ?? 0;
                        $qc_failed  = $dashboard_stats['qc_stats']->failed_count  ?? 0;
                        $qc_pending = $dashboard_stats['qc_stats']->pending_count ?? 0;
                        $qc_pass_rate = $qc_total > 0 ? round($qc_passed / $qc_total * 100, 1) : 0;
                        $qc_fail_pct  = $qc_total > 0 ? round($qc_failed / $qc_total * 100)    : 0;
                    ?>
                    <div class="qc-stat-row">
                        <div class="qc-stat">
                            <div class="qc-stat-num text-success"><?php echo e($qc_passed, false); ?></div>
                            <div class="qc-stat-lbl"><?php echo app('translator')->get('manufacturing::lang.qc_passed'); ?></div>
                        </div>
                        <div class="qc-stat">
                            <div class="qc-stat-num text-danger"><?php echo e($qc_failed, false); ?></div>
                            <div class="qc-stat-lbl"><?php echo app('translator')->get('manufacturing::lang.qc_failed'); ?></div>
                        </div>
                        <div class="qc-stat">
                            <div class="qc-stat-num text-warning"><?php echo e($qc_pending, false); ?></div>
                            <div class="qc-stat-lbl"><?php echo app('translator')->get('manufacturing::lang.qc_pending'); ?></div>
                        </div>
                    </div>
                    <?php if($qc_total > 0): ?>
                    <div class="mt-2 px-1">
                        <div class="d-flex justify-content-between mb-1">
                            <small class="fw-semibold text-muted"><?php echo app('translator')->get('manufacturing::lang.pass_rate'); ?></small>
                            <small class="fw-bold text-success"><?php echo e($qc_pass_rate, false); ?>%</small>
                        </div>
                        <div class="progress" style="height:10px;border-radius:8px;background:#f0f0f0;">
                            <div class="progress-bar bg-success" style="width:<?php echo e($qc_pass_rate, false); ?>%;border-radius:8px 0 0 8px;" title="<?php echo e($qc_passed, false); ?> <?php echo app('translator')->get('manufacturing::lang.qc_passed'); ?>"></div>
                            <div class="progress-bar bg-danger"  style="width:<?php echo e($qc_fail_pct, false); ?>%;" title="<?php echo e($qc_failed, false); ?> <?php echo app('translator')->get('manufacturing::lang.qc_failed'); ?>"></div>
                        </div>
                        <small class="text-muted mt-1 d-block"><?php echo e($qc_total, false); ?> <?php echo app('translator')->get('manufacturing::lang.inspections'); ?></small>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="mfg-card">
                <div class="mfg-card-header">
                    <span class="header-title">
                        <i class="fas fa-file-invoice-dollar text-info"></i>
                        <?php echo app('translator')->get('manufacturing::lang.cost_breakdown'); ?>
                    </span>
                </div>
                <div class="card-body py-2 px-3">
                    <?php
                        $c_total    = $dashboard_stats['cost_data']->total_cost         ?? 0;
                        $c_labor    = $dashboard_stats['cost_data']->total_labor_cost    ?? 0;
                        $c_overhead = $dashboard_stats['cost_data']->total_overhead_cost ?? 0;
                    ?>
                    <table class="table table-sm table-borderless mb-0">
                        <tr>
                            <td><span class="badge bg-primary me-1" style="width:10px;">&nbsp;</span> <?php echo app('translator')->get('manufacturing::lang.total_production_cost'); ?></td>
                            <td class="text-end fw-bold"><span class="display_currency" data-currency_symbol="true"><?php echo e($c_total, false); ?></span></td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-info me-1" style="width:10px;">&nbsp;</span> <?php echo app('translator')->get('manufacturing::lang.labor_cost'); ?></td>
                            <td class="text-end"><span class="display_currency" data-currency_symbol="true"><?php echo e($c_labor, false); ?></span></td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-warning me-1" style="width:10px;">&nbsp;</span> <?php echo app('translator')->get('manufacturing::lang.overhead_cost'); ?></td>
                            <td class="text-end"><span class="display_currency" data-currency_symbol="true"><?php echo e($c_overhead, false); ?></span></td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>

    </div>

    
    <div class="mfg-card">
        <div class="mfg-card-header">
            <span class="header-title">
                <i class="fas fa-list-alt text-primary"></i>
                <?php echo app('translator')->get('manufacturing::lang.recent_productions'); ?>
            </span>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manufacturing.access_production')): ?>
            <a href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\ProductionController::class, 'index']), false); ?>" class="btn btn-sm btn-outline-primary">
                <i class="fas fa-external-link-alt me-1"></i> <?php echo app('translator')->get('manufacturing::lang.view_all'); ?>
            </a>
            <?php endif; ?>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mfg-recent-table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                            <th><?php echo app('translator')->get('sale.product'); ?></th>
                            <th><?php echo app('translator')->get('messages.date'); ?></th>
                            <th><?php echo app('translator')->get('manufacturing::lang.total_cost'); ?></th>
                            <th><?php echo app('translator')->get('manufacturing::lang.production_status'); ?></th>
                            <th><?php echo app('translator')->get('manufacturing::lang.priority'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $dashboard_stats['recent_productions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $production): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr>
                                <td class="text-muted"><?php echo e($idx + 1, false); ?></td>
                                <td><span class="mfg-ref"><?php echo e($production->ref_no, false); ?></span></td>
                                <td><?php echo e($production->product_name, false); ?></td>
                                <td class="text-nowrap"><?php echo e(\Carbon::createFromTimestamp(strtotime($production->transaction_date))->format(session('business.date_format')), false); ?></td>
                                <td class="text-nowrap"><span class="display_currency" data-currency_symbol="true"><?php echo e($production->final_total, false); ?></span></td>
                                <td>
                                    <?php if($production->mfg_production_status): ?>
                                        <span class="badge <?php echo e(\Modules\Manufacturing\Utils\ManufacturingUtil::getProductionStatusBadge($production->mfg_production_status), false); ?>">
                                            <?php echo e(\Modules\Manufacturing\Utils\ManufacturingUtil::getProductionStatusLabel($production->mfg_production_status), false); ?>

                                        </span>
                                    <?php elseif($production->mfg_is_final): ?>
                                        <span class="badge bg-success"><?php echo app('translator')->get('manufacturing::lang.finalize'); ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark"><?php echo app('translator')->get('lang_v1.pending'); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($production->mfg_priority): ?>
                                        <span class="badge <?php echo e(\Modules\Manufacturing\Utils\ManufacturingUtil::getPriorityBadge($production->mfg_priority), false); ?>">
                                            <?php echo e(ucfirst($production->mfg_priority), false); ?>

                                        </span>
                                    <?php else: ?>
                                        <span class="text-muted">&mdash;</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                            <tr>
                                <td colspan="7">
                                    <div class="mfg-empty">
                                        <i class="fas fa-inbox"></i>
                                        <?php echo app('translator')->get('lang_v1.no_data'); ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
$(document).ready(function() {

    // ── Shared apply-filters helper ──────────────────────────────
    var dashboardBaseUrl = '<?php echo e(action([\Modules\Manufacturing\Http\Controllers\ProductionDashboardController::class, "index"]), false); ?>';

    function applyDashboardFilters() {
        var dateVal = $('#dashboard_date_range').val();
        var locId   = $('#dashboard_location_id').val();
        var params  = {};
        if (dateVal) {
            var parts = dateVal.split(' ~ ');
            if (parts.length === 2) {
                params.start_date = moment(parts[0], moment_date_format).format('YYYY-MM-DD');
                params.end_date   = moment(parts[1], moment_date_format).format('YYYY-MM-DD');
            }
        }
        if (locId) params.location_id = locId;
        window.location.href = dashboardBaseUrl + '?' + $.param(params);
    }

    // ── Date range picker ────────────────────────────────────────
    if ($('#dashboard_date_range').length) {
        var dashDateSettings = $.extend(true, {}, dateRangeSettings);
        dashDateSettings.startDate = moment('<?php echo e($start_date, false); ?>');
        dashDateSettings.endDate   = moment('<?php echo e($end_date, false); ?>');
        $('#dashboard_date_range').daterangepicker(dashDateSettings, function(start, end) {
            $('#dashboard_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            applyDashboardFilters();
        });
        $('#dashboard_date_range').val(
            moment('<?php echo e($start_date, false); ?>').format(moment_date_format) + ' ~ ' +
            moment('<?php echo e($end_date, false); ?>').format(moment_date_format)
        );
        $('#dashboard_date_range').on('cancel.daterangepicker', function() {
            $(this).val('');
            applyDashboardFilters();
        });
    }

    // ── Location dropdown ────────────────────────────────────────
    $('#dashboard_location_id').on('change', function() {
        applyDashboardFilters();
    });

    // ── Refresh button ───────────────────────────────────────────
    $('#refresh_dashboard').on('click', function() {
        applyDashboardFilters();
    });

    // ── Chart.js defaults ────────────────────────────────────────
    var isDark = document.documentElement.classList.contains('dark-theme');
    Chart.defaults.color       = isDark ? '#aaa' : '#555';
    Chart.defaults.borderColor = isDark ? 'rgba(255,255,255,.08)' : '#eee';

    // ── Status doughnut ──────────────────────────────────────────
    var statusCtx = document.getElementById('statusChart');
    if (statusCtx) {
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: [
                    '<?php echo e(__("manufacturing::lang.status_planned"), false); ?>',
                    '<?php echo e(__("manufacturing::lang.status_in_progress"), false); ?>',
                    '<?php echo e(__("manufacturing::lang.status_quality_check"), false); ?>',
                    '<?php echo e(__("manufacturing::lang.status_completed"), false); ?>',
                    '<?php echo e(__("manufacturing::lang.status_on_hold"), false); ?>',
                    '<?php echo e(__("manufacturing::lang.status_cancelled"), false); ?>'
                ],
                datasets: [{
                    data: [
                        <?php echo e($dashboard_stats['status_counts']->planned_count      ?? 0, false); ?>,
                        <?php echo e($dashboard_stats['status_counts']->in_progress_count  ?? 0, false); ?>,
                        <?php echo e($dashboard_stats['status_counts']->quality_check_count ?? 0, false); ?>,
                        <?php echo e($dashboard_stats['status_counts']->completed_count     ?? 0, false); ?>,
                        <?php echo e($dashboard_stats['status_counts']->on_hold_count       ?? 0, false); ?>,
                        <?php echo e($dashboard_stats['status_counts']->cancelled_count     ?? 0, false); ?>

                    ],
                    backgroundColor: ['#0dcaf0','#0d6efd','#ffc107','#198754','#6c757d','#dc3545'],
                    hoverOffset: 8,
                    borderWidth: 2,
                    borderColor: isDark ? '#1e2a3a' : '#fff'
                }]
            },
            options: {
                cutout: '66%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { padding: 10, boxWidth: 12, font: { size: 11 } }
                    }
                },
                animation: { animateRotate: true, duration: 900 }
            }
        });
    }

    // ── Priority horizontal bar chart ────────────────────────────
    var prCtx = document.getElementById('priorityChart');
    if (prCtx) {
        new Chart(prCtx, {
            type: 'bar',
            data: {
                labels: [
                    '<?php echo e(__("manufacturing::lang.priority_urgent"), false); ?>',
                    '<?php echo e(__("manufacturing::lang.priority_high"), false); ?>',
                    '<?php echo e(__("manufacturing::lang.priority_normal"), false); ?>',
                    '<?php echo e(__("manufacturing::lang.priority_low"), false); ?>'
                ],
                datasets: [{
                    data: [
                        <?php echo e($dashboard_stats['priority_counts']->urgent_count ?? 0, false); ?>,
                        <?php echo e($dashboard_stats['priority_counts']->high_count   ?? 0, false); ?>,
                        <?php echo e($dashboard_stats['priority_counts']->normal_count ?? 0, false); ?>,
                        <?php echo e($dashboard_stats['priority_counts']->low_count    ?? 0, false); ?>

                    ],
                    backgroundColor: ['#dc3545','#fd7e14','#0dcaf0','#6c757d'],
                    borderRadius: 6,
                    borderSkipped: false
                }]
            },
            options: {
                indexAxis: 'y',
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false }, ticks: { stepSize: 1, precision: 0 } },
                    y: { grid: { display: false } }
                },
                animation: { duration: 800 }
            }
        });
    }

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>