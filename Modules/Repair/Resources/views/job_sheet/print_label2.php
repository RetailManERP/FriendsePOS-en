<link rel="stylesheet" href="<?php echo e(asset('css/app.css?v='.$asset_v), false); ?>">
<style type="text/css">
    .box {
        /* border: 1px solid; */
    }

    .table-pdf {
        width: 100%;
    }

    .table-pdf td,
    .table-pdf th {
        padding: 6px;
        text-align: left;
    }

    .w-20 {
        width: 20%;
        float: left;
    }

    .checklist {
        padding: 5px 15px;
        width: 100%;
    }

    .checkbox {
        width: 20%;
        float: left;
    }

    .checkbox-text {
        width: 80%;
        float: left;
    }

    .content-div {
        padding: 6px;
    }

    .table-slim {
        width: 100%;
    }

    .table-slim td,
    .table-slim th {
        padding: 1px !important;
        font-size: 12px;
    }

    .font-14 {
        font-size: 14px;
    }

    .font-12 {
        font-size: 12px;
    }

    body {
        font-size: 11px;
        font-family: Arial Black;
    }
</style>
<?php
$custom_labels = json_decode(session('business.custom_labels'), true);
$contact_custom_fields = !empty($jobsheet_settings['contact_custom_fields']) ?
$jobsheet_settings['contact_custom_fields'] : [];
?>
<div class="width-100 box mb-10">

    <div class="width-100" align="center">
        <p style="text-align: center;">
            <strong class="font-14">
                <?php echo e($job_sheet->customer->business->name, false); ?><br>
            </strong>

            <?php if(!empty($jobsheet_settings['show_location_in_label']) && 
            ($job_sheet->customer->business->name != $job_sheet->businessLocation->name)): ?>
            <span class="font-12">
                <?php echo $job_sheet->businessLocation->name; ?> <br>
            </span>
            <?php endif; ?>

            <?php if(!empty($jobsheet_settings['show_barcode_in_label'])): ?>
            <span align="center">
                <img src="data:image/png;base64,<?php echo e(DNS1D::getBarcodePNG($job_sheet->job_sheet_no, 'C128', 1,30,array(39, 48, 10), true), false); ?>"><br>
            </span>
            <?php endif; ?>

            <span class="font-12">
                <b><?php echo app('translator')->get('repair::lang.job_sheet_no'); ?>: <?php echo e($job_sheet->job_sheet_no, false); ?></b><br>
            </span>
            <?php if(!empty($jobsheet_settings['show_brand_in_label'])): ?>
                <span class="font-12">
                    <b><?php echo e($job_sheet->brand?->name, false); ?> <?php echo e($job_sheet->deviceModel?->name, false); ?></b><br>
                </span>
            <?php endif; ?>

            <?php if(!empty($jobsheet_settings['show_password_in_label']) && !empty($job_sheet->security_pwd)): ?>
            <span class="font-12">
                <b><?php echo app('translator')->get('lang_v1.password'); ?>: <?php echo e($job_sheet->security_pwd, false); ?></b><br>
            </span>
            <?php endif; ?>

            <?php if(!empty($job_sheet->security_pattern)): ?>
            <span class="font-12">
                <b><?php echo app('translator')->get('repair::lang.security_pattern_code'); ?>: <?php echo e($job_sheet->security_pattern, false); ?></b><br>
            </span>
            <?php endif; ?>
            <?php if(!empty($jobsheet_settings['show_problem_in_label'])): ?>
                <span class="font-12">
                    <b><?php echo app('translator')->get('repair::lang.problem'); ?>:
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
                    </b>
                    <br>
                </span>
            <?php endif; ?>
            <?php if(!empty($jobsheet_settings['show_sales_person_in_label'])): ?>
                <span class="font-12">
                    <b><?php echo app('translator')->get('repair::lang.sales_person'); ?>: <?php echo e($job_sheet->createdBy->user_full_name, false); ?></b><br>
                </span>
            <?php endif; ?>
            <?php if(!empty($jobsheet_settings['show_status_in_label'])): ?>
                <span class="font-12">
                    <b><?php echo app('translator')->get('sale.status'); ?>: <?php echo e($job_sheet->status->name ?? '', false); ?></b><br>
                </span>
            <?php endif; ?>
            <?php if(!empty($jobsheet_settings['show_due_date_in_label'])): ?>
                <span class="font-12">
                    <b><?php echo app('translator')->get('lang_v1.due_date'); ?>: <?php if(!empty($job_sheet->delivery_date)): ?>
                    <?php echo format_datetime_br($job_sheet->delivery_date); ?></b><br><?php endif; ?>
                </span>
            <?php endif; ?>
            <br>
            <?php if(!empty($jobsheet_settings['show_technician_in_label']) && !empty($job_sheet->service_staff)): ?>
                <span class="font-12">
                    <b><?php echo app('translator')->get('repair::lang.technician'); ?>: <?php echo e($job_sheet->technician->user_full_name ?? '', false); ?></b><br>
                </span>
            <?php endif; ?>
            <?php if(!empty($jobsheet_settings['show_technician_in_label'])): ?>
                <span class="font-12">
                    <b><?php echo app('translator')->get('repair::lang.technician'); ?>: <?php echo e($job_sheet->sale_commission_agent->user_full_name ?? '', false); ?></b><br>
                </span>
            <?php endif; ?>
            <?php if(!empty($jobsheet_settings['show_sr_no_in_label'])): ?>
                <span class="font-12">
                    <b><?php echo app('translator')->get('repair::lang.imei_sr_no'); ?>: <?php echo e($job_sheet->serial_no ?? '', false); ?></b><br>
                </span>
            <?php endif; ?>

            <?php if(!empty($jobsheet_settings['show_customer_name_in_label'])): ?>
                <span class="font-12">
                    <b><?php echo app('translator')->get('contact.customer'); ?>:
                    <?php echo e($job_sheet->customer->name, false); ?></b><br>
                </span>
            <?php endif; ?>

            <?php if(!empty($jobsheet_settings['show_customer_address_in_label'])): ?>
                <span class="font-12">
                    <b><?php echo implode(', ', $job_sheet->customer->contact_address_array); ?></b><br>
                </span>
            <?php endif; ?>
            <?php if(!empty($jobsheet_settings['show_customer_phone_in_label'])): ?>
                <span class="font-12">
                    <b><?php echo e($job_sheet->customer->mobile, false); ?>,</b>
                </span>
            <?php endif; ?>
            <?php if(!empty($jobsheet_settings['show_customer_alt_phone_in_label'])): ?>
                <span class="font-12">
                <b><?php echo e($job_sheet->customer->alternate_number, false); ?></b>
                </span>
            <?php endif; ?>
            <?php if(!empty($jobsheet_settings['show_customer_email_in_label'])): ?>
                <span class="font-12">
                    </b><?php echo e($job_sheet->customer->email, false); ?></b>
                </span>
            <?php endif; ?>
        </p>
    </div>
</div>
