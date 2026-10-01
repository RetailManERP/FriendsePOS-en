
<?php $__env->startSection('title', __('clinic::lang.enter_result')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 >
            <i class="fas fa-flask me-2"></i><?php echo app('translator')->get('clinic::lang.enter_result'); ?> - <?php echo e($labOrder->order_ref, false); ?>

        </h1>
    </section>

    <section class="content">
        <?php echo Form::open(['action' => ['\Modules\Clinic\Http\Controllers\LabController@saveResult', $labOrder->id], 'method' => 'post']); ?>


        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.lab_order')]); ?>
            <div class="row">
                <div class="col-md-6">
                    <table class="table no-margin">
                        <tr><th><?php echo app('translator')->get('clinic::lang.lab_order_ref'); ?></th><td><?php echo e($labOrder->order_ref, false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.patient'); ?></th><td><?php echo e($labOrder->patient->first_name ?? '', false); ?> <?php echo e($labOrder->patient->last_name ?? '', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.doctor'); ?></th><td><?php echo e($labOrder->doctor->first_name ?? '', false); ?> <?php echo e($labOrder->doctor->last_name ?? '', false); ?></td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table no-margin">
                        <tr><th><?php echo app('translator')->get('clinic::lang.test_name'); ?></th><td><?php echo e($labOrder->labTest->name ?? '', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.normal_range'); ?></th><td><?php echo e($labOrder->labTest->normal_range ?? '-', false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('clinic::lang.sample_type'); ?></th><td><?php echo e($labOrder->labTest->sample_type ?? '-', false); ?></td></tr>
                    </table>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.result')]); ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('result_value', __('clinic::lang.result_value') . ':*'); ?>

                        <?php echo Form::text('result_value', $labOrder->result_value, ['class' => 'form-control', 'required', 'placeholder' => __('clinic::lang.result_value')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('result_status', __('clinic::lang.status') . ':*'); ?>

                        <?php echo Form::select('result_status', ['result_available' => __('clinic::lang.result_available'), 'delivered' => __('clinic::lang.delivered')], $labOrder->result_status ?? 'result_available', ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('result_notes', __('clinic::lang.result_notes') . ':'); ?>

                        <?php echo Form::textarea('result_notes', $labOrder->result_notes, ['class' => 'form-control', 'rows' => 3]); ?>

                    </div>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i><?php echo app('translator')->get('clinic::lang.save_result'); ?>
                </button>
                <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\LabController::class, 'index']), false); ?>"
                   class="btn btn-default">
                    <?php echo app('translator')->get('clinic::lang.back'); ?>
                </a>
            </div>
        </div>

        <?php echo Form::close(); ?>

    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>