<!-- /.box-header -->
<div class="box-body">
    <table class="table table-condensed bg-gray">
        <tr>
            <th><?php echo app('translator')->get('lang_v1.date'); ?></th>
            <th><?php echo app('translator')->get('messages.action'); ?></th>
            <th><?php echo app('translator')->get('lang_v1.by'); ?></th>
            <th><?php echo app('translator')->get('brand.note'); ?></th>
        </tr>
        <?php $__empty_18 = true; $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
            <?php if($activity->description != 'is_sent_notification'): ?>
                <tr>
                    <td><?php echo format_datetime_br($activity->created_at); ?></td>
                    <td>
                        <?php if($activity->description == 'status_changed'): ?>
                            <?php echo app('translator')->get('truckmate::lang.status_changed_to', ['status' => $activity->getExtraProperty('updated_status')]); ?>
                        <?php else: ?>
                            <?php echo e(__('lang_v1.' . $activity->description), false); ?>

                        <?php endif; ?>
                    </td>
                    <td><?php echo e($activity->causer->user_full_name, false); ?></td>
                    <td>
                        <?php if(!empty($activity->getExtraProperty('update_note'))): ?>
                            <?php echo e($activity->getExtraProperty('update_note'), false); ?>

                            <br>
                        <?php endif; ?>
                        <?php if(!empty($activity->getExtraProperty('completed_on_from'))): ?>
                            <?php echo app('translator')->get('truckmate::lang.completed_on_changed'); ?>
                            <?php echo app('translator')->get('account.from'); ?>: <?php echo format_datetime_br($activity->getExtraProperty('completed_on_from')); ?>

                            <?php echo app('translator')->get('account.to'); ?>: <?php echo format_datetime_br($activity->getExtraProperty('completed_on_to')); ?>

                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
            <tr>
              <td colspan="4" class="text-center">
                <?php echo app('translator')->get('purchase.no_records_found'); ?>
              </td>
            </tr>
        <?php endif; ?>
    </table>
</div>
<!-- /.box-body -->