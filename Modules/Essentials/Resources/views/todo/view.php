

<?php $__env->startSection('title', __('essentials::lang.todo')); ?>

<?php $__env->startSection('content'); ?>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h4 class="box-title">
						<i class="ion ion-clipboard"></i>
						<small><code>(<?php echo e($todo->task_id, false); ?>)</code></small> <?php echo e($todo->task, false); ?>

					</h4>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-4">
							<strong><?php echo e(__('business.start_date'), false); ?>: </strong> <?php echo e(\Carbon::createFromTimestamp(strtotime($todo->date))->format(session('business.date_format')), false); ?><br>
							<strong><?php echo e(__('essentials::lang.end_date'), false); ?>: </strong> <?php if(!empty($todo->end_date)): ?><?php echo e(\Carbon::createFromTimestamp(strtotime($todo->end_date))->format(session('business.date_format')), false); ?><?php endif; ?><br>
							<strong><?php echo e(__('essentials::lang.estimated_hours'), false); ?>: </strong> <?php echo e($todo->estimated_hours, false); ?>

						</div>
						<div class="col-md-4">
							<strong><?php echo e(__('essentials::lang.assigned_by'), false); ?>: </strong> <?php echo e($todo->assigned_by?->user_full_name, false); ?><br>
							<strong><?php echo e(__('essentials::lang.assigned_to'), false); ?>: </strong> <?php echo e(implode(', ', $users), false); ?>

						</div>
						<div class="col-md-4">
							<strong><?php echo e(__('essentials::lang.priority'), false); ?>: </strong> <?php echo e($priorities[$todo->priority] ?? '', false); ?><br>
							<strong><?php echo e(__('sale.status'), false); ?>: </strong> <?php echo e($task_statuses[$todo->status] ?? '', false); ?>

						</div>
						<div class="clearfix"></div>
						<div class="col-md-12">
							<br/>
							<strong><?php echo e(__('lang_v1.description'), false); ?>: </strong> <?php echo $todo->description; ?>

						</div>
					</div>
				</div>
			</div>
		<div class="col-md-12">
			<div class="card">
		    <div class="card-header p-0">
		        <ul class="nav nav-tabs" role="tablist">
		            <li class="nav-item">
		                <a class="nav-link active" href="#comments_tab" data-bs-toggle="tab" role="tab" aria-expanded="true">
		                    <i class="fa fa-comment"></i>
							<?php echo app('translator')->get('essentials::lang.comments'); ?> </a>
		            </li>
		            <li class="nav-item">
		                <a class="nav-link" href="#documents_tab" data-bs-toggle="tab" role="tab">
		                    <i class="fa fa-file"></i>
						<?php echo app('translator')->get('lang_v1.documents'); ?> </a>
		            </li>
		            <li class="nav-item">
		                <a class="nav-link" href="#activities_tab" data-bs-toggle="tab" role="tab">
		                    <i class="fa fa-pen-square"></i>
						<?php echo app('translator')->get('lang_v1.activities'); ?> </a>
		            </li>
		        </ul>
		    </div>
		    <div class="card-body">
		        <div class="tab-content">
	    	    <div class="tab-pane fade show active" id="comments_tab" role="tabpanel">
			    		<div class="row">
							<?php echo Form::open(['url' => action([\Modules\Essentials\Http\Controllers\ToDoController::class, 'addComment']), 'id' => 'task_comment_form', 'method' => 'post']); ?>

							<div class="col-md-6">
								<div class="form-group">
									<?php echo Form::label('comment', __('essentials::lang.add_comment') . ':'); ?>

									<?php echo Form::textarea('comment', null, ['rows' => 3, 'class' => 'form-control', 'required']); ?>

									<?php echo Form::hidden('task_id', $todo->id); ?>

								</div>
							</div>
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary float-end ladda-button add-comment-btn" data-style="expand-right">
									<span class="ladda-label">
										<?php echo app('translator')->get('messages.add'); ?>
									</span>
								</button>
							</div>
							<?php echo Form::close(); ?>

							<div class="col-md-12">
								<hr>
								<div class="direct-chat-messages">
									<?php $__currentLoopData = $todo->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php echo $__env->make('essentials::todo.comment', 
										['comment' => $comment], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
							</div>
						</div>
			    	</div>

			    	<div class="tab-pane fade" id="documents_tab" role="tabpanel">
			    		<div class="row">
			    			<?php if(in_array('upload_documents', $enabled_modules)): ?>
							<?php echo Form::open(['url' => action([\Modules\Essentials\Http\Controllers\ToDoController::class, 'uploadDocument']), 'id' => 'task_upload_doc_form', 'method' => 'post', 'files' => true]); ?>

							<div class="col-md-12">
								<div class="form-group">
									<?php echo Form::label('documents', __('lang_v1.upload_documents') . ':'); ?>

									<?php echo Form::file('documents[]', ['id' => 'documents', 'multiple', 'required']); ?>

									<?php echo Form::hidden('task_id', $todo->id); ?>

								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<?php echo Form::label('description', __('lang_v1.description') . ':'); ?>

									<?php echo Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]); ?>

								</div>
							</div>
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary float-end"><?php echo app('translator')->get('essentials::lang.upload'); ?></button>
							</div>
							<?php echo Form::close(); ?>

							<?php endif; ?>
							<div class="col-md-12">
								<hr>
								<table class="table table-th-skin">
									<thead>
										<tr>
											<th><?php echo app('translator')->get('lang_v1.documents'); ?></th>
											<th><?php echo app('translator')->get('lang_v1.description'); ?></th>
											<th><?php echo app('translator')->get('lang_v1.uploaded_by'); ?></th>
											<th><?php echo app('translator')->get('lang_v1.download'); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php $__currentLoopData = $todo->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo e($media->display_name, false); ?></td>
												<td><?php echo e($media->description, false); ?></td>
												<td><?php echo e($media->uploaded_by_user->user_full_name ?? '', false); ?></td>
												<td><a href="<?php echo e($media->display_url, false); ?>" download class="btn btn-success btn-xs"><?php echo app('translator')->get('lang_v1.download'); ?></a>

												<?php if(in_array(auth()->user()->id, [$media->uploaded_by, $todo->created_by])): ?>
													<a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\ToDoController::class, 'deleteDocument'], $media->id), false); ?>" class="btn btn-danger btn-xs delete-document" data-media_id="<?php echo e($media->id, false); ?>"><i class="fa fa-trash"></i> <?php echo app('translator')->get('messages.delete'); ?></a>
												<?php endif; ?>
												</td>
											</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</tbody>
								</table>
							</div>
						</div>
			    	</div>
			    	<div class="tab-pane fade" id="activities_tab" role="tabpanel">
			    		<div class="row">
			    			<div class="col-md-12">
                                <?php echo $__env->make('activity_log.activities', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			    			</div>
			    		</div>
			    	</div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</section>
<div class="modal fade" id="task_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
//form submit
$(document).on('submit', 'form#task_comment_form', function(e){
	e.preventDefault();
	var url = $(this).attr("action");
	var method = $(this).attr("method");
	var data = $("form#task_comment_form").serialize();
	var ladda = Ladda.create(document.querySelector('.add-comment-btn'));
	ladda.start();
	$.ajax({
		method: method,
		url: url,
		data: data,
		dataType: "json",
		success: function(result){
			ladda.stop();
			if(result.success == true){
				toastr.success(result.msg);
				$('.direct-chat-messages').prepend(result.comment_html);
				$("form#task_comment_form").find('#comment').val('');
			} else {
				toastr.error(result.msg);
			}
		}
	});
});
$(document).on('click', '.delete-comment', function(e){
	var element = $(this);
	$.ajax({
		url: '/essentials/todo/delete-comment/' + element.data('comment_id'),
		dataType: "json",
		success: function(result){
			if(result.success == true){
				toastr.success(result.msg);
				element.closest('.direct-chat-msg').remove();
			} else {
				toastr.error(result.msg);
			}
		}
	});
});

$(document).on('click', '.delete-document', function(e){
	e.preventDefault();
	var element = $(this);
	var url = $(this).attr('href');
	$.ajax({
		url: url,
		dataType: "json",
		success: function(result){
			if(result.success == true){
				toastr.success(result.msg);
				element.closest('tr').remove();
			} else {
				toastr.error(result.msg);
			}
		}
	});
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>