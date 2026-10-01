<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('name', __('fuelstation::lang.tank_name') . ':*'); ?>

            <?php echo Form::text('name', $tank->name ?? null, ['class' => 'form-control', 'required', 'placeholder' => __('fuelstation::lang.tank_name')]); ?>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('code', __('fuelstation::lang.code') . ':'); ?>

            <?php echo Form::text('code', $tank->code ?? null, ['class' => 'form-control']); ?>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php
                $location_options = collect($business_locations);
                $selected_location_id = $tank->location_id ?? ($location_options->count() === 1 ? $location_options->keys()->first() : null);
            ?>
            <?php echo Form::label('location_id', __('fuelstation::lang.location') . ':*'); ?>

            <?php echo Form::select('location_id', $business_locations, $selected_location_id, ['class' => 'form-control select2', 'style' => 'width:100%', 'required', 'placeholder' => __('messages.please_select')]); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('product_id', __('fuelstation::lang.linked_product') . ':'); ?>

            <?php echo Form::select('product_id', $products, $tank->product_id ?? null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('messages.please_select')]); ?>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('fuel_type', __('fuelstation::lang.fuel_type') . ':'); ?>

            <?php echo Form::text('fuel_type', $tank->fuel_type ?? null, ['class' => 'form-control', 'placeholder' => 'Petrol, Diesel, Premium 95, Super, etc.']); ?>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('placement', __('fuelstation::lang.placement') . ':'); ?>

            <?php echo Form::select('placement', ['underground' => __('fuelstation::lang.underground'), 'aboveground' => __('fuelstation::lang.aboveground')], $tank->placement ?? 'underground', ['class' => 'form-control']); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <?php echo Form::label('capacity', __('fuelstation::lang.capacity') . ':*'); ?>

            <?php echo Form::number('capacity', $tank->capacity ?? null, ['class' => 'form-control', 'step' => 'any', 'required']); ?>

        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <?php echo Form::label('color', __('fuelstation::lang.graph_color') . ':'); ?>

            <?php echo Form::color('color', $tank->color ?? '#4F46E5', ['class' => 'form-control']); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('status', __('fuelstation::lang.status') . ':'); ?>

            <?php echo Form::select('status', ['active' => __('fuelstation::lang.active'), 'inactive' => __('fuelstation::lang.inactive')], $tank->status ?? 'active', ['class' => 'form-control']); ?>

        </div>
    </div>
</div>
