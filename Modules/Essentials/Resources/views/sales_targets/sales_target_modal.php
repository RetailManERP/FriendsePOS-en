<div class="modal-dialog" role="document">
  	<div class="modal-content">
  		<?php echo Form::open(['url' => action([\Modules\Essentials\Http\Controllers\SalesTargetController::class, 'saveSalesTarget']), 'method' => 'post' ]); ?>

  		<input type="hidden" name="user_id" value="<?php echo e($user->id, false); ?>">
  		<div class="modal-header">
	      	<h4 class="modal-title">
	      		<?php echo app('translator')->get( 'essentials::lang.set_sales_target_for', ['user' => $user->user_full_name] ); ?>
	      	</h4>
	      	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	    </div>
	    <div class="modal-body">
	    	<div class="table-responsive">
<table class="table table-th-skin" id="target_table">
	    		<thead>
	    			<tr>
	    				<th>
	    					<?php echo app('translator')->get( 'essentials::lang.total_sales_amount_from'); ?>
	    				</th>
	    				<th>
	    					<?php echo app('translator')->get( 'essentials::lang.total_sales_amount_to'); ?>
	    				</th>
	    				<th>
	    					<?php echo app('translator')->get( 'essentials::lang.commission_percent'); ?>
	    				</th>
	    				<th>
	    					<button type="button" class="btn btn-primary btn-sm" id="add_target"><i class="fas fa-plus"></i></button>
	    				</th>
	    			</tr>
	    			</thead>
	    			<tbody>
	    				<?php $__currentLoopData = $sales_targets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sales_target): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	    					<tr>
			    				<td>
			    					<?php echo Form::text('edit_target[' . $sales_target->id . '][target_start]', number_format($sales_target->target_start, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input-sm input_number', 'required']); ?>

			    				</td>
			    				<td>
			    					<?php echo Form::text('edit_target[' . $sales_target->id . '][target_end]', number_format($sales_target->target_end, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input-sm input_number', 'required']); ?>

			    				</td>
			    				<td>
			    					<?php echo Form::text('edit_target[' . $sales_target->id . '][commission_percent]', number_format($sales_target->commission_percent, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input-sm input_number', 'required']); ?>

			    				</td>
			    				<td>
									<button type="button" class="btn btn-danger btn-xs remove_target"><i class="fas fa-times"></i></button>
								</td>
			    			</tr>
	    				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		    			<tr>
		    				<td>
		    					<?php echo Form::text('sales_amount_start[]', 0, ['class' => 'form-control input-sm input_number', 'required']); ?>

		    				</td>
		    				<td>
		    					<?php echo Form::text('sales_amount_end[]', 0, ['class' => 'form-control input-sm input_number', 'required']); ?>

		    				</td>
		    				<td>
		    					<?php echo Form::text('commission[]', 0, ['class' => 'form-control input-sm input_number', 'required']); ?>

		    				</td>
		    			</tr>
	    			</tbody>
	    	</table>
</div>
	    </div>
	    <div class="modal-footer">
	      	<button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.submit' ); ?></button>
	      	<button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
	    </div>
	    <?php echo Form::close(); ?>

	    <div class="table-responsive">
<table class="hidden" id="sales_target_row_hidden">
	    	<tr>
				<td>
					<?php echo Form::text('sales_amount_start[]', 0, ['class' => 'form-control input-sm input_number', 'required']); ?>

				</td>
				<td>
					<?php echo Form::text('sales_amount_end[]', 0, ['class' => 'form-control input-sm input_number', 'required']); ?>

				</td>
				<td>
					<?php echo Form::number('commission[]', 0, ['class' => 'form-control input-sm', 'min' => 0, 'max' => 100, 'required']); ?>

				</td>
				<td>
					<button type="button" class="btn btn-danger btn-xs remove_target"><i class="fas fa-times"></i></button>
				</td>
			</tr>
	    </table>
</div>
  	</div>
</div>
