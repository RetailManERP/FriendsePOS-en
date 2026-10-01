
<?php $__env->startSection('title', __('clinic::lang.prescription_details')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 >
            <i class="fas fa-prescription me-2"></i><?php echo e($prescription->prescription_ref, false); ?>

        </h1>
    </section>

    <section class="content">
        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.prescription_details')]); ?>
            <div class="row">
                <div class="col-md-6">
                    <table class="table no-margin">
                        <tr><th><?php echo app('translator')->get('clinic::lang.prescription_ref'); ?></th><td><?php echo e($prescription->prescription_ref, false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.patient'); ?></th><td><?php echo e($prescription->patient->first_name ?? '', false); ?> <?php echo e($prescription->patient->last_name ?? '', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.doctor'); ?></th><td><?php echo app('translator')->get('clinic::lang.dr'); ?> <?php echo e($prescription->doctor->first_name ?? '', false); ?> <?php echo e($prescription->doctor->last_name ?? '', false); ?></td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table no-margin">
                        <tr><th><?php echo app('translator')->get('clinic::lang.status'); ?></th><td>
                            <?php
                                $rxStatusColors = ['prescribed' => 'bg-primary', 'dispensed' => 'bg-success', 'partially_dispensed' => 'bg-warning', 'cancelled' => 'bg-danger'];
                            ?>
                            <span class="badge <?php echo e($rxStatusColors[$prescription->status] ?? 'bg-secondary', false); ?>"><?php echo e(ucfirst(str_replace('_', ' ', $prescription->status)), false); ?></span>
                        </td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.created_at'); ?></th><td><?php echo e($prescription->created_at->format('d/m/Y h:i A'), false); ?></td></tr>
                        <?php if($prescription->notes): ?><tr><th><?php echo app('translator')->get('clinic::lang.notes'); ?></th><td><?php echo e($prescription->notes, false); ?></td></tr><?php endif; ?>
                    </table>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.prescriptions')]); ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo app('translator')->get('clinic::lang.medicine_name'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.dosage'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.frequency'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.duration'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.route'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.quantity'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.instructions'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.dispensed'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $prescription->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($i + 1, false); ?></td>
                                <td><?php echo e($item->medicine_name, false); ?>

                                    <?php if($item->product): ?><br><small class="text-muted">(<?php echo e($item->product->name, false); ?>)</small><?php endif; ?>
                                </td>
                                <td><?php echo e($item->dosage, false); ?></td>
                                <td><?php echo e($item->frequency, false); ?></td>
                                <td><?php echo e($item->duration, false); ?> days</td>
                                <td><?php echo e(ucfirst($item->route), false); ?></td>
                                <td><?php echo e($item->quantity ?? '-', false); ?></td>
                                <td><?php echo e($item->instructions ?? '-', false); ?></td>
                                <td><?php echo $item->is_dispensed ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>'; ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php echo $__env->renderComponent(); ?>

        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\PrescriptionController::class, 'index']), false); ?>"
                   class="btn btn-default">
                    <i class="fas fa-arrow-left me-1"></i><?php echo app('translator')->get('clinic::lang.back'); ?>
                </a>
                <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\PrescriptionController::class, 'print'], $prescription->id), false); ?>"
                   class="btn btn-info" target="_blank">
                    <i class="fas fa-print me-1"></i><?php echo app('translator')->get('clinic::lang.print_prescription'); ?>
                </a>
                <?php if($prescription->status !== 'dispensed'): ?>
                    <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\PrescriptionController::class, 'dispense'], $prescription->id), false); ?>"
                       class="btn btn-success dispense_btn">
                        <i class="fas fa-pills me-1"></i><?php echo app('translator')->get('clinic::lang.dispense'); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).on('click', '.dispense_btn', function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        swal({
            title: LANG.sure,
            text: "<?php echo app('translator')->get('clinic::lang.dispense'); ?> all items?",
            icon: "info",
            buttons: true,
        }).then((confirmed) => {
            if (confirmed) {
                $.ajax({
                    method: 'POST',
                    url: href,
                    data: { '_token': '<?php echo e(csrf_token(), false); ?>' },
                    success: function(result) {
                        if (result.success) {
                            toastr.success(result.msg);
                            location.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>