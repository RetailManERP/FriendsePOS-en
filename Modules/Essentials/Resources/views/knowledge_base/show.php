

<?php $__env->startSection('title', __('essentials::lang.knowledge_base')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('essentials::layouts.nav_essentials', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<section class="content">
		<div class="row">
			<div class="col-md-3">
				<?php echo $__env->make('essentials::knowledge_base.sidebar', ['knowledge_base' => $knowledge_base, 'current_id' => $kb_object->id, 'article_id' => $article_id, 'section_id' => $section_id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
			<div class="col-md-9">
				<div class="box box-primary">
					<div class="box-header">
						<h4 class="box-title"><?php echo e($kb_object->title, false); ?></h4>
						<?php if(!empty($kb_object->share_with)): ?>
						<br>
							<small><b><?php echo app('translator')->get('essentials::lang.share_with'); ?>:</b> <?php echo app('translator')->get('essentials::lang.' . $kb_object->share_with); ?> <?php if($kb_object->share_with == 'only_with'): ?> (<?php echo e(implode(', ', $users), false); ?>) <?php endif; ?></small>
						<?php endif; ?>
					</div>
					<div class="box-body">
						<?php echo $kb_object->content; ?>

					</div>
				</div>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	$(document).ready( function(){

	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>