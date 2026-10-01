<?php echo $__env->make('layouts.partials.google_analytics', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(!empty($__site_details['google_analytics'])): ?>
    <?php echo $__site_details['google_analytics']; ?>

<?php endif; ?>
