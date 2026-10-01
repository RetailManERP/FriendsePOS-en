
<?php $__env->startSection('title', __('cms::lang.content_files')); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('modules/cms/css/cms-admin.css?v=' . config('constants.asset_version')), false); ?>">
<style>
    .content-file-card {
        border: 1px solid #e3e6f0;
        border-radius: 0.75rem;
        transition: all 0.2s ease;
        background: #fff;
    }
    .content-file-card:hover {
        border-color: var(--bs-primary);
        box-shadow: 0 4px 15px rgba(var(--bs-primary-rgb), 0.12);
        transform: translateY(-2px);
    }
    .content-file-card .card-body {
        padding: 1.25rem;
    }
    .content-file-card .file-icon {
        font-size: 2rem;
        color: var(--bs-primary);
        opacity: 0.8;
    }
    .content-file-card .file-name {
        font-weight: 600;
        font-size: 0.95rem;
        color: #2d3748;
        word-break: break-all;
    }
    .content-file-card .file-meta {
        font-size: 0.78rem;
        color: #718096;
    }
    .content-file-card .card-actions .btn {
        padding: 0.25rem 0.6rem;
        font-size: 0.8rem;
    }
    .folder-tabs .nav-link {
        font-weight: 600;
        color: #4a5568;
        border: none;
        border-bottom: 3px solid transparent;
        padding: 0.75rem 1.25rem;
        transition: all 0.2s;
    }
    .folder-tabs .nav-link.active {
        color: var(--bs-primary);
        border-bottom-color: var(--bs-primary);
        background: transparent;
    }
    .folder-tabs .nav-link:hover:not(.active) {
        color: var(--bs-primary);
        background: rgba(var(--bs-primary-rgb), 0.05);
    }
    .folder-tabs .nav-link .badge {
        font-size: 0.7rem;
        padding: 0.2em 0.5em;
    }
    .empty-folder-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #a0aec0;
    }
    .empty-folder-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('cms::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header cms-page-header">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
        <h1>
            <span class="header-icon">
                <i class="fas fa-file-code"></i>
            </span>
            <?php echo app('translator')->get('cms::lang.content_files'); ?>
        </h1>
        <a class="cms-add-btn" 
            href="<?php echo e(action([\Modules\Cms\Http\Controllers\CmsContentController::class, 'create'], ['folder' => $activeFolder]), false); ?>">
            <i class="fas fa-plus"></i> <?php echo app('translator')->get('cms::lang.new_file'); ?>
        </a>
    </div>
</section>

<section class="content cms-content">
    
    <ul class="nav folder-tabs mb-4">
        <?php $__currentLoopData = $folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folderName => $files): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="nav-item">
                <a class="nav-link <?php echo e($activeFolder === $folderName ? 'active' : '', false); ?>"
                    href="<?php echo e(action([\Modules\Cms\Http\Controllers\CmsContentController::class, 'index'], ['folder' => $folderName]), false); ?>">
                    <?php if($folderName === 'pages'): ?>
                        <i class="fas fa-file-alt me-1"></i>
                    <?php elseif($folderName === 'blogs'): ?>
                        <i class="fas fa-rss me-1"></i>
                    <?php else: ?>
                        <i class="fas fa-folder me-1"></i>
                    <?php endif; ?>
                    <?php echo e(ucfirst($folderName), false); ?>

                    <span class="badge bg-secondary ms-1"><?php echo e(count($files), false); ?></span>
                </a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>

    
    <div class="row g-3">
        <?php $__empty_18 = true; $__currentLoopData = $folders[$activeFolder]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
            <div class="col-lg-4 col-md-6 file-box" data-folder="<?php echo e($activeFolder, false); ?>" data-file="<?php echo e($file['name'], false); ?>">
                <div class="card content-file-card">
                    <div class="card-body">
                        <div class="d-flex align-items-start gap-3">
                            <div class="file-icon">
                                <i class="fab fa-markdown"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="file-name"><?php echo e($file['name'], false); ?></div>
                                <div class="file-meta mt-1">
                                    <span><i class="fas fa-hdd me-1"></i><?php echo e(number_format($file['size'] / 1024, 1), false); ?> KB</span>
                                    <span class="ms-2"><i class="far fa-clock me-1"></i><?php echo e($file['modified'], false); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2 mt-3 card-actions">
                            <a href="<?php echo e(action([\Modules\Cms\Http\Controllers\CmsContentController::class, 'edit'], ['folder' => $activeFolder, 'file' => $file['name']]), false); ?>"
                                class="btn btn-sm btn-outline-primary" title="<?php echo app('translator')->get('messages.edit'); ?>">
                                <i class="fas fa-edit me-1"></i><?php echo app('translator')->get('messages.edit'); ?>
                            </a>
                            <button class="btn btn-sm btn-outline-danger delete-content-file"
                                data-folder="<?php echo e($activeFolder, false); ?>" data-file="<?php echo e($file['name'], false); ?>" title="<?php echo app('translator')->get('messages.delete'); ?>">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
            <div class="col-12">
                <div class="empty-folder-state">
                    <i class="fas fa-folder-open"></i>
                    <h5><?php echo app('translator')->get('cms::lang.no_content_files'); ?></h5>
                    <p><?php echo app('translator')->get('cms::lang.no_content_files_hint'); ?></p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.delete-content-file', function() {
            var btn = $(this);
            var fileBox = btn.closest('.file-box');
            var folder = btn.data('folder');
            var file = btn.data('file');

            swal({
                title: LANG.sure,
                text: '<?php echo e(__("cms::lang.delete_file_confirm"), false); ?>',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(function(willDelete) {
                if (willDelete) {
                    $.ajax({
                        method: 'DELETE',
                        url: '<?php echo e(action([\Modules\Cms\Http\Controllers\CmsContentController::class, "destroy"]), false); ?>',
                        data: {
                            folder: folder,
                            file: file,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        success: function(result) {
                            if (result.success) {
                                toastr.success(result.msg);
                                fileBox.fadeOut(300, function() { $(this).remove(); });
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                        error: function() {
                            toastr.error('<?php echo e(__("messages.something_went_wrong"), false); ?>');
                        }
                    });
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>