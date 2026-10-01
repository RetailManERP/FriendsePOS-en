
<?php $__env->startSection('title', __('messages.settings')); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('crm::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo app('translator')->get('messages.settings'); ?>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php echo Form::open(['url' => action([\Modules\Crm\Http\Controllers\CrmSettingsController::class,
            'updateSettings']), 'method' => 'post']); ?>

            <?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
            <div class="col-md-4">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('enable_order_request', 1, !empty($crm_settings['enable_order_request']),
                        ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('crm::lang.enable_order_request'); ?>
                    </label> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('crm::lang.enable_order_request_help') . '"></i>';
                }
            ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('order_request_prefix', __('crm::lang.order_request_prefix') . ':'); ?>

                    <?php echo Form::text('order_request_prefix', $crm_settings['order_request_prefix'] ?? null, ['class' =>
                    'form-control','placeholder' => __( 'crm::lang.order_request_prefix' )]); ?>

                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary float-end"><?php echo app('translator')->get( 'messages.update' ); ?></button>
            </div>
            <?php echo $__env->renderComponent(); ?>
            <div class="col-xs-12">
                <p class="help-block"><i><?php echo __('crm::lang.version_info', ['version' => $version]); ?></i></p>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>