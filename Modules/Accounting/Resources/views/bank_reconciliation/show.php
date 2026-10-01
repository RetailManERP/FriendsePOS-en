

<?php $__env->startSection('title', __('accounting::lang.bank_reconciliation') . ' — ' . $reconciliation->reference_no); ?>

<?php $__env->startSection('content'); ?>

<?php if(!$print): ?>
<?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1>
        <i class="fas fa-file-alt me-2 text-primary"></i>
        <?php echo app('translator')->get('accounting::lang.reconciliation_report'); ?>
    </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo e(action([\Modules\Accounting\Http\Controllers\BankReconciliationController::class, 'index']), false); ?>">
                <?php echo app('translator')->get('accounting::lang.bank_reconciliation'); ?>
            </a>
        </li>
        <li class="breadcrumb-item active"><?php echo e($reconciliation->reference_no, false); ?></li>
    </ol>
</section>
<?php endif; ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <?php if(!$print): ?>
            <div class="mb-3 no-print">
                <a href="<?php echo e(action([\Modules\Accounting\Http\Controllers\BankReconciliationController::class, 'index']), false); ?>"
                   class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> <?php echo app('translator')->get('messages.back'); ?>
                </a>
                <a href="?print=1" target="_blank" class="btn btn-outline-primary btn-sm ms-2">
                    <i class="fas fa-print"></i> <?php echo app('translator')->get('messages.print'); ?>
                </a>
                <?php if($reconciliation->status !== 'locked'): ?>
                    <a href="<?php echo e(action([\Modules\Accounting\Http\Controllers\BankReconciliationController::class, 'reconcile'], [$reconciliation->id]), false); ?>"
                       class="btn btn-primary btn-sm ms-2">
                        <i class="fas fa-edit"></i> <?php echo app('translator')->get('accounting::lang.continue_reconciling'); ?>
                    </a>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">
                            <i class="fas fa-balance-scale me-2"></i>
                            <?php echo app('translator')->get('accounting::lang.bank_reconciliation_statement'); ?>
                        </h4>
                        <small><?php echo e($reconciliation->account->name, false); ?></small>
                    </div>
                    <div class="text-end">
                        <div><?php echo $reconciliation->statusBadge(); ?></div>
                        <small><?php echo e($reconciliation->reference_no, false); ?></small>
                    </div>
                </div>

                <div class="card-body">
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <td class="text-muted fw-semibold" style="width:200px;"><?php echo app('translator')->get('accounting::lang.bank_account'); ?></td>
                                    <td><?php echo e($reconciliation->account->name, false); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-semibold"><?php echo app('translator')->get('accounting::lang.statement_from_date'); ?></td>
                                    <td><?php echo e($reconciliation->statement_from_date ? $reconciliation->statement_from_date->format('d M Y') : '—', false); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-semibold"><?php echo app('translator')->get('accounting::lang.statement_date'); ?></td>
                                    <td><?php echo e($reconciliation->statement_date->format('d M Y'), false); ?></td>
                                </tr>
                                <?php if($reconciliation->note): ?>
                                <tr>
                                    <td class="text-muted fw-semibold"><?php echo app('translator')->get('accounting::lang.note'); ?></td>
                                    <td><?php echo e($reconciliation->note, false); ?></td>
                                </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <td class="text-muted fw-semibold" style="width:200px;"><?php echo app('translator')->get('messages.created_by'); ?></td>
                                    <td><?php echo e(optional($reconciliation->createdBy)->full_name ?? '—', false); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-semibold"><?php echo app('translator')->get('accounting::lang.created_at'); ?></td>
                                    <td><?php echo e($reconciliation->created_at->format('d M Y, h:i A'), false); ?></td>
                                </tr>
                                <?php if($reconciliation->completed_at): ?>
                                <tr>
                                    <td class="text-muted fw-semibold"><?php echo app('translator')->get('accounting::lang.completed_by'); ?></td>
                                    <td><?php echo e(optional($reconciliation->completedBy)->full_name ?? '—', false); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-semibold"><?php echo app('translator')->get('accounting::lang.completed_at'); ?></td>
                                    <td><?php echo e($reconciliation->completed_at->format('d M Y, h:i A'), false); ?></td>
                                </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>

                    
                    <div class="bg-light rounded p-3 mb-4 border">
                        <h5 class="fw-bold mb-3"><?php echo app('translator')->get('accounting::lang.reconciliation_summary'); ?></h5>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-sm table-borderless mb-0">
                                    <tr>
                                        <td><?php echo app('translator')->get('accounting::lang.bank_statement_balance'); ?></td>
                                        <td class="text-end fw-semibold"><?php echo e(number_format($reconciliation->statement_closing_balance, 2), false); ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-sm table-borderless mb-0">
                                    <tr>
                                        <td><?php echo app('translator')->get('accounting::lang.system_opening_balance'); ?></td>
                                        <td class="text-end fw-semibold"><?php echo e(number_format($reconciliation->system_opening_balance, 2), false); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-success">+ <?php echo app('translator')->get('accounting::lang.cleared_deposits'); ?></td>
                                        <td class="text-end text-success fw-semibold"><?php echo e(number_format($reconciliation->cleared_credit_total, 2), false); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-warning">− <?php echo app('translator')->get('accounting::lang.cleared_payments'); ?></td>
                                        <td class="text-end text-warning fw-semibold"><?php echo e(number_format($reconciliation->cleared_debit_total, 2), false); ?></td>
                                    </tr>
                                    <tr class="border-top">
                                        <td class="fw-bold"><?php echo app('translator')->get('accounting::lang.reconciled_balance'); ?></td>
                                        <td class="text-end fw-bold">
                                            <?php echo e(number_format($reconciliation->system_opening_balance + $reconciliation->cleared_credit_total - $reconciliation->cleared_debit_total, 2), false); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold <?php echo e(abs($reconciliation->difference) < 0.01 ? 'text-success' : 'text-danger', false); ?>">
                                            <?php echo app('translator')->get('accounting::lang.difference'); ?>
                                        </td>
                                        <td class="text-end fw-bold <?php echo e(abs($reconciliation->difference) < 0.01 ? 'text-success' : 'text-danger', false); ?>">
                                            <?php echo e(number_format($reconciliation->difference, 2), false); ?>

                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    
                    <h5 class="mt-3 fw-bold border-bottom pb-2">
                        <i class="fas fa-arrow-down text-success me-2"></i>
                        <?php echo app('translator')->get('accounting::lang.cleared_deposits'); ?>
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th><?php echo app('translator')->get('accounting::lang.date'); ?></th>
                                    <th><?php echo app('translator')->get('accounting::lang.description'); ?></th>
                                    <th><?php echo app('translator')->get('accounting::lang.reference_no'); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('accounting::lang.amount'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_18 = true; $__currentLoopData = $items_credit->where('is_cleared', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                    <tr>
                                        <td><?php echo e($item->transaction_date->format('d/m/Y'), false); ?></td>
                                        <td><?php echo e($item->description ?: '—', false); ?></td>
                                        <td><?php echo e($item->reference_no ?: '—', false); ?></td>
                                        <td class="text-end text-success"><?php echo e(number_format($item->amount, 2), false); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                    <tr><td colspan="4" class="text-muted text-center"><?php echo app('translator')->get('accounting::lang.none'); ?></td></tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot class="fw-bold table-light">
                                <tr>
                                    <td colspan="3" class="text-end"><?php echo app('translator')->get('accounting::lang.total'); ?></td>
                                    <td class="text-end text-success"><?php echo e(number_format($reconciliation->cleared_credit_total, 2), false); ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    
                    <h5 class="mt-4 fw-bold border-bottom pb-2">
                        <i class="fas fa-arrow-up text-warning me-2"></i>
                        <?php echo app('translator')->get('accounting::lang.cleared_payments'); ?>
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th><?php echo app('translator')->get('accounting::lang.date'); ?></th>
                                    <th><?php echo app('translator')->get('accounting::lang.description'); ?></th>
                                    <th><?php echo app('translator')->get('accounting::lang.reference_no'); ?></th>
                                    <th class="text-end"><?php echo app('translator')->get('accounting::lang.amount'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_18 = true; $__currentLoopData = $items_debit->where('is_cleared', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                    <tr>
                                        <td><?php echo e($item->transaction_date->format('d/m/Y'), false); ?></td>
                                        <td><?php echo e($item->description ?: '—', false); ?></td>
                                        <td><?php echo e($item->reference_no ?: '—', false); ?></td>
                                        <td class="text-end text-warning"><?php echo e(number_format($item->amount, 2), false); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                    <tr><td colspan="4" class="text-muted text-center"><?php echo app('translator')->get('accounting::lang.none'); ?></td></tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot class="fw-bold table-light">
                                <tr>
                                    <td colspan="3" class="text-end"><?php echo app('translator')->get('accounting::lang.total'); ?></td>
                                    <td class="text-end text-warning"><?php echo e(number_format($reconciliation->cleared_debit_total, 2), false); ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h6 class="fw-bold text-muted"><?php echo app('translator')->get('accounting::lang.outstanding_deposits'); ?></h6>
                            <table class="table table-sm table-bordered">
                                <thead class="table-light"><tr><th><?php echo app('translator')->get('accounting::lang.date'); ?></th><th><?php echo app('translator')->get('accounting::lang.description'); ?></th><th class="text-end"><?php echo app('translator')->get('accounting::lang.amount'); ?></th></tr></thead>
                                <tbody>
                                    <?php $__empty_18 = true; $__currentLoopData = $items_credit->where('is_cleared', false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                        <tr>
                                            <td><?php echo e($item->transaction_date->format('d/m/Y'), false); ?></td>
                                            <td><?php echo e($item->description ?: '—', false); ?></td>
                                            <td class="text-end"><?php echo e(number_format($item->amount, 2), false); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                        <tr><td colspan="3" class="text-muted text-center"><?php echo app('translator')->get('accounting::lang.none'); ?></td></tr>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot class="fw-bold table-light">
                                    <tr>
                                        <td colspan="2" class="text-end"><?php echo app('translator')->get('accounting::lang.total'); ?></td>
                                        <td class="text-end"><?php echo e(number_format($items_credit->where('is_cleared', false)->sum('amount'), 2), false); ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold text-muted"><?php echo app('translator')->get('accounting::lang.outstanding_payments'); ?></h6>
                            <table class="table table-sm table-bordered">
                                <thead class="table-light"><tr><th><?php echo app('translator')->get('accounting::lang.date'); ?></th><th><?php echo app('translator')->get('accounting::lang.description'); ?></th><th class="text-end"><?php echo app('translator')->get('accounting::lang.amount'); ?></th></tr></thead>
                                <tbody>
                                    <?php $__empty_18 = true; $__currentLoopData = $items_debit->where('is_cleared', false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                        <tr>
                                            <td><?php echo e($item->transaction_date->format('d/m/Y'), false); ?></td>
                                            <td><?php echo e($item->description ?: '—', false); ?></td>
                                            <td class="text-end"><?php echo e(number_format($item->amount, 2), false); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                        <tr><td colspan="3" class="text-muted text-center"><?php echo app('translator')->get('accounting::lang.none'); ?></td></tr>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot class="fw-bold table-light">
                                    <tr>
                                        <td colspan="2" class="text-end"><?php echo app('translator')->get('accounting::lang.total'); ?></td>
                                        <td class="text-end"><?php echo e(number_format($items_debit->where('is_cleared', false)->sum('amount'), 2), false); ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    
                    <div class="row mt-5 no-print">
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-4 text-center">
                            <div class="border-top mt-4 pt-2 text-muted small"><?php echo app('translator')->get('accounting::lang.prepared_by'); ?></div>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4 text-center">
                            <div class="border-top mt-4 pt-2 text-muted small"><?php echo app('translator')->get('accounting::lang.authorized_by'); ?></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php if($print): ?>
<script>window.onload = function() { window.print(); };</script>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>