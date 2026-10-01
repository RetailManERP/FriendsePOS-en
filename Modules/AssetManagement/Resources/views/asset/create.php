<!-- Modal -->
<div class="modal-dialog modal-lg" role="document">
    <?php echo Form::open(['action' => '\Modules\AssetManagement\Http\Controllers\AssetController@store', 'id' => 'asset_form', 'method' => 'post', 'files' => true]); ?>

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">    <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">
                <?php echo app('translator')->get('assetmanagement::lang.add_asset'); ?>
            </h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <?php if(count($business_locations) == 1): ?>
                        <?php 
                            $default_location = current(array_keys($business_locations->toArray()));
                        ?>
                    <?php else: ?>
                        <?php
                            $default_location = null;
                        ?>
                    <?php endif; ?>
                    <div class="form-group">
                        <?php echo Form::label('location_id', __('business.business_location') . ':*' ); ?>

                        <?php echo Form::select('location_id', $business_locations, $default_location, ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('asset_code', __('assetmanagement::lang.asset_code') . ':' ); ?>

                        <?php echo Form::text('asset_code', null, ['class' => 'form-control', 'placeholder' => __('assetmanagement::lang.asset_code')]); ?>

                        <p class="help-block">
                            <?php echo app('translator')->get('lang_v1.leave_empty_to_autogenerate'); ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('name', __('assetmanagement::lang.asset_name') . ':*' ); ?>

                        <?php echo Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('assetmanagement::lang.asset_name'), 'required']); ?>

                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('quantity', __('lang_v1.quantity') . ':*' ); ?>

                        <?php echo Form::text('quantity', null, ['class' => 'form-control input_number', 'placeholder' => __('lang_v1.quantity'), 'required', 'min' => 1]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <?php echo Form::label('model', __('assetmanagement::lang.model_no') . ':' ); ?>

                    <?php echo Form::text('model', null, ['class' => 'form-control', 'placeholder' => __('assetmanagement::lang.model_no')]); ?>

                </div>
                <div class="col-md-4">
                    <?php echo Form::label('serial_no', __('assetmanagement::lang.serial_no') . ':' ); ?>

                    <?php echo Form::text('serial_no', null, ['class' => 'form-control', 'placeholder' => __('assetmanagement::lang.serial_no')]); ?>

                </div>
                <div class="clearfix"></div>
                <div class="col-md-4">
                    <?php echo Form::label('category_id', __('assetmanagement::lang.asset_category') . ':' ); ?>

                    <?php echo Form::select('category_id', $asset_category, null, ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('purchase_date', __('purchase.purchase_date') . ':' ); ?>

                        <?php echo Form::text('purchase_date', null, ['class' => 'form-control datepicker', 'placeholder' => __('purchase.purchase_date'), 'readonly']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <?php echo Form::label('purchase_type', __('assetmanagement::lang.purchase_type') . ':' ); ?>

                    <?php echo Form::select('purchase_type', $purchase_types, null, ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;']); ?>

                </div>
                <div class="clearfix"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('unit_price', __('sale.unit_price') . ':*' ); ?>

                        <?php echo Form::text('unit_price', null, ['class' => 'form-control input_number', 'placeholder' => __('sale.unit_price'), 'required']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('depreciation', __('assetmanagement::lang.depreciation') . ':' ); ?>

                        <?php echo Form::text('depreciation', null, ['class' => 'form-control input_number', 'placeholder' => __('assetmanagement::lang.depreciation')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-group">
                            <?php echo Form::label('image', __('lang_v1.image') . ':'); ?>

                            <?php echo Form::file('image', ['id' => 'upload_asset_image', 'accept' => 'image/*']); ?>

                            <small>
                                <p class="help-block">
                                    <?php echo app('translator')->get('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)]); ?>
                                </p>
                            </small>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
<input type="checkbox" name="is_allocatable" value="1">
                                <?php echo app('translator')->get('assetmanagement::lang.is_allocatable'); ?>

                                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('assetmanagement::lang.allocatable_tooltip') . '"></i>';
                }
            ?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('description', __('lang_v1.description') . ':'); ?>

                        <?php echo Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => __('lang_v1.description')]); ?>

                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <h4><?php echo app('translator')->get('lang_v1.warranties'); ?></h4>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-sm btn-primary float-end" id="add_more_warranty"><i class="fas fa-plus"></i> <?php echo app('translator')->get('assetmanagement::lang.add_more'); ?></button>
                </div>
                <div class="col-md-12">
                <div class="table-responsive">
<table class="table" id="asset_warranty_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('business.start_date'); ?></th>
                            <th><?php echo app('translator')->get('assetmanagement::lang.warranty_months'); ?></th>
                            <th><?php echo app('translator')->get('assetmanagement::lang.additional_cost'); ?></th>
                            <th><?php echo app('translator')->get('purchase.additional_notes'); ?></th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php echo Form::text('start_dates[]', null, ['class' => 'form-control datepicker', 'placeholder' => __('business.start_date'), 'readonly' ]); ?>

                            </td>
                            <td>
                                <?php echo Form::text('months[]', null, ['class' => 'form-control input_number', 'placeholder' => __('assetmanagement::lang.warranty_months')]); ?>

                            </td>
                            <td>
                                <?php echo Form::text('additional_cost[]', 0, ['class' => 'form-control input_number', 'placeholder' => __('assetmanagement::lang.additional_cost')]); ?>

                            </td>
                            <td>
                                <?php echo Form::textarea('additional_note[]', null, ['class' => 'form-control', 'placeholder' => __('purchase.additional_notes'), 'rows' => 3]); ?>

                            </td>
                            <td>&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
</div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <?php echo app('translator')->get('messages.close'); ?>
            </button>
            <button type="submit" class="btn btn-primary">
                <?php echo app('translator')->get('messages.save'); ?>
            </button>
        </div>
    </div>
    <?php echo Form::close(); ?>

</div>
