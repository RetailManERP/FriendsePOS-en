
<?php $__env->startSection('title', __('superadmin::lang.superadmin') . ' | Coupon'); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('superadmin::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?php echo app('translator')->get('superadmin::lang.add_new_coupon'); ?> </h3>
            </div>
            <div class="box-body">
                <?php echo Form::open([
                    'url' => action([\Modules\Superadmin\Http\Controllers\CouponController::class, 'store']),
                    'method' => 'post',
                    'id' => 'create_coupon',
                ]); ?>

                <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('coupon_code', __('superadmin::lang.coupon_code') . '*'); ?>

                        <?php echo Form::text('coupon_code', null, [
                            'class' => 'form-control',
                            'required',
                            'placeholder' => __('superadmin::lang.coupon_code'),
                        ]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('discount_type', __('superadmin::lang.discount_type') . '*'); ?>

                        <?php echo Form::select('discount_type', $discount_types, null, [
                            'class' => 'form-control',
                            'required',
                            'placeholder' => __('messages.please_select'),
                        ]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('discount', __('superadmin::lang.discount') . '*'); ?>

                        <?php echo Form::number('discount', null, [
                            'class' => 'form-control',
                            'required',
                            'placeholder' => __('superadmin::lang.discount'),
                            'step' => '0.01'
                        ]); ?>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('expiry_date', __('superadmin::lang.expiry_date')); ?>

                        <?php echo Form::text('expiry_date', null, [
                            'class' => 'form-control',
                            'placeholder' => __('superadmin::lang.expiry_date'),
                            'readonly',
                            'id' => 'expiry_date',
                        ]); ?>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('applied_on_packages', __('superadmin::lang.applied_on_packages')); ?>

                        <?php echo Form::select('applied_on_packages[]', $packages, '', [
                            'class' => 'form-control select2',
                            'multiple',
                        ]); ?>

                        <small><?php echo app('translator')->get('superadmin::lang.applied_on_packages_help_text'); ?></small>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('applied_on_business', __('superadmin::lang.applied_on_business')); ?>

                        <?php echo Form::select('applied_on_business[]', $businesses, '', [
                            'class' => 'form-control select2',
                            'multiple',
                        ]); ?>

                        <small><?php echo app('translator')->get('superadmin::lang.applied_on_business_help_text'); ?></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('is_active', 1, true, 
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__('superadmin::lang.is_active'), false); ?>

                      </label>
                    </div>
                </div>
                </div>

                <?php echo Form::close(); ?>

            </div>
        </div>

    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#expiry_date').datepicker({
        autoclose: true
        });

        $("form#create_coupon").validate();
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>