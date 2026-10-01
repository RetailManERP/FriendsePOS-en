

<?php $__env->startSection('title', __('truckmate::lang.vehicles')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('truckmate::vehicle.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <div class="tm-page-header">
        <h1><i class="fas fa-truck" style="color:var(--tm-primary)"></i> <?php echo app('translator')->get('truckmate::lang.vehicles'); ?></h1>
    </div>
</section>
<!-- Main content -->
<section class="content tm-content no-print">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __( 'truckmate::lang.vehicles')]); ?>
    <?php $__env->slot('tool'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('truckmate_vehicle.create')): ?>
    <div class="box-tools">
        <a class="btn btn-inline btn-primary" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\VehicleController::class, 'create']), false); ?>">
            <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?></a>
    </div>
    <?php endif; ?>
    <?php $__env->endSlot(); ?>
    <div class="table-responsive">
<table class="table table-bordered table-striped ajax_view table-hover table-th-skin" id="vehicles_table">
        <thead>
            <tr>
                <th><?php echo app('translator')->get('truckmate::lang.vehicle_name'); ?></th>
                <th><?php echo app('translator')->get('truckmate::lang.vehicle_number'); ?></th>
                <th><?php echo app('translator')->get('truckmate::lang.pmi_brake_date'); ?></th>
                <th><?php echo app('translator')->get('truckmate::lang.mot_date'); ?></th>
                <th><?php echo app('translator')->get('truckmate::lang.road_tax_date'); ?></th>
                <th><?php echo app('translator')->get('truckmate::lang.insurance_date'); ?></th>
                <th><?php echo app('translator')->get('truckmate::lang.calibration_date'); ?></th>
                <th><?php echo app('translator')->get('truckmate::lang.notes'); ?></th>
                <th><?php echo app('translator')->get('messages.action'); ?></th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
    <?php echo $__env->renderComponent(); ?>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            vehicles_table = $("#vehicles_table").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax:{
                        url: '/truckmate/vehicles',
                    },
                    columns:[
                        { data: 'name', name: 'name' },
                        { data: 'number', name: 'number' },
                        { data: 'pmi_brake_date', name: 'pmi_brake_date' },
                        { data: 'mot_date', name: 'mot_date' },
                        { data: 'road_tax_date', name: 'road_tax_date' },
                        { data: 'insurance_date', name: 'insurance_date' },
                        { data: 'calibration_date', name: 'calibration_date' },
                        { data: 'notes', name: 'notes' },
                        { data: 'action', name: 'action' }
                    ],
                    "fnDrawCallback": function (oSettings) {
                        __currency_convert_recursively($('#vehicles_table'));
                    }
            });

            // $(document).on('change', '#location_id, #contact_id, #status_id, #technician',  function() {
            //     pending_vehicles_datatable.ajax.reload();
            //     completed_vehicles_datatable.ajax.reload();
            // });

            $(document).on('click', '#delete_vehicle', function(e) {
                e.preventDefault();
                swal({
                    title: LANG.sure,
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then(willDelete => {
                    if (willDelete) {
                        var href = $(this).attr('data-href');
                        $.ajax({
                            method: 'DELETE',
                            url: href,
                            dataType: 'json',
                            success: function(result) {
                                if (result.success == true) {
                                    toastr.success(result.msg);
                                    vehicles_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                        });
                    }
                });
            });

        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>