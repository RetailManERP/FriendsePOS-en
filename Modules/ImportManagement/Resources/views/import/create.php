
<?php $__env->startSection('title', __('importmanagement::lang.add_import')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header no-print">
    <h1><?php echo app('translator')->get('importmanagement::lang.add_import'); ?></h1>
</section>

<section class="content no-print">
    <?php echo Form::open(['url' => action([\Modules\ImportManagement\Http\Controllers\ImportController::class, 'store']), 'method' => 'post', 'id' => 'import_add_form', 'files' => true]); ?>


    
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('importmanagement::lang.import_info')]); ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('location_id', __('importmanagement::lang.business_location') . ':*'); ?>

                    <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'id' => 'import_location_id', 'required', 'placeholder' => __('importmanagement::lang.select_location')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('contact_id', __('importmanagement::lang.supplier_importer') . ':*'); ?>

                    <?php echo Form::select('contact_id', $suppliers, null, ['class' => 'form-control select2', 'required', 'placeholder' => __('importmanagement::lang.select_supplier')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('import_ref_no', __('importmanagement::lang.import_ref_no') . ':'); ?>

                    <?php echo Form::text('import_ref_no', $import_ref_no, ['class' => 'form-control', 'readonly']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('import_date', __('importmanagement::lang.import_date') . ':*'); ?>

                    <?php echo Form::text('import_date', \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'id' => 'import_date', 'required', 'readonly']); ?>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('status', __('importmanagement::lang.import_status') . ':'); ?>

                    <?php echo Form::select('status', $orderStatuses, 'draft', ['class' => 'form-control select2']); ?>

                </div>
            </div>

            
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('location_currency_id', __('importmanagement::lang.import_currency') . ':'); ?>

                    <select name="location_currency_id" id="import_currency_select" class="form-control select2">
                        <option value=""><?php echo app('translator')->get('importmanagement::lang.default_currency'); ?></option>
                        <?php $__currentLoopData = $location_currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($lc->id, false); ?>" data-multiplier="<?php echo e($lc->multiplier, false); ?>" data-code="<?php echo e($lc->code, false); ?>" data-symbol="<?php echo e($lc->symbol, false); ?>" data-thousand="<?php echo e($lc->thousand_separator, false); ?>" data-decimal="<?php echo e($lc->decimal_separator, false); ?>">
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
                        <?php echo Form::number('exchange_rate', 1, ['class' => 'form-control', 'id' => 'import_exchange_rate', 'step' => 'any', 'min' => '0.000000001']); ?>

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

                    <?php echo Form::select('incoterm', $incoterms, null, ['class' => 'form-control select2', 'placeholder' => __('importmanagement::lang.select_method')]); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('pay_term_number', __('importmanagement::lang.payment_terms') . ':'); ?>

                    <div class="input-group">
                        <?php echo Form::number('pay_term_number', null, ['class' => 'form-control', 'placeholder' => __('importmanagement::lang.payment_terms')]); ?>

                        <span class="input-group-addon" style="padding: 0; border: 0;">
                            <?php echo Form::select('pay_term_type', ['' => '', 'days' => __('importmanagement::lang.days'), 'months' => __('importmanagement::lang.months')], null, ['class' => 'form-control']); ?>

                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hidden currency detail fields -->
        <input type="hidden" id="import_p_code" value="<?php echo e($currency_details->code ?? '', false); ?>">
        <input type="hidden" id="import_p_symbol" value="<?php echo e($currency_details->symbol ?? '', false); ?>">
    <?php echo $__env->renderComponent(); ?>

    
    <?php $__env->startComponent('components.widget', ['class' => 'box-warning', 'title' => __('importmanagement::lang.shipping_logistics')]); ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('shipping_method', __('importmanagement::lang.shipping_method') . ':'); ?>

                    <?php echo Form::select('shipping_method', $shipping_methods, null, ['class' => 'form-control select2', 'placeholder' => __('importmanagement::lang.select_method')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('source_country', __('importmanagement::lang.source_country') . ':'); ?>

                    <?php echo Form::text('source_country', null, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('destination_country', __('importmanagement::lang.destination_country') . ':'); ?>

                    <?php echo Form::text('destination_country', null, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('port_of_loading', __('importmanagement::lang.port_of_loading') . ':'); ?>

                    <?php echo Form::text('port_of_loading', null, ['class' => 'form-control']); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('port_of_discharge', __('importmanagement::lang.port_of_discharge') . ':'); ?>

                    <?php echo Form::text('port_of_discharge', null, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('bill_of_lading_no', __('importmanagement::lang.bill_of_lading_no') . ':'); ?>

                    <?php echo Form::text('bill_of_lading_no', null, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('airway_bill_no', __('importmanagement::lang.airway_bill_no') . ':'); ?>

                    <?php echo Form::text('airway_bill_no', null, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('container_no', __('importmanagement::lang.container_no') . ':'); ?>

                    <?php echo Form::text('container_no', null, ['class' => 'form-control']); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('vessel_name', __('importmanagement::lang.vessel_name') . ':'); ?>

                    <?php echo Form::text('vessel_name', null, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('voyage_no', __('importmanagement::lang.voyage_no') . ':'); ?>

                    <?php echo Form::text('voyage_no', null, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('tracking_no', __('importmanagement::lang.tracking_no') . ':'); ?>

                    <?php echo Form::text('tracking_no', null, ['class' => 'form-control']); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('estimated_departure_date', __('importmanagement::lang.estimated_departure') . ':'); ?>

                    <?php echo Form::date('estimated_departure_date', null, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('estimated_arrival_date', __('importmanagement::lang.estimated_arrival') . ':'); ?>

                    <?php echo Form::date('estimated_arrival_date', null, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('actual_arrival_date', __('importmanagement::lang.actual_arrival') . ':'); ?>

                    <?php echo Form::date('actual_arrival_date', null, ['class' => 'form-control']); ?>

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
                        <?php echo Form::text('search_product', null, ['class' => 'form-control', 'id' => 'import_search_product', 'placeholder' => __('importmanagement::lang.search_product'), 'autofocus']); ?>

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
                                <th style="width: 3%;"><i class="fa fa-trash" title="Remove"></i></th>
                            </tr>
                        </thead>
                        <tbody id="import_items_body">
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right"><strong><?php echo app('translator')->get('importmanagement::lang.total_items_cost'); ?>:</strong></td>
                                <td><span id="total_items_cost_display">0.00</span></td>
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

                    <?php echo Form::select('overhead_allocation_method', $allocation_methods, 'by_value', ['class' => 'form-control select2']); ?>

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
                                <th style="width: 15%;"><?php echo app('translator')->get('importmanagement::lang.charge_category'); ?></th>
                                <th style="width: 15%;"><?php echo app('translator')->get('importmanagement::lang.charge_name'); ?></th>
                                <th style="width: 12%;"><?php echo app('translator')->get('importmanagement::lang.charge_currency'); ?></th>
                                <th style="width: 8%;"><?php echo app('translator')->get('importmanagement::lang.exchange_rate'); ?></th>
                                <th style="width: 10%;"><?php echo app('translator')->get('importmanagement::lang.charge_amount'); ?></th>
                                <th style="width: 10%;"><?php echo app('translator')->get('importmanagement::lang.charge_amount_base'); ?></th>
                                <th style="width: 8%;"><?php echo app('translator')->get('importmanagement::lang.charge_tax'); ?></th>
                                <th style="width: 10%;"><?php echo app('translator')->get('importmanagement::lang.vendor'); ?></th>
                                <th style="width: 5%;"><?php echo app('translator')->get('importmanagement::lang.include_in_landed_cost'); ?></th>
                                <th style="width: 3%;"><i class="fa fa-trash"></i></th>
                            </tr>
                        </thead>
                        <tbody id="import_charges_body">
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-right"><strong><?php echo app('translator')->get('importmanagement::lang.total_charges'); ?>:</strong></td>
                                <td><span id="total_charges_display">0.00</span></td>
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

                    <?php echo Form::select('tax_id', $taxes['tax_rates'], null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.none'), 'id' => 'import_tax_id']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('discount_type', __('importmanagement::lang.discount') . ':'); ?>

                    <div class="input-group">
                        <?php echo Form::select('discount_type', ['' => __('lang_v1.none'), 'fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage')], null, ['class' => 'form-control', 'id' => 'import_discount_type']); ?>

                        <?php echo Form::number('discount_amount', 0, ['class' => 'form-control', 'id' => 'import_discount_amount', 'step' => 'any', 'min' => '0']); ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed">
                    <tr>
                        <td class="text-right" style="width: 80%;"><strong><?php echo app('translator')->get('importmanagement::lang.total_items_cost_base'); ?>:</strong></td>
                        <td><span id="summary_items_cost_base" class="display_currency" data-currency_symbol="true">0</span></td>
                    </tr>
                    <tr>
                        <td class="text-right"><strong><?php echo app('translator')->get('importmanagement::lang.total_charges'); ?>:</strong></td>
                        <td><span id="summary_total_charges" class="display_currency" data-currency_symbol="true">0</span></td>
                    </tr>
                    <tr>
                        <td class="text-right"><strong><?php echo app('translator')->get('importmanagement::lang.total_landed_cost'); ?>:</strong></td>
                        <td><span id="summary_landed_cost" class="display_currency" data-currency_symbol="true">0</span></td>
                    </tr>
                    <tr>
                        <td class="text-right"><strong><?php echo app('translator')->get('importmanagement::lang.import_tax'); ?>:</strong></td>
                        <td><span id="summary_tax_amount" class="display_currency" data-currency_symbol="true">0</span></td>
                    </tr>
                    <tr>
                        <td class="text-right"><strong><?php echo app('translator')->get('importmanagement::lang.discount'); ?>:</strong></td>
                        <td>(-) <span id="summary_discount" class="display_currency" data-currency_symbol="true">0</span></td>
                    </tr>
                    <tr class="bg-light-blue">
                        <td class="text-right"><strong><?php echo app('translator')->get('importmanagement::lang.grand_total'); ?>:</strong></td>
                        <td><strong><span id="summary_grand_total" class="display_currency" data-currency_symbol="true">0</span></strong></td>
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

                    <?php echo Form::textarea('additional_notes', null, ['class' => 'form-control', 'rows' => 3]); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('staff_note', __('importmanagement::lang.staff_note') . ':'); ?>

                    <?php echo Form::textarea('staff_note', null, ['class' => 'form-control', 'rows' => 3]); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('import_document', __('importmanagement::lang.upload_document') . ':'); ?>

                    <?php echo Form::file('import_document', ['accept' => '.pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png']); ?>

                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php echo $__env->make('importmanagement::import.partials.import_form_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>