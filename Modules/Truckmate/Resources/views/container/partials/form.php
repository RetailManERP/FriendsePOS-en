<div class="tm-card tm-card-primary">
    <div class="tm-card-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <?php echo Form::label('container_no', __('truckmate::lang.container') . ':*'); ?>

                    <?php echo Form::text('container_no', optional($container)->container_no, ['class' => 'form-control', 'placeholder' => __('truckmate::lang.container'), 'required']); ?>

                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <?php echo Form::label('name', __('truckmate::lang.container_name') . ':'); ?>

                    <?php echo Form::text('name', optional($container)->name, ['class' => 'form-control', 'placeholder' => __('truckmate::lang.container_name')]); ?>

                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <?php echo Form::label('notes', __('truckmate::lang.notes')); ?>

                    <?php echo Form::textarea('notes', optional($container)->notes, ['class' => 'form-control', 'rows' => 3]); ?>

                </div>
            </div>
        </div>
    </div>
</div>
