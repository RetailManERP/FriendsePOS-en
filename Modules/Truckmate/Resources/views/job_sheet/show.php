

<?php $__env->startSection('title', __('truckmate::lang.view_job_sheet')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('truckmate::job_sheet.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
$custom_labels = json_decode(session('business.custom_labels'), true);
$contact_custom_fields = !empty($jobsheet_settings['contact_custom_fields']) ? $jobsheet_settings['contact_custom_fields'] : [];
?>
<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <div class="tm-page-header">
        <h1><i class="fas fa-clipboard-list" style="color:var(--tm-primary)"></i> <?php echo app('translator')->get('truckmate::lang.job_sheet'); ?> (<code><?php echo e($job_sheet->job_sheet_no, false); ?></code>)</h1>
    </div>
</section>
<!-- Main content -->
<section class="content tm-content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header no-print">
                    <div class="box-tools d-flex gap-2 flex-wrap">
                        <?php if(auth()->user()->can("truckmate_job_sheet.edit")): ?>
                        <a href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\JobSheetController::class, 'edit'], [$job_sheet->id]), false); ?>" class="btn btn-info btn-sm cursor-pointer" style="border-radius:8px">
                            <i class="fa fa-edit me-1"></i>
                            <?php echo app('translator')->get("messages.edit"); ?>
                        </a>
                        <?php endif; ?>
                        <button type="button" class="btn btn-primary btn-sm" aria-label="Print" id="print_jobsheet" style="border-radius:8px">
                            <i class="fa fa-print me-1"></i>
                            <?php echo app('translator')->get( 'truckmate::lang.print' ); ?>
                        </button>

                        <a class="btn btn-success btn-sm" href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\JobSheetController::class, 'print'], [$job_sheet->id]), false); ?>" target="_blank" style="border-radius:8px">
                            <i class="fas fa-file-pdf me-1"></i>
                            <?php echo app('translator')->get( 'truckmate::lang.print_pdf' ); ?>
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
                            <th colspan="2">
                                <?php echo app('translator')->get('receipt.date'); ?>:
                                <span style="font-weight: 100">
                                    <?php echo format_datetime_br($job_sheet->created_at); ?>

                                </span>
                            </th>
                            <td>
                                <b><?php echo app('translator')->get('truckmate::lang.job_sheet_no'); ?>:</b>
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
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo app('translator')->get('lang_v1.start_date'); ?>:
                                </b>
                            </td>
                            <td>
                                <span style="font-weight: 100">
                                    <?php echo format_datetime_br($job_sheet->start_date); ?>

                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo app('translator')->get('lang_v1.end_date'); ?>:
                                </b>
                            </td>
                            <td>
                                <span style="font-weight: 100">
                                    <?php echo format_datetime_br($job_sheet->end_date); ?>

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
                                    <?php echo app('translator')->get('truckmate::lang.vehicle'); ?>:
                                </b>
                            </td>
                            <td>
                                <?php echo e($job_sheet->vehicle?->number, false); ?>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo app('translator')->get('truckmate::lang.driver'); ?>:
                                </b>
                            </td>
                            <td>
                                <?php echo e($job_sheet->driver?->user_full_name, false); ?>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo app('translator')->get('truckmate::lang.loading_point'); ?>:
                                </b>
                            </td>
                            <td>
                                <?php echo collect($job_sheet->point_lines)->map(fn($pl) => $pl->load_address . '<br>' . $pl->load_point)->implode('<br><br>'); ?>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo app('translator')->get('truckmate::lang.destination_point'); ?>:
                                </b>
                            </td>
                            <td>
                                <?php echo collect($job_sheet->point_lines)->map(fn($pl) => $pl->dest_address . '<br>' . $pl->dest_point)->implode('<br><br>'); ?>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo app('translator')->get('truckmate::lang.estimated_cost'); ?>:
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
                                    <?php echo app('translator')->get('truckmate::lang.remarks'); ?>:
                                </b>
                            </td>
                            <td>
                                <?php echo e($job_sheet->remarks, false); ?>

                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo app('translator')->get('sale.invoice_no'); ?>:
                                </b>
                            </td>
                            <td>
                                
                            </td>
                        </tr>
                        <?php if(!empty($job_sheet->custom_field_1)): ?>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo e($truckmate_settings['job_sheet_custom_field_1'] ?? __('lang_v1.custom_field', ['number' => 1]), false); ?>:
                                </b>
                            </td>
                            <td>
                                <?php echo e($job_sheet->custom_field_1, false); ?>

                            </td>
                        </tr>
                        <?php endif; ?>
                        </td>
                        </tr>
                        <?php if(!empty($job_sheet->custom_field_2)): ?>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo e($truckmate_settings['job_sheet_custom_field_2'] ?? __('lang_v1.custom_field', ['number' => 2]), false); ?>:
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
                                    <?php echo e($truckmate_settings['job_sheet_custom_field_3'] ?? __('lang_v1.custom_field', ['number' => 3]), false); ?>:
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
                                    <?php echo e($truckmate_settings['job_sheet_custom_field_4'] ?? __('lang_v1.custom_field', ['number' => 4]), false); ?>:
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
                                    <?php echo e($truckmate_settings['job_sheet_custom_field_5'] ?? __('lang_v1.custom_field', ['number' => 5]), false); ?>:
                                </b>
                            </td>
                            <td>
                                <?php echo e($job_sheet->custom_field_5, false); ?>

                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td colspan="2">
                                <b>
                                    <?php echo app('translator')->get('truckmate::lang.customer_signature'); ?>:
                                </b>
                            </td>
                            <td>
                                <b>
                                    <?php echo app('translator')->get('truckmate::lang.authorized_signature'); ?>:
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
                        <?php echo app('translator')->get('truckmate::lang.uploaded_image_for', ['number' => $job_sheet->job_sheet_no]); ?>
                    </h4>
                </div>
                <div class="box-body">
                    <?php if ($__env->exists('truckmate::job_sheet.partials.document_table_view', ['medias' => $job_sheet->media])) echo $__env->make('truckmate::job_sheet.partials.document_table_view', ['medias' => $job_sheet->media], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="col-md-6">
            <div class="box box-primary box-primary no-print">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo e(__('truckmate::lang.activities'), false); ?>:</h3>
                </div>
                <!-- /.box-header -->
                <?php echo $__env->make('truckmate::truckmate.partials.activities', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

        <?php if(!empty(request()->input('print_on_load'))): ?>
            $(window).on('load', function(){
                $('#job_sheet').printThis();
            });
        <?php endif; ?>
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