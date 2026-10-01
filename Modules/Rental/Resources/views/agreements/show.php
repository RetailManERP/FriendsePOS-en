

<?php $__env->startSection('title', __('rental::lang.view_agreement') . ' - ' . $agreement->agreement_no); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('rental::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">
    
    <div class="row">
        <div class="col-md-8">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => $agreement->agreement_no]); ?>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-condensed no-border">
                            <tr>
                                <th><?php echo app('translator')->get('rental::lang.status'); ?>:</th>
                                <td>
                                    <?php
                                        $status_colors = ['draft'=>'default','confirmed'=>'info','active'=>'primary','overdue'=>'danger','completed'=>'success','cancelled'=>'warning'];
                                    ?>
                                    <span class="label label-<?php echo e($status_colors[$agreement->status] ?? 'default', false); ?>"><?php echo e(__('rental::lang.status_' . $agreement->status), false); ?></span>
                                </td>
                            </tr>
                            <tr><th><?php echo app('translator')->get('rental::lang.customer'); ?>:</th><td><?php echo e($agreement->contact ? $agreement->contact->name : '-', false); ?></td></tr>
                            <tr><th><?php echo app('translator')->get('rental::lang.location'); ?>:</th><td><?php echo e($agreement->location ? $agreement->location->name : '-', false); ?></td></tr>
                            <tr><th><?php echo app('translator')->get('rental::lang.rental_period_type'); ?>:</th><td><?php echo e(__('rental::lang.' . $agreement->rental_period_type), false); ?></td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-condensed no-border">
                            <tr><th><?php echo app('translator')->get('rental::lang.rental_start_date'); ?>:</th><td><?php echo e($agreement->rental_start_date ? $agreement->rental_start_date->format('M d, Y H:i') : '-', false); ?></td></tr>
                            <tr><th><?php echo app('translator')->get('rental::lang.rental_end_date'); ?>:</th><td><?php echo e($agreement->rental_end_date ? $agreement->rental_end_date->format('M d, Y H:i') : '-', false); ?></td></tr>
                            <tr><th><?php echo app('translator')->get('rental::lang.duration'); ?>:</th><td><?php echo e($agreement->duration, false); ?> <?php echo e(__('rental::lang.' . $agreement->rental_period_type), false); ?></td></tr>
                            <tr><th><?php echo app('translator')->get('rental::lang.created_by'); ?>:</th><td><?php echo e($agreement->createdBy ? $agreement->createdBy->user_full_name : '-', false); ?></td></tr>
                        </table>
                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-4">
            <?php $__env->startComponent('components.widget', ['class' => 'box-success', 'title' => __('rental::lang.financial_summary')]); ?>
                <table class="table table-condensed no-border">
                    <tr><th><?php echo app('translator')->get('rental::lang.subtotal'); ?>:</th><td class="text-right"><span class="display_currency" data-currency_symbol="true"><?php echo e($agreement->subtotal, false); ?></span></td></tr>
                    <?php if($agreement->discount_amount > 0): ?>
                    <tr><th><?php echo app('translator')->get('sale.discount'); ?>:</th><td class="text-right">(-) <span class="display_currency" data-currency_symbol="true"><?php echo e($agreement->discount_amount, false); ?></span></td></tr>
                    <?php endif; ?>
                    <?php if($agreement->tax_amount > 0): ?>
                    <tr><th><?php echo app('translator')->get('sale.tax'); ?>:</th><td class="text-right">(+) <span class="display_currency" data-currency_symbol="true"><?php echo e($agreement->tax_amount, false); ?></span></td></tr>
                    <?php endif; ?>
                    <tr class="bg-light-blue"><th><h4><?php echo app('translator')->get('rental::lang.total'); ?>:</h4></th><td class="text-right"><h4><span class="display_currency" data-currency_symbol="true"><?php echo e($agreement->total_amount, false); ?></span></h4></td></tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.deposit'); ?>:</th><td class="text-right"><span class="display_currency" data-currency_symbol="true"><?php echo e($agreement->deposit_amount, false); ?></span></td></tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.total_paid'); ?>:</th><td class="text-right text-success"><span class="display_currency" data-currency_symbol="true"><?php echo e($agreement->total_paid, false); ?></span></td></tr>
                    <tr><th><?php echo app('translator')->get('rental::lang.balance_due'); ?>:</th><td class="text-right text-danger"><span class="display_currency" data-currency_symbol="true"><?php echo e($agreement->balance_due, false); ?></span></td></tr>
                </table>

                <?php $payment_badges = ['unpaid'=>'danger','partial'=>'warning','paid'=>'success']; ?>
                <div class="text-center">
                    <span class="label label-<?php echo e($payment_badges[$agreement->payment_status] ?? 'default', false); ?>"><?php echo e(__('rental::lang.' . $agreement->payment_status), false); ?></span>
                </div>
            <?php echo $__env->renderComponent(); ?>

            
            <?php $__env->startComponent('components.widget', ['class' => 'box-warning', 'title' => __('rental::lang.actions')]); ?>
                <div class="btn-group-vertical btn-block">
                    <?php if(in_array($agreement->status, ['draft'])): ?>
                        <a href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalAgreementController::class, 'edit'], [$agreement->id]), false); ?>" class="btn btn-info">
                            <i class="fas fa-edit"></i> <?php echo app('translator')->get('messages.edit'); ?>
                        </a>
                    <?php endif; ?>

                    <?php if(in_array($agreement->status, ['confirmed'])): ?>
                        <form action="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalAgreementController::class, 'update'], [$agreement->id]), false); ?>" method="POST" style="display:inline">
                            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                            <input type="hidden" name="status" value="active">
                            <button type="submit" class="btn btn-success btn-block"><i class="fas fa-play"></i> <?php echo app('translator')->get('rental::lang.activate_checkout'); ?></button>
                        </form>
                    <?php endif; ?>

                    <?php if(in_array($agreement->status, ['active', 'overdue'])): ?>
                        <a href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalReturnController::class, 'create'], [$agreement->id]), false); ?>" class="btn btn-primary">
                            <i class="fas fa-undo"></i> <?php echo app('translator')->get('rental::lang.process_return'); ?>
                        </a>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('rental.manage_payments')): ?>
                        <?php if(in_array($agreement->status, ['active', 'overdue', 'confirmed']) && $agreement->balance_due > 0): ?>
                            <button type="button" class="btn btn-success btn-add-payment" data-agreement-id="<?php echo e($agreement->id, false); ?>">
                                <i class="fas fa-money-bill"></i> <?php echo app('translator')->get('rental::lang.add_payment'); ?>
                            </button>
                        <?php endif; ?>
                    <?php endif; ?>

                    <a href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalAgreementController::class, 'printAgreement'], [$agreement->id]), false); ?>" class="btn btn-default" target="_blank">
                        <i class="fas fa-print"></i> <?php echo app('translator')->get('rental::lang.print'); ?>
                    </a>

                    <?php if(in_array($agreement->status, ['draft', 'confirmed'])): ?>
                        <button type="button" class="btn btn-danger cancel_agreement" data-href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalAgreementController::class, 'destroy'], [$agreement->id]), false); ?>">
                            <i class="fas fa-times"></i> <?php echo app('translator')->get('rental::lang.cancel'); ?>
                        </button>
                    <?php endif; ?>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_lines" data-toggle="tab"><?php echo app('translator')->get('rental::lang.rental_items'); ?> (<?php echo e($agreement->lines->count(), false); ?>)</a></li>
                    <li><a href="#tab_payments" data-toggle="tab"><?php echo app('translator')->get('rental::lang.payments'); ?> (<?php echo e($agreement->payments->count(), false); ?>)</a></li>
                    <li><a href="#tab_returns" data-toggle="tab"><?php echo app('translator')->get('rental::lang.returns'); ?> (<?php echo e($agreement->returns->count(), false); ?>)</a></li>
                    <li><a href="#tab_damage" data-toggle="tab"><?php echo app('translator')->get('rental::lang.damage_reports'); ?> (<?php echo e($agreement->damageReports->count(), false); ?>)</a></li>
                </ul>
                <div class="tab-content">
                    
                    <div class="tab-pane active" id="tab_lines">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('rental::lang.item'); ?></th>
                                    <th><?php echo app('translator')->get('rental::lang.quantity'); ?></th>
                                    <th><?php echo app('translator')->get('rental::lang.rate_type'); ?></th>
                                    <th><?php echo app('translator')->get('rental::lang.rate_amount'); ?></th>
                                    <th><?php echo app('translator')->get('rental::lang.duration'); ?></th>
                                    <th><?php echo app('translator')->get('rental::lang.deposit'); ?></th>
                                    <th><?php echo app('translator')->get('rental::lang.line_total'); ?></th>
                                    <th><?php echo app('translator')->get('rental::lang.status'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $agreement->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($line->item ? $line->item->name : '-', false); ?></td>
                                    <td><?php echo e($line->quantity, false); ?></td>
                                    <td><?php echo e(__('rental::lang.' . $line->rate_type), false); ?></td>
                                    <td><span class="display_currency" data-currency_symbol="true"><?php echo e($line->rate_amount, false); ?></span></td>
                                    <td><?php echo e($line->duration, false); ?></td>
                                    <td><span class="display_currency" data-currency_symbol="true"><?php echo e($line->deposit_amount, false); ?></span></td>
                                    <td><span class="display_currency" data-currency_symbol="true"><?php echo e($line->line_total, false); ?></span></td>
                                    <td><span class="badge badge-info"><?php echo e(__('rental::lang.line_status_' . $line->status), false); ?></span></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    
                    <div class="tab-pane" id="tab_payments">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('lang_v1.date'); ?></th>
                                    <th><?php echo app('translator')->get('rental::lang.payment_type'); ?></th>
                                    <th><?php echo app('translator')->get('lang_v1.payment_method'); ?></th>
                                    <th><?php echo app('translator')->get('sale.amount'); ?></th>
                                    <th><?php echo app('translator')->get('lang_v1.payment_ref_no'); ?></th>
                                    <th><?php echo app('translator')->get('rental::lang.status'); ?></th>
                                    <th><?php echo app('translator')->get('rental::lang.note'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $agreement->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($payment->created_at->format('M d, Y H:i'), false); ?></td>
                                    <td><?php echo e(__('rental::lang.payment_type_' . $payment->payment_type), false); ?></td>
                                    <td><?php echo e($payment->payment_method, false); ?></td>
                                    <td><span class="display_currency" data-currency_symbol="true"><?php echo e($payment->amount, false); ?></span></td>
                                    <td><?php echo e($payment->payment_ref_no ?? '-', false); ?></td>
                                    <td><span class="badge badge-<?php echo e($payment->status == 'completed' ? 'success' : 'warning', false); ?>"><?php echo e(ucfirst($payment->status), false); ?></span></td>
                                    <td><?php echo e($payment->note ?? '-', false); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    
                    <div class="tab-pane" id="tab_returns">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('rental::lang.return_no'); ?></th>
                                    <th><?php echo app('translator')->get('rental::lang.item'); ?></th>
                                    <th><?php echo app('translator')->get('rental::lang.quantity'); ?></th>
                                    <th><?php echo app('translator')->get('rental::lang.condition_on_return'); ?></th>
                                    <th><?php echo app('translator')->get('rental::lang.late_fee'); ?></th>
                                    <th><?php echo app('translator')->get('rental::lang.damage_fee'); ?></th>
                                    <th><?php echo app('translator')->get('rental::lang.deposit_refund'); ?></th>
                                    <th><?php echo app('translator')->get('lang_v1.date'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $agreement->returns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $return): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($return->return_no, false); ?></td>
                                    <td><?php echo e($return->item ? $return->item->name : '-', false); ?></td>
                                    <td><?php echo e($return->quantity_returned, false); ?></td>
                                    <td><?php echo e(__('rental::lang.condition_' . $return->condition_on_return), false); ?></td>
                                    <td><span class="display_currency" data-currency_symbol="true"><?php echo e($return->late_fee, false); ?></span></td>
                                    <td><span class="display_currency" data-currency_symbol="true"><?php echo e($return->damage_fee, false); ?></span></td>
                                    <td><span class="display_currency" data-currency_symbol="true"><?php echo e($return->deposit_refund, false); ?></span></td>
                                    <td><?php echo e($return->created_at->format('M d, Y H:i'), false); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    
                    <div class="tab-pane" id="tab_damage">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('rental::lang.report_no'); ?></th>
                                    <th><?php echo app('translator')->get('rental::lang.item'); ?></th>
                                    <th><?php echo app('translator')->get('rental::lang.damage_type'); ?></th>
                                    <th><?php echo app('translator')->get('rental::lang.severity'); ?></th>
                                    <th><?php echo app('translator')->get('rental::lang.estimated_repair_cost'); ?></th>
                                    <th><?php echo app('translator')->get('rental::lang.resolution_status'); ?></th>
                                    <th><?php echo app('translator')->get('lang_v1.date'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $agreement->damageReports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalDamageReportController::class, 'show'], [$report->id]), false); ?>">
                                            <?php echo e($report->report_no, false); ?>

                                        </a>
                                    </td>
                                    <td><?php echo e($report->item ? $report->item->name : '-', false); ?></td>
                                    <td><?php echo e(__('rental::lang.damage_type_' . $report->damage_type), false); ?></td>
                                    <td>
                                        <?php $sev_colors = ['minor'=>'warning','moderate'=>'orange','major'=>'danger','critical'=>'dark']; ?>
                                        <span class="badge badge-<?php echo e($sev_colors[$report->severity] ?? 'default', false); ?>"><?php echo e(ucfirst($report->severity), false); ?></span>
                                    </td>
                                    <td><span class="display_currency" data-currency_symbol="true"><?php echo e($report->estimated_repair_cost, false); ?></span></td>
                                    <td><?php echo e(__('rental::lang.resolution_' . $report->resolution_status), false); ?></td>
                                    <td><?php echo e($report->created_at->format('M d, Y'), false); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <?php if($agreement->rental_terms || $agreement->staff_note): ?>
    <div class="row">
        <?php if($agreement->rental_terms): ?>
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-default', 'title' => __('rental::lang.rental_terms')]); ?>
                <?php echo nl2br(e($agreement->rental_terms)); ?>

            <?php echo $__env->renderComponent(); ?>
        </div>
        <?php endif; ?>
        <?php if($agreement->staff_note): ?>
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-default', 'title' => __('rental::lang.notes')]); ?>
                <?php echo nl2br(e($agreement->staff_note)); ?>

            <?php echo $__env->renderComponent(); ?>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</section>


<div class="modal fade" id="add_payment_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php echo Form::open(['url' => action([\Modules\Rental\Http\Controllers\RentalPaymentController::class, 'store']), 'method' => 'post', 'id' => 'rental_payment_form']); ?>

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title"><?php echo app('translator')->get('rental::lang.add_payment'); ?></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="rental_agreement_id" value="<?php echo e($agreement->id, false); ?>">
                <div class="form-group">
                    <?php echo Form::label('payment_type', __('rental::lang.payment_type') . ':*'); ?>

                    <?php echo Form::select('payment_type', [
                        'deposit' => __('rental::lang.deposit'),
                        'rental_fee' => __('rental::lang.rental_fee'),
                        'late_fee' => __('rental::lang.late_fee'),
                        'damage_fee' => __('rental::lang.damage_fee'),
                    ], null, ['class' => 'form-control select2', 'required', 'style' => 'width:100%']); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('amount', __('sale.amount') . ':*'); ?>

                    <?php echo Form::text('amount', number_format($agreement->balance_due, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'required']); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('method', __('lang_v1.payment_method') . ':*'); ?>

                    <?php echo Form::select('method', $payment_methods ?? ['cash' => __('lang_v1.cash'), 'card' => __('lang_v1.card'), 'bank_transfer' => __('lang_v1.bank_transfer')], null, ['class' => 'form-control select2', 'required', 'style' => 'width:100%']); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('payment_ref_no', __('lang_v1.payment_ref_no') . ':'); ?>

                    <?php echo Form::text('payment_ref_no', null, ['class' => 'form-control']); ?>

                </div>
                <div class="form-group">
                    <?php echo Form::label('note', __('rental::lang.note') . ':'); ?>

                    <?php echo Form::textarea('note', null, ['class' => 'form-control', 'rows' => 2]); ?>

                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.save'); ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        $('.btn-add-payment').click(function() {
            $('#add_payment_modal').modal('show');
        });

        $('#rental_payment_form').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                method: 'POST',
                url: form.attr('action'),
                data: form.serialize(),
                dataType: 'json',
                success: function(result) {
                    if (result.success) {
                        toastr.success(result.msg);
                        $('#add_payment_modal').modal('hide');
                        location.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                }
            });
        });

        $('.cancel_agreement').click(function(e) {
            e.preventDefault();
            swal({
                title: LANG.sure,
                text: '<?php echo e(__("rental::lang.cancel_agreement_confirm"), false); ?>',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willCancel) => {
                if (willCancel) {
                    $.ajax({
                        method: 'DELETE',
                        url: $(this).data('href'),
                        dataType: 'json',
                        success: function(result) {
                            if (result.success) {
                                toastr.success(result.msg);
                                location.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>