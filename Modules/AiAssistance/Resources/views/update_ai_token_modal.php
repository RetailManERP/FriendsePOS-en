<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\Modules\Superadmin\Http\Controllers\SuperadminSubscriptionsController::class, 'postUpdateAiTokenLimit']), 'method' => 'post', 'id' => 'superadmin_add_subscription' ]); ?>


    <?php echo Form::hidden('business_id', $business_id); ?>

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><?php echo app('translator')->get( 'superadmin::lang.update_ai_tokens' ); ?></h4>
    </div>

    <div class="modal-body">
        <?php if($ai_enabled): ?>
        <div class="row">
            <div class="col-md-4 text-center">
                <h4>Current Token Limit <br><?php echo e($max_token ?? 0, false); ?></h4>
            </div>
            <div class="col-md-4 text-center">
                <h4>Used Tokens <br>
                <?php echo e($used_tokens ?? 0, false); ?> </h4>
            </div>
            <div class="col-md-4 text-center">
                <h4>Remaining Tokens <br>
                <?php echo e($remaining_tokens ?? 0, false); ?></h4> 
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo Form::label('new_limit', __( 'superadmin::lang.new_limit' ) . ':'); ?>

                    <?php echo Form::number('new_limit', $max_token, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-12 mt-5">
                <b>Example:</b><br> 
                Current Limit is 1000 and you want to add 500 more then enter new limit 1500</b>
            </div>
            <br>
        </div>
        <?php else: ?>
            Business Does not Have AiAssistance Module
        <?php endif; ?>

    </div>

    <div class="modal-footer">
        <?php if($ai_enabled): ?>
        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
        <?php endif; ?>
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->