
<?php $__env->startSection('title', __('hms::lang.edit_booking')); ?>
<?php $__env->startSection('content'); ?>
    <?php
        $settings = json_decode($busines->hms_settings ?? '{}') ?: (object) [];
        $hms_time_format = session('business.time_format') == 12 ? 'h:i A' : 'H:i';
        $default_check_in_time = \Carbon\Carbon::parse($settings->check_in_time ?? '12:00')->format($hms_time_format);
        $configured_check_out_time = \Carbon\Carbon::parse($settings->check_out_time ?? '12:00')->format($hms_time_format);
        $checkout_grace_minutes = (int) ($settings->grace_before_checkout_minutes ?? 15);
    ?>
    <style>
        .table.booking-rooms-table {
            table-layout: auto !important;
        }

        .table.booking-rooms-table thead th {
            white-space: normal !important;
            overflow-wrap: anywhere;
            text-align: center;
            vertical-align: middle;
            min-width: 0;
            padding: 0.5rem 0.25rem;
        }
    </style>
    <?php echo $__env->make('hms::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Main content -->
    <section class="content">
    <?php echo Form::open([
        'url' => action([\Modules\Hms\Http\Controllers\HmsBookingController::class, 'update'],[$transaction->id]),
        'method' => 'put',
        'id' => 'edit_booking',
        'files' => true
    ]); ?>

    <div class="row">
       <div class="col-md-8">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title"> <?php echo app('translator')->get('hms::lang.edit_booking'); ?></h3>
            </div>
            <div class="box-body">
                <?php echo Form::hidden('location_id', $payment_location->id ?? null, [
                    'id' => 'location_id',
                    'data-default_payment_accounts' => $payment_location->default_payment_accounts ?? '{}',
                ]); ?>


                <input type="hidden" name="total_booking_amount" id="total_booking_amount">
                <input type="hidden" name="total_discount" id="total_discount">
                <input type="hidden" name="coupon_id" id="coupon_id">
                <input type="hidden" name="discount_type" id="discount_type">
                <input type="hidden" name="save_and_print" id="save_and_print" value="0">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('contact_id', __('contact.customer') . ':*'); ?>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="hidden" id="default_customer_id" value="<?php echo e($transaction->contact->id, false); ?>">
                                <input type="hidden" id="default_customer_name" value="<?php echo e($transaction->contact->name, false); ?>">
                                <?php echo Form::select('contact_id', [], null, ['class' => 'form-control mousetrap', 'id' => 'customer_id', 'placeholder' => 'Enter Customer name / phone', 'required']); ?>

                                <span class="input-group-btn"><button type="button" class="btn btn-default bg-white btn-flat add_new_customer" data-name=""><i class="fa fa-plus-circle text-primary fa-lg"></i></button></span>
                            </div>
                            <small class="text-danger <?php if(empty($customer_due)): ?> hide <?php endif; ?> contact_due_text"><strong><?php echo app('translator')->get('account.customer_due'); ?>:</strong> <span><?php echo e($customer_due ?? '', false); ?></span></small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <small><strong><?php echo app('translator')->get('lang_v1.billing_address'); ?>:</strong><div id="billing_address_div"><?php echo $transaction->contact->contact_address ?? ''; ?></div></small>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('status', __('hms::lang.status') . ':*'); ?>

                            <?php echo Form::select('status', $status, $transaction->status, ['class' => 'form-control status', 'required', 'placeholder' => __('hms::lang.status')]); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('arrival_date', __('hms::lang.arrival_date') . ':'); ?>

                            <?php echo Form::text('arrival_date', \Carbon::createFromTimestamp(strtotime($transaction->hms_booking_arrival_date_time))->format(session('business.date_format')), ['class' => 'form-control date_picker', 'placeholder' => __('hms::lang.arrival_date'), 'readonly', 'required', 'id' => 'arrival_date']); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('arrival_time', __('hms::lang.arrival_time') . ':'); ?>

                            <?php echo Form::text('arrival_time', \Carbon::createFromTimestamp(strtotime($transaction->hms_booking_arrival_date_time))->format('h:i A'), ['class' => 'form-control time_picker', 'placeholder' => __('hms::lang.arrival_time'), 'readonly', 'required', 'id' => 'arrival_time']); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('departure_date', __('hms::lang.departure_date') . ':'); ?>

                            <?php echo Form::text('departure_date', \Carbon::createFromTimestamp(strtotime($transaction->hms_booking_departure_date_time))->format(session('business.date_format')), ['class' => 'form-control departure_date', 'placeholder' => __('hms::lang.departure_date'), 'readonly', 'required', 'id' => 'departure_date']); ?>

                        </div>
                        <p class="days_count text-success">1 Days</p>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('departure_time', __('hms::lang.departure_time') . ':'); ?>

                            <?php echo Form::text('departure_time', \Carbon::createFromTimestamp(strtotime($transaction->hms_booking_departure_date_time))->format('h:i A'), ['class' => 'form-control time_picker', 'placeholder' => __('hms::lang.departure_time'), 'readonly', 'required', 'id' => 'departure_time']); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12"><hr></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                            <?php
                                $settings = json_decode($busines->hms_settings);
                            ?>
                            <div class="d-flex flex-wrap gap-2">
                                <?php $__currentLoopData = $transaction->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($media->model_media_type == 'id_proof_1'): ?>
                                            <?php if(Str::endsWith(strtolower($media->file_name), '.pdf')): ?>
                                            <div class="img-thumbnail position-relative" style="width: 100px; height: auto;">
                                            <span class="badge bg-red position-absolute  delete-media" style="z-index: 100;"
                                                data-href="<?php echo e(action([Modules\Hms\Http\Controllers\HmsBookingController::class, 'deleteMedia'], ['media_id' => $media->id]), false); ?>">
                                                <i class="fas fa-times"></i>
                                            </span>
                                                <a href="<?php echo e($media->display_url, false); ?>" target="_blank">
                                                    <i class="fas fa-file-pdf fa-3x text-danger d-block mx-auto my-3"></i>
                                                </a>
                                            </div>
                                            <?php else: ?>
                                            <div class="img-thumbnail position-relative" style="width: 100px; height: auto; top: -10px;">
                                            <span class="badge bg-red position-absolute  delete-media" style="z-index: 100;"
                                                data-href="<?php echo e(action([Modules\Hms\Http\Controllers\HmsBookingController::class, 'deleteMedia'], ['media_id' => $media->id]), false); ?>">
                                                <i class="fas fa-times"></i>
                                            </span>
                                            <img src="<?php echo e($media->display_url, false); ?>" style="width: 100%; height: 50px;" class="img-thumbnail">
                                            </div>
                                            <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                        <div class="form-group">
                            <?php echo Form::label('id_proof', ($settings->id_proof_label_1 ?? __('hms::lang.id_proof_1')) . ':'); ?>

                            <?php echo Form::file('id_proof_1[]', [
                            'id' => 'id_proof_1',
                                'accept' => 'image/*, application/pdf',
                                'multiple' => true,
                                'class' => 'upload-element',
                            'required' => $settings->is_id_proof_1_required ?? false,
                            ]); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-wrap gap-2">
                            <?php $__currentLoopData = $transaction->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($media->model_media_type == 'id_proof_2'): ?>
                                        <?php if(Str::endsWith(strtolower($media->file_name), '.pdf')): ?>
                                        <div class="img-thumbnail position-relative" style="width: 100px; height: auto;">
                                        <span class="badge bg-red position-absolute  delete-media" style="z-index: 100;"
                                            data-href="<?php echo e(action([Modules\Hms\Http\Controllers\HmsBookingController::class, 'deleteMedia'], ['media_id' => $media->id]), false); ?>">
                                            <i class="fas fa-times"></i>
                                        </span>
                                            <a href="<?php echo e($media->display_url, false); ?>" target="_blank">
                                                <i class="fas fa-file-pdf fa-3x text-danger d-block mx-auto my-3"></i>
                                            </a>
                                        </div>
                                        <?php else: ?>
                                        <div class="img-thumbnail position-relative" style="width: 100px; height: auto; top: -10px;">
                                        <span class="badge bg-red position-absolute  delete-media" style="z-index: 100;"
                                            data-href="<?php echo e(action([Modules\Hms\Http\Controllers\HmsBookingController::class, 'deleteMedia'], ['media_id' => $media->id]), false); ?>">
                                            <i class="fas fa-times"></i>
                                        </span>
                                        <img src="<?php echo e($media->display_url, false); ?>" style="width: 100%; height: 50px;" class="img-thumbnail">
                                        </div>
                                        <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="form-group">
                            <?php echo Form::label('id_proof_2', ($settings->id_proof_label_2 ?? __('hms::lang.id_proof_2')) . ':'); ?>

                            <?php echo Form::file('id_proof_2[]', [
                                'id' => 'id_proof_2',
                                'accept' => 'image/*, application/pdf',
                                'multiple' => true,
                                'class' => 'upload-element',
                                'required' => $settings->is_id_proof_2_required ?? false,
                            ]); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-wrap gap-2">
                            <?php $__currentLoopData = $transaction->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($media->model_media_type == 'id_proof_3'): ?>
                                        <?php if(Str::endsWith(strtolower($media->file_name), '.pdf')): ?>
                                        <div class="img-thumbnail position-relative" style="width: 100px; height: auto;">
                                        <span class="badge bg-red position-absolute  delete-media" style="z-index: 100;"
                                            data-href="<?php echo e(action([Modules\Hms\Http\Controllers\HmsBookingController::class, 'deleteMedia'], ['media_id' => $media->id]), false); ?>">
                                            <i class="fas fa-times"></i>
                                        </span>
                                            <a href="<?php echo e($media->display_url, false); ?>" target="_blank">
                                                <i class="fas fa-file-pdf fa-3x text-danger d-block mx-auto my-3"></i>
                                            </a>
                                        </div>
                                        <?php else: ?>
                                        <div class="img-thumbnail position-relative" style="width: 100px; height: auto; top: -10px;">
                                        <span class="badge bg-red position-absolute  delete-media" style="z-index: 100;"
                                            data-href="<?php echo e(action([Modules\Hms\Http\Controllers\HmsBookingController::class, 'deleteMedia'], ['media_id' => $media->id]), false); ?>">
                                            <i class="fas fa-times"></i>
                                        </span>
                                        <img src="<?php echo e($media->display_url, false); ?>" style="width: 100%; height: 50px;" class="">
                                        </div>
                                        <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="form-group">
                                <?php echo Form::label('id_proof_3', ($settings->id_proof_label_3 ?? __('hms::lang.id_proof_3')) . ':'); ?>

                                <?php echo Form::file('id_proof_3[]', [
                                    'id' => 'id_proof_3',
                                    'accept' => 'image/*, application/pdf',
                                    'multiple' => true,
                                    'class' => 'upload-element',
                                    'required' => $settings->is_id_proof_3_required ?? false,
                                ]); ?>

                            </div>
                        </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-wrap gap-2">
                            <?php $__currentLoopData = $transaction->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($media->model_media_type == 'id_proof_4'): ?>
                                    <?php if(Str::endsWith(strtolower($media->file_name), '.pdf')): ?>
                                        <div class="img-thumbnail position-relative" style="width: 100px; height: auto;">
                                            <span class="badge bg-red position-absolute delete-media" style="z-index: 100;"
                                                data-href="<?php echo e(action([Modules\Hms\Http\Controllers\HmsBookingController::class, 'deleteMedia'], ['media_id' => $media->id]), false); ?>">
                                                <i class="fas fa-times"></i>
                                            </span>
                                            <a href="<?php echo e($media->display_url, false); ?>" target="_blank">
                                                <i class="fas fa-file-pdf fa-3x text-danger d-block mx-auto my-3"></i>
                                            </a>
                                        </div>
                                    <?php else: ?>
                                        <div class="img-thumbnail position-relative" style="width: 100px; height: auto;">
                                            <span class="badge bg-red position-absolute delete-media" style="z-index: 100;"
                                                data-href="<?php echo e(action([Modules\Hms\Http\Controllers\HmsBookingController::class, 'deleteMedia'], ['media_id' => $media->id]), false); ?>">
                                                <i class="fas fa-times"></i>
                                            </span>
                                            <img src="<?php echo e($media->display_url, false); ?>" style="width: 100%; height: 50px;" class="img-thumbnail">
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="form-group">
                            <?php echo Form::label('id_proof_4', ($settings->id_proof_label_4 ?? __('hms::lang.id_proof_4')) . ':'); ?>

                            <?php echo Form::file('id_proof_4[]', [
                                'id' => 'id_proof_4',
                                'accept' => 'image/*, application/pdf',
                                'multiple' => true,
                                'class' => 'upload-element',
                            ]); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <h3><?php echo app('translator')->get('hms::lang.rooms_and_extras'); ?></h3>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-8 booking_add_room">
                    <div class="table-responsive">
                    <table class="table table-bordered booking-rooms-table">
                        <thead>
                            <tr class="bg-light-green">
                                <th><?php echo app('translator')->get('hms::lang.type'); ?></th>
                                <th><?php echo app('translator')->get('hms::lang.room_no'); ?></th>
                                <th><?php echo app('translator')->get('hms::lang.no_of_adult'); ?></th>
                                <th><?php echo app('translator')->get('hms::lang.no_of_child'); ?></th>
                                <th><?php echo app('translator')->get('hms::lang.price'); ?></th>
                                <th><?php echo app('translator')->get('messages.action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $booking_rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <input type="hidden" value="<?php echo e($room->total_price, false); ?>" name="rooms[<?php echo e($index, false); ?>][total_price]">
                                        <input type="hidden" value="<?php echo e($room->price, false); ?>" name="rooms[<?php echo e($index, false); ?>][price]">
                                        <input type="hidden" value="<?php echo e($room->hms_room_type_id, false); ?>" name="rooms[<?php echo e($index, false); ?>][type_id]">
                                        <input type="hidden" class="room-id-input" value="<?php echo e($room->hms_room_id, false); ?>" name="rooms[<?php echo e($index, false); ?>][room_id]">
                                        <input type="hidden" value="<?php echo e($room->adults, false); ?>" name="rooms[<?php echo e($index, false); ?>][no_of_adult]">
                                        <input type="hidden" value="<?php echo e($room->childrens, false); ?>" name="rooms[<?php echo e($index, false); ?>][no_of_child]">
                                        <?php echo e($room->type, false); ?>

                                    
                                    </td>
                                    <td>
                                        <?php echo e($room->room_number, false); ?>

                                    </td>
                                    <td>
                                        <?php echo e($room->adults, false); ?>

                                    </td>
                                    <td>
                                        <?php echo e($room->childrens, false); ?>

                                    </td>
                                    <td class="price-td" data-unit-price="<?php echo e($room->price, false); ?>" data-room-type-id="<?php echo e($room->hms_room_type_id, false); ?>" data-daily-prices="<?php echo e(json_encode($room->daily_prices), false); ?>">
                                        <?php echo e($room->total_price, false); ?>

                                    </td>
                                    <td> 
                                        <button type="button" class="btn btn-sm btn-danger me-1 remove"><i class="fas fa-trash-alt"></i></button> 
                                        <button type="button" class="btn btn-sm btn-primary me-1 edit"><i class="fas fa-edit"></i></button> 
                                    </td> 
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary add-room">  <?php echo app('translator')->get('messages.add'); ?> <?php echo app('translator')->get('hms::lang.rooms'); ?></button>
                    </div>
                </div>
       </div>
                <div class="col-md-4">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('hms::lang.extras'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $extras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $extra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                     <input type="checkbox" name="extras[<?php echo e($extra->id, false); ?>][id]" class="extra" value="<?php echo e($extra->id, false); ?>" data-value="<?php echo e($extra->price_per, false); ?>" data-price="<?php echo e($extra->price, false); ?>" <?php if(in_array($extra->id, $extras_id)): ?>
                                         checked
                                     <?php endif; ?>>
                                     <input type="hidden" name="extras[<?php echo e($extra->id, false); ?>][price]" value="" id="<?php echo e($extra->id, false); ?>">
                                     <?php echo e($extra->name, false); ?> / <span class="display_currency" data-currency_symbol="true"> <?php echo e($extra->price, false); ?></span> - <?php echo e(str_replace("_", " ", $extra->price_per), false); ?>

                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
       </div>
       <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading status-heading">
                    <h3 class="panel-title">
                     <?php echo app('translator')->get('hms::lang.status'); ?>
                    <span class="float-end status_value"><?php echo app('translator')->get('hms::lang.status'); ?></span>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <strong><?php echo app('translator')->get('hms::lang.room_price'); ?> :</strong>
                        </div>
                        <div class="col-xs-6 text-right">
                           <strong class="display_currency room_price" data-currency_symbol="true">0.00</strong>
                        </div>
                    </div>
                        <div class="row">
                        <div class="col-xs-6">
                            <strong><?php echo app('translator')->get('hms::lang.extra_price'); ?> :</strong>
                        </div>
                        <div class="col-xs-6 text-right">
                            
                            <strong class="display_currency extra_price" data-currency_symbol="true">0.00</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <strong><?php echo app('translator')->get('hms::lang.discount'); ?> :</strong>
                        </div>
                        <div class="col-xs-6 text-right">
                            <strong class="display_currency total_discount_show" data-currency_symbol="true">0.00</strong>

                        </div>
                    </div>
                    <div class="row">
                    <hr>
                    <?php

                    $discount_percent_disable  = 0;
    
                    if(!empty($transaction->hms_coupon_id)){
                        $discount_percent_disable = 1;
                    }

                    ?>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <?php echo Form::number('discount_percent', ($discount_percent_disable == 0 &&  $transaction->discount_amount > 0)? number_format($transaction->discount_amount, 2)  : null, [
                                    'class' => 'form-control',
                                    'id' => 'discount_percent',
                                    'disabled' => $discount_percent_disable == 1 ? 'disabled' : null,
                                    'placeholder' => __('hms::lang.discount_percent'),
                                ]); ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <strong>Total:</strong>
                        </div>
                        <div class="col-xs-6 text-right">
                            <strong class="display_currency total" data-currency_symbol="true">0.00</strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <?php echo app('translator')->get('hms::lang.apply_coupon'); ?>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <?php echo Form::label('coupon_code', __('hms::lang.coupon_code') . ':'); ?>

                                <?php echo Form::text('coupon_code', $transaction->coupon_code, [
                                    'class' => 'form-control coupon_code',
                                    'placeholder' => __('hms::lang.coupon_code'),
                                    'disabled' => (empty($transaction->hms_coupon_id) && $transaction->discount_amount > 0) ? 'disabled' : null,
                                ]); ?>

                                <div class="coupon-box" style="display:none"></div>
                            </div>
                            <a class="btn btn-sm btn-success apply_coupon"><?php echo app('translator')->get('hms::lang.apply_coupon'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header">
                    <h3 class="box-title"> <?php echo app('translator')->get('hms::lang.add_payment'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <strong><?php echo app('translator')->get('lang_v1.advance_balance'); ?>:</strong>
                            <span id="advance_balance_text"><?php echo e(number_format(0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
                            <?php echo Form::hidden('advance_balance', 0, [
                                'id' => 'advance_balance',
                                'data-error-msg' => __('lang_v1.required_advance_balance_not_available'),
                            ]); ?>

                        </div>
                    </div>
                    <div class="row" id="payment_rows_div">
                            <?php $__currentLoopData = $payment_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>			
                                <?php if($payment_line['is_return'] == 1): ?>
                                    <?php
                                        $change_return = $payment_line;
                                    ?>

                                    <?php continue; ?>
                                <?php endif; ?>

                                <?php if(!empty($payment_line['id'])): ?>
                                    <?php echo Form::hidden("payment[$loop->index][payment_id]", $payment_line['id']); ?>

                                <?php endif; ?>
                                <div class="box-body payment_row">
                                    <?php echo $__env->make('hms::partials.payment_row_form', ['row_index' => $loop->index, 'show_date' => true, 'payment_lines' => $payment_line, 'show_denomination' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <input type="hidden" id="payment_row_index" value="<?php echo e(count($payment_lines), false); ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary" id="add-payment-row"><?php echo app('translator')->get('sale.add_payment_row'); ?></button>
                        </div>
                    </div>
                        <div class="payment_row">
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <strong>
                                        <?php echo app('translator')->get('lang_v1.change_return'); ?>:
                                    </strong>
                                    <br/>
                                    <span class="lead text-bold change_return_span">0</span>
                                    <?php echo Form::hidden("change_return", $change_return['amount'], ['class' => 'form-control change_return input_number', 'required', 'id' => "change_return"]); ?>

                                    <!-- <span class="lead text-bold total_quantity">0</span> -->
                                    <?php if(!empty($change_return['id'])): ?>
                                        <input type="hidden" name="change_return_id" 
                                        value="<?php echo e($change_return['id'], false); ?>">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="hide payment_row" id="change_return_payment_data">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo Form::label("change_return_method" , __('lang_v1.change_return_payment_method') . ':*'); ?>

                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-money-bill-alt"></i>
                                            </span>
                                            <?php
                                                $_payment_method = empty($change_return['method']) && array_key_exists('cash', $payment_types) ? 'cash' : $change_return['method'];
        
                                                $_payment_types = $payment_types;
                                                if(isset($_payment_types['advance'])) {
                                                    unset($_payment_types['advance']);
                                                }
                                            ?>
                                            <?php echo Form::select("payment[change_return][method]", $_payment_types, $_payment_method, ['class' => 'form-control col-md-12 payment_types_dropdown', 'id' => 'change_return_method', 'style' => 'width:100%;']); ?>

                                        </div>
                                    </div>
                                </div>
                                <?php if(!empty($accounts)): ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo Form::label("change_return_account" , __('lang_v1.change_return_payment_account') . ':'); ?>

                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-money-bill-alt"></i>
                                                </span>
                                                <?php echo Form::select("payment[change_return][account_id]", $accounts, !empty($change_return['account_id']) ? $change_return['account_id'] : '' , ['class' => 'form-control select2', 'id' => 'change_return_account', 'style' => 'width:100%;']); ?>

                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php echo $__env->make('hms::partials.payment_type_details', ['payment_line' => $change_return, 'row_index' => 'change_return'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="float-end"><strong><?php echo app('translator')->get('lang_v1.balance'); ?>:</strong> <span class="balance_due">0.00</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
       <?php echo Form::close(); ?>

    </section>
    <!-- /.content -->

    <div id="hms-booking-edit-footer-actions-template" class="d-none">
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-primary" id="hms_booking_update_btn"><?php echo app('translator')->get('messages.update'); ?></button>
            <button type="button" class="btn btn-success" id="hms_booking_update_print_btn"><i class="fa fa-print"></i> <?php echo app('translator')->get('lang_v1.update_and_print'); ?></button>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modals'); ?>
    <div class="modal fade view_modal_room" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel"></div>
    <div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        <?php echo $__env->make('contact.create', ['quick_add' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script>
        $(document).ready(function() {
            var current_index = parseFloat("<?php echo e(count($booking_rooms), false); ?>") + 1;
            var row = null;
            var coupon_id = null;
            var discount_type = null;
            var checkoutGraceMinutes = <?php echo e($checkout_grace_minutes, false); ?>;
            var configuredCheckoutTime = <?php echo json_encode($configured_check_out_time, 15, 512) ?>;

            $('.add-room').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?php echo e(route('booking_room_add'), false); ?>",
                    dataType: 'html',
                    success: function(result) {
                        $('.view_modal_room')
                            .html(result)
                            .modal('show');
                    },
                });
            });

            // Use event delegation for dynamically loaded modal content
            $(".view_modal_room").on("submit", "#add_booking_room", function(event) {
                current_index++;
                event.preventDefault();
                $.ajax({
                    url: "<?php echo e(route('get_room_detail'), false); ?>",
                    dataType: 'html',
                    data: {
                        'current_index' : current_index, 
                        'type_id': $('#type').val(),
                        'room_id': $('#room_no').val(),
                        'no_of_child': $('#no_of_child').val(),
                        'no_of_adult': $('#no_of_adult').val(),
                        'arrival_date': $('#arrival_date').val(),
                        'arrival_time': $('#arrival_time').val(),
                        'departure_date': $('#departure_date').val(),
                        'departure_time': $('#departure_time').val(),
                    },
                    success: function(result) {
                        $('.booking_add_room table tbody').append(result);
                        calculateAllPrice();
                    },
                });

                $('.view_modal_room').modal('hide');
                return false;
            });

            $(".view_modal_room").on("submit", "#edit_booking_room", function(event) {
                current_index++;
                event.preventDefault();
                $.ajax({
                    url: "<?php echo e(route('get_room_detail'), false); ?>",
                    dataType: 'html',
                    data: {
                        'current_index' : current_index, 
                        'type_id': $('#type').val(),
                        'room_id': $('#room_no').val(),
                        'no_of_child': $('#no_of_child').val(),
                        'no_of_adult': $('#no_of_adult').val(),
                        'arrival_date': $('#arrival_date').val(),
                        'arrival_time': $('#arrival_time').val(),
                        'departure_date': $('#departure_date').val(),
                        'departure_time': $('#departure_time').val(),
                        'is_edit': true,
                    },
                    success: function(result) {
                        row.html(result);
                        calculateAllPrice();
                    },
                });

                $('.view_modal_room').modal('hide');
                return false;
            });

            $(".view_modal_room").on("change", "#type", function() {
                var roomIds = [];
                $('.room-id-input').each(function () {
                    var roomId = $(this).val();
                    roomIds.push(roomId);
                });

                $.ajax({
                    url: "<?php echo e(route('get_room_type_by'), false); ?>",
                    dataType: 'html',
                    data: {
                        't_id': "<?php echo e($transaction->id, false); ?>",
                        'type_id': $(this).val(),
                        'arrival_date': $('#arrival_date').val(),
                        'departure_date': $('#departure_date').val(),
                        'arrival_time': $('#arrival_time').val(),
                        'departure_time': $('#departure_time').val(),
                        'room_ids': roomIds,
                    },
                    success: function(result) {
                        $('.modify_field').html(result);
                    },
                });
            });

            var currentDate = new Date();
            var currentDateTime = moment(currentDate);

            $('.date_picker').datetimepicker({
                format: moment_date_format,
                ignoreReadonly: true,
            });

            $('.departure_date').datetimepicker({
                format: moment_date_format,
                ignoreReadonly: true,
                defaultDate: currentDateTime,
            });

            var initialDate;
            var previousDate;
            var changeEventBound = true;
            
            $('.date_picker').on('dp.change', function (e) {
                if (!changeEventBound) {
                    return;
                }
                
                var selectedDate = e.date;
                previousDate = e.oldDate;

                if (!initialDate) {
                    initialDate = selectedDate;
                }

                // Update the minimum date of the departure datepicker
                var rowCount = $(".booking_add_room table tbody tr").length;

                if(rowCount > 0){
                    changeEventBound = false;
                    swal({
                        text: " <?php echo e(__('hms::lang.changing_date_will_reset_rooms_selection_do_you_want_to_continue'), false); ?> ",
                        title: "<?php echo e(__('hms::lang.are_you_sure'), false); ?>",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((confirmed) => {
                        if (confirmed) {
                            // Perform deletion logic here
                            $(".booking_add_room table tbody tr").remove();
                            $('#coupon_code').val('');
                            initialDate = selectedDate;
                            $('.departure_date').data('DateTimePicker').minDate(selectedDate);
                            calculateAllPrice();
                        } else {
                            initialDate = previousDate;
                            $('.date_picker').data("DateTimePicker").date(previousDate);
                        }
                        changeEventBound = true;
                    });
                }else{
                    $('.departure_date').data('DateTimePicker').minDate(selectedDate);
                    calculateAllPrice();
                }

            });

            var initialDate;
            var previousDate;
            var changeEventBound = true;

            $('.departure_date').on('dp.change', function (e) {

                if (!changeEventBound) {
                    return;
                }
                
                var selectedDate = e.date;
                previousDate = e.oldDate;

                if (!initialDate) {
                    initialDate = selectedDate;
                }

                // Update the minimum date of the departure datepicker
                var rowCount = $(".booking_add_room table tbody tr").length;

                if(rowCount > 0){
                    changeEventBound = false;
                    swal({
                        text: " <?php echo e(__('hms::lang.changing_date_will_reset_rooms_selection_do_you_want_to_continue'), false); ?> ",
                        title: "<?php echo e(__('hms::lang.are_you_sure'), false); ?>",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((confirmed) => {
                        if (confirmed) {
                            // Perform deletion logic here
                            $(".booking_add_room table tbody tr").remove();
                            initialDate = selectedDate;
                            $('.departure_date').data('DateTimePicker').minDate(selectedDate);
                            $('#coupon_code').val('');
                            calculateAllPrice();
                        } else {
                            initialDate = previousDate;
                            $('.departure_date').data("DateTimePicker").date(previousDate);
                        }
                        changeEventBound = true;
                    });
                }else{
                    calculateAllPrice();
                }
            });

            $('.time_picker').datetimepicker({
                format: moment_time_format,
                ignoreReadonly: true,
            });
            $('.time_picker').on('dp.change', function() {
                calculateAllPrice();
            });

            // Remove row functionality
            $(document).on('click', '.remove', function(e) {
                e.preventDefault();
                swal({
                    title: "<?php echo e(__('hms::lang.delete_booking_room'), false); ?>",
                    text: "<?php echo e(__('hms::lang.are_you_sure_you_want_to_delete_selected_items?'), false); ?>",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((confirmed) => {
                    if (confirmed) {
                        $(this).closest('tr').remove();
                        calculateAllPrice();
                    }
                });
            });

            $(document).on('click', '.edit', function(e) {
                e.preventDefault();
                current_index ++;
                row = $(this).closest('tr');
                var type_id = row.find('input[name^="rooms["][name$="][type_id]"]').val();
                var room_id = row.find('input[name^="rooms["][name$="][room_id]"]').val();
                var no_of_adult = row.find('input[name^="rooms["][name$="][no_of_adult]"]').val();
                var no_of_child = row.find('input[name^="rooms["][name$="][no_of_child]"]').val();
                var roomIds = []; // Array to store the room_ids
                $('.room-id-input').each(function () {
                    var roomId = $(this).val();
                    roomIds.push(roomId);
                });
                $.ajax({
                    url: "<?php echo e(route('booking_room_edit'), false); ?>",
                    dataType: 'html',
                    data: {
                        'type_id': type_id,
                        'room_id': room_id,
                        'no_of_adult': no_of_adult,
                        'no_of_child': no_of_child,
                        'room_ids':roomIds,
                    },
                    success: function(result) {
                        $('.view_modal_room')
                            .html(result)
                            .modal('show');
                    },
                });
            });
            $(document).on('click', '.price_calculate, .extra', function(){
                calculateAllPrice();
            });

            $('.status').on('change', function(){
                setStatus();
            });

            function setStatus(){
                if($('#status').val() == 'cancelled'){
                    $('.status-heading').css('background-color', 'red');
                    $('.status_value').html("Cancelled");
                } else if($('#status').val() == 'confirmed'){
                    $('.status_value').html("Confirmed");
                    $('.status-heading').css('background-color', 'green');
                } else if($('#status').val() == 'pending'){
                    $('.status-heading').css('background-color', 'yellow');
                    $('.status_value').html("Pending")
                } else{
                    $('.status-heading').css('background-color', '#f5f5f5');
                    $('.status_value').html("Status")
                }
            }
            
            setStatus();

            $('.apply_coupon').on('click', function(){
                calculateAllPrice();
            });

            $('.coupon_code').on('change', function(){
                calculateAllPrice();
                // alert('ok');
            });

            $("form#edit_booking").validate();


            async function getCouponDiscount(price, type_id) {
                var discount = 0;
                    const result = await $.ajax({
                        url: "<?php echo e(route('get_coupon_discount'), false); ?>",
                        dataType: 'json',
                        data: {
                            'coupon_code': $('#coupon_code').val(),
                            'booking_date': $('#arrival_date').val(),
                        },
                    });
                    if (result.status === 1) {
                        if (result.coupon.hms_room_type_id == type_id) {
                            if(result.coupon.discount_type == 'fixed'){
                                discount = result.coupon.discount;
                            }else{
                                discount = (result.coupon.discount * price) / 100;
                            }
                            coupon_id = result.coupon.id; 
                            discount_type = result.coupon.discount_type;
                        }else{
                            discount = 0;
                        }
                    }
                return {
                    'discount':discount, 
                    'coupon_id': coupon_id,
                    'discount_type' : discount_type,
                };
            }

            function calculateRoomTotal(priceCell, fallbackPrice, days) {
                let dailyPrices = {};
                try {
                    dailyPrices = JSON.parse(priceCell.attr('data-daily-prices') || '{}');
                } catch (error) {
                    dailyPrices = {};
                }

                const arrivalDate = moment($('#arrival_date').val(), moment_date_format, true);
                if (!arrivalDate.isValid()) {
                    return days * fallbackPrice;
                }

                let total = 0;
                for (let day = 0; day < days; day++) {
                    const dateKey = arrivalDate.clone().add(day, 'days').format('YYYY-MM-DD');
                    const dailyPrice = parseFloat(dailyPrices[dateKey]);
                    total += Number.isFinite(dailyPrice) ? dailyPrice : fallbackPrice;
                }

                return total;
            }

            async function calculateAllPrice() {
                    var extra_amount = 0;
                    var person = 0;
                    var room_price = 0;
                    var total = 0;
                    var total_discount = 0;
                    var type_id = null;

                
                    await Promise.all(
                        $('.booking_add_room table tbody tr').map(async function() {
                            const tr = $(this);
                            const priceCell = tr.find('.price-td');
                            let price = parseFloat(tr.find('input[name^="rooms["][name$="][price]"]').val());
                            if (!Number.isFinite(price)) {
                                price = parseFloat(priceCell.data('unit-price'));
                            }
                            if (!Number.isFinite(price)) {
                                price = 0;
                            }
                            const type_id = tr.find('input[name^="rooms["][name$="][type_id]"]').val() ||
                                priceCell.data('room-type-id');
                            if($('#coupon_code').val() != ''){
                                discount = await getCouponDiscount(price, type_id);
                                total_discount = total_discount + parseFloat(discount.discount);
                                coupon_id = discount.coupon_id;
                                discount_type  = discount.discount_type
                            }
                            var total_price = calculateRoomTotal(priceCell, price, calculateDays());
                            priceCell.text(__currency_trans_from_en(total_price.toFixed(2) , true));
                            tr.find('input[name^="rooms["][name$="][total_price]"]').val(total_price);
                            room_price += total_price;
                            person += parseFloat(tr.find('input[name^="rooms["][name$="][no_of_adult]"]').val()) +
                                parseFloat(tr.find('input[name^="rooms["][name$="][no_of_child]"]').val());
                        })
                    );
                    

                    $('.extra').each(async function() {
                        if ($(this).prop('checked')) {
                           
                            var per_type = $(this).data('value');
                            var price = parseFloat($(this).data('price'));

                            if (per_type == 'per_booking') {
                                extra_amount =  parseFloat(extra_amount) + price;
                                $('#' + $(this).val()).val(price);
                            }
                            if (per_type == 'per_person') {
                                extra_amount = parseFloat(extra_amount) + person * price;
                                $('#' + $(this).val()).val(person * price);
                            }
                            if (per_type == 'per_day') {
                                extra_amount = parseFloat(extra_amount) + calculateDays() * price;
                                $('#' + $(this).val()).val(calculateDays() * price);
                            }
                            if (per_type == 'per_day_per_person') {
                                extra_amount = parseFloat(extra_amount) +  calculateDays() * person * price;
                                $('#' + $(this).val()).val(calculateDays() * person * price);
                            }
                        } else {
                            $('#' + $(this).val()).val('');
                        }
                    });

                    var extra = parseFloat(extra_amount);
                    var room_price = parseFloat(room_price);

                    if($('#discount_percent').val() != '' && $('#discount_percent').val() > 0){
                       discount = ($('#discount_percent').val() * (extra + room_price) / 100)
                       total_discount = discount;
                       coupon_id = null;
                       $('#discount_type').val('Percentage');
                       $('#total_discount').val($('#discount_percent').val());
                       $('.total_discount_show').text(__currency_trans_from_en(total_discount.toFixed(2) , true));
                    }

                    total = extra + room_price - total_discount;
                    $('#total_booking_amount').val(total);
                    calculate_balance_due();

                     if($('#coupon_code').val() != ''){
                        if(total_discount > 0){
                            $('#coupon_id').val(coupon_id);
                            $('#discount_type').val('Fixed');
                            $('#total_discount').val(total_discount);
                            $('.total_discount_show').text(__currency_trans_from_en(total_discount.toFixed(2) , true));
                            $('.coupon-box').show();
                            $('.coupon-box').html("<?php echo e(__('hms::lang.applied_successfully'), false); ?>").css({'font-weight': 'bold','font-size': '16px', 'color': 'green'});
                        }else{
                            $('#coupon_id').val(null);
                            $('#discount_type').val(null);
                            $('#total_discount').val(null);
                            $('.coupon-box').show();
                            $('.coupon-box').html("<?php echo e(__('hms::lang.something_went_wrong'), false); ?>").css({'font-weight': 'bold','font-size': '16px', 'color': 'red'});
                        }
                    }else{
                        $('#coupon_id').val(null);
                        $('.coupon-box').hide();

                        if($('#discount_percent').val() == ''){
                            $('#discount_type').val(null);
                            $('#total_discount').val(null);
                            $('.total_discount_show').text(__currency_trans_from_en(total_discount.toFixed(2) , true));
                        }
                    }


                    $('.total').text(__currency_trans_from_en(total.toFixed(2) , true));
                    $('.extra_price').text(__currency_trans_from_en(extra_amount.toFixed(2) , true));
                    $('.room_price').text(__currency_trans_from_en(room_price.toFixed(2) , true));
            }


             function calculateDays() {
                const startDateString = $('#arrival_date').val();
                const endDateString = $('#departure_date').val();
                const startDate = moment(startDateString, moment_date_format, true);
                const endDate = moment(endDateString, moment_date_format, true);
                const arrivalTime = moment($('#arrival_time').val(), moment_time_format, true);
                const departureTime = moment($('#departure_time').val(), moment_time_format, true);
                const configuredCheckout = moment(configuredCheckoutTime, moment_time_format, true);

                if (startDate.isValid() && endDate.isValid() && arrivalTime.isValid() && departureTime.isValid() && configuredCheckout.isValid()) {
                    startDate.hour(arrivalTime.hour()).minute(arrivalTime.minute()).second(0);
                    endDate.hour(departureTime.hour()).minute(departureTime.minute()).second(0);

                    const calendarDays = endDate.clone().startOf('day').diff(startDate.clone().startOf('day'), 'days');
                    const checkoutDeadline = endDate.clone()
                        .hour(configuredCheckout.hour())
                        .minute(configuredCheckout.minute())
                        .second(0)
                        .add(checkoutGraceMinutes, 'minutes');
                    const isLateCheckout = calendarDays > 0 && endDate.isSameOrAfter(checkoutDeadline);
                    const daysDifference = Math.max(1, calendarDays + (isLateCheckout ? 1 : 0));
                    $('.days_count').text(daysDifference + ' Days');

                    return daysDifference;
                }

                return 1;
            }
            calculateAllPrice();


             //get customer
             $('select#customer_id').select2({
                ajax: {
                    url: '/contacts/customers',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page,
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data,
                        };
                    },
                },
                templateResult: function (data) { 
                    var template = '';
                    if (data.supplier_business_name) {
                        template += data.supplier_business_name + "<br>";
                    }
                    template += data.text + "<br>" + LANG.mobile + ": " + data.mobile;

                    if (typeof(data.total_rp) != "undefined") {
                        var rp = data.total_rp ? data.total_rp : 0;
                        template += "<br><i class='fa fa-gift text-success'></i> " + rp;
                    }

                    return  template;
                },
                minimumInputLength: 1,
                language: {
                    noResults: function() {
                        var name = $('#customer_id')
                            .data('select2')
                            .dropdown.$search.val();
                        return (
                            '<button type="button" data-name="' +
                            name +
                            '" class="btn btn-link add_new_customer"><i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i>&nbsp; ' +
                            __translate('add_name_as_new_customer', { name: name }) +
                            '</button>'
                        );
                    },
                },
                escapeMarkup: function(markup) {
                    return markup;
                },
            });
            $('#customer_id').on('select2:select', function(e) {
                var data = e.params.data;
                if (data.pay_term_number) {
                    $('input#pay_term_number').val(data.pay_term_number);
                } else {
                    $('input#pay_term_number').val('');
                }

                if (data.pay_term_type) {
                    $('#add_sell_form select[name="pay_term_type"]').val(data.pay_term_type);
                    $('#edit_sell_form select[name="pay_term_type"]').val(data.pay_term_type);
                } else {
                    $('#add_sell_form select[name="pay_term_type"]').val('');
                    $('#edit_sell_form select[name="pay_term_type"]').val('');
                }
                
                update_shipping_address(data);
                get_contact_advance(data.id);

                if (data.price_calculation_type == 'selling_price_group') {
                    $('#price_group').val(data.selling_price_group_id);
                    $('#price_group').change();
                } else {
                    $('#price_group').val('');
                    $('#price_group').change();
                }
                if ($('.contact_due_text').length) {
                    get_contact_due(data.id);
                }
            });

            function update_shipping_address(data) {
                if ($('#billing_address_div').length) {
                    var address = [];
                    if (data.supplier_business_name) {
                        address.push(data.supplier_business_name);
                    }
                    var contactName = data.text || data.name;
                    if (contactName) {
                        address.push('<br>' + contactName);
                    }
                    if (data.address_line_1) {
                        address.push('<br>' + data.address_line_1);
                    }
                    if (data.address_line_2) {
                        address.push('<br>' + data.address_line_2);
                    }
                    if (data.city) {
                        address.push('<br>' + data.city);
                    }
                    if (data.state) {
                        address.push(data.state);
                    }
                    if (data.country) {
                        address.push(data.country);
                    }
                    if (data.zip_code) {
                        address.push('<br>' + data.zip_code);
                    }
                    var billing_address = address.join(', ');
                    $('#billing_address_div').html(billing_address);
                }
                
            }

            function get_contact_due(id) {
                $.ajax({
                    method: 'get',
                    url: '/get-contact-due/' + encodeURIComponent(id),
                    dataType: 'json',
                    success: function(result) {
                        if (result && result.due) {
                            $('.contact_due_text').find('span').text(result.due);
                            $('.contact_due_text').removeClass('hide');
                        } else {
                            $('.contact_due_text').find('span').text('');
                            $('.contact_due_text').addClass('hide');
                        }
                    },
                });
            }

            function get_contact_advance(id) {
                $('#advance_balance').val(0);
                $('#advance_balance_text').text(__currency_trans_from_en(0, true));
                updateAdvancePaymentOptions(0);
                if (!id) {
                    return;
                }

                $.ajax({
                    method: 'get',
                    url: '/contacts/get-contact-advance',
                    data: { id: id },
                    dataType: 'json',
                    success: function(result) {
                        var deposit = parseFloat(result && result.advance_deposit) || 0;
                        var paid = parseFloat(result && result.advance_deposit_paid) || 0;
                        var available = Math.max(0, deposit - paid);
                        $('#advance_balance').val(available);
                        $('#advance_balance_text').text(__currency_trans_from_en(available, true));
                        updateAdvancePaymentOptions(available);

                        $('.payment_row').has('.payment_types_dropdown').each(function() {
                            var row = $(this);
                            var methodSelect = row.find('select.payment_types_dropdown').first();
                            if (methodSelect.val() === 'advance' && !methodSelect.prop('disabled')) {
                                __write_number(row.find('.payment-amount'), available);
                                row.find('.payment-amount').trigger('change');
                            }
                        });
                    },
                });
            }

            function updateAdvancePaymentOptions(available) {
                var hasAdvance = (parseFloat(available) || 0) > 0;
                $('.payment_types_dropdown').filter('select').each(function() {
                    var methodSelect = $(this);
                    if (methodSelect.prop('disabled') && methodSelect.val() === 'advance') {
                        return;
                    }

                    var advanceOption = methodSelect.find('option[value="advance"]');
                    advanceOption.prop('hidden', !hasAdvance).prop('disabled', !hasAdvance);
                    if (!hasAdvance && methodSelect.val() === 'advance') {
                        var fallbackMethod = methodSelect.find('option').filter(function() {
                            return this.value && this.value !== 'advance' && !this.disabled;
                        }).first().val();
                        methodSelect.val(fallbackMethod || '').trigger('change');
                    }
                });
            }

            set_default_customer();

            function set_default_customer() {
                var default_customer_id = $('#default_customer_id').val();
                var default_customer_name = $('#default_customer_name').val();
                var default_customer_balance = $('#default_customer_balance').val();
                var default_customer_address = $('#default_customer_address').val();
                var exists = default_customer_id ? $('select#customer_id option[value=' + default_customer_id + ']').length : 0;
                if (exists == 0 && default_customer_id) {
                    $('select#customer_id').append(
                        $('<option>', { value: default_customer_id, text: default_customer_name })
                    );
                }
                get_contact_advance(default_customer_id);
                if (default_customer_address) {
                    $('#shipping_address').val(default_customer_address);
                }
                $('select#customer_id')
                    .val(default_customer_id)
                    .trigger('change');

                if ($('#default_selling_price_group').length) {
                    $('#price_group').val($('#default_selling_price_group').val());
                    $('#price_group').change();
                }

                //initialize tags input (tagify)
                if ($("textarea#repair_defects").length > 0 && !customer_set) {
                    let suggestions = [];
                    if ($("input#pos_repair_defects_suggestion").length > 0 && $("input#pos_repair_defects_suggestion").val().length > 2) {
                        suggestions = JSON.parse($("input#pos_repair_defects_suggestion").val());    
                    }
                    let repair_defects = document.querySelector('textarea#repair_defects');
                    tagify_repair_defects = new Tagify(repair_defects, {
                            whitelist: suggestions,
                            maxTags: 100,
                            dropdown: {
                                maxItems: 100,           // <- mixumum allowed rendered suggestions
                                classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
                                enabled: 0,             // <- show suggestions on focus
                                closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
                            }
                            });
                }

                customer_set = true;
            }

            $(document).on('click', '.add_new_customer', function() {
                $('#customer_id').select2('close');
                var name = $(this).data('name');
                $('.contact_modal')
                    .find('input#name')
                    .val(name);
                $('.contact_modal')
                    .find('select#contact_type')
                    .val('customer')
                    .closest('div.contact_type_div')
                    .addClass('hide');
                $('.contact_modal').modal('show');
            });
            $('form#quick_add_contact')
                .submit(function(e) {
                    e.preventDefault();
                })
                .validate({
                    rules: {
                        contact_id: {
                            remote: {
                                url: '/contacts/check-contacts-id',
                                type: 'post',
                                data: {
                                    contact_id: function() {
                                        return $('#contact_id').val();
                                    },
                                    hidden_id: function() {
                                        if ($('#hidden_id').length) {
                                            return $('#hidden_id').val();
                                        } else {
                                            return '';
                                        }
                                    },
                                },
                            },
                        },
                    },
                    messages: {
                        contact_id: {
                            remote: LANG.contact_id_already_exists,
                        },
                    },
                    submitHandler: function(form) {
                        $.ajax({
                            method: 'POST',
                            url: base_path + '/check-mobile',
                            dataType: 'json',
                            data: {
                                contact_id: function() {
                                    return $('#hidden_id').val();
                                },
                                mobile_number: function() {
                                    return $('#mobile').val();
                                },
                            },
                            beforeSend: function(xhr) {
                                __disable_submit_button($(form).find('button[type="submit"]'));
                            },
                            success: function(result) {
                                if (result.is_mobile_exists == true) {
                                    swal({
                                        title: LANG.sure,
                                        text: result.msg,
                                        icon: 'warning',
                                        buttons: true,
                                        dangerMode: true,
                                    }).then(willContinue => {
                                        if (willContinue) {
                                            submitQuickContactForm(form);
                                        } else {
                                            $('#mobile').select();
                                        }
                                    });
                                    
                                } else {
                                    submitQuickContactForm(form);
                                }
                            },
                        });
                    },
                });
            $('.contact_modal').on('hidden.bs.modal', function() {
                $('form#quick_add_contact')
                    .find('button[type="submit"]')
                    .removeAttr('disabled');
                $('form#quick_add_contact')[0].reset();
            });
            function submitQuickContactForm(form) {
                var data = $(form).serialize();
                $.ajax({
                    method: 'POST',
                    url: $(form).attr('action'),
                    dataType: 'json',
                    data: data,
                    beforeSend: function(xhr) {
                        __disable_submit_button($(form).find('button[type="submit"]'));
                    },
                    success: function(result) {
                        if (result.success == true) {
                            var name = result.data.name;

                            if (result.data.supplier_business_name) {
                                name += result.data.supplier_business_name;
                            }
                            
                            $('select#customer_id').append(
                                $('<option>', { value: result.data.id, text: name })
                            );
                            $('select#customer_id')
                                .val(result.data.id)
                                .trigger('change');
                            $('div.contact_modal').modal('hide');
                            update_shipping_address(result.data)
                            toastr.success(result.msg);
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                }); 
            }

              // discount side show
              $("#discount_percent").keyup(function(){
                
                if($(this).val() > 0){
                    $('#coupon_code').prop('disabled', true);
                    calculateAllPrice();
                }else{
                    calculateAllPrice();
                    $('#coupon_code').prop('disabled', false);
                    
                }

            });

            // coupon hide show
            $("#coupon_code").keyup(function(){
                
                if($(this).val() != ''){
                    $('#discount_percent').prop('disabled', true);
                }else{
                    $('#discount_percent').prop('disabled', false);
                    calculateAllPrice();
                }

            });

                // 
           
            $(document).on('change', '.payment_types_dropdown', function() {
                var payment_type = $(this).val();
                var default_accounts = $('#location_id').data('default_payment_accounts');
                var payment_row = $(this).closest('.payment_row');
                var amount_element = payment_row.find('.payment-amount');
                var account_dropdown = payment_row.find('.account-dropdown');

                if (payment_type && payment_type != 'advance') {
                    var payment_account_settings = default_accounts && default_accounts[payment_type];
                    var default_account = payment_account_settings && payment_account_settings.account
                        ? payment_account_settings.account
                        : '';
                    var row_index = payment_row.find('.payment_row_index').val();
                    account_dropdown = payment_row.find('select#account_' + row_index);

                    if (account_dropdown.length && default_accounts) {
                        account_dropdown.val(default_account).trigger('change');
                    }
                }

                if (payment_type === 'advance') {
                    var advance_balance = parseFloat($('#advance_balance').val()) || 0;
                    __write_number(amount_element, advance_balance);
                    amount_element.trigger('change');
                    if (typeof amount_element.rules === 'function') {
                        amount_element.rules('add', {
                            'max-value': advance_balance,
                            messages: { 'max-value': $('#advance_balance').data('error-msg') },
                        });
                    }
                    account_dropdown.prop('disabled', true).closest('.form-group').addClass('hide');
                } else {
                    if (typeof amount_element.rules === 'function') {
                        amount_element.rules('remove', 'max-value');
                    }
                    account_dropdown.prop('disabled', false).closest('.form-group').removeClass('hide');
                }

                var to_show = null;
                $(this)
                    .closest('.payment_row')
                    .find('.payment_details_div')
                    .each(function() {
                        if ($(this).attr('data-type') == payment_type) {
                            to_show = $(this);
                        } else {
                            if (!$(this).hasClass('hide')) {
                                $(this).addClass('hide');
                            }
                        }
                    });

                if (to_show && to_show.hasClass('hide')) {
                    to_show.removeClass('hide');
                    to_show
                        .find('input')
                        .filter(':visible:first')
                        .focus();
                }

                if ($(this).closest('.payment_row').find('.enable_cash_denomination_for_payment_methods').length) {
                    var payment_methods = JSON.parse($(this).closest('.payment_row').find('.enable_cash_denomination_for_payment_methods').val());
                    if (payment_methods.indexOf(payment_type) >= 0) {
                        $(this).closest('.payment_row').find('.cash_denomination_div').removeClass('hide');
                    } else {
                        $(this).closest('.payment_row').find('.cash_denomination_div').addClass('hide');
                    }
                }
            });

            $('.account-dropdown[data-select-default-account="1"]')
                .closest('.payment_row')
                .find('.payment_types_dropdown')
                .trigger('change');

            $('#add-payment-row').on('click', function() {
                var row_index = parseInt($('#payment_row_index').val(), 10) || 1;
                $.ajax({
                    method: 'GET',
                    url: '<?php echo e(action([Modules\Hms\Http\Controllers\HmsBookingController::class, 'paymentRow']), false); ?>',
                    data: {
                        row_index: row_index,
                        location_id: $('#location_id').val(),
                    },
                    dataType: 'html',
                    success: function(html) {
                        var row = $('<div class="box-body payment_row"></div>').html(html).appendTo('#payment_rows_div');
                        if (typeof __select2 === 'function') {
                            __select2(row.find('.select2'));
                        }
                        updateAdvancePaymentOptions($('#advance_balance').val());
                        row.find('.payment_types_dropdown').trigger('change');
                        var total = __read_number($('#total_booking_amount')) || 0;
                        var paid = 0;
                        $('#payment_rows_div .payment-amount').not(row.find('.payment-amount')).each(function() {
                            paid += __read_number($(this)) || 0;
                        });
                        __write_number(row.find('.payment-amount'), Math.max(0, total - paid));
                        row.find('.payment-amount').trigger('change').focus().select();
                        $('#payment_row_index').val(row_index + 1);
                    },
                });
            });

            $(document).on('click', '.remove_payment_row', function() {
                $(this).closest('.payment_row').remove();
                calculate_balance_due();
            });
            

            $(document).on('change', '.payment-amount', function() {
                    calculate_balance_due();
            });

            function calculate_balance_due() {
                var total_payable = __read_number($('#total_booking_amount'));
                var total_paying = 0;
                    $('.payment-amount')
                    .each(function() {
                        if (parseFloat($(this).val())) {
                            total_paying += __read_number($(this));
                        }
                    });
                var bal_due = total_payable - total_paying;
                var change_return = 0;

                //change_return
                if (bal_due < 0 || Math.abs(bal_due) < 0.05) {
                    __write_number($('input#change_return'), bal_due * -1);
                    $('span.change_return_span').text(__currency_trans_from_en(bal_due * -1, true));
                    change_return = bal_due * -1;
                    bal_due = 0;
                } else {
                    __write_number($('input#change_return'), 0);
                    $('span.change_return_span').text(__currency_trans_from_en(0, true));
                    change_return = 0;
                    
                }

                if (change_return !== 0) {
                    $('#change_return_payment_data').removeClass('hide');
                } else {
                    $('#change_return_payment_data').addClass('hide');
                }

                __write_number($('input#total_paying_input'), total_paying);
                $('span.total_paying').text(__currency_trans_from_en(total_paying, true));

                __write_number($('input#in_balance_due'), bal_due);
                $('span.balance_due').text(__currency_trans_from_en(bal_due, true));

                __highlight(bal_due * -1, $('span.balance_due'));
                __highlight(change_return * -1, $('span.change_return_span'));
            }

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>