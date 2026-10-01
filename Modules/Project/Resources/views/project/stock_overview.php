
<?php $__env->startSection('title', __('project::lang.stock')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('project::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><i class="fa fa-boxes"></i> <?php echo app('translator')->get('project::lang.stock'); ?> <small><?php echo app('translator')->get('project::lang.allocated_stock'); ?></small></h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <?php echo Form::open(['url' => route('project.stock.overview'), 'method' => 'get', 'id' => 'project_stock_overview_filter']); ?>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('location_id', __('business.business_location') . ':'); ?>

                        <?php echo Form::select('location_id', $business_locations, $location_id, ['class' => 'form-control select2', 'placeholder' => __('messages.all'), 'style' => 'width: 100%;']); ?>

                    </div>
                </div>
            </div>
        <?php echo Form::close(); ?>

    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php if($projects->isEmpty()): ?>
            <p class="text-muted"><?php echo app('translator')->get('project::lang.no_projects_yet'); ?></p>
        <?php else: ?>
            <div class="table-responsive">
            <table class="table table-bordered table-striped table-th-skin">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('project::lang.project'); ?></th>
                        <th><?php echo app('translator')->get('business.business_location'); ?></th>
                        <th><?php echo app('translator')->get('sale.status'); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('lang_v1.received'); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('lang_v1.returned'); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('lang_v1.available'); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('project::lang.stock_requests'); ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <a href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'show'], [$p->id]), false); ?>">
                                    <?php echo e($p->name, false); ?>

                                </a>
                            </td>
                            <td><?php echo e(optional($p->location)->name ?? '-', false); ?></td>
                            <td><span class="label label-default"><?php echo app('translator')->get('project::lang.'.$p->status); ?></span></td>
                            <td class="text-right"><?php echo e(number_format($p->qty_in, 2), false); ?></td>
                            <td class="text-right"><?php echo e(number_format($p->qty_out, 2), false); ?></td>
                            <td class="text-right"><strong><?php echo e(number_format($p->qty_available, 2), false); ?></strong></td>
                            <td class="text-right">
                                <?php if($p->pending_requests > 0): ?>
                                    <span class="label label-warning"><?php echo e($p->pending_requests, false); ?> <?php echo app('translator')->get('lang_v1.pending'); ?></span>
                                <?php else: ?>
                                    <span class="text-muted">0</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a class="btn btn-xs btn-info" href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'show'], [$p->id]), false); ?>#project_stock">
                                    <i class="fa fa-eye"></i> <?php echo app('translator')->get('messages.view'); ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            </div>
        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).on('change', '#project_stock_overview_filter select[name="location_id"]', function () {
        $('#project_stock_overview_filter').submit();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>