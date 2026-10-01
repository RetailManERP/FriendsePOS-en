<div class="modal-dialog" role="document">
    <div class="modal-content">

        <?php echo Form::open([
            'url' => route('gym.subscription.freeze.store', $subscription->id),
            'method' => 'post',
            'id' => 'freeze_membership_form',
        ]); ?>


        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="fa fa-snowflake"></i> <?php echo app('translator')->get('gym::lang.freeze_membership'); ?></h4>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <strong><?php echo app('translator')->get('gym::lang.package'); ?>:</strong> <?php echo e($package->name ?? 'N/A', false); ?> <br>
                        <strong><?php echo app('translator')->get('gym::lang.freeze_max_days'); ?>:</strong> <?php echo e($max_freeze_days > 0 ? $max_freeze_days . ' ' . __('gym::lang.days') : __('gym::lang.unlimited'), false); ?> <br>
                        <strong><?php echo app('translator')->get('gym::lang.total_freeze_days'); ?>:</strong> <?php echo e($used_freeze_days, false); ?> <?php echo app('translator')->get('gym::lang.days'); ?> <br>
                        <?php if($max_freeze_days > 0): ?>
                            <strong><?php echo app('translator')->get('gym::lang.days_remaining'); ?>:</strong> <?php echo e($remaining_freeze_days, false); ?> <?php echo app('translator')->get('gym::lang.days'); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('freeze_start_date', __('gym::lang.freeze_start_date') . ':*'); ?>

                        <?php echo Form::text('freeze_start_date', \Carbon::createFromTimestamp(strtotime(date('Y-m-d')))->format(session('business.date_format')), [
                            'class' => 'form-control',
                            'placeholder' => __('gym::lang.freeze_start_date'),
                            'required',
                            'id' => 'freeze_start_date',
                            'readonly',
                        ]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('freeze_end_date', __('gym::lang.freeze_end_date') . ':*'); ?>

                        <?php echo Form::text('freeze_end_date', null, [
                            'class' => 'form-control',
                            'placeholder' => __('gym::lang.freeze_end_date'),
                            'required',
                            'id' => 'freeze_end_date',
                            'readonly',
                        ]); ?>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('freeze_reason', __('gym::lang.freeze_reason') . ':'); ?>

                        <?php echo Form::textarea('freeze_reason', null, [
                            'class' => 'form-control',
                            'placeholder' => __('gym::lang.freeze_reason'),
                            'rows' => 3,
                        ]); ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary tw-text-white"><i class="fa fa-snowflake"></i> <?php echo app('translator')->get('gym::lang.freeze_membership'); ?></button>
            <button type="button" class="btn btn-neutral tw-text-white" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>

        <?php echo Form::close(); ?>


    </div>
</div>

<script>
    $('#freeze_start_date, #freeze_end_date').datetimepicker({
        format: moment_date_format,
        ignoreReadonly: true,
    });
</script>
