<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
                <i class="fas fa-clipboard-check"></i> <?php echo app('translator')->get('manufacturing::lang.inspection_details'); ?>
            </h4>
            <button type="button" class="btn-close no-print" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <strong><?php echo app('translator')->get('purchase.ref_no'); ?>:</strong> 
                    <?php echo e($inspection->transaction->ref_no ?? 'N/A', false); ?>

                </div>
                <div class="col-sm-6">
                    <strong><?php echo app('translator')->get('manufacturing::lang.inspection_date'); ?>:</strong> 
                    <?php echo format_datetime_br($inspection->inspection_date); ?>

                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-4">
                    <strong><?php echo app('translator')->get('sale.status'); ?>:</strong>
                    <?php
                        $badge_class = [
                            'pending' => 'bg-warning',
                            'passed' => 'bg-success', 
                            'failed' => 'bg-danger',
                            'conditional' => 'bg-info'
                        ][$inspection->status] ?? 'bg-secondary';
                    ?>
                    <span class="badge <?php echo e($badge_class, false); ?>"><?php echo e(ucfirst($inspection->status), false); ?></span>
                </div>
                <div class="col-sm-4">
                    <strong><?php echo app('translator')->get('manufacturing::lang.inspector'); ?>:</strong> 
                    <?php echo e($inspection->inspector ? ($inspection->inspector->first_name . ' ' . $inspection->inspector->last_name) : 'N/A', false); ?>

                </div>
                <div class="col-sm-4">
                    <strong><?php echo app('translator')->get('manufacturing::lang.batch_number'); ?>:</strong> 
                    <?php echo e($inspection->batch_number ?? 'N/A', false); ?>

                </div>
            </div>

            <?php if($inspection->transaction && $inspection->transaction->purchase_lines->isNotEmpty()): ?>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <strong><?php echo app('translator')->get('sale.product'); ?>:</strong>
                        <?php echo e($inspection->transaction->purchase_lines->first()->variations->full_name ?? 'N/A', false); ?>

                    </div>
                </div>
            <?php endif; ?>

            <?php if($inspection->notes): ?>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <strong><?php echo app('translator')->get('manufacturing::lang.qc_notes'); ?>:</strong>
                        <p class="mb-0"><?php echo e($inspection->notes, false); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            
            <?php if(!empty($inspection->parameters)): ?>
                <h5 class="mt-3"><i class="fas fa-list-check"></i> <?php echo app('translator')->get('manufacturing::lang.qc_parameters'); ?></h5>
                <table class="table table-bordered table-sm">
                    <thead class="table-light">
                        <tr>
                            <th><?php echo app('translator')->get('manufacturing::lang.parameter_name'); ?></th>
                            <th><?php echo app('translator')->get('manufacturing::lang.expected_value'); ?></th>
                            <th><?php echo app('translator')->get('manufacturing::lang.actual_value'); ?></th>
                            <th><?php echo app('translator')->get('manufacturing::lang.result'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $inspection->parameters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $param): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($param['name'] ?? '', false); ?></td>
                                <td><?php echo e($param['expected_value'] ?? '', false); ?></td>
                                <td><?php echo e($param['actual_value'] ?? '', false); ?></td>
                                <td>
                                    <?php
                                        $result_badge = [
                                            'pass' => 'bg-success',
                                            'fail' => 'bg-danger',
                                            'pending' => 'bg-warning'
                                        ][$param['result'] ?? 'pending'] ?? 'bg-secondary';
                                    ?>
                                    <span class="badge <?php echo e($result_badge, false); ?>"><?php echo e(ucfirst($param['result'] ?? 'pending'), false); ?></span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-primary no-print" aria-label="Print" 
                onclick="$(this).closest('div.modal-content').printThis();">
                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?>
            </button>
            <button type="button" class="btn btn-default no-print" data-bs-dismiss="modal">
                <?php echo app('translator')->get('messages.close'); ?>
            </button>
        </div>
    </div>
</div>
