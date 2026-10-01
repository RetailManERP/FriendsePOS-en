<div class="modal-dialog no-print" role="document">
<?php echo Form::open(['url' => action([\Modules\Accounting\Http\Controllers\TransactionController::class, 'saveMap']), 'method' => 'POST', 'id' => 'save_accounting_map' ]); ?>

    
    <input type="hidden" name="type" value="<?php echo e($type, false); ?>" id="transaction_type">
    <?php if(in_array($type, ['sell', 'purchase', 'expense', 'sell_return', 'purchase_return', 'opening_stock','opening_balance', 'advance_deposit', 'stock_adjustment', 'payroll', 'payroll_advance', 'production_purchase'])): ?>
        <input type="hidden" name="id" value="<?php echo e($transaction->id, false); ?>">
    <?php elseif(in_array($type, ['sell_payment', 'purchase_payment', 'expense_payment', 'sell_return_payment', 'purchase_return_payment', 'contact_payment', 'opening_balance_payment', 'stock_recovered', 'payroll_payment'])): ?>
        <input type="hidden" name="id" value="<?php echo e($transaction_payment->id, false); ?>">
    <?php endif; ?>

<div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title" id="modalTitle">
        <?php if($type == 'sell'): ?>
            <?php echo e($transaction->invoice_no, false); ?>

        <?php elseif($type == 'sell_return'): ?>
            <?php echo e($transaction->invoice_no, false); ?>

        <?php elseif($type == 'purchase' ): ?>
            <?php echo e($transaction->ref_no, false); ?>

        <?php elseif($type == 'purchase_return'): ?>
            <?php echo e($transaction->ref_no, false); ?>

        <?php elseif($type == 'stock_adjustment'): ?>
            <?php echo e($transaction->ref_no, false); ?>

        <?php elseif($type == 'expense'): ?>
            <?php echo e($transaction->ref_no, false); ?>

        <?php elseif($type == 'opening_balance'): ?>
            <?php echo e($transaction->ref_no, false); ?>

        <?php elseif($type == 'opening_stock'): ?>
            <?php echo e(__('lang_v1.opening_stock'), false); ?>

        <?php elseif($type == 'advance_deposit'): ?>
            <?php echo e($transaction->ref_no, false); ?>    
        <?php elseif($type == 'payroll_advance'): ?>
            <?php echo e($transaction->ref_no, false); ?>

        <?php elseif($type == 'production_purchase'): ?>
            <?php echo e($transaction->ref_no, false); ?>    
        <?php elseif(in_array($type, ['sell_payment', 'purchase_payment', 'expense_payment', 'sell_return_payment', 'purchase_return_payment', 'stock_recovered', 'contact_payment', 'opening_balance_payment'])): ?>
            <?php echo e($transaction_payment->payment_ref_no, false); ?>

        <?php endif; ?>
    </h4>
    <button type="button" class="btn-close no-print" data-bs-dismiss="modal" aria-label="Close"></button>
    
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo Form::label('payment_account', __('accounting::lang.payment_account') . ':*' ); ?>

                <?php echo Form::select('payment_account', !is_null($default_payment_account) ? [$default_payment_account->id => $default_payment_account->name] : [], $default_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown','placeholder' => __('accounting::lang.payment_account'), 'required' => 'required']); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo Form::label('deposit_to', __('accounting::lang.deposit_to') . ':*' ); ?>

                <?php echo Form::select('deposit_to', !is_null($default_deposit_to) ? 
                    [$default_deposit_to->id => $default_deposit_to->name] : [], $default_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown','placeholder' => __('accounting::lang.deposit_to'), 'required' => 'required']); ?>

            </div>
        </div>
        <?php if($type == 'sell_return' || $type == 'purchase_return' || $type == 'sell_return_payment' || $type == 'purchase_return_payment'): ?>
            <div class="text-center"><small>Accounts will be reversed - Currently Showing Default Accounts from Sell/Purchase</small></div>
        <?php endif; ?>
    </div>

</div>

<div class="modal-footer">
    <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.update'); ?></button>
    <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.cancel'); ?></button>
</div>

<?php echo Form::close(); ?>

	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
