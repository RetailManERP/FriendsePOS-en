
<?php $__env->startSection('title', __('slaughterhouse::lang.floor_scanning')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('slaughterhouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header"><h1><?php echo app('translator')->get('slaughterhouse::lang.floor_scanning'); ?></h1></section>
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('slaughterhouse::lang.scan_next_stage')]); ?>
        <?php echo Form::open(['url' => action([\Modules\Slaughterhouse\Http\Controllers\SlaughterScanController::class, 'store']), 'method' => 'post']); ?>

            <div class="row">
                <div class="col-md-4"><div class="form-group"><?php echo Form::label('animal_number', __('slaughterhouse::lang.animal_number') . ':*'); ?><?php echo Form::text('animal_number', null, ['class' => 'form-control input-lg', 'required', 'autofocus']); ?></div></div>
                <div class="col-md-3"><div class="form-group"><?php echo Form::label('to_stage', __('slaughterhouse::lang.current_stage') . ':'); ?><?php echo Form::select('to_stage', array_combine($stages, array_map(fn($stage) => __('slaughterhouse::lang.' . $stage), $stages)), null, ['class' => 'form-control', 'placeholder' => 'Auto next stage']); ?></div></div>
                <div class="col-md-3"><div class="form-group"><?php echo Form::label('station_code', __('slaughterhouse::lang.station_code') . ':'); ?><?php echo Form::text('station_code', null, ['class' => 'form-control']); ?></div></div>
                <div class="col-md-2"><div class="form-group"><label>&nbsp;</label><button class="btn btn-primary btn-block btn-lg" type="submit"><i class="fa fa-qrcode"></i> <?php echo app('translator')->get('slaughterhouse::lang.save'); ?></button></div></div>
            </div>
            <div class="row">
                <div class="col-md-12"><div class="form-group"><?php echo Form::label('notes', __('slaughterhouse::lang.notes') . ':'); ?><?php echo Form::text('notes', null, ['class' => 'form-control']); ?></div></div>
            </div>
        <?php echo Form::close(); ?>

    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>