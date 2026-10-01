
<?php $__env->startSection('title', __('productcatalogue::lang.catalogue_settings')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1 class="fs-4 fw-bold text-dark">
        <?php echo app('translator')->get('productcatalogue::lang.catalogue_settings'); ?>
    </h1>
</section>

<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo e(session('status.msg'), false); ?>

        </div>
    <?php endif; ?>

    <?php echo Form::open(['url' => action([\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'saveSettings']), 'method' => 'post', 'id' => 'catalogue_settings_form']); ?>

    <div class="row">
        
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid', 'title' => __('productcatalogue::lang.general_settings')]); ?>
                <div class="form-group">
                    <?php echo Form::label('catalogue_title', __('productcatalogue::lang.catalogue_title') . ':'); ?>

                    <?php echo Form::text('catalogue_title', $settings['catalogue_title'] ?? '', ['class' => 'form-control', 'placeholder' => __('productcatalogue::lang.catalogue_title_placeholder')]); ?>

                </div>

                <div class="form-group">
                    <?php echo Form::label('catalogue_description', __('productcatalogue::lang.catalogue_description') . ':'); ?>

                    <?php echo Form::textarea('catalogue_description', $settings['catalogue_description'] ?? '', ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('productcatalogue::lang.catalogue_description_placeholder')]); ?>

                </div>

                <div class="form-group">
                    <?php echo Form::label('is_show', __('productcatalogue::lang.outofstock_products') . ':'); ?>

                    <div class="form-inline">
                        <div class="radio">
                            <label>
                                <?php echo Form::radio('is_show', 1, ($settings['is_show'] ?? 1) == 1, ['class' => 'form-check-input']); ?>

                                <?php echo app('translator')->get('productcatalogue::lang.show'); ?>
                            </label>
                        </div>
                        &nbsp;&nbsp;
                        <div class="radio">
                            <label>
                                <?php echo Form::radio('is_show', 0, ($settings['is_show'] ?? 1) == 0, ['class' => 'form-check-input']); ?>

                                <?php echo app('translator')->get('productcatalogue::lang.hide'); ?>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('show_sku', 1, ($settings['show_sku'] ?? 1) == 1, ['class' => 'form-check-input']); ?>

                            <?php echo app('translator')->get('productcatalogue::lang.show_sku_on_catalogue'); ?>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('show_description', 1, ($settings['show_description'] ?? 1) == 1, ['class' => 'form-check-input']); ?>

                            <?php echo app('translator')->get('productcatalogue::lang.show_product_description'); ?>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo Form::label('products_per_row', __('productcatalogue::lang.products_per_row') . ':'); ?>

                    <?php echo Form::select('products_per_row', [2 => '2', 3 => '3', 4 => '4', 6 => '6'], $settings['products_per_row'] ?? 4, ['class' => 'form-control']); ?>

                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>

        
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid', 'title' => __('productcatalogue::lang.appearance_branding')]); ?>
                <div class="form-group">
                    <?php echo Form::label('primary_color', __('productcatalogue::lang.primary_color') . ':'); ?>

                    <?php echo Form::text('primary_color', $settings['primary_color'] ?? '#667eea', ['class' => 'form-control']); ?>

                </div>

                <div class="form-group">
                    <?php echo Form::label('secondary_color', __('productcatalogue::lang.secondary_color') . ':'); ?>

                    <?php echo Form::text('secondary_color', $settings['secondary_color'] ?? '#764ba2', ['class' => 'form-control']); ?>

                </div>

                <div class="form-group">
                    <?php echo Form::label('currency_display', __('productcatalogue::lang.currency_display') . ':'); ?>

                    <?php echo Form::select('currency_display', ['symbol' => __('productcatalogue::lang.symbol'), 'code' => __('productcatalogue::lang.code'), 'both' => __('productcatalogue::lang.both')], $settings['currency_display'] ?? 'symbol', ['class' => 'form-control']); ?>

                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>

        
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid', 'title' => __('productcatalogue::lang.ordering_features')]); ?>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('enable_ordering', 1, ($settings['enable_ordering'] ?? 1) == 1, ['class' => 'form-check-input']); ?>

                            <?php echo app('translator')->get('productcatalogue::lang.enable_ordering'); ?>
                        </label>
                    </div>
                    <p class="text-muted small"><?php echo app('translator')->get('productcatalogue::lang.enable_ordering_help'); ?></p>
                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('enable_customer_info', 1, ($settings['enable_customer_info'] ?? 0) == 1, ['class' => 'form-check-input']); ?>

                            <?php echo app('translator')->get('productcatalogue::lang.enable_customer_info'); ?>
                        </label>
                    </div>
                    <p class="text-muted small"><?php echo app('translator')->get('productcatalogue::lang.enable_customer_info_help'); ?></p>
                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('enable_search', 1, ($settings['enable_search'] ?? 1) == 1, ['class' => 'form-check-input']); ?>

                            <?php echo app('translator')->get('productcatalogue::lang.enable_search'); ?>
                        </label>
                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>

        
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid', 'title' => __('productcatalogue::lang.social_sharing')]); ?>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('enable_social_share', 1, ($settings['enable_social_share'] ?? 0) == 1, ['class' => 'form-check-input']); ?>

                            <?php echo app('translator')->get('productcatalogue::lang.enable_social_share'); ?>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo Form::label('whatsapp_number', __('productcatalogue::lang.whatsapp_number') . ':'); ?>

                    <?php echo Form::text('whatsapp_number', $settings['whatsapp_number'] ?? '', ['class' => 'form-control', 'placeholder' => '+1234567890']); ?>

                    <p class="text-muted small"><?php echo app('translator')->get('productcatalogue::lang.whatsapp_number_help'); ?></p>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>

        
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-solid', 'title' => __('productcatalogue::lang.announcement_banner')]); ?>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('announcement_active', 1, ($settings['announcement_active'] ?? 0) == 1, ['class' => 'form-check-input']); ?>

                            <?php echo app('translator')->get('productcatalogue::lang.enable_announcement'); ?>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo Form::label('announcement_text', __('productcatalogue::lang.announcement_text') . ':'); ?>

                    <?php echo Form::text('announcement_text', $settings['announcement_text'] ?? '', ['class' => 'form-control', 'placeholder' => __('productcatalogue::lang.announcement_text_placeholder')]); ?>

                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>

    </div>
    <?php echo Form::close(); ?>


    <div id="catalogue-settings-footer-actions-template" class="d-none">
        <div>
            <button type="button" class="btn btn-primary" id="catalogue_settings_save_btn">
                <i class="fas fa-save"></i> <?php echo app('translator')->get('productcatalogue::lang.save_settings'); ?>
            </button>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        $('#primary_color').colorpicker();
        $('#secondary_color').colorpicker();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>