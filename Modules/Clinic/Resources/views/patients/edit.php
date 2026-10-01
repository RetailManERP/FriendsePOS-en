
<?php $__env->startSection('title', __('clinic::lang.edit_patient')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 >
            <i class="fas fa-user-edit me-2"></i><?php echo app('translator')->get('clinic::lang.edit_patient'); ?> - <?php echo e($patient->first_name, false); ?> <?php echo e($patient->last_name, false); ?>

        </h1>
    </section>

    <section class="content">
        <?php echo Form::open(['action' => ['\Modules\Clinic\Http\Controllers\PatientController@update', $patient->id], 'method' => 'put', 'id' => 'patient_form']); ?>


        
        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.personal_info')]); ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('first_name', __('clinic::lang.first_name') . ':*'); ?>

                        <?php echo Form::text('first_name', $patient->first_name, ['class' => 'form-control', 'required', 'placeholder' => __('clinic::lang.first_name')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('last_name', __('clinic::lang.last_name') . ':*'); ?>

                        <?php echo Form::text('last_name', $patient->last_name, ['class' => 'form-control', 'required', 'placeholder' => __('clinic::lang.last_name')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('date_of_birth', __('clinic::lang.date_of_birth') . ':'); ?>

                        <?php echo Form::date('date_of_birth', $patient->date_of_birth, ['class' => 'form-control']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('gender', __('clinic::lang.gender') . ':*'); ?>

                        <?php echo Form::select('gender', ['' => __('clinic::lang.select_one'), 'male' => __('clinic::lang.male'), 'female' => __('clinic::lang.female'), 'other' => __('clinic::lang.other')], $patient->gender, ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('blood_group', __('clinic::lang.blood_group') . ':'); ?>

                        <?php echo Form::select('blood_group', ['' => __('clinic::lang.select_one'), 'A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'AB+' => 'AB+', 'AB-' => 'AB-', 'O+' => 'O+', 'O-' => 'O-'], $patient->blood_group, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('phone', __('clinic::lang.phone') . ':*'); ?>

                        <?php echo Form::text('phone', $patient->phone, ['class' => 'form-control', 'required', 'placeholder' => __('clinic::lang.phone')]); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('email', __('clinic::lang.email') . ':'); ?>

                        <?php echo Form::email('email', $patient->email, ['class' => 'form-control', 'placeholder' => __('clinic::lang.email')]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('address', __('clinic::lang.address') . ':'); ?>

                        <?php echo Form::textarea('address', $patient->address, ['class' => 'form-control', 'rows' => 2, 'placeholder' => __('clinic::lang.address')]); ?>

                    </div>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        
        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.emergency_contact')]); ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('emergency_contact_name', __('clinic::lang.emergency_contact_name') . ':'); ?>

                        <?php echo Form::text('emergency_contact_name', $patient->emergency_contact_name, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('emergency_contact_phone', __('clinic::lang.emergency_contact_phone') . ':'); ?>

                        <?php echo Form::text('emergency_contact_phone', $patient->emergency_contact_phone, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('emergency_contact_relation', __('clinic::lang.emergency_contact_relation') . ':'); ?>

                        <?php echo Form::text('emergency_contact_relation', $patient->emergency_contact_relation, ['class' => 'form-control']); ?>

                    </div>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        
        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.medical_info')]); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('medical_history', __('clinic::lang.medical_history') . ':'); ?>

                        <?php echo Form::textarea('medical_history', $patient->medical_history, ['class' => 'form-control', 'rows' => 3]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('allergies', __('clinic::lang.allergies') . ':'); ?>

                        <?php echo Form::textarea('allergies', $patient->allergies, ['class' => 'form-control', 'rows' => 3]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('chronic_conditions', __('clinic::lang.chronic_conditions') . ':'); ?>

                        <?php echo Form::textarea('chronic_conditions', $patient->chronic_conditions, ['class' => 'form-control', 'rows' => 3]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('current_medications', __('clinic::lang.current_medications') . ':'); ?>

                        <?php echo Form::textarea('current_medications', $patient->current_medications, ['class' => 'form-control', 'rows' => 3]); ?>

                    </div>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i><?php echo app('translator')->get('messages.update'); ?>
                </button>
                <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\PatientController::class, 'index']), false); ?>"
                   class="btn btn-default">
                    <?php echo app('translator')->get('clinic::lang.back'); ?>
                </a>
            </div>
        </div>

        <?php echo Form::close(); ?>

    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>