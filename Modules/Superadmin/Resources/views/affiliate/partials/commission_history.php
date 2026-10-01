
<?php ($show_actions = $show_actions ?? false); ?>
<?php $__env->startComponent('components.widget', ['title' => __('superadmin::lang.commission_history')]); ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('superadmin::lang.subscription_date'); ?></th>
                    <th><?php echo app('translator')->get('superadmin::lang.business'); ?></th>
                    <th><?php echo app('translator')->get('superadmin::lang.package'); ?></th>
                    <th><?php echo app('translator')->get('superadmin::lang.sale_amount'); ?></th>
                    <th><?php echo app('translator')->get('superadmin::lang.commission_percentage'); ?></th>
                    <th><?php echo app('translator')->get('superadmin::lang.commission_amount'); ?></th>
                    <th><?php echo app('translator')->get('superadmin::lang.status'); ?></th>
                    <?php if($show_actions): ?>
                        <th><?php echo app('translator')->get('superadmin::lang.action'); ?></th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_18 = true; $__currentLoopData = $commissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                    <tr>
                        <td><?php echo e(\Carbon::createFromTimestamp(strtotime($commission->created_at))->format(session('business.date_format') . ' ' . 'h:i A'), false); ?></td>
                        <td><?php echo e(optional($commission->business)->name, false); ?></td>
                        <td><?php echo e(optional($commission->package)->name, false); ?></td>
                        <td><span class="display_currency" data-currency_symbol="true" data-use_page_currency="true"><?php echo e($commission->sale_amount, false); ?></span></td>
                        <td><?php echo e($commission->commission_percentage, false); ?>%</td>
                        <td><span class="display_currency" data-currency_symbol="true" data-use_page_currency="true"><?php echo e($commission->commission_amount, false); ?></span></td>
                        <td><?php echo e(\Modules\Superadmin\Entities\AffiliateCommission::statuses()[$commission->status] ?? $commission->status, false); ?></td>
                        <?php if($show_actions): ?>
                            <td>
                                
                                <?php $__currentLoopData = \Modules\Superadmin\Utils\AffiliateUtil::assignableCommissionStatuses(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($status == $commission->status) continue; ?>
                                    <?php echo Form::open([
                                        'action' => ['\Modules\Superadmin\Http\Controllers\SuperadminAffiliatesController@updateCommissionStatus', $commission->id],
                                        'method' => 'post',
                                        'class' => 'disable-on-submit',
                                        'style' => 'display:inline-block',
                                    ]); ?>

                                        <?php echo Form::hidden('status', $status); ?>

                                        
                                        <button type="submit" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline <?php if($status == 'approved'): ?> tw-dw-btn-success <?php elseif($status == 'cancelled'): ?> tw-dw-btn-error <?php else: ?> tw-dw-btn-info <?php endif; ?>">
                                            <?php echo e(\Modules\Superadmin\Utils\AffiliateUtil::statusActionLabel($status), false); ?>

                                        </button>
                                    <?php echo Form::close(); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                    <tr>
                        <td colspan="<?php echo e($show_actions ? 8 : 7, false); ?>" class="text-center"><?php echo app('translator')->get('superadmin::lang.no_commissions_yet'); ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php echo $__env->renderComponent(); ?>
