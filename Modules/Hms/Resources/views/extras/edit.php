<div class="modal-dialog" role="document">
    <div class="modal-content">
  
      <?php echo Form::open(['url' => action([\Modules\Hms\Http\Controllers\ExtraController::class, 'update'], ['extra'=> $extra->id]), 'method' => 'put', 'id' => 'add_extra' ]); ?>

  
      <div class="modal-header">
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo app('translator')->get( 'hms::lang.edit_extra' ); ?></h4>
      </div>
  
      <div class="modal-body">
        <div class="form-group">
            <?php echo Form::label('name', __('hms::lang.name') . '*'); ?>

            <?php echo Form::text('name', $extra->name, [
                'class' => 'form-control',
                'required',
                'placeholder' => __('hms::lang.name'),
            ]); ?>

        </div>
        <div class="form-group">
            <?php echo Form::label('price', __('hms::lang.price') . '*'); ?>

            <?php echo Form::number('price', $extra->price, [
                'class' => 'form-control',
                'required',
                'step' => '0.01',
                'placeholder' => __('hms::lang.price'),
            ]); ?>

        </div>
        <div class="form-group">
            <?php echo Form::label('price_per', __('hms::lang.per') . '*'); ?>

            <?php echo Form::select('price_per', $price_per,$extra->price_per , [
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
