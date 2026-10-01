
<?php $__env->startSection('title', __('clinic::lang.prescriptions')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 >
            <i class="fas fa-prescription me-2"></i><?php echo app('translator')->get('clinic::lang.prescriptions'); ?>
        </h1>
        <p><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('clinic::lang.manage_prescriptions_help'); ?></p>
    </section>

    <section class="content">
        <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <?php $__env->slot('tool'); ?>
                <div class="box-tools">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clinic.manage_prescriptions')): ?>
                        <a class="btn btn-block btn-primary"
                           href="<?php echo e(action([\Modules\Clinic\Http\Controllers\PrescriptionController::class, 'create']), false); ?>">
                            <i class="fa fa-plus"></i> <?php echo app('translator')->get('clinic::lang.add_prescription'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php $__env->endSlot(); ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="prescriptions_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.prescription_ref'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.patient'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.doctor'); ?></th>
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
        var prescriptions_table = $('#prescriptions_table').DataTable({
            processing: true,
            serverSide: true,
            fixedHeader: false,
            ajax: {
                url: "<?php echo e(action([\Modules\Clinic\Http\Controllers\PrescriptionController::class, 'index']), false); ?>",
            },
            aaSorting: [[4, 'desc']],
            columns: [
                { data: 'prescription_ref', name: 'clinic_prescriptions.prescription_ref' },
                { data: 'patient_name', name: 'patient_name', searchable: false },
                { data: 'doctor_name', name: 'doctor_name', searchable: false },
                { data: 'status', name: 'clinic_prescriptions.status' },
                { data: 'created_at', name: 'clinic_prescriptions.created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>