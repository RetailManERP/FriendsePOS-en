

<?php $__env->startSection('title', __('aiassistance::lang.ai_voice_command')); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('aiassistance::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <section class="content-header">
        <h1>
            <i class="fas fa-microphone"></i> <?php echo app('translator')->get('aiassistance::lang.ai_voice_command'); ?>
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
                            <strong><?php echo app('translator')->get('aiassistance::lang.voice_command_hint'); ?></strong>
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('aiassistance::lang.voice_command_label'); ?></label>
                            <div class="input-group">
                                <textarea id="voice_input" class="form-control" rows="2" placeholder="<?php echo app('translator')->get('aiassistance::lang.voice_command_placeholder'); ?>"></textarea>
                                <span class="input-group-btn" style="vertical-align: top;">
                                    <button class="btn btn-danger" id="voice_record_btn" title="<?php echo app('translator')->get('aiassistance::lang.voice_record_tip'); ?>" style="height:100%;">
                                        <i class="fas fa-microphone fa-2x"></i>
                                    </button>
                                </span>
                            </div>
                            <small class="text-muted" id="voice_status"></small>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-block" id="voice_submit_btn">
                                <i class="fas fa-paper-plane"></i> <?php echo app('translator')->get('aiassistance::lang.voice_execute'); ?>
                            </button>
                        </div>

                        <div id="voice_result" style="display:none;">
                            <hr>
                            <div id="voice_result_content"></div>
                            <div class="text-right mt-3">
                                <button class="btn btn-sm btn-info" id="voice_copy"><i class="fas fa-copy"></i> <?php echo app('translator')->get('aiassistance::lang.bi_copy'); ?></button>
                            </div>
                        </div>

                        <div class="mt-4">
                            <p class="text-muted"><strong><?php echo app('translator')->get('aiassistance::lang.voice_examples_title'); ?>:</strong></p>
                            <div class="d-flex flex-wrap gap-2">
                                <button class="btn btn-outline-primary btn-sm voice-quick" data-q="Create a new sale for customer John">New sale</button>
                                <button class="btn btn-outline-primary btn-sm voice-quick" data-q="Show me today's sales report">Today's report</button>
                                <button class="btn btn-outline-primary btn-sm voice-quick" data-q="Add 50 units of product SKU-001 to stock">Stock update</button>
                                <button class="btn btn-outline-primary btn-sm voice-quick" data-q="Check low stock products at main store">Low stock check</button>
                                <button class="btn btn-outline-primary btn-sm voice-quick" data-q="Create expense for office supplies $150">Add expense</button>
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
    var recognition = null;
    var isRecording = false;

    // Setup speech recognition if available
    if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
        var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        recognition = new SpeechRecognition();
        recognition.continuous = false;
        recognition.interimResults = true;
        recognition.lang = document.documentElement.lang || 'en-US';

        recognition.onresult = function(event) {
            var transcript = '';
            for (var i = event.resultIndex; i < event.results.length; i++) {
                transcript += event.results[i][0].transcript;
            }
            $('#voice_input').val(transcript);
        };

        recognition.onend = function() {
            isRecording = false;
            $('#voice_record_btn').removeClass('btn-success').addClass('btn-danger');
            $('#voice_status').text('');
        };
    } else {
        $('#voice_record_btn').prop('disabled', true).attr('title', 'Speech recognition not supported');
    }

    $('#voice_record_btn').click(function() {
        if (!recognition) return;

        if (isRecording) {
            recognition.stop();
            isRecording = false;
            $(this).removeClass('btn-success').addClass('btn-danger');
            $('#voice_status').text('');
        } else {
            recognition.start();
            isRecording = true;
            $(this).removeClass('btn-danger').addClass('btn-success');
            $('#voice_status').text('<?php echo app('translator')->get("aiassistance::lang.voice_listening"); ?>');
        }
    });

    $('.voice-quick').click(function() {
        $('#voice_input').val($(this).data('q'));
    });

    $('#voice_submit_btn').click(function() {
        var command = $('#voice_input').val().trim();
        if (!command) {
            toastr.error('<?php echo app('translator')->get("aiassistance::lang.question_required"); ?>');
            return;
        }

        var $btn = $(this);
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> <?php echo app('translator')->get("aiassistance::lang.bi_analyzing"); ?>');
        $('#voice_result').hide();

        $.ajax({
            url: '/aiassistance/bi/voice-command',
            type: 'POST',
            data: {
                _token: '<?php echo e(csrf_token(), false); ?>',
                command: command,
            },
            success: function(response) {
                if (response.success) {
                    $('#voice_result_content').html(response.html);
                    $('#voice_result').show();
                } else {
                    toastr.error(response.msg || '<?php echo app('translator')->get("aiassistance::lang.something_went_wrong"); ?>');
                }
            },
            error: function() {
                toastr.error('<?php echo app('translator')->get("aiassistance::lang.something_went_wrong"); ?>');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fas fa-paper-plane"></i> <?php echo app('translator')->get("aiassistance::lang.voice_execute"); ?>');
            }
        });
    });

    $('#voice_copy').click(function() {
        navigator.clipboard.writeText($('#voice_result_content').text()).then(function() {
            toastr.success('<?php echo app('translator')->get("aiassistance::lang.bi_copied"); ?>');
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>