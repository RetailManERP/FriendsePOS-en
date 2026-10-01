<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\Modules\Crm\Http\Controllers\ScheduleLogController::class, 'store']), 'method' => 'post', 'id' => 'schedule_log_form' ]); ?>

            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo app('translator')->get('crm::lang.add_schedule_log'); ?>
                </h4>
            </div>
            <div class="modal-body">
                <!-- schedule id -->
                <input type="hidden" name="schedule_id" value="<?php echo e($schedule->id, false); ?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('subject', __('crm::lang.subject') . ':*'); ?>

                            <?php echo Form::text('subject', null, ['class' => 'form-control', 'required']); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('log_type', __('crm::lang.log_type') .':*'); ?>

                            <?php echo Form::select('log_type', ['call' => __('crm::lang.call'), 'sms' => __('crm::lang.sms'), 'meeting' => __('crm::lang.meeting'), 'email' => __('business.email')], $schedule->schedule_type, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                       <div class="form-group">
                            <?php echo Form::label('start_datetime', __('crm::lang.start_datetime') . ':*' ); ?>

                            <?php echo Form::text('start_datetime', null, ['class' => 'form-control datetimepicker', 'required', 'readonly']); ?>

                       </div>
                    </div>
                    <div class="col-md-4">
                       <div class="form-group">
                            <?php echo Form::label('end_datetime', __('crm::lang.end_datetime') . ':*' ); ?>

                            <?php echo Form::text('end_datetime', null, ['class' => 'form-control datetimepicker', 'required', 'readonly']); ?>

                       </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('description', __('lang_v1.description') . ':'); ?>

                            <?php echo Form::textarea('description', null, ['class' => 'form-control ', 'id' => 'description']); ?>

                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                       <div class="form-group">
                            <?php echo Form::label('status', __('crm::lang.schedule_status') .':'); ?>

                            <?php echo Form::select('status', $statuses, $schedule->status, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;']); ?>

                       </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                <?php echo app('translator')->get('messages.close'); ?>
                </button>
                <button type="submit" class="btn btn-primary">
                    <?php echo app('translator')->get('messages.save'); ?>
                </button>
            </div>
        <?php echo Form::close(); ?>

    </div>
</div>
