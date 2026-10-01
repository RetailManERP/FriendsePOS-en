

<?php $__env->startSection('title', __('recruitment::lang.candidates')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('recruitment::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('recruitment::lang.all_candidates'); ?>
        <?php if($is_admin): ?>
            <button type="button" class="btn btn-primary btn-modal pull-right"
                data-href="<?php echo e(action([\Modules\Recruitment\Http\Controllers\CandidateController::class, 'create']), false); ?>"
                data-container=".recruitment_modal">
                <i class="fas fa-plus"></i> <?php echo app('translator')->get('recruitment::lang.add_candidate'); ?>
            </button>
        <?php endif; ?>
    </h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('filter_source', __('recruitment::lang.source') . ':'); ?>

                <?php echo Form::select('filter_source', ['' => __('lang_v1.all')] + $sources, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="candidates_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('recruitment::lang.candidate_name'); ?></th>
                        <th><?php echo app('translator')->get('business.email'); ?></th>
                        <th><?php echo app('translator')->get('contact.mobile'); ?></th>
                        <th><?php echo app('translator')->get('recruitment::lang.source'); ?></th>
                        <th><?php echo app('translator')->get('recruitment::lang.current_company'); ?></th>
                        <th><?php echo app('translator')->get('recruitment::lang.experience'); ?></th>
                        <th><?php echo app('translator')->get('recruitment::lang.expected_salary'); ?></th>
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
        var candidates_table = $('#candidates_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?php echo e(action([\Modules\Recruitment\Http\Controllers\CandidateController::class, "index"]), false); ?>',
                data: function(d) {
                    d.source = $('#filter_source').val();
                }
            },
            columns: [
                {data: 'full_name', name: 'full_name', orderable: false, searchable: false},
                {data: 'email', name: 'recruitment_candidates.email'},
                {data: 'phone', name: 'recruitment_candidates.phone'},
                {data: 'source', name: 'recruitment_candidates.source'},
                {data: 'current_company', name: 'recruitment_candidates.current_company'},
                {data: 'experience_years', name: 'recruitment_candidates.experience_years'},
                {data: 'expected_salary', name: 'recruitment_candidates.expected_salary'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });

        $('#filter_source').change(function() {
            candidates_table.ajax.reload();
        });

        $(document).on('click', '.view-candidate', function(e) {
            e.preventDefault();
            $('div.recruitment_modal').load($(this).data('href'), function() { $(this).modal('show'); });
        });

        $(document).on('click', '.edit-candidate', function(e) {
            e.preventDefault();
            $('div.recruitment_modal').load($(this).data('href'), function() {
                $(this).modal('show');
                $('form#edit_candidate_form').submit(function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        method: 'POST',
                        url: $(this).attr('action'),
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(result) {
                            if (result.success == true) {
                                $('div.recruitment_modal').modal('hide');
                                toastr.success(result.msg);
                                candidates_table.ajax.reload();
                            } else { toastr.error(result.msg); }
                        },
                    });
                });
            });
        });

        $(document).on('click', '.delete-candidate', function(e) {
            e.preventDefault();
            swal({ title: LANG.sure, icon: 'warning', buttons: true, dangerMode: true }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        method: 'DELETE', url: $(this).attr('href'), dataType: 'json',
                        success: function(result) {
                            if (result.success) { toastr.success(result.msg); candidates_table.ajax.reload(); }
                            else { toastr.error(result.msg); }
                        },
                    });
                }
            });
        });

        $('div.recruitment_modal').on('shown.bs.modal', function() {
            $('form#add_candidate_form').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        if (result.success == true) {
                            $('div.recruitment_modal').modal('hide');
                            toastr.success(result.msg);
                            candidates_table.ajax.reload();
                        } else { toastr.error(result.msg); }
                    },
                });
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>