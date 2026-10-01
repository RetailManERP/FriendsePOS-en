<div class="modal-dialog modal-danger" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> <?php echo app('translator')->get('superadmin::lang.subscription_expired'); ?></h4>
    </div>

    <div class="modal-body">
      <?php echo app('translator')->get('superadmin::lang.subscription_expired_modal_content', 
      ['app_name' => env('APP_NAME')]); ?>
    </div>

    <div class="modal-footer">
      <a href="<?php echo e(url('/superadmin/subscription'), false); ?>" class="btn btn-outline btn-default"><i class="fa fa-refresh"></i> <?php echo app('translator')->get( 'superadmin::lang.subscribe'); ?></a>
      <button type="button" class="btn btn-outline" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
