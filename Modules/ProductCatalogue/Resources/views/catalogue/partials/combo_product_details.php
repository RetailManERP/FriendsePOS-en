<div class="mt-4">
	<div class="d-flex align-items-center mb-3">
		<span class="me-2" style="width:28px; height:28px; display:inline-flex; align-items:center; justify-content:center; background:linear-gradient(135deg,#667eea,#764ba2); color:#fff; border-radius:6px; font-size:.75rem;">
			<i class="fas fa-cubes"></i>
		</span>
		<h6 class="fw-bold mb-0"><?php echo app('translator')->get('lang_v1.combo'); ?></h6>
	</div>
	<div class="row g-3">
		<?php $__currentLoopData = $combo_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col-6 col-md-4 col-lg-3">
				<div class="card h-100 border-0 shadow-sm" style="border-radius:12px; overflow:hidden;">
					<div class="text-center p-2" style="background:#f8f9fa;">
						<?php if(!empty($variation['variation']->media->first())): ?>
							<img src="<?php echo e($variation['variation']->media->first()->display_url, false); ?>" class="img-fluid rounded" alt="Product image" style="height:120px; object-fit:contain;">
						<?php else: ?>
							<img src="<?php echo e($product->image_url, false); ?>" alt="Product image" class="img-fluid rounded" style="height:120px; object-fit:contain;">
						<?php endif; ?>
					</div>
					<div class="card-body p-2 d-flex flex-column" style="font-size:.85rem;">
						<h6 class="fw-semibold mb-1" style="font-size:.82rem; line-height:1.3;">
							<?php echo e($variation['variation']['product']->name, false); ?>

							<?php if($variation['variation']['product']->type == 'variable'): ?>
								- <?php echo e($variation['variation']->name, false); ?>

							<?php endif; ?>
						</h6>
						<div class="text-muted small mb-1">
							<i class="fas fa-barcode me-1"></i><?php echo e($variation['variation']->sub_sku, false); ?>

						</div>
						<div class="fw-bold mb-1" style="color:#16a34a;">
							<span class="display_currency" data-currency_symbol="true"><?php echo e($variation['variation']->sell_price_inc_tax, false); ?></span>
						</div>
						<div class="text-muted small">
							<i class="fas fa-boxes me-1"></i><?php echo app('translator')->get('sale.qty'); ?>:
							<span class="display_currency fw-medium" data-currency_symbol="false" data-is_quantity=true><?php echo e($variation['quantity'], false); ?></span>
							<?php echo e($variation['unit_name'], false); ?>

						</div>
					</div>
				</div>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
</div>