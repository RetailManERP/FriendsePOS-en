
<?php $__env->startSection('title', __('manufacturing::lang.production')); ?>

<?php $__env->startSection('css'); ?>
<style>
    #productions_table_wrapper .dataTables_scrollBody > table {
        min-width: 100% !important;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('manufacturing::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('manufacturing::lang.production'); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('productstion_list_filter_location_id',  __('purchase.business_location') . ':'); ?>


                <?php echo Form::select('productstion_list_filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all') ]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('production_list_filter_date_range', __('report.date_range') . ':'); ?>

                <?php echo Form::text('production_list_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <div class="form-check">
                    <br>
                    <label class="form-check-label">
<?php echo Form::checkbox('production_list_is_final', 1, false, 
                      [ 'class' => 'form-check-input', 'id' => 'production_list_is_final']); ?> <?php echo e(__('manufacturing::lang.finalize'), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('production_list_filter_status', __('manufacturing::lang.production_status') . ':'); ?>

                <?php echo Form::select('production_list_filter_status', [
                    '' => __('lang_v1.all'),
                    'planned' => __('manufacturing::lang.status_planned'),
                    'in_progress' => __('manufacturing::lang.status_in_progress'),
                    'quality_check' => __('manufacturing::lang.status_quality_check'),
                    'completed' => __('manufacturing::lang.status_completed'),
                    'on_hold' => __('manufacturing::lang.status_on_hold'),
                    'cancelled' => __('manufacturing::lang.status_cancelled'),
                ], null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('production_list_filter_category_id', __('product.category') . ':'); ?>

                <?php echo Form::select('production_list_filter_category_id', $categories, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('production_list_filter_sub_category_id', __('product.sub_category') . ':'); ?>

                <?php echo Form::select('production_list_filter_sub_category_id', [], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('production_list_filter_sub2_category_id', __('product.sub2_category') . ':'); ?>

                <?php echo Form::select('production_list_filter_sub2_category_id', [], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-12 mt-2">
            <button type="button" class="btn btn-primary btn-sm" id="production_filter_save">
                <i class="fa fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>
            </button>
            <button type="button" class="btn btn-warning btn-sm" id="production_filter_reset">
                <i class="fa fa-undo"></i> <?php echo app('translator')->get('lang_v1.reset'); ?>
            </button>
        </div>
    <?php echo $__env->renderComponent(); ?>
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <a class="btn btn-block btn-primary" href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\ProductionController::class, 'create']), false); ?>">
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></a>
            </div>
        <?php $__env->endSlot(); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-th-skin" id="productions_table">
                 <thead>
                    <tr>
                        <th><?php echo app('translator')->get('messages.action'); ?></th>
                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                        <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                        <th><?php echo app('translator')->get('sale.product'); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('lang_v1.quantity'); ?></th>
                        <th><?php echo app('translator')->get('manufacturing::lang.production_status'); ?></th>
                        <th><?php echo app('translator')->get('manufacturing::lang.priority'); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('manufacturing::lang.total_cost'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('lang_v1.selling_price'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                        <th><?php echo app('translator')->get('purchase.location'); ?></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="bg-gray font-17 footer-total text-center">
                        <td colspan="7"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                        <td class="footer_total_cost text-right"></td>
                        <td class="footer_total_selling_price text-right"></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>
</section>
<!-- /.content -->
<div class="modal fade" id="recipe_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade" id="production_status_modal" tabindex="-1" role="dialog" aria-labelledby="prodStatusModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="prodStatusModalLabel"><?php echo app('translator')->get('manufacturing::lang.change_status'); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="prod_status_change_id">
                <div class="form-group">
                    <label for="prod_status_new_status"><?php echo app('translator')->get('manufacturing::lang.production_status'); ?></label>
                    <select id="prod_status_new_status" class="form-control">
                        <option value="planned"><?php echo app('translator')->get('manufacturing::lang.status_planned'); ?></option>
                        <option value="in_progress"><?php echo app('translator')->get('manufacturing::lang.status_in_progress'); ?></option>
                        <option value="quality_check"><?php echo app('translator')->get('manufacturing::lang.status_quality_check'); ?></option>
                        <option value="on_hold"><?php echo app('translator')->get('manufacturing::lang.status_on_hold'); ?></option>
                        <option value="cancelled"><?php echo app('translator')->get('manufacturing::lang.status_cancelled'); ?></option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
                <button type="button" class="btn btn-primary" id="prod_status_save_btn"><?php echo app('translator')->get('manufacturing::lang.update_status'); ?></button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <?php echo $__env->make('manufacturing::layouts.partials.common_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>