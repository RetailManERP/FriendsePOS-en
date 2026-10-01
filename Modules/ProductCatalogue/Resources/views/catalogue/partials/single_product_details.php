<div class="mt-4">
	<div class="d-flex align-items-center mb-3">
		<span class="me-2" style="width:28px; height:28px; display:inline-flex; align-items:center; justify-content:center; background:linear-gradient(135deg,#667eea,#764ba2); color:#fff; border-radius:6px; font-size:.75rem;">
			<i class="fas fa-info-circle"></i>
		</span>
		<h6 class="fw-bold mb-0"><?php echo app('translator')->get('product.variations'); ?></h6>
	</div>
	<div class="table-responsive">
		<table class="table table-sm table-hover" style="border-radius:8px; overflow:hidden;">
			<thead style="background:linear-gradient(135deg,#667eea,#764ba2);">
				<tr>
					<th class="text-white fw-semibold border-0" style="font-size:.82rem;"><?php echo app('translator')->get('product.default_selling_price'); ?> (<?php echo app('translator')->get('product.exc_of_tax'); ?>)</th>
				    <th class="text-white fw-semibold border-0" style="font-size:.82rem;"><?php echo app('translator')->get('product.default_selling_price'); ?> (<?php echo app('translator')->get('product.inc_of_tax'); ?>)</th>
			        <th class="text-white fw-semibold border-0" style="font-size:.82rem;"><?php echo app('translator')->get('lang_v1.variation_images'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $product->variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td class="fw-medium" style="font-size:.85rem;">
						<span class="display_currency" data-currency_symbol="true"><?php echo e($variation->default_sell_price, false); ?></span>
					</td>
					<td class="fw-bold" style="color:#16a34a; font-size:.85rem;">
						<span class="display_currency" data-currency_symbol="true"><?php echo e($variation->sell_price_inc_tax, false); ?></span>
					</td>
			        <td>
			        	<?php $__currentLoopData = $variation->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			        		<?php echo $media->thumbnail([60, 60], 'img-thumbnail rounded'); ?>

			        	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			        </td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>
</div>