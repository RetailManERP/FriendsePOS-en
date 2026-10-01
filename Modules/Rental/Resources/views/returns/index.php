

<?php $__env->startSection('title', __('rental::lang.rental_returns')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('rental::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('return_date_range', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('return_date_range', null, ['class' => 'form-control daterange', 'placeholder' => __('lang_v1.select_a_date_range'), 'readonly']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('return_location_filter', __('purchase.business_location') . ':'); ?>

                    <?php echo Form::select('return_location_filter', $locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('return_condition_filter', __('rental::lang.condition') . ':'); ?>

                    <?php echo Form::select('return_condition_filter', ['' => __('messages.all'), 'good' => __('rental::lang.condition_good'), 'fair' => __('rental::lang.condition_fair'), 'poor' => __('rental::lang.condition_poor'), 'damaged' => __('rental::lang.condition_damaged')], null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                </div>
            </div>
        </div>

        <table class="table table-bordered table-striped" id="rental_returns_table">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('rental::lang.return_no'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.agreement_no'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.item'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.customer'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.quantity'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.condition_on_return'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.late_fee'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.damage_fee'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.deposit_refund'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.date'); ?></th>
                </tr>
            </thead>
        </table>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        var returns_table = $('#rental_returns_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?php echo e(action([\Modules\Rental\Http\Controllers\RentalReturnController::class, "index"]), false); ?>',
                data: function(d) {
                    d.date_range = $('#return_date_range').val();
                    d.location_id = $('#return_location_filter').val();
                    d.condition = $('#return_condition_filter').val();
                }
            },
            columns: [
                { data: 'return_no', name: 'return_no' },
                { data: 'agreement_no', name: 'rental_agreements.agreement_no' },
                { data: 'item_name', name: 'rental_items.name' },
                { data: 'customer', name: 'contacts.name' },
                { data: 'quantity_returned', name: 'quantity_returned' },
                { data: 'condition_on_return', name: 'condition_on_return' },
                { data: 'late_fee', name: 'late_fee' },
                { data: 'damage_fee', name: 'damage_fee' },
                { data: 'deposit_refund', name: 'deposit_refund' },
                { data: 'created_at', name: 'created_at' }
            ]
        });

        $('#return_location_filter, #return_condition_filter').change(function() {
            returns_table.ajax.reload();
        });
        $('#return_date_range').on('apply.daterangepicker cancel.daterangepicker', function(ev) {
            if (ev.type == 'cancel') $(this).val('');
            returns_table.ajax.reload();
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>