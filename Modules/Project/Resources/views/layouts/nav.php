<?php if (! $__env->hasRenderedOnce('222ba5ec-a24b-4fe7-867d-31f4816fbe45')): $__env->markAsRenderedOnce('222ba5ec-a24b-4fe7-867d-31f4816fbe45'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('modules/project/sass/project.css?v=' . $asset_v . '.' . filemtime(public_path('modules/project/sass/project.css'))), false); ?>">
<?php endif; ?>

<?php
    $can_project_admin = $__is_admin || auth()->user()->can('superadmin');
?>
<section class="content-header no-print project-module-nav">
    <div class="btn-group mb-2 flex-wrap" role="group">
        <?php if($can_project_admin || auth()->user()->can('project.access_dashboard')): ?>
            <a href="<?php echo e(action([\Modules\Project\Http\Controllers\DashboardController::class, 'index']), false); ?>" class="btn btn-sm <?php echo e(request()->segment(2) == 'dashboard' ? 'btn-primary' : 'btn-default', false); ?>">
                <i class="fas fa-tachometer-alt"></i> <?php echo app('translator')->get('project::lang.dashboard'); ?>
            </a>
        <?php endif; ?>
        <?php if($can_project_admin || auth()->user()->can('project.view_project') || auth()->user()->can('project.view_all_projects')): ?>
            <a href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'index']) . '?project_view=list_view', false); ?>" class="btn btn-sm <?php echo e(request()->segment(2) == 'project' && request()->get('project_view') != 'kanban' ? 'btn-primary' : 'btn-default', false); ?>">
                <i class="fas fa-folder-open"></i> <?php echo app('translator')->get('project::lang.projects'); ?>
            </a>
            <a href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'index']) . '?project_view=kanban', false); ?>" class="btn btn-sm <?php echo e(request()->segment(2) == 'project' && request()->get('project_view') == 'kanban' ? 'btn-primary' : 'btn-default', false); ?>">
                <i class="fas fa-columns"></i> <?php echo app('translator')->get('project::lang.kanban_board'); ?>
            </a>
        <?php endif; ?>
        <?php if($can_project_admin || auth()->user()->can('project.view_task')): ?>
            <a href="<?php echo e(action([\Modules\Project\Http\Controllers\TaskController::class, 'index']), false); ?>" class="btn btn-sm <?php echo e(request()->segment(2) == 'project-task' ? 'btn-primary' : 'btn-default', false); ?>">
                <i class="fas fa-tasks"></i> <?php echo app('translator')->get('project::lang.my_tasks'); ?>
            </a>
        <?php endif; ?>
        <?php if($can_project_admin || auth()->user()->can('project.view_stock')): ?>
            <a href="<?php echo e(route('project.stock.overview'), false); ?>" class="btn btn-sm <?php echo e(request()->segment(2) == 'project-stock' ? 'btn-primary' : 'btn-default', false); ?>">
                <i class="fas fa-boxes"></i> <?php echo app('translator')->get('project::lang.stock'); ?>
            </a>
        <?php endif; ?>
        <?php if($can_project_admin || auth()->user()->can('project.view_reports')): ?>
            <a href="<?php echo e(action([\Modules\Project\Http\Controllers\ReportController::class, 'index']), false); ?>" class="btn btn-sm <?php echo e(request()->segment(2) == 'project-reports' ? 'btn-primary' : 'btn-default', false); ?>">
                <i class="fas fa-chart-bar"></i> <?php echo app('translator')->get('project::lang.project_report'); ?>
            </a>
        <?php endif; ?>
        <?php if($can_project_admin || auth()->user()->can('project.manage_project_category')): ?>
            <a href="<?php echo e(action([\App\Http\Controllers\TaxonomyController::class, 'index']) . '?type=project', false); ?>" class="btn btn-sm <?php echo e(request()->get('type') == 'project' ? 'btn-primary' : 'btn-default', false); ?>">
                <i class="fas fa-tags"></i> <?php echo app('translator')->get('project::lang.project_category'); ?>
            </a>
        <?php endif; ?>
        <?php if($can_project_admin || auth()->user()->can('project.manage_settings')): ?>
            <a href="<?php echo e(action([\Modules\Project\Http\Controllers\SettingsController::class, 'index']), false); ?>" class="btn btn-sm <?php echo e(request()->segment(2) == 'settings' ? 'btn-primary' : 'btn-default', false); ?>">
                <i class="fas fa-cog"></i> <?php echo app('translator')->get('project::lang.settings'); ?>
            </a>
        <?php endif; ?>
    </div>
</section>
