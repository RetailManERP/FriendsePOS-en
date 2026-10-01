<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\Modules\Superadmin\Http\Controllers\SuperadminSubscriptionsController::class, 'store']), 'method' => 'post', 'id' => 'superadmin_add_subscription' ]); ?>


    <?php echo Form::hidden('business_id', $business_id); ?>

    <div class="modal-header">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      <h4 class="modal-title"><?php echo app('translator')->get( 'superadmin::lang.add_subscription' ); ?></h4>
    </div>

    <div class="modal-body">
      <div class="form-group">
        <?php echo Form::label('package_id', __( 'superadmin::lang.subscription_packages' ) . ':*'); ?>

          <?php echo Form::select('package_id', $packages, null, ['class' => 'form-control select2', 'required', 'placeholder' => __( 'messages.please_select' ), 'style' => 'width: 100%;', 'data-minimum-results-for-search' => '0' ]); ?>

      </div>
      <div class="form-group">
        <?php echo Form::label('paid_via', __( 'superadmin::lang.paid_via' ) . ':*'); ?>

          <?php echo Form::select('paid_via', $gateways, null, ['class' => 'form-control select2', 'required', 'placeholder' => __( 'messages.please_select' ), 'style' => 'width: 100%;', 'data-minimum-results-for-search' => '0' ]); ?>

      </div>
      <div class="form-group">
        <?php echo Form::label('payment_transaction_id', __( 'superadmin::lang.payment_transaction_id' ) . ':'); ?>

          <?php echo Form::text('payment_transaction_id', null, ['class' => 'form-control', 'placeholder' => __( 'superadmin::lang.payment_transaction_id' ) ]); ?>

      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
