<?php if(empty($rows) || $rows->isEmpty()): ?>
    <p class="text-muted"><?php echo app('translator')->get('project::lang.no_project_history'); ?></p>
<?php else: ?>
    <div class="project-stock-scroll">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('messages.date'); ?></th>
                    <th><?php echo app('translator')->get('project::lang.movement_type'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.product'); ?></th>
                    <th><?php echo app('translator')->get('project::lang.linked_location'); ?></th>
                    <th><?php echo app('translator')->get('project::lang.project_steps'); ?></th>
                    <th class="text-right"><?php echo app('translator')->get('lang_v1.quantity_change'); ?></th>
                    <th class="text-right"><?php echo app('translator')->get('project::lang.project_balance'); ?></th>
                    <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.additional_notes'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $badges = ['allocation'=>'success', 'consumption'=>'danger', 'return'=>'warning'];
                        $labels = [
                            'allocation' => __('project::lang.allocation_label'),
                            'consumption' => __('project::lang.consumption_label'),
                            'return' => __('project::lang.return_label'),
                        ];
                        $b = $badges[$h->movement_type] ?? 'default';
                    ?>
                    <tr>
                        <td><?php echo e(\Carbon\Carbon::parse($h->date)->format('Y-m-d H:i'), false); ?></td>
                        <td><span class="label label-<?php echo e($b, false); ?>"><?php echo e($labels[$h->movement_type] ?? $h->movement_type, false); ?></span></td>
                        <td>
                            <?php echo e($h->product_name, false); ?>

                            <?php if(!empty($h->variation_name) && $h->variation_name !== 'DUMMY'): ?>
                                <small class="text-muted">(<?php echo e($h->variation_name, false); ?>)</small>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($h->location_name ?? '-', false); ?></td>
                        <td><?php echo e($h->step_name ?? '-', false); ?></td>
                        <td class="text-right">
                            <?php if($h->quantity_change >= 0): ?>
                                <span class="text-success">+<?php echo e(number_format($h->quantity_change, 2), false); ?></span>
                            <?php else: ?>
                                <span class="text-danger"><?php echo e(number_format($h->quantity_change, 2), false); ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="text-right"><strong><?php echo e(number_format($h->balance, 2), false); ?></strong></td>
                        <td><?php echo e($h->ref_no ?? '-', false); ?></td>
                        <td><?php echo e($h->notes ?? '', false); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <small class="text-muted"><i class="fa fa-info-circle"></i> <?php echo e($rows->count(), false); ?> rows</small>
<?php endif; ?>
