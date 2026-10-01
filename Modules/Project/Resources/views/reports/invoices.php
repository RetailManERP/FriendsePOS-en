
<?php $__env->startSection('title', __('project::lang.invoices_report')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('project::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header">
	<h1>
		<?php echo app('translator')->get('project::lang.invoices_report'); ?>
		<small>- <?php echo e($project->name, false); ?></small>
	</h1>
</section>

<section class="content">
	<?php echo $__env->make('project::reports.partials._switcher', ['current_route' => 'invoices', 'project' => $project, 'projects' => $projects], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-4 tw-gap-4 tw-mb-5">
		<div class="tw-bg-white tw-rounded-xl tw-border tw-border-gray-200 tw-p-4 tw-text-center">
			<div class="tw-text-xs tw-text-gray-500"><?php echo app('translator')->get('project::lang.invoice_count'); ?></div>
			<div class="tw-text-2xl tw-font-bold tw-text-gray-900"><?php echo e($totals['count'], false); ?></div>
		</div>
		<div class="tw-bg-white tw-rounded-xl tw-border tw-border-gray-200 tw-p-4 tw-text-center">
			<div class="tw-text-xs tw-text-gray-500"><?php echo app('translator')->get('project::lang.invoiced'); ?></div>
			<div class="tw-text-2xl tw-font-bold tw-text-blue-600">
				<span class="display_currency" data-currency_symbol="true"><?php echo e($totals['invoiced'], false); ?></span>
			</div>
		</div>
		<div class="tw-bg-white tw-rounded-xl tw-border tw-border-gray-200 tw-p-4 tw-text-center">
			<div class="tw-text-xs tw-text-gray-500"><?php echo app('translator')->get('project::lang.total_paid'); ?></div>
			<div class="tw-text-2xl tw-font-bold tw-text-green-600">
				<span class="display_currency" data-currency_symbol="true"><?php echo e($totals['paid'], false); ?></span>
			</div>
		</div>
		<div class="tw-bg-white tw-rounded-xl tw-border tw-border-gray-200 tw-p-4 tw-text-center">
			<div class="tw-text-xs tw-text-gray-500"><?php echo app('translator')->get('project::lang.total_due'); ?></div>
			<div class="tw-text-2xl tw-font-bold <?php echo e($totals['due'] > 0 ? 'tw-text-red-600' : 'tw-text-gray-700', false); ?>">
				<span class="display_currency" data-currency_symbol="true"><?php echo e($totals['due'], false); ?></span>
			</div>
		</div>
	</div>

	<div class="tw-bg-white tw-rounded-xl tw-border tw-border-gray-200 tw-overflow-hidden">
		<?php if($invoices->isEmpty()): ?>
			<div class="tw-p-6 tw-text-center tw-text-gray-500"><?php echo app('translator')->get('project::lang.no_invoices'); ?></div>
		<?php else: ?>
			<div class="table-responsive">
				<table class="table table-striped table-th-skin tw-mb-0">
					<thead>
						<tr>
							<th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
							<th><?php echo app('translator')->get('sale.sale_date'); ?></th>
							<th><?php echo app('translator')->get('contact.customer'); ?></th>
							<th class="text-right"><?php echo app('translator')->get('sale.total_amount'); ?></th>
							<th class="text-right"><?php echo app('translator')->get('project::lang.total_paid'); ?></th>
							<th class="text-right"><?php echo app('translator')->get('project::lang.total_due'); ?></th>
							<th><?php echo app('translator')->get('sale.payment_status'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php $due = $inv->final_total - $inv->paid_amount; ?>
							<tr>
								<td><?php echo e($inv->invoice_no, false); ?></td>
								<td><?php echo e(\Carbon\Carbon::parse($inv->transaction_date)->format('Y-m-d'), false); ?></td>
								<td><?php echo e($inv->customer_name, false); ?></td>
								<td class="text-right"><span class="display_currency" data-currency_symbol="true"><?php echo e($inv->final_total, false); ?></span></td>
								<td class="text-right"><span class="display_currency" data-currency_symbol="true"><?php echo e($inv->paid_amount, false); ?></span></td>
								<td class="text-right"><span class="display_currency" data-currency_symbol="true"><?php echo e($due, false); ?></span></td>
								<td>
									<span class="label
										<?php if($inv->payment_status == 'paid'): ?> label-success
										<?php elseif($inv->payment_status == 'partial'): ?> label-warning
										<?php else: ?> label-danger
										<?php endif; ?>">
										<?php echo e(ucfirst($inv->payment_status ?? '-'), false); ?>

									</span>
								</td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			</div>
		<?php endif; ?>
	</div>

</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>