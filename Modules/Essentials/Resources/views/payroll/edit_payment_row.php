<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'postEditPayment'], [$payment_line->id, 'payroll_group_id'=> $payroll_group_id]), 'method' => 'post', 'id' => 'transaction_payment_add_form' ]); ?>

    <?php echo Form::hidden('default_payment_accounts', !empty($transaction->location) ? $transaction->location->default_payment_accounts : '[]', ['id' => 'default_payment_accounts']); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'purchase.edit_payment' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
      <div class="row">
        <?php if(!empty($transaction->contact)): ?>
        <div class="col-md-4">
          <div class="well">
            <strong><?php if($transaction->contact->type == 'supplier'): ?> <?php echo app('translator')->get('purchase.supplier'); ?>: <?php else: ?> <?php echo app('translator')->get('contact.customer'); ?>: <?php endif; ?> </strong><?php echo e($transaction->contact->full_name_with_business, false); ?><br>
            <strong><?php echo app('translator')->get('business.business'); ?>: </strong><?php echo e($transaction->contact->supplier_business_name, false); ?>

          </div>
        </div>
        <?php endif; ?>
        <?php if($transaction->type != 'opening_balance'): ?>
        <div class="col-md-4">
          <div class="well">
            <strong><?php echo app('translator')->get('purchase.ref_no'); ?>: </strong><?php echo e($transaction->ref_no, false); ?><br>
            <?php if(!empty($transaction->location)): ?>
              <strong><?php echo app('translator')->get('purchase.location'); ?>: </strong><?php echo e($transaction->location->name, false); ?>

            <?php endif; ?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="well">
            <strong><?php echo app('translator')->get('sale.total_amount'); ?>: </strong><span class="display_currency" data-currency_symbol="true"><?php echo e($transaction->final_total, false); ?></span><br>
            <strong><?php echo app('translator')->get('purchase.payment_note'); ?>: </strong>
            <?php if(!empty($transaction->additional_notes)): ?>
            <?php echo e($transaction->additional_notes, false); ?>

            <?php else: ?>
              --
            <?php endif; ?>
          </div>
        </div>
        <?php endif; ?>
      </div>
      <div class="row payment_row">
        <div class="col-md-4">
          <div class="form-group">
            <?php echo Form::label("method" , __('purchase.payment_method') . ':*'); ?>

            <div class="input-group">
              <span class="input-group-text">
                <i class="fas fa-money-bill-alt"></i>
              </span>
              <?php echo Form::select("method", $payment_types, $payment_line->method, ['class' => 'form-control select2 payment_types_dropdown', 'required', 'style' => 'width:100%;']); ?>

            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <?php echo Form::label("paid_on" , __('lang_v1.paid_on') . ':*'); ?>

            <div class="input-group">
              <span class="input-group-text">
                <i class="fa fa-calendar"></i>
              </span>
              <?php echo Form::text('paid_on', \Carbon::createFromTimestamp(strtotime($payment_line->paid_on))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'readonly', 'required']); ?>

            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <?php echo Form::label("amount" , __('sale.amount') . ':*'); ?>

            <div class="input-group">
              <span class="input-group-text">
                <i class="fas fa-money-bill-alt"></i>
              </span>
              <?php echo Form::text("amount", number_format($payment_line->amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number payment_amount', 'required', 'placeholder' => 'Amount']); ?>

            </div>
          </div>
        </div>
         <?php
            // Phase 56: per-location overlay — controller now passes $pos_settings overlaid for the
            // payment's transaction branch; fall back to the operator's session if not provided.
            $pos_settings = isset($pos_settings) && is_array($pos_settings)
                ? $pos_settings
                : (!empty(session()->get('business.pos_settings')) ? json_decode(session()->get('business.pos_settings'), true) : []);

            $enable_cash_denomination_for_payment_methods = !empty($pos_settings['enable_cash_denomination_for_payment_methods']) ? $pos_settings['enable_cash_denomination_for_payment_methods'] : [];
        ?>

        <?php if(!empty($pos_settings['enable_cash_denomination_on']) && $pos_settings['enable_cash_denomination_on'] == 'all_screens'): ?>
            <input type="hidden" class="enable_cash_denomination_for_payment_methods" value="<?php echo e(json_encode($pos_settings['enable_cash_denomination_for_payment_methods']), false); ?>">
            <div class="clearfix"></div>
            <div class="col-md-12 cash_denomination_div <?php if(!in_array($payment_line->method, $enable_cash_denomination_for_payment_methods)): ?> hide <?php endif; ?>">
                <hr>
                <strong><?php echo app('translator')->get( 'lang_v1.cash_denominations' ); ?></strong>
                  <?php if(!empty($pos_settings['cash_denominations'])): ?>
                    <table class="table table-slim">
                      <thead>
                        <tr>
                          <th width="20%" class="text-right"><?php echo app('translator')->get('lang_v1.denomination'); ?></th>
                          <th width="20%">&nbsp;</th>
                          <th width="20%" class="text-center"><?php echo app('translator')->get('lang_v1.count'); ?></th>
                          <th width="20%">&nbsp;</th>
                          <th width="20%" class="text-left"><?php echo app('translator')->get('sale.subtotal'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $total = 0;
                        ?>
                        <?php $__currentLoopData = explode(',', $pos_settings['cash_denominations']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dnm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $count = 0;
                            $sub_total = 0;
                            foreach($payment_line->denominations as $d) {
                                if($d->amount == $dnm) {
                                    $count = $d->total_count; 
                                    $sub_total = $d->total_count * $d->amount;
                                    $total += $sub_total;
                                }
                            }
                        ?>
                        <tr>
                          <td class="text-right"><?php echo e($dnm, false); ?></td>
                          <td class="text-center" >X</td>
                          <td><?php echo Form::number("denominations[$dnm]", $count, ['class' => 'form-control cash_denomination input-sm', 'min' => 0, 'data-denomination' => $dnm, 'style' => 'width: 100px; margin:auto;' ]); ?></td>
                          <td class="text-center">=</td>
                          <td class="text-left">
                            <span class="denomination_subtotal"><?php echo e(number_format($sub_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
                          </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="4" class="text-center"><?php echo app('translator')->get('sale.total'); ?></th>
                          <td>
                            <span class="denomination_total"><?php echo e(number_format($total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
                            <input type="hidden" class="denomination_total_amount" value="<?php echo e($total, false); ?>">
                            <input type="hidden" class="is_strict" value="<?php echo e($pos_settings['cash_denomination_strict_check'] ?? '', false); ?>">
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                    <p class="cash_denomination_error error hide"><?php echo app('translator')->get('lang_v1.cash_denomination_error'); ?></p>
                  <?php else: ?>
                    <p class="help-block"><?php echo app('translator')->get('lang_v1.denomination_add_help_text'); ?></p>
                  <?php endif; ?>
            </div>
            <div class="clearfix"></div>
        <?php endif; ?>
        
        
        
        <div class="clearfix"></div>
          <?php echo $__env->make('transaction_payment.payment_type_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="col-md-12">
          <div class="form-group">
            <?php echo Form::label("note", __('lang_v1.payment_note') . ':'); ?>

            <?php echo Form::textarea("note", $payment_line->note, ['class' => 'form-control', 'rows' => 3]); ?>

          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.update' ); ?></button>
      <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
