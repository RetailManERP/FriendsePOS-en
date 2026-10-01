<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo app('translator')->get('tailorpro::lang.job_card'); ?> - <?php echo e($order->order_no, false); ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 13px; color: #333; padding: 20px; }
        .job-card { max-width: 800px; margin: 0 auto; border: 2px solid #333; padding: 0; }
        .header { background: #6f42c1; color: #fff; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { font-size: 20px; margin: 0; }
        .header .order-no { font-size: 24px; font-weight: bold; }
        .header .business-name { font-size: 14px; opacity: 0.9; }
        .section { padding: 12px 20px; border-bottom: 1px solid #ddd; }
        .section-title { font-size: 14px; font-weight: bold; color: #6f42c1; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 6px 20px; }
        .info-item { display: flex; }
        .info-item .label { font-weight: bold; min-width: 130px; color: #555; }
        .info-item .value { color: #333; }
        table { width: 100%; border-collapse: collapse; }
        table th, table td { border: 1px solid #ccc; padding: 6px 10px; text-align: left; font-size: 12px; }
        table th { background: #f5f0ff; font-weight: bold; color: #6f42c1; }
        .priority-badge { display: inline-block; padding: 2px 10px; border-radius: 3px; font-weight: bold; font-size: 12px; color: #fff; }
        .priority-normal { background: #6c757d; }
        .priority-urgent { background: #ffc107; color: #333; }
        .priority-express { background: #dc3545; }
        .status-badge { display: inline-block; padding: 3px 12px; border-radius: 4px; font-weight: bold; font-size: 13px; color: #fff; }
        .notes-box { background: #fffde7; border: 1px dashed #ffc107; padding: 10px; border-radius: 5px; min-height: 40px; white-space: pre-wrap; }
        .measurement-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 4px 15px; }
        .measurement-grid .m-item { display: flex; justify-content: space-between; border-bottom: 1px dotted #ccc; padding: 3px 0; }
        .measurement-grid .m-item .m-label { color: #555; }
        .measurement-grid .m-item .m-value { font-weight: bold; }
        .footer { padding: 15px 20px; display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; font-size: 11px; }
        .footer .sign-line { border-top: 1px solid #333; padding-top: 5px; text-align: center; margin-top: 40px; }
        .images-row { display: flex; gap: 10px; flex-wrap: wrap; }
        .images-row img { width: 120px; height: 120px; object-fit: cover; border: 1px solid #ccc; border-radius: 4px; }
        @media print {
            body { padding: 0; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align:center;margin-bottom:15px;">
        <button onclick="window.print()" style="padding:8px 25px;background:#6f42c1;color:#fff;border:none;border-radius:5px;font-size:14px;cursor:pointer;">
            <i class="fas fa-print"></i> Print Job Card
        </button>
    </div>

    <div class="job-card">
        
        <div class="header">
            <div>
                <div class="business-name"><?php echo e($business->name ?? '', false); ?></div>
                <h1><?php echo app('translator')->get('tailorpro::lang.job_card'); ?></h1>
            </div>
            <div style="text-align:right;">
                <div class="order-no"><?php echo e($order->order_no, false); ?></div>
                <span class="priority-badge priority-<?php echo e($order->priority, false); ?>"><?php echo e(strtoupper($order->priority), false); ?></span>
                <?php if($order->status): ?>
                    <br><span class="status-badge" style="background:<?php echo e($order->status->color ?? '#6c757d', false); ?>;margin-top:5px;"><?php echo e($order->status->name, false); ?></span>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="section">
            <div class="info-grid">
                <div class="info-item"><span class="label"><?php echo app('translator')->get('role.customer'); ?>:</span> <span class="value"><?php echo e($order->customer->name ?? '-', false); ?></span></div>
                <div class="info-item"><span class="label"><?php echo app('translator')->get('tailorpro::lang.order_date'); ?>:</span> <span class="value"><?php echo e($order->order_date ? \Carbon::createFromTimestamp(strtotime($order->order_date))->format(session('business.date_format')) : '-', false); ?></span></div>
                <div class="info-item"><span class="label"><?php echo app('translator')->get('tailorpro::lang.garment_type'); ?>:</span> <span class="value"><?php echo e($order->garment_type ?? '-', false); ?></span></div>
                <div class="info-item"><span class="label"><?php echo app('translator')->get('tailorpro::lang.delivery_date'); ?>:</span> <span class="value"><strong><?php echo e($order->delivery_date ? \Carbon::createFromTimestamp(strtotime($order->delivery_date))->format(session('business.date_format')) : '-', false); ?></strong></span></div>
                <div class="info-item"><span class="label"><?php echo app('translator')->get('tailorpro::lang.tailor'); ?>:</span> <span class="value"><?php echo e($order->tailor ? $order->tailor->first_name . ' ' . $order->tailor->last_name : '-', false); ?></span></div>
                <div class="info-item"><span class="label"><?php echo app('translator')->get('purchase.business_location'); ?>:</span> <span class="value"><?php echo e($order->location->name ?? '-', false); ?></span></div>
            </div>
        </div>

        
        <?php if($order->orderItems && $order->orderItems->count()): ?>
        <div class="section">
            <div class="section-title"><?php echo app('translator')->get('tailorpro::lang.order_items'); ?></div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo app('translator')->get('tailorpro::lang.garment_type'); ?></th>
                        <th><?php echo app('translator')->get('tailorpro::lang.tailor'); ?></th>
                        <th><?php echo app('translator')->get('tailorpro::lang.stitching_cost'); ?></th>
                        <th><?php echo app('translator')->get('tailorpro::lang.addon_cost'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration, false); ?></td>
                        <td><?php echo e($oi->garment_type ?? '-', false); ?></td>
                        <td><?php echo e($oi->tailor ? $oi->tailor->first_name . ' ' . $oi->tailor->last_name : '-', false); ?></td>
                        <td><?php echo e(number_format($oi->stitching_cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                        <td><?php echo e(number_format($oi->addon_cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>

        
        <?php if($order->measurement && $order->measurement->data): ?>
        <div class="section">
            <div class="section-title"><?php echo app('translator')->get('tailorpro::lang.measurement'); ?> — <?php echo e($order->measurement->type ?? '', false); ?></div>
            <div class="measurement-grid">
                <?php $__currentLoopData = $order->measurement->data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="m-item">
                    <span class="m-label"><?php echo e(ucfirst(str_replace('_', ' ', $key)), false); ?></span>
                    <span class="m-value"><?php echo e($val, false); ?></span>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>

        
        <?php if($order->orderMaterials && $order->orderMaterials->count()): ?>
        <div class="section">
            <div class="section-title"><?php echo app('translator')->get('tailorpro::lang.materials_plan'); ?></div>
            <table>
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('tailorpro::lang.material_label'); ?></th>
                        <th><?php echo app('translator')->get('product.product_name'); ?></th>
                        <th><?php echo app('translator')->get('tailorpro::lang.required_qty'); ?></th>
                        <th><?php echo app('translator')->get('tailorpro::lang.unit_cost'); ?></th>
                        <th><?php echo app('translator')->get('tailorpro::lang.line_total'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $order->orderMaterials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($material->material_label ?: '-', false); ?></td>
                        <td><?php echo e($material->product->name ?? '-', false); ?></td>
                        <td><?php echo e(number_format($material->quantity, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e(optional($material->product->unit)->short_name, false); ?></td>
                        <td><?php echo e(number_format($material->unit_cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                        <td><?php echo e(number_format($material->total_cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php elseif($order->fabricProduct || $order->fabric_qty): ?>
        <div class="section">
            <div class="section-title"><?php echo app('translator')->get('tailorpro::lang.fabric'); ?></div>
            <div class="info-grid">
                <div class="info-item"><span class="label"><?php echo app('translator')->get('product.product_name'); ?>:</span> <span class="value"><?php echo e($order->fabricProduct->name ?? '-', false); ?></span></div>
                <div class="info-item"><span class="label"><?php echo app('translator')->get('tailorpro::lang.fabric_qty'); ?>:</span> <span class="value"><?php echo e($order->fabric_qty ?? '-', false); ?></span></div>
            </div>
        </div>
        <?php endif; ?>

        
        <div class="section">
            <div class="section-title"><?php echo app('translator')->get('tailorpro::lang.cost_summary'); ?></div>
            <div class="info-grid">
                <div class="info-item"><span class="label"><?php echo app('translator')->get('tailorpro::lang.stitching_cost'); ?>:</span> <span class="value"><?php echo e(number_format($order->stitching_cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span></div>
                <div class="info-item"><span class="label"><?php echo app('translator')->get('tailorpro::lang.fabric_cost'); ?>:</span> <span class="value"><?php echo e(number_format($order->fabric_cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span></div>
                <div class="info-item"><span class="label"><?php echo app('translator')->get('tailorpro::lang.addon_cost'); ?>:</span> <span class="value"><?php echo e(number_format($order->addon_cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span></div>
                <div class="info-item"><span class="label"><strong><?php echo app('translator')->get('tailorpro::lang.total_cost'); ?>:</strong></span> <span class="value"><strong><?php echo e(number_format($order->total_cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></strong></span></div>
                <div class="info-item"><span class="label"><?php echo app('translator')->get('tailorpro::lang.total_paid'); ?>:</span> <span class="value"><?php echo e(number_format($order->total_paid, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span></div>
                <div class="info-item"><span class="label"><?php echo app('translator')->get('tailorpro::lang.balance_due'); ?>:</span> <span class="value"><strong><?php echo e(number_format($order->balance_due, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></strong></span></div>
            </div>
        </div>

        
        <?php if($order->design_notes): ?>
        <div class="section">
            <div class="section-title"><?php echo app('translator')->get('tailorpro::lang.design_notes'); ?></div>
            <div class="notes-box"><?php echo nl2br(e($order->design_notes)); ?></div>
        </div>
        <?php endif; ?>

        
        <?php if($order->media && $order->media->count()): ?>
        <div class="section">
            <div class="section-title"><?php echo app('translator')->get('tailorpro::lang.design_images'); ?></div>
            <div class="images-row">
                <?php $__currentLoopData = $order->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <img src="<?php echo e(asset('uploads/media/' . $m->file_name), false); ?>" alt="Design">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>

        
        <?php if($order->remarks): ?>
        <div class="section">
            <div class="section-title"><?php echo app('translator')->get('tailorpro::lang.remarks'); ?></div>
            <div class="notes-box"><?php echo nl2br(e($order->remarks)); ?></div>
        </div>
        <?php endif; ?>

        
        <div class="footer">
            <div><div class="sign-line"><?php echo app('translator')->get('tailorpro::lang.tailor'); ?> Signature</div></div>
            <div><div class="sign-line"><?php echo app('translator')->get('role.customer'); ?> Signature</div></div>
            <div><div class="sign-line">Authorized By</div></div>
        </div>
    </div>
</body>
</html>
