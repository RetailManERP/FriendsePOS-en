

<?php $__env->startSection('title', __('aiassistance::lang.ai_smart_search')); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('aiassistance::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <section class="content-header">
        <h1>
            <i class="fas fa-search"></i> <?php echo app('translator')->get('aiassistance::lang.ai_smart_search'); ?>
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
                            <strong><?php echo app('translator')->get('aiassistance::lang.smart_search_hint'); ?></strong>
                        </div>

                        <div class="form-group">
                            <label><?php echo app('translator')->get('aiassistance::lang.smart_search_query'); ?></label>
                            <textarea id="search_query" class="form-control" rows="3" placeholder="<?php echo app('translator')->get('aiassistance::lang.smart_search_placeholder'); ?>"></textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-block" id="search_btn">
                                <i class="fas fa-search"></i> <?php echo app('translator')->get('aiassistance::lang.smart_search_go'); ?>
                            </button>
                        </div>

                        <div id="search_result" style="display:none;">
                            <hr>
                            <div id="search_result_content"></div>
                            <div class="text-right mt-3">
                                <button class="btn btn-sm btn-info" id="search_copy"><i class="fas fa-copy"></i> <?php echo app('translator')->get('aiassistance::lang.bi_copy'); ?></button>
                            </div>
                        </div>

                        <div class="mt-4">
                            <p class="text-muted"><strong><?php echo app('translator')->get('aiassistance::lang.smart_search_examples_title'); ?>:</strong></p>
                            <div class="d-flex flex-wrap gap-2">
                                <button class="btn btn-outline-primary btn-sm search-quick" data-q="Find all products with low stock">Low stock products</button>
                                <button class="btn btn-outline-primary btn-sm search-quick" data-q="Show me customers from last week">Recent customers</button>
                                <button class="btn btn-outline-primary btn-sm search-quick" data-q="Which invoices are unpaid?">Unpaid invoices</button>
                                <button class="btn btn-outline-primary btn-sm search-quick" data-q="Find products in electronics category">Category search</button>
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
    $('.search-quick').click(function() {
        $('#search_query').val($(this).data('q'));
    });

    $('#search_btn').click(function() {
        var query = $('#search_query').val().trim();
        if (!query) {
            toastr.error('<?php echo app('translator')->get("aiassistance::lang.question_required"); ?>');
            return;
        }

        var $btn = $(this);
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> <?php echo app('translator')->get("aiassistance::lang.bi_analyzing"); ?>');
        $('#search_result').hide();

        $.ajax({
            url: '/aiassistance/bi/smart-search',
            type: 'POST',
            data: {
                _token: '<?php echo e(csrf_token(), false); ?>',
                query: query,
            },
            success: function(response) {
                if (response.success) {
                    $('#search_result_content').html(response.html);
                    $('#search_result').show();
                } else {
                    toastr.error(response.msg || '<?php echo app('translator')->get("aiassistance::lang.something_went_wrong"); ?>');
                }
            },
            error: function() {
                toastr.error('<?php echo app('translator')->get("aiassistance::lang.something_went_wrong"); ?>');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="fas fa-search"></i> <?php echo app('translator')->get("aiassistance::lang.smart_search_go"); ?>');
            }
        });
    });

    $('#search_copy').click(function() {
        navigator.clipboard.writeText($('#search_result_content').text()).then(function() {
            toastr.success('<?php echo app('translator')->get("aiassistance::lang.bi_copied"); ?>');
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>