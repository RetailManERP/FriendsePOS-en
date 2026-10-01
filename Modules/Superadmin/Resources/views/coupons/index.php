
<?php $__env->startSection('title', __('superadmin::lang.superadmin') . ' | Coupons'); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('superadmin::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php echo app('translator')->get('superadmin::lang.all_coupon'); ?>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">&nbsp;</h3>
                <div class="box-tools">
                    <a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\CouponController::class, 'create']), false); ?>"
                        class="btn btn-block btn-primary">
                        <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?></a>
                </div>
            </div>
            <div class="box-body">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin')): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover table-th-skin" id="superadmin_Coupons_table">
                            <thead>
                                <tr>
                                    <th>
                                        <?php echo app('translator')->get('superadmin::lang.coupon_code'); ?>
                                    </th>
                                    <th>
                                        <?php echo app('translator')->get('superadmin::lang.discount_type'); ?>
                                    </th>
                                    <th>
                                        <?php echo app('translator')->get('superadmin::lang.discount'); ?>
                                    </th>
                                    <th>
                                        <?php echo app('translator')->get('superadmin::lang.expiry_date'); ?>
                                    </th>
                                    <th>
                                        <?php echo app('translator')->get('superadmin::lang.applied_on_packages'); ?>
                                    </th>
                                    <th>
                                        <?php echo app('translator')->get('superadmin::lang.applied_on_business'); ?>
                                    </th>
                                    <th>
                                        <?php echo app('translator')->get('superadmin::lang.status'); ?>
                                    </th>
                                    <th>
                                        <?php echo app('translator')->get('superadmin::lang.created_at'); ?>
                                    </th>
                                    <th>
                                        <?php echo app('translator')->get('superadmin::lang.action'); ?>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </section>
    <!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

    <script type="text/javascript">
        $(document).ready(function() {
            superadmin_business_table = $('#superadmin_Coupons_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "<?php echo e(action([\Modules\Superadmin\Http\Controllers\CouponController::class, 'index']), false); ?>",
                },
                aaSorting: [
                    [6, 'desc']
                ],
                columns: [{
                        data: 'coupon_code',
                        name: 'coupons.coupon_code'
                    },
                    {
                        data: 'discount_type',
                        name: 'coupons.discount_type'
                    },
                    {
                        data: 'discount',
                        name: 'coupons.discount'
                    },
                    {
                        data: 'expiry_date',
                        name: 'coupons.expiry_date'
                    },
                    {
                        data: 'applied_on_packages',
                        name: 'coupons.applied_on_packages'
                    },
                    {
                        data: 'applied_on_business',
                        name: 'coupons.applied_on_business'
                    },
                    {
                        data: 'is_active',
                        name: 'coupons.is_active'
                    },
                    {
                        data: 'created_at',
                        name: 'coupons.created_at'
                    },
                    {
                        data: 'action',
                        name: 'coupons.action'
                    },
                ]
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