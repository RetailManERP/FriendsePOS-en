<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"><?php echo app('translator')->get('essentials::lang.warning_details'); ?></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-condensed">
                        <tr>
                            <th><?php echo app('translator')->get('essentials::lang.employee'); ?>:</th>
                            <td><?php echo e($warning->employee->user_full_name ?? '', false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('essentials::lang.warning_type'); ?>:</th>
                            <td>
                                <?php
                                    $colors = ['verbal' => 'info', 'written' => 'warning', 'final' => 'danger', 'suspension' => 'dark'];
                                    $color = $colors[$warning->warning_type] ?? 'secondary';
                                ?>
                                <span class="badge bg-<?php echo e($color, false); ?>"><?php echo e($warning_types[$warning->warning_type] ?? $warning->warning_type, false); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('essentials::lang.warning_date'); ?>:</th>
                            <td><?php echo e(\Carbon::createFromTimestamp(strtotime($warning->warning_date))->format(session('business.date_format')), false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('essentials::lang.status'); ?>:</th>
                            <td>
                                <?php
                                    $scolors = ['active' => 'danger', 'acknowledged' => 'info', 'resolved' => 'success', 'expired' => 'secondary'];
                                    $scolor = $scolors[$warning->status] ?? 'secondary';
                                ?>
                                <span class="badge bg-<?php echo e($scolor, false); ?>"><?php echo e($warning_statuses[$warning->status] ?? $warning->status, false); ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-condensed">
                        <tr>
                            <th><?php echo app('translator')->get('essentials::lang.subject'); ?>:</th>
                            <td><?php echo e($warning->subject, false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('essentials::lang.issued_by'); ?>:</th>
                            <td><?php echo e($warning->issuer->user_full_name ?? '', false); ?></td>
                        </tr>
                        <?php if($warning->acknowledged_date): ?>
                        <tr>
                            <th><?php echo app('translator')->get('essentials::lang.acknowledged_date'); ?>:</th>
                            <td><?php echo e(\Carbon::createFromTimestamp(strtotime($warning->acknowledged_date))->format(session('business.date_format')), false); ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
            <?php if($warning->description): ?>
            <div class="row">
                <div class="col-md-12">
                    <h4><?php echo app('translator')->get('essentials::lang.description'); ?></h4>
                    <div class="well"><?php echo e($warning->description, false); ?></div>
                </div>
            </div>
            <?php endif; ?>
            <?php if($warning->employee_response): ?>
            <div class="row">
                <div class="col-md-12">
                    <h4><?php echo app('translator')->get('essentials::lang.employee_response'); ?></h4>
                    <div class="well"><?php echo e($warning->employee_response, false); ?></div>
                </div>
            </div>
            <?php endif; ?>

            <?php if($is_admin): ?>
            <hr>
            <?php echo Form::open(['url' => action([\Modules\Essentials\Http\Controllers\WarningController::class, 'updateStatus']), 'method' => 'post', 'id' => 'update_warning_status_form']); ?>

            <?php echo Form::hidden('warning_id', $warning->id); ?>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('status', __('essentials::lang.change_status') . ':'); ?>

                        <?php echo Form::select('status', $warning_statuses, $warning->status, ['class' => 'form-control select2', 'style' => 'width: 100%;']); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('employee_response', __('essentials::lang.employee_response') . ':'); ?>

                        <?php echo Form::text('employee_response', null, ['class' => 'form-control', 'placeholder' => __('essentials::lang.employee_response')]); ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <br>
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.update'); ?></button>
                    </div>
                </div>
            </div>
            <?php echo Form::close(); ?>

            <?php endif; ?>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var $modal = $('#view_warning_modal');
        $modal.find('.select2').each(function() {
            $(this).select2({ dropdownParent: $modal });
        });

        $('#update_warning_status_form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                method: 'POST',
                url: $(this).attr('action'),
                dataType: 'json',
                data: $(this).serialize(),
                success: function(result) {
                    if (result.success) {
                        $('#view_warning_modal').modal('hide');
                        toastr.success(result.msg);
                        $('#warnings_table').DataTable().ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                }
            });
        });
    });
</script>
