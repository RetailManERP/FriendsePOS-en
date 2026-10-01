

<?php $__env->startSection('title', __('rental::lang.edit_rental_item')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('rental::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">
    <?php echo Form::open(['url' => action([\Modules\Rental\Http\Controllers\RentalItemController::class, 'update'], [$item->id]), 'method' => 'put', 'files' => true, 'id' => 'rental_item_form']); ?>


    <div class="row">
        <div class="col-md-8">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('rental::lang.edit_rental_item')]); ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('name', __('rental::lang.name') . ':*'); ?>

                            <?php echo Form::text('name', $item->name, ['class' => 'form-control', 'required']); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('rental_sku', __('rental::lang.rental_sku') . ':'); ?>

                            <?php echo Form::text('rental_sku', $item->rental_sku, ['class' => 'form-control']); ?>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('product_id', __('rental::lang.linked_product') . ':'); ?>

                            <?php echo Form::select('product_id', ['' => __('messages.please_select')] + $products->toArray(), $item->product_id, ['class' => 'form-control select2']); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('rental_category_id', __('rental::lang.rental_category') . ':'); ?>

                            <?php echo Form::select('rental_category_id', ['' => __('messages.please_select')] + $categories->toArray(), $item->rental_category_id, ['class' => 'form-control select2']); ?>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('location_id', __('rental::lang.location') . ':'); ?>

                            <?php echo Form::select('location_id', ['' => __('rental::lang.all_locations')] + $business_locations->toArray(), $item->location_id, ['class' => 'form-control select2']); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('serial_number', __('rental::lang.serial_number') . ':'); ?>

                            <?php echo Form::text('serial_number', $item->serial_number, ['class' => 'form-control']); ?>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('total_quantity', __('rental::lang.total_quantity') . ':*'); ?>

                            <?php echo Form::number('total_quantity', $item->total_quantity, ['class' => 'form-control', 'required', 'min' => 1]); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('condition', __('rental::lang.condition') . ':'); ?>

                            <?php echo Form::select('condition', [
                                'good' => __('rental::lang.condition_good'),
                                'fair' => __('rental::lang.condition_fair'),
                                'poor' => __('rental::lang.condition_poor'),
                                'needs_repair' => __('rental::lang.condition_needs_repair'),
                            ], $item->condition, ['class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('image', __('rental::lang.image') . ':'); ?>

                            <?php echo Form::file('image', ['class' => 'form-control', 'accept' => 'image/*']); ?>

                            <?php if($item->image): ?>
                                <small class="text-muted">Current: <?php echo e($item->image, false); ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo Form::label('description', __('rental::lang.description') . ':'); ?>

                    <?php echo Form::textarea('description', $item->description, ['class' => 'form-control', 'rows' => 3]); ?>

                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>

        <div class="col-md-4">
            <?php $__env->startComponent('components.widget', ['class' => 'box-success', 'title' => __('rental::lang.pricing')]); ?>
                <div class="form-group">
                    <?php echo Form::label('hourly_rate', __('rental::lang.hourly_rate') . ':'); ?>

                    <?php echo Form::text('hourly_rate', number_format($item->hourly_rate, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number']); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('daily_rate', __('rental::lang.daily_rate') . ':*'); ?>

                    <?php echo Form::text('daily_rate', number_format($item->daily_rate, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'required']); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('weekly_rate', __('rental::lang.weekly_rate') . ':'); ?>

                    <?php echo Form::text('weekly_rate', number_format($item->weekly_rate, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number']); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('monthly_rate', __('rental::lang.monthly_rate') . ':'); ?>

                    <?php echo Form::text('monthly_rate', number_format($item->monthly_rate, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number']); ?>

                </div>
                <hr>
                <div class="form-group">
                    <?php echo Form::label('deposit_amount', __('rental::lang.deposit_amount') . ':'); ?>

                    <?php echo Form::text('deposit_amount', number_format($item->deposit_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number']); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('late_fee_per_day', __('rental::lang.late_fee_per_day') . ':'); ?>

                    <?php echo Form::text('late_fee_per_day', number_format($item->late_fee_per_day, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number']); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('damage_fee', __('rental::lang.damage_fee') . ':'); ?>

                    <?php echo Form::text('damage_fee', number_format($item->damage_fee, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number']); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('replacement_cost', __('rental::lang.replacement_cost') . ':'); ?>

                    <?php echo Form::text('replacement_cost', number_format($item->replacement_cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number']); ?>

                </div>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.widget', ['class' => 'box-warning', 'title' => __('rental::lang.settings')]); ?>
                <div class="checkbox">
                    <label><?php echo Form::checkbox('requires_deposit', 1, $item->requires_deposit); ?> <?php echo app('translator')->get('rental::lang.requires_deposit'); ?></label>
                </div>
                <div class="checkbox">
                    <label><?php echo Form::checkbox('is_available', 1, $item->is_available); ?> <?php echo app('translator')->get('rental::lang.available_items'); ?></label>
                </div>
                <div class="checkbox">
                    <label><?php echo Form::checkbox('requires_id_verification', 1, $item->requires_id_verification); ?> <?php echo app('translator')->get('rental::lang.requires_id_verification'); ?></label>
                </div>
                <div class="checkbox">
                    <label><?php echo Form::checkbox('requires_agreement_signature', 1, $item->requires_agreement_signature); ?> <?php echo app('translator')->get('rental::lang.requires_agreement_signature'); ?></label>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <?php echo Form::close(); ?>


    <div id="rental-item-footer-actions-template" class="d-none">
        <button type="submit" class="btn btn-primary" form="rental_item_form"><i class="fas fa-save"></i> <?php echo app('translator')->get('messages.update'); ?></button>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>