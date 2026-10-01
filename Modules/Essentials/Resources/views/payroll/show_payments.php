<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title no-print">
                <?php echo app('translator')->get( 'purchase.view_payments' ); ?> 
                (
                    <?php echo e($payroll_group->name, false); ?>

                )   
            </h4>
            <button type="button" class="btn-close no-print" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <?php echo app('translator')->get('essentials::lang.payroll_for'); ?>:
                    <address>
                        <strong><?php echo e($payroll_group->transaction_for, false); ?></strong>
                    </address>
                </div>
                <div class="col-md-4 invoice-col">
                    <?php echo app('translator')->get('business.business'); ?>:
                    <address>
                        <strong><?php echo e($payroll_group->business->name, false); ?></strong>
                        <?php echo e($payroll_group->businessLocation->name ?? '', false); ?>

                        <?php if(!empty($payroll_group->businessLocation->landmark)): ?>
                            <br><?php echo e($payroll_group->businessLocation->landmark, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($payroll_group->businessLocation->city) || !empty($payroll_group->businessLocation->state) || !empty($payroll_group->businessLocation->country)): ?>
                            <br><?php echo e(implode(',', array_filter([$payroll_group->businessLocation->city, $payroll_group->businessLocation->state, $payroll_group->businessLocation->country])), false); ?>

                        <?php endif; ?>
                    
                        <?php if(!empty($payroll_group->business->tax_number_1)): ?>
                            <br><?php echo e($payroll_group->business->tax_label_1, false); ?>: <?php echo e($payroll_group->business->tax_number_1, false); ?>

                        <?php endif; ?>

                        <?php if(!empty($payroll_group->business->tax_number_2)): ?>
                            <br><?php echo e($payroll_group->business->tax_label_2, false); ?>: <?php echo e($payroll_group->business->tax_number_2, false); ?>

                        <?php endif; ?>

                        <?php if(!empty($payroll_group->businessLocation->mobile)): ?>
                            <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($payroll_group->businessLocation->mobile, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($payroll_group->businessLocation->email)): ?>
                            <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($payroll_group->businessLocation->email, false); ?>

                        <?php endif; ?>
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    
                    <?php
                        $transaction_date = \Carbon::parse($payroll_group->transaction_date);
                    ?>
                    <b><?php echo app('translator')->get( 'essentials::lang.month_year' ); ?>:</b> <?php echo e($transaction_date->format('F'), false); ?> <?php echo e($transaction_date->format('Y'), false); ?><br/>
                    <b><?php echo app('translator')->get('purchase.payment_status'); ?>:</b> <?php echo e(__('lang_v1.' . $payroll_group->payment_status), false); ?><br>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                        <tr>
                          <th><?php echo app('translator')->get('messages.date'); ?></th>
                          <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                          <th><?php echo app('translator')->get('essentials::lang.employee'); ?></th>
                          <th><?php echo app('translator')->get('purchase.amount'); ?></th>
                          <th><?php echo app('translator')->get('purchase.location'); ?></th>
                          <th><?php echo app('translator')->get('purchase.payment_method'); ?></th>
                          <th><?php echo app('translator')->get('purchase.payment_note'); ?></th>
                          <?php if($accounts_enabled): ?>
                            <th><?php echo app('translator')->get('lang_v1.payment_account'); ?></th>
                          <?php endif; ?>
                          <th class="no-print"><?php echo app('translator')->get('messages.actions'); ?></th>
                        </tr>
                        <?php $__empty_18 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr>
                              <td><?php echo format_datetime_br($payment->paid_on); ?></td>
                              <td><?php echo e($payment->payment_ref_no, false); ?></td>
                              <td><?php echo e($payment->employee, false); ?></td>
                              <td><span class="display_currency" data-currency_symbol="true"><?php if($payment->is_return == 1): ?> <?php echo e(-1*$payment->amount, false); ?> <?php else: ?> <?php echo e($payment->amount, false); ?> <?php endif; ?></span></td>
                              <td><?php echo e($payment->location->name, false); ?></td>
                              <td><?php echo e($payment_types[$payment->method] ?? '', false); ?>

                                <?php if($payment->is_return == 1): ?>
                                    <br/>
                                    ( <?php echo e(__('lang_v1.change_return'), false); ?> )
                                <?php endif; ?>
                              </td>
                              <td><?php if(!empty($payment->gateway)): ?><?php echo e($payment->gateway, false); ?> - <?php endif; ?> <?php echo e($payment->note, false); ?></td>
                              <?php if($accounts_enabled): ?>
                                <td><?php echo e($payment->payment_account->name ?? '', false); ?></td>
                              <?php endif; ?>
                              <td class="no-print" style="display: flex;">
                                <?php if($can_edit_payment): ?>
                                <button type="button" class="btn btn-info btn-xs edit_payment" 
                                    data-href="<?php echo e(action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'getEditPayment'], [$payment->id]), false); ?>?payroll_group_id=<?php echo e($payroll_group->id, false); ?>"><i class="fa fa-edit"></i></button>
                                &nbsp; 
                                <?php endif; ?>
                                <?php if($can_delete_payment): ?>
                                <button type="button" class="btn btn-danger btn-xs delete_payment" 
                                data-href="<?php echo e(action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'deletePayment'], [$payment->id]), false); ?>?payroll_group_id=<?php echo e($payroll_group->id, false); ?>"
                                ><i class="fa fa-trash" aria-hidden="true"></i></button>
                            
                                &nbsp;
                                <?php endif; ?>
                                <?php if($can_view_payment): ?>
                                <button type="button" class="btn btn-primary btn-xs view_payment" data-href="<?php echo e(action([\App\Http\Controllers\TransactionPaymentController::class, 'viewPayment'], [$payment->id]), false); ?>">
                                  <i class="fa fa-eye" aria-hidden="true"></i>
                                </button>
                                <?php endif; ?>
                              </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                            <tr class="text-center">
                              <td colspan="7"><?php echo app('translator')->get('purchase.no_records_found'); ?></td>
                            </tr>
                        <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            
            <button type="button" class="btn btn-default no-print" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
