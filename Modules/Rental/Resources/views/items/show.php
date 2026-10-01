

<?php $__env->startSection('title', $item->name); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('rental::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">
    <div class="row">
        <div class="col-md-4">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('rental::lang.item_details')]); ?>
                <?php if($item->image_url): ?>
                    <div class="text-center mb-10">
                        <img src="<?php echo e($item->image_url, false); ?>" alt="<?php echo e($item->name, false); ?>" class="img-responsive" style="max-height:200px; margin:0 auto;">
                    </div>
                <?php endif; ?>
                <table class="table table-condensed no-border">
                    <tr><th><?php echo app('translator')->get('rental::lang.name'); ?></th><td><?php echo e($item->name, false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.rental_sku'); ?></th><td><?php echo e($item->rental_sku ?? '-', false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.serial_number'); ?></th><td><?php echo e($item->serial_number ?? '-', false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.rental_category'); ?></th><td><?php echo e($item->category ? $item->category->name : '-', false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.location'); ?></th><td><?php echo e($item->location ? $item->location->name : __('rental::lang.all_locations'), false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.linked_product'); ?></th><td><?php echo e($item->product ? $item->product->name : '-', false); ?></td></tr>
                    <tr>
                        <th><?php echo app('translator')->get('rental::lang.condition'); ?></th>
                        <td>
                            <?php $cond_badges = ['good'=>'success','fair'=>'warning','poor'=>'danger','needs_repair'=>'dark']; ?>
                            <span class="badge badge-<?php echo e($cond_badges[$item->condition] ?? 'secondary', false); ?>"><?php echo e(__('rental::lang.condition_' . $item->condition), false); ?></span>
                        </td>
                    </tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.total_quantity'); ?></th><td><?php echo e($item->total_quantity, false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.available_quantity'); ?></th><td class="<?php echo e($item->available_quantity > 0 ? 'text-success' : 'text-danger', false); ?>"><?php echo e($item->available_quantity, false); ?></td></tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.description'); ?></th><td><?php echo e($item->description ?? '-', false); ?></td></tr>
                </table>
            <?php echo $__env->renderComponent(); ?>
        </div>

        <div class="col-md-4">
            <?php $__env->startComponent('components.widget', ['class' => 'box-success', 'title' => __('rental::lang.pricing')]); ?>
                <table class="table table-condensed no-border">
                    <tr><th><?php echo app('translator')->get('rental::lang.hourly_rate'); ?></th><td><span class="display_currency" data-currency_symbol="true"><?php echo e($item->hourly_rate, false); ?></span></td></tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.daily_rate'); ?></th><td><span class="display_currency" data-currency_symbol="true"><?php echo e($item->daily_rate, false); ?></span></td></tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.weekly_rate'); ?></th><td><span class="display_currency" data-currency_symbol="true"><?php echo e($item->weekly_rate, false); ?></span></td></tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.monthly_rate'); ?></th><td><span class="display_currency" data-currency_symbol="true"><?php echo e($item->monthly_rate, false); ?></span></td></tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.deposit_amount'); ?></th><td><span class="display_currency" data-currency_symbol="true"><?php echo e($item->deposit_amount, false); ?></span></td></tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.late_fee_per_day'); ?></th><td><span class="display_currency" data-currency_symbol="true"><?php echo e($item->late_fee_per_day, false); ?></span></td></tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.damage_fee'); ?></th><td><span class="display_currency" data-currency_symbol="true"><?php echo e($item->damage_fee, false); ?></span></td></tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.replacement_cost'); ?></th><td><span class="display_currency" data-currency_symbol="true"><?php echo e($item->replacement_cost, false); ?></span></td></tr>
                </table>
            <?php echo $__env->renderComponent(); ?>
        </div>

        <div class="col-md-4">
            <?php $__env->startComponent('components.widget', ['class' => 'box-warning', 'title' => __('rental::lang.settings')]); ?>
                <table class="table table-condensed no-border">
                    <tr><th><?php echo app('translator')->get('rental::lang.requires_deposit'); ?></th><td><?php echo $item->requires_deposit ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>'; ?></td></tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.requires_id_verification'); ?></th><td><?php echo $item->requires_id_verification ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>'; ?></td></tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.requires_agreement_signature'); ?></th><td><?php echo $item->requires_agreement_signature ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>'; ?></td></tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.min_rental_duration'); ?></th><td><?php echo e($item->min_rental_duration ?? '-', false); ?> hrs</td></tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.max_rental_duration'); ?></th><td><?php echo e($item->max_rental_duration ?? '-', false); ?> hrs</td></tr>
                </table>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-info', 'title' => __('rental::lang.rental_history')]); ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('rental::lang.agreement_no'); ?></th>
                            <th><?php echo app('translator')->get('rental::lang.customer'); ?></th>
                            <th><?php echo app('translator')->get('rental::lang.quantity'); ?></th>
                            <th><?php echo app('translator')->get('rental::lang.rate_type'); ?></th>
                            <th><?php echo app('translator')->get('rental::lang.line_total'); ?></th>
                            <th><?php echo app('translator')->get('rental::lang.status'); ?></th>
                            <th><?php echo app('translator')->get('rental::lang.checked_out_at'); ?></th>
                            <th><?php echo app('translator')->get('rental::lang.returned_at'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $rental_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <a href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalAgreementController::class, 'show'], [$line->agreement->id]), false); ?>">
                                    <?php echo e($line->agreement->agreement_no, false); ?>

                                </a>
                            </td>
                            <td><?php echo e($line->agreement->contact ? $line->agreement->contact->name : '-', false); ?></td>
                            <td><?php echo e($line->quantity, false); ?></td>
                            <td><?php echo e(__('rental::lang.' . $line->rate_type), false); ?></td>
                            <td><span class="display_currency" data-currency_symbol="true"><?php echo e($line->line_total, false); ?></span></td>
                            <td><span class="badge badge-info"><?php echo e(__('rental::lang.line_status_' . $line->status), false); ?></span></td>
                            <td><?php echo e($line->checked_out_at ? $line->checked_out_at->format('Y-m-d H:i') : '-', false); ?></td>
                            <td><?php echo e($line->returned_at ? $line->returned_at->format('Y-m-d H:i') : '-', false); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>