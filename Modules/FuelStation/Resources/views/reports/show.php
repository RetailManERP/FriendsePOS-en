
<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('fuelstation::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header"><h1><?php echo e($title, false); ?></h1></section>

<section class="content">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <?php echo Form::open(['url' => action([\Modules\FuelStation\Http\Controllers\FuelReportController::class, 'show'], [$type]), 'method' => 'get', 'id' => 'report_filter_form']); ?>

        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('location_id', __('fuelstation::lang.location') . ':'); ?>

                <?php echo Form::select('location_id', $business_locations, $location_id, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('start_date', __('fuelstation::lang.start_date') . ':'); ?>

                <?php echo Form::date('start_date', $start_date, ['class' => 'form-control']); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('end_date', __('fuelstation::lang.end_date') . ':'); ?>

                <?php echo Form::date('end_date', $end_date, ['class' => 'form-control']); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>&nbsp;</label><br>
                <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> <?php echo app('translator')->get('fuelstation::lang.apply'); ?></button>
                <button type="button" class="btn btn-default no-print" onclick="window.print();"><i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?></button>
            </div>
        </div>
        <?php echo Form::close(); ?>

    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => $title]); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <?php switch($type):
                    case ('daily-sales'): ?>
                        <thead><tr><th><?php echo app('translator')->get('fuelstation::lang.date'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.linked_product'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.liters_sold'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.amount'); ?></th></tr></thead>
                        <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr><td><?php echo e($r->d, false); ?></td><td><?php echo e($r->product_name, false); ?></td><td><?php echo e(number_format($r->liters, 2), false); ?></td><td><span class="display_currency" data-currency_symbol="true"><?php echo e($r->amount, false); ?></span></td></tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?> <tr><td colspan="4" class="text-center text-muted"><?php echo app('translator')->get('fuelstation::lang.no_records'); ?></td></tr> <?php endif; ?>
                        </tbody>
                        <?php break; ?>

                    <?php case ('shift-closing'): ?>
                        <thead><tr><th><?php echo app('translator')->get('fuelstation::lang.shift_no'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.operator'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.dispenser'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.total_liters'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.total_amount'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.short_excess'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.status'); ?></th></tr></thead>
                        <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr><td><?php echo e($r->shift_no, false); ?></td><td><?php echo e(trim($r->operator_name), false); ?></td><td><?php echo e($r->dispenser_name ?? '-', false); ?></td><td><?php echo e(number_format($r->total_liters, 2), false); ?></td><td><span class="display_currency" data-currency_symbol="true"><?php echo e($r->total_amount, false); ?></span></td><td><span class="display_currency" data-currency_symbol="true"><?php echo e($r->short_excess, false); ?></span></td><td><?php echo app('translator')->get('fuelstation::lang.shift_status_' . $r->status); ?></td></tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?> <tr><td colspan="7" class="text-center text-muted"><?php echo app('translator')->get('fuelstation::lang.no_records'); ?></td></tr> <?php endif; ?>
                        </tbody>
                        <?php break; ?>

                    <?php case ('nozzle-reading'): ?>
                        <thead><tr><th><?php echo app('translator')->get('fuelstation::lang.shift_no'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.nozzle'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.opening_reading'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.closing_reading'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.test_quantity'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.liters_sold'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.amount'); ?></th></tr></thead>
                        <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr><td><?php echo e($r->shift_no, false); ?></td><td><?php echo e($r->nozzle_name ?? '-', false); ?></td><td><?php echo e(number_format($r->opening_reading, 2), false); ?></td><td><?php echo e(number_format($r->closing_reading, 2), false); ?></td><td><?php echo e(number_format($r->test_quantity, 2), false); ?></td><td><?php echo e(number_format($r->liters_sold, 2), false); ?></td><td><span class="display_currency" data-currency_symbol="true"><?php echo e($r->amount, false); ?></span></td></tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?> <tr><td colspan="7" class="text-center text-muted"><?php echo app('translator')->get('fuelstation::lang.no_records'); ?></td></tr> <?php endif; ?>
                        </tbody>
                        <?php break; ?>

                    <?php case ('tank-stock'): ?>
                        <thead><tr><th><?php echo app('translator')->get('fuelstation::lang.tank'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.location'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.fuel_type'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.capacity'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.current_stock'); ?></th><th>%</th></tr></thead>
                        <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr><td><?php echo e($r->name, false); ?></td><td><?php echo e(optional($r->location)->name ?? '-', false); ?></td><td><?php echo e($r->fuel_type, false); ?></td><td><?php echo e(number_format($r->capacity, 2), false); ?></td><td><?php echo e(number_format($r->current_stock, 2), false); ?></td><td><?php echo e($r->fill_percent, false); ?>%</td></tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?> <tr><td colspan="6" class="text-center text-muted"><?php echo app('translator')->get('fuelstation::lang.no_records'); ?></td></tr> <?php endif; ?>
                        </tbody>
                        <?php break; ?>

                    <?php case ('tank-adjustment'): ?>
                        <thead><tr><th><?php echo app('translator')->get('fuelstation::lang.ref_no'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.tank'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.type'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.direction'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.quantity'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.status'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.adjustment_date'); ?></th></tr></thead>
                        <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr><td><?php echo e($r->ref_no, false); ?></td><td><?php echo e($r->tank_name ?? '-', false); ?></td><td><?php echo app('translator')->get('fuelstation::lang.adj_type_' . $r->type); ?></td><td><?php echo e($r->direction == 'decrease' ? '-' : '+', false); ?></td><td><?php echo e(number_format($r->quantity, 2), false); ?></td><td><?php echo app('translator')->get('fuelstation::lang.status_' . $r->status); ?></td><td><?php echo e($r->adjustment_date, false); ?></td></tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?> <tr><td colspan="7" class="text-center text-muted"><?php echo app('translator')->get('fuelstation::lang.no_records'); ?></td></tr> <?php endif; ?>
                        </tbody>
                        <?php break; ?>

                    <?php case ('dispenser-sales'): ?>
                        <thead><tr><th><?php echo app('translator')->get('fuelstation::lang.dispenser'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.liters_sold'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.amount'); ?></th></tr></thead>
                        <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr><td><?php echo e($r->dispenser_name, false); ?></td><td><?php echo e(number_format($r->liters, 2), false); ?></td><td><span class="display_currency" data-currency_symbol="true"><?php echo e($r->amount, false); ?></span></td></tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?> <tr><td colspan="3" class="text-center text-muted"><?php echo app('translator')->get('fuelstation::lang.no_records'); ?></td></tr> <?php endif; ?>
                        </tbody>
                        <?php break; ?>

                    <?php case ('staff-sales'): ?>
                        <thead><tr><th><?php echo app('translator')->get('fuelstation::lang.operator'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.liters_sold'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.amount'); ?></th></tr></thead>
                        <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr><td><?php echo e(trim($r->operator_name) ?: '-', false); ?></td><td><?php echo e(number_format($r->liters, 2), false); ?></td><td><span class="display_currency" data-currency_symbol="true"><?php echo e($r->amount, false); ?></span></td></tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?> <tr><td colspan="3" class="text-center text-muted"><?php echo app('translator')->get('fuelstation::lang.no_records'); ?></td></tr> <?php endif; ?>
                        </tbody>
                        <?php break; ?>

                    <?php case ('credit-customer'): ?>
                        <thead><tr><th><?php echo app('translator')->get('fuelstation::lang.shift_no'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.start_time'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.credit_amount'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.total_amount'); ?></th></tr></thead>
                        <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr><td><?php echo e($r->shift_no, false); ?></td><td><?php echo e($r->start_time, false); ?></td><td><span class="display_currency" data-currency_symbol="true"><?php echo e($r->credit_amount, false); ?></span></td><td><span class="display_currency" data-currency_symbol="true"><?php echo e($r->total_amount, false); ?></span></td></tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?> <tr><td colspan="4" class="text-center text-muted"><?php echo app('translator')->get('fuelstation::lang.no_records'); ?></td></tr> <?php endif; ?>
                        </tbody>
                        <?php break; ?>

                    <?php case ('cash-short-excess'): ?>
                        <thead><tr><th><?php echo app('translator')->get('fuelstation::lang.shift_no'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.operator'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.expected_cash'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.cash_received'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.short_excess'); ?></th></tr></thead>
                        <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr><td><?php echo e($r->shift_no, false); ?></td><td><?php echo e(trim($r->operator_name) ?: '-', false); ?></td><td><span class="display_currency" data-currency_symbol="true"><?php echo e($r->expected_cash, false); ?></span></td><td><span class="display_currency" data-currency_symbol="true"><?php echo e($r->cash_received, false); ?></span></td><td><span class="display_currency" data-currency_symbol="true"><?php echo e($r->short_excess, false); ?></span></td></tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?> <tr><td colspan="5" class="text-center text-muted"><?php echo app('translator')->get('fuelstation::lang.no_records'); ?></td></tr> <?php endif; ?>
                        </tbody>
                        <?php break; ?>

                    <?php case ('integration-log'): ?>
                        <thead><tr><th><?php echo app('translator')->get('fuelstation::lang.date'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.dispenser'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.direction'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.status'); ?></th><th><?php echo app('translator')->get('fuelstation::lang.message'); ?></th></tr></thead>
                        <tbody>
                        <?php $__empty_18 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                            <tr><td><?php echo e($r->created_at->format('d-m-Y H:i:s'), false); ?></td><td><?php echo e(optional($r->dispenser)->name ?? '-', false); ?></td><td><?php echo e(ucfirst($r->direction), false); ?></td><td><?php echo e(ucfirst($r->status), false); ?></td><td><?php echo e($r->message, false); ?></td></tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?> <tr><td colspan="5" class="text-center text-muted"><?php echo app('translator')->get('fuelstation::lang.no_records'); ?></td></tr> <?php endif; ?>
                        </tbody>
                        <?php break; ?>
                <?php endswitch; ?>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(function () { __currency_convert_recursively($('section.content')); });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>