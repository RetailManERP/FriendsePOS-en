
<?php $__env->startSection('title', __('essentials::lang.my_payrolls')); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('essentials::layouts.nav_hrm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header">
    <h1>
        <?php echo app('translator')->get('essentials::lang.my_payrolls'); ?>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header p-0">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#pay_components_tab" data-bs-toggle="tab" aria-expanded="true">
                                <i class="fab fa-gg-circle" aria-hidden="true"></i>
                                <?php echo app('translator')->get('essentials::lang.pay_components'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#payrolls_tab" data-bs-toggle="tab">
                                <i class="fas fa-coins" aria-hidden="true"></i>
                                <?php echo app('translator')->get('essentials::lang.all_payrolls'); ?>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="pay_components_tab">                        
                        <div class="row mt-5">
                           <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-th-skin" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th><?php echo app('translator')->get( 'lang_v1.description' ); ?></th>
                                                <th><?php echo app('translator')->get( 'lang_v1.type' ); ?></th>
                                                <th><?php echo app('translator')->get( 'sale.amount' ); ?></th>
                                                <th><?php echo app('translator')->get( 'essentials::lang.applicable_date' ); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__empty_18 = true; $__currentLoopData = $pay_components; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay_component): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                            <tr>
                                                <td>
                                                    <?php echo e($pay_component->description, false); ?>

                                                </td>
                                                <td>
                                                    <?php echo e(__("essentials::lang." . $pay_component->type), false); ?>

                                                </td>
                                                <td>
                                                    <?php if(!empty($pay_component->amount)): ?>
                                                        <?php echo e(number_format($pay_component->amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                                                    <?php endif; ?>
                                                    <?php if($pay_component->amount_type =="percent"): ?> <?php echo e('%', false); ?> <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if(!empty($pay_component->applicable_date)): ?>
                                                        <?php echo e(\Carbon::createFromTimestamp(strtotime($pay_component->applicable_date))->format(session('business.date_format')), false); ?>

                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                            <tr>
                                                <td colspan="4" class="text-center">
                                                    <?php echo app('translator')->get('essentials::lang.no_data_found'); ?>
                                                </td>
                                            </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                           </div>
                        </div>
                    </div>
                   <div class="tab-pane" id="payrolls_tab">
                        <div class="row mt-5">
                           <div class="col-md-12">
                               <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-th-skin" id="my_payrolls" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th><?php echo app('translator')->get( 'essentials::lang.month_year' ); ?></th>
                                                <th><?php echo app('translator')->get( 'purchase.ref_no' ); ?></th>
                                                <th><?php echo app('translator')->get( 'sale.total_amount' ); ?></th>
                                                <th><?php echo app('translator')->get( 'sale.payment_status' ); ?></th>
                                                <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>         
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready( function(){
            my_payrolls_table = $('#my_payrolls').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "<?php echo e(action([\Modules\Essentials\Http\Controllers\PayrollController::class, 'getMyPayrolls']), false); ?>"
                    },
                    columnDefs: [
                        {
                            targets: 4,
                            orderable: false,
                            searchable: false,
                        },
                    ],
                    aaSorting: [[1, 'desc']],
                    columns: [
                        { data: 'transaction_date', name: 'transaction_date'},
                        { data: 'ref_no', name: 'ref_no'},
                        { data: 'final_total', name: 'final_total'},
                        { data: 'payment_status', name: 'payment_status'},
                        { data: 'action', name: 'action' },
                    ],
                    fnDrawCallback: function(oSettings) {
                        __currency_convert_recursively($('#my_payrolls'));
                    }
            });

            $('div.view_modal').on('shown.bs.modal', function(e) {
                __currency_convert_recursively($('.view_modal'));
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>