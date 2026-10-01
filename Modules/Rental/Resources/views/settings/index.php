

<?php $__env->startSection('title', __('rental::lang.rental_settings')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('rental::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">
    <div class="row">
        
        <div class="col-md-8">
            <?php echo Form::open(['url' => action([\Modules\Rental\Http\Controllers\RentalSettingController::class, 'update']), 'method' => 'post', 'id' => 'rental_settings_form']); ?>


            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('rental::lang.general_settings')]); ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('agreement_prefix', __('rental::lang.agreement_prefix') . ':'); ?>

                            <?php echo Form::text('agreement_prefix', $settings['agreement_prefix'] ?? 'RA', ['class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('return_prefix', __('rental::lang.return_prefix') . ':'); ?>

                            <?php echo Form::text('return_prefix', $settings['return_prefix'] ?? 'RR', ['class' => 'form-control']); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('damage_report_prefix', __('rental::lang.damage_report_prefix') . ':'); ?>

                            <?php echo Form::text('damage_report_prefix', $settings['damage_report_prefix'] ?? 'DR', ['class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('default_rental_period', __('rental::lang.default_rental_period') . ':'); ?>

                            <?php echo Form::select('default_rental_period', [
                                'hourly' => __('rental::lang.hourly'),
                                'daily' => __('rental::lang.daily'),
                                'weekly' => __('rental::lang.weekly'),
                                'monthly' => __('rental::lang.monthly'),
                            ], $settings['default_rental_period'] ?? 'daily', ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                        </div>
                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.widget', ['class' => 'box-info', 'title' => __('rental::lang.default_requirements')]); ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('require_deposit', 1, ($settings['require_deposit'] ?? 1), ['class' => 'input-icheck']); ?>

                                <?php echo app('translator')->get('rental::lang.require_deposit_by_default'); ?>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('require_id_verification', 1, ($settings['require_id_verification'] ?? 0), ['class' => 'input-icheck']); ?>

                                <?php echo app('translator')->get('rental::lang.require_id_verification'); ?>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('require_agreement_signature', 1, ($settings['require_agreement_signature'] ?? 0), ['class' => 'input-icheck']); ?>

                                <?php echo app('translator')->get('rental::lang.require_agreement_signature'); ?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('auto_calculate_late_fees', 1, ($settings['auto_calculate_late_fees'] ?? 1), ['class' => 'input-icheck']); ?>

                                <?php echo app('translator')->get('rental::lang.auto_calculate_late_fees'); ?>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('send_reminder_before_due', 1, ($settings['send_reminder_before_due'] ?? 0), ['class' => 'input-icheck']); ?>

                                <?php echo app('translator')->get('rental::lang.send_due_reminders'); ?>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('send_overdue_notification', 1, ($settings['send_overdue_notification'] ?? 0), ['class' => 'input-icheck']); ?>

                                <?php echo app('translator')->get('rental::lang.send_overdue_notifications'); ?>
                            </label>
                        </div>
                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.widget', ['class' => 'box-warning', 'title' => __('rental::lang.default_terms')]); ?>
                <div class="form-group">
                    <?php echo Form::label('default_terms_and_conditions', __('rental::lang.default_rental_terms') . ':'); ?>

                    <?php echo Form::textarea('default_terms_and_conditions', $settings['default_terms_and_conditions'] ?? '', ['class' => 'form-control', 'rows' => 6]); ?>

                </div>
            <?php echo $__env->renderComponent(); ?>

            <?php echo Form::close(); ?>


            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('rental.manage_settings')): ?>
                <div id="rental-settings-footer-actions-template" class="d-none">
                    <button type="submit" class="btn btn-primary" form="rental_settings_form"><i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?></button>
                </div>
            <?php endif; ?>
        </div>

        
        <div class="col-md-4">
            <?php $__env->startComponent('components.widget', ['class' => 'box-success', 'title' => __('rental::lang.rental_categories')]); ?>
                <?php $__env->slot('tool'); ?>
                    <div class="box-tools">
                        <button type="button" class="btn btn-primary btn-xs" id="add_category_btn">
                            <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
                        </button>
                    </div>
                <?php $__env->endSlot(); ?>

                
                <div id="add_category_form" style="display:none;" class="mb-15">
                    <?php echo Form::open(['url' => action([\Modules\Rental\Http\Controllers\RentalSettingController::class, 'storeCategory']), 'method' => 'post', 'class' => 'category_form']); ?>

                    <div class="input-group">
                        <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __('rental::lang.category_name')]); ?>

                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i></button>
                            <button type="button" class="btn btn-default cancel_category_form"><i class="fas fa-times"></i></button>
                        </span>
                    </div>
                    <?php echo Form::close(); ?>

                </div>

                <table class="table table-condensed" id="categories_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('rental::lang.name'); ?></th>
                            <th><?php echo app('translator')->get('rental::lang.status'); ?></th>
                            <th style="width:80px;"><?php echo app('translator')->get('messages.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <span class="category_name_display"><?php echo e($category->name, false); ?></span>
                                <div class="edit_category_form" style="display:none;">
                                    <?php echo Form::open(['url' => action([\Modules\Rental\Http\Controllers\RentalSettingController::class, 'updateCategory'], [$category->id]), 'method' => 'put', 'class' => 'category_form']); ?>

                                    <div class="input-group input-group-sm">
                                        <?php echo Form::text('name', $category->name, ['class' => 'form-control', 'required']); ?>

                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-success btn-xs"><i class="fas fa-check"></i></button>
                                            <button type="button" class="btn btn-default btn-xs cancel_edit_category"><i class="fas fa-times"></i></button>
                                        </span>
                                    </div>
                                    <?php echo Form::close(); ?>

                                </div>
                            </td>
                            <td>
                                <span class="badge badge-<?php echo e($category->is_active ? 'success' : 'danger', false); ?>">
                                    <?php echo e($category->is_active ? __('rental::lang.active') : __('rental::lang.inactive'), false); ?>

                                </span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-xs edit_category"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-danger btn-xs delete_category" data-href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalSettingController::class, 'destroyCategory'], [$category->id]), false); ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        // Show/hide add category form
        $('#add_category_btn').click(function() {
            $('#add_category_form').slideDown();
        });
        $('.cancel_category_form').click(function() {
            $('#add_category_form').slideUp();
        });

        // Edit category inline
        $(document).on('click', '.edit_category', function() {
            var row = $(this).closest('tr');
            row.find('.category_name_display').hide();
            row.find('.edit_category_form').show();
        });
        $(document).on('click', '.cancel_edit_category', function() {
            var row = $(this).closest('tr');
            row.find('.edit_category_form').hide();
            row.find('.category_name_display').show();
        });

        // AJAX submit for category forms
        $(document).on('submit', '.category_form', function(e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                method: form.attr('method') == 'put' ? 'PUT' : 'POST',
                url: form.attr('action'),
                data: form.serialize(),
                dataType: 'json',
                success: function(result) {
                    if (result.success) {
                        toastr.success(result.msg);
                        location.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                }
            });
        });

        // Delete category
        $(document).on('click', '.delete_category', function() {
            var href = $(this).data('href');
            swal({
                title: LANG.sure,
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        method: 'DELETE',
                        url: href,
                        dataType: 'json',
                        success: function(result) {
                            if (result.success) {
                                toastr.success(result.msg);
                                location.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
            });
        });

    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>