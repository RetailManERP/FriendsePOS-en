

<?php $__env->startSection('title', __('repair::lang.edit_job_sheet')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('repair::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1>
    	<?php echo app('translator')->get('repair::lang.job_sheet'); ?>
        (<code><?php echo e($job_sheet->job_sheet_no, false); ?></code>)
    </h1>
</section>
<section class="content">
    <?php if(!empty($repair_settings)): ?>
        <?php
            $product_conf = isset($repair_settings['product_configuration']) ? explode(',', $repair_settings['product_configuration']) : [];

            $defects = isset($repair_settings['problem_reported_by_customer']) ? explode(',', $repair_settings['problem_reported_by_customer']) : [];

            $product_cond = isset($repair_settings['product_condition']) ? explode(',', $repair_settings['product_condition']) : [];
        ?>
    <?php else: ?>
        <?php
            $product_conf = [];
            $defects = [];
            $product_cond = [];
        ?>
    <?php endif; ?>
    <?php echo Form::open(['url' => action([\Modules\Repair\Http\Controllers\JobSheetController::class, 'update'], [$job_sheet->id]), 'method' => 'put', 'id' => 'edit_job_sheet_form', 'files' => true]); ?>

        <?php if ($__env->exists('repair::job_sheet.partials.scurity_modal')) echo $__env->make('repair::job_sheet.partials.scurity_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" id="job_sheet_id" value="<?php echo e($job_sheet->id, false); ?>">
                        <div class="form-group">
                            <?php echo Form::label('contact_id', __('role.customer') .':*'); ?>

                            <div class="input-group">
                                <input type="hidden" id="default_customer_id" value="<?php echo e($job_sheet->customer->id, false); ?>" >
                                <input type="hidden" id="default_customer_name" value="<?php echo e($job_sheet->customer->name, false); ?>" >
                                <input type="hidden" id="default_customer_balance" value="<?php echo e($job_sheet->customer->balance, false); ?>" >

                                <?php echo Form::select('contact_id', [], null, ['class' => 'form-control mousetrap', 'id' => 'customer_id', 'placeholder' => 'Enter Customer name / phone', 'required', 'style' => 'width: 100%;']); ?>

                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default bg-white btn-flat add_new_customer" data-name=""  <?php if(!auth()->user()->can('customer.create')): ?> disabled <?php endif; ?>><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php echo Form::label('service_type',  __('repair::lang.service_type').':*', ['style' => 'margin-left:20px;']); ?>

                        <br>
                        <label class="radio-inline">
                            <?php echo Form::radio('service_type', 'carry_in', ($job_sheet->service_type == 'carry_in') ? true : false, [ 'class' => 'form-check-input', 'required']); ?>

                            <?php echo app('translator')->get('repair::lang.carry_in'); ?>
                        </label>
                        <label class="radio-inline">
                            <?php echo Form::radio('service_type', 'pick_up', ($job_sheet->service_type == 'pick_up') ? true : false, [ 'class' => 'form-check-input']); ?>

                            <?php echo app('translator')->get('repair::lang.pick_up'); ?>
                        </label>
                        <label class="radio-inline radio_btns">
                            <?php echo Form::radio('service_type', 'on_site', ($job_sheet->service_type == 'on_site') ? true : false, [ 'class' => 'form-check-input']); ?>

                            <?php echo app('translator')->get('repair::lang.on_site'); ?>
                        </label>
                    </div>
                    <div class="clearfix"></div>
                    <?php if(!empty($commission_agent)): ?>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                            <?php echo Form::label('commission_agent', __('lang_v1.commission_agent') . ':'); ?>

                            <?php echo Form::select('commission_agent', $commission_agent, $job_sheet->commission_agent, ['id' => 'commission_agent','width: 100%;', 'class' => 'form-control select2', ]); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if($job_sheet->service_type == 'pick_up' || $job_sheet->service_type == 'on_site'): ?>
                    <?php
                        $avail_addr = true;
                    ?>
                <?php else: ?>
                    <?php
                        $avail_addr = false;
                    ?>
                <?php endif; ?>
                <div class="row pick_up_onsite_addr" <?php if(!$avail_addr): ?> style="display: none;" <?php endif; ?>>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('pick_up_on_site_addr', __('repair::lang.pick_up_on_site_addr') . ':'); ?>

                            <?php echo Form::textarea('pick_up_on_site_addr',$job_sheet->pick_up_on_site_addr, ['class' => 'form-control ', 'id' => 'pick_up_on_site_addr', 'placeholder' => __('repair::lang.pick_up_on_site_addr'), 'rows' => 3]); ?>

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
                            <?php echo Form::label('brand_id', __('product.brand') . ':'); ?>

                            <?php echo Form::select('brand_id', $brands, $job_sheet->brand_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <?php echo Form::label('device_id', __('repair::lang.device') . ':'); ?>

                            <?php echo Form::select('device_id', $devices, $job_sheet->device_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <?php echo Form::label('device_model_id', __('repair::lang.device_model') . ':'); ?>

                            <?php echo Form::select('device_model_id', $device_models, $job_sheet->device_model_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h5 class="box-title">
                                    <?php echo app('translator')->get('repair::lang.pre_repair_checklist'); ?>:
                                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('repair::lang.prechecklist_help_text') . '"></i>';
                }
            ?>
                                    <small>
                                        <?php echo app('translator')->get('repair::lang.not_applicable_key'); ?> = <?php echo app('translator')->get('repair::lang.not_applicable'); ?>
                                    </small>
                                </h5>
                            </div>
                            <div class="box-body">
                                <div class="append_checklists"></div>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php echo Form::label('serial_no', __('repair::lang.serial_no') . ':*'); ?>

                            <?php echo Form::text('serial_no', $job_sheet->serial_no, ['class' => 'form-control', 'placeholder' => __('repair::lang.serial_no'), 'required']); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                           <?php echo Form::label('security_pwd', __('repair::lang.repair_passcode') . ':'); ?>

                            <div class="input-group">
                                <?php echo Form::text('security_pwd', $job_sheet->security_pwd, ['class' => 'form-control', 'placeholder' => __('lang_v1.password')]); ?>

                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary btn-flat" data-bs-toggle="modal" data-bs-target="#security_pattern">
                                        <i class="fas fa-lock"></i>
                                        <?php echo app('translator')->get('repair::lang.pattern_lock'); ?>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('product_configuration', __('repair::lang.product_configuration') . ':'); ?> <br>
                            <?php echo Form::textarea('product_configuration', $job_sheet->product_configuration, ['class' => 'tags-look', 'rows' => 4]); ?>


                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('defects', __('repair::lang.problem_reported_by_customer') . ':'); ?> <br>
                            <?php echo Form::textarea('defects', $job_sheet->defects, ['class' => 'tags-look', 'rows' => 4]); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('product_condition', __('repair::lang.condition_of_product') . ':'); ?> <br>
                            <?php echo Form::textarea('product_condition', $job_sheet->product_condition, ['class' => 'tags-look', 'rows' => 4]); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <?php if(in_array('service_staff' ,$enabled_modules)): ?>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <?php echo Form::label('service_staff', __('repair::lang.assign_service_staff') . ':'); ?>

                                <?php echo Form::select('service_staff', $technecians, $job_sheet->service_staff, ['class' => 'form-control select2', 'placeholder' => __('restaurant.select_service_staff')]); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('comment_by_ss', __('repair::lang.comment_by_ss') . ':'); ?>

                            <?php echo Form::textarea('comment_by_ss', $job_sheet->comment_by_ss, ['class' => 'form-control ', 'rows' => '3']); ?>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <?php echo Form::label('estimated_cost', __('repair::lang.estimated_cost') . ':'); ?>

                            <?php echo Form::text('estimated_cost', !empty($job_sheet->estimated_cost) ? number_format($job_sheet->estimated_cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : null, ['class' => 'form-control input_number', 'placeholder' => __('repair::lang.estimated_cost')]); ?>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="status_id"><?php echo e(__('sale.status') . ':*', false); ?></label>
                            <select name="status_id" class="form-control status" id="status_id" required>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('delivery_date', __('lang_v1.due_date') . ':'); ?>

                            <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('repair::lang.delivery_date_tooltip') . '"></i>';
                }
            ?>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <?php echo Form::text('delivery_date', !empty($job_sheet->delivery_date)? \Carbon::createFromTimestamp(strtotime($job_sheet->delivery_date))->format(session('business.date_format') . ' ' . 'h:i A') : null, ['class' => 'form-control', 'readonly']); ?>

                                <span class="input-group-text">
                                    <i class="fas fa-times-circle cursor-pointer clear_delivery_date"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <?php echo Form::label('images', __('repair::lang.document') . ':'); ?>

                            <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
                            <?php echo Form::file('images[]', ['id' => 'upload_job_sheet_image', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types'))), 'multiple']); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo app('translator')->get('repair::lang.send_notification'); ?></label> <br>
                            <div class="checkbox-inline">
                                <label class="cursor-pointer">
                                    <input type="checkbox" name="send_notification[]" value="sms">
                                    <?php echo app('translator')->get('repair::lang.sms'); ?>
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
                    <div class="clearfix"></div>
                    <div class="col-sm-4">
                    <div class="form-group">
                        <?php
                            $custom_field_1_label = !empty($repair_settings['job_sheet_custom_field_1']) ? $repair_settings['job_sheet_custom_field_1'] : __('lang_v1.custom_field', ['number' => 1])
                        ?>
                        <?php echo Form::label('custom_field_1', $custom_field_1_label . ':'); ?>

                        <?php echo Form::text('custom_field_1', $job_sheet->custom_field_1, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <?php
                            $custom_field_2_label = !empty($repair_settings['job_sheet_custom_field_2']) ? $repair_settings['job_sheet_custom_field_2'] : __('lang_v1.custom_field', ['number' => 2])
                        ?>
                        <?php echo Form::label('custom_field_2', $custom_field_2_label . ':'); ?>

                        <?php echo Form::text('custom_field_2', $job_sheet->custom_field_2, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <?php
                            $custom_field_3_label = !empty($repair_settings['job_sheet_custom_field_3']) ? $repair_settings['job_sheet_custom_field_3'] : __('lang_v1.custom_field', ['number' => 3])
                        ?>
                        <?php echo Form::label('custom_field_3', $custom_field_3_label . ':'); ?>

                        <?php echo Form::text('custom_field_3', $job_sheet->custom_field_3, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <?php
                            $custom_field_4_label = !empty($repair_settings['job_sheet_custom_field_4']) ? $repair_settings['job_sheet_custom_field_4'] : __('lang_v1.custom_field', ['number' => 4])
                        ?>
                        <?php echo Form::label('custom_field_4', $custom_field_4_label . ':'); ?>

                        <?php echo Form::text('custom_field_4', $job_sheet->custom_field_4, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <?php
                            $custom_field_5_label = !empty($repair_settings['job_sheet_custom_field_5']) ? $repair_settings['job_sheet_custom_field_5'] : __('lang_v1.custom_field', ['number' => 5])
                        ?>
                        <?php echo Form::label('custom_field_5', $custom_field_5_label . ':'); ?>

                        <?php echo Form::text('custom_field_5', $job_sheet->custom_field_5, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-sm-12 text-right">
                    <input type="hidden" name="submit_type" id="submit_type">
                    <button type="submit" class="btn btn-success submit_button" value="save_and_add_parts" id="save_and_add_parts">
                        <?php echo app('translator')->get('repair::lang.save_and_add_parts'); ?>
                    </button>
                    <button type="submit" class="btn btn-primary submit_button" value="submit" id="save">
                        <?php echo app('translator')->get('messages.save'); ?>
                    </button>
                    <button type="submit" class="btn btn-info submit_button" value="save_and_upload_docs" id="save_and_upload_docs">
                        <?php echo app('translator')->get('repair::lang.save_and_upload_docs'); ?>
                    </button>
                </div>
                </div>
            </div>
        </div>
    <?php echo Form::close(); ?> <!-- /form close -->
    <div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        <?php echo $__env->make('contact.create', ['quick_add' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <?php echo $__env->make('repair::job_sheet.tagify_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script src="<?php echo e(asset('js/pos.js?v=' . $asset_v), false); ?>"></script>
    <script type="text/javascript">
        $(document).ready( function() {
            $('.submit_button').click( function(){
                $('#submit_type').val($(this).attr('value'));
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
              text: '<?php echo app('translator')->get("messages.please_select"); ?>',
              html: '<?php echo app('translator')->get("messages.please_select"); ?>',
              is_complete : '0',
            }, 
            <?php $__currentLoopData = $repair_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $repair_status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                {
                id: <?php echo e($repair_status->id, false); ?>,
                is_complete : '<?php echo e($repair_status->is_completed_status, false); ?>',
                <?php if(!empty($repair_status->color)): ?>
                    text: '<i class="fa fa-circle" aria-hidden="true" style="color: <?php echo e($repair_status->color, false); ?>;"></i> <?php echo e($repair_status->name, false); ?>',
                    title: '<?php echo e($repair_status->name, false); ?>'
                <?php else: ?>
                    text: "<?php echo e($repair_status->name, false); ?>"
                <?php endif; ?>
                },
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ];

            $("select#status_id").select2({
                data: data,
                escapeMarkup: function(markup) {
                    return markup;
                },
                 templateSelection: function (data, container) {
                    $(data.element).attr('data-is_complete', data.is_complete);
                    return data.text;
                }
            });

            <?php if(!empty($job_sheet->status_id)): ?>
                $("select#status_id").val(<?php echo e($job_sheet->status_id, false); ?>).change();
            <?php elseif(!empty($default_status)): ?>
                $("select#status_id").val(<?php echo e($default_status, false); ?>).change();
            <?php endif; ?>

            $('#delivery_date').datetimepicker({
                format: moment_date_format + ' ' + moment_time_format,
                ignoreReadonly: true,
            });

            $(document).on('click', '.clear_delivery_date', function() {
                $('#delivery_date').data("DateTimePicker").clear();
            });

            var lock = new PatternLock("#pattern_container", {
                onDraw:function(pattern){
                    $('input#security_pattern').val(pattern);
                },
                enableSetPattern: true
            });

            <?php if(!empty($job_sheet->security_pattern)): ?>
                lock.setPattern("<?php echo e($job_sheet->security_pattern, false); ?>");
            <?php endif; ?>

            //filter device model id based on brand & device
            $(document).on('change', '#brand_id', function() {
                getModelForDevice();
                getModelRepairChecklists();
            });

            // get models for particular device
            $(document).on('change', '#device_id', function() {
                getModelForDevice();
            });
            
            $(document).on('change', '#device_model_id', function() {
                getModelRepairChecklists();
            });

            function getModelForDevice() {
                var data = {
                    device_id : $("#device_id").val(),
                    brand_id: $("#brand_id").val()
                };

                $.ajax({
                    method: 'GET',
                    url: '/repair/get-device-models',
                    dataType: 'html',
                    data: data,
                    success: function(result) {
                        $('select#device_model_id').html(result);
                    }
                });
            }

            function getModelRepairChecklists() {
                var data = {
                        model_id : $("#device_model_id").val(),
                        job_sheet_id : $("#job_sheet_id").val()
                    };
                $.ajax({
                    method: 'GET',
                    url: '/repair/models-repair-checklist',
                    dataType: 'html',
                    data: data,
                    success: function(result) {
                        $(".append_checklists").html(result);
                    }
                });
            }

            getModelRepairChecklists();

            $('input[type=radio][name=service_type]').on('change', function(){
              if ($(this).val() == 'pick_up' || $(this).val() == 'on_site') {
                $("div.pick_up_onsite_addr").show();
              } else {
                $("div.pick_up_onsite_addr").hide();
              }
            });

            //initialize file input
            $('#upload_job_sheet_image').fileinput({
                showUpload: false,
                showPreview: false,
                browseLabel: '',
                removeLabel: '',
                cancelLabel: ''
            });

            //initialize tags input (tagify)
            var product_configuration = document.querySelector('textarea#product_configuration');
            tagify_pc = new Tagify(product_configuration, {
              whitelist: <?php echo json_encode($product_conf); ?>,
              maxTags: 100,
              dropdown: {
                maxItems: 100,           // <- mixumum allowed rendered suggestions
                classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
                enabled: 0,             // <- show suggestions on focus
                closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
              }
            });

            var product_defects = document.querySelector('textarea#defects');
            tagify_pd = new Tagify(product_defects, {
              whitelist: <?php echo json_encode($defects); ?>,
              maxTags: 100,
              dropdown: {
                maxItems: 100,           // <- mixumum allowed rendered suggestions
                classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
                enabled: 0,             // <- show suggestions on focus
                closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
              }
            });

            var product_condition = document.querySelector('textarea#product_condition');
            tagify_p_condition = new Tagify(product_condition, {
              whitelist: <?php echo json_encode($product_cond); ?>,
              maxTags: 100,
              dropdown: {
                maxItems: 100,           // <- mixumum allowed rendered suggestions
                classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
                enabled: 0,             // <- show suggestions on focus
                closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
              }
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
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>