

<?php $__env->startSection('title', __('truckmate::lang.vehicles_overview')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('truckmate::vehicle.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Main content -->
<section class="content tm-content no-print">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __( 'truckmate::lang.vehicles_overview')]); ?>
    <?php $__env->slot('tool'); ?>
    <div class="box-tools">
         <div class="tm-color-legend" role="group" aria-label="table-color-labels">
            <span class="btn btn-sm bg-info text-white"><i class="fas fa-circle me-1" style="font-size:0.5rem"></i> Future Reminder</span>
            <span class="btn btn-sm bg-warning text-dark"><i class="fas fa-circle me-1" style="font-size:0.5rem"></i> Approaching Expiry</span>
            <span class="btn btn-sm" style="background:#dc3545;color:#fff"><i class="fas fa-circle me-1" style="font-size:0.5rem"></i> Critical</span>
            <span class="btn btn-sm bg-danger text-white"><i class="fas fa-circle me-1" style="font-size:0.5rem"></i> Past Due</span>
        </div>
    </div>
    <?php $__env->endSlot(); ?>
    <div class="table-responsive">
<table class="table table-bordered table-striped ajax_view table-hover table-th-skin" id="vehicles_overview">
        <thead>
            <tr>
                <th><?php echo app('translator')->get('truckmate::lang.vehicle_number'); ?></th>
                <th><?php echo app('translator')->get('truckmate::lang.pmi_date'); ?></th>
                <th><?php echo app('translator')->get('truckmate::lang.brake_date'); ?></th>
                <th><?php echo app('translator')->get('truckmate::lang.mot_date'); ?></th>
                <th><?php echo app('translator')->get('truckmate::lang.road_tax_date'); ?></th>
                <th><?php echo app('translator')->get('truckmate::lang.insurance_date'); ?></th>
                <th><?php echo app('translator')->get('truckmate::lang.calibration_date'); ?></th>
                <th><?php echo app('translator')->get('truckmate::lang.notes'); ?></th>
            </tr>
        </thead>
        <tbody>
            
            <?php $__empty_18 = true; $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
            <tr>
                <td><?php echo e($v['number'], false); ?></td>
                <td class="<?php echo e($v['pmi_test_class'], false); ?>"><?php echo e($v['pmi_test'], false); ?></td>
                <td class="<?php echo e($v['brake_test_class'], false); ?>"><?php echo e($v['brake_test'], false); ?></td>
                <td class="<?php echo e($v['mot_class'], false); ?>"><?php echo e($v['mot_date'], false); ?></td>
                <td class="<?php echo e($v['road_tax_class'], false); ?>"><?php echo e($v['road_tax_date'], false); ?></td>
                <td class="<?php echo e($v['insurance_class'], false); ?>"><?php echo e($v['insurance_date'], false); ?></td>
                <td class="<?php echo e($v['calibration_class'], false); ?>"><?php echo e($v['calibration_date'], false); ?></td>
                <td><?php echo e($v['notes'], false); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
            <tr>
                <td colspan="8">No Vehicles Found</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
    <?php echo $__env->renderComponent(); ?>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            // vehicles_overview = $("#vehicles_overview").DataTable({
            //         processing: true,
            //         serverSide: true,
            //         searchable: false,
            //         dom: 'r',
            //         ajax:{
            //             url: '/truckmate/vehicle-dashboard',
            //         },
            //         columns:[
            //             { data: 'number', name: 'number' },
            //             { data: 'pmi_date', name: 'pmi_brake_date' },
            //             { data: 'brake_test_date', name: 'pmi_brake_date' },
            //             { data: 'mot_date', name: 'mot_date' },
            //             { data: 'road_tax_date', name: 'road_tax_date' },
            //             { data: 'insurance_date', name: 'insurance_date' },
            //             { data: 'calibration_date', name: 'calibration_date' },
            //             { data: 'notes', name: 'notes' },
            //         ],
            //         "fnDrawCallback": function (oSettings) {
            //             __currency_convert_recursively($('#vehicles_table'));
            //         }
            // });

        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>