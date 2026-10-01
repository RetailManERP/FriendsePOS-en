
<?php $__env->startSection('title', __('warehouse::lang.warehouse_management')); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('warehouse::lang.warehouse_management'); ?>
        <small><?php echo app('translator')->get('warehouse::lang.install_module'); ?></small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
                <div class="text-center">
                    <i class="fas fa-warehouse fa-4x text-primary mb-15" style="margin-bottom:15px;display:block;"></i>
                    <h3><?php echo app('translator')->get('warehouse::lang.warehouse_management'); ?></h3>
                    <p class="text-muted">
                        Comprehensive warehouse management system with multi-warehouse support, zone & bin locations,
                        stock tracking with lot/expiry management, inter-warehouse stock transfers, and detailed reporting.
                    </p>
                </div>

                <?php if(session('notification')): ?>
                    <div class="alert alert-<?php echo e(session('notification.type', 'info'), false); ?>">
                        <?php echo e(session('notification.msg'), false); ?>

                    </div>
                <?php endif; ?>

                <hr>

                <?php if(!$is_installed): ?>
                    <div class="text-center">
                        <?php echo Form::open(['route' => 'warehouse.install.post', 'method' => 'POST']); ?>

                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-download"></i> <?php echo app('translator')->get('warehouse::lang.install_module'); ?>
                        </button>
                        <?php echo Form::close(); ?>

                    </div>
                <?php else: ?>
                    <div class="alert alert-success text-center">
                        <i class="fas fa-check-circle"></i> <?php echo app('translator')->get('warehouse::lang.module_installed'); ?>
                        <br><small><?php echo app('translator')->get('warehouse::lang.module_version'); ?>: <?php echo e($module_version, false); ?></small>
                    </div>
                    <?php if($is_update_available): ?>
                        <div class="text-center">
                            <a href="<?php echo e(route('warehouse.install.update'), false); ?>" class="btn btn-warning">
                                <i class="fas fa-sync"></i> <?php echo app('translator')->get('warehouse::lang.update_module'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>