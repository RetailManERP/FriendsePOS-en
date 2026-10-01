<div class="modal-dialog modal-lg project-modal project-create-modal" role="document">
    <?php echo Form::open(['action' => '\Modules\Project\Http\Controllers\ProjectController@store', 'id' => 'project_form', 'method' => 'post']); ?>

    <div class="modal-content">
        <div class="modal-header tw-border-b tw-border-gray-200">
            <h4 class="modal-title tw-flex tw-items-center tw-gap-2">
                <i class="fa fa-plus-circle tw-text-blue-600"></i>
                <?php echo app('translator')->get('project::lang.create_project'); ?>
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

                            <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __('project::lang.project') . ' ' . __('messages.name')]); ?>

                       </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('description', __('lang_v1.description') . ':'); ?>

                            <?php echo Form::textarea('description', null, ['class' => 'form-control ', 'id' => 'description']); ?>

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

                            <?php echo Form::select('contact_id', $customers, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;']); ?>

                       </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('location_id', __('business.business_location') . ':*'); ?>

                            <?php echo Form::select('location_id', $business_locations, $default_location, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('status', __('sale.status') .':*'); ?>

                            <?php echo Form::select('status', $statuses, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('lead_id', __('project::lang.lead') .':*'); ?>

                            <?php echo Form::select('lead_id', $users, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

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

                            <?php echo Form::text('start_date', '', ['class' => 'form-control datepicker', 'readonly']); ?>

                       </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('end_date', __('project::lang.end_date') .':'); ?>

                            <?php echo Form::text('end_date', '', ['class' => 'form-control datepicker', 'readonly']); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('budget', __('project::lang.budget') . ':'); ?>

                            <div class="project-money-field">
                                <span class="project-money-icon"><i class="fa fa-money"></i></span>
                                <?php echo Form::text('budget', null, ['class' => 'form-control input_number project-money-input', 'placeholder' => __('project::lang.budget'), 'inputmode' => 'decimal']); ?>

                            </div>
                            <small class="text-muted"><?php echo app('translator')->get('project::lang.budget_optional_hint'); ?></small>
                        </div>
                    </div>
                </div>
            </div>

            <?php echo $__env->make('project::project.partials.steps_form', ['project' => null, 'statuses' => $statuses], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            
            <div class="tw-mb-4">
                <h5 class="tw-text-sm tw-font-semibold tw-text-gray-500 tw-uppercase tw-tracking-wider tw-mb-3">
                    <i class="fa fa-users tw-mr-1"></i> <?php echo app('translator')->get('project::lang.team_members'); ?> & <?php echo app('translator')->get('project::lang.category'); ?>
                </h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('user_id', __('project::lang.members') .':*'); ?>

                           <?php echo Form::select('user_id[]', $users, null, ['class' => 'form-control select2', 'multiple', 'required', 'style' => 'width: 100%;']); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('category_id', __('project::lang.category') .':'); ?>

                           <?php echo Form::select('category_id[]', $categories, null, ['class' => 'form-control select2', 'multiple', 'style' => 'width: 100%;']); ?>

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

                            <?php echo Form::text($key, null , ['class' => 'form-control']); ?>

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
                <span class="ladda-label"><i class="fa fa-save tw-mr-1"></i> <?php echo app('translator')->get('messages.save'); ?></span>
            </button>
             <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white" data-dismiss="modal" data-bs-dismiss="modal">
                <?php echo app('translator')->get('messages.close'); ?>
            </button>
        </div>
    </div><!-- /.modal-content -->
    <?php echo Form::close(); ?>

</div><!-- /.modal-dialog -->
