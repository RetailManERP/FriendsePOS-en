<li class="treeview <?php echo e(request()->is('warehouse*') ? 'active active-sub' : '', false); ?>">
    <a href="#">
        <i class="fas fa-warehouse"></i>
        <span><?php echo app('translator')->get('warehouse::lang.warehouse_management'); ?></span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('warehouse.view')): ?>
            <li class="<?php echo e(request()->routeIs('warehouse.index') ? 'active' : '', false); ?>">
                <a href="<?php echo e(route('warehouse.index'), false); ?>">
                    <i class="fa fa-tachometer-alt"></i> <?php echo app('translator')->get('warehouse::lang.dashboard'); ?>
                </a>
            </li>
        <?php endif; ?>

        <?php if(auth()->user()->can('superadmin') || auth()->user()->can('warehouse.transfer.create')): ?>
            <li>
                <a href="<?php echo e(action([\Modules\Warehouse\Http\Controllers\StockTransferController::class, 'create']), false); ?>">
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get('warehouse::lang.create_transfer'); ?>
                </a>
            </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('warehouse.transfer.view')): ?>
            <li class="<?php echo e(request()->routeIs('warehouse.transfers') ? 'active' : '', false); ?>">
                <a href="<?php echo e(route('warehouse.transfers'), false); ?>">
                    <i class="fa fa-exchange-alt"></i> <?php echo app('translator')->get('warehouse::lang.stock_transfers'); ?>
                </a>
            </li>
        <?php endif; ?>

        <?php if(auth()->user()->can('superadmin') || auth()->user()->can('warehouse.report.view') || auth()->user()->can('warehouse.view') || auth()->user()->can('warehouse.stock.view')): ?>
            <li class="treeview <?php echo e((request()->is('warehouse/reports*') || request()->is('warehouse/warehouses*') || request()->is('warehouse/stock*')) ? 'active active-sub' : '', false); ?>">
                <a href="#">
                    <i class="fa fa-chart-bar"></i> <?php echo app('translator')->get('report.reports'); ?>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <?php if(auth()->user()->can('superadmin') || auth()->user()->can('warehouse.view')): ?>
                        <li class="<?php echo e(request()->routeIs('warehouse.list') ? 'active' : '', false); ?>">
                            <a href="<?php echo e(route('warehouse.list'), false); ?>">
                                <i class="fa fa-warehouse"></i> <?php echo app('translator')->get('warehouse::lang.warehouses'); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(auth()->user()->can('superadmin') || auth()->user()->can('warehouse.stock.view')): ?>
                        <li class="<?php echo e(request()->routeIs('warehouse.stock') ? 'active' : '', false); ?>">
                            <a href="<?php echo e(route('warehouse.stock'), false); ?>">
                                <i class="fa fa-boxes"></i> <?php echo app('translator')->get('warehouse::lang.warehouse_stock'); ?>
                            </a>
                        </li>
                        <li class="<?php echo e(request()->routeIs('warehouse.stock.movements') ? 'active' : '', false); ?>">
                            <a href="<?php echo e(route('warehouse.stock.movements'), false); ?>">
                                <i class="fa fa-history"></i> <?php echo app('translator')->get('warehouse::lang.stock_movements'); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(auth()->user()->can('superadmin') || auth()->user()->can('warehouse.report.view')): ?>
                        <li class="divider" style="border-top:1px solid #444;margin:4px 0;"></li>
                        <li><a href="<?php echo e(route('warehouse.reports.stock-summary'), false); ?>"><i class="fa fa-clipboard-list"></i> <?php echo app('translator')->get('warehouse::lang.stock_summary_report'); ?></a></li>
                        <li><a href="<?php echo e(route('warehouse.reports.transfers'), false); ?>"><i class="fa fa-exchange-alt"></i> <?php echo app('translator')->get('warehouse::lang.transfer_report'); ?></a></li>
                        <li><a href="<?php echo e(route('warehouse.reports.expiry'), false); ?>"><i class="fa fa-calendar-times"></i> <?php echo app('translator')->get('warehouse::lang.expiry_report'); ?></a></li>
                        <li><a href="<?php echo e(route('warehouse.reports.movements'), false); ?>"><i class="fa fa-route"></i> <?php echo app('translator')->get('warehouse::lang.movement_report'); ?></a></li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>

        <?php if(auth()->user()->can('superadmin') || auth()->user()->hasRole('Admin#'.auth()->user()->business_id)): ?>
            <li class="<?php echo e(request()->is('warehouse/settings*') ? 'active' : '', false); ?>">
                <a href="<?php echo e(route('warehouse.settings'), false); ?>">
                    <i class="fa fa-cog"></i> <?php echo app('translator')->get('warehouse::lang.settings'); ?>
                </a>
            </li>
            <li class="<?php echo e(request()->is('warehouse/hard-reset*') ? 'active' : '', false); ?>">
                <a href="<?php echo e(route('warehouse.hard-reset'), false); ?>">
                    <i class="fa fa-sync-alt"></i> <?php echo app('translator')->get('warehouse::lang.hard_reset_options'); ?>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</li>
