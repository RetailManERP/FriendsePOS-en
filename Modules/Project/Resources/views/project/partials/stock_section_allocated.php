<?php if($rows->isEmpty()): ?>
    <p class="text-muted"><?php echo app('translator')->get('project::lang.no_stock_allocated'); ?></p>
<?php else: ?>
    <div class="project-stock-scroll">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('lang_v1.product'); ?></th>
                    <th><?php echo app('translator')->get('project::lang.at_location'); ?></th>
                    <th><?php echo app('translator')->get('project::lang.project_steps'); ?></th>
                    <th class="text-right"><?php echo app('translator')->get('lang_v1.received'); ?></th>
                    <th class="text-right"><?php echo app('translator')->get('lang_v1.returned'); ?></th>
                    <th class="text-right"><?php echo app('translator')->get('project::lang.consumed'); ?></th>
                    <th class="text-right"><?php echo app('translator')->get('lang_v1.available'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php echo e($row->product_name, false); ?>

                            <?php if(!empty($row->variation_name) && $row->variation_name !== 'DUMMY'): ?>
                                <small class="text-muted">(<?php echo e($row->variation_name, false); ?>)</small>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($row->location_name ?? '-', false); ?></td>
                        <td><?php echo e($row->step_names ?: '-', false); ?></td>
                        <td class="text-right"><?php echo e(number_format($row->qty_in, 2), false); ?></td>
                        <td class="text-right"><?php echo e(number_format($row->qty_out, 2), false); ?></td>
                        <td class="text-right"><?php echo e(number_format($row->qty_consumed ?? 0, 2), false); ?></td>
                        <td class="text-right"><strong><?php echo e(number_format($row->qty_available, 2), false); ?></strong></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <small class="text-muted"><i class="fa fa-info-circle"></i> <?php echo e($rows->count(), false); ?> rows</small>
<?php endif; ?>
