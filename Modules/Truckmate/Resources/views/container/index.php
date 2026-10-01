

<?php $__env->startSection('title', __('truckmate::lang.container_docs')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('truckmate::container.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header no-print">
    <div class="tm-page-header">
        <h1><i class="fas fa-folder-open" style="color:var(--tm-primary)"></i> <?php echo app('translator')->get('truckmate::lang.container_docs'); ?></h1>
    </div>
</section>
<section class="content tm-content no-print">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('truckmate::lang.container_docs')]); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <a class="btn btn-inline btn-primary" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\ContainerController::class, 'create']), false); ?>">
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get('truckmate::lang.add_container'); ?>
                </a>
            </div>
        <?php $__env->endSlot(); ?>
        <div class="row no-print" style="margin-bottom: 15px;">
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('container_search', __('truckmate::lang.search_containers') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-search"></i>
                        </span>
                        <?php echo Form::text('container_search', null, ['class' => 'form-control', 'placeholder' => __('truckmate::lang.search_containers'), 'id' => 'container_search']); ?>

                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default" id="clear_container_search">
                                <i class="fas fa-times"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped ajax_view table-hover table-th-skin" id="containers_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('truckmate::lang.container'); ?></th>
                        <th><?php echo app('translator')->get('truckmate::lang.container_name'); ?></th>
                        <th><?php echo app('translator')->get('truckmate::lang.notes'); ?></th>
                        <th><?php echo app('translator')->get('messages.action'); ?></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            containers_table = $("#containers_table").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/truckmate/containers',
                },
                columns: [
                    { data: 'container_no', name: 'container_no' },
                    { data: 'name', name: 'name' },
                    { data: 'notes', name: 'notes' },
                    { data: 'action', name: 'action' }
                ],
                dom: 'lrtip',
            });

            var containerSearchTimer = null;
            $(document).on('keyup change', '#container_search', function() {
                clearTimeout(containerSearchTimer);
                containerSearchTimer = setTimeout(function() {
                    containers_table.search($('#container_search').val()).draw();
                }, 250);
            });

            $(document).on('click', '#clear_container_search', function() {
                $('#container_search').val('');
                containers_table.search('').draw();
            });

            $(document).on('click', '#delete_container', function(e) {
                e.preventDefault();
                swal({
                    title: LANG.sure,
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then(willDelete => {
                    if (willDelete) {
                        var href = $(this).attr('data-href');
                        $.ajax({
                            method: 'DELETE',
                            url: href,
                            dataType: 'json',
                            success: function(result) {
                                if (result.success == true) {
                                    toastr.success(result.msg);
                                    containers_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                        });
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>