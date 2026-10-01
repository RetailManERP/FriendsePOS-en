<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\Modules\Recruitment\Http\Controllers\OnboardingController::class, 'update'], [$onboarding->id]), 'method' => 'PUT', 'id' => 'edit_onboarding_form']); ?>

        <?php echo Form::hidden('_method', 'PUT'); ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo app('translator')->get('recruitment::lang.edit_onboarding'); ?> - <?php echo e($onboarding->candidate->full_name ?? '', false); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('joining_date', __('recruitment::lang.joining_date') . ':*'); ?>

                        <?php echo Form::text('joining_date', \Carbon::createFromTimestamp(strtotime($onboarding->joining_date))->format(session('business.date_format')), ['class' => 'form-control datepicker', 'required', 'readonly']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('status', __('recruitment::lang.status') . ':'); ?>

                        <?php echo Form::select('status', $statuses, $onboarding->status, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('assigned_buddy', __('recruitment::lang.assigned_buddy') . ':'); ?>

                        <?php echo Form::select('assigned_buddy', ['' => __('messages.please_select')] + $users, $onboarding->assigned_buddy, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

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
                            <?php echo Form::checkbox('document_verification', 1, $onboarding->document_verification); ?>

                            <?php echo app('translator')->get('recruitment::lang.document_verification'); ?>
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('equipment_assigned', 1, $onboarding->equipment_assigned); ?>

                            <?php echo app('translator')->get('recruitment::lang.equipment_assigned'); ?>
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('access_provided', 1, $onboarding->access_provided); ?>

                            <?php echo app('translator')->get('recruitment::lang.access_provided'); ?>
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('training_scheduled', 1, $onboarding->training_scheduled); ?>

                            <?php echo app('translator')->get('recruitment::lang.training_scheduled'); ?>
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('policy_acknowledged', 1, $onboarding->policy_acknowledged); ?>

                            <?php echo app('translator')->get('recruitment::lang.policy_acknowledged'); ?>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('checklist_notes', __('recruitment::lang.checklist_notes') . ':'); ?>

                        <?php echo Form::textarea('checklist_notes', $onboarding->checklist_notes, ['class' => 'form-control', 'rows' => 2]); ?>

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
