<div class="form-group">
    <?php echo Form::label('no_of_adult', __('hms::lang.no_of_adult') . '*'); ?>

    <select class="form-control" id="no_of_adult" required name="no_of_child">
        <?php for($i = 1; $i <= $type->no_of_adult; $i++): ?>
            <option value="<?php echo e($i, false); ?>"><?php echo e($i, false); ?></option>
        <?php endfor; ?>
    </select>
</div>
<div class="form-group">
    <?php echo Form::label('no_of_child', __('hms::lang.no_of_child') . '*'); ?>

    <select class="form-control" id="no_of_child" required name="no_of_child">
        <?php for($i = 0; $i <= $type->no_of_child; $i++): ?>
            <option value="<?php echo e($i, false); ?>"><?php echo e($i, false); ?></option>
        <?php endfor; ?>
    </select>
</div>
<div class="form-group">
    <?php echo Form::label('room_no', __('hms::lang.room_no') . '*'); ?>

    <?php echo Form::select('room_no', $rooms, '', [
        'class' => 'form-control',
        'required',
        'id' => 'room_no',
        'placeholder' => __('hms::lang.room_no'),
    ]); ?>

</div>
