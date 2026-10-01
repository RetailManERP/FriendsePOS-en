<?php $animal_number = $animal_number ?? null; ?>
<div class="row">
    <div class="col-md-3"><div class="form-group"><?php echo Form::label('eid_booking_id', __('slaughterhouse::lang.eid_booking') . ':*'); ?><?php echo Form::select('eid_booking_id', $bookings, old('eid_booking_id', $animal_number->eid_booking_id ?? null), ['class' => 'form-control select2', 'style' => 'width:100%', 'required', 'placeholder' => __('messages.please_select')]); ?></div></div>
    <div class="col-md-3"><div class="form-group"><?php echo Form::label('animal_number', __('slaughterhouse::lang.animal_number') . ':'); ?><?php echo Form::text('animal_number', old('animal_number', $animal_number->animal_number ?? null), ['class' => 'form-control', 'placeholder' => 'Auto if blank']); ?></div></div>
    <div class="col-md-3"><div class="form-group"><?php echo Form::label('animal_type', __('slaughterhouse::lang.animal_type') . ':'); ?><?php echo Form::select('animal_type', $animal_types, old('animal_type', $animal_number->animal_type ?? null), ['class' => 'form-control', 'placeholder' => __('messages.please_select')]); ?></div></div>
    <div class="col-md-3"><div class="form-group"><?php echo Form::label('location_id', __('slaughterhouse::lang.location') . ':'); ?><?php echo Form::select('location_id', $business_locations, old('location_id', $animal_number->location_id ?? null), ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('messages.please_select')]); ?></div></div>
</div>
<div class="row">
    <div class="col-md-3"><div class="form-group"><?php echo Form::label('service_option_id', __('slaughterhouse::lang.service_option') . ':'); ?><?php echo Form::select('service_option_id', $service_options, old('service_option_id', $animal_number->service_option_id ?? null), ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('messages.please_select')]); ?></div></div>
    <div class="col-md-3"><div class="form-group"><?php echo Form::label('cutting_type_id', __('slaughterhouse::lang.cutting_type') . ':'); ?><?php echo Form::select('cutting_type_id', $cutting_types, old('cutting_type_id', $animal_number->cutting_type_id ?? null), ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('messages.please_select')]); ?></div></div>
    <div class="col-md-3"><div class="form-group"><?php echo Form::label('base_animal_cost', __('slaughterhouse::lang.base_animal_cost') . ':'); ?><?php echo Form::number('base_animal_cost', old('base_animal_cost', $animal_number->base_animal_cost ?? 0), ['class' => 'form-control', 'step' => 'any', 'min' => 0]); ?></div></div>
    <div class="col-md-3"><div class="form-group"><?php echo Form::label('service_fee', __('slaughterhouse::lang.service_fee') . ':'); ?><?php echo Form::number('service_fee', old('service_fee', $animal_number->service_fee ?? 0), ['class' => 'form-control', 'step' => 'any', 'min' => 0]); ?></div></div>
</div>
<div class="row">
    <div class="col-md-3"><div class="checkbox"><label><?php echo Form::hidden('is_distribution', 0); ?><?php echo Form::checkbox('is_distribution', 1, old('is_distribution', $animal_number->is_distribution ?? false)); ?> <?php echo app('translator')->get('slaughterhouse::lang.is_distribution'); ?></label></div></div>
    <div class="col-md-3"><div class="checkbox"><label><?php echo Form::hidden('full_distribution', 0); ?><?php echo Form::checkbox('full_distribution', 1, old('full_distribution', $animal_number->full_distribution ?? false)); ?> <?php echo app('translator')->get('slaughterhouse::lang.full_distribution'); ?></label></div></div>
    <div class="col-md-6"><div class="form-group"><?php echo Form::label('specific_parts_taken', __('slaughterhouse::lang.specific_parts_taken') . ':'); ?><?php echo Form::text('specific_parts_taken', old('specific_parts_taken', $animal_number->specific_parts_taken ?? null), ['class' => 'form-control']); ?></div></div>
</div>
<div class="row">
    <div class="col-md-3"><div class="form-group"><?php echo Form::label('arrival_slot', __('slaughterhouse::lang.arrival_slot') . ':'); ?><?php echo Form::input('datetime-local', 'arrival_slot', old('arrival_slot', optional($animal_number->arrival_slot ?? null)->format('Y-m-d\\TH:i')), ['class' => 'form-control']); ?></div></div>
    <div class="col-md-9"><div class="form-group"><?php echo Form::label('cutting_instructions', __('slaughterhouse::lang.cutting_instructions') . ':'); ?><?php echo Form::textarea('cutting_instructions', old('cutting_instructions', $animal_number->cutting_instructions ?? null), ['class' => 'form-control', 'rows' => 2]); ?></div></div>
</div>
<div class="row">
    <div class="col-md-12"><div class="form-group"><?php echo Form::label('notes', __('slaughterhouse::lang.notes') . ':'); ?><?php echo Form::textarea('notes', old('notes', $animal_number->notes ?? null), ['class' => 'form-control', 'rows' => 2]); ?></div></div>
</div>
