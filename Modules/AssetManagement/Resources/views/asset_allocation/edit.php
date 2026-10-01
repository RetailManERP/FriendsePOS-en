<div class="modal-dialog" role="document">
    <?php echo Form::open(['url' => action([\Modules\AssetManagement\Http\Controllers\AssetAllocationController::class, 'update'], [$asset_allocated->id]), 'method' => 'put', 'id' => 'asset_allocation_form']); ?>

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <?php echo app('translator')->get('assetmanagement::lang.edit'); ?>
                    <code>(<?php echo e($asset_allocated->ref_no, false); ?>)</code>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('asset_id', __('assetmanagement::lang.asset') . ':*' ); ?>

                            <?php echo Form::select('asset_id', $assets['assets'], $asset_allocated->asset_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;', 'disabled'], $assets['asset_quantity']); ?>

                        </div>
                        <input type="hidden" name="asset_id" value="<?php echo e($asset_allocated->asset_id, false); ?>">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('receiver', __('assetmanagement::lang.allocate_to') . ':*' ); ?>

                            <?php echo Form::select('receiver', $users, $asset_allocated->receiver, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php if(!empty($asset_allocated->revokeTransaction)): ?>
                        <?php
                            $revoked_quantities = $asset_allocated->revokeTransaction->pluck('quantity')->toArray();
                            $total_rq = 0;
                            foreach ($revoked_quantities as $key => $quantity) {
                                $total_rq += (int)$quantity;
                            }

                            $current_allocated_qty = $asset_allocated->quantity - $total_rq;
                            $max_qty = $current_allocated_qty + $total_available_asset;
                        ?>                    
                    <?php endif; ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('quantity', __('lang_v1.quantity') . ':*' ); ?>

                            <?php echo Form::text('quantity', !empty($asset_allocated->quantity) ? number_format($asset_allocated->quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']): null, ['class' => 'form-control input_number', 'placeholder' => __('lang_v1.quantity'), 'required', 'min' => 1, 'max' => (int)$max_qty]); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('transaction_datetime', __('assetmanagement::lang.allocate_from') . ':*' ); ?>

                            <?php echo Form::text('transaction_datetime', !empty($asset_allocated->transaction_datetime) ? \Carbon::createFromTimestamp(strtotime($asset_allocated->transaction_datetime))->format(session('business.date_format') . ' ' . 'h:i A') : null, ['class' => 'form-control datetimepicker', 'placeholder' => __('assetmanagement::lang.allocate_from'), 'readonly', 'required']); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('allocated_upto', __('assetmanagement::lang.allocated_upto') . ':' ); ?>

                            <?php echo Form::text('allocated_upto', !empty($asset_allocated->allocated_upto) ? \Carbon::createFromTimestamp(strtotime($asset_allocated->allocated_upto))->format(session('business.date_format')) : null, ['class' => 'form-control datepicker', 'placeholder' => __('assetmanagement::lang.allocated_upto'), 'readonly']); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('reason', __('assetmanagement::lang.reason') . ':'); ?>

                            <?php echo Form::textarea('reason', $asset_allocated->reason, ['class' => 'form-control', 'rows' => '3', 'placeholder' => __('assetmanagement::lang.reason')]); ?>

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
    <?php echo Form::close(); ?> <!-- /form close -->
</div><!-- /.modal-dialog -->
