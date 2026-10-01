

<?php $__env->startSection('title', __('essentials::lang.knowledge_base')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('essentials::layouts.nav_essentials', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header">
	<h1><?php echo app('translator')->get('essentials::lang.knowledge_base'); ?>
	</h1>
</section>
	<section class="content">
		<?php $__env->startComponent('components.widget', ['title' => __('essentials::lang.knowledge_base')]); ?>
			<?php $__env->slot('tool'); ?>
				<div class="box-tools float-end">
					<a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\KnowledgeBaseController::class, 'create']), false); ?>" class="btn btn-sm btn-primary">
						<i class="fa fa-plus"></i> 
						<?php echo app('translator')->get( 'messages.add' ); ?>
					</a>
				</div>
			<?php $__env->endSlot(); ?>
				<div class="row">
				<?php $__currentLoopData = $knowledge_bases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="col-md-4">
						<div class="box box-primary" style="max-height: 500px; overflow-y: auto;">
							<div class="box-header">
								<h4 class="box-title"><?php echo e($kb->title, false); ?></h4>
								<div class="box-tools float-end">
									<a class="text-info p-5-5" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\KnowledgeBaseController::class, 'show'], [$kb->id]), false); ?>" title="<?php echo app('translator')->get('messages.view'); ?>" data-bs-toggle="tooltip"><i class="fas fa-eye"></i></a>

									<a class="text-primary p-5-5" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\KnowledgeBaseController::class, 'edit'], [$kb->id]), false); ?>" title="<?php echo app('translator')->get('messages.edit'); ?>" data-bs-toggle="tooltip"><i class="fas fa-edit"></i></a>

									<a class="text-danger p-5-5 delete-kb" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\KnowledgeBaseController::class, 'destroy'], [$kb->id]), false); ?>" title="<?php echo app('translator')->get('messages.delete'); ?>" data-bs-toggle="tooltip"><i class="fas fa-trash"></i></a>

									<a class="text-primary p-5-5" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\KnowledgeBaseController::class, 'create']), false); ?>?parent=<?php echo e($kb->id, false); ?>" title="<?php echo app('translator')->get('essentials::lang.add_section'); ?>" data-bs-toggle="tooltip"><i class="fas fa-plus"></i></a>
								</div>
							</div>
							<div class="box-body">
								<?php echo $kb->content; ?>

								<?php if(count($kb->children) > 0): ?>
									<div class="box-group" 
										id="accordian_<?php echo e($kb->id, false); ?>">
										<?php $__currentLoopData = $kb->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<div class="panel box box-primary">
												<div class="box-header with-border" style="padding: 10px 12px;">
													<h4 class="box-title">
														<a data-bs-toggle="collapse" data-bs-parent="#accordian_<?php echo e($kb->id, false); ?>" href="#collapse_<?php echo e($section->id, false); ?>" <?php if($loop->index == 0 ): ?>aria-expanded="true" <?php endif; ?>><?php echo e($section->title, false); ?>

														</a>
													</h4>
													<div class="box-tools float-end">
														<a class="text-info p-5-5" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\KnowledgeBaseController::class, 'show'], [$section->id]), false); ?>" title="<?php echo app('translator')->get('messages.view'); ?>" data-bs-toggle="tooltip"><i class="fas fa-eye"></i></a>

														<a class="text-primary p-5-5" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\KnowledgeBaseController::class, 'edit'], [$section->id]), false); ?>" title="<?php echo app('translator')->get('messages.edit'); ?>" data-bs-toggle="tooltip"><i class="fas fa-edit"></i></a>

														<a class="text-danger p-5-5 delete-kb" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\KnowledgeBaseController::class, 'destroy'], [$section->id]), false); ?>" title="<?php echo app('translator')->get('messages.delete'); ?>" data-bs-toggle="tooltip"><i class="fas fa-trash"></i></a>

														<a class="text-success p-5-5" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\KnowledgeBaseController::class, 'create']), false); ?>?parent=<?php echo e($section->id, false); ?>" title="<?php echo app('translator')->get('essentials::lang.add_article'); ?>" data-bs-toggle="tooltip"><i class="fas fa-plus"></i></a>
													</div>
												</div>
												<div id="collapse_<?php echo e($section->id, false); ?>" class="panel-collapse collapse <?php if($loop->index == 0 ): ?>in <?php endif; ?>" <?php if($loop->index == 0 ): ?>aria-expanded="true" <?php endif; ?> >
								                    <div class="box-body" style="padding: 10px 12px;">
								                		<?php echo $section->content; ?>

								                		<?php if(count($section->children) > 0): ?>
								                			<ul class="todo-list">
								                			<?php $__currentLoopData = $section->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								                				<li><a class="text-primary" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\KnowledgeBaseController::class, 'show'], [$article->id]), false); ?>"><?php echo e($article->title, false); ?>

								                				</a>
								                				<div class="tools">
								                				<a class="text-primary p-5-5" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\KnowledgeBaseController::class, 'edit'], [$article->id]), false); ?>" title="<?php echo app('translator')->get('messages.edit'); ?>" data-bs-toggle="tooltip"><i class="fas fa-edit"></i></a>

																<a class="text-danger p-5-5 delete-kb" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\KnowledgeBaseController::class, 'destroy'], [$article->id]), false); ?>" title="<?php echo app('translator')->get('messages.delete'); ?>" data-bs-toggle="tooltip"><i class="fas fa-trash"></i></a>
																</div>
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
							</div>
						</div>
					</div>
					<?php if($loop->iteration%3 == 0): ?>
						<div class="clearfix"></div>
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
		<?php echo $__env->renderComponent(); ?>
	</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	$(document).ready( function(){
		$('.delete-kb').click(function(e){
			e.preventDefault();
			swal({
	            title: LANG.sure,
	            icon: 'warning',
	            buttons: true,
	            dangerMode: true,
	        }).then(willDelete => {
	            if (willDelete) {
	                var href = $(this).attr('href');
	                var data = $(this).serialize();

	                $.ajax({
	                    method: 'DELETE',
	                    url: href,
	                    dataType: 'json',
	                    data: data,
	                    success: function(result) {
	                        if (result.success == true) {
	                            toastr.success(result.msg);
	                        } else {
	                            toastr.error(result.msg);
	                        }

	                        location.reload();
	                    },
	                });
	            }
	        });
		})
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>