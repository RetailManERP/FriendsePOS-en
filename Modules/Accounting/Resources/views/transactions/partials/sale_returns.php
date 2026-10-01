<div class="pos-tab-content">
    <div class="row">
        <?php $__env->startComponent('components.filters', ['title' => __('report.filters'), 'filterId' => 'saleReturnsFilter']); ?>
            <div class="col-md-3">
                <div class="form-group">
                    <button class="btn btn-info btn-block" id="remap_defaults_sell_return" type="button">Remap Defaults <i class="hide fas fa-sync fa-spin fa-fw"></i></button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('sell_return_list_filter_location_id',  __('purchase.business_location') . ':'); ?>

                    <?php echo Form::select('sell_return_list_filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('sell_return_list_filter_customer_id',  __('sale.customer_name') . ':'); ?>

                    <?php echo Form::select('sell_return_list_filter_customer_id', [], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('sell_return_list_filter_mapping_type',  'Mapping Type:'); ?>

                    <?php echo Form::select('sell_return_list_filter_mapping_type', ['mapped' => 'Mapped', 'unmapped' => 'Unmapped'], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('sell_return_list_filter_payment_status',  __('purchase.payment_status') . ':'); ?>

                    <?php echo Form::select('sell_return_list_filter_payment_status', ['paid' => __('lang_v1.paid'), 'due' => __('lang_v1.due'), 'partial' => __('lang_v1.partial'), 'overdue' => __('lang_v1.overdue')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('sell_return_list_filter_date_range', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('sell_return_list_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="sell_return_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('messages.action'); ?></th>
                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                        <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                        <th><?php echo app('translator')->get('sale.customer_name'); ?></th>
                        <th><?php echo app('translator')->get('sale.location'); ?></th>
                        <th><?php echo app('translator')->get('sale.payment_status'); ?></th>
                        <th><?php echo app('translator')->get('purchase.grand_total'); ?></th>
                        <th><?php echo app('translator')->get('purchase.payment_due'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right text-bold"><?php echo app('translator')->get('lang_v1.total'); ?></td>
                        <td class="footer_final_total text-right text-bold"></td>
                        <td class="footer_total_remaining text-right text-bold"></td>
                        <td></td>
                    </tr>
                </tfoot>
                <tbody></tbody>
            </table>
</div>
        </div>
    </div>
</div>
