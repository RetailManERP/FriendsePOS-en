<div class="table-responsive">
<table class="table table-condensed table-th-skin" id="customer_invoice_table">
	<tr>
		<th><?php echo app('translator')->get('contact.customer'); ?></th>
		<th><?php echo app('translator')->get('crm::lang.assgined'); ?></th>
		<th  class="text-center"><i class="fas fa-times text-danger"></i></th>
	</tr>
	<?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<tr>
		<td>
			<?php if(!empty($customer->supplier_business_name)): ?>
				<?php echo e($customer->supplier_business_name, false); ?><br>
			<?php endif; ?>
			<?php echo e($customer->name, false); ?>

		</td>
		<td>
			<div class="form-group">
                <?php echo Form::select('follow_ups[' . $customer->id . '][user_id][]', $users, $customer->created_by, ['class' => 'form-control select2', 'required', 'style' => 'width: 100%;']); ?>

            </div>
		</td>
		<td class="text-center">
			<i class="fas fa-times text-danger remove-follow-up" style="cursor: pointer;"></i>
		</td>
	</tr>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
</div>
