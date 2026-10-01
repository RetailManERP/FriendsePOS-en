<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\Modules\Crm\Http\Controllers\ScheduleController::class, 'store']), 'method' => 'post', 'id' => 'add_schedule' ]); ?>

            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo app('translator')->get('crm::lang.add_schedule'); ?>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="schedule_for" value="<?php echo e($schedule_for, false); ?>" id="schedule_for">
                    <div class="col-md-8">
                       <div class="form-group">
                            <?php echo Form::label('title', __('crm::lang.title') . ':*' ); ?>

                            <?php echo Form::text('title', null, ['class' => 'form-control', 'required' ]); ?>

                       </div>
                    </div>
                    <div class="col-md-4">
                       <div class="form-group">
                            <?php echo Form::label('contact_id', __('contact.customer') . '/' . __('crm::lang.lead') .':*'); ?>

                            <?php echo Form::select('contact_id', $customers, $contact_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

                       </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                       <div class="form-group">
                            <?php echo Form::label('status', __('sale.status') .':'); ?>

                            <?php echo Form::select('status', $statuses, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;', 'id' => 'follow_up_create_status']); ?>

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
                            <?php echo Form::label('description', __('crm::lang.description') . ':'); ?>

                            <?php echo Form::textarea('description', null, ['class' => 'form-control ', 'id' => 'description']); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('schedule_type', __('crm::lang.schedule_type') .':*'); ?>

                            <?php echo Form::select('schedule_type', $follow_up_types, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('followup_category_id', __('crm::lang.followup_category') .':*'); ?>

                            <?php echo Form::select('followup_category_id', $followup_category, null, ['class' => 'form-control select2', 'required', 'style' => 'width: 100%;', 'placeholder' => __('messages.please_select')]); ?>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('user_id', __('crm::lang.assgined') .':*'); ?>

                            <?php echo Form::select('user_id[]', $users, null, ['class' => 'form-control select2', 'multiple', 'required', 'style' => 'width: 100%;']); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-check-label">
<?php echo Form::checkbox('allow_notification', 1, false, ['class' => 'form-check-input', 'id' => 'allow_notification']); ?>

                                <?php echo app('translator')->get('crm::lang.send_notification'); ?>
                            </label>
                            <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('crm::lang.send_schedule_notificatoion') . '"></i>';
                }
            ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="allow_notification_elements hide">
                        <div class="col-md-6">
                            <?php echo Form::label('notify_via', __('crm::lang.notify_via') .':*'); ?> 
                            <div class="form-group checkbox-inline">
                                <label class="form-check-label">
<?php echo Form::checkbox('notify_via[sms]', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('crm::lang.sms'); ?>
                                </label>
                            </div>
                            <div class="form-group checkbox-inline">
                                <label class="form-check-label">
<?php echo Form::checkbox('notify_via[mail]', 1, true, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('business.email'); ?>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="multi-input">
                                    <?php echo Form::label('notify_before', __('crm::lang.notify_before') . ':*'); ?>

                                    <br/>
                                    <?php echo Form::number('notify_before', null, ['class' => 'form-control width-40 float-start', 'placeholder' => __('crm::lang.notify_before'), 'required']); ?>


                                    <?php echo Form::select('notify_type', $notify_type, '', ['class' => 'form-control width-60 float-start']); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">
                    <?php echo app('translator')->get('messages.save'); ?>
                </button>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                <?php echo app('translator')->get('messages.close'); ?>
                </button>
            </div>
        <?php echo Form::close(); ?>

    </div>
</div>
