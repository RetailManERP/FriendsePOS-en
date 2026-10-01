<?php
    $can_edit_location = ! empty($can_edit_project);
    $readonly = $can_edit_location ? [] : ['readonly' => true];
    $api_key = env('GOOGLE_MAP_API_KEY');
?>

<div class="project-panel">
    <div class="project-panel-header">
        <h4>
            <i class="fas fa-map-marker-alt"></i>
            <?php echo app('translator')->get('project::lang.project_location'); ?>
        </h4>
    </div>
    <div class="project-panel-body">
        <?php echo Form::open(['route' => ['project.location.update', $project->id], 'method' => 'put', 'id' => 'project_location_form']); ?>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('address_line_1', __('lang_v1.address_line_1') . ':*'); ?>

                        <?php echo Form::text('address_line_1', $project->address_line_1, array_merge(['class' => 'form-control', 'required' => true, 'placeholder' => __('lang_v1.address_line_1')], $readonly)); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('address_line_2', __('lang_v1.address_line_2') . ':'); ?>

                        <?php echo Form::text('address_line_2', $project->address_line_2, array_merge(['class' => 'form-control', 'placeholder' => __('lang_v1.address_line_2')], $readonly)); ?>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('city', __('business.city') . ':*'); ?>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-map-marker"></i>
                            </span>
                            <?php echo Form::text('city', $project->city, array_merge(['class' => 'form-control', 'required' => true, 'placeholder' => __('business.city')], $readonly)); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('state', __('business.state') . ':*'); ?>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-map-marker"></i>
                            </span>
                            <?php echo Form::text('state', $project->state, array_merge(['class' => 'form-control', 'required' => true, 'placeholder' => __('business.state')], $readonly)); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('country', __('business.country') . ':*'); ?>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-globe"></i>
                            </span>
                            <?php echo Form::text('country', $project->country, array_merge(['class' => 'form-control', 'required' => true, 'placeholder' => __('business.country')], $readonly)); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('zip_code', __('business.zip_code') . ':*'); ?>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-map-marker"></i>
                            </span>
                            <?php echo Form::text('zip_code', $project->zip_code, array_merge(['class' => 'form-control', 'required' => true, 'placeholder' => __('business.zip_code')], $readonly)); ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="form-group">
                        <?php echo Form::label('shipping_address', __('project::lang.map_address') . ':'); ?>

                        <?php echo Form::text('shipping_address', $project->shipping_address, array_merge(['class' => 'form-control', 'placeholder' => __('lang_v1.search_address'), 'id' => 'project_shipping_address'], $readonly)); ?>

                    </div>

                    <?php echo Form::hidden('position', $project->position, ['id' => 'project_position']); ?>


                    <?php if(! empty($api_key)): ?>
                        <div id="project_location_map" style="width: 100%; height: 320px; margin-bottom: 15px;"></div>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <?php echo app('translator')->get('project::lang.google_map_api_key_missing'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if($can_edit_location): ?>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary ladda-button project-location-save-btn" data-style="expand-right">
                            <span class="ladda-label"><i class="fa fa-save"></i> <?php echo app('translator')->get('messages.update'); ?></span>
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        <?php echo Form::close(); ?>

    </div>
</div>
