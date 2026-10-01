<div>
    <?php echo app('translator')->get('hms::lang.id'); ?>: <?php echo e($info->ref_no, false); ?> <br>
    <?php echo e($info->contact->name, false); ?> <br>
    <?php echo e($info->contact->mobile, false); ?> <br>
    <?php if($info->status == 'confirmed'): ?>
        <h6 class="bg-green badge"><?php echo e(ucfirst($info->status), false); ?></h6>
    <?php elseif($info->status == 'pending'): ?>
        <h6 class="bg-yellow badge"><?php echo e(ucfirst($info->status), false); ?></h6>
    <?php elseif($info->status == 'cancelled'): ?>
        <h6 class="bg-red badge"><?php echo e(ucfirst($info->status), false); ?></h6>
    <?php endif; ?>
    <br>
    <?php echo app('translator')->get('hms::lang.stay'); ?> : <?php echo format_datetime_br($info->hms_booking_arrival_date_time); ?> - <?php echo format_datetime_br($info->hms_booking_departure_date_time); ?>

    <hr>
    <br>
</div>
