
<?php $__env->startSection('title', __('tailorpro::lang.view_measurement')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('tailorpro::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><i class="fas fa-ruler-combined" style="color:#6f42c1;"></i> <?php echo app('translator')->get('tailorpro::lang.view_measurement'); ?></h1>
</section>

<section class="content">
    <div class="box" style="border-radius:10px;">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo e($measurement->customer->name ?? '', false); ?> &mdash; <?php echo e(ucfirst($measurement->type), false); ?> (v<?php echo e($measurement->version, false); ?>)</h3>
            <div class="box-tools">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tailorpro_measurement.update')): ?>
                <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\MeasurementController::class, 'edit'], [$measurement->id]), false); ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-edit"></i> <?php echo app('translator')->get('messages.edit'); ?>
                </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <strong><?php echo app('translator')->get('role.customer'); ?>:</strong>
                    <p><?php echo e($measurement->customer->name ?? 'N/A', false); ?></p>
                </div>
                <div class="col-md-4">
                    <strong><?php echo app('translator')->get('tailorpro::lang.type'); ?>:</strong>
                    <p><?php echo e(ucfirst($measurement->type), false); ?></p>
                </div>
                <div class="col-md-4">
                    <strong><?php echo app('translator')->get('tailorpro::lang.version'); ?>:</strong>
                    <p>v<?php echo e($measurement->version, false); ?></p>
                </div>
            </div>

            <hr>
            <h4><i class="fas fa-ruler"></i> <?php echo app('translator')->get('tailorpro::lang.measurement_values'); ?></h4>
            <div class="row">
                <?php if(is_array($measurement->data) && count($measurement->data) > 0): ?>
                    <?php $__currentLoopData = $measurement->data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo e(ucwords(str_replace('_', ' ', $key)), false); ?></label>
                            <p class="form-control-static"><strong><?php echo e($value, false); ?></strong></p>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="col-md-12">
                        <p class="text-muted"><?php echo app('translator')->get('tailorpro::lang.no_measurement_data'); ?></p>
                    </div>
                <?php endif; ?>
            </div>

            <?php if($measurement->notes): ?>
            <hr>
            <h4><i class="fas fa-sticky-note"></i> <?php echo app('translator')->get('tailorpro::lang.notes'); ?></h4>
            <p><?php echo e($measurement->notes, false); ?></p>
            <?php endif; ?>

            <hr>
            <div class="row">
                <div class="col-md-4">
                    <strong><?php echo app('translator')->get('tailorpro::lang.recorded_by'); ?>:</strong>
                    <p><?php echo e($measurement->createdBy->first_name ?? '', false); ?> <?php echo e($measurement->createdBy->last_name ?? '', false); ?></p>
                </div>
                <div class="col-md-4">
                    <strong><?php echo app('translator')->get('tailorpro::lang.date'); ?>:</strong>
                    <p><?php echo e(\Carbon::createFromTimestamp(strtotime($measurement->created_at))->format(session('business.date_format') . ' ' . 'h:i A'), false); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>