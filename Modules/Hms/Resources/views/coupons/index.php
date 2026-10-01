
<?php $__env->startSection('title', __('hms::lang.coupons')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('hms::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1> <?php echo app('translator')->get('hms::lang.coupons'); ?>
        </h1>
        <p><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('hms::lang.coupon_help_text'); ?> </p>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php $__env->startComponent('components.widget'); ?>
            <div class="box-tools float-end mb-3">
                <a class="btn btn-primary pull-right btn-modal-coupon"
                    href="<?php echo e(action([\Modules\Hms\Http\Controllers\HmsCouponController::class, 'create']), false); ?>">
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
                </a>
            </div>
            <div class="table-responsive" style="min-height: 80vh">
<table class="table table-bordered table-striped table-hover table-th-skin" id="extras_table">
                <thead>
                    <tr>
                        <th>
                            <?php echo app('translator')->get('hms::lang.type'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('hms::lang.coupon_code'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('hms::lang.date_from'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('hms::lang.date_to'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('hms::lang.discount'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('hms::lang.discount_type'); ?>
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
    <div class="modal fade view_modal_coupon" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

    <script type="text/javascript">
        $(document).ready(function() {
            superadmin_business_table = $('#extras_table').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader:false,
                ajax: {
                    url: "<?php echo e(action([\Modules\Hms\Http\Controllers\HmsCouponController::class, 'index']), false); ?>",
                },
                aaSorting: [
                    [6, 'desc']
                ],
                columns: [{
                        data: 'type',
                        name: 'type.type'
                    },
                    {
                        data: 'coupon_code',
                        name: 'coupon_code'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
                    },
                    {
                        data: 'end_date',
                        name: 'end_date'
                    },
                    {
                        data: 'discount',
                        name: 'discount'
                    },
                    {
                        data: 'discount_type',
                        name: 'discount_type'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        sorting: false,
                    }
                ],
            });

            $(document).on('click', '.btn-modal-coupon', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('href'),
                    dataType: 'html',
                    success: function(result) {
                        $('.view_modal_coupon')
                            .html(result)
                            .modal('show');

                        var currentDate = new Date();
                        var currentDateTime = moment(currentDate);

                        $('.view_modal_coupon .date_picker').datetimepicker({
                            format: moment_date_format,
                            ignoreReadonly: true,
                            defaultDate: currentDateTime
                        });
                    },
                });
            });

            $(document).on('click', 'a.delete_coupon_confirmation', function(e) {
                e.preventDefault();
                swal({
                    title: LANG.sure,
                    text: "Once deleted, you will not be able to recover this Coupon !",
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