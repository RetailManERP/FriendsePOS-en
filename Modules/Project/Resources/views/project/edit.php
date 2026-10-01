<div class="modal-dialog modal-lg project-modal" role="document">
    <?php echo Form::open(['url' => action([\Modules\Project\Http\Controllers\ProjectController::class, 'update'], $project->id), 'id' => 'project_form', 'method' => 'put']); ?>

    <div class="modal-content">
        <div class="modal-header tw-border-b tw-border-gray-200">
            <h4 class="modal-title tw-flex tw-items-center tw-gap-2">
                <i class="fa fa-edit tw-text-blue-600"></i>
                <?php echo app('translator')->get('project::lang.edit_project'); ?>
            </h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
            <div class="tw-mb-4">
                <h5 class="tw-text-sm tw-font-semibold tw-text-gray-500 tw-uppercase tw-tracking-wider tw-mb-3">
                    <i class="fa fa-info-circle tw-mr-1"></i> <?php echo app('translator')->get('project::lang.project_details'); ?>
                </h5>
                <div class="row">
                    <div class="col-md-12">
                       <div class="form-group">
                            <?php echo Form::label('name', __('messages.name') . ':*' ); ?>

                            <?php echo Form::text('name', $project->name, ['class' => 'form-control', 'required' ]); ?>

                       </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('description', __('lang_v1.description') . ':'); ?>

                            <?php echo Form::textarea('description', $project->description, ['class' => 'form-control ', 'id' => 'description']); ?>

                        </div>
                    </div>
                </div>
            </div>

            
            <div class="tw-mb-4">
                <h5 class="tw-text-sm tw-font-semibold tw-text-gray-500 tw-uppercase tw-tracking-wider tw-mb-3">
                    <i class="fa fa-cog tw-mr-1"></i> <?php echo app('translator')->get('project::lang.configuration'); ?>
                </h5>
                <div class="row">
                    <div class="col-md-3">
                       <div class="form-group">
                            <?php echo Form::label('contact_id', __('role.customer') . ':' ); ?>

                            <?php echo Form::select('contact_id', $customers, $project->contact_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;']); ?>

                       </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('location_id', __('business.business_location') . ':*'); ?>

                            <?php echo Form::select('location_id', $business_locations, $project->location_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('status', __('sale.status') .':*'); ?>

                            <?php echo Form::select('status', $statuses, $project->status, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('lead_id', __('project::lang.lead') .':*'); ?>

                            <?php echo Form::select('lead_id', $users, $project->lead_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

                        </div>
                    </div>
                </div>
            </div>

            
            <div class="tw-mb-4">
                <h5 class="tw-text-sm tw-font-semibold tw-text-gray-500 tw-uppercase tw-tracking-wider tw-mb-3">
                    <i class="fa fa-calendar tw-mr-1"></i> <?php echo app('translator')->get('project::lang.schedule'); ?>
                </h5>
                <div class="row">
                    <div class="col-md-6">
                       <div class="form-group">
                            <?php echo Form::label('start_date', __('business.start_date') . ':' ); ?>

                            <?php echo Form::text('start_date', !empty($project->start_date) ? \Carbon::createFromTimestamp(strtotime($project->start_date))->format(session('business.date_format')) : '', ['class' => 'form-control datepicker', 'readonly']); ?>

                       </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('end_date', __('project::lang.end_date') .':'); ?>

                            <?php echo Form::text('end_date', !empty($project->end_date) ? \Carbon::createFromTimestamp(strtotime($project->end_date))->format(session('business.date_format')) : '', ['class' => 'form-control datepicker', 'readonly']); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('budget', __('project::lang.budget') . ':'); ?>

                            <?php
                                $budget_value = ! is_null($project->budget)
                                    ? rtrim(rtrim(number_format((float) $project->budget, 2, '.', ''), '0'), '.')
                                    : null;
                            ?>
                            <div class="project-money-field">
                                <span class="project-money-icon"><i class="fa fa-money"></i></span>
                                <?php echo Form::text('budget', $budget_value, ['class' => 'form-control input_number project-money-input', 'placeholder' => __('project::lang.budget'), 'inputmode' => 'decimal']); ?>

                            </div>
                            <small class="text-muted"><?php echo app('translator')->get('project::lang.budget_optional_hint'); ?></small>
                        </div>
                    </div>
                </div>

                
                <div class="row">
                    <div class="col-md-12">
                        <div class="tw-mt-2 tw-mb-3">
                            <h5 class="tw-text-sm tw-font-semibold tw-text-gray-500 tw-uppercase tw-tracking-wider tw-mb-2">
                                <i class="fa fa-history tw-mr-1"></i> <?php echo app('translator')->get('project::lang.budget_change_log'); ?>
                            </h5>
                            <?php if($budget_logs->isEmpty()): ?>
                                <div class="text-muted tw-text-sm tw-italic"><?php echo app('translator')->get('project::lang.no_budget_changes_yet'); ?></div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-striped tw-mb-0">
                                        <thead>
                                            <tr>
                                                <th><?php echo app('translator')->get('project::lang.changed_on'); ?></th>
                                                <th><?php echo app('translator')->get('project::lang.change_type'); ?></th>
                                                <th class="text-right"><?php echo app('translator')->get('project::lang.previous_budget'); ?></th>
                                                <th class="text-right"><?php echo app('translator')->get('project::lang.updated_budget'); ?></th>
                                                <th><?php echo app('translator')->get('project::lang.budget_change_note'); ?></th>
                                                <th><?php echo app('translator')->get('project::lang.changed_by'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $budget_logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e(\Carbon\Carbon::parse($log->created_at)->format('Y-m-d H:i'), false); ?></td>
                                                    <td>
                                                        <?php if($log->change_type === 'additional'): ?>
                                                            <span class="label label-success">+ <?php echo app('translator')->get('project::lang.additional'); ?></span>
                                                            <small class="text-muted">(<span class="display_currency" data-currency_symbol="true"><?php echo e($log->change_amount, false); ?></span>)</small>
                                                        <?php else: ?>
                                                            <span class="label label-info"><?php echo app('translator')->get('project::lang.modify'); ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-right"><span class="display_currency" data-currency_symbol="true"><?php echo e($log->old_budget, false); ?></span></td>
                                                    <td class="text-right"><span class="display_currency" data-currency_symbol="true"><?php echo e($log->new_budget, false); ?></span></td>
                                                    <td><?php echo e($log->note, false); ?></td>
                                                    <td><?php echo e(optional($log->changedBy)->user_full_name ?? optional($log->changedBy)->username ?? '-', false); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                
            </div>

            <?php echo $__env->make('project::project.partials.steps_form', ['project' => $project, 'statuses' => $statuses], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            
            <div class="tw-mb-4">
                <h5 class="tw-text-sm tw-font-semibold tw-text-gray-500 tw-uppercase tw-tracking-wider tw-mb-3">
                    <i class="fa fa-users tw-mr-1"></i> <?php echo app('translator')->get('project::lang.team_members'); ?> & <?php echo app('translator')->get('project::lang.category'); ?>
                </h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('user_id', __('project::lang.members') .':*'); ?>

                           <?php echo Form::select('user_id[]', $users, $project->members->pluck('id'), ['class' => 'form-control select2', 'multiple', 'required', 'style' => 'width: 100%;']); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('category_id', __('project::lang.category') .':'); ?>

                           <?php echo Form::select('category_id[]', $categories, $project->categories->pluck('id'), ['class' => 'form-control select2', 'multiple', 'style' => 'width: 100%;']); ?>

                        </div>
                    </div>
                </div>
            </div>

            <?php
                $fields = json_decode($busines->prj_setting) ?? [];
                $fields = $fields->custom_fields ?? [];
            ?>
            <?php if(collect((array)$fields)->filter()->isNotEmpty()): ?>
            <div class="tw-mb-4">
                <h5 class="tw-text-sm tw-font-semibold tw-text-gray-500 tw-uppercase tw-tracking-wider tw-mb-3">
                    <i class="fa fa-list-alt tw-mr-1"></i> <?php echo app('translator')->get('project::lang.custom_field'); ?>
                </h5>
                <div class="row">
                    <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!empty($field )): ?>
                        <div class="col-md-3">
                            <div class="form-group">
                            <?php echo Form::label($key, $field); ?>

                            <?php echo Form::text($key, $project->$key , ['class' => 'form-control']); ?>

                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
       
        <div class="modal-footer tw-border-t tw-border-gray-200">
            <button type="submit" class="tw-dw-btn tw-dw-btn-primary tw-text-white ladda-button" data-style="expand-right">
                <span class="ladda-label"><i class="fa fa-save tw-mr-1"></i> <?php echo app('translator')->get('messages.update'); ?></span>
            </button>
             <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white" data-dismiss="modal" data-bs-dismiss="modal">
                <?php echo app('translator')->get('messages.close'); ?>
            </button>
        </div>
    </div><!-- /.modal-content -->
    <?php echo Form::close(); ?>

</div><!-- /.modal-dialog -->


<div class="modal fade" id="budget_change_modal" tabindex="-1" role="dialog" aria-labelledby="budgetChangeModalLabel">
    <div class="modal-dialog project-modal" role="document">
        <div class="modal-content">
            <?php echo Form::open([
                'url' => action([\Modules\Project\Http\Controllers\ProjectController::class, 'postBudgetChange'], ['id' => $project->id]),
                'method' => 'post',
                'id' => 'budget_change_form',
            ]); ?>

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="budgetChangeModalLabel">
                    <i class="fa fa-money"></i> <?php echo app('translator')->get('project::lang.change_budget'); ?>
                </h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label><?php echo app('translator')->get('project::lang.change_type'); ?>:</label><br>
                    <label class="radio-inline">
                        <input type="radio" name="change_type" value="modify" checked> <?php echo app('translator')->get('project::lang.modify_budget'); ?>
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="change_type" value="additional"> <?php echo app('translator')->get('project::lang.add_additional_budget'); ?>
                    </label>
                </div>
                <div class="form-group">
                    <?php echo Form::label('amount', __('project::lang.new_budget_amount') . ':*', ['id' => 'budget_amount_label']); ?>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                        <?php echo Form::number('amount', $project->budget, ['class' => 'form-control input_number', 'step' => '0.01', 'min' => '0', 'required', 'id' => 'budget_change_amount']); ?>

                    </div>
                </div>
                <div class="form-group">
                    <?php echo Form::label('note', __('project::lang.budget_change_note') . ':*'); ?>

                    <?php echo Form::textarea('note', null, ['class' => 'form-control', 'rows' => 3, 'required', 'maxlength' => 1000]); ?>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.cancel'); ?></button>
                <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.save'); ?></button>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
</div>

<script>
	(function () {
		// Toggle label/input when switching between modify and additional.
		var currentBudget = <?php echo e((float) ($project->budget ?? 0), false); ?>;
		var labelModify    = "<?php echo addslashes(__('project::lang.new_budget_amount')); ?>" + ':*';
		var labelAdditional = "<?php echo addslashes(__('project::lang.additional_amount')); ?>" + ':*';

		function syncBudgetForm() {
			var type = $('#budget_change_form input[name=change_type]:checked').val();
			if (type === 'additional') {
				$('#budget_amount_label').html(labelAdditional);
				$('#budget_change_amount').val('');
			} else {
				$('#budget_amount_label').html(labelModify);
				$('#budget_change_amount').val(currentBudget);
			}
		}
		$(document).off('change.budgetChangeType').on('change.budgetChangeType', '#budget_change_form input[name=change_type]', syncBudgetForm);

		// Submit via AJAX so the parent page can refresh cleanly.
		$(document).off('submit.budgetChangeForm').on('submit.budgetChangeForm', '#budget_change_form', function (e) {
			e.preventDefault();
			var $form = $(this);
			var url = $form.attr('action');
			$.ajax({
				method: 'POST',
				url: url,
				data: $form.serialize(),
				dataType: 'json',
			}).done(function (resp) {
				if (resp && resp.success) {
					toastr.success(resp.msg);
					$('#budget_change_modal').modal('hide');
					// Reload to refresh budget + log table.
					setTimeout(function () { location.reload(); }, 300);
				} else {
					toastr.error(resp && resp.msg ? resp.msg : 'Error');
				}
			}).fail(function (xhr) {
				var msg = 'Error';
				if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
				toastr.error(msg);
			});
		});

		// Initial sync.
		syncBudgetForm();
	})();
</script>
