
<?php $__env->startSection('title', 'KRA Notices'); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>KRA Notices <small>Official eTIMS Notifications</small></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('kenyaetims.dashboard'), false); ?>">eTIMS</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('kenyaetims.settings'), false); ?>">Settings</a></li>
        <li class="breadcrumb-item active">Notices</li>
    </ol>
</section>

<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php echo e(session('status.msg'), false); ?>

        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="card-title mb-0"><i class="fas fa-bell"></i> Notices from KRA</h5>
            <div class="ms-auto">
                <span class="badge bg-warning me-2"><?php echo e($unread_count, false); ?> Unread</span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width: 30px"></th>
                            <th>Notice No</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Date</th>
                            <th>Detail URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr class="<?php echo e(!$notice->is_read ? 'fw-bold table-warning' : '', false); ?>">
                            <td>
                                <?php if(!$notice->is_read): ?>
                                    <span class="badge bg-primary rounded-pill" title="Unread">&bull;</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($notice->notice_no, false); ?></td>
                            <td><?php echo e($notice->title, false); ?></td>
                            <td>
                                <span title="<?php echo e($notice->content, false); ?>">
                                    <?php echo e(Str::limit($notice->content, 80), false); ?>

                                </span>
                            </td>
                            <td><?php echo e($notice->registration_date ? \Carbon\Carbon::parse($notice->registration_date)->format('Y-m-d') : '-', false); ?></td>
                            <td>
                                <?php if($notice->detail_url): ?>
                                    <a href="<?php echo e($notice->detail_url, false); ?>" target="_blank" class="btn btn-xs btn-outline-primary">
                                        <i class="fas fa-external-link-alt"></i> Open
                                    </a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No notices from KRA.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if($notices->hasPages()): ?>
        <div class="card-footer">
            <?php echo e($notices->links(), false); ?>

        </div>
        <?php endif; ?>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>