<div class="table-responsive">
	<table class="table bg-gray">
		<thead>
			<tr class="bg-green">
	            <th>#</th>
	            <th class="col-md-4"><?php echo app('translator')->get('project::lang.task'); ?></th>
	            <th><?php echo app('translator')->get('project::lang.rate'); ?></th>
	            <th><?php echo app('translator')->get('sale.qty'); ?></th>
	            <th><?php echo app('translator')->get('business.tax'); ?></th>
	            <th><?php echo app('translator')->get('receipt.total'); ?></th>
	        </tr>
	    </thead>
	    <tbody>
	    	<?php $__currentLoopData = $transaction->invoiceLines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $invoiceLine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		    	<tr>
		    		<td><?php echo e($loop->iteration, false); ?></td>
		    		<td>
		    			<?php echo e($invoiceLine->task, false); ?>

		    			<?php if(isset($invoiceLine->description)): ?>
		    				<br>
		    				(<?php echo $invoiceLine->description; ?>)
		    			<?php endif; ?>
		    		</td>
		    		<td>
		    			<span class="display_currency" data-currency_symbol="true">
		    				<?php echo e($invoiceLine->rate, false); ?>

		    			</span>
		    		</td>
		    		<td><?php echo e(number_format($invoiceLine->quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
		    		<td>
		    			<?php if(isset($invoiceLine->tax->name)): ?>
		    				<?php echo e($invoiceLine->tax->name, false); ?>

		    			<?php else: ?>
		    				<?php echo app('translator')->get('lang_v1.none'); ?>
		    			<?php endif; ?>
		    		</td>
		    		<td>
		    			<span class="display_currency" data-currency_symbol="true">
		    				<?php echo e($invoiceLine->total, false); ?>

		    			</span>
		    		</td>
		    	</tr>
		    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	    </tbody>
	</table>
</div>