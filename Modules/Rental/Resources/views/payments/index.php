

<?php $__env->startSection('title', __('rental::lang.rental_payments')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('rental::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('payment_date_range', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('payment_date_range', null, ['class' => 'form-control daterange', 'placeholder' => __('lang_v1.select_a_date_range'), 'readonly']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('payment_type_filter', __('rental::lang.payment_type') . ':'); ?>

                    <?php echo Form::select('payment_type_filter', [
                        '' => __('messages.all'),
                        'deposit' => __('rental::lang.deposit'),
                        'rental_fee' => __('rental::lang.rental_fee'),
                        'late_fee' => __('rental::lang.late_fee'),
                        'damage_fee' => __('rental::lang.damage_fee'),
                        'deposit_refund' => __('rental::lang.deposit_refund'),
                        'additional_charge' => __('rental::lang.additional_charge'),
                    ], null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('payment_method_filter', __('lang_v1.payment_method') . ':'); ?>

                    <?php echo Form::select('payment_method_filter', ['' => __('messages.all'), 'cash' => __('lang_v1.cash'), 'card' => __('lang_v1.card'), 'bank_transfer' => __('lang_v1.bank_transfer')], null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                </div>
            </div>
        </div>

        <table class="table table-bordered table-striped" id="rental_payments_table">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('lang_v1.date'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.agreement_no'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.customer'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.payment_type'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.payment_method'); ?></th>
                    <th><?php echo app('translator')->get('sale.amount'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.payment_ref_no'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.status'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.note'); ?></th>
                </tr>
            </thead>
        </table>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        var payments_table = $('#rental_payments_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?php echo e(action([\Modules\Rental\Http\Controllers\RentalPaymentController::class, "index"]), false); ?>',
                data: function(d) {
                    d.date_range = $('#payment_date_range').val();
                    d.payment_type = $('#payment_type_filter').val();
                    d.payment_method = $('#payment_method_filter').val();
                }
            },
            columns: [
                { data: 'date', name: 'rental_payments.created_at' },
                { data: 'agreement_no', name: 'rental_agreements.agreement_no' },
                { data: 'customer', name: 'contacts.name' },
                { data: 'payment_type', name: 'payment_type' },
                { data: 'method', name: 'method' },
                { data: 'amount', name: 'amount' },
                { data: 'payment_ref_no', name: 'payment_ref_no' },
                { data: 'status', name: 'status' },
                { data: 'note', name: 'note' }
            ]
        });

        $('#payment_type_filter, #payment_method_filter').change(function() {
            payments_table.ajax.reload();
        });
        $('#payment_date_range').on('apply.daterangepicker cancel.daterangepicker', function(ev) {
            if (ev.type == 'cancel') $(this).val('');
            payments_table.ajax.reload();
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>