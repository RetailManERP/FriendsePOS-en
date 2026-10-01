
<?php $__env->startSection('title', __('productcatalogue::lang.order_notes')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1 class="fs-4 fw-bold text-dark">
        <i class="fas fa-sticky-note"></i> <?php echo app('translator')->get('productcatalogue::lang.order_notes'); ?>
    </h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo app('translator')->get('productcatalogue::lang.invoice_ref'); ?></th>
                        <th><?php echo app('translator')->get('productcatalogue::lang.customer_name'); ?></th>
                        <th><?php echo app('translator')->get('productcatalogue::lang.customer_phone'); ?></th>
                        <th><?php echo app('translator')->get('productcatalogue::lang.order_type'); ?></th>
                        <th><?php echo app('translator')->get('productcatalogue::lang.special_instructions'); ?></th>
                        <th><?php echo app('translator')->get('productcatalogue::lang.order_total'); ?></th>
                        <th><?php echo app('translator')->get('productcatalogue::lang.order_status'); ?></th>
                        <th><?php echo app('translator')->get('productcatalogue::lang.date'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_18 = true; $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><?php echo e($note->id, false); ?></td>
                            <td>
                                <?php if($note->transaction): ?>
                                    <?php echo e($note->transaction->invoice_no ?: $note->transaction->ref_no, false); ?>

                                <?php else: ?>
                                    <span class="text-muted">N/A</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($note->customer_name ?: '-', false); ?></td>
                            <td><?php echo e($note->customer_phone ?: '-', false); ?></td>
                            <td>
                                <span class="label label-<?php echo e($note->order_type == 'delivery' ? 'warning' : ($note->order_type == 'takeaway' ? 'info' : 'success'), false); ?>">
                                    <?php echo e($note->order_type_label, false); ?>

                                </span>
                            </td>
                            <td><?php echo e($note->special_instructions ?: '-', false); ?></td>
                            <td>
                                <?php if($note->transaction): ?>
                                    <span class="display_currency" data-currency_symbol="true"><?php echo e($note->transaction->final_total, false); ?></span>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($note->transaction): ?>
                                    <span class="label label-<?php echo e($note->transaction->status == 'final' ? 'success' : 'warning', false); ?>">
                                        <?php echo e(ucfirst($note->transaction->status), false); ?>

                                    </span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e(\Carbon\Carbon::parse($note->created_at)->format('Y-m-d H:i'), false); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr>
                            <td colspan="9" class="text-center text-muted">
                                <?php echo app('translator')->get('productcatalogue::lang.no_order_notes_found'); ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="text-center">
            <?php echo e($notes->links(), false); ?>

        </div>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>