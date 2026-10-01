
<?php $__env->startSection('title', __('clinic::lang.view_lab_order')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1>
            <i class="fas fa-flask me-2"></i><?php echo app('translator')->get('clinic::lang.view_lab_order'); ?> - <?php echo e($order->order_ref, false); ?>

        </h1>
    </section>

    <section class="content">
        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.lab_order_details')]); ?>
            <div class="row">
                <div class="col-md-6">
                    <table class="table no-margin">
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.lab_order_ref'); ?></th>
                            <td><?php echo e($order->order_ref, false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.patient'); ?></th>
                            <td><?php echo e($order->patient->first_name ?? '', false); ?> <?php echo e($order->patient->last_name ?? '', false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.doctor'); ?></th>
                            <td><?php echo e($order->doctor ? 'Dr. ' . ($order->doctor->first_name ?? '') . ' ' . ($order->doctor->last_name ?? '') : '-', false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.test_name'); ?></th>
                            <td><?php echo e($order->labTest->name ?? '-', false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.consultation'); ?></th>
                            <td><?php echo e($order->consultation->consultation_ref ?? '-', false); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table no-margin">
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.order_date'); ?></th>
                            <td><?php echo e($order->order_date ? \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') : '-', false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.status'); ?></th>
                            <td>
                                <?php if($order->status == 'pending'): ?>
                                    <span class="badge bg-warning"><?php echo e(ucfirst($order->status), false); ?></span>
                                <?php elseif($order->status == 'sample_collected'): ?>
                                    <span class="badge bg-info">Sample Collected</span>
                                <?php elseif($order->status == 'processing'): ?>
                                    <span class="badge bg-primary"><?php echo e(ucfirst($order->status), false); ?></span>
                                <?php elseif($order->status == 'completed'): ?>
                                    <span class="badge bg-success"><?php echo e(ucfirst($order->status), false); ?></span>
                                <?php elseif($order->status == 'cancelled'): ?>
                                    <span class="badge bg-danger"><?php echo e(ucfirst($order->status), false); ?></span>
                                <?php else: ?>
                                    <span class="badge bg-secondary"><?php echo e(ucfirst($order->status ?? 'N/A'), false); ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.priority'); ?></th>
                            <td>
                                <?php if($order->priority == 'urgent'): ?>
                                    <span class="badge bg-warning"><?php echo e(ucfirst($order->priority), false); ?></span>
                                <?php elseif($order->priority == 'emergency'): ?>
                                    <span class="badge bg-danger"><?php echo e(ucfirst($order->priority), false); ?></span>
                                <?php else: ?>
                                    <span class="badge bg-secondary"><?php echo e(ucfirst($order->priority ?? 'Normal'), false); ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.cost'); ?></th>
                            <td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $order->cost, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.sample_collected_at'); ?></th>
                            <td><?php echo e($order->sample_collected_at ? \Carbon\Carbon::parse($order->sample_collected_at)->format('d/m/Y h:i A') : '-', false); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <?php if($order->clinical_notes): ?>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <h5><?php echo app('translator')->get('clinic::lang.clinical_notes'); ?></h5>
                        <p><?php echo e($order->clinical_notes, false); ?></p>
                    </div>
                </div>
            <?php endif; ?>
        <?php echo $__env->renderComponent(); ?>

        <?php if($order->result_value || $order->result_notes): ?>
            <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.result')]); ?>
                <div class="row">
                    <div class="col-md-4">
                        <table class="table no-margin">
                            <tr>
                                <th><?php echo app('translator')->get('clinic::lang.result_value'); ?></th>
                                <td><?php echo e($order->result_value ?? '-', false); ?></td>
                            </tr>
                            <tr>
                                <th><?php echo app('translator')->get('clinic::lang.normal_range'); ?></th>
                                <td><?php echo e($order->labTest->normal_range ?? '-', false); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table class="table no-margin">
                            <tr>
                                <th><?php echo app('translator')->get('clinic::lang.result_status'); ?></th>
                                <td><?php echo e(ucfirst(str_replace('_', ' ', $order->result_status ?? '-')), false); ?></td>
                            </tr>
                            <tr>
                                <th><?php echo app('translator')->get('clinic::lang.result_date'); ?></th>
                                <td><?php echo e($order->result_date ? \Carbon\Carbon::parse($order->result_date)->format('d/m/Y h:i A') : '-', false); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table class="table no-margin">
                            <tr>
                                <th><?php echo app('translator')->get('clinic::lang.result_entered_by'); ?></th>
                                <td><?php echo e($order->resultEnteredBy->first_name ?? '', false); ?> <?php echo e($order->resultEnteredBy->last_name ?? '', false); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php if($order->result_notes): ?>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h5><?php echo app('translator')->get('clinic::lang.result_notes'); ?></h5>
                            <p><?php echo e($order->result_notes, false); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            <?php echo $__env->renderComponent(); ?>
        <?php endif; ?>

        <div class="row mb-3">
            <div class="col-md-12">
                <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\LabController::class, 'index']), false); ?>"
                   class="btn btn-default">
                    <i class="fas fa-arrow-left me-1"></i><?php echo app('translator')->get('clinic::lang.back'); ?>
                </a>
                <?php if($order->status != 'completed' && $order->status != 'cancelled'): ?>
                    <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\LabController::class, 'enterResult'], [$order->id]), false); ?>"
                       class="btn btn-primary">
                        <i class="fas fa-edit me-1"></i><?php echo app('translator')->get('clinic::lang.enter_result'); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>