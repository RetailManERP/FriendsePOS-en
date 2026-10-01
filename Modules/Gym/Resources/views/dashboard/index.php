
<?php $__env->startSection('title', __('gym::lang.gym') . ' - ' . __('gym::lang.dashboard')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('gym::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content no-print">

        
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo app('translator')->get('gym::lang.total_member'); ?></span>
                        <span class="info-box-number"><?php echo e($total_members ?? 0, false); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="fa fas fa-user-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo app('translator')->get('gym::lang.active_member'); ?></span>
                        <span class="info-box-number"><?php echo e($active_members ?? 0, false); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-yellow">
                    <span class="info-box-icon"><i class="fa fas fa-user-plus"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo app('translator')->get('gym::lang.new_member_this_month'); ?></span>
                        <span class="info-box-number"><?php echo e($registered_this_month ?? 0, false); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="fa fas fa-user-times"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo app('translator')->get('gym::lang.expired_members'); ?></span>
                        <span class="info-box-number"><?php echo e($expired_members ?? 0, false); ?></span>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fas fa-money-bill-wave"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo app('translator')->get('gym::lang.total_revenue'); ?></span>
                        <span class="info-box-number"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_revenue, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fas fa-chart-line"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo app('translator')->get('gym::lang.monthly_revenue'); ?></span>
                        <span class="info-box-number"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $monthly_revenue, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fas fa-exclamation-triangle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo app('translator')->get('gym::lang.total_due'); ?></span>
                        <span class="info-box-number"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_due, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fas fa-clipboard-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo app('translator')->get('gym::lang.today_checkins'); ?></span>
                        <span class="info-box-number"><?php echo e($today_total_checkins ?? 0, false); ?></span>
                        <span class="info-box-text" style="font-size:11px;"><?php echo app('translator')->get('gym::lang.avg_daily'); ?>: <?php echo e(round($avg_daily_attendance), false); ?></span>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-purple"><i class="fa fas fa-box-open"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo app('translator')->get('gym::lang.total_package'); ?></span>
                        <span class="info-box-number"><?php echo e($total_packages ?? 0, false); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-maroon"><i class="fa fas fa-chalkboard-teacher"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo app('translator')->get('gym::lang.total_classes'); ?></span>
                        <span class="info-box-number"><?php echo e($total_classes ?? 0, false); ?></span>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-md-6">
                <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('gym::lang.popular_packages')]); ?>
                    <?php if(!empty($package_stats) && count($package_stats)): ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo app('translator')->get('gym::lang.package'); ?></th>
                                    <th><?php echo app('translator')->get('gym::lang.subscriptions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $package_stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $pkg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($i + 1, false); ?></td>
                                        <td><?php echo e($pkg->name, false); ?></td>
                                        <td><span class="label bg-blue"><?php echo e($pkg->total_subscriptions, false); ?></span></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-muted text-center"><?php echo app('translator')->get('gym::lang.no_records_found'); ?></p>
                    <?php endif; ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-6">
                <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('gym::lang.gender_distribution')]); ?>
                    <?php if(!empty($gender_stats) && count($gender_stats)): ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('gym::lang.gender'); ?></th>
                                    <th><?php echo app('translator')->get('gym::lang.count'); ?></th>
                                    <th>%</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $genderTotal = $gender_stats->sum(); ?>
                                <?php $__currentLoopData = $gender_stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gender => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <?php if($gender == 'male'): ?>
                                                <i class="fa fa-mars text-blue"></i> <?php echo app('translator')->get('gym::lang.male'); ?>
                                            <?php elseif($gender == 'female'): ?>
                                                <i class="fa fa-venus text-pink"></i> <?php echo app('translator')->get('gym::lang.female'); ?>
                                            <?php else: ?>
                                                <i class="fa fa-genderless"></i> <?php echo app('translator')->get('gym::lang.other'); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($count, false); ?></td>
                                        <td><?php echo e($genderTotal > 0 ? round(($count / $genderTotal) * 100, 1) : 0, false); ?>%</td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-muted text-center"><?php echo app('translator')->get('gym::lang.no_records_found'); ?></p>
                    <?php endif; ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>

        
        <div class="row">
            <div class="col-md-12">
                <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('gym::lang.membership_growth')]); ?>
                    <?php if(!empty($monthly_growth) && count($monthly_growth)): ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <?php $__currentLoopData = $monthly_growth; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <th class="text-center">
                                            <?php echo e(\Carbon\Carbon::createFromDate($mg->year, $mg->month, 1)->format('M Y'), false); ?>

                                        </th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php $__currentLoopData = $monthly_growth; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td class="text-center">
                                            <span class="label bg-green"><?php echo e($mg->count, false); ?></span>
                                        </td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-muted text-center"><?php echo app('translator')->get('gym::lang.no_records_found'); ?></p>
                    <?php endif; ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>

        
        <div class="row">
            <div class="col-md-6">
                <?php $__env->startComponent('components.widget', ['class' => 'box-success', 'title' => __('gym::lang.today_attendance_summary')]); ?>
                    <div class="tab-content p-3" style="max-height: 350px; overflow-y: auto;">
                        <?php $__empty_18 = true; $__currentLoopData = $today_attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <div class="attendance-item">
                                <strong><?php echo app('translator')->get('contact.name'); ?>:</strong> <?php echo e($attendance->contact_name, false); ?> <br>
                                <strong><?php echo app('translator')->get('contact.mobile'); ?>:</strong> <?php echo e($attendance->contact_mobile, false); ?> <br>
                                <strong><?php echo app('translator')->get('gym::lang.in_time'); ?>:</strong>
                                <?php echo e(\Carbon::createFromTimestamp(strtotime($attendance->in_time))->format('h:i A'), false); ?>

                                <?php
                                    $inTime = \Carbon\Carbon::parse($attendance->date . ' ' . $attendance->in_time);
                                    $diff = $inTime->diff(\Carbon\Carbon::now());
                                    $value = $diff->h > 0 ? $diff->h : $diff->i;
                                    $unit = $diff->h > 0 ? __('gym::lang.hours_ago') : __('gym::lang.minutes_ago');
                                ?>
                                <span class="label bg-info"> <?php echo e($value, false); ?> <?php echo e($unit, false); ?></span>
                                <hr>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                            <p class="text-muted text-center"><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('gym::lang.no_one_in_side'); ?></p>
                        <?php endif; ?>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-6">
                <?php $__env->startComponent('components.widget', ['class' => 'box-warning', 'title' => __('gym::lang.expiring_soon') . ' (7 ' . __('gym::lang.days') . ')']); ?>
                    <div class="tab-content p-3" style="max-height: 350px; overflow-y: auto;">
                        <?php $__empty_18 = true; $__currentLoopData = $expiring_soon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <div class="attendance-item">
                                <strong><?php echo app('translator')->get('contact.name'); ?>:</strong> <?php echo e($value->contact_name, false); ?> <br>
                                <strong><?php echo app('translator')->get('contact.mobile'); ?>:</strong> <?php echo e($value->contact_mobile, false); ?> <br>
                                <strong><?php echo app('translator')->get('gym::lang.end_date'); ?>:</strong>
                                <?php echo e(\Carbon::createFromTimestamp(strtotime($value->gym_package_end_date))->format(session('business.date_format')), false); ?>

                                <?php
                                    $daysLeft = \Carbon\Carbon::parse($value->gym_package_end_date)->diffInDays(\Carbon\Carbon::now());
                                ?>
                                <span class="label bg-warning"> <?php echo app('translator')->get('gym::lang.in'); ?> <?php echo e($daysLeft, false); ?> <?php echo app('translator')->get('gym::lang.days'); ?></span>
                                <br>
                                <strong><?php echo app('translator')->get('gym::lang.package'); ?>:</strong> <?php echo e($value->package_name, false); ?> <br>
                                <hr>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                            <p class="text-muted text-center"><i class="fa fa-check-circle text-green"></i> <?php echo app('translator')->get('gym::lang.no_records_found'); ?></p>
                        <?php endif; ?>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>

    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>