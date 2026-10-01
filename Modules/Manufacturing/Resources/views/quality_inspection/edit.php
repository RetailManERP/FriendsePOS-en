<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
                <i class="fas fa-edit"></i> <?php echo app('translator')->get('manufacturing::lang.edit_inspection'); ?>
            </h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <?php echo Form::open(['url' => action([\Modules\Manufacturing\Http\Controllers\QualityInspectionController::class, 'update'], [$inspection->id]), 'method' => 'put', 'id' => 'qc_edit_form']); ?>

        <div class="modal-body">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <?php echo Form::label('inspection_date', __('manufacturing::lang.inspection_date') . ':*'); ?>

                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            <?php echo Form::text('inspection_date', \Carbon::createFromTimestamp(strtotime($inspection->inspection_date))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'readonly', 'required']); ?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <?php echo Form::label('status', __('sale.status') . ':*'); ?>

                        <?php echo Form::select('status', ['pending' => __('manufacturing::lang.qc_pending'), 'passed' => __('manufacturing::lang.qc_passed'), 'failed' => __('manufacturing::lang.qc_failed'), 'conditional' => __('manufacturing::lang.qc_conditional')], $inspection->status, ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <?php echo Form::label('inspector_id', __('manufacturing::lang.inspector') . ':'); ?>

                        <?php echo Form::select('inspector_id', $users, $inspection->inspector_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <?php echo Form::label('batch_number', __('manufacturing::lang.batch_number') . ':'); ?>

                        <?php echo Form::text('batch_number', $inspection->batch_number, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <?php echo Form::label('notes', __('manufacturing::lang.qc_notes') . ':'); ?>

                        <?php echo Form::textarea('notes', $inspection->notes, ['class' => 'form-control', 'rows' => 3]); ?>

                    </div>
                </div>
            </div>

            
            <h6 class="fw-bold mt-3"><?php echo app('translator')->get('manufacturing::lang.qc_parameters'); ?></h6>
            <div id="qc_parameters_container_edit">
                <?php if(!empty($inspection->parameters)): ?>
                    <?php $__currentLoopData = $inspection->parameters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $param): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row qc_parameter_row mb-2">
                            <div class="col-md-3">
                                <input type="text" name="parameter_name[]" class="form-control" value="<?php echo e($param['name'] ?? '', false); ?>" placeholder="<?php echo app('translator')->get('manufacturing::lang.parameter_name'); ?>">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="parameter_expected[]" class="form-control" value="<?php echo e($param['expected_value'] ?? '', false); ?>" placeholder="<?php echo app('translator')->get('manufacturing::lang.expected_value'); ?>">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="parameter_actual[]" class="form-control" value="<?php echo e($param['actual_value'] ?? '', false); ?>" placeholder="<?php echo app('translator')->get('manufacturing::lang.actual_value'); ?>">
                            </div>
                            <div class="col-md-2">
                                <select name="parameter_result[]" class="form-control">
                                    <option value="pending" <?php echo e(($param['result'] ?? '') == 'pending' ? 'selected' : '', false); ?>><?php echo app('translator')->get('manufacturing::lang.qc_pending'); ?></option>
                                    <option value="pass" <?php echo e(($param['result'] ?? '') == 'pass' ? 'selected' : '', false); ?>><?php echo app('translator')->get('manufacturing::lang.qc_passed'); ?></option>
                                    <option value="fail" <?php echo e(($param['result'] ?? '') == 'fail' ? 'selected' : '', false); ?>><?php echo app('translator')->get('manufacturing::lang.qc_failed'); ?></option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger btn-sm remove_qc_parameter"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
            <button type="button" class="btn btn-sm btn-success mt-2" id="add_qc_parameter_edit">
                <i class="fa fa-plus"></i> <?php echo app('translator')->get('manufacturing::lang.add_parameter'); ?>
            </button>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-check"></i> <?php echo app('translator')->get('messages.update'); ?>
            </button>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>

<script>
    $('#add_qc_parameter_edit').on('click', function() {
        var row = `<div class="row qc_parameter_row mb-2">
            <div class="col-md-3"><input type="text" name="parameter_name[]" class="form-control" placeholder="<?php echo app('translator')->get('manufacturing::lang.parameter_name'); ?>"></div>
            <div class="col-md-3"><input type="text" name="parameter_expected[]" class="form-control" placeholder="<?php echo app('translator')->get('manufacturing::lang.expected_value'); ?>"></div>
            <div class="col-md-3"><input type="text" name="parameter_actual[]" class="form-control" placeholder="<?php echo app('translator')->get('manufacturing::lang.actual_value'); ?>"></div>
            <div class="col-md-2"><select name="parameter_result[]" class="form-control"><option value="pending"><?php echo app('translator')->get('manufacturing::lang.qc_pending'); ?></option><option value="pass"><?php echo app('translator')->get('manufacturing::lang.qc_passed'); ?></option><option value="fail"><?php echo app('translator')->get('manufacturing::lang.qc_failed'); ?></option></select></div>
            <div class="col-md-1"><button type="button" class="btn btn-danger btn-sm remove_qc_parameter"><i class="fa fa-times"></i></button></div>
        </div>`;
        $('#qc_parameters_container_edit').append(row);
    });
</script>
