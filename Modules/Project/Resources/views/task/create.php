<div class="modal-dialog modal-lg project-modal" role="document">
    <?php echo Form::open(['action' => '\Modules\Project\Http\Controllers\TaskController@store', 'id' => 'project_task_form', 'method' => 'post']); ?>

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        <h4 class="modal-title">
            <?php echo app('translator')->get('project::lang.create_task'); ?>
        </h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                   <div class="form-group">
                        <?php echo Form::label('subject', __('project::lang.subject') . ':*' ); ?>

                        <?php echo Form::text('subject', null, ['class' => 'form-control', 'required' ]); ?>

                   </div>
                </div>
            </div>
            <?php echo Form::hidden('project_id', $project_id, ['class' => 'form-control']); ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('description', __('lang_v1.description') . ':'); ?>

                        <?php echo Form::textarea('description', null, ['class' => 'form-control ', 'id' => 'description']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                   <div class="form-group">
                        <?php echo Form::label('start_date', __('business.start_date') . ':' ); ?>

                        <?php echo Form::text('start_date', '', ['class' => 'form-control datepicker', 'readonly']); ?>

                   </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('due_date', __('project::lang.due_date') .':'); ?>

                        <?php echo Form::text('due_date', '', ['class' => 'form-control datepicker', 'readonly']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('priority', __('project::lang.priority') .':*'); ?>

                        <?php echo Form::select('priority', $priorities, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('status', __('sale.status') .':*'); ?>

                        <?php echo Form::select('status', $statuses, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('user_id', __('project::lang.members') .':*'); ?>

                       <?php echo Form::select('user_id[]', $project_members, null, ['class' => 'form-control select2', 'multiple', 'required', 'style' => 'width: 100%;']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('custom_field_1', ($task_custom_field_labels['custom_field_1'] ?? __('project::lang.task_custom_field_1')) . ':' ); ?>

                        <?php echo Form::text('custom_field_1', null, ['class' => 'form-control']); ?>

                   </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('custom_field_2', ($task_custom_field_labels['custom_field_2'] ?? __('project::lang.task_custom_field_2')) . ':' ); ?>

                        <?php echo Form::text('custom_field_2', null, ['class' => 'form-control']); ?>

                   </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('custom_field_3', ($task_custom_field_labels['custom_field_3'] ?? __('project::lang.task_custom_field_3')) . ':' ); ?>

                        <?php echo Form::text('custom_field_3', null, ['class' => 'form-control']); ?>

                   </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('custom_field_4', ($task_custom_field_labels['custom_field_4'] ?? __('project::lang.task_custom_field_4')) . ':' ); ?>

                        <?php echo Form::text('custom_field_4', null, ['class' => 'form-control']); ?>

                   </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-text-white ladda-button" data-style="expand-right">
                <span class="ladda-label"><?php echo app('translator')->get('messages.save'); ?></span>
            </button>

             <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white" data-dismiss="modal" data-bs-dismiss="modal">
                <?php echo app('translator')->get('messages.close'); ?>
            </button>
        </div>
    </div>
    <?php echo Form::close(); ?>

</div>
