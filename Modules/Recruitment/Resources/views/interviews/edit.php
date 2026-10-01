<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\Modules\Recruitment\Http\Controllers\InterviewController::class, 'update'], [$interview->id]), 'method' => 'PUT', 'id' => 'edit_interview_form']); ?>

        <?php echo Form::hidden('_method', 'PUT'); ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo app('translator')->get('recruitment::lang.edit_interview'); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('application_id', __('recruitment::lang.application') . ':*'); ?>

                        <?php echo Form::select('application_id', ['' => __('messages.please_select')] + $applications, $interview->application_id, ['class' => 'form-control select2', 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('interview_type', __('recruitment::lang.interview_type') . ':*'); ?>

                        <?php echo Form::select('interview_type', ['' => __('messages.please_select')] + $interview_types, $interview->interview_type, ['class' => 'form-control select2', 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('interview_date', __('recruitment::lang.interview_date') . ':*'); ?>

                        <?php echo Form::text('interview_date', \Carbon::createFromTimestamp(strtotime($interview->interview_date))->format(session('business.date_format')), ['class' => 'form-control datepicker', 'required', 'readonly']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('start_time', __('recruitment::lang.start_time') . ':'); ?>

                        <?php echo Form::text('start_time', $interview->start_time ? \Carbon\Carbon::parse($interview->start_time)->format('h:i A') : null, ['class' => 'form-control timepicker']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('end_time', __('recruitment::lang.end_time') . ':'); ?>

                        <?php echo Form::text('end_time', $interview->end_time ? \Carbon\Carbon::parse($interview->end_time)->format('h:i A') : null, ['class' => 'form-control timepicker']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('location', __('recruitment::lang.interview_location') . ':'); ?>

                        <?php echo Form::text('location', $interview->location, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('meeting_link', __('recruitment::lang.meeting_link') . ':'); ?>

                        <?php echo Form::url('meeting_link', $interview->meeting_link, ['class' => 'form-control']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('status', __('recruitment::lang.status') . ':'); ?>

                        <?php echo Form::select('status', $statuses, $interview->status, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('recommendation', __('recruitment::lang.recommendation') . ':'); ?>

                        <?php echo Form::select('recommendation', ['' => __('messages.please_select')] + $recommendations, $interview->recommendation, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('overall_rating', __('recruitment::lang.overall_rating') . ':'); ?>

                        <?php echo Form::select('overall_rating', ['' => __('messages.please_select'), '1' => '1 - Poor', '2' => '2 - Below Average', '3' => '3 - Average', '4' => '4 - Good', '5' => '5 - Excellent'], $interview->overall_rating, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <?php echo Form::label('interviewers', __('recruitment::lang.interviewers') . ':'); ?>

                        <?php echo Form::select('interviewers[]', $users, $interview->interviewers, ['class' => 'form-control select2', 'multiple', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('feedback', __('recruitment::lang.feedback') . ':'); ?>

                        <?php echo Form::textarea('feedback', $interview->feedback, ['class' => 'form-control', 'rows' => 2]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('notes', __('recruitment::lang.notes') . ':'); ?>

                        <?php echo Form::textarea('notes', $interview->notes, ['class' => 'form-control', 'rows' => 2]); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.update'); ?></button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>
