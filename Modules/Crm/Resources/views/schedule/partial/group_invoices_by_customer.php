<div class="table-responsive">
<table class="table table-condensed table-th-skin" id="customer_invoice_table">
	<tr>
		<th><?php echo app('translator')->get('contact.customer'); ?></th>
		<th><?php echo app('translator')->get('lang_v1.invoices'); ?></th>
		<th><?php echo app('translator')->get('crm::lang.assgined'); ?></th>
		<th  class="text-center"><i class="fas fa-times text-danger"></i></th>
	</tr>
	<?php $__currentLoopData = $sells_by_customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<tr>
		<td>
			<?php
				$contact = $value[0]->contact;
			?>
			<?php if(!empty($contact->supplier_business_name)): ?>
				<?php echo e($contact->supplier_business_name, false); ?><br>
			<?php endif; ?>
			<?php echo e($contact->name, false); ?>

		</td>
		<td>
			<?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sell): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php echo e($sell->invoice_no, false); ?> <?php if(!$loop->last): ?>,<?php endif; ?>
				<input type="hidden" name="follow_ups[<?php echo e($key, false); ?>][invoices][]" value="<?php echo e($sell->id, false); ?>">
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</td>
		<td>
			<div class="form-group">
                <?php echo Form::select('follow_ups[' . $key . '][user_id][]', $users, $contact->created_by, ['class' => 'form-control select2', 'required', 'style' => 'width: 100%;']); ?>

            </div>
		</td>
		<td class="text-center">
			<i class="fas fa-times text-danger remove-follow-up" style="cursor: pointer;"></i>
		</td>
	</tr>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
</div>
