<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <?php echo Form::open(['url' => action([\App\Http\Controllers\ProductController::class, 'postCreateAlternateSku']), 'method' => 'post', 'id' => 'add_alternate_sku_form' ]); ?>

  
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <h4 class="modal-title">Create your Own Package</h4>
      </div>
  
      <div class="modal-body">
		
	  </div>
  
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
        <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
      </div>
  
      <?php echo Form::close(); ?>

  
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
