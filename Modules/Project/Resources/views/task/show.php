<div class="modal-dialog modal-lg project-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h3 class="modal-title tw-flex tw-items-center tw-gap-2">
                <i class="fa fa-tasks tw-text-blue-600"></i>
                <?php echo e($project_task->subject, false); ?>

                <code class="tw-text-xs tw-font-normal">(<?php echo e($project_task->task_id, false); ?>)</code>
                <?php if(!empty($can_edit_task)): ?>
                    <button data-href="<?php echo e(action([\Modules\Project\Http\Controllers\TaskController::class, 'edit'], [$project_task->id, 'project_id' => $project_task->project_id]), false); ?>" class="cursor-pointer edit_a_task_from_view_task mr-16 tw-dw-btn tw-dw-btn-primary tw-text-white tw-dw-btn-sm pull-right">
                        <i class="fa fa-edit"></i>
                        <?php echo e(__("messages.edit"), false); ?>

                    </button>
                <?php endif; ?>
            </h3>
            <div class="tw-flex tw-flex-wrap tw-gap-2 tw-mt-2">
                <span class="tw-inline-flex tw-items-center tw-gap-1 tw-px-2.5 tw-py-1 tw-rounded-full tw-text-xs tw-font-semibold tw-bg-blue-100 tw-text-blue-700" data-toggle="tooltip" title="<?php echo app('translator')->get('project::lang.project'); ?>">
                    <i class="fa fa-folder-open tw-text-[10px]"></i>
                    <?php echo e($project_task->project->name, false); ?>

                </span>
                <?php if(isset($project_task->due_date)): ?>
                    <?php
                        $isOverdue = \Carbon\Carbon::parse($project_task->due_date)->lt(\Carbon\Carbon::today()) && $project_task->status != 'completed';
                    ?>
                    <span class="tw-inline-flex tw-items-center tw-gap-1 tw-px-2.5 tw-py-1 tw-rounded-full tw-text-xs tw-font-semibold <?php echo e($isOverdue ? 'tw-bg-red-100 tw-text-red-700' : 'tw-bg-gray-100 tw-text-gray-600', false); ?>" data-toggle="tooltip" title="<?php echo app('translator')->get('project::lang.due_date'); ?>">
                        <i class="fa fa-calendar-times-o tw-text-[10px]"></i>
                        <?php echo e(\Carbon::createFromTimestamp(strtotime($project_task->due_date))->format(session('business.date_format')), false); ?>

                        <?php if($isOverdue): ?> <i class="fa fa-exclamation-circle"></i> <?php endif; ?>
                    </span>
                <?php endif; ?>
                <span class="priority-badge priority-<?php echo e($project_task->priority, false); ?>" data-toggle="tooltip" title="<?php echo app('translator')->get('project::lang.priority'); ?>">
                    <?php echo e(__('project::lang.'.$project_task->priority), false); ?>

                </span>
                <span class="status-badge status-<?php echo e($project_task->status, false); ?>" data-toggle="tooltip" title="<?php echo app('translator')->get('sale.status'); ?>">
                    <span class="status-dot"></span>
                    <?php echo e(__('project::lang.'.$project_task->status), false); ?>

                </span>
            </div>
            <div class="tw-mt-2">
                <?php if ($__env->exists('project::avatar.create', ['max_count' => '10', 'members' => $project_task->members])) echo $__env->make('project::avatar.create', ['max_count' => '10', 'members' => $project_task->members], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <h5>
                        <i class="fa fa-bars"></i>&nbsp;
                        <b><?php echo e(__('lang_v1.description'), false); ?></b>
                        <?php if(!empty($can_edit_task)): ?>
                            <i class="fa fa-edit cursor-pointer edit_task_description toggle_description_fields" data-toggle="tooltip" title="<?php echo app('translator')->get('messages.edit'); ?>"></i>
                        <?php endif; ?>
                    </h5>
                    <div class="form_n_description">
                        <?php if ($__env->exists('project::task.partials.edit_description')) echo $__env->make('project::task.partials.edit_description', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
            <hr>
            <!-- time log for task -->
            <?php if(!empty($can_view_timelog)): ?>
                <?php if ($__env->exists('project::task.partials.time_log')) echo $__env->make('project::task.partials.time_log', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?> <!-- /time log for task -->
            <!-- form open -->
            <?php if(!empty($can_create_task_comment)): ?>
                <?php echo Form::open(['url' => action([\Modules\Project\Http\Controllers\TaskCommentController::class, 'store']), 'id' => 'add_comment_form', 'method' => 'post']); ?>

                <div class="row">
                    <div class="col-md-12">
                        <h5>
                            <i class="fas fa-comments"></i>
                            <b><?php echo e(__('project::lang.add_comment'), false); ?></b>
                        </h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('comment', __('project::lang.comment') . ':*'); ?>

                            <?php echo Form::textarea('comment', null, ['class' => 'form-control ', 'rows' => '3', 'required']); ?>

                        </div>
                        <input type="hidden" name="project_task_id" value="<?php echo e($project_task->id, false); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group toggleMedia">
                            <label for="fileupload">
                                <?php echo app('translator')->get('project::lang.file_upload'); ?>:
                            </label>
                            <div class="dropzone" id="fileupload"></div>
                        </div>
                        <input type="hidden" id="comment_media" name="file_name[]" value="">
                    </div>
                </div>
                <button type="button" class="tw-dw-btn tw-dw-btn-info tw-text-white tw-dw-btn-sm upload_doc">
                    <?php echo app('translator')->get('project::lang.upload_doc'); ?>
                </button>
                <button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-text-white tw-dw-btn-sm ladda-button comment_btn" data-style="expand-right">
                   <span class="ladda-label"><?php echo app('translator')->get('project::lang.save_comment'); ?></span>
                </button>
                <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white tw-dw-btn-sm hide_upload_btn toggleMedia">
                    <?php echo app('translator')->get('messages.close'); ?>
                </button>
                <?php echo Form::close(); ?>

            <?php endif; ?>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <h5>
                        <i class="fas fa-comment-dots"></i>
                        <b><?php echo e(__('project::lang.activity'), false); ?></b>
                    </h5>
                    <div class="direct-chat-messages" style="max-height: 500px;height: auto;">
                        <?php if ($__env->exists('project::task.partials.comment', ['comments' => $project_task->comments])) echo $__env->make('project::task.partials.comment', ['comments' => $project_task->comments], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer tw-border-t tw-border-gray-200">
            <span class="pull-left tw-text-gray-500 tw-text-sm">
                <i class="fas fa-pencil-alt tw-mr-1"></i>
                <?php echo app('translator')->get('project::lang.added_this_task_on', [
                    'name' => $project_task->createdBy->user_full_name
                ]); ?>
                <?php echo e(\Carbon::createFromTimestamp(strtotime($project_task->created_at))->format(session('business.date_format')), false); ?>

            </span>
            <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white" data-dismiss="modal">
                <?php echo app('translator')->get('messages.close'); ?>
            </button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
