<div class="modal-dialog modal-xl no-print" role="document">
  <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title" id="modalTitle"><i class="fas fa-file-invoice me-2" style="color:var(--tm-primary)"></i> <?php echo app('translator')->get('truckmate::lang.truckmate_details'); ?> (<b><?php echo app('translator')->get('sale.invoice_no'); ?>:</b> <?php echo e($invoice->invoice_no, false); ?>)
    </h4>
    <button type="button" class="btn-close no-print" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body tm-content">
    <div class="row">
      <div class="col-xs-12">
          <p class="pull-right"><b><?php echo app('translator')->get('messages.date'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($invoice->transaction_date))->format(session('business.date_format')), false); ?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <b><?php echo e(__('sale.invoice_no'), false); ?>:</b> #<?php echo e($invoice->invoice_no, false); ?><br>
        <b><?php echo e(__('sale.status'), false); ?>:</b> <?php echo e(ucwords($invoice->status), false); ?>

        <br>
        <b><?php echo e(__('sale.payment_status'), false); ?>:</b> <?php echo e(ucfirst( $invoice->payment_status ), false); ?><br>
      </div>
      <div class="col-sm-4">
        <b><?php echo e(__('sale.customer_name'), false); ?>:</b> <?php echo e(($invoice->contact->name) ? $invoice->contact->name : $invoice->contact->supplier_business_name, false); ?><br>
        <b><?php echo e(__('business.address'), false); ?>:</b><br>
        <?php if(!empty($invoice->billing_address())): ?>
          <?php echo e($invoice->billing_address(), false); ?>

        <?php else: ?>
          <?php echo $invoice->contact->contact_address; ?>

        <?php endif; ?>
      </div>
      <div class="col-sm-4">

      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-12 col-xs-12">
        <h4><?php echo e(__('truckmate::lang.job_sheets'), false); ?>:</h4>
      </div>

      <div class="col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table bg-gray" id="job_table">
						<thead>
							<tr>
								<th class="text-center">	
									<?php echo app('translator')->get('lang_v1.date'); ?>
								</th>
								<th class="text-center">	
									<?php echo app('translator')->get('truckmate::lang.job_sheet'); ?>
								</th>
								<th class="text-center">	
									<?php echo app('translator')->get('truckmate::lang.collection'); ?>
								</th>
								<th class="text-center">	
									<?php echo app('translator')->get('truckmate::lang.drop_off'); ?>
								</th>
								<th class="text-center">	
									<?php echo app('translator')->get('truckmate::lang.price'); ?>
								</th>
								<th class="text-center">	
									<?php echo app('translator')->get('truckmate::lang.waiting_charges'); ?>
								</th>
								<th class="text-center">
									<?php echo app('translator')->get('sale.subtotal'); ?>
								</th>
							</tr>
						</thead>
						<tbody>
                <?php $__currentLoopData = $job_sheets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job_sheet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr class="text-center">
                    <td><?php echo e(\Carbon::createFromTimestamp(strtotime($job_sheet->start_date))->format(session('business.date_format')), false); ?></td>
                    <td><?php echo e($job_sheet->job_sheet_no, false); ?></td>
                    <td><?php echo e($job_sheet->load_point, false); ?></td>
                    <td><?php echo e($job_sheet->dest_point, false); ?></td>
                    <td><?php echo e(number_format($job_sheet->price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                    <td><?php echo e(number_format($job_sheet->extra_charges, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                    <td><?php echo e(number_format($job_sheet->line_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
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
                            <th><?php echo e(__('sale.discount'), false); ?>:</th>
                            <td><b>(-)</b></td>
                            <td><span class="pull-right"><?php echo e($invoice->discount_amount, false); ?> <?php if( $invoice->discount_type == 'percentage'): ?> <?php echo e('%', false); ?> <?php endif; ?></span></td>
                        </tr>
                        <?php if(session('business.enable_rp') == 1 && !empty($invoice->rp_redeemed) ): ?>
                          <tr>
                            <th><?php echo e(session('business.rp_name'), false); ?>:</th>
                            <td><b>(-)</b></td>
                            <td> <span class="display_currency pull-right" data-currency_symbol="true"><?php echo e($invoice->rp_redeemed_amount, false); ?></span></td>
                          </tr>
                        <?php endif; ?>
                        <tr>
                            <th><?php echo e(__('sale.order_tax'), false); ?>:</th>
                            <td><b>(+)</b></td>
                            <td class="text-right">
                                <?php if(!empty($order_taxes)): ?>
                                  <?php $__currentLoopData = $order_taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <strong><small><?php echo e($k, false); ?></small></strong> - <span class="display_currency pull-right" data-currency_symbol="true"><?php echo e($v, false); ?></span><br>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                0.00
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo e(__('sale.shipping'), false); ?>: <?php if($invoice->shipping_details): ?>(<?php echo e($invoice->shipping_details, false); ?>) <?php endif; ?></th>
                            <td><b>(+)</b></td>
                            <td><span class="display_currency pull-right" data-currency_symbol="true"><?php echo e($invoice->shipping_charges, false); ?></span></td>
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
    <a href="#" class="print-invoice btn btn-primary" data-href="<?php echo e(route('truckmate.print-invoice', [$invoice->id]), false); ?>">
        <i class="fa fa-print" aria-hidden="true"></i>
        <?php echo app('translator')->get("messages.print"); ?>
    </a>
    <button type="button" class="btn btn-default no-print" data-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    var element = $('div.modal-xl');
    __currency_convert_recursively(element);

    <?php if(!empty($invoice->truckmate_security_pattern)): ?>
        var security_pattern =  new PatternLock("#security_pattern_container", {
                                enableSetPattern: true
                            });
        security_pattern.setPattern("<?php echo e($invoice->truckmate_security_pattern, false); ?>");
    <?php endif; ?>
  });
</script>
