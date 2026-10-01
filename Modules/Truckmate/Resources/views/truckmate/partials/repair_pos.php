<?php
$truckmate = [];
if (!empty($view_data['job_sheet'])) {
$truckmate['truckmate_job_sheet_id'] = $view_data['job_sheet']['id'];
$truckmate['truckmate_due_date'] = $view_data['job_sheet']['delivery_date'];
$truckmate['truckmate_completed_on'] = null;
$truckmate['truckmate_warranty_id'] = null;
$truckmate['truckmate_status_id'] = $view_data['job_sheet']['status_id'];
$truckmate['truckmate_brand_id'] = $view_data['job_sheet']['brand_id'];
$truckmate['truckmate_device_id'] = $view_data['job_sheet']['device_id'];
$truckmate['truckmate_model_id'] = $view_data['job_sheet']['device_model_id'];
$truckmate['truckmate_serial_no'] = $view_data['job_sheet']['serial_no'];
$truckmate['truckmate_defects'] = $view_data['job_sheet']['defects'];
$truckmate['res_waiter_id'] = $view_data['job_sheet']['service_staff'];
} elseif (!empty($transaction)) {
$truckmate['truckmate_due_date'] = $transaction['truckmate_due_date'];
$truckmate['truckmate_completed_on'] = $transaction['truckmate_completed_on'];
$truckmate['truckmate_warranty_id'] = $transaction['truckmate_warranty_id'];
$truckmate['truckmate_status_id'] = $transaction['truckmate_status_id'];
$truckmate['truckmate_brand_id'] = $transaction['truckmate_brand_id'];
$truckmate['truckmate_device_id'] = $transaction['truckmate_device_id'];
$truckmate['truckmate_model_id'] = $transaction['truckmate_model_id'];
$truckmate['truckmate_serial_no'] = $transaction['truckmate_serial_no'];
$truckmate['truckmate_defects'] = $transaction['truckmate_defects'];
}

$defects = [];
if(!empty($view_data['truckmate_settings'])) {
$defects = isset($view_data['truckmate_settings']['problem_reported_by_customer']) ? explode(',',
$view_data['truckmate_settings']['problem_reported_by_customer']) : [];
}
?>

<?php echo Form::hidden('has_module_data', true); ?>



<?php if(!empty($view_data['parts'])): ?>
<input type="hidden" id="pos_truckmate_parts_used" value="<?php echo e(json_encode($view_data['parts']), false); ?>">
<?php endif; ?>

<?php if(!empty($defects)): ?>
<input type="hidden" id="pos_truckmate_defects_suggestion" value="<?php echo e(json_encode($defects), false); ?>">
<?php endif; ?>

<?php if(!empty($view_data['job_sheet']['location_id'])): ?>
<input type="hidden" id="job_sheet_location_id" value="<?php echo e($view_data['job_sheet']['location_id'], false); ?>">
<?php endif; ?>


<input type="hidden" id="truckmate_transaction_id" value="<?php if(!empty($transaction->id)): ?><?php echo e($transaction->id, false); ?><?php endif; ?>">
<input type="hidden" id="truckmate_job_sheet_id" name="truckmate_job_sheet_id"
    value="<?php if(!empty($truckmate['truckmate_job_sheet_id'])): ?><?php echo e($truckmate['truckmate_job_sheet_id'], false); ?><?php endif; ?>">

<?php if(!empty($truckmate['res_waiter_id'])): ?>
<input type="hidden" id="truckmate_technician" value="<?php echo e($truckmate['res_waiter_id'], false); ?>">
<?php endif; ?>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo Form::label('truckmate_due_date', __('truckmate::lang.delivery_date') . ':'); ?>

            <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('truckmate::lang.truckmate_due_date_tooltip') . '"></i>';
                }
            ?>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>
                <?php echo Form::text('truckmate_due_date', !empty($truckmate['truckmate_due_date']) ?
                \Carbon::createFromTimestamp(strtotime($truckmate['truckmate_due_date']))->format(session('business.date_format') . ' ' . 'h:i A') : null, ['class' => 'form-control', 'readonly']); ?>

                <span class="input-group-addon">
                    <i class="fas fa-times-circle cursor-pointer clear_truckmate_due_date"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo Form::label('truckmate_completed_on', __('truckmate::lang.truckmate_completed_on') . ':'); ?>

            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>
                <?php echo Form::text('truckmate_completed_on', !empty($truckmate['truckmate_completed_on']) ?
                \Carbon::createFromTimestamp(strtotime($truckmate['truckmate_completed_on']))->format(session('business.date_format') . ' ' . 'h:i A') : null, ['class' => 'form-control', 'readonly']); ?>

                <span class="input-group-addon">
                    <i class="fas fa-times-circle cursor-pointer clear_truckmate_completed_on"></i>
                </span>
            </div>
        </div>
    </div>
    <?php if(!empty($view_data['warranties'])): ?>
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo Form::label('truckmate_warranty_id', __('lang_v1.warranty') . ':'); ?>

            <?php echo Form::select('truckmate_warranty_id', $view_data['warranties'], !empty($truckmate['truckmate_warranty_id']) ?
            $truckmate['truckmate_warranty_id'] : null, ['class' => 'form-control select2', 'placeholder' =>
            __('messages.please_select'), 'style' => 'width: 100%;']); ?>

        </div>
    </div>
    <?php endif; ?>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="truckmate_status_id"><?php echo e(__('sale.status') . ':', false); ?></label>
            <select name="truckmate_status_id" class="form-control" id="truckmate_status_id" required>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo Form::label('truckmate_brand_id', __('product.brand') . ':'); ?>

            <?php echo Form::select('truckmate_brand_id', $view_data['brands'], !empty($truckmate['truckmate_brand_id']) ?
            $truckmate['truckmate_brand_id'] : null, ['class' => 'form-control select2', 'placeholder' =>
            __('messages.please_select'), 'style' => 'width: 100%;']); ?>

        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo Form::label('truckmate_device_id', __('truckmate::lang.device') . ':'); ?>

            <?php echo Form::select('truckmate_device_id', $view_data['devices'], !empty($truckmate['truckmate_device_id']) ?
            $truckmate['truckmate_device_id'] : null, ['class' => 'form-control select2', 'placeholder' =>
            __('messages.please_select'), 'style' => 'width: 100%;']); ?>

        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo Form::label('truckmate_model_id', __('truckmate::lang.device_model') . ':'); ?>

            <?php echo Form::select('truckmate_model_id', $view_data['device_models'], !empty($truckmate['truckmate_model_id']) ?
            $truckmate['truckmate_model_id'] : null, ['class' => 'form-control select2', 'placeholder' =>
            __('messages.please_select'), 'style' => 'width: 100%;']); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo Form::label('truckmate_serial_no', __('truckmate::lang.serial_no') . ':'); ?>

            <?php echo Form::text('truckmate_serial_no', !empty($truckmate['truckmate_serial_no']) ? $truckmate['truckmate_serial_no'] : null,
            ['class' => 'form-control', 'placeholder' => __('truckmate::lang.serial_no')]); ?>

        </div>
    </div>
    <div class="col-sm-6 mt-15">
        <div class="btn-group mt-5" role="group">
            <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#checklist_modal"><i
                    class="fa fa-plus"></i> <?php echo app('translator')->get('truckmate::lang.pre_truckmate_checklist'); ?></button>
            <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#security_modal"><i
                    class="fa fa-lock"></i> <?php echo app('translator')->get('truckmate::lang.security'); ?></button>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <?php echo Form::label('truckmate_defects',__('truckmate::lang.problem_reported_by_customer') . ':'); ?> <br>
            <?php echo Form::textarea('truckmate_defects', !empty($truckmate['truckmate_defects']) ? $truckmate['truckmate_defects'] : null,
            ['class' => 'tags-look', 'rows' => 3]); ?>

        </div>
    </div>
</div>
<?php echo $__env->make('truckmate::truckmate.partials.security_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('truckmate::truckmate.partials.checklist_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<style type="text/css">
#product_category_div,
#feature_product_div,
#product_brand_div {
    display: none !important;
}
</style>