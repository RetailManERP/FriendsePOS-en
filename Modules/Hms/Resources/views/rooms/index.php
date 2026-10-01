
<?php $__env->startSection('title', __('hms::lang.rooms')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('hms::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1> <?php echo app('translator')->get('hms::lang.rooms'); ?>
        </h1>
        <p><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('hms::lang.rooms_help_text'); ?> </p>
    </section>

    <!-- Main content -->
    <section class="content">

        <?php $__env->startComponent('components.widget'); ?>
            <div class="box-tools float-end mb-3">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('hms.add_booking')): ?>
                        <a class="btn btn-primary pull-right"
                         href="<?php echo e(action([\Modules\Hms\Http\Controllers\RoomController::class, 'create']), false); ?>">
                            <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
                        </a>
                <?php endif; ?>
            </div>
            <div class="table-responsive" style="min-height: 80vh">
<table class="table table-bordered table-striped table-hover table-th-skin" id="rooms_table">
                <thead>
                    <tr>
                        <th>
                            <?php echo app('translator')->get('hms::lang.type'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('hms::lang.max_no_of_adult'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('hms::lang.max_no_of_child'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('hms::lang.max_occupancy'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('hms::lang.description'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('lang_v1.created_at'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('messages.action'); ?>
                        </th>
                    </tr>
                </thead>
            </table>
</div>
        <?php echo $__env->renderComponent(); ?>

    </section>
    <!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

    <script type="text/javascript">
        $(document).ready(function() {
            superadmin_business_table = $('#rooms_table').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader:false,
                ajax: {
                    url: "<?php echo e(action([\Modules\Hms\Http\Controllers\RoomController::class, 'index']), false); ?>",
                },
                aaSorting: [
                    [5, 'desc']
                ],
                columns: [{
                        data: 'type',
                        name: 'hms_room_types.type'
                    },
                    {
                        data: 'no_of_adult',
                        name: 'hms_room_types.no_of_adult'
                    },
                    {
                        data: 'no_of_child',
                        name: 'hms_room_types.no_of_child'
                    },
                    {
                        data: 'max_occupancy',
                        name: 'hms_room_types.max_occupancy'
                    },
                    {
                        data: 'description',
                        name: 'hms_room_types.description'
                    },
                    {
                        data: 'created_at',
                        name: 'hms_room_types.created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        sorting: false,
                    },
                ]
            });

            $(document).on('click', 'a.delete_room_confirmation', function(e) {
                e.preventDefault();
                swal({
                    title: LANG.sure,
                    text: "Once deleted, you will not be able to recover this Room !",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((confirmed) => {
                    if (confirmed) {
                        window.location.href = $(this).attr('href');
                    }
                });
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>