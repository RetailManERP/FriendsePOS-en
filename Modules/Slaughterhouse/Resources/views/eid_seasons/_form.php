<?php
    $season = $season ?? null;
?>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('name', __('slaughterhouse::lang.season_name') . ':*'); ?>

            <?php echo Form::text('name', old('name', $season->name ?? null), ['class' => 'form-control', 'required']); ?>

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <?php echo Form::label('day_1_date', __('slaughterhouse::lang.day_1_date') . ':*'); ?>

            <?php echo Form::date('day_1_date', old('day_1_date', optional($season->day_1_date ?? null)->format('Y-m-d')), ['class' => 'form-control', 'required']); ?>

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <?php echo Form::label('day_2_date', __('slaughterhouse::lang.day_2_date') . ':*'); ?>

            <?php echo Form::date('day_2_date', old('day_2_date', optional($season->day_2_date ?? null)->format('Y-m-d')), ['class' => 'form-control', 'required']); ?>

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <?php echo Form::label('day_3_date', __('slaughterhouse::lang.day_3_date') . ':*'); ?>

            <?php echo Form::date('day_3_date', old('day_3_date', optional($season->day_3_date ?? null)->format('Y-m-d')), ['class' => 'form-control', 'required']); ?>

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <?php echo Form::label('status', __('slaughterhouse::lang.status') . ':*'); ?>

            <?php echo Form::select('status', ['active' => __('slaughterhouse::lang.active'), 'inactive' => __('slaughterhouse::lang.inactive'), 'closed' => __('slaughterhouse::lang.closed')], old('status', $season->status ?? 'active'), ['class' => 'form-control', 'required']); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('booking_start_date', __('slaughterhouse::lang.booking_start_date') . ':'); ?>

            <?php echo Form::date('booking_start_date', old('booking_start_date', optional($season->booking_start_date ?? null)->format('Y-m-d')), ['class' => 'form-control']); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('booking_end_date', __('slaughterhouse::lang.booking_end_date') . ':'); ?>

            <?php echo Form::date('booking_end_date', old('booking_end_date', optional($season->booking_end_date ?? null)->format('Y-m-d')), ['class' => 'form-control']); ?>

        </div>
    </div>
</div>
<div class="row">
    <?php $__currentLoopData = [1, 2, 3]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-2">
            <div class="form-group">
                <?php echo Form::label('max_bookings_day'.$day, __('slaughterhouse::lang.max_bookings_day'.$day) . ':'); ?>

                <?php echo Form::number('max_bookings_day'.$day, old('max_bookings_day'.$day, $season->{'max_bookings_day'.$day} ?? 0), ['class' => 'form-control', 'min' => 0]); ?>

            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <?php echo Form::label('max_animals_day'.$day, __('slaughterhouse::lang.max_animals_day'.$day) . ':'); ?>

                <?php echo Form::number('max_animals_day'.$day, old('max_animals_day'.$day, $season->{'max_animals_day'.$day} ?? 0), ['class' => 'form-control', 'min' => 0]); ?>

            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('default_slaughter_charge', __('slaughterhouse::lang.default_slaughter_charge') . ':'); ?>

            <?php echo Form::number('default_slaughter_charge', old('default_slaughter_charge', $season->default_slaughter_charge ?? 0), ['class' => 'form-control', 'step' => 'any', 'min' => 0]); ?>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('default_cutting_charge', __('slaughterhouse::lang.default_cutting_charge') . ':'); ?>

            <?php echo Form::number('default_cutting_charge', old('default_cutting_charge', $season->default_cutting_charge ?? 0), ['class' => 'form-control', 'step' => 'any', 'min' => 0]); ?>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('default_delivery_charge', __('slaughterhouse::lang.default_delivery_charge') . ':'); ?>

            <?php echo Form::number('default_delivery_charge', old('default_delivery_charge', $season->default_delivery_charge ?? 0), ['class' => 'form-control', 'step' => 'any', 'min' => 0]); ?>

        </div>
    </div>
</div>
