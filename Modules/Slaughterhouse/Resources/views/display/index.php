
<?php $__env->startSection('title', __('slaughterhouse::lang.display_screen')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1><?php echo app('translator')->get('slaughterhouse::lang.display_screen'); ?></h1>
</section>
<section class="content">
    <div class="row qurbani-display">
        <?php $__currentLoopData = ['waiting', 'slaughtering_skinning', 'ready', 'coldroom']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3">
                <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('slaughterhouse::lang.' . $zone)]); ?>
                    <div id="zone_<?php echo e($zone, false); ?>" class="display-zone-list"></div>
                <?php echo $__env->renderComponent(); ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
function renderZone(zone, items) {
    var html = '';
    if (!items.length) {
        html = '<p class="text-muted"><?php echo app('translator')->get('slaughterhouse::lang.no_records'); ?></p>';
    } else {
        items.forEach(function (item) {
            html += '<div class="callout callout-info" style="padding:10px;margin-bottom:8px;">'
                + '<h3 style="margin:0;">' + item.token_no + '</h3>'
                + '<p style="margin:4px 0;">' + (item.customer_name || '') + '</p>'
                + '<strong>' + item.progress + '</strong>'
                + '<br><small>' + item.animal_numbers.join(', ') + '</small>'
                + '</div>';
        });
    }
    $('#zone_' + zone).html(html);
}

function refreshDisplay() {
    $.getJSON('<?php echo e(action([\Modules\Slaughterhouse\Http\Controllers\SlaughterDisplayController::class, 'data']), false); ?>', function (data) {
        ['waiting', 'slaughtering_skinning', 'ready', 'coldroom'].forEach(function (zone) {
            renderZone(zone, data[zone] || []);
        });
    });
}

$(function () {
    refreshDisplay();
    setInterval(refreshDisplay, 5000);
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>