

<?php $__env->startSection('title', __('truckmate::lang.future_pmi')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('truckmate::vehicle.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Main content -->
<section class="content tm-content no-print">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __( 'truckmate::lang.future_pmi')]); ?>
    <div class="table-responsive">
<table class="table table-bordered table-striped ajax_view table-hover table-th-skin" id="future_pmi">
        
        <thead>
            <tr>
                <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v => $dates): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th><?php echo e($v, false); ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        </thead>
        <tbody>
            <?php for($week = 0; $week <= 15; $week++): ?>
                <tr>
                    <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v => $dates): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td><?php echo e($dates[$week] ?? '', false); ?></td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            <?php endfor; ?>
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