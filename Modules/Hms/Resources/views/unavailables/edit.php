<div class="modal-dialog" role="document">
    <div class="modal-content">
  
      <?php echo Form::open(['url' => action([\Modules\Hms\Http\Controllers\UnavailableController::class, 'update'], [$unavailable->id]), 'method' => 'put', 'id' => 'edit_unavailable' ]); ?>

  
      <div class="modal-header">
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo app('translator')->get( 'hms::lang.edit_unavailable' ); ?></h4>
      </div>
  
      <div class="modal-body">
        <div class="form-group">
          <?php echo Form::label('room_id', __('hms::lang.rooms'). '*'); ?> <br>
          <?php echo Form::select('room_id', $rooms, $unavailable->hms_rooms_id, [
              'class' => 'form-control select2',
              'required',
              'style' => 'width:100%'
          ]); ?>

        </div>

        <div class="form-group">
            <?php echo Form::label('date_from', __('hms::lang.date_from') . '*'); ?>

            <?php echo Form::text('date_from', !empty($unavailable->date_from) ? \Carbon::createFromTimestamp(strtotime($unavailable->date_from))->format(session('business.date_format')) : null, [
                'class' => 'form-control',
                'required',
                'readonly',
            ]); ?>

        </div>
        <div class="form-group">
            <?php echo Form::label('date_to', __('hms::lang.date_to') . '*'); ?>

            <?php echo Form::text('date_to', !empty($unavailable->date_to) ? \Carbon::createFromTimestamp(strtotime($unavailable->date_to))->format(session('business.date_format')) : null, [
                'class' => 'form-control datepicker',
                'required',
                'readonly',
            ]); ?>

        </div>
        <div class="form-group">
          <?php echo Form::label('unavailable_type', __('hms::lang.unavailable_type'). '*'); ?> <br>
          <?php echo Form::select('unavailable_type', $types, $unavailable->unavailable_type, [
              'class' => 'form-control',
              'required',
              'placeholder' => __('hms::lang.unavailable_type')
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
