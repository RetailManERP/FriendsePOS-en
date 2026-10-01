

<?php $__env->startSection('title', __('accounting::lang.journal_entry')); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'accounting_journal_entry_filter_date_range', 'date_range_setting_input_id' => 'accounting_journal_entry_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'accounting::lang.journal_entry_list' ); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.journal_list_help') . '"></i>';
                }
            ?> </h1>
</section>
<section class="content no-print">
<div class="row">

        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
                <input type="hidden" id="business_location" value="">
                <input type="hidden" id="date_range" value="">
                <div class="col-sm-4">
                    <div class="form-group">
                        <?php echo Form::label('location_id', __('purchase.business_location') . ':'); ?>

                        <?php echo Form::select(
                            'location_id',
                            $business_locations,
                            null,
                            ['class' => 'form-control select2', 'placeholder' => 'All', 'style' => 'width:100%'],
                        ); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('journal_entry_date_range_filter', __('report.date_range') . ':'); ?>

                        <?php echo Form::text('journal_entry_date_range_filter', null, 
                            ['placeholder' => __('lang_v1.select_a_date_range'), 
                            'class' => 'form-control', 'readonly']); ?>

                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
	<?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.view_journal')): ?>
                    <button type="button" class="btn btn-primary" id="journal_entry_print_btn">
                        <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                    </button>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.add_journal')): ?>
                    <a class="btn btn-block btn-primary" 
                        href="<?php echo e(action([\Modules\Accounting\Http\Controllers\JournalEntryController::class, 'create']), false); ?>">
                        <i class="fas fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></a>
                <?php endif; ?>
            </div>
        <?php $__env->endSlot(); ?>
        
        <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="journal_table">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('accounting::lang.journal_date'); ?></th>
                    <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                    <th><?php echo app('translator')->get('purchase.amount'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                    <th><?php echo app('translator')->get('accounting::lang.narration'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.additional_notes'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                    <th><?php echo app('translator')->get('purchase.location'); ?></th>
                    <th><?php echo app('translator')->get('messages.action'); ?></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
</div>

        
    <?php echo $__env->renderComponent(); ?>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script type="text/javascript">

    $(document).ready( function(){
        var journalEntryDateRangeSettings = $('#accounting_journal_entry_filter_date_range').length
            ? window.getAdminReportDateRangeSettings('#accounting_journal_entry_filter_date_range')
            : $.extend({}, dateRangeSettings);

        $('#journal_entry_date_range_filter').daterangepicker(
            journalEntryDateRangeSettings,
            function (start, end) {
                $('#journal_entry_date_range_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                var dateRange = $('#journal_entry_date_range_filter').val();
                $('#date_range').val(dateRange);
                if (typeof journal_table !== 'undefined') {
                    journal_table.ajax.reload();
                }
            }
        );

        var journalEntryDatePicker = $('#journal_entry_date_range_filter').data('daterangepicker');
        if (journalEntryDatePicker) {
            $('#journal_entry_date_range_filter').val(journalEntryDatePicker.startDate.format(moment_date_format) + ' ~ ' + journalEntryDatePicker.endDate.format(moment_date_format));
            $('#date_range').val($('#journal_entry_date_range_filter').val());
        }
        
        //Journal table
        journal_table = $('#journal_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/accounting/journal-entry',
                data: function(d) {
                    var start = '';
                    var end = '';
                    if ($('#journal_entry_date_range_filter').val()) {
                        start = $('input#journal_entry_date_range_filter')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        end = $('input#journal_entry_date_range_filter')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    d.start_date = start;
                    d.end_date = end;
                    d.location_id = $('select#location_id').val();
                },
            },
            aaSorting: [[1, 'desc']],
            columns: [
                { data: 'operation_date', name: 'operation_date' },
                { data: 'ref_no', name: 'ref_no' },
                { data: 'amount', name: 'amount' },
                { data: 'narration', name: 'narration', orderable: false, searchable: false },
                { data: 'note', name: 'note' },
                { data: 'added_by', name: 'added_by' },
                { data: 'location', name: 'location' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        $('#journal_entry_date_range_filter').on('cancel.daterangepicker', function(ev, picker) {
            $('#journal_entry_date_range_filter').val('');
            $('#date_range').val('');
            journal_table.ajax.reload();
        });

        $('select#location_id').on('change', function() {
            var location = $('select#location_id').find('option:selected').text();
            $('#business_location').val(location);
            journal_table.ajax.reload();
        });

        var dateRange = $('#journal_entry_date_range_filter').val();
        $('#date_range').val(dateRange);

        $('#journal_entry_print_btn').on('click', function(e) {
            e.preventDefault();
            window.open("<?php echo e(route('journal-entry.print'), false); ?>?" + $.param(getJournalEntryPrintParams()), '_blank');
        });

        function getJournalEntryPrintParams() {
            var start = '';
            var end = '';
            if ($('#journal_entry_date_range_filter').val()) {
                start = $('input#journal_entry_date_range_filter')
                    .data('daterangepicker')
                    .startDate.format('YYYY-MM-DD');
                end = $('input#journal_entry_date_range_filter')
                    .data('daterangepicker')
                    .endDate.format('YYYY-MM-DD');
            }

            return {
                start_date: start,
                end_date: end,
                location_id: $('select#location_id').val() || 'all',
                tab: 'all'
            };
        }

        //Delete Sale
        $(document).on('click', '.delete_journal_button', function(e) {
            e.preventDefault();
            swal({
                title: LANG.sure,
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(willDelete => {
                if (willDelete) {
                    var href = $(this).attr('data-href');
                    $.ajax({
                        method: 'DELETE',
                        url: href,
                        dataType: 'json',
                        success: function(result) {
                            if (result.success == true) {
                                toastr.success(result.msg);
                                journal_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                }
            });
        });

	});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>