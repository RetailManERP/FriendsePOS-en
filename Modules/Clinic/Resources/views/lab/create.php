
<?php $__env->startSection('title', __('clinic::lang.add_lab_order')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 >
            <i class="fas fa-flask me-2"></i><?php echo app('translator')->get('clinic::lang.add_lab_order'); ?>
        </h1>
    </section>

    <section class="content">
        <?php echo Form::open(['action' => '\Modules\Clinic\Http\Controllers\LabController@store', 'method' => 'post', 'id' => 'lab_order_form']); ?>


        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.lab_order')]); ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('patient_id', __('clinic::lang.select_patient') . ':*'); ?>

                        <?php echo Form::select('patient_id', $patients, request('patient_id'), ['class' => 'form-control select2', 'required', 'placeholder' => __('clinic::lang.select_one')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('doctor_id', __('clinic::lang.select_doctor') . ':*'); ?>

                        <?php echo Form::select('doctor_id', $doctors, request('doctor_id'), ['class' => 'form-control select2', 'required', 'placeholder' => __('clinic::lang.select_one')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('consultation_id', __('clinic::lang.consultation') . ':'); ?>

                        <?php echo Form::select('consultation_id', $consultations, request('consultation_id'), ['class' => 'form-control select2', 'placeholder' => __('clinic::lang.select_one')]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('lab_test_id', __('clinic::lang.lab_test') . ':*'); ?>

                        <?php echo Form::select('lab_test_id', $lab_tests, null, ['class' => 'form-control select2', 'required', 'placeholder' => __('clinic::lang.select_one')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('priority', __('clinic::lang.priority') . ':'); ?>

                        <?php echo Form::select('priority', ['normal' => __('clinic::lang.normal'), 'urgent' => __('clinic::lang.urgent'), 'emergency' => __('clinic::lang.emergency')], 'normal', ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('cost', __('clinic::lang.cost') . ':'); ?>

                        <?php echo Form::number('cost', 0, ['class' => 'form-control', 'step' => '0.01', 'min' => '0']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('notes', __('clinic::lang.notes') . ':'); ?>

                        <?php echo Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 2]); ?>

                    </div>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        <?php echo Form::close(); ?>

    </section>

    
    <div id="lab-order-footer-actions-template" class="d-none">
        <div>
            <button type="button" class="btn btn-primary" id="lab_order_save_btn">
                <i class="fas fa-save me-2"></i><?php echo app('translator')->get('messages.save'); ?>
            </button>
            <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\LabController::class, 'index']), false); ?>"
               class="btn btn-default">
                <?php echo app('translator')->get('clinic::lang.back'); ?>
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>