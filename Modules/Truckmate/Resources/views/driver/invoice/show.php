<div class="modal-dialog modal-xl no-print" role="document">
  <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="modalTitle"> <?php echo app('translator')->get('truckmate::lang.truckmate_details'); ?> (<b><?php echo app('translator')->get('purchase.ref_no'); ?>:</b> <?php echo e($invoice->ref_no, false); ?>)
    </h4>
</div>
<div class="modal-body">
    <div class="row">
      <div class="col-xs-12">
          <p class="pull-right"><b><?php echo app('translator')->get('messages.date'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($invoice->transaction_date))->format(session('business.date_format')), false); ?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <b><?php echo e(__('purchase.ref_no'), false); ?>:</b> #<?php echo e($invoice->ref_no, false); ?><br>
        <b><?php echo e(__('sale.status'), false); ?>:</b> <?php echo e(ucwords($invoice->status), false); ?>

        <br>
        <b><?php echo e(__('sale.payment_status'), false); ?>:</b> <?php echo e(ucfirst( $invoice->payment_status ), false); ?><br>
      </div>
      <div class="col-sm-4">
        <b><?php echo e(__('truckmate::lang.driver'), false); ?>:</b> <?php echo e($invoice->transaction_for->user_full_name, false); ?><br>
        
        <b><?php echo app('translator')->get('truckmate::lang.truckmate_week_start'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($invoice->week_start))->format(session('business.date_format')), false); ?> <br>
        <b><?php echo app('translator')->get('truckmate::lang.truckmate_week_end'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($invoice->week_end))->format(session('business.date_format')), false); ?> <br>

      </div>
      <div class="col-sm-4">

      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-12 col-xs-12">
        <h4><?php echo e(__('lang_v1.detailed_list'), false); ?>:</h4>
      </div>

      <div class="col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table bg-gray" id="job_table">
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

    <div class="row">

      <div class="col-md-6">
          <div class="box box-default box-primary">
              <div class="box-header with-border collapsed-box-title" style="cursor: pointer;">
                  <h3 class="box-title"><?php echo e(__('lang_v1.documents'), false); ?>:</h3>

                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                  </div>
                  <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body" style="display: block;">
                  <table class="table table-condensed bg-gray">
                      <tr>
                          <th><?php echo app('translator')->get('lang_v1.name'); ?></th>
                          <th><?php echo app('translator')->get('messages.view'); ?></th>
                          <th><?php echo app('translator')->get('messages.delete'); ?></th>
                      </tr>
                      <?php $__empty_18 = true; $__currentLoopData = $invoice->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                      <tr>
                          <td><?php echo e($media->display_name, false); ?></td>
                          <td><a href="<?php echo e($media->display_url, false); ?>" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-external-link"></i></a></td>
                          <td><a href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\TruckmateController::class, 'deleteMedia'], $media->id), false); ?>"" class="btn btn-danger btn-xs delete_media"><i class="fa fa-trash"></i></a></td>
                      </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                      <tr>
                          <td colspan="3"><?php echo app('translator')->get('purchase.no_records_found'); ?></td>
                      </tr>
                      <?php endif; ?>
                  </table>
              </div>
              <!-- /.box-body -->
          </div>
      </div>
      <div class="col-sm-6">
        <div class="box box-default box-primary">
            <div class="box-header with-border collapsed-box-title" style="cursor: pointer;">
                <h3 class="box-title"><?php echo e(__('sale.payment_info'), false); ?>:</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: block;">
                <div class="table-responsive">
                    <table class="table bg-gray">
                        <tr>
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
                        <?php $__currentLoopData = $invoice->payment_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                <td><span class="display_currency" data-currency_symbol="true"><?php echo e($payment_line->amount, false); ?></span></td>
                                <td>
                                  <?php echo e($payment_types[$payment_line->method], false); ?>

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
                <div class="table-responsive">
                    <table class="table bg-gray">
                        <tr>
                            <th><?php echo e(__('sale.total'), false); ?>: </th>
                            <td></td>
                            <td><span class="display_currency pull-right" data-currency_symbol="true"><?php echo e($invoice->total_before_tax, false); ?></span></td>
                        </tr>
                        <tr>
                            <th><?php echo e(__('sale.total_payable'), false); ?>: </th>
                            <td></td>
                            <td><span class="display_currency pull-right"><?php echo e($invoice->final_total, false); ?></span></td>
                        </tr>
                        <tr>
                            <th><?php echo e(__('sale.total_paid'), false); ?>:</th>
                            <td></td>
                            <td><span class="display_currency pull-right" data-currency_symbol="true" ><?php echo e($total_paid, false); ?></span></td>
                        </tr>
                        <tr>
                            <th><?php echo e(__('sale.total_remaining'), false); ?>:</th>
                            <td></td>
                            <td><span class="display_currency pull-right" data-currency_symbol="true" ><?php echo e($invoice->final_total - $total_paid, false); ?></span></td>
                        </tr>
                    </table>
                </div>

            </div>
            <!-- /.box-body -->
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
          <div class="box box-default box-primary collapsed-box">
              <div class="box-header with-border collapsed-box-title" style="cursor: pointer;">
                  <h3 class="box-title"><?php echo e(__('truckmate::lang.activities'), false); ?>:</h3>

                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                      </button>
                  </div>
                  <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <?php if ($__env->exists('truckmate::truckmate.partials.activities')) echo $__env->make('truckmate::truckmate.partials.activities', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    
    <button type="button" class="btn btn-default no-print" data-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
   </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    var element = $('div.modal-xl');
    __currency_convert_recursively(element);
  });
</script>
