

<?php $__env->startSection('title', __('accounting::lang.daily_transactions_report')); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('accounting::lang.daily_transactions_report'); ?></h1>
</section>

<section class="content">
    <div class="row no-print">
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('daily_txn_date', __('accounting::lang.transaction_date') . ':'); ?>

                <?php echo Form::text('daily_txn_date', \Carbon::createFromTimestamp(strtotime($date))->format(session('business.date_format')), [
                    'class' => 'form-control',
                    'readonly',
                    'id' => 'daily_txn_date',
                    'placeholder' => __('accounting::lang.transaction_date'),
                ]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('daily_txn_location_id', __('purchase.business_location') . ':'); ?>

                <?php echo Form::select('daily_txn_location_id', $business_locations, $location_id, [
                    'class' => 'form-control select2',
                    'id' => 'daily_txn_location_id',
                ]); ?>

            </div>
        </div>
        <div class="col-md-3" style="padding-top: 25px;">
            <button type="button" class="btn btn-primary" id="apply_daily_txn_filter">
                <i class="fa fa-search"></i> <?php echo app('translator')->get('accounting::lang.view_report'); ?>
            </button>
            <button type="button" class="btn btn-primary" id="print_daily_transactions_report">
                <i class="fa fa-print"></i> Print A4
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border text-center">
                    <h2 class="box-title"><?php echo app('translator')->get('accounting::lang.daily_transactions_report'); ?></h2>
                    <p><?php echo e(\Carbon::createFromTimestamp(strtotime($date))->format(session('business.date_format')), false); ?></p>
                </div>

                <div class="box-body">
                    <?php if($transactions->count() > 0): ?>

                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="info-box bg-green">
                                <span class="info-box-icon"><i class="fas fa-arrow-left"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"><?php echo app('translator')->get('accounting::lang.total_debits'); ?></span>
                                    <span class="info-box-number"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_debits, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box bg-red">
                                <span class="info-box-icon"><i class="fas fa-arrow-right"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"><?php echo app('translator')->get('accounting::lang.total_credits'); ?></span>
                                    <span class="info-box-number"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_credits, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box bg-blue">
                                <span class="info-box-icon"><i class="fas fa-balance-scale"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"><?php echo app('translator')->get('lang_v1.difference'); ?></span>
                                    <span class="info-box-number"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_debits - $total_credits, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="daily_transactions_table">
                            <thead>
                                <tr class="active">
                                    <th>#</th>
                                    <th><?php echo app('translator')->get('accounting::lang.gl_code'); ?></th>
                                    <th><?php echo app('translator')->get('accounting::lang.account'); ?></th>
                                    <th><?php echo app('translator')->get('accounting::lang.transaction_type'); ?></th>
                                    <th><?php echo app('translator')->get('accounting::lang.ref_no'); ?></th>
                                    <th><?php echo app('translator')->get('lang_v1.contact'); ?></th>
                                    <th><?php echo app('translator')->get('accounting::lang.mapped_via'); ?></th>
                                    <th><?php echo app('translator')->get('accounting::lang.note'); ?></th>
                                    <th><?php echo app('translator')->get('accounting::lang.debit'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                    <th><?php echo app('translator')->get('accounting::lang.credit'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $row = 1; ?>
                                <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $txn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($row++, false); ?></td>
                                        <td><?php echo e($txn->gl_code ?? '-', false); ?></td>
                                        <td>
                                            <?php echo e($txn->account_name, false); ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.ledger_report.view')): ?>
                                            <a class="btn btn-xs btn-default text-success ledger-link" 
                                                title="<?php echo app('translator')->get('accounting::lang.ledger'); ?>"
                                                target="_blank"
                                                href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'ledger'], $txn->account_id), false); ?>?location_id=<?php echo e($location_id, false); ?>&start=<?php echo e($date, false); ?>&end=<?php echo e($date, false); ?>">
                                                <i class="fas fa-file-alt"></i>
                                            </a>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($txn->transaction_type): ?>
                                                <span class="label label-default"><?php echo e(ucfirst(str_replace('_', ' ', $txn->transaction_type)), false); ?></span>
                                            <?php elseif($txn->sub_type == 'journal_entry'): ?>
                                                <span class="label label-info">Journal Entry</span>
                                            <?php elseif($txn->sub_type == 'fund_transfer'): ?>
                                                <span class="label label-warning">Fund Transfer</span>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($txn->invoice_no ?? $txn->ref_no ?? '-', false); ?></td>
                                        <td><?php echo e($txn->contact_name ?? '-', false); ?></td>
                                        <td>
                                            <?php if($txn->map_type): ?>
                                                <?php echo e(ucfirst(str_replace('_', ' ', $txn->map_type)), false); ?>

                                            <?php elseif($txn->sub_type): ?>
                                                <?php echo e(ucfirst(str_replace('_', ' ', $txn->sub_type)), false); ?>

                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($txn->note ?? '-', false); ?></td>
                                        <td class="text-right">
                                            <?php if($txn->type == 'debit'): ?>
                                                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $txn->amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-right">
                                            <?php if($txn->type == 'credit'): ?>
                                                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $txn->amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr class="active">
                                    <th colspan="8" class="text-right"><?php echo app('translator')->get('sale.total'); ?></th>
                                    <th class="text-right"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_debits, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
                                    <th class="text-right"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_credits, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    
                    <div class="box box-default mt-3">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo app('translator')->get('accounting::lang.daily_summary'); ?> - <?php echo app('translator')->get('accounting::lang.account'); ?></h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-condensed">
                                    <thead>
                                        <tr class="active">
                                            <th><?php echo app('translator')->get('accounting::lang.gl_code'); ?></th>
                                            <th><?php echo app('translator')->get('accounting::lang.account'); ?></th>
                                            <th><?php echo app('translator')->get('accounting::lang.account_type'); ?></th>
                                            <th class="text-right"><?php echo app('translator')->get('accounting::lang.debit'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                            <th class="text-right"><?php echo app('translator')->get('accounting::lang.credit'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $grouped = $transactions->groupBy('account_id');
                                        ?>
                                        <?php $__currentLoopData = $grouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account_id => $account_txns): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $first = $account_txns->first();
                                                $acct_debits = $account_txns->where('type', 'debit')->sum('amount');
                                                $acct_credits = $account_txns->where('type', 'credit')->sum('amount');
                                            ?>
                                            <tr>
                                                <td><?php echo e($first->gl_code ?? '-', false); ?></td>
                                                <td><?php echo e($first->account_name, false); ?></td>
                                                <td><span class="label label-default"><?php echo e(ucfirst($first->account_primary_type), false); ?></span></td>
                                                <td class="text-right">
                                                    <?php if($acct_debits > 0): ?>
                                                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $acct_debits, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php if($acct_credits > 0): ?>
                                                        <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $acct_credits, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="active">
                                            <th colspan="3" class="text-right"><?php echo app('translator')->get('sale.total'); ?></th>
                                            <th class="text-right"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_debits, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
                                            <th class="text-right"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_credits, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <?php else: ?>
                        <div class="text-center">
                            <p class="text-muted">
                                <i class="fas fa-info-circle"></i>
                                <?php echo app('translator')->get('accounting::lang.no_transactions_found'); ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php echo $__env->make('accounting::accounting.common_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
    $(document).ready(function(){
        $('#daily_txn_date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            autoUpdateInput: true,
            locale: {
                format: moment_date_format
            }
        });

        $('#apply_daily_txn_filter').click(function(){
            var date = moment($('#daily_txn_date').val(), moment_date_format).format('YYYY-MM-DD');
            var location_id = $('#daily_txn_location_id').val();
            var url = "<?php echo e(route('accounting.daily_transactions'), false); ?>";
            url += '?date=' + date + '&location_id=' + location_id;
            window.location = url;
        });

        $('#print_daily_transactions_report').on('click', function(e) {
            e.preventDefault();
            var params = getDailyTransactionsPrintParams();
            window.open("<?php echo e(route('accounting.daily_transactions.print'), false); ?>" + '?' + $.param(params), '_blank');
        });

        function getDailyTransactionsPrintParams() {
            var date = moment($('#daily_txn_date').val(), moment_date_format).format('YYYY-MM-DD');
            if (! date || date == 'Invalid date') {
                date = '<?php echo e($date, false); ?>';
            }

            var urlParams = new URLSearchParams(window.location.search);
            var tab = urlParams.get('tab') || 'all';

            return {
                date: date,
                location_id: $('#daily_txn_location_id').val() || urlParams.get('location_id') || '<?php echo e($location_id ?? 'all', false); ?>',
                type: tab,
                tab: tab
            };
        }

        if($('#daily_transactions_table').length){
            $('#daily_transactions_table').DataTable({
                paging: true,
                pageLength: 50,
                searching: true,
                ordering: false,
                info: true,
                dom: 'lfrtip'
            });
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>