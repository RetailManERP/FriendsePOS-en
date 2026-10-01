
<?php $__env->startSection('title', __('cms::lang.lead_details')); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('modules/cms/css/cms-admin.css?v=' . config('constants.asset_version')), false); ?>">
<style>
    .lead-detail-card { background: #fff; border-radius: 10px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.06); margin-bottom: 1.5rem; }
    .lead-detail-card h5 { font-weight: 600; margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 2px solid #f0f0f0; }
    .lead-field { margin-bottom: 0.75rem; }
    .lead-field .label { font-size: 0.8rem; text-transform: uppercase; color: #636e72; font-weight: 600; letter-spacing: 0.5px; }
    .lead-field .value { font-size: 1rem; color: #2d3436; margin-top: 0.25rem; }
    .lead-badge { display: inline-block; padding: 0.3em 0.85em; border-radius: 50px; font-size: 0.85rem; font-weight: 600; }
    .lead-badge.new { background: #dfe6e9; color: #2d3436; }
    .lead-badge.contacted { background: #74b9ff; color: #fff; }
    .lead-badge.qualified { background: #ffeaa7; color: #2d3436; }
    .lead-badge.converted { background: #55efc4; color: #2d3436; }
    .lead-badge.lost { background: #fab1a0; color: #2d3436; }
    .lead-message-box { background: #f8f9fa; border-radius: 8px; padding: 1rem; border-left: 4px solid #6c5ce7; font-style: italic; }
    .status-action-btn { border-radius: 6px; margin: 0.25rem; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('cms::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header cms-page-header">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
        <h1>
            <span class="header-icon"><i class="fas fa-user"></i></span>
            <?php echo app('translator')->get('cms::lang.lead_details'); ?>
        </h1>
        <a class="btn btn-outline-secondary" href="<?php echo e(route('cms.leads.index'), false); ?>">
            <i class="fas fa-arrow-left"></i> <?php echo app('translator')->get('cms::lang.back_to_leads'); ?>
        </a>
    </div>
</section>

<section class="content cms-content">
    <div class="row">
        
        <div class="col-md-8">
            <div class="lead-detail-card">
                <h5><i class="fas fa-user-circle me-2"></i> <?php echo e($lead->name, false); ?></h5>
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="lead-field">
                            <div class="label"><?php echo app('translator')->get('cms::lang.lead_email'); ?></div>
                            <div class="value">
                                <?php if($lead->email): ?>
                                    <a href="mailto:<?php echo e($lead->email, false); ?>"><?php echo e($lead->email, false); ?></a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="lead-field">
                            <div class="label"><?php echo app('translator')->get('cms::lang.lead_mobile'); ?></div>
                            <div class="value">
                                <?php if($lead->mobile): ?>
                                    <a href="tel:<?php echo e($lead->mobile, false); ?>"><?php echo e($lead->mobile, false); ?></a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="lead-field">
                            <div class="label"><?php echo app('translator')->get('cms::lang.lead_source'); ?></div>
                            <div class="value"><?php echo e(\Modules\Cms\Entities\CmsLead::sources()[$lead->source] ?? $lead->source, false); ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="lead-field">
                            <div class="label"><?php echo app('translator')->get('cms::lang.date'); ?></div>
                            <div class="value"><?php echo e($lead->created_at->format('M d, Y H:i:s'), false); ?></div>
                        </div>
                    </div>
                    <?php if($lead->page_url): ?>
                    <div class="col-sm-12">
                        <div class="lead-field">
                            <div class="label"><?php echo app('translator')->get('cms::lang.page_url'); ?></div>
                            <div class="value"><a href="<?php echo e($lead->page_url, false); ?>" target="_blank"><?php echo e($lead->page_url, false); ?></a></div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if($lead->ip_address): ?>
                    <div class="col-sm-6">
                        <div class="lead-field">
                            <div class="label"><?php echo app('translator')->get('cms::lang.ip_address'); ?></div>
                            <div class="value"><?php echo e($lead->ip_address, false); ?></div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if($lead->message): ?>
                <div class="lead-field mt-3">
                    <div class="label"><?php echo app('translator')->get('cms::lang.lead_message'); ?></div>
                    <div class="lead-message-box mt-2"><?php echo e($lead->message, false); ?></div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="lead-detail-card">
                <h5><i class="fas fa-tasks me-2"></i> <?php echo app('translator')->get('cms::lang.lead_status'); ?></h5>
                
                <div class="text-center mb-3">
                    <span class="lead-badge <?php echo e($lead->status, false); ?>" style="font-size: 1rem;">
                        <?php echo e($statuses[$lead->status] ?? $lead->status, false); ?>

                    </span>
                </div>

                <?php if(auth()->user()->can('superadmin') || auth()->user()->can('cms.manage_leads')): ?>
                <hr>
                <p class="text-muted small"><?php echo app('translator')->get('cms::lang.update_status'); ?>:</p>
                <div class="d-flex flex-wrap justify-content-center">
                    <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statusKey => $statusLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($statusKey !== $lead->status): ?>
                        <button class="btn btn-sm btn-outline-secondary status-action-btn update-lead-status"
                            data-url="<?php echo e(route('cms.leads.update-status', $lead->id), false); ?>"
                            data-status="<?php echo e($statusKey, false); ?>">
                            <?php echo e($statusLabel, false); ?>

                        </button>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <hr>
                <div class="mt-3">
                    <label class="label"><?php echo app('translator')->get('cms::lang.lead_admin_notes'); ?></label>
                    <textarea class="form-control mt-1" id="admin_notes" rows="3" placeholder="<?php echo app('translator')->get('cms::lang.lead_admin_notes'); ?>..."><?php echo e($lead->admin_notes, false); ?></textarea>
                    <button class="btn btn-sm btn-primary mt-2 save-notes-btn"
                        data-url="<?php echo e(route('cms.leads.update-status', $lead->id), false); ?>"
                        data-current-status="<?php echo e($lead->status, false); ?>">
                        <i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>
                    </button>
                </div>
                <?php endif; ?>

                <?php if($lead->handled_by): ?>
                <hr>
                <div class="lead-field">
                    <div class="label"><?php echo app('translator')->get('cms::lang.lead_handled_by'); ?></div>
                    <div class="value">
                        <?php
                            $handler = \App\User::find($lead->handled_by);
                        ?>
                        <?php echo e($handler ? ($handler->first_name . ' ' . $handler->last_name) : '-', false); ?>

                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(document).on('click', '.update-lead-status', function() {
    var url = $(this).data('url');
    var status = $(this).data('status');
    var notes = $('#admin_notes').val();
    
    $.ajax({
        method: "POST",
        url: url,
        data: { status: status, admin_notes: notes },
        dataType: "json",
        success: function(result) {
            if (result.success) {
                toastr.success(result.msg);
                location.reload();
            } else {
                toastr.error(result.msg);
            }
        }
    });
});

$(document).on('click', '.save-notes-btn', function() {
    var url = $(this).data('url');
    var status = $(this).data('current-status');
    var notes = $('#admin_notes').val();
    
    $.ajax({
        method: "POST",
        url: url,
        data: { status: status, admin_notes: notes },
        dataType: "json",
        success: function(result) {
            if (result.success) {
                toastr.success(result.msg);
            } else {
                toastr.error(result.msg);
            }
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>