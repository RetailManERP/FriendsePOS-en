

<?php $__env->startSection('title', __('truckmate::lang.view_container')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('truckmate::container.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header no-print">
    <div class="tm-page-header">
        <h1><i class="fas fa-eye" style="color:var(--tm-primary)"></i> <?php echo app('translator')->get('truckmate::lang.view_container'); ?> (<code><?php echo e($container->container_no, false); ?></code>)</h1>
    </div>
</section>
<section class="content tm-content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php $__env->slot('tool'); ?>
            <a class="btn btn-primary" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\ContainerController::class, 'getUploadDocs'], [$container->id]), false); ?>">
                <i class="fas fa-file-upload"></i> <?php echo app('translator')->get('truckmate::lang.add_document'); ?>
            </a>
        <?php $__env->endSlot(); ?>
        <table class="table">
            <tr>
                <th><?php echo app('translator')->get('truckmate::lang.container'); ?>:</th>
                <td><?php echo e($container->container_no, false); ?></td>
                <th><?php echo app('translator')->get('truckmate::lang.container_name'); ?>:</th>
                <td><?php echo e($container->name, false); ?></td>
            </tr>
            <?php if(!empty($container->notes)): ?>
                <tr>
                    <th><?php echo app('translator')->get('truckmate::lang.notes'); ?>:</th>
                    <td colspan="3"><?php echo e($container->notes, false); ?></td>
                </tr>
            <?php endif; ?>
        </table>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('truckmate::lang.documents')]); ?>
        <?php if($container->media->count() > 0): ?>
            <div class="row no-print" style="margin-bottom: 15px;">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('container_doc_search', __('truckmate::lang.search_documents') . ':'); ?>

                        <?php echo Form::text('container_doc_search', null, ['class' => 'form-control', 'placeholder' => __('truckmate::lang.search_documents'), 'id' => 'container_doc_search']); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('container_doc_date_range', __('truckmate::lang.uploaded_date_range') . ':'); ?>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <?php echo Form::text('container_doc_date_range', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.select_a_date_range'), 'id' => 'container_doc_date_range', 'readonly']); ?>

                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default" id="clear_container_doc_filters">
                                    <i class="fas fa-times"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($__env->exists('truckmate::container.partials.document_table_view', ['medias' => $container->media])) echo $__env->make('truckmate::container.partials.document_table_view', ['medias' => $container->media], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
            <p class="help-block"><?php echo app('translator')->get('truckmate::lang.no_documents_found'); ?></p>
        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(function () {
        var docStartDate = null;
        var docEndDate = null;

        if ($('#container_doc_date_range').length) {
            $('#container_doc_date_range').daterangepicker(
                dateRangeSettings,
                function(start, end) {
                    docStartDate = start.startOf('day');
                    docEndDate = end.endOf('day');
                    $('#container_doc_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                    filterContainerDocuments();
                }
            );
            $('#container_doc_date_range').val('');
        }

        $(document).on('keyup change', '#container_doc_search', function() {
            filterContainerDocuments();
        });

        $(document).on('click', '#clear_container_doc_filters', function() {
            $('#container_doc_search').val('');
            $('#container_doc_date_range').val('');
            docStartDate = null;
            docEndDate = null;
            filterContainerDocuments();
        });

        function filterContainerDocuments() {
            var search = ($('#container_doc_search').val() || '').toLowerCase();

            $('#container_documents_table tbody tr.media_row').each(function() {
                var row = $(this);
                var name = (row.data('document-name') || '').toString().toLowerCase();
                var uploadedAt = row.data('uploaded-at') ? moment(row.data('uploaded-at'), 'YYYY-MM-DD') : null;
                var matchesSearch = !search || name.indexOf(search) !== -1;
                var matchesDate = true;

                if (docStartDate && docEndDate && uploadedAt) {
                    matchesDate = uploadedAt.isBetween(docStartDate, docEndDate, null, '[]');
                }

                row.toggle(matchesSearch && matchesDate);
            });

            var visibleRows = $('#container_documents_table tbody tr.media_row:visible').length;
            $('#container_documents_no_results').toggle(visibleRows === 0);
        }

        $(document).on('click', '.delete_media', function (e) {
            e.preventDefault();
            var url = $(this).data('href');
            var this_btn = $(this);
            swal({
                title: LANG.sure,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((confirmed) => {
                if (confirmed) {
                    $.ajax({
                        method: 'GET',
                        url: url,
                        dataType: 'json',
                        success: function(result) {
                            if(result.success == true){
                                this_btn.closest('tr').remove();
                                toastr.success(result.msg);
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