<?php if($__is_mfg_enabled): ?>
	<?php
		$__mfg_can_dashboard = auth()->user()->can('manufacturing.access_dashboard');
		$__mfg_can_demand_reports = auth()->user()->can('manufacturing.demand_order_report.view')
			|| auth()->user()->can('manufacturing.demand_ingredient_report.view')
			|| auth()->user()->can('manufacturing.access_reports');
		$__mfg_can_production_reports = auth()->user()->can('manufacturing.manufacturing_report.view')
			|| auth()->user()->can('manufacturing.recipe_report.view')
			|| auth()->user()->can('manufacturing.productions_report.view')
			|| auth()->user()->can('manufacturing.production_transfer_products_summary.view')
			|| auth()->user()->can('manufacturing.access_reports');
		$__mfg_can_reports = $__mfg_can_demand_reports || $__mfg_can_production_reports;
		$__mfg_can_settings = auth()->user()->can('superadmin')
			|| auth()->user()->hasRole('Admin#' . session()->get('user.business_id'))
			|| auth()->user()->can('manufacturing.access_settings');
	?>
	<li class="treeview bg-manufacturing <?php echo e(in_array($request->segment(1), ['manufacturing']) ? 'active active-sub' : '', false); ?>">
	    <a href="#">
	        <i class="fa fa-industry"></i>
	        <span class="title"><?php echo app('translator')->get('manufacturing::lang.manufacturing'); ?></span>
	        <span class="float-end-container">
	            <i class="fa fa-angle-left float-end"></i>
	        </span>
	    </a>

	    <ul class="treeview-menu">
	    	
			<?php if($__mfg_can_dashboard): ?>
				<li class="<?php echo e($request->segment(2) == 'dashboard' ? 'active active-sub' : '', false); ?>">
					<a href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\ProductionDashboardController::class, 'index']), false); ?>">
						<i class="fa fa-tachometer-alt"></i>
						<span class="title">
							<?php echo app('translator')->get('manufacturing::lang.dashboard'); ?>
						</span>
				  	</a>
				</li>
			<?php endif; ?>

			
	    	<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manufacturing.access_recipe')): ?>
		    	<li class="<?php echo e($request->segment(1) == 'manufacturing' && in_array($request->segment(2), ['recipe', 'add-ingredient']) ? 'active active-sub' : '', false); ?>">
					<a href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\RecipeController::class, 'index']), false); ?>">
						<i class="fa fa-utensils"></i>
						<span class="title">
							<?php echo app('translator')->get('manufacturing::lang.recipe'); ?>
						</span>
				  	</a>
				</li>
			<?php endif; ?>

			<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manufacturing.access_production')): ?>
				
				<li class="<?php echo e($request->segment(2) == 'production' && empty($request->segment(3))  ? 'active active-sub' : '', false); ?>">
					<a href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\ProductionController::class, 'index']), false); ?>">
						<i class="fa fa-cogs"></i>
						<span class="title">
							<?php echo app('translator')->get('manufacturing::lang.production'); ?>
						</span>
				  	</a>
				</li>
			<?php endif; ?>

			<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manufacturing.add_demand_order')): ?>
				
				<li class="<?php echo e($request->segment(2) == 'demand-order' && $request->segment(3) == 'create' ? 'active active-sub' : '', false); ?>">
					<a href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\DemandOrderController::class, 'create']), false); ?>">
						<i class="fa fa-clipboard-list"></i>
						<span class="title">
							<?php echo app('translator')->get('manufacturing::lang.add_demand_order'); ?>
						</span>
				  	</a>
				</li>
			<?php endif; ?>

			<?php if($__mfg_can_reports): ?>
				
				<?php
					$__mfg_is_reports_active = ($request->segment(2) == 'demand-order' && $request->segment(3) != 'create')
						|| $request->segment(2) == 'demand-ingredient-report'
						|| $request->segment(2) == 'report'
				|| $request->segment(2) == 'recipe-report'
				|| $request->segment(2) == 'productions-report'
				|| $request->segment(2) == 'production-transfer-products-summary';
				?>
				<li class="treeview <?php echo e($__mfg_is_reports_active ? 'active active-sub' : '', false); ?>">
					<a href="#">
						<i class="fa fa-chart-bar"></i>
						<span class="title"><?php echo app('translator')->get('manufacturing::lang.reports'); ?></span>
						<span class="float-end-container">
							<i class="fa fa-angle-left float-end"></i>
						</span>
					</a>
					<ul class="treeview-menu">
					<?php if(auth()->user()->can('manufacturing.demand_order_report.view') || auth()->user()->can('manufacturing.access_reports')): ?>
						<li class="<?php echo e($request->segment(2) == 'demand-order' && $request->segment(3) != 'create' ? 'active active-sub' : '', false); ?>">
							<a href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\DemandOrderController::class, 'index']), false); ?>">
								<i class="fa fa-list-alt"></i>
								<span class="title"><?php echo app('translator')->get('manufacturing::lang.demand_order'); ?></span>
							</a>
						</li>
						<?php endif; ?>
					<?php if(auth()->user()->can('manufacturing.demand_ingredient_report.view') || auth()->user()->can('manufacturing.access_reports')): ?>
						<li class="<?php echo e($request->segment(2) == 'demand-ingredient-report' ? 'active active-sub' : '', false); ?>">
							<a href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\DemandIngredientReportController::class, 'index']), false); ?>">
								<i class="fa fa-flask"></i>
								<span class="title"><?php echo app('translator')->get('manufacturing::lang.demand_ingredient_report'); ?></span>
							</a>
						</li>
						<?php endif; ?>
					<?php if(auth()->user()->can('manufacturing.manufacturing_report.view') || auth()->user()->can('manufacturing.access_reports')): ?>
						<li class="<?php echo e($request->segment(2) == 'report' ? 'active active-sub' : '', false); ?>">
							<a href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\ProductionController::class, 'getManufacturingReport']), false); ?>">
								<i class="fa fa-chart-line"></i>
								<span class="title"><?php echo app('translator')->get('manufacturing::lang.manufacturing_report'); ?></span>
							</a>
						</li>
						<?php endif; ?>
					<?php if(auth()->user()->can('manufacturing.recipe_report.view') || auth()->user()->can('manufacturing.access_reports')): ?>
						<li class="<?php echo e($request->segment(2) == 'recipe-report' ? 'active active-sub' : '', false); ?>">
							<a href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\RecipeController::class, 'getRecipeReport']), false); ?>">
								<i class="fa fa-utensils"></i>
								<span class="title"><?php echo app('translator')->get('manufacturing::lang.recipe_report'); ?></span>
							</a>
						</li>
						<?php endif; ?>
					<?php if(auth()->user()->can('manufacturing.productions_report.view') || auth()->user()->can('manufacturing.access_reports')): ?>
						<li class="<?php echo e($request->segment(2) == 'productions-report' ? 'active active-sub' : '', false); ?>">
							<a href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\ProductionsReportController::class, 'index']), false); ?>">
								<i class="fa fa-chart-area"></i>
								<span class="title"><?php echo app('translator')->get('manufacturing::lang.productions_report'); ?></span>
							</a>
						</li>
						<?php endif; ?>
					<?php if(auth()->user()->can('manufacturing.production_transfer_products_summary.view') || auth()->user()->can('manufacturing.access_reports')): ?>
						<li class="<?php echo e($request->segment(2) == 'production-transfer-products-summary' ? 'active active-sub' : '', false); ?>">
							<a href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\ProductionsReportController::class, 'productionTransferProductsSummary']), false); ?>">
								<i class="fa fa-balance-scale"></i>
								<span class="title"><?php echo app('translator')->get('manufacturing::lang.production_transfer_products_summary'); ?></span>
							</a>
						</li>
					<?php endif; ?>
					</ul>
				</li>
			<?php endif; ?>

			<?php if($__mfg_can_settings): ?>
				
				<li class="<?php echo e($request->segment(1) == 'manufacturing' && $request->segment(2) == 'settings' ? 'active active-sub' : '', false); ?>">
					<a href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\SettingsController::class, 'index']), false); ?>">
						<i class="fa fa-wrench"></i>
						<span class="title">
							<?php echo app('translator')->get('messages.settings'); ?>
						</span>
				  	</a>
				</li>
			<?php endif; ?>
        </ul>
	</li>
<?php endif; ?>
