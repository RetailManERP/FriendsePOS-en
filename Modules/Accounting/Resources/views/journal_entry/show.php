<div class="modal-dialog modal-xl" role="document">
  <div class="modal-content">
  <div class="modal-header no-print">
      <h4 class="modal-title no-print">
        <?php echo app('translator')->get( 'accounting::lang.journal_entry' ); ?>
        <?php if(!empty($journal->ref_no)): ?>
          ( <?php echo app('translator')->get('purchase.ref_no'); ?>: <?php echo e($journal->ref_no, false); ?> )
        <?php endif; ?>
      </h4>
      <button type="button" class="btn-close no-print" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <div class="row text-center">
        <h3><?php echo e($journal->business->name, false); ?></h3>
        <p><?php echo $journal->business->business_address; ?></p>
        <hr>
      </div>

      <div class="row">
       
        <div class="col-xs-6">
        <b><?php echo app('translator')->get( 'accounting::lang.journal_entry' ); ?></b></br>
          <b><?php echo app('translator')->get('purchase.ref_no'); ?>:</b> 
            <?php if(!empty($journal->ref_no)): ?>
              <?php echo e($journal->ref_no, false); ?>

            <?php else: ?>
              --
            <?php endif; ?>
            <br/>
          <b><?php echo app('translator')->get('lang_v1.paid_on'); ?>:</b> <?php echo format_datetime_br($journal->operation_date); ?><br/>

        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <br>
          <div class="table-responsive">
          <table class="table table-striped table-th-skin">
            <thead class="bg-success">
              <tr>
                <th class="col-md-1">#</th>
                
                <th class="col-md-4"><?php echo app('translator')->get( 'accounting::lang.account' ); ?></th>
                <th class="col-md-3"><?php echo app('translator')->get( 'accounting::lang.narration' ); ?></th>
                <th class="col-md-2"><?php echo app('translator')->get( 'accounting::lang.debit' ); ?></th>
                <th class="col-md-2"><?php echo app('translator')->get( 'accounting::lang.credit' ); ?></th>
              </tr>
            </thead>
            <tbody>
              <?php $__empty_18 = true; $__currentLoopData = $accounts_transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
              
                <tr>
                  <td><?php echo e($loop->index+1, false); ?></td>
                  
                  <td><?php echo e($tran['account']['name'], false); ?></td>
                  <td><?php echo e($tran['note'], false); ?></td>
                  <td>
                    <?php if($tran['type'] == 'debit'): ?>
                        <?php echo e(number_format($tran['amount'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                    <?php endif; ?>
                  
                  </td>
                  <td><?php if($tran['type'] == 'credit'): ?>
                        <?php echo e(number_format($tran['amount'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                    <?php endif; ?></td>
                </tr>  
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                <tr>
                  <td class="text-center" colspan="4">No Transactions</td>
                </tr>
              <?php endif; ?>
            </tbody>
            <tfoot class="table-th-skin">
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <th><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $journal->amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
                <th><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $journal->amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
              </tr>
            </tfoot>
          </table>
          </div>
        </div>
      </div>

      <div class="row">
          
          <div class="col-xs-6">
            <strong><?php echo app('translator')->get('lang_v1.added_by'); ?> :</strong>
              <?php echo e($journal->added_by, false); ?><br>
            <strong><?php echo app('translator')->get('purchase.payment_note'); ?> :</strong>
              <?php echo e($journal->note, false); ?><br>
            <strong><?php echo app('translator')->get('sale.location'); ?> :</strong>
                <?php echo e($journal->location->name, false); ?>

              
          </div>
      </div>

      <?php if(!empty($cheque_info)): ?>
      <div class="row mt-3">
          <div class="col-md-12">
              <div class="card border-info">
                  <div class="card-header bg-info text-white py-2">
                      <i class="fas fa-money-check me-1"></i>
                      <strong><?php echo app('translator')->get('accounting::lang.cheque_details'); ?></strong>
                  </div>
                  <div class="card-body p-2">
                      <table class="table table-sm table-bordered mb-0">
                          <tbody>
                              <tr>
                                  <th style="width:25%;"><?php echo app('translator')->get('accounting::lang.bank_account'); ?></th>
                                  <td><?php echo e($cheque_info->chequeBook->bankAccount->name ?? '-', false); ?></td>
                                  <th style="width:25%;"><?php echo app('translator')->get('accounting::lang.cheque_book_no'); ?></th>
                                  <td><?php echo e($cheque_info->chequeBook->cheque_book_no ?? '-', false); ?></td>
                              </tr>
                              <tr>
                                  <th><?php echo app('translator')->get('accounting::lang.cheque_number'); ?></th>
                                  <td><strong><?php echo e($cheque_info->cheque_number, false); ?></strong></td>
                                  <th><?php echo app('translator')->get('accounting::lang.cheque_date'); ?></th>
                                  <td><?php echo e($cheque_info->cheque_date ? \Carbon::createFromTimestamp(strtotime($cheque_info->cheque_date))->format(session('business.date_format')) : '-', false); ?></td>
                              </tr>
                              <?php if($cheque_info->issued_to || $cheque_info->amount): ?>
                              <tr>
                                  <th><?php echo app('translator')->get('accounting::lang.issued_to'); ?></th>
                                  <td><?php echo e($cheque_info->issued_to ?? '-', false); ?></td>
                                  <th><?php echo app('translator')->get('sale.amount'); ?></th>
                                  <td><?php echo e($cheque_info->amount ? number_format($cheque_info->amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : '-', false); ?></td>
                              </tr>
                              <?php endif; ?>
                              <?php if($cheque_info->memo): ?>
                              <tr>
                                  <th><?php echo app('translator')->get('accounting::lang.memo'); ?></th>
                                  <td colspan="3"><?php echo e($cheque_info->memo, false); ?></td>
                              </tr>
                              <?php endif; ?>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
      <?php endif; ?>

      
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary no-print" aria-label="Print" 
      onclick="$(this).closest('div.modal-content').printThis();"><i class="fa fa-print"></i> <?php echo app('translator')->get( 'messages.print' ); ?>
      </button>
      <button type="button" class="btn btn-default no-print" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>
  </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		var element = $('div.modal-xl');
		__currency_convert_recursively(element);
	});
</script>
