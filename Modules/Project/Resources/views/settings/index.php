
<?php $__env->startSection('title', __('project::lang.settings')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('project::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header">
	<h1><?php echo app('translator')->get('project::lang.settings'); ?></h1>
</section>
<section class="content">
            <?php $__env->startComponent('components.widget'); ?>
            <div class="box-body">
                <?php echo Form::open([
                    'url' => action([\Modules\Project\Http\Controllers\SettingsController::class, 'store']),
                    'method' => 'post',
                    'id' => 'settings',
                    'files' => true
                ]); ?>


                <?php
                $fields = json_decode($busines->prj_setting) ?? [];
                $task_fields = $fields->task_custom_fields ?? [];
                ?>

                <h4 class="project-section-title"><?php echo app('translator')->get('project::lang.project'); ?> <?php echo app('translator')->get('project::lang.custom_field'); ?></h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('custom_field1', __('project::lang.custom_field1')); ?>

                            <?php echo Form::text('custom_fields[custom_field1]', $fields->custom_fields->custom_field1 ?? null , [
                                'class' => 'form-control',
                                'placeholder' => __('project::lang.custom_field1'),
                            ]); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('custom_field2', __('project::lang.custom_field2')); ?>

                            <?php echo Form::text('custom_fields[custom_field2]', $fields->custom_fields->custom_field2 ?? null, [
                                'class' => 'form-control',
                                'placeholder' => __('project::lang.custom_field2'),
                            ]); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('custom_field3', __('project::lang.custom_field3')); ?>

                            <?php echo Form::text('custom_fields[custom_field3]', $fields->custom_fields->custom_field3 ?? null, [
                                'class' => 'form-control',
                                'placeholder' => __('project::lang.custom_field3'),
                            ]); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('custom_field4', __('project::lang.custom_field4')); ?>

                            <?php echo Form::text('custom_fields[custom_field4]', $fields->custom_fields->custom_field4 ?? null, [
                                'class' => 'form-control',
                                'placeholder' => __('project::lang.custom_field4'),
                            ]); ?>

                        </div>
                    </div>
                </div>

                <hr>
                <h4 class="project-section-title"><?php echo app('translator')->get('project::lang.task'); ?> <?php echo app('translator')->get('project::lang.custom_field'); ?></h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('task_custom_field_1', __('project::lang.task_custom_field_1')); ?>

                            <?php echo Form::text('task_custom_fields[custom_field_1]', $task_fields->custom_field_1 ?? null, [
                                'class' => 'form-control',
                                'placeholder' => __('project::lang.task_custom_field_1'),
                            ]); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('task_custom_field_2', __('project::lang.task_custom_field_2')); ?>

                            <?php echo Form::text('task_custom_fields[custom_field_2]', $task_fields->custom_field_2 ?? null, [
                                'class' => 'form-control',
                                'placeholder' => __('project::lang.task_custom_field_2'),
                            ]); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('task_custom_field_3', __('project::lang.task_custom_field_3')); ?>

                            <?php echo Form::text('task_custom_fields[custom_field_3]', $task_fields->custom_field_3 ?? null, [
                                'class' => 'form-control',
                                'placeholder' => __('project::lang.task_custom_field_3'),
                            ]); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('task_custom_field_4', __('project::lang.task_custom_field_4')); ?>

                            <?php echo Form::text('task_custom_fields[custom_field_4]', $task_fields->custom_field_4 ?? null, [
                                'class' => 'form-control',
                                'placeholder' => __('project::lang.task_custom_field_4'),
                            ]); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" name="submit_action" value="save" class="btn btn-primary submit_form"><?php echo app('translator')->get('messages.save'); ?></button>
                </div>
                <?php echo Form::close(); ?>

            </div>
            <?php echo $__env->renderComponent(); ?>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>