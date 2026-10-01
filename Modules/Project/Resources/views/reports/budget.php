
<?php $__env->startSection('title', __('project::lang.budget_report')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('project::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header">
	<h1>
		<?php echo app('translator')->get('project::lang.budget_report'); ?>
		<small>- <?php echo e($project->name, false); ?></small>
	</h1>
</section>

<section class="content">
	<?php echo $__env->make('project::reports.partials._switcher', ['current_route' => 'budget', 'project' => $project, 'projects' => $projects], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-4 tw-gap-4 tw-mb-5">
		<div class="tw-bg-white tw-rounded-xl tw-border tw-border-gray-200 tw-p-5 tw-text-center">
			<div class="tw-text-sm tw-text-gray-500 tw-mb-1"><?php echo app('translator')->get('project::lang.budget'); ?></div>
			<div class="tw-text-2xl tw-font-bold tw-text-gray-900">
				<span class="display_currency" data-currency_symbol="true"><?php echo e($budget, false); ?></span>
			</div>
		</div>
		<div class="tw-bg-white tw-rounded-xl tw-border tw-border-gray-200 tw-p-5 tw-text-center">
			<div class="tw-text-sm tw-text-gray-500 tw-mb-1"><?php echo app('translator')->get('project::lang.actual_spend'); ?></div>
			<div class="tw-text-2xl tw-font-bold tw-text-orange-600">
				<span class="display_currency" data-currency_symbol="true"><?php echo e($actual_spend, false); ?></span>
			</div>
		</div>
		<div class="tw-bg-white tw-rounded-xl tw-border tw-border-gray-200 tw-p-5 tw-text-center">
			<div class="tw-text-sm tw-text-gray-500 tw-mb-1"><?php echo app('translator')->get('project::lang.remaining'); ?></div>
			<div class="tw-text-2xl tw-font-bold <?php echo e($remaining < 0 ? 'tw-text-red-600' : 'tw-text-green-600', false); ?>">
				<span class="display_currency" data-currency_symbol="true"><?php echo e($remaining, false); ?></span>
			</div>
		</div>
		<div class="tw-bg-white tw-rounded-xl tw-border tw-border-gray-200 tw-p-5 tw-text-center">
			<div class="tw-text-sm tw-text-gray-500 tw-mb-1"><?php echo app('translator')->get('project::lang.invoiced'); ?></div>
			<div class="tw-text-2xl tw-font-bold tw-text-blue-600">
				<span class="display_currency" data-currency_symbol="true"><?php echo e($invoiced_total, false); ?></span>
			</div>
			<div class="tw-text-xs tw-text-gray-500 tw-mt-1">
				<?php echo app('translator')->get('project::lang.total_paid'); ?>: <span class="display_currency" data-currency_symbol="true"><?php echo e($invoiced_paid, false); ?></span>
			</div>
		</div>
	</div>

	<?php if($budget > 0): ?>
		<?php
			$pct = $budget > 0 ? min(100, max(0, round(($actual_spend / $budget) * 100, 1))) : 0;
			$bar_color = $pct >= 100 ? 'tw-bg-red-500' : ($pct >= 75 ? 'tw-bg-yellow-500' : 'tw-bg-green-500');
		?>
		<div class="tw-bg-white tw-rounded-xl tw-border tw-border-gray-200 tw-p-5">
			<div class="tw-flex tw-justify-between tw-mb-2 tw-text-sm">
				<span class="tw-font-semibold tw-text-gray-700"><?php echo app('translator')->get('project::lang.budget_vs_actual'); ?></span>
				<span class="tw-text-gray-600"><?php echo e($pct, false); ?>%</span>
			</div>
			<div class="tw-w-full tw-bg-gray-200 tw-rounded-full tw-h-3 tw-overflow-hidden">
				<div class="<?php echo e($bar_color, false); ?> tw-h-3" style="width: <?php echo e($pct, false); ?>%;"></div>
			</div>
		</div>
	<?php endif; ?>

</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>