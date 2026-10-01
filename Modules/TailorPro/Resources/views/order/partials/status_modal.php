<div class="modal-dialog" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\Modules\TailorPro\Http\Controllers\OrderController::class, 'updateStatus'], [$order->id]), 'method' => 'put', 'id' => 'update_status_form']); ?>

        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">
                <?php echo app('translator')->get('tailorpro::lang.update_status'); ?> - <?php echo e($order->order_no, false); ?>

            </h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <?php echo Form::label('status_id', __('sale.status') . ':*'); ?>

                <?php echo Form::select('status_id', $statuses['statuses'], $order->status_id, [
                    'class' => 'form-control select2',
                    'required',
                    'id' => 'status_id_modal',
                    'style' => 'width:100%;'
                ]); ?>

            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> <?php echo app('translator')->get('messages.update'); ?>
            </button>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>
