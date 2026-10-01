<div class="box box-primary">
	<div class="box-body">
		<div class="row">
			<div class="col-md-12">
				<button class="btn btn-danger float-end btn-xs remove_ingredient_group"><i class="fas fa-times"></i></button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<?php echo Form::label('ingredient_group' . $ig_index, __('manufacturing::lang.ingredient_group').':'); ?>


					<?php echo Form::text('ingredient_groups[' . $ig_index . ']', !empty($ig_name) ? $ig_name : null, ['class' => 'form-control ingredient_group', 'id' => 'ingredient_group' . $ig_index, 'placeholder' => __('manufacturing::lang.ingredient_group'), 'data-ig_index' => $ig_index , 'required']); ?>

				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<?php echo Form::label('ingredient_group_description' . $ig_index, __('lang_v1.description').':'); ?>


					<?php echo Form::textarea('ingredient_group_description[' . $ig_index . ']', !empty($ig_description) ? $ig_description : null, ['class' => 'form-control', 'id' => 'ingredient_group_description' . $ig_index, 'placeholder' => __('lang_v1.description'), 'rows' => 2]); ?>

				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<?php echo Form::label('search_product_' . $ig_index, __('manufacturing::lang.select_ingredient').':'); ?>


					<?php echo Form::text('search_product', null, ['class' => 'form-control search_product', 'placeholder' => __('manufacturing::lang.select_ingredient'), 'id' => 'search_product_' . $ig_index]); ?>

				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped table-th-green text-center ingredients_table">
					<thead>
						<tr>
							<th><?php echo app('translator')->get('manufacturing::lang.ingredient'); ?></th>
							<th><?php echo app('translator')->get('manufacturing::lang.waste_percent'); ?></th>
							<th><?php echo app('translator')->get('manufacturing::lang.final_quantity'); ?></th>
							<th><?php echo app('translator')->get('lang_v1.price'); ?></th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody class="ingredient-row-sortable">
						<?php if(!empty($ingredients)): ?>
							<?php $__currentLoopData = $ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php echo $__env->make('manufacturing::recipe.ingredient_row', ['ingredient' => (object) $ingredient, 'ig_index' => $ig_index], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
								
								<?php
									$row_index++;
								?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div> <!--box end-->
