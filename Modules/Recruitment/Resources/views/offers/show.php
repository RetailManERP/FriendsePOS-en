<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo app('translator')->get('recruitment::lang.offer_details'); ?> - <?php echo e($offer->offer_ref, false); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-condensed">
                        <tr><th style="width:40%"><?php echo app('translator')->get('recruitment::lang.candidate'); ?></th><td><?php echo e($offer->application->candidate->full_name ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.job_opening'); ?></th><td><?php echo e($offer->application->jobOpening->title ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.offer_ref'); ?></th><td><?php echo e($offer->offer_ref ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.offered_salary'); ?></th><td><?php echo e($offer->offered_salary ? number_format($offer->offered_salary, 2) : '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.salary_period'); ?></th><td><?php echo e($offer->salary_period ? __('recruitment::lang.' . $offer->salary_period) : '-', false); ?></td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-condensed">
                        <tr><th style="width:40%"><?php echo app('translator')->get('recruitment::lang.offer_date'); ?></th><td><?php echo e(\Carbon::createFromTimestamp(strtotime($offer->offer_date))->format(session('business.date_format')), false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.valid_until'); ?></th><td><?php echo e($offer->valid_until ? \Carbon::createFromTimestamp(strtotime($offer->valid_until))->format(session('business.date_format')) : '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.expected_joining_date'); ?></th><td><?php echo e($offer->expected_joining_date ? \Carbon::createFromTimestamp(strtotime($offer->expected_joining_date))->format(session('business.date_format')) : '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.status'); ?></th><td>
                            <?php
                                $status_colors = ['draft' => 'default', 'sent' => 'info', 'accepted' => 'success', 'declined' => 'danger', 'negotiating' => 'warning', 'expired' => 'default', 'withdrawn' => 'danger'];
                            ?>
                            <span class="badge bg-<?php echo e($status_colors[$offer->status] ?? 'default', false); ?>">
                                <?php echo e(\Modules\Recruitment\Entities\RecruitmentOffer::statuses()[$offer->status] ?? $offer->status, false); ?>

                            </span>
                        </td></tr>
                        <tr><th><?php echo app('translator')->get('recruitment::lang.responded_at'); ?></th><td><?php echo e($offer->responded_at ? \Carbon::createFromTimestamp(strtotime($offer->responded_at))->format(session('business.date_format')) : '-', false); ?></td></tr>
                    </table>
                </div>
            </div>

            <?php if($offer->terms_and_conditions): ?>
            <div class="row">
                <div class="col-md-12">
                    <strong><?php echo app('translator')->get('recruitment::lang.terms_and_conditions'); ?>:</strong>
                    <p><?php echo nl2br(e($offer->terms_and_conditions)); ?></p>
                </div>
            </div>
            <?php endif; ?>

            <?php if($offer->benefits_offered): ?>
            <div class="row" style="margin-top:10px;">
                <div class="col-md-12">
                    <strong><?php echo app('translator')->get('recruitment::lang.benefits_offered'); ?>:</strong>
                    <p><?php echo nl2br(e($offer->benefits_offered)); ?></p>
                </div>
            </div>
            <?php endif; ?>

            <?php if($offer->candidate_remarks): ?>
            <div class="row" style="margin-top:10px;">
                <div class="col-md-12">
                    <strong><?php echo app('translator')->get('recruitment::lang.candidate_remarks'); ?>:</strong>
                    <p><?php echo nl2br(e($offer->candidate_remarks)); ?></p>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
    </div>
</div>
