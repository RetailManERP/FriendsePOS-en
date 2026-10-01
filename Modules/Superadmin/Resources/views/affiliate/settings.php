
<?php $__env->startSection('title', __('superadmin::lang.superadmin') . ' | ' . __('superadmin::lang.affiliates')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('superadmin::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black"><?php echo app('translator')->get('superadmin::lang.affiliates'); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <?php echo $__env->make('superadmin::layouts.partials.currency', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php $__env->startComponent('components.widget'); ?>
        
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#affiliate_accounts_tab" data-toggle="tab">
                    <strong><?php echo app('translator')->get('superadmin::lang.affiliate_accounts'); ?></strong>
                </a>
            </li>
            <li>
                <a href="#affiliate_settings_tab" data-toggle="tab">
                    <strong><?php echo app('translator')->get('superadmin::lang.program_settings'); ?></strong>
                </a>
            </li>
        </ul>

        
        <div class="tab-content tw-p-4 tw-bg-white tw-border tw-border-gray-200">
            <div class="tab-pane active" id="affiliate_accounts_tab">
                <?php echo $__env->make('superadmin::affiliate.partials.list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <div class="tab-pane" id="affiliate_settings_tab">
                <?php echo Form::open([
                    'action' => '\Modules\Superadmin\Http\Controllers\AffiliateSettingsController@update',
                    'method' => 'put',
                    'id' => 'affiliate_settings_form',
                ]); ?>

                    <div class="row">
                        <div class="col-xs-12">
                        <div class="form-group">
                            <label>
                            <?php echo Form::checkbox('enabled', 1, !empty($settings['enabled']), ['class' => 'input-icheck']); ?>

                            <?php echo app('translator')->get('superadmin::lang.enable_affiliate'); ?>
                            </label>
                            <br>
                            <small class="text-muted"><?php echo app('translator')->get('superadmin::lang.enable_affiliate_help'); ?></small>
                        </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <?php echo Form::label('commission_percentage', __('superadmin::lang.commission_percentage') . ':'); ?>

                            <?php echo Form::number('commission_percentage', $settings['commission_percentage'], ['class' => 'form-control', 'step' => '0.01', 'min' => '0', 'max' => '100', 'required']); ?>

                            <small class="text-muted"><?php echo app('translator')->get('superadmin::lang.commission_percentage_help'); ?></small>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <?php echo Form::label('cookie_days', __('superadmin::lang.affiliate_cookie_duration') . ':'); ?>

                            <?php echo Form::number('cookie_days', $settings['cookie_days'], ['class' => 'form-control', 'min' => '1', 'max' => '3650', 'required']); ?>

                            <small class="text-muted"><?php echo app('translator')->get('superadmin::lang.affiliate_cookie_duration_help'); ?></small>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <?php echo Form::label('min_payout', __('superadmin::lang.minimum_payout') . ':'); ?>

                            
                            <?php echo Form::text('min_payout', number_format($settings['min_payout'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'required']); ?>

                            <small class="text-muted"><?php echo app('translator')->get('superadmin::lang.minimum_payout_help'); ?></small>
                        </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <?php echo Form::label('affiliate_terms', __('superadmin::lang.affiliate_terms_and_conditions') . ':'); ?>

                            <?php echo Form::textarea('terms', $settings['terms'], ['class' => 'form-control', 'id' => 'affiliate_terms']); ?>

                        </div>
                    </div>

                    </div>

                    
                    <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <?php echo e(Form::submit(__('messages.update'), ['class' => "tw-dw-btn tw-dw-btn-primary tw-text-white"]), false); ?>

                        </div>
                    </div>
                    </div>
                <?php echo Form::close(); ?>

            </div>

        </div>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        if ($('#affiliate_terms').length) {
            tinymce.init({
                selector: 'textarea#affiliate_terms'
            });
        }

        $('form#affiliate_settings_form').validate({
            /*
             * The terms editor is replaced by TinyMCE, which hides the original
             * textarea; nothing here requires it, but keeping the default
             * ignore rule would also skip the icheck backed enable switch.
             */
            ignore: [],
            rules: {
                commission_percentage: {
                    required: true,
                    number: true,
                    min: 0,
                    max: 100
                },
                cookie_days: {
                    required: true,
                    digits: true,
                    min: 1,
                    max: 3650
                },
                min_payout: {
                    required: true
                }
            },
            messages: {
                commission_percentage: {
                    required: "<?php echo e(__('validation.required', ['attribute' => __('superadmin::lang.commission_percentage')]), false); ?>"
                },
                cookie_days: {
                    required: "<?php echo e(__('validation.required', ['attribute' => __('superadmin::lang.affiliate_cookie_duration')]), false); ?>"
                },
                min_payout: {
                    required: "<?php echo e(__('validation.required', ['attribute' => __('superadmin::lang.minimum_payout')]), false); ?>"
                }
            },
            //Only runs once valid, so a failed check never leaves it disabled.
            submitHandler: function(form) {
                $(form).find('input[type="submit"], button[type="submit"]').prop('disabled', true);

                form.submit();
            }
        });

        var affiliates_table = $('#affiliates_table').DataTable({
            processing: true,
            serverSide: true,
            fixedHeader: false,
            /*
             * Widths are left to css rather than measured and written inline,
             * so the table fills its pane whatever the pane's width turns out
             * to be.
             */
            autoWidth: false,
            ajax: {
                url: "<?php echo e(action([\Modules\Superadmin\Http\Controllers\SuperadminAffiliatesController::class, 'index']), false); ?>",
                data: function(d) {
                    d.status = $('#affiliate_status_filter').val();

                    d = __datatable_ajax_callback(d);
                }
            },
            
            aaSorting: [
                [6, 'desc']
            ],
            columns: [
                { data: 'checkbox', name: 'checkbox', orderable: false, searchable: false },
                { data: 'affiliate_name', name: 'affiliate_name' },
                { data: 'status', name: 'affiliates.status' },
                /*
                 * Sortable on the alias, which mysql allows in ORDER BY, but not
                 * searchable: a WHERE cannot reference a select alias, so letting
                 * the global search touch these would produce invalid sql.
                 */
                { data: 'to_approve_count', name: 'to_approve_count', searchable: false },
                { data: 'payable_amount', name: 'payable_amount', searchable: false },
                { data: 'paid_amount', name: 'paid_amount', searchable: false },
                { data: 'created_at', name: 'affiliates.created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            //Rows arrive by ajax, so the money columns are converted per draw.
            "fnDrawCallback": function(oSettings) {
                __currency_convert_recursively($('#affiliates_table'), true);
            }
        });

        /*
         * The form wraps the table so the row checkboxes submit themselves,
         * which also leaves DataTables' own "show N entries" select inside it.
         * Dropping its name keeps it out of the submitted url. DataTables binds
         * to the element rather than the name, so the control still works.
         */
        $('#affiliates_table_wrapper').find('select[name$="_length"]').removeAttr('name');

        /*
         * The accounts pane opens first, so the table is measured against a
         * visible pane. The re-measure is kept for the trip back from the
         * settings tab, where the pane is hidden and shown again.
         */
        $('a[href="#affiliate_accounts_tab"]').on('shown.bs.tab', function () {
            affiliates_table.columns.adjust();
        });

        $('#affiliate_status_filter').change(function() {
            affiliates_table.ajax.reload();
        });

        /*
         * ---- bulk pay -------------------------------------------------------
         *
         * Only rows with something payable carry a .row-select checkbox, so the
         * shared select-all handler cannot pick an affiliate who has nothing to
         * be paid. The amount sits on each checkbox, which is what lets the bar
         * total the selection without asking the server again.
         */
        var refreshBulkBar = function() {
            var selected = $('#affiliates_table').find('input.row-select:checked');
            var total = 0;

            selected.each(function() {
                total += parseFloat($(this).data('payable')) || 0;
            });

            //The bar stays put; only the button's state and wording change.
            $('#affiliate_bulk_pay')
                .prop('disabled', selected.length === 0)
                .text(
                    "<?php echo e(__('superadmin::lang.pay_selected_count'), false); ?>"
                        .replace(':count', selected.length)
                );

            $('#affiliate_bulk_summary').text(
                selected.length === 0
                    ? "<?php echo e(__('superadmin::lang.bulk_select_hint'), false); ?>"
                    : "<?php echo e(__('superadmin::lang.bulk_selection_summary'), false); ?>"
                        .replace(':count', selected.length)
                        //Formatted by the app's own helper, like every other amount on the page.
                        .replace(':total', __currency_trans_from_en(total, true))
            );
        };

        //Delegated: the rows are replaced on every draw.
        $(document).on('change', '#affiliates_table input.row-select, #select-all-row', refreshBulkBar);

        refreshBulkBar();

        //A redraw drops the selection, so the bar must not linger.
        affiliates_table.on('draw', function() {
            $('#select-all-row').prop('checked', false);
            refreshBulkBar();
        });

        /*
         * The checkboxes are inside the form and carry their own name, so the
         * browser submits the selection. This only stops an empty submit.
         *
         * No confirmation dialog: submitting opens the payout page, where the
         * amounts are shown and can still be changed. Asking "are you sure"
         * before a screen that writes nothing asks about the wrong step.
         */
        $('#affiliate_bulk_form').submit(function() {
            return $('#affiliates_table').find('input.row-select:checked').length > 0;
        });

        /*
         * These are json encoded rather than echoed by blade. A blade echo
         * escapes for html, so an apostrophe would reach the dialog as a raw
         * html entity with nothing to decode it: the confirmation would read
         * "affiliate" followed by an entity instead of an apostrophe.
         * Encoding produces a correctly quoted js string instead.
         *
         * Note for anyone editing this block: a bare blade directive or echo
         * inside a comment is still compiled, so neither may appear above.
         */
        var affiliate_status_prompts = {
            approved: {
                title: <?php echo json_encode(__('superadmin::lang.confirm_approve_title'), 15, 512) ?>,
                text: <?php echo json_encode(__('superadmin::lang.confirm_approve_text'), 15, 512) ?>,
                icon: 'info'
            },
            rejected: {
                title: <?php echo json_encode(__('superadmin::lang.confirm_reject_title'), 15, 512) ?>,
                text: <?php echo json_encode(__('superadmin::lang.confirm_reject_text'), 15, 512) ?>,
                icon: 'warning'
            },
            suspended: {
                title: <?php echo json_encode(__('superadmin::lang.confirm_suspend_title'), 15, 512) ?>,
                text: <?php echo json_encode(__('superadmin::lang.confirm_suspend_text'), 15, 512) ?>,
                icon: 'warning'
            }
        };

        
        $(document).on('click', '.update_affiliate_status', function(e) {
            e.preventDefault();

            var button = $(this);
            var status = button.data('status');

            //Falls back to the generic wording if a new status is ever added.
            var prompt = affiliate_status_prompts[status] || {
                title: LANG.sure,
                text: <?php echo json_encode(__('superadmin::lang.confirm_affiliate_status_change'), 15, 512) ?>,
                icon: 'warning'
            };

            swal({
                title: prompt.title,
                text: prompt.text,
                icon: prompt.icon,
                buttons: true,
                dangerMode: status !== 'approved',
            }).then((confirmed) => {
                if (confirmed) {
                    $.ajax({
                        method: 'POST',
                        url: button.data('href'),
                        dataType: 'json',
                        data: {
                            status: status,
                            _token: "<?php echo e(csrf_token(), false); ?>"
                        },
                        success: function(result) {
                            if (result.success === true) {
                                toastr.success(result.msg);
                                affiliates_table.ajax.reload();
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