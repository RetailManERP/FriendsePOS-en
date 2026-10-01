<table class="table table-condensed bg-gray table-th-skin">
	<thead>
		<tr>
			<th>
				<?php echo app('translator')->get('contact.customer'); ?>
			</th>
			<th>
				<?php echo app('translator')->get('crm::lang.converted_on'); ?>
			</th>
		</tr>
	</thead>
	<tbody>
		<?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td>
					<?php if(!empty($contact->supplier_business_name)): ?>
						<?php echo e($contact->supplier_business_name, false); ?><br>
					<?php endif; ?>
					<?php echo e($contact->name, false); ?>

				</td>
				<td><?php echo format_datetime_br($contact->converted_on); ?></td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tbody>
</table>
