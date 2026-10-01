<?php echo Form::label("final_total_".$id , __('sale.amount') . ':*'); ?>

<div class="input-group">
  <span class="input-group-text">
    <i class="fa fa-money-bill-alt"></i>
  </span>
  <?php echo Form::text('payments['.$id.'][final_total]', number_format($payroll['final_total']-$payroll['paid_amount'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input-sm final_total', 'required', 'id' => 'final_total_'.$id, 'data-id' => $id]); ?>

</div>

<?php echo Form::label("paid_on_".$id , __('lang_v1.paid_on') . ':*'); ?>

<div class="input-group">
  <span class="input-group-text">
    <i class="fa fa-calendar"></i>
  </span>
  <?php echo Form::text('payments['.$id.'][paid_on]', \Carbon::createFromTimestamp(strtotime($payroll['paid_on']))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control input-sm paid_on', 'readonly', 'required', 'id' => 'paid_on_'.$id, 'data-id' => $id]); ?>

</div>

<?php if(!empty($accounts)): ?>
	<?php echo Form::label("account_id_".$id , __('lang_v1.payment_account') . ':'); ?>

      <div class="input-group">
        <span class="input-group-text">
          <i class="fas fa-money-bill-alt"></i>
        </span>
        <?php echo Form::select('payments['.$id.'][account_id]', $accounts, null , ['class' => 'form-control input-sm select2', 'id' => "account_id_".$id, 'style' => 'width:100%;', 'data-id' => $id]); ?>

      </div>
<?php endif; ?>

<?php echo Form::label("method_".$id , __('purchase.payment_method') . ':*'); ?>

<div class="input-group">
  <span class="input-group-text">
    <i class="fas fa-money-bill-alt"></i>
  </span>
  <?php echo Form::select('payments['.$id.'][method]', $payment_types, null, ['class' => 'form-control select2 payment_types input-sm', 'id' => 'method_'.$id, 'style' => 'width:100%;', 'data-id' => $id, 'placeholder' => __('messages.please_select')]); ?>

</div>

<div id="cheque_<?php echo e($id, false); ?>" style="display: none;">
	<?php echo Form::label("cheque_number_".$id,__('lang_v1.cheque_no')); ?>

	<?php echo Form::text('payments['.$id.'][cheque_number]', null, ['class' => 'form-control input-sm', 'placeholder' => __('lang_v1.cheque_no'), 'id' => 'cheque_number_'.$id, 'data-id' => $id]); ?>

</div>

<div id="bank_transfer_<?php echo e($id, false); ?>" style="display: none;">
	<?php echo Form::label("bank_account_number_".$id,__('lang_v1.bank_account_number')); ?>

	<?php echo Form::text('payments['.$id.'][bank_account_number]', null, ['class' => 'form-control input-sm', 'placeholder' => __('lang_v1.bank_account_number'), 'data-id' => $id, 'id' => 'bank_account_number_'.$id]); ?>

</div>
<div id="custom_pay_1_<?php echo e($id, false); ?>" style="display: none;">
	<?php echo Form::label("transaction_no_1_".$id, __('lang_v1.transaction_no')); ?>

	<?php echo Form::text('payments['.$id.'][transaction_no_1]', null, ['class' => 'form-control input-sm', 'placeholder' => __('lang_v1.transaction_no'), 'data-id' => $id, 'id' => 'transaction_no_1_'.$id]); ?>

</div>
<div id="custom_pay_2_<?php echo e($id, false); ?>" style="display: none;">
	<?php echo Form::label("transaction_no_2_".$id, __('lang_v1.transaction_no')); ?>

	<?php echo Form::text('payments['.$id.'][transaction_no_2]', null, ['class' => 'form-control input-sm', 'placeholder' => __('lang_v1.transaction_no'), 'data-id' => $id, 'id' => 'transaction_no_2_'.$id]); ?>

</div>
<div id="custom_pay_3_<?php echo e($id, false); ?>" style="display: none;">
	<?php echo Form::label("transaction_no_3_".$id, __('lang_v1.transaction_no')); ?>

	<?php echo Form::text('payments['.$id.'][transaction_no_3]', null, ['class' => 'form-control input-sm', 'placeholder' => __('lang_v1.transaction_no'), 'data-id' => $id, 'id' => 'transaction_no_3_'.$id]); ?>

</div>
<div id="card_<?php echo e($id, false); ?>" style="display: none;">
    <table class="table table-th-skin">
        <tr>
            <td>
            	<?php echo Form::label("card_number", __('lang_v1.card_no')); ?>

				<?php echo Form::text('payments['.$id.'][card_number]', null, ['class' => 'form-control input-sm', 'placeholder' => __('lang_v1.card_no')]); ?>

            </td>
            <td>
            	<?php echo Form::label("card_holder_name", __('lang_v1.card_holder_name')); ?>

				<?php echo Form::text('payments['.$id.'][card_holder_name]', null, ['class' => 'form-control input-sm', 'placeholder' => __('lang_v1.card_holder_name')]); ?>

        	</td>
        </tr>
        
        <tr>
            <td>
            	<?php echo Form::label("card_transaction_number",__('lang_v1.card_transaction_no')); ?>

				<?php echo Form::text('payments['.$id.'][card_transaction_number]', null, ['class' => 'form-control input-sm', 'placeholder' => __('lang_v1.card_transaction_no')]); ?>

            </td>
            <td>
            	<?php echo Form::label("card_type", __('lang_v1.card_type')); ?>

				<?php echo Form::select('payments['.$id.'][card_type]', ['credit' => 'Credit Card', 'debit' => 'Debit Card', 'visa' => 'Visa', 'master' => 'MasterCard'], null,['class' => 'form-control input-sm']); ?>

            </td>
        </tr>
        <tr>
        	<td>
        		<?php echo Form::label("card_month", __('lang_v1.month')); ?>

				<?php echo Form::text('payments['.$id.'][card_month]', null, ['class' => 'form-control input-sm', 'placeholder' => __('lang_v1.month') ]); ?>

        	</td>
        	<td>
        		<?php echo Form::label("card_year", __('lang_v1.year')); ?>

				<?php echo Form::text('payments['.$id.'][card_year]', null, ['class' => 'form-control input-sm', 'placeholder' => __('lang_v1.year') ]); ?>

        	</td>
        </tr>
        <tr>
        	<td colspan="2">
        		<?php echo Form::label("card_security",__('lang_v1.security_code')); ?>

				<?php echo Form::text('payments['.$id.'][card_security]', null, ['class' => 'form-control input-sm', 'placeholder' => __('lang_v1.security_code')]); ?>

        	</td>
        </tr>
	</table>
</div>
<div class="form-group">
	<?php echo Form::label("note", __('lang_v1.payment_note') . ':'); ?>

	<?php echo Form::textarea('payments['.$id.'][note]', null, ['class' => 'form-control', 'rows' => 2 , 'id' => 'note_'.$id, 'data-id' => $id]); ?>

</div>
