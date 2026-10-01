<?php $__currentLoopData = $project_task->timeLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timeLog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td><?php echo e($loop->iteration, false); ?></td>
    <td>
        <?php echo e(\Carbon::createFromTimestamp(strtotime($timeLog->start_datetime))->format(session('business.date_format') . ' ' . 'h:i A'), false); ?>

    </td>
    <td>
        <?php echo e(\Carbon::createFromTimestamp(strtotime($timeLog->end_datetime))->format(session('business.date_format') . ' ' . 'h:i A'), false); ?>

    </td>
    <td>
        <?php
            $start_datetime = \Carbon::parse($timeLog->start_datetime);
            $end_datetime = \Carbon::parse($timeLog->end_datetime);
        ?>
        <?php echo e($start_datetime->diffForHumans($end_datetime, true), false); ?>

    </td>
    <td>
       <?php echo e($timeLog->user->user_full_name, false); ?>

    </td>
    <td>
       <?php echo $timeLog->note; ?>

    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>