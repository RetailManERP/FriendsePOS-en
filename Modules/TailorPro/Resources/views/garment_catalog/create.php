
<?php $__env->startSection('title', __('tailorpro::lang.add_catalog_item')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('tailorpro::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header no-print">
    <h1><i class="fas fa-plus-circle" style="color:#6f42c1;"></i> <?php echo app('translator')->get('tailorpro::lang.add_catalog_item'); ?></h1>
</section>

<section class="content no-print">
    <?php echo Form::open(['url' => action([\Modules\TailorPro\Http\Controllers\GarmentCatalogController::class, 'store']), 'method' => 'post', 'id' => 'tailorpro_catalog_form', 'files' => true]); ?>

    <div class="box" style="border-radius:10px;">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo app('translator')->get('tailorpro::lang.garment_catalog'); ?></h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('name', __('tailorpro::lang.catalog_name') . ':*'); ?>

                        <?php echo Form::text('name', null, ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('default_price', __('tailorpro::lang.default_price') . ':'); ?>

                        <?php echo Form::number('default_price', 0, ['class' => 'form-control', 'step' => '0.01', 'min' => '0']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('measurement_template_id', __('tailorpro::lang.linked_template') . ':'); ?>

                        <?php echo Form::select('measurement_template_id', $templates, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('description', __('tailorpro::lang.catalog_description') . ':'); ?>

                        <?php echo Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('image', __('tailorpro::lang.catalog_image') . ':'); ?>

                        <?php echo Form::file('image', ['class' => 'form-control', 'accept' => 'image/*']); ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <?php echo Form::label('sort_order', __('tailorpro::lang.sort_order') . ':'); ?>

                        <?php echo Form::number('sort_order', 0, ['class' => 'form-control', 'min' => '0']); ?>

                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <?php echo Form::label('is_active', __('tailorpro::lang.active') . ':'); ?><br>
                        <?php echo Form::checkbox('is_active', 1, true); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>