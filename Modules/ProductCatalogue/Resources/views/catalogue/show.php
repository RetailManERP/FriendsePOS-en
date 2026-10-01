<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
	<div class="modal-content" style="border:none; border-radius:16px; overflow:hidden;">
		
		<div class="modal-header" style="background:linear-gradient(135deg,#667eea 0%,#764ba2 100%); color:#fff; border-bottom:none; padding:1rem 1.5rem;">
		    <h5 class="modal-title fw-bold" id="modalTitle">
		    	<i class="fas fa-box-open me-2"></i><?php echo e($product->name, false); ?>

		    </h5>
		    <button type="button" class="btn-close btn-close-white no-print" data-bs-dismiss="modal" aria-label="Close"></button>
	    </div>

	    
	    <div class="modal-body p-4">
      		<div class="row g-4">
      			
      			<div class="col-md-5">
      				<div class="catalogue-detail-img-wrapper text-center p-3 rounded-3" style="background:#f8f9fa;">
      					<img src="<?php echo e($product->image_url, false); ?>" alt="Product image" class="img-fluid rounded" style="max-height:320px; object-fit:contain;">
      					<?php if($product->type == 'single' && !empty($discounts[$product->variations->first()->id])): ?>
      						<span class="badge catalogue-discount-badge" style="position:absolute; top:16px; right:16px;">
      							-<?php echo e(number_format($discounts[$product->variations->first()->id]->discount_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>%
      						</span>
      					<?php endif; ?>
      				</div>
      			</div>

      			
      			<div class="col-md-7">
      				<?php if($product->type == 'single' || $product->type == 'combo'): ?>
      					<div class="catalogue-detail-price mb-3">
      						<span class="text-muted small"><?php echo app('translator')->get('lang_v1.price'); ?></span>
      						<div class="fs-4 fw-bold" style="color:#16a34a;">
      							<span class="display_currency" data-currency_symbol="true"><?php echo e($product->variations->first()->sell_price_inc_tax, false); ?></span>
      						</div>
      					</div>
      				<?php endif; ?>

      				<div class="table-responsive">
	      				<table class="table table-sm catalogue-detail-table mb-3">
	      					<tbody>
		      					<tr>
		      						<th class="text-muted" style="width:35%;"><?php echo app('translator')->get('product.sku'); ?></th>
		      						<td class="fw-medium"><?php echo e($product->sku, false); ?></td>
		      					</tr>
		      					<tr>
		      						<th class="text-muted"><?php echo app('translator')->get('product.category'); ?></th>
		      						<td class="fw-medium"><?php echo e($product->category->name ?? '--', false); ?></td>
		      					</tr>
		      					<tr>
		      						<th class="text-muted"><?php echo app('translator')->get('product.sub_category'); ?></th>
		      						<td class="fw-medium"><?php echo e($product->sub_category->name ?? '--', false); ?></td>
		      					</tr>
		      					<tr>
		      						<th class="text-muted"><?php echo app('translator')->get('product.brand'); ?></th>
		      						<td class="fw-medium"><?php echo e($product->brand->name ?? '--', false); ?></td>
		      					</tr>
		      					<?php 
	    							$custom_labels = json_decode(session('business.custom_labels'), true);
								?>
								<?php if(!empty($product->product_custom_field1)): ?>
									<tr>
		      							<th class="text-muted"><?php echo e($custom_labels['product']['custom_field_1'] ?? __('lang_v1.product_custom_field1'), false); ?></th>
										<td class="fw-medium"><?php echo e($product->product_custom_field1, false); ?></td>
									</tr>
								<?php endif; ?>
								<?php if(!empty($product->product_custom_field2)): ?>
									<tr>
			      						<th class="text-muted"><?php echo e($custom_labels['product']['custom_field_2'] ?? __('lang_v1.product_custom_field2'), false); ?></th>
										<td class="fw-medium"><?php echo e($product->product_custom_field2, false); ?></td>
									</tr>
								<?php endif; ?>
								<?php if(!empty($product->product_custom_field3)): ?>
									<tr>
		      							<th class="text-muted"><?php echo e($custom_labels['product']['custom_field_3'] ?? __('lang_v1.product_custom_field3'), false); ?></th>
										<td class="fw-medium"><?php echo e($product->product_custom_field3, false); ?></td>
									</tr>
								<?php endif; ?>
								<?php if(!empty($product->product_custom_field4)): ?>
									<tr>
		      							<th class="text-muted"><?php echo e($custom_labels['product']['custom_field_4'] ?? __('lang_v1.product_custom_field4'), false); ?></th>
										<td class="fw-medium"><?php echo e($product->product_custom_field4, false); ?></td>
									</tr>
								<?php endif; ?>
							</tbody>
	      				</table>
	      			</div>

	      			
	      			<?php if(!empty($product->product_description)): ?>
	      				<div class="catalogue-detail-desc mt-2 p-3 rounded-3" style="background:#f8f9fa; font-size:.9rem; line-height:1.65;">
	      					<?php echo $product->product_description; ?>

	      				</div>
	      			<?php endif; ?>

					<?php if(($product->stock < 0 || empty($product->stock)) && $product->enable_stock): ?>
						<div class="alert alert-warning mt-3 py-2 px-3 d-flex align-items-center" style="font-size:.85rem; border-radius:8px;">
							<i class="fas fa-exclamation-triangle me-2"></i>
							<?php echo app('translator')->get('productcatalogue::lang.out_of_stock'); ?>
						</div>
					<?php endif; ?>
	      		</div>
      		</div>

      		
      		<?php if($product->type == 'variable'): ?>
      			<?php echo $__env->make('productcatalogue::catalogue.partials.variable_product_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      		<?php elseif($product->type == 'combo'): ?>
      			<?php echo $__env->make('productcatalogue::catalogue.partials.combo_product_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      		<?php endif; ?>
      	</div>

      	
      	<div class="modal-footer" style="border-top:1px solid #f0f0f0; padding:.75rem 1.25rem;">
	      	<?php
	      		$default_variation = $product->variations->first();
	      		$is_out_of_stock = $product->enable_stock && (empty($product->stock) || $product->stock < 0);
	      	?>
	      	<?php if(in_array($product->type, ['single', 'combo']) && !empty($default_variation)): ?>
				<button type="button"
					class="btn btn-sm catalogue-add-btn add-to-cart-btn text-white"
					style="background:linear-gradient(135deg,#16a34a,#15803d); border:none; border-radius:8px; font-weight:600; padding:.45rem 1.25rem;"
					data-variation-id="<?php echo e($default_variation->id, false); ?>"
					data-product-id="<?php echo e($product->id, false); ?>"
					data-product-name="<?php echo e($product->name, false); ?>"
					data-price="<?php echo e($default_variation->sell_price_inc_tax, false); ?>"
					<?php if($is_out_of_stock): ?> disabled <?php endif; ?>>
					<i class="fas fa-cart-plus me-1"></i> Add to Cart
				</button>
			<?php endif; ?>
	      	<button type="button" class="btn btn-outline-secondary btn-sm no-print" data-bs-dismiss="modal" style="border-radius:8px;">
	      		<?php echo app('translator')->get('messages.close'); ?>
	      	</button>
	    </div>
	</div>
</div>
