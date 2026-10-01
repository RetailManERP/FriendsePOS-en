<div class="modal-dialog" role="document">
  <div class="modal-content">
    <?php echo Form::open(['url' => action([\Modules\Essentials\Http\Controllers\DocumentShareController::class, 'update'], [$id]), 'id' => 'share_document_form', 'method' => 'put']); ?>

    <div class="modal-header">
      <h4 class="modal-title text-center" id="exampleModalLabel">
        <?php if(!empty($type)): ?>
          <?php echo app('translator')->get('essentials::lang.share_memos'); ?>
        <?php else: ?>
          <?php echo app('translator')->get('essentials::lang.share_document'); ?>
        <?php endif; ?>
      </h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      
        <input type="hidden" name="document_id" id="document_id" value="<?php echo e($id, false); ?>">
        <div class="form-group">
            <?php echo Form::label('user', __('essentials::lang.user').':'); ?> <br>
            <?php echo Form::select('user[]', $users, $shared_user, ['class' => 'form-control select2', 'multiple' => 'multiple', 'style'=>"width: 50%; height:50%"]); ?>

        </div>
        <div class="form-group">
            <?php echo Form::label('role', __('essentials::lang.role').':'); ?> <br>
            <?php echo Form::select('role[]', $roles, $shared_role, ['class' => 'form-control select2', 'multiple' => 'multiple', 'style'=>"width: 50%; height:50%"]); ?>

        </div>

    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary float-end ladda-button doc-share-btn" data-style="expand-right">
          <span class="ladda-label"><?php echo app('translator')->get('messages.update'); ?></span>
      </button>
    </div>
  </div>
  <?php echo Form::close(); ?>

</div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    __select2($('.select2'));
  })
</script>
