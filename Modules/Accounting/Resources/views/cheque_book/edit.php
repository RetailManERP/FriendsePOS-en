<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\Modules\Accounting\Http\Controllers\ChequeBookController::class, 'update'], $cheque_book->id),
            'method' => 'put', 'id' => 'cheque_book_form']); ?>


        <div class="modal-header">
            <h4 class="modal-title"><?php echo app('translator')->get('accounting::lang.edit_cheque_book'); ?></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('bank_account', __('accounting::lang.bank_account') . ':'); ?>

                        <p class="form-control-static fw-bold"><?php echo e($cheque_book->bankAccount->name ?? 'N/A', false); ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('cheque_book_no', __('accounting::lang.cheque_book_no') . ':*'); ?>

                        <?php echo Form::text('cheque_book_no', $cheque_book->cheque_book_no, ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label><?php echo app('translator')->get('accounting::lang.prefix'); ?></label>
                        <p class="form-control-static"><?php echo e($cheque_book->prefix ?? '-', false); ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><?php echo app('translator')->get('accounting::lang.range'); ?></label>
                        <p class="form-control-static"><?php echo e($cheque_book->start_number, false); ?> - <?php echo e($cheque_book->end_number, false); ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><?php echo app('translator')->get('accounting::lang.total_leaves'); ?></label>
                        <p class="form-control-static"><?php echo e($cheque_book->total_leaves, false); ?>

                            (<?php echo e(__('accounting::lang.used'), false); ?>: <?php echo e($cheque_book->used_leaves, false); ?>,
                             <?php echo e(__('accounting::lang.cancelled_leaves'), false); ?>: <?php echo e($cheque_book->cancelled_leaves, false); ?>)
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('note', __('accounting::lang.note') . ':'); ?>

                        <?php echo Form::textarea('note', $cheque_book->note, ['class' => 'form-control', 'rows' => 2]); ?>

                    </div>
                </div>
            </div>
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i>
                <?php echo app('translator')->get('accounting::lang.cheque_book_edit_warning'); ?>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>
            </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>

        <?php echo Form::close(); ?>

    </div>
</div>
