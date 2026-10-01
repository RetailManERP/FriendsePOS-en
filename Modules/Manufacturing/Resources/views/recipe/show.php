<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			  <h4 class="modal-title" id="modalTitle"><?php echo e($recipe->variation->full_name, false); ?></h4>
			<button type="button" class="btn-close no-print" data-bs-dismiss="modal" aria-label="Close"></button>
		    
			</div>
	    <div class="modal-body">
	    	<div class="row">
      			<div class="col-md-6">
      				<?php echo $recipe->variation->product->product_description; ?>

      			</div>
      			<div class="col-md-6">
      				<?php $__currentLoopData = $recipe->variation->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			        	<?php echo $media->thumbnail([60, 60], 'img-thumbnail'); ?>

			        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      			</div>
      		</div>
      		<div class="row">
      			<div class="col-md-12">
      				<table class="table">
						<thead>
							<tr>
								<th><?php echo app('translator')->get('manufacturing::lang.ingredient'); ?></th>
								<th><?php echo app('translator')->get('lang_v1.quantity'); ?></th>
								<th><?php echo app('translator')->get('manufacturing::lang.waste_percent'); ?></th>
								<th><?php echo app('translator')->get('lang_v1.price'); ?></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$ingredient_groups = [];
								$ingredient_total_price = 0;
								$ingredient_quantity = 0;
							?>
							<?php $__currentLoopData = $ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php
									$ingredient_obj = (object) $ingredient;
									$ingredient_price = $ingredient['quantity']*$ingredient['dpp_inc_tax']*$ingredient['multiplier'];
									$ingredient_total_price += $ingredient_price;
									$quantity = $ingredient_obj->quantity;
									$ingredient_quantity += $quantity;
								?>
								<?php if(empty($ingredient['mfg_ingredient_group_id'])): ?>
									<tr>
										<td>
											<?php echo e($ingredient['full_name'], false); ?>

										</td>
										<td><span class="display_currency" data-currency_symbol="false" data-is_quantity="true"><?php echo e($ingredient['quantity'], false); ?></span> <?php echo e($ingredient['unit'], false); ?></td>
										<td><span class="display_currency" data-currency_symbol="false"><?php echo e($ingredient['waste_percent'], false); ?></span>%</td>
										<td><span class="display_currency" data-currency_symbol="true"><?php echo e($ingredient_price, false); ?></span></td>
									</tr>
								<?php else: ?>
									<?php
										$ingredient_groups[$ingredient['mfg_ingredient_group_id']][] = $ingredient;
									?>
								<?php endif; ?>	
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php $__currentLoopData = $ingredient_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td colspan="4" class="bg-gray"><strong><?php echo e($ingredient_group[0]['ingredient_group_name'] ?? '', false); ?></strong> <?php if(!empty($ingredient_group[0]['ig_description'])): ?>
									- <?php echo e($ingredient_group[0]['ig_description'], false); ?>

								<?php endif; ?></td>
								</tr>
								
								<?php $__currentLoopData = $ingredient_group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td>
											<?php echo e($ingredient['full_name'], false); ?>

										</td>
										<td><span class="display_currency" data-currency_symbol="false" data-is_quantity="true"><?php echo e($ingredient['quantity'], false); ?></span> <?php echo e($ingredient['unit'], false); ?></td>
										<td><span class="display_currency" data-currency_symbol="false"><?php echo e($ingredient['waste_percent'], false); ?></span>%</td>
										<td><span class="display_currency" data-currency_symbol="true"><?php echo e($ingredient['quantity']*$ingredient['dpp_inc_tax']*$ingredient['multiplier'], false); ?></span></td>
									</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="3" class="text-right"><strong><?php echo app('translator')->get('manufacturing::lang.ingredients_quantity'); ?></strong></td>
								<td><span class="display_currency" data-currency_symbol="false"><?php echo e($ingredient_quantity, false); ?></span></td>
							</tr>
							<tr>
								<td colspan="3" class="text-right"><strong><?php echo app('translator')->get('manufacturing::lang.ingredients_cost'); ?></strong></td>
								<td><span class="display_currency" data-currency_symbol="true"><?php echo e($ingredient_total_price, false); ?></span></td>
							</tr>
						</tfoot>
					</table>
      			</div>
      		</div>
      		<div class="row">
      			<div class="col-md-6">
      				<strong><?php echo app('translator')->get('manufacturing::lang.wastage'); ?>:</strong>
      				<?php echo e($recipe->waste_percent ?? 0, false); ?> % <br>
      				<strong><?php echo app('translator')->get('manufacturing::lang.total_output_quantity'); ?>:</strong>
      				<?php if(!empty($recipe->total_quantity)): ?><?php echo e(number_format($recipe->total_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?><?php else: ?> 0 <?php endif; ?> <?php if(!empty($recipe->sub_unit)): ?> <?php echo e($recipe->sub_unit->short_name, false); ?> <?php else: ?> <?php echo e($recipe->variation->product->unit->short_name, false); ?> <?php endif; ?>
      			</div>
      			<div class="col-md-6">
      				<strong><?php echo app('translator')->get('manufacturing::lang.extra_cost'); ?>:</strong>
      				<span ></span><?php echo e(number_format($recipe->extra_cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php if($recipe->production_cost_type == 'percentage'): ?> % <?php elseif($recipe->production_cost_type == 'per_unit'): ?> (<?php echo app('translator')->get('manufacturing::lang.per_unit'); ?>) <?php endif; ?> <br>
      				<strong><?php echo app('translator')->get('sale.total'); ?>:</strong>
      				<span class="display_currency" data-currency_symbol="true"><?php echo e($recipe->final_price, false); ?></span>
      			</div>
      		</div>
      		<div class="row">
      			<div class="col-md-12">
      				<strong><?php echo app('translator')->get('lang_v1.instructions'); ?>:</strong><br>
      				<?php echo $recipe->instructions; ?>

      			</div>
      		</div>
      	</div>
      	<div class="modal-footer">
      		<button type="button" class="btn btn-primary no-print" aria-label="Print" 
			      onclick="$(this).closest('div.modal-content').printThis();"><i class="fa fa-print"></i> <?php echo app('translator')->get( 'messages.print' ); ?>
			</button>
	      	<button type="button" class="btn btn-default no-print" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
	    </div>
	</div>
</div>
