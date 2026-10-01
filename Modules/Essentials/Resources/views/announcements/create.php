<div class="modal-dialog" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\Modules\Essentials\Http\Controllers\AnnouncementController::class, 'store']), 'method' => 'post', 'id' => 'announcement_form']); ?>


        <div class="modal-header">
            <h4 class="modal-title"><?php echo app('translator')->get('essentials::lang.add_announcement'); ?></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('title', __('essentials::lang.title') . ':*'); ?>

                        <?php echo Form::text('title', null, ['class' => 'form-control', 'required', 'placeholder' => __('essentials::lang.announcement_title_placeholder')]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('start_date', __('essentials::lang.start_date') . ':*'); ?>

                        <?php echo Form::text('start_date', \Carbon\Carbon::now()->format('m/d/Y'), ['class' => 'form-control', 'required', 'readonly', 'id' => 'announcement_start_date']); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('end_date', __('essentials::lang.end_date') . ':*'); ?>

                        <?php echo Form::text('end_date', \Carbon\Carbon::now()->addDays(7)->format('m/d/Y'), ['class' => 'form-control', 'required', 'readonly', 'id' => 'announcement_end_date']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('location_id', __('essentials::lang.location') . ':'); ?>

                        <?php echo Form::select('location_id', $locations, null, ['class' => 'form-control select2', 'style' => 'width: 100%;', 'placeholder' => __('essentials::lang.all_locations')]); ?>

                        <small class="text-muted"><?php echo app('translator')->get('essentials::lang.leave_empty_for_all'); ?></small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('department_id', __('essentials::lang.department') . ':'); ?>

                        <?php echo Form::select('department_id', $departments, null, ['class' => 'form-control select2', 'style' => 'width: 100%;', 'placeholder' => __('essentials::lang.all_departments')]); ?>

                        <small class="text-muted"><?php echo app('translator')->get('essentials::lang.leave_empty_for_all'); ?></small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('description', __('essentials::lang.description') . ':*'); ?>

                        <?php echo Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5, 'required', 'placeholder' => __('essentials::lang.announcement_description_placeholder')]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('status', __('essentials::lang.status') . ':'); ?>

                        <?php echo Form::select('status', ['active' => __('essentials::lang.active'), 'inactive' => __('essentials::lang.inactive')], 'active', ['class' => 'form-control']); ?>

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
        var $modal = $('#announcement_modal');
        $modal.find('.select2').each(function() {
            $(this).select2({ dropdownParent: $modal });
        });

        $('#announcement_start_date, #announcement_end_date').datepicker({
            autoclose: true,
            format: 'mm/dd/yyyy',
        });

        $('#announcement_form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                method: 'POST',
                url: $(this).attr('action'),
                dataType: 'json',
                data: $(this).serialize(),
                success: function(result) {
                    if (result.success) {
                        $('#announcement_modal').modal('hide');
                        toastr.success(result.msg);
                        $('#announcements_table').DataTable().ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                }
            });
        });
    });
</script>
