<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo e($agreement->agreement_no, false); ?> - <?php echo app('translator')->get('rental::lang.rental_agreement'); ?></title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #333; margin: 0; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 15px; }
        .header h1 { margin: 0; font-size: 24px; }
        .header h2 { margin: 5px 0; font-size: 16px; color: #666; }
        .info-section { display: flex; justify-content: space-between; margin-bottom: 20px; }
        .info-box { width: 48%; }
        .info-box h3 { background: #f5f5f5; padding: 8px 12px; margin: 0 0 10px; font-size: 14px; border-left: 4px solid #337ab7; }
        .info-table { width: 100%; }
        .info-table td { padding: 4px 8px; font-size: 13px; }
        .info-table td:first-child { font-weight: bold; width: 40%; }
        .items-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .items-table th { background: #337ab7; color: #fff; padding: 8px 10px; font-size: 13px; text-align: left; }
        .items-table td { padding: 8px 10px; border-bottom: 1px solid #ddd; font-size: 13px; }
        .items-table tfoot td { font-weight: bold; border-top: 2px solid #333; }
        .summary-box { width: 350px; float: right; margin-bottom: 20px; }
        .summary-table { width: 100%; }
        .summary-table td { padding: 6px 10px; }
        .summary-table td:last-child { text-align: right; }
        .summary-table .total-row { font-size: 16px; font-weight: bold; border-top: 2px solid #333; }
        .terms-section { clear: both; margin-top: 30px; padding-top: 15px; border-top: 1px solid #ddd; }
        .terms-section h3 { font-size: 14px; margin-bottom: 10px; }
        .signature-section { margin-top: 60px; display: flex; justify-content: space-between; }
        .signature-box { width: 40%; text-align: center; }
        .signature-line { border-top: 1px solid #333; margin-top: 60px; padding-top: 5px; }
        .no-print { margin-bottom: 20px; }
        @media print {
            .no-print { display: none; }
            body { padding: 10px; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align:center;">
        <button onclick="window.print()" style="padding:10px 30px; font-size:16px; cursor:pointer;">
            <i class="fas fa-print"></i> Print Agreement
        </button>
        <button onclick="window.close()" style="padding:10px 30px; font-size:16px; cursor:pointer; margin-left:10px;">Close</button>
    </div>

    <div class="header">
        <h1><?php echo e($business->name, false); ?></h1>
        <?php if($location): ?>
        <p><?php echo e($location->location_address, false); ?><br>
        <?php if($location->mobile): ?> Tel: <?php echo e($location->mobile, false); ?> <?php endif; ?></p>
        <?php endif; ?>
        <h2><?php echo app('translator')->get('rental::lang.rental_agreement'); ?></h2>
    </div>

    <div class="info-section">
        <div class="info-box">
            <h3><?php echo app('translator')->get('rental::lang.agreement_details'); ?></h3>
            <table class="info-table">
                <tr><td><?php echo app('translator')->get('rental::lang.agreement_no'); ?>:</td><td><?php echo e($agreement->agreement_no, false); ?></td></tr>
                <tr><td><?php echo app('translator')->get('rental::lang.status'); ?>:</td><td><?php echo e(__('rental::lang.status_' . $agreement->status), false); ?></td></tr>
                <tr><td><?php echo app('translator')->get('rental::lang.rental_start_date'); ?>:</td><td><?php echo e($agreement->rental_start_date ? $agreement->rental_start_date->format('M d, Y H:i') : '-', false); ?></td></tr>
                <tr><td><?php echo app('translator')->get('rental::lang.rental_end_date'); ?>:</td><td><?php echo e($agreement->rental_end_date ? $agreement->rental_end_date->format('M d, Y H:i') : '-', false); ?></td></tr>
                <tr><td><?php echo app('translator')->get('rental::lang.rental_period_type'); ?>:</td><td><?php echo e(__('rental::lang.' . $agreement->rental_period_type), false); ?></td></tr>
                <tr><td><?php echo app('translator')->get('rental::lang.duration'); ?>:</td><td><?php echo e($agreement->duration, false); ?></td></tr>
            </table>
        </div>
        <div class="info-box">
            <h3><?php echo app('translator')->get('rental::lang.customer_details'); ?></h3>
            <table class="info-table">
                <?php if($agreement->contact): ?>
                <tr><td><?php echo app('translator')->get('rental::lang.name'); ?>:</td><td><?php echo e($agreement->contact->name, false); ?></td></tr>
                <?php if($agreement->contact->mobile): ?><tr><td><?php echo app('translator')->get('business.phone'); ?>:</td><td><?php echo e($agreement->contact->mobile, false); ?></td></tr><?php endif; ?>
                <?php if($agreement->contact->email): ?><tr><td><?php echo app('translator')->get('business.email'); ?>:</td><td><?php echo e($agreement->contact->email, false); ?></td></tr><?php endif; ?>
                <?php if($agreement->contact->address_line_1): ?><tr><td><?php echo app('translator')->get('business.address'); ?>:</td><td><?php echo e($agreement->contact->address_line_1, false); ?></td></tr><?php endif; ?>
                <?php endif; ?>
                <?php if($agreement->id_verification_note): ?>
                <tr><td><?php echo app('translator')->get('rental::lang.id_verification'); ?>:</td><td><?php echo e($agreement->id_verification_note, false); ?></td></tr>
                <?php endif; ?>
            </table>
        </div>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th>#</th>
                <th><?php echo app('translator')->get('rental::lang.item'); ?></th>
                <th><?php echo app('translator')->get('rental::lang.quantity'); ?></th>
                <th><?php echo app('translator')->get('rental::lang.rate'); ?></th>
                <th><?php echo app('translator')->get('rental::lang.duration'); ?></th>
                <th><?php echo app('translator')->get('rental::lang.deposit'); ?></th>
                <th style="text-align:right;"><?php echo app('translator')->get('rental::lang.total'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $agreement->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($index + 1, false); ?></td>
                <td><?php echo e($line->item ? $line->item->name : '-', false); ?></td>
                <td><?php echo e($line->quantity, false); ?></td>
                <td><?php echo e(number_format($line->rate_amount, 2), false); ?> / <?php echo e(__('rental::lang.' . $line->rate_type), false); ?></td>
                <td><?php echo e($line->duration, false); ?></td>
                <td><?php echo e(number_format($line->deposit_amount, 2), false); ?></td>
                <td style="text-align:right;"><?php echo e(number_format($line->line_total, 2), false); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="summary-box">
        <table class="summary-table">
            <tr><td><?php echo app('translator')->get('rental::lang.subtotal'); ?>:</td><td><?php echo e(number_format($agreement->subtotal, 2), false); ?></td></tr>
            <?php if($agreement->discount_amount > 0): ?>
            <tr><td><?php echo app('translator')->get('sale.discount'); ?>:</td><td>(-) <?php echo e(number_format($agreement->discount_amount, 2), false); ?></td></tr>
            <?php endif; ?>
            <?php if($agreement->tax_amount > 0): ?>
            <tr><td><?php echo app('translator')->get('sale.tax'); ?>:</td><td>(+) <?php echo e(number_format($agreement->tax_amount, 2), false); ?></td></tr>
            <?php endif; ?>
            <tr class="total-row"><td><?php echo app('translator')->get('rental::lang.total_amount'); ?>:</td><td><?php echo e(number_format($agreement->total_amount, 2), false); ?></td></tr>
            <tr><td><?php echo app('translator')->get('rental::lang.total_deposit'); ?>:</td><td><?php echo e(number_format($agreement->deposit_amount, 2), false); ?></td></tr>
        </table>
    </div>

    <div style="clear:both;"></div>

    <?php if($agreement->rental_terms): ?>
    <div class="terms-section">
        <h3><?php echo app('translator')->get('rental::lang.terms_and_conditions'); ?></h3>
        <p><?php echo nl2br(e($agreement->rental_terms)); ?></p>
    </div>
    <?php endif; ?>

    <div class="signature-section">
        <div class="signature-box">
            <div class="signature-line"><?php echo app('translator')->get('rental::lang.customer_signature'); ?></div>
            <p><?php echo e($agreement->contact ? $agreement->contact->name : '', false); ?></p>
        </div>
        <div class="signature-box">
            <div class="signature-line"><?php echo app('translator')->get('rental::lang.authorized_signature'); ?></div>
            <p><?php echo e($business->name, false); ?></p>
        </div>
    </div>

    <div style="text-align:center; margin-top: 30px; font-size: 11px; color: #999;">
        <?php echo app('translator')->get('rental::lang.agreement_printed_on'); ?> <?php echo e(now()->format('M d, Y H:i'), false); ?>

    </div>
</body>
</html>
