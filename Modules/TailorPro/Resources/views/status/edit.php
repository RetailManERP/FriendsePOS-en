
<?php $__env->startSection('title', __('tailorpro::lang.edit_status')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('tailorpro::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><i class="fas fa-tags" style="color:#6f42c1;"></i> <?php echo app('translator')->get('tailorpro::lang.edit_status'); ?></h1>
</section>

<section class="content">
    <?php echo Form::open(['url' => action([\Modules\TailorPro\Http\Controllers\StatusController::class, 'update'], [$status->id]), 'method' => 'put', 'id' => 'tailorpro_status_form']); ?>

    <div class="box" style="border-radius:10px;">
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('name', __('tailorpro::lang.status_name') . ':*'); ?>

                        <?php echo Form::text('name', $status->name, ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('color', __('tailorpro::lang.color') . ':*'); ?>

                        <?php echo Form::color('color', $status->color, ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <?php echo Form::label('sort_order', __('tailorpro::lang.sort_order') . ':'); ?>

                        <?php echo Form::number('sort_order', $status->sort_order, ['class' => 'form-control', 'min' => 0]); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <br>
                        <div class="checkbox">
                            <label>
                                <?php echo Form::checkbox('is_completed_status', 1, $status->is_completed_status); ?>

                                <?php echo app('translator')->get('tailorpro::lang.is_completed'); ?>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <h4><i class="fas fa-sms"></i> <?php echo app('translator')->get('tailorpro::lang.notification_templates'); ?></h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('sms_template', __('tailorpro::lang.sms_template') . ':'); ?>

                        <?php echo Form::textarea('sms_template', $status->sms_template, ['class' => 'form-control', 'rows' => 2]); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('email_subject', __('tailorpro::lang.email_subject') . ':'); ?>

                        <?php echo Form::text('email_subject', $status->email_subject, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('email_body', __('tailorpro::lang.email_body') . ':'); ?>

                        <?php echo Form::textarea('email_body', $status->email_body, ['class' => 'form-control', 'rows' => 4]); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
$(document).ready(function () {
    $('#status_form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            method: 'PUT',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function (result) {
                if (result.success) {
                    toastr.success(result.msg);
                    window.location.href = '<?php echo e(action([\Modules\TailorPro\Http\Controllers\StatusController::class, "index"]), false); ?>';
                } else {
                    toastr.error(result.msg);
                }
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>