
<?php $__env->startSection('title', __('warehouse::lang.settings')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('warehouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('warehouse::lang.settings'); ?></h1>
</section>

<section class="content">

    <?php echo Form::open(['route' => 'warehouse.settings.save', 'method' => 'POST']); ?>


    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('warehouse::lang.transfer_settings')]); ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('default_transfer_status', __('warehouse::lang.default_transfer_status') . ':'); ?>

                    <?php echo Form::select('default_transfer_status', [
                        'draft'      => __('warehouse::lang.status_draft'),
                        'pending'    => __('warehouse::lang.status_pending'),
                        'in_transit' => __('warehouse::lang.status_in_transit'),
                        'partial'    => __('warehouse::lang.status_partial'),
                        'completed'  => __('warehouse::lang.status_completed'),
                        'cancelled'  => __('warehouse::lang.status_cancelled'),
                    ], $settings['default_transfer_status'], ['class' => 'form-control select2']); ?>

                    <small class="form-text text-muted"><?php echo app('translator')->get('warehouse::lang.default_transfer_status_help'); ?></small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('transfer_number_prefix', __('warehouse::lang.transfer_number_prefix') . ':'); ?>

                    <?php echo Form::text('transfer_number_prefix', $settings['transfer_number_prefix'], ['class' => 'form-control', 'placeholder' => 'e.g. WT']); ?>

                    <small class="form-text text-muted"><?php echo app('translator')->get('warehouse::lang.transfer_number_prefix_help'); ?></small>
                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-md-12 text-end mb-3">
            <?php echo Form::submit(__('messages.save'), ['class' => 'btn btn-primary']); ?>

        </div>
    </div>

    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>