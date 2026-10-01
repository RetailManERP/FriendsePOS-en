
<?php $__env->startSection('title', __('cms::lang.contact_leads')); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('modules/cms/css/cms-admin.css?v=' . config('constants.asset_version')), false); ?>">
<style>
    .lead-stats { display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 1.5rem; }
    .lead-stat-card { flex: 1; min-width: 180px; background: #fff; border-radius: 10px; padding: 1.25rem; box-shadow: 0 2px 8px rgba(0,0,0,0.06); border-left: 4px solid #6c5ce7; }
    .lead-stat-card.new { border-left-color: #00b894; }
    .lead-stat-card.monthly { border-left-color: #0984e3; }
    .lead-stat-card.rate { border-left-color: #e17055; }
    .lead-stat-card .stat-value { font-size: 1.75rem; font-weight: 700; color: #2d3436; }
    .lead-stat-card .stat-label { font-size: 0.85rem; color: #636e72; margin-top: 0.25rem; }
    .lead-badge { display: inline-block; padding: 0.25em 0.75em; border-radius: 50px; font-size: 0.8rem; font-weight: 600; }
    .lead-badge.new { background: #dfe6e9; color: #2d3436; }
    .lead-badge.contacted { background: #74b9ff; color: #fff; }
    .lead-badge.qualified { background: #ffeaa7; color: #2d3436; }
    .lead-badge.converted { background: #55efc4; color: #2d3436; }
    .lead-badge.lost { background: #fab1a0; color: #2d3436; }
    .lead-actions-bar { display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap; margin-bottom: 1rem; }
    .lead-filter { border-radius: 6px; padding: 0.4rem 0.75rem; border: 1px solid #ddd; font-size: 0.9rem; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('cms::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header cms-page-header">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
        <h1>
            <span class="header-icon"><i class="fas fa-address-book"></i></span>
            <?php echo app('translator')->get('cms::lang.contact_leads'); ?>
        </h1>
        <?php if(auth()->user()->can('superadmin') || auth()->user()->can('cms.manage_leads')): ?>
        <a class="cms-add-btn" href="<?php echo e(route('cms.leads.export'), false); ?>">
            <i class="fas fa-download"></i> <?php echo app('translator')->get('cms::lang.export_leads'); ?>
        </a>
        <?php endif; ?>
    </div>
</section>

<section class="content cms-content">
    
    <div class="lead-stats">
        <div class="lead-stat-card">
            <div class="stat-value"><?php echo e($total_leads, false); ?></div>
            <div class="stat-label"><?php echo app('translator')->get('cms::lang.all_leads'); ?></div>
        </div>
        <div class="lead-stat-card new">
            <div class="stat-value"><?php echo e($new_leads, false); ?></div>
            <div class="stat-label"><?php echo app('translator')->get('cms::lang.new_leads'); ?></div>
        </div>
        <div class="lead-stat-card monthly">
            <div class="stat-value"><?php echo e($this_month_leads, false); ?></div>
            <div class="stat-label"><?php echo app('translator')->get('cms::lang.this_month_leads'); ?></div>
        </div>
        <div class="lead-stat-card rate">
            <div class="stat-value"><?php echo e($conversion_rate, false); ?>%</div>
            <div class="stat-label"><?php echo app('translator')->get('cms::lang.conversion_rate'); ?></div>
        </div>
    </div>

    
    <div class="lead-actions-bar">
        <form method="GET" action="<?php echo e(route('cms.leads.index'), false); ?>" class="d-flex gap-2 flex-wrap">
            <select name="status" class="lead-filter" onchange="this.form.submit()">
                <option value=""><?php echo app('translator')->get('cms::lang.all_statuses'); ?></option>
                <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key, false); ?>" <?php if($status_filter == $key): ?> selected <?php endif; ?>><?php echo e($label, false); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select name="source" class="lead-filter" onchange="this.form.submit()">
                <option value=""><?php echo app('translator')->get('cms::lang.all_sources'); ?></option>
                <?php $__currentLoopData = $sources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key, false); ?>" <?php if($source_filter == $key): ?> selected <?php endif; ?>><?php echo e($label, false); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </form>
    </div>

    
    <div class="card radius-10 cms-card">
        <div class="card-body p-0">
            <?php if($leads->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo app('translator')->get('cms::lang.lead_name'); ?></th>
                            <th><?php echo app('translator')->get('cms::lang.lead_email'); ?></th>
                            <th><?php echo app('translator')->get('cms::lang.lead_mobile'); ?></th>
                            <th><?php echo app('translator')->get('cms::lang.lead_source'); ?></th>
                            <th><?php echo app('translator')->get('cms::lang.lead_status'); ?></th>
                            <th><?php echo app('translator')->get('cms::lang.date'); ?></th>
                            <th><?php echo app('translator')->get('messages.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($lead->id, false); ?></td>
                            <td><strong><?php echo e($lead->name, false); ?></strong></td>
                            <td><?php echo e($lead->email ?? '-', false); ?></td>
                            <td><?php echo e($lead->mobile ?? '-', false); ?></td>
                            <td><?php echo e($sources[$lead->source] ?? $lead->source, false); ?></td>
                            <td>
                                <span class="lead-badge <?php echo e($lead->status, false); ?>">
                                    <?php echo e($statuses[$lead->status] ?? $lead->status, false); ?>

                                </span>
                            </td>
                            <td><?php echo e($lead->created_at->format('M d, Y H:i'), false); ?></td>
                            <td>
                                <a href="<?php echo e(route('cms.leads.show', $lead->id), false); ?>" class="btn btn-sm btn-outline-primary" title="<?php echo app('translator')->get('messages.view'); ?>">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <?php if(auth()->user()->can('superadmin') || auth()->user()->can('cms.manage_leads')): ?>
                                <button class="btn btn-sm btn-outline-danger delete-lead" data-href="<?php echo e(route('cms.leads.destroy', $lead->id), false); ?>" title="<?php echo app('translator')->get('messages.delete'); ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                <?php echo e($leads->appends(request()->query())->links(), false); ?>

            </div>
            <?php else: ?>
            <div class="text-center p-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <p class="text-muted"><?php echo app('translator')->get('cms::lang.no_leads_found'); ?></p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(document).on('click', '.delete-lead', function() {
    var url = $(this).data('href');
    swal({
        title: LANG.sure,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((confirmed) => {
        if (confirmed) {
            $.ajax({
                method: "DELETE",
                url: url,
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
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>