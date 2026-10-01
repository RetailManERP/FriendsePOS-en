
<?php $__env->startSection('title', __('clinic::lang.doctors')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 >
            <i class="fas fa-user-md me-2"></i><?php echo app('translator')->get('clinic::lang.doctors'); ?>
        </h1>
        <p><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('clinic::lang.manage_doctors_help'); ?></p>
    </section>

    <section class="content">
        <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <?php $__env->slot('tool'); ?>
                <div class="box-tools">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clinic.manage_doctors')): ?>
                        <a class="btn btn-block btn-primary"
                           href="<?php echo e(action([\Modules\Clinic\Http\Controllers\DoctorController::class, 'create']), false); ?>">
                            <i class="fa fa-plus"></i> <?php echo app('translator')->get('clinic::lang.add_doctor'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php $__env->endSlot(); ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="doctors_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.name'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.specialization'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.qualification'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.license_number'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.consultation_fee'); ?></th>
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
        var doctors_table = $('#doctors_table').DataTable({
            processing: true,
            serverSide: true,
            fixedHeader: false,
            ajax: {
                url: "<?php echo e(action([\Modules\Clinic\Http\Controllers\DoctorController::class, 'index']), false); ?>",
            },
            aaSorting: [[0, 'asc']],
            columns: [
                { data: 'full_name', name: 'full_name', searchable: false },
                { data: 'specialization', name: 'clinic_specializations.name' },
                { data: 'qualification', name: 'clinic_doctors.qualifications' },
                { data: 'license_number', name: 'clinic_doctors.license_number' },
                { data: 'consultation_fee', name: 'clinic_doctors.consultation_fee' },
                { data: 'status', name: 'clinic_doctors.status' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        $(document).on('click', 'a.delete-doctor', function(e) {
            e.preventDefault();
            swal({
                title: LANG.sure,
                text: "<?php echo app('translator')->get('clinic::lang.delete_confirm'); ?>",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((confirmed) => {
                if (confirmed) {
                    var href = $(this).data('href');
                    $.ajax({
                        method: 'DELETE',
                        url: href,
                        data: { '_token': '<?php echo e(csrf_token(), false); ?>' },
                        success: function(result) {
                            if (result.success) {
                                toastr.success(result.msg);
                                doctors_table.ajax.reload();
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