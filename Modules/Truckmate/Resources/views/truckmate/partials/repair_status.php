var data = [{
  id: "",
  text: '<?php echo app('translator')->get("messages.please_select"); ?>',
  html: '<?php echo app('translator')->get("messages.please_select"); ?>',
}, 
<?php $__currentLoopData = $view_data['truckmate_statuses']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $truckmate_status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	{
	id: <?php echo e($truckmate_status->id, false); ?>,
	<?php if(!empty($truckmate_status->color)): ?>
		text: '<i class="fa fa-circle" aria-hidden="true" style="color: <?php echo e($truckmate_status->color, false); ?>;"></i> <?php echo e($truckmate_status->name, false); ?>',
		title: '<?php echo e($truckmate_status->name, false); ?>'
	<?php else: ?>
		text: "<?php echo e($truckmate_status->name, false); ?>"
	<?php endif; ?>
	},
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
];

$("select#truckmate_status_id").select2({
  data: data,
  escapeMarkup: function(markup) {
    return markup;
  }
});