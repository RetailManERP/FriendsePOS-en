
<?php $__env->startSection('title', __('importmanagement::lang.edit_import')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header no-print">
    <h1><?php echo app('translator')->get('importmanagement::lang.edit_import'); ?> - <?php echo e($import->import_ref_no, false); ?></h1>
</section>

<section class="content no-print">
    <?php echo Form::open(['url' => action([\Modules\ImportManagement\Http\Controllers\ImportController::class, 'update'], [$import->id]), 'method' => 'put', 'id' => 'import_add_form', 'files' => true]); ?>


    
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('importmanagement::lang.import_info')]); ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('location_id', __('importmanagement::lang.business_location') . ':*'); ?>

                    <?php echo Form::select('location_id', $business_locations, $import->location_id, ['class' => 'form-control select2', 'id' => 'import_location_id', 'required']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('contact_id', __('importmanagement::lang.supplier_importer') . ':*'); ?>

                    <?php echo Form::select('contact_id', $suppliers, $import->contact_id, ['class' => 'form-control select2', 'required']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('import_ref_no', __('importmanagement::lang.import_ref_no') . ':'); ?>

                    <?php echo Form::text('import_ref_no', $import->import_ref_no, ['class' => 'form-control', 'readonly']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('import_date', __('importmanagement::lang.import_date') . ':*'); ?>

                    <?php echo Form::text('import_date', $import->import_date, ['class' => 'form-control', 'id' => 'import_date', 'required', 'readonly']); ?>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('status', __('importmanagement::lang.import_status') . ':'); ?>

                    <?php echo Form::select('status', $orderStatuses, $import->status, ['class' => 'form-control select2']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('location_currency_id', __('importmanagement::lang.import_currency') . ':'); ?>

                    <select name="location_currency_id" id="import_currency_select" class="form-control select2">
                        <option value=""><?php echo app('translator')->get('importmanagement::lang.default_currency'); ?></option>
                        <?php $__currentLoopData = $location_currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($lc->id, false); ?>" data-multiplier="<?php echo e($lc->multiplier, false); ?>" data-code="<?php echo e($lc->code, false); ?>" data-symbol="<?php echo e($lc->symbol, false); ?>" data-thousand="<?php echo e($lc->thousand_separator, false); ?>" data-decimal="<?php echo e($lc->decimal_separator, false); ?>" <?php echo e($import->location_currency_id == $lc->id ? 'selected' : '', false); ?>>
                                <?php echo e($lc->currency, false); ?> (<?php echo e($lc->code, false); ?>) - <?php echo e($lc->symbol, false); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('exchange_rate', __('importmanagement::lang.exchange_rate') . ':'); ?>

                    <div class="input-group">
                        <?php echo Form::number('exchange_rate', $import->exchange_rate, ['class' => 'form-control', 'id' => 'import_exchange_rate', 'step' => 'any', 'min' => '0.000000001']); ?>

                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default refresh_import_exchange_rate" title="Refresh rate">
                                <i class="fa fa-sync-alt"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('incoterm', __('importmanagement::lang.incoterm') . ':'); ?>

                    <?php echo Form::select('incoterm', $incoterms, $import->incoterm, ['class' => 'form-control select2', 'placeholder' => __('importmanagement::lang.select_method')]); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('pay_term_number', __('importmanagement::lang.payment_terms') . ':'); ?>

                    <div class="input-group">
                        <?php echo Form::number('pay_term_number', $import->pay_term_number, ['class' => 'form-control']); ?>

                        <span class="input-group-addon" style="padding: 0; border: 0;">
                            <?php echo Form::select('pay_term_type', ['' => '', 'days' => __('importmanagement::lang.days'), 'months' => __('importmanagement::lang.months')], $import->pay_term_type, ['class' => 'form-control']); ?>

                        </span>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" id="import_p_code" value="<?php echo e($currency_details->code ?? '', false); ?>">
        <input type="hidden" id="import_p_symbol" value="<?php echo e($currency_details->symbol ?? '', false); ?>">
    <?php echo $__env->renderComponent(); ?>

    
    <?php $__env->startComponent('components.widget', ['class' => 'box-warning', 'title' => __('importmanagement::lang.shipping_logistics')]); ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('shipping_method', __('importmanagement::lang.shipping_method') . ':'); ?>

                    <?php echo Form::select('shipping_method', $shipping_methods, $import->shipping_method, ['class' => 'form-control select2', 'placeholder' => __('importmanagement::lang.select_method')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('source_country', __('importmanagement::lang.source_country') . ':'); ?>

                    <?php echo Form::text('source_country', $import->source_country, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('destination_country', __('importmanagement::lang.destination_country') . ':'); ?>

                    <?php echo Form::text('destination_country', $import->destination_country, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('port_of_loading', __('importmanagement::lang.port_of_loading') . ':'); ?>

                    <?php echo Form::text('port_of_loading', $import->port_of_loading, ['class' => 'form-control']); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('port_of_discharge', __('importmanagement::lang.port_of_discharge') . ':'); ?>

                    <?php echo Form::text('port_of_discharge', $import->port_of_discharge, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('bill_of_lading_no', __('importmanagement::lang.bill_of_lading_no') . ':'); ?>

                    <?php echo Form::text('bill_of_lading_no', $import->bill_of_lading_no, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('airway_bill_no', __('importmanagement::lang.airway_bill_no') . ':'); ?>

                    <?php echo Form::text('airway_bill_no', $import->airway_bill_no, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('container_no', __('importmanagement::lang.container_no') . ':'); ?>

                    <?php echo Form::text('container_no', $import->container_no, ['class' => 'form-control']); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('vessel_name', __('importmanagement::lang.vessel_name') . ':'); ?>

                    <?php echo Form::text('vessel_name', $import->vessel_name, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('voyage_no', __('importmanagement::lang.voyage_no') . ':'); ?>

                    <?php echo Form::text('voyage_no', $import->voyage_no, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('tracking_no', __('importmanagement::lang.tracking_no') . ':'); ?>

                    <?php echo Form::text('tracking_no', $import->tracking_no, ['class' => 'form-control']); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('estimated_departure_date', __('importmanagement::lang.estimated_departure') . ':'); ?>

                    <?php echo Form::date('estimated_departure_date', $import->estimated_departure_date, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('estimated_arrival_date', __('importmanagement::lang.estimated_arrival') . ':'); ?>

                    <?php echo Form::date('estimated_arrival_date', $import->estimated_arrival_date, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('actual_arrival_date', __('importmanagement::lang.actual_arrival') . ':'); ?>

                    <?php echo Form::date('actual_arrival_date', $import->actual_arrival_date, ['class' => 'form-control']); ?>

                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    
    <?php $__env->startComponent('components.widget', ['class' => 'box-success', 'title' => __('importmanagement::lang.import_items')]); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <?php echo Form::text('search_product', null, ['class' => 'form-control', 'id' => 'import_search_product', 'placeholder' => __('importmanagement::lang.search_product')]); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed" id="import_items_table">
                        <thead>
                            <tr class="bg-light-blue-active">
                                <th style="width: 25%;"><?php echo app('translator')->get('importmanagement::lang.product'); ?></th>
                                <th style="width: 10%;"><?php echo app('translator')->get('importmanagement::lang.quantity'); ?></th>
                                <th style="width: 12%;"><?php echo app('translator')->get('importmanagement::lang.unit_price'); ?> <small class="import_currency_label"></small></th>
                                <th style="width: 12%;"><?php echo app('translator')->get('importmanagement::lang.sub_total'); ?> <small class="import_currency_label"></small></th>
                                <th style="width: 10%;"><?php echo app('translator')->get('importmanagement::lang.item_tax'); ?></th>
                                <th style="width: 8%;"><?php echo app('translator')->get('importmanagement::lang.weight_per_unit'); ?></th>
                                <th style="width: 10%;"><?php echo app('translator')->get('importmanagement::lang.lot_number'); ?></th>
                                <th style="width: 3%;"><i class="fa fa-trash"></i></th>
                            </tr>
                        </thead>
                        <tbody id="import_items_body">
                            <?php $__currentLoopData = $import->importLines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="import_item_row" data-row="<?php echo e($idx, false); ?>">
                                <td>
                                    <input type="hidden" name="import_lines[<?php echo e($idx, false); ?>][import_line_id]" value="<?php echo e($line->id, false); ?>">
                                    <input type="hidden" name="import_lines[<?php echo e($idx, false); ?>][product_id]" value="<?php echo e($line->product_id, false); ?>">
                                    <input type="hidden" name="import_lines[<?php echo e($idx, false); ?>][variation_id]" value="<?php echo e($line->variation_id, false); ?>">
                                    <span class="product_name_label"><?php echo e($line->product->name ?? '', false); ?> <?php echo e($line->variation->name != 'DUMMY' ? '- ' . $line->variation->name : '', false); ?></span>
                                </td>
                                <td>
                                    <input type="number" name="import_lines[<?php echo e($idx, false); ?>][quantity]" class="form-control input-sm import_line_qty" value="<?php echo e($line->quantity, false); ?>" min="0.0001" step="any" required>
                                </td>
                                <td>
                                    <input type="number" name="import_lines[<?php echo e($idx, false); ?>][unit_price]" class="form-control input-sm import_line_price" value="<?php echo e($line->unit_price, false); ?>" min="0" step="any" required>
                                </td>
                                <td>
                                    <span class="import_line_subtotal"><?php echo e(number_format($line->sub_total, 2), false); ?></span>
                                </td>
                                <td>
                                    <?php echo Form::select('import_lines[' . $idx . '][tax_id]', $taxes['tax_rates'], $line->tax_id, ['class' => 'form-control input-sm import_line_tax_select', 'placeholder' => 'None']); ?>

                                    <input type="hidden" name="import_lines[<?php echo e($idx, false); ?>][item_tax]" class="import_line_item_tax" value="<?php echo e($line->item_tax, false); ?>">
                                </td>
                                <td>
                                    <input type="number" name="import_lines[<?php echo e($idx, false); ?>][weight_per_unit]" class="form-control input-sm" value="<?php echo e($line->weight_per_unit, false); ?>" min="0" step="any">
                                </td>
                                <td>
                                    <input type="text" name="import_lines[<?php echo e($idx, false); ?>][lot_number]" class="form-control input-sm" value="<?php echo e($line->lot_number, false); ?>">
                                </td>
                                <td>
                                    <?php if(empty($line->purchase_line_id)): ?>
                                        <button type="button" class="btn btn-danger btn-xs remove_import_line"><i class="fa fa-times"></i></button>
                                    <?php else: ?>
                                        <i class="fa fa-lock text-muted" title="Already received"></i>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right"><strong><?php echo app('translator')->get('importmanagement::lang.total_items_cost'); ?>:</strong></td>
                                <td><span id="total_items_cost_display"><?php echo e(number_format($import->total_items_cost, 2), false); ?></span></td>
                                <td colspan="4"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    
    <?php $__env->startComponent('components.widget', ['class' => 'box-danger', 'title' => __('importmanagement::lang.overhead_charges')]); ?>
        <div class="row mb-10">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('overhead_allocation_method', __('importmanagement::lang.overhead_allocation_method') . ':'); ?>

                    <?php echo Form::select('overhead_allocation_method', $allocation_methods, $import->overhead_allocation_method, ['class' => 'form-control select2']); ?>

                </div>
            </div>
            <div class="col-md-9 text-right">
                <br>
                <button type="button" class="btn btn-success btn-sm" id="add_charge_btn">
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get('importmanagement::lang.add_charge'); ?>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed" id="import_charges_table">
                        <thead>
                            <tr class="bg-yellow">
                                <th><?php echo app('translator')->get('importmanagement::lang.charge_category'); ?></th>
                                <th><?php echo app('translator')->get('importmanagement::lang.charge_name'); ?></th>
                                <th><?php echo app('translator')->get('importmanagement::lang.charge_currency'); ?></th>
                                <th><?php echo app('translator')->get('importmanagement::lang.exchange_rate'); ?></th>
                                <th><?php echo app('translator')->get('importmanagement::lang.charge_amount'); ?></th>
                                <th><?php echo app('translator')->get('importmanagement::lang.charge_amount_base'); ?></th>
                                <th><?php echo app('translator')->get('importmanagement::lang.charge_tax'); ?></th>
                                <th><?php echo app('translator')->get('importmanagement::lang.vendor'); ?></th>
                                <th><?php echo app('translator')->get('importmanagement::lang.include_in_landed_cost'); ?></th>
                                <th><i class="fa fa-trash"></i></th>
                            </tr>
                        </thead>
                        <tbody id="import_charges_body">
                            <?php $__currentLoopData = $import->charges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cidx => $charge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="import_charge_row" data-charge-row="<?php echo e($cidx, false); ?>">
                                <td>
                                    <input type="hidden" name="import_charges[<?php echo e($cidx, false); ?>][import_charge_id]" value="<?php echo e($charge->id, false); ?>">
                                    <?php echo Form::select('import_charges[' . $cidx . '][charge_category]', $charge_categories, $charge->charge_category, ['class' => 'form-control input-sm']); ?>

                                </td>
                                <td>
                                    <input type="text" name="import_charges[<?php echo e($cidx, false); ?>][charge_name]" class="form-control input-sm" value="<?php echo e($charge->charge_name, false); ?>" required>
                                </td>
                                <td>
                                    <select name="import_charges[<?php echo e($cidx, false); ?>][charge_currency_id]" class="form-control input-sm charge_currency_select">
                                        <option value="" data-multiplier="1">Base Currency</option>
                                        <?php $__currentLoopData = $location_currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($lc->id, false); ?>" data-multiplier="<?php echo e($lc->multiplier, false); ?>" <?php echo e($charge->charge_currency_id == $lc->id ? 'selected' : '', false); ?>><?php echo e($lc->code, false); ?> - <?php echo e($lc->symbol, false); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="import_charges[<?php echo e($cidx, false); ?>][charge_exchange_rate]" class="form-control input-sm charge_exchange_rate" value="<?php echo e($charge->charge_exchange_rate, false); ?>" step="any">
                                </td>
                                <td>
                                    <input type="number" name="import_charges[<?php echo e($cidx, false); ?>][amount]" class="form-control input-sm charge_amount" value="<?php echo e($charge->amount, false); ?>" step="any" required>
                                </td>
                                <td>
                                    <span class="charge_amount_base_display"><?php echo e(number_format($charge->amount_base, 2), false); ?></span>
                                </td>
                                <td>
                                    <input type="number" name="import_charges[<?php echo e($cidx, false); ?>][tax_amount]" class="form-control input-sm charge_tax_amount" value="<?php echo e($charge->tax_amount, false); ?>" step="any">
                                </td>
                                <td>
                                    <input type="text" name="import_charges[<?php echo e($cidx, false); ?>][reference_no]" class="form-control input-sm" value="<?php echo e($charge->reference_no, false); ?>">
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="import_charges[<?php echo e($cidx, false); ?>][include_in_landed_cost]" value="1" <?php echo e($charge->include_in_landed_cost ? 'checked' : '', false); ?>>
                                </td>
                                <td>
                                    <?php if(empty($charge->expense_transaction_id)): ?>
                                        <button type="button" class="btn btn-danger btn-xs remove_charge_row"><i class="fa fa-times"></i></button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-right"><strong><?php echo app('translator')->get('importmanagement::lang.total_charges'); ?>:</strong></td>
                                <td><span id="total_charges_display"><?php echo e(number_format($import->total_charges, 2), false); ?></span></td>
                                <td colspan="4"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    
    <?php $__env->startComponent('components.widget', ['class' => 'box-info', 'title' => __('importmanagement::lang.financial_summary')]); ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('tax_id', __('importmanagement::lang.import_tax') . ':'); ?>

                    <?php echo Form::select('tax_id', $taxes['tax_rates'], $import->tax_id, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.none'), 'id' => 'import_tax_id']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('discount_type', __('importmanagement::lang.discount') . ':'); ?>

                    <div class="input-group">
                        <?php echo Form::select('discount_type', ['' => __('lang_v1.none'), 'fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage')], $import->discount_type, ['class' => 'form-control', 'id' => 'import_discount_type']); ?>

                        <?php echo Form::number('discount_amount', $import->discount_amount, ['class' => 'form-control', 'id' => 'import_discount_amount', 'step' => 'any', 'min' => '0']); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed">
                    <tr>
                        <td class="text-right" style="width: 80%;"><strong><?php echo app('translator')->get('importmanagement::lang.total_items_cost_base'); ?>:</strong></td>
                        <td><span id="summary_items_cost_base" class="display_currency" data-currency_symbol="true"><?php echo e($import->total_items_cost_base, false); ?></span></td>
                    </tr>
                    <tr>
                        <td class="text-right"><strong><?php echo app('translator')->get('importmanagement::lang.total_charges'); ?>:</strong></td>
                        <td><span id="summary_total_charges" class="display_currency" data-currency_symbol="true"><?php echo e($import->total_charges, false); ?></span></td>
                    </tr>
                    <tr>
                        <td class="text-right"><strong><?php echo app('translator')->get('importmanagement::lang.total_landed_cost'); ?>:</strong></td>
                        <td><span id="summary_landed_cost" class="display_currency" data-currency_symbol="true"><?php echo e($import->total_landed_cost, false); ?></span></td>
                    </tr>
                    <tr>
                        <td class="text-right"><strong><?php echo app('translator')->get('importmanagement::lang.import_tax'); ?>:</strong></td>
                        <td><span id="summary_tax_amount" class="display_currency" data-currency_symbol="true"><?php echo e($import->tax_amount, false); ?></span></td>
                    </tr>
                    <tr>
                        <td class="text-right"><strong><?php echo app('translator')->get('importmanagement::lang.discount'); ?>:</strong></td>
                        <td>(-) <span id="summary_discount" class="display_currency" data-currency_symbol="true">0</span></td>
                    </tr>
                    <tr class="bg-light-blue">
                        <td class="text-right"><strong><?php echo app('translator')->get('importmanagement::lang.grand_total'); ?>:</strong></td>
                        <td><strong><span id="summary_grand_total" class="display_currency" data-currency_symbol="true"><?php echo e($import->final_total, false); ?></span></strong></td>
                    </tr>
                </table>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    
    <?php $__env->startComponent('components.widget', ['class' => 'box-default']); ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('additional_notes', __('importmanagement::lang.additional_notes') . ':'); ?>

                    <?php echo Form::textarea('additional_notes', $import->additional_notes, ['class' => 'form-control', 'rows' => 3]); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('staff_note', __('importmanagement::lang.staff_note') . ':'); ?>

                    <?php echo Form::textarea('staff_note', $import->staff_note, ['class' => 'form-control', 'rows' => 3]); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('import_document', __('importmanagement::lang.upload_document') . ':'); ?>

                    <?php echo Form::file('import_document', ['accept' => '.pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png']); ?>

                    <?php if($import->document): ?>
                        <p class="help-block">Current: <a href="<?php echo e(url($import->document_path), false); ?>" target="_blank"><?php echo e($import->document, false); ?></a></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php echo $__env->make('importmanagement::import.partials.import_form_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
$(document).ready(function() {
    // Set initial row indexes based on existing data
    import_row_index = <?php echo e($import->importLines->count(), false); ?>;
    charge_row_index = <?php echo e($import->charges->count(), false); ?>;

    // Set currency label if import currency is set
    <?php if($import->location_currency_id): ?>
        var selected = $('#import_currency_select').find(':selected');
        if (selected.data('code')) {
            $('.import_currency_label').text('(' + selected.data('code') + ')');
        }
    <?php endif; ?>

    // Recalculate on load
    recalculateTotals();
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>