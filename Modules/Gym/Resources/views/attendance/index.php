
<?php $__env->startSection('title', __('gym::lang.attendance')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('gym::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h3 class="text-muted"> <?php echo app('translator')->get('gym::lang.attendance_for_today'); ?>  <?php echo e(\Carbon::createFromTimestamp(strtotime(now()))->format(session('business.date_format')), false); ?>

        </h3>
    </section>

    <!-- Main content -->
    <section class="content">

        <?php $__env->startComponent('components.widget'); ?>
            <div class="table-responsive">
<table class="table table-bordered table-striped" id="member_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('contact.name'); ?></th>
                        <th><?php echo app('translator')->get('business.email'); ?></th>
                        <th><?php echo app('translator')->get('contact.mobile'); ?></th>
                        <th>
                            <?php echo app('translator')->get('lang_v1.created_at'); ?>
                        </th>
                        <th><?php echo app('translator')->get('gym::lang.in_time'); ?></th>
                        <th><?php echo app('translator')->get('gym::lang.out_time'); ?></th>
                    </tr>
                </thead>
            </table>
</div>
        <?php echo $__env->renderComponent(); ?>

    </section>
    <div class="modal fade view_modal_in_out" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
    </div>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            member_table = $('#member_table').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: false,
                ajax: {
                    url: "<?php echo e(action([\Modules\Gym\Http\Controllers\AttendanceController::class, 'index']), false); ?>",
                },
                aaSorting: [
                    [3, 'desc']
                ],
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'mobile',
                        name: 'mobile'
                    },
                    {
                        data: 'created_at',
                        name: 'contacts.created_at'
                    },
                    {
                        data: 'in',
                        name: 'in',
                        sorting: false,
                    },
                    {
                        data: 'out',
                        name: 'out',
                        sorting: false,
                    },
                ]
            });

            $(document).on('click', '.btn-modal-in', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('href'),
                    dataType: 'html',
                    success: function(result) {
                        $('.view_modal_in_out')
                            .html(result)
                            .modal('show');
                    },
                });
            });

            $('.view_modal_in_out').on('shown.bs.modal', function() {

                $('#add_edit_in_time').on('submit', function(event) {
                    event.preventDefault(); // Prevent the default form submission

                    // Get the form data
                    var formData = $(this).serialize();

                    // Send the data via AJAX
                    $.ajax({
                        url: $(this).attr('action'), // URL to send the request to
                        method: $(this).attr('method'), // HTTP method (POST)
                        data: formData, // The data to send
                        dataType: 'json', // Expecting JSON response
                        success: function(response) {
                            if (response
                                .success) { // Assuming the response has a message field
                                $('.view_modal_in_out').modal(
                                'hide');
                                member_table.ajax.reload();
                            } else {
                                // Handle errors (e.g., display an error message)
                                alert(response.message || 'An error occurred.');
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle AJAX errors
                            console.log(xhr
                            .responseText); // Log error response for debugging
                            alert('Something went wrong. Please try again.');
                        }
                    });
                });

                $('#add_edit_out_time').on('submit', function(event) {
                    event.preventDefault(); // Prevent the default form submission

                    // Get the form data
                    var formData = $(this).serialize();

                    // Send the data via AJAX
                    $.ajax({
                        url: $(this).attr('action'), // URL to send the request to
                        method: $(this).attr('method'), // HTTP method (POST)
                        data: formData, // The data to send
                        dataType: 'json', // Expecting JSON response
                        success: function(response) {
                            if (response
                                .success) { // Assuming the response has a message field
                                $('.view_modal_in_out').modal(
                                'hide');
                                member_table.ajax.reload();
                            } else {
                                // Handle errors (e.g., display an error message)
                                alert(response.message || 'An error occurred.');
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle AJAX errors
                            console.log(xhr
                            .responseText); // Log error response for debugging
                            alert('Something went wrong. Please try again.');
                        }
                    });
                });

                $('.time_picker').datetimepicker({
                    format: moment_time_format,
                    ignoreReadonly: true,
                    defaultDate: moment(),
                });
            });

            $(document).on('click', '.btn-modal-out', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('href'),
                    dataType: 'html',
                    success: function(result) {
                        $('.view_modal_in_out')
                            .html(result)
                            .modal('show');
                    },
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>