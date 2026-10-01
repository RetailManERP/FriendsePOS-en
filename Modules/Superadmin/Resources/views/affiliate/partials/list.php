
<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <?php echo Form::label('affiliate_status_filter', __('superadmin::lang.show') . ':'); ?>

            <?php echo Form::select('affiliate_status_filter', $affiliate_statuses, null, ['class' => 'form-control', 'id' => 'affiliate_status_filter', 'style' => 'width:100%', 'placeholder' => __('messages.all')]); ?>

        </div>
    </div>
</div>


<?php echo Form::open([
    'url' => action([\Modules\Superadmin\Http\Controllers\SuperadminAffiliatesController::class, 'preparePayout']),
    'method' => 'get',
    'id' => 'affiliate_bulk_form',
]); ?>



<div class="row">
    <div class="col-xs-12" id="affiliate_bulk_bar">
        <div class="tw-flex tw-flex-col sm:tw-flex-row tw-items-center tw-gap-3 tw-p-3 tw-mb-3 tw-bg-gray-50 tw-rounded-lg tw-ring-1 tw-ring-gray-200">
            <span class="tw-text-sm tw-font-medium tw-text-gray-700 tw-whitespace-nowrap tw-flex-1" id="affiliate_bulk_summary"></span>

            <button type="submit" id="affiliate_bulk_pay" disabled
                class="tw-dw-btn tw-dw-btn-sm tw-shrink-0 tw-whitespace-nowrap tw-bg-gradient-to-r tw-from-indigo-600 tw-to-blue-500 tw-font-bold tw-text-white tw-border-none tw-rounded-full">
                <?php echo app('translator')->get('superadmin::lang.pay_selected'); ?>
            </button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped tw-w-full" id="affiliates_table" style="width:100%">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all-row" data-table-id="affiliates_table"></th>
                        <th><?php echo app('translator')->get('superadmin::lang.affiliate'); ?></th>
                        <th><?php echo app('translator')->get('superadmin::lang.account_status'); ?></th>
                        <th title="<?php echo app('translator')->get('superadmin::lang.to_approve_help'); ?>"><?php echo app('translator')->get('superadmin::lang.to_approve'); ?></th>
                        <th><?php echo app('translator')->get('superadmin::lang.payable_amount'); ?></th>
                        <th><?php echo app('translator')->get('superadmin::lang.paid_amount'); ?></th>
                        <th><?php echo app('translator')->get('superadmin::lang.applied_on'); ?></th>
                        <th><?php echo app('translator')->get('superadmin::lang.action'); ?></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<?php echo Form::close(); ?>

