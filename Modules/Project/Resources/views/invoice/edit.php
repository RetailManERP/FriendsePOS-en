
<?php $__env->startSection('title', __('project::lang.invoices')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('project::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content">
    <h1>
        <i class="fa fa-file"></i>
        <?php echo app('translator')->get('project::lang.invoice'); ?>
        <small><?php echo app('translator')->get('messages.edit'); ?></small>
    </h1>
    <!-- form open -->
    <?php echo Form::open(['url' => action([\Modules\Project\Http\Controllers\InvoiceController::class, 'update'], $transaction->id), 'id' => 'invoice_form', 'method' => 'put']); ?>

        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('pjt_title', __('project::lang.title') . ':*' ); ?>

                            <?php echo Form::text('pjt_title', $transaction->pjt_title, ['class' => 'form-control', 'required' ]); ?>

                        </div>
                    </div>
                    <!-- project_id -->
                    <?php echo Form::hidden('pjt_project_id', $transaction->pjt_project_id, ['class' => 'form-control']); ?>

                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('contact_id', __('role.customer') . ':*' ); ?>

                            <?php echo Form::select('contact_id', $customers, $transaction->contact_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('location_id', __('business.business_location') . ':*' ); ?>

                            <?php echo Form::select('location_id', $business_locations, $transaction->location_id, ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('transaction_date', __('project::lang.invoice_date') . ':*' ); ?>

                            <?php echo Form::text('transaction_date', \Carbon::createFromTimestamp(strtotime($transaction->transaction_date))->format(session('business.date_format')), ['class' => 'form-control date-picker','required', 'readonly']); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                           <div class="multi-input">
                              <?php echo Form::label('pay_term_number', __('contact.pay_term') . ':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.pay_term') . '"></i>';
                }
            ?>
                              <br/>
                              <?php echo Form::number('pay_term_number', $transaction->pay_term_number, ['class' => 'form-control width-40 pull-left', 'placeholder' => __('contact.pay_term')]); ?>

                              <?php echo Form::select('pay_term_type',
                                  ['months' => __('lang_v1.months'),
                                      'days' => __('lang_v1.days')],
                                      $transaction->pay_term_type,
                                  ['class' => 'form-control width-60 pull-left','placeholder' => __('messages.please_select')]); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('status', __('sale.status') . ':*' ); ?>

                            <?php echo Form::select('status', $statuses, $transaction->status, ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- /box -->
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <label><?php echo app('translator')->get('project::lang.task'); ?>:*</label>
                    </div>
                    <div class="col-md-2">
                        <label><?php echo app('translator')->get('project::lang.rate'); ?>:*</label>
                    </div>
                    <div class="col-md-2">
                        <label><?php echo app('translator')->get('project::lang.qty'); ?>:*</label>
                    </div>
                    <div class="col-md-2">
                        <label><?php echo app('translator')->get('business.tax'); ?>(%):*</label>
                    </div>
                    <div class="col-md-2">
                        <label><?php echo app('translator')->get('receipt.total'); ?>:*</label>
                    </div>
                    <div class="col-md-1">
                    </div>
                </div>
                <div class="invoice_lines">
                    <?php $__currentLoopData = $transaction->invoiceLines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $invoiceLine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-12 il-bg invoice_line">
                            <div class="mt-10">
                            <!-- invoice line id -->
                            <?php echo Form::hidden('invoice_line_id[]', $invoiceLine->id, ['class' => 'form-control']); ?>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <?php echo Form::text('existing_task[]', $invoiceLine->task, ['class' => 'form-control', 'required' ]); ?>

                                        <span class="input-group-btn">
                                            <button class="btn btn-default toggle_description" type="button">
                                                <i class="fa fa-info-circle text-info" data-toggle="tooltip" title="<?php echo app('translator')->get('project::lang.toggle_invoice_task_description'); ?>"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <?php echo Form::text('existing_rate[]', number_format($invoiceLine->rate, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control rate input_number', 'required' ]); ?>

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <?php echo Form::text('existing_quantity[]', number_format($invoiceLine->quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control quantity input_number', 'required' ]); ?>

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <?php echo Form::select('existing_tax_rate_id[]', $taxes, $invoiceLine->tax_rate_id, ['class' => 'form-control tax'], $tax_attributes); ?>


                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <?php echo Form::text('existing_total[]', number_format($invoiceLine->total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control total input_number', 'required', 'readonly']); ?>

                                </div>
                            </div>
                            <?php if($key != 0): ?>
                                <div class="col-md-1">
                                    <i class="fa fa-trash text-danger cursor-pointer remove_this_row"></i>
                                </div>
                            <?php endif; ?>
                            <div class="col-md-11">
                                <div class="form-group description" style="
                                    <?php if(!isset($invoiceLine->description)): ?>display: none;
                                    <?php endif; ?>">
                                    <?php echo Form::textarea('existing_description[]', $invoiceLine->description, ['class' => 'form-control ', 'placeholder' => __('lang_v1.description'), 'rows' => '3']); ?>

                                </div>
                            </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="col-md-4 col-md-offset-4">
                    <br>
                    <button type="button" class="tw-dw-btn tw-dw-btn-primary tw-text-white tw-dw-btn-sm tw-w-full add_invoice_line">
                        <?php echo app('translator')->get('project::lang.add_a_row'); ?>
                        <i class="fa fa-plus-circle"></i>
                    </button>
                </div>
            </div>
            <!-- including invoice line row -->
            <?php if ($__env->exists('project::invoice.partials.invoice_line_row')) echo $__env->make('project::invoice.partials.invoice_line_row', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>  <!-- /box -->
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-10">
                        <b><?php echo app('translator')->get('sale.subtotal'); ?>:</b>
                        <span class="subtotal display_currency" data-currency_symbol="true" >0.00</span>
                        <input type="hidden" name="total_before_tax" id="subtotal" value="0.00">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?php echo Form::label('discount_type', __('sale.discount_type') . ':' ); ?>

                        <?php echo Form::select('discount_type', $discount_types, $transaction->discount_type, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;']); ?>

                    </div>
                    <div class="col-md-6">
                        <?php echo Form::label('discount_amount', __('sale.discount_amount') . ':' ); ?>

                        <?php echo Form::text('discount_amount', number_format($transaction->discount_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number']); ?>

                    </div>
                </div> <br>

                <div class="row">
                    <div class="col-md-6 col-md-offset-6">
                        <b><?php echo app('translator')->get('project::lang.invoice_total'); ?>:</b>
                        <span class="invoice_total display_currency" data-currency_symbol="true" >0.00</span>
                        <input type="hidden" name="final_total" id="invoice_total" value="0.00">
                    </div>
                </div> <br>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('staff_note', __('project::lang.terms') . ':'); ?>

                            <?php echo Form::textarea('staff_note', $transaction->staff_note, ['class' => 'form-control ', 'rows' => '3']); ?>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('additional_notes', __('project::lang.notes') . ':'); ?>

                            <?php echo Form::textarea('additional_notes', $transaction->additional_notes, ['class' => 'form-control ', 'rows' => '3']); ?>

                        </div>
                    </div>
                </div>
                <button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-text-white pull-right">
                    <?php echo app('translator')->get('messages.update'); ?>
                </button>
                <a href="<?php echo e(action([\Modules\Project\Http\Controllers\ProjectController::class, 'show'], [$transaction->pjt_project_id]), false); ?>?view=project_invoices"
                   class="tw-dw-btn tw-dw-btn-outline pull-right" style="margin-right:8px;">
                    <i class="fa fa-times"></i> <?php echo app('translator')->get('messages.close'); ?>
                </a>
            </div>
        </div> <!-- /box -->
    <?php echo Form::close(); ?> <!-- /form close -->
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('modules/project/js/project.js?v=' . $asset_v . '.' . filemtime(public_path('modules/project/js/project.js'))), false); ?>"></script>
<!-- call a function to calculate subtotal once edit page is loaded -->
<script type="text/javascript">
    $(document).ready(function() {
        calculateSubtotal();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>