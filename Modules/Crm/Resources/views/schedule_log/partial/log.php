<?php if($modal_content): ?>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    Follow Up Log <span class="text-info"><?php echo e($schedule->title, false); ?></span> <br/>
                    <span class="text-info"><?php echo e($schedule->customer->full_name_with_business, false); ?></span>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
<?php endif; ?>

<div class="col-md-12" style="margin-bottom: 5px;">
    <?php echo $__env->make('crm::schedule.partial.schedule_info_invoices', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<!-- if call log enabled get the log with this user. -->
<?php if(config('constants.enable_crm_call_log')): ?>
    <table class="table table-bordered table-th-skin">
        <tr>
            <th><?php echo app('translator')->get('restaurant.start_time'); ?></th>
            <th><?php echo app('translator')->get('restaurant.end_time'); ?></th>
            <th><?php echo app('translator')->get('crm::lang.call_duration'); ?></th>
            <th><?php echo app('translator')->get('crm::lang.call_type'); ?></th>
            <th><?php echo app('translator')->get('lang_v1.contact_no'); ?></th>
            <th><?php echo app('translator')->get('crm::lang.call_log_created_by'); ?></th>
        </tr>

        <?php $__currentLoopData = $call_logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $call_log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($call_log->start_time, false); ?></td>
                <td><?php echo e($call_log->end_time, false); ?></td>
                <td>
                    <?php if(empty($call_log->duration)): ?>
                        <?php echo e(Carbon\CarbonInterval::seconds($call_log->duration)->cascade()->forHumans(), false); ?>

                    <?php endif; ?>
                </td>
                <td><?php echo e($call_log->call_type, false); ?></td>
                <td><?php echo e($call_log->mobile_number, false); ?> <br/> <?php echo e($call_log->mobile_name, false); ?></td>
                <td><?php echo e($call_log->created_user_name, false); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(count($call_logs) == 0): ?>
            <tr>
                <td colspan="6" class="text-center">
                    <?php echo app('translator')->get('lang_v1.no_data'); ?>
                </td>
            </tr>
        <?php endif; ?>
    </table>
<?php endif; ?>

<div class="col-md-12">
<ul class="timeline">
<?php if($schedule_logs->count() > 0): ?>
    <?php $__currentLoopData = $schedule_logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule_log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <!-- timeline time label -->
        <li class="time-label">
            <span class="bg-red">
                <?php echo format_datetime_br($schedule_log->created_at); ?>

            </span>
        </li>
        <!-- /.timeline-label -->

        <!-- timeline item -->
        <li>
            <!-- timeline icon -->
            <i class="
                <?php if($schedule_log->log_type == 'email'): ?>
                    fa fa-envelope
                <?php elseif($schedule_log->log_type == 'call'): ?>
                    fas fa fa-phone-alt
                <?php elseif($schedule_log->log_type == 'sms'): ?>
                    fas fa fa-sms
                <?php elseif($schedule_log->log_type == 'meeting'): ?>
                    fas fa fa-handshake
                <?php endif; ?>
                <?php if($schedule_log->created_at == $schedule_log->updated_at): ?>
                    bg-green
                <?php else: ?>
                    bg-blue
                <?php endif; ?>
                " data-bs-toggle="tooltip" title="<?php echo app('translator')->get('crm::lang.'.$schedule_log->log_type); ?>">
            </i>
            <div class="timeline-item">
                <span class="time pa-0">
                    <span>
                        <i class="fas fa-pen"></i>
                        <?php echo e($schedule_log->createdBy->user_full_name, false); ?>

                    </span><br>
                    <i class="fas fa-clock"></i>
                    <?php echo format_datetime_br($schedule_log->start_datetime); ?> ~ <?php echo format_datetime_br($schedule_log->end_datetime); ?>

                </span>

                <h3 class="timeline-header">
                    <a class="cursor-pointer view_a_schedule_log" data-href="<?php echo e(action([\Modules\Crm\Http\Controllers\ScheduleLogController::class, 'show'], ['follow_up_log' => $schedule_log->id, 'schedule_id' => $schedule_log->schedule_id]), false); ?>">
                        <?php echo e($schedule_log->subject, false); ?>

                    </a>
                </h3>

                <div class="timeline-body">
                    <?php echo $schedule_log->description; ?>

                </div>

                <div class="timeline-footer">
                    
                    <i class="fa fa-eye cursor-pointer m-5 text-info view_a_schedule_log" data-href="<?php echo e(action([\Modules\Crm\Http\Controllers\ScheduleLogController::class, 'show'], ['follow_up_log' => $schedule_log->id, 'schedule_id' => $schedule_log->schedule_id]), false); ?>"></i>
                
                
                    <i class="fa fa-edit cursor-pointer m-5 text-primary edit_schedule_log" data-href="<?php echo e(action([\Modules\Crm\Http\Controllers\ScheduleLogController::class, 'edit'], ['follow_up_log' => $schedule_log->id, 'schedule_id' => $schedule_log->schedule_id]), false); ?>"></i>
            
              
                    <i class="fas fa-trash cursor-pointer m-5 text-danger delete_schedule_log" data-href="<?php echo e(action([\Modules\Crm\Http\Controllers\ScheduleLogController::class, 'destroy'], ['follow_up_log' => $schedule_log->id, 'schedule_id' => $schedule_log->schedule_id]), false); ?>"></i>
                    
                </div>
            </div>
        </li>
        <!-- END timeline item -->
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
<?php else: ?>
    <li>
        <div class="timeline-item">
            <div class="timeline-body">
                <span class="text-info"><?php echo app('translator')->get('crm::lang.no_log_found'); ?></span>
            </div>
        </div>
    </li>
<?php endif; ?>
</ul>
</div>

<?php if($modal_content): ?>
            </div>
        </div>
    </div>
</div></div>
<?php endif; ?>
