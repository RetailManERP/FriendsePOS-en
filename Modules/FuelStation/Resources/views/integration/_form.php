<?php
    $cfg = isset($integration) ? ($integration->connection_config ?? []) : [];
?>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('brand', __('fuelstation::lang.brand') . ':'); ?>

            <?php echo Form::text('brand', $integration->brand ?? null, ['class' => 'form-control', 'placeholder' => 'e.g. EnE / Gilbarco / Tatsuno']); ?>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('machine_model', __('fuelstation::lang.machine_model') . ':'); ?>

            <?php echo Form::text('machine_model', $integration->machine_model ?? null, ['class' => 'form-control', 'placeholder' => 'e.g. MC2SR 2FP']); ?>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('protocol', __('fuelstation::lang.protocol') . ':*'); ?>

            <?php echo Form::select('protocol', $protocols, $integration->protocol ?? 'manual', ['class' => 'form-control', 'required', 'id' => 'protocol']); ?>

        </div>
    </div>
</div>
<div class="row" id="tcp_fields" style="display:none;">
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('ip', __('fuelstation::lang.ip_address') . ':'); ?>

            <?php echo Form::text('ip', $cfg['ip'] ?? null, ['class' => 'form-control', 'placeholder' => '192.168.1.50']); ?>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('port', __('fuelstation::lang.port') . ':'); ?>

            <?php echo Form::text('port', $cfg['port'] ?? null, ['class' => 'form-control', 'placeholder' => '5000']); ?>

        </div>
    </div>
</div>
<div class="row" id="serial_fields" style="display:none;">
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('port_name', __('fuelstation::lang.serial_port') . ':'); ?>

            <?php echo Form::text('port_name', $cfg['port_name'] ?? null, ['class' => 'form-control', 'placeholder' => 'COM3 / /dev/ttyUSB0']); ?>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('baud_rate', __('fuelstation::lang.baud_rate') . ':'); ?>

            <?php echo Form::text('baud_rate', $cfg['baud_rate'] ?? null, ['class' => 'form-control', 'placeholder' => '9600']); ?>

        </div>
    </div>
</div>
<div class="row" id="api_fields" style="display:none;">
    <div class="col-md-6">
        <div class="form-group">
            <?php echo Form::label('api_url', __('fuelstation::lang.api_url') . ':'); ?>

            <?php echo Form::text('api_url', $cfg['api_url'] ?? null, ['class' => 'form-control', 'placeholder' => 'https://...']); ?>

        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <?php echo Form::label('api_key', __('fuelstation::lang.api_key') . ':'); ?>

            <?php echo Form::text('api_key', $cfg['api_key'] ?? null, ['class' => 'form-control']); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="checkbox">
            <label>
                <?php echo Form::checkbox('is_active', 1, isset($integration) ? (bool) $integration->is_active : true); ?>

                <?php echo app('translator')->get('fuelstation::lang.active'); ?>
            </label>
        </div>
    </div>
</div>
