
<?php $__env->startSection('title', __('clinic::lang.consultation_details')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 >
            <i class="fas fa-stethoscope me-2"></i><?php echo app('translator')->get('clinic::lang.consultation_details'); ?> - <?php echo e($consultation->consultation_ref, false); ?>

        </h1>
    </section>

    <section class="content">
        <div class="row">
            
            <div class="col-md-4">
                <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.patient_details')]); ?>
                    <table class="table no-margin">
                        <tr><th><?php echo app('translator')->get('clinic::lang.patient'); ?></th><td><?php echo e($consultation->patient->first_name ?? '', false); ?> <?php echo e($consultation->patient->last_name ?? '', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.patient_id'); ?></th><td><?php echo e($consultation->patient->patient_id_number ?? '', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.doctor'); ?></th><td><?php echo app('translator')->get('clinic::lang.dr'); ?> <?php echo e($consultation->doctor->first_name ?? '', false); ?> <?php echo e($consultation->doctor->last_name ?? '', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.consultation_ref'); ?></th><td><?php echo e($consultation->consultation_ref, false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.status'); ?></th><td><span class="badge bg-info"><?php echo e(ucfirst($consultation->status), false); ?></span></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.consultation_fee'); ?></th><td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $consultation->consultation_fee, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.created_at'); ?></th><td><?php echo e($consultation->created_at->format('d/m/Y h:i A'), false); ?></td></tr>
                    </table>
                <?php echo $__env->renderComponent(); ?>

                <?php $latestVitals = $consultation->vitals->first(); ?>
                <?php if($latestVitals): ?>
                <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.vitals')]); ?>
                    <table class="table no-margin">
                        <?php if($latestVitals->temperature): ?><tr><th><?php echo app('translator')->get('clinic::lang.temperature'); ?></th><td><?php echo e($latestVitals->temperature, false); ?> °C</td></tr><?php endif; ?>
                        <?php if($latestVitals->blood_pressure_systolic): ?><tr><th><?php echo app('translator')->get('clinic::lang.blood_pressure'); ?></th><td><?php echo e($latestVitals->blood_pressure_systolic, false); ?>/<?php echo e($latestVitals->blood_pressure_diastolic, false); ?> mmHg</td></tr><?php endif; ?>
                        <?php if($latestVitals->pulse_rate): ?><tr><th><?php echo app('translator')->get('clinic::lang.pulse_rate'); ?></th><td><?php echo e($latestVitals->pulse_rate, false); ?> bpm</td></tr><?php endif; ?>
                        <?php if($latestVitals->respiratory_rate): ?><tr><th><?php echo app('translator')->get('clinic::lang.respiratory_rate'); ?></th><td><?php echo e($latestVitals->respiratory_rate, false); ?></td></tr><?php endif; ?>
                        <?php if($latestVitals->oxygen_saturation): ?><tr><th><?php echo app('translator')->get('clinic::lang.oxygen_saturation'); ?></th><td><?php echo e($latestVitals->oxygen_saturation, false); ?>%</td></tr><?php endif; ?>
                        <?php if($latestVitals->weight): ?><tr><th><?php echo app('translator')->get('clinic::lang.weight'); ?></th><td><?php echo e($latestVitals->weight, false); ?> kg</td></tr><?php endif; ?>
                        <?php if($latestVitals->height): ?><tr><th><?php echo app('translator')->get('clinic::lang.height'); ?></th><td><?php echo e($latestVitals->height, false); ?> cm</td></tr><?php endif; ?>
                        <?php if($latestVitals->bmi): ?><tr><th><?php echo app('translator')->get('clinic::lang.bmi'); ?></th><td><?php echo e(number_format($latestVitals->bmi, 1), false); ?></td></tr><?php endif; ?>
                        <?php if($latestVitals->blood_sugar): ?><tr><th><?php echo app('translator')->get('clinic::lang.blood_sugar'); ?></th><td><?php echo e($latestVitals->blood_sugar, false); ?> mg/dL</td></tr><?php endif; ?>
                    </table>
                <?php echo $__env->renderComponent(); ?>
                <?php endif; ?>
            </div>

            
            <div class="col-md-8">
                <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.chief_complaint')]); ?>
                    <p><?php echo e($consultation->chief_complaint, false); ?></p>
                <?php echo $__env->renderComponent(); ?>

                <?php if($consultation->history_of_present_illness || $consultation->physical_examination || $consultation->assessment || $consultation->plan): ?>
                <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.soap_notes')]); ?>
                    <?php if($consultation->history_of_present_illness): ?>
                        <h6 class="fw-bold"><?php echo app('translator')->get('clinic::lang.history_of_illness'); ?></h6>
                        <p><?php echo e($consultation->history_of_present_illness, false); ?></p>
                    <?php endif; ?>
                    <?php if($consultation->physical_examination): ?>
                        <h6 class="fw-bold mt-3"><?php echo app('translator')->get('clinic::lang.examination_findings'); ?></h6>
                        <p><?php echo e($consultation->physical_examination, false); ?></p>
                    <?php endif; ?>
                    <?php if($consultation->assessment): ?>
                        <h6 class="fw-bold mt-3"><?php echo app('translator')->get('clinic::lang.assessment'); ?></h6>
                        <p><?php echo e($consultation->assessment, false); ?></p>
                    <?php endif; ?>
                    <?php if($consultation->plan): ?>
                        <h6 class="fw-bold mt-3"><?php echo app('translator')->get('clinic::lang.treatment_plan'); ?></h6>
                        <p><?php echo e($consultation->plan, false); ?></p>
                    <?php endif; ?>
                <?php echo $__env->renderComponent(); ?>
                <?php endif; ?>

                
                <?php if($consultation->diagnoses->count()): ?>
                <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.diagnoses')]); ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('clinic::lang.icd_code'); ?></th>
                                    <th><?php echo app('translator')->get('clinic::lang.diagnosis_name'); ?></th>
                                    <th><?php echo app('translator')->get('clinic::lang.diagnosis_type'); ?></th>
                                    <th><?php echo app('translator')->get('clinic::lang.severity'); ?></th>
                                    <th><?php echo app('translator')->get('clinic::lang.is_chronic'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $consultation->diagnoses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($dx->icd_code ?? '-', false); ?></td>
                                        <td><?php echo e($dx->diagnosis_name, false); ?></td>
                                        <td><span class="badge <?php echo e($dx->type == 'primary' ? 'bg-primary' : 'bg-secondary', false); ?>"><?php echo e(ucfirst($dx->type), false); ?></span></td>
                                        <td><?php echo e(ucfirst($dx->severity), false); ?></td>
                                        <td><?php echo $dx->is_chronic ? '<i class="fas fa-check text-danger"></i>' : '-'; ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php echo $__env->renderComponent(); ?>
                <?php endif; ?>

                
                <?php if($consultation->prescriptions->count()): ?>
                <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.prescriptions')]); ?>
                    <?php $__currentLoopData = $consultation->prescriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong><?php echo e($rx->prescription_ref, false); ?></strong>
                                <span class="badge bg-info"><?php echo e(ucfirst(str_replace('_', ' ', $rx->status)), false); ?></span>
                            </div>
                            <?php if($rx->items->count()): ?>
                                <table class="table table-sm mt-2">
                                    <thead><tr><th><?php echo app('translator')->get('clinic::lang.medicine_name'); ?></th><th><?php echo app('translator')->get('clinic::lang.dosage'); ?></th><th><?php echo app('translator')->get('clinic::lang.frequency'); ?></th><th><?php echo app('translator')->get('clinic::lang.duration'); ?></th></tr></thead>
                                    <tbody>
                                        <?php $__currentLoopData = $rx->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($item->medicine_name, false); ?></td>
                                                <td><?php echo e($item->dosage, false); ?></td>
                                                <td><?php echo e($item->frequency, false); ?></td>
                                                <td><?php echo e($item->duration, false); ?> <?php echo app('translator')->get('clinic::lang.duration_days'); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->renderComponent(); ?>
                <?php endif; ?>

                
                <?php if($consultation->labOrders->count()): ?>
                <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.lab_orders')]); ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('clinic::lang.lab_order_ref'); ?></th>
                                <th><?php echo app('translator')->get('clinic::lang.test_name'); ?></th>
                                <th><?php echo app('translator')->get('clinic::lang.status'); ?></th>
                                <th><?php echo app('translator')->get('clinic::lang.result'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $consultation->labOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($lab->order_ref, false); ?></td>
                                    <td><?php echo e($lab->labTest->name ?? '', false); ?></td>
                                    <td><span class="badge bg-info"><?php echo e(ucfirst(str_replace('_', ' ', $lab->status)), false); ?></span></td>
                                    <td><?php echo e($lab->result_value ?? '-', false); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php echo $__env->renderComponent(); ?>
                <?php endif; ?>

                <?php if($consultation->clinical_notes): ?>
                <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.clinical_notes')]); ?>
                    <p><?php echo e($consultation->clinical_notes, false); ?></p>
                <?php echo $__env->renderComponent(); ?>
                <?php endif; ?>

                <?php if($consultation->follow_up_date): ?>
                <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.follow_up')]); ?>
                    <p><strong><?php echo app('translator')->get('clinic::lang.follow_up_date'); ?>:</strong> <?php echo e(\Carbon\Carbon::parse($consultation->follow_up_date)->format('d/m/Y'), false); ?></p>
                    <?php if($consultation->follow_up_instructions): ?><p><?php echo e($consultation->follow_up_instructions, false); ?></p><?php endif; ?>
                <?php echo $__env->renderComponent(); ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\ConsultationController::class, 'index']), false); ?>"
                   class="btn btn-default">
                    <i class="fas fa-arrow-left me-1"></i><?php echo app('translator')->get('clinic::lang.back'); ?>
                </a>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clinic.manage_prescriptions')): ?>
                <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\PrescriptionController::class, 'create']), false); ?>?consultation_id=<?php echo e($consultation->id, false); ?>&patient_id=<?php echo e($consultation->patient_id, false); ?>&doctor_id=<?php echo e($consultation->doctor_id, false); ?>"
                   class="btn btn-success">
                    <i class="fas fa-prescription me-1"></i><?php echo app('translator')->get('clinic::lang.add_prescription'); ?>
                </a>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clinic.manage_lab')): ?>
                <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\LabController::class, 'create']), false); ?>?consultation_id=<?php echo e($consultation->id, false); ?>&patient_id=<?php echo e($consultation->patient_id, false); ?>&doctor_id=<?php echo e($consultation->doctor_id, false); ?>"
                   class="btn btn-warning">
                    <i class="fas fa-flask me-1"></i><?php echo app('translator')->get('clinic::lang.add_lab_order'); ?>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>