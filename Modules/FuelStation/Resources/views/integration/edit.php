
<?php $__env->startSection('title', __('fuelstation::lang.edit_integration')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('fuelstation::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header"><h1><?php echo app('translator')->get('fuelstation::lang.edit_integration'); ?> — <?php echo e(optional($integration->dispenser)->name, false); ?></h1></section>

<section class="content">
    <?php echo Form::open(['url' => action([\Modules\FuelStation\Http\Controllers\FuelIntegrationController::class, 'update'], [$integration->id]), 'method' => 'PUT']); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('fuelstation::lang.edit_integration')]); ?>
        <?php echo $__env->make('fuelstation::integration._form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php $__env->slot('footer'); ?>
            <button type="submit" class="btn btn-primary pull-right"><?php echo app('translator')->get('fuelstation::lang.save'); ?></button>
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <?php echo Form::close(); ?>


    <?php $__env->startComponent('components.widget', ['class' => 'box-solid', 'title' => __('fuelstation::lang.integration_logs')]); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('fuelstation::lang.date'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.direction'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.status'); ?></th>
                        <th><?php echo app('translator')->get('fuelstation::lang.message'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_18 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                    <tr>
                        <td><?php echo e($log->created_at->format('d-m-Y H:i:s'), false); ?></td>
                        <td><?php echo e(ucfirst($log->direction), false); ?></td>
                        <td>
                            <span class="label <?php echo e($log->status == 'success' ? 'bg-success' : 'bg-danger', false); ?>"><?php echo e(ucfirst($log->status), false); ?></span>
                        </td>
                        <td><?php echo e($log->message, false); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                    <tr><td colspan="4" class="text-center text-muted"><?php echo app('translator')->get('fuelstation::lang.no_records'); ?></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(function () {
    function toggleFields() {
        var p = $('#protocol').val();
        $('#tcp_fields, #serial_fields, #api_fields').hide();
        if (p === 'tcp_ip') { $('#tcp_fields').show(); }
        else if (p === 'serial' || p === 'rs232') { $('#serial_fields').show(); }
        else if (p === 'api') { $('#api_fields').show(); }
    }
    $('#protocol').change(toggleFields);
    toggleFields();
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>