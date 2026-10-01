<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('name', __('fuelstation::lang.name') . ':*'); ?>

            <?php echo Form::text('name', $dispenser->name ?? null, ['class' => 'form-control', 'required']); ?>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('code', __('fuelstation::lang.code') . ':'); ?>

            <?php echo Form::text('code', $dispenser->code ?? null, ['class' => 'form-control']); ?>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php
                $location_options = collect($business_locations);
                $selected_location_id = $dispenser->location_id ?? ($location_options->count() === 1 ? $location_options->keys()->first() : null);
            ?>
            <?php echo Form::label('location_id', __('fuelstation::lang.location') . ':*'); ?>

            <?php echo Form::select('location_id', $business_locations, $selected_location_id, ['class' => 'form-control select2', 'style' => 'width:100%', 'required', 'placeholder' => __('messages.please_select')]); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('model', __('fuelstation::lang.model') . ':'); ?>

            <?php echo Form::text('model', $dispenser->model ?? null, ['class' => 'form-control', 'placeholder' => 'e.g. MC2SR 2FP']); ?>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('serial_number', __('fuelstation::lang.serial_number') . ':'); ?>

            <?php echo Form::text('serial_number', $dispenser->serial_number ?? null, ['class' => 'form-control']); ?>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('status', __('fuelstation::lang.status') . ':'); ?>

            <?php echo Form::select('status', ['active' => __('fuelstation::lang.active'), 'inactive' => __('fuelstation::lang.inactive')], $dispenser->status ?? 'active', ['class' => 'form-control']); ?>

        </div>
    </div>
</div>
