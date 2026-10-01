
<?php $__env->startSection('title', __('clinic::lang.add_appointment')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 >
            <i class="fas fa-calendar-plus me-2"></i><?php echo app('translator')->get('clinic::lang.add_appointment'); ?>
        </h1>
    </section>

    <section class="content">
        <?php echo Form::open(['action' => '\Modules\Clinic\Http\Controllers\AppointmentController@store', 'method' => 'post', 'id' => 'appointment_form']); ?>


        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.appointment_details')]); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('patient_id', __('clinic::lang.select_patient') . ':*'); ?>

                        <?php echo Form::select('patient_id', $patients, request('patient_id'), ['class' => 'form-control select2', 'required', 'placeholder' => __('clinic::lang.select_one')]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('doctor_id', __('clinic::lang.select_doctor') . ':*'); ?>

                        <?php echo Form::select('doctor_id', $doctors, null, ['class' => 'form-control select2', 'required', 'placeholder' => __('clinic::lang.select_one')]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('appointment_start', __('clinic::lang.start_datetime') . ':*'); ?>

                        <?php echo Form::datetimeLocal('appointment_start', null, ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('appointment_end', __('clinic::lang.end_datetime') . ':'); ?>

                        <?php echo Form::datetimeLocal('appointment_end', null, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('type', __('clinic::lang.appointment_type') . ':*'); ?>

                        <?php echo Form::select('type', ['consultation' => __('clinic::lang.consultation'), 'follow_up' => __('clinic::lang.follow_up'), 'emergency' => __('clinic::lang.emergency'), 'telemedicine' => __('clinic::lang.telemedicine')], 'consultation', ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('priority', __('clinic::lang.priority') . ':'); ?>

                        <?php echo Form::select('priority', ['normal' => __('clinic::lang.normal'), 'urgent' => __('clinic::lang.urgent'), 'emergency' => __('clinic::lang.emergency')], 'normal', ['class' => 'form-control']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="form-check mt-4">
                            <?php echo Form::checkbox('is_walk_in', 1, false, ['class' => 'form-check-input', 'id' => 'is_walk_in']); ?>

                            <?php echo Form::label('is_walk_in', __('clinic::lang.walk_in'), ['class' => 'form-check-label']); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <?php echo Form::label('notes', __('clinic::lang.notes') . ':'); ?>

                        <?php echo Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 2, 'placeholder' => __('clinic::lang.notes')]); ?>

                    </div>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        <?php echo Form::close(); ?>

    </section>

    
    <div id="appointment-footer-actions-template" class="d-none">
        <div>
            <button type="button" class="btn btn-primary" id="appointment_save_btn">
                <i class="fas fa-save me-2"></i><?php echo app('translator')->get('messages.save'); ?>
            </button>
            <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\AppointmentController::class, 'index']), false); ?>"
               class="btn btn-default">
                <?php echo app('translator')->get('clinic::lang.back'); ?>
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>