<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo app('translator')->get('recruitment::lang.onboarding_details'); ?> - <?php echo e($onboarding->candidate->full_name ?? '', false); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-condensed">
                        <tr><th style="width:40%"><?php echo app('translator')->get('recruitment::lang.candidate'); ?></th><td><?php echo e($onboarding->candidate->full_name ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.job_opening'); ?></th><td><?php echo e($onboarding->application->jobOpening->title ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.joining_date'); ?></th><td><?php echo e(\Carbon::createFromTimestamp(strtotime($onboarding->joining_date))->format(session('business.date_format')), false); ?></td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-condensed">
                        <tr><th style="width:40%"><?php echo app('translator')->get('recruitment::lang.status'); ?></th><td>
                            <?php
                                $status_colors = ['pending' => 'warning', 'in_progress' => 'info', 'completed' => 'success', 'cancelled' => 'danger'];
                            ?>
                            <span class="badge bg-<?php echo e($status_colors[$onboarding->status] ?? 'default', false); ?>">
                                <?php echo e(\Modules\Recruitment\Entities\RecruitmentOnboarding::statuses()[$onboarding->status] ?? $onboarding->status, false); ?>

                            </span>
                        </td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.assigned_buddy'); ?></th><td><?php echo e($onboarding->buddy->user_full_name ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.progress'); ?></th><td>
                            <div class="progress" style="margin-bottom:0;">
                                <div class="progress-bar progress-bar-<?php echo e($onboarding->completion_percent == 100 ? 'success' : 'info', false); ?>"
                                     role="progressbar" style="width: <?php echo e($onboarding->completion_percent, false); ?>%">
                                    <?php echo e($onboarding->completion_percent, false); ?>%
                                </div>
                            </div>
                        </td></tr>
                    </table>
                </div>
            </div>

            <h4><?php echo app('translator')->get('recruitment::lang.onboarding_checklist'); ?></h4>
            <table class="table table-bordered">
                <tr>
                    <td style="width:40%"><?php echo app('translator')->get('recruitment::lang.document_verification'); ?></td>
                    <td>
                        <?php if($onboarding->document_verification): ?>
                            <i class="fas fa-check-circle text-success"></i> <?php echo app('translator')->get('recruitment::lang.completed'); ?>
                        <?php else: ?>
                            <i class="fas fa-times-circle text-danger"></i> <?php echo app('translator')->get('recruitment::lang.pending'); ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('recruitment::lang.equipment_assigned'); ?></td>
                    <td>
                        <?php if($onboarding->equipment_assigned): ?>
                            <i class="fas fa-check-circle text-success"></i> <?php echo app('translator')->get('recruitment::lang.completed'); ?>
                        <?php else: ?>
                            <i class="fas fa-times-circle text-danger"></i> <?php echo app('translator')->get('recruitment::lang.pending'); ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('recruitment::lang.access_provided'); ?></td>
                    <td>
                        <?php if($onboarding->access_provided): ?>
                            <i class="fas fa-check-circle text-success"></i> <?php echo app('translator')->get('recruitment::lang.completed'); ?>
                        <?php else: ?>
                            <i class="fas fa-times-circle text-danger"></i> <?php echo app('translator')->get('recruitment::lang.pending'); ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('recruitment::lang.training_scheduled'); ?></td>
                    <td>
                        <?php if($onboarding->training_scheduled): ?>
                            <i class="fas fa-check-circle text-success"></i> <?php echo app('translator')->get('recruitment::lang.completed'); ?>
                        <?php else: ?>
                            <i class="fas fa-times-circle text-danger"></i> <?php echo app('translator')->get('recruitment::lang.pending'); ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('recruitment::lang.policy_acknowledged'); ?></td>
                    <td>
                        <?php if($onboarding->policy_acknowledged): ?>
                            <i class="fas fa-check-circle text-success"></i> <?php echo app('translator')->get('recruitment::lang.completed'); ?>
                        <?php else: ?>
                            <i class="fas fa-times-circle text-danger"></i> <?php echo app('translator')->get('recruitment::lang.pending'); ?>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>

            <?php if($onboarding->checklist_notes): ?>
            <strong><?php echo app('translator')->get('recruitment::lang.checklist_notes'); ?>:</strong>
            <p><?php echo nl2br(e($onboarding->checklist_notes)); ?></p>
            <?php endif; ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
    </div>
</div>
