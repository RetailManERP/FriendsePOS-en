<div class="modal-dialog" role="document">
    <?php echo Form::open(['action' => '\Modules\AssetManagement\Http\Controllers\RevokeAllocatedAssetController@store', 'id' => 'revoke_asset_form', 'method' => 'post']); ?>

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <?php echo app('translator')->get('assetmanagement::lang.revoke_asset', ['allocation_code' => $allocated_asset->ref_no]); ?>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <input type="hidden" name="parent_id" value="<?php echo e($allocated_asset->id, false); ?>">
                        <input type="hidden" name="asset_id" value="<?php echo e($allocated_asset->asset_id, false); ?>">
                        <div class="form-group">
                            <?php echo Form::label('ref_no', __('assetmanagement::lang.revoke_code') . ':' ); ?>

                            <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.leave_empty_to_autogenerate') . '"></i>';
                }
            ?>
                            <?php echo Form::text('ref_no', null, ['class' => 'form-control', 'placeholder' => __('assetmanagement::lang.revoke_code')]); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <?php if(!empty($allocated_asset->quantity)): ?>
                            <?php
                                $max_qty = $allocated_asset->quantity - $total_revoked_asset;
                            ?>
                        <?php endif; ?>
                        <div class="form-group">
                            <?php echo Form::label('quantity', __('lang_v1.quantity') . ':*' ); ?>

                            <?php echo Form::text('quantity', null, ['class' => 'form-control input_number', 'placeholder' => __('lang_v1.quantity'), 'required', 'min' => 1, 'max' => (int)$max_qty]); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('transaction_datetime', __('assetmanagement::lang.revoked_at') . ':*' ); ?>

                            <?php echo Form::text('transaction_datetime', null, ['class' => 'form-control datetimepicker', 'placeholder' => __('assetmanagement::lang.revoked_at'), 'readonly', 'required']); ?>

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
        </div><!-- /.modal-content -->
    <?php echo Form::close(); ?>

</div><!-- /.modal-dialog -->
