
<?php $__env->startSection('title', __('essentials::lang.announcements')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('essentials::layouts.nav_hrm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header">
    <h1><?php echo app('translator')->get('essentials::lang.announcements'); ?></h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('essentials::lang.all_announcements')]); ?>
                <?php if($is_admin): ?>
                <?php $__env->slot('tool'); ?>
                    <div class="box-tools">
                        <button type="button" class="btn btn-block btn-primary btn-modal"
                            data-href="<?php echo e(action([\Modules\Essentials\Http\Controllers\AnnouncementController::class, 'create']), false); ?>"
                            data-container="#announcement_modal">
                            <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
                        </button>
                    </div>
                <?php $__env->endSlot(); ?>
                <?php endif; ?>
                <div class="table-responsive" style="min-height: 80vh">
                    <table class="table table-bordered table-striped table-hover table-th-skin" id="announcements_table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('essentials::lang.title'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.start_date'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.end_date'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.location'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.department'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.status'); ?></th>
                                <th><?php echo app('translator')->get('essentials::lang.created_by'); ?></th>
                                <th><?php echo app('translator')->get('messages.action'); ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<div class="modal fade" id="announcement_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
<div class="modal fade" id="view_announcement_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
$(document).ready(function() {
    var announcements_table = $('#announcements_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?php echo e(action([\Modules\Essentials\Http\Controllers\AnnouncementController::class, 'index']), false); ?>"
        },
        columns: [
            { data: 'title', name: 'essentials_announcements.title' },
            { data: 'start_date', name: 'essentials_announcements.start_date' },
            { data: 'end_date', name: 'essentials_announcements.end_date' },
            { data: 'location_name', name: 'bl.name' },
            { data: 'department_name', name: 'dept.name' },
            { data: 'status', name: 'essentials_announcements.status' },
            { data: 'created_by_name', name: 'created_by_name' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
    });

    $(document).on('click', '.view_announcement', function() {
        var href = $(this).data('href');
        $.ajax({
            url: href,
            dataType: 'html',
            success: function(result) {
                $('#view_announcement_modal').html(result).modal('show');
            }
        });
    });

    $(document).on('click', '.delete_announcement', function() {
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
                            announcements_table.ajax.reload();
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