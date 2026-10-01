

<?php $__env->startSection('title', __('truckmate::lang.upload_container_docs')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('truckmate::container.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header no-print">
    <div class="tm-page-header">
        <h1><i class="fas fa-upload" style="color:var(--tm-primary)"></i> <?php echo app('translator')->get('truckmate::lang.upload_container_docs'); ?></h1>
    </div>
</section>
<section class="content tm-content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <table class="table">
            <tr>
                <th><?php echo app('translator')->get('truckmate::lang.container'); ?>:</th>
                <td><?php echo e($container->container_no, false); ?></td>
                <th><?php echo app('translator')->get('truckmate::lang.container_name'); ?>:</th>
                <td><?php echo e($container->name, false); ?></td>
            </tr>
        </table>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php if(in_array('upload_documents', $enabled_modules)): ?>
            <?php echo Form::open(['action' => '\Modules\Truckmate\Http\Controllers\ContainerController@postUploadDocs', 'id' => 'container_doc_upload', 'method' => 'post']); ?>

                <input type="hidden" name="container_id" value="<?php echo e($container->id, false); ?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="fileupload">
                                <?php echo app('translator')->get('truckmate::lang.document'); ?>:
                            </label>
                            <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
                            <div class="dropzone" id="documentUpload"></div>
                        </div>
                        <input type="hidden" id="images" name="images" value="">
                    </div>
                </div>
                <button type="submit" class="btn btn-block btn-primary pull-right">
                    <?php echo app('translator')->get('messages.save'); ?>
                </button>
            <?php echo Form::close(); ?>

        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>

    <?php if($container->media->count() > 0): ?>
        <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('truckmate::lang.documents')]); ?>
            <?php if ($__env->exists('truckmate::container.partials.document_table_view', ['medias' => $container->media])) echo $__env->make('truckmate::container.partials.document_table_view', ['medias' => $container->media], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->renderComponent(); ?>
    <?php endif; ?>
    <?php
        $accepted_files = implode(',', array_keys(config('constants.document_upload_mimes_types')));
    ?>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    Dropzone.autoDiscover = false;
    $(function () {
        var file_names = [];
        $("div#documentUpload").dropzone({
            url: base_path+'/truckmate/container-document-upload',
            paramName: 'file',
            uploadMultiple: false,
            autoProcessQueue: true,
            timeout: 600000,
            acceptedFiles: '<?php echo e($accepted_files, false); ?>',
            maxFiles: 10,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, response) {
                if (response.success && response.file_name) {
                    toastr.success(response.msg);
                    file_names.push(response.file_name);
                    $('input#images').val(JSON.stringify(file_names));
                } else {
                    toastr.error(response.msg || '<?php echo app('translator')->get('messages.something_went_wrong'); ?>');
                }
            },
        });

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