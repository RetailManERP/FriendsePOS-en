
<?php $__env->startSection('title', __('gym::lang.classes')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('gym::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black"> <?php echo app('translator')->get('gym::lang.classes'); ?>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <?php $__env->startComponent('components.widget'); ?>
            <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <a class="btn btn-primary pull-right btn-modal-class"
                    href="<?php echo e(action([\Modules\Gym\Http\Controllers\ClassController::class, 'create']), false); ?>">
                     <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
                </a>
            </div>
            <?php $__env->endSlot(); ?>
            <div class="table-responsive">
<table class="table table-bordered table-striped" id="class_table">
                <thead>
                    <tr>
                        <th>
                            <?php echo app('translator')->get('gym::lang.name'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('gym::lang.start_time'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('gym::lang.end_time'); ?>
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

        <!-- Add HMS Extra Modal -->
        <div class="modal fade view_modal_class" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
        </div>

    </section>
    <!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

    <script type="text/javascript">
        $(document).ready(function() {
            class_table = $('#class_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "<?php echo e(action([\Modules\Gym\Http\Controllers\ClassController::class, 'index']), false); ?>",
                },
                aaSorting: [
                    [3, 'desc']
                ],
                columns: [{
                        data: 'name',
                        name: 'gym_classes.name'
                    },
                    {
                        data: 'start_time',
                        name: 'gym_classes.start_time'
                    },
                    {
                        data: 'end_time',
                        name: 'gym_classes.end_time'
                    },
                    {
                        data: 'created_at',
                        name: 'gym_classes.created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        sorting: false,
                    }
                ],
            });

            $(document).on('shown.bs.modal', '.view_modal_class', function(e) {
                $('.time_picker').datetimepicker({
                    format: moment_time_format,
                    ignoreReadonly: true,
                });

                $('#add_class').validate();
            });

            $(document).on('click', '.btn-modal-class', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('href'),
                    dataType: 'html',
                    success: function(result) {
                        $('.view_modal_class')
                            .html(result)
                            .modal('show');
                    },
                });
            });

            $(document).on('click', 'a.delete_class_confirmation', function(e) {
                e.preventDefault();
                swal({
                    title: LANG.sure,
                    text: "<?php echo e(__('gym::lang.delete_alert'), false); ?>",
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