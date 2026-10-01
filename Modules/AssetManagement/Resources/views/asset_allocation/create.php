<div class="modal-dialog" role="document">
    <?php echo Form::open(['action' => '\Modules\AssetManagement\Http\Controllers\AssetAllocationController@store', 'id' => 'asset_allocation_form', 'method' => 'post']); ?>

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <?php echo app('translator')->get('assetmanagement::lang.asset_allocation'); ?>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('ref_no', __('assetmanagement::lang.allocation_code') . ':' ); ?>

                            <?php echo Form::text('ref_no', null, ['class' => 'form-control', 'placeholder' => __('assetmanagement::lang.allocation_code')]); ?>

                            <p class="help-block">
                                <?php echo app('translator')->get('lang_v1.leave_empty_to_autogenerate'); ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('asset_id', __('assetmanagement::lang.asset') . ':*' ); ?>

                            <?php echo Form::select('asset_id', $assets['assets'], $asset_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;'], $assets['asset_quantity']); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('receiver', __('assetmanagement::lang.allocate_to') . ':*' ); ?>

                            <?php echo Form::select('receiver', $users, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('quantity', __('lang_v1.quantity') . ':*' ); ?>

                            <?php echo Form::text('quantity', null, ['class' => 'form-control input_number', 'placeholder' => __('lang_v1.quantity'), 'required', 'min' => 1]); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('transaction_datetime', __('assetmanagement::lang.allocate_from') . ':*' ); ?>

                            <?php echo Form::text('transaction_datetime', null, ['class' => 'form-control datetimepicker', 'placeholder' => __('assetmanagement::lang.allocate_from'), 'readonly', 'required']); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('allocated_upto', __('assetmanagement::lang.allocated_upto') . ':' ); ?>

                            <?php echo Form::text('allocated_upto', null, ['class' => 'form-control datepicker', 'placeholder' => __('assetmanagement::lang.allocated_upto'), 'readonly']); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('reason', __('assetmanagement::lang.reason') . ':'); ?>

                            <?php echo Form::textarea('reason', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => __('assetmanagement::lang.reason')]); ?>

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
    <?php echo Form::close(); ?> <!-- /form close -->
</div><!-- /.modal-dialog -->
