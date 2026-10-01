<div class="pos-tab-content">
    <div class="row">
        <?php $__env->startComponent('components.filters', ['title' => __('report.filters'), 'filterId' => 'stockAdjustmentFilter']); ?>
            <div class="col-md-3">
                <div class="form-group">
                    <button class="btn btn-info btn-block" id="remap_defaults_stock_adjustment" type="button">Remap Defaults <i class="hide fas fa-sync fa-spin fa-fw"></i></button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('stock_adjustment_filter_location_id',  __('purchase.business_location') . ':'); ?>

                    <?php echo Form::select('stock_adjustment_filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('stock_adjustment_filter_mapping_type',  'Mapping Type:'); ?>

                    <?php echo Form::select('stock_adjustment_filter_mapping_type', ['mapped' => 'Mapped', 'unmapped' => 'Unmapped'], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('stock_adjustment_filter_date_range', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('stock_adjustment_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>
    </div>

    <div class="row">
        <div class="col-md-12">
            

        <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="stock_adjustment_table">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('messages.action'); ?></th>
                    <th><?php echo app('translator')->get('messages.date'); ?></th>
                    <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                    <th><?php echo app('translator')->get('purchase.location'); ?></th>
                    <th><?php echo app('translator')->get('stock_adjustment.adjustment_type'); ?></th>
                    <th><?php echo app('translator')->get('stock_adjustment.total_amount'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                    <th><?php echo app('translator')->get('stock_adjustment.total_amount_recovered'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-right text-bold"><?php echo app('translator')->get('lang_v1.total'); ?></td>
                    <td class="footer_final_total text-right text-bold"></td>
                    <td class="footer_total_amount_recovered text-right text-bold"></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
</div>
        </div>
    </div>
</div>
