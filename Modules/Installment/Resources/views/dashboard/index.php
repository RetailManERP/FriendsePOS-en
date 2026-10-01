
<?php $__env->startSection('title', __('installment::lang.installment_dashboard')); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('installment::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('installment::layouts.partials.style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php
        $can_view_installment_reports = auth()->user()->can('installment.view_reports') || auth()->user()->can('installment.view');
        $can_view_installment_contacts = auth()->user()->can('installment.view_contacts') || auth()->user()->can('installment.view');
        $can_view_installment_sells = auth()->user()->can('installment.view_sells') || auth()->user()->can('installment.create') || auth()->user()->can('installment.view');
        $can_view_installment_system = auth()->user()->can('installment.system_view')
            || auth()->user()->can('installment.system_add')
            || auth()->user()->can('installment.system_edit')
            || auth()->user()->can('installment.system_delete');
    ?>

    <section class="content-header">
        <h1><i class="fa fa-tachometer-alt"></i> <?php echo app('translator')->get('installment::lang.installment_dashboard'); ?></h1>
    </section>

    <section class="content">
        
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo e($summary['active_plans'], false); ?></h3>
                        <p><?php echo app('translator')->get('installment::lang.active_plans'); ?></p>
                    </div>
                    <div class="icon"><i class="fa fa-file-invoice-dollar"></i></div>
                    <?php if($can_view_installment_contacts): ?>
                        <a href="<?php echo e(url('/installment/reports?tab=customers'), false); ?>" class="small-box-footer">
                            <?php echo app('translator')->get('installment::lang.view_details'); ?> <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo e($summary['paid_installments'], false); ?><small>/<?php echo e($summary['total_installments'], false); ?></small></h3>
                        <p><?php echo app('translator')->get('installment::lang.paid_installments'); ?></p>
                    </div>
                    <div class="icon"><i class="fa fa-check-circle"></i></div>
                    <?php if($can_view_installment_reports): ?>
                        <a href="<?php echo e(url('/installment/reports'), false); ?>" class="small-box-footer">
                            <?php echo app('translator')->get('installment::lang.view_details'); ?> <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo e($summary['due_soon'], false); ?></h3>
                        <p><?php echo app('translator')->get('installment::lang.due_within_7_days'); ?></p>
                    </div>
                    <div class="icon"><i class="fa fa-clock"></i></div>
                    <?php if($can_view_installment_reports): ?>
                        <a href="<?php echo e(url('/installment/reports'), false); ?>" class="small-box-footer">
                            <?php echo app('translator')->get('installment::lang.view_details'); ?> <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo e($summary['overdue_installments'], false); ?></h3>
                        <p><?php echo app('translator')->get('installment::lang.overdue_installments'); ?></p>
                    </div>
                    <div class="icon"><i class="fa fa-exclamation-triangle"></i></div>
                    <?php if($can_view_installment_reports): ?>
                        <a href="<?php echo e(url('/installment/reports'), false); ?>" class="small-box-footer">
                            <?php echo app('translator')->get('installment::lang.view_details'); ?> <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3><small><?php echo e(session('currency.symbol', '$'), false); ?></small><?php echo e($summary['total_expected'], false); ?></h3>
                        <p><?php echo app('translator')->get('installment::lang.total_expected'); ?></p>
                    </div>
                    <div class="icon"><i class="fa fa-money-bill-wave"></i></div>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><small><?php echo e(session('currency.symbol', '$'), false); ?></small><?php echo e($summary['total_collected'], false); ?></h3>
                        <p><?php echo app('translator')->get('installment::lang.total_collected'); ?></p>
                    </div>
                    <div class="icon"><i class="fa fa-hand-holding-usd"></i></div>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><small><?php echo e(session('currency.symbol', '$'), false); ?></small><?php echo e($summary['total_overdue_amount'], false); ?></h3>
                        <p><?php echo app('translator')->get('installment::lang.overdue_amount'); ?></p>
                    </div>
                    <div class="icon"><i class="fa fa-ban"></i></div>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><small><?php echo e(session('currency.symbol', '$'), false); ?></small><?php echo e($summary['total_late_fines'], false); ?></h3>
                        <p><?php echo app('translator')->get('installment::lang.total_late_fines'); ?></p>
                    </div>
                    <div class="icon"><i class="fa fa-gavel"></i></div>
                </div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-md-4">
                <?php $__env->startComponent('components.widget', ['class' => 'box-success', 'title' => __('installment::lang.today_collections')]); ?>
                    <div class="text-center">
                        <h2 class="text-success"><small><?php echo e(session('currency.symbol', '$'), false); ?></small><?php echo e($summary['today_collected'], false); ?></h2>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>

            <div class="col-md-4">
                <?php $__env->startComponent('components.widget', ['class' => 'box-info', 'title' => __('installment::lang.month_collections')]); ?>
                    <div class="text-center">
                        <h2 class="text-info"><small><?php echo e(session('currency.symbol', '$'), false); ?></small><?php echo e($summary['month_collected'], false); ?></h2>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>

            <div class="col-md-4">
                <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('installment::lang.collection_rate')]); ?>
                    <div class="text-center">
                        <h2>
                            <?php echo e($summary['collection_rate'], false); ?>%
                        </h2>
                        <div class="progress" style="margin-bottom: 0;">
                            <div class="progress-bar progress-bar-success" role="progressbar" 
                                 style="width: <?php echo e($summary['collection_rate'], false); ?>%;" 
                                 aria-valuenow="<?php echo e($summary['collection_rate'], false); ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>

        
        <div class="row">
            <div class="col-md-6">
                <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('installment::lang.plans_overview')]); ?>
                    <table class="table table-striped">
                        <tr>
                            <td><i class="fa fa-play text-info"></i> <?php echo app('translator')->get('installment::lang.active_plans'); ?></td>
                            <td class="text-right"><strong><?php echo e($summary['active_plans'], false); ?></strong></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-check text-success"></i> <?php echo app('translator')->get('installment::lang.completed_plans'); ?></td>
                            <td class="text-right"><strong><?php echo e($summary['completed_plans'], false); ?></strong></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-list text-primary"></i> <?php echo app('translator')->get('installment::lang.total_installments'); ?></td>
                            <td class="text-right"><strong><?php echo e($summary['total_installments'], false); ?></strong></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-hourglass-half text-warning"></i> <?php echo app('translator')->get('installment::lang.unpaid_installments'); ?></td>
                            <td class="text-right"><strong><?php echo e($summary['unpaid_installments'], false); ?></strong></td>
                        </tr>
                    </table>
                <?php echo $__env->renderComponent(); ?>
            </div>

            <div class="col-md-6">
                <?php $__env->startComponent('components.widget', ['class' => 'box-danger', 'title' => __('installment::lang.quick_actions')]); ?>
                    <div class="list-group">
                        <?php if($can_view_installment_reports): ?>
                            <a href="<?php echo e(url('/installment/reports'), false); ?>" class="list-group-item">
                                <i class="fa fa-list-alt text-primary"></i> <?php echo app('translator')->get('installment::lang.installment_report'); ?>
                            </a>
                        <?php endif; ?>
                        <?php if($can_view_installment_contacts): ?>
                            <a href="<?php echo e(url('/installment/reports?tab=customers'), false); ?>" class="list-group-item">
                                <i class="fa fa-users text-info"></i> <?php echo app('translator')->get('installment::lang.installment_customer'); ?>
                            </a>
                        <?php endif; ?>
                        <?php if($can_view_installment_sells): ?>
                            <a href="<?php echo e(url('/installment/sells'), false); ?>" class="list-group-item">
                                <i class="fa fa-plus-circle text-success"></i> <?php echo app('translator')->get('installment::lang.create_new_plan'); ?>
                            </a>
                        <?php endif; ?>
                        <?php if($can_view_installment_system): ?>
                            <a href="<?php echo e(url('/installment/plans'), false); ?>" class="list-group-item">
                                <i class="fa fa-cogs text-warning"></i> <?php echo app('translator')->get('installment::lang.installment_plan'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>