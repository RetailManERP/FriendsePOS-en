

<?php $__env->startSection('title', __('messages.settings')); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1><?php echo app('translator')->get( 'messages.settings' ); ?></h1>
</section>
<section class="content">
	<?php if(auth()->user()->can('accounting.access_settings') || auth()->user()->can('accounting.map_transactions')): ?>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header p-0">
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" href="#account_setting" data-bs-toggle="tab" aria-expanded="true">
								<?php echo app('translator')->get('accounting::lang.account_setting'); ?> / <?php echo app('translator')->get('accounting::lang.map_transactions'); ?>
							</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="#sub_type_tab" data-bs-toggle="tab" aria-expanded="true">
								<?php echo app('translator')->get('accounting::lang.account_sub_type'); ?>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#detail_type_tab" data-bs-toggle="tab" aria-expanded="true">
								<?php echo app('translator')->get('accounting::lang.detail_type'); ?>
							</a>
						</li>
					</ul>
				</div>
				<div class="card-body">
					<div class="tab-content">

						<div class="tab-pane fade show active" id="account_setting">
						<?php echo Form::open(['action' => '\Modules\Accounting\Http\Controllers\SettingsController@saveSettings',
						'method' => 'post', 'id' => 'accounting_settings_form']); ?>

						<?php 
						$user_settings = json_decode(auth()->user()->user_settings, true);
						?>
						<?php if(isset($user_settings['enable_reset_accounting_data']) && $user_settings['enable_reset_accounting_data'] == 1): ?>
						<div class="row mb-12">
							<div class="col-md-4">
								<button class="btn btn-danger accounting_reset_data" data-href="<?php echo e(action([\Modules\Accounting\Http\Controllers\SettingsController::class, 'resetData']), false); ?>">
									<?php echo app('translator')->get('accounting::lang.reset_data'); ?>
								</button>
							</div>
						</div>
						<?php endif; ?>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<?php echo Form::label('journal_entry_prefix', __('accounting::lang.journal_entry_prefix') . ':'); ?>

									<?php echo Form::text('journal_entry_prefix',!empty($accounting_settings['journal_entry_prefix'])?
									$accounting_settings['journal_entry_prefix'] : '',
									['class' => 'form-control ', 'id' => 'journal_entry_prefix']); ?>

								</div>
								<div class="form-group">
									<?php echo Form::label('transfer_prefix', __('accounting::lang.transfer_prefix') . ':'); ?>

									<?php echo Form::text('transfer_prefix',!empty($accounting_settings['transfer_prefix'])?
									$accounting_settings['transfer_prefix'] : '',
									['class' => 'form-control ', 'id' => 'transfer_prefix']); ?>

								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<?php echo Form::label('chart_of_accounts_order', __('accounting::lang.chart_of_accounts_order') . ':'); ?>

									<ul id="sortable" class="list-group">
										<?php $__currentLoopData = $account_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<li class="ui-state-default bg-info list-group-item" data-key="<?php echo e($key, false); ?>"><b><?php echo e($value['label'], false); ?></b> <span class="pull-right"><i class="glyphicon glyphicon-resize-vertical"></i></span></li>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</ul>
									<input type="hidden" name="coa_order" id="coa_order">
								</div>
							</div>
						</div>

						<hr />

						<h3><?php echo app('translator')->get('accounting::lang.map_transactions'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('accounting::lang.map_transactions_help') . '"></i>';
                }
            ?></h3>

						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs" id="accounting_location_tabs" role="tablist">
								
								<?php $__currentLoopData = $business_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $business_location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li class="nav-item">
									<a class="nav-link <?php if($loop->first): ?> active <?php endif; ?>" href="#location-<?php echo e($business_location->id, false); ?>-tab" data-bs-toggle="tab" role="tab" aria-expanded="true">
										<?php echo e($business_location->name, false); ?>

									</a>
								</li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>	
							<div class="tab-content">
								<?php $__currentLoopData = $business_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $business_location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="tab-pane fade <?php if($loop->first): ?> show active <?php endif; ?>" id="location-<?php echo e($business_location->id, false); ?>-tab" role="tabpanel">
									<?php $__env->startComponent('components.widget', ['title' => $business_location->name. ' Settings']); ?>

									<?php
									$business_id = session()->get('business')['id'];
									
									$default_map = json_decode($business_location->accounting_default_map, true) ?: [];
									$defaultAccount = function ($map_key, $fallback_name) use ($default_map, $business_id) {
										$account_id = \Illuminate\Support\Arr::get($default_map, $map_key);

										if (!empty($account_id)) {
											$mapped_account = \Modules\Accounting\Entities\AccountingAccount::where('id', $account_id)
												->where('business_id', $business_id)
												->where('status', 'active')
												->first();

											if (!is_null($mapped_account)) {
												return $mapped_account;
											}
										}

										return \Modules\Accounting\Entities\AccountingAccount::where('name', $fallback_name)
											->where('business_id', $business_id)
											->where('status', 'active')
											->first();
									};

									$defaultAccountFromKeys = function (array $map_keys, $fallback_name = null) use ($default_map, $business_id) {
										foreach ($map_keys as $map_key) {
											$account_id = \Illuminate\Support\Arr::get($default_map, $map_key);

											if (!empty($account_id)) {
												$mapped_account = \Modules\Accounting\Entities\AccountingAccount::where('id', $account_id)
													->where('business_id', $business_id)
													->where('status', 'active')
													->first();

												if (!is_null($mapped_account)) {
													return $mapped_account;
												}
											}
										}

										if (empty($fallback_name)) {
											return null;
										}

										return \Modules\Accounting\Entities\AccountingAccount::where('name', $fallback_name)
											->where('business_id', $business_id)
											->where('status', 'active')
											->first();
									};

									//Sale Tabs
									$sale_payment_account = $defaultAccount('sale.payment_account', 'Sales');

									$sale_deposit_to = $defaultAccount('sale.deposit_to', 'Trade Debters (A/R)');

									$sales_payments_payment_account = $defaultAccount('sell_payment.payment_account', 'Trade Debters (A/R)');

									$sales_payments_deposit_to = $defaultAccount('sell_payment.deposit_to', 'Cash in Hand');

									$cost_of_sale_payment_account = $defaultAccount('cost_of_sale.payment_account', 'Stock Inventory');

									$cost_of_sale_deposit_to = $defaultAccount('cost_of_sale.deposit_to', 'Cost of Goods Sold - COGS');

									$foc_cost_of_sale_deposit_to = $defaultAccount('foc_cost_of_sale.deposit_to', 'Cost of Goods Sold - COGS');

									$sale_discount_payment_account = $defaultAccount('sale_discount.payment_account', 'Trade Debters (A/R)');

									$sale_discount_deposit_to = $defaultAccount('sale_discount.deposit_to', 'Total Sale Discounts - COS');

									$tax_sale_payment_account = $defaultAccount('tax_sale.payment_account', 'Tax Collected');
									
									$tax_sale_deposit_to = $defaultAccount('tax_sale.deposit_to', 'Trade Debters (A/R)');

									$tos_sale_payment_account = $defaultAccount('tos_sale.payment_account', 'Total Type of Services - Income');
									
									$tos_sale_deposit_to = $defaultAccount('tos_sale.deposit_to', 'Trade Debters (A/R)');

									$customer_ob_payment_account = $defaultAccount('customer_opening_balance.payment_account', 'Adjustment Previous (B/F) - Equity');

									$customer_ob_deposit_to = $defaultAccount('customer_opening_balance.deposit_to', 'Trade Debters (A/R)');

									$customer_cp_payment_account = $defaultAccount('customer_contact_payment.payment_account', 'Debitor Deposits (A/P)');

									$customer_cp_deposit_to = $defaultAccount('customer_contact_payment.deposit_to', 'Cash in Hand');
									
									//Purchase Tabs
									$purchases_payment_account = $defaultAccount('purchases.payment_account', 'Trade Creditors (A/P)');

									$purchases_deposit_to = $defaultAccount('purchases.deposit_to', 'Stock Inventory');

									$foc_purchases_deposit_to = $defaultAccount('purchases.foc_deposit_to', 'Stock Inventory');

									$purchase_payment_payment_account = $defaultAccount('purchase_payment.payment_account', 'Cash in Hand');

									$purchase_payment_deposit_to = $defaultAccount('purchase_payment.deposit_to', 'Trade Creditors (A/P)');

									$purchase_discount_payment_account = $defaultAccount('purchase_discount.payment_account', 'Total Purchase Discounts - Income');

									$purchase_discount_deposit_to = $defaultAccount('purchase_discount.deposit_to', 'Trade Creditors (A/P)');
									
									$tax_purchase_payment_account = $defaultAccount('tax_purchase.payment_account', 'Trade Creditors (A/P)');

									$tax_purchase_deposit_to = $defaultAccount('tax_purchase.deposit_to', 'Tax Paid');

									$supplier_ob_payment_account = $defaultAccount('supplier_opening_balance.payment_account', 'Trade Creditors (A/P)');

									$supplier_ob_deposit_to = $defaultAccount('supplier_opening_balance.deposit_to', 'Adjustment Previous (B/F) - Equity');

									$supplier_cp_payment_account = $defaultAccount('supplier_contact_payment.payment_account', 'Cash in Hand');

									$supplier_cp_deposit_to = $defaultAccount('supplier_contact_payment.deposit_to', 'Creditor Deposits (A/R)');

									//Stock Adjusment Tabs
									$opening_stock_payment_account = $defaultAccount('opening_stock.payment_account', 'Adjustment Previous (B/F) - Equity');

									$opening_stock_deposit_to = $defaultAccount('opening_stock.deposit_to', 'Stock Inventory');

									$sa_payment_account = $defaultAccount('stock_adjustment.payment_account', 'Stock Inventory');

									$sa_deposit_to = $defaultAccount('stock_adjustment.deposit_to', 'Change in inventory - COS');

									$sap_payment_account = $defaultAccount('stock_adjustment_payment.payment_account', 'Change in inventory - COS');

									$sap_deposit_to = $defaultAccount('stock_adjustment_payment.deposit_to', 'Cash in Hand');

									$production_payment_account = $defaultAccountFromKeys(['manufacturing_production.payment_account'], 'Stock Inventory');

									$production_deposit_to = $defaultAccountFromKeys(['manufacturing_production.deposit_to'], 'Stock Inventory');

									$reverse_production_payment_account = $defaultAccountFromKeys(['manufacturing_reverse_production.payment_account'], 'Stock Inventory');

									$reverse_production_deposit_to = $defaultAccountFromKeys(['manufacturing_reverse_production.deposit_to'], 'Stock Inventory');

									//Expense Tabs
									$expense_payment_account = $defaultAccount('expense.payment_account', 'Expenses Payable (E/P)');

									$expense_deposit_to = $defaultAccount('expense.deposit_to', 'Uncategorised Expense');

									$expense_payment_payment_account = $defaultAccount('expense_payment.payment_account', 'Cash in Hand');

									$expense_payment_deposit_to = $defaultAccount('expense_payment.deposit_to', 'Expenses Payable (E/P)');

									$tax_expense_payment_account = $defaultAccount('tax_expense.payment_account', 'Trade Creditors (A/P)');

									$tax_expense_deposit_to = $defaultAccount('tax_expense.deposit_to', 'Deferred tax assets');

									$payroll_payment_account = $defaultAccountFromKeys(['payroll.payment_account'], 'Payroll liabilities');

									$payroll_deposit_to = $defaultAccountFromKeys(['payroll.deposit_to'], 'Payroll Expenses');

									$payroll_payment_payment_account = $defaultAccountFromKeys(['payroll_payment.payment_account'], 'Cash in Hand');

									$payroll_payment_deposit_to = $defaultAccountFromKeys(['payroll_payment.deposit_to', 'payroll.payment_account'], 'Payroll liabilities');

									$payroll_advance_payment_account = $defaultAccountFromKeys(['payroll_advance.payment_account'], 'Cash in Hand');

									$payroll_advance_deposit_to = $defaultAccountFromKeys(['payroll_advance.deposit_to'], 'Payroll liabilities');

									?>

									
									<strong><?php echo app('translator')->get('accounting::lang.sales_title'); ?></strong>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('payment_account', __('accounting::lang.sale_income_credit') . ':' ); ?>

												<?php echo Form::select('payment_account', !is_null($sale_payment_account) ? [$sale_payment_account->id => $sale_payment_account->name] : [], $sale_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 'name' => "accounting_default_map[$business_location->id][sale][payment_account]",
												'id' => $business_location->id . 'sale_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', __('accounting::lang.receivable_debit') . ':' ); ?>

												<?php echo Form::select('deposit_to', !is_null($sale_deposit_to) ?
												[$sale_deposit_to->id => $sale_deposit_to->name] : [], $sale_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][sale][deposit_to]",
												'id' => $business_location->id . '_sale_deposit_to', 'style' => 'width: 100%;']); ?>

											</div>
										</div>
									</div>

									

									<strong><?php echo app('translator')->get('accounting::lang.sales_payments_title'); ?></strong>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('payment_account', __('accounting::lang.receivable_credit') . ':' ); ?>

												<?php echo Form::select('payment_account', !is_null($sales_payments_payment_account) ? [$sales_payments_payment_account->id => $sales_payments_payment_account->name] : [], $sales_payments_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 'name' => "accounting_default_map[$business_location->id][sell_payment][payment_account]", 'id' => $business_location->id . 'sales_payments_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', __('accounting::lang.sale_payment_debit') . ':' ); ?>

												<?php echo Form::select('deposit_to', !is_null($sales_payments_deposit_to) ?
												[$sales_payments_deposit_to->id => $sales_payments_deposit_to->name] : [], $sales_payments_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][sell_payment][deposit_to]",
												'id' => $business_location->id . 'sales_payments_deposit_to', 'style' => 'width: 100%;'
												]); ?>

											</div>
										</div>
									</div>

									
									<strong><?php echo app('translator')->get('accounting::lang.cost_of_sale_title'); ?></strong>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('payment_account', __('accounting::lang.inventory_credit') . ':' ); ?>

												<?php echo Form::select('payment_account', !is_null($cost_of_sale_payment_account) ? [$cost_of_sale_payment_account->id => $cost_of_sale_payment_account->name] : [], $cost_of_sale_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 'name' => "accounting_default_map[$business_location->id][cost_of_sale][payment_account]", 'id' => $business_location->id . 'cost_of_sale_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', __('accounting::lang.cost_of_sale_debit') . ':' ); ?>

												<?php echo Form::select('deposit_to', !is_null($cost_of_sale_deposit_to) ?
												[$cost_of_sale_deposit_to->id => $cost_of_sale_deposit_to->name] : [], $cost_of_sale_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][cost_of_sale][deposit_to]",
												'id' => $business_location->id . 'cost_of_sale_deposit_to', 'style' => 'width: 100%;'
												]); ?>

											</div>
										</div>

										<div class="col-md-6"></div>
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', __('accounting::lang.foc_cost_of_sale_debit') . ':' ); ?>

												<?php echo Form::select('deposit_to', !is_null($foc_cost_of_sale_deposit_to) ?
												[$foc_cost_of_sale_deposit_to->id => $foc_cost_of_sale_deposit_to->name] : [], $foc_cost_of_sale_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][foc_cost_of_sale][deposit_to]",
												'id' => $business_location->id . 'foc_cost_of_sale_deposit_to', 'style' => 'width: 100%;'
												]); ?>

											</div>
										</div>
									</div>

									
									<strong><?php echo app('translator')->get('accounting::lang.sale_discount_title'); ?></strong>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('payment_account', __('accounting::lang.sale_discount_credit') . ':' ); ?>

												<?php echo Form::select('payment_account', !is_null($sale_discount_payment_account) ? [$sale_discount_payment_account->id => $sale_discount_payment_account->name] : [], $sale_discount_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 'name' => "accounting_default_map[$business_location->id][sale_discount][payment_account]", 'id' => $business_location->id . 'sale_discount_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', __('accounting::lang.sale_discount_debit') . ':' ); ?>

												<?php echo Form::select('deposit_to', !is_null($sale_discount_deposit_to) ?
												[$sale_discount_deposit_to->id => $sale_discount_deposit_to->name] : [], $sale_discount_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][sale_discount][deposit_to]",
												'id' => $business_location->id . 'sale_discount_deposit_to', 'style' => 'width: 100%;'
												]); ?>

											</div>
										</div>
									</div>

									
									<strong><?php echo app('translator')->get('accounting::lang.tax_sale'); ?></strong>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('payment_account', __('accounting::lang.tax_sale_credit') . ':' ); ?>

												<?php echo Form::select('payment_account', !is_null($tax_sale_payment_account) ? [$tax_sale_payment_account->id => $tax_sale_payment_account->name] : [], $tax_sale_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 
												'name' => "accounting_default_map[$business_location->id][tax_sale][payment_account]", 'id' => $business_location->id . 'tax_sale_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6 hide">
											<div class="form-group">
												<?php echo Form::label('deposit_to', __('accounting::lang.tax_sale_debit') . ':' ); ?>

												<?php echo Form::select('deposit_to', !is_null($tax_sale_deposit_to) ?
												[$tax_sale_deposit_to->id => $tax_sale_deposit_to->name] : [], $tax_sale_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][tax_sale][deposit_to]",
												'id' => $business_location->id . 'tax_sale_deposit_to', 'style' => 'width: 100%;'
												]); ?>

											</div>
										</div>
									</div>

									
									<strong><?php echo app('translator')->get('accounting::lang.tos_sale'); ?></strong>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('payment_account', __('accounting::lang.tos_sale_credit') . ':' ); ?>

												<?php echo Form::select('payment_account', !is_null($tos_sale_payment_account) ? [$tos_sale_payment_account->id => $tos_sale_payment_account->name] : [], $tos_sale_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 
												'name' => "accounting_default_map[$business_location->id][tos_sale][payment_account]", 'id' => $business_location->id . 'tos_sale_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6 hide">
											<div class="form-group">
												<?php echo Form::label('deposit_to', __('accounting::lang.tos_sale_debit') . ':' ); ?>

												<?php echo Form::select('deposit_to', !is_null($tos_sale_deposit_to) ?
												[$tos_sale_deposit_to->id => $tos_sale_deposit_to->name] : [], $tos_sale_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][tos_sale][deposit_to]",
												'id' => $business_location->id . 'tos_sale_deposit_to', 'style' => 'width: 100%;'
												]); ?>

											</div>
										</div>
									</div>

									
									<strong><?php echo app('translator')->get('accounting::lang.contact_ob_title'); ?></strong>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('payment_account', __('accounting::lang.contact_ob_credit') . ':' ); ?>

												<?php echo Form::select('payment_account', !is_null($customer_ob_payment_account) ? [$customer_ob_payment_account->id => $customer_ob_payment_account->name] : [], $customer_ob_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 'name' => "accounting_default_map[$business_location->id][customer_opening_balance][payment_account]", 'id' => $business_location->id . 'customer_ob_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', __('accounting::lang.contact_ob_debit') . ':' ); ?>

												<?php echo Form::select('deposit_to', !is_null($customer_ob_deposit_to) ?
												[$customer_ob_deposit_to->id => $customer_ob_deposit_to->name] : [], $customer_ob_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][customer_opening_balance][deposit_to]",
												'id' => $business_location->id . 'customer_ob_deposit_to', 'style' => 'width: 100%;'
												]); ?>

											</div>
										</div>
									</div>

									
									<strong><?php echo app('translator')->get('accounting::lang.contact_payment_title'); ?></strong>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('payment_account', __('accounting::lang.contact_payment_credit') . ':' ); ?>

												<?php echo Form::select('payment_account', !is_null($customer_cp_payment_account) ? [$customer_cp_payment_account->id => $customer_cp_payment_account->name] : [], $customer_cp_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 'name' => "accounting_default_map[$business_location->id][customer_contact_payment][payment_account]", 'id' => $business_location->id . 'customer_cp_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', __('accounting::lang.contact_payment_debit') . ':' ); ?>

												<?php echo Form::select('deposit_to', !is_null($customer_cp_deposit_to) ?
												[$customer_cp_deposit_to->id => $customer_cp_deposit_to->name] : [], $customer_cp_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][customer_contact_payment][deposit_to]",
												'id' => $business_location->id . 'customer_cp_deposit_to', 'style' => 'width: 100%;'
												]); ?>

											</div>
										</div>
									</div>

									<hr>
									
									
									<strong><?php echo app('translator')->get('accounting::lang.purchases_title'); ?></strong>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('payment_account', __('accounting::lang.purchase_credit') . ':' ); ?>

												<?php echo Form::select('payment_account', !is_null($purchases_payment_account) ? [$purchases_payment_account->id => $purchases_payment_account->name] : [], $purchases_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 'name' => "accounting_default_map[$business_location->id][purchases][payment_account]",
												'id' => $business_location->id . 'purchases_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', __('accounting::lang.inventory_debit') . ':' ); ?>

												<?php echo Form::select('deposit_to', !is_null($purchases_deposit_to) ?
												[$purchases_deposit_to->id => $purchases_deposit_to->name] : [], $purchases_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][purchases][deposit_to]",
												'id' => $business_location->id . '_purchases_deposit_to', 'style' => 'width: 100%;']); ?>

											</div>
										</div>
										<div class="col-md-6"></div>
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', __('accounting::lang.foc_inventory_debit') . ':' ); ?>

												<?php echo Form::select('deposit_to', !is_null($foc_purchases_deposit_to) ?
												[$foc_purchases_deposit_to->id => $foc_purchases_deposit_to->name] : [], $foc_purchases_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][purchases][foc_deposit_to]",
												'id' => $business_location->id . '_purchases_deposit_to', 'style' => 'width: 100%;']); ?>

											</div>
										</div>
									</div>

									
									<strong><?php echo app('translator')->get('accounting::lang.purchase_payments_title'); ?></strong>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('payment_account', __('accounting::lang.purchase_payment_credit') . ':' ); ?>

												<?php echo Form::select('payment_account', !is_null($purchase_payment_payment_account) ? [$purchase_payment_payment_account->id => $purchase_payment_payment_account->name] : [], $purchase_payment_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 'name' => "accounting_default_map[$business_location->id][purchase_payment][payment_account]",
												'id' => $business_location->id . 'purchase_payment_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', __('accounting::lang.inventory_debit_payable') . ':' ); ?>

												<?php echo Form::select('deposit_to', !is_null($purchase_payment_deposit_to) ?
												[$purchase_payment_deposit_to->id => $purchase_payment_deposit_to->name] : [], $purchase_payment_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][purchase_payment][deposit_to]",
												'id' => $business_location->id . '_purchase_payment_deposit_to', 'style' => 'width: 100%;']); ?>

											</div>
										</div>
									</div>

									
									<strong><?php echo app('translator')->get('accounting::lang.purchase_discount_title'); ?></strong>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('payment_account', __('accounting::lang.purchase_discount_credit') . ':' ); ?>

												<?php echo Form::select('payment_account', !is_null($purchase_discount_payment_account) ? [$purchase_discount_payment_account->id => $purchase_discount_payment_account->name] : [],
												$purchase_discount_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 
												'name' => "accounting_default_map[$business_location->id][purchase_discount][payment_account]", 'id' => $business_location->id . 'purchase_discount_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', __('accounting::lang.purchase_discount_debit') . ':' ); ?>

												<?php echo Form::select('deposit_to', !is_null($purchase_discount_deposit_to) ?
												[$purchase_discount_deposit_to->id => $purchase_discount_deposit_to->name] : [], $purchase_discount_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][purchase_discount][deposit_to]",
												'id' => $business_location->id . 'purchase_discount_deposit_to', 'style' => 'width: 100%;'
												]); ?>

											</div>
										</div>
									</div>
									

									
									<strong><?php echo app('translator')->get('accounting::lang.tax_purchase'); ?></strong>

									<div class="row">
										<div class="col-md-6 hide">
											<div class="form-group">
												<?php echo Form::label('payment_account', __('accounting::lang.tax_purchase_credit') . ':' ); ?>

												<?php echo Form::select('payment_account', !is_null($tax_purchase_payment_account) ? [$tax_purchase_payment_account->id => $tax_purchase_payment_account->name] : [], $tax_purchase_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 
												'name' => "accounting_default_map[$business_location->id][tax_purchase][payment_account]", 'id' => $business_location->id . 'tax_purchase_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', __('accounting::lang.tax_purchase_debit') . ':' ); ?>

												<?php echo Form::select('deposit_to', !is_null($tax_purchase_deposit_to) ?
												[$tax_purchase_deposit_to->id => $tax_purchase_deposit_to->name] : [], $tax_purchase_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][tax_purchase][deposit_to]",
												'id' => $business_location->id . 'tax_purchase_deposit_to', 'style' => 'width: 100%;'
												]); ?>

											</div>
										</div>
									</div>

									
									<strong><?php echo app('translator')->get('accounting::lang.contact_ob_title'); ?></strong>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('payment_account', __('accounting::lang.contact_ob_credit') . ':' ); ?>

												<?php echo Form::select('payment_account', !is_null($supplier_ob_payment_account) ? [$supplier_ob_payment_account->id => $supplier_ob_payment_account->name] : [], $supplier_ob_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 'name' => "accounting_default_map[$business_location->id][supplier_opening_balance][payment_account]", 'id' => $business_location->id . 'supplier_ob_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', __('accounting::lang.contact_ob_debit') . ':' ); ?>

												<?php echo Form::select('deposit_to', !is_null($supplier_ob_deposit_to) ?
												[$supplier_ob_deposit_to->id => $supplier_ob_deposit_to->name] : [], $supplier_ob_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][supplier_opening_balance][deposit_to]",
												'id' => $business_location->id . 'supplier_ob_deposit_to', 'style' => 'width: 100%;'
												]); ?>

											</div>
										</div>
									</div>

									
									<strong><?php echo app('translator')->get('accounting::lang.contact_payment_title'); ?></strong>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('payment_account', __('accounting::lang.contact_payment_credit') . ':' ); ?>

												<?php echo Form::select('payment_account', !is_null($supplier_cp_payment_account) ? [$supplier_cp_payment_account->id => $supplier_cp_payment_account->name] : [], $supplier_cp_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 'name' => "accounting_default_map[$business_location->id][supplier_contact_payment][payment_account]", 'id' => $business_location->id . 'supplier_cp_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', __('accounting::lang.contact_payment_debit') . ':' ); ?>

												<?php echo Form::select('deposit_to', !is_null($supplier_cp_deposit_to) ?
												[$supplier_cp_deposit_to->id => $supplier_cp_deposit_to->name] : [], $supplier_cp_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][supplier_contact_payment][deposit_to]",
												'id' => $business_location->id . 'supplier_cp_deposit_to', 'style' => 'width: 100%;'
												]); ?>

											</div>
										</div>
									</div>

									<hr>

									<strong><?php echo app('translator')->get('accounting::lang.opening_stock'); ?></strong>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('payment_account', 'Opening Stock Credit:' ); ?>

												<?php echo Form::select('payment_account', !is_null($opening_stock_payment_account) ? [$opening_stock_payment_account->id => $opening_stock_payment_account->name] : [], $opening_stock_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 'name' => "accounting_default_map[$business_location->id][opening_stock][payment_account]",
												'id' => $business_location->id . 'opening_stock_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', 'Opening Stock Debit:' ); ?>

												<?php echo Form::select('deposit_to', !is_null($opening_stock_deposit_to) ?
												[$opening_stock_deposit_to->id => $opening_stock_deposit_to->name] : [], $opening_stock_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][opening_stock][deposit_to]",
												'id' => $business_location->id . '_opening_stock_deposit_to', 'style' => 'width: 100%;']); ?>

											</div>
										</div>
									</div>

									
									
									<strong><?php echo app('translator')->get('accounting::lang.stock_adjustment_title'); ?></strong>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('payment_account', __('accounting::lang.stock_adjustment_credit') . ':' ); ?>

												<?php echo Form::select('payment_account', !is_null($sa_payment_account) ? [$sa_payment_account->id => $sa_payment_account->name] : [], $sa_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 'name' => "accounting_default_map[$business_location->id][stock_adjustment][payment_account]",
												'id' => $business_location->id . 'stock_adjustment_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', __('accounting::lang.stock_adjustment_debit') . ':' ); ?>

												<?php echo Form::select('deposit_to', !is_null($sa_deposit_to) ?
												[$sa_deposit_to->id => $sa_deposit_to->name] : [], $sa_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][stock_adjustment][deposit_to]",
												'id' => $business_location->id . '_stock_adjustment_deposit_to', 'style' => 'width: 100%;']); ?>

											</div>
										</div>
									</div>

									
									<strong><?php echo app('translator')->get('accounting::lang.stock_adjustment_payments_title'); ?></strong>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('payment_account', __('accounting::lang.stock_adjustment_payment_credit') . ':' ); ?>

												<?php echo Form::select('payment_account', !is_null($sap_payment_account) ? [$sap_payment_account->id => $sap_payment_account->name] : [], $sap_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 'name' => "accounting_default_map[$business_location->id][stock_adjustment_payment][payment_account]",
												'id' => $business_location->id . 'stock_adjustment_payment_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', __('accounting::lang.stock_adjustment_debit_payable') . ':' ); ?>

												<?php echo Form::select('deposit_to', !is_null($sap_deposit_to) ?
												[$sap_deposit_to->id => $sap_deposit_to->name] : [], $sap_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][stock_adjustment_payment][deposit_to]",
												'id' => $business_location->id . '_stock_adjustment_payment_deposit_to', 'style' => 'width: 100%;']); ?>

											</div>
										</div>
									</div>

									<hr>
									<strong>Manufacturing Module</strong>
									<br>
									<strong>Production</strong>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('payment_account', 'Production Credit:' ); ?>

												<?php echo Form::select('payment_account', !is_null($production_payment_account) ? [$production_payment_account->id => $production_payment_account->name] : [], $production_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 'name' => "accounting_default_map[$business_location->id][manufacturing_production][payment_account]",
												'id' => $business_location->id . 'manufacturing_production_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', 'Production Debit:' ); ?>

												<?php echo Form::select('deposit_to', !is_null($production_deposit_to) ?
												[$production_deposit_to->id => $production_deposit_to->name] : [], $production_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][manufacturing_production][deposit_to]",
												'id' => $business_location->id . '_manufacturing_production_deposit_to', 'style' => 'width: 100%;']); ?>

											</div>
										</div>
									</div>

									<strong>Reverse Production</strong>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('payment_account', 'Reverse Production Credit:' ); ?>

												<?php echo Form::select('payment_account', !is_null($reverse_production_payment_account) ? [$reverse_production_payment_account->id => $reverse_production_payment_account->name] : [], $reverse_production_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 'name' => "accounting_default_map[$business_location->id][manufacturing_reverse_production][payment_account]",
												'id' => $business_location->id . 'manufacturing_reverse_production_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', 'Reverse Production Debit:' ); ?>

												<?php echo Form::select('deposit_to', !is_null($reverse_production_deposit_to) ?
												[$reverse_production_deposit_to->id => $reverse_production_deposit_to->name] : [], $reverse_production_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][manufacturing_reverse_production][deposit_to]",
												'id' => $business_location->id . '_manufacturing_reverse_production_deposit_to', 'style' => 'width: 100%;']); ?>

											</div>
										</div>
									</div>

									<hr>
									<strong>Payroll</strong>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('payment_account', 'Payroll Credit:' ); ?>

												<?php echo Form::select('payment_account', !is_null($payroll_payment_account) ? [$payroll_payment_account->id => $payroll_payment_account->name] : [], $payroll_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 'name' => "accounting_default_map[$business_location->id][payroll][payment_account]",
												'id' => $business_location->id . 'payroll_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', 'Payroll Debit:' ); ?>

												<?php echo Form::select('deposit_to', !is_null($payroll_deposit_to) ?
												[$payroll_deposit_to->id => $payroll_deposit_to->name] : [], $payroll_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][payroll][deposit_to]",
												'id' => $business_location->id . '_payroll_deposit_to', 'style' => 'width: 100%;']); ?>

											</div>
										</div>
									</div>

									<strong>Payroll Payments</strong>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('payment_account', 'Payroll Payment Credit:' ); ?>

												<?php echo Form::select('payment_account', !is_null($payroll_payment_payment_account) ? [$payroll_payment_payment_account->id => $payroll_payment_payment_account->name] : [], $payroll_payment_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 'name' => "accounting_default_map[$business_location->id][payroll_payment][payment_account]",
												'id' => $business_location->id . 'payroll_payment_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', 'Payroll Payment Debit:' ); ?>

												<?php echo Form::select('deposit_to', !is_null($payroll_payment_deposit_to) ?
												[$payroll_payment_deposit_to->id => $payroll_payment_deposit_to->name] : [], $payroll_payment_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][payroll_payment][deposit_to]",
												'id' => $business_location->id . '_payroll_payment_deposit_to', 'style' => 'width: 100%;']); ?>

											</div>
										</div>
									</div>

									<strong>Payroll Advance Payments</strong>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('payment_account', 'Payroll Payment Credit:' ); ?>

												<?php echo Form::select('payment_account', !is_null($payroll_advance_payment_account) ? [$payroll_advance_payment_account->id => $payroll_advance_payment_account->name] : [], $payroll_advance_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 'name' => "accounting_default_map[$business_location->id][payroll_advance][payment_account]",
												'id' => $business_location->id . 'payroll_advance_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', 'Payroll Payment Debit:' ); ?>

												<?php echo Form::select('deposit_to', !is_null($payroll_advance_deposit_to) ?
												[$payroll_advance_deposit_to->id => $payroll_advance_deposit_to->name] : [], $payroll_advance_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][payroll_advance][deposit_to]",
												'id' => $business_location->id . '_payroll_advance_deposit_to', 'style' => 'width: 100%;']); ?>

											</div>
										</div>
									</div>

									<hr>
									<strong><?php echo app('translator')->get('accounting::lang.expenses_title'); ?></strong>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('payment_account', __('accounting::lang.expense_credit') . ':' ); ?>

												<?php echo Form::select('payment_account', !is_null($expense_payment_account) ? [$expense_payment_account->id => $expense_payment_account->name] : [], $expense_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 'name' => "accounting_default_map[$business_location->id][expense][payment_account]",
												'id' => $business_location->id . 'expense_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', __('accounting::lang.expense_debit') . ':' ); ?>

												<?php echo Form::select('deposit_to', !is_null($expense_deposit_to) ?
												[$expense_deposit_to->id => $expense_deposit_to->name] : [], $expense_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][expense][deposit_to]",
												'id' => $business_location->id . '_expense_deposit_to', 'style' => 'width: 100%;']); ?>

											</div>
										</div>
									</div>

									
									<strong><?php echo app('translator')->get('accounting::lang.expense_payments_title'); ?></strong>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('payment_account', __('accounting::lang.expense_payment_credit') . ':' ); ?>

												<?php echo Form::select('payment_account', !is_null($expense_payment_payment_account) ? [$expense_payment_payment_account->id => $expense_payment_payment_account->name] : [], $expense_payment_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 'name' => "accounting_default_map[$business_location->id][expense_payment][payment_account]",
												'id' => $business_location->id . 'expense_payment_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', __('accounting::lang.expense_debit_payable') . ':' ); ?>

												<?php echo Form::select('deposit_to', !is_null($expense_payment_deposit_to) ?
												[$expense_payment_deposit_to->id => $expense_payment_deposit_to->name] : [], $expense_payment_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][expense_payment][deposit_to]",
												'id' => $business_location->id . '_expense_payment_deposit_to', 'style' => 'width: 100%;']); ?>

											</div>
										</div>
									</div>

									
									<strong><?php echo app('translator')->get('accounting::lang.tax_expense'); ?></strong>

									<div class="row">
										<div class="col-md-6 hide">
											<div class="form-group">
												<?php echo Form::label('payment_account', __('accounting::lang.tax_expense_credit') . ':' ); ?>

												<?php echo Form::select('payment_account', !is_null($tax_expense_payment_account) ? [$tax_expense_payment_account->id => $tax_expense_payment_account->name] : [], $tax_expense_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.payment_account'), 
												'name' => "accounting_default_map[$business_location->id][tax_expense][payment_account]", 'id' => $business_location->id . 'tax_expense_payment_account', 'style' => 'width: 100%;']); ?>

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<?php echo Form::label('deposit_to', __('accounting::lang.tax_expense_debit') . ':' ); ?>

												<?php echo Form::select('deposit_to', !is_null($tax_expense_deposit_to) ?
												[$tax_expense_deposit_to->id => $tax_expense_deposit_to->name] : [], $tax_expense_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown width-100','placeholder' => __('accounting::lang.deposit_to'), 'name' => "accounting_default_map[$business_location->id][tax_expense][deposit_to]",
												'id' => $business_location->id . 'tax_expense_deposit_to', 'style' => 'width: 100%;'
												]); ?>

											</div>
										</div>
									</div>

									<?php echo $__env->renderComponent(); ?>
								</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						</div>
						<?php $__currentLoopData = $business_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $business_location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						<?php echo Form::close(); ?>


						<div id="accounting-settings-footer-actions-template" class="d-none">
							<button class="btn btn-primary" type="submit" form="accounting_settings_form">
								<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>
							</button>
						</div>

					</div>



					<div class="tab-pane fade" id="sub_type_tab" role="tabpanel">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-primary float-end" id="add_account_sub_type">
									<i class="fas fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
								</button>
							</div>
							<div class="col-md-12">
								<br>
								<div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="account_sub_type_table">
									<thead>
										<tr>
											<th>
												<?php echo app('translator')->get('accounting::lang.account_sub_type'); ?>
											</th>
											<th>
												<?php echo app('translator')->get('accounting::lang.account_type'); ?>
											</th>
											<th>
												<?php echo app('translator')->get('messages.action'); ?>
											</th>
										</tr>
									</thead>
								</table>
</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="detail_type_tab" role="tabpanel">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-primary float-end" id="add_detail_type">
									<i class="fas fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
								</button>
							</div>
							<div class="col-md-12">
								<br>
								<div class="table-responsive">
<table class="table table-striped table-th-skin" id="detail_type_table" style="width: 100%;">
									<thead>
										<tr>
											<th>
												<?php echo app('translator')->get('accounting::lang.detail_type'); ?>
											</th>
											<th>
												<?php echo app('translator')->get('accounting::lang.parent_type'); ?>
											</th>
											<th>
												<?php echo app('translator')->get('lang_v1.description'); ?>
											</th>
											<th>
												<?php echo app('translator')->get('messages.action'); ?>
											</th>
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
	<?php else: ?>
		<div class="container">
			<h2>You do not have permission to access this page.<h2>
		</div>
	<?php endif; ?>
</section>
<?php echo $__env->make('accounting::account_type.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="modal fade" id="edit_account_type_modal" tabindex="-1" role="dialog">
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

<?php echo $__env->make('accounting::accounting.common_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script type="text/javascript">
	$(document).ready(function() {
		function syncAccountingLocationTabs(activeLink) {
			var $tabs = $('#accounting_location_tabs');

			if (!$tabs.length) {
				return;
			}

			var $activeLink = activeLink ? $(activeLink) : $tabs.find('a.nav-link.active').first();

			$tabs.find('li.nav-item').removeClass('active');
			$activeLink.closest('li.nav-item').addClass('active');
		}

		syncAccountingLocationTabs();

		$(document).on('shown.bs.tab click', '#accounting_location_tabs a[data-bs-toggle="tab"]', function() {
			var link = this;

			setTimeout(function() {
				syncAccountingLocationTabs(link);
			}, 0);
		});

		account_sub_type_table = $('#account_sub_type_table').DataTable({
			processing: true,
			serverSide: true,
			ajax: "<?php echo e(action([\Modules\Accounting\Http\Controllers\AccountTypeController::class, 'index']), false); ?>?account_type=sub_type",
			columnDefs: [{
				targets: [2],
				orderable: false,
				searchable: false,
			}, ],
			columns: [{
					data: 'name',
					name: 'name'
				},
				{
					data: 'account_primary_type',
					name: 'account_primary_type'
				},
				{
					data: 'action',
					name: 'action'
				},
			],
		});

		detail_type_table = $('#detail_type_table').DataTable({
			processing: true,
			serverSide: true,
			ajax: "<?php echo e(action([\Modules\Accounting\Http\Controllers\AccountTypeController::class, 'index']), false); ?>?account_type=detail_type",
			columnDefs: [{
				targets: 3,
				orderable: false,
				searchable: false,
			}, ],
			columns: [{
					data: 'name',
					name: 'name'
				},
				{
					data: 'parent_type',
					name: 'parent_type'
				},
				{
					data: 'description',
					name: 'description'
				},
				{
					data: 'action',
					name: 'action'
				},
			],
		});

		$('#add_account_sub_type').click(function() {
			$('#account_type').val('sub_type')
			$('#account_type_title').text("<?php echo e(__('accounting::lang.add_account_sub_type'), false); ?>");
			$('#description_div').addClass('hide');
			$('#parent_id_div').addClass('hide');
			$('#account_type_div').removeClass('hide');
			$('#create_account_type_modal').modal('show');
		});

		$('#add_detail_type').click(function() {
			$('#account_type').val('detail_type')
			$('#account_type_title').text("<?php echo e(__('accounting::lang.add_detail_type'), false); ?>");
			$('#description_div').removeClass('hide');
			$('#parent_id_div').removeClass('hide');
			$('#account_type_div').addClass('hide');
			$('#create_account_type_modal').modal('show');
		})

		function setCoaOrder() {
			let order = $("#sortable").sortable("toArray", { attribute: "data-key" });
			$("#coa_order").val(JSON.stringify(order));
		}

		$("#sortable").sortable({
			update: setCoaOrder
		});
		setCoaOrder();
	});
	$(document).on('hidden.bs.modal', '#create_account_type_modal', function(e) {
		$('#create_account_type_form')[0].reset();
	})
	$(document).on('submit', 'form#create_account_type_form', function(e) {
		e.preventDefault();
		var form = $(this);
		var data = form.serialize();

		$.ajax({
			method: 'POST',
			url: $(this).attr('action'),
			dataType: 'json',
			data: data,
			success: function(result) {
				if (result.success == true) {
					$('#create_account_type_modal').modal('hide');
					toastr.success(result.msg);
					if (result.data.account_type == 'sub_type') {
						account_sub_type_table.ajax.reload();
					} else {
						detail_type_table.ajax.reload();
					}
					$('#create_account_type_form').find('button[type="submit"]').attr('disabled', false);
				} else {
					toastr.error(result.msg);
				}
			},
		});
	});

	$(document).on('submit', 'form#edit_account_type_form', function(e) {
		e.preventDefault();
		var form = $(this);
		var data = form.serialize();

		$.ajax({
			method: 'PUT',
			url: $(this).attr('action'),
			dataType: 'json',
			data: data,
			success: function(result) {
				if (result.success == true) {
					$('#edit_account_type_modal').modal('hide');
					toastr.success(result.msg);
					if (result.data.account_type == 'sub_type') {
						account_sub_type_table.ajax.reload();
					} else {
						detail_type_table.ajax.reload();
					}

				} else {
					toastr.error(result.msg);
				}
			},
		});
	});

	$(document).on('click', 'button.delete_account_type_button', function() {
		swal({
			title: LANG.sure,
			icon: 'warning',
			buttons: true,
			dangerMode: true,
		}).then(willDelete => {
			if (willDelete) {
				var href = $(this).data('href');
				var data = $(this).serialize();

				$.ajax({
					method: 'DELETE',
					url: href,
					dataType: 'json',
					data: data,
					success: function(result) {
						if (result.success == true) {
							toastr.success(result.msg);
							account_sub_type_table.ajax.reload();
							detail_type_table.ajax.reload();
						} else {
							toastr.error(result.msg);
						}
					},
				});
			}
		});
	});

	$(document).on('click', 'button.accounting_reset_data', function(e) {
		e.preventDefault();
		swal({
			title: LANG.sure,
			icon: 'warning',
			text: "<?php echo app('translator')->get('accounting::lang.reset_help_txt'); ?>",
			buttons: true,
			dangerMode: true,
		}).then(willDelete => {
			if (willDelete) {
				var href = $(this).data('href');
				window.location.href = href;
			}
		});
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>