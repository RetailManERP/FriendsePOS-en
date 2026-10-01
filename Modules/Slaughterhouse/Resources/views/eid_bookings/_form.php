<?php
    $booking = $booking ?? null;
?>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('eid_season_id', __('slaughterhouse::lang.eid_season') . ':*'); ?>

            <?php echo Form::select('eid_season_id', $seasons, old('eid_season_id', $booking->eid_season_id ?? null), ['class' => 'form-control select2', 'style' => 'width:100%', 'required', 'placeholder' => __('messages.please_select')]); ?>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('location_id', __('slaughterhouse::lang.location') . ':'); ?>

            <?php echo Form::select('location_id', $business_locations, old('location_id', $booking->location_id ?? null), ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('messages.please_select')]); ?>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('preferred_day', __('slaughterhouse::lang.preferred_day') . ':*'); ?>

            <?php echo Form::select('preferred_day', [1 => 'Day 1', 2 => 'Day 2', 3 => 'Day 3'], old('preferred_day', $booking->preferred_day ?? 1), ['class' => 'form-control', 'required']); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('customer_name', __('slaughterhouse::lang.customer_name') . ':*'); ?>

            <?php echo Form::text('customer_name', old('customer_name', $booking->customer_name ?? null), ['class' => 'form-control', 'required']); ?>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('mobile', __('slaughterhouse::lang.mobile') . ':'); ?>

            <?php echo Form::text('mobile', old('mobile', $booking->mobile ?? null), ['class' => 'form-control']); ?>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('preferred_slot', __('slaughterhouse::lang.preferred_slot') . ':'); ?>

            <?php echo Form::text('preferred_slot', old('preferred_slot', $booking->preferred_slot ?? null), ['class' => 'form-control', 'placeholder' => '09:00 - 11:00']); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('booking_type', __('slaughterhouse::lang.booking_type') . ':*'); ?>

            <?php echo Form::select('booking_type', $booking_types, old('booking_type', $booking->booking_type ?? 'share'), ['class' => 'form-control', 'required']); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('animal_type', __('slaughterhouse::lang.animal_type') . ':*'); ?>

            <?php echo Form::select('animal_type', $animal_types, old('animal_type', $booking->animal_type ?? 'cow'), ['class' => 'form-control', 'required']); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('share_count', __('slaughterhouse::lang.share_count') . ':*'); ?>

            <?php echo Form::number('share_count', old('share_count', $booking->share_count ?? 1), ['class' => 'form-control', 'required', 'min' => 1]); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('total_shares', __('slaughterhouse::lang.total_shares') . ':*'); ?>

            <?php echo Form::number('total_shares', old('total_shares', $booking->total_shares ?? 7), ['class' => 'form-control', 'required', 'min' => 1]); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('booking_amount', __('slaughterhouse::lang.booking_amount') . ':'); ?>

            <?php echo Form::number('booking_amount', old('booking_amount', $booking->booking_amount ?? 0), ['class' => 'form-control', 'step' => 'any', 'min' => 0]); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('advance_amount', __('slaughterhouse::lang.advance_amount') . ':'); ?>

            <?php echo Form::number('advance_amount', old('advance_amount', $booking->advance_amount ?? 0), ['class' => 'form-control', 'step' => 'any', 'min' => 0]); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('delivery_type', __('slaughterhouse::lang.delivery_type') . ':*'); ?>

            <?php echo Form::select('delivery_type', $delivery_types, old('delivery_type', $booking->delivery_type ?? 'pickup'), ['class' => 'form-control', 'required']); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('delivery_status', __('slaughterhouse::lang.delivery_status') . ':*'); ?>

            <?php echo Form::select('delivery_status', ['pending' => __('slaughterhouse::lang.pending'), 'scheduled' => __('slaughterhouse::lang.scheduled'), 'out_for_delivery' => __('slaughterhouse::lang.out_for_delivery'), 'delivered' => __('slaughterhouse::lang.delivered'), 'cancelled' => __('slaughterhouse::lang.cancelled')], old('delivery_status', $booking->delivery_status ?? 'pending'), ['class' => 'form-control', 'required']); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('fulfillment_status', __('slaughterhouse::lang.fulfillment_status') . ':*'); ?>

            <?php echo Form::select('fulfillment_status', ['booked' => __('slaughterhouse::lang.booked'), 'allocated' => __('slaughterhouse::lang.allocated'), 'in_slaughter' => __('slaughterhouse::lang.in_slaughter'), 'cutting' => __('slaughterhouse::lang.cutting'), 'packing' => __('slaughterhouse::lang.packing'), 'ready' => __('slaughterhouse::lang.ready'), 'delivered' => __('slaughterhouse::lang.delivered'), 'cancelled' => __('slaughterhouse::lang.cancelled')], old('fulfillment_status', $booking->fulfillment_status ?? 'booked'), ['class' => 'form-control', 'required']); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('gross_meat_weight', __('slaughterhouse::lang.gross_meat_weight') . ':'); ?>

            <?php echo Form::number('gross_meat_weight', old('gross_meat_weight', $booking->gross_meat_weight ?? null), ['class' => 'form-control', 'step' => 'any', 'min' => 0]); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('net_meat_weight', __('slaughterhouse::lang.net_meat_weight') . ':'); ?>

            <?php echo Form::number('net_meat_weight', old('net_meat_weight', $booking->net_meat_weight ?? null), ['class' => 'form-control', 'step' => 'any', 'min' => 0]); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('package_count', __('slaughterhouse::lang.package_count') . ':'); ?>

            <?php echo Form::number('package_count', old('package_count', $booking->package_count ?? 0), ['class' => 'form-control', 'min' => 0]); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <?php echo Form::label('address', __('slaughterhouse::lang.address') . ':'); ?>

            <?php echo Form::textarea('address', old('address', $booking->address ?? null), ['class' => 'form-control', 'rows' => 3]); ?>

        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <?php echo Form::label('notes', __('slaughterhouse::lang.notes') . ':'); ?>

            <?php echo Form::textarea('notes', old('notes', $booking->notes ?? null), ['class' => 'form-control', 'rows' => 3]); ?>

        </div>
    </div>
</div>
