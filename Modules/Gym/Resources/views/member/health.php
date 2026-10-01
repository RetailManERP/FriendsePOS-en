
<?php $__env->startSection('title', __('gym::lang.members')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('gym::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black"> <?php echo app('translator')->get('gym::lang.health'); ?>
            <small><?php echo e($member->name, false); ?></small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php $__env->startComponent('components.widget'); ?>
            <div class="row">
                <div class="col-md-12">
                    <?php echo Form::open([
                        'url' => action([\Modules\Gym\Http\Controllers\MemberController::class, 'store_health'], ['id' => $member->id]),
                        'method' => 'post',
                        'id' => 'create_health_tracking',
                    ]); ?>


                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('date', __('lang_v1.date') . ':'); ?>

                                <?php echo Form::text('date', null, [
                                    'class' => 'form-control health_date',
                                    'placeholder' => __('lang_v1.date'),
                                    'readonly',
                                    'required',
                                ]); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('neck', __('gym::lang.neck') . ':'); ?>

                                <?php echo Form::number('neck', null, ['class' => 'form-control', 'step' => '0.01']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('left_arm', __('gym::lang.left_arm') . ':'); ?>

                                <?php echo Form::number('left_arm', null, ['class' => 'form-control', 'step' => '0.01']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('right_arm', __('gym::lang.right_arm') . ':'); ?>

                                <?php echo Form::number('right_arm', null, ['class' => 'form-control', 'step' => '0.01']); ?>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('chest', __('gym::lang.chest') . ':'); ?>

                                <?php echo Form::number('chest', null, ['class' => 'form-control', 'step' => '0.01']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('upper_waist', __('gym::lang.upper_waist') . ':'); ?>

                                <?php echo Form::number('upper_waist', null, ['class' => 'form-control', 'step' => '0.01']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('lower_waist', __('gym::lang.lower_waist') . ':'); ?>

                                <?php echo Form::number('lower_waist', null, ['class' => 'form-control', 'step' => '0.01']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('hips', __('gym::lang.hips') . ':'); ?>

                                <?php echo Form::number('hips', null, ['class' => 'form-control', 'step' => '0.01']); ?>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('left_thigh', __('gym::lang.left_thigh') . ':'); ?>

                                <?php echo Form::number('left_thigh', null, ['class' => 'form-control', 'step' => '0.01']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('right_thigh', __('gym::lang.right_thigh') . ':'); ?>

                                <?php echo Form::number('right_thigh', null, ['class' => 'form-control', 'step' => '0.01']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('calf', __('gym::lang.calf') . ':'); ?>

                                <?php echo Form::number('calf', null, ['class' => 'form-control', 'step' => '0.01']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('height', __('gym::lang.height') . ':*'); ?>

                                <?php echo Form::number('height', null, ['class' => 'form-control', 'required', 'step' => '0.1']); ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('weight', __('gym::lang.weight') . ':*'); ?>

                                <?php echo Form::number('weight', null, ['class' => 'form-control', 'required', 'step' => '0.1']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('shoulders', __('gym::lang.shoulders') . ':'); ?>

                                <?php echo Form::number('shoulders', null, ['class' => 'form-control', 'step' => '0.01']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('body_fat_percentage', __('gym::lang.body_fat_percentage') . ':'); ?>

                                <?php echo Form::number('body_fat_percentage', null, ['class' => 'form-control', 'step' => '0.01']); ?>

                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('visceral_fat', __('gym::lang.visceral_fat') . ':'); ?>

                                <?php echo Form::number('visceral_fat', null, ['class' => 'form-control', 'step' => '0.01']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('subcutaneous_fat', __('gym::lang.subcutaneous_fat') . ':'); ?>

                                <?php echo Form::number('subcutaneous_fat', null, ['class' => 'form-control', 'step' => '0.01']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('bmi', __('gym::lang.bmi') . ':'); ?>

                                <?php echo Form::number('bmi', null, ['class' => 'form-control', 'step' => '0.01']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('muscle_mass_percentage', __('gym::lang.muscle_mass_percentage') . ':'); ?>

                                <?php echo Form::number('muscle_mass_percentage', null, ['class' => 'form-control', 'step' => '0.01']); ?>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('remarks', __('gym::lang.remarks') . ':'); ?>

                                <?php echo Form::textarea('remarks', null, ['class' => 'form-control', 'rows' => 3]); ?>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 text-center">
                        <button type="submit" name="submit_action" value="save"
                            class="btn btn-primary tw-text-white"><?php echo app('translator')->get('messages.save'); ?></button>
                    </div>

                    <?php echo Form::close(); ?>

                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>
    </section>
    <section class="content-header">
        <h3><?php echo app('translator')->get('gym::lang.previous_health_record_of'); ?> <?php echo e($member->name, false); ?></h3>
    </section>
    <section class="content">
        <?php $__env->startComponent('components.widget'); ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="health_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('gym::lang.date'); ?></th>
                            <th><?php echo app('translator')->get('gym::lang.weight'); ?></th>
                            <th><?php echo app('translator')->get('gym::lang.height'); ?></th>
                            <th><?php echo app('translator')->get('gym::lang.bmi'); ?></th>
                            <th><?php echo app('translator')->get('gym::lang.body_fat_percentage'); ?></th>
                            <th><?php echo app('translator')->get('gym::lang.muscle_mass_percentage'); ?></th>
                            <th><?php echo app('translator')->get('gym::lang.neck'); ?></th>
                            <th><?php echo app('translator')->get('gym::lang.left_arm'); ?></th>
                            <th><?php echo app('translator')->get('gym::lang.right_arm'); ?></th>
                            <th><?php echo app('translator')->get('gym::lang.chest'); ?></th>
                            <th><?php echo app('translator')->get('gym::lang.upper_waist'); ?></th>
                            <th><?php echo app('translator')->get('gym::lang.lower_waist'); ?></th>
                            <th><?php echo app('translator')->get('gym::lang.hips'); ?></th>
                            <th><?php echo app('translator')->get('gym::lang.left_thigh'); ?></th>
                            <th><?php echo app('translator')->get('gym::lang.right_thigh'); ?></th>
                            <th><?php echo app('translator')->get('gym::lang.calf'); ?></th>
                            <th><?php echo app('translator')->get('gym::lang.shoulders'); ?></th>
                            <th><?php echo app('translator')->get('gym::lang.visceral_fat'); ?></th>
                            <th><?php echo app('translator')->get('gym::lang.subcutaneous_fat'); ?></th>
                            <th><?php echo app('translator')->get('gym::lang.remarks'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $health; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(\Carbon::createFromTimestamp(strtotime($record->date))->format(session('business.date_format')), false); ?></td>
                                <td><?php echo e($record->weight, false); ?></td>
                                <td><?php echo e($record->height, false); ?></td>
                                <td><?php echo e($record->bmi, false); ?></td>
                                <td><?php echo e($record->body_fat_percentage, false); ?></td>
                                <td><?php echo e($record->muscle_mass_percentage, false); ?></td>
                                <td><?php echo e($record->neck, false); ?></td>
                                <td><?php echo e($record->left_arm, false); ?></td>
                                <td><?php echo e($record->right_arm, false); ?></td>
                                <td><?php echo e($record->chest, false); ?></td>
                                <td><?php echo e($record->upper_waist, false); ?></td>
                                <td><?php echo e($record->lower_waist, false); ?></td>
                                <td><?php echo e($record->hips, false); ?></td>
                                <td><?php echo e($record->left_thigh, false); ?></td>
                                <td><?php echo e($record->right_thigh, false); ?></td>
                                <td><?php echo e($record->calf, false); ?></td>
                                <td><?php echo e($record->shoulders, false); ?></td>
                                <td><?php echo e($record->visceral_fat, false); ?></td>
                                <td><?php echo e($record->subcutaneous_fat, false); ?></td>
                                <td><?php echo e($record->remarks, false); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php echo $__env->renderComponent(); ?>

    </section>

    <!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            var currentDate = new Date();
            var currentDateTime = moment(currentDate).format(moment_date_format);

            $('.health_date').datepicker({
                defaultDate: currentDateTime,
            }).datepicker('setDate', currentDateTime);

            $("form#create_health_tracking").validate();

            $('#health_table').DataTable({

            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>