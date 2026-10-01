

<?php $__env->startSection('title', __('aiassistance::lang.ai_nl_reports')); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('aiassistance::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <section class="content-header">
        <h1>
            <i class="fas fa-comments"></i> <?php echo app('translator')->get('aiassistance::lang.ai_nl_reports'); ?>
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
                            <strong><?php echo app('translator')->get('aiassistance::lang.nl_reports_hint'); ?></strong>
                            <br>
                            <small><?php echo app('translator')->get('aiassistance::lang.nl_reports_examples'); ?></small>
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('aiassistance::lang.nl_your_question'); ?></label>
                            <textarea id="nl_question" class="form-control" rows="3" placeholder="<?php echo app('translator')->get('aiassistance::lang.nl_question_placeholder'); ?>"></textarea>
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('purchase.business_location'); ?> (<?php echo app('translator')->get('lang_v1.optional'); ?>)</label>
                            <?php echo Form::select('location_id', $locations, null, ['class' => 'form-control', 'id' => 'nl_location', 'placeholder' => __('report.all_locations')]); ?>

                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-block" id="nl_ask_btn">
                                <i class="fas fa-paper-plane"></i> <?php echo app('translator')->get('aiassistance::lang.nl_ask'); ?>
                            </button>
                        </div>

                        <div id="nl_result" style="display:none;">
                            <hr>
                            <div id="nl_result_content"></div>
                            <div class="text-right mt-3">
                                <button class="btn btn-sm btn-info" id="nl_copy"><i class="fas fa-copy"></i> <?php echo app('translator')->get('aiassistance::lang.bi_copy'); ?></button>
                            </div>
                        </div>

                        <div class="mt-4">
                            <p class="text-muted"><strong><?php echo app('translator')->get('aiassistance::lang.nl_example_questions'); ?>:</strong></p>
                            <div class="d-flex flex-wrap gap-2">
                                <button class="btn btn-outline-primary btn-sm nl-quick-q" data-q="What were my top 5 selling products last month?">Top 5 products</button>
                                <button class="btn btn-outline-primary btn-sm nl-quick-q" data-q="How much revenue did I make this month compared to last month?">Revenue comparison</button>
                                <button class="btn btn-outline-primary btn-sm nl-quick-q" data-q="Which customers owe me money?">Outstanding receivables</button>
                                <button class="btn btn-outline-primary btn-sm nl-quick-q" data-q="How many products are low on stock?">Low stock items</button>
                                <button class="btn btn-outline-primary btn-sm nl-quick-q" data-q="What is my average order value and how can I improve it?">Avg order value</button>
                                <button class="btn btn-outline-primary btn-sm nl-quick-q" data-q="What are my biggest expense categories?">Top expenses</button>
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
    $('.nl-quick-q').click(function() {
        $('#nl_question').val($(this).data('q'));
    });

    $('#nl_ask_btn').click(function() {
        var question = $('#nl_question').val().trim();
        if (!question) {
            toastr.error('<?php echo app('translator')->get("aiassistance::lang.question_required"); ?>');
            return;
        }

        var $btn = $(this);
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> <?php echo app('translator')->get("aiassistance::lang.bi_analyzing"); ?>');
        $('#nl_result').hide();

        $.ajax({
            url: '/aiassistance/bi/nl-reports',
            type: 'POST',
            data: {
                _token: '<?php echo e(csrf_token(), false); ?>',
                question: question,
                location_id: $('#nl_location').val() || '',
            },
            success: function(response) {
                if (response.success) {
                    $('#nl_result_content').html(response.html);
                    $('#nl_result').show();
                } else {
                    toastr.error(response.msg || '<?php echo app('translator')->get("aiassistance::lang.something_went_wrong"); ?>');
                }
            },
            error: function() {
                toastr.error('<?php echo app('translator')->get("aiassistance::lang.something_went_wrong"); ?>');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fas fa-paper-plane"></i> <?php echo app('translator')->get("aiassistance::lang.nl_ask"); ?>');
            }
        });
    });

    $('#nl_copy').click(function() {
        navigator.clipboard.writeText($('#nl_result_content').text()).then(function() {
            toastr.success('<?php echo app('translator')->get("aiassistance::lang.bi_copied"); ?>');
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>