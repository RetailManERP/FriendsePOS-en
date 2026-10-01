<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo e($candidate->full_name, false); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-condensed">
                        <tr><th style="width:40%"><?php echo app('translator')->get('business.email'); ?></th><td><?php echo e($candidate->email ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('contact.mobile'); ?></th><td><?php echo e($candidate->phone ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.source'); ?></th><td><?php echo e(\Modules\Recruitment\Entities\RecruitmentCandidate::sources()[$candidate->source] ?? $candidate->source ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.current_company'); ?></th><td><?php echo e($candidate->current_company ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.current_designation'); ?></th><td><?php echo e($candidate->current_designation ?? '-', false); ?></td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-condensed">
                        <tr><th style="width:40%"><?php echo app('translator')->get('recruitment::lang.experience'); ?></th><td><?php echo e($candidate->experience_years ? $candidate->experience_years . ' years' : '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.current_salary'); ?></th><td><?php echo e($candidate->current_salary ? number_format($candidate->current_salary, 2) : '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.expected_salary'); ?></th><td><?php echo e($candidate->expected_salary ? number_format($candidate->expected_salary, 2) : '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.highest_qualification'); ?></th><td><?php echo e($candidate->highest_qualification ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.skills'); ?></th><td>
                            <?php $__currentLoopData = $candidate->skills_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge bg-info"><?php echo e($skill, false); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(empty($candidate->skills_array)): ?> - <?php endif; ?>
                        </td></tr>
                    </table>
                </div>
            </div>

            <?php if($candidate->applications->count() > 0): ?>
                <h4><?php echo app('translator')->get('recruitment::lang.application_history'); ?></h4>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('recruitment::lang.job'); ?></th>
                            <th><?php echo app('translator')->get('recruitment::lang.applied_date'); ?></th>
                            <th><?php echo app('translator')->get('recruitment::lang.stage'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $candidate->applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($app->jobOpening->title ?? '-', false); ?></td>
                                <td><?php echo e(\Carbon::createFromTimestamp(strtotime($app->applied_date))->format(session('business.date_format')), false); ?></td>
                                <td>
                                    <?php $color = \Modules\Recruitment\Entities\RecruitmentApplication::stageBadgeColor($app->stage); ?>
                                    <span class="badge bg-<?php echo e($color, false); ?>"><?php echo e(\Modules\Recruitment\Entities\RecruitmentApplication::stages()[$app->stage] ?? $app->stage, false); ?></span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>

            <?php if($candidate->notes): ?>
                <h4><?php echo app('translator')->get('recruitment::lang.notes'); ?></h4>
                <p><?php echo nl2br(e($candidate->notes)); ?></p>
            <?php endif; ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
    </div>
</div>
