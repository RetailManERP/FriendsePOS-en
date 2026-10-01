<div class="modal-dialog" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\Modules\Essentials\Http\Controllers\AwardController::class, 'store']), 'method' => 'post', 'id' => 'award_form']); ?>


        <div class="modal-header">
            <h4 class="modal-title"><?php echo app('translator')->get('essentials::lang.add_award'); ?></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('user_id', __('essentials::lang.employee') . ':*'); ?>

                        <?php echo Form::select('user_id', $employees, null, ['class' => 'form-control select2', 'required', 'style' => 'width: 100%;', 'placeholder' => __('messages.please_select')]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('award_name', __('essentials::lang.award_name') . ':*'); ?>

                        <?php echo Form::text('award_name', null, ['class' => 'form-control', 'required', 'placeholder' => __('essentials::lang.award_name')]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('gift', __('essentials::lang.gift') . ':'); ?>

                        <?php echo Form::text('gift', null, ['class' => 'form-control', 'placeholder' => __('essentials::lang.gift_placeholder')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('cash_prize', __('essentials::lang.cash_prize') . ':'); ?>

                        <?php echo Form::number('cash_prize', 0, ['class' => 'form-control', 'step' => '0.01', 'min' => '0']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('award_date', __('essentials::lang.award_date') . ':*'); ?>

                        <?php echo Form::text('award_date', \Carbon\Carbon::now()->format('m/d/Y'), ['class' => 'form-control', 'required', 'readonly', 'id' => 'award_date_picker']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('description', __('essentials::lang.description') . ':'); ?>

                        <?php echo Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('essentials::lang.award_description_placeholder')]); ?>

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
        var $modal = $('#award_modal');
        $modal.find('.select2').each(function() {
            $(this).select2({ dropdownParent: $modal });
        });

        $('#award_date_picker').datepicker({
            autoclose: true,
            format: 'mm/dd/yyyy',
        });

        $('#award_form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                method: 'POST',
                url: $(this).attr('action'),
                dataType: 'json',
                data: $(this).serialize(),
                success: function(result) {
                    if (result.success) {
                        $('#award_modal').modal('hide');
                        toastr.success(result.msg);
                        $('#awards_table').DataTable().ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                }
            });
        });
    });
</script>
