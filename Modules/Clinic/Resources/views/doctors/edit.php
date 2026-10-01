
<?php $__env->startSection('title', __('clinic::lang.edit_doctor')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 >
            <i class="fas fa-user-md me-2"></i><?php echo app('translator')->get('clinic::lang.edit_doctor'); ?> - <?php echo e($doctor->first_name, false); ?> <?php echo e($doctor->last_name, false); ?>

        </h1>
    </section>

    <section class="content">
        <?php echo Form::open(['action' => ['\Modules\Clinic\Http\Controllers\DoctorController@update', $doctor->id], 'method' => 'put', 'id' => 'doctor_form']); ?>


        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.doctor') . ' ' . __('clinic::lang.personal_info')]); ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('first_name', __('clinic::lang.first_name') . ':*'); ?>

                        <?php echo Form::text('first_name', $doctor->first_name, ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('last_name', __('clinic::lang.last_name') . ':*'); ?>

                        <?php echo Form::text('last_name', $doctor->last_name, ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('user_id', __('clinic::lang.select_user') . ':'); ?>

                        <?php echo Form::select('user_id', $users, $doctor->user_id, ['class' => 'form-control select2', 'placeholder' => __('clinic::lang.select_one')]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('specialization_id', __('clinic::lang.specialization') . ':'); ?>

                        <?php echo Form::select('specialization_id', $specializations, $doctor->specialization_id, ['class' => 'form-control select2', 'placeholder' => __('clinic::lang.select_one')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('qualification', __('clinic::lang.qualification') . ':'); ?>

                        <?php echo Form::text('qualification', $doctor->qualification, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('license_number', __('clinic::lang.license_number') . ':'); ?>

                        <?php echo Form::text('license_number', $doctor->license_number, ['class' => 'form-control']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('consultation_fee', __('clinic::lang.consultation_fee') . ':'); ?>

                        <?php echo Form::number('consultation_fee', $doctor->consultation_fee, ['class' => 'form-control', 'step' => '0.01', 'min' => '0']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('follow_up_fee', __('clinic::lang.follow_up_fee') . ':'); ?>

                        <?php echo Form::number('follow_up_fee', $doctor->follow_up_fee, ['class' => 'form-control', 'step' => '0.01', 'min' => '0']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('avg_consultation_minutes', __('clinic::lang.avg_consultation_minutes') . ':'); ?>

                        <?php echo Form::number('avg_consultation_minutes', $doctor->avg_consultation_minutes, ['class' => 'form-control', 'min' => '5']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('phone', __('clinic::lang.phone') . ':'); ?>

                        <?php echo Form::text('phone', $doctor->phone, ['class' => 'form-control']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('email', __('clinic::lang.email') . ':'); ?>

                        <?php echo Form::email('email', $doctor->email, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('status', __('clinic::lang.status') . ':'); ?>

                        <?php echo Form::select('status', ['active' => 'Active', 'inactive' => 'Inactive', 'on_leave' => 'On Leave'], $doctor->status, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('bio', __('clinic::lang.bio') . ':'); ?>

                        <?php echo Form::textarea('bio', $doctor->bio, ['class' => 'form-control', 'rows' => 2]); ?>

                    </div>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.working_hours')]); ?>
            <?php $hours = $doctor->working_hours ?? []; ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th><?php echo app('translator')->get('clinic::lang.start_time'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.end_time'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(ucfirst($day), false); ?></td>
                            <td><?php echo Form::time("working_hours[$day][start]", $hours[$day]['start'] ?? '08:00', ['class' => 'form-control']); ?></td>
                            <td><?php echo Form::time("working_hours[$day][end]", $hours[$day]['end'] ?? '17:00', ['class' => 'form-control']); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php echo $__env->renderComponent(); ?>

        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i><?php echo app('translator')->get('messages.update'); ?>
                </button>
                <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\DoctorController::class, 'index']), false); ?>"
                   class="btn btn-default">
                    <?php echo app('translator')->get('clinic::lang.back'); ?>
                </a>
            </div>
        </div>

        <?php echo Form::close(); ?>

    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>