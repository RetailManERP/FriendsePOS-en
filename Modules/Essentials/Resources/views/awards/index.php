
<?php $__env->startSection('title', __('essentials::lang.awards')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('essentials::layouts.nav_hrm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header">
    <h1><?php echo app('translator')->get('essentials::lang.awards'); ?></h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters'), 'class' => 'box-primary']); ?>
                <?php if($is_admin): ?>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('award_employee_id', __('essentials::lang.employee') . ':'); ?>

                        <?php echo Form::select('award_employee_id', $employees, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                    </div>
                </div>
                <?php endif; ?>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('essentials::lang.all_awards')]); ?>
                <?php if($is_admin): ?>
                <?php $__env->slot('tool'); ?>
                    <div class="box-tools">
                        <button type="button" class="btn btn-block btn-primary btn-modal"
                            data-href="<?php echo e(action([\Modules\Essentials\Http\Controllers\AwardController::class, 'create']), false); ?>"
                            data-container="#award_modal">
                            <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
                        </button>
                    </div>
                <?php $__env->endSlot(); ?>
                <?php endif; ?>
                <div class="table-responsive" style="min-height: 80vh">
                    <table class="table table-bordered table-striped table-hover table-th-skin" id="awards_table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('essentials::lang.employee'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.award_name'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.description'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.gift'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.cash_prize'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.award_date'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.awarded_by'); ?></th>
                                <?php if($is_admin): ?>
                                <th><?php echo app('translator')->get('messages.action'); ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<div class="modal fade" id="award_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
$(document).ready(function() {
    var awards_table = $('#awards_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?php echo e(action([\Modules\Essentials\Http\Controllers\AwardController::class, 'index']), false); ?>",
            data: function(d) {
                d.employee_id = $('#award_employee_id').val();
            }
        },
        columns: [
            { data: 'employee_name', name: 'employee_name' },
            { data: 'award_name', name: 'essentials_awards.award_name' },
            { data: 'description', name: 'essentials_awards.description' },
            { data: 'gift', name: 'essentials_awards.gift' },
            { data: 'cash_prize', name: 'essentials_awards.cash_prize' },
            { data: 'award_date', name: 'essentials_awards.award_date' },
            { data: 'awarded_by_name', name: 'awarded_by_name' },
            <?php if($is_admin): ?>
            { data: 'action', name: 'action', orderable: false, searchable: false },
            <?php endif; ?>
        ],
    });

    $('#award_employee_id').change(function() {
        awards_table.ajax.reload();
    });

    $(document).on('click', '.delete_award', function() {
        swal({
            title: LANG.sure,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((confirmed) => {
            if (confirmed) {
                var href = $(this).data('href');
                $.ajax({
                    method: "DELETE",
                    url: href,
                    dataType: "json",
                    success: function(result) {
                        if (result.success) {
                            toastr.success(result.msg);
                            awards_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>