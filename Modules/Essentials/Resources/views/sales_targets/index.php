
<?php $__env->startSection('title', __('essentials::lang.sales_target')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('essentials::layouts.nav_hrm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header">
    <h1><?php echo app('translator')->get('essentials::lang.sales_target'); ?>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
                <div class="table-responsive" style="min-height: 80vh">
                    <table class="table table-bordered table-striped table-hover table-th-skin" id="sales_target_table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get( 'report.user' ); ?></th>
                                <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<!-- /.content -->
<div class="modal fade" id="set_sales_target_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel"></div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            sales_target_table = $('#sales_target_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "<?php echo e(action([\Modules\Essentials\Http\Controllers\SalesTargetController::class, 'index']), false); ?>"
                },
                columns: [
                    { data: 'full_name', name: 'full_name' },
                    { data: 'action', name: 'action' },
                ],
            });

            $(document).on('submit', 'form#add_holiday_form', function(e) {
                e.preventDefault();
                $(this).find('button[type="submit"]').attr('disabled', true);
                var data = $(this).serialize();

                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if (result.success == true) {
                            $('div#add_holiday_modal').modal('hide');
                            toastr.success(result.msg);
                            holidays_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            });
        });

        $(document).on('click', '#add_target', function(e) {
            $('#target_table tbody').append($('#sales_target_row_hidden tbody').html());
        });
        $(document).on('click', '.remove_target', function(e) {
            $(this).closest('tr').remove();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>