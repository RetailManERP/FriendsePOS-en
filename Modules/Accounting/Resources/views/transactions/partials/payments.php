<div class="pos-tab-content">
    <div class="row">
        <?php $__env->startComponent('components.filters', ['title' => __('report.filters'), 'filterId' => 'payment_' . $id . '_filter']); ?>
            <div class="col-md-3">
                <div class="form-group">
                    <button class="btn btn-info btn-block remap_defaults_payment_btn" type="button" data-table-id="<?php echo e($id, false); ?>">Remap Defaults <i class="hide fas fa-sync fa-spin fa-fw"></i></button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('payment_filter_location_id',  __('purchase.business_location') . ':'); ?>

                    <?php echo Form::select('payment_filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('payment_filter_mapping_type_' . $id,  'Mapping Type:'); ?>

                    <?php echo Form::select('payment_filter_mapping_type_' . $id, ['mapped' => 'Mapped', 'unmapped' => 'Unmapped'], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all'), 'id' => 'payment_filter_mapping_type_' . $id]); ?>

                </div>
            </div>
            <?php if($id == 'contact_payment_table'): ?>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('payment_filter_contact_type_' . $id,  'Contact Type:'); ?>

                        <?php echo Form::select('payment_filter_contact_type_' . $id, ['customer' => 'Customers', 'supplier' => 'Suppliers', 'both' => 'Barterers'], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all'), 'id' => 'payment_filter_contact_type_' . $id]); ?>

                    </div>
                </div>
            <?php endif; ?>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('payment_filter_status',  __('lang_v1.payment_method') . ':'); ?>

                    <?php echo Form::select('payment_filter_status', [], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('payment_filter_date_range_' . $id, __('report.date_range') . ':'); ?>

                    <?php echo Form::text('payment_filter_date_range_' . $id, null, ['id' => 'payment_filter_date_range_' . $id, 'placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped table-th-skin" id="<?php echo e($id, false); ?>">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('messages.action'); ?></th>
                                <th><?php echo app('translator')->get('messages.date'); ?></th>
                                <th><?php echo app('translator')->get('account.payment_ref_no'); ?></th>
                                <th><?php echo app('translator')->get('account.invoice_ref_no'); ?></th>
                                <th><?php echo app('translator')->get('sale.amount'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                <th><?php echo app('translator')->get('lang_v1.payment_type'); ?></th>
                                <th><?php echo app('translator')->get( 'lang_v1.description' ); ?></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right text-bold"><?php echo app('translator')->get('lang_v1.total'); ?></td>
                                <td class="footer_amount text-right text-bold"></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
