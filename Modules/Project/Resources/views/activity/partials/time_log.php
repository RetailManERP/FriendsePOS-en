<?php
	$start_datetime = null;
	$end_datetime = null;
	if(isset($activity->properties['attributes']['start_datetime'])) {
		$start_datetime = $activity->properties['attributes']['start_datetime'];
	}
	else{
		$start_datetime = $activity->subject->start_datetime;
	}
	

	if(isset($activity->properties['attributes']['end_datetime'])){
		$end_datetime = $activity->properties['attributes']['end_datetime'];
	}
	else{
		$end_datetime = $activity->subject->end_datetime;
	}
?>

<?php echo e(\Carbon::createFromTimestamp(strtotime($start_datetime))->format(session('business.date_format') . ' ' . 'h:i A'), false); ?>

- 
<?php echo e(\Carbon::createFromTimestamp(strtotime($end_datetime))->format(session('business.date_format') . ' ' . 'h:i A'), false); ?>

<code>
(<?php echo e(\Carbon::parse($start_datetime)->diffForHumans(\Carbon::parse($end_datetime), true), false); ?>)
</code>