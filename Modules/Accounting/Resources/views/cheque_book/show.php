

<?php $__env->startSection('title', __('accounting::lang.cheque_book_details')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('accounting::lang.cheque_book_details'); ?>
        <small><?php echo e($cheque_book->cheque_book_no, false); ?></small>
    </h1>
</section>

<section class="content">
    
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-money-check me-2"></i>
                        <?php echo e($cheque_book->cheque_book_no, false); ?>

                        <?php
                            $statusBadges = ['active' => 'bg-success', 'completed' => 'bg-info', 'cancelled' => 'bg-danger'];
                        ?>
                        <span class="badge <?php echo e($statusBadges[$cheque_book->status] ?? 'bg-secondary', false); ?> ms-2">
                            <?php echo e(ucfirst($cheque_book->status), false); ?>

                        </span>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <strong><?php echo app('translator')->get('accounting::lang.bank_account'); ?>:</strong><br>
                            <?php echo e($cheque_book->bankAccount->name ?? 'N/A', false); ?>

                        </div>
                        <div class="col-md-2">
                            <strong><?php echo app('translator')->get('accounting::lang.prefix'); ?>:</strong><br>
                            <?php echo e($cheque_book->prefix ?? '-', false); ?>

                        </div>
                        <div class="col-md-2">
                            <strong><?php echo app('translator')->get('accounting::lang.range'); ?>:</strong><br>
                            <?php echo e($cheque_book->start_number, false); ?> - <?php echo e($cheque_book->end_number, false); ?>

                        </div>
                        <div class="col-md-2">
                            <strong><?php echo app('translator')->get('accounting::lang.total_leaves'); ?>:</strong><br>
                            <?php echo e($cheque_book->total_leaves, false); ?>

                        </div>
                        <div class="col-md-3">
                            <strong><?php echo app('translator')->get('accounting::lang.next_cheque_number'); ?>:</strong><br>
                            <span class="fs-5 fw-bold text-primary">
                                <?php echo e($cheque_book->getNextChequeNumber() ?? __('accounting::lang.book_exhausted'), false); ?>

                            </span>
                        </div>
                    </div>
                    <?php if($cheque_book->note): ?>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <strong><?php echo app('translator')->get('accounting::lang.note'); ?>:</strong> <?php echo e($cheque_book->note, false); ?>

                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row mb-3">
        <?php
            $statuses = ['unused' => ['bg-secondary', 'fas fa-file'], 'used' => ['bg-success', 'fas fa-check-circle'],
                'cancelled' => ['bg-danger', 'fas fa-times-circle'], 'voided' => ['bg-warning', 'fas fa-ban'],
                'returned' => ['bg-info', 'fas fa-undo']];
        ?>
        <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status => $config): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col">
                <div class="card shadow-sm text-center">
                    <div class="card-body py-2">
                        <i class="<?php echo e($config[1], false); ?> fa-lg <?php echo e(str_replace('bg-', 'text-', $config[0]), false); ?>"></i>
                        <div class="fs-4 fw-bold"><?php echo e($status_summary[$status] ?? 0, false); ?></div>
                        <small class="text-muted text-uppercase"><?php echo e(ucfirst($status), false); ?></small>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('accounting::lang.cheque_leaves')]); ?>
                <?php $__env->slot('tool'); ?>
                    <div class="box-tools">
                        <button type="button" class="btn btn-primary btn-sm" id="cheque_book_detail_print_btn">
                            <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                        </button>
                        <select id="leaf_status_filter" class="form-control form-control-sm" style="width:150px;display:inline-block;">
                            <option value=""><?php echo app('translator')->get('lang_v1.all'); ?></option>
                            <option value="unused"><?php echo app('translator')->get('accounting::lang.unused'); ?></option>
                            <option value="used"><?php echo app('translator')->get('accounting::lang.used'); ?></option>
                            <option value="cancelled"><?php echo app('translator')->get('accounting::lang.cancelled'); ?></option>
                            <option value="voided"><?php echo app('translator')->get('accounting::lang.voided'); ?></option>
                            <option value="returned"><?php echo app('translator')->get('accounting::lang.returned'); ?></option>
                        </select>
                    </div>
                <?php $__env->endSlot(); ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="cheque_leaves_table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('accounting::lang.cheque_number'); ?></th>
                                <th><?php echo app('translator')->get('sale.status'); ?></th>
                                <th><?php echo app('translator')->get('accounting::lang.issued_to'); ?></th>
                                <th><?php echo app('translator')->get('accounting::lang.cheque_date'); ?></th>
                                <th><?php echo app('translator')->get('accounting::lang.amount'); ?></th>
                                <th><?php echo app('translator')->get('accounting::lang.memo'); ?></th>
                                <th><?php echo app('translator')->get('messages.action'); ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>


<div class="modal fade" id="issue_cheque_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('accounting::lang.issue_cheque'); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="issue_cheque_leaf_id">
                <div class="form-group">
                    <label><?php echo app('translator')->get('accounting::lang.issued_to'); ?> *</label>
                    <input type="text" class="form-control" id="issue_issued_to" required>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('accounting::lang.cheque_date'); ?></label>
                            <input type="date" class="form-control" id="issue_cheque_date">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('accounting::lang.amount'); ?></label>
                            <input type="number" class="form-control" id="issue_amount" step="0.01">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label><?php echo app('translator')->get('accounting::lang.memo'); ?></label>
                    <textarea class="form-control" id="issue_memo" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="confirm_issue_cheque">
                    <i class="fas fa-check"></i> <?php echo app('translator')->get('accounting::lang.issue'); ?>
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="reason_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="reason_modal_title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="reason_leaf_id">
                <input type="hidden" id="reason_action">
                <div class="form-group">
                    <label><?php echo app('translator')->get('accounting::lang.reason'); ?> *</label>
                    <textarea class="form-control" id="reason_text" rows="3" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="confirm_reason_action">
                    <i class="fas fa-check"></i> <?php echo app('translator')->get('messages.save'); ?>
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        var cheque_leaves_table = $('#cheque_leaves_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?php echo e(action([\Modules\Accounting\Http\Controllers\ChequeBookController::class, "show"], $cheque_book->id), false); ?>',
                data: function(d) {
                    d.leaf_status = $('#leaf_status_filter').val();
                }
            },
            columns: [
                { data: 'cheque_number', name: 'cheque_number' },
                { data: 'status', name: 'status' },
                { data: 'issued_to', name: 'issued_to', defaultContent: '-' },
                { data: 'cheque_date', name: 'cheque_date' },
                { data: 'amount', name: 'amount' },
                { data: 'memo', name: 'memo', defaultContent: '-' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            order: [[0, 'asc']]
        });

        $('#leaf_status_filter').on('change', function() {
            cheque_leaves_table.ajax.reload();
        });

        $('#cheque_book_detail_print_btn').on('click', function(e) {
            e.preventDefault();
            window.open("<?php echo e(route('cheque-book.print'), false); ?>?" + $.param({
                tab: 'all',
                cheque_book_id: '<?php echo e($cheque_book->id, false); ?>',
                leaf_status: $('#leaf_status_filter').val() || 'all'
            }), '_blank');
        });

        // Issue Cheque
        $(document).on('click', '.issue-cheque', function() {
            var id = $(this).data('id');
            $('#issue_cheque_leaf_id').val(id);
            $('#issue_issued_to').val('');
            $('#issue_cheque_date').val('');
            $('#issue_amount').val('');
            $('#issue_memo').val('');
            $('#issue_cheque_modal').modal('show');
        });

        $('#confirm_issue_cheque').on('click', function() {
            var leafId = $('#issue_cheque_leaf_id').val();
            $.ajax({
                method: 'POST',
                url: '/accounting/cheque-book/leaf/' + leafId + '/update-status',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    action: 'issue',
                    issued_to: $('#issue_issued_to').val(),
                    cheque_date: $('#issue_cheque_date').val(),
                    amount: $('#issue_amount').val(),
                    memo: $('#issue_memo').val(),
                },
                success: function(result) {
                    if (result.success) {
                        toastr.success(result.msg);
                        $('#issue_cheque_modal').modal('hide');
                        cheque_leaves_table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                }
            });
        });

        // Cancel / Void / Return
        $(document).on('click', '.cancel-cheque-leaf, .void-cheque, .return-cheque', function() {
            var id = $(this).data('id');
            var action = '';
            var title = '';

            if ($(this).hasClass('cancel-cheque-leaf')) {
                action = 'cancel';
                title = '<?php echo e(__("accounting::lang.cancel_cheque"), false); ?>';
            } else if ($(this).hasClass('void-cheque')) {
                action = 'void';
                title = '<?php echo e(__("accounting::lang.void_cheque"), false); ?>';
            } else if ($(this).hasClass('return-cheque')) {
                action = 'return';
                title = '<?php echo e(__("accounting::lang.return_cheque"), false); ?>';
            }

            $('#reason_leaf_id').val(id);
            $('#reason_action').val(action);
            $('#reason_modal_title').text(title);
            $('#reason_text').val('');
            $('#reason_modal').modal('show');
        });

        $('#confirm_reason_action').on('click', function() {
            var leafId = $('#reason_leaf_id').val();
            var action = $('#reason_action').val();
            var reason = $('#reason_text').val();

            if (!reason) {
                toastr.error('<?php echo e(__("accounting::lang.reason_required"), false); ?>');
                return;
            }

            $.ajax({
                method: 'POST',
                url: '/accounting/cheque-book/leaf/' + leafId + '/update-status',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    action: action,
                    reason: reason,
                },
                success: function(result) {
                    if (result.success) {
                        toastr.success(result.msg);
                        $('#reason_modal').modal('hide');
                        cheque_leaves_table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>