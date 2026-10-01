
<?php $__env->startSection('title', __('clinic::lang.consultations')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 >
            <i class="fas fa-stethoscope me-2"></i><?php echo app('translator')->get('clinic::lang.consultations'); ?>
        </h1>
        <p><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('clinic::lang.manage_consultations_help'); ?></p>
    </section>

    <section class="content">
        <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <?php $__env->slot('tool'); ?>
                <div class="box-tools">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clinic.manage_consultations')): ?>
                        <a class="btn btn-block btn-primary"
                           href="<?php echo e(action([\Modules\Clinic\Http\Controllers\ConsultationController::class, 'create']), false); ?>">
                            <i class="fa fa-plus"></i> <?php echo app('translator')->get('clinic::lang.add_consultation'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php $__env->endSlot(); ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="consultations_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.consultation_ref'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.patient'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.doctor'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.chief_complaint'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.consultation_fee'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.status'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.created_at'); ?></th>
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
        var consultations_table = $('#consultations_table').DataTable({
            processing: true,
            serverSide: true,
            fixedHeader: false,
            ajax: {
                url: "<?php echo e(action([\Modules\Clinic\Http\Controllers\ConsultationController::class, 'index']), false); ?>",
            },
            aaSorting: [[6, 'desc']],
            columns: [
                { data: 'consultation_ref', name: 'clinic_consultations.consultation_ref' },
                { data: 'patient_name', name: 'patient_name', searchable: false },
                { data: 'doctor_name', name: 'doctor_name', searchable: false },
                { data: 'chief_complaint', name: 'clinic_consultations.chief_complaint' },
                { data: 'consultation_fee', name: 'clinic_consultations.consultation_fee' },
                { data: 'status', name: 'clinic_consultations.status' },
                { data: 'created_at', name: 'clinic_consultations.created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>