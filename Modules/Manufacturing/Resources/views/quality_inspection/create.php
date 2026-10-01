
<?php $__env->startSection('title', __('manufacturing::lang.add_inspection')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('manufacturing::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><i class="fas fa-clipboard-check"></i> <?php echo app('translator')->get('manufacturing::lang.add_inspection'); ?></h1>
</section>

<section class="content">
    <?php echo Form::open(['url' => action([\Modules\Manufacturing\Http\Controllers\QualityInspectionController::class, 'store']), 'method' => 'post', 'id' => 'qc_form']); ?>


    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo Form::label('transaction_id', __('manufacturing::lang.production_order') . ':*'); ?>

                    <?php echo Form::select('transaction_id', $productions, $transaction_id ?? null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); ?>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo Form::label('inspection_date', __('manufacturing::lang.inspection_date') . ':*'); ?>

                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        <?php echo Form::text('inspection_date', \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'readonly', 'required']); ?>

                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo Form::label('status', __('sale.status') . ':*'); ?>

                    <?php echo Form::select('status', ['pending' => __('manufacturing::lang.qc_pending'), 'passed' => __('manufacturing::lang.qc_passed'), 'failed' => __('manufacturing::lang.qc_failed'), 'conditional' => __('manufacturing::lang.qc_conditional')], 'pending', ['class' => 'form-control select2', 'required']); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo Form::label('inspector_id', __('manufacturing::lang.inspector') . ':'); ?>

                    <?php echo Form::select('inspector_id', $users, auth()->user()->id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo Form::label('batch_number', __('manufacturing::lang.batch_number') . ':'); ?>

                    <?php echo Form::text('batch_number', null, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo Form::label('notes', __('manufacturing::lang.qc_notes') . ':'); ?>

                    <?php echo Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 3]); ?>

                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    
    <?php $__env->startComponent('components.widget', ['class' => 'box-warning', 'title' => __('manufacturing::lang.qc_parameters')]); ?>
        <div id="qc_parameters_container">
            <div class="row qc_parameter_row mb-2">
                <div class="col-md-3">
                    <input type="text" name="parameter_name[]" class="form-control" placeholder="<?php echo app('translator')->get('manufacturing::lang.parameter_name'); ?>">
                </div>
                <div class="col-md-3">
                    <input type="text" name="parameter_expected[]" class="form-control" placeholder="<?php echo app('translator')->get('manufacturing::lang.expected_value'); ?>">
                </div>
                <div class="col-md-3">
                    <input type="text" name="parameter_actual[]" class="form-control" placeholder="<?php echo app('translator')->get('manufacturing::lang.actual_value'); ?>">
                </div>
                <div class="col-md-2">
                    <select name="parameter_result[]" class="form-control">
                        <option value="pending"><?php echo app('translator')->get('manufacturing::lang.qc_pending'); ?></option>
                        <option value="pass"><?php echo app('translator')->get('manufacturing::lang.qc_passed'); ?></option>
                        <option value="fail"><?php echo app('translator')->get('manufacturing::lang.qc_failed'); ?></option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-sm remove_qc_parameter"><i class="fa fa-times"></i></button>
                </div>
            </div>
        </div>
        <br>
        <button type="button" class="btn btn-sm btn-success" id="add_qc_parameter">
            <i class="fa fa-plus"></i> <?php echo app('translator')->get('manufacturing::lang.add_parameter'); ?>
        </button>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary float-end">
                <i class="fas fa-check"></i> <?php echo app('translator')->get('messages.save'); ?>
            </button>
        </div>
    </div>

    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function() {
    // Add QC parameter row
    $('#add_qc_parameter').on('click', function() {
        var row = `<div class="row qc_parameter_row mb-2">
            <div class="col-md-3">
                <input type="text" name="parameter_name[]" class="form-control" placeholder="<?php echo app('translator')->get('manufacturing::lang.parameter_name'); ?>">
            </div>
            <div class="col-md-3">
                <input type="text" name="parameter_expected[]" class="form-control" placeholder="<?php echo app('translator')->get('manufacturing::lang.expected_value'); ?>">
            </div>
            <div class="col-md-3">
                <input type="text" name="parameter_actual[]" class="form-control" placeholder="<?php echo app('translator')->get('manufacturing::lang.actual_value'); ?>">
            </div>
            <div class="col-md-2">
                <select name="parameter_result[]" class="form-control">
                    <option value="pending"><?php echo app('translator')->get('manufacturing::lang.qc_pending'); ?></option>
                    <option value="pass"><?php echo app('translator')->get('manufacturing::lang.qc_passed'); ?></option>
                    <option value="fail"><?php echo app('translator')->get('manufacturing::lang.qc_failed'); ?></option>
                </select>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger btn-sm remove_qc_parameter"><i class="fa fa-times"></i></button>
            </div>
        </div>`;
        $('#qc_parameters_container').append(row);
    });

    // Remove QC parameter row
    $(document).on('click', '.remove_qc_parameter', function() {
        $(this).closest('.qc_parameter_row').remove();
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>