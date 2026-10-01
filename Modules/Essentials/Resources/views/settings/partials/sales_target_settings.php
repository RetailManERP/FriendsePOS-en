<div class="pos-tab-content">
    <div class="row">
        <div class="col-md-6">
            <div class="form-check">
                <label class="form-check-label">
<?php echo Form::checkbox('calculate_sales_target_commission_without_tax', 1, !empty($settings['calculate_sales_target_commission_without_tax']) ? 1 : 0, ['class' => 'form-check-input'] ); ?> <?php echo app('translator')->get('essentials::lang.calculate_sales_target_commission_without_tax'); ?>
                </label>
                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('essentials::lang.calculate_sales_target_commission_without_tax_help') . '"></i>';
                }
            ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-check">
                <label class="form-check-label">
<?php echo Form::checkbox('disable_commission_calculation', 1, !empty($settings['disable_commission_calculation']) ? 1 : 0, ['class' => 'form-check-input'] ); ?> <?php echo app('translator')->get('essentials::lang.disable_commission_calculation'); ?>
                </label>
            </div>
        </div>
    </div>
</div>
