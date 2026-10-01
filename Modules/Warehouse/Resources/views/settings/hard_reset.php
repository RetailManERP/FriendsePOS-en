
<?php $__env->startSection('title', __('warehouse::lang.hard_reset_options')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('warehouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><i class="fa fa-refresh"></i> <?php echo app('translator')->get('warehouse::lang.hard_reset_options'); ?></h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-danger', 'title' => __('warehouse::lang.hard_reset_options')]); ?>
        <div class="alert alert-warning">
            <?php echo app('translator')->get('warehouse::lang.hard_reset_warning'); ?>
        </div>

        <?php echo Form::open(['route' => 'warehouse.hard-reset.reset', 'method' => 'POST', 'id' => 'warehouse_reset_data_form']); ?>

            <div class="row">
                <div class="col-md-12 check_group mb-3">
                    <div class="row align-items-center">
                        <div class="col-md-8 mb-2">
                            <strong><?php echo app('translator')->get('warehouse::lang.transactions_hard_delete'); ?></strong>
                        </div>
                        <div class="col-md-4 mb-2 text-right">
                            <label class="form-check-label fw-bold">
                                <input type="checkbox" class="check_all"> <?php echo e(__('role.select_all'), false); ?>

                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[warehouse_transactions]" type="checkbox" value="1" class="form-check-input">
                                    <?php echo app('translator')->get('warehouse::lang.reset_warehouse_transactions'); ?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12"><hr></div>

                <div class="col-md-12 check_group mb-3">
                    <div class="row align-items-center">
                        <div class="col-md-8 mb-2">
                            <strong><?php echo app('translator')->get('warehouse::lang.data_entry_hard_delete'); ?></strong>
                        </div>
                        <div class="col-md-4 mb-2 text-right">
                            <label class="form-check-label fw-bold">
                                <input type="checkbox" class="check_all"> <?php echo e(__('role.select_all'), false); ?>

                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[reset_warehouse]" type="checkbox" value="1" class="form-check-input">
                                    <?php echo app('translator')->get('warehouse::lang.reset_warehouse'); ?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <button id="warehouse_reset_data" class="btn btn-danger pull-right">
                        <?php echo app('translator')->get('warehouse::lang.reset_data'); ?>
                    </button>
                </div>
            </div>
        <?php echo Form::close(); ?>

    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).on('click', 'button#warehouse_reset_data', function(e) {
        e.preventDefault();
        swal({
            title: LANG.sure,
            text: '<?php echo app('translator')->get("warehouse::lang.hard_reset_confirm"); ?>',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(function(willContinue) {
            if (willContinue) {
                $('form#warehouse_reset_data_form').submit();
            } else {
                toastr.warning('<?php echo app('translator')->get("warehouse::lang.nothing_happened"); ?>');
            }
        });
    });

    $(document).ready(function() {
        $('.check_all').on('change', function() {
            $(this).closest('.check_group').find('input[type=checkbox]').not(this).prop('checked', this.checked);
        });

        $('.check_group input[type=checkbox]').not('.check_all').on('change', function() {
            var group = $(this).closest('.check_group');
            var total = group.find('input[type=checkbox]').not('.check_all').length;
            var checked = group.find('input[type=checkbox]:checked').not('.check_all').length;
            group.find('.check_all').prop('checked', total === checked);
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>