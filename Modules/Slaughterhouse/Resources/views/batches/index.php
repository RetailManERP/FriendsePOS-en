
<?php $__env->startSection('title', __('slaughterhouse::lang.slaughter_batches')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('slaughterhouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('slaughterhouse::lang.slaughter_batches'); ?></h1>
</section>

<section class="content">
    <?php echo Form::open(['method' => 'get']); ?>

        <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('location_id', __('slaughterhouse::lang.location') . ':'); ?>

                    <?php echo Form::select('location_id', $business_locations, request('location_id'), ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('slaughterhouse::lang.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('eid_season_id', __('slaughterhouse::lang.eid_season') . ':'); ?>

                    <?php echo Form::select('eid_season_id', $seasons, request('eid_season_id'), ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('slaughterhouse::lang.all')]); ?>

                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-primary btn-block"><?php echo app('translator')->get('report.apply_filters'); ?></button>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>
    <?php echo Form::close(); ?>


    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('slaughterhouse::lang.slaughter_batches')]); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.batch_no'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.location'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.eid_season'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.slaughter_date'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.eid_day'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.total_animals'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.status'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_18 = true; $__currentLoopData = $batches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><?php echo e($batch->batch_no, false); ?></td>
                            <td><?php echo e(optional($batch->location)->name, false); ?></td>
                            <td><?php echo e(optional($batch->eidSeason)->name, false); ?></td>
                            <td><?php echo e(optional($batch->slaughter_date)->format('d-m-Y'), false); ?></td>
                            <td><?php echo e($batch->eid_day ? 'Day '.$batch->eid_day : '-', false); ?></td>
                            <td><?php echo e($batch->total_animals, false); ?></td>
                            <td><span class="label label-default"><?php echo app('translator')->get('slaughterhouse::lang.' . $batch->status); ?></span></td>
                            <td>
                                <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterBatchController::class, 'show'], $batch->id), false); ?>" class="btn btn-xs btn-info">
                                    <?php echo app('translator')->get('slaughterhouse::lang.view'); ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr><td colspan="8" class="text-center"><?php echo app('translator')->get('slaughterhouse::lang.no_records'); ?></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php echo e($batches->links(), false); ?>

    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>