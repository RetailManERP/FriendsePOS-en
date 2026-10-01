
<?php $__env->startSection('title', __('hms::lang.unavailable')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('hms::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1> <?php echo app('translator')->get('hms::lang.unavailable'); ?>
        </h1>
        <p><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('hms::lang.unavailable_help_text'); ?> </p>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php $__env->startComponent('components.widget'); ?>
            <div class="box-tools float-end mb-3">
                <a class="btn btn-primary pull-right btn-modal-unavailable"
                    href="<?php echo e(action([\Modules\Hms\Http\Controllers\UnavailableController::class, 'create']), false); ?>">
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
                </a>
            </div>
            <div class="table-responsive" style="min-height: 80vh">
<table class="table table-bordered table-striped table-hover table-th-skin" id="unavailable_table">
                <thead>
                    <tr>
                        <th>
                            <?php echo app('translator')->get('hms::lang.room_no'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('hms::lang.date_from'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('hms::lang.date_to'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('hms::lang.unavailable_type'); ?>
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


        </div>

    </section>
    <!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modals'); ?>
    <div class="modal fade view_modal_unavailable" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

    <script type="text/javascript">
        $(document).ready(function() {
            superadmin_business_table = $('#unavailable_table').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader:false,
                ajax: {
                    url: "<?php echo e(action([\Modules\Hms\Http\Controllers\UnavailableController::class, 'index']), false); ?>",
                },
                columns: [{
                        data: 'room_number',
                        name: 'room.room_number'
                    },
                    {
                        data: 'date_from',
                        name: 'hms_room_unavailables.date_from',
                    },
                    {
                        data: 'date_to',
                        name: 'hms_room_unavailables.date_to',
                    },
                    {
                        data: 'unavailable_type',
                        name: 'hms_room_unavailables.unavailable_type',
                    },
                    {
                        data: 'created_at',
                        name: 'hms_room_unavailables.created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        sorting: false,
                    }
                ],
            });

            $(document).on('click', '.btn-modal-unavailable', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('href'),
                    dataType: 'html',
                    success: function(result) {
                        $('.view_modal_unavailable')
                            .html(result)
                            .modal('show');

                        $('.view_modal_unavailable .select2').select2({
                            dropdownParent: $('.view_modal_unavailable')
                        });
                        $('.view_modal_unavailable .select2-container').css('width', '100%');
                        $('.view_modal_unavailable #date_from').datepicker({
                            autoclose: true,
                            container: '.view_modal_unavailable',
                        });
                        $('.view_modal_unavailable #date_to').datepicker({
                            autoclose: true,
                            container: '.view_modal_unavailable',
                        });
                    },
                });
            });


            $(document).on('click', 'a.delete_unavailable_confirmation', function(e) {
                e.preventDefault();
                swal({
                    title: LANG.sure,
                    text: "Once deleted, you will not be able to recover this Unavailable !",
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