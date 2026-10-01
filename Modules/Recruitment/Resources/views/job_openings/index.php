

<?php $__env->startSection('title', __('recruitment::lang.job_openings')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('recruitment::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('recruitment::lang.all_job_openings'); ?>
        <?php if($is_admin): ?>
            <button type="button" class="btn btn-primary btn-modal pull-right"
                data-href="<?php echo e(action([\Modules\Recruitment\Http\Controllers\JobOpeningController::class, 'create']), false); ?>"
                data-container=".recruitment_modal">
                <i class="fas fa-plus"></i> <?php echo app('translator')->get('recruitment::lang.add_job_opening'); ?>
            </button>
        <?php endif; ?>
    </h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('filter_status', __('sale.status') . ':'); ?>

                <?php echo Form::select('filter_status', ['' => __('lang_v1.all')] + $statuses, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('filter_department', __('recruitment::lang.department') . ':'); ?>

                <?php echo Form::select('filter_department', ['' => __('lang_v1.all')] + $departments, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('filter_employment_type', __('recruitment::lang.employment_type') . ':'); ?>

                <?php echo Form::select('filter_employment_type', ['' => __('lang_v1.all')] + $employment_types, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="job_openings_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('recruitment::lang.job_title'); ?></th>
                        <th><?php echo app('translator')->get('recruitment::lang.reference_no'); ?></th>
                        <th><?php echo app('translator')->get('recruitment::lang.department'); ?></th>
                        <th><?php echo app('translator')->get('recruitment::lang.employment_type'); ?></th>
                        <th><?php echo app('translator')->get('recruitment::lang.positions'); ?></th>
                        <th><?php echo app('translator')->get('sale.status'); ?></th>
                        <th><?php echo app('translator')->get('recruitment::lang.opening_date'); ?></th>
                        <th><?php echo app('translator')->get('recruitment::lang.closing_date'); ?></th>
                        <th><?php echo app('translator')->get('recruitment::lang.hiring_manager'); ?></th>
                        <th><?php echo app('translator')->get('messages.action'); ?></th>
                    </tr>
                </thead>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <div class="modal fade recruitment_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        var job_openings_table = $('#job_openings_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?php echo e(action([\Modules\Recruitment\Http\Controllers\JobOpeningController::class, "index"]), false); ?>',
                data: function(d) {
                    d.status = $('#filter_status').val();
                    d.department_id = $('#filter_department').val();
                    d.employment_type = $('#filter_employment_type').val();
                }
            },
            columns: [
                {data: 'title', name: 'recruitment_job_openings.title'},
                {data: 'reference_no', name: 'recruitment_job_openings.reference_no'},
                {data: 'department_name', name: 'dept.name'},
                {data: 'employment_type', name: 'recruitment_job_openings.employment_type'},
                {data: 'num_positions', name: 'recruitment_job_openings.num_positions'},
                {data: 'status', name: 'recruitment_job_openings.status'},
                {data: 'opening_date', name: 'recruitment_job_openings.opening_date'},
                {data: 'closing_date', name: 'recruitment_job_openings.closing_date'},
                {data: 'hiring_manager_name', name: 'hiring_manager_name', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });

        $('#filter_status, #filter_department, #filter_employment_type').change(function() {
            job_openings_table.ajax.reload();
        });

        $(document).on('click', '.edit-job', function(e) {
            e.preventDefault();
            $('div.recruitment_modal').load($(this).data('href'), function() {
                $(this).modal('show');
                $('form#edit_job_form').submit(function(e) {
                    e.preventDefault();
                    var data = $(this).serialize();
                    $.ajax({
                        method: 'PUT',
                        url: $(this).attr('action'),
                        dataType: 'json',
                        data: data,
                        success: function(result) {
                            if (result.success == true) {
                                $('div.recruitment_modal').modal('hide');
                                toastr.success(result.msg);
                                job_openings_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                });
            });
        });

        $(document).on('click', '.view-job', function(e) {
            e.preventDefault();
            $('div.recruitment_modal').load($(this).data('href'), function() {
                $(this).modal('show');
            });
        });

        $(document).on('click', '.delete-job', function(e) {
            e.preventDefault();
            swal({
                title: LANG.sure,
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    var href = $(this).attr('href');
                    $.ajax({
                        method: 'DELETE',
                        url: href,
                        dataType: 'json',
                        success: function(result) {
                            if (result.success == true) {
                                toastr.success(result.msg);
                                job_openings_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                }
            });
        });

        $('div.recruitment_modal').on('shown.bs.modal', function() {
            $('form#add_job_form').submit(function(e) {
                e.preventDefault();
                var data = $(this).serialize();
                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'),
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if (result.success == true) {
                            $('div.recruitment_modal').modal('hide');
                            toastr.success(result.msg);
                            job_openings_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>