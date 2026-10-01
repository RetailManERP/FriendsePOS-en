<div class="modal-dialog" role="document">
    <div class="modal-content">

        <?php echo Form::open([
            'url' => action([\Modules\Gym\Http\Controllers\AttendanceController::class, 'add_edit_in_time']),
            'method' => 'post',
            'id' => 'add_edit_in_time',
        ]); ?>


        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo app('translator')->get('gym::lang.in_time'); ?></h4>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="hidden" name="contact_id" value="<?php echo e($member->id, false); ?>">
                        <?php echo Form::label('in_time', __('gym::lang.in_time') . ':'); ?>

                        <?php echo Form::text('in_time', $attendance && $attendance->in_time ? \Carbon::createFromTimestamp(strtotime($attendance->in_time))->format('h:i A') : null, [
                            'class' => 'form-control time_picker',
                            'placeholder' => __('gym::lang.in_time'),
                            'readonly',
                            'required',
                            'id' => 'in_time',
                        ]); ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary tw-text-white"><?php echo app('translator')->get('messages.save'); ?></button>
            <button type="button" class="btn btn-neutral tw-text-white"
                data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>

        <?php echo Form::close(); ?>


    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
