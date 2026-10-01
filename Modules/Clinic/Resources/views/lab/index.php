
<?php $__env->startSection('title', __('clinic::lang.lab_orders')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 >
            <i class="fas fa-flask me-2"></i><?php echo app('translator')->get('clinic::lang.lab_orders'); ?>
        </h1>
        <p><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('clinic::lang.manage_lab_help'); ?></p>
    </section>

    <section class="content">
        <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <?php $__env->slot('tool'); ?>
                <div class="box-tools">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clinic.manage_lab')): ?>
                        <a class="btn btn-warning"
                           href="<?php echo e(action([\Modules\Clinic\Http\Controllers\LabController::class, 'tests']), false); ?>">
                            <i class="fas fa-vials me-1"></i><?php echo app('translator')->get('clinic::lang.lab_test_catalog'); ?>
                        </a>
                        <a class="btn btn-block btn-primary"
                           href="<?php echo e(action([\Modules\Clinic\Http\Controllers\LabController::class, 'create']), false); ?>">
                            <i class="fa fa-plus"></i> <?php echo app('translator')->get('clinic::lang.add_lab_order'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php $__env->endSlot(); ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="lab_orders_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.lab_order_ref'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.patient'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.doctor'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.test_name'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.status'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.result'); ?></th>
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
        var lab_table = $('#lab_orders_table').DataTable({
            processing: true,
            serverSide: true,
            fixedHeader: false,
            ajax: {
                url: "<?php echo e(action([\Modules\Clinic\Http\Controllers\LabController::class, 'index']), false); ?>",
            },
            aaSorting: [[6, 'desc']],
            columns: [
                { data: 'order_ref', name: 'clinic_lab_orders.order_ref' },
                { data: 'patient_name', name: 'patient_name', searchable: false },
                { data: 'doctor_name', name: 'doctor_name', searchable: false },
                { data: 'test_name', name: 'test_name', searchable: false },
                { data: 'status', name: 'clinic_lab_orders.status' },
                { data: 'result_value', name: 'clinic_lab_orders.result_status' },
                { data: 'created_at', name: 'clinic_lab_orders.created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>