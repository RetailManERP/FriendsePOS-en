<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header no-print">
      <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title no-print">
        <?php if(!empty($invoice->ref_no)): ?>
          ( <?php echo app('translator')->get('purchase.ref_no'); ?>: <?php echo e($invoice->ref_no, false); ?> )
        <?php endif; ?>
      </h4>
    </div>
    <div class="modal-body">
      <div class="row text-center">
        <h3><?php echo e($invoice->business->name, false); ?></h3>
        <p><?php echo $invoice->business->business_address; ?></p>
        <hr>
      </div>

      <?php if(!empty($invoice)): ?>
        <div class="row">
            <div class="col-xs-6">
              <?php if(!empty($invoice->transaction_for)): ?>
                <?php echo app('translator')->get('truckmate::lang.driver'); ?>:
                <address>
                    <strong><?php echo e($invoice->transaction_for->user_full_name, false); ?></strong>
                    <?php if(!empty($invoice->transaction_for->permanent_address)): ?>
                        <br><?php echo e($invoice->transaction_for->permanent_address, false); ?>

                    <?php endif; ?>
                    <?php if(!empty($invoice->transaction_for->contact_number)): ?>
                        <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($invoice->transaction_for->contact_number, false); ?>

                    <?php endif; ?>
                    <?php if(!empty($invoice->transaction_for->email)): ?>
                        <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($invoice->transaction_for->email, false); ?>

                    <?php endif; ?>
                </address>
              <?php endif; ?>
            </div>
            <div class="col-xs-6">
              <b><?php echo app('translator')->get('purchase.ref_no'); ?>:</b> <?php echo e($invoice->ref_no, false); ?><br>
              <b><?php echo app('translator')->get('messages.date'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($invoice->transaction_date))->format(session('business.date_format')), false); ?><br>
              <b><?php echo app('translator')->get('truckmate::lang.truckmate_week_start'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($invoice->week_start))->format(session('business.date_format')), false); ?> <br>
              <b><?php echo app('translator')->get('truckmate::lang.truckmate_week_end'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($invoice->week_end))->format(session('business.date_format')), false); ?> <br>
            </div>
            <div class="col-xs-6 hide">
              <?php echo app('translator')->get('business.business'); ?>:
              <address>
                <strong><?php echo e($invoice->business->name, false); ?></strong>
                <?php if(!empty($invoice->location)): ?>
                  <?php echo e($invoice->location->name, false); ?>

                  <?php if(!empty($invoice->location->landmark)): ?>
                    <br><?php echo e($invoice->location->landmark, false); ?>

                  <?php endif; ?>
                  <?php if(!empty($invoice->location->city) || !empty($invoice->location->state) || !empty($invoice->location->country)): ?>
                    <br><?php echo e(implode(',', array_filter([$invoice->location->city, $invoice->location->state, $invoice->location->country])), false); ?>

                  <?php endif; ?>
                <?php endif; ?>
                
                <?php if(!empty($invoice->business->tax_number_1)): ?>
                  <br><?php echo e($invoice->business->tax_label_1, false); ?>: <?php echo e($invoice->business->tax_number_1, false); ?>

                <?php endif; ?>

                <?php if(!empty($invoice->business->tax_number_2)): ?>
                  <br><?php echo e($invoice->business->tax_label_2, false); ?>: <?php echo e($invoice->business->tax_number_2, false); ?>

                <?php endif; ?>

                <?php if(!empty($invoice->location)): ?>
                  <?php if(!empty($invoice->location->mobile)): ?>
                    <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($invoice->location->mobile, false); ?>

                  <?php endif; ?>
                  <?php if(!empty($invoice->location->email)): ?>
                    <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($invoice->location->email, false); ?>

                  <?php endif; ?>
                <?php endif; ?>
              </address>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
            </div>
        </div>
      <?php endif; ?>

      <div class="row">
          <br>
          <div class="col-xs-6">
            <strong><?php echo app('translator')->get('purchase.amount'); ?> :</strong>
            <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $invoice->amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?><br>
            <strong><?php echo app('translator')->get('lang_v1.payment_method'); ?> :</strong>
            <?php echo e($payment_types[$invoice->method] ?? '', false); ?><br>
            <?php if($invoice->method == "card"): ?>
              <strong><?php echo app('translator')->get('lang_v1.card_holder_name'); ?> :</strong>
              <?php echo e($invoice->card_holder_name, false); ?> <br>
              <strong><?php echo app('translator')->get('lang_v1.card_number'); ?> :</strong>
              <?php echo e($invoice->card_number, false); ?> <br>
              <strong><?php echo app('translator')->get('lang_v1.card_invoice_number'); ?> :</strong>
              <?php echo e($invoice->card_invoice_number, false); ?>

              
            <?php elseif($invoice->method == "cheque"): ?>
              <strong><?php echo app('translator')->get('lang_v1.cheque_number'); ?> :</strong>
              <?php echo e($invoice->cheque_number, false); ?>

            <?php elseif($invoice->method == "bank_transfer"): ?>

            <?php elseif($invoice->method == "custom_pay_1"): ?>

              <strong><?php echo app('translator')->get('lang_v1.invoice_number'); ?> :</strong>
              <?php echo e($invoice->invoice_no, false); ?>

            <?php elseif($invoice->method == "custom_pay_2"): ?>

              <strong><?php echo app('translator')->get('lang_v1.invoice_number'); ?> :</strong>
              <?php echo e($invoice->invoice_no, false); ?>

            <?php elseif($invoice->method == "custom_pay_3"): ?>

              <strong> <?php echo app('translator')->get('lang_v1.invoice_number'); ?>:</strong>
              <?php echo e($invoice->invoice_no, false); ?>

            <?php endif; ?>
            <strong><?php echo app('translator')->get('purchase.payment_note'); ?> :</strong>
              <?php echo e($invoice->note, false); ?>

          </div>
          <div class="col-xs-6">
            <b><?php echo app('translator')->get('purchase.ref_no'); ?>:</b> 
              <?php if(!empty($invoice->payment_ref_no)): ?>
                <?php echo e($invoice->payment_ref_no, false); ?>

              <?php else: ?>
                --
              <?php endif; ?>
              <br/>
            <b><?php echo app('translator')->get('lang_v1.paid_on'); ?>:</b> <?php echo format_datetime_br($invoice->paid_on); ?><br/>
            <br>
            <?php if(!empty($invoice->document_path)): ?>
              <a href="<?php echo e($invoice->document_path, false); ?>" class="btn btn-success btn-xs no-print" download="<?php echo e($invoice->document_name, false); ?>"><i class="fa fa-download" data-toggle="tooltip" title="<?php echo e(__('purchase.download_document'), false); ?>"></i> <?php echo e(__('purchase.download_document'), false); ?></a>
            <?php endif; ?>
          </div>
      </div>

      
    </div>
    <div class="modal-footer no-print">
      <button type="button" class="btn btn-primary no-print" 
        aria-label="Print" 
          onclick="$(this).closest('div.modal').printThis();">
        <i class="fa fa-print"></i> <?php echo app('translator')->get( 'messages.print' ); ?>
      </button>
      <button type="button" class="btn btn-default no-print" data-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?>
      </button>
    </div>
  </div>
</div>