<?php
    $page_size = '210mm 297mm';
    $sheet_width = '210mm';
    $sheet_min_height = '297mm';
    $settings = json_decode($business->hms_settings ?? '{}') ?: (object) [];
    $pdf_settings = $settings->booking_pdf ?? (object) [];
    $logo_path = session('business.logo');
    $total_paid = (float) ($transaction->total_paid ?? 0);
    $total_due = max(0, (float) $transaction->final_total - $total_paid);
    $generated_at = format_datetime_br(now());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(__('hms::lang.booking'), false); ?> <?php echo e($transaction->ref_no, false); ?></title>
    <?php echo $__env->make('report.partials.crystal_report_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        .booking-print .cr-head { margin-bottom: 12px; }
        .booking-print .cr-filters { border-bottom: 1px solid #c9cdd1; padding-bottom: 8px; }
        .booking-print .cr-group-title { border-bottom: 1px solid #d5d9dc; margin-top: 10px; }
        .booking-print .cr-info-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px 20px;
            padding: 10px 8px;
            border: 1px solid #d2d2d2;
        }
        .booking-print .cr-info-item { display: flex; gap: 6px; min-width: 0; }
        .booking-print .cr-info-item b { min-width: 120px; }
        .booking-print .cr-info-item span { overflow-wrap: anywhere; }
        .booking-print .cr-table { margin-bottom: 8px; }
        .booking-print .cr-table th,
        .booking-print .cr-table td { white-space: normal; }
        .booking-print .cr-summary { margin: 12px 0 0 auto; width: min(100%, 340px); border: 1px solid #c7cbd0; }
        .booking-print .cr-summary-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 7px 10px;
            border-bottom: 1px solid #e0e0e0;
        }
        .booking-print .cr-summary-row:last-child { border-bottom: 0; }
        .booking-print .cr-summary-row.total { font-weight: 800; background: #e8e8e8; }
        .booking-print .cr-empty { padding: 12px; font-size: 9pt; }
        @media (max-width: 700px) {
            .booking-print .cr-info-grid { grid-template-columns: 1fr; }
            .booking-print .cr-info-item b { min-width: 105px; }
        }
        @media print {
            @page { size: <?php echo e($page_size, false); ?>; margin: 5mm; }
            html,
            body { width: 100%; margin: 0; }
            .booking-print {
                display: block !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            .booking-print .cr-sheet {
                width: 100% !important;
                max-width: none !important;
                min-height: auto;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <div class="cr-toolbar">
        <span class="cr-title"><?php echo e(__('hms::lang.booking'), false); ?> - <?php echo e($transaction->ref_no, false); ?></span>
        <div class="cr-group">
            <button class="cr-btn primary" id="printBtn" type="button">&#128424; <?php echo e(__('messages.print'), false); ?> A4</button>
            <button class="cr-btn" id="closeBtn" type="button">&times; <?php echo e(__('messages.close'), false); ?></button>
        </div>
    </div>

    <main class="cr-stage booking-print">
        <article class="cr-sheet">
            <header class="cr-head">
                <div class="cr-head-left">
                    <?php if($logo_path): ?>
                        <img class="cr-logo" src="<?php echo e(asset('uploads/business_logos/' . $logo_path), false); ?>" alt="<?php echo e($business->name, false); ?>">
                    <?php endif; ?>
                    <div>
                        <div class="cr-biz-name"><?php echo e($business->name, false); ?></div>
                        <?php if($location): ?>
                            <div class="cr-biz-loc"><?php echo e($location->name, false); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="cr-head-right">
                    <div class="cr-report-title"><?php echo e(__('hms::lang.booking'), false); ?></div>
                    <div class="cr-report-sub"><?php echo e(__('hms::lang.booking_Id'), false); ?>: <?php echo e($transaction->ref_no, false); ?></div>
                    <div class="cr-report-sub"><?php echo e(__('messages.date'), false); ?>: <?php echo $generated_at; ?></div>
                </div>
            </header>

            <div class="cr-filters">
                <?php if(!empty($pdf_settings->address)): ?>
                    <span class="f-item"><b><?php echo e(__('hms::lang.address'), false); ?>:</b> <?php echo e($pdf_settings->address, false); ?></span>
                <?php endif; ?>
                <?php if(!empty($pdf_settings->phone)): ?>
                    <span class="f-item"><b><?php echo e(__('contact.contact'), false); ?>:</b> <?php echo e($pdf_settings->phone, false); ?></span>
                <?php endif; ?>
                <?php if(!empty($pdf_settings->email)): ?>
                    <span class="f-item"><b><?php echo e(__('hms::lang.email'), false); ?>:</b> <?php echo e($pdf_settings->email, false); ?></span>
                <?php endif; ?>
            </div>

            <h2 class="cr-group-title"><?php echo e(__('hms::lang.booking'), false); ?> <?php echo e(__('lang_v1.details'), false); ?></h2>
            <section class="cr-info-grid">
                <div class="cr-info-item"><b><?php echo e(__('sale.customer_name'), false); ?>:</b><span><?php echo e($transaction->contact->name ?? '', false); ?></span></div>
                <div class="cr-info-item"><b><?php echo e(__('hms::lang.status'), false); ?>:</b><span><?php echo e(ucfirst($transaction->status), false); ?></span></div>
                <div class="cr-info-item"><b><?php echo e(__('contact.mobile'), false); ?>:</b><span><?php echo e($transaction->contact->mobile ?? '—', false); ?></span></div>
                <div class="cr-info-item"><b><?php echo e(__('hms::lang.payment_status'), false); ?>:</b><span><?php echo e(ucfirst($transaction->payment_status ?? ''), false); ?></span></div>
                <div class="cr-info-item"><b><?php echo e(__('hms::lang.arrival_date_time'), false); ?>:</b><span><?php echo format_datetime_br($transaction->hms_booking_arrival_date_time); ?></span></div>
                <div class="cr-info-item"><b><?php echo e(__('hms::lang.departure_date_time'), false); ?>:</b><span><?php echo format_datetime_br($transaction->hms_booking_departure_date_time); ?></span></div>
                <?php if(!empty($transaction->contact->email)): ?>
                    <div class="cr-info-item"><b><?php echo e(__('hms::lang.email'), false); ?>:</b><span><?php echo e($transaction->contact->email, false); ?></span></div>
                <?php endif; ?>
                <?php if(!empty($transaction->coupon_code)): ?>
                    <div class="cr-info-item"><b><?php echo e(__('hms::lang.coupon_code'), false); ?>:</b><span><?php echo e($transaction->coupon_code, false); ?></span></div>
                <?php endif; ?>
            </section>

            <h2 class="cr-group-title"><?php echo e(__('hms::lang.rooms'), false); ?></h2>
            <?php if($booking_rooms->isNotEmpty()): ?>
                <table class="cr-table">
                    <thead><tr>
                        <th><?php echo e(__('hms::lang.type'), false); ?></th>
                        <th><?php echo e(__('hms::lang.room_no'), false); ?></th>
                        <th class="c"><?php echo e(__('hms::lang.no_of_adult'), false); ?></th>
                        <th class="c"><?php echo e(__('hms::lang.no_of_child'), false); ?></th>
                        <th class="r"><?php echo e(__('hms::lang.price'), false); ?></th>
                    </tr></thead>
                    <tbody>
                    <?php $__currentLoopData = $booking_rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($room->type, false); ?></td>
                            <td><?php echo e($room->room_number, false); ?></td>
                            <td class="c"><?php echo e($room->adults, false); ?></td>
                            <td class="c"><?php echo e($room->childrens, false); ?></td>
                            <td class="r"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $room->total_price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="cr-empty">—</div>
            <?php endif; ?>

            <h2 class="cr-group-title"><?php echo e(__('hms::lang.extras'), false); ?></h2>
            <?php if($booking_extras->isNotEmpty()): ?>
                <table class="cr-table">
                    <thead><tr>
                        <th><?php echo e(__('hms::lang.name'), false); ?></th>
                        <th>Rate basis</th>
                        <th class="r"><?php echo e(__('hms::lang.price'), false); ?></th>
                    </tr></thead>
                    <tbody>
                    <?php $__currentLoopData = $booking_extras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($extra->name, false); ?></td>
                            <td><?php echo e(str_replace('_', ' ', $extra->price_per ?? ''), false); ?></td>
                            <td class="r"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $extra->price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="cr-empty">—</div>
            <?php endif; ?>

            <section class="cr-summary">
                <div class="cr-summary-row"><span><?php echo e(__('hms::lang.room_price'), false); ?></span><b><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $transaction->room_price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></b></div>
                <div class="cr-summary-row"><span><?php echo e(__('hms::lang.extra_price'), false); ?></span><b><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $transaction->extra_price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></b></div>
                <div class="cr-summary-row"><span><?php echo e(__('hms::lang.discount'), false); ?></span><b><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $transaction->discount_amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></b></div>
                <div class="cr-summary-row total"><span><?php echo e(__('hms::lang.total'), false); ?></span><b><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $transaction->final_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></b></div>
                <div class="cr-summary-row"><span><?php echo e(__('hms::lang.total_paid'), false); ?></span><b><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_paid, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></b></div>
                <div class="cr-summary-row total"><span><?php echo e(__('hms::lang.due'), false); ?></span><b><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_due, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></b></div>
            </section>

            <?php if(!empty($pdf_settings->footer_text)): ?>
                <footer class="cr-foot"><span><?php echo nl2br(e($pdf_settings->footer_text)); ?></span></footer>
            <?php endif; ?>
        </article>
    </main>

    <script>
        var returnToIndex = <?php echo json_encode(request()->boolean('return_to_index'), 15, 512) ?>;
        var bookingIndexUrl = <?php echo json_encode(action([\Modules\Hms\Http\Controllers\HmsBookingController::class, 'index']), 512) ?>;
        function returnToBookingIndex() {
            if (returnToIndex) {
                window.location.assign(bookingIndexUrl);
            }
        }

        document.getElementById('printBtn').addEventListener('click', function () { window.print(); });
        document.getElementById('closeBtn').addEventListener('click', function () {
            if (returnToIndex) {
                returnToBookingIndex();
                return;
            }
            if (window.history.length > 1) { window.history.back(); } else { window.close(); }
        });
        if (returnToIndex) {
            window.addEventListener('afterprint', returnToBookingIndex);
        }
        <?php if(request()->boolean('auto_print')): ?>
            window.addEventListener('load', function () { window.setTimeout(function () { window.print(); }, 400); });
        <?php endif; ?>
    </script>
</body>
</html>
