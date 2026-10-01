<div class="modal-dialog" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\Modules\Repair\Http\Controllers\DeviceModelController::class, 'update'], [$model->id]), 'method' => 'put', 'id' => 'device_model' ]); ?>

        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">
                <?php echo app('translator')->get('repair::lang.add_device_model'); ?>
            </h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                   <div class="form-group">
                        <?php echo Form::label('name', __('repair::lang.model_name') . ':*' ); ?>

                        <?php echo Form::text('name', $model->name, ['class' => 'form-control', 'required' ]); ?>

                   </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                   <div class="form-group">
                        <?php echo Form::label('brand_id', __('product.brand') .':'); ?>

                        <?php echo Form::select('brand_id', $brands, $model->brand_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;', 'id' => 'model_brand_id']); ?>

                   </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group">
                        <?php echo Form::label('device_id', __('repair::lang.device') .':'); ?>

                        <?php echo Form::select('device_id', $devices, $model->device_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;', 'id' => 'model_device_id']); ?>

                   </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('repair_checklist', __('repair::lang.repair_checklist') . ':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('repair::lang.repair_checklist_tooltip') . '"></i>';
                }
            ?>
                        <?php echo Form::textarea('repair_checklist', $model->repair_checklist, ['class' => 'form-control ', 'id' => 'repair_checklist', 'rows' => '3']); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">
                <?php echo app('translator')->get('messages.update'); ?>
            </button>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                <?php echo app('translator')->get('messages.close'); ?>
            </button>
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>
