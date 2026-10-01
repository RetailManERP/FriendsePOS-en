
<?php $__env->startSection('title', __('clinic::lang.add_consultation')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 >
            <i class="fas fa-stethoscope me-2"></i><?php echo app('translator')->get('clinic::lang.add_consultation'); ?>
        </h1>
    </section>

    <section class="content">
        <?php echo Form::open(['action' => '\Modules\Clinic\Http\Controllers\ConsultationController@store', 'method' => 'post', 'id' => 'consultation_form']); ?>


        
        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.consultation_details')]); ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('patient_id', __('clinic::lang.select_patient') . ':*'); ?>

                        <?php echo Form::select('patient_id', $patients, request('patient_id'), ['class' => 'form-control select2', 'required', 'placeholder' => __('clinic::lang.select_one')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('doctor_id', __('clinic::lang.select_doctor') . ':*'); ?>

                        <?php echo Form::select('doctor_id', $doctors, request('doctor_id'), ['class' => 'form-control select2', 'required', 'placeholder' => __('clinic::lang.select_one')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('appointment_id', __('clinic::lang.appointment') . ':'); ?>

                        <?php echo Form::select('appointment_id', $appointments, request('appointment_id'), ['class' => 'form-control select2', 'placeholder' => __('clinic::lang.select_one')]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('chief_complaint', __('clinic::lang.chief_complaint') . ':*'); ?>

                        <?php echo Form::textarea('chief_complaint', null, ['class' => 'form-control', 'rows' => 2, 'required', 'placeholder' => __('clinic::lang.chief_complaint')]); ?>

                    </div>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        
        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.vitals')]); ?>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <?php echo Form::label('vitals[temperature]', __('clinic::lang.temperature') . ':'); ?>

                        <?php echo Form::number('vitals[temperature]', null, ['class' => 'form-control', 'step' => '0.1', 'placeholder' => '36.5']); ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <?php echo Form::label('vitals[blood_pressure_systolic]', __('clinic::lang.blood_pressure_systolic') . ':'); ?>

                        <?php echo Form::number('vitals[blood_pressure_systolic]', null, ['class' => 'form-control', 'placeholder' => '120']); ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <?php echo Form::label('vitals[blood_pressure_diastolic]', __('clinic::lang.blood_pressure_diastolic') . ':'); ?>

                        <?php echo Form::number('vitals[blood_pressure_diastolic]', null, ['class' => 'form-control', 'placeholder' => '80']); ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <?php echo Form::label('vitals[pulse_rate]', __('clinic::lang.pulse_rate') . ':'); ?>

                        <?php echo Form::number('vitals[pulse_rate]', null, ['class' => 'form-control', 'placeholder' => '72']); ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <?php echo Form::label('vitals[respiratory_rate]', __('clinic::lang.respiratory_rate') . ':'); ?>

                        <?php echo Form::number('vitals[respiratory_rate]', null, ['class' => 'form-control', 'placeholder' => '16']); ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <?php echo Form::label('vitals[oxygen_saturation]', __('clinic::lang.oxygen_saturation') . ':'); ?>

                        <?php echo Form::number('vitals[oxygen_saturation]', null, ['class' => 'form-control', 'step' => '0.1', 'placeholder' => '98']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('vitals[weight]', __('clinic::lang.weight') . ':'); ?>

                        <?php echo Form::number('vitals[weight]', null, ['class' => 'form-control', 'step' => '0.1', 'placeholder' => '70']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('vitals[height]', __('clinic::lang.height') . ':'); ?>

                        <?php echo Form::number('vitals[height]', null, ['class' => 'form-control', 'step' => '0.1', 'placeholder' => '170']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('vitals[blood_sugar]', __('clinic::lang.blood_sugar') . ':'); ?>

                        <?php echo Form::number('vitals[blood_sugar]', null, ['class' => 'form-control', 'step' => '0.1', 'placeholder' => '100']); ?>

                    </div>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        
        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.soap_notes')]); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('history_of_present_illness', __('clinic::lang.history_of_illness') . ':'); ?>

                        <?php echo Form::textarea('history_of_present_illness', null, ['class' => 'form-control', 'rows' => 3]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('physical_examination', __('clinic::lang.examination_findings') . ':'); ?>

                        <?php echo Form::textarea('physical_examination', null, ['class' => 'form-control', 'rows' => 3]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('assessment', __('clinic::lang.assessment') . ':'); ?>

                        <?php echo Form::textarea('assessment', null, ['class' => 'form-control', 'rows' => 3]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('plan', __('clinic::lang.treatment_plan') . ':'); ?>

                        <?php echo Form::textarea('plan', null, ['class' => 'form-control', 'rows' => 3]); ?>

                    </div>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        
        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.diagnoses')]); ?>
            <div id="diagnosis_rows">
                <div class="row diagnosis-row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <?php echo Form::text('diagnoses[0][icd_code]', null, ['class' => 'form-control', 'placeholder' => __('clinic::lang.icd_code')]); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::text('diagnoses[0][diagnosis_name]', null, ['class' => 'form-control', 'placeholder' => __('clinic::lang.diagnosis_name')]); ?>

                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <?php echo Form::select('diagnoses[0][type]', ['primary' => __('clinic::lang.primary'), 'secondary' => __('clinic::lang.secondary')], 'primary', ['class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <?php echo Form::select('diagnoses[0][severity]', ['mild' => __('clinic::lang.mild'), 'moderate' => __('clinic::lang.moderate'), 'severe' => __('clinic::lang.severe')], 'mild', ['class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check mt-2">
                            <?php echo Form::checkbox('diagnoses[0][is_chronic]', 1, false, ['class' => 'form-check-input']); ?>

                            <label class="form-check-label"><?php echo app('translator')->get('clinic::lang.is_chronic'); ?></label>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger btn-sm remove-diagnosis mt-1" style="display:none;">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-info mt-2" id="add_diagnosis">
                <i class="fas fa-plus me-1"></i><?php echo app('translator')->get('clinic::lang.add_diagnosis'); ?>
            </button>
        <?php echo $__env->renderComponent(); ?>

        
        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.follow_up')]); ?>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('follow_up_date', __('clinic::lang.follow_up_date') . ':'); ?>

                        <?php echo Form::date('follow_up_date', null, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('consultation_fee', __('clinic::lang.consultation_fee') . ':'); ?>

                        <?php echo Form::number('consultation_fee', 0, ['class' => 'form-control', 'step' => '0.01', 'min' => '0']); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('follow_up_instructions', __('clinic::lang.follow_up_notes') . ':'); ?>

                        <?php echo Form::textarea('follow_up_instructions', null, ['class' => 'form-control', 'rows' => 2]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('clinical_notes', __('clinic::lang.clinical_notes') . ':'); ?>

                        <?php echo Form::textarea('clinical_notes', null, ['class' => 'form-control', 'rows' => 2]); ?>

                    </div>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        <?php echo Form::close(); ?>


        
        <div id="consultation-footer-actions-template" class="d-none">
            <div>
                <button type="button" class="btn btn-primary" id="consultation_save_btn">
                    <i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>
                </button>
                <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\ConsultationController::class, 'index']), false); ?>"
                   class="btn btn-default" id="consultation_back_btn">
                    <i class="fas fa-arrow-left"></i> <?php echo app('translator')->get('clinic::lang.back'); ?>
                </a>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        var diagnosisIndex = 1;
        $('#add_diagnosis').click(function() {
            var row = `<div class="row diagnosis-row">
                <div class="col-md-2"><div class="form-group"><input type="text" name="diagnoses[${diagnosisIndex}][icd_code]" class="form-control" placeholder="<?php echo app('translator')->get('clinic::lang.icd_code'); ?>"></div></div>
                <div class="col-md-3"><div class="form-group"><input type="text" name="diagnoses[${diagnosisIndex}][diagnosis_name]" class="form-control" placeholder="<?php echo app('translator')->get('clinic::lang.diagnosis_name'); ?>"></div></div>
                <div class="col-md-2"><div class="form-group"><select name="diagnoses[${diagnosisIndex}][type]" class="form-control"><option value="primary"><?php echo app('translator')->get('clinic::lang.primary'); ?></option><option value="secondary"><?php echo app('translator')->get('clinic::lang.secondary'); ?></option></select></div></div>
                <div class="col-md-2"><div class="form-group"><select name="diagnoses[${diagnosisIndex}][severity]" class="form-control"><option value="mild"><?php echo app('translator')->get('clinic::lang.mild'); ?></option><option value="moderate"><?php echo app('translator')->get('clinic::lang.moderate'); ?></option><option value="severe"><?php echo app('translator')->get('clinic::lang.severe'); ?></option></select></div></div>
                <div class="col-md-2"><div class="form-check mt-2"><input type="checkbox" name="diagnoses[${diagnosisIndex}][is_chronic]" value="1" class="form-check-input"><label class="form-check-label"><?php echo app('translator')->get('clinic::lang.is_chronic'); ?></label></div></div>
                <div class="col-md-1"><button type="button" class="btn btn-danger btn-sm remove-diagnosis mt-1"><i class="fas fa-times"></i></button></div>
            </div>`;
            $('#diagnosis_rows').append(row);
            diagnosisIndex++;
        });

        $(document).on('click', '.remove-diagnosis', function() {
            $(this).closest('.diagnosis-row').remove();
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>