

<?php $__env->startSection('title', __('aiassistance::lang.ai_receipt_scanner')); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('aiassistance::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <section class="content-header">
        <h1>
            <i class="fas fa-camera"></i> <?php echo app('translator')->get('aiassistance::lang.ai_receipt_scanner'); ?>
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
                            <strong><?php echo app('translator')->get('aiassistance::lang.receipt_scanner_hint'); ?></strong>
                        </div>

                        <form id="receipt_form" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label><?php echo app('translator')->get('aiassistance::lang.receipt_upload_label'); ?></label>
                                <input type="file" name="receipt_image" id="receipt_image" class="form-control" accept="image/jpeg,image/png,image/webp">
                                <small class="text-muted"><?php echo app('translator')->get('aiassistance::lang.receipt_upload_hint'); ?></small>
                            </div>

                            <div id="receipt_preview" style="display:none;" class="mb-4">
                                <img id="receipt_preview_img" src="" alt="Preview" style="max-width:100%; max-height:300px; border-radius:5px;">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block" id="scan_btn">
                                    <i class="fas fa-camera"></i> <?php echo app('translator')->get('aiassistance::lang.receipt_scan_btn'); ?>
                                </button>
                            </div>
                        </form>

                        <div id="scan_result" style="display:none;">
                            <hr>
                            <div id="scan_result_content"></div>
                            <div class="text-right mt-3">
                                <button class="btn btn-sm btn-info" id="scan_copy"><i class="fas fa-copy"></i> <?php echo app('translator')->get('aiassistance::lang.bi_copy'); ?></button>
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
    $('#receipt_image').change(function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#receipt_preview_img').attr('src', e.target.result);
                $('#receipt_preview').show();
            };
            reader.readAsDataURL(file);
        }
    });

    $('#receipt_form').submit(function(e) {
        e.preventDefault();
        var fileInput = $('#receipt_image')[0];
        if (!fileInput.files.length) {
            toastr.error('<?php echo app('translator')->get("aiassistance::lang.no_file_uploaded"); ?>');
            return;
        }

        var formData = new FormData(this);
        var $btn = $('#scan_btn');
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> <?php echo app('translator')->get("aiassistance::lang.bi_analyzing"); ?>');
        $('#scan_result').hide();

        $.ajax({
            url: '/aiassistance/bi/receipt-scanner',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    $('#scan_result_content').html(response.html);
                    $('#scan_result').show();
                } else {
                    toastr.error(response.msg || '<?php echo app('translator')->get("aiassistance::lang.something_went_wrong"); ?>');
                }
            },
            error: function() {
                toastr.error('<?php echo app('translator')->get("aiassistance::lang.something_went_wrong"); ?>');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fas fa-camera"></i> <?php echo app('translator')->get("aiassistance::lang.receipt_scan_btn"); ?>');
            }
        });
    });

    $('#scan_copy').click(function() {
        navigator.clipboard.writeText($('#scan_result_content').text()).then(function() {
            toastr.success('<?php echo app('translator')->get("aiassistance::lang.bi_copied"); ?>');
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>