

<?php $__env->startSection('title', __('truckmate::lang.edit_job_sheet')); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('truckmate::job_sheet.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header no-print">
        <div class="tm-page-header">
            <h1><i class="fas fa-edit" style="color:var(--tm-primary)"></i> <?php echo app('translator')->get('truckmate::lang.job_sheet'); ?> (<code><?php echo e($job_sheet->job_sheet_no, false); ?></code>)</h1>
        </div>
    </section>
    <section class="content tm-content">
        <?php echo Form::open([
            'url' => action([\Modules\Truckmate\Http\Controllers\JobSheetController::class, 'update'], [$job_sheet->id]),
            'method' => 'put',
            'id' => 'edit_job_sheet_form',
            'files' => true,
        ]); ?>

        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <input type="hidden" id="job_sheet_id" value="<?php echo e($job_sheet->id, false); ?>">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('location_id', __('business.business_location') . ':*'); ?>

                            <?php echo Form::select('location_id', $business_locations, $job_sheet->location_id, [
                                'class' => 'form-control',
                                'placeholder' => __('messages.please_select'),
                                'required',
                                'style' => 'width: 100%;',
                            ]); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('contact_id', __('role.customer') . ':*'); ?>

                            <div class="input-group">
                                <input type="hidden" id="default_customer_id" value="<?php echo e($job_sheet->customer->id, false); ?>">
                                <input type="hidden" id="default_customer_name"
                                    value="<?php echo e(!empty($job_sheet->customer->name) ? $job_sheet->customer->name : $job_sheet->customer->supplier_business_name, false); ?>">
                                <input type="hidden" id="default_customer_balance"
                                    value="<?php echo e($job_sheet->customer->balance, false); ?>">

                                <?php echo Form::select('contact_id', [], null, [
                                    'class' => 'form-control mousetrap',
                                    'id' => 'customer_id',
                                    'placeholder' => 'Enter Customer name / phone',
                                    'required',
                                    'style' => 'width: 100%;',
                                ]); ?>

                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default bg-white btn-flat add_new_customer"
                                        data-name="" <?php if(!auth()->user()->can('customer.create')): ?> disabled <?php endif; ?>><i
                                            class="fa fa-plus-circle text-primary fa-lg"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('source', __('truckmate::lang.source') . ':'); ?>

                            <?php echo Form::select('source', ['amazon' => 'Amazon', 'other' => 'Other'], $job_sheet->source, [
                                'class' => 'form-control mousetrap',
                                'id' => 'source',
                                'placeholder' => __('messages.please_select'),
                                'style' => 'width: 100%;',
                            ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <?php echo Form::label('job_sheet_no', __('truckmate::lang.job_sheet_no') . ':'); ?>

                            <?php echo Form::text('job_sheet_no', $job_sheet->job_sheet_no, [
                                'class' => 'form-control',
                                'readonly',
                                'placeholder' => __('lang_v1.keep_blank_to_autogenerate'),
                            ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="status_id"><?php echo e(__('sale.status') . ':*', false); ?></label>
                            <select name="status_id" class="form-control status" id="status_id" required>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-body">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('start_date', __('lang_v1.start_date') . ':*'); ?>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <?php echo Form::text('start_date', !empty($job_sheet->start_date) ? \Carbon::createFromTimestamp(strtotime($job_sheet->start_date))->format(session('business.date_format') . ' ' . 'h:i A') : null, [
                                    'class' => 'form-control',
                                    'readonly',
                                    'required',
                                ]); ?>

                                <span class="input-group-addon">
                                    <i class="fas fa-times-circle cursor-pointer clear_start_date"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('end_date', __('lang_v1.end_date') . ':*'); ?>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <?php echo Form::text('end_date', !empty($job_sheet->end_date) ? \Carbon::createFromTimestamp(strtotime($job_sheet->end_date))->format(session('business.date_format') . ' ' . 'h:i A') : null, [
                                    'class' => 'form-control',
                                    'readonly',
                                    'required',
                                ]); ?>

                                <span class="input-group-addon">
                                    <i class="fas fa-times-circle cursor-pointer clear_end_date"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <?php
                    $row_count = 0;
                    ?>
                    <div class="col-md-12">
                        <div class="table-responsive">
<table class="table table-reponsive" id="job_sheet_points_table">
                            <thead>
                                <tr>
                                    <th style="width:10%"><?php echo app('translator')->get('truckmate::lang.loading_point'); ?></th>
                                    <th style="width:30%"><?php echo app('translator')->get('truckmate::lang.loading_address'); ?></th>
                                    <th style="width:10%"><?php echo app('translator')->get('truckmate::lang.destination_point'); ?></th>
                                    <th style="width:30%"><?php echo app('translator')->get('truckmate::lang.destination_address'); ?></th>
                                    <th style="width:5%"></th>
                                </tr>
                            </thead>  
                            <tbody>
                                <?php $__currentLoopData = $job_sheet->point_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('truckmate::job_sheet.partials.job_sheet_point_row', ['row_count' => $row_count, 'point_line' => $point_line], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php
                                    $row_count++;
                                ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
</div>
                    </div>
                    <input type="hidden" id="row_count" value="<?php echo e(count($job_sheet->point_lines), false); ?>">

                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <button type="button" class="btn btn-primary btn-sm align-right" id="add_new_point_row">
                                <i class="fa fa-plus"></i> Add New Row
                            </button>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <?php echo Form::label('vehicle_id', __('truckmate::lang.vehicle') . ':*'); ?>

                            
                            <?php echo Form::select('vehicle_id',
                                $vehicles,
                                $job_sheet->vehicle_id,
                                ['class' => 'form-control select2', 'required'],
                            ); ?>

                            <input type="hidden" id="hidden_vehicle_id" value="<?php echo e($job_sheet->vehicle_id, false); ?>">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <?php echo Form::label('driver_id', __('truckmate::lang.driver') . ':*'); ?>

                            <?php echo Form::select(
                                'driver_id',
                                $drivers,
                                $job_sheet->driver_id,
                                ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required'],
                            ); ?>

                            <input type="hidden" id="hidden_driver_id" value="<?php echo e($job_sheet->driver_id, false); ?>">
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">

                    <div class="col-sm-4">
                        <div class="form-group">
                            <?php echo Form::label('estimated_cost', __('truckmate::lang.estimated_cost') . ':'); ?>

                            <?php echo Form::text(
                                'estimated_cost',
                                !empty($job_sheet->estimated_cost) ? number_format($job_sheet->estimated_cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : null,
                                ['class' => 'form-control input_number', 'placeholder' => __('truckmate::lang.estimated_cost')],
                            ); ?>

                        </div>
                    </div>
                    <?php if(in_array('upload_documents', $enabled_modules)): ?>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <?php echo Form::label('images', __('truckmate::lang.document') . ':'); ?>

                            <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
                            <?php echo Form::file('images[]', [
                                'id' => 'upload_job_sheet_image',
                                'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types'))),
                                'multiple',
                            ]); ?>

                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('remarks', __('truckmate::lang.remarks') . ':'); ?>

                            <?php echo Form::textarea('remarks', $job_sheet->remarks, ['class' => 'form-control ', 'rows' => '3']); ?>

                        </div>
                    </div>
                    <div class="col-md-4 hide">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('truckmate::lang.send_notification'); ?></label> <br>
                            <div class="checkbox-inline">
                                <label class="cursor-pointer">
                                    <input type="checkbox" name="send_notification[]" value="sms">
                                    <?php echo app('translator')->get('truckmate::lang.sms'); ?>
                                </label>
                            </div>
                            <div class="checkbox-inline">
                                <label class="cursor-pointer">
                                    <input type="checkbox" name="send_notification[]" value="email">
                                    <?php echo app('translator')->get('business.email'); ?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="col-sm-4 <?php if(empty($truckmate_settings['job_sheet_custom_field_1'])): ?> hide <?php endif; ?>">
                        <div class="form-group">
                            <?php
                                $custom_field_1_label = !empty($truckmate_settings['job_sheet_custom_field_1'])
                                    ? $truckmate_settings['job_sheet_custom_field_1']
                                    : __('lang_v1.custom_field', ['number' => 1]);
                            ?>
                            <?php echo Form::label('custom_field_1', $custom_field_1_label . ':'); ?>

                            <?php echo Form::text('custom_field_1', $job_sheet->custom_field_1, ['class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-sm-4 <?php if(empty($truckmate_settings['job_sheet_custom_field_2'])): ?> hide <?php endif; ?>">
                        <div class="form-group">
                            <?php
                                $custom_field_2_label = !empty($truckmate_settings['job_sheet_custom_field_2'])
                                    ? $truckmate_settings['job_sheet_custom_field_2']
                                    : __('lang_v1.custom_field', ['number' => 2]);
                            ?>
                            <?php echo Form::label('custom_field_2', $custom_field_2_label . ':'); ?>

                            <?php echo Form::text('custom_field_2', $job_sheet->custom_field_2, ['class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-sm-4 <?php if(empty($truckmate_settings['job_sheet_custom_field_3'])): ?> hide <?php endif; ?>">
                        <div class="form-group">
                            <?php
                                $custom_field_3_label = !empty($truckmate_settings['job_sheet_custom_field_3'])
                                    ? $truckmate_settings['job_sheet_custom_field_3']
                                    : __('lang_v1.custom_field', ['number' => 3]);
                            ?>
                            <?php echo Form::label('custom_field_3', $custom_field_3_label . ':'); ?>

                            <?php echo Form::text('custom_field_3', $job_sheet->custom_field_3, ['class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-sm-4 <?php if(empty($truckmate_settings['job_sheet_custom_field_4'])): ?> hide <?php endif; ?>">
                        <div class="form-group">
                            <?php
                                $custom_field_4_label = !empty($truckmate_settings['job_sheet_custom_field_4'])
                                    ? $truckmate_settings['job_sheet_custom_field_4']
                                    : __('lang_v1.custom_field', ['number' => 4]);
                            ?>
                            <?php echo Form::label('custom_field_4', $custom_field_4_label . ':'); ?>

                            <?php echo Form::text('custom_field_4', $job_sheet->custom_field_4, ['class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-sm-4 <?php if(empty($truckmate_settings['job_sheet_custom_field_5'])): ?> hide <?php endif; ?>">
                        <div class="form-group">
                            <?php
                                $custom_field_5_label = !empty($truckmate_settings['job_sheet_custom_field_5'])
                                    ? $truckmate_settings['job_sheet_custom_field_5']
                                    : __('lang_v1.custom_field', ['number' => 5]);
                            ?>
                            <?php echo Form::label('custom_field_5', $custom_field_5_label . ':'); ?>

                            <?php echo Form::text('custom_field_5', $job_sheet->custom_field_5, ['class' => 'form-control']); ?>

                        </div>
                    </div>
                    <input type="hidden" name="submit_type" id="submit_type">
                </div>
            </div>
        </div>
        <?php echo Form::close(); ?> <!-- /form close -->
        
        <div id="job-sheet-footer-actions-template" class="d-none">
            <div>
                <button type="button" class="btn btn-primary" id="footer_save">
                    <i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>
                </button>
                <button type="button" class="btn btn-info" id="footer_save_and_upload_docs">
                    <i class="fas fa-upload"></i> <?php echo app('translator')->get('truckmate::lang.save_and_upload_docs'); ?>
                </button>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('modals'); ?>
<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
            <?php echo $__env->make('contact.create', ['quick_add' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <?php echo $__env->make('truckmate::job_sheet.tagify_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        .bootstrap-datetimepicker-widget.dropdown-menu {
            z-index: 99999 !important;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script src="<?php echo e(asset('js/pos.js?v=' . $asset_v), false); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Footer button handlers
            $(document).on('click', '#footer_save', function() {
                $('#submit_type').val('submit');
                $('form#edit_job_sheet_form').submit();
            });
            $(document).on('click', '#footer_save_and_upload_docs', function() {
                $('#submit_type').val('save_and_upload_docs');
                $('form#edit_job_sheet_form').submit();
            });
            $('form#edit_job_sheet_form').validate({
                errorPlacement: function(error, element) {
                    if (element.parent('.iradio_square-blue').length) {
                        error.insertAfter($(".radio_btns"));
                    } else if (element.hasClass('status')) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

            var data = [{
                    id: "",
                    text: '<?php echo app('translator')->get('messages.please_select'); ?>',
                    html: '<?php echo app('translator')->get('messages.please_select'); ?>',
                    is_complete: '0',
                },
                <?php $__currentLoopData = $truckmate_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $truckmate_status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    {
                        id: <?php echo e($truckmate_status->id, false); ?>,
                        is_complete: '<?php echo e($truckmate_status->is_completed_status, false); ?>',
                        <?php if(!empty($truckmate_status->color)): ?>
                            text: '<i class="fa fa-circle" aria-hidden="true" style="color: <?php echo e($truckmate_status->color, false); ?>;"></i> <?php echo e($truckmate_status->name, false); ?>',
                            title: '<?php echo e($truckmate_status->name, false); ?>'
                        <?php else: ?>
                            text: "<?php echo e($truckmate_status->name, false); ?>"
                        <?php endif; ?>
                    },
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ];

            $("select#status_id").select2({
                data: data,
                escapeMarkup: function(markup) {
                    return markup;
                },
                templateSelection: function(data, container) {
                    $(data.element).attr('data-is_complete', data.is_complete);
                    return data.text;
                }
            });

            <?php if(!empty($job_sheet->status_id)): ?>
                $("select#status_id").val(<?php echo e($job_sheet->status_id, false); ?>).change();
            <?php elseif(!empty($default_status)): ?>
                $("select#status_id").val(<?php echo e($default_status, false); ?>).change();
            <?php endif; ?>

            $('#start_date').datetimepicker({
                format: moment_date_format + ' ' + moment_time_format,
                ignoreReadonly: true,
            });

            $(document).on('click', '.clear_start_date', function() {
                $('#start_date').data("DateTimePicker").clear();
            });


            $('#end_date').datetimepicker({
                format: moment_date_format + ' ' + moment_time_format,
                ignoreReadonly: true,
            });

            $(document).on('click', '.clear_end_date', function() {
                $('#end_date').data("DateTimePicker").clear();
            });

            $('#start_date').on('dp.change', function() {
                get_driver_vehicle();
            });

            $('#end_date').on('dp.change', function(e) {
                get_driver_vehicle();
            });

            //initialize file input
            $('#upload_job_sheet_image').fileinput({
                showUpload: false,
                showPreview: false,
                browseLabel: '',
                removeLabel: '',
                cancelLabel: ''
            });

            //TODO:Uncomment the below code

            // function toggleSubmitButton () {
            //     if ($('select#status_id').find(':selected').data('is_complete')) {
            //         $("#save_and_add_parts").attr('disabled', false);
            //         $("#save_and_upload_docs").attr('disabled', true);
            //     } else {
            //         $("#save_and_add_parts").attr('disabled', true);
            //         $("#save_and_upload_docs").attr('disabled', false);
            //     }
            // }

            // $("select#status_id").on('change', function () {
            //     toggleSubmitButton();
            // });

            // toggleSubmitButton();

            $(document).on('click', '#add_new_point_row', function() {
                $.ajax({
                    method: 'GET',
                    url: '/truckmate/get-job-sheet-point-line',
                    async: false,
                    data: {
                        row_count: $('input#row_count').val(),
                    },
                    dataType: 'html',
                    success: function(result) {
                        $('table#job_sheet_points_table tbody').append(result);    
                        $('input#row_count').val(parseInt($('input#row_count').val())+1);
                    },
                });
            });

            $(document).on('click', '.point_row', function() {
                $(this).parents('tr').remove();
            });
        });

        function get_driver_vehicle() {
            let start_date = $("#start_date").val();
            let end_date = $("#end_date").val();
            let job_sheet_id = $('#job_sheet_id').val();
            let vehicle_id = $('#hidden_vehicle_id').val();
            let driver_id = $('#hidden_driver_id').val();
            if (start_date && end_date) {
                $.ajax({
                    url: "<?php echo e(route('truckmate.get_vehicle_drivers'), false); ?>",
                    dataType: 'json',
                    data: {
                        'start_date': start_date,
                        'end_date': end_date,
                        'job_sheet_id': job_sheet_id,
                    },
                    success: function(result) {
                        if (result.success) {
                            $('#vehicle_id').select2('destroy')
                                .empty()
                                .select2({
                                    data: result.vehicles,
                                });
                            $('#vehicle_id').val(vehicle_id);
                            $('#vehicle_id').change();

                            $('#driver_id').select2('destroy')
                                .empty()
                                .select2({
                                    data: result.drivers,
                                });
                            $('#driver_id').val(driver_id);
                            $('#driver_id').change();
                        }
                    },
                });
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>