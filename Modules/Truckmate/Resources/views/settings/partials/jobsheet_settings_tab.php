<?php echo Form::open(['action' => '\Modules\Truckmate\Http\Controllers\TruckmateSettingsController@updateJobsheetSettings', 'method' => 'post', 'id' => 'jobsheet_settings_form']); ?>

<?php
$custom_labels = json_decode(session('business.custom_labels'), true);
$contact_custom_fields = !empty($jobsheet_pdf_settings['contact_custom_fields']) ? $jobsheet_pdf_settings['contact_custom_fields'] : [];
?>
<div class="row">
    <div class="col-sm-12">
        <h3><?php echo app('translator')->get('truckmate::lang.job_sheet_pdf'); ?>:</h3>
    </div>

    <div class="col-sm-12">
        <h4><?php echo app('translator')->get('lang_v1.fields_for_customer_details'); ?>:</h4>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo Form::checkbox('show_customer', 1, !empty($jobsheet_pdf_settings['show_customer']), ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('invoice.show_customer'); ?></label>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <?php echo Form::label('customer_label', __('invoice.customer_label') . ':' ); ?>

            <?php echo Form::text('customer_label', $jobsheet_pdf_settings['customer_label'] ?? null, ['class' => 'form-control',
            'placeholder' => __('invoice.customer_label') ]); ?>

        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo Form::checkbox('show_client_id', 1, !empty($jobsheet_pdf_settings['show_client_id']), ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.show_client_id'); ?></label>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <?php echo Form::label('client_id_label', __('lang_v1.client_id_label') . ':' ); ?>

            <?php echo Form::text('client_id_label', $jobsheet_pdf_settings['client_id_label'] ?? null, ['class' => 'form-control',
            'placeholder' => __('lang_v1.client_id_label') ]); ?>

        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <?php echo Form::label('client_tax_label', __('lang_v1.client_tax_label') . ':' ); ?>

            <?php echo Form::text('client_tax_label', $jobsheet_pdf_settings['client_tax_label'] ?? null, ['class' => 'form-control',
            'placeholder' => __('lang_v1.client_tax_label') ]); ?>

        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo Form::checkbox('contact_custom_fields[]', 'custom_field1', in_array('custom_field1', $contact_custom_fields), ['class' => 'form-check-input']); ?> <?php echo e($custom_labels['contact']['custom_field_1'] ?? __('lang_v1.contact_custom_field1'), false); ?></label>
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo Form::checkbox('contact_custom_fields[]', 'custom_field2', in_array('custom_field2', $contact_custom_fields), ['class' => 'form-check-input']); ?> <?php echo e($custom_labels['contact']['custom_field_2'] ?? __('lang_v1.contact_custom_field2'), false); ?></label>
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo Form::checkbox('contact_custom_fields[]', 'custom_field3', in_array('custom_field3', $contact_custom_fields), ['class' => 'form-check-input']); ?> <?php echo e($custom_labels['contact']['custom_field_3'] ?? __('lang_v1.contact_custom_field3'), false); ?></label>
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo Form::checkbox('contact_custom_fields[]', 'custom_field4', in_array('custom_field4', $contact_custom_fields), ['class' => 'form-check-input']); ?> <?php echo e($custom_labels['contact']['custom_field_4'] ?? __('lang_v1.contact_custom_field4'), false); ?></label>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <h3><?php echo app('translator')->get('truckmate::lang.job_sheet_label'); ?>:</h3>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <?php echo Form::label('truckmate::lang.label_width', __('truckmate::lang.label_width') . '(MM):' ); ?>

            <?php echo Form::text('label_width', $jobsheet_pdf_settings['label_width'] ?? 75, ['class' => 'form-control',
            'placeholder' => __('truckmate::lang.label_width') ]); ?>

        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <?php echo Form::label('truckmate::lang.label_height', __('truckmate::lang.label_height') . '(MM):' ); ?>

            <?php echo Form::text('label_height', $jobsheet_pdf_settings['label_height'] ?? 50, ['class' => 'form-control',
            'placeholder' => __('truckmate::lang.label_height') ]); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <h4><?php echo app('translator')->get('truckmate::lang.customer_information'); ?>:</h4>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo Form::checkbox('show_customer_name_in_label', 1, 
                        !empty($jobsheet_pdf_settings['show_customer_name_in_label']), 
                        ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('sale.customer_name'); ?></label>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo Form::checkbox('show_customer_address_in_label', 1, 
                        !empty($jobsheet_pdf_settings['show_customer_address_in_label']), 
                        ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('truckmate::lang.customer_address'); ?></label>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo Form::checkbox('show_customer_phone_in_label', 1, 
                        !empty($jobsheet_pdf_settings['show_customer_phone_in_label']), 
                        ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('truckmate::lang.customer_phone'); ?></label>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo Form::checkbox('show_customer_alt_phone_in_label', 1, 
                        !empty($jobsheet_pdf_settings['show_customer_alt_phone_in_label']), 
                        ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('truckmate::lang.alt_phone'); ?></label>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo Form::checkbox('show_customer_email_in_label', 1, 
                        !empty($jobsheet_pdf_settings['show_customer_email_in_label']), 
                        ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.customer_email'); ?></label>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <h4><?php echo app('translator')->get('truckmate::lang.label_details'); ?>:</h4>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo Form::checkbox('show_sales_person_in_label', 1, 
                        !empty($jobsheet_pdf_settings['show_sales_person_in_label']), 
                        ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('truckmate::lang.sales_person'); ?></label>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo Form::checkbox('show_barcode_in_label', 1, 
                        !empty($jobsheet_pdf_settings['show_barcode_in_label']), 
                        ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('truckmate::lang.barcode'); ?></label>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo Form::checkbox('show_status_in_label', 1, 
                        !empty($jobsheet_pdf_settings['show_status_in_label']), 
                        ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('sale.status'); ?></label>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo Form::checkbox('show_due_date_in_label', 1, 
                        !empty($jobsheet_pdf_settings['show_due_date_in_label']), 
                        ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.due_date'); ?></label>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <h4><?php echo app('translator')->get('truckmate::lang.label_information'); ?>:</h4>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo Form::checkbox('show_technician_in_label', 1, 
                        !empty($jobsheet_pdf_settings['show_technician_in_label']), 
                        ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('truckmate::lang.technician'); ?></label>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo Form::checkbox('show_problem_in_label', 1, 
                        !empty($jobsheet_pdf_settings['show_problem_in_label']), 
                        ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('truckmate::lang.problem'); ?></label>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <h4><?php echo app('translator')->get('truckmate::lang.device_info'); ?>:</h4>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo Form::checkbox('show_sr_no_in_label', 1, 
                        !empty($jobsheet_pdf_settings['show_sr_no_in_label']), 
                        ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('truckmate::lang.imei_sr_no'); ?></label>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo Form::checkbox('show_brand_in_label', 1, 
                        !empty($jobsheet_pdf_settings['show_brand_in_label']), 
                        ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('truckmate::lang.brand_model'); ?></label>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo Form::checkbox('show_location_in_label', 1, 
                        !empty($jobsheet_pdf_settings['show_location_in_label']), 
                        ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('sale.location'); ?></label>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?php echo Form::checkbox('show_password_in_label', 1, 
                        !empty($jobsheet_pdf_settings['show_password_in_label']), 
                        ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.password'); ?></label>
            </div>
        </div>
    </div>
</div>

<?php echo Form::close(); ?>