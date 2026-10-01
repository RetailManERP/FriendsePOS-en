
<?php $__env->startSection('title', __('importmanagement::lang.view_import')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header no-print">
    <h1>
        <?php echo app('translator')->get('importmanagement::lang.view_import'); ?> - <?php echo e($import->import_ref_no, false); ?>

        <span class="label <?php echo e($import->getStatusClasses()[$import->status] ?? 'label-default', false); ?>" style="font-size: 14px;">
            <?php echo e(__('importmanagement::lang.' . $import->status), false); ?>

        </span>
    </h1>
    <div class="pull-right no-print" style="margin-top: -25px;">
        <a href="<?php echo e(action([\Modules\ImportManagement\Http\Controllers\ImportController::class, 'index']), false); ?>" class="btn btn-default">
            <i class="fa fa-arrow-left"></i> <?php echo app('translator')->get('importmanagement::lang.all_imports'); ?>
        </a>
        <?php if($import->status != 'received' && $import->status != 'cancelled'): ?>
            <a href="<?php echo e(action([\Modules\ImportManagement\Http\Controllers\ImportController::class, 'edit'], [$import->id]), false); ?>" class="btn btn-primary">
                <i class="fa fa-edit"></i> <?php echo app('translator')->get('messages.edit'); ?>
            </a>
        <?php endif; ?>
        <button class="btn btn-success no-print" onclick="window.print()">
            <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?>
        </button>
    </div>
</section>

<section class="content">

    
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-money-bill-wave"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('importmanagement::lang.total_items_cost_base'); ?></span>
                    <span class="info-box-number">
                        <span class="display_currency" data-currency_symbol="true"><?php echo e($import->total_items_cost_base, false); ?></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-truck"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('importmanagement::lang.total_charges'); ?></span>
                    <span class="info-box-number">
                        <span class="display_currency" data-currency_symbol="true"><?php echo e($import->total_charges, false); ?></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-calculator"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('importmanagement::lang.total_landed_cost'); ?></span>
                    <span class="info-box-number">
                        <span class="display_currency" data-currency_symbol="true"><?php echo e($import->total_landed_cost, false); ?></span>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-file-invoice-dollar"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?php echo app('translator')->get('importmanagement::lang.grand_total'); ?></span>
                    <span class="info-box-number">
                        <span class="display_currency" data-currency_symbol="true"><?php echo e($import->final_total, false); ?></span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('importmanagement::lang.import_info')]); ?>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-condensed no-border">
                    <tr>
                        <th style="width: 40%;"><?php echo app('translator')->get('importmanagement::lang.import_ref_no'); ?>:</th>
                        <td><?php echo e($import->import_ref_no, false); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo app('translator')->get('importmanagement::lang.import_date'); ?>:</th>
                        <td>\Carbon::createFromTimestamp(strtotime($import->import_date))->format(session('business.date_format'))</td>
                    </tr>
                    <tr>
                        <th><?php echo app('translator')->get('importmanagement::lang.supplier_importer'); ?>:</th>
                        <td><?php echo e($import->contact->name ?? '', false); ?> <?php echo e($import->contact->supplier_business_name ? '(' . $import->contact->supplier_business_name . ')' : '', false); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo app('translator')->get('importmanagement::lang.business_location'); ?>:</th>
                        <td><?php echo e($import->location->name ?? '', false); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo app('translator')->get('importmanagement::lang.import_currency'); ?>:</th>
                        <td><?php echo e($import->locationCurrency ? $import->locationCurrency->currency . ' (' . $import->locationCurrency->code . ')' : __('importmanagement::lang.default_currency'), false); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo app('translator')->get('importmanagement::lang.exchange_rate'); ?>:</th>
                        <td><?php echo e($import->exchange_rate, false); ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-condensed no-border">
                    <tr>
                        <th style="width: 40%;"><?php echo app('translator')->get('importmanagement::lang.incoterm'); ?>:</th>
                        <td><?php echo e($import->incoterm ?: '-', false); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo app('translator')->get('importmanagement::lang.payment_terms'); ?>:</th>
                        <td>
                            <?php if($import->pay_term_number): ?>
                                <?php echo e($import->pay_term_number, false); ?> <?php echo e(__('importmanagement::lang.' . $import->pay_term_type), false); ?>

                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo app('translator')->get('importmanagement::lang.overhead_allocation_method'); ?>:</th>
                        <td><?php echo e(__('importmanagement::lang.' . $import->overhead_allocation_method), false); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo app('translator')->get('importmanagement::lang.created_by'); ?>:</th>
                        <td><?php echo e($import->createdByUser->user_full_name ?? '', false); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo app('translator')->get('importmanagement::lang.created_at'); ?>:</th>
                        <td>\Carbon::createFromTimestamp(strtotime($import->created_at))->format(session('business.date_format') . ' ' . 'h:i A')</td>
                    </tr>
                    <?php if($import->transaction_id): ?>
                    <tr>
                        <th><?php echo app('translator')->get('importmanagement::lang.linked_purchase'); ?>:</th>
                        <td><a href="<?php echo e(action([\App\Http\Controllers\PurchaseController::class, 'show'], [$import->transaction_id]), false); ?>" target="_blank"><?php echo e($import->transaction->ref_no ?? '', false); ?></a></td>
                    </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    
    <?php $__env->startComponent('components.widget', ['class' => 'box-warning', 'title' => __('importmanagement::lang.shipping_logistics')]); ?>
        <div class="row">
            <div class="col-md-4">
                <table class="table table-condensed no-border">
                    <tr><th style="width: 50%;"><?php echo app('translator')->get('importmanagement::lang.shipping_method'); ?>:</th><td><?php echo e($import->shipping_method ? __('importmanagement::lang.' . $import->shipping_method) : '-', false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('importmanagement::lang.source_country'); ?>:</th><td><?php echo e($import->source_country ?: '-', false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('importmanagement::lang.destination_country'); ?>:</th><td><?php echo e($import->destination_country ?: '-', false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('importmanagement::lang.port_of_loading'); ?>:</th><td><?php echo e($import->port_of_loading ?: '-', false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('importmanagement::lang.port_of_discharge'); ?>:</th><td><?php echo e($import->port_of_discharge ?: '-', false); ?></td></tr>
                </table>
            </div>
            <div class="col-md-4">
                <table class="table table-condensed no-border">
                    <tr><th style="width: 50%;"><?php echo app('translator')->get('importmanagement::lang.bill_of_lading_no'); ?>:</th><td><?php echo e($import->bill_of_lading_no ?: '-', false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('importmanagement::lang.airway_bill_no'); ?>:</th><td><?php echo e($import->airway_bill_no ?: '-', false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('importmanagement::lang.container_no'); ?>:</th><td><?php echo e($import->container_no ?: '-', false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('importmanagement::lang.vessel_name'); ?>:</th><td><?php echo e($import->vessel_name ?: '-', false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('importmanagement::lang.voyage_no'); ?>:</th><td><?php echo e($import->voyage_no ?: '-', false); ?></td></tr>
                </table>
            </div>
            <div class="col-md-4">
                <table class="table table-condensed no-border">
                    <tr><th style="width: 50%;"><?php echo app('translator')->get('importmanagement::lang.tracking_no'); ?>:</th><td><?php echo e($import->tracking_no ?: '-', false); ?></td></tr>
                    <tr>
                        <th><?php echo app('translator')->get('importmanagement::lang.estimated_departure'); ?>:</th>
                        <td><?php echo e($import->estimated_departure_date ? \Carbon::createFromTimestamp(strtotime($import->estimated_departure_date))->format(session('business.date_format')) : '-', false); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo app('translator')->get('importmanagement::lang.estimated_arrival'); ?>:</th>
                        <td><?php echo e($import->estimated_arrival_date ? \Carbon::createFromTimestamp(strtotime($import->estimated_arrival_date))->format(session('business.date_format')) : '-', false); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo app('translator')->get('importmanagement::lang.actual_arrival'); ?>:</th>
                        <td><?php echo e($import->actual_arrival_date ? \Carbon::createFromTimestamp(strtotime($import->actual_arrival_date))->format(session('business.date_format')) : '-', false); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    
    <?php $__env->startComponent('components.widget', ['class' => 'box-success', 'title' => __('importmanagement::lang.import_items')]); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="bg-light-blue-active">
                        <th>#</th>
                        <th><?php echo app('translator')->get('importmanagement::lang.product'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.quantity'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.qty_received'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.unit_price'); ?>
                            <?php if($import->locationCurrency): ?>
                                <small>(<?php echo e($import->locationCurrency->code, false); ?>)</small>
                            <?php endif; ?>
                        </th>
                        <th><?php echo app('translator')->get('importmanagement::lang.sub_total'); ?>
                            <?php if($import->locationCurrency): ?>
                                <small>(<?php echo e($import->locationCurrency->code, false); ?>)</small>
                            <?php endif; ?>
                        </th>
                        <th><?php echo app('translator')->get('importmanagement::lang.unit_price_base'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.sub_total_base'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.item_tax'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.allocated_charges'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.landed_cost_per_unit'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.total_landed_cost'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.weight_per_unit'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.lot_number'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $import->importLines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($idx + 1, false); ?></td>
                        <td>
                            <?php echo e($line->product->name ?? '', false); ?>

                            <?php if($line->variation && $line->variation->name != 'DUMMY'): ?>
                                - <?php echo e($line->variation->name, false); ?>

                            <?php endif; ?>
                            <?php if($line->product): ?>
                                <br><small class="text-muted">SKU: <?php echo e($line->product->sku ?? '', false); ?></small>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e(number_format($line->quantity, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                        <td>
                            <?php echo e(number_format($line->quantity_received, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                            <?php if($line->quantity_received < $line->quantity): ?>
                                <span class="label label-warning">Pending</span>
                            <?php else: ?>
                                <span class="label label-success">Full</span>
                            <?php endif; ?>
                        </td>
                        <td><span class="display_currency" data-currency_symbol="false"><?php echo e($line->unit_price, false); ?></span></td>
                        <td><span class="display_currency" data-currency_symbol="false"><?php echo e($line->sub_total, false); ?></span></td>
                        <td><span class="display_currency" data-currency_symbol="true"><?php echo e($line->unit_price_base, false); ?></span></td>
                        <td><span class="display_currency" data-currency_symbol="true"><?php echo e($line->sub_total_base, false); ?></span></td>
                        <td><span class="display_currency" data-currency_symbol="true"><?php echo e($line->item_tax, false); ?></span></td>
                        <td><span class="display_currency" data-currency_symbol="true"><?php echo e($line->allocated_charges, false); ?></span></td>
                        <td><span class="display_currency" data-currency_symbol="true"><?php echo e($line->landed_cost_per_unit, false); ?></span></td>
                        <td><span class="display_currency" data-currency_symbol="true"><?php echo e($line->total_landed_cost, false); ?></span></td>
                        <td><?php echo e($line->weight_per_unit ?: '-', false); ?></td>
                        <td><?php echo e($line->lot_number ?: '-', false); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr class="bg-gray">
                        <td colspan="2"><strong><?php echo app('translator')->get('importmanagement::lang.totals'); ?>:</strong></td>
                        <td><strong><?php echo e(number_format($import->importLines->sum('quantity'), session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></strong></td>
                        <td><strong><?php echo e(number_format($import->importLines->sum('quantity_received'), session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></strong></td>
                        <td></td>
                        <td><strong><span class="display_currency" data-currency_symbol="false"><?php echo e($import->total_items_cost, false); ?></span></strong></td>
                        <td></td>
                        <td><strong><span class="display_currency" data-currency_symbol="true"><?php echo e($import->total_items_cost_base, false); ?></span></strong></td>
                        <td><strong><span class="display_currency" data-currency_symbol="true"><?php echo e($import->importLines->sum('item_tax'), false); ?></span></strong></td>
                        <td><strong><span class="display_currency" data-currency_symbol="true"><?php echo e($import->importLines->sum('allocated_charges'), false); ?></span></strong></td>
                        <td></td>
                        <td><strong><span class="display_currency" data-currency_symbol="true"><?php echo e($import->importLines->sum('total_landed_cost'), false); ?></span></strong></td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>

    
    <?php $__env->startComponent('components.widget', ['class' => 'box-danger', 'title' => __('importmanagement::lang.overhead_charges')]); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="bg-yellow">
                        <th>#</th>
                        <th><?php echo app('translator')->get('importmanagement::lang.charge_category'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.charge_name'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.charge_currency'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.exchange_rate'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.charge_amount'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.charge_amount_base'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.charge_tax'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.reference_no'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.include_in_landed_cost'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $import->charges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cidx => $charge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($cidx + 1, false); ?></td>
                        <td><?php echo e(__('importmanagement::lang.' . $charge->charge_category), false); ?></td>
                        <td><?php echo e($charge->charge_name, false); ?></td>
                        <td><?php echo e($charge->chargeCurrency ? $charge->chargeCurrency->code : __('importmanagement::lang.default_currency'), false); ?></td>
                        <td><?php echo e($charge->charge_exchange_rate, false); ?></td>
                        <td><span class="display_currency" data-currency_symbol="false"><?php echo e($charge->amount, false); ?></span></td>
                        <td><span class="display_currency" data-currency_symbol="true"><?php echo e($charge->amount_base, false); ?></span></td>
                        <td><span class="display_currency" data-currency_symbol="true"><?php echo e($charge->tax_amount, false); ?></span></td>
                        <td><?php echo e($charge->reference_no ?: '-', false); ?></td>
                        <td class="text-center">
                            <?php if($charge->include_in_landed_cost): ?>
                                <i class="fa fa-check-circle text-success"></i>
                            <?php else: ?>
                                <i class="fa fa-times-circle text-danger"></i>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr class="bg-gray">
                        <td colspan="6" class="text-right"><strong><?php echo app('translator')->get('importmanagement::lang.total_charges'); ?>:</strong></td>
                        <td><strong><span class="display_currency" data-currency_symbol="true"><?php echo e($import->total_charges, false); ?></span></strong></td>
                        <td><strong><span class="display_currency" data-currency_symbol="true"><?php echo e($import->charges->sum('tax_amount'), false); ?></span></strong></td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>

    
    <?php $__env->startComponent('components.widget', ['class' => 'box-info', 'title' => __('importmanagement::lang.financial_summary')]); ?>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <table class="table table-condensed">
                    <tr>
                        <td class="text-right" style="width: 60%;"><strong><?php echo app('translator')->get('importmanagement::lang.total_items_cost_base'); ?>:</strong></td>
                        <td><span class="display_currency" data-currency_symbol="true"><?php echo e($import->total_items_cost_base, false); ?></span></td>
                    </tr>
                    <tr>
                        <td class="text-right"><strong><?php echo app('translator')->get('importmanagement::lang.total_charges'); ?>:</strong></td>
                        <td><span class="display_currency" data-currency_symbol="true"><?php echo e($import->total_charges, false); ?></span></td>
                    </tr>
                    <tr class="active">
                        <td class="text-right"><strong><?php echo app('translator')->get('importmanagement::lang.total_landed_cost'); ?>:</strong></td>
                        <td><strong><span class="display_currency" data-currency_symbol="true"><?php echo e($import->total_landed_cost, false); ?></span></strong></td>
                    </tr>
                    <tr>
                        <td class="text-right"><strong><?php echo app('translator')->get('importmanagement::lang.import_tax'); ?>:</strong></td>
                        <td><span class="display_currency" data-currency_symbol="true"><?php echo e($import->tax_amount, false); ?></span></td>
                    </tr>
                    <?php if($import->discount_amount > 0): ?>
                    <tr>
                        <td class="text-right"><strong><?php echo app('translator')->get('importmanagement::lang.discount'); ?> (<?php echo e($import->discount_type == 'percentage' ? $import->discount_amount . '%' : '', false); ?>):</strong></td>
                        <td>(-) <span class="display_currency" data-currency_symbol="true"><?php echo e($import->discount_amount, false); ?></span></td>
                    </tr>
                    <?php endif; ?>
                    <tr class="success" style="font-size: 16px;">
                        <td class="text-right"><strong><?php echo app('translator')->get('importmanagement::lang.grand_total'); ?>:</strong></td>
                        <td><strong><span class="display_currency" data-currency_symbol="true"><?php echo e($import->final_total, false); ?></span></strong></td>
                    </tr>
                </table>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    
    <?php if($import->additional_notes || $import->staff_note): ?>
    <?php $__env->startComponent('components.widget', ['class' => 'box-default', 'title' => __('importmanagement::lang.notes')]); ?>
        <div class="row">
            <?php if($import->additional_notes): ?>
            <div class="col-md-6">
                <strong><?php echo app('translator')->get('importmanagement::lang.additional_notes'); ?>:</strong>
                <p><?php echo nl2br(e($import->additional_notes)); ?></p>
            </div>
            <?php endif; ?>
            <?php if($import->staff_note): ?>
            <div class="col-md-6">
                <strong><?php echo app('translator')->get('importmanagement::lang.staff_note'); ?>:</strong>
                <p><?php echo nl2br(e($import->staff_note)); ?></p>
            </div>
            <?php endif; ?>
        </div>
    <?php echo $__env->renderComponent(); ?>
    <?php endif; ?>

    
    <?php if($import->documents->count() > 0 || $import->document): ?>
    <?php $__env->startComponent('components.widget', ['class' => 'box-default', 'title' => __('importmanagement::lang.documents')]); ?>
        <?php if($import->document): ?>
        <p>
            <a href="<?php echo e(url($import->document_path), false); ?>" target="_blank" class="btn btn-sm btn-default">
                <i class="fa fa-paperclip"></i> <?php echo e($import->document, false); ?>

            </a>
        </p>
        <?php endif; ?>
        <?php if($import->documents->count() > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('importmanagement::lang.document_type'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.document_name'); ?></th>
                        <th><?php echo app('translator')->get('importmanagement::lang.action'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $import->documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(__('importmanagement::lang.' . $doc->document_type), false); ?></td>
                        <td><?php echo e($doc->document_name, false); ?></td>
                        <td>
                            <a href="<?php echo e(url($doc->document_path), false); ?>" target="_blank" class="btn btn-xs btn-default">
                                <i class="fa fa-download"></i> <?php echo app('translator')->get('messages.download'); ?>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>
    <?php endif; ?>

    
    <?php $__env->startComponent('components.widget', ['class' => 'box-default', 'title' => __('importmanagement::lang.status_timeline')]); ?>
        <?php
            $timeline_statuses = ['draft', 'ordered', 'in_transit', 'at_port', 'customs_clearance', 'received'];
            $current_found = false;
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="timeline-steps" style="display: flex; justify-content: space-between; padding: 20px 0;">
                    <?php $__currentLoopData = $timeline_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $is_current = ($ts === $import->status);
                            $is_done = !$current_found && !$is_current;
                            if ($is_current) $current_found = true;
                            $color = $is_done ? '#28a745' : ($is_current ? '#007bff' : '#ccc');
                        ?>
                        <div class="text-center" style="flex: 1;">
                            <div style="width: 30px; height: 30px; border-radius: 50%; background: <?php echo e($color, false); ?>; margin: 0 auto; line-height: 30px; color: #fff;">
                                <?php if($is_done): ?>
                                    <i class="fa fa-check"></i>
                                <?php elseif($is_current): ?>
                                    <i class="fa fa-circle"></i>
                                <?php endif; ?>
                            </div>
                            <small style="color: <?php echo e($color, false); ?>; font-weight: <?php echo e($is_current ? 'bold' : 'normal', false); ?>;"><?php echo e(__('importmanagement::lang.' . $ts), false); ?></small>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <?php if($import->status == 'cancelled'): ?>
            <div class="alert alert-danger text-center">
                <i class="fa fa-ban"></i> <?php echo app('translator')->get('importmanagement::lang.import_cancelled'); ?>
            </div>
        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>