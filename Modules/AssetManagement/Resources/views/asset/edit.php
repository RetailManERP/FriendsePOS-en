<!-- Modal -->
<div class="modal-dialog modal-lg" role="document">
    <?php echo Form::open(['url' => action([\Modules\AssetManagement\Http\Controllers\AssetController::class, 'update'], [$asset->id]), 'method' => 'put', 'id' => 'asset_form', 'files' => true]); ?>

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">    <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">
                <?php echo app('translator')->get('assetmanagement::lang.edit_asset'); ?>
                <small><code>(<?php echo e($asset->asset_code, false); ?>)</code></small>
            </h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('location_id', __('business.business_location') . ':*' ); ?>

                        <?php echo Form::select('location_id', $business_locations, $asset->location_id, ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('name', __('assetmanagement::lang.asset_name') . ':*' ); ?>

                        <?php echo Form::text('name', $asset->name, ['class' => 'form-control', 'placeholder' => __('assetmanagement::lang.asset_name'), 'required']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('quantity', __('lang_v1.quantity') . ':*' ); ?>

                        <?php echo Form::text('quantity', !empty($asset->quantity) ? number_format($asset->quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']): null, ['class' => 'form-control input_number', 'placeholder' => __('lang_v1.quantity'), 'required', 'min' => 1]); ?>

                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('model', __('assetmanagement::lang.model_no') . ':' ); ?>

                        <?php echo Form::text('model', $asset->model, ['class' => 'form-control', 'placeholder' => __('assetmanagement::lang.model_no')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <?php echo Form::label('serial_no', __('assetmanagement::lang.serial_no') . ':' ); ?>

                    <?php echo Form::text('serial_no', $asset->serial_no, ['class' => 'form-control', 'placeholder' => __('assetmanagement::lang.serial_no')]); ?>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('category_id', __('assetmanagement::lang.asset_category') . ':' ); ?>

                        <?php echo Form::select('category_id', $asset_category, $asset->category_id, ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('purchase_date', __('purchase.purchase_date') . ':' ); ?>

                        <?php echo Form::text('purchase_date', !empty($asset->purchase_date) ? \Carbon::createFromTimestamp(strtotime($asset->purchase_date))->format(session('business.date_format')) : null, ['class' => 'form-control datepicker', 'placeholder' => __('purchase.purchase_date'), 'readonly']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <?php echo Form::label('purchase_type', __('assetmanagement::lang.purchase_type') . ':' ); ?>

                    <?php echo Form::select('purchase_type', $purchase_types, $asset->purchase_type, ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;']); ?>

                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('unit_price', __('sale.unit_price') . ':*' ); ?>

                        <?php echo Form::text('unit_price', !empty($asset->unit_price) ? number_format($asset->unit_price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : null, ['class' => 'form-control input_number', 'placeholder' => __('sale.unit_price'), 'required']); ?>

                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('depreciation', __('assetmanagement::lang.depreciation') . ':' ); ?>

                        <?php echo Form::text('depreciation', !empty($asset->depreciation) ? number_format($asset->depreciation, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : null, ['class' => 'form-control input_number', 'placeholder' => __('assetmanagement::lang.depreciation')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-group">
                            <?php echo Form::label('image', __('lang_v1.image') . ':'); ?>

                            <?php echo Form::file('image', ['id' => 'upload_asset_image', 'accept' => 'image/*']); ?>

                            <small>
                                <p class="help-block">
                                    <?php echo app('translator')->get('assetmanagement::lang.image_replace_help_text'); ?><br>
                                    <?php echo app('translator')->get('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)]); ?>
                                </p>
                            </small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
<input type="checkbox" name="is_allocatable" value="1" <?php if($asset->is_allocatable): ?> checked <?php endif; ?>>
                                <?php echo app('translator')->get('assetmanagement::lang.is_allocatable'); ?>
                            </label>
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
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12">
                    <?php echo Form::label('description', __('lang_v1.description') . ':'); ?>

                    <?php echo Form::textarea('description', $asset->description, ['class' => 'form-control', 'rows' => '3', 'placeholder' => __('lang_v1.description')]); ?>

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
                        <?php $__currentLoopData = $asset->warranties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warranty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php echo Form::text('edit_warranty[' . $warranty->id . '][start_date]', \Carbon::createFromTimestamp(strtotime($warranty->start_date))->format(session('business.date_format')), ['class' => 'form-control datepicker', 'placeholder' => __('business.start_date'), 'readonly' , 'required']); ?>

                            </td>
                            <td>
                                <?php echo Form::text('edit_warranty[' . $warranty->id . '][months]', number_format($warranty->months, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'placeholder' => __('assetmanagement::lang.warranty_months'), 'required']); ?>

                            </td>
                            <td>
                                <?php echo Form::text('edit_warranty[' . $warranty->id . '][additional_cost]', number_format($warranty->additional_cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'placeholder' => __('assetmanagement::lang.additional_cost')]); ?>

                            </td>
                            <td>
                                <?php echo Form::textarea('edit_warranty[' . $warranty->id . '][additional_note]', $warranty->additional_note, ['class' => 'form-control', 'placeholder' => __('purchase.additional_notes'), 'rows' => 3]); ?>

                            </td>
                            <td><button type="button" class="btn btn-sm btn-danger remove-warranty"><i class="fas fa-times"></i></button></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <?php echo app('translator')->get('messages.update'); ?>
            </button>
        </div>
    </div>
    <?php echo Form::close(); ?>

</div>
