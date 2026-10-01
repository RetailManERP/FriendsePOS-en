

<?php $__env->startSection('title', __('rental::lang.rental_reports')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('rental::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('rental::lang.rental_reports')]); ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('report_type', __('rental::lang.report_type') . ':*'); ?>

                    <?php echo Form::select('report_type', [
                        'revenue' => __('rental::lang.revenue_report'),
                        'items' => __('rental::lang.items_report'),
                        'agreements' => __('rental::lang.agreements_report'),
                        'overdue' => __('rental::lang.overdue_report'),
                        'utilization' => __('rental::lang.utilization_report'),
                    ], request('report_type', 'revenue'), ['class' => 'form-control select2', 'id' => 'report_type', 'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('report_location', __('purchase.business_location') . ':'); ?>

                    <?php echo Form::select('report_location', $locations, null, ['class' => 'form-control select2', 'id' => 'report_location', 'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('report_date_range', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('report_date_range', null, ['class' => 'form-control daterange', 'id' => 'report_date_range', 'placeholder' => __('lang_v1.select_a_date_range'), 'readonly']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group" style="margin-top:25px;">
                    <button type="button" class="btn btn-primary" id="generate_report">
                        <i class="fas fa-sync"></i> <?php echo app('translator')->get('rental::lang.generate_report'); ?>
                    </button>
                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    
    <div id="report_results">
        <?php if(isset($report_data)): ?>
            
            <?php if($report_type == 'revenue'): ?>
            <div class="row">
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fas fa-money-bill"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo app('translator')->get('rental::lang.total_revenue'); ?></span>
                            <span class="info-box-number"><span class="display_currency" data-currency_symbol="true"><?php echo e($report_data['total_revenue'] ?? 0, false); ?></span></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-blue"><i class="fas fa-file-contract"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo app('translator')->get('rental::lang.total_agreements'); ?></span>
                            <span class="info-box-number"><?php echo e($report_data['total_agreements'] ?? 0, false); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fas fa-clock"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo app('translator')->get('rental::lang.total_late_fees'); ?></span>
                            <span class="info-box-number"><span class="display_currency" data-currency_symbol="true"><?php echo e($report_data['total_late_fees'] ?? 0, false); ?></span></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fas fa-exclamation-triangle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo app('translator')->get('rental::lang.total_damage_fees'); ?></span>
                            <span class="info-box-number"><span class="display_currency" data-currency_symbol="true"><?php echo e($report_data['total_damage_fees'] ?? 0, false); ?></span></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            
            <?php if(in_array($report_type, ['items', 'agreements', 'overdue', 'utilization'])): ?>
            <?php $__env->startComponent('components.widget', ['class' => 'box-success', 'title' => __('rental::lang.' . $report_type . '_report')]); ?>
                <table class="table table-bordered table-striped" id="report_data_table">
                    <thead>
                        <tr>
                            <?php $__currentLoopData = $report_data['columns'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th><?php echo e($col, false); ?></th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $report_data['rows'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cell): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td><?php echo $cell; ?></td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php echo $__env->renderComponent(); ?>
            <?php endif; ?>
        <?php else: ?>
            <div class="callout callout-info">
                <p><i class="fas fa-info-circle"></i> <?php echo app('translator')->get('rental::lang.select_report_type_and_generate'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        $('#generate_report').click(function() {
            var params = {
                report_type: $('#report_type').val(),
                location_id: $('#report_location').val(),
                date_range: $('#report_date_range').val()
            };

            var url = '<?php echo e(action([\Modules\Rental\Http\Controllers\RentalReportController::class, "index"]), false); ?>';
            var queryString = $.param(params);
            window.location.href = url + '?' + queryString;
        });

        if ($('#report_data_table').length) {
            $('#report_data_table').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                dom: 'Bfrtip',
                buttons: ['csv', 'excel', 'print']
            });
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>