<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\Modules\Recruitment\Http\Controllers\JobOpeningController::class, 'store']), 'method' => 'POST', 'id' => 'add_job_form']); ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo app('translator')->get('recruitment::lang.add_job_opening'); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('title', __('recruitment::lang.job_title') . ':*'); ?>

                        <?php echo Form::text('title', null, ['class' => 'form-control', 'required', 'placeholder' => __('recruitment::lang.job_title_placeholder')]); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('reference_no', __('recruitment::lang.reference_no') . ':'); ?>

                        <?php echo Form::text('reference_no', null, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('num_positions', __('recruitment::lang.num_positions') . ':*'); ?>

                        <?php echo Form::number('num_positions', 1, ['class' => 'form-control', 'required', 'min' => 1]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('location_id', __('recruitment::lang.location') . ':'); ?>

                        <?php echo Form::select('location_id', ['' => __('messages.please_select')] + $locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('department_id', __('recruitment::lang.department') . ':'); ?>

                        <?php echo Form::select('department_id', ['' => __('messages.please_select')] + $departments, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('designation_id', __('recruitment::lang.designation') . ':'); ?>

                        <?php echo Form::select('designation_id', ['' => __('messages.please_select')] + $designations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('employment_type', __('recruitment::lang.employment_type') . ':*'); ?>

                        <?php echo Form::select('employment_type', $employment_types, 'full_time', ['class' => 'form-control select2', 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('hiring_manager_id', __('recruitment::lang.hiring_manager') . ':'); ?>

                        <?php echo Form::select('hiring_manager_id', ['' => __('messages.please_select')] + $users, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('status', __('sale.status') . ':*'); ?>

                        <?php echo Form::select('status', $statuses, 'draft', ['class' => 'form-control select2', 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('salary_min', __('recruitment::lang.salary_min') . ':'); ?>

                        <?php echo Form::number('salary_min', null, ['class' => 'form-control', 'step' => '0.01']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('salary_max', __('recruitment::lang.salary_max') . ':'); ?>

                        <?php echo Form::number('salary_max', null, ['class' => 'form-control', 'step' => '0.01']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('opening_date', __('recruitment::lang.opening_date') . ':'); ?>

                        <?php echo Form::text('opening_date', null, ['class' => 'form-control datepicker', 'readonly']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('closing_date', __('recruitment::lang.closing_date') . ':'); ?>

                        <?php echo Form::text('closing_date', null, ['class' => 'form-control datepicker', 'readonly']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('description', __('recruitment::lang.job_description') . ':'); ?>

                        <?php echo Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('recruitment::lang.job_description_placeholder')]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('requirements', __('recruitment::lang.requirements') . ':'); ?>

                        <?php echo Form::textarea('requirements', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('recruitment::lang.requirements_placeholder')]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('benefits', __('recruitment::lang.benefits') . ':'); ?>

                        <?php echo Form::textarea('benefits', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('recruitment::lang.benefits_placeholder')]); ?>

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
