

<?php $__env->startSection('title', __('repair::lang.view_job_sheet')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('repair::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
$custom_labels = json_decode(session('business.custom_labels'), true);
$contact_custom_fields = !empty($jobsheet_settings['contact_custom_fields']) ?
$jobsheet_settings['contact_custom_fields'] : [];
?>
<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1>
        <?php echo app('translator')->get('repair::lang.job_sheet'); ?>
        (<code><?php echo e($job_sheet->job_sheet_no, false); ?></code>)
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header no-print">
                    <div class="box-tools">
                        <?php if(auth()->user()->can("job_sheet.edit")): ?>
                        <a href="<?php echo e(action([\Modules\Repair\Http\Controllers\JobSheetController::class, 'edit'], [$job_sheet->id]), false); ?>" class="btn btn-info cursor-pointer">
                            <i class="fa fa-edit"></i>
                            <?php echo app('translator')->get("messages.edit"); ?>
                        </a>
                        <?php endif; ?>
                        <button type="button" class="btn btn-primary" aria-label="Print" id="print_jobsheet">
                            <i class="fa fa-print"></i>
                            <?php echo app('translator')->get( 'repair::lang.print_format_1' ); ?>
                        </button>

                        <a class="btn btn-success" href="<?php echo e(action([\Modules\Repair\Http\Controllers\JobSheetController::class, 'print'], [$job_sheet->id]), false); ?>" target="_blank">
                            <i class="fas fa-file-pdf"></i>
                            <?php echo app('translator')->get( 'repair::lang.print_format_2' ); ?>
                        </a>

                        <a class="btn btn-warning" href="<?php echo e(action([\Modules\Repair\Http\Controllers\JobSheetController::class, 'printLabel'], [$job_sheet->id]), false); ?>" target="_blank">
                            <i class="fas fa-barcode"></i>
                            <?php echo app('translator')->get( 'repair::lang.print_label' ); ?>
                        </a>

                        <a class="btn btn-warning" href="<?php echo e(action([\Modules\Repair\Http\Controllers\JobSheetController::class, 'printLabel2'], [$job_sheet->id]), false); ?>" target="_blank">
                            <i class="fas fa-barcode"></i>
                            <?php echo app('translator')->get( 'repair::lang.print_label' ); ?> 2
                        </a>
                    </div>
                </div>
                <div class="box-body" id="job_sheet" style="font-family: Arial, Helvetica, sans-serif !important">
                    
                    <div class="width-100">
                        
                        <div class="text-center">
                            
                            <p style="text-align: center;">
                                <strong class="font-23">
                                    <?php echo e($job_sheet->customer->business->name, false); ?>

                                </strong>
                                <br>
                                <?php if(!empty($job_sheet->businessLocation)): ?>
                                <?php echo e($job_sheet->businessLocation->name, false); ?><br>
                                <?php endif; ?>
                                <span>
                                    <?php echo $job_sheet->businessLocation->location_address; ?>

                                </span>
                                <?php if(!empty($job_sheet->businessLocation->mobile)): ?>
                                <br>
                                <?php echo app('translator')->get('business.mobile'); ?>: <?php echo e($job_sheet->businessLocation->mobile, false); ?>,
                                <?php endif; ?>
                                <?php if(!empty($job_sheet->businessLocation->alternate_number)): ?>
                                <?php echo app('translator')->get('invoice.show_alternate_number'); ?>: <?php echo e($job_sheet->businessLocation->alternate_number, false); ?>,
                                <?php endif; ?>
                                <?php if(!empty($job_sheet->businessLocation->email)): ?>
                                <br>
                                <?php echo app('translator')->get('business.email'); ?>: <?php echo e($job_sheet->businessLocation->email, false); ?>,
                                <?php endif; ?>

                                <?php if(!empty($job_sheet->businessLocation->website)): ?>
                                <?php echo app('translator')->get('lang_v1.website'); ?>: <?php echo e($job_sheet->businessLocation->website, false); ?>

                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                    
                    <table class="table table-bordered" style="margin-top: 15px;">
                        <tr>
                            <th rowspan="3">
                                <?php echo app('translator')->get('receipt.date'); ?>:
                                <span style="font-weight: 100">
                                    <?php echo format_datetime_br($job_sheet->created_at); ?>

                                </span>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <b><?php echo app('translator')->get('repair::lang.service_type'); ?>:</b>
                                <?php echo app('translator')->get('repair::lang.'.$job_sheet->service_type); ?>
                            </td>
                            <th rowspan="2">
                                <b>
                                    <?php echo app('translator')->get('lang_v1.due_date'); ?>:
                                </b>
                                <?php if(!empty($job_sheet->delivery_date)): ?>
                                <span style="font-weight: 100">
                                    <?php echo format_datetime_br($job_sheet->delivery_date); ?>

                                </span>
                                <?php endif; ?>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <b><?php echo app('translator')->get('repair::lang.job_sheet_no'); ?>:</b>
                                <?php echo e($job_sheet->job_sheet_no, false); ?>

                            </td>
                        </tr>
                        <tr>
                            <?php if(!empty($jobsheet_settings['show_customer'])): ?>
                            <td colspan="2">
                                <?php if(!empty($jobsheet_settings['customer_label'])): ?>
                                <strong><?php echo e($jobsheet_settings['customer_label'], false); ?>:</strong><br>
                                <?php endif; ?>
                                <p>
                                    <?php echo $job_sheet->customer->contact_address; ?>


                                    <?php if(!empty($jobsheet_settings['show_client_id'])): ?>
                                    <br> <?php echo e($jobsheet_settings['client_id_label'] ?? '', false); ?>:
                                    <?php echo e($job_sheet->customer->contact_id, false); ?>

                                    <?php endif; ?>

                                    <?php if(!empty($contact->email)): ?>
                                    <br><?php echo app('translator')->get('business.email'); ?>:
                                    <?php echo e($job_sheet->customer->email, false); ?>

                                    <?php endif; ?>
                                    <br><?php echo app('translator')->get('contact.mobile'); ?>:
                                    <?php echo e($job_sheet->customer->mobile, false); ?>

                                    <?php if(!empty($contact->tax_number)): ?>
                                    <br><?php echo e($jobsheet_settings['client_tax_label'] ?? '', false); ?>:
                                    <?php echo e($job_sheet->customer->tax_number, false); ?>

                                    <?php endif; ?>
                                    <?php if(in_array('custom_field1', $contact_custom_fields)): ?>
                                    <br> <?php echo e($custom_labels['contact']['custom_field_1'] ??
											__('lang_v1.contact_custom_field1'), false); ?>:
                                    <?php echo e($job_sheet->customer->custom_field1, false); ?>

                                    <?php endif; ?>
                                    <?php if(in_array('custom_field2', $contact_custom_fields)): ?>
                                    <br> <?php echo e($custom_labels['contact']['custom_field_2'] ?? 
											__('lang_v1.contact_custom_field2'), false); ?>:
                                    <?php echo e($job_sheet->customer->custom_field2, false); ?>

                                    <?php endif; ?>
                                    <?php if(in_array('custom_field3', $contact_custom_fields)): ?>
                                    <br> <?php echo e($custom_labels['contact']['custom_field_3'] ?? 
											__('lang_v1.contact_custom_field3'), false); ?>:
                                    <?php echo e($job_sheet->customer->custom_field3, false); ?>

                                    <?php endif; ?>
                                    <?php if(in_array('custom_field4', $contact_custom_fields)): ?>
                                    <br> <?php echo e($custom_labels['contact']['custom_field_4'] ?? 
											__('lang_v1.contact_custom_field4'), false); ?>:
                                    <?php echo e($job_sheet->customer->custom_field4, false); ?>

                                    <?php endif; ?>
                                </p>
                            </td>
                            <?php endif; ?>
                            <td>
                                <b><?php echo app('translator')->get('product.brand'); ?>:</b>
                                <?php echo e($job_sheet->brand?->name, false); ?>

                                <br>
                                <b><?php echo app('translator')->get('repair::lang.device'); ?>:</b>
                                <?php echo e($job_sheet->device?->name, false); ?>

                                <br>
                                <b><?php echo app('translator')->get('repair::lang.device_model'); ?>:</b>
                                <?php echo e($job_sheet->deviceModel?->name, false); ?>

                                <br>
                                <b><?php echo app('translator')->get('repair::lang.serial_no'); ?>:</b>
                                <?php echo e($job_sheet->serial_no, false); ?>

                                <br>
                                <b><?php echo app('translator')->get('lang_v1.password'); ?>:</b>
                                <?php echo e($job_sheet->security_pwd, false); ?>

                                <br>
                                <b>
                                    <?php echo app('translator')->get('repair::lang.security_pattern_code'); ?>:
                                </b>
                                <?php echo e($job_sheet->security_pattern, false); ?>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo app('translator')->get('sale.invoice_no'); ?>:
                                </b>
                            </td>
                            <td>
                                <?php if($job_sheet->invoices->count() > 0): ?>
                                <?php $__currentLoopData = $job_sheet->invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($invoice->invoice_no, false); ?>

                                <?php if(!$loop->last): ?>
                                <?php echo e(', ', false); ?>

                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo app('translator')->get('repair::lang.estimated_cost'); ?>:
                                </b>
                            </td>
                            <td>
                                <span class="display_currency" data-currency_symbol="true">
                                    <?php echo e($job_sheet->estimated_cost, false); ?>

                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo app('translator')->get('sale.status'); ?>:
                                </b>
                            </td>
                            <td>
                                <?php echo e($job_sheet->status?->name, false); ?>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo app('translator')->get('business.location'); ?>:
                                </b>
                            </td>
                            <td>
                                <?php echo e($job_sheet->businessLocation?->name, false); ?>

                            </td>
                        </tr>
                        <?php if(!empty($job_sheet->commission_agent)): ?>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo app('translator')->get('lang_v1.commission_agent'); ?>:
                                </b>
                            </td>
                            <td>
                                <?php echo e($job_sheet->sale_commission_agent->user_full_name, false); ?>

                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo app('translator')->get('repair::lang.technician'); ?>:
                                </b>
                            </td>
                            <td>
                                <?php echo e($job_sheet->technician?->user_full_name, false); ?>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo app('translator')->get('repair::lang.comment_by_ss'); ?>:
                                </b>
                            </td>
                            <td>
                                <?php echo e($job_sheet->comment_by_ss, false); ?>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo app('translator')->get('repair::lang.pre_repair_checklist'); ?>:
                                </b>
                            </td>
                            <td>
                                <?php
                                $checklists = [];
                                if (!empty($job_sheet->deviceModel) && !empty($job_sheet->deviceModel->repair_checklist)) {
                                $checklists = explode('|', $job_sheet->deviceModel->repair_checklist);
                                }
                                if(!empty($repair_settings['default_repair_checklist'])) {
                                $checklists = array_merge(explode('|', $repair_settings['default_repair_checklist']), $checklists);
                                }
                                ?>
                                <?php if(!empty($checklists)): ?>
                                <?php $__currentLoopData = $checklists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $check): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                if(!isset($job_sheet->checklist[$check])) {
                                continue;
                                }
                                ?>
                                <div class="col-xs-4">
                                    <?php if($job_sheet->checklist[$check] == 'yes'): ?>
                                    <i class="fas fa-check-square text-success fa-lg"></i>
                                    <?php elseif($job_sheet->checklist[$check] == 'no'): ?>
                                    <i class="fas fa-window-close text-danger fa-lg"></i>
                                    <?php elseif($job_sheet->checklist[$check] == 'not_applicable'): ?>
                                    <i class="fas fa-square fa-lg"></i>
                                    <?php endif; ?>
                                    <?php echo e($check, false); ?>

                                    <br>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php if($job_sheet->service_type == 'pick_up' || $job_sheet->service_type == 'on_site'): ?>
                        <tr>
                            <td colspan="3">
                                <b>
                                    <?php echo app('translator')->get('repair::lang.pick_up_on_site_addr'); ?>:
                                </b> <br>
                                <?php echo $job_sheet->pick_up_on_site_addr; ?>

                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td colspan="3">
                                <b>
                                    <?php echo app('translator')->get('repair::lang.product_configuration'); ?>:
                                </b> <br>
                                <?php
                                $product_configuration = json_decode($job_sheet->product_configuration, true);
                                ?>
                                <?php if(!empty($product_configuration)): ?>
                                <?php $__currentLoopData = $product_configuration; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_conf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($product_conf['value'], false); ?>

                                <?php if(!$loop->last): ?>
                                <?php echo e(',', false); ?>

                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <b>
                                    <?php echo app('translator')->get('repair::lang.condition_of_product'); ?>:
                                </b> <br>
                                <?php
                                $product_condition = json_decode($job_sheet->product_condition, true);
                                ?>
                                <?php if(!empty($product_condition)): ?>
                                <?php $__currentLoopData = $product_condition; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_cond): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($product_cond['value'], false); ?>

                                <?php if(!$loop->last): ?>
                                <?php echo e(',', false); ?>

                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php if(!empty($job_sheet->custom_field_1)): ?>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo e($repair_settings['job_sheet_custom_field_1'] ?? __('lang_v1.custom_field', ['number' => 1]), false); ?>:
                                </b>
                            </td>
                            <td>
                                <?php echo e($job_sheet->custom_field_1, false); ?>

                            </td>
                        </tr>
                        <?php endif; ?>
                        </td>
                        </tr>
                        <tr>
                            <th colspan="2"><?php echo app('translator')->get('repair::lang.parts_used'); ?>:</th>
                            <td>
                                <?php if(!empty($parts)): ?>
                                <table>
                                    <?php $__currentLoopData = $parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($part['variation_name'], false); ?>: &nbsp;</td>
                                        <td><?php echo e($part['quantity'], false); ?> <?php echo e($part['unit'], false); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php if(!empty($job_sheet->custom_field_2)): ?>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo e($repair_settings['job_sheet_custom_field_2'] ?? __('lang_v1.custom_field', ['number' => 2]), false); ?>:
                                </b>
                            </td>
                            <td>
                                <?php echo e($job_sheet->custom_field_2, false); ?>

                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($job_sheet->custom_field_3)): ?>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo e($repair_settings['job_sheet_custom_field_3'] ?? __('lang_v1.custom_field', ['number' => 3]), false); ?>:
                                </b>
                            </td>
                            <td>
                                <?php echo e($job_sheet->custom_field_3, false); ?>

                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($job_sheet->custom_field_4)): ?>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo e($repair_settings['job_sheet_custom_field_4'] ?? __('lang_v1.custom_field', ['number' => 4]), false); ?>:
                                </b>
                            </td>
                            <td>
                                <?php echo e($job_sheet->custom_field_4, false); ?>

                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($job_sheet->custom_field_5)): ?>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo e($repair_settings['job_sheet_custom_field_5'] ?? __('lang_v1.custom_field', ['number' => 5]), false); ?>:
                                </b>
                            </td>
                            <td>
                                <?php echo e($job_sheet->custom_field_5, false); ?>

                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td colspan="3">
                                <b>
                                    <?php echo app('translator')->get('repair::lang.problem_reported_by_customer'); ?>:
                                </b> <br>
                                <?php
                                $defects = json_decode($job_sheet->defects, true);
                                ?>
                                <?php if(!empty($defects)): ?>
                                <?php $__currentLoopData = $defects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_defect): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($product_defect['value'], false); ?>

                                <?php if(!$loop->last): ?>
                                <?php echo e(',', false); ?>

                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <strong>
                                    <?php echo app('translator')->get("lang_v1.terms_conditions"); ?>:
                                </strong>
                                <?php if(!empty($repair_settings['repair_tc_condition'])): ?>
                                <?php echo $repair_settings['repair_tc_condition']; ?>

                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo app('translator')->get('repair::lang.customer_signature'); ?>:
                                </b>
                            </td>
                            <td>
                                <b>
                                    <?php echo app('translator')->get('repair::lang.authorized_signature'); ?>:
                                </b>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php if($job_sheet->media->count() > 0): ?>
        <div class="col-md-6">
            <div class="box box-primary no-print">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        <?php echo app('translator')->get('repair::lang.uploaded_image_for', ['job_sheet_no' => $job_sheet->job_sheet_no]); ?>
                    </h4>
                </div>
                <div class="box-body">
                    <?php if ($__env->exists('repair::job_sheet.partials.document_table_view', ['medias' => $job_sheet->media])) echo $__env->make('repair::job_sheet.partials.document_table_view', ['medias' => $job_sheet->media], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="col-md-6">
            <div class="box box-primary box-primary no-print">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo e(__('repair::lang.activities'), false); ?>:</h3>
                </div>
                <!-- /.box-header -->
                <?php echo $__env->make('repair::repair.partials.activities', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<style type="text/css">
    .table-bordered>thead>tr>th,
    .table-bordered>tbody>tr>th,
    .table-bordered>tfoot>tr>th,
    .table-bordered>thead>tr>td,
    .table-bordered>tbody>tr>td,
    .table-bordered>tfoot>tr>td {
        border: 1px solid #1d1a1a;
    }
    #job_sheet{
        font-family: Arial, Helvetica, sans-serif;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#print_jobsheet').click(function() {
            $('#job_sheet').printThis();
        });
        $(document).on('click', '.delete_media', function(e) {
            e.preventDefault();
            var url = $(this).data('href');
            var this_btn = $(this);
            swal({
                title: LANG.sure,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((confirmed) => {
                if (confirmed) {
                    $.ajax({
                        method: 'GET',
                        url: url,
                        dataType: 'json',
                        success: function(result) {
                            if (result.success == true) {
                                this_btn.closest('tr').remove();
                                toastr.success(result.msg);
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>