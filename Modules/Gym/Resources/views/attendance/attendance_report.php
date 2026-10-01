
<?php $__env->startSection('title', __('gym::lang.attendance_report')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('gym::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h3 class="text-muted"> <?php echo app('translator')->get('gym::lang.attendance_report'); ?></h3>
    </section>

    <!-- Main content -->
    <section class="content">

        <?php $__env->startComponent('components.widget'); ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('member_id', __('gym::lang.members') . ':'); ?>

                    <?php echo Form::select('member_id', $members, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('date_range', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

                </div>
            </div>
        </div>
            <div class="table-responsive">
<table class="table table-bordered table-striped" id="attendance_report">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('lang_v1.date'); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.contact_id'); ?></th>
                        <th><?php echo app('translator')->get('contact.name'); ?></th>
                        <th><?php echo app('translator')->get('business.email'); ?></th>
                        <th><?php echo app('translator')->get('contact.mobile'); ?></th>
                        <th><?php echo app('translator')->get('gym::lang.in_time'); ?></th>
                        <th><?php echo app('translator')->get('gym::lang.out_time'); ?></th>
                    </tr>
                </thead>
            </table>
</div>
        <?php echo $__env->renderComponent(); ?>

    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            attendance_report = $('#attendance_report').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: false,
                ajax: {
                    url: "<?php echo e(action([\Modules\Gym\Http\Controllers\AttendanceController::class, 'AttendanceReport']), false); ?>",
                    "data" : function(d) {
                        if ($('#member_id').length) {
                            d.member_id = $('#member_id').val();
                        }
                        if($('#date_range').val()) {
                            var start = $('#date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                            var end = $('#date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                            d.start_date = start;
                            d.end_date = end;
                        }
                    }
                },
                columns: [
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'cid',
                        name: 'cid'
                    },
                    {
                        data: 'name',
                        name: 'c.name'
                    },
                    {
                        data: 'email',
                        name: 'c.email'
                    },
                    {
                        data: 'mobile',
                        name: 'c.mobile'
                    },
                    {
                        data: 'in_time',
                        name: 'in_time',
                        sorting: false,
                    },
                    {
                        data: 'out_time',
                        name: 'out_time',
                        sorting: false,
                    },
                ]
            });

            $('#date_range').daterangepicker(
                dateRangeSettings,
                function (start, end) {
                    $('#date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                }
            );
            $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#date_range').val('');
                attendance_report.ajax.reload();
            });

            $(document).on('change', '#member_id, #date_range', function() {
                attendance_report.ajax.reload();
            });

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>