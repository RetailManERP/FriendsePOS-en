<div class="modal-dialog" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\Modules\Essentials\Http\Controllers\LeaveQuotaController::class, 'store']), 'method' => 'post', 'id' => 'leave_quota_form']); ?>


        <div class="modal-header">
            <h4 class="modal-title"><?php echo app('translator')->get('essentials::lang.add_leave_quota'); ?></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('user_ids', __('essentials::lang.employees') . ':*'); ?>

                        <?php echo Form::select('user_ids[]', $employees, null, ['class' => 'form-control select2', 'required', 'multiple', 'style' => 'width: 100%;']); ?>

                        <small class="text-muted"><?php echo app('translator')->get('essentials::lang.select_multiple_employees'); ?></small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('essentials_leave_type_id', __('essentials::lang.leave_type') . ':*'); ?>

                        <?php echo Form::select('essentials_leave_type_id', $leave_types, null, ['class' => 'form-control select2', 'required', 'style' => 'width: 100%;', 'placeholder' => __('messages.please_select')]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('fiscal_year', __('essentials::lang.fiscal_year') . ':*'); ?>

                        <?php echo Form::select('fiscal_year', $fiscal_years, date('Y'), ['class' => 'form-control select2', 'required', 'style' => 'width: 100%;']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('allocated_days', __('essentials::lang.allocated_days') . ':*'); ?>

                        <?php echo Form::number('allocated_days', 0, ['class' => 'form-control', 'required', 'min' => '0', 'step' => '0.5']); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('carried_forward', __('essentials::lang.carried_forward') . ':'); ?>

                        <?php echo Form::number('carried_forward', 0, ['class' => 'form-control', 'min' => '0', 'step' => '0.5']); ?>

                        <small class="text-muted"><?php echo app('translator')->get('essentials::lang.carried_forward_help'); ?></small>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.save'); ?></button>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>

        <?php echo Form::close(); ?>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var $modal = $('#leave_quota_modal');
        $modal.find('.select2').each(function() {
            $(this).select2({ dropdownParent: $modal });
        });

        $('#leave_quota_form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                method: 'POST',
                url: $(this).attr('action'),
                dataType: 'json',
                data: $(this).serialize(),
                success: function(result) {
                    if (result.success) {
                        $('#leave_quota_modal').modal('hide');
                        toastr.success(result.msg);
                        $('#leave_quotas_table').DataTable().ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                }
            });
        });
    });
</script>
