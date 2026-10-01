<?php
    $project_steps = $project->steps->pluck('name', 'id');
    $add_expense_url = action([\App\Http\Controllers\ExpenseController::class, 'create'])
        . '?pjt_project_id=' . $project->id
        . '&status=draft'
        . '&project_expense_modal=1';

    if (! empty($project->location_id)) {
        $add_expense_url .= '&location_id=' . $project->location_id;
    }
?>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('project_expense_step_filter', __('project::lang.project_step') . ':'); ?>

            <?php echo Form::select('project_expense_step_filter', $project_steps, null, ['class' => 'form-control select2', 'id' => 'project_expense_step_filter', 'placeholder' => __('lang_v1.all'), 'style' => 'width: 100%;']); ?>

        </div>
    </div>
    <div class="col-md-9 text-right">
        <?php if(!empty($can_add_project_expense)): ?>
            <a href="<?php echo e($add_expense_url, false); ?>" class="btn btn-primary" id="project_add_expense_btn" data-base-href="<?php echo e($add_expense_url, false); ?>">
                <i class="fa fa-plus"></i> <?php echo app('translator')->get('expense.add_expense'); ?>
            </a>
        <?php endif; ?>
    </div>
</div>

<div class="table-responsive" style="overflow-x:auto; width:100%; max-width:100%;">
    <table class="table table-bordered table-striped table-th-skin" id="project_expense_table" style="width:100%;">
        <thead>
            <tr>
                <th><?php echo app('translator')->get('messages.action'); ?></th>
                <th><?php echo app('translator')->get('messages.date'); ?></th>
                <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                <th><?php echo app('translator')->get('project::lang.project_step'); ?></th>
                <th><?php echo app('translator')->get('expense.expense_category'); ?></th>
                <th><?php echo app('translator')->get('expense.expense_status'); ?></th>
                <th><?php echo app('translator')->get('sale.payment_status'); ?></th>
                <th class="text-right"><?php echo app('translator')->get('sale.total_amount'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <th class="text-right"><?php echo app('translator')->get('purchase.payment_due'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
            </tr>
        </thead>
        <tfoot>
            <tr class="bg-gray font-17 text-center footer-total">
                <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="project_footer_status_count"></td>
                <td class="project_footer_payment_status_count"></td>
                <td class="project_footer_expense_total text-right"></td>
                <td class="project_footer_total_due text-right"></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>
