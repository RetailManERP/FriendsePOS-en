
<?php $__env->startSection('title', __('cms::lang.new_file')); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('modules/cms/css/cms-admin.css?v=' . config('constants.asset_version')), false); ?>">
<style>
    .cms-editor-form .form-label {
        font-weight: 600;
        color: #2d3748;
    }
    .cms-editor-form .form-text {
        font-size: 0.8rem;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('cms::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header cms-page-header">
    <h1>
        <span class="header-icon">
            <i class="fas fa-plus-circle"></i>
        </span>
        <?php echo app('translator')->get('cms::lang.new_file'); ?>
    </h1>
</section>

<section class="content cms-content cms-form">
    <?php echo Form::open(['url' => action([\Modules\Cms\Http\Controllers\CmsContentController::class, 'store']), 'id' => 'create_content_form', 'method' => 'POST']); ?>

        <div class="row cms-editor-form">
            <div class="col-md-8">
                <?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <?php echo Form::label('folder', __('cms::lang.content_folder') . ':*'); ?>

                                <?php echo Form::select('folder', array_combine($allowedFolders, array_map('ucfirst', $allowedFolders)), $folder, ['class' => 'form-control form-select', 'required']); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <?php echo Form::label('filename', __('cms::lang.file_name') . ':*'); ?>

                                <div class="input-group">
                                    <?php echo Form::text('filename', null, ['class' => 'form-control', 'required', 'placeholder' => 'e.g. about-us', 'pattern' => '[a-zA-Z0-9_\\-]+']); ?>

                                    <span class="input-group-text">.md</span>
                                </div>
                                <small class="form-text text-muted"><?php echo app('translator')->get('cms::lang.filename_help'); ?></small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('content', __('cms::lang.content') . ':'); ?>

                                <?php echo Form::textarea('content', '# New Page' . "\n\nWrite your content here in Markdown format.", ['class' => 'form-control content-editor', 'rows' => 20, 'id' => 'md_content']); ?>

                            </div>
                        </div>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-4">
                <?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
                    <div class="mb-3">
                        <h6 class="fw-bold"><i class="fas fa-info-circle me-1 text-primary"></i> <?php echo app('translator')->get('cms::lang.md_editor_help_title'); ?></h6>
                        <div class="small text-muted">
                            <p><?php echo app('translator')->get('cms::lang.md_editor_help_desc'); ?></p>
                            <ul class="ps-3 mb-0">
                                <li><code># Heading 1</code></li>
                                <li><code>## Heading 2</code></li>
                                <li><code>**bold**</code></li>
                                <li><code>*italic*</code></li>
                                <li><code>[link text](url)</code></li>
                                <li><code>- list item</code></li>
                                <li><code>```code block```</code></li>
                            </ul>
                        </div>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="<?php echo e(action([\Modules\Cms\Http\Controllers\CmsContentController::class, 'index'], ['folder' => $folder]), false); ?>" class="btn btn-secondary btn-lg me-2">
                    <?php echo app('translator')->get('messages.cancel'); ?>
                </a>
                <button type="submit" class="btn cms-submit-btn submit-btn btn-lg">
                    <i class="fas fa-save me-1"></i> <?php echo app('translator')->get('cms::lang.create_file'); ?>
                </button>
            </div>
        </div>
    <?php echo Form::close(); ?>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $("form#create_content_form").validate({
            submitHandler: function(form) {
                let btn = Ladda.create(document.querySelector('.submit-btn'));
                btn.start();
                form.submit();
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>