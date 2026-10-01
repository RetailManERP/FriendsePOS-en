
<?php $__env->startSection('title', __('tailorpro::lang.view_order')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('tailorpro::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header no-print">
    <h1>
        <i class="fas fa-eye" style="color:#6f42c1;"></i> <?php echo app('translator')->get('tailorpro::lang.order'); ?> #<?php echo e($order->order_no, false); ?>

        <?php if($order->status): ?>
            <span class="badge" style="background:<?php echo e($order->status->color ?? '#6c757d', false); ?>;color:#fff;font-size:0.85rem;vertical-align:middle;">
                <?php echo e($order->status->name, false); ?>

            </span>
        <?php endif; ?>
        <?php $priorityColors = ['normal' => '#6c757d', 'urgent' => '#ffc107', 'express' => '#dc3545']; ?>
        <?php if($order->priority && $order->priority != 'normal'): ?>
            <span class="badge" style="background:<?php echo e($priorityColors[$order->priority] ?? '#6c757d', false); ?>;color:#fff;font-size:0.8rem;vertical-align:middle;">
                <?php echo e(strtoupper($order->priority), false); ?>

            </span>
        <?php endif; ?>
        <?php if($order->is_overdue): ?>
            <span class="badge" style="background:#dc3545;color:#fff;font-size:0.8rem;vertical-align:middle;"><?php echo app('translator')->get('tailorpro::lang.overdue'); ?></span>
        <?php endif; ?>
    </h1>
    <div class="pull-right" style="margin-top:-35px;">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tailorpro_order.print')): ?>
        <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\OrderController::class, 'printJobCard'], [$order->id]), false); ?>" class="btn btn-info btn-sm" target="_blank">
            <i class="fas fa-print"></i> <?php echo app('translator')->get('tailorpro::lang.print_job_card'); ?>
        </a>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tailorpro_order.update')): ?>
        <a href="<?php echo e(action([\Modules\TailorPro\Http\Controllers\OrderController::class, 'edit'], [$order->id]), false); ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-edit"></i> <?php echo app('translator')->get('messages.edit'); ?>
        </a>
        <?php endif; ?>
    </div>
</section>

<section class="content no-print">
    <div class="row">
        <div class="col-md-8">
            
            <div class="box" style="border-radius:10px;">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo app('translator')->get('tailorpro::lang.order_details'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-condensed no-border">
                                <tr><th style="width:40%;"><?php echo app('translator')->get('tailorpro::lang.order_no'); ?></th><td><strong><?php echo e($order->order_no, false); ?></strong></td></tr>
                                <tr><th><?php echo app('translator')->get('role.customer'); ?></th><td><?php echo e($order->customer->name ?? '-', false); ?></td></tr>
                                <tr><th><?php echo app('translator')->get('tailorpro::lang.garment_type'); ?></th><td><?php echo e($order->garment_type ?? '-', false); ?></td></tr>
                                <tr><th><?php echo app('translator')->get('tailorpro::lang.tailor'); ?></th><td><?php echo e($order->tailor ? $order->tailor->first_name . ' ' . $order->tailor->last_name : '-', false); ?></td></tr>
                                <tr><th><?php echo app('translator')->get('purchase.business_location'); ?></th><td><?php echo e($order->location->name ?? '-', false); ?></td></tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-condensed no-border">
                                <tr><th style="width:40%;"><?php echo app('translator')->get('tailorpro::lang.order_date'); ?></th><td><?php echo e($order->order_date ? \Carbon::createFromTimestamp(strtotime($order->order_date))->format(session('business.date_format')) : '-', false); ?></td></tr>
                                <tr><th><?php echo app('translator')->get('tailorpro::lang.delivery_date'); ?></th><td><?php echo e($order->delivery_date ? \Carbon::createFromTimestamp(strtotime($order->delivery_date))->format(session('business.date_format')) : '-', false); ?></td></tr>
                                <?php if($order->is_delivered): ?>
                                <tr><th><?php echo app('translator')->get('tailorpro::lang.delivered_at'); ?></th><td><span class="text-success"><i class="fas fa-check-circle"></i> <?php echo e(\Carbon::createFromTimestamp(strtotime($order->delivered_at))->format(session('business.date_format')), false); ?></span></td></tr>
                                <?php endif; ?>
                                <tr><th><?php echo app('translator')->get('tailorpro::lang.priority'); ?></th><td><span class="badge" style="background:<?php echo e($priorityColors[$order->priority] ?? '#6c757d', false); ?>;color:#fff;"><?php echo e(ucfirst($order->priority), false); ?></span></td></tr>
                                <tr><th><?php echo app('translator')->get('lang_v1.created_at'); ?></th><td><?php echo e(\Carbon::createFromTimestamp(strtotime($order->created_at))->format(session('business.date_format')), false); ?></td></tr>
                            </table>
                        </div>
                    </div>

                    
                    <?php $cfData = $order->custom_fields_data ? (is_array($order->custom_fields_data) ? $order->custom_fields_data : json_decode($order->custom_fields_data, true)) : []; ?>
                    <?php if(!empty($cfData)): ?>
                    <hr>
                    <h4 style="margin-bottom:10px;"><?php echo app('translator')->get('tailorpro::lang.custom_fields'); ?></h4>
                    <div class="row">
                        <?php $__currentLoopData = $cfData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4">
                            <p><strong><?php echo e(ucwords(str_replace('_', ' ', $key)), false); ?>:</strong> <?php echo e($val, false); ?></p>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            
            <?php if($order->orderItems && $order->orderItems->count()): ?>
            <div class="box" style="border-radius:10px;">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fas fa-layer-group"></i> <?php echo app('translator')->get('tailorpro::lang.order_items'); ?> (<?php echo e($order->orderItems->count(), false); ?>)</h3>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo app('translator')->get('tailorpro::lang.garment_type'); ?></th>
                                <th><?php echo app('translator')->get('tailorpro::lang.tailor'); ?></th>
                                <th><?php echo app('translator')->get('tailorpro::lang.stitching_cost'); ?></th>
                                <th><?php echo app('translator')->get('tailorpro::lang.addon_cost'); ?></th>
                                <th><?php echo app('translator')->get('sale.status'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $order->orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration, false); ?></td>
                                <td><?php echo e($oi->garment_type ?? '-', false); ?></td>
                                <td><?php echo e($oi->tailor ? $oi->tailor->first_name . ' ' . $oi->tailor->last_name : '-', false); ?></td>
                                <td class="text-right"><?php echo e(number_format($oi->stitching_cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                                <td class="text-right"><?php echo e(number_format($oi->addon_cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                                <td>
                                    <?php if($oi->status): ?>
                                        <span class="badge" style="background:<?php echo e($oi->status->color ?? '#6c757d', false); ?>;color:#fff;"><?php echo e($oi->status->name, false); ?></span>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            
            <?php if($order->measurement): ?>
            <div class="box" style="border-radius:10px;">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fas fa-ruler-combined"></i> <?php echo app('translator')->get('tailorpro::lang.measurement'); ?></h3>
                </div>
                <div class="box-body">
                    <p><strong><?php echo app('translator')->get('tailorpro::lang.type'); ?>:</strong> <?php echo e($order->measurement->type ?? '-', false); ?> (v<?php echo e($order->measurement->version, false); ?>)</p>
                    <?php if($order->measurement->data): ?>
                        <table class="table table-bordered table-condensed">
                            <thead><tr><th><?php echo app('translator')->get('tailorpro::lang.measurement_field'); ?></th><th><?php echo app('translator')->get('tailorpro::lang.value'); ?></th></tr></thead>
                            <tbody>
                                <?php $__currentLoopData = $order->measurement->data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr><td><?php echo e(ucfirst(str_replace('_', ' ', $key)), false); ?></td><td><?php echo e($val, false); ?></td></tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            
            <?php if($order->activityLogs && $order->activityLogs->count()): ?>
            <div class="box" style="border-radius:10px;">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fas fa-stream"></i> <?php echo app('translator')->get('tailorpro::lang.activity_timeline'); ?></h3>
                </div>
                <div class="box-body">
                    <ul class="timeline" style="padding-left:10px;">
                        <?php $__currentLoopData = $order->activityLogs->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li style="list-style:none;padding:8px 0;border-left:2px solid #6f42c1;padding-left:15px;margin-left:10px;position:relative;">
                            <span style="position:absolute;left:-7px;top:12px;width:12px;height:12px;border-radius:50%;background:#6f42c1;"></span>
                            <strong><?php echo e(ucfirst(str_replace('_', ' ', $log->action)), false); ?></strong>
                            <span class="text-muted" style="font-size:0.85em;"> — <?php echo e($log->created_at->diffForHumans(), false); ?></span>
                            <br>
                            <span style="color:#555;"><?php echo e($log->description, false); ?></span>
                            <?php if($log->creator): ?>
                                <span class="text-muted" style="font-size:0.8em;"> by <?php echo e($log->creator->first_name, false); ?></span>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            <?php endif; ?>

            
            <?php if($order->trialLogs && $order->trialLogs->count()): ?>
            <div class="box" style="border-radius:10px;">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fas fa-history"></i> <?php echo app('translator')->get('tailorpro::lang.trial_alteration_history'); ?></h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('tailorpro::lang.type'); ?></th>
                                <th><?php echo app('translator')->get('tailorpro::lang.findings'); ?></th>
                                <th><?php echo app('translator')->get('tailorpro::lang.alterations'); ?></th>
                                <th><?php echo app('translator')->get('tailorpro::lang.date'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $order->trialLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><span class="badge badge-<?php echo e($log->type == 'trial' ? 'info' : 'warning', false); ?>"><?php echo e(ucfirst($log->type), false); ?></span></td>
                                    <td><?php echo e($log->findings ?? '-', false); ?></td>
                                    <td><?php echo e($log->alterations ?? '-', false); ?></td>
                                    <td><?php echo e($log->created_at->format('d M Y H:i'), false); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="col-md-4">
            <?php $hasConsumedStock = $order->stockConsumptions->where('transaction_type', 'consume')->count() > 0; ?>

            
            <div class="box" style="border-radius:10px;">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fas fa-receipt"></i> <?php echo app('translator')->get('tailorpro::lang.cost_summary'); ?></h3>
                </div>
                <div class="box-body">
                    <table class="table">
                        <tr><th><?php echo app('translator')->get('tailorpro::lang.stitching_cost'); ?></th><td class="text-right"><?php echo e(number_format($order->stitching_cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('tailorpro::lang.fabric_cost'); ?></th><td class="text-right"><?php echo e(number_format($order->fabric_cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('tailorpro::lang.addon_cost'); ?></th><td class="text-right"><?php echo e(number_format($order->addon_cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td></tr>
                        <tr style="font-weight:bold;border-top:2px solid #333;">
                            <th><?php echo app('translator')->get('tailorpro::lang.total_cost'); ?></th>
                            <td class="text-right"><?php echo e(number_format($order->total_cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                        </tr>
                    </table>
                    <hr>
                    <table class="table">
                        <tr class="text-success"><th><?php echo app('translator')->get('tailorpro::lang.total_paid'); ?></th><td class="text-right"><strong><?php echo e(number_format($order->total_paid, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></strong></td></tr>
                        <tr class="<?php echo e($order->balance_due > 0 ? 'text-danger' : 'text-success', false); ?>">
                            <th><?php echo app('translator')->get('tailorpro::lang.balance_due'); ?></th>
                            <td class="text-right"><strong><?php echo e(number_format($order->balance_due, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></strong></td>
                        </tr>
                    </table>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tailorpro_order.add_payment')): ?>
                    <button type="button" class="btn btn-success btn-block" id="add_payment_btn">
                        <i class="fas fa-money-bill-wave"></i> <?php echo app('translator')->get('tailorpro::lang.add_payment'); ?>
                    </button>
                    <?php endif; ?>
                </div>
            </div>

            
            <?php if($order->payments && $order->payments->count()): ?>
            <div class="box" style="border-radius:10px;">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fas fa-file-invoice-dollar"></i> <?php echo app('translator')->get('tailorpro::lang.payment_history'); ?></h3>
                </div>
                <div class="box-body">
                    <table class="table table-condensed">
                        <thead><tr><th><?php echo app('translator')->get('tailorpro::lang.date'); ?></th><th><?php echo app('translator')->get('tailorpro::lang.amount'); ?></th><th><?php echo app('translator')->get('tailorpro::lang.method'); ?></th></tr></thead>
                        <tbody>
                            <?php $__currentLoopData = $order->payments->sortByDesc('payment_date'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(\Carbon::createFromTimestamp(strtotime($pay->payment_date))->format(session('business.date_format')), false); ?></td>
                                <td class="text-right"><?php echo e(number_format($pay->amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                                <td><?php echo e(ucfirst($pay->payment_method), false); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            
            <?php if($order->media && $order->media->count()): ?>
            <div class="box" style="border-radius:10px;">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fas fa-images"></i> <?php echo app('translator')->get('tailorpro::lang.design_images'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <?php $__currentLoopData = $order->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-xs-6 col-md-6 text-center" style="margin-bottom:10px;">
                            <a href="<?php echo e(asset('uploads/media/' . $m->file_name), false); ?>" target="_blank">
                                <img src="<?php echo e(asset('uploads/media/' . $m->file_name), false); ?>" style="width:100%;max-height:150px;object-fit:cover;border-radius:8px;border:1px solid #ddd;">
                            </a>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            
            <?php if($order->orderMaterials && $order->orderMaterials->count()): ?>
            <div class="box" style="border-radius:10px;">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fas fa-boxes"></i> <?php echo app('translator')->get('tailorpro::lang.materials_plan'); ?></h3>
                    <?php if(!$hasConsumedStock): ?>
                    <div class="box-tools">
                        <button type="button" class="btn btn-xs btn-success" id="consume_stock_btn" data-order-id="<?php echo e($order->id, false); ?>">
                            <i class="fas fa-warehouse"></i> <?php echo app('translator')->get('tailorpro::lang.consume_materials_stock'); ?>
                        </button>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered">
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
                </div>
            </div>
            <?php elseif($order->fabricProduct): ?>
            <div class="box" style="border-radius:10px;">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fas fa-tshirt"></i> <?php echo app('translator')->get('tailorpro::lang.fabric'); ?></h3>
                    <?php if(!$hasConsumedStock): ?>
                    <div class="box-tools">
                        <button type="button" class="btn btn-xs btn-success" id="consume_stock_btn" data-order-id="<?php echo e($order->id, false); ?>">
                            <i class="fas fa-warehouse"></i> <?php echo app('translator')->get('tailorpro::lang.consume_materials_stock'); ?>
                        </button>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="box-body">
                    <p><strong><?php echo app('translator')->get('product.product_name'); ?>:</strong> <?php echo e($order->fabricProduct->name, false); ?></p>
                    <p><strong><?php echo app('translator')->get('tailorpro::lang.fabric_qty'); ?>:</strong> <?php echo e($order->fabric_qty, false); ?></p>
                </div>
            </div>
            <?php endif; ?>

            
            <?php if($order->stockConsumptions && $order->stockConsumptions->count()): ?>
            <div class="box" style="border-radius:10px;">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fas fa-warehouse"></i> <?php echo app('translator')->get('tailorpro::lang.stock_consumption'); ?></h3>
                </div>
                <div class="box-body">
                    <table class="table table-condensed">
                        <?php $__currentLoopData = $order->stockConsumptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <?php echo e($sc->notes ?: ($sc->product->name ?? '-'), false); ?>

                                    <?php if($sc->product): ?>
                                        <br><small class="text-muted"><?php echo e($sc->product->name, false); ?></small>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e(number_format($sc->quantity, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e(optional($sc->product->unit)->short_name, false); ?></td>
                                <td><span class="badge badge-info"><?php echo e($sc->transaction_type, false); ?></span></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            
            <?php if($order->design_notes || $order->remarks): ?>
            <div class="box" style="border-radius:10px;">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fas fa-pencil-alt"></i> <?php echo app('translator')->get('tailorpro::lang.notes'); ?></h3>
                </div>
                <div class="box-body">
                    <?php if($order->design_notes): ?>
                        <p><strong><?php echo app('translator')->get('tailorpro::lang.design_notes'); ?>:</strong></p>
                        <p><?php echo nl2br(e($order->design_notes)); ?></p>
                    <?php endif; ?>
                    <?php if($order->remarks): ?>
                        <p><strong><?php echo app('translator')->get('tailorpro::lang.remarks'); ?>:</strong></p>
                        <p><?php echo nl2br(e($order->remarks)); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>


<div class="modal fade" id="add_payment_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('tailorpro::lang.add_payment'); ?></h4>
                <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span></button>
            </div>
            <?php echo Form::open(['url' => action([\Modules\TailorPro\Http\Controllers\OrderController::class, 'addPayment'], [$order->id]), 'method' => 'post', 'id' => 'tailorpro_payment_form']); ?>

            <div class="modal-body">
                <div class="form-group">
                    <?php echo Form::label('payment_amount', __('tailorpro::lang.amount') . ':*'); ?>

                    <?php echo Form::number('amount', null, ['class' => 'form-control', 'required', 'step' => '0.01', 'min' => '0.01', 'max' => $order->balance_due, 'id' => 'payment_amount']); ?>

                    <p class="help-block"><?php echo app('translator')->get('tailorpro::lang.balance_due'); ?>: <strong><?php echo e(number_format($order->balance_due, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></strong></p>
                </div>
                <div class="form-group">
                    <?php echo Form::label('payment_method', __('tailorpro::lang.payment_method') . ':*'); ?>

                    <?php echo Form::select('payment_method', ['cash' => __('lang_v1.cash'), 'card' => __('lang_v1.card'), 'bank_transfer' => __('lang_v1.bank_transfer'), 'cheque' => __('lang_v1.cheque'), 'other' => __('lang_v1.other')], null, ['class' => 'form-control', 'required']); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('payment_date', __('tailorpro::lang.payment_date') . ':'); ?>

                    <?php echo Form::text('payment_date', \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format')), ['class' => 'form-control', 'id' => 'payment_date_input', 'readonly']); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('payment_ref', __('tailorpro::lang.payment_reference') . ':'); ?>

                    <?php echo Form::text('payment_ref', null, ['class' => 'form-control']); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('payment_notes', __('tailorpro::lang.notes') . ':'); ?>

                    <?php echo Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 2]); ?>

                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> <?php echo app('translator')->get('tailorpro::lang.record_payment'); ?></button>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
$(document).ready(function () {
    var $paymentModal = $('#add_payment_modal');
    $paymentModal.appendTo('body');

    $('#add_payment_btn').on('click', function () {
        $paymentModal.modal('show');
    });

    $('#payment_date_input').datetimepicker({
        format: moment_date_format,
        ignoreReadonly: true,
    });

    // AJAX payment submit
    $('#tailorpro_payment_form').on('submit', function (e) {
        e.preventDefault();
        var $btn = $(this).find('[type="submit"]');
        $btn.prop('disabled', true);
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (r) {
                if (r.success) {
                    $paymentModal.modal('hide');
                    toastr.success(r.msg);
                    setTimeout(function () { location.reload(); }, 1000);
                } else {
                    toastr.error(r.msg || 'Error');
                }
            },
            error: function () { toastr.error('Error processing payment'); },
            complete: function () { $btn.prop('disabled', false); }
        });
    });

    $('#consume_stock_btn').on('click', function () {
        var $btn = $(this);
        $btn.prop('disabled', true);

        $.ajax({
            url: '<?php echo e(action([\Modules\TailorPro\Http\Controllers\OrderController::class, "consumeStock"]), false); ?>',
            method: 'POST',
            data: {
                order_id: $btn.data('order-id'),
                _token: '<?php echo e(csrf_token(), false); ?>'
            },
            dataType: 'json',
            success: function (r) {
                if (r.success) {
                    toastr.success(r.msg);
                    setTimeout(function () { location.reload(); }, 1000);
                } else {
                    toastr.error(r.msg || 'Error');
                }
            },
            error: function () {
                toastr.error('Error consuming stock');
            },
            complete: function () {
                $btn.prop('disabled', false);
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>