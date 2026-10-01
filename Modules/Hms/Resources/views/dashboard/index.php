
<?php $__env->startSection('title', __('hms::lang.hms')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('hms::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content no-print">
        
        <div class="row">
            <div class="col-md-2 col-sm-4 col-xs-6">
                <?php $__env->startComponent('components.widget'); ?>
                    <div class="text-center">
                        <h4 class="fw-bold text-success"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $today_revenue, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></h4>
                        <p class="text-muted small"><?php echo app('translator')->get('hms::lang.today_revenue'); ?></p>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6">
                <?php $__env->startComponent('components.widget'); ?>
                    <div class="text-center">
                        <h4 class="fw-bold text-primary"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $month_revenue, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></h4>
                        <p class="text-muted small"><?php echo app('translator')->get('hms::lang.monthly_revenue'); ?></p>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6">
                <?php $__env->startComponent('components.widget'); ?>
                    <div class="text-center">
                        <h4 class="fw-bold text-info"><?php echo e($occupancy_rate, false); ?>%</h4>
                        <p class="text-muted small"><?php echo app('translator')->get('hms::lang.occupancy_rate'); ?></p>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6">
                <?php $__env->startComponent('components.widget'); ?>
                    <div class="text-center">
                        <h4 class="fw-bold text-warning"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $adr, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></h4>
                        <p class="text-muted small"><?php echo app('translator')->get('hms::lang.avg_daily_rate'); ?></p>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6">
                <?php $__env->startComponent('components.widget'); ?>
                    <div class="text-center">
                        <h4 class="fw-bold text-danger"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $revpar, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></h4>
                        <p class="text-muted small"><?php echo app('translator')->get('hms::lang.revpar'); ?></p>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6">
                <?php $__env->startComponent('components.widget'); ?>
                    <div class="text-center">
                        <h4 class="fw-bold text-success"><?php echo e($checked_in_count, false); ?></h4>
                        <p class="text-muted small"><?php echo app('translator')->get('hms::lang.checked_in_now'); ?></p>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                

                <?php $__env->startComponent('components.widget'); ?>
                    <table class="table no-margin">
                        <tr>
                            <th><?php echo app('translator')->get('hms::lang.rooms_booked_today'); ?></th>
                            <td><?php echo e($room_count->booked_rooms ?? 0, false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('hms::lang.pending_rooms_today'); ?></th>
                            <td><?php echo e($room_count->pending_rooms ?? 0, false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('hms::lang.available_rooms_today'); ?></th>
                            <td><?php echo e($room_count->unbooked_rooms ?? 0, false); ?></td>
                        </tr>
                    </table>
                <?php echo $__env->renderComponent(); ?>

                <?php $__env->startComponent('components.widget', ['title' => __('hms::lang.available_rooms_by_type')]); ?>
                    <table class="table no-margin">
                        <?php $__currentLoopData = $unbooked_rooms_by_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $types): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th><?php echo e($types->room_type, false); ?></th>
                                <td><?php echo e($types->unbooked_count ?? 0, false); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                <?php echo $__env->renderComponent(); ?>
                <?php $__env->startComponent('components.widget', ['title' => __('hms::lang.guests')]); ?>
                    <table class="table no-margin">
                        <tr>
                            <th><?php echo app('translator')->get('hms::lang.staying_tonight'); ?></th>
                            <td><?php echo e($guest_count_tonight->sum('adult_guests') + $guest_count_tonight->sum('child_guests'), false); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo app('translator')->get('hms::lang.adults'); ?></td>
                            <td><?php echo e($guest_count_tonight->sum('adult_guests') ?? 0, false); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo app('translator')->get('hms::lang.childrens'); ?></td>
                            <td><?php echo e($guest_count_tonight->sum('child_guests') ?? 0, false); ?></td>
                        </tr>
                    </table>
                    <table class="table no-margin">
                        <tr>
                            <th><?php echo app('translator')->get('hms::lang.arriving_today'); ?></th>
                            <td><?php echo e($arrive_today->sum('adult_guests') + $arrive_today->sum('child_guests'), false); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo app('translator')->get('hms::lang.adults'); ?></td>
                            <td><?php echo e($arrive_today->sum('adult_guests') ?? 0, false); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo app('translator')->get('hms::lang.childrens'); ?></td>
                            <td><?php echo e($arrive_today->sum('child_guests') ?? 0, false); ?></td>
                        </tr>
                    </table>
                    <table class="table no-margin">
                        <tr>
                            <th><?php echo app('translator')->get('hms::lang.leaving_today'); ?></th>
                            <td><?php echo e($leave_today->sum('adult_guests') + $leave_today->sum('child_guests'), false); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo app('translator')->get('hms::lang.adults'); ?></td>
                            <td><?php echo e($leave_today->sum('adult_guests') ?? 0, false); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo app('translator')->get('hms::lang.childrens'); ?></td>
                            <td><?php echo e($leave_today->sum('child_guests') ?? 0, false); ?></td>
                        </tr>
                    </table>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-4">

                <?php $__env->startComponent('components.widget'); ?>
                    <div class="card">
                        <div class="card-header p-0">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#cn_1" data-bs-toggle="tab" aria-expanded="true">
                                        <?php echo app('translator')->get('hms::lang.arrivals'); ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#cn_2" data-bs-toggle="tab" aria-expanded="true">
                                        <?php echo app('translator')->get('hms::lang.departures'); ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#cn_3" data-bs-toggle="tab" aria-expanded="true">
                                        <?php echo app('translator')->get('hms::lang.latest'); ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="cn_1">
                                <?php $__empty_18 = true; $__currentLoopData = $today_arrivales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                    <?php echo $__env->make('hms::dashboard.partial.booking_info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                    <?php echo app('translator')->get('hms::lang.no_arrivals_today'); ?>
                                <?php endif; ?>
                            </div>
                            <div class="tab-pane fade" id="cn_2">
                                <?php $__empty_18 = true; $__currentLoopData = $today_departure; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                    <?php echo $__env->make('hms::dashboard.partial.booking_info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                    <?php echo app('translator')->get('hms::lang.no_departures_today'); ?>
                                <?php endif; ?>
                            </div>
                            <div class="tab-pane fade" id="cn_3">
                                <?php $__empty_18 = true; $__currentLoopData = $latest_bookig; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                    <?php echo $__env->make('hms::dashboard.partial.booking_info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                    <?php echo app('translator')->get('hms::lang.no_latest'); ?>
                                <?php endif; ?>
                            </div>
                            </div>
                        </div>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>

            <div class="col-md-4">

                <?php $__env->startComponent('components.widget'); ?>
                    <div class="card">
                        <div class="card-header p-0">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#chat_1" data-bs-toggle="tab" aria-expanded="true">
                                        <?php echo app('translator')->get('hms::lang.upcoming_bookings'); ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#chat_2" data-bs-toggle="tab" aria-expanded="true">
                                        <?php echo app('translator')->get('hms::lang.past_bookings'); ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="chat_1">
                                    <?php echo $booking_chart->container(); ?>

                                </div>
                                <div class="tab-pane fade" id="chat_2">
                                    <?php echo $past_booking_chart->container(); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php echo $__env->renderComponent(); ?>


            </div>
        </div>

        
        <div class="row">
            <div class="col-md-6">
                <?php $__env->startComponent('components.widget', ['title' => __('hms::lang.revenue_by_room_type')]); ?>
                    <table class="table table-striped no-margin">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('hms::lang.room_type'); ?></th>
                                <th><?php echo app('translator')->get('hms::lang.bookings'); ?></th>
                                <th><?php echo app('translator')->get('hms::lang.revenue'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_18 = true; $__currentLoopData = $revenue_by_room_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rrt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                <tr>
                                    <td><?php echo e($rrt->room_type, false); ?></td>
                                    <td><?php echo e($rrt->booking_count, false); ?></td>
                                    <td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $rrt->total_revenue, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                <tr>
                                    <td colspan="3" class="text-center text-muted"><?php echo app('translator')->get('hms::lang.no_data'); ?></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-6">
                <?php $__env->startComponent('components.widget', ['title' => __('hms::lang.monthly_summary')]); ?>
                    <table class="table no-margin">
                        <tr>
                            <th><?php echo app('translator')->get('hms::lang.total_rooms'); ?></th>
                            <td><?php echo e($total_rooms, false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('hms::lang.monthly_revenue'); ?></th>
                            <td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $month_revenue, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('hms::lang.monthly_collected'); ?></th>
                            <td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $month_paid, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('hms::lang.monthly_outstanding'); ?></th>
                            <td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $month_revenue - $month_paid, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('hms::lang.avg_daily_rate'); ?></th>
                            <td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $adr, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('hms::lang.revpar'); ?></th>
                            <td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $revpar, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                        </tr>
                    </table>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('javascript'); ?>
        <?php echo $booking_chart->script(); ?>

        <?php echo $past_booking_chart->script(); ?>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>