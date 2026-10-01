<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\Modules\Accounting\Http\Controllers\CoaController::class, 'update'], $account->id), 
        'method' => 'put', 'id' => 'create_client_form' ]); ?>


    <div class="modal-header">
      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><?php echo app('translator')->get( 'accounting::lang.edit_account' ); ?></h4>
    </div>

    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo Form::label('account_primary_type', __( 'accounting::lang.account_type' ) . ':*'); ?>

                    <select class="form-control" name="account_primary_type" id="account_primary_type" required>
                        <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                        <?php $__currentLoopData = $account_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account_type => $account_details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($account_type, false); ?>"
                            <?php if($account->account_primary_type == $account_type): ?> selected <?php endif; ?>
                            ><?php echo e(__('accounting::lang.' .$account_type), false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <?php echo Form::label('account_sub_type', __( 'accounting::lang.account_sub_type' ) . ':*'); ?>

                    <select class="form-control" name="account_sub_type_id" id="account_sub_type" required>
                        <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                        <?php $__currentLoopData = $account_sub_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($account_type->id, false); ?>" 
                            data-show_balance="<?php echo e($account_type->show_balance, false); ?>"
                             <?php if($account->account_sub_type_id == $account_type->id): ?> selected <?php endif; ?>>
                            <?php echo e($account_type->account_type_name, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <?php echo Form::label('detail_type', __( 'accounting::lang.detail_type' ) . ':'); ?>


                    <select class="form-control" name="detail_type_id" id="detail_type">
                        <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                        <?php $__currentLoopData = $account_detail_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($detail_type->id, false); ?>" 
                            <?php if($account->detail_type_id == $detail_type->id): ?> selected <?php endif; ?> >
                            <?php echo e($detail_type->account_type_name, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <p class="help-block" id="detail_type_desc"><?php echo e($account->detail_type->account_type_description ?? '', false); ?></p>
                </div>
                <div class="form-group">
                    <?php echo Form::label('name', __( 'user.name' ) . ':*'); ?>

                    <?php echo Form::text('name', $account->name, ['class' => 'form-control', 'required', 'placeholder' => __( 'user.name' ) ]); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('account_number', __( 'accounting::lang.account_number' ) . ':'); ?>

                    <?php echo Form::text('account_number', $account->account_number ?? null, ['class' => 'form-control', 'placeholder' => __( 'accounting::lang.account_number_placeholder' ) ]); ?>

                    <p class="help-block"><?php echo app('translator')->get( 'accounting::lang.account_number_help' ); ?></p>
                </div>
                <div class="form-group">
                    <?php echo Form::label('gl_code', __( 'accounting::lang.gl_code' ) . ':'); ?>

                    <?php echo Form::text('gl_code', $account->gl_code, ['class' => 'form-control', 'placeholder' => __( 'accounting::lang.gl_code' ) ]); ?>

                    <p class="help-block"><?php echo app('translator')->get( 'accounting::lang.gl_code_help' ); ?></p>
                </div>
                <div class="form-group">
                    <?php echo Form::label('parent_account', __( 'accounting::lang.parent_account' ) . ':'); ?>

                    <select class="form-control" name="parent_account_id" id="parent_account">
                        <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                        <?php $__currentLoopData = $parent_accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent_account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($parent_account->id, false); ?>" 
                            <?php if($account->parent_account_id == $parent_account->id): ?> selected <?php endif; ?> >
                            <?php echo e($parent_account->name, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
<?php echo Form::checkbox('is_cash_flow_account', 1, $account->is_cash_flow_account, [ 'class' =>
                            'form-check-input', 'id' => 'is_cash_flow_account']); ?> <b><?php echo e(__( 'lang_v1.is_cash_flow_account' ), false); ?></b>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
<?php echo Form::checkbox('is_non_posting', 1, $account->is_non_posting, [ 'class' =>
                            'form-check-input', 'id' => 'is_non_posting']); ?> <b><?php echo e(__( 'lang_v1.is_non_posting' ), false); ?></b>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo Form::label('description', __( 'lang_v1.description' ) . ':'); ?>

                    <?php echo Form::textarea('description', $account->description, ['class' => 'form-control', 
                        'placeholder' => __( 'lang_v1.description' ), 'rows' => 3 ]); ?>

                </div>
            </div>
        </div>

        
        <div class="row bank-details-section" <?php if(empty($account->bank_name)): ?> style="display:none;" <?php endif; ?>>
            <div class="col-md-12">
                <h5 class="text-primary"><i class="fas fa-university"></i> <?php echo app('translator')->get('accounting::lang.bank_details'); ?></h5>
                <hr>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('bank_name', __( 'accounting::lang.bank_name' ) . ':'); ?>

                    <?php echo Form::text('bank_name', $account->bank_name ?? null, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('account_holder_name', __( 'accounting::lang.account_holder_name' ) . ':'); ?>

                    <?php echo Form::text('account_holder_name', $account->account_holder_name ?? null, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('bank_account_number', __( 'accounting::lang.bank_account_number' ) . ':'); ?>

                    <?php echo Form::text('bank_account_number', $account->bank_account_number ?? null, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('bank_branch', __( 'accounting::lang.bank_branch' ) . ':'); ?>

                    <?php echo Form::text('bank_branch', $account->bank_branch ?? null, ['class' => 'form-control']); ?>

                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
