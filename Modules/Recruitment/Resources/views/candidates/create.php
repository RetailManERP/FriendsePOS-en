<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\Modules\Recruitment\Http\Controllers\CandidateController::class, 'store']), 'method' => 'POST', 'id' => 'add_candidate_form', 'files' => true]); ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo app('translator')->get('recruitment::lang.add_candidate'); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('first_name', __('business.first_name') . ':*'); ?>

                        <?php echo Form::text('first_name', null, ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('last_name', __('business.last_name') . ':'); ?>

                        <?php echo Form::text('last_name', null, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('email', __('business.email') . ':'); ?>

                        <?php echo Form::email('email', null, ['class' => 'form-control']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('phone', __('contact.mobile') . ':'); ?>

                        <?php echo Form::text('phone', null, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('gender', __('lang_v1.gender') . ':'); ?>

                        <?php echo Form::select('gender', ['' => __('messages.please_select'), 'male' => __('lang_v1.male'), 'female' => __('lang_v1.female'), 'other' => __('lang_v1.other')], null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('date_of_birth', __('lang_v1.dob') . ':'); ?>

                        <?php echo Form::text('date_of_birth', null, ['class' => 'form-control datepicker', 'readonly']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('source', __('recruitment::lang.source') . ':'); ?>

                        <?php echo Form::select('source', ['' => __('messages.please_select')] + $sources, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('current_company', __('recruitment::lang.current_company') . ':'); ?>

                        <?php echo Form::text('current_company', null, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('current_designation', __('recruitment::lang.current_designation') . ':'); ?>

                        <?php echo Form::text('current_designation', null, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('experience_years', __('recruitment::lang.experience_years') . ':'); ?>

                        <?php echo Form::number('experience_years', null, ['class' => 'form-control', 'step' => '0.5', 'min' => 0]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('current_salary', __('recruitment::lang.current_salary') . ':'); ?>

                        <?php echo Form::number('current_salary', null, ['class' => 'form-control', 'step' => '0.01']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('expected_salary', __('recruitment::lang.expected_salary') . ':'); ?>

                        <?php echo Form::number('expected_salary', null, ['class' => 'form-control', 'step' => '0.01']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('highest_qualification', __('recruitment::lang.highest_qualification') . ':'); ?>

                        <?php echo Form::text('highest_qualification', null, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('referred_by', __('recruitment::lang.referred_by') . ':'); ?>

                        <?php echo Form::text('referred_by', null, ['class' => 'form-control']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('skills', __('recruitment::lang.skills') . ':'); ?>

                        <?php echo Form::text('skills', null, ['class' => 'form-control', 'placeholder' => __('recruitment::lang.skills_placeholder')]); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('resume', __('recruitment::lang.resume') . ':'); ?>

                        <?php echo Form::file('resume', ['class' => 'form-control', 'accept' => '.pdf,.doc,.docx']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('photo', __('recruitment::lang.photo') . ':'); ?>

                        <?php echo Form::file('photo', ['class' => 'form-control', 'accept' => '.jpg,.jpeg,.png']); ?>

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
