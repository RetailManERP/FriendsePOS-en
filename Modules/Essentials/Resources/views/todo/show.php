<?php if(count($todo) > 0): ?>
	<?php $__currentLoopData = $todo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $do): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<li class="todo_li">
		<?php if($do->is_completed == 1): ?>
		<input type="checkbox" name="todo_id" class="todo_id" value ="<?php echo e($do->id, false); ?>" checked>

		<a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\ToDoController::class, 'show'], $do->id), false); ?>"><span class="text task_name" style="text-decoration:line-through;">
			<?php echo e($do->task, false); ?>

		</span></a>
		<i class="fa fa-trash text-danger float-end delete_task cursor-pointer" style="display:none;">
			<span class="hidden"><?php echo e($do->id, false); ?></span>
		</i>
		<?php else: ?>
		<input type="checkbox" name="todo_id" class="todo_id" value ="<?php echo e($do->id, false); ?>">

		<a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\ToDoController::class, 'show'], $do->id), false); ?>"><span class="text task_name"> <?php echo e($do->task, false); ?></span></a>
		<?php endif; ?>
		<br>
		<small class="text-muted"><strong><?php echo app('translator')->get('essentials::lang.assigned_to'); ?>: </strong> <?php echo e($do->user->user_full_name, false); ?></small>
		<div class="tools">
			<i class="fa fa-trash text-danger float-end delete_task cursor-pointer action_btn">
				<span class="hidden"><?php echo e($do->id, false); ?></span>
			</i>
			<i class="fa fa-edit text-primary float-end btn-modal cursor-pointer action_btn"  data-container="#task_modal" data-href="<?php echo e(action([\Modules\Essentials\Http\Controllers\ToDoController::class, 'edit'], $do->id), false); ?>"></i>
		</div>
	</li>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
	<h2 class="text-center text-info">
		<?php echo e(__('essentials::lang.no_task'), false); ?>

	</h2>
<?php endif; ?>
