
<?php $__env->startSection('title', __('clinic::lang.appointments')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 >
            <i class="fas fa-calendar-check me-2"></i><?php echo app('translator')->get('clinic::lang.appointments'); ?>
        </h1>
        <p><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('clinic::lang.manage_appointments_help'); ?></p>
    </section>

    <section class="content">
        
        <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('filter_status', __('clinic::lang.filter_by_status') . ':'); ?>

                    <?php echo Form::select('filter_status', ['' => __('clinic::lang.all'), 'scheduled' => __('clinic::lang.scheduled'), 'confirmed' => __('clinic::lang.confirmed'), 'checked_in' => __('clinic::lang.checked_in'), 'in_progress' => __('clinic::lang.in_progress'), 'completed' => __('clinic::lang.completed'), 'cancelled' => __('clinic::lang.cancelled'), 'no_show' => __('clinic::lang.no_show')], null, ['class' => 'form-control', 'id' => 'filter_status']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('filter_doctor', __('clinic::lang.filter_by_doctor') . ':'); ?>

                    <?php echo Form::select('filter_doctor', ['' => __('clinic::lang.all')] + $doctors->toArray(), null, ['class' => 'form-control select2', 'id' => 'filter_doctor']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('filter_date_from', __('clinic::lang.date_from') . ':'); ?>

                    <?php echo Form::date('filter_date_from', \Carbon\Carbon::today(), ['class' => 'form-control', 'id' => 'filter_date_from']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('filter_date_to', __('clinic::lang.date_to') . ':'); ?>

                    <?php echo Form::date('filter_date_to', null, ['class' => 'form-control', 'id' => 'filter_date_to']); ?>

                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <?php $__env->slot('tool'); ?>
                <div class="box-tools">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clinic.manage_appointments')): ?>
                        <a class="btn btn-info"
                           href="<?php echo e(action([\Modules\Clinic\Http\Controllers\AppointmentController::class, 'calendar']), false); ?>">
                            <i class="fas fa-calendar-alt me-1"></i><?php echo app('translator')->get('clinic::lang.calendar'); ?>
                        </a>
                        <a class="btn btn-block btn-primary"
                           href="<?php echo e(action([\Modules\Clinic\Http\Controllers\AppointmentController::class, 'create']), false); ?>">
                            <i class="fa fa-plus"></i> <?php echo app('translator')->get('clinic::lang.add_appointment'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php $__env->endSlot(); ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="appointments_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.appointment_ref'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.patient'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.doctor'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.start_datetime'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.appointment_type'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.status'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.action'); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
        <?php echo $__env->renderComponent(); ?>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        var appointments_table = $('#appointments_table').DataTable({
            processing: true,
            serverSide: true,
            fixedHeader: false,
            ajax: {
                url: "<?php echo e(action([\Modules\Clinic\Http\Controllers\AppointmentController::class, 'index']), false); ?>",
                data: function(d) {
                    d.status = $('#filter_status').val();
                    d.doctor_id = $('#filter_doctor').val();
                    d.date_from = $('#filter_date_from').val();
                    d.date_to = $('#filter_date_to').val();
                }
            },
            aaSorting: [[3, 'desc']],
            columns: [
                { data: 'appointment_ref', name: 'clinic_appointments.appointment_ref' },
                { data: 'patient_name', name: 'patient_name', searchable: false },
                { data: 'doctor_name', name: 'doctor_name', searchable: false },
                { data: 'start_datetime', name: 'clinic_appointments.appointment_start' },
                { data: 'appointment_type', name: 'clinic_appointments.type' },
                { data: 'status', name: 'clinic_appointments.status' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        // Filter change handlers
        $('#filter_status, #filter_doctor, #filter_date_from, #filter_date_to').on('change', function() {
            appointments_table.ajax.reload();
        });

        $(document).on('click', 'a.cancel-appointment', function(e) {
            e.preventDefault();
            swal({
                title: LANG.sure,
                text: "<?php echo app('translator')->get('clinic::lang.cancel_appointment'); ?>?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((confirmed) => {
                if (confirmed) {
                    $.ajax({
                        method: 'POST',
                        url: $(this).data('href'),
                        data: { '_token': '<?php echo e(csrf_token(), false); ?>' },
                        success: function(result) {
                            if (result.success) {
                                toastr.success(result.msg);
                                appointments_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
            });
        });

        $(document).on('click', 'a.check-in-appointment', function(e) {
            e.preventDefault();
            $.ajax({
                method: 'POST',
                url: $(this).data('href'),
                data: { '_token': '<?php echo e(csrf_token(), false); ?>' },
                success: function(result) {
                    if (result.success) {
                        toastr.success(result.msg);
                        appointments_table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>