
<?php $__env->startComponent('components.widget', ['title' => __('superadmin::lang.referral_history')]); ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('superadmin::lang.business'); ?></th>
                    <th><?php echo app('translator')->get('superadmin::lang.registered_at'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_18 = true; $__currentLoopData = $referrals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                    <tr>
                        <td><?php echo e(optional($referral->business)->name, false); ?></td>
                        <td><?php if(!empty($referral->registered_at)): ?> <?php echo e(\Carbon::createFromTimestamp(strtotime($referral->registered_at))->format(session('business.date_format') . ' ' . 'h:i A'), false); ?> <?php endif; ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                    <tr>
                        <td colspan="2" class="text-center"><?php echo app('translator')->get('superadmin::lang.no_referrals_yet'); ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php echo $__env->renderComponent(); ?>
