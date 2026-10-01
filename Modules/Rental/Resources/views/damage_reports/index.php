

<?php $__env->startSection('title', __('rental::lang.damage_reports')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('rental::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('damage_severity_filter', __('rental::lang.severity') . ':'); ?>

                    <?php echo Form::select('damage_severity_filter', ['' => __('messages.all'), 'minor' => __('rental::lang.minor'), 'moderate' => __('rental::lang.moderate'), 'major' => __('rental::lang.major'), 'critical' => __('rental::lang.critical')], null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('damage_resolution_filter', __('rental::lang.resolution_status') . ':'); ?>

                    <?php echo Form::select('damage_resolution_filter', ['' => __('messages.all'), 'pending' => __('rental::lang.resolution_pending'), 'in_progress' => __('rental::lang.resolution_in_progress'), 'resolved' => __('rental::lang.resolution_resolved')], null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('damage_date_range', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('damage_date_range', null, ['class' => 'form-control daterange', 'placeholder' => __('lang_v1.select_a_date_range'), 'readonly']); ?>

                </div>
            </div>
        </div>

        <table class="table table-bordered table-striped" id="damage_reports_table">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('rental::lang.report_no'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.agreement_no'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.item'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.customer'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.damage_type'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.severity'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.estimated_repair_cost'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.resolution_status'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.date'); ?></th>
                    <th><?php echo app('translator')->get('messages.action'); ?></th>
                </tr>
            </thead>
        </table>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        var damage_table = $('#damage_reports_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?php echo e(action([\Modules\Rental\Http\Controllers\RentalDamageReportController::class, "index"]), false); ?>',
                data: function(d) {
                    d.severity = $('#damage_severity_filter').val();
                    d.resolution_status = $('#damage_resolution_filter').val();
                    d.date_range = $('#damage_date_range').val();
                }
            },
            columns: [
                { data: 'report_no', name: 'report_no' },
                { data: 'agreement_no', name: 'rental_agreements.agreement_no' },
                { data: 'item_name', name: 'rental_items.name' },
                { data: 'customer', name: 'contacts.name' },
                { data: 'damage_type', name: 'damage_type' },
                { data: 'severity', name: 'severity' },
                { data: 'estimated_repair_cost', name: 'estimated_repair_cost' },
                { data: 'resolution_status', name: 'resolution_status' },
                { data: 'created_at', name: 'rental_damage_reports.created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        $('#damage_severity_filter, #damage_resolution_filter').change(function() {
            damage_table.ajax.reload();
        });
        $('#damage_date_range').on('apply.daterangepicker cancel.daterangepicker', function(ev) {
            if (ev.type == 'cancel') $(this).val('');
            damage_table.ajax.reload();
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>