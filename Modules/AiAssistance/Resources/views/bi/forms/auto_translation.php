

<?php $__env->startSection('title', __('aiassistance::lang.ai_auto_translation')); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('aiassistance::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <section class="content-header">
        <h1>
            <i class="fas fa-language"></i> <?php echo app('translator')->get('aiassistance::lang.ai_auto_translation'); ?>
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
                            <strong><?php echo app('translator')->get('aiassistance::lang.translation_hint'); ?></strong>
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('aiassistance::lang.translation_content_type'); ?></label>
                            <select id="content_type" class="form-control">
                                <option value="products"><?php echo app('translator')->get('aiassistance::lang.translation_products'); ?></option>
                                <option value="categories"><?php echo app('translator')->get('aiassistance::lang.translation_categories'); ?></option>
                                <option value="custom"><?php echo app('translator')->get('aiassistance::lang.translation_custom'); ?></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('aiassistance::lang.translation_target_lang'); ?></label>
                            <select id="target_language" class="form-control">
                                <option value="English">English</option>
                                <option value="Spanish">Español</option>
                                <option value="French">Français</option>
                                <option value="Arabic">العربية</option>
                                <option value="Chinese">中文</option>
                                <option value="Hindi">हिन्दी</option>
                                <option value="Portuguese">Português</option>
                                <option value="German">Deutsch</option>
                                <option value="Japanese">日本語</option>
                                <option value="Korean">한국어</option>
                                <option value="Malay">Bahasa Melayu</option>
                                <option value="Thai">ไทย</option>
                                <option value="Turkish">Türkçe</option>
                                <option value="Russian">Русский</option>
                                <option value="Italian">Italiano</option>
                            </select>
                        </div>

                        <div class="form-group" id="custom_text_group" style="display:none;">
                            <label><?php echo app('translator')->get('aiassistance::lang.translation_custom_text'); ?></label>
                            <textarea id="custom_text" class="form-control" rows="4" placeholder="<?php echo app('translator')->get('aiassistance::lang.translation_custom_placeholder'); ?>"></textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-block" id="translate_btn">
                                <i class="fas fa-language"></i> <?php echo app('translator')->get('aiassistance::lang.translation_translate'); ?>
                            </button>
                        </div>

                        <div id="translate_result" style="display:none;">
                            <hr>
                            <div id="translate_result_content"></div>
                            <div class="text-right mt-3">
                                <button class="btn btn-sm btn-info" id="translate_copy"><i class="fas fa-copy"></i> <?php echo app('translator')->get('aiassistance::lang.bi_copy'); ?></button>
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
    $('#content_type').change(function() {
        if ($(this).val() === 'custom') {
            $('#custom_text_group').show();
        } else {
            $('#custom_text_group').hide();
        }
    });

    $('#translate_btn').click(function() {
        var contentType = $('#content_type').val();
        var data = {
            _token: '<?php echo e(csrf_token(), false); ?>',
            content_type: contentType,
            target_language: $('#target_language').val(),
        };

        if (contentType === 'custom') {
            data.custom_text = $('#custom_text').val().trim();
            if (!data.custom_text) {
                toastr.error('<?php echo app('translator')->get("aiassistance::lang.question_required"); ?>');
                return;
            }
        }

        var $btn = $(this);
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> <?php echo app('translator')->get("aiassistance::lang.bi_analyzing"); ?>');
        $('#translate_result').hide();

        $.ajax({
            url: '/aiassistance/bi/auto-translation',
            type: 'POST',
            data: data,
            success: function(response) {
                if (response.success) {
                    $('#translate_result_content').html(response.html);
                    $('#translate_result').show();
                } else {
                    toastr.error(response.msg || '<?php echo app('translator')->get("aiassistance::lang.something_went_wrong"); ?>');
                }
            },
            error: function() {
                toastr.error('<?php echo app('translator')->get("aiassistance::lang.something_went_wrong"); ?>');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fas fa-language"></i> <?php echo app('translator')->get("aiassistance::lang.translation_translate"); ?>');
            }
        });
    });

    $('#translate_copy').click(function() {
        navigator.clipboard.writeText($('#translate_result_content').text()).then(function() {
            toastr.success('<?php echo app('translator')->get("aiassistance::lang.bi_copied"); ?>');
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>