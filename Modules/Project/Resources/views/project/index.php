
<?php $__env->startSection('title', __('project::lang.project')); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('project::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1><?php echo app('translator')->get('project::lang.projects'); ?> <small><?php echo app('translator')->get('project::lang.all_projects'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php if($project_view == 'list_view'): ?>
            <div class="row project-status-summary">
                <?php $__currentLoopData = $project_stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $icon = match($project->status) {
                            'not_started' => 'fas fa-hourglass-start',
                            'in_progress' => 'fas fa-spinner',
                            'on_hold' => 'fas fa-pause-circle',
                            'cancelled' => 'fas fa-times-circle',
                            'completed' => 'fas fa-check-circle',
                            default => 'fas fa-circle'
                        };
                        $color = match($project->status) {
                            'not_started' => 'bg-gray',
                            'in_progress' => 'bg-blue',
                            'on_hold' => 'bg-yellow',
                            'cancelled' => 'bg-red',
                            'completed' => 'bg-green',
                            default => 'bg-aqua'
                        };
                    ?>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="info-box">
                            <span class="info-box-icon <?php echo e($color, false); ?>"><i class="<?php echo e($icon, false); ?>"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo e($statuses[$project->status], false); ?></span>
                                <span class="info-box-number"><?php echo e($project->count, false); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
        <div class="card shadow-sm project-list-panel">
            <div class="card-header">
                <h4>
                    <i class="fas fa-folder-open"></i> <?php echo app('translator')->get('project::lang.projects'); ?>
                </h4>
                <div class="project-view-toolbar">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-sm btn-primary active list">
                            <input type="radio" name="project_view" value="list_view" class="project_view"
                                data-href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'index']) . '?project_view=list_view', false); ?>">
                            <i class="fa fa-list"></i> <?php echo app('translator')->get('project::lang.list_view'); ?>
                        </label>
                        <label class="btn btn-sm btn-default kanban">
                            <input type="radio" name="project_view" value="kanban" class="project_view"
                                data-href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'index']) . '?project_view=kanban', false); ?>">
                            <i class="fa fa-columns"></i> <?php echo app('translator')->get('project::lang.kanban_board'); ?>
                        </label>
                    </div>
                    <?php if($is_admin || auth()->user()->can('superadmin') || auth()->user()->can('project.create_project')): ?>
                        <button type="button" class="btn btn-sm btn-primary add_new_project"
                            data-href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'create']), false); ?>">
                            <i class="fa fa-plus"></i> <?php echo app('translator')->get('project::lang.new_project'); ?>
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('project_location_filter', __('business.business_location') . ':'); ?>

                            <?php echo Form::select('project_location_filter', $business_locations, request()->get('location_id'), [
                                'class' => 'form-control select2',
                                'placeholder' => __('messages.all'),
                                'style' => 'width: 100%;',
                            ]); ?>

                        </div>
                    </div>
                    <?php if($project_view == 'list_view'): ?>
                        <div class="col-md-3 project_status_filter">
                            <div class="form-group">
                                <?php echo Form::label('project_status_filter', __('sale.status') . ':'); ?>

                                <?php echo Form::select('project_status_filter', $statuses, null, [
                                    'class' => 'form-control select2',
                                    'placeholder' => __('messages.all'),
                                    'style' => 'width: 100%;',
                                ]); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('project_end_date_filter', __('project::lang.end_date') . ':'); ?>

                            <?php echo Form::select('project_end_date_filter', $due_dates, null, [
                                'class' => 'form-control select2',
                                'placeholder' => __('messages.all'),
                                'style' => 'width: 100%;',
                            ]); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('project_categories_filter', __('project::lang.category') . ':'); ?>

                            <?php echo Form::select('project_categories_filter', $categories, null, [
                                'class' => 'form-controll select2',
                                'placeholder' => __('messages.all'),
                                'style' => 'width:100%;',
                            ]); ?>

                        </div>
                    </div>
                </div>
                <?php if($project_view == 'list_view'): ?>
                    <div class="project_html">
                    </div>
                <?php endif; ?>
                <!-- project kanban -->
                <?php if($project_view == 'kanban'): ?>
                    <div class="project-kanban-board">
                        <div class="page">
                            <div class="main">
                                <div class="meta-tasks-wrapper">
                                    <div id="myKanban" class="meta-tasks">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- /.box -->
        <div class="modal fade" tabindex="-1" role="dialog" id="project_model"></div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script src="<?php echo e(asset('modules/project/js/project.js?v=' . $asset_v . '.' . filemtime(public_path('modules/project/js/project.js'))), false); ?>"></script>
    <!-- get list of project on load of page -->
    <script type="text/javascript">
        $(document).ready(function() {
            var project_view = urlSearchParam('project_view');

            //if project view is empty, set default to list_view
            if (_.isEmpty(project_view)) {
                project_view = 'list_view';
            }

            if (project_view == 'kanban') {
                $('.kanban').addClass('active');
                $('.list').removeClass('active');
                initializeProjectKanbanBoard();
            } else if (project_view == 'list_view') {
                getProjectList();
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>