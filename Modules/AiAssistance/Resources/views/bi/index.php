

<?php $__env->startSection('title', __('aiassistance::lang.ai_business_intelligence')); ?>

<?php $__env->startSection('css'); ?>
<style>
    .bi-tier-badge { background: var(--bs-primary); }
    .bi-tier-card { border-top: 3px solid var(--bs-primary) !important; }
    .bi-tier-icon { color: var(--bs-primary); }
    .bi-tier-btn { background: var(--bs-primary) !important; color: #fff !important; border: none !important; }
    .bi-tier-btn:hover { opacity: 0.9; color: #fff !important; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('aiassistance::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Content Header -->
    <section class="content-header">
        <h1>
            <i class="fas fa-brain"></i> <?php echo app('translator')->get('aiassistance::lang.ai_business_intelligence'); ?>
        </h1>
        <?php if($token_remaining_display): ?>
            <p class="text-info"><?php echo e($token_remaining_display, false); ?></p>
        <?php endif; ?>
    </section>

    <section class="content no-print">
        
        <div class="mb-4">
            <h5 class="mb-3">
                <span class="badge rounded-pill text-white me-2 bi-tier-badge">Tier 1</span>
                <?php echo app('translator')->get('aiassistance::lang.bi_tier1_title'); ?>
            </h5>
            <div class="row">
                <?php $__currentLoopData = $bi_tools['tier1']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12 col-sm-6 col-md-4 mb-3">
                        <div class="card radius-10 h-100 bi-tier-card">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="<?php echo e($tool['icon'], false); ?> font-30 bi-tier-icon"></i>
                                </div>
                                <h6 class="card-title mb-2"><?php echo e($tool['label'], false); ?></h6>
                                <p class="text-muted font-13"><?php echo e($tool['description'], false); ?></p>
                                <button class="btn btn-sm bi-analyze-btn bi-tier-btn mt-2" data-route="<?php echo e($tool['route'], false); ?>">
                                    <i class="fas fa-magic me-1"></i> <?php echo app('translator')->get('aiassistance::lang.bi_analyze'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        
        <div class="mb-4">
            <h5 class="mb-3">
                <span class="badge rounded-pill text-white me-2 bi-tier-badge">Tier 2</span>
                <?php echo app('translator')->get('aiassistance::lang.bi_tier2_title'); ?>
            </h5>
            <div class="row">
                <?php $__currentLoopData = $bi_tools['tier2']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12 col-sm-6 col-md-4 mb-3">
                        <div class="card radius-10 h-100 bi-tier-card">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="<?php echo e($tool['icon'], false); ?> font-30 bi-tier-icon"></i>
                                </div>
                                <h6 class="card-title mb-2"><?php echo e($tool['label'], false); ?></h6>
                                <p class="text-muted font-13"><?php echo e($tool['description'], false); ?></p>
                                <?php if($tool['route'] == 'nl-reports' || $tool['route'] == 'document-extraction'): ?>
                                    <a href="<?php echo e(url('aiassistance/bi/' . $tool['route'] . '/form'), false); ?>" class="btn btn-sm bi-tier-btn mt-2">
                                        <i class="fas fa-external-link-alt me-1"></i> <?php echo app('translator')->get('aiassistance::lang.bi_open'); ?>
                                    </a>
                                <?php else: ?>
                                    <button class="btn btn-sm bi-analyze-btn bi-tier-btn mt-2" data-route="<?php echo e($tool['route'], false); ?>">
                                        <i class="fas fa-magic me-1"></i> <?php echo app('translator')->get('aiassistance::lang.bi_analyze'); ?>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        
        <div class="mb-4">
            <h5 class="mb-3">
                <span class="badge rounded-pill text-white me-2 bi-tier-badge">Tier 3</span>
                <?php echo app('translator')->get('aiassistance::lang.bi_tier3_title'); ?>
            </h5>
            <div class="row">
                <?php $__currentLoopData = $bi_tools['tier3']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12 col-sm-6 col-md-4 mb-3">
                        <div class="card radius-10 h-100 bi-tier-card">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="<?php echo e($tool['icon'], false); ?> font-30 bi-tier-icon"></i>
                                </div>
                                <h6 class="card-title mb-2"><?php echo e($tool['label'], false); ?></h6>
                                <p class="text-muted font-13"><?php echo e($tool['description'], false); ?></p>
                                <button class="btn btn-sm bi-analyze-btn bi-tier-btn mt-2" data-route="<?php echo e($tool['route'], false); ?>">
                                    <i class="fas fa-magic me-1"></i> <?php echo app('translator')->get('aiassistance::lang.bi_analyze'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        
        <div class="mb-4">
            <h5 class="mb-3">
                <span class="badge rounded-pill text-white me-2 bi-tier-badge">Tier 4</span>
                <?php echo app('translator')->get('aiassistance::lang.bi_tier4_title'); ?>
            </h5>
            <div class="row">
                <?php $__currentLoopData = $bi_tools['tier4']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12 col-sm-6 col-md-4 mb-3">
                        <div class="card radius-10 h-100 bi-tier-card">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="<?php echo e($tool['icon'], false); ?> font-30 bi-tier-icon"></i>
                                </div>
                                <h6 class="card-title mb-2"><?php echo e($tool['label'], false); ?></h6>
                                <p class="text-muted font-13"><?php echo e($tool['description'], false); ?></p>
                                <?php if(!empty($tool['has_form'])): ?>
                                    <a href="<?php echo e(url('aiassistance/bi/' . $tool['route'] . '/form'), false); ?>" class="btn btn-sm bi-tier-btn mt-2">
                                        <i class="fas fa-external-link-alt me-1"></i> <?php echo app('translator')->get('aiassistance::lang.bi_open'); ?>
                                    </a>
                                <?php else: ?>
                                    <button class="btn btn-sm bi-analyze-btn bi-tier-btn mt-2" data-route="<?php echo e($tool['route'], false); ?>">
                                        <i class="fas fa-magic me-1"></i> <?php echo app('translator')->get('aiassistance::lang.bi_analyze'); ?>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        
        <div class="mb-4">
            <h5 class="mb-3">
                <span class="badge rounded-pill text-white me-2 bi-tier-badge">Tier 5</span>
                <?php echo app('translator')->get('aiassistance::lang.bi_tier5_title'); ?>
            </h5>
            <div class="row">
                <?php $__currentLoopData = $bi_tools['tier5']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12 col-sm-6 col-md-4 mb-3">
                        <div class="card radius-10 h-100 bi-tier-card">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="<?php echo e($tool['icon'], false); ?> font-30 bi-tier-icon"></i>
                                </div>
                                <h6 class="card-title mb-2"><?php echo e($tool['label'], false); ?></h6>
                                <p class="text-muted font-13"><?php echo e($tool['description'], false); ?></p>
                                <?php if(!empty($tool['has_form'])): ?>
                                    <a href="<?php echo e(url('aiassistance/bi/' . $tool['route'] . '/form'), false); ?>" class="btn btn-sm bi-tier-btn mt-2">
                                        <i class="fas fa-external-link-alt me-1"></i> <?php echo app('translator')->get('aiassistance::lang.bi_open'); ?>
                                    </a>
                                <?php else: ?>
                                    <button class="btn btn-sm bi-analyze-btn bi-tier-btn mt-2" data-route="<?php echo e($tool['route'], false); ?>">
                                        <i class="fas fa-magic me-1"></i> <?php echo app('translator')->get('aiassistance::lang.bi_analyze'); ?>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        
        <div class="mb-4">
            <h5 class="mb-3">
                <span class="badge rounded-pill text-white me-2 bi-tier-badge">Tier 6</span>
                <?php echo app('translator')->get('aiassistance::lang.bi_tier6_title'); ?>
            </h5>
            <div class="row">
                <?php $__currentLoopData = $bi_tools['tier6']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12 col-sm-6 col-md-4 mb-3">
                        <div class="card radius-10 h-100 bi-tier-card">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="<?php echo e($tool['icon'], false); ?> font-30 bi-tier-icon"></i>
                                </div>
                                <h6 class="card-title mb-2"><?php echo e($tool['label'], false); ?></h6>
                                <p class="text-muted font-13"><?php echo e($tool['description'], false); ?></p>
                                <?php if(!empty($tool['has_form'])): ?>
                                    <a href="<?php echo e(url('aiassistance/bi/' . $tool['route'] . '/form'), false); ?>" class="btn btn-sm bi-tier-btn mt-2">
                                        <i class="fas fa-external-link-alt me-1"></i> <?php echo app('translator')->get('aiassistance::lang.bi_open'); ?>
                                    </a>
                                <?php else: ?>
                                    <button class="btn btn-sm bi-analyze-btn bi-tier-btn mt-2" data-route="<?php echo e($tool['route'], false); ?>">
                                        <i class="fas fa-magic me-1"></i> <?php echo app('translator')->get('aiassistance::lang.bi_analyze'); ?>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- BI Result Modal -->
    <div class="modal fade" id="bi_result_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="bi_modal_title">
                        <i class="fas fa-brain"></i> <?php echo app('translator')->get('aiassistance::lang.ai_analysis_results'); ?>
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="bi_modal_body">
                    <div class="text-center" id="bi_loading">
                        <i class="fas fa-spinner fa-spin fa-3x text-primary"></i>
                        <p class="mt-3"><?php echo app('translator')->get('aiassistance::lang.bi_analyzing'); ?></p>
                    </div>
                    <div id="bi_result_content" style="display:none;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="bi_export_btn">
                        <i class="fa fa-download"></i> <?php echo app('translator')->get('aiassistance::lang.bi_export'); ?>
                    </button>
                    <button type="button" class="btn btn-info" id="bi_copy_btn">
                        <i class="fa fa-copy"></i> <?php echo app('translator')->get('aiassistance::lang.bi_copy'); ?>
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <?php echo app('translator')->get('messages.close'); ?>
                    </button>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function() {
    // Move modal to body to escape .content-wrapper stacking context
    $('#bi_result_modal').appendTo('body');

    // Handle analyze button clicks
    $('.bi-analyze-btn').click(function() {
        var route = $(this).data('route');
        var $btn = $(this);
        
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> <?php echo app('translator')->get("aiassistance::lang.bi_analyzing"); ?>');
        
        $('#bi_loading').show();
        $('#bi_result_content').hide().html('');
        $('#bi_result_modal').modal('show');
        
        $.ajax({
            url: '<?php echo e(url("aiassistance/bi"), false); ?>/' + route,
            type: 'POST',
            data: {
                _token: '<?php echo e(csrf_token(), false); ?>',
                location_id: $('select[name="location_id"]').val() || '',
            },
            success: function(response) {
                $('#bi_loading').hide();
                if (response.success) {
                    $('#bi_result_content').html(response.html).show();
                } else {
                    $('#bi_result_content').html('<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> ' + (response.msg || 'An error occurred') + '</div>').show();
                }
            },
            error: function(xhr) {
                $('#bi_loading').hide();
                $('#bi_result_content').html('<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?php echo app('translator')->get("aiassistance::lang.something_went_wrong"); ?></div>').show();
            },
            complete: function() {
                $btn.prop('disabled', false);
                $btn.html('<i class="fas fa-magic"></i> <?php echo app('translator')->get("aiassistance::lang.bi_analyze"); ?>');
            }
        });
    });

    // Copy to clipboard
    $('#bi_copy_btn').click(function() {
        var text = document.getElementById('bi_result_content').innerText;
        navigator.clipboard.writeText(text).then(function() {
            toastr.success('<?php echo app('translator')->get("aiassistance::lang.bi_copied"); ?>');
        });
    });

    // Export as text file
    $('#bi_export_btn').click(function() {
        var text = document.getElementById('bi_result_content').innerText;
        var blob = new Blob([text], {type: 'text/plain'});
        var a = document.createElement('a');
        a.href = URL.createObjectURL(blob);
        a.download = 'ai-analysis-' + new Date().toISOString().slice(0,10) + '.txt';
        a.click();
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>