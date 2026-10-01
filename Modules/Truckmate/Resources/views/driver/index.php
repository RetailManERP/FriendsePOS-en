
<?php $__env->startSection('title', __( 'truckmate::lang.drivers' )); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('truckmate::driver.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <div class="tm-page-header">
        <h1><i class="fas fa-id-card" style="color:var(--tm-primary)"></i> <?php echo app('translator')->get('truckmate::lang.drivers_list'); ?></h1>
    </div>
</section>

<!-- Main content -->
<section class="content tm-content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __( 'truckmate::lang.drivers_list' )]); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user.create')): ?>
            <?php $__env->slot('tool'); ?>
                <div class="box-tools">
                    <a class="btn btn-block btn-primary" 
                    href="<?php echo e(action([\App\Http\Controllers\ManageUserController::class, 'create']), false); ?>?type=truckmate" >
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></a>
                 </div>
            <?php $__env->endSlot(); ?>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('truckmate_driver.view_all')): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-th-skin" id="users_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get( 'user.name' ); ?></th>
                            <th><?php echo app('translator')->get( 'user.role' ); ?></th>
                            <th><?php echo app('translator')->get( 'truckmate::lang.driver_company' ); ?></th>
                            <th><?php echo app('translator')->get( 'truckmate::lang.truckmate_day_rate' ); ?></th>
                            <th><?php echo app('translator')->get( 'truckmate::lang.truckmate_night_rate' ); ?></th>
                            <th><?php echo app('translator')->get( 'truckmate::lang.truckmate_sat_rate' ); ?></th>
                            <th><?php echo app('translator')->get( 'truckmate::lang.truckmate_sun_rate' ); ?></th>
                            <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="modal fade user_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    //Roles table
    $(document).ready( function(){
        var users_table = $('#users_table').DataTable({
                    processing: true,
                    serverSide: true,
                    "ajax": {
                        "url": "/truckmate/drivers",
                        "data": function(d) {
                        d.show_deleted = $('#show_deleted').is(':checked');
                    }},
                    columnDefs: [ {
                        // "targets": [4],
                        "orderable": false,
                        "searchable": false
                    } ],
                    "columns":[
                        {"data":"full_name"},
                        {"data":"role"},
                        {"data":"driver_company"},
                        {"data":"truckmate_day_rate"},
                        {"data":"truckmate_night_rate"},
                        {"data":"truckmate_sat_rate"},
                        {"data":"truckmate_sun_rate"},
                        {"data":"action"}
                    ]
                });
        $(document).on('click', 'button.delete_user_button', function(){
            swal({
              title: LANG.sure,
              text: LANG.confirm_delete_user,
              icon: "warning",
              buttons: true,
              dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    var href = $(this).data('href');
                    var data = $(this).serialize();
                    $.ajax({
                        method: "DELETE",
                        url: href,
                        dataType: "json",
                        data: data,
                        success: function(result){
                            if(result.success == true){
                                toastr.success(result.msg);
                                users_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
             });
        });
        $(document).on('click', 'button.restore_user_button', function(){
            swal({
              title: LANG.sure,
              icon: "info",
              buttons: true,
            }).then((willRestore) => {
                if (willRestore) {
                    var href = $(this).data('href');
                    var data = $(this).serialize();
                    $.ajax({
                        method: "GET",
                        url: href,
                        dataType: "json",
                        data: data,
                        success: function(result){
                            if(result.success == true){
                                toastr.success(result.msg);
                                users_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
             });
        });
        $(document).on('change', 'input#show_deleted', function(e) {
            users_table.ajax.reload();
        });
        
    });
    
    
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>