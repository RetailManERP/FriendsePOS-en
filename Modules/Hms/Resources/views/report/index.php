
<?php $__env->startSection('title', __('hms::lang.reports')); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('hms::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 > <?php echo app('translator')->get('hms::lang.reports'); ?>
        </h1>
        <p><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('hms::lang.report_help_text'); ?> </p>
    </section>
    <!-- Main content -->
    <section class="content">
       
        <?php $__env->startComponent('components.filters', ['title' => __('report.filters'), 'closed' => false]); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::open([
                        'url' => action([\Modules\Hms\Http\Controllers\HmsReportController::class, 'index']),
                        'method' => 'get',
                    ]); ?>

                    <div class="form-group">
                        <?php echo Form::label('date_to', __('hms::lang.date_to') . ':'); ?>

                        <?php echo Form::text('date_to', request('date_to'), [
                            'class' => 'form-control date_to',
                            'placeholder' => __('hms::lang.date_to'),
                            'readonly',
                            'required',
                            'id' => 'date_to',
                        ]); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('date_from', __('hms::lang.date_from') . ':'); ?>

                        <?php echo Form::text('date_from', request('date_from'), [
                            'class' => 'form-control date_from',
                            'placeholder' => __('hms::lang.date_from'),
                            'readonly',
                            'required',
                            'id' => 'date_from',
                        ]); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-sm btn-primary mt-4"><?php echo app('translator')->get('hms::lang.generate'); ?></button>
                    </div>
                </div>
                <?php echo Form::close(); ?>

            </div>
        <?php echo $__env->renderComponent(); ?>

        <?php if(request()->has('date_to') && request()->has('date_from')): ?>

            <?php $__env->startComponent('components.widget'); ?>
                <div class="row">
                    <hr>
                    <div class="col-md-3">
                        <strong><?php echo app('translator')->get('hms::lang.total_bookings_received'); ?>:</strong> <br>
                        <?php echo e($total_booking->total_count, false); ?>

                    </div>
                    <div class="col-md-3">
                        <strong><?php echo app('translator')->get('hms::lang.total_guests'); ?>:</strong> <br>
                        <?php echo e($total_booking->total_guest, false); ?>

                    </div>
                    <div class="col-md-3">
                        <strong><?php echo app('translator')->get('hms::lang.total_nights_booked'); ?>:</strong> <br>
                        <?php echo e($total_booking->total_nights, false); ?>

                    </div>
                    <div class="col-md-3">
                        <strong><?php echo app('translator')->get('hms::lang.total_amount'); ?>:</strong> <br>
                        <span class="display_currency" data-currency_symbol="true"> <?php echo e($total_booking->total_amount, false); ?>

                        </span>
                    </div>
                </div>
                <div class="row mt-5">
                    <hr>
                    <div class="col-md-3">
                        <strong><?php echo app('translator')->get('hms::lang.total_confirmed_bookings'); ?>:</strong> <br>
                        <?php echo e($total_confirmed_booking->total_count, false); ?>

                    </div>
                    <div class="col-md-3">
                        <strong><?php echo app('translator')->get('hms::lang.total_confirmed_guests'); ?>:</strong> <br>
                        <?php echo e($total_confirmed_booking->total_guest, false); ?>

                    </div>
                    <div class="col-md-3">
                        <strong><?php echo app('translator')->get('hms::lang.total_confirmed_nights'); ?></strong> <br>
                        <?php echo e($total_confirmed_booking->total_nights, false); ?>

                    </div>
                    <div class="col-md-3">
                        <strong><?php echo app('translator')->get('hms::lang.total_amount'); ?>:</strong> <br>
                        <span class="display_currency" data-currency_symbol="true">
                            <?php echo e($total_confirmed_booking->total_amount, false); ?> </span>
                    </div>
                </div>
                <div class="row mt-5">
                    <hr>
                    <div class="col-md-3">
                        <strong><?php echo app('translator')->get('hms::lang.total_cancelled_bookings'); ?>:</strong> <br>
                        <?php echo e($total_cancelled_booking->total_count, false); ?>

                    </div>
                    <div class="col-md-3">
                        <strong><?php echo app('translator')->get('hms::lang.total_cancelled_guests'); ?>:</strong> <br>
                        <?php echo e($total_cancelled_booking->total_guest, false); ?>

                    </div>
                    <div class="col-md-3">
                        <strong><?php echo app('translator')->get('hms::lang.total_cancelled_nights'); ?></strong> <br>
                        <?php echo e($total_cancelled_booking->total_nights, false); ?>

                    </div>
                    <div class="col-md-3">
                        <strong><?php echo app('translator')->get('hms::lang.total_amount'); ?>:</strong> <br>
                        <span class="display_currency" data-currency_symbol="true">
                            <?php echo e($total_cancelled_booking->total_amount, false); ?> </span>
                    </div>
                </div>
                <div class="row mt-5">
                    <hr>
                    <div class="col-md-3">
                        <strong><?php echo app('translator')->get('hms::lang.total_pending_bookings'); ?>:</strong> <br>
                        <?php echo e($total_pending_booking->total_count, false); ?>

                    </div>
                    <div class="col-md-3">
                        <strong><?php echo app('translator')->get('hms::lang.total_pending_guests'); ?>:</strong> <br>
                        <?php echo e($total_pending_booking->total_guest, false); ?>

                    </div>
                    <div class="col-md-3">
                        <strong><?php echo app('translator')->get('hms::lang.total_pending_nights'); ?></strong> <br>
                        <?php echo e($total_pending_booking->total_nights, false); ?>

                    </div>
                    <div class="col-md-3">
                        <strong><?php echo app('translator')->get('hms::lang.total_amount'); ?>:</strong> <br>
                        <span class="display_currency" data-currency_symbol="true">
                            <?php echo e($total_pending_booking->total_amount, false); ?> </span>
                    </div>
                </div>
                <div class="row">
                    <hr>
                    <div class="col-md-3">
                        <strong><?php echo app('translator')->get('hms::lang.adults_guests'); ?>:</strong> <br>
                        <?php echo e($total_confirmed_booking->total_adult_guest, false); ?>


                        <?php if($total_confirmed_booking->total_guest != 0): ?>
                            (<?php echo e(($total_confirmed_booking->total_adult_guest / $total_confirmed_booking->total_guest) * 100, false); ?>

                            %)
                        <?php endif; ?>
                    </div>
                    <div class="col-md-3">
                        <strong><?php echo app('translator')->get('hms::lang.children_guests'); ?>:</strong> <br>
                        <?php echo e($total_confirmed_booking->total_childs_guest, false); ?>


                        <?php if($total_confirmed_booking->total_guest != 0): ?>
                            (<?php echo e(($total_confirmed_booking->total_childs_guest / $total_confirmed_booking->total_guest) * 100, false); ?>

                            %)
                        <?php endif; ?>
                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.widget'); ?>
                <div class="row">
                    <table class="table table-hover table-th-skin">
                        <thead>
                            <tr class="bg-light-green">
                                <th><?php echo app('translator')->get('hms::lang.rooms_per_booking'); ?></th>
                                <th><?php echo app('translator')->get('hms::lang.bookings'); ?></th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo app('translator')->get('hms::lang.one_room_bookings'); ?></td>
                                <td><?php echo e($rooms_by_booking_count->one_line_count, false); ?></td>
                                <td>
                                    <?php if(
                                        $rooms_by_booking_count->one_line_count +
                                            $rooms_by_booking_count->two_lines_count +
                                            $rooms_by_booking_count->more_than_two_lines_count !=
                                            0): ?>
                                        <?php echo e(number_format(($rooms_by_booking_count->one_line_count / ($rooms_by_booking_count->one_line_count + $rooms_by_booking_count->two_lines_count + $rooms_by_booking_count->more_than_two_lines_count)) * 100), false); ?>

                                        %
                                    <?php else: ?>
                                        0 %
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo app('translator')->get('hms::lang.two_room_bookings'); ?></td>
                                <td><?php echo e($rooms_by_booking_count->two_lines_count, false); ?></td>
                                <td>
                                    <?php if(
                                        $rooms_by_booking_count->one_line_count +
                                            $rooms_by_booking_count->two_lines_count +
                                            $rooms_by_booking_count->more_than_two_lines_count !=
                                            0): ?>
                                        <?php echo e(number_format(($rooms_by_booking_count->two_lines_count / ($rooms_by_booking_count->one_line_count + $rooms_by_booking_count->two_lines_count + $rooms_by_booking_count->more_than_two_lines_count)) * 100), false); ?>

                                        %
                                    <?php else: ?>
                                        0 %
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo app('translator')->get('hms::lang.two_+_room_bookings'); ?></td>
                                <td><?php echo e($rooms_by_booking_count->more_than_two_lines_count, false); ?></td>
                                <td>
                                    <?php if(
                                        $rooms_by_booking_count->one_line_count +
                                            $rooms_by_booking_count->two_lines_count +
                                            $rooms_by_booking_count->more_than_two_lines_count !=
                                            0): ?>
                                        <?php echo e(number_format(($rooms_by_booking_count->more_than_two_lines_count / ($rooms_by_booking_count->one_line_count + $rooms_by_booking_count->two_lines_count + $rooms_by_booking_count->more_than_two_lines_count)) * 100), false); ?>

                                        %
                                    <?php else: ?>
                                        0 %
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.widget'); ?>
                <div class="row">
                    <table class="table table-hover table-th-skin">
                        <thead>
                            <tr class="bg-light-green">
                                <th><?php echo app('translator')->get('hms::lang.nights_per_booking'); ?></th>
                                <th><?php echo app('translator')->get('hms::lang.booking'); ?></th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $total_nights =
                                    $count_by_night->one_night_count +
                                    $count_by_night->two_night_count +
                                    $count_by_night->three_night_count +
                                    $count_by_night->four_night_count +
                                    $count_by_night->five_night_count +
                                    $count_by_night->six_night_count +
                                    $count_by_night->more_than_six_night_count;
                            ?>
                            <tr>
                                <td><?php echo app('translator')->get('hms::lang.1_night_bookings'); ?></td>
                                <td><?php echo e($count_by_night->one_night_count, false); ?></td>
                                <td>
                                    <?php if($total_nights != 0): ?>
                                        <?php echo e(number_format(($count_by_night->one_night_count / $total_nights) * 100), false); ?> %
                                    <?php else: ?>
                                        0%
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo app('translator')->get('hms::lang.2_night_bookings'); ?></td>
                                <td><?php echo e($count_by_night->two_night_count, false); ?></td>
                                <td>
                                    <?php if($total_nights != 0): ?>
                                        <?php echo e(number_format(($count_by_night->two_night_count / $total_nights) * 100), false); ?> %
                                    <?php else: ?>
                                        0%
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo app('translator')->get('hms::lang.3_night_bookings'); ?></td>
                                <td><?php echo e($count_by_night->three_night_count, false); ?></td>
                                <td>
                                    <?php if($total_nights != 0): ?>
                                        <?php echo e(number_format(($count_by_night->three_night_count / $total_nights) * 100), false); ?> %
                                    <?php else: ?>
                                        0%
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo app('translator')->get('hms::lang.4_night_bookings'); ?></td>
                                <td><?php echo e($count_by_night->four_night_count, false); ?></td>
                                <td>
                                    <?php if($total_nights != 0): ?>
                                        <?php echo e(number_format(($count_by_night->four_night_count / $total_nights) * 100), false); ?> %
                                    <?php else: ?>
                                        0%
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo app('translator')->get('hms::lang.5_night_bookings'); ?></td>
                                <td><?php echo e($count_by_night->five_night_count, false); ?></td>
                                <td>
                                    <?php if($total_nights != 0): ?>
                                        <?php echo e(number_format(($count_by_night->five_night_count / $total_nights) * 100), false); ?> %
                                    <?php else: ?>
                                        0%
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo app('translator')->get('hms::lang.6_night_bookings'); ?></td>
                                <td><?php echo e($count_by_night->six_night_count, false); ?></td>
                                <td>
                                    <?php if($total_nights != 0): ?>
                                        <?php echo e(number_format(($count_by_night->six_night_count / $total_nights) * 100), false); ?> %
                                    <?php else: ?>
                                        0%
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo app('translator')->get('hms::lang.6_+_night_bookings'); ?></td>
                                <td><?php echo e($count_by_night->more_than_six_night_count, false); ?></td>
                                <td>
                                    <?php if($total_nights != 0): ?>
                                        <?php echo e(number_format(($count_by_night->more_than_six_night_count / $total_nights) * 100), false); ?>

                                        %
                                    <?php else: ?>
                                        0%
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.widget'); ?>
                <div class="row">
                    <table class="table table-hover table-th-skin">
                        <thead>
                            <tr class="bg-light-green">
                                <th><?php echo app('translator')->get('hms::lang.guests_per_booking'); ?></th>
                                <th><?php echo app('translator')->get('hms::lang.booking'); ?></th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $total_adults =
                                    $count_by_adults->one_adult_count +
                                    $count_by_adults->two_adults_count +
                                    $count_by_adults->three_adults_count +
                                    $count_by_adults->four_adults_count +
                                    $count_by_adults->five_adults_count +
                                    $count_by_adults->six_adults_count +
                                    $count_by_adults->more_than_six_adults_count;
                            ?>
                            <tr>
                                <td><?php echo app('translator')->get('hms::lang.1_guest_bookings'); ?></td>
                                <td><?php echo e($count_by_adults->one_adult_count, false); ?></td>
                                <td>
                                    <?php if($total_adults != 0): ?>
                                        <?php echo e(number_format(($count_by_adults->one_adult_count / $total_adults) * 100), false); ?> %
                                    <?php else: ?>
                                        0%
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo app('translator')->get('hms::lang.2_guest_bookings'); ?></td>
                                <td><?php echo e($count_by_adults->two_adults_count, false); ?></td>
                                <td>
                                    <?php if($total_adults != 0): ?>
                                        <?php echo e(number_format(($count_by_adults->two_adults_count / $total_adults) * 100), false); ?> %
                                    <?php else: ?>
                                        0%
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo app('translator')->get('hms::lang.3_guest_bookings'); ?></td>
                                <td><?php echo e($count_by_adults->three_adults_count, false); ?></td>
                                <td>
                                    <?php if($total_adults != 0): ?>
                                        <?php echo e(number_format(($count_by_adults->three_adults_count / $total_adults) * 100), false); ?> %
                                    <?php else: ?>
                                        0%
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo app('translator')->get('hms::lang.4_guest_bookings'); ?></td>
                                <td><?php echo e($count_by_adults->four_adults_count, false); ?></td>
                                <td>
                                    <?php if($total_adults != 0): ?>
                                        <?php echo e(number_format(($count_by_adults->four_adults_count / $total_adults) * 100), false); ?> %
                                    <?php else: ?>
                                        0%
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo app('translator')->get('hms::lang.5_guest_bookings'); ?></td>
                                <td><?php echo e($count_by_adults->five_adults_count, false); ?></td>
                                <td>
                                    <?php if($total_adults != 0): ?>
                                        <?php echo e(number_format(($count_by_adults->five_adults_count / $total_adults) * 100), false); ?> %
                                    <?php else: ?>
                                        0%
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo app('translator')->get('hms::lang.6_guest_bookings'); ?></td>
                                <td><?php echo e($count_by_adults->six_adults_count, false); ?></td>
                                <td>
                                    <?php if($total_adults != 0): ?>
                                        <?php echo e(number_format(($count_by_adults->six_adults_count / $total_adults) * 100), false); ?> %
                                    <?php else: ?>
                                        0%
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo app('translator')->get('hms::lang.6_+_guest_bookings'); ?></td>
                                <td><?php echo e($count_by_adults->more_than_six_adults_count, false); ?></td>
                                <td>
                                    <?php if($total_adults != 0): ?>
                                        <?php echo e(number_format(($count_by_adults->more_than_six_adults_count / $total_adults) * 100), false); ?>

                                        %
                                    <?php else: ?>
                                        0%
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
            <?php $__env->startComponent('components.widget'); ?>
                <div class="row">
                    <?php echo $__env->make('hms::partials.hms_report_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            <?php echo $__env->renderComponent(); ?>
        <?php endif; ?>
    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script>
        $(document).ready(function() {
            var currentDate = new Date();
            var currentYear = currentDate.getFullYear(); // Get the current year
            var startOfYear = new Date(currentYear, 0, 1); // January 1st of the current year
            var formattedStartOfYear = moment(startOfYear)
            var currentDateTime = moment(currentDate)


            $('.date_to').datetimepicker({
                format: moment_date_format,
                ignoreReadonly: true,
                defaultDate: formattedStartOfYear
            });

            $('.date_from').datetimepicker({
                format: moment_date_format,
                ignoreReadonly: true,
                defaultDate: currentDateTime,
                minDate: formattedStartOfYear,
            });

            $('.date_to').on('dp.change', function(e) {
                var selectedDate = e.date;
                // Update the minimum date of the departure datepicker
                $('.date_from').data('DateTimePicker').minDate(selectedDate);
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>