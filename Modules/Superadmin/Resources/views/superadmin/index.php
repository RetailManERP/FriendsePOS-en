
<?php $__env->startSection('title', __('superadmin::lang.superadmin') . ' | ' . __('superadmin::lang.dashboard')); ?>

<?php $__env->startSection('css'); ?>
<style>
	/* ── Superadmin Dashboard – Modern SaaS Design v2 ── */
	.sa-kpi-card {
		background: #fff; border: 1px solid #e2e8f0; border-radius: 1rem;
		padding: 1.25rem 1.5rem; display: flex; align-items: center; gap: 1rem;
		transition: transform .2s, box-shadow .2s; height: 100%;
	}
	.sa-kpi-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,.07); }
	.sa-kpi-icon {
		width: 52px; height: 52px; border-radius: .75rem;
		display: flex; align-items: center; justify-content: center;
		font-size: 1.35rem; flex-shrink: 0;
	}
	.sa-kpi-icon.blue    { background: #eef2ff; color: #6366f1; }
	.sa-kpi-icon.green   { background: #ecfdf5; color: #059669; }
	.sa-kpi-icon.amber   { background: #fffbeb; color: #d97706; }
	.sa-kpi-icon.red     { background: #fef2f2; color: #dc2626; }
	.sa-kpi-icon.purple  { background: #f5f3ff; color: #7c3aed; }
	.sa-kpi-icon.cyan    { background: #ecfeff; color: #0891b2; }
	.sa-kpi-icon.emerald { background: #ecfdf5; color: #10b981; }
	.sa-kpi-icon.orange  { background: #fff7ed; color: #ea580c; }
	.sa-kpi-icon.rose    { background: #fff1f2; color: #e11d48; }
	.sa-kpi-icon.sky     { background: #f0f9ff; color: #0284c7; }
	.sa-kpi-icon.teal    { background: #f0fdfa; color: #0d9488; }
	.sa-kpi-icon.indigo  { background: #eef2ff; color: #4f46e5; }
	.sa-kpi-body h4 { font-size: 1.5rem; font-weight: 700; color: #1e293b; margin: 0; line-height: 1.2; }
	.sa-kpi-body p  { font-size: .82rem; color: #64748b; margin: 0; }
	.sa-kpi-body .kpi-sub { font-size: .72rem; color: #94a3b8; margin-top: .15rem; }
	.sa-kpi-body .kpi-badge { font-size: .7rem; padding: .15rem .5rem; border-radius: .4rem; font-weight: 600; display: inline-block; margin-top: .2rem; }
	.sa-kpi-body .kpi-badge.up { background: #ecfdf5; color: #059669; }
	.sa-kpi-body .kpi-badge.down { background: #fef2f2; color: #dc2626; }
	.sa-kpi-body .kpi-badge.neutral { background: #f8fafc; color: #64748b; }

	.sa-widget {
		background: #fff; border: 1px solid #e2e8f0; border-radius: 1rem;
		padding: 1.5rem; margin-bottom: 1.5rem;
	}
	.sa-widget .widget-head {
		display: flex; align-items: center; justify-content: space-between;
		margin-bottom: 1rem; flex-wrap: wrap; gap: .5rem;
	}
	.sa-widget .widget-head h5 { font-weight: 700; color: #1e293b; margin: 0; font-size: 1.05rem; }
	.sa-widget .widget-head .widget-sub { font-size: .78rem; color: #94a3b8; }
	.sa-date-filters .btn { font-size: .8rem; padding: .35rem .85rem; border-radius: .5rem; }
	.sa-date-filters .btn.active { background: #6366f1; border-color: #6366f1; color: #fff; }

	.sa-pkg-rank { display: flex; align-items: center; gap: .75rem; padding: .6rem 0; border-bottom: 1px solid #f1f5f9; }
	.sa-pkg-rank:last-child { border-bottom: none; }
	.sa-pkg-rank .rank-num { width: 28px; height: 28px; border-radius: 50%; background: #eef2ff; color: #6366f1; font-weight: 700; font-size: .8rem; display: flex; align-items: center; justify-content: center; }
	.sa-pkg-rank .rank-name { flex: 1; font-weight: 600; color: #334155; font-size: .88rem; }
	.sa-pkg-rank .rank-count { font-weight: 700; color: #1e293b; font-size: .92rem; }

	.sa-quick-action { display: flex; flex-direction: column; align-items: center; gap: .35rem; padding: .75rem; border-radius: .75rem; text-decoration: none; color: #475569; transition: background .15s; }
	.sa-quick-action:hover { background: #f1f5f9; color: #6366f1; text-decoration: none; }
	.sa-quick-action i { font-size: 1.5rem; }
	.sa-quick-action span { font-size: .75rem; font-weight: 600; text-align: center; }

	.sa-alert-badge { position: relative; }
	.sa-alert-badge .badge-dot { position: absolute; top: -2px; right: -6px; width: 8px; height: 8px; border-radius: 50%; background: #ef4444; border: 2px solid #fff; }

	/* Activity table */
	.sa-activity-table { width: 100%; font-size: .85rem; }
	.sa-activity-table th { font-weight: 600; color: #64748b; font-size: .75rem; text-transform: uppercase; letter-spacing: .04em; padding: .5rem .75rem; border-bottom: 2px solid #f1f5f9; }
	.sa-activity-table td { padding: .6rem .75rem; border-bottom: 1px solid #f8fafc; color: #334155; vertical-align: middle; }
	.sa-activity-table tbody tr:hover { background: #fafbfd; }
	.sa-status-badge { font-size: .72rem; padding: .2rem .55rem; border-radius: .4rem; font-weight: 600; }
	.sa-status-badge.approved { background: #ecfdf5; color: #059669; }
	.sa-status-badge.waiting { background: #fffbeb; color: #d97706; }
	.sa-status-badge.declined { background: #fef2f2; color: #dc2626; }

	/* Expiring soon items */
	.sa-expiry-item { display: flex; align-items: center; gap: .75rem; padding: .55rem 0; border-bottom: 1px solid #f1f5f9; }
	.sa-expiry-item:last-child { border-bottom: none; }
	.sa-expiry-item .expiry-biz { flex: 1; }
	.sa-expiry-item .expiry-biz .biz-name { font-weight: 600; color: #334155; font-size: .85rem; }
	.sa-expiry-item .expiry-biz .pkg-name { font-size: .75rem; color: #94a3b8; }
	.sa-expiry-item .expiry-days { text-align: right; }
	.sa-expiry-item .expiry-days .days-num { font-weight: 700; font-size: .95rem; }
	.sa-expiry-item .expiry-days .days-num.urgent { color: #dc2626; }
	.sa-expiry-item .expiry-days .days-num.warning { color: #d97706; }
	.sa-expiry-item .expiry-days .days-label { font-size: .7rem; color: #94a3b8; }

	/* Progress bars for system health */
	.sa-health-bar { margin-bottom: .75rem; }
	.sa-health-bar .bar-label { display: flex; justify-content: space-between; font-size: .82rem; margin-bottom: .3rem; }
	.sa-health-bar .bar-label span:first-child { font-weight: 600; color: #334155; }
	.sa-health-bar .bar-label span:last-child { color: #64748b; }
	.sa-health-bar .progress { height: 8px; border-radius: 4px; background: #f1f5f9; }
	.sa-health-bar .progress-bar { border-radius: 4px; }

	/* Doughnut chart container */
	.sa-doughnut-wrap { max-width: 240px; margin: 0 auto; }

	/* View all link */
	.sa-view-all { font-size: .8rem; font-weight: 600; color: #6366f1; text-decoration: none; }
	.sa-view-all:hover { color: #4f46e5; text-decoration: underline; }

	/* ── Dark Mode Overrides ── */
	html.dark-theme .sa-kpi-card {
		background: #1e293b; border-color: rgba(255,255,255,.1);
	}
	html.dark-theme .sa-kpi-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,.3); }
	html.dark-theme .sa-kpi-body h4 { color: #e2e8f0; }
	html.dark-theme .sa-kpi-body p  { color: #94a3b8; }
	html.dark-theme .sa-kpi-body .kpi-sub { color: #64748b; }
	html.dark-theme .sa-kpi-body .kpi-badge.up      { background: rgba(5,150,105,.15); color: #34d399; }
	html.dark-theme .sa-kpi-body .kpi-badge.down     { background: rgba(220,38,38,.15); color: #fca5a5; }
	html.dark-theme .sa-kpi-body .kpi-badge.neutral  { background: rgba(255,255,255,.06); color: #94a3b8; }

	html.dark-theme .sa-kpi-icon.blue    { background: rgba(99,102,241,.15); }
	html.dark-theme .sa-kpi-icon.green   { background: rgba(5,150,105,.15); }
	html.dark-theme .sa-kpi-icon.amber   { background: rgba(217,119,6,.15); }
	html.dark-theme .sa-kpi-icon.red     { background: rgba(220,38,38,.15); }
	html.dark-theme .sa-kpi-icon.purple  { background: rgba(124,58,237,.15); }
	html.dark-theme .sa-kpi-icon.cyan    { background: rgba(8,145,178,.15); }
	html.dark-theme .sa-kpi-icon.emerald { background: rgba(16,185,129,.15); }
	html.dark-theme .sa-kpi-icon.orange  { background: rgba(234,88,12,.15); }
	html.dark-theme .sa-kpi-icon.rose    { background: rgba(225,29,72,.15); }
	html.dark-theme .sa-kpi-icon.sky     { background: rgba(2,132,199,.15); }
	html.dark-theme .sa-kpi-icon.teal    { background: rgba(13,148,136,.15); }
	html.dark-theme .sa-kpi-icon.indigo  { background: rgba(79,70,229,.15); }

	html.dark-theme .sa-widget {
		background: #1e293b; border-color: rgba(255,255,255,.1);
	}
	html.dark-theme .sa-widget .widget-head h5 { color: #e2e8f0; }
	html.dark-theme .sa-widget .widget-head .widget-sub { color: #64748b; }

	html.dark-theme .sa-date-filters .btn { color: #94a3b8; border-color: rgba(255,255,255,.12); }
	html.dark-theme .sa-date-filters .btn.active { background: #6366f1; border-color: #6366f1; color: #fff; }

	html.dark-theme .sa-pkg-rank { border-bottom-color: rgba(255,255,255,.06); }
	html.dark-theme .sa-pkg-rank .rank-num { background: rgba(99,102,241,.15); color: #818cf8; }
	html.dark-theme .sa-pkg-rank .rank-name { color: #cbd5e1; }
	html.dark-theme .sa-pkg-rank .rank-count { color: #e2e8f0; }

	html.dark-theme .sa-quick-action { color: #94a3b8; }
	html.dark-theme .sa-quick-action:hover { background: rgba(255,255,255,.06); color: #818cf8; }

	html.dark-theme .sa-alert-badge .badge-dot { border-color: #1e293b; }

	html.dark-theme .sa-activity-table th { color: #64748b; border-bottom-color: rgba(255,255,255,.08); }
	html.dark-theme .sa-activity-table td { color: #cbd5e1; border-bottom-color: rgba(255,255,255,.04); }
	html.dark-theme .sa-activity-table tbody tr:hover { background: rgba(255,255,255,.03); }
	html.dark-theme .sa-status-badge.approved { background: rgba(5,150,105,.15); color: #34d399; }
	html.dark-theme .sa-status-badge.waiting  { background: rgba(217,119,6,.15); color: #fbbf24; }
	html.dark-theme .sa-status-badge.declined { background: rgba(220,38,38,.15); color: #fca5a5; }

	html.dark-theme .sa-expiry-item { border-bottom-color: rgba(255,255,255,.06); }
	html.dark-theme .sa-expiry-item .expiry-biz .biz-name { color: #e2e8f0; }
	html.dark-theme .sa-expiry-item .expiry-biz .pkg-name { color: #64748b; }
	html.dark-theme .sa-expiry-item .expiry-days .days-label { color: #64748b; }

	html.dark-theme .sa-health-bar .bar-label span:first-child { color: #cbd5e1; }
	html.dark-theme .sa-health-bar .bar-label span:last-child  { color: #94a3b8; }
	html.dark-theme .sa-health-bar .progress { background: rgba(255,255,255,.08); }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('superadmin::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<section class="content-header">
		<h1><?php echo app('translator')->get('superadmin::lang.welcome_superadmin'); ?></h1>
	</section>

	<section class="content">
		<?php echo $__env->make('superadmin::layouts.partials.currency', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		
		<div class="row mb-3">
			<div class="col-12 d-flex justify-content-end">
				<div class="btn-group sa-date-filters" data-bs-toggle="buttons">
					<label class="btn btn-outline-secondary active">
						<input type="radio" name="date-filter"
						data-start="<?php echo e(date('Y-m-d'), false); ?>" data-end="<?php echo e(date('Y-m-d'), false); ?>"
						checked> <?php echo e(__('home.today'), false); ?>

					</label>
					<label class="btn btn-outline-secondary">
						<input type="radio" name="date-filter"
						data-start="<?php echo e($date_filters['this_week']['start'], false); ?>" data-end="<?php echo e($date_filters['this_week']['end'], false); ?>">
						<?php echo e(__('home.this_week'), false); ?>

					</label>
					<label class="btn btn-outline-secondary">
						<input type="radio" name="date-filter"
						data-start="<?php echo e($date_filters['this_month']['start'], false); ?>" data-end="<?php echo e($date_filters['this_month']['end'], false); ?>">
						<?php echo e(__('home.this_month'), false); ?>

					</label>
					<label class="btn btn-outline-secondary">
						<input type="radio" name="date-filter"
						data-start="<?php echo e($date_filters['this_yr']['start'], false); ?>" data-end="<?php echo e($date_filters['this_yr']['end'], false); ?>">
						<?php echo e(__('superadmin::lang.this_year'), false); ?>

					</label>
				</div>
			</div>
		</div>

		
		<div class="row g-3 mb-3">
			<div class="col-xl-3 col-md-6">
				<div class="sa-kpi-card">
					<div class="sa-kpi-icon blue"><i class="fas fa-dollar-sign"></i></div>
					<div class="sa-kpi-body">
						<h4><span class="new_subscriptions">&nbsp;</span></h4>
						<p><?php echo app('translator')->get('superadmin::lang.new_subscriptions'); ?></p>
						<div class="kpi-sub"><?php echo app('translator')->get('superadmin::lang.for_selected_period'); ?></div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6">
				<div class="sa-kpi-card">
					<div class="sa-kpi-icon green"><i class="fas fa-store"></i></div>
					<div class="sa-kpi-body">
						<h4><span class="new_registrations">&nbsp;</span></h4>
						<p><?php echo app('translator')->get('superadmin::lang.new_registrations'); ?></p>
						<div class="kpi-sub"><?php echo app('translator')->get('superadmin::lang.for_selected_period'); ?></div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6">
				<div class="sa-kpi-card">
					<div class="sa-kpi-icon red"><i class="fas fa-exclamation-triangle"></i></div>
					<div class="sa-kpi-body">
						<h4><?php echo e($not_subscribed, false); ?></h4>
						<p><?php echo app('translator')->get('superadmin::lang.not_subscribed'); ?></p>
						<div class="kpi-sub"><?php echo app('translator')->get('superadmin::lang.businesses_without_plan'); ?></div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6">
				<div class="sa-kpi-card">
					<div class="sa-kpi-icon amber sa-alert-badge">
						<i class="fas fa-hourglass-half"></i>
						<?php if($pending_approvals > 0): ?><span class="badge-dot"></span><?php endif; ?>
					</div>
					<div class="sa-kpi-body">
						<h4><?php echo e($pending_approvals, false); ?></h4>
						<p><?php echo app('translator')->get('superadmin::lang.pending_approvals'); ?></p>
						<div class="kpi-sub"><?php echo app('translator')->get('superadmin::lang.needs_your_attention'); ?></div>
					</div>
				</div>
			</div>
		</div>

		
		<div class="row g-3 mb-3">
			<div class="col-xl-3 col-md-6">
				<div class="sa-kpi-card">
					<div class="sa-kpi-icon purple"><i class="fas fa-chart-line"></i></div>
					<div class="sa-kpi-body">
						<h4><span class="display_currency" data-currency_symbol="true"><?php echo e($mrr, false); ?></span></h4>
						<p><?php echo app('translator')->get('superadmin::lang.mrr'); ?></p>
						<div class="kpi-sub"><?php echo app('translator')->get('superadmin::lang.monthly_recurring_revenue'); ?></div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6">
				<div class="sa-kpi-card">
					<div class="sa-kpi-icon sky"><i class="fas fa-user-tag"></i></div>
					<div class="sa-kpi-body">
						<h4><span class="display_currency" data-currency_symbol="true"><?php echo e($arpu, false); ?></span></h4>
						<p><?php echo app('translator')->get('superadmin::lang.arpu'); ?></p>
						<div class="kpi-sub"><?php echo app('translator')->get('superadmin::lang.avg_revenue_per_user'); ?></div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6">
				<div class="sa-kpi-card">
					<div class="sa-kpi-icon rose"><i class="fas fa-user-slash"></i></div>
					<div class="sa-kpi-body">
						<h4><?php echo e($churn_rate, false); ?>%</h4>
						<p><?php echo app('translator')->get('superadmin::lang.churn_rate'); ?></p>
						<div class="kpi-sub"><?php echo app('translator')->get('superadmin::lang.expired_last_30_days'); ?></div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6">
				<div class="sa-kpi-card">
					<div class="sa-kpi-icon teal"><i class="fas fa-rocket"></i></div>
					<div class="sa-kpi-body">
						<h4><?php echo e($growth_rate > 0 ? '+' : '', false); ?><?php echo e($growth_rate, false); ?>%</h4>
						<p><?php echo app('translator')->get('superadmin::lang.business_growth'); ?></p>
						<span class="kpi-badge <?php echo e($growth_rate > 0 ? 'up' : ($growth_rate < 0 ? 'down' : 'neutral'), false); ?>">
							<i class="fas fa-arrow-<?php echo e($growth_rate >= 0 ? 'up' : 'down', false); ?>"></i>
							<?php echo e($new_this_month, false); ?> <?php echo app('translator')->get('superadmin::lang.vs_last_month'); ?> <?php echo e($new_last_month, false); ?>

						</span>
					</div>
				</div>
			</div>
		</div>

		
		<div class="row g-3 mb-3">
			<div class="col-xl-3 col-md-6">
				<div class="sa-kpi-card">
					<div class="sa-kpi-icon emerald"><i class="fas fa-check-circle"></i></div>
					<div class="sa-kpi-body">
						<h4><?php echo e($active_subscriptions, false); ?></h4>
						<p><?php echo app('translator')->get('superadmin::lang.active_subscriptions'); ?></p>
						<div class="kpi-sub"><?php echo app('translator')->get('superadmin::lang.currently_running'); ?></div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6">
				<div class="sa-kpi-card">
					<div class="sa-kpi-icon orange"><i class="fas fa-clock"></i></div>
					<div class="sa-kpi-body">
						<h4><?php echo e($expiring_soon, false); ?></h4>
						<p><?php echo app('translator')->get('superadmin::lang.expiring_soon'); ?></p>
						<div class="kpi-sub"><?php echo app('translator')->get('superadmin::lang.within_7_days'); ?></div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6">
				<div class="sa-kpi-card">
					<div class="sa-kpi-icon cyan"><i class="fas fa-building"></i></div>
					<div class="sa-kpi-body">
						<h4><?php echo e($total_businesses, false); ?></h4>
						<p><?php echo app('translator')->get('superadmin::lang.total_businesses'); ?></p>
						<div class="kpi-sub"><?php echo e($active_businesses, false); ?> <?php echo app('translator')->get('superadmin::lang.active'); ?> / <?php echo e($inactive_businesses, false); ?> <?php echo app('translator')->get('superadmin::lang.inactive'); ?></div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-md-6">
				<div class="sa-kpi-card">
					<div class="sa-kpi-icon green"><i class="fas fa-wallet"></i></div>
					<div class="sa-kpi-body">
						<h4><span class="display_currency" data-currency_symbol="true"><?php echo e($total_revenue, false); ?></span></h4>
						<p><?php echo app('translator')->get('superadmin::lang.total_lifetime_revenue'); ?></p>
						<div class="kpi-sub">
							<?php echo e($total_businesses > 0 ? round(($active_subscriptions / $total_businesses) * 100) : 0, false); ?>% <?php echo app('translator')->get('superadmin::lang.subscription_rate'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		
		<div class="row g-3 mb-3">
			<div class="col-lg-8">
				<div class="sa-widget">
					<div class="widget-head">
						<h5><i class="fas fa-chart-bar me-2"></i> <?php echo e(__('superadmin::lang.monthly_sales_trend'), false); ?></h5>
						<span class="widget-sub"><?php echo app('translator')->get('superadmin::lang.last_12_months'); ?></span>
					</div>
					<?php echo $monthly_sells_chart->container(); ?>

				</div>
			</div>
			<div class="col-lg-4">
				<div class="sa-widget">
					<div class="widget-head">
						<h5><i class="fas fa-chart-pie me-2"></i> <?php echo app('translator')->get('superadmin::lang.subscription_distribution'); ?></h5>
						<span class="widget-sub"><?php echo app('translator')->get('superadmin::lang.by_active_packages'); ?></span>
					</div>
					<div class="sa-doughnut-wrap">
						<canvas id="subscriptionDistChart" height="240"></canvas>
					</div>
					<?php if($subscription_dist->count() > 0): ?>
					<div class="mt-3">
						<?php $__currentLoopData = $subscription_dist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="d-flex justify-content-between align-items-center py-1" style="font-size:.82rem;">
							<span class="text-muted"><?php echo e($dist->name, false); ?></span>
							<span class="fw-bold"><?php echo e($dist->count, false); ?></span>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>

		
		<div class="row g-3 mb-3">
			<div class="col-lg-8">
				<div class="sa-widget">
					<div class="widget-head">
						<h5><i class="fas fa-chart-area me-2"></i> <?php echo app('translator')->get('superadmin::lang.registration_trend'); ?></h5>
						<span class="widget-sub"><?php echo app('translator')->get('superadmin::lang.new_business_registrations'); ?></span>
					</div>
					<?php echo $registration_chart->container(); ?>

				</div>
			</div>
			<div class="col-lg-4">
				<div class="sa-widget">
					<div class="widget-head">
						<h5><i class="fas fa-coins me-2"></i> <?php echo app('translator')->get('superadmin::lang.revenue_by_package'); ?></h5>
						<span class="widget-sub"><?php echo app('translator')->get('superadmin::lang.all_time_revenue_breakdown'); ?></span>
					</div>
					<?php $__empty_18 = true; $__currentLoopData = $revenue_by_package; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $rpkg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
						<?php
							$max_rev = $revenue_by_package->max('total_revenue');
							$pct = $max_rev > 0 ? round(($rpkg->total_revenue / $max_rev) * 100) : 0;
							$colors = ['#6366f1','#059669','#d97706','#dc2626','#7c3aed','#0891b2'];
						?>
						<div class="sa-health-bar">
							<div class="bar-label">
								<span><?php echo e($rpkg->name, false); ?></span>
								<span><span class="display_currency" data-currency_symbol="true"><?php echo e($rpkg->total_revenue, false); ?></span></span>
							</div>
							<div class="progress">
								<div class="progress-bar" style="width:<?php echo e($pct, false); ?>%;background:<?php echo e($colors[$index % count($colors)], false); ?>;"></div>
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
						<p class="text-muted text-center mb-0" style="font-size:.88rem;"><?php echo app('translator')->get('superadmin::lang.no_data_available'); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>

		
		<div class="row g-3 mb-3">
			<div class="col-lg-5">
				<div class="sa-widget">
					<div class="widget-head">
						<h5><i class="fas fa-history me-2"></i> <?php echo app('translator')->get('superadmin::lang.latest_subscriptions'); ?></h5>
						<a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\SuperadminSubscriptionsController::class, 'index']), false); ?>" class="sa-view-all"><?php echo app('translator')->get('superadmin::lang.view_all'); ?> &rarr;</a>
					</div>
					<?php if($latest_subscriptions->count() > 0): ?>
					<div class="table-responsive">
						<table class="sa-activity-table">
							<thead>
								<tr>
									<th><?php echo app('translator')->get('superadmin::lang.business_name'); ?></th>
									<th><?php echo app('translator')->get('superadmin::lang.package_name'); ?></th>
									<th><?php echo app('translator')->get('superadmin::lang.amount'); ?></th>
									<th><?php echo app('translator')->get('superadmin::lang.status'); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php $__currentLoopData = $latest_subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td><?php echo e(optional($sub->business)->name ?? '-', false); ?></td>
									<td><?php echo e(optional($sub->package)->name ?? '-', false); ?></td>
									<td><span class="display_currency" data-currency_symbol="true"><?php echo e($sub->package_price, false); ?></span></td>
									<td>
										<span class="sa-status-badge <?php echo e($sub->status, false); ?>">
											<?php echo e(ucfirst($sub->status), false); ?>

										</span>
									</td>
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
					</div>
					<?php else: ?>
						<p class="text-muted text-center mb-0" style="font-size:.88rem;"><?php echo app('translator')->get('superadmin::lang.no_recent_activity'); ?></p>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="sa-widget">
					<div class="widget-head">
						<h5><i class="fas fa-exclamation-circle me-2 text-warning"></i> <?php echo app('translator')->get('superadmin::lang.expiring_soon_list'); ?></h5>
						<span class="widget-sub"><?php echo app('translator')->get('superadmin::lang.within_7_days'); ?></span>
					</div>
					<?php $__empty_18 = true; $__currentLoopData = $expiring_soon_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
						<?php
							$days_left = \Carbon::today()->diffInDays(\Carbon::parse($exp->end_date), false);
							$days_left = max(0, $days_left);
						?>
						<div class="sa-expiry-item">
							<div class="expiry-biz">
								<div class="biz-name"><?php echo e(optional($exp->business)->name ?? '-', false); ?></div>
								<div class="pkg-name"><?php echo e(optional($exp->package)->name ?? '-', false); ?></div>
							</div>
							<div class="expiry-days">
								<div class="days-num <?php echo e($days_left <= 2 ? 'urgent' : 'warning', false); ?>"><?php echo e($days_left, false); ?></div>
								<div class="days-label"><?php echo app('translator')->get('superadmin::lang.days_left'); ?></div>
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
						<p class="text-muted text-center mb-0 py-3" style="font-size:.88rem;">
							<i class="fas fa-check-circle text-success me-1"></i>
							<?php echo app('translator')->get('superadmin::lang.no_expiring_subscriptions'); ?>
						</p>
					<?php endif; ?>
				</div>

				
				<div class="sa-widget">
					<div class="widget-head">
						<h5><i class="fas fa-heartbeat me-2"></i> <?php echo app('translator')->get('superadmin::lang.system_health'); ?></h5>
					</div>
					<?php
						$biz_health = $total_businesses > 0 ? round(($active_businesses / $total_businesses) * 100) : 0;
						$sub_health = $total_businesses > 0 ? round(($active_subscriptions / $total_businesses) * 100) : 0;
					?>
					<div class="sa-health-bar">
						<div class="bar-label">
							<span><?php echo app('translator')->get('superadmin::lang.businesses_active'); ?></span>
							<span><?php echo e($biz_health, false); ?>%</span>
						</div>
						<div class="progress">
							<div class="progress-bar bg-success" style="width:<?php echo e($biz_health, false); ?>%;"></div>
						</div>
					</div>
					<div class="sa-health-bar">
						<div class="bar-label">
							<span><?php echo app('translator')->get('superadmin::lang.subscriptions_active'); ?></span>
							<span><?php echo e($sub_health, false); ?>%</span>
						</div>
						<div class="progress">
							<div class="progress-bar" style="width:<?php echo e($sub_health, false); ?>%;background:#6366f1;"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				
				<div class="sa-widget">
					<div class="widget-head">
						<h5><i class="fas fa-trophy me-2"></i> <?php echo app('translator')->get('superadmin::lang.top_packages'); ?></h5>
					</div>
					<?php $__empty_18 = true; $__currentLoopData = $top_packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $pkg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
						<div class="sa-pkg-rank">
							<div class="rank-num"><?php echo e($index + 1, false); ?></div>
							<div class="rank-name"><?php echo e($pkg->name, false); ?></div>
							<div class="rank-count"><?php echo e($pkg->subscriber_count, false); ?></div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
						<p class="text-muted text-center mb-0" style="font-size:.88rem;"><?php echo app('translator')->get('superadmin::lang.no_data_available'); ?></p>
					<?php endif; ?>
				</div>

				
				<div class="sa-widget">
					<div class="widget-head">
						<h5><i class="fas fa-bolt me-2"></i> <?php echo app('translator')->get('superadmin::lang.quick_actions'); ?></h5>
					</div>
					<div class="row g-2">
						<div class="col-6">
							<a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\BusinessController::class, 'create']), false); ?>" class="sa-quick-action">
								<i class="fas fa-plus-circle text-success"></i>
								<span><?php echo app('translator')->get('superadmin::lang.add_business'); ?></span>
							</a>
						</div>
						<div class="col-6">
							<a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\PackagesController::class, 'create']), false); ?>" class="sa-quick-action">
								<i class="fas fa-box text-primary"></i>
								<span><?php echo app('translator')->get('superadmin::lang.add_package_short'); ?></span>
							</a>
						</div>
						<div class="col-6">
							<a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\CommunicatorController::class, 'index']), false); ?>" class="sa-quick-action">
								<i class="fas fa-envelope text-info"></i>
								<span><?php echo app('translator')->get('superadmin::lang.send_message'); ?></span>
							</a>
						</div>
						<div class="col-6">
							<a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\SuperadminSubscriptionsController::class, 'index']), false); ?>" class="sa-quick-action">
								<i class="fas fa-list-alt text-warning"></i>
								<span><?php echo app('translator')->get('superadmin::lang.subscriptions'); ?></span>
							</a>
						</div>
						<div class="col-6">
							<a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\CouponController::class, 'create']), false); ?>" class="sa-quick-action">
								<i class="fas fa-tags text-danger"></i>
								<span><?php echo app('translator')->get('superadmin::lang.add_coupon_short'); ?></span>
							</a>
						</div>
						<div class="col-6">
							<a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\SuperadminSettingsController::class, 'edit']), false); ?>" class="sa-quick-action">
								<i class="fas fa-cog text-secondary"></i>
								<span><?php echo app('translator')->get('superadmin::lang.settings'); ?></span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		
		<div class="row hide">
			<div class="col-md-12">
				<div class="box box-primary">
				<div class="box-body">
					<div class="col-sm-6">
						<?php echo Form::select(
							'select_business',
							$businesses,
							null,
							['class' => 'form-control input-sm select2', 'id' => 'select_business select2'],
						); ?>

					</div>
				</div>
				</div>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php echo $monthly_sells_chart->script(); ?>

<?php echo $registration_chart->script(); ?>


<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var start = $('input[name="date-filter"]:checked').data('start');
		var end = $('input[name="date-filter"]:checked').data('end');
		update_statistics(start, end);
		$(document).on('change', 'input[name="date-filter"]', function(){
			var start = $('input[name="date-filter"]:checked').data('start');
			var end = $('input[name="date-filter"]:checked').data('end');
			update_statistics(start, end);
		});

		// Subscription Distribution Doughnut Chart
		var distCtx = document.getElementById('subscriptionDistChart');
		if (distCtx) {
			var distLabels = <?php echo json_encode($subscription_dist->pluck('name')); ?>;
			var distData = <?php echo json_encode($subscription_dist->pluck('count')); ?>;
			var distColors = ['#6366f1','#059669','#d97706','#dc2626','#7c3aed','#0891b2'];
			var isDark = document.documentElement.classList.contains('dark-theme');
			new Chart(distCtx, {
				type: 'doughnut',
				data: {
					labels: distLabels,
					datasets: [{
						data: distData,
						backgroundColor: distColors.slice(0, distLabels.length),
						borderWidth: 2,
						borderColor: isDark ? '#1e293b' : '#fff',
						hoverOffset: 6
					}]
				},
				options: {
					responsive: true,
					cutout: '65%',
					plugins: {
						legend: { display: false }
					}
				}
			});
		}
	});

	function update_statistics(start, end){
		var data = { start: start, end: end };
		var loader = '<i class="fa fa-refresh fa-spin fa-fw"></i>';
		$('.new_subscriptions').html(loader);
		$('.new_registrations').html(loader);
		$.ajax({
			method: "GET",
			url: '/superadmin/stats',
			dataType: "json",
			data: data,
			success: function(data){
				$('.new_subscriptions').html(__currency_trans_from_en(data.new_subscriptions, true, true));
				$('.new_registrations').html(data.new_registrations);
			}
		});
	}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>