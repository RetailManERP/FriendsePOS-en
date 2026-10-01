

<?php $__env->startSection('title', __('rental::lang.damage_report') . ' - ' . $report->report_no); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('rental::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">
    <div class="row">
        <div class="col-md-8">
            <?php $__env->startComponent('components.widget', ['class' => 'box-danger', 'title' => __('rental::lang.damage_report') . ' #' . $report->report_no]); ?>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-condensed no-border">
                            <tr><th><?php echo app('translator')->get('rental::lang.agreement_no'); ?>:</th><td><a href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalAgreementController::class, 'show'], [$report->rental_agreement_id]), false); ?>"><?php echo e($report->agreement ? $report->agreement->agreement_no : '-', false); ?></a></td></tr>
                            <tr><th><?php echo app('translator')->get('rental::lang.item'); ?>:</th><td><?php echo e($report->item ? $report->item->name : '-', false); ?></td></tr>
                            <tr><th><?php echo app('translator')->get('rental::lang.customer'); ?>:</th><td><?php echo e($report->contact ? $report->contact->name : '-', false); ?></td></tr>
                            <tr><th><?php echo app('translator')->get('rental::lang.reported_date'); ?>:</th><td><?php echo e($report->created_at->format('M d, Y H:i'), false); ?></td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-condensed no-border">
                            <tr><th><?php echo app('translator')->get('rental::lang.damage_type'); ?>:</th><td><?php echo e(__('rental::lang.damage_type_' . $report->damage_type), false); ?></td></tr>
                            <tr>
                                <th><?php echo app('translator')->get('rental::lang.severity'); ?>:</th>
                                <td>
                                    <?php $sev_colors = ['minor'=>'warning','moderate'=>'orange','major'=>'danger','critical'=>'dark']; ?>
                                    <span class="label label-<?php echo e($sev_colors[$report->severity] ?? 'default', false); ?>"><?php echo e(ucfirst($report->severity), false); ?></span>
                                </td>
                            </tr>
                            <tr><th><?php echo app('translator')->get('rental::lang.estimated_repair_cost'); ?>:</th><td><span class="display_currency" data-currency_symbol="true"><?php echo e($report->estimated_repair_cost, false); ?></span></td></tr>
                            <tr><th><?php echo app('translator')->get('rental::lang.replacement_cost'); ?>:</th><td><span class="display_currency" data-currency_symbol="true"><?php echo e($report->replacement_cost, false); ?></span></td></tr>
                        </table>
                    </div>
                </div>

                <hr>
                <h4><?php echo app('translator')->get('rental::lang.damage_description'); ?></h4>
                <p><?php echo nl2br(e($report->description)); ?></p>

                <?php if($report->image_1 || $report->image_2 || $report->image_3): ?>
                <hr>
                <h4><?php echo app('translator')->get('rental::lang.damage_images'); ?></h4>
                <div class="row">
                    <?php $__currentLoopData = ['image_1', 'image_2', 'image_3']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($report->$img): ?>
                        <div class="col-md-4">
                            <a href="<?php echo e(url('uploads/' . $report->$img), false); ?>" target="_blank">
                                <img src="<?php echo e(url('uploads/' . $report->$img), false); ?>" class="img-responsive img-thumbnail" alt="Damage Image">
                            </a>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>
            <?php echo $__env->renderComponent(); ?>
        </div>

        <div class="col-md-4">
            <?php $__env->startComponent('components.widget', ['class' => 'box-info', 'title' => __('rental::lang.resolution')]); ?>
                <table class="table table-condensed no-border">
                    <tr>
                        <th><?php echo app('translator')->get('rental::lang.resolution_status'); ?>:</th>
                        <td>
                            <?php $res_colors = ['pending'=>'warning','in_progress'=>'info','resolved'=>'success']; ?>
                            <span class="label label-<?php echo e($res_colors[$report->resolution_status] ?? 'default', false); ?>"><?php echo e(__('rental::lang.resolution_' . $report->resolution_status), false); ?></span>
                        </td>
                    </tr>
                    <?php if($report->charged_to_customer): ?>
                    <tr><th><?php echo app('translator')->get('rental::lang.charged_to_customer'); ?>:</th><td><span class="display_currency" data-currency_symbol="true"><?php echo e($report->charged_to_customer, false); ?></span></td></tr>
                    <?php endif; ?>
                    <?php if($report->resolution_notes): ?>
                    <tr><th><?php echo app('translator')->get('rental::lang.resolution_notes'); ?>:</th><td><?php echo nl2br(e($report->resolution_notes)); ?></td></tr>
                    <?php endif; ?>
                    <?php if($report->resolved_at): ?>
                    <tr><th><?php echo app('translator')->get('rental::lang.resolved_at'); ?>:</th><td><?php echo e($report->resolved_at->format('M d, Y H:i'), false); ?></td></tr>
                    <?php endif; ?>
                </table>

                <?php if($report->resolution_status != 'resolved'): ?>
                <hr>
                <?php echo Form::open(['url' => action([\Modules\Rental\Http\Controllers\RentalDamageReportController::class, 'resolve'], [$report->id]), 'method' => 'post']); ?>

                    <div class="form-group">
                        <?php echo Form::label('charged_to_customer', __('rental::lang.charged_to_customer') . ':'); ?>

                        <?php echo Form::text('charged_to_customer', number_format($report->estimated_repair_cost, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number']); ?>

                    </div>
                    <div class="form-group">
                        <?php echo Form::label('resolution_notes', __('rental::lang.resolution_notes') . ':'); ?>

                        <?php echo Form::textarea('resolution_notes', null, ['class' => 'form-control', 'rows' => 3]); ?>

                    </div>
                    <button type="submit" class="btn btn-success btn-block">
                        <i class="fas fa-check"></i> <?php echo app('translator')->get('rental::lang.mark_resolved'); ?>
                    </button>
                <?php echo Form::close(); ?>

                <?php endif; ?>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>