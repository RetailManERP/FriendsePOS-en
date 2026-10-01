<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title"><?php echo app('translator')->get('aiassistance::lang.use_ai'); ?></h4>
        </div>
        <form action="<?php echo e(action([\Modules\AiAssistance\Http\Controllers\AiAssistanceController::class, 'processPurchaseFile']), false); ?>" method="POST" enctype="multipart/form-data" id="ai_purchase_form">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('location_id', __('purchase.business_location').':*'); ?>

                            <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.purchase_location') . '"></i>';
                }
            ?>
                            <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('purchase_file', __('aiassistance::lang.upload_purchase_file') . ':*' ); ?>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-file"></i>
                                </span>
                                <input type="file" name="purchase_file" class="form-control" required accept=".jpg,.jpeg,.png,.pdf">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
                <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('aiassistance::lang.process'); ?></button>
            </div>
        </form>
    </div>
</div>