

<?php $__env->startSection('title', __('aiassistance::lang.aiassistance')); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('aiassistance::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo app('translator')->get('aiassistance::lang.aiassistance'); ?></h1>
        <?php if($token_remaining_display): ?>
            <p class="text-info"><?php echo e($token_remaining_display, false); ?></p>
        <?php endif; ?>
    </section>

    <section class="content no-print">
        <div class="row">

            <?php $__currentLoopData = $tools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card radius-10 h-100 border-top border-3 border-primary">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="<?php echo e($tool['icon'], false); ?> font-30 text-primary"></i>
                            </div>
                            <h5 class="card-title mb-2"><?php echo e($tool['label'], false); ?></h5>
                            <p class="text-muted font-13"><?php echo e($tool['description'], false); ?></p>
                            <a href="<?php echo e(action([\Modules\AiAssistance\Http\Controllers\AiAssistanceController::class, 'create'], ['tool' => $k]), false); ?>"
                                class="btn btn-primary btn-sm mt-2">
                                <i class="fas fa-plus-circle me-1"></i> <?php echo app('translator')->get('aiassistance::lang.create'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>