<link rel="stylesheet" href="<?php echo e(asset('css/app.css?v=' . $asset_v), false); ?>">
<style type="text/css">
    .box {
        border: 1px solid;
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
    }
</style>
<?php
    $settings = json_decode($business->hms_settings);
?>
<div class="width-100 box mb-10">
    <?php if(!empty(Session::get('business.logo'))): ?>
        <div class="f-left" style="width:25%">
            <img src="<?php echo e(asset('uploads/business_logos/' . Session::get('business.logo')), false); ?>" alt="Logo"
                style="width: auto; max-height: 90px; margin: auto;">
        </div>
    <?php endif; ?>
    <div class="f-left" align="center" style="width:25%">
        <p style="text-align: center;">
            <strong class="font-14">
                <?php echo e($business->name, false); ?>

            </strong>
        </p>
    </div>

    <?php if(!empty($settings->booking_pdf->address)): ?>
        <div class="f-left" align="center" style="width:25%">
            <p style="text-align: left;">
                <strong><?php echo nl2br(e($settings->booking_pdf->address)); ?></strong>
            </p>
        </div>
    <?php endif; ?>
    <div class="f-left" align="center" style="width:25%">
        <p style="text-align: left;">
            <?php if(!empty($settings->booking_pdf->phone)): ?>
                <strong style="font-size: 10px;">
                    <?php echo app('translator')->get('contact.contact'); ?>: <?php echo e($settings->booking_pdf->phone, false); ?>

                </strong>
            <?php endif; ?>
            <?php if(!empty($settings->booking_pdf->email)): ?>
                <br>
                <strong style="font-size: 10px">
                    <?php echo app('translator')->get('hms::lang.email'); ?>: <?php echo e($settings->booking_pdf->email, false); ?>

                </strong>
            <?php endif; ?>

            <?php if(!empty($settings->booking_pdf->website)): ?>
                <br>
                <strong style="font-size: 10px;">
                    <?php echo app('translator')->get('hms::lang.website'); ?>: <?php echo e($settings->booking_pdf->website, false); ?>

                </strong>
            <?php endif; ?>
        </p>
    </div>
</div>
<div class="width-100 box mb-10">
    <table class="no-border table-pdf">
        <tr>
            <th><?php echo app('translator')->get('hms::lang.booking_Id'); ?>:</th>
            <th><?php echo app('translator')->get('hms::lang.arrival_date_time'); ?>:</th>
            <th><?php echo app('translator')->get('hms::lang.departure_date_time'); ?>:</th>

            <?php if(!empty($transaction->check_in)): ?>
                <th><?php echo app('translator')->get('hms::lang.check_in'); ?>:</th>
            <?php endif; ?>

            <?php if(!empty($transaction->check_out)): ?>
                <th><?php echo app('translator')->get('hms::lang.check_out'); ?>:</th>
            <?php endif; ?>

            <th><?php echo app('translator')->get('hms::lang.status'); ?>:</th>
        </tr>
        <tr>
            <td style="padding-top: 8">
                <?php echo e($transaction->ref_no, false); ?>

            </td>
            <td style="padding-top: 8">
                <?php echo format_datetime_br($transaction->hms_booking_arrival_date_time); ?>

            </td>
            <td style="padding-top: 8">
                <?php echo format_datetime_br($transaction->hms_booking_departure_date_time); ?>

            </td>
            <?php if(!empty($transaction->check_in)): ?>
                <td style="padding-top: 8">
                    <?php echo format_datetime_br($transaction->check_in); ?>

                </td>
            <?php endif; ?>
            <?php if(!empty($transaction->check_out)): ?>
                <td style="padding-top: 8">
                    <?php echo format_datetime_br($transaction->check_out); ?>

                </td>
            <?php endif; ?>
            <td style="padding-top: 8">
                <?php echo e(ucfirst($transaction->status), false); ?>

            </td>
        </tr>
    </table>
</div>
<div class="box mb-10">
    <table class="table-pdf">
        <tr>
            <td colspan="2" style="vertical-align: top;">
                <table class="width-100">
                    <tr>
                        <th><?php echo app('translator')->get('sale.customer_name'); ?>:</th>
                        <td><?php echo e($transaction->contact->name, false); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo app('translator')->get('hms::lang.address'); ?>:</th>
                        <td>
                            <?php if($transaction->contact->landmark): ?>
                                <?php echo e($transaction->contact->landmark, false); ?>,
                            <?php endif; ?>

                            <?php echo e($transaction->contact->city, false); ?>


                            <?php if($transaction->contact->state): ?>
                                <?php echo e(', ' . $transaction->contact->state, false); ?>

                            <?php endif; ?>
                            <br>
                            <?php if($transaction->contact->country): ?>
                                <?php echo e($transaction->contact->country, false); ?>

                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php if($transaction->contact->mobile): ?>
                        <tr>
                            <th><?php echo app('translator')->get('contact.mobile'); ?>:</th>
                            <td><?php echo e($transaction->contact->mobile, false); ?></td>
                        </tr>
                    <?php endif; ?>
                    <?php if($transaction->contact->alternate_number): ?>
                        <tr>
                            <th><?php echo app('translator')->get('contact.alternate_contact_number'); ?>:</th>
                            <td><?php echo e($transaction->contact->alternate_number, false); ?></td>
                        </tr>
                    <?php endif; ?>
                    <?php if($transaction->contact->landline): ?>
                        <tr>
                            <th><?php echo app('translator')->get('contact.landline'); ?>:</th>
                            <td><?php echo e($transaction->contact->alternate_number, false); ?></td>
                        </tr>
                    <?php endif; ?>
                </table>
            </td>
        </tr>
    </table>
</div>

<div class="width-100 box mb-10">
    <table class="no-border table-pdf">
        <thead>
            <tr>
                <th><?php echo app('translator')->get('hms::lang.rooms'); ?></th>
            </tr>
        </thead>
        <tr>
            <th><?php echo app('translator')->get('hms::lang.type'); ?></th>
            <th><?php echo app('translator')->get('hms::lang.room_no'); ?></th>
            <th><?php echo app('translator')->get('hms::lang.no_of_adult'); ?></th>
            <th><?php echo app('translator')->get('hms::lang.no_of_child'); ?></th>
            <th><?php echo app('translator')->get('hms::lang.price'); ?></th>
        </tr>
        <?php $__currentLoopData = $booking_rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td style="padding-top: 8">
                    <?php echo e($room->type, false); ?>


                </td>
                <td style="padding-top: 8">
                    <?php echo e($room->room_number, false); ?>

                </td>
                <td style="padding-top: 8">
                    <?php echo e($room->adults, false); ?>

                </td>
                <td style="padding-top: 8">
                    <?php echo e($room->childrens, false); ?>

                </td>
                <td style="padding-top: 8">
                    <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $room->total_price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</div>
<div class="width-100 box mb-10">
    <table class="no-border table-pdf">
        <thead>
            <tr>
                <th><?php echo app('translator')->get('hms::lang.extras'); ?></th>
            </tr>
        </thead>
        <?php $__currentLoopData = $extras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $extra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(in_array($extra->id, $extras_id)): ?>
                <tr>
                    <td>
                        <?php echo e($extra->name, false); ?> / <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $extra->price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> - <?php echo e(str_replace('_', ' ', $extra->price_per), false); ?>

                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</div>

<?php
    $discount_percent_disable = 0;
    if (!empty($transaction->hms_coupon_id)) {
        $discount_percent_disable = 1;
    }
?>

<div class="width-100 box mb-10">
    <table class="no-border table-pdf">
        <tr>
            <th><?php echo app('translator')->get('hms::lang.room_price'); ?>:</th>
            <th><?php echo app('translator')->get('hms::lang.extra_price'); ?>:</th>
            <?php if($discount_percent_disable == 0 && $transaction->discount_amount > 0): ?>
                <th><?php echo app('translator')->get('hms::lang.discount'); ?>: (<?php echo e(number_format($transaction->discount_amount, 2), false); ?> % )</th>
            <?php else: ?>
                <th><?php echo app('translator')->get('hms::lang.discount'); ?>:</th>
            <?php endif; ?>
            <th><?php echo app('translator')->get('hms::lang.total'); ?>:</th>
            <th><?php echo app('translator')->get('hms::lang.total_paid'); ?>:</th>
            <th><?php echo app('translator')->get('hms::lang.due'); ?>:</th>
        </tr>
        <tr>
            <td style="padding-top: 8">
                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $transaction->room_price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
            </td>
            <td style="padding-top: 8">
                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $transaction->extra_price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
            </td>
            <?php if($discount_percent_disable == 0 && $transaction->discount_amount > 0): ?>
                <td style="padding-top: 8">
                    <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) ($transaction->discount_amount * ($transaction->room_price + $transaction->extra_price)) / 100, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                </td>
            <?php else: ?>
                <td style="padding-top: 8">
                    <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $transaction->discount_amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                </td>
            <?php endif; ?>

            <td style="padding-top: 8">
                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $transaction->final_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
            </td>
            <td style="padding-top: 8">
                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $transaction->total_paid, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
            </td>
            <td style="padding-top: 8">
                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $transaction->final_total - $transaction->total_paid, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
            </td>
        </tr>
    </table>
</div>
<footer class="container-fluid text-center" style="position: absolute; bottom: 80; width: 90%;">
    <div class="row">
        <div class="col-xs-12">
            <div class="your-div">

                <?php if(!empty($settings->booking_pdf->footer_text)): ?>
                    <div>
                        <?php echo $settings->booking_pdf->footer_text; ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>
