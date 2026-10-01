

<?php $__env->startSection('title', __('accounting::lang.chart_of_account_report')); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header no-print">
    <h1><?php echo app('translator')->get('accounting::lang.chart_of_account_report'); ?></h1>
</section>

<section class="content">

    
    <div class="row no-print">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-body">
                    <div class="row align-items-center">
                        <div class="col-sm-3">
                            <div class="form-group mb-0">
                                <?php echo Form::label('location_id', __('purchase.business_location') . ':'); ?>

                                <?php echo Form::select('location_id', $business_locations, $location_id, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                            </div>
                        </div>
                        <div class="col-sm-auto">
                            <div class="form-group mb-0">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="show_balances_cb"
                                            <?php if($show_balances): ?> checked <?php endif; ?>>
                                        <strong><?php echo app('translator')->get('accounting::lang.show_balances'); ?></strong>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-auto ms-auto">
                            <button type="button" id="apply_filter_btn" class="btn btn-primary btn-sm">
                                <i class="fa fa-search"></i> <?php echo app('translator')->get('report.apply_filters'); ?>
                            </button>
                            <button type="button" id="print_report_btn" class="btn btn-success btn-sm ms-1">
                                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-10 col-md-offset-1" id="coa_report_content">

            
            <div class="text-center print-only" style="display:none; margin-bottom:15px;">
                <h2><?php echo e(session('business.name'), false); ?></h2>
                <h3><?php echo app('translator')->get('accounting::lang.chart_of_account_report'); ?></h3>
                <p><?php echo app('translator')->get('messages.date'); ?>: <?php echo e(\Carbon\Carbon::now()->format(session('business.date_format', 'd/m/Y')), false); ?></p>
            </div>

            <?php $__empty_18 = true; $__currentLoopData = $account_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $account_type_label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                <?php
                    $type_accounts = $accounts->where('account_primary_type', $key);
                ?>
                <?php if($type_accounts->isEmpty()): ?>
                    <?php continue; ?>
                <?php endif; ?>

                <div class="box box-primary coa-report-section">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-folder"></i> <?php echo e($account_type_label, false); ?>

                        </h3>
                    </div>
                    <div class="box-body no-padding">
                        <table class="table table-condensed table-hover mb-0">
                            <thead>
                                <tr class="bg-light">
                                    <th width="12%"><?php echo app('translator')->get('accounting::lang.gl_code'); ?></th>
                                    <th><?php echo app('translator')->get('accounting::lang.account_name'); ?></th>
                                    <th width="22%"><?php echo app('translator')->get('accounting::lang.account_sub_type'); ?></th>
                                    <th width="10%" class="text-center"><?php echo app('translator')->get('lang_v1.status'); ?></th>
                                    <?php if($show_balances): ?>
                                    <th width="15%" class="text-right"><?php echo app('translator')->get('accounting::lang.balance'); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $account_sub_types->where('account_primary_type', $key)->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $sub_accounts = $type_accounts->where('account_sub_type_id', $sub_type->id)->values();
                                    ?>
                                    <?php if($sub_accounts->isEmpty()): ?>
                                        <?php continue; ?>
                                    <?php endif; ?>

                                    <tr class="active">
                                        <td colspan="<?php echo e($show_balances ? 5 : 4, false); ?>" style="padding-left:20px; font-weight:600; background:#f9f9f9;">
                                            <i class="fa fa-folder-open-o"></i>
                                            <?php echo e($sub_type->account_type_name, false); ?>

                                        </td>
                                    </tr>

                                    <?php $__currentLoopData = $sub_accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td style="padding-left:35px;">
                                                <?php if(!empty($account->gl_code)): ?>
                                                    <span class="text-muted"><?php echo e($account->gl_code, false); ?></span>
                                                <?php else: ?>
                                                    <span class="text-muted">—</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if(!empty($account->parent_account_name)): ?>
                                                    <span class="text-muted" style="font-size:0.85em;"><?php echo e($account->parent_account_name, false); ?> /</span>
                                                <?php endif; ?>
                                                <?php echo e($account->name, false); ?>

                                                <?php if($account->is_non_posting): ?>
                                                    <small class="text-muted">(Non-posting)</small>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e($sub_type->account_type_name, false); ?></td>
                                            <td class="text-center">
                                                <?php if($account->status == 'active'): ?>
                                                    <span class="label label-success"><?php echo app('translator')->get('accounting::lang.active'); ?></span>
                                                <?php else: ?>
                                                    <span class="label label-default"><?php echo app('translator')->get('lang_v1.inactive'); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <?php if($show_balances): ?>
                                            <td class="text-right">
                                                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $account->balance ?? 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                            </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    
                                    <?php if($show_balances): ?>
                                    <tr>
                                        <td colspan="4" class="text-right" style="padding-left:35px; font-style:italic;">
                                            <?php echo app('translator')->get('accounting::lang.total'); ?> <?php echo e($sub_type->account_type_name, false); ?>:
                                        </td>
                                        <td class="text-right" style="border-top:1px solid #ddd; font-weight:600;">
                                            <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $sub_accounts->sum('balance'), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                
                                <?php if($show_balances): ?>
                                <tr>
                                    <td colspan="4" class="text-right" style="font-weight:700; background:#f5f5f5;">
                                        <?php echo app('translator')->get('accounting::lang.total'); ?> <?php echo e($account_type_label, false); ?>:
                                    </td>
                                    <td class="text-right" style="font-weight:700; background:#f5f5f5; border-top:2px solid #aaa;">
                                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $type_accounts->sum('balance'), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                <div class="callout callout-info">
                    <p><?php echo app('translator')->get('accounting::lang.no_accounts'); ?></p>
                </div>
            <?php endif; ?>

        </div>
    </div>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style>
    /* ── Screen styles ── */
    .coa-report-section { margin-bottom: 20px; }
    .print-only { display: none !important; }

    /* ── Print styles ── */
    @media print {
        .no-print,
        .content-header,
        nav,
        .sidebar,
        .main-header,
        .main-footer,
        #accounting_nav { display: none !important; }

        .print-only { display: block !important; }

        .content { margin: 0 !important; padding: 0 !important; }
        .col-md-10, .col-md-offset-1 {
            width: 100% !important;
            margin-left: 0 !important;
        }

        .box { border: none !important; box-shadow: none !important; page-break-inside: avoid; }
        .box-header { background: #eee !important; -webkit-print-color-adjust: exact; }
        table { width: 100%; border-collapse: collapse; font-size: 11px; }
        th, td { border: 1px solid #ccc !important; padding: 4px 6px !important; }
        .label { border: 1px solid #888; padding: 1px 4px; font-size: 10px; }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function () {

    // Apply filters — reload page with show_balances param
    $('#apply_filter_btn').on('click', function () {
        var showBalances = $('#show_balances_cb').is(':checked') ? 1 : 0;
        var locationId = $('#location_id').val();
        var url = '<?php echo e(route("accounting.chart_of_account_report"), false); ?>?show_balances=' + showBalances + '&location_id=' + locationId;
        window.location.href = url;
    });

    // Allow Enter key on checkbox to trigger apply
    $('#show_balances_cb').on('change', function () {
        $('#apply_filter_btn').trigger('click');
    });

    // Print preview
    $('#print_report_btn').on('click', function () {
        var showBalances = $('#show_balances_cb').is(':checked') ? 1 : 0;
        var locationId = $('#location_id').val();
        var urlParams = new URLSearchParams(window.location.search);
        var tab = urlParams.get('tab') || 'all';
        var url = '<?php echo e(route("accounting.chart_of_account_report.print"), false); ?>?show_balances=' + showBalances + '&location_id=' + locationId + '&tab=' + tab;
        window.open(url, '_blank');
    });

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>