<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo e($job->title, false); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-condensed">
                        <tr><th style="width:40%"><?php echo app('translator')->get('recruitment::lang.reference_no'); ?></th><td><?php echo e($job->reference_no ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.department'); ?></th><td><?php echo e($job->department->name ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.designation'); ?></th><td><?php echo e($job->designation->name ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.location'); ?></th><td><?php echo e($job->location->name ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.employment_type'); ?></th><td><?php echo e(\Modules\Recruitment\Entities\RecruitmentJobOpening::employmentTypes()[$job->employment_type] ?? $job->employment_type, false); ?></td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-condensed">
                        <tr><th style="width:40%"><?php echo app('translator')->get('recruitment::lang.positions'); ?></th><td><?php echo e($job->num_positions, false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('sale.status'); ?></th><td>
                            <?php $colors = ['draft'=>'secondary','open'=>'success','on_hold'=>'warning','closed'=>'danger','cancelled'=>'dark']; ?>
                            <span class="badge bg-<?php echo e($colors[$job->status] ?? 'default', false); ?>"><?php echo e(\Modules\Recruitment\Entities\RecruitmentJobOpening::statuses()[$job->status] ?? $job->status, false); ?></span>
                        </td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.salary_range'); ?></th><td><?php echo e($job->salary_min ? number_format($job->salary_min,2) . ' - ' . number_format($job->salary_max,2) : '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.opening_date'); ?></th><td><?php echo e($job->opening_date ? \Carbon::createFromTimestamp(strtotime($job->opening_date))->format(session('business.date_format')) : '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.closing_date'); ?></th><td><?php echo e($job->closing_date ? \Carbon::createFromTimestamp(strtotime($job->closing_date))->format(session('business.date_format')) : '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.hiring_manager'); ?></th><td><?php echo e($job->hiringManager->user_full_name ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.total_applications'); ?></th><td><span class="badge bg-info"><?php echo e($job->applications_count, false); ?></span></td></tr>
                    </table>
                </div>
            </div>
            <?php if($job->description): ?>
                <h4><?php echo app('translator')->get('recruitment::lang.job_description'); ?></h4>
                <p><?php echo nl2br(e($job->description)); ?></p>
            <?php endif; ?>
            <?php if($job->requirements): ?>
                <h4><?php echo app('translator')->get('recruitment::lang.requirements'); ?></h4>
                <p><?php echo nl2br(e($job->requirements)); ?></p>
            <?php endif; ?>
            <?php if($job->benefits): ?>
                <h4><?php echo app('translator')->get('recruitment::lang.benefits'); ?></h4>
                <p><?php echo nl2br(e($job->benefits)); ?></p>
            <?php endif; ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
    </div>
</div>
