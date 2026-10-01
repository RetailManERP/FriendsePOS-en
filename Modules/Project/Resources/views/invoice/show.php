<div class="modal-dialog modal-xl project-modal no-print" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">
                <?php echo app('translator')->get('project::lang.invoice_details'); ?>
                (<b><?php echo app('translator')->get('sale.invoice_no'); ?>:</b> <?php echo e($transaction->invoice_no, false); ?>)
            </h4>
        </div>
        <div class="modal-body">
            <div class="row">
              <div class="col-xs-12">
                  <p class="pull-right"><b><?php echo app('translator')->get('messages.date'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($transaction->transaction_date))->format(session('business.date_format')), false); ?></p>
              </div>
            </div>
            <!-- invoice details -->
            <div class="row">
                <div class="col-sm-4 invoice-col">
                    <b><?php echo app('translator')->get('project::lang.title'); ?>:</b>
                        <?php echo e($transaction->pjt_title, false); ?><br>
                    <b><?php echo e(__('sale.invoice_no'), false); ?>:</b>
                        #<?php echo e($transaction->invoice_no, false); ?><br>
                    <b><?php echo e(__('sale.status'), false); ?>:</b>
                       <?php echo e(__('sale.' . $transaction->status), false); ?>

                    <br>
                    <b><?php echo e(__('sale.payment_status'), false); ?>:</b>
                    <?php if(!empty($transaction->payment_status)): ?>
                        <?php echo e(__('lang_v1.'.$transaction->payment_status), false); ?>

                        <br>
                    <?php endif; ?>
                </div>
                <div class="col-sm-4 invoice-col">
                    <b><?php echo e(__('sale.customer_name'), false); ?>:</b>
                        <?php echo e($transaction->contact->name, false); ?><br>
                    <b><?php echo e(__('business.address'), false); ?>:</b><br>
                    <?php if(!empty($transaction->billing_address())): ?>
                      <?php echo e($transaction->billing_address(), false); ?>

                    <?php else: ?>
                      <?php if($transaction->contact->landmark): ?>
                          <?php echo e($transaction->contact->landmark, false); ?>,
                      <?php endif; ?>

                      <?php echo e($transaction->contact->city, false); ?>


                      <?php if($transaction->contact->state): ?>
                          <?php echo e(', ' . $transaction->contact->state, false); ?>

                      <?php endif; ?>
                      <br>
                      <?php if($transaction->contact->country): ?>
                          <?php echo e($transaction->contact->country, false); ?>

                      <?php endif; ?>
                      <?php if($transaction->contact->mobile): ?>
                      <br>
                          <?php echo e(__('contact.mobile'), false); ?>: <?php echo e($transaction->contact->mobile, false); ?>

                      <?php endif; ?>
                      <?php if($transaction->contact->alternate_number): ?>
                      <br>
                          <?php echo e(__('contact.alternate_contact_number'), false); ?>:
                          <?php echo e($transaction->contact->alternate_number, false); ?>

                      <?php endif; ?>
                      <?php if($transaction->contact->landline): ?>
                        <br>
                          <?php echo e(__('contact.landline'), false); ?>:
                          <?php echo e($transaction->contact->landline, false); ?>

                      <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="col-sm-4 invoice-col">
                    <b><?php echo app('translator')->get('project::lang.project'); ?>:</b>
                    <?php echo e($transaction->project->name, false); ?> <br>
                    <b><?php echo app('translator')->get('sale.status'); ?>:</b>
                    <?php echo app('translator')->get('project::lang.'.$transaction->project->status); ?>
                    <br>
                    <?php if(isset($transaction->project->start_date)): ?>
                        <b><?php echo app('translator')->get('business.start_date'); ?>:</b>
                        <?php echo e(\Carbon::createFromTimestamp(strtotime($transaction->project->start_date))->format(session('business.date_format')), false); ?>

                    <?php endif; ?> <br>
                    <?php if(isset($transaction->project->end_date)): ?>
                        <b><?php echo app('translator')->get('project::lang.end_date'); ?>:</b>
                        <?php echo e(\Carbon::createFromTimestamp(strtotime($transaction->project->end_date))->format(session('business.date_format')), false); ?>

                    <?php endif; ?>
                </div>
            </div> <br>
            <!-- /invoice details -->

            <!-- invoice lines -->
            <div class="row">
              <div class="col-sm-12 col-xs-12">
                <h4><?php echo e(__('project::lang.tasks'), false); ?>:</h4>
              </div>

              <div class="col-sm-12 col-xs-12">
                <div class="table-responsive">
                  <?php if ($__env->exists('project::invoice.partials.invoice_line_table')) echo $__env->make('project::invoice.partials.invoice_line_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
              </div>
            </div>
            <!-- /invoice lines -->

            <!-- payment info & invoice total -->
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <h4><?php echo e(__('sale.payment_info'), false); ?>:</h4>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                        <table class="table bg-gray">
                            <tr class="bg-green">
                                <th>#</th>
                                <th><?php echo e(__('messages.date'), false); ?></th>
                                <th><?php echo e(__('purchase.ref_no'), false); ?></th>
                                <th><?php echo e(__('sale.amount'), false); ?></th>
                                <th><?php echo e(__('sale.payment_mode'), false); ?></th>
                                <th><?php echo e(__('sale.payment_note'), false); ?></th>
                            </tr>
                            <?php
                                $total_paid = 0;
                            ?>
                            <?php $__currentLoopData = $transaction->payment_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    if($payment_line->is_return == 1){
                                      $total_paid -= $payment_line->amount;
                                    } else {
                                      $total_paid += $payment_line->amount;
                                    }
                                ?>
                            <tr>
                                <td><?php echo e($loop->iteration, false); ?></td>
                                <td><?php echo e(\Carbon::createFromTimestamp(strtotime($payment_line->paid_on))->format(session('business.date_format')), false); ?></td>
                                <td><?php echo e($payment_line->payment_ref_no, false); ?></td>
                                <td>
                                    <span class="display_currency" data-currency_symbol="true">
                                        <?php echo e($payment_line->amount, false); ?>

                                    </span>
                                </td>
                                <td>
                                  <?php echo e($payment_types[$payment_line->method] ?? $payment_line->method, false); ?>

                                  <?php if($payment_line->is_return == 1): ?>
                                    <br/>
                                    ( <?php echo e(__('lang_v1.change_return'), false); ?> )
                                  <?php endif; ?>
                                </td>
                                <td><?php if($payment_line->note): ?>
                                  <?php echo e(ucfirst($payment_line->note), false); ?>

                                  <?php else: ?>
                                  --
                                  <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                        <table class="table bg-gray">
                            <tr>
                                <th><?php echo e(__('sale.subtotal'), false); ?>: </th>
                                <td></td>
                                <td>
                                    <span class="display_currency pull-right" data-currency_symbol="true">
                                        <?php echo e($transaction->total_before_tax, false); ?>

                                    </span>
                                </td>
                            </tr>
                            <tr>
                                  <th><?php echo e(__('sale.discount'), false); ?>:</th>
                                  <td><b>(-)</b></td>
                                  <td>
                                      <div class="pull-right">
                                          <span class="display_currency"
                                              <?php if( $transaction->discount_type == 'fixed'): ?> data-currency_symbol="true" <?php endif; ?>>
                                              <?php echo e($transaction->discount_amount, false); ?>

                                          </span>
                                          <?php if($transaction->discount_type == 'percentage'): ?>
                                              <?php echo e('%', false); ?>

                                          <?php endif; ?>
                                      </div>
                                  </td>
                            </tr>
                            <tr>
                                <th><?php echo e(__('sale.total_payable'), false); ?>: </th>
                                <td></td>
                                <td>
                                    <span class="display_currency pull-right" data-currency_symbol="true">
                                        <?php echo e($transaction->final_total, false); ?>

                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th><?php echo e(__('sale.total_paid'), false); ?>:</th>
                                <td></td>
                                <td>
                                    <span class="display_currency pull-right" data-currency_symbol="true" >
                                        <?php echo e($total_paid, false); ?>

                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <?php echo e(__('sale.total_remaining'), false); ?>:
                                </th>
                                <td></td>
                                <td>
                                    <span class="display_currency pull-right" data-currency_symbol="true" >
                                        <?php echo e($transaction->final_total - $total_paid, false); ?>

                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /payment info & invoice total -->

            <!-- terms/notes -->
            <div class="row">
                <div class="col-sm-6">
                    <strong>
                        <?php echo e(__('project::lang.terms'), false); ?>:
                    </strong><br>
                    <p class="well well-sm no-shadow bg-gray">
                      <?php if($transaction->staff_note): ?>
                        <?php echo e($transaction->staff_note, false); ?>

                      <?php else: ?>
                        --
                      <?php endif; ?>
                    </p>
                </div>
                <div class="col-sm-6">
                    <strong>
                        <?php echo e(__('project::lang.notes'), false); ?>:
                    </strong><br>
                    <p class="well well-sm no-shadow bg-gray">
                      <?php if($transaction->additional_notes): ?>
                        <?php echo e($transaction->additional_notes, false); ?>

                      <?php else: ?>
                        --
                      <?php endif; ?>
                    </p>
                </div>
            </div>
            <!-- / terms/notes -->
        </div>
        <div class="modal-footer">
        <button type="button" class="tw-dw-btn tw-dw-btn-primary tw-text-white no-print" aria-label="Print"
                onclick="$(this).closest('div.modal-content').printThis();"><i class="fa fa-print"></i> <?php echo app('translator')->get( 'messages.print' ); ?>
        </button>
            <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white no-print" data-dismiss="modal">
                <?php echo app('translator')->get( 'messages.close' ); ?>
            </button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script type="text/javascript">
  $(document).ready(function(){
    var element = $('div.modal-xl');
    __currency_convert_recursively(element);
  });
</script>
