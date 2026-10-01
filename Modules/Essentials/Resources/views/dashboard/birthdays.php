<div class="col-md-4 col-sm-6 col-xs-12 col-custom">
    <div class="box box-primary">
        <div class="box-header with-border">
            <i class="fas fa-birthday-cake"></i>
            <h3 class="box-title"><?php echo app('translator')->get('essentials::lang.birthdays'); ?></h3>
        </div>
        <div class="box-body p-10">
            <table class="table no-margin  table-th-skin">
                <tbody>
                    <tr>
                        <th class="bg-light-gray" colspan="3"><?php echo app('translator')->get('home.today'); ?></th>
                    </tr>
                    <?php $__empty_18 = true; $__currentLoopData = $today_births; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $birthday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><?php echo e($birthday->surname, false); ?> <?php echo e($birthday->first_name, false); ?> <?php echo e($birthday->last_name, false); ?></td>
                            <td><?php echo e(\Carbon::createFromTimestamp(strtotime(\Carbon::parse($birthday->dob)->setYear(date('Y'))))->format(session('business.date_format')), false); ?> </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr>
                            <td colspan="3" class="text-center"><?php echo app('translator')->get('lang_v1.no_data'); ?></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <th class="bg-light-gray" colspan="3"><?php echo app('translator')->get('lang_v1.upcoming'); ?></th>
                    </tr>
                    <?php $__empty_18 = true; $__currentLoopData = $up_comming_births; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $birthday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><?php echo e($birthday->surname, false); ?> <?php echo e($birthday->first_name, false); ?> <?php echo e($birthday->last_name, false); ?></td>
                            <?php if(date('m') == '12' && Carbon::parse($birthday->dob)->format('m') == '1'): ?>
                                <td><?php echo e(\Carbon::createFromTimestamp(strtotime(\Carbon::parse($birthday->dob)->setYear(date('Y') + 1)))->format(session('business.date_format')), false); ?> </td>
                            <?php else: ?>
                                <td><?php echo e(\Carbon::createFromTimestamp(strtotime(\Carbon::parse($birthday->dob)->setYear(date('Y'))))->format(session('business.date_format')), false); ?> </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr>
                            <td colspan="3" class="text-center"><?php echo app('translator')->get('lang_v1.no_data'); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
