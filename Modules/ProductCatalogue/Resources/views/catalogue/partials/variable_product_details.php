<div class="mt-4">
	<div class="d-flex align-items-center mb-3">
		<span class="me-2" style="width:28px; height:28px; display:inline-flex; align-items:center; justify-content:center; background:linear-gradient(135deg,#667eea,#764ba2); color:#fff; border-radius:6px; font-size:.75rem;">
			<i class="fas fa-layer-group"></i>
		</span>
		<h6 class="fw-bold mb-0"><?php echo app('translator')->get('product.variations'); ?></h6>
	</div>
	<?php
		$settings = json_decode($business->productcatalogue_settings);
		$is_show = $settings->is_show ?? 1;
	?>
	<div class="row g-3">
		<?php $__currentLoopData = $product->variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php if($is_show == 1 || ((!empty(json_decode($variation->variation_location_details, true) && $variation->variation_location_details->first()->qty_available > 0)))): ?>
				<div class="col-6 col-md-4 col-lg-3">
					<div class="card h-100 border-0 shadow-sm" style="border-radius:12px; overflow:hidden;">
						<div class="text-center p-2" style="background:#f8f9fa;">
							<?php if(!empty($variation->media->first())): ?>
								<img src="<?php echo e($variation->media->first()->display_url, false); ?>" class="img-fluid rounded" alt="Product image" style="height:120px; object-fit:contain;">
							<?php else: ?>
								<img src="<?php echo e($product->image_url, false); ?>" alt="Product image" class="img-fluid rounded" style="height:120px; object-fit:contain;">
							<?php endif; ?>
							<?php if(!empty($discounts[$variation->id])): ?>
								<span class="badge" style="position:absolute; top:8px; right:8px; background:linear-gradient(135deg,#f59e0b,#d97706); color:#fff; border-radius:20px; font-size:.7rem; padding:3px 8px;">
									-<?php echo e(number_format($discounts[$variation->id]->discount_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>%
								</span>
							<?php endif; ?>
						</div>
						<div class="card-body p-2 d-flex flex-column" style="font-size:.85rem;">
							<h6 class="fw-semibold mb-1" style="font-size:.82rem; line-height:1.3;">
								<?php echo e($variation->product_variation->name, false); ?> - <?php echo e($variation->name, false); ?>

							</h6>
							<div class="text-muted small mb-1">
								<i class="fas fa-barcode me-1"></i><?php echo e($variation->sub_sku, false); ?>

							</div>
							<div class="fw-bold mb-2" style="color:#16a34a;">
								<span class="display_currency" data-currency_symbol="true"><?php echo e($variation->sell_price_inc_tax, false); ?></span>
							</div>
							<?php if($product->enable_stock && (empty(json_decode($variation->variation_location_details, true))) || (!empty(json_decode($variation->variation_location_details, true) && $variation->variation_location_details->first()->qty_available == 0))): ?>
								<div class="text-danger small mb-1">
									<i class="fas fa-exclamation-circle me-1"></i><?php echo app('translator')->get('productcatalogue::lang.out_of_stock'); ?>
								</div>
							<?php endif; ?>
							<?php
								$qty_available = optional($variation->variation_location_details->first())->qty_available;
								$is_out_of_stock = $product->enable_stock && (empty($qty_available) || $qty_available <= 0);
								$variation_label = $variation->product_variation->name . ' - ' . $variation->name;
							?>
							<div class="mt-auto">
								<button type="button"
									class="btn btn-sm w-100 add-to-cart-btn text-white"
									style="background:linear-gradient(135deg,#16a34a,#15803d); border:none; border-radius:6px; font-weight:600; font-size:.78rem; padding:.35rem .5rem;"
									data-variation-id="<?php echo e($variation->id, false); ?>"
									data-product-id="<?php echo e($product->id, false); ?>"
									data-product-name="<?php echo e($product->name, false); ?> - <?php echo e($variation_label, false); ?>"
									data-price="<?php echo e($variation->sell_price_inc_tax, false); ?>"
									<?php if($is_out_of_stock): ?> disabled <?php endif; ?>>
									<i class="fas fa-cart-plus me-1"></i> Add
								</button>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
</div>