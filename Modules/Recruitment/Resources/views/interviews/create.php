<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\Modules\Recruitment\Http\Controllers\InterviewController::class, 'store']), 'method' => 'POST', 'id' => 'add_interview_form']); ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo app('translator')->get('recruitment::lang.schedule_interview'); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('application_id', __('recruitment::lang.application') . ':*'); ?>

                        <?php echo Form::select('application_id', ['' => __('messages.please_select')] + $applications, null, ['class' => 'form-control select2', 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('interview_type', __('recruitment::lang.interview_type') . ':*'); ?>

                        <?php echo Form::select('interview_type', ['' => __('messages.please_select')] + $interview_types, null, ['class' => 'form-control select2', 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('interview_date', __('recruitment::lang.interview_date') . ':*'); ?>

                        <?php echo Form::text('interview_date', null, ['class' => 'form-control datepicker', 'required', 'readonly']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('start_time', __('recruitment::lang.start_time') . ':'); ?>

                        <?php echo Form::text('start_time', null, ['class' => 'form-control timepicker']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('end_time', __('recruitment::lang.end_time') . ':'); ?>

                        <?php echo Form::text('end_time', null, ['class' => 'form-control timepicker']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('location', __('recruitment::lang.interview_location') . ':'); ?>

                        <?php echo Form::text('location', null, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('meeting_link', __('recruitment::lang.meeting_link') . ':'); ?>

                        <?php echo Form::url('meeting_link', null, ['class' => 'form-control', 'placeholder' => 'https://']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('interviewers', __('recruitment::lang.interviewers') . ':'); ?>

                        <?php echo Form::select('interviewers[]', $users, null, ['class' => 'form-control select2', 'multiple', 'style' => 'width:100%', 'id' => 'interviewers']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('notes', __('recruitment::lang.notes') . ':'); ?>

                        <?php echo Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 2]); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.save'); ?></button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>
