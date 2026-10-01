
<?php $__env->startSection('title', __('project::lang.project_dashboard')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('project::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <div class="project-onedash-title">
        <div>
            <h1 class="project-title">
                <i class="fas fa-chart-pie"></i>
                <?php echo app('translator')->get('project::lang.owner_dashboard'); ?>
            </h1>
            <div class="project-meta-row">
                <span class="text-muted"><?php echo app('translator')->get('project::lang.portfolio_command_center'); ?></span>
            </div>
        </div>
        <div class="project-view-toolbar">
            <?php echo Form::open(['url' => action([\Modules\Project\Http\Controllers\DashboardController::class, 'index']), 'method' => 'get', 'class' => 'project-location-filter-form']); ?>

                <?php echo Form::select('location_id', $business_locations, $location_id, [
                    'class' => 'form-control input-sm select2 project-dashboard-location-filter',
                    'placeholder' => __('messages.all'),
                    'style' => 'width: 220px;',
                ]); ?>

            <?php echo Form::close(); ?>

            <?php if($is_admin || auth()->user()->can('superadmin') || auth()->user()->can('project.create_project')): ?>
                <button type="button" class="btn btn-sm btn-primary add_new_project"
                    data-href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'create']), false); ?>">
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get('project::lang.new_project'); ?>
                </button>
            <?php endif; ?>
            <?php if($is_admin || auth()->user()->can('superadmin') || auth()->user()->can('project.view_reports')): ?>
                <a href="<?php echo e(action([\Modules\Project\Http\Controllers\ReportController::class, 'index']), false); ?>" class="btn btn-sm btn-default">
                    <i class="fas fa-chart-bar"></i> <?php echo app('translator')->get('project::lang.project_report'); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="content project-dashboard owner-dashboard">
    <div class="owner-kpi-grid">
        <div class="owner-kpi-card kpi-blue">
            <div class="owner-kpi-icon"><i class="fas fa-folder-open"></i></div>
            <div class="owner-kpi-main">
                <span><?php echo app('translator')->get('project::lang.portfolio'); ?></span>
                <strong><?php echo e($total_projects, false); ?></strong>
                <small><?php echo e($active_projects, false); ?> <?php echo app('translator')->get('project::lang.active_projects'); ?> / <?php echo e($at_risk_projects, false); ?> <?php echo app('translator')->get('project::lang.at_risk'); ?></small>
            </div>
        </div>

        <div class="owner-kpi-card kpi-green">
            <div class="owner-kpi-icon"><i class="fas fa-check-circle"></i></div>
            <div class="owner-kpi-main">
                <span><?php echo app('translator')->get('project::lang.task_completion'); ?></span>
                <strong><?php echo e($task_completion_rate, false); ?>%</strong>
                <small><?php echo e($open_tasks, false); ?> <?php echo app('translator')->get('project::lang.open_tasks'); ?> / <?php echo e($tasks_due_today, false); ?> <?php echo app('translator')->get('project::lang.due_today'); ?></small>
            </div>
        </div>

        <div class="owner-kpi-card kpi-orange">
            <div class="owner-kpi-icon"><i class="fas fa-wallet"></i></div>
            <div class="owner-kpi-main">
                <span><?php echo app('translator')->get('project::lang.budget_utilization'); ?></span>
                <?php if($budget_summary['enabled']): ?>
                    <strong><?php echo e($budget_summary['utilization_percent'], false); ?>%</strong>
                    <small>
                        <span class="display_currency" data-currency_symbol="true"><?php echo e($budget_summary['stock_consumed'], false); ?></span>
                        / <span class="display_currency" data-currency_symbol="true"><?php echo e($budget_summary['budget'], false); ?></span>
                    </small>
                <?php else: ?>
                    <strong>--</strong>
                    <small><?php echo app('translator')->get('project::lang.budget_tracking_not_enabled'); ?></small>
                <?php endif; ?>
            </div>
        </div>

        <div class="owner-kpi-card kpi-red">
            <div class="owner-kpi-icon"><i class="fas fa-file-invoice-dollar"></i></div>
            <div class="owner-kpi-main">
                <span><?php echo app('translator')->get('project::lang.invoice_due'); ?></span>
                <strong><span class="display_currency" data-currency_symbol="true"><?php echo e($invoice_summary['due'], false); ?></span></strong>
                <small><?php echo e($invoice_summary['count'], false); ?> <?php echo app('translator')->get('project::lang.invoices'); ?> / <span class="display_currency" data-currency_symbol="true"><?php echo e($invoice_summary['paid'], false); ?></span> <?php echo app('translator')->get('project::lang.total_paid'); ?></small>
            </div>
        </div>

        <div class="owner-kpi-card kpi-purple">
            <div class="owner-kpi-icon"><i class="fas fa-hourglass-half"></i></div>
            <div class="owner-kpi-main">
                <span><?php echo app('translator')->get('project::lang.total_hours'); ?></span>
                <strong><?php echo e($total_hours_formatted, false); ?></strong>
                <small><?php echo e($hours_this_week_formatted, false); ?> <?php echo app('translator')->get('project::lang.this_week'); ?></small>
            </div>
        </div>

        <div class="owner-kpi-card kpi-aqua">
            <div class="owner-kpi-icon"><i class="fas fa-users"></i></div>
            <div class="owner-kpi-main">
                <span><?php echo app('translator')->get('project::lang.team_capacity'); ?></span>
                <strong><?php echo e($team_members_count, false); ?></strong>
                <small><?php echo e($pending_stock_requests, false); ?> <?php echo app('translator')->get('project::lang.pending_stock_requests'); ?></small>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="project-panel owner-watchlist">
                <div class="project-panel-header">
                    <h4><i class="fas fa-bullseye"></i> <?php echo app('translator')->get('project::lang.owner_watchlist'); ?></h4>
                    <a href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'index']) . '?project_view=list_view', false); ?>" class="btn btn-xs btn-default">
                        <?php echo app('translator')->get('project::lang.view_all'); ?> <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
                <div class="project-panel-body">
                    <?php $__empty_18 = true; $__currentLoopData = $owner_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <?php
                            $progress = $project->total_tasks > 0 ? round(($project->completed_tasks / $project->total_tasks) * 100) : 0;
                            $is_overdue = !empty($project->end_date) && \Carbon\Carbon::parse($project->end_date)->lt(\Carbon\Carbon::today()) && !in_array($project->status, ['completed', 'cancelled']);
                            $risk_class = $is_overdue || $project->overdue_tasks > 0 || $project->status == 'on_hold' ? 'risk' : 'healthy';
                        ?>
                        <a class="owner-project-row <?php echo e($risk_class, false); ?>" href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'show'], $project->id), false); ?>">
                            <div class="owner-project-main">
                                <strong><?php echo e($project->name, false); ?></strong>
                                <span class="status-badge status-<?php echo e($project->status, false); ?>"><span class="status-dot"></span><?php echo e($statuses[$project->status] ?? $project->status, false); ?></span>
                                <small class="text-muted">
                                    <?php if($project->lead): ?>
                                        <i class="fa fa-user"></i> <?php echo e($project->lead->user_full_name, false); ?>

                                    <?php endif; ?>
                                    <?php if($project->end_date): ?>
                                        <span class="owner-dot">.</span> <?php echo app('translator')->get('project::lang.end_date'); ?>: <?php echo e(\Carbon::createFromTimestamp(strtotime($project->end_date))->format(session('business.date_format')), false); ?>

                                    <?php endif; ?>
                                </small>
                            </div>
                            <div class="owner-project-progress">
                                <div class="owner-project-counts">
                                    <span><?php echo e($project->completed_tasks, false); ?>/<?php echo e($project->total_tasks, false); ?> <?php echo app('translator')->get('project::lang.tasks'); ?></span>
                                    <?php if($project->overdue_tasks > 0): ?>
                                        <span class="text-danger"><?php echo e($project->overdue_tasks, false); ?> <?php echo app('translator')->get('project::lang.overdue'); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="progress progress-xs">
                                    <div class="progress-bar <?php echo e($progress >= 75 ? 'progress-bar-success' : ($progress >= 40 ? 'progress-bar-primary' : 'progress-bar-warning'), false); ?>" style="width: <?php echo e($progress, false); ?>%"></div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <div class="empty-state">
                            <i class="fas fa-folder-open"></i>
                            <p><?php echo app('translator')->get('project::lang.no_projects_yet'); ?></p>
                            <small><?php echo app('translator')->get('project::lang.create_project_to_start'); ?></small>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="project-panel">
                        <div class="project-panel-header">
                            <h4><i class="fas fa-tasks"></i> <?php echo app('translator')->get('project::lang.task_status_overview'); ?></h4>
                        </div>
                        <div class="project-panel-body">
                            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $count = $task_counts[$key] ?? 0;
                                    $percent = $total_tasks > 0 ? round(($count / $total_tasks) * 100) : 0;
                                ?>
                                <div class="project-dashboard-progress">
                                    <div class="clearfix">
                                        <span class="pull-left"><span class="status-badge status-<?php echo e($key, false); ?>"><span class="status-dot"></span><?php echo e($label, false); ?></span></span>
                                        <strong class="pull-right"><?php echo e($count, false); ?></strong>
                                    </div>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-primary" style="width: <?php echo e($percent, false); ?>%"></div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="project-panel">
                        <div class="project-panel-header">
                            <h4><i class="fas fa-bolt"></i> <?php echo app('translator')->get('project::lang.priority_pressure'); ?></h4>
                        </div>
                        <div class="project-panel-body">
                            <?php
                                $priorities = [
                                    'urgent' => __('project::lang.urgent'),
                                    'high' => __('project::lang.high'),
                                    'medium' => __('project::lang.medium'),
                                    'low' => __('project::lang.low'),
                                ];
                            ?>
                            <?php $__currentLoopData = $priorities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $count = $task_priority_counts[$key] ?? 0;
                                    $percent = $total_tasks > 0 ? round(($count / $total_tasks) * 100) : 0;
                                ?>
                                <div class="project-dashboard-progress">
                                    <div class="clearfix">
                                        <span class="pull-left"><span class="priority-badge priority-<?php echo e($key, false); ?>"><?php echo e($label, false); ?></span></span>
                                        <strong class="pull-right"><?php echo e($count, false); ?></strong>
                                    </div>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar <?php echo e(in_array($key, ['urgent', 'high']) ? 'progress-bar-danger' : 'progress-bar-info', false); ?>" style="width: <?php echo e($percent, false); ?>%"></div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="project-panel owner-action-center">
                <div class="project-panel-header">
                    <h4><i class="fas fa-compass"></i> <?php echo app('translator')->get('project::lang.owner_action_center'); ?></h4>
                </div>
                <div class="project-panel-body">
                    <?php $__currentLoopData = $owner_actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="owner-action-item action-<?php echo e($action['severity'], false); ?>">
                            <div class="owner-action-icon"><i class="<?php echo e($action['icon'], false); ?>"></i></div>
                            <div>
                                <strong>
                                    <?php if(!empty($action['is_currency'])): ?>
                                        <span class="display_currency" data-currency_symbol="true"><?php echo e($action['count'], false); ?></span>
                                    <?php else: ?>
                                        <?php echo e($action['count'], false); ?>

                                    <?php endif; ?>
                                    <?php echo e($action['label'], false); ?>

                                </strong>
                                <small><?php echo e($action['helper'], false); ?></small>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="project-panel">
                <div class="project-panel-header">
                    <h4><i class="fas fa-calendar-day"></i> <?php echo app('translator')->get('project::lang.deadline_focus'); ?></h4>
                </div>
                <div class="project-panel-body owner-deadline-focus">
                    <div>
                        <strong><?php echo e($tasks_due_today, false); ?></strong>
                        <span><?php echo app('translator')->get('project::lang.due_today'); ?></span>
                    </div>
                    <div>
                        <strong><?php echo e($tasks_due_this_week, false); ?></strong>
                        <span><?php echo app('translator')->get('project::lang.due_this_week'); ?></span>
                    </div>
                    <div>
                        <strong><?php echo e($projects_due_this_week, false); ?></strong>
                        <span><?php echo app('translator')->get('project::lang.projects_due_this_week'); ?></span>
                    </div>
                    <div>
                        <strong><?php echo e($high_priority_open_tasks, false); ?></strong>
                        <span><?php echo app('translator')->get('project::lang.high_priority_open'); ?></span>
                    </div>
                </div>
            </div>

            <div class="project-panel">
                <div class="project-panel-header">
                    <h4><i class="fas fa-rocket"></i> <?php echo app('translator')->get('project::lang.market_ready_features'); ?></h4>
                </div>
                <div class="project-panel-body">
                    <?php $__currentLoopData = $feature_backlog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="owner-feature-item">
                            <span class="owner-feature-status"><?php echo e($feature['status'], false); ?></span>
                            <div class="owner-feature-icon"><i class="<?php echo e($feature['icon'], false); ?>"></i></div>
                            <div>
                                <strong><?php echo e($feature['title'], false); ?></strong>
                                <small><?php echo e($feature['detail'], false); ?></small>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="project-panel">
                <div class="project-panel-header">
                    <h4><i class="fas fa-users-cog"></i> <?php echo app('translator')->get('project::lang.team_workload'); ?></h4>
                </div>
                <div class="project-panel-body">
                    <?php $__empty_18 = true; $__currentLoopData = $team_workload; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <?php
                            $load_percent = min(100, ($member->open_tasks / max($open_tasks, 1)) * 100);
                        ?>
                        <div class="owner-workload-row">
                            <div>
                                <strong><?php echo e($member->user_name, false); ?></strong>
                                <small><?php echo e($member->due_this_week, false); ?> <?php echo app('translator')->get('project::lang.due_this_week'); ?> / <?php echo e($member->overdue_tasks, false); ?> <?php echo app('translator')->get('project::lang.overdue'); ?></small>
                            </div>
                            <div class="owner-workload-progress">
                                <span><?php echo e($member->open_tasks, false); ?> <?php echo app('translator')->get('project::lang.open_tasks'); ?></span>
                                <div class="progress progress-xs">
                                    <div class="progress-bar <?php echo e($member->overdue_tasks > 0 ? 'progress-bar-danger' : 'progress-bar-primary', false); ?>" style="width: <?php echo e($load_percent, false); ?>%"></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <div class="empty-state compact">
                            <i class="fas fa-users"></i>
                            <p><?php echo app('translator')->get('project::lang.no_open_workload'); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <?php if($overdue_task_list->count() > 0): ?>
                <div class="project-panel">
                    <div class="project-panel-header">
                        <h4><i class="fas fa-fire"></i> <?php echo app('translator')->get('project::lang.overdue_tasks'); ?></h4>
                    </div>
                    <div class="project-panel-body">
                        <?php $__currentLoopData = $overdue_task_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="project-dashboard-task overdue">
                                <strong><?php echo e($task->subject, false); ?></strong>
                                <small><?php echo e($task->project->name ?? '', false); ?> - <?php echo e(\Carbon\Carbon::parse($task->due_date)->diffForHumans(), false); ?></small>
                                <span class="priority-badge priority-<?php echo e($task->priority, false); ?>"><?php echo e(__('project::lang.' . $task->priority), false); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="project-panel">
                <div class="project-panel-header">
                    <h4><i class="fas fa-calendar-check"></i> <?php echo app('translator')->get('project::lang.upcoming_tasks'); ?></h4>
                </div>
                <div class="project-panel-body">
                    <?php $__empty_18 = true; $__currentLoopData = $upcoming_tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <div class="project-dashboard-task">
                            <strong><?php echo e($task->subject, false); ?></strong>
                            <small><?php echo e($task->project->name ?? '', false); ?> <?php if($task->due_date): ?>- <?php echo e(\Carbon::createFromTimestamp(strtotime($task->due_date))->format(session('business.date_format')), false); ?><?php endif; ?></small>
                            <span class="priority-badge priority-<?php echo e($task->priority, false); ?>"><?php echo e(__('project::lang.' . $task->priority), false); ?></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <div class="empty-state compact">
                            <i class="fas fa-calendar-check"></i>
                            <p><?php echo app('translator')->get('project::lang.no_upcoming_tasks'); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="project_model"></div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('modules/project/js/project.js?v=' . $asset_v . '.' . filemtime(public_path('modules/project/js/project.js'))), false); ?>"></script>
<script>
    $(document).on('change', '.project-dashboard-location-filter', function () {
        $(this).closest('form').submit();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>