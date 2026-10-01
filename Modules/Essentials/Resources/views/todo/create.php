<div class="modal-dialog modal-xl modal-dialog-scrollable todo-modal-dialog" role="document">
    <?php echo Form::open(['url' => action([\Modules\Essentials\Http\Controllers\ToDoController::class, 'store']), 'id' => 'task_form', 'method' => 'post', 'class' => 'modal-content todo-modal-content']); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'essentials::lang.add_to_do' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body todo-modal-body">
    	<div class="row">
    		<div class="col-md-12">
		        <div class="form-group">
		            <?php echo Form::label('task', __('essentials::lang.task') . ":*"); ?>

		            <?php echo Form::text('task', null, ['class' => 'form-control', 'required']); ?>

		         </div>
		    </div>
		    <?php if(!empty($users)): ?>
		    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('essentials.assign_todos')): ?>
			<div class="col-md-12">
		        <div class="form-group">
					<?php echo Form::label('users', __('essentials::lang.assigned_to') . ':*'); ?>

					<div class="input-group">
						<span class="input-group-text">
							<i class="fa fa-user"></i>
						</span>
						<?php echo Form::select('users[]', $users, null, ['class' => 'form-control select2', 'multiple', 'required', 'style' => 'width: 100%;']); ?>

					</div>
				</div>
			</div>
			<?php endif; ?>
			<?php endif; ?>
			<div class="clearfix"></div>
			<div class="col-md-6">
		        <div class="form-group">
					<?php echo Form::label('priority', __('essentials::lang.priority') . ':'); ?>

					<?php echo Form::select('priority', $priorities, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;']); ?>

				</div>
			</div>
			<div class="col-md-6">
		        <div class="form-group">
					<?php echo Form::label('status', __('sale.status') . ':'); ?>

					<?php echo Form::select('status', $task_statuses, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;']); ?>

				</div>
			</div>
			<div class="clearfix"></div>
		    <div class="col-md-6">
		        <div class="form-group">
					<?php echo Form::label('date', __('business.start_date') . ':*'); ?>

					<div class="input-group">
						<span class="input-group-text">
							<i class="fa fa-calendar"></i>
						</span>
						<?php echo Form::text('date', \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control datepicker text-center', 'required', 'readonly']); ?>

					</div>
				</div>
			</div>
			<div class="col-md-6">
		        <div class="form-group">
					<?php echo Form::label('end_date', __('essentials::lang.end_date') . ':'); ?>

					<div class="input-group">
						<span class="input-group-text">
							<i class="fa fa-calendar"></i>
						</span>
						<?php echo Form::text('end_date', '', ['class' => 'form-control datepicker text-center', 'readonly']); ?>

					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="col-md-6">
		        <div class="form-group">
					<?php echo Form::label('estimated_hours', __('essentials::lang.estimated_hours') . ':'); ?>

					<div class="input-group">
						<span class="input-group-text">
							<i class="fas fa-clock"></i>
						</span>
						<?php echo Form::text('estimated_hours', null, ['class' => 'form-control']); ?>

					</div>
				</div>
			</div>
		    <div class="clearfix"></div>
	    	<div class="col-md-12">
	    		<div class="form-group">
					<?php echo Form::label('to_do_description', __('lang_v1.description') . ':'); ?>

					<?php echo Form::textarea('description', null, ['id' => 'to_do_description']); ?>

				</div>
	    	</div>
	    	<div class="col-md-12">
	        	<?php if(in_array('upload_documents', $enabled_modules)): ?>
	        	<div class="form-group">
                    <label for="media_upload">
                        <?php echo app('translator')->get('lang_v1.upload_documents'); ?>:
                    </label>
                    <div class="dropzone" id="media_upload"></div>
                    
				    <input type="hidden" id="media_upload_url" value="<?php echo e(route('attach.medias.to.model'), false); ?>">
				    <input type="hidden" id="model_id" value="">
				    <input type="hidden" id="model_type" value="Modules\Essentials\Entities\ToDo">
				    <input type="hidden" id="model_media_type" value="">
                </div>
                <?php endif; ?>
	        </div>
    	</div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary ladda-button" data-style="expand-right">
      	<span class="ladda-label"><?php echo app('translator')->get( 'messages.save' ); ?></span>
      </button>
      <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


</div><!-- /.modal-dialog -->
