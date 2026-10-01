
<?php $__env->startSection('title', __('clinic::lang.patients')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 >
            <i class="fas fa-user-injured me-2"></i><?php echo app('translator')->get('clinic::lang.patients'); ?>
        </h1>
        <p><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('clinic::lang.manage_patients_help'); ?></p>
    </section>

    <section class="content">
        <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <?php $__env->slot('tool'); ?>
                <div class="box-tools">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clinic.manage_patients')): ?>
                        <a class="btn btn-block btn-primary"
                           href="<?php echo e(action([\Modules\Clinic\Http\Controllers\PatientController::class, 'create']), false); ?>">
                            <i class="fa fa-plus"></i> <?php echo app('translator')->get('clinic::lang.add_patient'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php $__env->endSlot(); ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="patients_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.patient_id'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.name'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.gender'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.age'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.phone'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.blood_group'); ?></th>
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
        var patients_table = $('#patients_table').DataTable({
            processing: true,
            serverSide: true,
            fixedHeader: false,
            ajax: {
                url: "<?php echo e(action([\Modules\Clinic\Http\Controllers\PatientController::class, 'index']), false); ?>",
            },
            aaSorting: [[6, 'desc']],
            columns: [
                { data: 'patient_id_number', name: 'clinic_patients.patient_id_number' },
                { data: 'full_name', name: 'full_name', searchable: false },
                { data: 'gender', name: 'clinic_patients.gender' },
                { data: 'date_of_birth', name: 'clinic_patients.date_of_birth' },
                { data: 'phone', name: 'clinic_patients.phone' },
                { data: 'blood_group', name: 'clinic_patients.blood_group' },
                { data: 'created_at', name: 'clinic_patients.created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        $(document).on('click', 'a.delete-patient', function(e) {
            e.preventDefault();
            swal({
                title: LANG.sure,
                text: "<?php echo app('translator')->get('clinic::lang.delete_confirm'); ?>",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((confirmed) => {
                if (confirmed) {
                    var href = $(this).attr('href');
                    $.ajax({
                        method: 'DELETE',
                        url: href,
                        data: { '_token': '<?php echo e(csrf_token(), false); ?>' },
                        success: function(result) {
                            if (result.success) {
                                toastr.success(result.msg);
                                patients_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>