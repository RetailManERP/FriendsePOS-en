<div class="modal-dialog" role="document">
    <?php echo Form::open(['url' => action([\Modules\AssetManagement\Http\Controllers\AssetMaitenanceController::class, 'update'], [$maintenance->id]), 'method' => 'put', 'id' => 'asset_maintenance_form', 'files' => true]); ?>

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <?php echo app('translator')->get('assetmanagement::lang.asset_maintenance'); ?> - #<?php echo e($maintenance->maitenance_id, false); ?>

                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('status', __('sale.status') . ':' ); ?>

                            <?php echo Form::select('status', $statuses, $maintenance->status, ['class' => 'form-control', 'placeholder' => __('messages.please_select')]); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('priority', __('lang_v1.priority') . ':' ); ?>

                            <?php echo Form::select('priority', $priorities, $maintenance->priority, ['class' => 'form-control', 'placeholder' => __('messages.please_select')]); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php if(in_array('upload_documents', $enabled_modules)): ?>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php echo Form::label('attachments', __('assetmanagement::lang.attachments') . ':'); ?>

                            <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
                            <?php echo Form::file('attachments[]', ['id' => 'attachments', 'multiple', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); ?>

                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('assigned_to', __('lang_v1.assigned_to') . ':' ); ?>

                            <?php echo Form::select('assigned_to', $users, $maintenance->assigned_to, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $__env->make('sell.partials.media_table', ['medias' => $maintenance->media, 'delete' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('maintenance_note', __('assetmanagement::lang.maintenance_note') . ':' ); ?>

                            <?php echo Form::textarea('maintenance_note', $maintenance->maintenance_note, ['class' => 'form-control', 'placeholder' => __('assetmanagement::lang.maintenance_note'), 'rows' => 3, 'readonly']); ?>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('details', __('assetmanagement::lang.send_for_maintenance_details') . ':' ); ?>

                            <?php echo Form::textarea('details', $maintenance->details, ['class' => 'form-control', 'placeholder' => __('assetmanagement::lang.send_for_maintenance_details'), 'rows' => 3]); ?>

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
        </div><!-- /.modal-content -->
    <?php echo Form::close(); ?>

</div><!-- /.modal-dialog -->
