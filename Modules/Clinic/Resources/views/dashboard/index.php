
<?php $__env->startSection('title', __('clinic::lang.clinic_dashboard')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content no-print">

        
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <?php $__env->startComponent('components.widget'); ?>
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3 bg-light-success text-success" style="width:50px; height:50px; min-width:50px;">
                            <i class="fas fa-dollar-sign fa-lg"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold text-success"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $today_revenue, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></h4>
                            <p class="mb-0 text-muted small"><?php echo app('translator')->get('clinic::lang.today_revenue'); ?></p>
                            <small class="text-primary"><i class="fas fa-calendar-alt"></i> <?php echo app('translator')->get('clinic::lang.monthly'); ?>: <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $month_revenue, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></small>
                        </div>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-3 col-sm-6">
                <?php $__env->startComponent('components.widget'); ?>
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3 bg-light-info text-info" style="width:50px; height:50px; min-width:50px;">
                            <i class="fas fa-users fa-lg"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold text-info"><?php echo e($total_patients, false); ?></h4>
                            <p class="mb-0 text-muted small"><?php echo app('translator')->get('clinic::lang.total_patients'); ?></p>
                            <small class="text-success"><i class="fas fa-user-plus"></i> +<?php echo e($new_patients_today, false); ?> <?php echo app('translator')->get('clinic::lang.today'); ?></small>
                        </div>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-3 col-sm-6">
                <?php $__env->startComponent('components.widget'); ?>
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3 bg-light-warning text-warning" style="width:50px; height:50px; min-width:50px;">
                            <i class="fas fa-calendar-check fa-lg"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold text-warning"><?php echo e($today_appointments, false); ?></h4>
                            <p class="mb-0 text-muted small"><?php echo app('translator')->get('clinic::lang.todays_appointments'); ?></p>
                            <small>
                                <span class="text-success"><i class="fas fa-check-circle"></i> <?php echo e($appointments_completed_today, false); ?></span>
                                <span class="text-warning mx-1"><i class="fas fa-clock"></i> <?php echo e($appointments_pending_today, false); ?></span>
                                <span class="text-danger"><i class="fas fa-times-circle"></i> <?php echo e($appointments_cancelled_today, false); ?></span>
                            </small>
                        </div>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-3 col-sm-6">
                <?php $__env->startComponent('components.widget'); ?>
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3 bg-light-danger text-danger" style="width:50px; height:50px; min-width:50px;">
                            <i class="fas fa-list-ol fa-lg"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold text-danger"><?php echo e($queue_waiting, false); ?></h4>
                            <p class="mb-0 text-muted small"><?php echo app('translator')->get('clinic::lang.queue_waiting'); ?></p>
                            <small class="text-primary"><i class="fas fa-user-md"></i> <?php echo e($active_doctors, false); ?> <?php echo app('translator')->get('clinic::lang.doctors_on_duty'); ?></small>
                        </div>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>

        
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <?php $__env->startComponent('components.widget'); ?>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="mb-1 text-muted small"><?php echo app('translator')->get('clinic::lang.new_patients_today'); ?></p>
                            <h5 class="mb-0 fw-bold text-primary"><?php echo e($new_patients_today, false); ?></h5>
                        </div>
                        <div class="text-primary"><i class="fas fa-user-plus fa-2x opacity-50"></i></div>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-3 col-sm-6">
                <?php $__env->startComponent('components.widget'); ?>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="mb-1 text-muted small"><?php echo app('translator')->get('clinic::lang.new_patients_month'); ?></p>
                            <h5 class="mb-0 fw-bold text-info"><?php echo e($new_patients_month, false); ?></h5>
                        </div>
                        <div class="text-info"><i class="fas fa-users fa-2x opacity-50"></i></div>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-3 col-sm-6">
                <?php $__env->startComponent('components.widget'); ?>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="mb-1 text-muted small"><?php echo app('translator')->get('clinic::lang.consultations_this_month'); ?></p>
                            <h5 class="mb-0 fw-bold text-success"><?php echo e($consultations_month, false); ?></h5>
                        </div>
                        <div class="text-success"><i class="fas fa-stethoscope fa-2x opacity-50"></i></div>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-3 col-sm-6">
                <?php $__env->startComponent('components.widget'); ?>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="mb-1 text-muted small"><?php echo app('translator')->get('clinic::lang.pending_lab_orders'); ?></p>
                            <h5 class="mb-0 fw-bold text-danger"><?php echo e($pending_lab_orders, false); ?></h5>
                        </div>
                        <div class="text-danger"><i class="fas fa-flask fa-2x opacity-50"></i></div>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>

        
        <div class="row">
            <div class="col-md-8">
                <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.revenue_trend')]); ?>
                    <?php echo $revenue_chart->container(); ?>

                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-4">
                <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.appointment_status')]); ?>
                    <?php if(!empty($appointment_status_counts)): ?>
                        <div id="appointment_status_chart" style="height: 280px;"></div>
                    <?php else: ?>
                        <div class="text-center text-muted py-5">
                            <i class="fas fa-chart-pie fa-3x mb-3 opacity-50"></i>
                            <p><?php echo app('translator')->get('clinic::lang.no_data'); ?></p>
                        </div>
                    <?php endif; ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>

        
        <div class="row">
            <div class="col-md-5">
                <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.appointment_trend')]); ?>
                    <?php echo $appointment_chart->container(); ?>

                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-7">
                <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.todays_queue')]); ?>
                    <?php if($todays_queue->count() > 0): ?>
                        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                            <table class="table table-hover table-striped table-sm mb-0">
                                <thead class="table-th-skin">
                                    <tr>
                                        <th><?php echo app('translator')->get('clinic::lang.queue_number'); ?></th>
                                        <th><?php echo app('translator')->get('clinic::lang.patient'); ?></th>
                                        <th><?php echo app('translator')->get('clinic::lang.doctor'); ?></th>
                                        <th><?php echo app('translator')->get('clinic::lang.department'); ?></th>
                                        <th><?php echo app('translator')->get('clinic::lang.status'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $todays_queue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $queue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><span class="badge bg-primary"><?php echo e($queue->queue_number, false); ?></span></td>
                                            <td><?php echo e(optional($queue->patient)->first_name, false); ?> <?php echo e(optional($queue->patient)->last_name, false); ?></td>
                                            <td><?php echo e(optional($queue->doctor)->first_name, false); ?> <?php echo e(optional($queue->doctor)->last_name, false); ?></td>
                                            <td><?php echo e(ucfirst(str_replace('_', ' ', $queue->department ?? '')), false); ?></td>
                                            <td>
                                                <?php
                                                    $queueStatusColors = [
                                                        'waiting' => 'bg-warning',
                                                        'in_service' => 'bg-success',
                                                        'completed' => 'bg-secondary',
                                                        'skipped' => 'bg-danger',
                                                    ];
                                                ?>
                                                <span class="badge <?php echo e($queueStatusColors[$queue->status] ?? 'bg-secondary', false); ?>">
                                                    <?php echo e(ucfirst(str_replace('_', ' ', $queue->status)), false); ?>

                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-list-ol fa-3x mb-3 opacity-50"></i>
                            <p><?php echo app('translator')->get('clinic::lang.no_queue'); ?></p>
                        </div>
                    <?php endif; ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>

        
        <div class="row">
            <div class="col-md-3">
                <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.quick_actions')]); ?>
                    <div class="d-grid gap-2">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clinic.manage_patients')): ?>
                        <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\PatientController::class, 'create']), false); ?>"
                           class="btn btn-sm btn-info w-100">
                            <i class="fas fa-user-plus me-2"></i><?php echo app('translator')->get('clinic::lang.new_patient'); ?>
                        </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clinic.manage_appointments')): ?>
                        <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\AppointmentController::class, 'create']), false); ?>"
                           class="btn btn-sm btn-success w-100">
                            <i class="fas fa-calendar-plus me-2"></i><?php echo app('translator')->get('clinic::lang.new_appointment'); ?>
                        </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clinic.manage_consultations')): ?>
                        <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\ConsultationController::class, 'create']), false); ?>"
                           class="btn btn-sm btn-warning w-100">
                            <i class="fas fa-stethoscope me-2"></i><?php echo app('translator')->get('clinic::lang.new_consultation'); ?>
                        </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clinic.manage_lab')): ?>
                        <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\LabController::class, 'create']), false); ?>"
                           class="btn btn-sm btn-primary w-100">
                            <i class="fas fa-flask me-2"></i><?php echo app('translator')->get('clinic::lang.new_lab_order'); ?>
                        </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clinic.manage_queue')): ?>
                        <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\QueueController::class, 'index']), false); ?>"
                           class="btn btn-sm btn-danger w-100">
                            <i class="fas fa-list-ol me-2"></i><?php echo app('translator')->get('clinic::lang.view_queue'); ?>
                        </a>
                        <?php endif; ?>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-4">
                <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.top_doctors')]); ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm mb-0">
                            <thead class="table-th-skin">
                                <tr>
                                    <th><?php echo app('translator')->get('clinic::lang.doctor'); ?></th>
                                    <th class="text-center"><?php echo app('translator')->get('clinic::lang.consultations'); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('clinic::lang.revenue'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_18 = true; $__currentLoopData = $top_doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                    <tr>
                                        <td>
                                            <i class="fas fa-user-md text-primary me-1"></i>
                                            <?php echo e(optional($doc->doctor)->first_name, false); ?> <?php echo e(optional($doc->doctor)->last_name, false); ?>

                                        </td>
                                        <td class="text-center"><span class="badge bg-info"><?php echo e($doc->consultation_count, false); ?></span></td>
                                        <td class="text-end fw-bold text-success"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $doc->total_revenue, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                    <tr><td colspan="3" class="text-center text-muted"><?php echo app('translator')->get('clinic::lang.no_data'); ?></td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-5">
                <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.upcoming_appointments')]); ?>
                    <div style="max-height: 320px; overflow-y: auto;">
                        <?php $__empty_18 = true; $__currentLoopData = $recent_appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <div class="d-flex align-items-center justify-content-between py-2 <?php echo e(!$loop->last ? 'border-bottom' : '', false); ?>">
                                <div>
                                    <strong><?php echo e($appt->patient->first_name ?? '', false); ?> <?php echo e($appt->patient->last_name ?? '', false); ?></strong>
                                    <br><small class="text-muted"><i class="fas fa-user-md"></i> <?php echo e($appt->doctor->first_name ?? '', false); ?> <?php echo e($appt->doctor->last_name ?? '', false); ?></small>
                                </div>
                                <div class="text-end">
                                    <small class="text-muted">
                                        <?php echo e($appt->appointment_start ? $appt->appointment_start->format('M d') : '', false); ?>

                                    </small>
                                    <br>
                                    <small class="fw-bold">
                                        <?php echo e($appt->appointment_start ? $appt->appointment_start->format('h:i A') : '', false); ?>

                                    </small>
                                    <br>
                                    <?php
                                        $statusColors = [
                                            'scheduled' => 'bg-primary',
                                            'confirmed' => 'bg-info',
                                            'checked_in' => 'bg-warning',
                                            'in_progress' => 'bg-success',
                                            'completed' => 'bg-secondary',
                                            'cancelled' => 'bg-danger',
                                            'no_show' => 'bg-dark',
                                            'rescheduled' => 'bg-warning',
                                        ];
                                    ?>
                                    <span class="badge <?php echo e($statusColors[$appt->status] ?? 'bg-secondary', false); ?>"><?php echo e(ucfirst(str_replace('_', ' ', $appt->status)), false); ?></span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                            <div class="text-center text-muted py-4">
                                <i class="fas fa-calendar fa-3x mb-3 opacity-50"></i>
                                <p><?php echo app('translator')->get('clinic::lang.no_appointments'); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <?php echo $revenue_chart->script(); ?>

    <?php echo $appointment_chart->script(); ?>


    <?php if(!empty($appointment_status_counts)): ?>
    <script>
        $(function() {
            var statusData = <?php echo json_encode($appointment_status_counts, 15, 512) ?>;
            var statusColors = {
                'scheduled': '#3461ff',
                'confirmed': '#17a2b8',
                'checked_in': '#ffc107',
                'in_progress': '#28a745',
                'completed': '#6c757d',
                'cancelled': '#dc3545',
                'no_show': '#343a40',
                'rescheduled': '#fd7e14'
            };
            var statusLabels = {
                'scheduled': '<?php echo app('translator')->get("clinic::lang.scheduled"); ?>',
                'confirmed': '<?php echo app('translator')->get("clinic::lang.confirmed"); ?>',
                'checked_in': '<?php echo app('translator')->get("clinic::lang.checked_in"); ?>',
                'in_progress': '<?php echo app('translator')->get("clinic::lang.in_progress"); ?>',
                'completed': '<?php echo app('translator')->get("clinic::lang.completed"); ?>',
                'cancelled': '<?php echo app('translator')->get("clinic::lang.cancelled"); ?>',
                'no_show': '<?php echo app('translator')->get("clinic::lang.no_show"); ?>',
                'rescheduled': '<?php echo app('translator')->get("clinic::lang.rescheduled"); ?>'
            };

            var chartData = [];
            for (var key in statusData) {
                chartData.push({
                    name: statusLabels[key] || key,
                    y: statusData[key],
                    color: statusColors[key] || '#6c757d'
                });
            }

            if (typeof Highcharts !== 'undefined') {
                Highcharts.chart('appointment_status_chart', {
                    chart: { type: 'pie', backgroundColor: 'transparent' },
                    title: { text: null },
                    tooltip: {
                        pointFormat: '<b>{point.y}</b> ({point.percentage:.1f}%)'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '{point.name}: {point.y}',
                                style: { fontSize: '11px' }
                            },
                            showInLegend: false
                        }
                    },
                    credits: { enabled: false },
                    series: [{ name: 'Appointments', data: chartData }]
                });
            }
        });
    </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>