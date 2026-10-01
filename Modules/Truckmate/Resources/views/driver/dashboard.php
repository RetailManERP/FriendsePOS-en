

<?php $__env->startSection('title', __('truckmate::lang.driver_dashboard')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('truckmate::driver.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Main content -->
<section class="content tm-content no-print">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __( 'truckmate::lang.driver_dashboard')]); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('truckmate_driver.dashboard')): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-th-skin" id="drivers_table">
                    <thead>
                        <tr>
                            <th class="col-md-2"><?php echo app('translator')->get( 'user.name' ); ?></th>
                            <th class="col-md-1"><?php echo app('translator')->get( 'truckmate::lang.truckmate_license_expiry' ); ?></th>
                            <th class="col-md-1"><?php echo app('translator')->get( 'truckmate::lang.truckmate_tacograph_expiry' ); ?></th>
                            <th class="col-md-1"><?php echo app('translator')->get( 'truckmate::lang.truckmate_cpc_expiry' ); ?></th>
                            <th class="col-md-2"><?php echo app('translator')->get( 'truckmate::lang.driver_company' ); ?></th>
                            <th class="col-md-2"><?php echo app('translator')->get( 'business.address' ); ?></th>
                            <th><?php echo app('translator')->get( 'truckmate::lang.truckmate_day_rate' ); ?></th>
                            <th><?php echo app('translator')->get( 'truckmate::lang.truckmate_night_rate' ); ?></th>
                            <th><?php echo app('translator')->get( 'truckmate::lang.truckmate_sat_rate' ); ?></th>
                            <th><?php echo app('translator')->get( 'truckmate::lang.truckmate_sun_rate' ); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
             var users_table = $('#drivers_table').DataTable({
                    processing: true,
                    serverSide: true,
                    "ajax": {
                        "url": "/truckmate/drivers",
                    },
                    columnDefs: [ {
                        // "targets": [4],
                        "orderable": false,
                        "searchable": false
                    } ],
                    "columns":[
                        {"data":"full_name"},
                        {"data":"truckmate_license_expiry"},
                        {"data":"truckmate_tacograph_expiry"},
                        {"data":"truckmate_cpc_expiry"},
                        {"data":"driver_company"},
                        {"data":"driver_address"},
                        {"data":"truckmate_day_rate"},
                        {"data":"truckmate_night_rate"},
                        {"data":"truckmate_sat_rate"},
                        {"data":"truckmate_sun_rate"},
                    ]
                });

        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>