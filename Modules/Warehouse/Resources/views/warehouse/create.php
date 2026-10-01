
<?php $__env->startSection('title', __('warehouse::lang.add_warehouse')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('warehouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('warehouse::lang.add_warehouse'); ?></h1>
</section>

<section class="content">
    <?php echo Form::open(['route' => 'warehouse.store', 'method' => 'POST', 'id' => 'warehouse_form']); ?>


    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('name', __('warehouse::lang.warehouse_name') . ':*'); ?>

                    <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __('warehouse::lang.warehouse_name')]); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('location_id', __('warehouse::lang.warehouse_code') . ':'); ?>

                    <?php echo Form::text('location_id', $warehouse_code, ['class' => 'form-control', 'readonly', 'placeholder' => __('warehouse::lang.warehouse_code')]); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('warehouse_type', __('warehouse::lang.warehouse_type') . ':*'); ?>

                    <?php echo Form::select('warehouse_type', $warehouse_types, 'main', ['class' => 'form-control select2', 'required']); ?>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('warehouse_parent_location', __('warehouse::lang.warehouse_parent_location') . ':'); ?>

                    <?php echo Form::select('warehouse_parent_location', $business_locations, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('warehouse_manager_id', __('warehouse::lang.warehouse_manager') . ':'); ?>

                    <?php echo Form::select('warehouse_manager_id', $users, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <br>
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('is_active', 1, true); ?> <?php echo app('translator')->get('warehouse::lang.active'); ?>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('landmark', __('warehouse::lang.warehouse_address') . ':'); ?>

                    <?php echo Form::textarea('landmark', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('warehouse::lang.warehouse_address')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('city', __('warehouse::lang.warehouse_city') . ':*'); ?>

                    <?php echo Form::text('city', null, ['class' => 'form-control', 'required', 'placeholder' => __('warehouse::lang.warehouse_city')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('state', __('warehouse::lang.warehouse_state') . ':*'); ?>

                    <?php echo Form::text('state', null, ['class' => 'form-control', 'required', 'placeholder' => __('warehouse::lang.warehouse_state')]); ?>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('country', __('warehouse::lang.warehouse_country') . ':*'); ?>

                    <?php echo Form::text('country', null, ['class' => 'form-control', 'required', 'placeholder' => __('warehouse::lang.warehouse_country')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('zip_code', __('warehouse::lang.warehouse_zip') . ':*'); ?>

                    <?php echo Form::text('zip_code', null, ['class' => 'form-control', 'required', 'placeholder' => __('warehouse::lang.warehouse_zip')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('mobile', __('warehouse::lang.warehouse_phone') . ':'); ?>

                    <?php echo Form::text('mobile', null, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('email', __('warehouse::lang.warehouse_email') . ':'); ?>

                    <?php echo Form::email('email', null, ['class' => 'form-control']); ?>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('warehouse_total_area', __('warehouse::lang.total_area') . ':'); ?>

                    <?php echo Form::number('warehouse_total_area', null, ['class' => 'form-control', 'step' => '0.01']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('warehouse_usable_area', __('warehouse::lang.usable_area') . ':'); ?>

                    <?php echo Form::number('warehouse_usable_area', null, ['class' => 'form-control', 'step' => '0.01']); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('warehouse_notes', __('warehouse::lang.warehouse_notes') . ':'); ?>

                    <?php echo Form::textarea('warehouse_notes', null, ['class' => 'form-control', 'rows' => 2]); ?>

                </div>
            </div>
        </div>

    <?php echo $__env->renderComponent(); ?>

    <?php echo Form::close(); ?>

</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>