

<?php $__env->startSection('title', __('clinic::lang.insurance_providers')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('clinic::lang.insurance_providers'); ?>
        <small><?php echo app('translator')->get('clinic::lang.manage_insurance'); ?></small>
    </h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#insuranceModal" id="add_insurance_btn">
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get('clinic::lang.add_insurance_provider'); ?>
                </button>
            </div>
        <?php $__env->endSlot(); ?>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="insurance_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('clinic::lang.name'); ?></th>
                        <th><?php echo app('translator')->get('clinic::lang.code'); ?></th>
                        <th><?php echo app('translator')->get('clinic::lang.contact_person'); ?></th>
                        <th><?php echo app('translator')->get('clinic::lang.phone'); ?></th>
                        <th><?php echo app('translator')->get('clinic::lang.email'); ?></th>
                        <th><?php echo app('translator')->get('clinic::lang.status'); ?></th>
                        <th><?php echo app('translator')->get('messages.action'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_18 = true; $__currentLoopData = $providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><?php echo e($provider->name, false); ?></td>
                            <td><?php echo e($provider->code, false); ?></td>
                            <td><?php echo e($provider->contact_person, false); ?></td>
                            <td><?php echo e($provider->phone, false); ?></td>
                            <td><?php echo e($provider->email, false); ?></td>
                            <td>
                                <?php if($provider->is_active): ?>
                                    <span class="badge bg-success"><?php echo app('translator')->get('clinic::lang.active'); ?></span>
                                <?php else: ?>
                                    <span class="badge bg-danger"><?php echo app('translator')->get('clinic::lang.inactive'); ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <button class="btn btn-xs btn-primary edit-insurance"
                                    data-id="<?php echo e($provider->id, false); ?>"
                                    data-name="<?php echo e($provider->name, false); ?>"
                                    data-code="<?php echo e($provider->code, false); ?>"
                                    data-contact="<?php echo e($provider->contact_person, false); ?>"
                                    data-phone="<?php echo e($provider->phone, false); ?>"
                                    data-email="<?php echo e($provider->email, false); ?>"
                                    data-address="<?php echo e($provider->address, false); ?>"
                                    data-coverage="<?php echo e($provider->coverage_details, false); ?>"
                                    data-active="<?php echo e($provider->is_active, false); ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-xs btn-danger delete-insurance" data-id="<?php echo e($provider->id, false); ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr>
                            <td colspan="7" class="text-center"><?php echo app('translator')->get('lang_v1.no_data'); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>
</section>


<div class="modal fade" id="insuranceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?php echo Form::open(['id' => 'insurance_form']); ?>

            <input type="hidden" name="insurance_id" id="insurance_id">
            <div class="modal-header">
                <h4 class="modal-title" id="insuranceModalLabel"><?php echo app('translator')->get('clinic::lang.add_insurance_provider'); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('name', __('clinic::lang.name') . ':*'); ?>

                            <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'id' => 'ins_name']); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('code', __('clinic::lang.code') . ':'); ?>

                            <?php echo Form::text('code', null, ['class' => 'form-control', 'id' => 'ins_code']); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('contact_person', __('clinic::lang.contact_person') . ':'); ?>

                            <?php echo Form::text('contact_person', null, ['class' => 'form-control', 'id' => 'ins_contact']); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('phone', __('clinic::lang.phone') . ':'); ?>

                            <?php echo Form::text('phone', null, ['class' => 'form-control', 'id' => 'ins_phone']); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('email', __('clinic::lang.email') . ':'); ?>

                            <?php echo Form::email('email', null, ['class' => 'form-control', 'id' => 'ins_email']); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('is_active', __('clinic::lang.status') . ':'); ?>

                            <?php echo Form::select('is_active', [1 => __('clinic::lang.active'), 0 => __('clinic::lang.inactive')], 1, ['class' => 'form-control', 'id' => 'ins_active']); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('address', __('clinic::lang.address') . ':'); ?>

                            <?php echo Form::textarea('address', null, ['class' => 'form-control', 'rows' => 2, 'id' => 'ins_address']); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo Form::label('coverage_details', __('clinic::lang.coverage_details') . ':'); ?>

                            <?php echo Form::textarea('coverage_details', null, ['class' => 'form-control', 'rows' => 3, 'id' => 'ins_coverage']); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
                <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.save'); ?></button>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        // Move modal to body to escape content-wrapper stacking context
        $('#insuranceModal').appendTo('body');

        // Add Insurance
        $('#add_insurance_btn').on('click', function() {
            $('#insurance_form')[0].reset();
            $('#insurance_id').val('');
            $('#insuranceModalLabel').text("<?php echo app('translator')->get('clinic::lang.add_insurance_provider'); ?>");
        });

        // Edit Insurance
        $(document).on('click', '.edit-insurance', function() {
            var btn = $(this);
            $('#insurance_id').val(btn.data('id'));
            $('#ins_name').val(btn.data('name'));
            $('#ins_code').val(btn.data('code'));
            $('#ins_contact').val(btn.data('contact'));
            $('#ins_phone').val(btn.data('phone'));
            $('#ins_email').val(btn.data('email'));
            $('#ins_address').val(btn.data('address'));
            $('#ins_coverage').val(btn.data('coverage'));
            $('#ins_active').val(btn.data('active'));
            $('#insuranceModalLabel').text("<?php echo app('translator')->get('clinic::lang.edit_insurance_provider'); ?>");
            $('#insuranceModal').modal('show');
        });

        // Save Insurance
        $('#insurance_form').on('submit', function(e) {
            e.preventDefault();
            var id = $('#insurance_id').val();
            var url = id
                ? "<?php echo e(url('clinic/insurance'), false); ?>/" + id
                : "<?php echo e(action([\Modules\Clinic\Http\Controllers\InsuranceController::class, 'store']), false); ?>";

            $.ajax({
                url: url,
                type: id ? 'PUT' : 'POST',
                data: $(this).serialize(),
                success: function(result) {
                    if(result.success) {
                        toastr.success(result.msg);
                        $('#insuranceModal').modal('hide');
                        location.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                }
            });
        });

        // Delete Insurance
        $(document).on('click', '.delete-insurance', function() {
            var id = $(this).data('id');
            swal({
                title: LANG.sure,
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((confirm) => {
                if(confirm) {
                    $.ajax({
                        url: "<?php echo e(url('clinic/insurance'), false); ?>/" + id,
                        type: 'DELETE',
                        success: function(result) {
                            if(result.success) {
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