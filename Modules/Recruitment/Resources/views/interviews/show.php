<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo app('translator')->get('recruitment::lang.interview_details'); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-condensed">
                        <tr><th style="width:40%"><?php echo app('translator')->get('recruitment::lang.candidate'); ?></th><td><?php echo e($interview->application->candidate->full_name ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.job_opening'); ?></th><td><?php echo e($interview->application->jobOpening->title ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.interview_type'); ?></th><td><?php echo e(\Modules\Recruitment\Entities\RecruitmentInterview::interviewTypes()[$interview->interview_type] ?? $interview->interview_type, false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.interview_date'); ?></th><td><?php echo e(\Carbon::createFromTimestamp(strtotime($interview->interview_date))->format(session('business.date_format')), false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.time'); ?></th><td>
                            <?php echo e($interview->start_time ? \Carbon\Carbon::parse($interview->start_time)->format('h:i A') : '-', false); ?>

                            <?php if($interview->end_time): ?> - <?php echo e(\Carbon\Carbon::parse($interview->end_time)->format('h:i A'), false); ?> <?php endif; ?>
                        </td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-condensed">
                        <tr><th style="width:40%"><?php echo app('translator')->get('recruitment::lang.status'); ?></th><td><?php echo e(\Modules\Recruitment\Entities\RecruitmentInterview::statuses()[$interview->status] ?? $interview->status, false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.interview_location'); ?></th><td><?php echo e($interview->location ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.meeting_link'); ?></th><td>
                            <?php if($interview->meeting_link): ?> <a href="<?php echo e($interview->meeting_link, false); ?>" target="_blank"><?php echo e($interview->meeting_link, false); ?></a> <?php else: ?> - <?php endif; ?>
                        </td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.overall_rating'); ?></th><td><?php echo e($interview->overall_rating ? $interview->overall_rating . '/5' : '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.recommendation'); ?></th><td>
                            <?php if($interview->recommendation): ?>
                                <?php echo e(\Modules\Recruitment\Entities\RecruitmentInterview::recommendations()[$interview->recommendation] ?? $interview->recommendation, false); ?>

                            <?php else: ?> - <?php endif; ?>
                        </td></tr>
                    </table>
                </div>
            </div>

            <?php if($interview->interviewers && count($interview->interviewers) > 0): ?>
            <div class="row">
                <div class="col-md-12">
                    <strong><?php echo app('translator')->get('recruitment::lang.interviewers'); ?>:</strong>
                    <?php $__currentLoopData = $interview->interviewers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interviewer_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $interviewer = \App\User::find($interviewer_id); ?>
                        <?php if($interviewer): ?>
                            <span class="badge bg-primary"><?php echo e($interviewer->user_full_name, false); ?></span>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if($interview->feedback): ?>
            <div class="row" style="margin-top:15px;">
                <div class="col-md-12">
                    <strong><?php echo app('translator')->get('recruitment::lang.feedback'); ?>:</strong>
                    <p><?php echo nl2br(e($interview->feedback)); ?></p>
                </div>
            </div>
            <?php endif; ?>

            <?php if($interview->notes): ?>
            <div class="row" style="margin-top:10px;">
                <div class="col-md-12">
                    <strong><?php echo app('translator')->get('recruitment::lang.notes'); ?>:</strong>
                    <p><?php echo nl2br(e($interview->notes)); ?></p>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
    </div>
</div>
