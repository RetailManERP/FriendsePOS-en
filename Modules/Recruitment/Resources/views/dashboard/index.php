

<?php $__env->startSection('title', __('recruitment::lang.recruitment_dashboard')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('recruitment::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('recruitment::lang.recruitment_dashboard'); ?></h1>
</section>

<section class="content">
    
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12 col-custom">
            <div class="info-box kpi-card-enhanced">
                <span class="info-box-icon bg-info"><i class="fas fa-briefcase"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('recruitment::lang.open_positions'); ?></span>
                    <span class="info-box-number"><?php echo e($open_jobs_count, false); ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12 col-custom">
            <div class="info-box kpi-card-enhanced">
                <span class="info-box-icon bg-success"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('recruitment::lang.total_candidates'); ?></span>
                    <span class="info-box-number"><?php echo e($total_candidates, false); ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12 col-custom">
            <div class="info-box kpi-card-enhanced">
                <span class="info-box-icon bg-warning"><i class="fas fa-file-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('recruitment::lang.active_applications'); ?></span>
                    <span class="info-box-number"><?php echo e($active_applications, false); ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12 col-custom">
            <div class="info-box kpi-card-enhanced">
                <span class="info-box-icon bg-primary"><i class="fas fa-user-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('recruitment::lang.hired_this_month'); ?></span>
                    <span class="info-box-number"><?php echo e($hired_this_month, false); ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fas fa-stream"></i>
                    <h3 class="box-title"><?php echo app('translator')->get('recruitment::lang.recruitment_pipeline'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <?php
                            $all_stages = [
                                'applied' => ['color' => 'info', 'icon' => 'fas fa-inbox'],
                                'screening' => ['color' => 'primary', 'icon' => 'fas fa-search'],
                                'shortlisted' => ['color' => 'warning', 'icon' => 'fas fa-list-ol'],
                                'interview_scheduled' => ['color' => 'primary', 'icon' => 'fas fa-calendar'],
                                'interviewed' => ['color' => 'info', 'icon' => 'fas fa-comments'],
                                'evaluation' => ['color' => 'warning', 'icon' => 'fas fa-star-half-alt'],
                                'offered' => ['color' => 'success', 'icon' => 'fas fa-file-contract'],
                            ];
                        ?>
                        <?php $__currentLoopData = $all_stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage_key => $stage_info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-sm-3 col-xs-6 text-center" style="padding: 8px;">
                                <div style="border: 2px solid #ddd; border-radius: 8px; padding: 10px;">
                                    <i class="<?php echo e($stage_info['icon'], false); ?> text-<?php echo e($stage_info['color'], false); ?>" style="font-size: 20px;"></i>
                                    <h3 style="margin:5px 0;"><?php echo e($pipeline[$stage_key] ?? 0, false); ?></h3>
                                    <small class="text-muted"><?php echo app('translator')->get('recruitment::lang.stage_' . $stage_key); ?></small>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fas fa-briefcase"></i>
                    <h3 class="box-title"><?php echo app('translator')->get('recruitment::lang.recent_open_jobs'); ?></h3>
                </div>
                <div class="box-body p-10">
                    <table class="table no-margin table-th-skin">
                        <?php $__empty_18 = true; $__currentLoopData = $recent_jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr>
                                <td>
                                    <strong><?php echo e($job->title, false); ?></strong>
                                    <br><small class="text-muted"><?php echo e($job->applications_count, false); ?> <?php echo app('translator')->get('recruitment::lang.applications'); ?></small>
                                </td>
                                <td class="text-right">
                                    <span class="badge bg-info"><?php echo e($job->num_positions, false); ?> <?php echo app('translator')->get('recruitment::lang.positions'); ?></span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                            <tr>
                                <td class="text-center"><?php echo app('translator')->get('lang_v1.no_data'); ?></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fas fa-calendar-alt"></i>
                    <h3 class="box-title"><?php echo app('translator')->get('recruitment::lang.upcoming_interviews'); ?></h3>
                </div>
                <div class="box-body p-10">
                    <table class="table no-margin table-th-skin">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('recruitment::lang.candidate'); ?></th>
                                <th><?php echo app('translator')->get('recruitment::lang.job'); ?></th>
                                <th><?php echo app('translator')->get('recruitment::lang.date'); ?></th>
                                <th><?php echo app('translator')->get('recruitment::lang.time'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $upcoming_interviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr>
                                <td><?php echo e($interview->candidate_name, false); ?></td>
                                <td><small><?php echo e($interview->job_title, false); ?></small></td>
                                <td><?php echo e(\Carbon::createFromTimestamp(strtotime($interview->interview_date))->format(session('business.date_format')), false); ?></td>
                                <td><?php echo e($interview->start_time ? \Carbon\Carbon::parse($interview->start_time)->format('h:i A') : '-', false); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                            <tr>
                                <td colspan="4" class="text-center"><?php echo app('translator')->get('recruitment::lang.no_upcoming_interviews'); ?></td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fas fa-file-contract"></i>
                    <h3 class="box-title"><?php echo app('translator')->get('recruitment::lang.pending_offers'); ?></h3>
                </div>
                <div class="box-body p-10">
                    <table class="table no-margin table-th-skin">
                        <?php $__empty_18 = true; $__currentLoopData = $pending_offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr>
                                <td>
                                    <strong><?php echo e($offer->candidate_name, false); ?></strong>
                                    <br><small class="text-muted"><?php echo e($offer->job_title, false); ?></small>
                                    <?php if($offer->offered_salary): ?>
                                        <br><small class="text-success"><?php echo e(number_format($offer->offered_salary, 2), false); ?></small>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                            <tr>
                                <td class="text-center"><?php echo app('translator')->get('recruitment::lang.no_pending_offers'); ?></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>

        
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fas fa-clipboard-check"></i>
                    <h3 class="box-title"><?php echo app('translator')->get('recruitment::lang.active_onboarding'); ?></h3>
                </div>
                <div class="box-body p-10">
                    <table class="table no-margin table-th-skin">
                        <?php $__empty_18 = true; $__currentLoopData = $active_onboardings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr>
                                <td>
                                    <strong><?php echo e($ob->candidate_name, false); ?></strong>
                                    <br><small class="text-muted"><?php echo app('translator')->get('recruitment::lang.joining'); ?>: <?php echo e(\Carbon::createFromTimestamp(strtotime($ob->joining_date))->format(session('business.date_format')), false); ?></small>
                                    <br>
                                    <?php
                                        $checks = [$ob->document_verification, $ob->equipment_assigned, $ob->access_provided, $ob->training_scheduled, $ob->policy_acknowledged];
                                        $pct = round((count(array_filter($checks)) / 5) * 100);
                                    ?>
                                    <div class="progress" style="margin:4px 0 0;height:8px;">
                                        <div class="progress-bar progress-bar-<?php echo e($pct == 100 ? 'success' : 'info', false); ?>" style="width:<?php echo e($pct, false); ?>%"></div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                            <tr>
                                <td class="text-center"><?php echo app('translator')->get('recruitment::lang.no_active_onboarding'); ?></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>