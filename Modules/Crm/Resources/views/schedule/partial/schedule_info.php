<div class="row">
    <div class="col-md-12">

        <input type="hidden" name="view_type" value="schedule_info" id="view_type">
        <button type="button" class="btn btn-sm btn-danger schedule_delete float-end m-5" data-href="<?php echo e(action([\Modules\Crm\Http\Controllers\ScheduleController::class, 'destroy'], ['follow_up' => $schedule->id]), false); ?>">
            <i class="fas fa-trash"></i>
            <?php echo app('translator')->get('messages.delete'); ?>
        </button>
        <button type="button" class="btn btn-sm btn-primary schedule_edit float-end m-5" data-href="<?php echo e(action([\Modules\Crm\Http\Controllers\ScheduleController::class, 'edit'], ['follow_up' => $schedule->id]), false); ?>?schedule_for=schedule_info">
            <i class="fa fa-edit"></i>
            <?php echo app('translator')->get('messages.edit'); ?>
        </button>
    </div>
    <?php if(!empty($schedule->description)): ?>
    <div class="col-md-12 mt-5">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $schedule->description; ?>

            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="col-md-12 mt-5">
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-3">
                    <strong><i class="fas fa-calendar-check"></i></i>
                        <?php echo app('translator')->get('crm::lang.start_datetime'); ?>
                    </strong>
                    <p class="text-muted">
                        <?php echo format_datetime_br($schedule->start_datetime); ?>

                    </p>
                    <strong><i class="fas fa-calendar-check"></i></i>
                        <?php echo app('translator')->get('crm::lang.end_datetime'); ?>
                    </strong>
                    <p class="text-muted">
                        <?php echo format_datetime_br($schedule->end_datetime); ?>

                    </p>
                </div>
                <div class="col-md-3">
                    <?php if(!empty($schedule->status)): ?>
                        <strong><i class="fas fa-check-circle"></i></i>
                            <?php echo app('translator')->get('sale.status'); ?>
                        </strong>
                        <p class="text-muted">
                            <?php echo app('translator')->get('crm::lang.'.$schedule->status); ?>
                        </p>
                    <?php endif; ?>
                    <strong><i class="fas fa-flag"></i></i>
                        <?php echo app('translator')->get('crm::lang.schedule_type'); ?>
                    </strong>
                    <p class="text-muted">
                        <?php echo app('translator')->get('crm::lang.'.$schedule->schedule_type); ?>
                    </p>
                    <?php if($schedule->allow_notification): ?>
                        <strong><i class="fas fa-bell"></i></i>
                            <?php echo app('translator')->get('crm::lang.notify_via'); ?>
                        </strong>
                        <p class="text-muted">
                            <?php if($schedule->notify_via['mail']): ?>
                                <?php echo app('translator')->get('crm::lang.email'); ?>
                                <?php if($schedule->notify_via['sms']): ?>
                                    <?php echo e(', ', false); ?>

                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if($schedule->notify_via['sms']): ?>
                                <?php echo app('translator')->get('crm::lang.sms'); ?>
                            <?php endif; ?>
                        </p>
                    <?php endif; ?>
                </div>
                <?php if($schedule->allow_notification): ?>
                    <div class="col-md-3">
                        <strong><i class="fas fa-flag-checkered"></i></i>
                            <?php echo app('translator')->get('crm::lang.notify_before'); ?>
                        </strong>
                        <p class="text-muted">
                            <?php echo e($schedule->notify_before, false); ?>

                            <?php if($schedule->notify_type != 'day'): ?>
                                <?php echo app('translator')->get('crm::lang.'.$schedule->notify_type); ?>
                            <?php else: ?>
                                <?php echo app('translator')->get('lang_v1.'.$schedule->notify_type); ?>
                            <?php endif; ?>
                        </p>
                    </div>
                <?php endif; ?>
                <div class="col-md-3">
                    <strong><i class="fas fa-users"></i>
                        <?php echo app('translator')->get('crm::lang.assgined'); ?>
                    </strong> <br>
                    <p>
                        <?php if ($__env->exists('components.avatar', ['max_count' => '10', 'members' => $schedule->users])) echo $__env->make('components.avatar', ['max_count' => '10', 'members' => $schedule->users], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </p>
                    <?php if(!empty($schedule->followup_additional_info)): ?>
                        <strong><i class="fas fa-align-justify"></i>
                            <?php echo app('translator')->get('crm::lang.additional_info'); ?>
                        </strong> <br>
                        <?php $__currentLoopData = $schedule->followup_additional_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <b><?php echo e($key, false); ?></b> : <?php echo e($value, false); ?> <br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div><hr>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-3">
                    <strong><i class="fa fa-briefcase"></i> <?php echo app('translator')->get('contact.customer'); ?></strong>
                    <p class="text-muted">
                        <?php echo e($schedule->customer->name, false); ?>

                    </p>
                </div>
                <div class="col-md-5">
                    <strong><i class="fa fa-map-marker margin-r-5"></i> <?php echo app('translator')->get('business.address'); ?></strong>
                    <p class="text-muted">
                        <?php if($schedule->customer->landmark): ?>
                            <?php echo e($schedule->customer->landmark, false); ?>

                        <?php endif; ?>

                        <?php echo e(', ' . $schedule->customer->city, false); ?>


                        <?php if($schedule->customer->state): ?>
                            <?php echo e(', ' . $schedule->customer->state, false); ?>

                        <?php endif; ?>
                        <br>
                        <?php if($schedule->customer->country): ?>
                            <?php echo e($schedule->customer->country, false); ?>

                        <?php endif; ?>
                    </p>
                </div>
                <div class="col-md-2">
                    <strong><i class="fa fa-mobile margin-r-5"></i> <?php echo app('translator')->get('contact.mobile'); ?></strong>
                    <p class="text-muted">
                        <?php echo e($schedule->customer->mobile, false); ?>

                    </p>

                    <?php if(!empty($schedule->customer->email)): ?>
                        <strong><i class="fa fa-mobile margin-r-5"></i> <?php echo app('translator')->get('business.email'); ?></strong>
                        <p class="text-muted">
                            <?php echo e($schedule->customer->email, false); ?>

                        </p>
                    <?php endif; ?>
                </div>
                <div class="col-md-2">
                    <?php if($schedule->customer->supplier_business_name): ?>
                        <strong><i class="fa fa-briefcase margin-r-5"></i> 
                        <?php echo app('translator')->get('business.business_name'); ?></strong>
                        <p class="text-muted">
                            <?php echo e($schedule->customer->supplier_business_name, false); ?>

                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <hr>
        <div class="row">
            <div class="col-md-12">
                <?php echo $__env->make('crm::schedule.partial.schedule_info_invoices', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
</div>
