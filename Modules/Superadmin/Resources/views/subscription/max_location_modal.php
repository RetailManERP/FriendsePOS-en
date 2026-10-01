<div class="modal-dialog modal-danger" role="document">
  <div class="modal-content">
  
    <div class="modal-header">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> <?php echo app('translator')->get('superadmin::lang.max_locations'); ?></h4>
    </div>

    <div class="modal-body">
      <?php echo app('translator')->get('superadmin::lang.max_locations'); ?>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-outline" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
