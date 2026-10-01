<table class="table table-striped table-th-skin">
	<thead>
		<tr>
			<th><?php echo app('translator')->get('crm::lang.document'); ?></th>
			<th><?php echo app('translator')->get('messages.action'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php $__currentLoopData = $medias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr class="media_row">
				<td>
					<?php if(isFileImage($media->display_url)): ?>
						<?php echo $media->thumbnail(); ?>

						<br>
					<?php endif; ?>
					<a href="<?php echo e($media->display_url, false); ?>" class="cursor-pointer"target="_blank">
						<?php echo e($media->display_name, false); ?>	
					</a>
				</td>
				<td>
					<a href="<?php echo e($media->display_url, false); ?>" download="<?php echo e($media->display_name, false); ?>" class="btn btn-success btn-sm">
						<i class="fas fa-download"></i>
					</a>
					<a data-href="<?php echo e(action([\Modules\Crm\Http\Controllers\ProposalTemplateController::class, 'deleteProposalMedia'], ['id' => $media->id]), false); ?>" class="btn btn-danger btn-sm delete_attachment">
						<i class="fas fa-trash-alt"></i>
					</a>
				</td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tbody>
</table>
