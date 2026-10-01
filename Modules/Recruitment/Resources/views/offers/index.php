

<?php $__env->startSection('title', __('recruitment::lang.offers')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('recruitment::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('recruitment::lang.all_offers'); ?>
        <?php if($is_admin): ?>
            <button type="button" class="btn btn-primary btn-modal pull-right"
                data-href="<?php echo e(action([\Modules\Recruitment\Http\Controllers\OfferController::class, 'create']), false); ?>"
                data-container=".recruitment_modal">
                <i class="fas fa-plus"></i> <?php echo app('translator')->get('recruitment::lang.create_offer'); ?>
            </button>
        <?php endif; ?>
    </h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('filter_status', __('recruitment::lang.status') . ':'); ?>

                <?php echo Form::select('filter_status', ['' => __('lang_v1.all')] + $statuses, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="offers_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('recruitment::lang.offer_ref'); ?></th>
                        <th><?php echo app('translator')->get('recruitment::lang.candidate'); ?></th>
                        <th><?php echo app('translator')->get('recruitment::lang.job_opening'); ?></th>
                        <th><?php echo app('translator')->get('recruitment::lang.offered_salary'); ?></th>
                        <th><?php echo app('translator')->get('recruitment::lang.offer_date'); ?></th>
                        <th><?php echo app('translator')->get('recruitment::lang.valid_until'); ?></th>
                        <th><?php echo app('translator')->get('recruitment::lang.status'); ?></th>
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
        var offers_table = $('#offers_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?php echo e(action([\Modules\Recruitment\Http\Controllers\OfferController::class, "index"]), false); ?>',
                data: function(d) {
                    d.status = $('#filter_status').val();
                }
            },
            columns: [
                {data: 'offer_ref', name: 'recruitment_offers.offer_ref'},
                {data: 'candidate_name', name: 'candidate_name', orderable: false, searchable: false},
                {data: 'job_title', name: 'job_title', orderable: false, searchable: false},
                {data: 'offered_salary', name: 'recruitment_offers.offered_salary'},
                {data: 'offer_date', name: 'recruitment_offers.offer_date'},
                {data: 'valid_until', name: 'recruitment_offers.valid_until'},
                {data: 'status', name: 'recruitment_offers.status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });

        $('#filter_status').change(function() {
            offers_table.ajax.reload();
        });

        $(document).on('click', '.view-offer', function(e) {
            e.preventDefault();
            $('div.recruitment_modal').load($(this).data('href'), function() { $(this).modal('show'); });
        });

        $(document).on('click', '.edit-offer', function(e) {
            e.preventDefault();
            $('div.recruitment_modal').load($(this).data('href'), function() {
                $(this).modal('show');
                $('form#edit_offer_form').submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        method: 'POST', url: $(this).attr('action'), data: $(this).serialize(), dataType: 'json',
                        success: function(result) {
                            if (result.success == true) {
                                $('div.recruitment_modal').modal('hide');
                                toastr.success(result.msg);
                                offers_table.ajax.reload();
                            } else { toastr.error(result.msg); }
                        },
                    });
                });
            });
        });

        $(document).on('click', '.delete-offer', function(e) {
            e.preventDefault();
            swal({ title: LANG.sure, icon: 'warning', buttons: true, dangerMode: true }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        method: 'DELETE', url: $(this).attr('href'), dataType: 'json',
                        success: function(result) {
                            if (result.success) { toastr.success(result.msg); offers_table.ajax.reload(); }
                            else { toastr.error(result.msg); }
                        },
                    });
                }
            });
        });

        $('div.recruitment_modal').on('shown.bs.modal', function() {
            $('form#add_offer_form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    method: 'POST', url: $(this).attr('action'), data: $(this).serialize(), dataType: 'json',
                    success: function(result) {
                        if (result.success == true) {
                            $('div.recruitment_modal').modal('hide');
                            toastr.success(result.msg);
                            offers_table.ajax.reload();
                        } else { toastr.error(result.msg); }
                    },
                });
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>