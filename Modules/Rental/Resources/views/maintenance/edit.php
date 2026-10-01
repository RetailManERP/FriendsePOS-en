

<?php $__env->startSection('title', isset($maintenance) ? __('rental::lang.edit_maintenance') : __('rental::lang.add_maintenance')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('rental::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">
    <?php
        $form_url = isset($maintenance)
            ? action([\Modules\Rental\Http\Controllers\RentalMaintenanceController::class, 'update'], [$maintenance->id])
            : action([\Modules\Rental\Http\Controllers\RentalMaintenanceController::class, 'store']);
        $form_method = isset($maintenance) ? 'put' : 'post';
    ?>

    <?php echo Form::open(['url' => $form_url, 'method' => $form_method, 'id' => 'maintenance_form']); ?>


    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => isset($maintenance) ? __('rental::lang.edit_maintenance') : __('rental::lang.add_maintenance')]); ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('rental_item_id', __('rental::lang.item') . ':*'); ?>

                            <?php echo Form::select('rental_item_id', $rental_items, isset($maintenance) ? $maintenance->rental_item_id : null, ['class' => 'form-control select2', 'required', 'style' => 'width:100%', 'placeholder' => __('messages.please_select')]); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('maintenance_type', __('rental::lang.maintenance_type') . ':*'); ?>

                            <?php echo Form::select('maintenance_type', [
                                'routine' => __('rental::lang.maint_type_routine'),
                                'repair' => __('rental::lang.maint_type_repair'),
                                'inspection' => __('rental::lang.maint_type_inspection'),
                                'cleaning' => __('rental::lang.maint_type_cleaning'),
                                'replacement' => __('rental::lang.maint_type_replacement'),
                            ], isset($maintenance) ? $maintenance->maintenance_type : null, ['class' => 'form-control select2', 'required', 'style' => 'width:100%', 'placeholder' => __('messages.please_select')]); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('priority', __('rental::lang.priority') . ':*'); ?>

                            <?php echo Form::select('priority', [
                                'low' => __('rental::lang.priority_low'),
                                'normal' => __('rental::lang.priority_normal'),
                                'high' => __('rental::lang.priority_high'),
                                'urgent' => __('rental::lang.priority_urgent'),
                            ], isset($maintenance) ? $maintenance->priority : 'normal', ['class' => 'form-control select2', 'required', 'style' => 'width:100%']); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('scheduled_date', __('rental::lang.scheduled_date') . ':*'); ?>

                            <?php echo Form::text('scheduled_date', isset($maintenance) && $maintenance->scheduled_date ? $maintenance->scheduled_date->format('m/d/Y') : null, ['class' => 'form-control datepicker', 'required', 'readonly']); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('cost', __('rental::lang.cost') . ':'); ?>

                            <?php echo Form::text('cost', isset($maintenance) ? number_format($maintenance->cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : 0, ['class' => 'form-control input_number']); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('assigned_to', __('rental::lang.assigned_to') . ':'); ?>

                            <?php echo Form::select('assigned_to', $users, isset($maintenance) ? $maintenance->assigned_to : null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('vendor_name', __('rental::lang.vendor_name') . ':'); ?>

                            <?php echo Form::text('vendor_name', isset($maintenance) ? $maintenance->vendor_name : null, ['class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('vendor_contact', __('rental::lang.vendor_contact') . ':'); ?>

                            <?php echo Form::text('vendor_contact', isset($maintenance) ? $maintenance->vendor_contact : null, ['class' => 'form-control']); ?>

                        </div>
                    </div>
                    <?php if(isset($maintenance)): ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('status', __('rental::lang.status') . ':'); ?>

                            <?php echo Form::select('status', [
                                'scheduled' => __('rental::lang.scheduled'),
                                'in_progress' => __('rental::lang.in_progress'),
                                'completed' => __('rental::lang.maintenance_completed'),
                                'cancelled' => __('rental::lang.cancelled'),
                            ], $maintenance->status, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('description', __('rental::lang.description') . ':'); ?>

                            <?php echo Form::textarea('description', isset($maintenance) ? $maintenance->description : null, ['class' => 'form-control', 'rows' => 3]); ?>

                        </div>
                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <?php echo Form::close(); ?>


    <div id="rental-maintenance-footer-actions-template" class="d-none">
        <button type="submit" class="btn btn-primary" form="maintenance_form"><i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?></button>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        if ($.fn.datepicker) {
            $('.datepicker').datepicker({
                autoclose: true,
                format: 'mm/dd/yyyy'
            });
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>