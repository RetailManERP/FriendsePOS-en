<div class="modal-dialog" role="document">
    <div class="modal-content">

        <?php echo Form::open([
            'url' => action([\Modules\Gym\Http\Controllers\ClassController::class, 'store']),
            'method' => 'post',
            'id' => 'add_class',
        ]); ?>


        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo app('translator')->get('gym::lang.classes'); ?></h4>
        </div>

        <div class="modal-body">
            <div class="form-group">
                <?php echo Form::label('name', __('gym::lang.name') . '*'); ?>

                <?php echo Form::text('name', null, [
                    'class' => 'form-control',
                    'required',
                    'placeholder' => __('gym::lang.name'),
                ]); ?>

            </div>
            <div class="form-group">
                <?php echo Form::label('start_time', __('gym::lang.start_time')); ?>

                <?php echo Form::text('start_time', null, [
                    'class' => 'form-control time_picker',
                    'readonly',
                ]); ?>

            </div>
            <div class="form-group">
                <?php echo Form::label('end_time', __('gym::lang.end_time')); ?>

                <?php echo Form::text('end_time', null, [
                    'class' => 'form-control time_picker',
                    'readonly',
                ]); ?>

            </div>
            <div class="form-group">
                <?php echo Form::label('description', __('gym::lang.description')); ?>

                <?php echo Form::textarea('description', null, [
                    'class' => 'form-control',
                    'placeholder' => __('gym::lang.description'),
                    'rows' => 3,
                ]); ?>

            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary tw-text-white"><?php echo app('translator')->get('messages.save'); ?></button>
            <button type="button" class="btn btn-default tw-text-white"
                data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>

        <?php echo Form::close(); ?>


    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
