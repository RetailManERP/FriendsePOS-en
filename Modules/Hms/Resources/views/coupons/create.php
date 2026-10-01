<div class="modal-dialog" role="document">
    <div class="modal-content">
  
      <?php echo Form::open(['url' => action([\Modules\Hms\Http\Controllers\HmsCouponController::class, 'store']), 'method' => 'post', 'id' => 'add_coupon' ]); ?>

  
      <div class="modal-header">
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo app('translator')->get( 'hms::lang.add_coupon' ); ?></h4>
      </div>
  
      <div class="modal-body">
        <div class="form-group">
            <?php echo Form::label('hms_room_type_id', __('hms::lang.type') . '*'); ?>

            <?php echo Form::select('hms_room_type_id', $types, '', [
                'class' => 'form-control',
                'required',
                'placeholder' => __('hms::lang.type'),
            ]); ?>

        </div>
        <div class="form-group">
            <?php echo Form::label('date_from', __('hms::lang.date_from') . '*'); ?>

            <?php echo Form::text('start_date', null, [
                'class' => 'form-control date_picker',
                'required',
                'readonly',
            ]); ?>

        </div>
        <div class="form-group">
            <?php echo Form::label('date_to', __('hms::lang.date_to') . '*'); ?>

            <?php echo Form::text('end_date', null, [
                'class' => 'form-control date_picker',
                'required',
                'readonly',
            ]); ?>

        </div>
        <div class="form-group">
            <?php echo Form::label('coupon_code', __('hms::lang.coupon_code') . '*'); ?>

            <?php echo Form::text('coupon_code', null, [
                'class' => 'form-control',
                'required',
            ]); ?>

        </div>
        <div class="form-group">
            <?php echo Form::label('discount', __('hms::lang.discount') . '*'); ?>

            <?php echo Form::number('discount', null, [
                'class' => 'form-control',
                'required',
                'step' => '0.01',
            ]); ?>

        </div>
        <div class="form-group">
            <?php echo Form::label('discount_type', __('hms::lang.discount_type'). '*'); ?>

            <?php echo Form::select('discount_type', $discount_type, '', [
                'class' => 'form-control',
                'required',
            ]); ?>

        </div>
      </div>
  
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
      </div>
  
      <?php echo Form::close(); ?>

  
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
