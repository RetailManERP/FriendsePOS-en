
<?php $__env->startSection('title', __('slaughterhouse::lang.eid_seasons')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('slaughterhouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('slaughterhouse::lang.eid_seasons'); ?></h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('slaughterhouse::lang.eid_seasons')]); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\EidSeasonController::class, 'create']), false); ?>" class="btn btn-primary">
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get('slaughterhouse::lang.add_eid_season'); ?>
                </a>
            </div>
        <?php $__env->endSlot(); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.season_name'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.day_1_date'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.day_2_date'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.day_3_date'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.status'); ?></th>
                        <th><?php echo app('translator')->get('slaughterhouse::lang.actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_18 = true; $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><?php echo e($season->name, false); ?></td>
                            <td><?php echo e(optional($season->day_1_date)->format('d-m-Y'), false); ?></td>
                            <td><?php echo e(optional($season->day_2_date)->format('d-m-Y'), false); ?></td>
                            <td><?php echo e(optional($season->day_3_date)->format('d-m-Y'), false); ?></td>
                            <td><span class="label label-default"><?php echo app('translator')->get('slaughterhouse::lang.' . $season->status); ?></span></td>
                            <td>
                                <a href="<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\EidSeasonController::class, 'edit'], $season->id), false); ?>" class="btn btn-xs btn-primary">
                                    <i class="fa fa-edit"></i> <?php echo app('translator')->get('slaughterhouse::lang.edit'); ?>
                                </a>
                                <?php echo Form::open(['url' => action([\Modules\Slaughterhouse\Http\Controllers\EidSeasonController::class, 'destroy'], $season->id), 'method' => 'delete', 'style' => 'display:inline']); ?>

                                    <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo e(__('messages.sure'), false); ?>')">
                                        <i class="fa fa-trash"></i> <?php echo app('translator')->get('slaughterhouse::lang.delete'); ?>
                                    </button>
                                <?php echo Form::close(); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr><td colspan="6" class="text-center"><?php echo app('translator')->get('slaughterhouse::lang.no_records'); ?></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php echo e($seasons->links(), false); ?>

    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>