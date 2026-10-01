<div class="modal-dialog" role="document">
    <div class="modal-content">
  
      <?php echo Form::open(['id' => 'edit_booking_room' ]); ?>

  
      <div class="modal-header">
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"> <?php echo app('translator')->get('hms::lang.edit_room'); ?></h4>
      </div>
  
      <div class="modal-body">
        <div class="form-group">
            <?php echo Form::label('name', __('hms::lang.type') . '*'); ?>

            <?php echo Form::select('type', $types, $type->id, [
                'class' => 'form-control',
                'required',
                'id' => 'type',
                'disabled' => true,
                'placeholder' => __('hms::lang.type'),
            ]); ?>

        </div>
       <div class="modify_field"> 
        <div class="form-group">
            <?php echo Form::label('no_of_adult', __('hms::lang.no_of_adult') . '*'); ?>

            <select class="form-control" id="no_of_adult" required name="no_of_child">
                <?php for($i = 1; $i <= $type->no_of_adult; $i++): ?>
                    <option <?php echo e($i == $no_of_adult ? 'selected' : '', false); ?> value="<?php echo e($i, false); ?>"><?php echo e($i, false); ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="form-group">
            <?php echo Form::label('no_of_child', __('hms::lang.no_of_child') . '*'); ?>

            <select class="form-control" id="no_of_child" required name="no_of_child">
                <?php for($i = 0; $i <= $type->no_of_child; $i++): ?>
                    <option <?php echo e($i == $no_of_child ? 'selected' : '', false); ?> value="<?php echo e($i, false); ?>"><?php echo e($i, false); ?></option>
                <?php endfor; ?>
            </select>
        </div>
          <div class="form-group">
            <?php echo Form::label('room_no', __('hms::lang.room_no') . '*'); ?>

            <?php echo Form::select('room_no', $rooms , $room_id , [
                'class' => 'form-control',
                'required',
                'id' => 'room_no',
                'placeholder' => __('hms::lang.room_no'),
            ]); ?>

          </div>
       </div>
      </div>
  
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
      </div>
  
      <?php echo Form::close(); ?>

  
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
