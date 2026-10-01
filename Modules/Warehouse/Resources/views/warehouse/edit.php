
<?php $__env->startSection('title', __('warehouse::lang.edit_warehouse')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('warehouse::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('warehouse::lang.edit_warehouse'); ?></h1>
</section>

<section class="content">
    <?php echo Form::open(['route' => ['warehouse.update', $warehouse->id], 'method' => 'PUT', 'id' => 'warehouse_form']); ?>


    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('name', __('warehouse::lang.warehouse_name') . ':*'); ?>

                    <?php echo Form::text('name', $warehouse->name, ['class' => 'form-control', 'required']); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('location_id', __('warehouse::lang.warehouse_code') . ':'); ?>

                    <?php echo Form::text('location_id', $warehouse->location_id, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('warehouse_type', __('warehouse::lang.warehouse_type') . ':*'); ?>

                    <?php echo Form::select('warehouse_type', $warehouse_types, $warehouse->warehouse_type, ['class' => 'form-control select2', 'required']); ?>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('warehouse_parent_location', __('warehouse::lang.warehouse_parent_location') . ':'); ?>

                    <?php echo Form::select('warehouse_parent_location', $business_locations, $warehouse->warehouse_parent_location, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('warehouse_manager_id', __('warehouse::lang.warehouse_manager') . ':'); ?>

                    <?php echo Form::select('warehouse_manager_id', $users, $warehouse->warehouse_manager_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <br>
                    <div class="checkbox">
                        <label>
                            <?php echo Form::checkbox('is_active', 1, $warehouse->is_active); ?> <?php echo app('translator')->get('warehouse::lang.active'); ?>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('landmark', __('warehouse::lang.warehouse_address') . ':'); ?>

                    <?php echo Form::textarea('landmark', $warehouse->landmark, ['class' => 'form-control', 'rows' => 3]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('city', __('warehouse::lang.warehouse_city') . ':*'); ?>

                    <?php echo Form::text('city', $warehouse->city, ['class' => 'form-control', 'required']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('state', __('warehouse::lang.warehouse_state') . ':*'); ?>

                    <?php echo Form::text('state', $warehouse->state, ['class' => 'form-control', 'required']); ?>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('country', __('warehouse::lang.warehouse_country') . ':*'); ?>

                    <?php echo Form::text('country', $warehouse->country, ['class' => 'form-control', 'required']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('zip_code', __('warehouse::lang.warehouse_zip') . ':*'); ?>

                    <?php echo Form::text('zip_code', $warehouse->zip_code, ['class' => 'form-control', 'required']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('mobile', __('warehouse::lang.warehouse_phone') . ':'); ?>

                    <?php echo Form::text('mobile', $warehouse->mobile, ['class' => 'form-control']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('email', __('warehouse::lang.warehouse_email') . ':'); ?>

                    <?php echo Form::email('email', $warehouse->email, ['class' => 'form-control']); ?>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('warehouse_total_area', __('warehouse::lang.total_area') . ':'); ?>

                    <?php echo Form::number('warehouse_total_area', $warehouse->warehouse_total_area, ['class' => 'form-control', 'step' => '0.01']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('warehouse_usable_area', __('warehouse::lang.usable_area') . ':'); ?>

                    <?php echo Form::number('warehouse_usable_area', $warehouse->warehouse_usable_area, ['class' => 'form-control', 'step' => '0.01']); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('warehouse_notes', __('warehouse::lang.warehouse_notes') . ':'); ?>

                    <?php echo Form::textarea('warehouse_notes', $warehouse->warehouse_notes, ['class' => 'form-control', 'rows' => 2]); ?>

                </div>
            </div>
        </div>

    <?php echo $__env->renderComponent(); ?>

    <?php echo Form::close(); ?>

</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>