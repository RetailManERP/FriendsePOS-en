<div class="modal-dialog" role="document">
    <div class="modal-content">
  
      <?php echo Form::open(['url' => action([\Modules\Hms\Http\Controllers\UnavailableController::class, 'store']), 'method' => 'post', 'id' => 'add_unavailable' ]); ?>

  
      <div class="modal-header">
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo app('translator')->get( 'hms::lang.add_unavailable' ); ?></h4>
      </div>
  
      <div class="modal-body">
        <div class="form-group">
          <?php echo Form::label('rooms', __('hms::lang.rooms'). '*'); ?> <br>
          <?php echo Form::select('rooms[]', $rooms, '', [
              'class' => 'form-control select2',
              'required',
              'style' => 'width:100%',
              'multiple' => 'multiple',
          ]); ?>

        </div>

        <div class="form-group">
            <?php echo Form::label('date_from', __('hms::lang.date_from') . '*'); ?>

            <?php echo Form::text('date_from', null, [
                'class' => 'form-control',
                'readonly',
                'required',
            ]); ?>

        </div>
        <div class="form-group">
            <?php echo Form::label('date_to', __('hms::lang.date_to') . '*'); ?>

            <?php echo Form::text('date_to', null, [
                'class' => 'form-control datepicker',
                'required',
                'readonly',
            ]); ?>

        </div>
        <div class="form-group">
          <?php echo Form::label('unavailable_type', __('hms::lang.unavailable_type'). '*'); ?> <br>
          <?php echo Form::select('unavailable_type', $types, '', [
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
