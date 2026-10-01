<!-- Modal -->
<div class="modal-dialog" role="document">
    <div class="modal-content">
     <?php echo Form::open(['url' => action([\Modules\Superadmin\Http\Controllers\SuperadminSubscriptionsController::class, 'update'],$subscription->id), 'method' => 'PUT', 'id' => 'status_change_form']); ?>


      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo app('translator')->get( "superadmin::lang.subscription_status"); ?></h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
             <div class="form-group">
                <?php echo Form::label('status', __( "superadmin::lang.status")); ?>


                <?php echo Form::select('status', $status, $subscription->status, ['class' => 'form-control']); ?>

              </div>

              <div class="form-group">
                <?php echo Form::label('payment_transaction_id', __("superadmin::lang.payment_transaction_id")); ?>


                <?php echo Form::text('payment_transaction_id', $subscription->payment_transaction_id, ['class' => 'form-control']); ?>

              </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( "superadmin::lang.update"); ?></button>
        <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( "superadmin::lang.close"); ?></button>
      </div>
      <?php echo Form::close(); ?>

    </div>
</div>
