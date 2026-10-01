<div class="pos-tab-content">
    <div class="row">
    <input type="hidden" id="business_location" value="">
        <?php $__env->startComponent('components.filters', ['title' => __('report.filters'), 'filterId' => 'openingBalanceFilter']); ?>
            <div class="col-md-3">
                <div class="form-group">
                    <button class="btn btn-info btn-block" id="remap_defaults_opening_balance" type="button">Remap Defaults <i class="hide fas fa-sync fa-spin fa-fw"></i></button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('opening_balance_filter_location_id',  __('purchase.business_location') . ':'); ?>

                    <?php echo Form::select('opening_balance_filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('opening_balance_filter_contact_type',  'Contact Type:'); ?>

                    <?php echo Form::select('opening_balance_filter_contact_type', ['customer' => 'Customers', 'supplier' => 'Suppliers', 'both' => 'Barterers'], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('opening_balance_filter_mapping_type',  'Mapping Type:'); ?>

                    <?php echo Form::select('opening_balance_filter_mapping_type', ['mapped' => 'Mapped', 'unmapped' => 'Unmapped'], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('opening_balance_filter_date_range', __('report.date_range') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        <?php echo Form::text('opening_balance_filter_date_range', null, ['class' =>
                        'form-control', 'readonly', 'id'=>'opening_balance_filter_date_range', 'placeholder' => __('report.date_range')]); ?>

                    </div>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>
    </div>

    <div class="row">
        <div class="col-md-12">
            

        <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="opening_balance_table">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('messages.action'); ?></th>
                    <th><?php echo app('translator')->get('messages.date'); ?></th>
                    <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                    <th><?php echo app('translator')->get('contact.contact_type'); ?></th>
                    <th><?php echo app('translator')->get('contact.name'); ?></th>
                    <th><?php echo app('translator')->get('sale.total_amount'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                    <th><?php echo app('translator')->get('purchase.location'); ?></th>
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
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
</div>
        </div>
    </div>
</div>
