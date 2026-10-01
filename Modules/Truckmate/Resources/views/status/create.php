<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\Modules\Truckmate\Http\Controllers\TruckmateStatusController::class, 'store']), 'method' => 'post', 'id' => 'status_form']); ?>


    <div class="modal-header">
      <button type="button" class="close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><?php echo app('translator')->get( 'truckmate::lang.add_status' ); ?></h4>
    </div>

    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <?php echo Form::label('name', __( 'truckmate::lang.status_name' ) . ':*'); ?>

                  <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'truckmate::lang.status_name' ) ]); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('color', __( 'truckmate::lang.color' ) . ':'); ?>

                    <?php echo Form::text('color', null, ['class' => 'form-control', 'placeholder' => __( 'truckmate::lang.color' ) ]); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('sort_order', __( 'truckmate::lang.sort_order' ) . ':'); ?>

                    <?php echo Form::number('sort_order', null, ['class' => 'form-control', 'placeholder' => __( 'truckmate::lang.sort_order' ) ]); ?>

                </div>
            </div>
            <div class="col-md-6 mt-15">
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="is_completed_status" value="1" id="is_completed_status"> <?php echo app('translator')->get('truckmate::lang.mark_this_status_as_complete'); ?>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 hide">
                <div class="form-group">
                    <?php echo Form::label('sms_template', __( 'truckmate::lang.sms_template' ) . ':'); ?>

                    <?php echo Form::textarea('sms_template', null, ['class' => 'form-control', 'placeholder' => __( 'truckmate::lang.sms_template' ), 'rows' => 4, 'id' => 'sms_template']); ?>

                </div>
            </div>
            <div class="col-md-12 hide">
                <div class="form-group">
                    <?php echo Form::label('email_subject', __( 'lang_v1.email_subject' ) . ':'); ?>

                    <?php echo Form::text('email_subject', null, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.email_subject' ), 'id' => 'email_subject']); ?>

                </div>
            </div>
            <div class="col-md-12 hide">
                <div class="form-group">
                    <?php echo Form::label('email_body', __( 'lang_v1.email_body' ) . ':'); ?>

                    <?php echo Form::textarea('email_body', null, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.email_body' ), 'rows' => 5, 'id' => 'email_body']); ?>

                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-default" data-bs-dismiss="modal" data-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
