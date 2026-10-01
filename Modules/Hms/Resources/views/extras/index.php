
<?php $__env->startSection('title', __('hms::lang.extras')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('hms::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1> <?php echo app('translator')->get('hms::lang.extras'); ?>
        </h1>
        <p><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('hms::lang.extra_help_text'); ?> </p>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php $__env->startComponent('components.widget'); ?>
                <a class="btn btn-primary pull-right btn-modal-extra"
                    href="<?php echo e(action([\Modules\Hms\Http\Controllers\ExtraController::class, 'create']), false); ?>">
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
                </a>
            </div>
            <div class="table-responsive" style="min-height: 80vh">
<table class="table table-bordered table-striped table-hover table-th-skin" id="extras_table">
                <thead>
                    <tr>
                        <th>
                            <?php echo app('translator')->get('hms::lang.name'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('hms::lang.price'); ?>
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
    <div class="modal fade view_modal_extra" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

    <script type="text/javascript">
        $(document).ready(function() {
            superadmin_business_table = $('#extras_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "<?php echo e(action([\Modules\Hms\Http\Controllers\ExtraController::class, 'index']), false); ?>",
                },
                aaSorting: [
                    [2, 'desc']
                ],
                columns: [{
                        data: 'name',
                        name: 'hms_extras.name'
                    },
                    {
                        data: 'price',
                        name: 'hms_extras.price'
                    },
                    {
                        data: 'created_at',
                        name: 'hms_extras.created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        sorting: false,
                    }
                ],
            });

            $(document).on('click', '.btn-modal-extra', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('href'),
                    dataType: 'html',
                    success: function(result) {
                        $('.view_modal_extra')
                            .html(result)
                            .modal('show');
                    },
                });
            });

            $(document).on('click', 'a.delete_extra_confirmation', function(e) {
                e.preventDefault();
                swal({
                    title: LANG.sure,
                    text: "Once deleted, you will not be able to recover this Extra !",
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