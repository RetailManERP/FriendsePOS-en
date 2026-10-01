
<?php $__env->startSection('title', __('clinic::lang.edit_appointment')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 >
            <i class="fas fa-calendar-check me-2"></i><?php echo app('translator')->get('clinic::lang.edit_appointment'); ?> - <?php echo e($appointment->appointment_ref, false); ?>

        </h1>
    </section>

    <section class="content">
        <?php echo Form::open(['action' => ['\Modules\Clinic\Http\Controllers\AppointmentController@update', $appointment->id], 'method' => 'put', 'id' => 'appointment_form']); ?>


        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.appointment_details')]); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('patient_id', __('clinic::lang.select_patient') . ':*'); ?>

                        <?php echo Form::select('patient_id', $patients, $appointment->patient_id, ['class' => 'form-control select2', 'required', 'placeholder' => __('clinic::lang.select_one')]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('doctor_id', __('clinic::lang.select_doctor') . ':*'); ?>

                        <?php echo Form::select('doctor_id', $doctors, $appointment->doctor_id, ['class' => 'form-control select2', 'required', 'placeholder' => __('clinic::lang.select_one')]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('start_datetime', __('clinic::lang.start_datetime') . ':*'); ?>

                        <?php echo Form::datetimeLocal('start_datetime', $appointment->start_datetime, ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('end_datetime', __('clinic::lang.end_datetime') . ':'); ?>

                        <?php echo Form::datetimeLocal('end_datetime', $appointment->end_datetime, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('appointment_type', __('clinic::lang.appointment_type') . ':*'); ?>

                        <?php echo Form::select('appointment_type', ['new_visit' => __('clinic::lang.new_visit'), 'follow_up' => __('clinic::lang.follow_up'), 'emergency' => __('clinic::lang.emergency'), 'telemedicine' => __('clinic::lang.telemedicine')], $appointment->appointment_type, ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('status', __('clinic::lang.status') . ':*'); ?>

                        <?php echo Form::select('status', ['scheduled' => __('clinic::lang.scheduled'), 'confirmed' => __('clinic::lang.confirmed'), 'checked_in' => __('clinic::lang.checked_in'), 'in_progress' => __('clinic::lang.in_progress'), 'completed' => __('clinic::lang.completed'), 'cancelled' => __('clinic::lang.cancelled'), 'no_show' => __('clinic::lang.no_show'), 'rescheduled' => __('clinic::lang.rescheduled')], $appointment->status, ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('priority', __('clinic::lang.priority') . ':'); ?>

                        <?php echo Form::select('priority', ['normal' => __('clinic::lang.normal'), 'urgent' => __('clinic::lang.urgent'), 'emergency' => __('clinic::lang.emergency')], $appointment->priority, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <?php echo Form::label('notes', __('clinic::lang.notes') . ':'); ?>

                        <?php echo Form::textarea('notes', $appointment->notes, ['class' => 'form-control', 'rows' => 2]); ?>

                    </div>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i><?php echo app('translator')->get('messages.update'); ?>
                </button>
                <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\AppointmentController::class, 'index']), false); ?>"
                   class="btn btn-default">
                    <?php echo app('translator')->get('clinic::lang.back'); ?>
                </a>
            </div>
        </div>

        <?php echo Form::close(); ?>

    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>