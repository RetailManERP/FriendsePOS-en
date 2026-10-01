
<?php $__env->startSection('title', __('clinic::lang.view_appointment')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1>
            <i class="fas fa-calendar-check me-2"></i><?php echo app('translator')->get('clinic::lang.view_appointment'); ?> - <?php echo e($appointment->appointment_ref, false); ?>

        </h1>
    </section>

    <section class="content">
        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.appointment_details')]); ?>
            <div class="row">
                <div class="col-md-6">
                    <table class="table no-margin">
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.appointment_ref'); ?></th>
                            <td><?php echo e($appointment->appointment_ref, false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.patient'); ?></th>
                            <td><?php echo e($appointment->patient->first_name ?? '', false); ?> <?php echo e($appointment->patient->last_name ?? '', false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.doctor'); ?></th>
                            <td><?php echo e($appointment->doctor ? 'Dr. ' . ($appointment->doctor->first_name ?? '') . ' ' . ($appointment->doctor->last_name ?? '') : '-', false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.specialization'); ?></th>
                            <td><?php echo e($appointment->doctor->specialization->name ?? '-', false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.appointment_type'); ?></th>
                            <td><span class="badge bg-info"><?php echo e(ucfirst(str_replace('_', ' ', $appointment->type ?? '-')), false); ?></span></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table no-margin">
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.start_datetime'); ?></th>
                            <td><?php echo e($appointment->appointment_start ? \Carbon\Carbon::parse($appointment->appointment_start)->format('d/m/Y h:i A') : '-', false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.end_datetime'); ?></th>
                            <td><?php echo e($appointment->appointment_end ? \Carbon\Carbon::parse($appointment->appointment_end)->format('d/m/Y h:i A') : '-', false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.status'); ?></th>
                            <td>
                                <?php if($appointment->status == 'scheduled'): ?>
                                    <span class="badge bg-primary"><?php echo e(ucfirst($appointment->status), false); ?></span>
                                <?php elseif($appointment->status == 'checked_in'): ?>
                                    <span class="badge bg-info">Checked In</span>
                                <?php elseif($appointment->status == 'completed'): ?>
                                    <span class="badge bg-success"><?php echo e(ucfirst($appointment->status), false); ?></span>
                                <?php elseif($appointment->status == 'cancelled'): ?>
                                    <span class="badge bg-danger"><?php echo e(ucfirst($appointment->status), false); ?></span>
                                <?php else: ?>
                                    <span class="badge bg-secondary"><?php echo e(ucfirst($appointment->status ?? 'N/A'), false); ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.priority'); ?></th>
                            <td>
                                <?php if($appointment->priority == 'urgent'): ?>
                                    <span class="badge bg-warning"><?php echo e(ucfirst($appointment->priority), false); ?></span>
                                <?php elseif($appointment->priority == 'emergency'): ?>
                                    <span class="badge bg-danger"><?php echo e(ucfirst($appointment->priority), false); ?></span>
                                <?php else: ?>
                                    <span class="badge bg-secondary"><?php echo e(ucfirst($appointment->priority ?? 'Normal'), false); ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.walk_in'); ?></th>
                            <td><?php echo e($appointment->is_walk_in ? __('messages.yes') : __('messages.no'), false); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <?php if($appointment->notes): ?>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <h5><?php echo app('translator')->get('clinic::lang.notes'); ?></h5>
                        <p><?php echo e($appointment->notes, false); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if($appointment->status == 'cancelled' && $appointment->cancellation_reason): ?>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <h5 class="text-danger"><?php echo app('translator')->get('clinic::lang.cancellation_reason'); ?></h5>
                        <p><?php echo e($appointment->cancellation_reason, false); ?></p>
                    </div>
                </div>
            <?php endif; ?>
        <?php echo $__env->renderComponent(); ?>

        <div class="row mb-3">
            <div class="col-md-12">
                <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\AppointmentController::class, 'index']), false); ?>"
                   class="btn btn-default">
                    <i class="fas fa-arrow-left me-1"></i><?php echo app('translator')->get('clinic::lang.back'); ?>
                </a>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>