

<?php $__env->startSection('title', __('recruitment::lang.applications')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('recruitment::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('recruitment::lang.all_applications'); ?>
        <?php if($is_admin): ?>
            <button type="button" class="btn btn-primary btn-modal pull-right"
                data-href="<?php echo e(action([\Modules\Recruitment\Http\Controllers\ApplicationController::class, 'create']), false); ?>"
                data-container=".recruitment_modal">
                <i class="fas fa-plus"></i> <?php echo app('translator')->get('recruitment::lang.add_application'); ?>
            </button>
        <?php endif; ?>
    </h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('filter_stage', __('recruitment::lang.stage') . ':'); ?>

                <?php echo Form::select('filter_stage', ['' => __('lang_v1.all')] + $stages, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php echo Form::label('filter_job_opening', __('recruitment::lang.job_opening') . ':'); ?>

                <?php echo Form::select('filter_job_opening', ['' => __('lang_v1.all')] + $job_openings, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="applications_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('recruitment::lang.application_ref'); ?></th>
                        <th><?php echo app('translator')->get('recruitment::lang.candidate'); ?></th>
                        <th><?php echo app('translator')->get('recruitment::lang.job_opening'); ?></th>
                        <th><?php echo app('translator')->get('recruitment::lang.applied_date'); ?></th>
                        <th><?php echo app('translator')->get('recruitment::lang.stage'); ?></th>
                        <th><?php echo app('translator')->get('recruitment::lang.rating'); ?></th>
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
        var applications_table = $('#applications_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?php echo e(action([\Modules\Recruitment\Http\Controllers\ApplicationController::class, "index"]), false); ?>',
                data: function(d) {
                    d.stage = $('#filter_stage').val();
                    d.job_opening_id = $('#filter_job_opening').val();
                }
            },
            columns: [
                {data: 'application_ref', name: 'recruitment_applications.application_ref'},
                {data: 'candidate_name', name: 'candidate_name', orderable: false, searchable: false},
                {data: 'job_title', name: 'job_title', orderable: false, searchable: false},
                {data: 'applied_date', name: 'recruitment_applications.applied_date'},
                {data: 'stage', name: 'recruitment_applications.stage'},
                {data: 'rating', name: 'recruitment_applications.rating'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });

        $('#filter_stage, #filter_job_opening').change(function() {
            applications_table.ajax.reload();
        });

        $(document).on('click', '.view-application', function(e) {
            e.preventDefault();
            $('div.recruitment_modal').load($(this).data('href'), function() { $(this).modal('show'); });
        });

        $(document).on('click', '.change-stage', function(e) {
            e.preventDefault();
            var url = $(this).data('href');
            var stage = $(this).data('stage');
            swal({
                title: LANG.sure,
                text: '<?php echo app('translator')->get("recruitment::lang.change_stage_confirm"); ?>',
                icon: 'warning',
                buttons: true,
                dangerMode: stage == 'rejected',
            }).then((willChange) => {
                if (willChange) {
                    $.ajax({
                        method: 'POST', url: url, data: { stage: stage },
                        dataType: 'json',
                        success: function(result) {
                            if (result.success) { toastr.success(result.msg); applications_table.ajax.reload(); }
                            else { toastr.error(result.msg); }
                        },
                    });
                }
            });
        });

        $(document).on('click', '.delete-application', function(e) {
            e.preventDefault();
            swal({ title: LANG.sure, icon: 'warning', buttons: true, dangerMode: true }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        method: 'DELETE', url: $(this).attr('href'), dataType: 'json',
                        success: function(result) {
                            if (result.success) { toastr.success(result.msg); applications_table.ajax.reload(); }
                            else { toastr.error(result.msg); }
                        },
                    });
                }
            });
        });

        $('div.recruitment_modal').on('shown.bs.modal', function() {
            $('form#add_application_form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    method: 'POST', url: $(this).attr('action'), data: $(this).serialize(), dataType: 'json',
                    success: function(result) {
                        if (result.success == true) {
                            $('div.recruitment_modal').modal('hide');
                            toastr.success(result.msg);
                            applications_table.ajax.reload();
                        } else { toastr.error(result.msg); }
                    },
                });
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>