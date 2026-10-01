
<?php $__env->startSection('title', __('cms::lang.cms')); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('modules/cms/css/cms-admin.css?v=' . config('constants.asset_version')), false); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('cms::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header cms-page-header">
    <h1>
        <span class="header-icon">
            <?php if($post_type == 'page'): ?>
                <i class="fas fa-plus"></i>
            <?php elseif($post_type == 'testimonial'): ?>
                <i class="fas fa-plus"></i>
            <?php elseif($post_type == 'blog'): ?>
                <i class="fas fa-plus"></i>
            <?php endif; ?>
        </span>
        <?php if($post_type == 'page'): ?>
            <?php echo app('translator')->get('cms::lang.add_page'); ?>
        <?php elseif($post_type == 'testimonial'): ?>
            <?php echo app('translator')->get('cms::lang.add_testimonial'); ?>
        <?php elseif($post_type == 'blog'): ?>
            <?php echo app('translator')->get('cms::lang.add_blog'); ?>
        <?php endif; ?>
    </h1>
</section>
<!-- input label text based on post type -->
<?php
    if (in_array($post_type, ['blog', 'page'])) {
        $title_label = __('cms::lang.title');
        $content_label = __('cms::lang.content');
        $feature_image_label = __('cms::lang.feature_image');
    } elseif (in_array($post_type, ['testimonial'])) {
        $title_label = __('user.name');
        $content_label = __('cms::lang.testimonial');
        $feature_image_label = __('cms::lang.user_image');
    }
?>
<!-- Main content -->
<section class="content cms-content cms-form">
    <?php echo Form::open(['action' => '\Modules\Cms\Http\Controllers\CmsPageController@store', 'id' => 'create_page_form', 'method' => 'post', 'files' => true]); ?>

        <input type="hidden" name="type" value="<?php echo e($post_type, false); ?>">
        <div class="row">
            <div class="col-md-9">
                <?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('title', $title_label . ':*' ); ?>

                                <?php echo Form::text('title', null, ['class' => 'form-control', 'required' ]); ?>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('content', $content_label . ':*' ); ?>

                                <?php echo Form::textarea('content', null, ['class' => 'form-control' ]); ?>

                            </div>
                        </div>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-3">
                <?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('feature_image', $feature_image_label . ':'); ?>

                                <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?>"></i>
                                <?php echo Form::file('feature_image', ['id' => 'feature_image', 'accept' => 'image/*']); ?>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('priority', __('cms::lang.priority') . ':' ); ?>

                                <?php echo Form::number('priority', null, ['class' => 'form-control' ]); ?>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <br>
                                <label class="form-check-label">
<?php echo Form::checkbox('is_enabled', 1, true, ['class' => 'form-check-input']); ?> <strong><?php echo app('translator')->get('cms::lang.is_enabled'); ?></strong>
                                </label> 
                            </div>
                        </div>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>
        <!-- TODO:include add SEO -->
        <div class="row">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn cms-submit-btn submit-btn btn-lg"><?php echo app('translator')->get('messages.submit'); ?></button>
            </div>
        </div>
    <?php echo Form::close(); ?>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            init_tinymce('content');

            var img_fileinput_setting = {
                showUpload: false,
                showPreview: true,
                browseLabel: '',
                removeLabel: '',
                cancelLabel: '',
                previewSettings: {
                    image: { width: 'auto', height: 'auto', 'max-width': '100%', 'max-height': '100%' },
                },
            };
            $('#feature_image').fileinput(img_fileinput_setting);

            $("form#create_page_form").validate({
                submitHandler: function(form, e) {
                    if ($('form#create_page_form').valid()) {
                        window.onbeforeunload = null;
                        //if meta des length is 0;extract from content and use it as meta description
                        if (
                            $("textarea#meta_description") &&
                            (
                                $("textarea#meta_description").val().length == 0
                            )
                        ) {
                           let meta_description = tinyMCE.get('content').getContent({format : 'text'});
                            $("textarea#meta_description").val(meta_description.substring(0, 160));
                        }
                        let post_submit_btn = Ladda.create(document.querySelector('.submit-btn'));
                        form.submit();
                        post_submit_btn.start();
                    }
                }
            });
            //display notification before if any data is changed
            __page_leave_confirmation('#create_page_form');
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>