<div class="pos-tab-content">
    <div class="row">
        <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('payroll_advance_filter_date_range', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('payroll_advance_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-th-skin" id="payroll_advance_table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('messages.action'); ?></th>
                            <th><?php echo app('translator')->get('messages.date'); ?></th>
                            <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                            <th><?php echo app('translator')->get('essentials::lang.payroll_advance'); ?></th>
                            <th><?php echo app('translator')->get('essentials::lang.employee'); ?></th>
                            <th><?php echo app('translator')->get('purchase.payment_status'); ?></th>
                            <th><?php echo app('translator')->get('purchase.grand_total'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right text-bold"><?php echo app('translator')->get('lang_v1.total'); ?></td>
                            <td class="footer_final_total text-right text-bold"></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
