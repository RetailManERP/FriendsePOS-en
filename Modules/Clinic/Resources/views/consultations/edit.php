
<?php $__env->startSection('title', __('clinic::lang.continue_consultation')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1>
            <i class="fas fa-stethoscope me-2"></i><?php echo app('translator')->get('clinic::lang.continue_consultation'); ?> - <?php echo e($consultation->consultation_ref, false); ?>

        </h1>
    </section>

    <section class="content">
        <?php echo Form::open(['action' => ['\Modules\Clinic\Http\Controllers\ConsultationController@update', $consultation->id], 'method' => 'put', 'id' => 'consultation_form']); ?>


        <?php
            $vitals = $consultation->vitals->first();
        ?>

        
        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.consultation_details')]); ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('patient_id', __('clinic::lang.patient') . ':'); ?>

                        <p class="form-control-plaintext"><strong><?php echo e($consultation->patient->first_name ?? '', false); ?> <?php echo e($consultation->patient->last_name ?? '', false); ?></strong></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('doctor_id', __('clinic::lang.doctor') . ':'); ?>

                        <p class="form-control-plaintext"><strong>Dr. <?php echo e($consultation->doctor->first_name ?? '', false); ?> <?php echo e($consultation->doctor->last_name ?? '', false); ?></strong></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('status', __('clinic::lang.status') . ':*'); ?>

                        <?php echo Form::select('status', [
                            'in_progress' => __('clinic::lang.in_progress'),
                            'completed' => __('clinic::lang.completed'),
                            'cancelled' => __('clinic::lang.cancelled'),
                        ], $consultation->status, ['class' => 'form-control']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('chief_complaint', __('clinic::lang.chief_complaint') . ':*'); ?>

                        <?php echo Form::textarea('chief_complaint', $consultation->chief_complaint, ['class' => 'form-control', 'rows' => 2, 'required']); ?>

                    </div>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        
        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.vitals')]); ?>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <?php echo Form::label('vitals[temperature]', __('clinic::lang.temperature') . ':'); ?>

                        <?php echo Form::number('vitals[temperature]', $vitals->temperature ?? null, ['class' => 'form-control', 'step' => '0.1', 'placeholder' => '36.5']); ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <?php echo Form::label('vitals[blood_pressure_systolic]', __('clinic::lang.blood_pressure_systolic') . ':'); ?>

                        <?php echo Form::number('vitals[blood_pressure_systolic]', $vitals->blood_pressure_systolic ?? null, ['class' => 'form-control', 'placeholder' => '120']); ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <?php echo Form::label('vitals[blood_pressure_diastolic]', __('clinic::lang.blood_pressure_diastolic') . ':'); ?>

                        <?php echo Form::number('vitals[blood_pressure_diastolic]', $vitals->blood_pressure_diastolic ?? null, ['class' => 'form-control', 'placeholder' => '80']); ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <?php echo Form::label('vitals[pulse_rate]', __('clinic::lang.pulse_rate') . ':'); ?>

                        <?php echo Form::number('vitals[pulse_rate]', $vitals->pulse_rate ?? null, ['class' => 'form-control', 'placeholder' => '72']); ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <?php echo Form::label('vitals[respiratory_rate]', __('clinic::lang.respiratory_rate') . ':'); ?>

                        <?php echo Form::number('vitals[respiratory_rate]', $vitals->respiratory_rate ?? null, ['class' => 'form-control', 'placeholder' => '16']); ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <?php echo Form::label('vitals[oxygen_saturation]', __('clinic::lang.oxygen_saturation') . ':'); ?>

                        <?php echo Form::number('vitals[oxygen_saturation]', $vitals->oxygen_saturation ?? null, ['class' => 'form-control', 'step' => '0.1', 'placeholder' => '98']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('vitals[weight]', __('clinic::lang.weight') . ':'); ?>

                        <?php echo Form::number('vitals[weight]', $vitals->weight ?? null, ['class' => 'form-control', 'step' => '0.1', 'placeholder' => '70']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('vitals[height]', __('clinic::lang.height') . ':'); ?>

                        <?php echo Form::number('vitals[height]', $vitals->height ?? null, ['class' => 'form-control', 'step' => '0.1', 'placeholder' => '170']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('vitals[blood_sugar]', __('clinic::lang.blood_sugar') . ':'); ?>

                        <?php echo Form::number('vitals[blood_sugar]', $vitals->blood_sugar ?? null, ['class' => 'form-control', 'step' => '0.1', 'placeholder' => '100']); ?>

                    </div>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        
        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.soap_notes')]); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('history_of_present_illness', __('clinic::lang.history_of_illness') . ':'); ?>

                        <?php echo Form::textarea('history_of_present_illness', $consultation->history_of_present_illness, ['class' => 'form-control', 'rows' => 3]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('physical_examination', __('clinic::lang.examination_findings') . ':'); ?>

                        <?php echo Form::textarea('physical_examination', $consultation->physical_examination, ['class' => 'form-control', 'rows' => 3]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('assessment', __('clinic::lang.assessment') . ':'); ?>

                        <?php echo Form::textarea('assessment', $consultation->assessment, ['class' => 'form-control', 'rows' => 3]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('plan', __('clinic::lang.treatment_plan') . ':'); ?>

                        <?php echo Form::textarea('plan', $consultation->plan, ['class' => 'form-control', 'rows' => 3]); ?>

                    </div>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        
        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.follow_up')]); ?>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('follow_up_date', __('clinic::lang.follow_up_date') . ':'); ?>

                        <?php echo Form::date('follow_up_date', $consultation->follow_up_date, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('consultation_fee', __('clinic::lang.consultation_fee') . ':'); ?>

                        <?php echo Form::number('consultation_fee', $consultation->consultation_fee, ['class' => 'form-control', 'step' => '0.01', 'min' => '0']); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('follow_up_instructions', __('clinic::lang.follow_up_notes') . ':'); ?>

                        <?php echo Form::textarea('follow_up_instructions', $consultation->follow_up_instructions, ['class' => 'form-control', 'rows' => 2]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('clinical_notes', __('clinic::lang.clinical_notes') . ':'); ?>

                        <?php echo Form::textarea('clinical_notes', $consultation->clinical_notes, ['class' => 'form-control', 'rows' => 2]); ?>

                    </div>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        <?php echo Form::close(); ?>


        
        <div id="consultation-footer-actions-template" class="d-none">
            <div>
                <button type="button" class="btn btn-primary" id="consultation_save_btn">
                    <i class="fas fa-save"></i> <?php echo app('translator')->get('messages.update'); ?>
                </button>
                <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\ConsultationController::class, 'index']), false); ?>"
                   class="btn btn-default" id="consultation_back_btn">
                    <i class="fas fa-arrow-left"></i> <?php echo app('translator')->get('clinic::lang.back'); ?>
                </a>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>