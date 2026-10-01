<?php
  $display_status = $sell_transfer->status === 'final' ? 'completed' : $sell_transfer->status;
  $priority = $sell_transfer->sub_status ?: 'normal';
  $is_received = !empty($purchase_transfer) && in_array($purchase_transfer->status, ['received', 'final', 'completed']);
  $show_lot = $sell_transfer->sell_lines->contains(function($line) {
    return !empty(optional($line->lot_details)->lot_number);
  });
  $line_total_amount = $sell_transfer->sell_lines->sum(function ($line) {
    return ($line->quantity ?? 0) * ($line->unit_price ?? 0);
  });
  $total_products = $sell_transfer->sell_lines->count();
  $total_quantity = $sell_transfer->sell_lines->sum('quantity');
?>

<div class="row">
  <div class="col-12">
    <h2 class="page-header">
      <?php echo app('translator')->get('warehouse::lang.wh_transfer'); ?> (<b><?php echo app('translator')->get('purchase.ref_no'); ?>:</b> #<?php echo e($sell_transfer->ref_no, false); ?>)
      <small class="float-end"><b><?php echo app('translator')->get('messages.date'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($sell_transfer->transaction_date ?? $sell_transfer->created_at))->format(session('business.date_format')), false); ?></small>
    </h2>
  </div>
</div>

<div class="row invoice-info">
  <div class="col-sm-4 invoice-col">
    <?php echo app('translator')->get('lang_v1.location_from'); ?>:
    <address>
      <strong><?php echo e(optional($sell_transfer->location)->name ?? '-', false); ?></strong>
      <?php if(!empty(optional($sell_transfer->location)->landmark)): ?>
        <br><?php echo e(optional($sell_transfer->location)->landmark, false); ?>

      <?php endif; ?>
      <?php if(!empty(optional($sell_transfer->location)->city) || !empty(optional($sell_transfer->location)->state) || !empty(optional($sell_transfer->location)->country)): ?>
        <br><?php echo e(implode(', ', array_filter([optional($sell_transfer->location)->city, optional($sell_transfer->location)->state, optional($sell_transfer->location)->country])), false); ?>

      <?php endif; ?>
      <?php if(!empty(optional($sell_transfer->location)->mobile)): ?>
        <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e(optional($sell_transfer->location)->mobile, false); ?>

      <?php endif; ?>
      <?php if(!empty(optional($sell_transfer->location)->email)): ?>
        <br>Email: <?php echo e(optional($sell_transfer->location)->email, false); ?>

      <?php endif; ?>
    </address>
  </div>

  <div class="col-sm-4 invoice-col">
    <?php echo app('translator')->get('lang_v1.location_to'); ?>:
    <address>
      <strong><?php echo e(optional(optional($purchase_transfer)->location)->name ?? '-', false); ?></strong>
      <?php if(!empty(optional(optional($purchase_transfer)->location)->landmark)): ?>
        <br><?php echo e(optional(optional($purchase_transfer)->location)->landmark, false); ?>

      <?php endif; ?>
      <?php if(!empty(optional(optional($purchase_transfer)->location)->city) || !empty(optional(optional($purchase_transfer)->location)->state) || !empty(optional(optional($purchase_transfer)->location)->country)): ?>
        <br><?php echo e(implode(', ', array_filter([optional(optional($purchase_transfer)->location)->city, optional(optional($purchase_transfer)->location)->state, optional(optional($purchase_transfer)->location)->country])), false); ?>

      <?php endif; ?>
      <?php if(!empty(optional(optional($purchase_transfer)->location)->mobile)): ?>
        <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e(optional(optional($purchase_transfer)->location)->mobile, false); ?>

      <?php endif; ?>
      <?php if(!empty(optional(optional($purchase_transfer)->location)->email)): ?>
        <br>Email: <?php echo e(optional(optional($purchase_transfer)->location)->email, false); ?>

      <?php endif; ?>
    </address>
  </div>

  <div class="col-sm-4 invoice-col">
    <b><?php echo app('translator')->get('purchase.ref_no'); ?>:</b> #<?php echo e($sell_transfer->ref_no, false); ?><br/>
    <b><?php echo app('translator')->get('messages.date'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($sell_transfer->transaction_date ?? $sell_transfer->created_at))->format(session('business.date_format')), false); ?><br/>
    <b><?php echo app('translator')->get('warehouse::lang.transfer_status'); ?>:</b> <?php echo app('translator')->get('warehouse::lang.status_' . $display_status); ?><br/>
    <b><?php echo app('translator')->get('warehouse::lang.priority'); ?>:</b> <?php echo app('translator')->get('warehouse::lang.priority_' . $priority); ?><br/>
    <?php if(!empty($sell_transfer->shipping_details)): ?>
      <b><?php echo app('translator')->get('warehouse::lang.shipping_method'); ?>:</b> <?php echo e($sell_transfer->shipping_details, false); ?><br/>
    <?php endif; ?>
    <?php if(!empty($sell_transfer->delivery_date)): ?>
      <b><?php echo app('translator')->get('warehouse::lang.expected_date'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($sell_transfer->delivery_date))->format(session('business.date_format') . ' ' . 'h:i A'), false); ?><br/>
    <?php endif; ?>
    <b><?php echo app('translator')->get('sale.shipping_charges'); ?>:</b> <?php echo e(number_format($sell_transfer->shipping_charges ?? 0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?><br/>
    <b><?php echo app('translator')->get('sale.total'); ?>:</b> <?php echo e(number_format($sell_transfer->final_total ?? 0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

  </div>
</div>

<br>
<div class="row">
  <div class="col-12">
    <div class="table-responsive">
      <table class="table bg-gray">
        <tr class="bg-green">
          <th>#</th>
          <th><?php echo app('translator')->get('sale.product'); ?></th>
          <th><?php echo app('translator')->get('product.sku'); ?></th>
          <?php if($show_lot): ?>
          <th><?php echo app('translator')->get('warehouse::lang.lot_number'); ?></th>
          <?php endif; ?>
          <th><?php echo app('translator')->get('warehouse::lang.quantity_sent'); ?></th>
          <th>Cost Price</th>
          <th><?php echo app('translator')->get('sale.subtotal'); ?></th>
        </tr>
        <?php $__currentLoopData = $sell_transfer->sell_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($loop->iteration, false); ?></td>
            <td>
              <?php echo e(optional($line->product)->name, false); ?>

              <?php if($line->variations && $line->variations->name !== 'DUMMY'): ?>
                - <?php echo e($line->variations->name, false); ?>

              <?php endif; ?>
            </td>
            <td><?php echo e(optional($line->variations)->sub_sku ?? optional($line->product)->sku, false); ?></td>
            <?php if($show_lot): ?>
            <td><?php echo e(optional($line->lot_details)->lot_number ?? '-', false); ?></td>
            <?php endif; ?>
            <td><?php echo e(number_format($line->quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
            <td><?php echo e(number_format($line->unit_price ?? 0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
            <td><?php echo e(number_format(($line->quantity ?? 0) * ($line->unit_price ?? 0), session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </table>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12 text-end">
    <strong><?php echo app('translator')->get('sale.total'); ?>:</strong> <?php echo e(number_format($line_total_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

  </div>
</div>
<div class="row" style="margin-top: 4px;">
  <div class="col-12 text-end">
    <strong><?php echo app('translator')->get('warehouse::lang.total_products'); ?>:</strong> <?php echo e($total_products, false); ?>

    &nbsp; | &nbsp;
    <strong><?php echo app('translator')->get('warehouse::lang.total_quantity'); ?>:</strong> <?php echo e(number_format($total_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

  </div>
</div>

<?php if($sell_transfer->additional_notes): ?>
<div class="row">
  <div class="col-sm-6">
    <strong><?php echo app('translator')->get('purchase.additional_notes'); ?>:</strong><br>
    <p class="well well-sm no-shadow bg-gray">
      <?php echo e($sell_transfer->additional_notes, false); ?>

    </p>
  </div>
</div>
<?php endif; ?>


<div class="row print_section">
  <div class="col-12 text-center">
    <img class="center-block" src="data:image/png;base64,<?php echo e(DNS1D::getBarcodePNG($sell_transfer->ref_no, 'C128', 2, 30, array(39, 48, 54), true), false); ?>">
  </div>
</div>
