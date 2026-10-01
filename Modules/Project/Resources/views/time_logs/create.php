<div class="modal-dialog project-modal" role="document">
    <?php echo Form::open(['action' => '\Modules\Project\Http\Controllers\ProjectTimeLogController@store', 'id' => 'time_log_form', 'method' => 'post']); ?>

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">
                <?php echo app('translator')->get('project::lang.add_time_log'); ?>
            </h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <!-- added from(task/timelog) -->
                <?php echo Form::hidden('added_from', $added_from, ['class' => 'form-control']); ?>

                <?php echo Form::hidden('project_id', $project_id, ['class' => 'form-control']); ?>

                <?php if($added_from == 'task'): ?>
                    <?php echo Form::hidden('project_task_id', $task_id, ['class' => 'form-control']); ?>

                <?php else: ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('project_task_id', __('project::lang.task') .':'); ?>

                            <?php echo Form::select('project_task_id', $project_tasks, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;']); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('start_datetime', __('project::lang.start_date_time') . ':*' ); ?>

                        <?php echo Form::text('start_datetime', '', ['class' => 'form-control datetimepicker', 'readonly', 'required']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('end_datetime', __('project::lang.end_date_time') .':*'); ?>

                        <?php echo Form::text('end_datetime', '', ['class' => 'form-control datetimepicker', 'readonly', 'required']); ?>

                    </div>
                </div>
                <?php if($is_lead_or_admin): ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('user_id', __('role.user') .':*'); ?>

                            <?php echo Form::select('user_id', $project_members, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('note', __('brand.note') . ':'); ?>

                        <?php echo Form::textarea('note', null, ['class' => 'form-control ', 'id' => 'note', 'rows' => '4']); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-text-white">
                <?php echo app('translator')->get('messages.save'); ?>
            </button>
             <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white" data-dismiss="modal" data-bs-dismiss="modal">
                <?php echo app('translator')->get('messages.close'); ?>
            </button>
        </div>
    </div>
    <?php echo Form::close(); ?>

</div>
