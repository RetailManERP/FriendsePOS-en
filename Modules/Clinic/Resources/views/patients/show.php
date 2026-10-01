
<?php $__env->startSection('title', __('clinic::lang.patient_profile')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 >
            <i class="fas fa-user-injured me-2"></i><?php echo e($patient->first_name, false); ?> <?php echo e($patient->last_name, false); ?>

            <small class="text-muted">(<?php echo e($patient->patient_id_number, false); ?>)</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            
            <div class="col-md-4">
                <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.personal_info')]); ?>
                    <table class="table no-margin">
                        <tr><th><?php echo app('translator')->get('clinic::lang.patient_id'); ?></th><td><?php echo e($patient->patient_id_number, false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.name'); ?></th><td><?php echo e($patient->first_name, false); ?> <?php echo e($patient->last_name, false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.gender'); ?></th><td><?php echo e(ucfirst($patient->gender), false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.date_of_birth'); ?></th><td><?php echo e($patient->date_of_birth ? \Carbon\Carbon::parse($patient->date_of_birth)->format('d/m/Y') : '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.age'); ?></th><td><?php echo e($patient->age ?? '-', false); ?> <?php echo app('translator')->get('clinic::lang.years'); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.blood_group'); ?></th><td><?php echo e($patient->blood_group ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.phone'); ?></th><td><?php echo e($patient->phone, false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.email'); ?></th><td><?php echo e($patient->email ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.address'); ?></th><td><?php echo e($patient->address ?? '-', false); ?></td></tr>
                    </table>
                <?php echo $__env->renderComponent(); ?>

                <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.emergency_contact')]); ?>
                    <table class="table no-margin">
                        <tr><th><?php echo app('translator')->get('clinic::lang.name'); ?></th><td><?php echo e($patient->emergency_contact_name ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.phone'); ?></th><td><?php echo e($patient->emergency_contact_phone ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.emergency_contact_relation'); ?></th><td><?php echo e($patient->emergency_contact_relation ?? '-', false); ?></td></tr>
                    </table>
                <?php echo $__env->renderComponent(); ?>

                <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.medical_info')]); ?>
                    <table class="table no-margin">
                        <tr><th><?php echo app('translator')->get('clinic::lang.allergies'); ?></th><td><?php echo e($patient->allergies ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.chronic_conditions'); ?></th><td><?php echo e($patient->chronic_conditions ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.current_medications'); ?></th><td><?php echo e($patient->current_medications ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.medical_history'); ?></th><td><?php echo e($patient->medical_history ?? '-', false); ?></td></tr>
                    </table>
                <?php echo $__env->renderComponent(); ?>

                <?php if($patient->insurances && $patient->insurances->count()): ?>
                <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.insurance_info')]); ?>
                    <?php $__currentLoopData = $patient->insurances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ins): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="border-bottom pb-2 mb-2">
                            <strong><?php echo e($ins->insuranceProvider->name ?? '', false); ?></strong><br>
                            <small><?php echo app('translator')->get('clinic::lang.policy_number'); ?>: <?php echo e($ins->policy_number, false); ?></small><br>
                            <small><?php echo app('translator')->get('clinic::lang.valid_until'); ?>: <?php echo e($ins->valid_until ? \Carbon\Carbon::parse($ins->valid_until)->format('d/m/Y') : '-', false); ?></small>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->renderComponent(); ?>
                <?php endif; ?>
            </div>

            
            <div class="col-md-8">
                <?php $__env->startComponent('components.widget'); ?>
                    <div class="card">
                        <div class="card-header p-0">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#consultations_tab" data-bs-toggle="tab">
                                        <i class="fas fa-stethoscope me-1"></i><?php echo app('translator')->get('clinic::lang.consultations'); ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#appointments_tab" data-bs-toggle="tab">
                                        <i class="fas fa-calendar-check me-1"></i><?php echo app('translator')->get('clinic::lang.appointments'); ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#prescriptions_tab" data-bs-toggle="tab">
                                        <i class="fas fa-prescription me-1"></i><?php echo app('translator')->get('clinic::lang.prescriptions'); ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#lab_orders_tab" data-bs-toggle="tab">
                                        <i class="fas fa-flask me-1"></i><?php echo app('translator')->get('clinic::lang.lab_orders'); ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                
                                <div class="tab-pane fade show active" id="consultations_tab">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th><?php echo app('translator')->get('clinic::lang.consultation_ref'); ?></th>
                                                    <th><?php echo app('translator')->get('clinic::lang.doctor'); ?></th>
                                                    <th><?php echo app('translator')->get('clinic::lang.chief_complaint'); ?></th>
                                                    <th><?php echo app('translator')->get('clinic::lang.status'); ?></th>
                                                    <th><?php echo app('translator')->get('clinic::lang.created_at'); ?></th>
                                                    <th><?php echo app('translator')->get('clinic::lang.action'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_18 = true; $__currentLoopData = $patient->consultations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cons): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                                    <tr>
                                                        <td><?php echo e($cons->consultation_ref, false); ?></td>
                                                        <td><?php echo e($cons->doctor->first_name ?? '', false); ?> <?php echo e($cons->doctor->last_name ?? '', false); ?></td>
                                                        <td><?php echo e(Str::limit($cons->chief_complaint, 40), false); ?></td>
                                                        <td><span class="badge bg-info"><?php echo e(ucfirst($cons->status), false); ?></span></td>
                                                        <td><?php echo e($cons->created_at->format('d/m/Y'), false); ?></td>
                                                        <td>
                                                            <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\ConsultationController::class, 'show'], $cons->id), false); ?>"
                                                               class="btn btn-xs btn-info">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                                    <tr><td colspan="6" class="text-center text-muted"><?php echo app('translator')->get('clinic::lang.no_consultations'); ?></td></tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                
                                <div class="tab-pane fade" id="appointments_tab">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th><?php echo app('translator')->get('clinic::lang.appointment_ref'); ?></th>
                                                    <th><?php echo app('translator')->get('clinic::lang.doctor'); ?></th>
                                                    <th><?php echo app('translator')->get('clinic::lang.appointment_date'); ?></th>
                                                    <th><?php echo app('translator')->get('clinic::lang.appointment_type'); ?></th>
                                                    <th><?php echo app('translator')->get('clinic::lang.status'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_18 = true; $__currentLoopData = $patient->appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                                    <tr>
                                                        <td><?php echo e($appt->appointment_ref, false); ?></td>
                                                        <td><?php echo e($appt->doctor->first_name ?? '', false); ?> <?php echo e($appt->doctor->last_name ?? '', false); ?></td>
                                                        <td><?php echo e(\Carbon\Carbon::parse($appt->start_datetime)->format('d/m/Y h:i A'), false); ?></td>
                                                        <td><?php echo e(ucfirst(str_replace('_', ' ', $appt->appointment_type)), false); ?></td>
                                                        <td><span class="badge bg-info"><?php echo e(ucfirst(str_replace('_', ' ', $appt->status)), false); ?></span></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                                    <tr><td colspan="5" class="text-center text-muted"><?php echo app('translator')->get('clinic::lang.no_appointments'); ?></td></tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                
                                <div class="tab-pane fade" id="prescriptions_tab">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th><?php echo app('translator')->get('clinic::lang.prescription_ref'); ?></th>
                                                    <th><?php echo app('translator')->get('clinic::lang.doctor'); ?></th>
                                                    <th><?php echo app('translator')->get('clinic::lang.status'); ?></th>
                                                    <th><?php echo app('translator')->get('clinic::lang.created_at'); ?></th>
                                                    <th><?php echo app('translator')->get('clinic::lang.action'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_18 = true; $__currentLoopData = $patient->prescriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                                    <tr>
                                                        <td><?php echo e($rx->prescription_ref, false); ?></td>
                                                        <td><?php echo e($rx->doctor->first_name ?? '', false); ?> <?php echo e($rx->doctor->last_name ?? '', false); ?></td>
                                                        <td><span class="badge bg-info"><?php echo e(ucfirst(str_replace('_', ' ', $rx->status)), false); ?></span></td>
                                                        <td><?php echo e($rx->created_at->format('d/m/Y'), false); ?></td>
                                                        <td>
                                                            <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\PrescriptionController::class, 'show'], $rx->id), false); ?>"
                                                               class="btn btn-xs btn-info">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                                    <tr><td colspan="5" class="text-center text-muted"><?php echo app('translator')->get('clinic::lang.no_prescriptions'); ?></td></tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                
                                <div class="tab-pane fade" id="lab_orders_tab">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th><?php echo app('translator')->get('clinic::lang.lab_order_ref'); ?></th>
                                                    <th><?php echo app('translator')->get('clinic::lang.test_name'); ?></th>
                                                    <th><?php echo app('translator')->get('clinic::lang.status'); ?></th>
                                                    <th><?php echo app('translator')->get('clinic::lang.result'); ?></th>
                                                    <th><?php echo app('translator')->get('clinic::lang.created_at'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_18 = true; $__currentLoopData = $patient->labOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                                    <tr>
                                                        <td><?php echo e($lab->order_ref, false); ?></td>
                                                        <td><?php echo e($lab->labTest->name ?? '', false); ?></td>
                                                        <td><span class="badge bg-info"><?php echo e(ucfirst(str_replace('_', ' ', $lab->status)), false); ?></span></td>
                                                        <td><?php echo e($lab->result_value ?? '-', false); ?></td>
                                                        <td><?php echo e($lab->created_at->format('d/m/Y'), false); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                                    <tr><td colspan="5" class="text-center text-muted"><?php echo app('translator')->get('clinic::lang.no_lab_orders'); ?></td></tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>