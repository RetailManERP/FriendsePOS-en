
<?php $__env->startSection('title', __('cms::lang.cms')); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/css/bootstrap-iconpicker.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('modules/cms/css/cms-admin.css?v=' . config('constants.asset_version')), false); ?>">
<style type="text/css">
    .input-group-text{
        padding: 0px;
        margin: 0px;
        border: 0.1px solid #d2d6de;
        background-color: #d2d6de !important;
    }
    .input-group-text > button.iconpicker{
        padding-bottom: 0px;
        background-color: #d2d6de !important;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('cms::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header cms-page-header">
    <h1>
        <span class="header-icon">
            <i class="fas fa-edit"></i>
        </span>
        <?php if($post_type == 'page'): ?>
            <?php echo app('translator')->get('cms::lang.edit_page'); ?>
        <?php elseif($post_type == 'testimonial'): ?>
            <?php echo app('translator')->get('cms::lang.edit_testimonial'); ?>
        <?php elseif($post_type == 'blog'): ?>
            <?php echo app('translator')->get('cms::lang.edit_blog'); ?>
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

    if(in_array($post_type, ['page']) && !empty($page->layout) && in_array($page->layout, ['contact'])) {
        $content_label = __('cms::lang.description');
    } elseif(in_array($post_type, ['page']) && !empty($page->layout) && in_array($page->layout, ['home'])) {
        $content_label = __('cms::lang.description');
    }
?>
<!-- Main content -->
<section class="content cms-content cms-form">
    <?php echo Form::open(['url' => action([\Modules\Cms\Http\Controllers\CmsPageController::class, 'update'], [$page->id]), 'id' => 'edit_page_form', 'method' => 'put', 'files' => true]); ?>

        <input type="hidden" name="type" value="<?php echo e($post_type, false); ?>">
        <div class="row">
            <div class="col-md-9">
                <?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('title', $title_label . ':*' ); ?>

                                <?php echo Form::text('title', $page->title, ['class' => 'form-control', 'required' ]); ?>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('content', $content_label . ':*' ); ?>

                                <?php echo Form::textarea('content', $page->content, ['class' => 'form-control' ]); ?>

                            </div>
                        </div>
                    </div>
                <?php echo $__env->renderComponent(); ?>
                <?php if(in_array($post_type, ['page']) && !empty($page->layout) && in_array($page->layout, ['home'])): ?>
                    <?php if ($__env->exists('cms::page.partials.features', ['page_meta' => $page_meta])) echo $__env->make('cms::page.partials.features', ['page_meta' => $page_meta], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php if ($__env->exists('cms::page.partials.industries', ['page_meta' => $page_meta])) echo $__env->make('cms::page.partials.industries', ['page_meta' => $page_meta], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>
            <div class="col-md-3">
                <?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('feature_image', $feature_image_label . ':'); ?>

                                <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.previous_image_will_be_replaced'); ?>"></i>
                                <?php echo Form::file('feature_image', ['id' => 'feature_image', 'accept' => 'image/*']); ?>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <?php echo Form::label('priority', __('cms::lang.priority') . ':' ); ?>

                                <?php echo Form::number('priority', $page->priority, ['class' => 'form-control' ]); ?>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <br>
                                <label class="form-check-label">
<?php echo Form::checkbox('is_enabled', 1, $page->is_enabled, ['class' => 'form-check-input']); ?> <strong><?php echo app('translator')->get('cms::lang.is_enabled'); ?></strong>
                                </label> 
                            </div>
                        </div>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>
        <!-- TODO:include edit SEO -->
        <div class="row">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn cms-submit-btn submit-btn btn-lg"><?php echo app('translator')->get('messages.update'); ?></button>
            </div>
        </div>
    <?php echo Form::close(); ?>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-iconpicker/1.10.0/js/bootstrap-iconpicker.bundle.min.js"></script>
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

            $("form#edit_page_form").validate({
                submitHandler: function(form, e) {
                    if ($('form#edit_page_form').valid()) {
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
            __page_leave_confirmation('#edit_page_form');

            <?php if(in_array($post_type, ['page']) && !empty($page->layout) && in_array($page->layout, ['home'])): ?>
                setTimeout(() => {
                    init_tinymce('industry_content');
                }, 3000);

                setTimeout(() => {
                    init_tinymce('feature_content');
                }, 4000);

                for(let i=0;i<8;i++) {
                    $(`#industry_icon_${i}`)
                        .iconpicker()
                        .on('change', function(e) {
                            $(`#input_industry_icon_${i}`).val(e.icon);
                        });
                }

                for(let i=0;i<10;i++){
                    $(`#feature_icon_${i}`)
                        .iconpicker()
                        .on('change', function(e) {
                            $(`#input_feature_icon_${i}`).val(e.icon);
                        });
                }
            <?php endif; ?>
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>