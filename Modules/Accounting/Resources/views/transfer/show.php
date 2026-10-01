<div class="modal-dialog modal-xl" role="document">
  <div class="modal-content">
  <div class="modal-header no-print">
      <h4 class="modal-title no-print">
        <?php echo app('translator')->get( 'accounting::lang.transfer' ); ?>
        <?php if(!empty($mapping_transaction->ref_no)): ?>
          ( <?php echo app('translator')->get('purchase.ref_no'); ?>: <?php echo e($mapping_transaction->ref_no, false); ?> )
        <?php endif; ?>
      </h4>
      <button type="button" class="btn-close no-print" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <div class="row text-center">
        <h3><?php echo e($mapping_transaction->business->name, false); ?></h3>
        <p><?php echo $mapping_transaction->business->business_address; ?></p>
        <hr>
      </div>

      <div class="row">
       
        <div class="col-xs-6">
        <b><?php echo app('translator')->get( 'accounting::lang.transfer' ); ?></b><br>
          <b><?php echo app('translator')->get('purchase.ref_no'); ?>:</b> 
            <?php if(!empty($mapping_transaction->ref_no)): ?>
              <?php echo e($mapping_transaction->ref_no, false); ?>

            <?php else: ?>
              --
            <?php endif; ?>
            <br/>
          <b><?php echo app('translator')->get('lang_v1.paid_on'); ?>:</b> <?php echo format_datetime_br($mapping_transaction->operation_date); ?><br/>

        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <br>
          <div class="table-responsive">
          <table class="table table-striped table-th-skin">
            <thead class="bg-success">
              <tr>
                <th>#</th>
                <th>Transaction Type</th>
                <th>Tranfer Debit Account Name</th>
                <th>Transfer Credit Account Name</th>
                <th>Debit</th>
                <th>Credit</th>
              </tr>
            </thead>
            <tbody>              
                <tr>
                <td>1</td>
                <td>Debit</td>
                <td><?php echo e($debit_tansaction->name, false); ?></td>
                <td></td>
                <td><?php echo e($debit_tansaction->amount, false); ?></td>
                <td></td>
                </tr>  

                <tr>
                <td>2</td>
                <td>Credit</td>
                <td></td>
                <td><?php echo e($credit_tansaction->name, false); ?></td>
                <td></td>
                <td><?php echo e($credit_tansaction->amount, false); ?></td>
                </tr>  
              
            </tbody>
            <tfoot class="table-th-skin">
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <th><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $debit_tansaction->amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
                <th><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $credit_tansaction->amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

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
              <?php echo e($mapping_transaction->added_by, false); ?><br>
            <strong><?php echo app('translator')->get('purchase.payment_note'); ?> :</strong>
              <?php echo e($mapping_transaction->note, false); ?><br>
            <strong><?php echo app('translator')->get('sale.location'); ?> :</strong>
                <?php echo e($mapping_transaction->location->name, false); ?>

              
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
                  <div class="card-body">
                      <div class="row">
                          <?php if($cheque_info->chequeBook && $cheque_info->chequeBook->bankAccount): ?>
                          <div class="col-md-4">
                              <strong><?php echo app('translator')->get('accounting::lang.bank_account'); ?>:</strong><br>
                              <?php echo e($cheque_info->chequeBook->bankAccount->name, false); ?>

                          </div>
                          <div class="col-md-4">
                              <strong><?php echo app('translator')->get('accounting::lang.cheque_book_no'); ?>:</strong><br>
                              <?php echo e($cheque_info->chequeBook->cheque_book_no, false); ?>

                          </div>
                          <?php endif; ?>
                          <div class="col-md-4">
                              <strong><?php echo app('translator')->get('accounting::lang.cheque_number'); ?>:</strong><br>
                              <?php echo e($cheque_info->cheque_number, false); ?>

                          </div>
                      </div>
                      <div class="row mt-2">
                          <div class="col-md-4">
                              <strong><?php echo app('translator')->get('accounting::lang.cheque_date'); ?>:</strong><br>
                              <?php echo e(!empty($cheque_info->cheque_date) ? \Carbon::createFromTimestamp(strtotime($cheque_info->cheque_date))->format(session('business.date_format')) : '--', false); ?>

                          </div>
                          <?php if(!empty($cheque_info->amount)): ?>
                          <div class="col-md-4">
                              <strong><?php echo app('translator')->get('sale.amount'); ?>:</strong><br>
                              <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $cheque_info->amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                          </div>
                          <?php endif; ?>
                          <?php if(!empty($cheque_info->memo)): ?>
                          <div class="col-md-4">
                              <strong><?php echo app('translator')->get('accounting::lang.memo'); ?>:</strong><br>
                              <?php echo e($cheque_info->memo, false); ?>

                          </div>
                          <?php endif; ?>
                      </div>
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
