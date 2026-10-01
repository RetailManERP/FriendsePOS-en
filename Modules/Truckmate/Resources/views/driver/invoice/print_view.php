<div class="modal-dialog modal-lg" role="document">
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
            <hr>
            <div class="col-xs-12">
               <div class="table-responsive">
                  <table class="table table-bordered" id="job_table">
                    <thead>
                      <tr>
                        <th class="col-md-2 text-center">Day & Date</th>
                        <th class="col-md-1 text-center">Hours</th>
                        <th class="col-md-1 text-center">Shift</th>
                        <th class="col-md-1 text-center">Hourly Rate</th>
                        <th class="col-md-1 text-center">Total Amount</th>
                        <th class="col-md-3 text-center">Remarks</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $invoice->weekdays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr class="text-center">
                            <td><?php echo e($w['day'], false); ?> , <?php echo e($w['date'], false); ?></td>
                            <td><?php echo e(number_format($w['hours'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                            <td><?php echo e($w['shift'], false); ?></td>
                            <td><?php echo e(number_format($w['hourly_rate'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                            <td><?php echo e(number_format($w['total_amount'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                            <td><?php echo e($w['remarks'], false); ?></td>
                          </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
              </div>
            </div>
        </div>
      <?php endif; ?>

      <div class="row">

          <?php
            $total_paid = 0;
          ?>
          <?php $__currentLoopData = $invoice->payment_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
              if($payment_line->is_return == 1){
                  $total_paid -= $payment_line->amount;
              } else {
                  $total_paid += $payment_line->amount;
              }
          ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <br>
          <div class="col-xs-6">
            <strong><?php echo app('translator')->get('truckmate::lang.remarks'); ?> :</strong><br>
            <?php echo e($invoice->stafF_note, false); ?>

          </div>
          <div class="col-xs-6">
            <strong><?php echo app('translator')->get('sale.total'); ?> :</strong> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $invoice->total_before_tax, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?><br>
            <strong><?php echo app('translator')->get('sale.total_payable'); ?> :</strong> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $invoice->final_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?><br>
            <strong><?php echo app('translator')->get('sale.total_paid'); ?> :</strong> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_paid, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?><br>
            <strong><?php echo app('translator')->get('sale.total_remaining'); ?> :</strong> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $invoice->final_total - $total_paid, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?><br>
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
<script type="text/javascript">
	$(document).ready( function(){
      $('.modal-content').closest('div.modal').printThis();
  });
</script>