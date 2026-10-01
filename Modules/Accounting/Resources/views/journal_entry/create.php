

<?php $__env->startSection('title', __('accounting::lang.journal_entry')); ?>

<?php $__env->startSection('css'); ?>
<style>
    .journal-entry-table .journal-entry-amount-heading,
    .journal-entry-table .journal-entry-amount-cell,
    .journal-entry-table .journal-entry-amount-input {
        text-align: right;
    }

    .journal-entry-table .journal-entry-amount-total {
        display: block;
        text-align: right;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'accounting::lang.journal_entry' ); ?></h1>
</section>
<section class="content">

<?php echo Form::open(['url' => action([\Modules\Accounting\Http\Controllers\JournalEntryController::class, 'store']), 
    'method' => 'post', 'id' => 'journal_add_form']); ?>


	<?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>

        <div class="row">
            <?php if(count($business_locations) == 1): ?>
            <?php
                $default_location = current(array_keys($business_locations->toArray()));
                $search_disable = false;
            ?>
            <?php else: ?>
            <?php
                $default_location = null;
                $search_disable = true;
            ?>
            <?php endif; ?>

            <?php if($location_id): ?>
                <?php
                    $default_location = $location_id;
                    $search_disable = false;
                ?>
            <?php endif; ?>

            <div class="col-sm-3">
                <div class="form-group">
                    <?php echo Form::label('location_id', __('purchase.business_location') . ':*'); ?>

                    <?php echo Form::select(
                        'location_id',
                        $business_locations,
                        $default_location,
                        ['class' => 'form-control select2', 'required'],
                    ); ?>

                </div>
            </div>
            
            <div class="col-sm-3">
                <div class="form-group">
                    <?php echo Form::label('ref_no', __('purchase.ref_no').':'); ?>

                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.leave_empty_to_autogenerate') . '"></i>';
                }
            ?>
                    <?php echo Form::text('ref_no', null, ['class' => 'form-control']); ?>

                </div>
            </div>

            <div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('journal_date', __('accounting::lang.journal_date') . ':*'); ?>

					<div class="input-group">
						<span class="input-group-text">
							<i class="fa fa-calendar"></i>
						</span>
						<?php echo Form::text('journal_date', \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control datetimepicker', 'readonly', 'required']); ?>

					</div>
				</div>
			</div>

            <?php if($truckmate_enabled): ?>
            <?php if(empty($job_sheet_id)): ?>
            <div class="col-sm-3">
                <div class="form-group">
                    <?php echo Form::label('job_sheet_id', __('truckmate::lang.jobs').':*'); ?>

                    <?php echo Form::select('job_sheet_id', [], null, ['class' => 'form-control select2', 'id' => 'job_sheet_ids', 'style' => 'width: 100%;']); ?>

                </div>
            </div>
            <?php else: ?>
            <input type="hidden" name="job_sheet_id" value="<?php echo e($job_sheet_id, false); ?>">
            <?php endif; ?>
            <?php endif; ?>

        </div>

        <div class="row">
            <div class="col-sm-12">

            <div class="table-responsive">
<table class="table table-bordered table-striped hide-footer table-th-skin journal-entry-table" id="journal_table">
                <thead>
                    <tr>
                        <th class="col-md-1">#</th>
                        <th class="col-md-4"><?php echo app('translator')->get( 'accounting::lang.account' ); ?></th>
                        <th class="col-md-3"><?php echo app('translator')->get( 'accounting::lang.narration' ); ?></th>
                        <th class="col-md-2 journal-entry-amount-heading"><?php echo app('translator')->get( 'accounting::lang.debit' ); ?> <?php if(!empty(session('currency.symbol'))): ?> (<?php echo e(session('currency.symbol'), false); ?>) <?php endif; ?></th>
                        <th class="col-md-2 journal-entry-amount-heading"><?php echo app('translator')->get( 'accounting::lang.credit' ); ?> <?php if(!empty(session('currency.symbol'))): ?> (<?php echo e(session('currency.symbol'), false); ?>) <?php endif; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i = 1; $i <= 2; $i++): ?>
                        <tr>
                            <td><?php echo e($i, false); ?></td>
                            <td>
                                <?php echo Form::select('account_id[' . $i . ']', [], null, 
                                            ['class' => 'form-control accounts-dropdown account_id', 
                                            'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;']); ?>

                            </td>
                            <td>
                                <?php echo Form::text('narration_note[' . $i . ']', null, ['class' => 'form-control note']); ?>

                            </td>
                            <td class="journal-entry-amount-cell">
                                <?php echo Form::text('debit[' . $i . ']', null, ['class' => 'form-control input_number debit journal-entry-amount-input']); ?>

                            </td>

                            <td class="journal-entry-amount-cell">
                                <?php echo Form::text('credit[' . $i . ']', null, ['class' => 'form-control input_number credit journal-entry-amount-input']); ?>

                            </td>
                        </tr>
                    <?php endfor; ?>
                    <tr>
                        <td class="text-center" colspan="6">
                            <button type="button" class="btn btn-primary btn-sm add_new_account_row"><i class="fa fa-plus"></i> <?php echo app('translator')->get('accounting::lang.add_new_account_row'); ?></button>
                        </td>
                    </tr>
                </tbody>

                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th class="text-center"><?php echo app('translator')->get( 'accounting::lang.total' ); ?></th>
                        <th class="journal-entry-amount-cell"><input type="hidden" class="total_debit_hidden"><span class="total_debit journal-entry-amount-total"></span></th>
                        <th class="journal-entry-amount-cell"><input type="hidden" class="total_credit_hidden"><span class="total_credit journal-entry-amount-total"></span></th>
                    </tr>
                </tfoot>
            </table>
</div>

            </div>
        </div>

        
        <div class="row mb-2">
            <div class="col-md-12">
                <button type="button" class="btn btn-outline-info btn-sm" id="toggle_cheque_section">
                    <i class="fas fa-money-check"></i> <?php echo app('translator')->get('accounting::lang.attach_cheque'); ?>
                </button>
            </div>
        </div>

        
        <div class="row mb-3" id="cheque_details_section" style="display:none;">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header bg-info text-white py-2 d-flex align-items-center">
                        <i class="fas fa-money-check me-2"></i>
                        <strong><?php echo app('translator')->get('accounting::lang.cheque_details'); ?></strong>
                        <button type="button" class="btn btn-sm btn-outline-light ms-auto" id="clear_cheque_selection">
                            <i class="fas fa-times"></i> <?php echo app('translator')->get('accounting::lang.clear_cheque'); ?>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo Form::label('cheque_bank_account_id', __('accounting::lang.bank_account') . ':'); ?>

                                    <select name="cheque_bank_account_id" id="cheque_bank_account_id" class="form-control cheque-select" style="width:100%">
                                        <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                                    </select>
                                    <small class="text-muted"><?php echo app('translator')->get('accounting::lang.cheque_bank_help'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo Form::label('cheque_book_id', __('accounting::lang.cheque_book_no') . ':'); ?>

                                    <select name="cheque_book_id" id="cheque_book_id" class="form-control cheque-select" style="width:100%">
                                        <option value=""><?php echo app('translator')->get('accounting::lang.select_bank_first'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo Form::label('cheque_leaf_id', __('accounting::lang.cheque_number') . ':'); ?>

                                    <select name="cheque_leaf_id" id="cheque_leaf_id" class="form-control cheque-select" style="width:100%">
                                        <option value=""><?php echo app('translator')->get('accounting::lang.select_cheque_book_first'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo Form::label('cheque_date', __('accounting::lang.cheque_date') . ':'); ?>

                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        <?php echo Form::text('cheque_date', null, ['class' => 'form-control', 'placeholder' => __('accounting::lang.cheque_date'), 'id' => 'cheque_date_input', 'readonly']); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo Form::label('note', __('lang_v1.additional_notes')); ?>

                    <?php echo Form::textarea('note', null, ['class' => 'form-control', 'rows' => 3]); ?>

                </div>
            </div>
        </div>

        <input type="hidden" name="save_and_print" value='0' id="save_and_print">
        
    <?php echo $__env->renderComponent(); ?>

    <?php echo Form::close(); ?>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php echo $__env->make('accounting::accounting.common_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<script type="text/javascript">
    $(document).ready(function(){

        // ── Cheque Details Toggle & Dynamic Loading ──
        var chequeRoutes = {
            booksByAccount: '<?php echo e(route("cheque-book.books-by-account"), false); ?>',
            unusedLeaves: '<?php echo e(route("cheque-book.unused-leaves"), false); ?>'
        };
        var chequeInitialized = false;

        // Helper: init or reinit Select2 on a cheque select
        function initChequeSelect2($el, placeholder) {
            if ($el.hasClass('select2-hidden-accessible')) {
                $el.select2('destroy');
            }
            $el.select2({
                placeholder: placeholder || '<?php echo app('translator')->get("messages.please_select"); ?>',
                allowClear: true,
                width: '100%'
            });
        }

        // Initialize cheque date picker
        function initChequeDatepicker() {
            if ($('#cheque_date_input').data('daterangepicker')) return;
            $('#cheque_date_input').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                autoUpdateInput: false,
                locale: {
                    format: moment_date_format,
                    cancelLabel: 'Clear'
                }
            });
            $('#cheque_date_input').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format(moment_date_format));
            });
            $('#cheque_date_input').on('cancel.daterangepicker', function() {
                $(this).val('');
            });
        }

        // Initialize all cheque fields (called once when section first opens)
        function initChequeFields() {
            if (chequeInitialized) return;
            chequeInitialized = true;

            initChequeSelect2($('#cheque_bank_account_id'), '<?php echo app('translator')->get("messages.please_select"); ?>');
            initChequeSelect2($('#cheque_book_id'), '<?php echo app('translator')->get("accounting::lang.select_bank_first"); ?>');
            initChequeSelect2($('#cheque_leaf_id'), '<?php echo app('translator')->get("accounting::lang.select_cheque_book_first"); ?>');
            initChequeDatepicker();
        }

        // Toggle cheque section
        $('#toggle_cheque_section').on('click', function() {
            var $section = $('#cheque_details_section');
            if ($section.is(':visible')) {
                $section.slideUp();
                $(this).html('<i class="fas fa-money-check"></i> <?php echo app('translator')->get("accounting::lang.attach_cheque"); ?>');
            } else {
                $section.slideDown(function() {
                    initChequeFields();
                    loadBankAccountsForCheque();
                });
                $(this).html('<i class="fas fa-times"></i> <?php echo app('translator')->get("accounting::lang.hide_cheque_section"); ?>');
            }
        });

        // Load bank accounts that have active cheque books into the cheque bank dropdown
        function loadBankAccountsForCheque() {
            var accountOptions = [];
            var seen = {};
            $('#journal_table tbody .account_id').each(function() {
                var $opt = $(this).find('option:selected');
                if ($opt.val() && !seen[$opt.val()]) {
                    seen[$opt.val()] = true;
                    accountOptions.push({ id: $opt.val(), text: $opt.text() });
                }
            });

            var $bankSelect = $('#cheque_bank_account_id');
            // Destroy and rebuild
            if ($bankSelect.hasClass('select2-hidden-accessible')) {
                $bankSelect.select2('destroy');
            }
            $bankSelect.empty().append('<option value=""><?php echo app('translator')->get("messages.please_select"); ?></option>');
            accountOptions.forEach(function(opt) {
                $bankSelect.append($('<option>', { value: opt.id, text: opt.text }));
            });
            initChequeSelect2($bankSelect, '<?php echo app('translator')->get("messages.please_select"); ?>');
        }

        // When bank account selected, load its cheque books
        $(document).on('change', '#cheque_bank_account_id', function() {
            var accountId = $(this).val();
            var $bookSelect = $('#cheque_book_id');
            var $leafSelect = $('#cheque_leaf_id');

            // Reset book select
            if ($bookSelect.hasClass('select2-hidden-accessible')) {
                $bookSelect.select2('destroy');
            }
            $bookSelect.empty().append('<option value=""><?php echo app('translator')->get("messages.please_select"); ?></option>');

            // Reset leaf select
            if ($leafSelect.hasClass('select2-hidden-accessible')) {
                $leafSelect.select2('destroy');
            }
            $leafSelect.empty().append('<option value=""><?php echo app('translator')->get("accounting::lang.select_cheque_book_first"); ?></option>');
            initChequeSelect2($leafSelect, '<?php echo app('translator')->get("accounting::lang.select_cheque_book_first"); ?>');

            if (!accountId) {
                initChequeSelect2($bookSelect, '<?php echo app('translator')->get("accounting::lang.select_bank_first"); ?>');
                return;
            }

            $.ajax({
                url: chequeRoutes.booksByAccount,
                data: { account_id: accountId },
                dataType: 'json',
                success: function(data) {
                    if (data.length > 0) {
                        data.forEach(function(book) {
                            $bookSelect.append($('<option>', { value: book.id, text: book.text }));
                        });
                    } else {
                        $bookSelect.empty().append('<option value=""><?php echo app('translator')->get("accounting::lang.no_active_cheque_book"); ?></option>');
                    }
                    initChequeSelect2($bookSelect, '<?php echo app('translator')->get("messages.please_select"); ?>');
                }
            });
        });

        // When cheque book selected, load unused leaves
        $(document).on('change', '#cheque_book_id', function() {
            var bookId = $(this).val();
            var $leafSelect = $('#cheque_leaf_id');

            if ($leafSelect.hasClass('select2-hidden-accessible')) {
                $leafSelect.select2('destroy');
            }
            $leafSelect.empty().append('<option value=""><?php echo app('translator')->get("messages.please_select"); ?></option>');

            if (!bookId) {
                initChequeSelect2($leafSelect, '<?php echo app('translator')->get("accounting::lang.select_cheque_book_first"); ?>');
                return;
            }

            $.ajax({
                url: chequeRoutes.unusedLeaves,
                data: { cheque_book_id: bookId },
                dataType: 'json',
                success: function(data) {
                    if (data.length > 0) {
                        data.forEach(function(leaf) {
                            $leafSelect.append($('<option>', { value: leaf.id, text: leaf.text }));
                        });
                        initChequeSelect2($leafSelect, '<?php echo app('translator')->get("messages.please_select"); ?>');
                        // Auto-select first (next available)
                        $leafSelect.val(data[0].id).trigger('change');
                    } else {
                        $leafSelect.empty().append('<option value=""><?php echo app('translator')->get("accounting::lang.book_exhausted"); ?></option>');
                        initChequeSelect2($leafSelect, '<?php echo app('translator')->get("accounting::lang.book_exhausted"); ?>');
                    }
                }
            });
        });

        // Clear cheque selection
        $('#clear_cheque_selection').on('click', function() {
            var $bankSelect = $('#cheque_bank_account_id');
            var $bookSelect = $('#cheque_book_id');
            var $leafSelect = $('#cheque_leaf_id');

            if ($bankSelect.hasClass('select2-hidden-accessible')) $bankSelect.select2('destroy');
            if ($bookSelect.hasClass('select2-hidden-accessible')) $bookSelect.select2('destroy');
            if ($leafSelect.hasClass('select2-hidden-accessible')) $leafSelect.select2('destroy');

            $bankSelect.empty().append('<option value=""><?php echo app('translator')->get("messages.please_select"); ?></option>');
            $bookSelect.empty().append('<option value=""><?php echo app('translator')->get("accounting::lang.select_bank_first"); ?></option>');
            $leafSelect.empty().append('<option value=""><?php echo app('translator')->get("accounting::lang.select_cheque_book_first"); ?></option>');

            initChequeSelect2($bankSelect, '<?php echo app('translator')->get("messages.please_select"); ?>');
            initChequeSelect2($bookSelect, '<?php echo app('translator')->get("accounting::lang.select_bank_first"); ?>');
            initChequeSelect2($leafSelect, '<?php echo app('translator')->get("accounting::lang.select_cheque_book_first"); ?>');
            $('#cheque_date_input').val('');
        });

        // Refresh bank account options when account rows change
        $(document).on('change', '.account_id', function() {
            if ($('#cheque_details_section').is(':visible')) {
                loadBankAccountsForCheque();
            }
        });

        $(document).on('click', '#journal_add_form #save_and_print_btn', function(e){
            e.preventDefault();
            $('#journal_add_form #save_and_print').val(1);
            $('.journal_add_btn').prop('disabled', true);
            $('#journal_add_form').submit();
        });

        $('.journal_add_btn').click(function(e){
            //e.preventDefault();
            calculate_total();
            
            var is_valid = true;

            //check if same or not
            if($('.total_credit_hidden').val() != $('.total_debit_hidden').val()){
                is_valid = false;
                alert("<?php echo app('translator')->get('accounting::lang.credit_debit_equal'); ?>");
            }

            //check if all account selected or not
            $('table > tbody  > tr').each(function(index, tr) { 
                var credit = __read_number($(tr).find('.credit'));
                var debit = __read_number($(tr).find('.debit'));

                if(credit != 0 || debit != 0){
                    if($(tr).find('.account_id').val() == ''){
                        is_valid = false;
                        alert("<?php echo app('translator')->get('accounting::lang.select_all_accounts'); ?>");
                    }
                }
            });

            if(is_valid){
                $('.journal_add_btn').prop('disabled', true);
                $('form#journal_add_form').submit();
            }

            return is_valid;
        });

        $('.credit').change(function(){
            if($(this).val() > 0){
                $(this).parents('tr').find('.debit').val('');
            }
            calculate_total();
        });
        $('.debit').change(function(){
            if($(this).val() > 0){
                $(this).parents('tr').find('.credit').val('');
            }
            calculate_total();
        });
        $('.account_id').change(function(){
            let firstNote = $('#journal_table tbody tr:first').find('.note').val(); // Get note from the first row
            $(this).closest('tr').find('.note').val(firstNote); // Set note
        });

        $(document).on('click', '.add_new_account_row', function(){
            // Get the last row index
            var lastRowIndex = 0;
            $('#journal_table tbody tr').each(function(){
                var rowIndex = parseInt($(this).find('td:first').text());
                if(!isNaN(rowIndex) && rowIndex > lastRowIndex){
                    lastRowIndex = rowIndex;
                }
            });
            var newIndex = lastRowIndex + 1;

            var newRow = `
                <tr>
                    <td>${newIndex}</td>
                    <td>
                        <select name="account_id[${newIndex}]" class="form-control accounts-dropdown account_id" style="width: 100%;">
                            <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="narration_note[${newIndex}]" class="form-control note">
                    </td>
                    <td class="journal-entry-amount-cell">
                        <input type="text" name="debit[${newIndex}]" class="form-control input_number debit journal-entry-amount-input">
                    </td>
                    <td class="journal-entry-amount-cell">
                        <input type="text" name="credit[${newIndex}]" class="form-control input_number credit journal-entry-amount-input">
                    </td>
                </tr>
            `;

            // Insert the new row before the "add new" button row
            $(this).closest('tr').before(newRow);

            // Initialize the accounts dropdown for the new row
            var newSelect = $('#journal_table tbody tr').eq(-2).find('.accounts-dropdown');
            newSelect.select2({
                ajax: {
                    url: '<?php echo e(route("accounts-dropdown"), false); ?>',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: data
                        }
                    },
                },
                escapeMarkup: function(markup) {
                    return markup;
                },
                templateResult: function(data) {
                    return data.html;
                },
                templateSelection: function(data) {
                    return data.text;
                }
            });
        });

        if ($('select#location_id').val()) {
			get_job_sheets_for_expense();
		}
        
        // Load job sheets when location changes
        $('select#location_id').change(function() {
            get_job_sheets_for_expense();
        });
	});

	function get_job_sheets_for_expense() {
		var location_id = $('select#location_id').val();
		if ($('#job_sheet_ids').length && location_id) {
			$.ajax({
            url: '/truckmate/get-location-job-sheets?location_id=' + location_id,
				dataType: 'json',
				success: function(data) {
					if(data && data.length > 0){
						$('#job_sheet_ids').select2('destroy').empty().select2({data: data});
						
						// Pre-select job if job_sheet_id query parameter is present
						<?php if(request()->has('job_sheet_id')): ?>
							var jobSheetId = '<?php echo e(request()->get('job_sheet_id'), false); ?>';
							if (jobSheetId) {
								$('#job_sheet_ids').val([jobSheetId]).trigger('change');
							}
						<?php endif; ?>
					} else {
						$('#job_sheet_ids').select2('destroy').empty().select2({data: [{id: '', text: 'No Jobs Available'}]});
					}
				},
				error: function() {
					$('#job_sheet_ids').select2('destroy').empty().select2({data: [{id: '', text: 'Click to Select'}]});
				}
			});
		}
	}

    function calculate_total(){
        var precision = $('#__precision').val();

        var total_credit = 0;
        var total_debit = 0;
        $('table > tbody  > tr').each(function(index, tr) { 
            var credit = __read_number($(tr).find('.credit'));
            total_credit += credit;

            var debit = __read_number($(tr).find('.debit'));
            total_debit += debit;
        });

        // Round total_credit and total_debit based on precision
        total_credit = parseFloat(total_credit.toFixed(precision));
        total_debit = parseFloat(total_debit.toFixed(precision));


        $('.total_credit_hidden').val(total_credit);
        $('.total_debit_hidden').val(total_debit);

        $('.total_credit').text(__currency_trans_from_en(total_credit, false));
        $('.total_debit').text(__currency_trans_from_en(total_debit, false));

        if((total_credit != 0) || (total_debit != 0) )
        {
            $('#save_btn').prop('disabled', false);
            $('#save_and_print_btn').prop('disabled', false);
        }
    }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>