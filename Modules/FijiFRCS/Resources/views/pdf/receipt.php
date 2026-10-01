<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>FRCS Receipt <?php echo e($invoice->frcs_receipt_number ?: $invoice->invoice_number, false); ?></title>
    <style>
        body { font-family: 'DejaVu Sans', Arial, sans-serif; font-size: 11px; color: #000; }
        h1 { font-size: 14px; margin: 0 0 4px; text-align: center; }
        .small { font-size: 10px; }
        .center { text-align: center; }
        .right  { text-align: right; }
        table { width: 100%; border-collapse: collapse; margin-top: 6px; }
        th, td { padding: 2px 4px; }
        .totals th, .totals td { border-top: 1px dashed #000; }
        .qr { margin-top: 8px; word-break: break-all; }
        hr { border: 0; border-top: 1px dashed #000; }
    </style>
</head>
<body>
    <h1><?php echo e($invoice->seller_name, false); ?></h1>
    <div class="center small">
        TIN: <?php echo e($invoice->seller_tin, false); ?>

        <?php if($invoice->onboarding): ?> | EFD: <?php echo e($invoice->onboarding->efd_pos_id, false); ?> <?php endif; ?><br>
        <?php echo e($invoice->seller_address, false); ?>

    </div>
    <hr>
    <div class="small">
        <strong><?php echo e(config('fijifrcs.receipt_types')[$invoice->receipt_type] ?? 'Receipt', false); ?></strong><br>
        Receipt #: <?php echo e($invoice->invoice_number, false); ?><br>
        FRCS RN : <?php echo e($invoice->frcs_receipt_number ?: '—', false); ?><br>
        Date    : <?php echo e($invoice->invoice_date, false); ?> <?php echo e($invoice->invoice_time, false); ?><br>
        ICV     : <?php echo e($invoice->icv_value ?: '—', false); ?><br>
        <?php if($invoice->buyer_name): ?>
            Buyer   : <?php echo e($invoice->buyer_name, false); ?><br>
            <?php if($invoice->buyer_tin): ?> Buyer TIN: <?php echo e($invoice->buyer_tin, false); ?><br> <?php endif; ?>
        <?php endif; ?>
    </div>
    <hr>

    <table>
        <thead>
            <tr><th class="left">Item</th><th class="right">Qty</th><th class="right">Price</th><th class="right">Total</th></tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $invoice->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->item_name, false); ?> <span class="small">[<?php echo e($item->tax_category, false); ?>]</span></td>
                    <td class="right"><?php echo e($item->quantity, false); ?></td>
                    <td class="right"><?php echo e(number_format($item->unit_price, 2), false); ?></td>
                    <td class="right"><?php echo e(number_format($item->line_total, 2), false); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <table class="totals">
        <tr><th class="right" colspan="3">Total Excl. VAT</th><td class="right"><?php echo e(number_format($invoice->total_excluding_vat, 2), false); ?></td></tr>
        <tr><th class="right" colspan="3">VAT</th><td class="right"><?php echo e(number_format($invoice->total_vat, 2), false); ?></td></tr>
        <tr><th class="right" colspan="3">TOTAL</th><td class="right"><strong><?php echo e($invoice->currency_code, false); ?> <?php echo e(number_format($invoice->total_including_vat, 2), false); ?></strong></td></tr>
        <tr><th class="right" colspan="3">Payment</th><td class="right"><?php echo e($invoice->payment_method, false); ?></td></tr>
    </table>

    <?php if($invoice->qr_code): ?>
        <hr>
        <div class="center small">FRCS Verification</div>
        <div class="qr small"><?php echo e($invoice->qr_code, false); ?></div>
    <?php endif; ?>

    <hr>
    <div class="center small">
        Receipt issued via FRCS-approved EFD<br>
        Verify at https://www.frcs.org.fj
    </div>
</body>
</html>
