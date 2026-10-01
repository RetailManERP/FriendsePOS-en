
<?php $__env->startSection('title', __('gym::lang.member_details')); ?>
<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1><?php echo app('translator')->get('gym::lang.member_details'); ?></h1>
    </section>
    <section class="content">
        <?php $__env->startComponent('components.widget'); ?>
            <div class="row">
                <div class="col-md-3">
                    <img <?php if($contact->gym_member_profile_photo): ?> src="<?php echo e(asset('uploads/gym/' . $contact->gym_member_profile_photo), false); ?>" <?php else: ?> src="<?php echo e(asset('img/gym_profile.png'), false); ?>" <?php endif; ?>
                        alt="User profile picture" style="height:275px;">
                </div>
                <div class="col-md-3">
                    <h3 class="profile-username"><?php echo e($contact->name, false); ?></h3>
                    <p class="text-muted"> <?php echo app('translator')->get('gym::lang.member_id'); ?> : <?php echo e($contact->contact_id, false); ?></p>
                    <ul class="list-group list-group-unbordered mt-5">
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('business.email'); ?></b> <span class="pull-right"><?php echo e($contact->email, false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('contact.mobile'); ?></b> <span class="pull-right"><?php echo e($contact->mobile, false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('contact.alternate_contact_number'); ?></b> <span class="pull-right"><?php echo e($contact->alternate_number, false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('contact.landline'); ?></b> <span class="pull-right"><?php echo e($contact->landline, false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('lang_v1.address_line_1'); ?></b> <span class="pull-right"><?php echo e($contact->address_line_1, false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('lang_v1.address_line_2'); ?></b> <span class="pull-right"><?php echo e($contact->address_line_2, false); ?></span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('lang_v1.dob'); ?></b> <span
                                class="pull-right"><?php echo e($contact->dob ? $commonUtil->format_date($contact->dob, false, $business) : '', false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('gym::lang.age'); ?></b> <span
                                class="pull-right"><?php echo e($contact->dob ? \Carbon\Carbon::parse($contact->dob)->age . ' ' . __('gym::lang.years') : '', false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('business.city'); ?></b> <span class="pull-right"><?php echo e($contact->city, false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('business.state'); ?></b> <span class="pull-right"><?php echo e($contact->state, false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('business.country'); ?></b> <span class="pull-right"><?php echo e($contact->country, false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('business.zip_code'); ?></b> <span class="pull-right"><?php echo e($contact->zip_code, false); ?></span>
                        </li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <h3 class="profile-username">
                        <?php echo app('translator')->get('gym::lang.package_details'); ?>
                    </h3>
                    <ul class="list-group list-group-unbordered mt-4">
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('gym::lang.package'); ?></b> <span class="pull-right"><?php echo e($package->package_name ?? '', false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('gym::lang.start_date'); ?></b> <span class="pull-right">
                                <?php if(isset($package->gym_package_start_date)): ?>
                                    <?php echo e($commonUtil->format_date($package->gym_package_start_date, false, $business), false); ?>

                                    <?php
                                        $startDate = \Carbon\Carbon::parse($package->gym_package_start_date);
                                        $now = \Carbon\Carbon::now();

                                    ?>
                                    <?php if($startDate->isAfter($now)): ?>
                                        <?php
                                            $diffInDays = $startDate->diffInDays($now);
                                        ?>
                                        <span class="label bg-info"> <?php echo app('translator')->get('gym::lang.start_in'); ?> <?php echo e($diffInDays, false); ?>

                                            <?php echo app('translator')->get('gym::lang.days'); ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('gym::lang.end_date'); ?></b> <span class="pull-right">
                                <?php if(isset($package->gym_package_end_date)): ?>
                                    <?php echo e($commonUtil->format_date($package->gym_package_end_date, false, $business), false); ?>

                                    <?php
                                        $daysLeft = \Carbon\Carbon::parse($package->gym_package_end_date)->diffInDays(
                                            \Carbon\Carbon::now(),
                                        );
                                    ?>

                                    <?php
                                        $startDate = \Carbon\Carbon::parse($package->gym_package_start_date);
                                        $now = \Carbon\Carbon::now();

                                    ?>
                                    <?php if($startDate->isAfter($now)): ?>
                                        <?php
                                            $diffInDays = $startDate->diffInDays($now);
                                        ?>
                                        <span class="label bg-info"> <?php echo app('translator')->get('gym::lang.start_in'); ?> <?php echo e($diffInDays, false); ?>

                                            <?php echo app('translator')->get('gym::lang.days'); ?></span>
                                    <?php elseif($package->gym_package_end_date < $now): ?>
                                        <span class="label tw-bg-red-400"> <?php echo app('translator')->get('gym::lang.expired'); ?></span>
                                    <?php else: ?>
                                        <span class="label bg-info"> <?php echo app('translator')->get('gym::lang.in'); ?> <?php echo e($daysLeft, false); ?>

                                            <?php echo app('translator')->get('gym::lang.days'); ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </span>
                        </li>
                    </ul>
                    <h3 class="profile-username">
                        <?php echo app('translator')->get('gym::lang.upcoming_class'); ?>
                    </h3>
                    <ul class="list-group list-group-unbordered mt-4">
                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item">
                                <b><?php echo e($class->name, false); ?></b> <span class="pull-right"><?php echo e(\Carbon::createFromTimestamp(strtotime($class->start_time))->format('h:i A'), false); ?> -
                                    <?php echo e(\Carbon::createFromTimestamp(strtotime($class->end_time))->format('h:i A'), false); ?></span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.widget'); ?>
            <h3 class="profile-username text-center">
                <?php echo app('translator')->get('gym::lang.diet_plan'); ?>
            </h3>
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group list-group-unbordered mt-5">
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('gym::lang.morning'); ?></b> <span class="pull-right"><?php echo e($diets->morning ?? '', false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('gym::lang.breakfast'); ?></b> <span class="pull-right"><?php echo e($diets->breakfast ?? '', false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('gym::lang.before_lunch'); ?></b> <span class="pull-right"><?php echo e($diets->before_lunch ?? '', false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('gym::lang.lunch'); ?></b> <span class="pull-right"><?php echo e($diets->lunch ?? '', false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('gym::lang.afternoon'); ?></b> <span class="pull-right"><?php echo e($diets->afternoon ?? '', false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('gym::lang.evening'); ?></b> <span class="pull-right"><?php echo e($diets->evening ?? '', false); ?></span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group list-group-unbordered mt-5">
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('gym::lang.dinner'); ?></b> <span class="pull-right"><?php echo e($diets->dinner ?? '', false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('gym::lang.before_sleep'); ?></b> <span class="pull-right"><?php echo e($diets->before_sleep ?? '', false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('gym::lang.before_workout'); ?></b> <span class="pull-right"><?php echo e($diets->before_workout ?? '', false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('gym::lang.after_workout'); ?></b> <span class="pull-right"><?php echo e($diets->after_workout ?? '', false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('gym::lang.remarks'); ?></b> <span class="pull-right"><?php echo e($diets->remarks ?? '', false); ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.widget'); ?>
            <h3 class="profile-username text-center">
                <?php echo app('translator')->get('gym::lang.health_record'); ?>
            </h3>
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
                                <td><?php echo e($commonUtil->format_date($record->date, false, $business), false); ?></td>
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

        <?php $__env->startComponent('components.widget'); ?>
            <h3 class="profile-username text-center">
                <?php echo app('translator')->get('gym::lang.attendance'); ?>
            </h3>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="attendances_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('gym::lang.date'); ?></th>
                            <th><?php echo app('translator')->get('gym::lang.in_time'); ?></th>
                            <th><?php echo app('translator')->get('gym::lang.out_time'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(isset($attendance->date) ? $commonUtil->format_date($attendance->date, false, $business) : '', false); ?>

                                </td>
                                <td><?php echo e(isset($attendance->in_time) ? \Carbon::createFromTimestamp(strtotime($attendance->in_time))->format('h:i A') : '', false); ?></td>
                                <td><?php echo e(isset($attendance->out_time) ? \Carbon::createFromTimestamp(strtotime($attendance->out_time))->format('h:i A') : '', false); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php echo $__env->renderComponent(); ?>
    </section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function() {

            $("form#create_health_tracking").validate();

            $('#health_table').DataTable({

            });

            $('#attendances_table').DataTable({

            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('gym::layouts.scanner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>