

<?php $__env->startSection('title', __('aiassistance::lang.ai_document_extraction')); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('aiassistance::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <section class="content-header">
        <h1>
            <i class="fas fa-file-invoice"></i> <?php echo app('translator')->get('aiassistance::lang.ai_document_extraction'); ?>
        </h1>
        <?php if($token_remaining_display): ?>
            <p class="text-info"><?php echo e($token_remaining_display, false); ?></p>
        <?php endif; ?>
    </section>

    <section class="content no-print">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="alert alert-info">
                            <i class="fas fa-lightbulb"></i>
                            <strong><?php echo app('translator')->get('aiassistance::lang.doc_extraction_hint'); ?></strong>
                        </div>

                        <form id="doc_extraction_form" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label><?php echo app('translator')->get('aiassistance::lang.doc_type'); ?></label>
                                <select name="document_type" id="doc_type" class="form-control" required>
                                    <option value="invoice"><?php echo app('translator')->get('aiassistance::lang.doc_type_invoice'); ?></option>
                                    <option value="receipt"><?php echo app('translator')->get('aiassistance::lang.doc_type_receipt'); ?></option>
                                    <option value="expense"><?php echo app('translator')->get('aiassistance::lang.doc_type_expense'); ?></option>
                                    <option value="bill_of_lading"><?php echo app('translator')->get('aiassistance::lang.doc_type_bol'); ?></option>
                                    <option value="quotation"><?php echo app('translator')->get('aiassistance::lang.doc_type_quotation'); ?></option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label><?php echo app('translator')->get('aiassistance::lang.doc_upload'); ?></label>
                                <input type="file" name="document" id="doc_file" class="form-control" accept="image/*,.pdf" required>
                                <small class="text-muted"><?php echo app('translator')->get('aiassistance::lang.doc_upload_hint'); ?></small>
                            </div>

                            <div id="doc_preview" style="display:none;" class="mb-4">
                                <img id="doc_preview_img" src="" style="max-width: 100%; max-height: 300px; border-radius: 5px; border: 1px solid #ddd;">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" id="doc_extract_btn">
                                    <i class="fas fa-magic"></i> <?php echo app('translator')->get('aiassistance::lang.doc_extract'); ?>
                                </button>
                            </div>
                        </form>

                        <div id="doc_result" style="display:none;">
                            <hr>
                            <div id="doc_result_content"></div>
                            <div class="text-right mt-3">
                                <button class="btn btn-sm btn-info" id="doc_copy"><i class="fas fa-copy"></i> <?php echo app('translator')->get('aiassistance::lang.bi_copy'); ?></button>
                                <button class="btn btn-sm btn-primary" id="doc_export"><i class="fas fa-download"></i> <?php echo app('translator')->get('aiassistance::lang.bi_export'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function() {
    // Preview uploaded image
    $('#doc_file').change(function() {
        var file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#doc_preview_img').attr('src', e.target.result);
                $('#doc_preview').show();
            };
            reader.readAsDataURL(file);
        } else {
            $('#doc_preview').hide();
        }
    });

    $('#doc_extraction_form').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var $btn = $('#doc_extract_btn');
        
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> <?php echo app('translator')->get("aiassistance::lang.bi_analyzing"); ?>');
        $('#doc_result').hide();

        $.ajax({
            url: '/aiassistance/bi/document-extraction',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    $('#doc_result_content').html(response.html);
                    $('#doc_result').show();
                } else {
                    toastr.error(response.msg || '<?php echo app('translator')->get("aiassistance::lang.something_went_wrong"); ?>');
                }
            },
            error: function() {
                toastr.error('<?php echo app('translator')->get("aiassistance::lang.something_went_wrong"); ?>');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fas fa-magic"></i> <?php echo app('translator')->get("aiassistance::lang.doc_extract"); ?>');
            }
        });
    });

    $('#doc_copy').click(function() {
        navigator.clipboard.writeText($('#doc_result_content').text()).then(function() {
            toastr.success('<?php echo app('translator')->get("aiassistance::lang.bi_copied"); ?>');
        });
    });

    $('#doc_export').click(function() {
        var text = $('#doc_result_content').text();
        var blob = new Blob([text], {type: 'text/plain'});
        var a = document.createElement('a');
        a.href = URL.createObjectURL(blob);
        a.download = 'extracted-' + $('#doc_type').val() + '-' + new Date().toISOString().slice(0,10) + '.txt';
        a.click();
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>