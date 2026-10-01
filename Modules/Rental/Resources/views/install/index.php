

<?php $__env->startSection('title', __('rental::lang.rental_module')); ?>

<?php $__env->startSection('content'); ?>
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('rental::lang.rental_module') . ' - ' . __('rental::lang.installation')]); ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="text-center">
                    <i class="fas fa-warehouse fa-4x text-primary mb-15" style="margin-bottom:20px; display:block;"></i>
                    <h3><?php echo app('translator')->get('rental::lang.rental_module'); ?></h3>
                    <p class="text-muted"><?php echo app('translator')->get('rental::lang.module_description'); ?></p>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <h4><i class="fas fa-check-circle text-success"></i> <?php echo app('translator')->get('rental::lang.features'); ?></h4>
                        <ul>
                            <li><?php echo app('translator')->get('rental::lang.feature_item_management'); ?></li>
                            <li><?php echo app('translator')->get('rental::lang.feature_agreements'); ?></li>
                            <li><?php echo app('translator')->get('rental::lang.feature_returns'); ?></li>
                            <li><?php echo app('translator')->get('rental::lang.feature_payments'); ?></li>
                            <li><?php echo app('translator')->get('rental::lang.feature_calendar'); ?></li>
                            <li><?php echo app('translator')->get('rental::lang.feature_damage_reports'); ?></li>
                            <li><?php echo app('translator')->get('rental::lang.feature_maintenance'); ?></li>
                            <li><?php echo app('translator')->get('rental::lang.feature_reports'); ?></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h4><i class="fas fa-info-circle text-info"></i> <?php echo app('translator')->get('rental::lang.module_info'); ?></h4>
                        <table class="table table-condensed no-border">
                            <tr><th><?php echo app('translator')->get('rental::lang.version'); ?>:</th><td><?php echo e($module_version ?? '1.0', false); ?></td></tr>
                            <tr><th><?php echo app('translator')->get('rental::lang.installed_version'); ?>:</th><td><?php echo e($installed_version ?? __('rental::lang.not_installed'), false); ?></td></tr>
                        </table>
                    </div>
                </div>

                <hr>

                <div class="text-center">
                    <?php if(empty($installed_version)): ?>
                        <?php echo Form::open(['url' => action([\Modules\Rental\Http\Controllers\InstallController::class, 'install']), 'method' => 'post']); ?>

                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-download"></i> <?php echo app('translator')->get('rental::lang.install_module'); ?>
                        </button>
                        <?php echo Form::close(); ?>

                    <?php elseif(version_compare($installed_version, $module_version, '<')): ?>
                        <?php echo Form::open(['url' => action([\Modules\Rental\Http\Controllers\InstallController::class, 'update']), 'method' => 'post']); ?>

                        <button type="submit" class="btn btn-info btn-lg">
                            <i class="fas fa-sync"></i> <?php echo app('translator')->get('rental::lang.update_module'); ?>
                        </button>
                        <?php echo Form::close(); ?>

                    <?php else: ?>
                        <div class="callout callout-success">
                            <p><i class="fas fa-check"></i> <?php echo app('translator')->get('rental::lang.module_up_to_date'); ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($installed_version)): ?>
                        <div class="mt-15" style="margin-top:15px;">
                            <?php echo Form::open(['url' => action([\Modules\Rental\Http\Controllers\InstallController::class, 'uninstall']), 'method' => 'post']); ?>

                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('<?php echo e(__('rental::lang.uninstall_confirm'), false); ?>')">
                                <i class="fas fa-trash"></i> <?php echo app('translator')->get('rental::lang.uninstall_module'); ?>
                            </button>
                            <?php echo Form::close(); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>