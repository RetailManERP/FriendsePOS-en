<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\Modules\Recruitment\Http\Controllers\CandidateController::class, 'update'], [$candidate->id]), 'method' => 'PUT', 'id' => 'edit_candidate_form', 'files' => true]); ?>

        <?php echo Form::hidden('_method', 'PUT'); ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo app('translator')->get('recruitment::lang.edit_candidate'); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('first_name', __('business.first_name') . ':*'); ?>

                        <?php echo Form::text('first_name', $candidate->first_name, ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('last_name', __('business.last_name') . ':'); ?>

                        <?php echo Form::text('last_name', $candidate->last_name, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('email', __('business.email') . ':'); ?>

                        <?php echo Form::email('email', $candidate->email, ['class' => 'form-control']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('phone', __('contact.mobile') . ':'); ?>

                        <?php echo Form::text('phone', $candidate->phone, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('source', __('recruitment::lang.source') . ':'); ?>

                        <?php echo Form::select('source', ['' => __('messages.please_select')] + $sources, $candidate->source, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('experience_years', __('recruitment::lang.experience_years') . ':'); ?>

                        <?php echo Form::number('experience_years', $candidate->experience_years, ['class' => 'form-control', 'step' => '0.5', 'min' => 0]); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('expected_salary', __('recruitment::lang.expected_salary') . ':'); ?>

                        <?php echo Form::number('expected_salary', $candidate->expected_salary, ['class' => 'form-control', 'step' => '0.01']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('skills', __('recruitment::lang.skills') . ':'); ?>

                        <?php echo Form::text('skills', $candidate->skills, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('resume', __('recruitment::lang.resume') . ':'); ?>

                        <?php echo Form::file('resume', ['class' => 'form-control', 'accept' => '.pdf,.doc,.docx']); ?>

                        <?php if($candidate->resume_path): ?> <small class="text-muted"><?php echo app('translator')->get('recruitment::lang.current_file_exists'); ?></small> <?php endif; ?>
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

                        <?php echo Form::textarea('notes', $candidate->notes, ['class' => 'form-control', 'rows' => 2]); ?>

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
