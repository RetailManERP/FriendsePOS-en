

<?php $__env->startSection('title', __('aiassistance::lang.ai_meeting_notes')); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('aiassistance::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <section class="content-header">
        <h1>
            <i class="fas fa-clipboard-list"></i> <?php echo app('translator')->get('aiassistance::lang.ai_meeting_notes'); ?>
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
                            <strong><?php echo app('translator')->get('aiassistance::lang.meeting_notes_hint'); ?></strong>
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('aiassistance::lang.meeting_type_label'); ?></label>
                            <select id="meeting_type" class="form-control">
                                <option value="general"><?php echo app('translator')->get('aiassistance::lang.meeting_type_general'); ?></option>
                                <option value="sales_review"><?php echo app('translator')->get('aiassistance::lang.meeting_type_sales'); ?></option>
                                <option value="team_standup"><?php echo app('translator')->get('aiassistance::lang.meeting_type_standup'); ?></option>
                                <option value="supplier_negotiation"><?php echo app('translator')->get('aiassistance::lang.meeting_type_supplier'); ?></option>
                                <option value="strategy_planning"><?php echo app('translator')->get('aiassistance::lang.meeting_type_strategy'); ?></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('aiassistance::lang.meeting_text_label'); ?></label>
                            <textarea id="meeting_text" class="form-control" rows="8" placeholder="<?php echo app('translator')->get('aiassistance::lang.meeting_text_placeholder'); ?>"></textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-block" id="notes_btn">
                                <i class="fas fa-clipboard-list"></i> <?php echo app('translator')->get('aiassistance::lang.meeting_generate'); ?>
                            </button>
                        </div>

                        <div id="notes_result" style="display:none;">
                            <hr>
                            <div id="notes_result_content"></div>
                            <div class="text-right mt-3">
                                <button class="btn btn-sm btn-info" id="notes_copy"><i class="fas fa-copy"></i> <?php echo app('translator')->get('aiassistance::lang.bi_copy'); ?></button>
                                <button class="btn btn-sm btn-success" id="notes_export"><i class="fas fa-download"></i> <?php echo app('translator')->get('aiassistance::lang.bi_export'); ?></button>
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
    $('#notes_btn').click(function() {
        var meetingText = $('#meeting_text').val().trim();
        if (!meetingText) {
            toastr.error('<?php echo app('translator')->get("aiassistance::lang.question_required"); ?>');
            return;
        }

        var $btn = $(this);
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> <?php echo app('translator')->get("aiassistance::lang.bi_analyzing"); ?>');
        $('#notes_result').hide();

        $.ajax({
            url: '/aiassistance/bi/meeting-notes',
            type: 'POST',
            data: {
                _token: '<?php echo e(csrf_token(), false); ?>',
                meeting_text: meetingText,
                meeting_type: $('#meeting_type').val(),
            },
            success: function(response) {
                if (response.success) {
                    $('#notes_result_content').html(response.html);
                    $('#notes_result').show();
                } else {
                    toastr.error(response.msg || '<?php echo app('translator')->get("aiassistance::lang.something_went_wrong"); ?>');
                }
            },
            error: function() {
                toastr.error('<?php echo app('translator')->get("aiassistance::lang.something_went_wrong"); ?>');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fas fa-clipboard-list"></i> <?php echo app('translator')->get("aiassistance::lang.meeting_generate"); ?>');
            }
        });
    });

    $('#notes_copy').click(function() {
        navigator.clipboard.writeText($('#notes_result_content').text()).then(function() {
            toastr.success('<?php echo app('translator')->get("aiassistance::lang.bi_copied"); ?>');
        });
    });

    $('#notes_export').click(function() {
        var content = $('#notes_result_content').html();
        var blob = new Blob(['<html><body>' + content + '</body></html>'], {type: 'text/html'});
        var url = URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'meeting-notes-' + new Date().toISOString().slice(0,10) + '.html';
        a.click();
        URL.revokeObjectURL(url);
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>