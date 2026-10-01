

<?php $__env->startSection('title', __('rental::lang.rental_calendar')); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
<style>
    #rental_calendar { min-height: 600px; }
    .fc-event { cursor: pointer; padding: 2px 5px; }
    .fc-event .fc-event-title { font-size: 12px; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('rental::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('rental::lang.rental_calendar')]); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <div class="form-inline">
                    <div class="form-group mr-10">
                        <?php echo Form::select('calendar_location_filter', $locations, null, ['class' => 'form-control select2 input-sm', 'id' => 'calendar_location_filter', 'style' => 'width:200px']); ?>

                    </div>
                    <div class="form-group">
                        <?php echo Form::select('calendar_status_filter', ['' => __('messages.all')] + $statuses, null, ['class' => 'form-control select2 input-sm', 'id' => 'calendar_status_filter', 'style' => 'width:150px']); ?>

                    </div>
                </div>
            </div>
        <?php $__env->endSlot(); ?>

        <div class="row mb-10">
            <div class="col-md-12">
                <span class="badge" style="background:#3788d8; color:#fff; padding:5px 10px;"><?php echo app('translator')->get('rental::lang.status_confirmed'); ?></span>
                <span class="badge" style="background:#28a745; color:#fff; padding:5px 10px;"><?php echo app('translator')->get('rental::lang.status_active'); ?></span>
                <span class="badge" style="background:#dc3545; color:#fff; padding:5px 10px;"><?php echo app('translator')->get('rental::lang.status_overdue'); ?></span>
                <span class="badge" style="background:#6c757d; color:#fff; padding:5px 10px;"><?php echo app('translator')->get('rental::lang.status_draft'); ?></span>
                <span class="badge" style="background:#17a2b8; color:#fff; padding:5px 10px;"><?php echo app('translator')->get('rental::lang.status_completed'); ?></span>
            </div>
        </div>

        <div id="rental_calendar"></div>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('rental_calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            events: function(info, successCallback, failureCallback) {
                $.ajax({
                    url: '<?php echo e(action([\Modules\Rental\Http\Controllers\RentalAgreementController::class, "calendar"]), false); ?>',
                    data: {
                        start: info.startStr,
                        end: info.endStr,
                        location_id: $('#calendar_location_filter').val(),
                        status: $('#calendar_status_filter').val()
                    },
                    success: function(data) {
                        successCallback(data);
                    },
                    error: function() {
                        failureCallback();
                    }
                });
            },
            eventClick: function(info) {
                if (info.event.url) {
                    window.location.href = info.event.url;
                    info.jsEvent.preventDefault();
                }
            },
            eventDidMount: function(info) {
                $(info.el).tooltip({
                    title: info.event.extendedProps.tooltip || info.event.title,
                    container: 'body',
                    html: true
                });
            },
            height: 'auto',
            editable: false,
            selectable: false,
            dayMaxEvents: 4
        });

        calendar.render();

        $('#calendar_location_filter, #calendar_status_filter').change(function() {
            calendar.refetchEvents();
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>