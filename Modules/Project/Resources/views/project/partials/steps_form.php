<?php
    $project_steps = isset($project) && ! empty($project) ? $project->steps : collect();
    $step_statuses = $statuses ?? \Modules\Project\Entities\Project::statusDropdown();
?>

<div class="tw-mb-4 project-steps-section">
    <h5 class="tw-text-sm tw-font-semibold tw-text-gray-500 tw-uppercase tw-tracking-wider tw-mb-3">
        <i class="fa fa-layer-group tw-mr-1"></i> <?php echo app('translator')->get('project::lang.project_steps'); ?>
    </h5>
    <div class="table-responsive">
        <table class="table table-condensed table-bordered" id="project_steps_table" data-next-index="<?php echo e($project_steps->count(), false); ?>">
            <thead>
                <tr>
                    <th style="width: 28%;"><?php echo app('translator')->get('project::lang.step_name'); ?></th>
                    <th style="width: 17%;"><?php echo app('translator')->get('project::lang.step_budget'); ?></th>
                    <th style="width: 17%;"><?php echo app('translator')->get('sale.status'); ?></th>
                    <th style="width: 16%;"><?php echo app('translator')->get('business.start_date'); ?></th>
                    <th style="width: 16%;"><?php echo app('translator')->get('project::lang.end_date'); ?></th>
                    <th style="width: 6%;"></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $project_steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $step_budget = ! is_null($step->budget)
                            ? rtrim(rtrim(number_format((float) $step->budget, 2, '.', ''), '0'), '.')
                            : null;
                    ?>
                    <tr class="project-step-row">
                        <td>
                            <input type="hidden" name="steps[<?php echo e($index, false); ?>][id]" value="<?php echo e($step->id, false); ?>">
                            <input type="hidden" name="steps[<?php echo e($index, false); ?>][_delete]" value="0" class="project-step-delete-flag">
                            <?php echo Form::text("steps[$index][name]", $step->name, ['class' => 'form-control', 'placeholder' => __('project::lang.step_name')]); ?>

                        </td>
                        <td>
                            <?php echo Form::text("steps[$index][budget]", $step_budget, ['class' => 'form-control input_number project-step-budget', 'placeholder' => __('project::lang.step_budget'), 'inputmode' => 'decimal']); ?>

                        </td>
                        <td>
                            <?php echo Form::select("steps[$index][status]", $step_statuses, $step->status, ['class' => 'form-control select2 project-step-status', 'style' => 'width: 100%;']); ?>

                        </td>
                        <td>
                            <?php echo Form::text("steps[$index][start_date]", ! empty($step->start_date) ? \Carbon::createFromTimestamp(strtotime($step->start_date))->format(session('business.date_format')) : '', ['class' => 'form-control datepicker project-step-date', 'readonly']); ?>

                        </td>
                        <td>
                            <?php echo Form::text("steps[$index][end_date]", ! empty($step->end_date) ? \Carbon::createFromTimestamp(strtotime($step->end_date))->format(session('business.date_format')) : '', ['class' => 'form-control datepicker project-step-date', 'readonly']); ?>

                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-xs remove_project_step_row">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <button type="button" class="btn btn-default btn-sm add_project_step_row">
        <i class="fa fa-plus"></i> <?php echo app('translator')->get('project::lang.add_step'); ?>
    </button>
</div>

<script type="text/html" id="project_step_row_template">
    <tr class="project-step-row">
        <td>
            <input type="hidden" name="steps[__INDEX__][id]" value="">
            <input type="hidden" name="steps[__INDEX__][_delete]" value="0" class="project-step-delete-flag">
            <input type="text" name="steps[__INDEX__][name]" class="form-control" placeholder="<?php echo app('translator')->get('project::lang.step_name'); ?>">
        </td>
        <td>
            <input type="text" name="steps[__INDEX__][budget]" class="form-control input_number project-step-budget" placeholder="<?php echo app('translator')->get('project::lang.step_budget'); ?>" inputmode="decimal">
        </td>
        <td>
            <select name="steps[__INDEX__][status]" class="form-control select2 project-step-status" style="width: 100%;">
                <?php $__currentLoopData = $step_statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status_key => $status_label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($status_key, false); ?>" <?php if($status_key === 'not_started'): ?> selected <?php endif; ?>><?php echo e($status_label, false); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </td>
        <td>
            <input type="text" name="steps[__INDEX__][start_date]" class="form-control datepicker project-step-date" readonly>
        </td>
        <td>
            <input type="text" name="steps[__INDEX__][end_date]" class="form-control datepicker project-step-date" readonly>
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-danger btn-xs remove_project_step_row">
                <i class="fa fa-trash"></i>
            </button>
        </td>
    </tr>
</script>
