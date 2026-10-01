<?php if(count($knowledge_base->children) > 0): ?>

<div class="box-group" 
	id="accordian">
	<?php $__currentLoopData = $knowledge_base->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="panel box box-primary" style="margin-bottom: 0;">
			<div class="box-header with-border">
				<h4 class="box-title">
					<a data-bs-toggle="collapse" data-bs-parent="#accordian" href="#collapse_<?php echo e($section->id, false); ?>" <?php if($loop->index == 0 ): ?>aria-expanded="true" <?php endif; ?>><?php echo e($section->title, false); ?>

					</a>
				</h4>
				<div class="box-tools float-end">
					<a class="text-info p-5-5" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\KnowledgeBaseController::class, 'show'], [$section->id]), false); ?>" title="<?php echo app('translator')->get('messages.view'); ?>" data-bs-toggle="tooltip"><i class="fas fa-eye"></i></a>
				</div>
			</div>
			<div id="collapse_<?php echo e($section->id, false); ?>" class="panel-collapse collapse <?php if($section_id == $section->id ): ?>in <?php endif; ?>" <?php if($loop->index == 0 ): ?>aria-expanded="true" <?php endif; ?> >
                <div class="box-body" style="padding: 10px 10px;">
            		<?php if(count($section->children) > 0): ?>
            			<ul class="list-group">
            			<?php $__currentLoopData = $section->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            				<li class="list-group-item <?php if($article_id == $article->id): ?> bg-info <?php endif; ?>"><a class="text-primary" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\KnowledgeBaseController::class, 'show'], [$article->id]), false); ?>"><?php echo e($article->title, false); ?>

            				</a>
            				</li>
            			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            			</ul>
            		<?php endif; ?>
                </div>
            </div>
		</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php endif; ?>
