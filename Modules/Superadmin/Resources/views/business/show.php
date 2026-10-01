
<?php $__env->startSection('title', __('superadmin::lang.superadmin') . ' | Business'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('superadmin::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'superadmin::lang.view_business' ); ?>
        <small> <?php echo e($business->name, false); ?></small>
    </h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    <div class="box collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">
                <strong><i class="fa fa-refresh margin-r-5"></i> 
                <?php echo app('translator')->get( 'superadmin::lang.hard_reset_options' ); ?></strong>
            </h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="box-body" style="display: none;">
            <div class="row">
                <?php echo Form::open(['url' => action([\Modules\Superadmin\Http\Controllers\BusinessController::class, 'resetData']), 'method' => 'post', 'id' => 'reset_data_form' ]); ?>

                <input type="hidden" name="business_id" value="<?php echo e($business->id, false); ?>">

                
                <div class="col-md-12 check_group mb-3">
                    <div class="row align-items-center">
                        <div class="col-md-8 mb-2">
                            <strong>Hard Delete Soft Deleted</strong>
                        </div>
                        <div class="col-md-4 mb-2 text-right">
                            <label class="form-check-label fw-bold">
                                <input type="checkbox" class="check_all"> <?php echo e(__('role.select_all'), false); ?>

                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[soft_products]" type="checkbox" value="1" class="form-check-input">
                                    Hard Delete all soft deleted Products
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12"><hr></div>

                
                <div class="col-md-12 check_group mb-3">
                    <div class="row align-items-center">
                        <div class="col-md-8 mb-2">
                            <strong>Transactions Hard Delete</strong>
                        </div>
                        <div class="col-md-4 mb-2 text-right">
                            <label class="form-check-label fw-bold">
                                <input name="reset[transactions_all]" type="checkbox" value="1" class="check_all"> <?php echo e(__('role.select_all'), false); ?>

                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[transactions_cloud_sales]" type="checkbox" value="1" class="form-check-input">
                                    Reset Cloud Sales
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[transactions_workstation_sales]" type="checkbox" value="1" class="form-check-input">
                                    Reset Workstation Sales
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[transactions_sales_order]" type="checkbox" value="1" class="form-check-input">
                                    Reset Sales Orders
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[delivery_notes]" type="checkbox" value="1" class="form-check-input">
                                    Reset Delivery Notes
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[transactions_purchase]" type="checkbox" value="1" class="form-check-input">
                                    Reset Purchases
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[transactions_opening_stock]" type="checkbox" value="1" class="form-check-input">
                                    Reset Opening Stock
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[transactions_contact_balances]" type="checkbox" value="1" class="form-check-input">
                                    Reset Contact Balances / Ledger
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[transactions_expense]" type="checkbox" value="1" class="form-check-input">
                                    Reset Expenses
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[counts]" type="checkbox" value="1" class="form-check-input">
                                    Reset Invoice Counts
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[cash_registers]" type="checkbox" value="1" class="form-check-input">
                                    Reset Cash Registers
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[truckmate_transactions]" type="checkbox" value="1" class="form-check-input">
                                    Reset Truckmate Transactions
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[installment_transactions]" type="checkbox" value="1" class="form-check-input">
                                    Reset Installment Transactions
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[warehouse_transactions]" type="checkbox" value="1" class="form-check-input">
                                    Reset Warehouse Transaction
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[project_transactions]" type="checkbox" value="1" class="form-check-input">
                                    Reset Project Transactions
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[accounting_mapping]" type="checkbox" value="1" class="form-check-input">
                                    Reset Accounting Mapping
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[accounting_transactions]" type="checkbox" value="1" class="form-check-input">
                                    Reset Accounting Transactions
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[hrm_essentials_transactions]" type="checkbox" value="1" class="form-check-input">
                                    Reset HRM / Essentials Transactions
                                </label>
                            </div>
                        </div>
                        <?php if(auth()->user()->business_id == $business->id && auth()->user()->can('superadmin')): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[superadmin_subs]" type="checkbox" value="1" class="form-check-input">
                                    Reset Superadmin Subscriptions
                                </label>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[demand_orders]" type="checkbox" value="1" class="form-check-input">
                                    Reset Demand Orders
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12"><hr></div>

                
                <div class="col-md-12 check_group mb-3">
                    <div class="row align-items-center">
                        <div class="col-md-8 mb-2">
                            <strong>Data Entry Hard Delete</strong>
                        </div>
                        <div class="col-md-4 mb-2 text-right">
                            <label class="form-check-label fw-bold">
                                <input type="checkbox" class="check_all"> <?php echo e(__('role.select_all'), false); ?>

                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[contacts]" type="checkbox" value="1" class="form-check-input">
                                    Reset Contacts (Dep. Transactions)
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[products]" type="checkbox" value="1" class="form-check-input">
                                    Reset Product Data
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[units]" type="checkbox" value="1" class="form-check-input">
                                    Reset Units
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[discounts]" type="checkbox" value="1" class="form-check-input">
                                    Reset Sale Discounts
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[expense_category]" type="checkbox" value="1" class="form-check-input">
                                    Reset Expense Category
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[settings]" type="checkbox" value="1" class="form-check-input">
                                    Reset Settings (User Defined)
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[manuf_recipe]" type="checkbox" value="1" class="form-check-input">
                                    Reset Manuf. Receipe
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[hrm_degn_dept]" type="checkbox" value="1" class="form-check-input">
                                    Reset HRM Department & Designation
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[repair]" type="checkbox" value="1" class="form-check-input">
                                    Reset Repair
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[acc_coa]" type="checkbox" value="1" class="form-check-input">
                                    Reset Acc. Chart of Accounts
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[reset_truckmate]" type="checkbox" value="1" class="form-check-input">
                                    Reset Truckmate
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[reset_installment]" type="checkbox" value="1" class="form-check-input">
                                    Reset Installment
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[reset_warehouse]" type="checkbox" value="1" class="form-check-input">
                                    Reset Warehouse
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="reset[reset_project]" type="checkbox" value="1" class="form-check-input">
                                    Reset Project
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-md-12">
                    <button id="reset_data" class="btn btn-danger pull-right">Reset Data</button>
                </div>
                <?php echo Form::close(); ?>

            </div>
            <hr>
            <div class="row">
                <?php echo Form::open(['url' => action([\Modules\Superadmin\Http\Controllers\BusinessController::class, 'resetAllOtherBusiness']), 'method' => 'post', 'id' => 'reset_all_other_business_form', 'style' => 'display: contents;' ]); ?>

                <input type="hidden" name="business_id" value="<?php echo e($business->id, false); ?>">
                
                    <button id="reset_all_other_busines_data" type="button" class="btn btn-danger">Reset All Other Business</button>
                
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>

    
    
    
    <?php
        $featureItems = [
            'home' => ['label' => 'Home / Dashboard', 'icon' => 'fa-tachometer-alt'],
            'contacts' => [
                'label' => 'Contacts',
                'icon' => 'fa-address-book',
                'children' => [
                    'contacts.suppliers' => 'Suppliers',
                    'contacts.customers' => 'Customers',
                    'contacts.barterers' => 'Barterers',
                    'contacts.customer_groups' => 'Customer Groups',
                    'contacts.import_contacts' => 'Import Contacts',
                    'contacts.map' => 'Map',
                ]
            ],
            'pos_sale' => [
                'label' => 'POS Sale',
                'icon' => 'fa-cash-register',
                'children' => [
                    'pos_sale.list' => 'POS List',
                    'pos_sale.create' => 'Create POS',
                    'pos_sale.drafts' => 'Draft List',
                    'pos_sale.add_draft' => 'Add Draft',
                    'pos_sale.sell_return' => 'Sell Return',
                    'pos_sale.discounts' => 'Discounts',
                ]
            ],
            'sale' => [
                'label' => 'Sale',
                'icon' => 'fa-arrow-circle-up',
                'children' => [
                    'sale.sales_order' => 'Sales Order',
                    'sale.all_sales' => 'All Sales',
                    'sale.add_sale' => 'Add Sale',
                    'sale.drafts' => 'Draft List',
                    'sale.list_quotations' => 'List Quotations',
                    'sale.add_quotation' => 'Add Quotation',
                    'sale.sell_return' => 'Sell Return',
                    'sale.shipments' => 'Shipments',
                    'sale.discounts' => 'Discounts',
                    'sale.subscriptions' => 'Subscriptions',
                    'sale.import_sales' => 'Import Sales',
                    'sale.pay_customer' => 'Pay Customer',
                ]
            ],
            'products' => [
                'label' => 'Products',
                'icon' => 'fa-cubes',
                'children' => [
                    'products.list' => 'List Products',
                    'products.add' => 'Add Product',
                    'products.print_labels' => 'Print Labels',
                    'products.variations' => 'Variations',
                    'products.import' => 'Import Products',
                    'products.import_opening_stock' => 'Import Opening Stock',
                    'products.selling_price_group' => 'Selling Price Group',
                    'products.units' => 'Units',
                    'products.categories' => 'Categories',
                    'products.brands' => 'Brands',
                    'products.warranties' => 'Warranties',
                    'products.generic_name' => 'Generic Name',
                    'products.potency' => 'Potency',
                    'products.drugs_class' => 'Drugs Class',
                ]
            ],
            'purchases' => [
                'label' => 'Purchases',
                'icon' => 'fa-arrow-circle-down',
                'children' => [
                    'purchases.purchase_requisition' => 'Purchase Requisition',
                    'purchases.purchase_order' => 'Purchase Order',
                    'purchases.list' => 'List Purchases',
                    'purchases.add' => 'Add Purchase',
                    'purchases.purchase_return' => 'Purchase Return',
                    'purchases.pay_supplier' => 'Pay Supplier',
                ]
            ],
            'stock_adjustment' => [
                'label' => 'Stock Adjustment',
                'icon' => 'fa-database',
                'children' => [
                    'stock_adjustment.list' => 'List Stock Adjustments',
                    'stock_adjustment.add' => 'Add Stock Adjustment',
                ]
            ],
            'stock_transfers' => [
                'label' => 'Stock Transfers',
                'icon' => 'fa-truck',
                'children' => [
                    'stock_transfers.list' => 'List Stock Transfers',
                    'stock_transfers.add' => 'Add Stock Transfer',
                ]
            ],
            'expenses' => [
                'label' => 'Expenses',
                'icon' => 'fa-minus-circle',
                'children' => [
                    'expenses.list' => 'List Expenses',
                    'expenses.add' => 'Add Expense',
                    'expenses.categories' => 'Expense Categories',
                ]
            ],
            'payment_accounts' => [
                'label' => 'Payment Accounts',
                'icon' => 'fa-money-check-alt',
                'children' => [
                    'payment_accounts.list' => 'List Accounts',
                    'payment_accounts.cash_flow' => 'Cash Flow',
                    'payment_accounts.report' => 'Payment Account Report',
                ]
            ],
            'user_management' => [
                'label' => 'User Management & Security',
                'icon' => 'fa-users',
                'children' => [
                    'user_management.users' => 'Users',
                    'user_management.roles' => 'Roles',
                    'user_management.sales_commission_agents' => 'Sales Commission Agents',
                ]
            ],
            'reports' => [
                'label' => 'Reports',
                'icon' => 'fa-chart-bar',
                'children' => [
                    'reports.admin_reports' => 'Admin Reports',
                    'reports.pos_reports' => 'POS Reports',
                    'reports.sales_reports' => 'Sales Reports',
                    'reports.stock_reports' => 'Stock Reports',
                    'reports.purchase_reports' => 'Purchase Reports',
                    'reports.general_reports' => 'General Reports',
                ]
            ],
            'backup' => ['label' => 'Backup', 'icon' => 'fa-hdd'],
            'modules' => ['label' => 'Modules', 'icon' => 'fa-plug'],
            'booking' => ['label' => 'Bookings', 'icon' => 'fa-calendar-check'],
            'kitchen' => ['label' => 'Kitchen', 'icon' => 'fa-fire'],
            'orders' => ['label' => 'Orders (Service Staff)', 'icon' => 'fa-list-alt'],
            'notification_templates' => ['label' => 'Notification Templates', 'icon' => 'fa-envelope'],
            'settings' => [
                'label' => 'Settings',
                'icon' => 'fa-cog',
                'children' => [
                    'settings.business_settings' => 'Business Settings',
                    'settings.business_locations' => 'Business Locations',
                    'settings.invoice_settings' => 'Invoice Settings',
                    'settings.barcode_settings' => 'Barcode Settings',
                    'settings.receipt_printers' => 'Receipt Printers',
                    'settings.tax_rates' => 'Tax Rates',
                    'settings.tables' => 'Tables',
                    'settings.quick_menu' => 'Quick Menu',
                    'settings.modifiers' => 'Modifiers',
                    'settings.types_of_service' => 'Types of Service',
                ]
            ],
            'synchronization' => ['label' => 'Synchronization', 'icon' => 'fa-sync'],
            'about' => ['label' => 'About', 'icon' => 'fa-info-circle'],
        ];
        $hiddenFeatures = !empty($business->common_settings['hidden_features'])
            ? $business->common_settings['hidden_features'] : [];
    ?>

    <div class="box box-warning collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title">
                <strong><i class="fa fa-eye-slash margin-r-5"></i>
                Hide/Disable Features</strong>
            </h3>
            <div class="box-tools pull-right">
                <span class="label label-warning">Only visible to Superadmin</span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="box-body" style="display: none;">
            <p class="text-muted"><i class="fa fa-info-circle"></i> Check features to <strong>hide</strong> them for this business. Hidden features will not appear in the sidebar menu even for business Admin. Only Superadmin will still see all features.</p>
            <form id="hidden_features_form">
                <input type="hidden" name="business_id" value="<?php echo e($business->id, false); ?>">
                <?php $__currentLoopData = $featureItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-12 feature_check_group mb-3">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label class="form-check-label fw-bold" style="font-size: 14px;">
                                <input type="checkbox" name="hidden_features[]" value="<?php echo e($key, false); ?>"
                                    class="feature_parent_check"
                                    <?php if(in_array($key, $hiddenFeatures)): ?> checked <?php endif; ?>>
                                <i class="fa <?php echo e($item['icon'], false); ?> margin-r-5"></i> <?php echo e($item['label'], false); ?>

                            </label>
                        </div>
                    </div>
                    <?php if(!empty($item['children'])): ?>
                    <div class="row" style="padding-left: 35px;">
                        <?php $__currentLoopData = $item['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childKey => $childLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
                                    <input name="hidden_features[]" type="checkbox" value="<?php echo e($childKey, false); ?>"
                                        class="form-check-input feature_child_check"
                                        <?php if(in_array($childKey, $hiddenFeatures)): ?> checked <?php endif; ?>>
                                    <?php echo e($childLabel, false); ?>

                                </label>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-12"><hr style="margin: 5px 0;"></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-12 mt-3">
                    <button type="submit" id="save_hidden_features" class="btn btn-warning pull-right">
                        <i class="fa fa-save"></i> Save Hidden Features
                    </button>
                </div>
            </form>
        </div>
    </div>

	<div class="box box-primary">
        <div class="box-header">
                <h3 class="box-title">
                        <strong><i class="fa fa-briefcase margin-r-5"></i> 
                        <?php echo e($business->name, false); ?></strong>
                </h3>
        </div>

        <div class="box-body">
            <div class="row">
                    <div class="col-sm-3">
                        <div class="well well-sm">
                            <strong><i class="fa fa-briefcase margin-r-5"></i> 
                            <?php echo app('translator')->get('business.business_name'); ?></strong>
                            <p class="text-muted">
                                <?php echo e($business->name, false); ?>

                            </p>

                            <strong><i class="fa fa-money margin-r-5"></i> 
                            <?php echo app('translator')->get('business.currency'); ?></strong>
                            <p class="text-muted">
                                <?php echo e($business->currency->currency, false); ?>

                            </p>

                            <strong><i class="fa fa-file-text-o margin-r-5"></i> 
                            <?php echo app('translator')->get('business.tax_number1'); ?></strong>
                            <p class="text-muted">
                                <?php if(!empty($business->tax_number_1)): ?>
                                    <?php echo e($business->tax_label_1, false); ?>: <?php echo e($business->tax_number_1, false); ?>

                                <?php endif; ?>
                            </p>

                            <strong><i class="fa fa-file-text-o margin-r-5"></i> 
                            <?php echo app('translator')->get('business.tax_number2'); ?></strong>
                            <p class="text-muted">
                                <?php if(!empty($business->tax_number_2)): ?>
                                <?php echo e($business->tax_label_2, false); ?>: <?php echo e($business->tax_number_2, false); ?>

                                <?php endif; ?>
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="well well-sm">
                            <strong><i class="fa fa-location-arrow margin-r-5"></i> 
                            <?php echo app('translator')->get('business.time_zone'); ?></strong>
                            <p class="text-muted">
                            <?php echo e($business->time_zone, false); ?>

                            </p>

                            <strong><i class="fa fa-toggle-on margin-r-5"></i> 
                            <?php echo app('translator')->get('business.is_active'); ?></strong>
                            <?php if($business->is_active == 0): ?>
                                <p class="text-muted">
                                    Inactive
                                </p>
                            <?php else: ?>
                                <p class="text-muted">
                                    Active
                                </p>
                            <?php endif; ?>

                            <strong><i class="fa fa-user-circle-o margin-r-5"></i> 
                            <?php echo app('translator')->get('business.created_by'); ?></strong>
                            <?php if(!empty($created_by)): ?>
                            <p class="text-muted">
                            <?php echo e($created_by->surname, false); ?> <?php echo e($created_by->first_name, false); ?> <?php echo e($created_by->last_name, false); ?>

                            </p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="well well-sm">
                            <strong><i class="fa fa-user-circle-o margin-r-5"></i> 
                            <?php echo app('translator')->get('business.owner'); ?></strong>
                            <?php if(!empty($business->owner)): ?>
                            <p class="text-muted">
                            <?php echo e($business->owner->surname, false); ?> <?php echo e($business->owner->first_name, false); ?> <?php echo e($business->owner->last_name, false); ?>

                            </p>
                            <?php endif; ?>

                            <strong><i class="fa fa-envelope margin-r-5"></i> 
                            <?php echo app('translator')->get('business.email'); ?></strong>
                            <p class="text-muted">
                            <?php echo e($business->owner->email, false); ?>

                            </p>

                            <strong><i class="fa fa-address-book-o margin-r-5"></i> 
                            <?php echo app('translator')->get('business.mobile'); ?></strong>
                            <p class="text-muted">
                            <?php echo e($business->owner->contact_no, false); ?>

                            </p>

                            <strong><i class="fa fa-map-marker margin-r-5"></i> 
                            <?php echo app('translator')->get('business.address'); ?></strong>
                            <p class="text-muted">
                            <?php echo e($business->owner->address, false); ?>

                            </p>
                        </div>
                    </div>

                    <div class="col-sm-3">
                            <div>
                                <?php if(!empty($business->logo)): ?>
                                    <?php
                                        $business_logo_path = asset('uploads/business_logos/'.$business->logo);
                                        if(!file_exists($blogo_path)){
                                            $blogo_path = asset('uploads/'.$business->id.'/business_logos/'.$business->logo);
                                        }
                                    ?>
                                    <img class="img-responsive" src="<?php echo e($blogo_path, false); ?>" alt="Business Logo" height="200px">
                                <?php endif; ?>
                            </div>
                    </div> 
                    <div class="clearfix"></div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input type="checkbox" name="hide_invoice_branding" class="form-check-input" value="<?php echo e($business->id, false); ?>" id="hide_invoice_branding"
                            <?php if(!empty($business->common_settings['hide_invoice_branding'])): ?> checked <?php endif; ?>>
                            <label class="form-check-label" for="hide_invoice_branding"><?php echo app('translator')->get('superadmin::lang.hide_footer_invoice_branding'); ?></label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input type="checkbox" name="disable_fbr" class="form-check-input" value="<?php echo e($business->id, false); ?>" id="disable_fbr"
                            <?php if(!empty($business->common_settings['disable_fbr'])): ?> checked <?php endif; ?>>
                            <label class="form-check-label" for="disable_fbr"><?php echo app('translator')->get('superadmin::lang.disable_fbr'); ?></label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input type="checkbox" name="access_backup" class="form-check-input" value="<?php echo e($business->id, false); ?>" id="access_backup"
                            <?php if(!empty($business->common_settings['access_backup'])): ?> checked <?php endif; ?>>
                            <label class="form-check-label" for="access_backup"><?php echo app('translator')->get('superadmin::lang.access_backup'); ?></label>
                        </div>
                    </div>
                    <?php if(config('app.env') === 'demo'): ?>
                    <div class="col-xs-12" style="margin-top: 20px;">
                        <strong>Demo login category</strong>
                        <div class="row" style="margin-top: 10px;">
                            <?php $__currentLoopData = \App\Business::DEMO_CATEGORIES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category_value => $category_label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6" style="margin-bottom: 10px;">
                                <div class="form-check">
                                    <input type="radio" name="demo_category" class="form-check-input demo-category-radio"
                                        value="<?php echo e($category_value, false); ?>" id="demo_category_<?php echo e($category_value, false); ?>"
                                        <?php if($demo_category === $category_value): ?> checked <?php endif; ?>>
                                    <label class="form-check-label" for="demo_category_<?php echo e($category_value, false); ?>"><?php echo e($category_label, false); ?></label>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div> 
    </div>
    </div>

    <div class="box">
        <div class="box-header">
                <h3 class="box-title">
                    <strong><i class="fa fa-map-marker margin-r-5"></i> 
                    <?php echo app('translator')->get( 'superadmin::lang.business_location' ); ?></strong>
                </h3>
        </div>
        <div class="box-body">
                <div class="row">
                    <div class ="col-xs-12">
                    <!-- location table-->
                            <table class="table table-bordered table-hover table-th-skin">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Location ID</th>
                                    <th>Landmark</th>
                                    <th>city</th>
                                    <th>Zip Code</th>
                                    <th>State</th>
                                    <th>Country</th>
                                </tr>
                                </thead>
                                
                                <tbody>
                                    <?php $__currentLoopData = $business->locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                    <td><?php echo e($location->name, false); ?></td>
                                    <td><?php echo e($location->location_id, false); ?></td>
                                    <td><?php echo e($location->landmark, false); ?></td>
                                    <td><?php echo e($location->city, false); ?></td>
                                    <td><?php echo e($location->zip_code, false); ?></td>
                                    <td><?php echo e($location->state, false); ?></td>
                                    <td><?php echo e($location->country, false); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               
                                </tbody>
                            </table>
                    </div>
                </div>
        </div>
    </div>

    <div class="box">
        <div class="box-header">
                <h3 class="box-title">
                    <strong><i class="fa fa-refresh margin-r-5"></i> 
                    <?php echo app('translator')->get( 'superadmin::lang.package_subscription' ); ?></strong>
                </h3>
        </div>
        <div class="box-body">
                <div class="row">
                    <div class ="col-xs-12">
                    <!-- location table-->
                            <table class="table table-bordered table-hover table-th-skin">
                                <thead>
                                <tr>
                                    <th>Package Name</th>
                                    <th>Start Date</th>
                                    <th>Trail End Date</th>
                                    <th>End Date</th>
                                    <th>Paid Via</th>
                                    <th>Payment Transaction ID</th>
                                    <th>Created At</th>
                                    <th>Created By</th>
                                </tr>
                                </thead>
                                
                                <tbody>
                                    <?php $__currentLoopData = $business->subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                    <td><?php echo e($subscription->package_details['name'], false); ?></td>
                                    <td><?php if(!empty($subscription->start_date)): ?><?php echo e(\Carbon::createFromTimestamp(strtotime($subscription->start_date))->format(session('business.date_format')), false); ?><?php endif; ?></td>
                                    <td><?php if(!empty($subscription->trial_end_date)): ?><?php echo e(\Carbon::createFromTimestamp(strtotime($subscription->trial_end_date))->format(session('business.date_format')), false); ?><?php endif; ?></td>
                                    <td><?php if(!empty($subscription->end_date)): ?><?php echo e(\Carbon::createFromTimestamp(strtotime($subscription->end_date))->format(session('business.date_format')), false); ?><?php endif; ?></td>
                                    <td><?php echo e($subscription->paid_via, false); ?></td>
                                    <td><?php echo e($subscription->payment_transaction_id, false); ?></td>
                                    <td><?php echo e($subscription->created_at, false); ?></td>
                                    <td><?php if(!empty($subscription->created_user)): ?> <?php echo e($subscription->created_user->user_full_name, false); ?> <?php endif; ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               
                                </tbody>
                            </table>
                    </div>
                </div>
        </div>
    </div>

    <?php $__env->startComponent('components.widget', ['class' => 'box-default', 'title' => __( 'user.all_users' )]); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user.view')): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-th-skin" id="users_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get( 'business.username' ); ?></th>
                            <th><?php echo app('translator')->get( 'user.name' ); ?></th>
                            <th><?php echo app('translator')->get( 'user.role' ); ?></th>
                            <th><?php echo app('translator')->get( 'business.email' ); ?></th>
                            <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-default', 'title' => 'All Employees']); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user.view')): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-th-skin" id="employees_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get( 'user.name' ); ?></th>
                            <th><?php echo app('translator')->get( 'user.role' ); ?></th>
                            <th><?php echo app('translator')->get( 'business.email' ); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-default', 'title' => 'All Merchants']); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user.view')): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-th-skin" id="merchants_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get( 'business.username' ); ?></th>
                            <th><?php echo app('translator')->get( 'user.name' ); ?></th>
                            <th><?php echo app('translator')->get( 'user.role' ); ?></th>
                            <th><?php echo app('translator')->get( 'business.email' ); ?></th>
                            <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>
    


    <div id="superadmin-business-footer-actions-template" class="hide" style="display: none;">
        <?php if(!empty($previous_business_id)): ?>
            <a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\BusinessController::class, 'show'], [$previous_business_id]), false); ?>" class="btn btn-default">
                <i class="fas fa-chevron-left"></i> PREVIOUS
            </a>
        <?php else: ?>
            <button type="button" class="btn btn-default" disabled>
                <i class="fas fa-chevron-left"></i> PREVIOUS
            </button>
        <?php endif; ?>

        <?php if(!empty($next_business_id)): ?>
            <a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\BusinessController::class, 'show'], [$next_business_id]), false); ?>" class="btn btn-primary">
                <i class="fas fa-chevron-right"></i> NEXT
            </a>
        <?php else: ?>
            <button type="button" class="btn btn-primary" disabled>
                <i class="fas fa-chevron-right"></i> NEXT
            </button>
        <?php endif; ?>
    </div>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('modals'); ?>
<?php echo $__env->make('superadmin::business.update_password_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    //Roles table
    $(document).ready( function(){
        var users_table = $('#users_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/superadmin/users/' + "<?php echo e($business->id, false); ?>" + '?type=users',
            columnDefs: [ {
                "targets": [4],
                "orderable": false,
                "searchable": false
            } ],
            "columns":[
                {"data":"username"},
                {"data":"full_name"},
                {"data":"role"},
                {"data":"email"},
                {"data":"action"}
            ]
        });

        var employees_table = $('#employees_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/superadmin/users/' + "<?php echo e($business->id, false); ?>" + '?type=employees',
            "columns":[
                {"data":"full_name"},
                {"data":"role"},
                {"data":"email"}
            ]
        });

        var merchants_table = $('#merchants_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/superadmin/users/' + "<?php echo e($business->id, false); ?>" + '?type=merchants',
            columnDefs: [ {
                "targets": [4],
                "orderable": false,
                "searchable": false
            } ],
            "columns":[
                {"data":"username"},
                {"data":"full_name"},
                {"data":"role"},
                {"data":"email"},
                {"data":"action"}
            ]
        });

        $(document).on('change', '#hide_invoice_branding', function (e) {
            e.preventDefault();
            $.ajax({
                method: 'get',
                url: '/superadmin/business/hide-invoice-branding/'+$(this).val()+'',
                success: function(result) {
                    if(result.success == 1){
                        toastr.success(result.msg);
                    }else{
                        toastr.danger(result.msg);
                    }
                },
            });
        });
        $(document).on('change', '#disable_fbr', function (e) {
            e.preventDefault();
            $.ajax({
                method: 'get',
                url: '/superadmin/business/disable-fbr/'+$(this).val()+'',
                success: function(result) {
                    if(result.success == 1){
                        toastr.success(result.msg);
                    }else{
                        toastr.danger(result.msg);
                    }
                },
            });
        });

        $(document).on('change', '#access_backup', function (e) {
            e.preventDefault();
            $.ajax({
                method: 'get',
                url: '/superadmin/business/access-backup/'+$(this).val()+'',
                success: function(result) {
                    if(result.success == 1){
                        toastr.success(result.msg);
                    }else{
                        toastr.danger(result.msg);
                    }
                },
            });
        });

        $(document).on('change', '.demo-category-radio', function (e) {
            e.preventDefault();
            $.ajax({
                method: 'post',
                url: "<?php echo e(url('/superadmin/business/demo-category/'.$business->id), false); ?>",
                data: {
                    demo_category: $(this).val(),
                    _token: "<?php echo e(csrf_token(), false); ?>"
                },
                success: function(result) {
                    if(result.success == 1){
                        toastr.success(result.msg);
                    }else{
                        toastr.error(result.msg);
                    }
                },
                error: function() {
                    toastr.error("<?php echo e(__('messages.something_went_wrong'), false); ?>");
                }
            });
        });
    });

    $(document).on('click', '.update_user_password', function (e) {
        e.preventDefault();
        $('form#password_update_form, #user_id').val($(this).data('user_id'));
        $('span#user_name').text($(this).data('user_name'));
        $('#update_password_modal').modal('show');
    });

    password_update_form_validator = $('form#password_update_form').validate();

    $('#update_password_modal').on('hidden.bs.modal', function() {
        password_update_form_validator.resetForm();
        $('form#password_update_form')[0].reset();
    });

    $(document).on('submit', 'form#password_update_form', function(e) {
        e.preventDefault();
        $(this)
            .find('button[type="submit"]')
            .attr('disabled', true);
        var data = $(this).serialize();
        $.ajax({
            method: 'post',
            url: $(this).attr('action'),
            dataType: 'json',
            data: data,
            success: function(result) {
                if (result.success == true) {
                    $('#update_password_modal').modal('hide');
                    toastr.success(result.msg);
                } else {
                    toastr.error(result.msg);
                }
                $('form#password_update_form')
                .find('button[type="submit"]')
                .attr('disabled', false);
            },
        });
    });

    $(document).on('click', 'button#reset_data', function(e) {
        e.preventDefault();
        swal({
            title: LANG.sure,
            text: 'This will Reset All Data with selected checkboxes',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willContinue => {
            if (willContinue) {
                $('form#reset_data_form').submit();
            } else {
                toastr.warning('Nothing Happend');
            }
        });
    });

    $(document).on('click', 'form#reset_all_other_business_form', function(e) {
        e.preventDefault();
        swal({
            title: LANG.sure,
            text: 'This will Reset All Other Business Data except This and Superadmin',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willContinue => {
            if (willContinue) {
                $('form#reset_all_other_business_form').submit();
            } else {
                toastr.warning('Nothing Happend');
            }
        });
    });

    $(document).on('change', '.tran_checkbox', function(e) {
        //if this is checked then do the next
        row = $(this).closest('tr');
        // row.find('.payment_checkbox').attr('checked');
        row.find('.payment_checkbox').prop('checked', $(this).is(':checked'));

    });

$(document).ready(function() {
    // When "Select All" is clicked
    $(".check_all").on("change", function() {
        $(this).closest(".check_group").find("input[type=checkbox]").not(this).prop("checked", this.checked);
    });

    // When any child checkbox changes
    $(".check_group input[type=checkbox]").not(".check_all").on("change", function() {
        var group = $(this).closest(".check_group");
        var allChecked = group.find("input[type=checkbox]").not(".check_all").length === 
                         group.find("input[type=checkbox]:checked").not(".check_all").length;
        group.find(".check_all").prop("checked", allChecked);
    });
});

// Hidden Features: parent checkbox selects/deselects all children
$(document).on('change', '.feature_parent_check', function() {
    $(this).closest('.feature_check_group').find('.feature_child_check').prop('checked', $(this).is(':checked'));
});

// Hidden Features: auto-check parent if all children are checked
$(document).on('change', '.feature_child_check', function() {
    var group = $(this).closest('.feature_check_group');
    var total = group.find('.feature_child_check').length;
    var checked = group.find('.feature_child_check:checked').length;
    group.find('.feature_parent_check').prop('checked', total === checked);
});

// Hidden Features: save form
$(document).on('submit', '#hidden_features_form', function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    // Ensure empty array is sent when nothing is checked
    if ($(this).find('input[name="hidden_features[]"]:checked').length === 0) {
        formData += '&hidden_features=';
    }
    $.ajax({
        method: 'POST',
        url: '/superadmin/business/hidden-features/' + $(this).find('input[name="business_id"]').val(),
        data: formData,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(result) {
            if (result.success == 1) {
                toastr.success(result.msg);
            } else {
                toastr.error(result.msg);
            }
        },
        error: function() {
            toastr.error('Something went wrong');
        }
    });
});

</script>      
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>