

<?php $__env->startSection('title', __('aiassistance::lang.openai_settings')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1>
        <i class="fas fa-robot"></i> <?php echo app('translator')->get('aiassistance::lang.openai_settings'); ?>
    </h1>
</section>

<section class="content">
    <?php echo Form::open(['url' => route('aiassistance.settings.update'), 'method' => 'post', 'id' => 'aiassistance_settings_form']); ?>

        <div class="card">
            <div class="card-body">
                <div class="alert alert-info">
                    <?php echo app('translator')->get('aiassistance::lang.openai_settings_help'); ?>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>
                                <?php echo Form::checkbox('is_enabled', 1, !empty($settings->is_enabled), ['class' => 'input-icheck']); ?>

                                <?php echo app('translator')->get('aiassistance::lang.enable_openai'); ?>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <?php if(!empty($masked_api_key)): ?>
                            <p class="text-muted">
                                <?php echo app('translator')->get('aiassistance::lang.saved_api_key'); ?>: <code><?php echo e($masked_api_key, false); ?></code>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('api_key', __('aiassistance::lang.openai_api_key')); ?>

                            <?php echo Form::password('api_key', ['class' => 'form-control', 'placeholder' => __('aiassistance::lang.leave_blank_keep_key'), 'autocomplete' => 'new-password']); ?>

                            <small class="text-muted"><?php echo app('translator')->get('aiassistance::lang.openai_api_key_help'); ?></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('organization_id', __('aiassistance::lang.openai_organization_id')); ?>

                            <?php echo Form::text('organization_id', $settings->organization_id, ['class' => 'form-control', 'placeholder' => 'org_...']); ?>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('text_model', __('aiassistance::lang.text_model')); ?>

                            <?php echo Form::text('text_model', $settings->text_model ?: 'gpt-3.5-turbo-1106', ['class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('vision_model', __('aiassistance::lang.vision_model')); ?>

                            <?php echo Form::text('vision_model', $settings->vision_model ?: 'gpt-4o', ['class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('image_model', __('aiassistance::lang.image_model')); ?>

                            <?php echo Form::text('image_model', $settings->image_model ?: 'dall-e-3', ['class' => 'form-control']); ?>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('monthly_token_limit', __('aiassistance::lang.monthly_token_limit')); ?>

                            <?php echo Form::number('monthly_token_limit', $settings->monthly_token_limit ?? 0, ['class' => 'form-control', 'min' => 0]); ?>

                            <small class="text-muted"><?php echo app('translator')->get('aiassistance::lang.monthly_token_limit_help'); ?></small>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <?php echo Form::label('assistant_instructions', __('aiassistance::lang.assistant_instructions')); ?>

                            <?php echo Form::textarea('assistant_instructions', $settings->assistant_instructions, ['class' => 'form-control', 'rows' => 4, 'placeholder' => __('aiassistance::lang.assistant_instructions_placeholder')]); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> <?php echo app('translator')->get('messages.update'); ?>
                </button>
                <button type="submit" name="test_connection" value="1" class="btn btn-info">
                    <i class="fas fa-plug"></i> <?php echo app('translator')->get('aiassistance::lang.test_openai_connection'); ?>
                </button>
            </div>
        </div>
    <?php echo Form::close(); ?>


    <div class="card mt-3">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-question-circle"></i> <?php echo app('translator')->get('aiassistance::lang.how_to_connect_openai'); ?>
            </h5>
        </div>
        <div class="card-body">
            <ol class="mb-3">
                <li><?php echo app('translator')->get('aiassistance::lang.openai_guide_step_1'); ?></li>
                <li><?php echo app('translator')->get('aiassistance::lang.openai_guide_step_2'); ?></li>
                <li><?php echo app('translator')->get('aiassistance::lang.openai_guide_step_3'); ?></li>
                <li><?php echo app('translator')->get('aiassistance::lang.openai_guide_step_4'); ?></li>
                <li><?php echo app('translator')->get('aiassistance::lang.openai_guide_step_5'); ?></li>
            </ol>

            <div class="alert alert-warning mb-0">
                <strong><?php echo app('translator')->get('aiassistance::lang.openai_guide_note_title'); ?></strong>
                <?php echo app('translator')->get('aiassistance::lang.openai_guide_note'); ?>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>