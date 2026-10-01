
<?php $__env->startSection('title', __('clinic::lang.add_doctor')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 >
            <i class="fas fa-user-md me-2"></i><?php echo app('translator')->get('clinic::lang.add_doctor'); ?>
        </h1>
    </section>

    <section class="content">
        <?php echo Form::open(['action' => '\Modules\Clinic\Http\Controllers\DoctorController@store', 'method' => 'post', 'id' => 'doctor_form']); ?>


        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.doctor') . ' ' . __('clinic::lang.personal_info')]); ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('first_name', __('clinic::lang.first_name') . ':*'); ?>

                        <?php echo Form::text('first_name', null, ['class' => 'form-control', 'required', 'placeholder' => __('clinic::lang.first_name')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('last_name', __('clinic::lang.last_name') . ':*'); ?>

                        <?php echo Form::text('last_name', null, ['class' => 'form-control', 'required', 'placeholder' => __('clinic::lang.last_name')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('user_id', __('clinic::lang.select_user') . ':'); ?>

                        <?php echo Form::select('user_id', $users, null, ['class' => 'form-control select2', 'placeholder' => __('clinic::lang.select_one')]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('specialization_id', __('clinic::lang.specialization') . ':'); ?>

                        <?php echo Form::select('specialization_id', $specializations, null, ['class' => 'form-control select2', 'placeholder' => __('clinic::lang.select_one')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('qualification', __('clinic::lang.qualification') . ':'); ?>

                        <?php echo Form::text('qualification', null, ['class' => 'form-control', 'placeholder' => __('clinic::lang.qualification')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('license_number', __('clinic::lang.license_number') . ':'); ?>

                        <?php echo Form::text('license_number', null, ['class' => 'form-control', 'placeholder' => __('clinic::lang.license_number')]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('consultation_fee', __('clinic::lang.consultation_fee') . ':'); ?>

                        <?php echo Form::number('consultation_fee', 0, ['class' => 'form-control', 'step' => '0.01', 'min' => '0']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('follow_up_fee', __('clinic::lang.follow_up_fee') . ':'); ?>

                        <?php echo Form::number('follow_up_fee', 0, ['class' => 'form-control', 'step' => '0.01', 'min' => '0']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('avg_consultation_minutes', __('clinic::lang.avg_consultation_minutes') . ':'); ?>

                        <?php echo Form::number('avg_consultation_minutes', 15, ['class' => 'form-control', 'min' => '5']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('phone', __('clinic::lang.phone') . ':'); ?>

                        <?php echo Form::text('phone', null, ['class' => 'form-control', 'placeholder' => __('clinic::lang.phone')]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('email', __('clinic::lang.email') . ':'); ?>

                        <?php echo Form::email('email', null, ['class' => 'form-control', 'placeholder' => __('clinic::lang.email')]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('bio', __('clinic::lang.bio') . ':'); ?>

                        <?php echo Form::textarea('bio', null, ['class' => 'form-control', 'rows' => 2]); ?>

                    </div>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.working_hours')]); ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.today'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.start_time'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.end_time'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(ucfirst($day), false); ?></td>
                            <td><?php echo Form::time("working_hours[$day][start]", '08:00', ['class' => 'form-control']); ?></td>
                            <td><?php echo Form::time("working_hours[$day][end]", '17:00', ['class' => 'form-control']); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php echo $__env->renderComponent(); ?>

        <?php echo Form::close(); ?>


        
        <div id="doctor-footer-actions-template" class="d-none">
            <div>
                <button type="button" class="btn btn-primary" id="doctor_save_btn">
                    <i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>
                </button>
                <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\DoctorController::class, 'index']), false); ?>"
                   class="btn btn-default" id="doctor_back_btn">
                    <i class="fas fa-arrow-left"></i> <?php echo app('translator')->get('clinic::lang.back'); ?>
                </a>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>