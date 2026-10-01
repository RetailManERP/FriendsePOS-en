<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\Modules\Recruitment\Http\Controllers\OnboardingController::class, 'store']), 'method' => 'POST', 'id' => 'add_onboarding_form']); ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo app('translator')->get('recruitment::lang.add_onboarding'); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('application_id', __('recruitment::lang.hired_candidate') . ':*'); ?>

                        <?php echo Form::select('application_id', ['' => __('messages.please_select')] + $applications, null, ['class' => 'form-control select2', 'required', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('joining_date', __('recruitment::lang.joining_date') . ':*'); ?>

                        <?php echo Form::text('joining_date', null, ['class' => 'form-control datepicker', 'required', 'readonly']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('assigned_buddy', __('recruitment::lang.assigned_buddy') . ':'); ?>

                        <?php echo Form::select('assigned_buddy', ['' => __('messages.please_select')] + $users, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4><?php echo app('translator')->get('recruitment::lang.onboarding_checklist'); ?></h4>
                </div>
                <div class="col-md-4">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('document_verification', 1, false); ?>

                            <?php echo app('translator')->get('recruitment::lang.document_verification'); ?>
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('equipment_assigned', 1, false); ?>

                            <?php echo app('translator')->get('recruitment::lang.equipment_assigned'); ?>
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('access_provided', 1, false); ?>

                            <?php echo app('translator')->get('recruitment::lang.access_provided'); ?>
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('training_scheduled', 1, false); ?>

                            <?php echo app('translator')->get('recruitment::lang.training_scheduled'); ?>
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('policy_acknowledged', 1, false); ?>

                            <?php echo app('translator')->get('recruitment::lang.policy_acknowledged'); ?>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('checklist_notes', __('recruitment::lang.checklist_notes') . ':'); ?>

                        <?php echo Form::textarea('checklist_notes', null, ['class' => 'form-control', 'rows' => 2]); ?>

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
