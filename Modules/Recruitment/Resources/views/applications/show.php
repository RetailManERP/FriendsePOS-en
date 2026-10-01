<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo app('translator')->get('recruitment::lang.application'); ?> #<?php echo e($application->application_ref, false); ?></h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-md-6">
                    <h4><?php echo app('translator')->get('recruitment::lang.candidate_info'); ?></h4>
                    <table class="table table-condensed">
                        <tr><th style="width:35%"><?php echo app('translator')->get('lang_v1.name'); ?></th><td><?php echo e($application->candidate->full_name ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('business.email'); ?></th><td><?php echo e($application->candidate->email ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('contact.mobile'); ?></th><td><?php echo e($application->candidate->phone ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.experience'); ?></th><td><?php echo e($application->candidate->experience_years ? $application->candidate->experience_years . ' years' : '-', false); ?></td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h4><?php echo app('translator')->get('recruitment::lang.job_info'); ?></h4>
                    <table class="table table-condensed">
                        <tr><th style="width:35%"><?php echo app('translator')->get('recruitment::lang.job_title'); ?></th><td><?php echo e($application->jobOpening->title ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.department'); ?></th><td><?php echo e($application->jobOpening->department->name ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.employment_type'); ?></th><td><?php echo e(\Modules\Recruitment\Entities\RecruitmentJobOpening::employmentTypes()[$application->jobOpening->employment_type] ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.applied_date'); ?></th><td><?php echo e(\Carbon::createFromTimestamp(strtotime($application->applied_date))->format(session('business.date_format')), false); ?></td></tr>
                    </table>
                </div>
            </div>

            
            <div class="row">
                <div class="col-md-12">
                    <h4><?php echo app('translator')->get('recruitment::lang.current_stage'); ?></h4>
                    <?php $color = \Modules\Recruitment\Entities\RecruitmentApplication::stageBadgeColor($application->stage); ?>
                    <span class="badge bg-<?php echo e($color, false); ?>" style="font-size:14px; padding:6px 12px;">
                        <?php echo e(\Modules\Recruitment\Entities\RecruitmentApplication::stages()[$application->stage] ?? $application->stage, false); ?>

                    </span>
                    <?php if($application->rating): ?>
                        &nbsp;&nbsp; <strong><?php echo app('translator')->get('recruitment::lang.rating'); ?>:</strong> <?php echo e($application->rating, false); ?>/5
                    <?php endif; ?>
                    <?php if($application->assigned_to): ?>
                        &nbsp;&nbsp; <strong><?php echo app('translator')->get('recruitment::lang.assigned_to'); ?>:</strong> <?php echo e($application->assignedTo->user_full_name ?? '-', false); ?>

                    <?php endif; ?>
                </div>
            </div>

            
            <?php if($is_admin): ?>
            <div class="row" style="margin-top:15px;">
                <div class="col-md-12">
                    <h4><?php echo app('translator')->get('recruitment::lang.change_stage'); ?></h4>
                    <div class="btn-group">
                        <?php $__currentLoopData = \Modules\Recruitment\Entities\RecruitmentApplication::stages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($key != $application->stage): ?>
                                <button type="button" class="btn btn-sm btn-<?php echo e(\Modules\Recruitment\Entities\RecruitmentApplication::stageBadgeColor($key), false); ?> change-stage-btn"
                                    data-href="<?php echo e(action([\Modules\Recruitment\Http\Controllers\ApplicationController::class, 'updateStage'], [$application->id]), false); ?>"
                                    data-stage="<?php echo e($key, false); ?>">
                                    <?php echo e($label, false); ?>

                                </button>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            
            <?php if($application->interviews->count() > 0): ?>
            <div class="row" style="margin-top:15px;">
                <div class="col-md-12">
                    <h4><?php echo app('translator')->get('recruitment::lang.interviews'); ?></h4>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('recruitment::lang.interview_type'); ?></th>
                                <th><?php echo app('translator')->get('recruitment::lang.interview_date'); ?></th>
                                <th><?php echo app('translator')->get('recruitment::lang.status'); ?></th>
                                <th><?php echo app('translator')->get('recruitment::lang.recommendation'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $application->interviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(\Modules\Recruitment\Entities\RecruitmentInterview::interviewTypes()[$interview->interview_type] ?? $interview->interview_type, false); ?></td>
                                <td><?php echo e(\Carbon::createFromTimestamp(strtotime($interview->interview_date))->format(session('business.date_format')), false); ?> <?php echo e($interview->start_time ? \Carbon\Carbon::parse($interview->start_time)->format('h:i A') : '', false); ?></td>
                                <td><?php echo e(\Modules\Recruitment\Entities\RecruitmentInterview::statuses()[$interview->status] ?? $interview->status, false); ?></td>
                                <td><?php echo e(\Modules\Recruitment\Entities\RecruitmentInterview::recommendations()[$interview->recommendation] ?? $interview->recommendation ?? '-', false); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            
            <?php if($application->offers->count() > 0): ?>
            <div class="row" style="margin-top:15px;">
                <div class="col-md-12">
                    <h4><?php echo app('translator')->get('recruitment::lang.offers'); ?></h4>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('recruitment::lang.offer_ref'); ?></th>
                                <th><?php echo app('translator')->get('recruitment::lang.offered_salary'); ?></th>
                                <th><?php echo app('translator')->get('recruitment::lang.offer_date'); ?></th>
                                <th><?php echo app('translator')->get('recruitment::lang.valid_until'); ?></th>
                                <th><?php echo app('translator')->get('recruitment::lang.status'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $application->offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($offer->offer_ref ?? '-', false); ?></td>
                                <td><?php echo e($offer->offered_salary ? number_format($offer->offered_salary, 2) : '-', false); ?></td>
                                <td><?php echo e(\Carbon::createFromTimestamp(strtotime($offer->offer_date))->format(session('business.date_format')), false); ?></td>
                                <td><?php echo e(\Carbon::createFromTimestamp(strtotime($offer->valid_until))->format(session('business.date_format')), false); ?></td>
                                <td><?php echo e(\Modules\Recruitment\Entities\RecruitmentOffer::statuses()[$offer->status] ?? $offer->status, false); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            
            <?php if($application->stage_notes): ?>
            <div class="row" style="margin-top:15px;">
                <div class="col-md-12">
                    <h4><?php echo app('translator')->get('recruitment::lang.notes'); ?></h4>
                    <p><?php echo nl2br(e($application->stage_notes)); ?></p>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.change-stage-btn').click(function() {
            var url = $(this).data('href');
            var stage = $(this).data('stage');
            $.ajax({
                method: 'POST', url: url, data: { stage: stage }, dataType: 'json',
                success: function(result) {
                    if (result.success) {
                        $('div.recruitment_modal').modal('hide');
                        toastr.success(result.msg);
                        if (typeof applications_table !== 'undefined') applications_table.ajax.reload();
                    } else { toastr.error(result.msg); }
                },
            });
        });
    });
</script>
