<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\Modules\Recruitment\Http\Controllers\JobOpeningController::class, 'update'], [$job->id]), 'method' => 'PUT', 'id' => 'edit_job_form']); ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo app('translator')->get('recruitment::lang.edit_job_opening'); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('title', __('recruitment::lang.job_title') . ':*'); ?>

                        <?php echo Form::text('title', $job->title, ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('reference_no', __('recruitment::lang.reference_no') . ':'); ?>

                        <?php echo Form::text('reference_no', $job->reference_no, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('num_positions', __('recruitment::lang.num_positions') . ':*'); ?>

                        <?php echo Form::number('num_positions', $job->num_positions, ['class' => 'form-control', 'required', 'min' => 1]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('location_id', __('recruitment::lang.location') . ':'); ?>

                        <?php echo Form::select('location_id', ['' => __('messages.please_select')] + $locations, $job->location_id, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('department_id', __('recruitment::lang.department') . ':'); ?>

                        <?php echo Form::select('department_id', ['' => __('messages.please_select')] + $departments, $job->department_id, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('designation_id', __('recruitment::lang.designation') . ':'); ?>

                        <?php echo Form::select('designation_id', ['' => __('messages.please_select')] + $designations, $job->designation_id, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('employment_type', __('recruitment::lang.employment_type') . ':*'); ?>

                        <?php echo Form::select('employment_type', $employment_types, $job->employment_type, ['class' => 'form-control select2', 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('hiring_manager_id', __('recruitment::lang.hiring_manager') . ':'); ?>

                        <?php echo Form::select('hiring_manager_id', ['' => __('messages.please_select')] + $users, $job->hiring_manager_id, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('status', __('sale.status') . ':*'); ?>

                        <?php echo Form::select('status', $statuses, $job->status, ['class' => 'form-control select2', 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('salary_min', __('recruitment::lang.salary_min') . ':'); ?>

                        <?php echo Form::number('salary_min', $job->salary_min, ['class' => 'form-control', 'step' => '0.01']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('salary_max', __('recruitment::lang.salary_max') . ':'); ?>

                        <?php echo Form::number('salary_max', $job->salary_max, ['class' => 'form-control', 'step' => '0.01']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('opening_date', __('recruitment::lang.opening_date') . ':'); ?>

                        <?php echo Form::text('opening_date', $job->opening_date ? $job->opening_date->format('m/d/Y') : null, ['class' => 'form-control datepicker', 'readonly']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('closing_date', __('recruitment::lang.closing_date') . ':'); ?>

                        <?php echo Form::text('closing_date', $job->closing_date ? $job->closing_date->format('m/d/Y') : null, ['class' => 'form-control datepicker', 'readonly']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('description', __('recruitment::lang.job_description') . ':'); ?>

                        <?php echo Form::textarea('description', $job->description, ['class' => 'form-control', 'rows' => 3]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('requirements', __('recruitment::lang.requirements') . ':'); ?>

                        <?php echo Form::textarea('requirements', $job->requirements, ['class' => 'form-control', 'rows' => 3]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('benefits', __('recruitment::lang.benefits') . ':'); ?>

                        <?php echo Form::textarea('benefits', $job->benefits, ['class' => 'form-control', 'rows' => 3]); ?>

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
