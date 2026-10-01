<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">  
      <div class="modal-header">
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo app('translator')->get('hms::lang.booking'); ?> - <?php echo e($transaction->ref_no, false); ?></h4>
      </div>
  
      <div class="modal-body">
            <div class="row">
                <div class="col-md-8">
                            <div class="col-md-6">
                                <b><?php echo e(__('sale.customer_name'), false); ?>:</b>
                                    <?php echo e($transaction->contact->name, false); ?><br>
                                <b><?php echo e(__('business.address'), false); ?>:</b><br>
                                <?php if(!empty($transaction->billing_address())): ?>
                                <?php echo e($transaction->billing_address(), false); ?>

                                <?php else: ?>
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
                                <?php if($transaction->contact->mobile): ?>
                                <br>
                                    <?php echo e(__('contact.mobile'), false); ?>: <?php echo e($transaction->contact->mobile, false); ?>

                                <?php endif; ?>
                                <?php if($transaction->contact->alternate_number): ?>
                                <br>
                                    <?php echo e(__('contact.alternate_contact_number'), false); ?>:
                                    <?php echo e($transaction->contact->alternate_number, false); ?>

                                <?php endif; ?>
                                <?php if($transaction->contact->landline): ?>
                                    <br>
                                    <?php echo e(__('contact.landline'), false); ?>:
                                    <?php echo e($transaction->contact->landline, false); ?>

                                <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                
                                <?php if($transaction->status == 'confirmed'): ?>
                                    <div class="form-group">
                                        <?php echo Form::label('status', __('hms::lang.status') . ':'); ?>

                                        <h6 class="bg-green badge"><?php echo e(ucfirst($transaction->status), false); ?></h6>
                                    </div>
                                <?php elseif($transaction->status == 'pending'): ?>
                                    <div class="form-group">
                                        <?php echo Form::label('status', __('hms::lang.status') . ':'); ?>

                                        <h6 class="bg-yellow badge"><?php echo e(ucfirst($transaction->status), false); ?></h6>
                                    </div>
                                <?php elseif($transaction->status == 'cancelled'): ?>
                                    <div class="form-group">
                                        <?php echo Form::label('status', __('hms::lang.status') . ':'); ?>

                                        <h6 class="bg-red badge"><?php echo e(ucfirst($transaction->status), false); ?></h6>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo Form::label('arrival_date', __('hms::lang.arrival_date') . ':'); ?>

                                    <?php echo e(\Carbon::createFromTimestamp(strtotime($transaction->hms_booking_arrival_date_time))->format(session('business.date_format')), false); ?>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo Form::label('arrival_time', __('hms::lang.arrival_time') . ':'); ?>

                                    <?php echo e(\Carbon::createFromTimestamp(strtotime($transaction->hms_booking_arrival_date_time))->format('h:i A'), false); ?>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo Form::label('departure_date', __('hms::lang.departure_date') . ':'); ?>

                                    <?php echo e(\Carbon::createFromTimestamp(strtotime($transaction->hms_booking_departure_date_time))->format(session('business.date_format')), false); ?>

                                </div>
                                <div class="days_count"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo Form::label('departure_time', __('hms::lang.departure_time') . ':'); ?>

                                    <?php echo e(\Carbon::createFromTimestamp(strtotime($transaction->hms_booking_departure_date_time))->format('h:i A'), false); ?>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div>
                                <h3 class="col-md-12">
                                    <?php echo app('translator')->get('hms::lang.rooms_and_extras'); ?>
                                </h3>
                            </div>
                            <div class="col-md-8 booking_add_room">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-light-green">
                                            <th><?php echo app('translator')->get('hms::lang.type'); ?></th>
                                            <th><?php echo app('translator')->get('hms::lang.room_no'); ?></th>
                                            <th><?php echo app('translator')->get('hms::lang.no_of_adult'); ?></th>
                                            <th><?php echo app('translator')->get('hms::lang.no_of_child'); ?></th>
                                            <th><?php echo app('translator')->get('hms::lang.price'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $booking_rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
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
                                                <td class="price-td">
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
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><?php echo app('translator')->get('hms::lang.extras'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $extras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $extra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(in_array($extra->id, $extras_id)): ?>
                                            <tr>
                                                <td>
                                                    <?php echo e($extra->name, false); ?> /<span class="display_currency" data-currency_symbol="true"> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $extra->price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> </span> - <?php echo e(str_replace("_", " ", $extra->price_per), false); ?>

                                                    
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                        <?php echo app('translator')->get('hms::lang.status'); ?>
                                        <span class="pull-right status_value"><?php echo e($transaction->status, false); ?></span>
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <strong><?php echo app('translator')->get('hms::lang.room_price'); ?> :</strong>
                                            </div>
                                            <div class="col-xs-6 text-right">
                                                <strong class="room_price" > <span class="display_currency" data-currency_symbol="true"> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $transaction->room_price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> </span></strong>
                                            </div>
                                        </div>
                                            <div class="row">
                                            <div class="col-xs-6">
                                                <strong><?php echo app('translator')->get('hms::lang.extra_price'); ?> :</strong>
                                            </div>
                                            <div class="col-xs-6 text-right">
                                                <strong class="extra_price"><span class="display_currency" data-currency_symbol="true"> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $transaction->extra_price, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> </span></strong>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <?php
                                            $discount_percent_disable  = 0;
                
                                            if(!empty($transaction->hms_coupon_id)){
                                                $discount_percent_disable = 1;
                                            }
                
                                        ?>
                                        <?php if($discount_percent_disable == 0 && $transaction->discount_amount > 0): ?>
                                            <div class="col-xs-6">
                                                <strong><?php echo app('translator')->get('hms::lang.discount'); ?>:</strong> ( <?php echo e(number_format($transaction->discount_amount, 2), false); ?> % )
                                            </div>
                                            <div class="col-xs-6 text-right">
                                            <strong class="total_discount"> <span class="display_currency" data-currency_symbol="true"> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $transaction->discount_amount * ( $transaction->extra_price + $transaction->room_price ) / 100, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> </span></strong>
                                        <?php else: ?>
                                        <div class="col-xs-6">
                                                <strong><?php echo app('translator')->get('hms::lang.discount'); ?>:</strong>
                                            </div>
                                            <div class="col-xs-6 text-right">
                                            <strong class="total_discount"> <span class="display_currency" data-currency_symbol="true"> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $transaction->discount_amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> </span></strong>
                                        <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <hr>
                                            <div class="col-xs-6">
                                                <strong><?php echo app('translator')->get('hms::lang.total'); ?>:</strong>
                                            </div>
                                            <div class="col-xs-6 text-right">
                                                <strong class="total"> <span class="display_currency" data-currency_symbol="true"> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $transaction->final_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> </span></strong>
                                            </div>
                                            <div class="col-xs-6">
                                                <strong><?php echo app('translator')->get('hms::lang.total_paid'); ?>:</strong>
                                            </div>
                                            <div class="col-xs-6 text-right">
                                                <strong class="total"> <span class="display_currency" data-currency_symbol="true"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $transaction->total_paid, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> </span></strong>
                                            </div>
                                            <div class="col-xs-6">
                                                <strong><?php echo app('translator')->get('hms::lang.due'); ?>:</strong>
                                            </div>
                                            <div class="col-xs-6 text-right">
                                                <strong class="total"> <span class="display_currency" data-currency_symbol="true"> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $transaction->final_total - $transaction->total_paid, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> </span></strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if(!empty($transaction->coupon_code)): ?>
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

                                                    <?php echo e($transaction->coupon_code, false); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                        <div>
                </div>
            </div>
        </div>
    <?php echo Form::open(['url' => action([\Modules\Hms\Http\Controllers\HmsBookingController::class, 'post_check_in_out'], $transaction->id), 'method' => 'put', 'id' => 'check_in_out' ]); ?>

    <div class="col-md-12">
        <div class="col-md-3">
                <?php if(empty($transaction->check_in)): ?>
                    <div class="form-group">
                        <?php echo Form::label('date_from', __('hms::lang.check_in_date_time') . '*'); ?>

                        <?php echo Form::text('in_out_date_time', null, [
                            'class' => 'form-control date_picker',
                            'required',
                            'readonly',
                        ]); ?>

                    </div>
                <?php elseif(!empty($transaction->check_in) && empty($transaction->check_out)): ?>
                    <div class="form-group">
                        <?php echo Form::label('date_from', __('hms::lang.check_out_date_time') . '*'); ?>

                        <?php echo Form::text('in_out_date_time', null, [
                            'class' => 'form-control date_picker',
                            'required',
                            'readonly',
                        ]); ?>

                    </div>
                <?php endif; ?>
        </div>
    </div>
    <div class="modal-footer">
        <?php if(empty($transaction->check_in)): ?>
            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'hms::lang.confirm_check_in' ); ?> </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
        <?php elseif(!empty($transaction->check_in) && empty($transaction->check_out)): ?>
            <?php if($transaction->payment_status != 'paid'): ?>
                <h4><?php echo app('translator')->get('hms::lang.check_out_payment_help_text'); ?></h4>
            <?php endif; ?>
            <button type="submit" <?php if($transaction->payment_status != 'paid'): ?> disabled <?php endif; ?> class="btn btn-primary"><?php echo app('translator')->get( 'hms::lang.confirm_check_out' ); ?> </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
        <?php endif; ?>
    </div>
    <?php echo Form::close(); ?>

  
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
