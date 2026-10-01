<div class="modal-dialog" role="document">
    <div class="modal-content">
  
      <?php echo Form::open(['id' => 'add_booking_room' ]); ?>

  
      <div class="modal-header">
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo app('translator')->get('messages.add'); ?> <?php echo app('translator')->get('hms::lang.rooms'); ?></h4>
      </div>
  
      <div class="modal-body">
        <div class="form-group">
            <?php echo Form::label('name', __('hms::lang.type') . '*'); ?>

            <?php echo Form::select('type', $types, '', [
                'class' => 'form-control',
                'required',
                'id' => 'type',
                'placeholder' => __('hms::lang.type'),
            ]); ?>

        </div>
       <div class="modify_field"> 
         <div class="form-group">
            <?php echo Form::label('no_of_adult', __('hms::lang.no_of_adult') . '*'); ?>

            <?php echo Form::select('no_of_adult', [], '', [
              'class' => 'form-control',
              'required',
              'id' => 'no_of_adult',
              'placeholder' => __('hms::lang.no_of_adult'),
            ]); ?>

          </div>
          <div class="form-group">
              <?php echo Form::label('no_of_child', __('hms::lang.no_of_child') . '*'); ?>

              <?php echo Form::select('no_of_child', [], '', [
                'class' => 'form-control',
                'required',
                'id' => 'no_of_child',
                'placeholder' => __('hms::lang.no_of_child'),
              ]); ?>

          </div>
          <div class="form-group">
            <?php echo Form::label('room_no', __('hms::lang.room_no') . '*'); ?>

            <?php echo Form::select('room_no', [], '', [
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
