
<?php $__env->startSection('title', __('manufacturing::lang.recipe')); ?>

<?php $__env->startSection('css'); ?>
<style>
    #recipe_table_wrapper .dataTables_scrollBody > table {
        min-width: 100% !important;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('manufacturing::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('manufacturing::lang.recipe'); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <div class="col-md-4">
            <div class="form-group">
                <?php echo Form::label('recipe_filter_category_id', __('product.category') . ':'); ?>

                <?php echo Form::select('recipe_filter_category_id', $categories, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php echo Form::label('recipe_filter_sub_category_id', __('product.sub_category') . ':'); ?>

                <?php echo Form::select('recipe_filter_sub_category_id', [], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php echo Form::label('recipe_filter_sub2_category_id', __('product.sub2_category') . ':'); ?>

                <?php echo Form::select('recipe_filter_sub2_category_id', [], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-12 mt-2">
            <button type="button" class="btn btn-primary btn-sm" id="recipe_filter_save">
                <i class="fa fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>
            </button>
            <button type="button" class="btn btn-warning btn-sm" id="recipe_filter_reset">
                <i class="fa fa-undo"></i> <?php echo app('translator')->get('lang_v1.reset'); ?>
            </button>
        </div>
    <?php echo $__env->renderComponent(); ?>
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check("manufacturing.add_recipe")): ?>
            <?php $__env->slot('tool'); ?>
                <div class="row align-items-center w-100">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group mb-0">
                            <label class="form-check-label">
                                <?php echo Form::checkbox('show_deleted', 1, false, ['class' => 'form-check-input', 'id' => 'show_deleted']); ?> <strong><?php echo app('translator')->get('lang_v1.show_deleted'); ?></strong>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 text-end">
                        <a href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\RecipeController::class, 'downloadExcel']), false); ?>" class="btn btn-warning" title="<?php echo app('translator')->get('manufacturing::lang.download_excel_help'); ?>">
                            <i class="fa fa-file-excel-o"></i> <?php echo app('translator')->get('lang_v1.download_excel'); ?></a>
                        <a href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\RecipeController::class, 'importForm']), false); ?>" class="btn btn-success">
                            <i class="fa fa-upload"></i> <?php echo app('translator')->get('manufacturing::lang.import_recipes'); ?></a>
                        <button class="btn btn btn-primary btn-modal" data-container="#recipe_modal" data-href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\RecipeController::class, 'create']), false); ?>">
                            <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></button>
                    </div>
                </div>
            <?php $__env->endSlot(); ?>
        <?php endif; ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-th-skin" id="recipe_table">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all-row" data-table-id="recipe_table"></th>
                        <th><?php echo app('translator')->get( 'manufacturing::lang.recipe' ); ?></th>
                        <th><?php echo app('translator')->get( 'product.category' ); ?></th>
                        <th><?php echo app('translator')->get( 'product.sub_category' ); ?></th>
                        <th><?php echo app('translator')->get( 'product.sub2_category' ); ?></th>
                        <th class="text-right"><?php echo app('translator')->get( 'lang_v1.quantity' ); ?></th>
                        <th class="text-right"><?php echo app('translator')->get( 'lang_v1.price' ); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('manufacturing::lang.price_updated_live') . '"></i>';
                }
            ?></th>
                        <th class="text-right"><?php echo app('translator')->get( 'sale.unit_price' ); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                        <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="9">
                            <button type="button" class="btn btn-xs btn-danger" id="mass_update_product_price" ><?php echo app('translator')->get('manufacturing::lang.update_product_price'); ?></button> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('manufacturing::lang.update_product_price_help') . '"></i>';
                }
            ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>
</section>
<!-- /.content -->
<div class="modal fade" id="recipe_modal" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <?php echo $__env->make('manufacturing::layouts.partials.common_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>