
<?php $__env->startSection('title', __('cms::lang.cms')); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('modules/cms/css/cms-admin.css?v=' . config('constants.asset_version')), false); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('cms::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
    $cms_details = \Modules\Cms\Entities\CmsSiteDetail::getSiteDetails();
?>

<!-- Content Header (Page header) -->
<section class="content-header cms-page-header">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
        <h1>
            <span class="header-icon">
                <?php if($post_type == 'page'): ?>
                    <i class="fas fa-file-alt"></i>
                <?php elseif($post_type == 'testimonial'): ?>
                    <i class="fas fa-quote-right"></i>
                <?php elseif($post_type == 'blog'): ?>
                    <i class="fas fa-rss"></i>
                <?php endif; ?>
            </span>
            <?php if($post_type == 'page'): ?>
                <?php echo app('translator')->get('cms::lang.page'); ?>
            <?php elseif($post_type == 'testimonial'): ?>
                <?php echo app('translator')->get('cms::lang.testimonial'); ?>
            <?php elseif($post_type == 'blog'): ?>
                <?php echo app('translator')->get('cms::lang.blog'); ?>
            <?php endif; ?>
        </h1>
        <a class="cms-add-btn" 
            href="<?php echo e(action([\Modules\Cms\Http\Controllers\CmsPageController::class, 'create'], ['type' => $post_type]), false); ?>">
            <i class="fas fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
        </a>
    </div>
</section>

<!-- Main content -->
<section class="content cms-content">
    
    
    <?php if($post_type == 'page'): ?>
        <div class="card radius-10 cms-card mb-4">
            <div class="card-body">
                <div class="cms-download-section">
                    <div class="section-header">
                        <span class="section-icon"><i class="fas fa-download"></i></span>
                        <div>
                            <h5><?php echo app('translator')->get('cms::lang.download_apps'); ?></h5>
                            <p><?php echo app('translator')->get('cms::lang.download_apps_desc'); ?></p>
                        </div>
                    </div>

                    
                    <h6 class="text-muted text-uppercase fw-bold mb-3" style="font-size: 0.75rem; letter-spacing: 0.08em;">
                        <i class="fab fa-android me-1"></i> <?php echo app('translator')->get('cms::lang.android_apps'); ?>
                    </h6>
                    <div class="download-grid mb-4">
                        <?php
                            $android_btn_1 = [
                                'text' => $cms_details['btns']['android_app_1']['text'] ?? __('cms::lang.android_app_primary'),
                                'link' => $cms_details['btns']['android_app_1']['link'] ?? '#'
                            ];
                            $android_btn_2 = [
                                'text' => $cms_details['btns']['android_app_2']['text'] ?? __('cms::lang.android_app_secondary'),
                                'link' => $cms_details['btns']['android_app_2']['link'] ?? '#'
                            ];
                        ?>
                        <a href="<?php echo e($android_btn_1['link'], false); ?>" class="cms-download-btn btn-android" target="_blank" rel="noopener">
                            <span class="btn-icon"><i class="fab fa-google-play"></i></span>
                            <span class="btn-text">
                                <span class="btn-label-small"><?php echo app('translator')->get('cms::lang.download_on'); ?></span>
                                <span class="btn-label-main"><?php echo e($android_btn_1['text'], false); ?></span>
                            </span>
                        </a>
                        <a href="<?php echo e($android_btn_2['link'], false); ?>" class="cms-download-btn btn-android-alt" target="_blank" rel="noopener">
                            <span class="btn-icon"><i class="fab fa-android"></i></span>
                            <span class="btn-text">
                                <span class="btn-label-small"><?php echo app('translator')->get('cms::lang.get_it_on'); ?></span>
                                <span class="btn-label-main"><?php echo e($android_btn_2['text'], false); ?></span>
                            </span>
                        </a>
                    </div>

                    
                    <h6 class="text-muted text-uppercase fw-bold mb-3" style="font-size: 0.75rem; letter-spacing: 0.08em;">
                        <i class="fab fa-apple me-1"></i> <?php echo app('translator')->get('cms::lang.ios_apps'); ?>
                    </h6>
                    <div class="download-grid mb-4">
                        <?php
                            $ios_btn_1 = [
                                'text' => $cms_details['btns']['ios_app_1']['text'] ?? __('cms::lang.ios_app_primary'),
                                'link' => $cms_details['btns']['ios_app_1']['link'] ?? '#'
                            ];
                            $ios_btn_2 = [
                                'text' => $cms_details['btns']['ios_app_2']['text'] ?? __('cms::lang.ios_app_secondary'),
                                'link' => $cms_details['btns']['ios_app_2']['link'] ?? '#'
                            ];
                        ?>
                        <a href="<?php echo e($ios_btn_1['link'], false); ?>" class="cms-download-btn btn-ios" target="_blank" rel="noopener">
                            <span class="btn-icon"><i class="fab fa-apple"></i></span>
                            <span class="btn-text">
                                <span class="btn-label-small"><?php echo app('translator')->get('cms::lang.download_on'); ?></span>
                                <span class="btn-label-main"><?php echo e($ios_btn_1['text'], false); ?></span>
                            </span>
                        </a>
                        <a href="<?php echo e($ios_btn_2['link'], false); ?>" class="cms-download-btn btn-ios-alt" target="_blank" rel="noopener">
                            <span class="btn-icon"><i class="fab fa-app-store-ios"></i></span>
                            <span class="btn-text">
                                <span class="btn-label-small"><?php echo app('translator')->get('cms::lang.get_it_on'); ?></span>
                                <span class="btn-label-main"><?php echo e($ios_btn_2['text'], false); ?></span>
                            </span>
                        </a>
                    </div>

                    
                    <h6 class="text-muted text-uppercase fw-bold mb-3" style="font-size: 0.75rem; letter-spacing: 0.08em;">
                        <i class="fas fa-desktop me-1"></i> <?php echo app('translator')->get('cms::lang.desktop_apps'); ?>
                    </h6>
                    <div class="download-grid">
                        <?php
                            $win_btn = [
                                'text' => $cms_details['btns']['windows']['text'] ?? __('cms::lang.windows_app'),
                                'link' => $cms_details['btns']['windows']['link'] ?? '#'
                            ];
                            $win_btn_2 = [
                                'text' => $cms_details['btns']['windows_2']['text'] ?? __('cms::lang.windows_app_2'),
                                'link' => $cms_details['btns']['windows_2']['link'] ?? '#'
                            ];
                            $linux_btn = [
                                'text' => $cms_details['btns']['linux']['text'] ?? __('cms::lang.linux_app'),
                                'link' => $cms_details['btns']['linux']['link'] ?? '#'
                            ];
                            $osx_btn = [
                                'text' => $cms_details['btns']['osx']['text'] ?? __('cms::lang.macos_app'),
                                'link' => $cms_details['btns']['osx']['link'] ?? '#'
                            ];
                        ?>
                        <a href="<?php echo e($win_btn['link'], false); ?>" class="cms-download-btn btn-windows" target="_blank" rel="noopener">
                            <span class="btn-icon"><i class="fab fa-windows"></i></span>
                            <span class="btn-text">
                                <span class="btn-label-small"><?php echo app('translator')->get('cms::lang.download_for'); ?></span>
                                <span class="btn-label-main"><?php echo e($win_btn['text'], false); ?></span>
                            </span>
                        </a>
                        <a href="<?php echo e($win_btn_2['link'], false); ?>" class="cms-download-btn btn-windows" target="_blank" rel="noopener">
                            <span class="btn-icon"><i class="fab fa-windows"></i></span>
                            <span class="btn-text">
                                <span class="btn-label-small"><?php echo app('translator')->get('cms::lang.download_for'); ?></span>
                                <span class="btn-label-main"><?php echo e($win_btn_2['text'], false); ?></span>
                            </span>
                        </a>
                        <a href="<?php echo e($linux_btn['link'], false); ?>" class="cms-download-btn btn-linux" target="_blank" rel="noopener">
                            <span class="btn-icon"><i class="fab fa-linux"></i></span>
                            <span class="btn-text">
                                <span class="btn-label-small"><?php echo app('translator')->get('cms::lang.download_for'); ?></span>
                                <span class="btn-label-main"><?php echo e($linux_btn['text'], false); ?></span>
                            </span>
                        </a>
                        <a href="<?php echo e($osx_btn['link'], false); ?>" class="cms-download-btn btn-macos" target="_blank" rel="noopener">
                            <span class="btn-icon"><i class="fab fa-apple"></i></span>
                            <span class="btn-text">
                                <span class="btn-label-small"><?php echo app('translator')->get('cms::lang.download_for'); ?></span>
                                <span class="btn-label-main"><?php echo e($osx_btn['text'], false); ?></span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    
    <div class="row g-3">
        <?php $__empty_18 = true; $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
            <div class="col-lg-4 col-md-6 page-box">
                <div class="card cms-card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h6 class="card-title mb-0 text-truncate" title="<?php echo e($page->title, false); ?>"><?php echo e($page->title, false); ?></h6>
                        <div class="card-actions">
                            <a class="btn btn-sm btn-outline-primary"
                                href="<?php echo e(action([\Modules\Cms\Http\Controllers\CmsPageController::class, 'edit'], [$page->id, 'type' => $post_type]), false); ?>" title="<?php echo app('translator')->get('messages.edit'); ?>">
                                <i class="fas fa-edit"></i>
                            </a>
                            <?php if(empty($page->layout)): ?>
                                <button data-href="<?php echo e(action([\Modules\Cms\Http\Controllers\CmsPageController::class, 'destroy'], [$page->id, 'type' => $post_type]), false); ?>" class="btn btn-sm btn-outline-danger delete_page" title="<?php echo app('translator')->get('messages.delete'); ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-meta">
                            <span><b><?php echo app('translator')->get('cms::lang.priority'); ?>:</b> <?php echo e($page->priority, false); ?></span>
                            <span><i class="far fa-calendar-alt me-1"></i> <?php echo app('translator')->get('lang_v1.added_on'); ?>: <?php echo format_datetime_br($page->created_at); ?></span>
                            <?php if(!empty($page->layout)): ?>
                                <span><i class="fas fa-layer-group me-1"></i> <?php echo app('translator')->get('cms::lang.layout'); ?>: <?php echo app('translator')->get('cms::lang.'.$page->layout); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="mt-2">
                            <?php if($page->is_enabled == 1): ?>
                                <span class="badge-status badge-enabled"><i class="fas fa-check-circle"></i> <?php echo app('translator')->get('cms::lang.is_enabled'); ?></span>
                            <?php else: ?>
                                <span class="badge-status badge-disabled"><i class="fas fa-minus-circle"></i> <?php echo app('translator')->get('cms::lang.disabled'); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
            <div class="col-md-12">
                <div class="cms-empty-state">
                    <div class="empty-icon">
                        <?php if($post_type == 'page'): ?>
                            <i class="fas fa-file-alt"></i>
                        <?php elseif($post_type == 'blog'): ?>
                            <i class="fas fa-rss"></i>
                        <?php else: ?>
                            <i class="fas fa-quote-right"></i>
                        <?php endif; ?>
                    </div>
                    <h4><?php echo app('translator')->get('cms::lang.not_found_please_add_one'); ?></h4>
                    <p><?php echo app('translator')->get('cms::lang.empty_state_hint'); ?></p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', 'button.delete_page', function() {
            var page_box = $(this).closest('.page-box');
            swal({
                title: LANG.sure,
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(willDelete => {
                if (willDelete) {
                    var href = $(this).data('href');
                    var data = $(this).serialize();
                    $.ajax({
                        method: 'DELETE',
                        url: href,
                        dataType: 'json',
                        data: data,
                        success: function(result) {
                            if (result.success == true) {
                                toastr.success(result.msg);
                                page_box.remove();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                }
            });
        });
    })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>