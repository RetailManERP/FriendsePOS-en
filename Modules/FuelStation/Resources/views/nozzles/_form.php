<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('name', __('fuelstation::lang.name') . ':*'); ?>

            <?php echo Form::text('name', $nozzle->name ?? null, ['class' => 'form-control', 'required']); ?>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('code', __('fuelstation::lang.code') . ':'); ?>

            <?php echo Form::text('code', $nozzle->code ?? null, ['class' => 'form-control']); ?>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('dispenser_id', __('fuelstation::lang.dispenser') . ':*'); ?>

            <?php echo Form::select('dispenser_id', $dispensers, $nozzle->dispenser_id ?? null, ['class' => 'form-control select2', 'style' => 'width:100%', 'required', 'placeholder' => __('messages.please_select')]); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('tank_id', __('fuelstation::lang.tank') . ':*'); ?>

            <?php echo Form::select('tank_id', $tanks, $nozzle->tank_id ?? null, ['class' => 'form-control select2', 'style' => 'width:100%', 'required', 'placeholder' => __('messages.please_select')]); ?>

            <p class="help-block"><?php echo app('translator')->get('fuelstation::lang.nozzle_product_from_tank'); ?></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('opening_reading', __('fuelstation::lang.opening_reading') . ':'); ?>

            <?php echo Form::number('opening_reading', $nozzle->opening_reading ?? 0, ['class' => 'form-control', 'step' => 'any']); ?>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('status', __('fuelstation::lang.status') . ':'); ?>

            <?php echo Form::select('status', ['active' => __('fuelstation::lang.status_active'), 'inactive' => __('fuelstation::lang.status_inactive'), 'maintenance' => __('fuelstation::lang.status_maintenance')], $nozzle->status ?? 'active', ['class' => 'form-control']); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('location_id', __('fuelstation::lang.location') . ':'); ?>

            <?php echo Form::select('location_id', $business_locations, $nozzle->location_id ?? null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('fuelstation::lang.nozzle_location_from_tank')]); ?>

        </div>
    </div>
</div>
