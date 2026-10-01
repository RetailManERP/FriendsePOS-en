<style>
    .clinic-nav-wrapper {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
        scrollbar-color: #c1c1c1 transparent;
        padding-bottom: 2px;
    }
    .clinic-nav-wrapper::-webkit-scrollbar {
        height: 4px;
    }
    .clinic-nav-wrapper::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 4px;
    }
    .clinic-nav-wrapper .nav-link {
        white-space: nowrap;
        text-align: center;
        padding: 0.5rem 0.75rem;
        font-size: 0.85rem;
        color: #555;
        border-radius: 0.375rem;
        transition: background 0.2s, color 0.2s;
    }
    .clinic-nav-wrapper .nav-link:hover {
        background: rgba(0,0,0,0.05);
        color: #212529;
    }
    .clinic-nav-wrapper .nav-link.active {
        color: #198754;
        font-weight: 600;
    }
    .clinic-nav-wrapper .nav-item {
        flex-shrink: 0;
    }
    @media (max-width: 767.98px) {
        .clinic-nav-wrapper .nav-link {
            font-size: 0.78rem;
            padding: 0.4rem 0.5rem;
        }
        .clinic-nav-wrapper .nav-link i {
            display: block;
            margin: 0 auto 2px;
            font-size: 1rem;
        }
        .clinic-nav-wrapper .nav-link .me-1 {
            margin-right: 0 !important;
        }
    }
</style>
<section class="no-print">
    <nav class="navbar navbar-light bg-white shadow-sm mx-2 mx-md-4 mt-4 mb-2 px-3 rounded" style="overflow: visible;">
        <div class="container-fluid px-0 flex-column flex-sm-column align-items-start">
            <div class="d-flex w-100 align-items-center justify-content-between mb-2">
                <a class="navbar-brand fw-semibold mb-0" href="<?php echo e(action([\Modules\Clinic\Http\Controllers\ClinicController::class, 'index']), false); ?>">
                    <i class="fas fa-clinic-medical me-2"></i><?php echo app('translator')->get('clinic::lang.clinic'); ?>
                </a>
            </div>

            <div class="clinic-nav-wrapper w-100">
                <ul class="navbar-nav flex-row flex-nowrap mb-0 w-100">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clinic.manage_patients')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'clinic' && request()->segment(2) == 'patients'): ?> active <?php endif; ?>"
                           href="<?php echo e(action([Modules\Clinic\Http\Controllers\PatientController::class, 'index']), false); ?>">
                            <i class="fas fa-user-injured me-1"></i><?php echo app('translator')->get('clinic::lang.patients'); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clinic.manage_doctors')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'clinic' && request()->segment(2) == 'doctors'): ?> active <?php endif; ?>"
                           href="<?php echo e(action([Modules\Clinic\Http\Controllers\DoctorController::class, 'index']), false); ?>">
                            <i class="fas fa-user-md me-1"></i><?php echo app('translator')->get('clinic::lang.doctors'); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clinic.manage_appointments')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'clinic' && request()->segment(2) == 'appointments'): ?> active <?php endif; ?>"
                           href="<?php echo e(action([Modules\Clinic\Http\Controllers\AppointmentController::class, 'index']), false); ?>">
                            <i class="fas fa-calendar-check me-1"></i><?php echo app('translator')->get('clinic::lang.appointments'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'clinic' && request()->segment(2) == 'calendar'): ?> active <?php endif; ?>"
                           href="<?php echo e(action([Modules\Clinic\Http\Controllers\AppointmentController::class, 'calendar']), false); ?>">
                            <i class="fas fa-calendar-alt me-1"></i><?php echo app('translator')->get('clinic::lang.calendar'); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clinic.manage_consultations')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'clinic' && request()->segment(2) == 'consultations'): ?> active <?php endif; ?>"
                           href="<?php echo e(action([Modules\Clinic\Http\Controllers\ConsultationController::class, 'index']), false); ?>">
                            <i class="fas fa-stethoscope me-1"></i><?php echo app('translator')->get('clinic::lang.consultations'); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clinic.manage_prescriptions')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'clinic' && request()->segment(2) == 'prescriptions'): ?> active <?php endif; ?>"
                           href="<?php echo e(action([Modules\Clinic\Http\Controllers\PrescriptionController::class, 'index']), false); ?>">
                            <i class="fas fa-prescription me-1"></i><?php echo app('translator')->get('clinic::lang.prescriptions'); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clinic.manage_lab')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'clinic' && request()->segment(2) == 'lab-orders'): ?> active <?php endif; ?>"
                           href="<?php echo e(action([Modules\Clinic\Http\Controllers\LabController::class, 'index']), false); ?>">
                            <i class="fas fa-flask me-1"></i><?php echo app('translator')->get('clinic::lang.lab_orders'); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clinic.manage_queue')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'clinic' && request()->segment(2) == 'queue'): ?> active <?php endif; ?>"
                           href="<?php echo e(action([Modules\Clinic\Http\Controllers\QueueController::class, 'index']), false); ?>">
                            <i class="fas fa-list-ol me-1"></i><?php echo app('translator')->get('clinic::lang.patient_queue'); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clinic.manage_insurance')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'clinic' && request()->segment(2) == 'insurance'): ?> active <?php endif; ?>"
                           href="<?php echo e(action([Modules\Clinic\Http\Controllers\InsuranceController::class, 'index']), false); ?>">
                            <i class="fas fa-shield-alt me-1"></i><?php echo app('translator')->get('clinic::lang.insurance'); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clinic.view_reports')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'clinic' && request()->segment(2) == 'reports'): ?> active <?php endif; ?>"
                           href="<?php echo e(action([Modules\Clinic\Http\Controllers\ReportController::class, 'index']), false); ?>">
                            <i class="fas fa-chart-bar me-1"></i><?php echo app('translator')->get('clinic::lang.reports'); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clinic.manage_settings')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(1) == 'clinic' && request()->segment(2) == 'settings'): ?> active <?php endif; ?>"
                           href="<?php echo e(action([Modules\Clinic\Http\Controllers\SettingController::class, 'index']), false); ?>">
                            <i class="fas fa-cog me-1"></i><?php echo app('translator')->get('messages.settings'); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</section>
