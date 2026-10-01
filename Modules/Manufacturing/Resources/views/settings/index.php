
<?php $__env->startSection('title', __('messages.settings')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('manufacturing::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('messages.settings'); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <?php echo Form::open(['url' => action([\Modules\Manufacturing\Http\Controllers\SettingsController::class, 'store']),
    'method' => 'post', 'id' => 'manufacturing_settings_form' ]); ?>

    <div class="row">
        <div class="col-xs-12">
            <!--  <pos-tab-container> -->
            <div class="col-xs-12 pos-tab-container">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 pos-tab-menu">
                    <div class="list-group">
                        <a href="#" class="list-group-item text-center active"><?php echo app('translator')->get('messages.settings'); ?></a>
                    </div>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 pos-tab">
                    <div class="pos-tab-content active">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo Form::label('ref_no_prefix', __('manufacturing::lang.mfg_ref_no_prefix') . ':' ); ?>

                                    <?php echo Form::text('ref_no_prefix', !empty($manufacturing_settings['ref_no_prefix']) ?
                                    $manufacturing_settings['ref_no_prefix'] : null, ['placeholder' =>
                                    __('manufacturing::lang.mfg_ref_no_prefix'), 'class' => 'form-control']); ?>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo Form::label('reverse_ref_no_prefix', __('manufacturing::lang.mfg_reverse_ref_no_prefix') . ':' ); ?>

                                    <?php echo Form::text('reverse_ref_no_prefix', !empty($manufacturing_settings['reverse_ref_no_prefix']) ?
                                    $manufacturing_settings['reverse_ref_no_prefix'] : null, ['placeholder' =>
                                    __('manufacturing::lang.mfg_reverse_ref_no_prefix'), 'class' => 'form-control']); ?>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <br>
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('enable_reverse_production', 1,
                                            !empty($manufacturing_settings['enable_reverse_production']), ['class'
                                            => 'form-check-input', 'id' => 'enable_reverse_production']); ?>

                                            <?php echo app('translator')->get('manufacturing::lang.enable_reverse_production'); ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <br>
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('disable_editing_ingredient_qty', 1,
                                            !empty($manufacturing_settings['disable_editing_ingredient_qty']), ['class'
                                            => 'form-check-input', 'id' => 'disable_editing_ingredient_qty']); ?>

                                            <?php echo app('translator')->get('manufacturing::lang.disable_editing_ingredient_qty'); ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <br>
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('enable_updating_product_price', 1,
                                            !empty($manufacturing_settings['enable_updating_product_price']), ['class'
                                            => 'form-check-input', 'id' => 'enable_updating_product_price']); ?>

                                            <?php echo app('translator')->get('manufacturing::lang.enable_editing_product_price_after_production'); ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <hr>
                        <h4><?php echo app('translator')->get('manufacturing::lang.enhanced_settings'); ?></h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('enable_production_status', 1,
                                            !empty($manufacturing_settings['enable_production_status']), ['class'
                                            => 'form-check-input', 'id' => 'enable_production_status']); ?>

                                            <?php echo app('translator')->get('manufacturing::lang.enable_production_status'); ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('enable_quality_control', 1,
                                            !empty($manufacturing_settings['enable_quality_control']), ['class'
                                            => 'form-check-input', 'id' => 'enable_quality_control']); ?>

                                            <?php echo app('translator')->get('manufacturing::lang.enable_quality_control'); ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('enable_yield_tracking', 1,
                                            !empty($manufacturing_settings['enable_yield_tracking']), ['class'
                                            => 'form-check-input', 'id' => 'enable_yield_tracking']); ?>

                                            <?php echo app('translator')->get('manufacturing::lang.enable_yield_tracking'); ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('enable_batch_tracking', 1,
                                            !empty($manufacturing_settings['enable_batch_tracking']), ['class'
                                            => 'form-check-input', 'id' => 'enable_batch_tracking']); ?>

                                            <?php echo app('translator')->get('manufacturing::lang.enable_batch_tracking'); ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('enable_enhanced_costs', 1,
                                            !empty($manufacturing_settings['enable_enhanced_costs']), ['class'
                                            => 'form-check-input', 'id' => 'enable_enhanced_costs']); ?>

                                            <?php echo app('translator')->get('manufacturing::lang.enable_enhanced_costs'); ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
<?php echo Form::checkbox('auto_generate_batch_number', 1,
                                            !empty($manufacturing_settings['auto_generate_batch_number']), ['class'
                                            => 'form-check-input', 'id' => 'auto_generate_batch_number']); ?>

                                            <?php echo app('translator')->get('manufacturing::lang.auto_generate_batch_number'); ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--  </pos-tab-container> -->
        </div>
    </div>
    <div class="row">
    </div>

    <div class="col-xs-12">
        <p class="help-block"><i><?php echo __('manufacturing::lang.version_info', ['version' => $version]); ?></i></p>
    </div>
    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
$(document).ready(function() {
    $(".file-input").fileinput(fileinput_setting);
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>