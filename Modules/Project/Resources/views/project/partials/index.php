<div class="row project-card-grid">
    <?php if($projects->count() > 0): ?>
        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $total_tasks = $project->total_tasks ?? 0;
                $completed_tasks = $project->completed_tasks ?? 0;
                $progress = $total_tasks > 0 ? round(($completed_tasks / $total_tasks) * 100) : 0;
                $days_remaining = !empty($project->end_date) ? (int) \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($project->end_date), false) : null;
                $is_overdue = !is_null($days_remaining) && $days_remaining < 0 && $project->status != 'completed';
                $is_due_soon = !is_null($days_remaining) && $days_remaining >= 0 && $days_remaining <= 7 && $project->status != 'completed';
                $progress_class = $progress >= 75 ? 'is-success' : ($progress >= 50 ? 'is-primary' : ($progress >= 25 ? 'is-warning' : 'is-muted'));
                $lead_name = !empty($project->lead) ? $project->lead->user_full_name : '-';
                $is_project_admin = auth()->user()->can('superadmin') || auth()->user()->hasRole('Admin#' . session()->get('user.business_id'));
            ?>

            <div class="col-xs-12 col-sm-6 col-lg-4 project-card-col">
                <div class="modern-project-card project-status-<?php echo e($project->status, false); ?> <?php echo e($is_overdue ? 'is-overdue' : '', false); ?>">
                    <div class="modern-project-card-header">
                        <a href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'show'], [$project->id]), false); ?>" class="project-card-avatar" aria-label="<?php echo app('translator')->get('project::lang.view_project'); ?>">
                            <?php echo e(strtoupper(substr($project->name, 0, 1)), false); ?>

                        </a>

                        <div class="project-card-title-wrap">
                            <a href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'show'], [$project->id]), false); ?>" class="project-card-title">
                                <?php echo e(ucfirst($project->name), false); ?>

                            </a>
                            <?php if(isset($project->customer->name)): ?>
                                <span class="project-card-subtitle">
                                    <i class="fa fa-briefcase"></i> <?php echo e($project->customer->name, false); ?>

                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="dropdown project-card-menu">
                            <button class="project-card-menu-btn dropdown-toggle" type="button" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right dropdown-menu-end">
                                <li>
                                    <a href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'show'], [$project->id]), false); ?>">
                                        <i class="fas fa-external-link-alt"></i> <?php echo app('translator')->get('messages.view'); ?>
                                    </a>
                                </li>
                                <?php if($is_project_admin || auth()->user()->can('project.edit_project')): ?>
                                    <li>
                                        <a data-href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'edit'], [$project->id]), false); ?>" class="cursor-pointer edit_a_project">
                                            <i class="fa fa-edit"></i> <?php echo app('translator')->get('messages.edit'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if($is_project_admin || auth()->user()->can('project.delete_project')): ?>
                                    <li>
                                        <a data-href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'destroy'], [$project->id]), false); ?>" class="cursor-pointer delete_a_project">
                                            <i class="fas fa-trash"></i> <?php echo app('translator')->get('messages.delete'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li class="divider"></li>
                                <li>
                                    <a href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'show'], [$project->id]) . '?view=overview', false); ?>">
                                        <i class="fas fa-tachometer-alt"></i> <?php echo app('translator')->get('project::lang.overview'); ?>
                                    </a>
                                </li>
                                <?php if($is_project_admin || auth()->user()->can('project.view_activity')): ?>
                                    <li>
                                        <a href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'show'], [$project->id]) . '?view=activities', false); ?>">
                                            <i class="fas fa-chart-line"></i> <?php echo app('translator')->get('lang_v1.activities'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if($is_project_admin || auth()->user()->can('project.view_task')): ?>
                                    <li>
                                        <a href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'show'], [$project->id]) . '?view=project_task', false); ?>">
                                            <i class="fa fa-tasks"></i> <?php echo app('translator')->get('project::lang.task'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(isset($project->settings['enable_timelog']) && $project->settings['enable_timelog'] && ($is_project_admin || auth()->user()->can('project.view_time_log') || auth()->user()->can('project.manage_timelogs'))): ?>
                                    <li>
                                        <a href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'show'], [$project->id]) . '?view=time_log', false); ?>">
                                            <i class="fas fa-clock"></i> <?php echo app('translator')->get('project::lang.time_logs'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(isset($project->settings['enable_notes_documents']) && $project->settings['enable_notes_documents'] && ($is_project_admin || auth()->user()->can('project.view_documents_notes') || auth()->user()->can('project.manage_documents_notes'))): ?>
                                    <li>
                                        <a href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'show'], [$project->id]) . '?view=documents_and_notes', false); ?>">
                                            <i class="fas fa-file-image"></i> <?php echo app('translator')->get('project::lang.documents_and_notes'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(false && (isset($project->settings['enable_invoice']) && $project->settings['enable_invoice']) && $project->is_lead_or_admin): ?>
                                    <li>
                                        <a href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'show'], [$project->id]) . '?view=project_invoices', false); ?>">
                                            <i class="fa fa-file"></i> <?php echo app('translator')->get('project::lang.invoices'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(!empty($project->is_lead_or_admin) && ($is_project_admin || auth()->user()->can('project.manage_settings'))): ?>
                                    <li>
                                        <a href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'show'], [$project->id]) . '?view=project_settings', false); ?>">
                                            <i class="fa fa-cogs"></i> <?php echo app('translator')->get('role.settings'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="project-card-chip-row">
                        <span class="status-badge status-<?php echo e($project->status, false); ?>">
                            <span class="status-dot"></span>
                            <?php echo app('translator')->get('project::lang.' . $project->status); ?>
                        </span>

                        <?php if(!empty($project->location)): ?>
                            <span class="project-card-chip">
                                <i class="fas fa-map-marker-alt"></i> <?php echo e($project->location->name, false); ?>

                            </span>
                        <?php endif; ?>

                        <?php if($is_overdue): ?>
                            <span class="project-card-chip chip-danger">
                                <i class="fas fa-calendar-times"></i> <?php echo e(abs($days_remaining), false); ?>d <?php echo app('translator')->get('project::lang.overdue'); ?>
                            </span>
                        <?php elseif($is_due_soon): ?>
                            <span class="project-card-chip chip-warning">
                                <i class="fas fa-calendar-day"></i>
                                <?php if($days_remaining == 0): ?>
                                    <?php echo app('translator')->get('home.today'); ?>
                                <?php else: ?>
                                    <?php echo e($days_remaining, false); ?>d
                                <?php endif; ?>
                            </span>
                        <?php endif; ?>

                        <?php $__currentLoopData = $project->categories->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="project-card-chip"><?php echo e($category->name, false); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($project->categories->count() > 2): ?>
                            <span class="project-card-chip">+<?php echo e($project->categories->count() - 2, false); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="project-card-progress">
                        <div class="project-card-progress-head">
                            <span><?php echo app('translator')->get('project::lang.progress'); ?></span>
                            <strong><?php echo e($progress, false); ?>%</strong>
                        </div>
                        <div class="project-card-progress-track">
                            <div class="project-card-progress-bar <?php echo e($progress_class, false); ?>" style="width: <?php echo e($progress, false); ?>%"></div>
                        </div>
                    </div>

                    <div class="project-card-meta">
                        <div class="project-card-meta-item">
                            <i class="fas fa-user-tie"></i>
                            <span title="<?php echo e($lead_name, false); ?>"><?php echo e($lead_name, false); ?></span>
                        </div>
                        <div class="project-card-meta-item">
                            <i class="fa fa-tasks"></i>
                            <span><?php echo e($completed_tasks, false); ?>/<?php echo e($total_tasks, false); ?> <?php echo app('translator')->get('project::lang.tasks'); ?></span>
                        </div>
                        <?php if(isset($project->start_date)): ?>
                            <div class="project-card-meta-item">
                                <i class="fas fa-play-circle"></i>
                                <span><?php echo e(\Carbon::createFromTimestamp(strtotime($project->start_date))->format(session('business.date_format')), false); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if(isset($project->end_date)): ?>
                            <div class="project-card-meta-item <?php echo e($is_overdue ? 'text-danger' : ($is_due_soon ? 'text-warning' : ''), false); ?>">
                                <i class="fas fa-flag-checkered"></i>
                                <span><?php echo e(\Carbon::createFromTimestamp(strtotime($project->end_date))->format(session('business.date_format')), false); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="modern-project-card-footer">
                        <div class="project-card-members">
                            <?php $__empty_18 = true; $__currentLoopData = $project->members->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                <?php if(isset($member->media->display_url)): ?>
                                    <img src="<?php echo e($member->media->display_url, false); ?>" alt="<?php echo e($member->user_full_name, false); ?>" title="<?php echo e($member->user_full_name, false); ?>" data-toggle="tooltip">
                                <?php else: ?>
                                    <span title="<?php echo e($member->user_full_name, false); ?>" data-toggle="tooltip">
                                        <?php echo e(strtoupper(substr($member->first_name, 0, 1)), false); ?><?php echo e(strtoupper(substr($member->last_name ?? '', 0, 1)), false); ?>

                                    </span>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                <span title="<?php echo app('translator')->get('project::lang.no_record_found'); ?>" data-toggle="tooltip">
                                    <i class="fa fa-user"></i>
                                </span>
                            <?php endif; ?>

                            <?php if($project->members->count() > 5): ?>
                                <span class="more-members">+<?php echo e($project->members->count() - 5, false); ?></span>
                            <?php endif; ?>
                        </div>

                        <a href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'show'], [$project->id]), false); ?>" class="project-card-view-link">
                            <?php echo app('translator')->get('project::lang.view_project'); ?> <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <div class="col-md-12">
            <div class="empty-state project-empty-state">
                <i class="fas fa-project-diagram"></i>
                <p><?php echo app('translator')->get('project::lang.project_not_found'); ?></p>
                <small><?php echo app('translator')->get('project::lang.create_project_to_start'); ?></small>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php if($projects->nextPageUrl()): ?>
    <a data-href="<?php echo e($projects->nextPageUrl(), false); ?>" class="project-load-more load_more_project">
        <i class="fas fa-chevron-down"></i> <?php echo app('translator')->get('project::lang.load_more'); ?>
    </a>
<?php endif; ?>
