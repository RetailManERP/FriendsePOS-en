
<?php $__env->startSection('title', __('warehouse::lang.receive_transfer') . ' - ' . $transfer->reference_no); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('warehouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('warehouse::lang.receive_transfer'); ?>
        <small><?php echo e($transfer->reference_no, false); ?></small>
    </h1>
</section>

<section class="content">
    <?php echo Form::open(['route' => ['warehouse.transfers.receive', $transfer->id], 'method' => 'POST']); ?>


    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row">
            <div class="col-md-6">
                <p><strong><?php echo app('translator')->get('warehouse::lang.source_warehouse'); ?>:</strong> <?php echo e($transfer->source_name ?? '-', false); ?></p>
                <p><strong><?php echo app('translator')->get('warehouse::lang.destination_warehouse'); ?>:</strong> <?php echo e($transfer->destination_name ?? '-', false); ?></p>
            </div>
        </div>

        <hr>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('warehouse::lang.product'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.lot_number'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.quantity_sent'); ?></th>
                    <th><?php echo app('translator')->get('warehouse::lang.quantity_received'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $transfer->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php echo e(optional($line->product)->name, false); ?>

                            <?php if($line->variation && $line->variation->name !== 'DUMMY'): ?>
                                - <?php echo e($line->variation->name, false); ?>

                            <?php endif; ?>
                        </td>
                        <td><?php echo e($line->lot_number ?? '-', false); ?></td>
                        <td><?php echo e(number_format($line->quantity_sent, 2), false); ?></td>
                        <td>
                            <input type="number"
                                name="lines[<?php echo e($line->id, false); ?>][quantity_received]"
                                class="form-control"
                                value="<?php echo e($line->quantity_sent, false); ?>"
                                max="<?php echo e($line->quantity_sent, false); ?>"
                                min="0"
                                step="0.01"
                                required>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-success pull-right">
                    <i class="fas fa-check-circle"></i> <?php echo app('translator')->get('warehouse::lang.receive_transfer'); ?>
                </button>
                <a href="<?php echo e(route('warehouse.transfers.show', $transfer->id), false); ?>" class="btn btn-default">
                    <?php echo app('translator')->get('messages.cancel'); ?>
                </a>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php echo Form::close(); ?>

</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>