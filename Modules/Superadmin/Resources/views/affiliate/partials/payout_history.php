
<?php $__env->startComponent('components.widget', ['title' => __('superadmin::lang.payout_history')]); ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('superadmin::lang.created_at'); ?></th>
                    <th><?php echo app('translator')->get('superadmin::lang.amount'); ?></th>
                    <th><?php echo app('translator')->get('superadmin::lang.status'); ?></th>
                    <th><?php echo app('translator')->get('superadmin::lang.paid_at'); ?></th>
                    <th><?php echo app('translator')->get('superadmin::lang.payment_transaction_id'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_18 = true; $__currentLoopData = $payouts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                    <tr>
                        <td><?php echo e(\Carbon::createFromTimestamp(strtotime($payout->created_at))->format(session('business.date_format') . ' ' . 'h:i A'), false); ?></td>
                        <td><span class="display_currency" data-currency_symbol="true" data-use_page_currency="true"><?php echo e($payout->amount, false); ?></span></td>
                        <td><?php echo e(\Modules\Superadmin\Entities\AffiliatePayout::statuses()[$payout->status] ?? $payout->status, false); ?></td>
                        <td><?php if(!empty($payout->paid_at)): ?> <?php echo e(\Carbon::createFromTimestamp(strtotime($payout->paid_at))->format(session('business.date_format') . ' ' . 'h:i A'), false); ?> <?php endif; ?></td>
                        <td><?php echo e($payout->transaction_id, false); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                    <tr>
                        <td colspan="5" class="text-center"><?php echo app('translator')->get('superadmin::lang.no_payouts_yet'); ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php echo $__env->renderComponent(); ?>
