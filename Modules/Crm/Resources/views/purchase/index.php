

<?php $__env->startSection('title', __('purchase.purchases')); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header no-print">
   <h1><?php echo app('translator')->get('purchase.purchases'); ?></h1>
</section>
<!-- Main content -->
<section class="content no-print">
	<?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('status_filter',  __('purchase.purchase_status') . ':'); ?>

                <?php echo Form::select('status_filter', $orderStatuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('payment_status_filter',  __('purchase.payment_status') . ':'); ?>

                <?php echo Form::select('payment_status_filter', ['paid' => __('lang_v1.paid'), 'due' => __('lang_v1.due'), 'partial' => __('lang_v1.partial'), 'overdue' => __('lang_v1.overdue')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('date_range_filter', __('report.date_range') . ':'); ?>

                <?php echo Form::text('date_range_filter', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('purchase.all_purchases')]); ?>
        <div class="table-responsive">
        	<table class="table table-bordered table-striped ajax_view table-th-skin" id="contact_purchase_table">
        		<thead>
        			<tr>
        				<th><?php echo app('translator')->get('messages.action'); ?></th>
        				<th><?php echo app('translator')->get('messages.date'); ?></th>
		                <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
		                <th><?php echo app('translator')->get('purchase.purchase_status'); ?></th>
		                <th><?php echo app('translator')->get('purchase.payment_status'); ?></th>
		                <th><?php echo app('translator')->get('purchase.grand_total'); ?></th>
		                <th><?php echo app('translator')->get('purchase.payment_due'); ?> &nbsp;&nbsp;<i class="fa fa-info-circle text-info no-print" data-bs-toggle="tooltip" data-placement="bottom" data-html="true" data-original-title="<?php echo e(__('messages.purchase_due_tooltip'), false); ?>" aria-hidden="true"></i></th>
		                <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
        			</tr>
        		</thead>
        		<tfoot>
		            <tr class="bg-gray font-17 text-center footer-total">
						<td colspan="3">
							<strong><?php echo app('translator')->get('sale.total'); ?>:</strong>
						</td>
						<td id="footer_status_count"></td>
						<td id="footer_payment_status_count"></td>
						<td>
							<span class="display_currency" id="footer_purchase_total" data-currency_symbol ="true">
							</span>
						</td>
						<td class="text-left">
							<small><?php echo app('translator')->get('report.purchase_due'); ?> -
								<span class="display_currency" id="footer_total_due" data-currency_symbol ="true"></span>
								<br>
								<?php echo app('translator')->get('lang_v1.purchase_return'); ?> - 
									<span class="display_currency" id="footer_total_purchase_return_due" data-currency_symbol ="true"></span>
							</small>
						</td>	
						<td></td>
		            </tr>
		        </tfoot>
        	</table>
        </div>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('js/purchase.js?v=' . $asset_v), false); ?>"></script>
<script src="<?php echo e(asset('modules/crm/js/crm.js?v=' . $asset_v), false); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('crm::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>