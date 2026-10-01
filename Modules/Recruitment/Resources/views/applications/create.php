<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\Modules\Recruitment\Http\Controllers\ApplicationController::class, 'store']), 'method' => 'POST', 'id' => 'add_application_form']); ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo app('translator')->get('recruitment::lang.add_application'); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('job_opening_id', __('recruitment::lang.job_opening') . ':*'); ?>

                        <?php echo Form::select('job_opening_id', ['' => __('messages.please_select')] + $job_openings, null, ['class' => 'form-control select2', 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('candidate_id', __('recruitment::lang.candidate') . ':*'); ?>

                        <?php echo Form::select('candidate_id', ['' => __('messages.please_select')] + $candidates, null, ['class' => 'form-control select2', 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('application_ref', __('recruitment::lang.application_ref') . ':'); ?>

                        <?php echo Form::text('application_ref', null, ['class' => 'form-control', 'placeholder' => __('recruitment::lang.auto_generated')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('applied_date', __('recruitment::lang.applied_date') . ':*'); ?>

                        <?php echo Form::text('applied_date', \Carbon::createFromTimestamp(strtotime(date('Y-m-d')))->format(session('business.date_format')), ['class' => 'form-control datepicker', 'required', 'readonly']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('assigned_to', __('recruitment::lang.assigned_to') . ':'); ?>

                        <?php echo Form::select('assigned_to', ['' => __('messages.please_select')] + $users, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('stage_notes', __('recruitment::lang.notes') . ':'); ?>

                        <?php echo Form::textarea('stage_notes', null, ['class' => 'form-control', 'rows' => 2]); ?>

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
