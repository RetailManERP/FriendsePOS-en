<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\Modules\Accounting\Http\Controllers\AccountTypeController::class, 'update'], 
        $account_type->id), 'method' => 'put', 'id' => 'edit_account_type_form' ]); ?>

    <div class="modal-header">
      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><?php if($account_type->account_type=='sub_type'): ?> 
        <?php echo app('translator')->get('accounting::lang.edit_account_type'); ?> <?php else: ?> <?php echo app('translator')->get('accounting::lang.edit_detail_type'); ?> <?php endif; ?></h4>
    </div>

    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo Form::label('edit_name', __( 'user.name' ) . ':*'); ?>

                    <?php echo Form::text('name', $account_type->name, ['class' => 'form-control', 
                        'required', 'placeholder' => __( 'user.name' ), 'id' => 'edit_name' ]); ?>

                </div>
            </div>
        </div>
        <div class="row <?php if($account_type->account_type=='sub_type'): ?> hide <?php endif; ?>">
            <div class="col-md-12">
              <div class="form-group">
                <?php echo Form::label('edit_parent_id', __( 'accounting::lang.parent_type' ) . ':*'); ?>

                  <select class="form-control" style="width: 100%;" name="parent_id" id="edit_parent_id">
                   <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                     <?php $__currentLoopData = $account_sub_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $at): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <option value="<?php echo e($at->id, false); ?>" <?php if($at->id==$account_type->parent_id): ?> selected <?php endif; ?> >
                      <?php echo e($at->account_type_name, false); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
              </div>
            </div>
        </div>
        <div class="row <?php if($account_type->account_type=='sub_type'): ?> hide <?php endif; ?>"">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo Form::label('edit_description', __( 'lang_v1.description' ) . ':'); ?>

                    <?php echo Form::textarea('description', $account_type->description, ['class' => 'form-control', 
                        'placeholder' => __( 'lang_v1.description' ), 'rows' => 3, 'id' => 'edit_description' ]); ?>

                </div>
            </div>
        </div> 
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.update' ); ?></button>
      <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
