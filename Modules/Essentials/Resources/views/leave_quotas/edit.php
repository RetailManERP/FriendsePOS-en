<div class="modal-dialog" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\Modules\Essentials\Http\Controllers\LeaveQuotaController::class, 'update'], $quota->id), 'method' => 'put', 'id' => 'edit_quota_form']); ?>


        <div class="modal-header">
            <h4 class="modal-title"><?php echo app('translator')->get('essentials::lang.edit_leave_quota'); ?></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-condensed">
                        <tr>
                            <th><?php echo app('translator')->get('essentials::lang.employee'); ?>:</th>
                            <td><?php echo e($quota->employee->user_full_name ?? '', false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('essentials::lang.leave_type'); ?>:</th>
                            <td><?php echo e($quota->leaveType->leave_type ?? '', false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('essentials::lang.fiscal_year'); ?>:</th>
                            <td><?php echo e($quota->fiscal_year, false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('essentials::lang.used_days'); ?>:</th>
                            <td><?php echo e($quota->used_days, false); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('allocated_days', __('essentials::lang.allocated_days') . ':*'); ?>

                        <?php echo Form::number('allocated_days', $quota->allocated_days, ['class' => 'form-control', 'required', 'min' => '0', 'step' => '0.5']); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('carried_forward', __('essentials::lang.carried_forward') . ':'); ?>

                        <?php echo Form::number('carried_forward', $quota->carried_forward, ['class' => 'form-control', 'min' => '0', 'step' => '0.5']); ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.update'); ?></button>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>

        <?php echo Form::close(); ?>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#edit_quota_form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                method: 'POST',
                url: $(this).attr('action'),
                dataType: 'json',
                data: $(this).serialize(),
                success: function(result) {
                    if (result.success) {
                        $('#edit_quota_modal').modal('hide');
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
