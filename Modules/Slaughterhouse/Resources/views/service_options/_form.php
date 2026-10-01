<?php $service = $service ?? null; ?>
<div class="row">
    <div class="col-md-4"><div class="form-group"><?php echo Form::label('name', __('messages.name') . ':*'); ?><?php echo Form::text('name', old('name', $service->name ?? null), ['class' => 'form-control', 'required']); ?></div></div>
    <div class="col-md-2"><div class="form-group"><?php echo Form::label('code', 'Code:*'); ?><?php echo Form::text('code', old('code', $service->code ?? null), ['class' => 'form-control', 'required']); ?></div></div>
    <div class="col-md-3"><div class="form-group"><?php echo Form::label('fee', __('slaughterhouse::lang.service_fee') . ':'); ?><?php echo Form::number('fee', old('fee', $service->fee ?? 0), ['class' => 'form-control', 'step' => 'any', 'min' => 0]); ?></div></div>
    <div class="col-md-3"><div class="form-group"><?php echo Form::label('status', __('slaughterhouse::lang.status') . ':*'); ?><?php echo Form::select('status', ['active' => __('slaughterhouse::lang.active'), 'inactive' => __('slaughterhouse::lang.inactive')], old('status', $service->status ?? 'active'), ['class' => 'form-control', 'required']); ?></div></div>
</div>
<div class="row">
    <div class="col-md-4"><div class="form-group"><?php echo Form::label('fulfillment_route', __('slaughterhouse::lang.fulfillment_route') . ':*'); ?><?php echo Form::select('fulfillment_route', ['collect' => __('slaughterhouse::lang.collect'), 'delivery' => __('slaughterhouse::lang.delivery'), 'coldroom' => __('slaughterhouse::lang.coldroom'), 'distribution' => __('slaughterhouse::lang.distribution'), 'take_alive' => __('slaughterhouse::lang.take_alive')], old('fulfillment_route', $service->fulfillment_route ?? 'collect'), ['class' => 'form-control', 'required']); ?></div></div>
    <div class="col-md-2"><div class="checkbox"><label><?php echo Form::hidden('requires_cutting', 0); ?><?php echo Form::checkbox('requires_cutting', 1, old('requires_cutting', $service->requires_cutting ?? false)); ?> <?php echo app('translator')->get('slaughterhouse::lang.requires_cutting'); ?></label></div></div>
    <div class="col-md-2"><div class="checkbox"><label><?php echo Form::hidden('requires_delivery', 0); ?><?php echo Form::checkbox('requires_delivery', 1, old('requires_delivery', $service->requires_delivery ?? false)); ?> <?php echo app('translator')->get('slaughterhouse::lang.requires_delivery'); ?></label></div></div>
    <div class="col-md-2"><div class="checkbox"><label><?php echo Form::hidden('is_distribution', 0); ?><?php echo Form::checkbox('is_distribution', 1, old('is_distribution', $service->is_distribution ?? false)); ?> <?php echo app('translator')->get('slaughterhouse::lang.is_distribution'); ?></label></div></div>
</div>
<div class="row">
    <div class="col-md-4"><div class="form-group"><?php echo Form::label('revenue_account', 'Revenue Account:'); ?><?php echo Form::text('revenue_account', old('revenue_account', $service->revenue_account ?? null), ['class' => 'form-control']); ?></div></div>
    <div class="col-md-8"><div class="form-group"><?php echo Form::label('description', 'Description:'); ?><?php echo Form::textarea('description', old('description', $service->description ?? null), ['class' => 'form-control', 'rows' => 2]); ?></div></div>
</div>
