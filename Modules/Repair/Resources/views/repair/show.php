<div class="modal-dialog modal-xl no-print" role="document">
  <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title" id="modalTitle"> <?php echo app('translator')->get('repair::lang.repair_details'); ?> (<b><?php echo app('translator')->get('sale.invoice_no'); ?>:</b> <?php echo e($sell->invoice_no, false); ?>)
    </h4>
    <button type="button" class="btn-close no-print" data-bs-dismiss="modal" aria-label="Close"></button>
    
</div>
<div class="modal-body">
    <div class="row">
      <div class="col-xs-12">
          <p class="float-end"><b><?php echo app('translator')->get('messages.date'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($sell->transaction_date))->format(session('business.date_format')), false); ?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <b><?php echo e(__('sale.invoice_no'), false); ?>:</b> #<?php echo e($sell->invoice_no, false); ?><br>
        <b><?php echo e(__('sale.status'), false); ?>:</b> <span class="label" style="background-color: <?php echo e($sell->repair_status_color, false); ?>;"><?php echo e($sell->repair_status, false); ?></span>
        <br>
        <b><?php echo e(__('sale.payment_status'), false); ?>:</b> <?php echo e(ucfirst( $sell->payment_status ), false); ?><br>
      </div>
      <div class="col-sm-4">
        <b><?php echo e(__('sale.customer_name'), false); ?>:</b> <?php echo e($sell->contact->name, false); ?><br>
        <b><?php echo e(__('business.address'), false); ?>:</b><br>
        <?php if(!empty($sell->billing_address())): ?>
          <?php echo e($sell->billing_address(), false); ?>

        <?php else: ?>
          <?php echo $sell->contact->contact_address; ?>

        <?php endif; ?>
      </div>
      <div class="col-sm-4">
        <strong><?php echo app('translator')->get('product.brand'); ?>: </strong> <?php echo e($sell->manufacturer, false); ?><br>
        <strong><?php echo app('translator')->get('repair::lang.device'); ?>: </strong> <?php echo e($sell->repair_device, false); ?><br>
        <strong><?php echo app('translator')->get('repair::lang.model'); ?>: </strong> <?php echo e($sell->repair_model, false); ?><br>
        <strong><?php echo app('translator')->get('repair::lang.serial_no'); ?>: </strong> <?php echo e($sell->repair_serial_no, false); ?><br>
        <?php if(in_array('service_staff' ,$enabled_modules)): ?>
          <strong><?php echo app('translator')->get('repair::lang.technician'); ?>: </strong> <?php echo e($sell->service_staff, false); ?><br>
        <?php endif; ?>

        <?php if(!empty($warranty_expires_in)): ?>
          <strong><?php echo app('translator')->get('repair::lang.warranty'); ?>: </strong> <?php echo e($sell->warranty_name, false); ?>

          <small class="help-block">( <?php echo app('translator')->get('repair::lang.expires_in'); ?> <?php echo e($warranty_expires_in, false); ?> )</small>
        <?php endif; ?>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-12 col-xs-12">
        <h4><?php echo e(__('sale.products'), false); ?>:</h4>
      </div>

      <div class="col-sm-12 col-xs-12">
        <div class="table-responsive">
          <?php echo $__env->make('sale_pos.partials.sale_line_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <strong><?php echo e(__('repair::lang.defect'), false); ?>:</strong><br>
        <p class="well well-sm no-shadow">
            <?php
                $defects = json_decode($sell->repair_defects, true);
            ?>
            <?php if(!empty($defects)): ?>
                <?php $__currentLoopData = $defects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_defect): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($product_defect['value'], false); ?>

                    <?php if(!$loop->last): ?>
                        <?php echo e(',', false); ?>

                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </p>
      </div>
      <div class="clearfix"></div>
      <div class="col-sm-6">
        <div class="box box-default box-primary collapsed-box">
            <div class="box-header with-border collapsed-box-title" style="cursor: pointer;">
                <h3 class="box-title"><?php echo e(__('repair::lang.pre_repair_checklist'), false); ?>:</h3>

                <div class="box-tools float-end">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: none;">
                <?php if(!empty($sell->repair_checklist)): ?>
                    <?php
                        $selected_checklist = json_decode($sell->repair_checklist, true);
                    ?>
                    <div class="row">
                        <?php $__currentLoopData = $checklists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $check): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-xs-4">
                                <?php if(isset($selected_checklist[$check])): ?>
                                  <?php if($selected_checklist[$check] == 'yes'): ?>
                                      <i class="fas fa-check-square text-success"></i>
                                  <?php elseif($selected_checklist[$check] == 'no'): ?>
                                    <i class="fas fa-window-close text-danger"></i>
                                  <?php elseif($selected_checklist[$check] == 'not_applicable'): ?>
                                    <i class="fas fa-square"></i>
                                  <?php endif; ?>
                                  <?php else: ?>
                                  <i class="fas fa-square"></i>
                                <?php endif; ?>
                                <?php echo e($check, false); ?>

                                <br>
                                <br>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
            <!-- /.box-body -->
        </div>
      </div>
      <div class="col-sm-6">
        <div class="box box-default box-primary collapsed-box">
            <div class="box-header with-border collapsed-box-title" style="cursor: pointer;">
                <h3 class="box-title"><?php echo e(__('sale.payment_info'), false); ?>:</h3>

                <div class="box-tools float-end">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: none;">
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
                        <?php $__currentLoopData = $sell->payment_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                            <td><span class="display_currency float-end" data-currency_symbol="true"><?php echo e($sell->total_before_tax, false); ?></span></td>
                        </tr>
                        <tr>
                            <th><?php echo e(__('sale.discount'), false); ?>:</th>
                            <td><b>(-)</b></td>
                            <td><span class="float-end"><?php echo e($sell->discount_amount, false); ?> <?php if( $sell->discount_type == 'percentage'): ?> <?php echo e('%', false); ?> <?php endif; ?></span></td>
                        </tr>
                        <?php if(session('business.enable_rp') == 1 && !empty($sell->rp_redeemed) ): ?>
                          <tr>
                            <th><?php echo e(session('business.rp_name'), false); ?>:</th>
                            <td><b>(-)</b></td>
                            <td> <span class="display_currency float-end" data-currency_symbol="true"><?php echo e($sell->rp_redeemed_amount, false); ?></span></td>
                          </tr>
                        <?php endif; ?>
                        <tr>
                            <th><?php echo e(__('sale.order_tax'), false); ?>:</th>
                            <td><b>(+)</b></td>
                            <td class="text-right">
                                <?php if(!empty($order_taxes)): ?>
                                  <?php $__currentLoopData = $order_taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <strong><small><?php echo e($k, false); ?></small></strong> - <span class="display_currency float-end" data-currency_symbol="true"><?php echo e($v, false); ?></span><br>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                0.00
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo e(__('sale.shipping'), false); ?>: <?php if($sell->shipping_details): ?>(<?php echo e($sell->shipping_details, false); ?>) <?php endif; ?></th>
                            <td><b>(+)</b></td>
                            <td><span class="display_currency float-end" data-currency_symbol="true"><?php echo e($sell->shipping_charges, false); ?></span></td>
                        </tr>
                        <tr>
                            <th><?php echo e(__('sale.total_payable'), false); ?>: </th>
                            <td></td>
                            <td><span class="display_currency float-end"><?php echo e($sell->final_total, false); ?></span></td>
                        </tr>
                        <tr>
                            <th><?php echo e(__('sale.total_paid'), false); ?>:</th>
                            <td></td>
                            <td><span class="display_currency float-end" data-currency_symbol="true" ><?php echo e($total_paid, false); ?></span></td>
                        </tr>
                        <tr>
                            <th><?php echo e(__('sale.total_remaining'), false); ?>:</th>
                            <td></td>
                            <td><span class="display_currency float-end" data-currency_symbol="true" ><?php echo e($sell->final_total - $total_paid, false); ?></span></td>
                        </tr>
                    </table>
                </div>

            </div>
            <!-- /.box-body -->
        </div>
      </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-default box-primary collapsed-box">
                <div class="box-header with-border collapsed-box-title" style="cursor: pointer;">
                    <h3 class="box-title"><?php echo e(__('repair::lang.activities'), false); ?>:</h3>

                    <div class="box-tools float-end">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <?php if ($__env->exists('repair::repair.partials.activities')) echo $__env->make('repair::repair.partials.activities', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-default box-primary collapsed-box">
                <div class="box-header with-border collapsed-box-title" style="cursor: pointer;">
                    <h3 class="box-title"><?php echo e(__('lang_v1.documents'), false); ?>:</h3>

                    <div class="box-tools float-end">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="display: none;">
                    <table class="table table-condensed bg-gray">
                        <tr>
                            <th><?php echo app('translator')->get('lang_v1.name'); ?></th>
                            <th><?php echo app('translator')->get('messages.view'); ?></th>
                            <th><?php echo app('translator')->get('messages.delete'); ?></th>
                        </tr>
                        <?php $__empty_18 = true; $__currentLoopData = $sell->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><?php echo e($media->display_name, false); ?></td>
                            <td><a href="<?php echo e($media->display_url, false); ?>" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-external-link"></i></a></td>
                            <td><a href="<?php echo e(action([\Modules\Repair\Http\Controllers\RepairController::class, 'deleteMedia'], $media->id), false); ?>"" class="btn btn-danger btn-xs delete_media"><i class="fa fa-trash"></i></a></td>
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
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default box-primary collapsed-box">
                <div class="box-header with-border collapsed-box-title" style="cursor: pointer;">
                    <h3 class="box-title"><?php echo e(__('repair::lang.pass_code_of_device'), false); ?>:</h3>

                    <div class="box-tools float-end">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <b><?php echo app('translator')->get('lang_v1.password'); ?>:</b>
                            <?php echo e($sell->repair_security_pwd, false); ?>

                        </div>
                    </div>
                    <div class="row mt-10">
                        <div class="col-md-6">
                            <b><?php echo app('translator')->get('repair::lang.security_pattern_code'); ?>:</b>
                            <div id="security_pattern_container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="modal-footer">
    <a href="#" class="print-invoice btn btn-primary" data-href="<?php echo e(route('repair.customerCopy', [$sell->id]), false); ?>">
        <i class="fa fa-print" aria-hidden="true"></i>
        <?php echo app('translator')->get("repair::lang.print_customer_copy"); ?>
    </a>
    <a href="#" class="print-invoice btn btn-primary" data-href="<?php echo e(route('sell.printInvoice', [$sell->id]), false); ?>"><i class="fa fa-print" aria-hidden="true"></i> <?php echo app('translator')->get("messages.print"); ?></a>
      <button type="button" class="btn btn-default no-print" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    var element = $('div.modal-xl');
    __currency_convert_recursively(element);

    <?php if(!empty($sell->repair_security_pattern)): ?>
        var security_pattern =  new PatternLock("#security_pattern_container", {
                                enableSetPattern: true
                            });
        security_pattern.setPattern("<?php echo e($sell->repair_security_pattern, false); ?>");
    <?php endif; ?>
  });
</script>
