
<?php $__env->startSection('title', __('essentials::lang.essentials_n_hrm_settings')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('essentials::layouts.nav_hrm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('essentials::lang.essentials_n_hrm_settings'); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <?php echo Form::open(['action' => '\Modules\Essentials\Http\Controllers\EssentialsSettingsController@update', 'method' => 'post', 'id' => 'essentials_settings_form']); ?>

    <div class="container-fluid">
        <div class="row pos-tab-container">
            <div class="col-2 pos-tab-menu">
                <div class="list-group">
                    <a href="#" class="list-group-item text-center active"><?php echo app('translator')->get('essentials::lang.leave'); ?></a>
                    <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('essentials::lang.payroll'); ?></a>
                    <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('essentials::lang.attendance'); ?></a>
                    <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('essentials::lang.sales_target'); ?></a>
                    <a href="#" class="list-group-item text-center"><?php echo app('translator')->get('essentials::lang.essentials'); ?></a>
                </div>
            </div>
            <div class="col-10 pos-tab">
                <?php echo $__env->make('essentials::settings.partials.leave_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('essentials::settings.partials.payroll_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('essentials::settings.partials.attendance_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('essentials::settings.partials.sales_target_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('essentials::settings.partials.essentials_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
        <div class="row mt-3">
        </div>
    </div>
    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready( function () {
        tinymce.init({
            selector: 'textarea#leave_instructions',
        });

        $('#essentials_settings_form').validate({ 
            ignore: [],
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>